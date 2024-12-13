<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>

<!-- Page content -->
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <div class="panel-title">
                   <h2> <?= $page_name ?></h2>
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
