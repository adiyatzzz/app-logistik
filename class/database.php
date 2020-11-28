<?php
session_start();

class database
{
    private $db_host = "localhost";
    private $db_username = "root";
    private $db_password = "";
    private $db_name = "db_logistik";

    public function __construct()
    {
        $this->conn = mysqli_connect($this->db_host, $this->db_username, $this->db_password, $this->db_name);
    }

    // function untuk select
    public function select($query)
    {
        $result = mysqli_query($this->conn, $query);
        $rows = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    /*
    EXAMPLE

    $name = $_POST["name"];
    $type = $_POST["type"];
    $dimensions = $_POST["dimensions"];

    Left = column name
    right = value

    $data = [
        "name" => $name,
        "dimensions" => $dimensions,
        "id_typeitem" => $type
    ];

    - call the function
    - first parameter is table name
    - second parameter is an array

    if ($db->insert("m_item", $data) > 0) {
        $_SESSION["flash"] = "Di Tambah";
        header("Location: ./?p=item");
    } else {
        echo 'gagal';
    }
    */
    public function insert($table, $data)
    {
        // set array key and vale into string
        $column = implode(', ', array_keys($data));
        $value = implode('\', \'', array_values($data));
        $sql = "INSERT INTO $table (" . $column . ") VALUES ('" . $value . "')";

        mysqli_query($this->conn, $sql);
        return mysqli_affected_rows($this->conn);
    }

    /*
    EXAMPLE
    - get the id
    $id_item = $_GET["id"];

    - set array, the row you want to delete
    left : column name
    right : value
    $data = [
        "id_item" => $id_item
    ];

    - first parameter is table name
    - second parameter is an array
    if ($db->delete("m_item", $data) > 0) {
        $_SESSION["flash"] = "Di Hapus";
        header("Location: ./?p=item");
    } else {
        echo 'gagal';
    }
    */
    public function delete($table, $data)
    {
        // get key and value
        $key = implode('', array_keys($data));
        $value = implode('', array_values($data));

        $sql = "DELETE FROM $table WHERE $key = '$value'";
        mysqli_query($this->conn, $sql);
        return mysqli_affected_rows($this->conn);
    }

    /*
    EXAMPLE

    $id = $_GET["id"];
    $name = $_POST["name"];
    $type = $_POST["type"];
    $dimensions = $_POST["dimensions"];

    - set an array the key must same as column name
    $data = [
        "name" => $name,
        "dimensions" => $dimensions,
        "id_typeitem" => $type
    ];

    - call the function 
    parameter
    1. table name
    2. data that you want to update
    3. the id of the column
    
    if ($db->edit("m_item", $data, ["id_item" => $id]) > 0) {
        $_SESSION["flash"] = "Di Edit";
        header("Location: ./?p=item");
    } else {
        echo 'gagal';
    }
    */
    public function edit($table, $data, $where)
    {
        $sql = "UPDATE $table SET ";
        foreach ($data as $key => $value) {
            $sql .= "$key = '$value',";
        }
        $sql = rtrim($sql, ',');
        $sql .= " WHERE " . implode('', array_keys($where)) . " = '" . implode('', array_values($where)) . "'";
        mysqli_query($this->conn, $sql);
        return mysqli_affected_rows($this->conn);
    }

    public function check_capacity($id_warehouse, $dimensions){
        // get max capacity of warehouse
        $max_capacity = $this->select("SELECT capacity FROM m_warehouse WHERE id_warehouse = $id_warehouse");
        $max_capacity = $max_capacity[0]["capacity"];
        // get current capacity
        $all_item_dimension = $this->select("SELECT `m_item`.`dimensions`
                                        FROM `m_warehousestorage` JOIN `m_item` 
                                        ON `m_warehousestorage`.`id_item` = `m_item`.`id_item`
                                        WHERE id_warehouse = $id_warehouse");
        // count total dimension
        $total_capacity = 0;
        foreach ($all_item_dimension as $data) {
            $total_capacity += $data["dimensions"];
        }
        $total_capacity += $dimensions;

        // if total capacity more than max_capacity return false
        if ($total_capacity > $max_capacity) {
            return $max_capacity - ($total_capacity - $dimensions);
        }else{
            return true;
        }
    }   

    function login($username, $password)
    {
        $cek_user = $this->select("SELECT * FROM m_user WHERE username = '$username'");
        if (count($cek_user) > 0) {
            $cek_user = $cek_user[0];
            if (password_verify($password, $cek_user["password"])) {
                $_SESSION["login"] = true;
                echo "<script>
                    window.location.href = './';
                </script>";
            } else {
                echo "<script>
                alert('Password Salah');
                window.location.href = 'login.php';
            </script>";
            }
        } else {
            echo "<script>
                alert('Akun belum di registrasi');
                window.location.href = 'login.php';
            </script>";
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }

    public function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyz', ceil($length / strlen($x)))), 1, $length);
    }
}
