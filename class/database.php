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

    public function insert($table, $data)
    {
        // set array key and vale into string
        $column = implode(', ', array_keys($data));
        $value = implode('\', \'', array_values($data));
        $sql = "INSERT INTO $table (" . $column . ") VALUES ('" . $value . "')";

        mysqli_query($this->conn, $sql);
        return mysqli_affected_rows($this->conn);
    }

    public function delete($table, $data)
    {
        // get key and value
        $key = implode('', array_keys($data));
        $value = implode('', array_values($data));

        $sql = "DELETE FROM $table WHERE $key = '$value'";
        mysqli_query($this->conn, $sql);
        return mysqli_affected_rows($this->conn);
    }

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

    function login($username, $password)
    {
        $cek_user = $this->select("SELECT * FROM m_user WHERE username = '$username'");
        if (count($cek_user) > 0) {
            $cek_user = $cek_user[0];
            if (password_verify($password, $cek_user["password"])) {
                $_SESSION["login"] = true;
                echo "<script>
                    window.location.href = 'index.php';
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
    }

    public function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyz', ceil($length / strlen($x)))), 1, $length);
    }
}
