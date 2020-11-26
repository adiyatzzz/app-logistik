<?php
// get id from url
$warehouse_id = $_GET["id"];
// select m_item with specific id
$warehouse = $db->select("SELECT * FROM m_warehouse WHERE id_warehouse = $warehouse_id");
// select all row m_typeitem
$warehouse_type = $db->select("SELECT * FROM m_typewarehouse");

foreach ($warehouse as $data) {
    $id_warehouse = $data["id_warehouse"];
    $name_warehouse = $data["name"];
    $capacity = $data["capacity"];
    $address  = $data["address"];
    $id_typewarehouse = $data["id_typewarehouse"];
}
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Warehouse</h5>
                    <form action="proses.php?act=edit_warehouse&id=<?= $id_warehouse ?>" method="post">
                        <div class="form-group">
                            <label for="name">Name Warehouse</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name Item..." value="<?= $name_warehouse ?>">
                        </div>
                        <div class="form-group">
                            <label for="capacity">Capacity</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Capacity..." value="<?= $capacity ?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address..." value="<?= $address ?>">
                        </div>
                        <div class="form-group">
                            <label for="type">Item Type</label>
                            <select class="form-control" id="type" name="type">
                                <option>Select Type</option>
                                <?php foreach ($warehouse_type as $type) : ?>
                                    <option value="<?= $type["id_typewarehouse"] ?>" <?= ($id_typewarehouse == $type["id_typewarehouse"]) ? "selected" : "" ?>><?= $type["nametype"] ?></option>
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