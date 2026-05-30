#!/usr/bin/env python3
"""
Convert MySQL phpMyAdmin SQL dump to SQLite-compatible SQL.
Usage: python3 convert_db.py input.sql output.sql
"""
import re
import sys


def collect_alter_info(sql):
    """Collect PRIMARY KEY and AUTO_INCREMENT info from ALTER TABLE blocks."""
    pk_info = {}
    ai_info = {}

    # Match full ALTER TABLE blocks (multi-line)
    for m in re.finditer(r'ALTER TABLE\s+`(\w+)`(.*?);', sql, re.DOTALL | re.IGNORECASE):
        table = m.group(1)
        body = m.group(2)

        pk_match = re.search(r'ADD PRIMARY KEY\s*\(([^)]+)\)', body, re.IGNORECASE)
        if pk_match:
            cols = [c.strip().strip('`') for c in pk_match.group(1).split(',')]
            pk_info[table] = cols

        ai_match = re.search(r'MODIFY\s+`(\w+)`[^,;]+AUTO_INCREMENT', body, re.IGNORECASE)
        if ai_match:
            ai_info[table] = ai_match.group(1)

    return pk_info, ai_info


def sqlite_type(mysql_type):
    """Map MySQL type to SQLite type."""
    t = mysql_type.strip()
    if re.match(r'(tiny|small|medium|big)?int\s*\(\d+\)', t, re.I):
        return 'INTEGER'
    if re.match(r'int\s*\(\d+\)', t, re.I):
        return 'INTEGER'
    if re.match(r'varchar\s*\(\d+\)', t, re.I):
        return 'TEXT'
    if re.match(r'(medium|long|tiny)?text\b', t, re.I):
        return 'TEXT'
    if re.match(r'char\s*\(\d+\)', t, re.I):
        return 'TEXT'
    if re.match(r'enum\s*\(', t, re.I):
        return 'TEXT'
    if re.match(r'set\s*\(', t, re.I):
        return 'TEXT'
    if re.match(r'(float|double)\b', t, re.I):
        return 'REAL'
    if re.match(r'decimal\s*\(', t, re.I):
        return 'REAL'
    if re.match(r'(datetime|timestamp|date|time)\b', t, re.I):
        return 'TEXT'
    if re.match(r'(medium|long|tiny)?blob\b', t, re.I):
        return 'BLOB'
    return 'TEXT'


def clean_constraints(s):
    """Remove MySQL-only constraint modifiers."""
    s = re.sub(r'\bUNSIGNED\b', '', s, flags=re.I)
    s = re.sub(r'\bZEROFILL\b', '', s, flags=re.I)
    s = re.sub(r'\bCHARACTER SET \w+', '', s, flags=re.I)
    s = re.sub(r'\bCOLLATE \w+', '', s, flags=re.I)
    s = re.sub(r"\bCOMMENT\s+'[^']*'", '', s, flags=re.I)
    s = re.sub(r'\bAUTO_INCREMENT\b', '', s, flags=re.I)
    return re.sub(r'\s+', ' ', s).strip()


def convert_col_line(raw):
    """Convert one column definition line. Returns None to skip, else string."""
    s = raw.strip().rstrip(',')
    if not s or s.startswith('--'):
        return None
    # Skip KEY/INDEX lines inside CREATE TABLE
    if re.match(r'(UNIQUE\s+KEY|KEY|PRIMARY\s+KEY)\s', s, re.I):
        return None
    # Must start with `colname`
    col_match = re.match(r'`(\w+)`\s+(.*)', s)
    if not col_match:
        return None

    col_name = col_match.group(1)
    rest = col_match.group(2)

    # Extract MySQL type (word + optional parens)
    type_match = re.match(r'(\w+(?:\s*\([^)]*\))?)', rest)
    if not type_match:
        return f'`{col_name}` TEXT'

    mysql_t = type_match.group(1)
    after = rest[len(mysql_t):]
    sql_t = sqlite_type(mysql_t)
    constraints = clean_constraints(after)

    # Mimic MySQL non-strict mode: NOT NULL without DEFAULT → add SQLite default
    if re.search(r'\bNOT NULL\b', constraints, re.I) and not re.search(r'\bDEFAULT\b', constraints, re.I):
        if sql_t in ('INTEGER', 'REAL'):
            constraints += ' DEFAULT 0'
        else:
            constraints += " DEFAULT ''"

    result = f'`{col_name}` {sql_t}'
    if constraints:
        result += f' {constraints}'
    return result


