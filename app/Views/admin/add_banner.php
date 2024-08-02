<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>

<hr style="margin-top:0px;" />

<h3 style="margin:20px 0px;" class="hidden-print">
    <i class="entypo-right-circled"></i>
    Add Banner
</h3>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    Add Banner Form
                </div>
            </div>
            <div class="panel-body">
                <form action="<?= base_url('admin/storeban') ?>" method="post" enctype="multipart/form-data" role="form" class="form-horizontal form-groups-bordered">
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-7">
                            <textarea name="description" class="form-control" rows="8" cols="80" placeholder="Description" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Banner Image</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <input type="file" id="icon" class="form-control-file" name="icon">
                            </div>
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">  
                                <img id="preview-icon" class="ll" src="#" alt="Preview Image" style="display: none;">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-offset-3 col-sm-5" style="padding-top: 10px;">
                        <button type="submit" class="btn btn-info">Add Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var imageInput = document.getElementById("icon");
    var previewImage = document.getElementById("preview-icon");
    imageInput.addEventListener("change", function(event) {
        if (event.target.files.length == 0) {
            previewImage.style.display = 'none';
            return;
        }
        var tempUrl = URL.createObjectURL(event.target.files[0]);
        previewImage.setAttribute("src", tempUrl);
        previewImage.style.display = 'block';
    });
</script>

<?= $this->endSection() ?>
