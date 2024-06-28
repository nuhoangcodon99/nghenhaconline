<?php
include_once(__DIR__ . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
define('_ROOT_', $_SERVER['DOCUMENT_ROOT']);
class ACAIVIPPRO
{
    private $ketnoi;

    function connect()
    {
        if (!$this->ketnoi) {
            try {
                $this->ketnoi = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);
                if (!$this->ketnoi) {
                    throw new Exception('Kết nối thất bại');
                }
                mysqli_query($this->ketnoi, "set names 'utf8'");
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }

    function dis_connect()
    {
        if ($this->ketnoi) {
            mysqli_close($this->ketnoi);
        }
    }
    public function get_id_insert()
    {
        $this->connect();
        return mysqli_insert_id($this->ketnoi);
    }
    function query($sql)
    {
        $this->connect();
        $row = $this->ketnoi->query($sql);
        return $row;
    }
    function cong($table, $data, $sotien, $where)
    {
        $this->connect();
        $row = $this->ketnoi->query("UPDATE `$table` SET `$data` = `$data` + '$sotien' WHERE $where ");
        return $row;
    }
    function tru($table, $data, $sotien, $where)
    {
        $this->connect();
        $row = $this->ketnoi->query("UPDATE `$table` SET `$data` = `$data` - '$sotien' WHERE $where ");
        return $row;
    }
    function insert($table, $data)
    {
        $this->connect();
        $field_list = '';
        $value_list = '';

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                // Nếu giá trị là mảng, chúng ta sẽ chuyển mảng thành một chuỗi JSON trước khi escape
                $value = json_encode($value);
            }
            $field_list .= ",$key";
            $value_list .= ",'" . mysqli_real_escape_string($this->ketnoi, $value) . "'";
        }

        $sql = 'INSERT INTO ' . $table . '(' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';

        return mysqli_query($this->ketnoi, $sql);
    }


    function update($table, $data, $where)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                // Nếu giá trị là mảng, chúng ta sẽ chuyển mảng thành một chuỗi JSON trước khi escape
                $value = json_encode($value);
            }
            $sql .= "$key = '" . mysqli_real_escape_string($this->ketnoi, $value) . "',";
        }
        $sql = 'UPDATE ' . $table . ' SET ' . trim($sql, ',') . ' WHERE ' . $where;
        return mysqli_query($this->ketnoi, $sql);
    }
    function update_value($table, $data, $where, $value1)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value) {
            $sql .= "$key = '" . mysqli_real_escape_string($this->ketnoi, $value) . "',";
        }
        $sql = 'UPDATE ' . $table . ' SET ' . trim($sql, ',') . ' WHERE ' . $where . ' LIMIT ' . $value1;
        return mysqli_query($this->ketnoi, $sql);
    }
    function remove($table, $where)
    {
        $this->connect();
        $sql = "DELETE FROM $table WHERE $where";
        return mysqli_query($this->ketnoi, $sql);
    }
    function get_list($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $return = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $return[] = $row;
        }
        mysqli_free_result($result);
        return $return;
    }
    function get_row($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($row) {
            return $row;
        }
        return false;
    }

    function num_rows($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result) {
            die('Câu truy vấn bị sai');
        }
        $row = mysqli_num_rows($result);
        mysqli_free_result($result);
        if ($row) {
            return $row;
        }
        return false;
    }
}

if (isset($_SESSION['username'])) {
    $ACAIVIPPRO = new ACAIVIPPRO;
    $getUser = $ACAIVIPPRO->get_row(" SELECT * FROM `users` WHERE username = '" . $_SESSION['username'] . "'");
    $my_username = True;
    $my_level = $getUser['admin'];
} else {
    $my_level = NULL;
    $my_money = 0;
}


function CheckLogin()
{
    global $my_username;
    if ($my_username != True) {
        return die('<script type="text/javascript">setTimeout(function(){ location.href = "/" }, 0);</script>');
    }
}
function CheckAdmin()
{
    global $my_level;
    if ($my_level != '1') {
        return die('<script type="text/javascript">setTimeout(function(){ location.href = "/" }, 0);</script>');
    }
}
