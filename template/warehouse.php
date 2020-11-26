<?php
$warehouses = $db->select("SELECT `m_warehouse`.* , `m_typewarehouse`.`nametype` AS tipe_warehouse
                    FROM `m_warehouse` JOIN `m_typewarehouse`
                    ON `m_warehouse`.`id_typewarehouse` = `m_typewarehouse`.`id_typewarehouse`
                    ");
$warehouse_type = $db->select("SELECT * FROM m_typewarehouse");
?>
<div class="container mb-3">
    <div class="row mt-3">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addWarehouse">
            <i class="fas fa-sitemap"></i><span class="ml-1">Tambah Warehouse</span>
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
                        <th>Name Warehouse</th>
                        <th>Name Category</th>
                        <th>Capacity</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($warehouses as $warehouse) : ?>
                        <tr>
                            <td><?= $warehouse["id_warehouse"] ?></td>
                            <td><?= $warehouse["name"] ?></td>
                            <td><?= $warehouse["tipe_warehouse"] ?></td>
                            <td><?= $warehouse["capacity"] ?></td>
                            <td><?= $warehouse["address"] ?></td>
                            <td>
                                <a href="proses.php?act=hapus_warehouse&id=<?= $warehouse["id_warehouse"] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')"><i class="fas fa-trash"></i></i></a>
                                <a href="?p=edit_warehouse&id=<?= $warehouse["id_warehouse"] ?>" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addWarehouse" tabindex="-1" aria-labelledby="addWarehouseLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWarehouseLabel">Tambah warehouse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="proses.php?act=tambah_warehouse" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name Warehouse</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name Warehouse...">
                    </div>
                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Capacity">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address...">
                    </div>
                    <div class="form-group">
                        <label for="type">Warehouse Type</label>
                        <select class="form-control" id="type" name="type">
                            <option>Select Type</option>
                            <?php foreach ($warehouse_type as $type) : ?>
                                <option value="<?= $type["id_typewarehouse"] ?>"><?= $type["nametype"] ?></option>
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