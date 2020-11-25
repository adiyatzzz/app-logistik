<?php

$users = $db->select("SELECT * FROM m_user WHERE deleted_at IS NULL OR deleted_at = ''");

?>
<div class="container mb-3">
    <div class="row mt-3">
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addUser">
            <i class="fas fa-user-plus"></i><span class="ml-1">Tambah User</span>
        </a>
    </div>


    <div class="row mt-3">
        <div class="col p-0">
            <?php if (isset($_SESSION["flash"])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    User telah <strong><?= $_SESSION["flash"] ?></strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
                unset($_SESSION["flash"]);
            endif;
            ?>
            <table id="table" class="table table-hover table-striped ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user["id_user"] ?></td>
                            <td><?= $user["username"] ?></td>
                            <td><?= $user["password"] ?></td>
                            <td><?= $user["email"] ?></td>
                            <td><?= $user["created_at"] ?></td>
                            <td>
                                <a href="proses.php?act=hapus_user&id=<?= $user["id_user"] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')"><i class="fas fa-trash"></i></i></a>
                                <a href="?p=edit_user&id=<?= $user["id_user"] ?>" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserLabel">Tambah Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="proses.php?act=tambah_user" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Name User</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username...">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password...">
                    </div>
                    <div class="form-group">
                        <label for="mail">Email</label>
                        <input type="email" class="form-control" id="mail" name="email" placeholder="Email...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>