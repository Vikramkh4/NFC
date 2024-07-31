<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>

<!-- Page content -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <div class="panel-title">
                   <h1> <?= $page_name ?></h1>
                </div>
            </div>
            <div class="panel-body">
           
                <form action="<?=base_url("admin/storeamt")?>"  method="post">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Amenity Title</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Provide Amenity Name">
                </div>
                <div class="form-group">
                    <label for="icon" class="col-sm-3 control-label">Icon picker</label>
                        <input type="text" class="form-control" name="icon" id="icon" placeholder="icon">
                </div>
                
                <div class="form-group">
                        <button type="submit" class="btn btn-blue btn-icon">Submit
                        <i class="entypo-check"></i>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>