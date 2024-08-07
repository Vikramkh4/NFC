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
                <form action="<?= base_url('admin/save_blog') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter Description" required></textarea>
                    </div>
                    <div>
                        <img id="preview-image" class="ll">
                    </div>
                    <div class="form-group">
                        <label for="blog_image" class="form-control-label">Blog image </label>
                        <input type="file" id="blog_image" name="blog_image" class="form-control-file">
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
