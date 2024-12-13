<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>

<ol class="breadcrumb bc-3">
    <li>
        <a href="<?= base_url(AD.'/') ?>"><i class="entypo-home"></i> Home</a>
    </li>
    <li>
         Tables
    </li>
    <li class="active">
        <strong>User Data</strong>
    </li>
</ol>

<style>
.right-align {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.right-align .btn {
    margin-right: 3px;
    margin-top: 10px;
}

.avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
}
</style>

<!-- Imported styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="<?= base_url('assets2/js/datatables/datatables.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets2/js/select2/select2-bootstrap.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets2/js/select2/select2.css') ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">
                    <b>
                        <h4><i class="entypo-right-circled"></i> VENDOR DATA</h4>
                    </b>
                </h1>
                <div class="right-align my-3">
                    <a href="<?= base_url(AD . 'adduser') ?>" class="btn btn-default btn-icon icon-left">
                        Add User
                        <i class="entypo-user-add"></i>
                    </a>
                </div>
            </div>

            <table class="table table-bordered datatable" id="table-1">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Image</th>
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
                        <td><?= esc($emp['name']) ?></td>
                        <td><img src="<?= base_url('uploads/' . ($emp['image'] ? $emp['image'] : 'default-avatar.png')) ?>" class="avatar" alt=" Image"></td>
                        <td><?= esc($emp['email']) ?></td>
                        <td><?= esc($emp['phone_no']) ?></td>
                        <td><?= esc($emp['role']) ?></td>
                        <td>
                            <a href="<?= base_url(AD . 'brtable?user_id=' . $emp['user_id']) ?>" class="btn btn-blue btn-icon icon-left">
                                <i class="entypo-box"></i> Brand
                            </a>
                        </td>
                        <td>
                            <a href="<?= base_url(AD . 'viewuser/' . $emp['user_id']) ?>" class="btn btn-green btn-sm">
                                <i class="entypo-eye"></i>
                            </a>
                            <a href="<?= base_url(AD . 'edituser/' . $emp['user_id']) ?>" class="btn btn-default btn-sm btn-icon icon-left">
                                <i class="entypo-pencil"></i> Edit
                            </a>
                            <a data-href="<?= base_url(AD . "deleteuser/" . $emp['user_id']) ?>" class="btn btn-danger btn-sm btn-icon icon-left confirm_del_btn" data-id="<?= $emp['user_id'] ?>">
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
                        <th>Image</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Role</th>
                        <th>Brand</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Imported scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets2/js/datatables/datatables.js') ?>"></script>
<script src="<?= base_url('assets2/js/select2/select2.min.js') ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function($) {
    var $table1 = $('#table-1');

    // Initialize DataTable with all combined options
    $table1.DataTable({
        "aLengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "bStateSave": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        initComplete: function() {
            // Initialize Select2 Dropdown after DataTable is created
            $table1.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });
        }
    });

    // Confirm delete functionality
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
                    url: href,
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
