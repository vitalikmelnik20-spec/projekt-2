<?php
// SQLite-based mysql_* compatibility shim (replaces deprecated PHP mysql_* functions)

if (!class_exists('_SqliteResult')) {
    class _SqliteResult {
        private $rows;
        private $pos = 0;

        public function __construct($rows) {
            $this->rows = $rows;
        }

        public function fetch() {
            if ($this->pos >= count($this->rows)) return false;
            return $this->rows[$this->pos++];
        }

        public function numRows() {
            return count($this->rows);
        }

        public function seek($offset) {
            $this->pos = (int)$offset;
        }

        public function getRow($row) {
            return isset($this->rows[$row]) ? $this->rows[$row] : false;
        }
    }
}

if (!function_exists('mysql_connect')) {

    $GLOBALS['__sqlite_db']            = null;
    $GLOBALS['__sqlite_insert_id']     = 0;
    $GLOBALS['__sqlite_affected_rows'] = 0;

    function _sqlite_open() {
        if ($GLOBALS['__sqlite_db']) return $GLOBALS['__sqlite_db'];
        $path = $GLOBALS['__sqlite_path'] ?? ($_ENV['SQLITE_PATH'] ?? '/data/game.db');
        try {
            $pdo = new PDO('sqlite:' . $path);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            $pdo->exec('PRAGMA journal_mode=WAL');
            $pdo->exec('PRAGMA synchronous=NORMAL');
            $GLOBALS['__sqlite_db'] = $pdo;
            return $pdo;
        } catch (Exception $e) {
            return false;
        }
    }

    function mysql_connect($host = '', $user = '', $pass = '', $new = false, $flags = 0) {
        return _sqlite_open();
    }

    function mysql_select_db($db, $link = null) {
        return true; // SQLite: database is the file
    }

    function mysql_query($query, $link = null) {
        $db = _sqlite_open();
        if (!$db) return false;

        $query = trim($query);

        // Silently ignore MySQL-specific statements
        if (preg_match('/^SET\s+(NAMES|CHARACTER|sql_mode|AUTOCOMMIT)/i', $query)) {
            return true;
        }

        try {
            $stmt = $db->query($query);
            if ($stmt === false) return false;

            $verb = strtoupper(substr(ltrim($query), 0, 6));
            if ($verb === 'SELECT' || $verb === 'SHOW  ') {
                $rows = $stmt->fetchAll(PDO::FETCH_BOTH);
                return new _SqliteResult($rows);
            } else {
                $GLOBALS['__sqlite_insert_id']     = $db->lastInsertId();
                $GLOBALS['__sqlite_affected_rows'] = $stmt->rowCount();
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    function mysql_fetch_array($result, $type = null) {
        if (!($result instanceof _SqliteResult)) return false;
        return $result->fetch();
    }

    function mysql_fetch_assoc($result) {
        if (!($result instanceof _SqliteResult)) return false;
        $row = $result->fetch();
        if (!$row) return false;
        // Return only string keys
        return array_filter($row, 'is_string', ARRAY_FILTER_USE_KEY);
    }

    function mysql_fetch_row($result) {
        if (!($result instanceof _SqliteResult)) return false;
        $row = $result->fetch();
        if (!$row) return false;
        return array_filter($row, 'is_int', ARRAY_FILTER_USE_KEY);
    }

    function mysql_fetch_object($result) {
        if (!($result instanceof _SqliteResult)) return false;
        $row = mysql_fetch_assoc($result);
        if (!$row) return false;
        return (object)$row;
    }

    function mysql_num_rows($result) {
        if (!($result instanceof _SqliteResult)) return 0;
        return $result->numRows();
    }

    function mysql_affected_rows($link = null) {
        return (int)$GLOBALS['__sqlite_affected_rows'];
    }

    function mysql_insert_id($link = null) {
        return (int)$GLOBALS['__sqlite_insert_id'];
    }

    function mysql_result($result, $row, $field = 0) {
        if (!($result instanceof _SqliteResult)) return false;
        $r = $result->getRow($row);
        if ($r === false) return false;
        if (is_int($field)) return $r[$field] ?? false;
        if (strpos($field, '.') !== false) {
            [, $col] = explode('.', $field, 2);
            return $r[$col] ?? false;
        }
        return $r[$field] ?? false;
    }

    function mysql_data_seek($result, $offset) {
        if (!($result instanceof _SqliteResult)) return false;
        $result->seek($offset);
        return true;
    }

    function mysql_num_fields($result) {
        if (!($result instanceof _SqliteResult)) return 0;
        $row = $result->getRow(0);
        if (!$row) return 0;
        return count(array_filter($row, 'is_string', ARRAY_FILTER_USE_KEY));
    }

    function mysql_free_result($result) { return true; }

    function mysql_error($link = null) {
        $db = $GLOBALS['__sqlite_db'];
        if (!$db) return '';
        $info = $db->errorInfo();
        return $info[2] ?? '';
    }

    function mysql_errno($link = null) {
        $db = $GLOBALS['__sqlite_db'];
        if (!$db) return 0;
        return (int)($db->errorCode() ?? 0);
    }

    function mysql_real_escape_string($str, $link = null) {
        // SQLite escaping: double single-quotes
        return str_replace("'", "''", $str);
    }

    function mysql_escape_string($str) {
        return mysql_real_escape_string($str);
    }

    function mysql_close($link = null) {
        $GLOBALS['__sqlite_db'] = null;
        return true;
    }

    function mysql_get_server_info($link = null) {
        return 'SQLite ' . SQLite3::version()['versionString'];
    }
}
