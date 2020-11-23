<?php
include('class/init.php');

if ($_GET["act"] == "tambah_item") {
    $name = $_POST["name"];
    $type = $_POST["type"];
    $dimensions = $_POST["dimensions"];

    $data = [
        "name" => $name,
        "dimensions" => $dimensions,
        "id_typeitem" => $type
    ];

    if ($db->insert("m_item", $data) > 0) {
        $_SESSION["flash"] = "Di Tambah";
        header("Location: ./?p=item");
    } else {
        echo 'gagal';
    }
} elseif ($_GET["act"] == "hapus_item") {
    $id_item = $_GET["id"];
    $data = [
        "id_item" => $id_item
    ];
    if ($db->delete("m_item", $data) > 0) {
        $_SESSION["flash"] = "Di Hapus";
        header("Location: ./?p=item");
    } else {
        echo 'gagal';
    }
} elseif ($_GET["act"] == "edit_item") {
    $id = $_GET["id"];
    $name = $_POST["name"];
    $type = $_POST["type"];
    $dimensions = $_POST["dimensions"];
    $data = [
        "name" => $name,
        "dimensions" => $dimensions,
        "id_typeitem" => $type
    ];

    if ($db->edit("m_item", $data, ["id_item" => $id]) > 0) {
        $_SESSION["flash"] = "Di Edit";
        header("Location: ./?p=item");
    } else {
        echo 'gagal';
    }
} elseif ($_GET["act"] == "register") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $email = $_POST["email"];

    // generate id user
    $id = $db->generateRandomString(8);
    for ($i = 0; $i < 3; $i++) {
        $id .= "-" . $db->generateRandomString(4);
    }
    $id .= $db->generateRandomString(12);

    $data = [
        "id_user" => $id,
        "username" => $username,
        "password" => $password,
        "email" => $email,
        "created_at" => date("Y-m-d h:m:s")
    ];

    if ($db->insert("m_user", $data) > 0) {
        echo "<script>
            alert('Akun telah di registrasi');
            window.location.href = 'login.php';
        </script>";
    } else {
        echo "gagal";
    }
} elseif ($_GET["act"] == "login") {
    $db->login($_POST["username"], $_POST["password"]);
} elseif ($_GET["act"] == "logout") {
    $db->logout();
    header("Location: login.php");
}
