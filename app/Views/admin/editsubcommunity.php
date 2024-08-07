<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>

<style>
     .ll{
       
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
                <p class="mb-0"><strong>  Edit Service  </strong></p>
               
              </div>
            </div>
            <div class="card-body">

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
<form enctype="multipart/form-data" name="brand_form" action="<?=base_url(AD.'update_subcommunity/'.$subcommunity['id'])?>" method="POST">
 <input type="hidden" name="community_id" value="<?= $_GET['community_id'] ?? "" ?>">


        <div class="row">
                            <!-- Sub Name Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_name" class="form-control-label">Sub Name</label>
                                    <input class="form-control" type="text" name="sub_name" value="<?=$subcommunity['sub_name']?>" placeholder="Sub Name">
                                </div>
                            </div>
                            <!-- Sub Description Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_description" class="form-control-label">Sub Description</label>
                                    <textarea class="form-control" name="sub_description"  placeholder="Sub Description" rows="2"><?=$subcommunity['sub_description']?></textarea>
                                </div>
                            </div>
                            <!-- Image Upload Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">Upload Image</label>
                                    <input type="file" id="logo" class="form-control-file" name="image">
                                    <img src="<?=base_url("/uploads/cummunity/$subcommunity[image]")?>" width="180" alt="logo" >
                                </div>
                                <div><img id="preview-image" class="ll"></div>
                            </div>
                            <!-- Tags Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tags" class="form-control-label">Tags</label>
                                    <input class="form-control" type="text" name="tags" value="<?=$subcommunity['tags']?>" placeholder="Tags">
                                </div>
                            </div>
                            <!-- Created By Input -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="createdby" class="form-control-label">Created By</label>
                                    <input class="form-control" type="text" name="createdby" value="<?=$subcommunity['createdby']?>" placeholder="Creator's Name">
                                </div>
                            </div>
                            <!-- Created Date Input -->
                            <div class="col-md-6">
    <div class="form-group">
        <label for="create_date" class="form-control-label">Created Date</label>
        <input class="form-control" type="date" name="create_date" value="<?=$subcommunity['create_date']?>">
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

<script>
    var imageInput = document.getElementById("image");
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