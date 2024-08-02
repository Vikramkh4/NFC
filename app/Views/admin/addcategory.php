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
                <form action="<?= base_url(ADMIN.'addcategory') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Category Title</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Provide category title">
                    </div>
                    <div class="form-group">
                        <label for="parent" class="col-sm-3 control-label">Parent Category</label>
                        <select name="parent" id="parent" onchange="checkCategoryType(this.value)" class="form-control" data-allow-clear="true" onchange="checkCategoryType(this.value)" >
                            <option value="0">None</option>
                            <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="icon" class="col-sm-3 control-label">Icon Picker</label>
                        <input type="text" class="form-control" name="icon" id="icon" placeholder="icon">
                    </div>  
                    <div>
   
</div>
<div class="form-group" id="thumbnail-picker-area" >
  <img id="preview-image" class="ll" alt="Image Preview">
    <label for="thumbnail" class="form-control-label">Category Thumbnail</label>
    <input type="file" id="thumbnail" name="thumbnail" class="form-control-file" accept="image/*">
    <a href="#" id="remove-thumbnail" class="btn btn-orange" style="display: none;">Remove</a>
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

    var imageInput = document.getElementById("thumbnail");
    var previewImage = document.getElementById("preview-image");
    var removeButton = document.getElementById("remove-thumbnail");
    let select =   document.getElementById("parent");
    // image-container
   
function checkCategoryType(category_type) {
    if (category_type > 0) {
        $('#thumbnail-picker-area').hide();
    } else {
        $('#thumbnail-picker-area').show();
    }
}

    imageInput.addEventListener("change", function(event) {
        if (event.target.files.length > 0) {
            var tempUrl = URL.createObjectURL(event.target.files[0]);
            previewImage.setAttribute("src", tempUrl);
            previewImage.style.display = 'block';
            removeButton.style.display = 'inline';
        }
    });



    removeButton.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default action of the link
        previewImage.setAttribute("src", "");
        previewImage.style.display = 'none';
        removeButton.style.display = 'none';
        imageInput.value = ""; // Clear the file input
    });


</script>
<!-- <script>
  

    function checkCategoryType(category_type) {
        var thumbnailPickerArea = document.getElementById('thumbnail-picker-area');
        if (category_type > 0) {
            thumbnailPickerArea.style.display = 'none';
        } else {
            thumbnailPickerArea.style.display = 'block';
        }
    }
</script> -->
<?= $this->endSection() ?>
