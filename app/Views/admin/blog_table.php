<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>
<style>
    .right-align {
        display: flex;
        justify-content: flex-end;
        align-items: center; /* Align items vertically centered */
    }

    .right-align .btn {
        margin-right: 2in; /* Adjusts the right margin */
        margin-top: 10px;  /* Adjust this value to move the button down */
    }
</style>
<script type="text/javascript">
jQuery(document).ready(function($) {
    var $table1 = jQuery('.table-bordered');

    // Initialize DataTable
    $table1.DataTable({
        "aLengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "bStateSave": true,
        "dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    // Initialize Select Dropdown after DataTables is created
    $table1.closest('.dataTables_wrapper').find('select').select2({
        minimumResultsForSearch: -1
    });
});
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title"><b><?= $page_name ?></b></h1>
                <div class="right-align my-3">
                    <a href="<?= base_url('/admin/blog_form') ?>" class="btn btn-default btn-icon icon-left">
                        Add Blogs
                        <i class="entypo-user-add"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($blogs)) : ?>
                            <?php foreach ($blogs as $key=>$blog) : ?>
                                <tr>
                                    <td><?= ($key+1) ?></td>
                                    <td><img src="<?= base_url("uploads/blog_image/".$blog['blog_image']) ?>" alt="Blog Image" width="100"></td>
                                    <td><?= $blog['tittle'] ?></td>
                                    <td><?= $blog['description'] ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/edit_blog/' . $blog['id']) ?>" class="btn btn-default btn-sm btn-icon icon-left">
                                            <i class="entypo-pencil"></i>
                                            Edit
                                        </a>
                                        <a href="<?= base_url('admin/delete_blog/' . $blog['id']) ?>" data-href="<?= base_url('admin/delete_blog/' . $blog['id']) ?>" class="btn btn-danger btn-sm btn-icon icon-left confirm_del_btn">
                                            <i class="entypo-cancel"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">No blogs found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Imported scripts on this page -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
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
                            text: "There was an error deleting the Review. Please try again.",
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
