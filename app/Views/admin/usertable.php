<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>


<ol class="breadcrumb bc-3">
    <li>
        <a href="index.html"><i class="fa-home"></i>Home</a>
    </li>
    <li>
        <a href="tables-main.html">Tables</a>
    </li>
    <li class="active">
        <strong>User Data</strong>
    </li>
</ol>

<div class="card-header pb-0">
    <h2>User Data</h2>
    <a href="<?=base_url(AD.'adduser')?>" class="btn btn-default btn-icon icon-left" style="float: right; margin-bottom: 10px;">
        Add User
        <i class="entypo-user-add"></i>
    </a>
</div>
<br />
<br />

<script type="text/javascript">
jQuery(document).ready(function($) {
    var $table1 = jQuery('#table-1');

    // Initialize DataTable
    $table1.DataTable({
        "aLengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "bStateSave": true
    });

    // Initalize Select Dropdown after DataTables is created
    $table1.closest('.dataTables_wrapper').find('select').select2({
        minimumResultsForSearch: -1
    });
});
</script>

<table class="table table-bordered datatable" id="table-1">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone No</th>
            <th>Role</th>
            <th>Brand</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $key => $emp): ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $emp['name'] ?></td>
            <td><?= $emp['email'] ?></td>
            <td><?= $emp['phone_no'] ?></td>
            <td><?= $emp['role'] ?></td>
            <td>
                <a href="<?= base_url(AD); ?>brtable?user_id=<?= $emp['user_id'] ?>" class="btn btn-blue btn-icon icon-left">
                    <i class="entypo-box"></i> Brand
                </a>
            </td>
            <td>
                <a href="<?= base_url(AD); ?>edituser/<?= $emp['user_id'] ?>" class="btn btn-default btn-sm btn-icon icon-left">
                    <i class="entypo-pencil"></i> Edit
                </a>
                <a data-href="<?= base_url(AD."deleteuser/".$emp['user_id']); ?>" class="btn btn-danger btn-sm btn-icon icon-left confirm_del_btn" data-id="<?= $emp['user_id'] ?>">
                    <i class="entypo-cancel"></i> Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone No</th>
            <th>Role</th>
            <th>Brand</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>

<!-- Imported styles on this page -->
<link rel="stylesheet" href="<?=base_url();?>assets2/js/datatables/datatables.css">
<link rel="stylesheet" href="<?=base_url();?>assets2/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?=base_url();?>assets2/js/select2/select2.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Imported scripts on this page -->
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
