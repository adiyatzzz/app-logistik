<?php
// get id from url
$item_id = $_GET["id"];
// select m_item with specific id
$item = $db->select("SELECT `m_item`.*,`m_item`.`name` AS `item_name`, `m_warehouse`.* , `m_warehouse`.`name` AS `warehouse_name` FROM m_warehousestorage
                    INNER JOIN `m_warehouse` ON `m_warehouse`.`id_warehouse` = `m_warehousestorage`.`id_warehouse`
                    INNER JOIN `m_item` ON `m_item`.`id_item` = `m_warehousestorage`.`id_item`
                    WHERE `m_item`.`id_item` = $item_id");
// select all row m_typeitem
$item_type = $db->select("SELECT * FROM m_typeitem");
$warehouse = $db->select("SELECT * FROM m_warehouse");

foreach ($item as $data) {
    $id_item = $data["id_item"];
    $name_item = $data["item_name"];
    $dimensions = $data["dimensions"];
    $id_typeitem = $data["id_typeitem"];
    $id_warehouse = $data["id_warehouse"];
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
                        <label for="warehouse">Warehouse</label>
                        <select class="form-control" id="warehouse" name="warehouse">
                            <option>Select Warehouse</option>
                            <?php foreach ($warehouse as $w) : ?>
                                <option value="<?= $w["id_warehouse"] ?>"  <?= ($w["id_warehouse"] == $id_warehouse) ? "selected" : "" ?>><?= $w["name"] ?></option>
                            <?php endforeach; ?>
                        </select>
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