<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>
<style>
.avatar {
    width: 100px; /* Adjust the width as needed */
    height: 100px; /* Adjust the height as needed */
    border-radius: 50%; /* Makes the image circular */
    object-fit: cover; /* Ensures the image covers the container */
    display: block;
    margin: 0 auto; /* Centers the image horizontally */
}
</style>

<div class="row">
    <div class="col-md-8">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h2>Add User</h2>
                </div>

                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i
                            class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div>
            </div>

            <div class="panel-body">
            <?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $field => $error): ?>
            <p><?= $error ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif;?>
<?= form_open('', ['enctype' => 'multipart/form-data']) ?>


<div class="form-group row">
                    <label class="col-sm-3 control-label">Profile</label>
                    <div class="col-sm-6 text-center">
                    <div class="mt-3">
                            <img id="profile-image-preview" src="<?= isset($emp['image']) ? base_url('uploads/' . $emp['image']) : '' ?>" class="avatar" alt="Profile Image">
                        </div>
                        <div class="input-group">
                            <input type="file" class="form-control" name="image" onchange="previewImage(event)">
                        </div>
                        
                    </div>
                </div>
<div class="form-group row">
    <label class="col-sm-3 control-label">Name</label>
    <div class="col-sm-6">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Username" name="name" value="<?= isset($emp['name']) ? $emp['name'] : ''; ?>">
            <span class="input-group-addon"><i class="entypo-user"></i></span>
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 control-label">Email</label>
    <div class="col-sm-6">
        <div class="input-group">
            <input class="form-control" type="email" name="email" placeholder="Email" value="<?= isset($emp['email']) ? $emp['email'] : ''; ?>">
            <span class="input-group-addon"><i class="entypo-mail"></i></span>
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 control-label">Phone No</label>
    <div class="col-sm-6">
        <div class="input-group">
            <input class="form-control" type="text" name="phone_no" placeholder="Phone No" value="<?= isset($emp['phone_no']) ? $emp['phone_no'] : ''; ?>">
            <span class="input-group-addon"><i class="entypo-phone"></i></span>
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 control-label">Password</label>
    <div class="col-sm-6">
        <div class="input-group">
            <input class="form-control" type="password" name="password" placeholder="Password" value="<?= isset($emp['password']) ? $emp['password'] : ''; ?>">
            <span class="input-group-addon"><i class="entypo-key"></i></span>
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="role" class="col-sm-3 control-label">Role</label>
    <div class="col-sm-6">
        <select name="role" id="role" class="form-control">
            <option value="vendor" <?= isset($emp['role']) && $emp['role'] == 'vendor' ? 'selected' : ''; ?>>Vendor</option>
            <option value="user" <?= isset($emp['role']) && $emp['role'] == 'user' ? 'selected' : ''; ?>>User</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" value="Save" class="btn btn-success">SUBMIT</button>
    </div>
</div>

<?= form_close() ?>


               

            </div>

        </div>

    </div>
</div>
<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('profile-image-preview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<?= $this->endSection() ?>