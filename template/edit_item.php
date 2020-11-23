<?php
// get id from url
$item_id = $_GET["id"];
// select m_item with specific id
$item = $db->select("SELECT * FROM m_item WHERE id_item = $item_id");
// select all row m_typeitem
$item_type = $db->select("SELECT * FROM m_typeitem");

foreach ($item as $data) {
    $id_item = $data["id_item"];
    $name_item = $data["name"];
    $dimensions = $data["dimensions"];
    $id_typeitem = $data["id_typeitem"];
}
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Item</h5>
                    <form action="proses.php?act=edit_item&id=<?= $id_item ?>" method="post">
                        <div class="form-group">
                            <label for="name">Name Item</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name Item..." value="<?= $name_item ?>">
                        </div>
                        <div class="form-group">
                            <label for="type">Item Type</label>
                            <select class="form-control" id="type" name="type">
                                <option>Select Type</option>
                                <?php foreach ($item_type as $type) : ?>
                                    <option value="<?= $type["id_typeitem"] ?>" <?= ($id_typeitem == $type["id_typeitem"]) ? "selected" : "" ?>><?= $type["name_item"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dimensions">Dimensions</label>
                            <input type="number" class="form-control" id="dimensions" name="dimensions" placeholder="Dimension" value="<?= $dimensions ?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>