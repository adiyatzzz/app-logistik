<?php
include('class/init.php');

if ($_GET["act"] == "tambah_item") {
    $name = $_POST["name"];
    $type = $_POST["type"];
    $dimensions = $_POST["dimensions"];
    $warehouse = $_POST["warehouse"];

    $data = [
        "name" => $name,
        "dimensions" => $dimensions,
        "id_typeitem" => $type
    ];
    
    // check if space available
    $capacity = $db->check_capacity($warehouse, $dimensions);
    // if over capacity
    if ($capacity !== true) {
        echo "<script>
                alert('Gagal! kapasitas melebihi batas.tersisa $capacity');
                window.location.href = './?p=item';
            </script>";
    }else{
        // insert to database
        if ($db->insert("m_item", $data) > 0) {
            $id_item = $db->select("SELECT MAX(id_item) AS id_item FROM m_item");
            $data = [
                "id_item" => $id_item[0]["id_item"],
                "id_warehouse" => $warehouse
            ];
            $db->insert("m_warehousestorage", $data);
            $_SESSION["flash"] = "Di Tambah";
            header("Location: ./?p=item");
        } else {
            echo "<script>
                    alert('Gagal!');
                    window.location.href = './?p=item';
                </script>";
        }
    }
} elseif ($_GET["act"] == "hapus_item") {
    $id_item = $_GET["id"];
    $data = [
        "id_item" => $id_item
    ];
    if ($db->delete("m_warehousestorage", $data) > 0 && $db->delete("m_item", $data) > 0) {
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
    $warehouse = $_POST["warehouse"];
    $data = [
        "name" => $name,
        "dimensions" => $dimensions,
        "id_typeitem" => $type
    ];

    $data_storage = [
        "id_item" => $id,
        "id_warehouse" => $warehouse
    ];

    // check if capacity still available
    $capacity = $db->check_capacity($warehouse, $dimensions);
    // if over capacity
    if ($capacity !== true) {
        echo "<script>
                alert('Gagal! kapasitas melebihi batas.tersisa $capacity');
                window.location.href = './?p=edit_item&id=$id';
            </script>";
    }else{
        if ($db->edit("m_item", $data, ["id_item" => $id]) > 0 || $db->edit("m_warehousestorage", $data_storage, ["id_item" => $id]) > 0) {
            $_SESSION["flash"] = "Di Edit";
            header("Location: ./?p=item");
        } else {
            echo "<script>
                    alert('Gagal!');
                    window.location.href = './?p=edit_item&id=$id';
                </script>";
        }
    }
}elseif($_GET["act"] == "tambah_warehouse"){
    $name = $_POST["name"];
    $type = $_POST["type"];
    $capacity = $_POST["capacity"];
    $address = $_POST["address"];

    $data = [
        "name" => $name,
        "id_typewarehouse" => $type,
        "capacity" => $capacity,
        "address" => $address
    ];

    if ($db->insert("m_warehouse", $data) > 0) {
        $_SESSION["flash"] = "Di Tambah";
        header("Location: ./?p=warehouse");
    } else {
        echo 'gagal';
    }
} elseif ($_GET["act"] == "hapus_warehouse") {
    $id_warehouse = $_GET["id"];
    $id_item = $db->select("SELECT id_item FROM m_warehousestorage WHERE id_warehouse = $id_warehouse");
    $data = [
        "id_warehouse" => $id_warehouse
    ];
    if ($db->delete("m_warehousestorage", ["id_warehouse" => $id_warehouse]) && $db->delete("m_warehouse", $data) > 0) {
        foreach ($id_item as $item) {
            $db->delete("m_item", ["id_item" => $item["id_item"]]);
        }
        $_SESSION["flash"] = "Di Hapus";
        header("Location: ./?p=warehouse");
    } else {
        echo 'gagal';
    }
} elseif ($_GET["act"] == "edit_warehouse") {
    $id = $_GET["id"];
    $name = $_POST["name"];
    $type = $_POST["type"];
    $capacity = $_POST["capacity"];
    $address = $_POST["address"];
    $data = [
        "name" => $name,
        "capacity" => $capacity,
        "address" => $address,   
        "id_typewarehouse" => $type
    ];

    if ($db->edit("m_warehouse", $data, ["id_warehouse" => $id]) > 0) {
        $_SESSION["flash"] = "Di Edit";
        header("Location: ./?p=warehouse");
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
} elseif ($_GET["act"] == "tambah_user") {
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
        $_SESSION["flash"] = "Di Tambah";
        echo "<script>
            window.location.href = './?p=user';
        </script>";
    } else {
        echo "gagal";
    }
} elseif ($_GET["act"] == "edit_user") {
    $id = $_GET["id"];
    $username = $_POST["username"];
    if (empty(trim($_POST["password"]))) {
        $password = $_POST["old_password"];
    } else {
        $password = $_POST["password"];
    }

    $email = $_POST["email"];
    $data = [
        "username" => $username,
        "password" => $password,
        "email" => $email,
        "update_at" => date("Y-m-d h:m:s")
    ];

    if ($db->edit("m_user", $data, ["id_user" => $id]) > 0) {
        $_SESSION["flash"] = "Di Edit";
        header("Location: ./?p=user");
    } else {
        echo 'gagal';
    }
} elseif ($_GET["act"] == "hapus_user") {
    $id_user = $_GET["id"];

    $data = [
        "deleted_at" => date("Y-m-d h:m:s")
    ];

    if ($db->edit("m_user", $data, ["id_user" => $id_user]) > 0) {
        $_SESSION["flash"] = "Di Hapus";
        header("Location: ./?p=user");
    } else {
        echo 'gagal';
    }
}
