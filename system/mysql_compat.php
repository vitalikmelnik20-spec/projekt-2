<?php
// Compatibility shim: maps old mysql_* functions to mysqli_* for PHP 7+
if (!function_exists('mysql_connect')) {

    $GLOBALS['__mysql_link'] = null;

    function mysql_connect($host, $user, $password, $new_link = false, $client_flags = 0) {
        $port = isset($GLOBALS['__mysql_port']) ? (int)$GLOBALS['__mysql_port'] : 3306;
        // Support "host:port" syntax
        if (strpos($host, ':') !== false) {
            list($host, $port) = explode(':', $host, 2);
            $port = (int)$port;
        }
        $link = @mysqli_connect($host, $user, $password, '', $port);
        if ($link) {
            $GLOBALS['__mysql_link'] = $link;
        }
        return $link ?: false;
    }

    function mysql_select_db($db, $link = null) {
        $link = $link ?: $GLOBALS['__mysql_link'];
        return mysqli_select_db($link, $db);
    }

    function mysql_query($query, $link = null) {
        $link = $link ?: $GLOBALS['__mysql_link'];
        return mysqli_query($link, $query);
    }

    function mysql_fetch_array($result, $result_type = MYSQLI_BOTH) {
        if (!$result) return false;
        return mysqli_fetch_array($result, $result_type);
    }

    function mysql_fetch_assoc($result) {
        if (!$result) return false;
        return mysqli_fetch_assoc($result);
    }

    function mysql_fetch_row($result) {
        if (!$result) return false;
        return mysqli_fetch_row($result);
    }

    function mysql_fetch_object($result) {
        if (!$result) return false;
        return mysqli_fetch_object($result);
    }

    function mysql_num_rows($result) {
        if (!$result) return 0;
        return mysqli_num_rows($result);
    }

    function mysql_affected_rows($link = null) {
        $link = $link ?: $GLOBALS['__mysql_link'];
        return mysqli_affected_rows($link);
    }

    function mysql_insert_id($link = null) {
        $link = $link ?: $GLOBALS['__mysql_link'];
        return mysqli_insert_id($link);
    }

    function mysql_error($link = null) {
        $link = $link ?: $GLOBALS['__mysql_link'];
        if (!$link) return '';
        return mysqli_error($link);
    }

    function mysql_errno($link = null) {
        $link = $link ?: $GLOBALS['__mysql_link'];
        if (!$link) return 0;
        return mysqli_errno($link);
    }

    function mysql_real_escape_string($str, $link = null) {
        $link = $link ?: $GLOBALS['__mysql_link'];
        return mysqli_real_escape_string($link, $str);
    }

    function mysql_escape_string($str) {
        return mysql_real_escape_string($str);
    }

    function mysql_result($result, $row, $field = 0) {
        if (!$result) return false;
        if ($row > 0) {
            mysqli_data_seek($result, $row);
        }
        $r = mysqli_fetch_array($result);
        if (!$r) return false;
        if (is_numeric($field)) {
            return $r[(int)$field];
        }
        if (strpos($field, '.') !== false) {
            list(, $col) = explode('.', $field, 2);
            return $r[$col] ?? false;
        }
        return $r[$field] ?? false;
    }

    function mysql_data_seek($result, $offset) {
        return mysqli_data_seek($result, $offset);
    }

    function mysql_free_result($result) {
        return mysqli_free_result($result);
    }

    function mysql_close($link = null) {
        $link = $link ?: $GLOBALS['__mysql_link'];
        return mysqli_close($link);
    }

    function mysql_num_fields($result) {
        return mysqli_num_fields($result);
    }

    function mysql_field_name($result, $field_offset) {
        $props = mysqli_fetch_field_direct($result, $field_offset);
        return $props ? $props->name : false;
    }

    function mysql_get_server_info($link = null) {
        $link = $link ?: $GLOBALS['__mysql_link'];
        return mysqli_get_server_info($link);
    }
}
