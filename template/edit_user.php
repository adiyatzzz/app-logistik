<?php
// get id from url
$user_id = $_GET["id"];
// select m_user with specific id
$users = $db->select("SELECT * FROM m_user WHERE id_user = '$user_id'");

foreach ($users as $data) {
    $id_user = $data["id_user"];
    $username = $data["username"];
    $password = $data["password"];
    $email = $data["email"];
}
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Item</h5>
                    <form action="proses.php?act=edit_user&id=<?= $user_id ?>" method="post">
                        <div class="form-group">
                            <label for="username">Name User</label>
                            <input typez="text" class="form-control" id="username" name="username" placeholder="Username..." value="<?= $username ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password...">
                            <input type="hidden" name="old_password" value="<?= $password ?>">
                        </div>
                        <div class="form-group">
                            <label for="mail">Email</label>
                            <input type="email" class="form-control" id="mail" name="email" placeholder="Email..." value="<?= $email ?>">
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