<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>
<style>
    .ll {
        padding: 5px;
        width: 150px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    <h1><?= $page_name ?></h1>
                </div>
            </div>
            <div class="panel-body">
                <form action="<?= base_url('admin/store_market') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="details" class="col-sm-3 control-label">Details</label>
                        <textarea class="form-control" name="details" id="details" placeholder="Enter Details" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="local_area" class="col-sm-3 control-label">Local area</label>
                        <input type="text" class="form-control" name="local_area" id="local_area" placeholder="Enter local area" required>
                    </div>
                    <div class="form-group">
                        <label for="icon" class="col-sm-3 control-label">Icon</label>
                        <input type="file" id="icon" name="icon" class="form-control-file" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-blue btn-icon">Submit
                            <i class="entypo-check"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var imageInput = document.getElementById("blog_image");
    var previewImage = document.getElementById("preview-image");
    imageInput.addEventListener("change", function(event) {
        if(event.target.files.length == 0){
            return;
        }
        var tempUrl = URL.createObjectURL(event.target.files[0]);
        previewImage.setAttribute("src", tempUrl);
    });
</script>
<?= $this->endSection() ?>