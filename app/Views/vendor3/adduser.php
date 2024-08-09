<?= $this->extend('vendor3/layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><i class="entypo-right-circled"></i>Add User</h3>
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
    <!--<p class="text-uppercase text-sm">User Information</p>-->
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


    <?= form_open() ?>
    <div class="row">
    <div class="col-md-6">
    <div class="form-group">
        <label for="name" class="form-control-label">Name</label>
        <input class="form-control" type="text" name="name" value="<?= isset($emp['name']) ? $emp['name'] : ''; ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="email" class="form-control-label">Email</label>
        <input class="form-control" type="email" name="email" value="<?= isset($emp['email']) ? $emp['email'] : ''; ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="phone_no" class="form-control-label">Phone No</label>
        <input class="form-control" type="text" name="phone_no" value="<?= isset($emp['phone_no']) ? $emp['phone_no'] : ''; ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="password" class="form-control-label">Password</label>
        <input class="form-control" type="password" name="password" value="<?= isset($emp['password']) ? $emp['password'] : ''; ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="role" class="form-control-label">Role</label>
        <select name="role" id="role" class="form-control">
            <option value="vendor" <?= isset($emp['role']) && $emp['role'] == 'vendor' ? 'selected' : ''; ?>>vendor</option>
            <option selected value="user" <?= isset($emp['role']) && $emp['role'] == 'user' ? 'selected' : ''; ?>>User</option>
            
        </select>
    </div>
</div>

</div>


      
        <div class="col-md-12">
            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-success ">
            </div>
        </div>
    </div>
    <?= form_close() ?>
</div>

          </div>
        </div>
    
      </div>

<?= $this->endSection() ?>