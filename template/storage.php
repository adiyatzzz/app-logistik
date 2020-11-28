<?php
$sql = "SELECT `m_item`.*,`m_item`.`name` AS `item_name`, `m_warehouse`.*, `m_warehouse`.`name` AS `warehouse_name`, `m_typewarehouse`.`nametype` AS `type_warehouse`
FROM `m_warehousestorage`
INNER JOIN `m_item`
ON `m_warehousestorage`.`id_item`= `m_item`.`id_item`
INNER JOIN `m_warehouse`
ON `m_warehousestorage`.`id_warehouse` = `m_warehouse`.`id_warehouse`
INNER JOIN `m_typewarehouse`
ON `m_warehouse`.`id_typewarehouse` = `m_typewarehouse`.`id_typewarehouse`";

$datas = $db->select($sql)

?>
<div class="container mb-3">
    <div class="row mt-3">
        <div class="col p-0">
            <table id="table" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID Warehouse</th>
                        <th>Name Warehouse</th>
                        <th>Capacity</th>
                        <th>Address</th>
                        <th>Type Warehouse</th>
                        <th>Nama Item</th>
                        <th>Dimension</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data) : ?>
                        <tr>
                            <td><?= $data["id_warehouse"] ?></td>
                            <td><?= $data["warehouse_name"] ?></td>
                            <td><?= $data["capacity"] ?></td>
                            <td><?= $data["address"] ?></td>
                            <td><?= $data["type_warehouse"] ?></td>
                            <td><?= $data["item_name"] ?></td>
                            <td><?= $data["dimensions"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>