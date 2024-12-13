<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>
<style>
.right-align {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    /* Align items vertically centered */
}

.right-align .btn {
    margin-right: 10px;
    /* Adjusts the right margin */
    margin-top: 0px;
    /* Adjust this value to move the button down */
}
</style>

<hr style="margin-top:0px;" />

<div class="row">
    <div class="col-lg-12">
        <h3 class="hidden-print">
            <i class="entypo-right-circled"></i>
            Banners
        </h3>
        <div class="right-align ">
            <a href="<?= base_url('/admin/banner') ?>" class="btn btn-primary alignToTitle"><i
                    class="entypo-plus"></i>Add New Banner</a>
        </div><br>
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><b>Banner List</b></h4>
                </div>
            </div>
            <div class="panel-body">
                <script type="text/javascript">
                jQuery(document).ready(function($) {
                    var $table1 = jQuery('#table-1');

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
                });
                </script>
                <table class="table table-bordered datatable" id="table-1">
                    <thead>
                        <tr>
                            <th width="50">
                                <div>#</div>
                            </th>
                            <th width="80">
                                <div>Image</div>
                            </th>
                            <th>
                                <div>Title</div>
                            </th>
                            <th>
                                <div>Description</div>
                            </th>
                            <th width="180">
                                <div>Option</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
    $counter = 0;
    foreach ($banners as $banner): ?>
                        <tr>
                            <td><?= ++$counter; ?></td>
                            <td class="text-center">
                                <?php if ($banner['image']): ?>
                                <img class="rounded-circle"
                                    src="<?= base_url('./uploads/banner_image/' . $banner['image']); ?>" alt=""
                                    style="height: 50px; width: 50px;">
                                <?php else: ?>
                                No Photo
                                <?php endif; ?>
                            </td>
                            <td><?= $banner['title']; ?></td>
                            <td><?= $banner['description']; ?></td>
                            <td style="text-align: center;">
                                <a href="<?= base_url('/admin/edit_banner/' . $banner['id']); ?>"
                                    class="btn btn-default btn-sm btn-icon icon-left">
                                    <i class="entypo-pencil"></i>
                                    Edit
                                </a>
                                <a data-href="<?= base_url('admin/banner/delete/' . $banner['id']); ?>"
                                    class="btn btn-danger btn-sm btn-icon icon-left confirm_del_btn"
                                    data-id="<?= $banner['id'] ?>">
                                    <i class="entypo-cancel"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th width="50">
                                <div>#</div>
                            </th>
                            <th width="80">
                                <div>Image</div>
                            </th>
                            <th>
                                <div>Title</div>
                            </th>
                            <th>
                                <div>Description</div>
                            </th>
                            <th width="180">
                                <div>Option</div>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div><!-- end col-->
</div>
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