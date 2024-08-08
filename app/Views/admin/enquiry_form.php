<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>
<style>
    .ll {
        padding: 5px;
        width: 150px;
    }
</style>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2><?= $page_name ?></h2>
                </div>
                <div class="panel-options">
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
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>
                <form name="enquiry_form" action="<?= base_url(AD. "enquirysubmit") ?>" method="POST">
                <input type="hidden" name="brand_id" value="<?=$_GET['brand_id'] ?? ""?>">
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 control-label">Email<span class='text-success text-sm'>*</span></label>
                        <div class="col-sm-6">
                            <input type="email" id="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 control-label">Name<span class='text-success text-sm'>*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="name" class="form-control" name="name" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="topic" class="col-sm-3 control-label">Topic<span class='text-success text-sm'>*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="topic" class="form-control" name="topic" placeholder="Topic" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="comment" class="col-sm-3 control-label">Comment<span class='text-success text-sm'>*</span></label>
                        <div class="col-sm-6">
                            <textarea id="comment" class="form-control" name="comment" rows="4" placeholder="Your comment" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" value="Submit" class="btn btn-success">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
