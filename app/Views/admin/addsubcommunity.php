<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>


<style>
    .li{
        padding: 5px;
        width: 120px;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0"><strong>Add SubCommunity</strong></p>
                    </div>
                </div>
                <div class="card-body">
                    <?php if(session()->has('errors')): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (session('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>

                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <form enctype="multipart/form-data" name="brand_form" action="<?= base_url(AD.'addsubcommunity') ?>" method="POST">
                        
                        <input type="hidden" name="community_id" value="<?= $_GET['community_id'] ?? "" ?>">
                        
                        <div class="row">
                            <!-- Sub Name Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_name" class="form-control-label">Sub Name</label>
                                    <input class="form-control" type="text" name="sub_name" placeholder="Sub Name">
                                </div>
                            </div>
                            <!-- Sub Description Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_description" class="form-control-label">Sub Description</label>
                                    <textarea class="form-control" name="sub_description" placeholder="Sub Description" rows="2"></textarea>
                                </div>
                            </div>
                            <!-- Image Upload Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">Upload Image</label>
                                    <input type="file" id="logo" class="form-control-file" name="image">
                                </div>
                                <div><img id="preview-image" class="li"></div>
                            </div>
                            <!-- Tags Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tags" class="form-control-label">Tags</label>
                                    <input class="form-control" type="text" name="tags" placeholder="Tags">
                                </div>
                            </div>
                            <!-- Created By Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="createdby" class="form-control-label">Created By</label>
                                    <input class="form-control" type="text" name="createdby" placeholder="Creator's Name">
                                </div>
                            </div>
                            <!-- Created Date Input -->
                           <div class="col-md-6">
    <div class="form-group">
        <label for="create_date" class="form-control-label">Created Date</label>
        <input class="form-control" type="date" name="create_date">
    </div>
</div>

                            <!-- Submit Button -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Save" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var imageInput = document.getElementById("logo");
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