def build_create_table(table_name, body_lines, pk_info, ai_info):
    """Build a SQLite CREATE TABLE statement."""
    pk_cols = pk_info.get(table_name, [])
    ai_col = ai_info.get(table_name)
    is_simple_pk = len(pk_cols) == 1

    converted = []
    for line in body_lines:
        col = convert_col_line(line)
        if col is None:
            continue

        col_name_m = re.match(r'`(\w+)`', col)
        if col_name_m:
            col_name = col_name_m.group(1)
            if is_simple_pk and col_name == pk_cols[0]:
                if ai_col == col_name:
                    col = f'`{col_name}` INTEGER PRIMARY KEY AUTOINCREMENT'
                else:
                    col = re.sub(r'\s+NOT NULL\b', '', col)
                    col = col.rstrip() + ' PRIMARY KEY'

        converted.append('  ' + col)

    # Composite primary key
    if len(pk_cols) > 1:
        pk_str = ', '.join(f'`{c}`' for c in pk_cols)
        converted.append(f'  PRIMARY KEY ({pk_str})')

    if not converted:
        converted.append('  `_dummy` INTEGER')

    cols_sql = ',\n'.join(converted)
    return f'CREATE TABLE IF NOT EXISTS `{table_name}` (\n{cols_sql}\n);\n'


def convert(input_path, output_path):
    with open(input_path, encoding='utf-8', errors='replace') as f:
        content = f.read()

    pk_info, ai_info = collect_alter_info(content)

    lines = content.split('\n')
    output = []
    i = 0
    in_ct = False
    ct_name = None
    ct_body = []

    while i < len(lines):
        line = lines[i]
        s = line.strip()

        # Skip MySQL conditional comments
        if s.startswith('/*!') or s.startswith('-- phpMyAdmin') or \
           s.startswith('-- version ') or s.startswith('-- https://www.phpmyadmin') or \
           s.startswith('-- Хост:') or s.startswith('-- Время создания') or \
           s.startswith('-- Версия сервера') or s.startswith('-- Версия PHP'):
            i += 1
            continue

        # Skip MySQL SET statements
        if re.match(r'SET\s+(SQL_MODE|AUTOCOMMIT|time_zone|NAMES)\b', s, re.I):
            i += 1
            continue

        # START TRANSACTION → BEGIN TRANSACTION
        if s == 'START TRANSACTION;':
            output.append('BEGIN TRANSACTION;')
            i += 1
            continue

        # Skip ALTER TABLE blocks (already processed)
        if re.match(r'ALTER TABLE\s', s, re.I):
            while i < len(lines) and not lines[i].rstrip().endswith(';'):
                i += 1
            i += 1
            continue

        # Detect CREATE TABLE start
        ct_match = re.match(r'CREATE TABLE `(\w+)`', s)
        if ct_match:
            in_ct = True
            ct_name = ct_match.group(1)
            ct_body = []
            i += 1
            continue

        if in_ct:
            # Closing line has ENGINE= or similar
            if re.match(r'\)\s*(ENGINE=|COLLATE=|DEFAULT\s+CHARSET=|ROW_FORMAT=)', s, re.I) \
               or (s == ');' and not ct_body):
                in_ct = False
                output.append(build_create_table(ct_name, ct_body, pk_info, ai_info))
            else:
                ct_body.append(line)
        else:
            output.append(line)

        i += 1

    with open(output_path, 'w', encoding='utf-8') as f:
        f.write('\n'.join(output))

    print(f"Done: {output_path}")


if __name__ == '__main__':
    if len(sys.argv) != 3:
        print(f"Usage: {sys.argv[0]} input.sql output.sql")
        sys.exit(1)
    convert(sys.argv[1], sys.argv[2])
