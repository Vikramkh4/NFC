<?= $this->extend('vendor3/layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .ll{
       
  padding: 5px;
  width: 150px;
    }
</style>
<div class="row">
    <div class="col-md-8">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h2>Add Product</h2>
                </div>

                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
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

                <form enctype="multipart/form-data" name="brand_form" action="<?=base_url(VD.'product2')?>" method="POST">
                <input type="hidden" name="brand_id" value="<?=$_GET['brand_id'] ?? ""?>">

                <div class="form-group row">
                    <label for="image" class="col-sm-3 control-label">Image<span class='text-success text-sm'>*</span></label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="file" id="image" class="form-control-file" name="image">
                            <span class="input-group-addon"><i class="entypo-picture"></i></span>
                        </div>
                        <div><img id="preview-image" class="ll"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="product" class="col-sm-3 control-label">Product</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input class="form-control" type="text" name="product" placeholder="Product name">
                            <span class="input-group-addon"><i class="entypo-suitcase"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="details" class="col-sm-3 control-label">Details</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input class="form-control" type="text" name="details" placeholder="Details">
                            <span class="input-group-addon"><i class="entypo-doc-text"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price" class="col-sm-3 control-label">Price</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input class="form-control" type="text" name="price" placeholder="₹2">
                            <span class="input-group-addon">$ $</span>
                        </div>
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

<script>
    var imageInput = document.getElementById("image");
    var previewImage = document.getElementById("preview-image");
    imageInput.addEventListener("change", function(event) {
        if(event.target.files.length == 0){
            return;
        }
        var tempUrl = URL.createObjectURL(event.target.files[0]);
        previewImage.setAttribute("src", tempUrl);
        previewImage.onload = function() {
            URL.revokeObjectURL(previewImage.src); // Free memory
        }
    });
</script>

<?= $this->endSection() ?>