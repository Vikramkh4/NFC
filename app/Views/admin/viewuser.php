<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>

<div style="text-align: right;">
    <ol class="breadcrumb bc-3">
        <li>
            <a href="index.html"><i class="entypo-home"></i>Dashboard</a>
        </li>
        <li>
            <a href="tables-main.html">Vendor</a>
        </li>
        <li class="active">
            <strong>View</strong>
        </li>
    </ol>
</div>

<div class="row">
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><b>Profile</b></div>
                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="profile">
                    <div class="avatar-container">
                        <img src="<?= base_url('uploads/' . ($emp['image'] ? $emp['image'] : 'default-avatar.png')) ?>" class="avatar" alt="Profile Image">
                    </div>
                    <h4><b><?= isset($emp['name']) ? $emp['name'] : ''; ?></b></h4>
                    <h6><?= isset($emp['role']) ? $emp['role'] : ''; ?></h6>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>Phone</b>
                            <span class="pull-right"><?= isset($emp['phone_no']) ? $emp['phone_no'] : ''; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                <ul class="nav nav-tabs"><!-- available classes "bordered", "right-aligned" -->
					<li class="active">
						<a href="#brand" data-toggle="tab">
							<span class="hidden-xs">Brands</span>
						</a>
					</li>
					<li>
						<a href="#product" data-toggle="tab">
							<span class="hidden-xs">Products</span>
						</a>
					</li>
					<li>
						<a href="#services" data-toggle="tab">
							<span class="hidden-xs">Services</span>
						</a>
					</li>
				</ul>
                </div>
                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div>
            </div>
            <div class="tab-content">
					<div class="tab-pane active" id="brand">
						
                        <div class="table-responsive">
                    <table class="table table-bordered datatable" id="table-1">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Address</th>
                                <th>Website</th>
                                <th>View</th>
                                <th>Social Media</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($brands as $key => $emp): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $emp['name'] ?></td>
                                    
                                    <td><?= $emp['email'] ?></td>
                                    <td><?= $emp['phone_no'] ?></td>
                                    <td><?= $emp['address'] ?></td>
                                    <td><a target="_blank" href="<?= $emp['website'] ?>">Website</a></td>
                                    <td><a href="<?= base_url(AD); ?>brtable?user_id=<?=$emp['u_id']?>" class="btn btn-blue  ">
                                        View More</a></td>
                                    <td>
                                        <a href="<?= $emp['twitter'] ?>"><i class="entypo-twitter"></i></a>
                                        <a href="<?= $emp['instagram'] ?>"><i class="entypo-instagram"></i></a>
                                        <a href="<?= $emp['facebook'] ?>"><i class="entypo-facebook"></i></a>
                                        <a href="<?= $emp['others'] ?>"><i class="entypo-flickr"></i></a>
                                    </td>
                                    <td>
                                        
                                        <a data-href="<?= base_url(AD); ?>deletebrand/<?=$emp['id']?>" class="confirm_del_btn btn btn-danger btn-sm btn-icon icon-left">
                                            <i class="entypo-cancel"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>		

					</div>
					<div class="tab-pane" id="product">
                    <table class="table table-bordered datatable" id="table-1">
    <thead>
        <tr>
            <th >ID</th>
            <th>Image</th>
            <th>Product</th>
            <th>Details</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $key => $emp): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td>
                    <img src="<?= base_url("/uploads/product/$emp[image]") ?>" alt="Product Image" style="height: 60px; width: 80px;">
                </td>
                <td><?= $emp['product'] ?></td>
                <td><?= $emp['details'] ?></td>
                <td><?= $emp['price'] ?></td>
                <td>
                    <button data-href="<?= base_url(AD . 'deleteproduct/' . $emp['id']) ?>" class="btn btn-danger btn-sm btn-icon icon-left confirm_del_btn">
                        <i class="entypo-cancel"></i>
                        Delete
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>							
					</div>
					<div class="tab-pane" id="services">
                    <table class="table table-bordered datatable" id="table-1">
    <thead>
        <tr>
            <th >ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Details</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($services as $key => $emp): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td>
                    <img class="image" width="120" height="120" src="<?= base_url("./uploads/Services/" . $emp['image']) ?>" alt="Service Image" style="height: 60px; width: 80px;" />
                </td>
                <td><?= $emp['name'] ?></td>
                <td><?= $emp['details'] ?></td>
                <td>
                    <button data-href="<?= base_url(AD . 'deleteservices/' . $emp['id']) ?>" class="btn btn-danger btn-sm btn-icon icon-left confirm_del_btn">
                        <i class="entypo-cancel"></i>
                        Delete
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>										
                    </div>
				</div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('.confirm_del_btn').click(function(e) {
        e.preventDefault();
        var userId = $(this).data('id'); 
        var href = $(this).data('href'); 
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:href,
                    method: "POST", // Assuming you use POST for deletion
                    success: function(response) {
                        Swal.fire({
                            title: response.status,
                            text: response.status_text,
                            icon: response.status_icon,
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        }).then((confirmed) => {
                            if (confirmed.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: "Error",
                            text: "There was an error deleting the user. Please try again.",
                            icon: "error",
                            confirmButtonColor: "#d33",
                            confirmButtonText: "OK"
                        });
                    }
                });
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
