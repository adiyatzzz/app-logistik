<?php
$items = $db->select("SELECT `m_item`.* , `m_typeitem`.`name_item` AS tipe_item
                    FROM `m_item` JOIN `m_typeitem`
                    ON `m_item`.`id_typeitem` = `m_typeitem`.`id_typeitem`
                    ");
$item_type = $db->select("SELECT * FROM m_typeitem");
$warehouse = $db->select("SELECT * FROM m_warehouse");
?>
<div class="container mb-3">
    <div class="row mt-3">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addItem">
            <i class="fas fa-sitemap"></i><span class="ml-1">Tambah Item</span>
        </a>
    </div>


    <div class="row mt-3">
        <div class="col p-0">
            <?php if (isset($_SESSION["flash"])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Item telah <strong><?= $_SESSION["flash"] ?></strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
                unset($_SESSION["flash"]);
            endif;
            ?>
            <table id="table" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name Item</th>
                        <th>Name Category</th>
                        <th>Dimension</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $item["id_item"] ?></td>
                            <td><?= $item["name"] ?></td>
                            <td><?= $item["tipe_item"] ?></td>
                            <td><?= $item["dimensions"] ?></td>
                            <td>
                                <a href="proses.php?act=hapus_item&id=<?= $item["id_item"] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')"><i class="fas fa-trash"></i></i></a>
                                <a href="?p=edit_item&id=<?= $item["id_item"] ?>" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addItem" tabindex="-1" aria-labelledby="addItemLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemLabel">Tambah Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="proses.php?act=tambah_item" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name Item</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name Item...">
                    </div>
                    <div class="form-group">
                        <label for="type">Item Type</label>
                        <select class="form-control" id="type" name="type">
                            <option>Select Type</option>
                            <?php foreach ($item_type as $type) : ?>
                                <option value="<?= $type["id_typeitem"] ?>"><?= $type["name_item"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dimensions">Dimensions</label>
                        <input type="number" class="form-control" id="dimensions" name="dimensions" placeholder="Dimension">
                    </div>
                    <div class="form-group">
                        <label for="warehouse">Warehouse</label>
                        <select class="form-control" id="warehouse" name="warehouse">
                            <option>Select Warehouse</option>
                            <?php foreach ($warehouse as $w) : ?>
                                <option value="<?= $w["id_warehouse"] ?>"><?= $w["name"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>