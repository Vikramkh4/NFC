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

<!-- Table to display amenities -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title"> <b><?= $page_name ?></b></h1>
                <div class="right-align my-3">
                    <a href="<?= base_url('/admin/add_market') ?>" class="btn btn-default btn-icon icon-left">
                        Add Market
                        <i class="entypo-user-add"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <table id="marketsTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th>Local Area</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($markets) && is_array($markets)) : ?>
                            <?php foreach ($markets as $market) : ?>
                                <tr>
                                    <td><img src="<?= base_url("uploads/market_image/" . $market['icon']) ?>" alt="Icon" style="width: 50px; height: 50px;" /></td>
                                    <td><?= esc($market['name']); ?></td>
                                    <td><?= esc($market['details']); ?></td>
                                    <td><?= esc($market['local_area']); ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/edit_market/' . $market['id']) ?>" class="btn btn-default btn-sm btn-icon icon-left">
                                            <i class="entypo-pencil"></i>
                                            Edit
                                        </a>
                                        <a href="<?= base_url("admin/delete_market/" . $market['id']); ?>" data-href="<?= base_url("admin/delete_market/" . $market['id']); ?>" class="btn btn-danger btn-sm btn-icon icon-left confirm_del_btn">
                                            <i class="entypo-cancel"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">No market entries found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Imported styles on this page -->
<link rel="stylesheet" href="<?= base_url(); ?>assets2/js/datatables/datatables.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets2/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets2/js/select2/select2.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
    $('#marketsTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

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
                            text: "There was an error deleting the Market. Please try again.",
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
