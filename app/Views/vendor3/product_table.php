<?= $this->extend('vendor3/layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .right-align {
    display: flex;
    justify-content: flex-end;
    align-items: center; /* Align items vertically centered */
}

.right-align .btn {
    margin-right: 3px; /* Adjusts the right margin */
    margin-top: 10px;  /* Adjust this value to move the button down */
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<ol class="breadcrumb bc-3">
    <li>
        <a href="<?= base_url(VD.'/') ?>"><i class="entypo-home"></i>Home</a>
    </li>
    <li>
        <a href="">Tables</a>
    </li>
    <li class="active">
        <strong>Product Table</strong>
    </li>
</ol>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title"> <b><h4><i class="entypo-right-circled"></i>PRODUCT TABLE</h4></b></h1>
                <div class="right-align my-3">
                <a href="<?= base_url(VD . 'product2?brand_id='.$_GET['brand_id'].'') ?>" class="btn btn-default btn-icon icon-left">
                        Add Product
                        <i class="entypo-user-add"></i>
                    </a>
            </div>

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
            <th width="50">ID</th>
            <th>Image</th>
            <th>Product</th>
            <th>Details</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($product as $key => $emp): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td>
                    <img src="<?= base_url("/uploads/product/$emp[image]") ?>" alt="Product Image" style="height: 60px; width: 80px;">
                </td>
                <td><?= $emp['product'] ?></td>
                <td><?= $emp['details'] ?></td>
                <td><?= $emp['price'] ?></td>
                <td>
                    <a href="<?=base_url(VD);?>editproduct2/<?=$emp['id']."?brand_id=".$_GET['brand_id']?>" class="btn btn-default btn-sm btn-icon icon-left">
                        <i class="entypo-pencil"></i>
                        Edit
                    </a>
                    <button data-href="<?=base_url(VD);?>deleteproduct2/<?=$emp['id']?>" class="btn btn-danger btn-sm btn-icon icon-left confirm_del_btn">
                        <i class="entypo-cancel"></i>
                        Delete
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Product</th>
            <th>Details</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

<!-- Imported styles on this page -->
<link rel="stylesheet" href="<?= base_url(); ?>assets2/js/datatables/datatables.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets2/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets2/js/select2/select2.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Imported scripts on this page -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('.confirm_del_btn').click(function(e) {
        e.preventDefault();
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
                    method: "POST",
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
                            text: "There was an error deleting the product. Please try again.",
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
