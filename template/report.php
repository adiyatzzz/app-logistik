<?php
$sql = "SELECT `m_warehouse`.`name`, COUNT(`m_warehousestorage`.`id_warehouse`) AS `jumlah`
FROM m_warehousestorage
JOIN `m_warehouse` ON `m_warehousestorage`.`id_warehouse` = `m_warehouse`.`id_warehouse`
GROUP BY `m_warehousestorage`.`id_warehouse`";

$datas = $db->select($sql)

?>
<div class="container mb-3">
    <div class="row mt-3">
        <div class="col p-0">
            <table id="table" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Name Warehouse</th>
                        <th>Jumlah item at warehouse</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data) : ?>
                        <tr>
                            <td><?= $data["name"] ?></td>
                            <td><?= $data["jumlah"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>