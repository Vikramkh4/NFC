<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<style>
    .ll {
        padding: 5px;
        width: 150px;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0"><strong>Community</strong></p>
                    </div>
                </div>
                <div class="card-body">

                    <?php if (session()->has('errors')) : ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (session('errors') as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <!-- Update Community Form -->
                    <form enctype="multipart/form-data" name="community_form" action="<?= base_url(AD . 'update_community/' . $community['id']) ?>" method="POST">
                        <!-- User of Brand Input -->
                        <div class="row me-auto">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">User Of Brand</label>
                                    <select name="brand_id" class="form-control">
                                        <option value="">Select Brand</option>
                                        <?php foreach ($brands as $brand) : ?>
                                            <option value="<?= $brand['id'] ?>" <?= set_select('brand_id', $brand['id'], ($community['brand_id'] == $brand['id'])) ?>>
                                                <?= $brand['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Name Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name" placeholder="Brand Name" value="<?= set_value('name', $community['name']) ?>">
                                </div>
                            </div>
                            <!-- Description Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Brand Description" rows="2"><?= set_value('description', $community['description']) ?></textarea>
                                </div>
                            </div>
                            <!-- Image Upload Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">Upload Image</label>
                                    <input type="file" id="logo" class="form-control-file" name="image">
                                </div>
                                <div><img id="preview-image" class="ll" src="<?= base_url(IMAGE_CUMMUNITY.'/'.$community['image']) ?>"></div>
                            </div>
                            <!-- Location Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location" class="form-control-label">Location</label>
                                    <input class="form-control" type="text" name="location" placeholder="Brand Location" value="<?= set_value('location', $community['location']) ?>">
                                </div>
                            </div>
                            <!-- Number of Members Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="numberofmembers" class="form-control-label">Number of Members</label>
                                    <input class="form-control" type="number" name="numberofmembers" placeholder="0" value="<?= set_value('numberofmembers', $community['numberofmembers']) ?>">
                                </div>
                            </div>
                            <!-- Is Public Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ispublic" class="form-control-label">Is Public</label>
                                    <select class="form-control" name="ispublic">
                                        <option value="1" <?= set_select('ispublic', '1', ($community['ispublic'] == 1)) ?>>Yes</option>
                                        <option value="0" <?= set_select('ispublic', '0', ($community['ispublic'] == 0)) ?>>No</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Created By Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="createdby" class="form-control-label">Created By</label>
                                    <input class="form-control" type="text" name="createdby" placeholder="Creator's Name" value="<?= set_value('createdby', $community['createdby']) ?>">
                                </div>
                            </div>
                            <!-- Created Date Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="createddate" class="form-control-label">Created Date</label>
                                    <input class="form-control" type="date" name="createddate" value="<?= set_value('createddate',$community['createddate'])?>">
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- End Update Community Form -->

                </div>

            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
    var imageInput = document.getElementById("logo");
    var previewImage = document.getElementById("preview-image");
    imageInput.addEventListener("change", function(event) {
        if (event.target.files.length == 0) {
            return;
        }
        var tempUrl = URL.createObjectURL(event.target.files[0]);
        previewImage.setAttribute("src", tempUrl);
    });
</script>
<?= $this->endSection() ?>
