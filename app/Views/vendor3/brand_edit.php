<?= $this->extend('vendor3/layouts/main') ?>

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
                <p class="mb-0"><strong> Edit Brand </strong></p>
               
              </div>
            </div>
            <div class="card-body">
    <!--<p class="text-uppercase text-sm">Brand Information</p>-->
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
<form enctype="multipart/form-data" name="brand_form" action="<?=base_url(VD.'editbrand2/'.$brand['id'])?>" method="POST">
<input type="hidden" name="user_id" value="<?=$_GET['user_id'] ?? ""?>">

    <div class="row me-auto">
        <?php $userModel = new \App\Models\UserModel();
            $user =    $userModel->where("user_id",$_GET['user_id'] ?? null)->first();
        ?>
     <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="form-control-label">User Of Brand</label>
                <input class="form-control" type="text" name="name" readonly value="<?=$user['name'] ?? "Null"?>">
            </div>
        </div>
    </div>




    <div class="row">
        <!-- Name Input -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="form-control-label">Name</label>
                <input class="form-control" type="text" name="name" value="<?=$brand['name']?>"placeholder="John Doe">
            </div>
        </div>
        <!-- Email Input -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="email" class="form-control-label">Email</label>
                <input class="form-control" value="<?=$brand['email']?>" type="email" name="email" placeholder="john@example.com">
            </div>
        </div>
        <!-- Phone Number Input -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone_no" class="form-control-label">Phone no.</label>
                <input class="form-control" value="<?=$brand['phone_no']?>" type="text" name="contact_no" placeholder="1234567890">
            </div>
        </div>
        <!-- Logo Upload Input -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="logo" class="form-control-label">Upload Logo<span class='text-success text-sm'>*</span></label>
                <input type="file" id="logo" class="form-control-file" name="logo">
                <img src="<?=base_url()."uploads/".$brand['logo']?>" id="logo_first"class="mt-2" width="150" />
            </div>
            <div><img id="preview-image" class="ll"  ></div>
        </div>
        <!-- Address Input -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="address" class="form-control-label">Address</label>
                <input class="form-control" value="<?=$brand['address']?>" type="text" name="address" placeholder="$5000">
            </div>
        </div>
        <!-- Website Input -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="website" class="form-control-label">Website</label>
                <input class="form-control" type="url" value="<?=$brand['website']?>" name="website" placeholder="Software Engineer">
            </div>
        </div>
        <!-- Google Review Link Input -->
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="whatsapp_no" class="form-control-label">Whatsapp No.</label>
                <input class="form-control" type="text" name="whatsapp_no" value="<?=$brand['whatsapp_no']?>"placeholder="Whatapp">
            </div>
        
        </div> <div class="col-md-6">
            <div class="form-group">
                <label for="twitter	" class="form-control-label">Twitter</label>
                <input class="form-control" type="url" name="twitter"value="<?=$brand['twitter']?>" placeholder="New York">
            </div>
        </div> <div class="col-md-6">
            <div class="form-group">
                <label for="instagram" class="form-control-label">Instagram</label>
                <input class="form-control" type="url" name="instagram"value="<?=$brand['instagram']?>" placeholder="New York">
            </div>
        </div> <div class="col-md-6">
            <div class="form-group">
                <label for="facebook" class="form-control-label">Meta</label>
                <input class="form-control" type="url" name="facebook"value="<?=$brand['facebook']?>" placeholder="New York">
            </div>
        </div> <div class="col-md-6">
            <div class="form-group">
                <label for="others" class="form-control-label">Other Link</label>
                <input class="form-control" type="url" name="others"value="<?=$brand['others']?>" placeholder="New York">
            </div>
        </div>
        <!-- Submit Button -->
        <div class="col-md-12">
            <div class="form-group">
                <input type="submit" value="Update" class="btn btn-success">
            </div>
        </div>
    </div>
</form>

</div>

          </div>
        </div>
    
      </div>
     
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var imageInput = document.getElementById("logo");
    var logofirst = document.getElementById("logo_first");
    var previewImage = document.getElementById("preview-image");
    imageInput.addEventListener("change", function(event) {
        logofirst.style.display="none";
        if(event.target.files.length == 0){
            return;
        }
        var tempUrl = URL.createObjectURL(event.target.files[0]);
        previewImage.setAttribute("src", tempUrl);
    });
</script>
<?= $this->endSection() ?>
