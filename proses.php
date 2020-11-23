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
}
