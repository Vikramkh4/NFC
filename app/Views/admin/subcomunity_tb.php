<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>
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

    .table-responsive {
        overflow-x: auto;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                < class="panel-title"><b><h3><i class="entypo-right-circled"></i> <?= $page_name ?></h3></b></h1>
                <div class="right-align my-3">
                    <a href="<?= base_url(AD . 'addsubcommunity?community_id='.$_GET['community_id'].'') ?>" class="btn btn-default btn-icon icon-left">
                        Add Sub Community
                        <i class="entypo-user-add"></i>
                    </a>
                </div>
            </div>

    <div class="table-responsive p-0">
            <table class="table table-bordered datatable" id="table-1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th >Name</th>
                        <th>Description</th>
                        <th width="80">Image</th>
                        <th>Tags</th>
                        <th>Created By </th>
                        <th>Create Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($community as $key => $emp): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td class="Affiliate-product"><?= $emp['sub_name'] ?></td>
                            <td class="Affiliate-feature"><?= $emp['sub_description'] ?></td>
                            <td class="Affiliate-image">
                                <img src="<?= base_url(IMAGE_CUMMUNITY.'/'.$emp['image']) ?>" style="width: 80px;"/>
                            </td>
                            <td class="Affiliate-product"><?= $emp['tags'] ?></td>
                            <td class="Affiliate-product"><?= $emp['createdby'] ?></td>
                            <td class="Affiliate-product"><?= $emp['create_date'] ?></td>
                            <td>
                                <a href="<?= base_url(AD . 'update_subcommunity/' . $emp['id']) ?>" ><button class="btn btn-primary">Edit</button></a>
                                <a href="<?= base_url(AD . 'deletesubcommunity/' . $emp['id']) ?>" ><button class="btn btn-danger confirm_del_btn text-light">Delete</button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                        <th>ID</th>
                        <th >Name</th>
                        <th>Description</th>
                        <th >Image</th>
                        <th>Tags</th>
                        <th>Created By </th>
                        <th>Create Date</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
</div>
                    </div>
<!-- Imported styles on this page -->
<link rel="stylesheet" href="<?=base_url();?>assets2/js/datatables/datatables.css">
<link rel="stylesheet" href="<?=base_url();?>assets2/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?=base_url();?>assets2/js/select2/select2.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Imported scripts on this page -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<script>
    $(document).ready(function(){
        $('.confirm_del_btn').click(function(e){
            e.preventDefault();
            var id = $(this).parent().attr('href'); // Extract ID from the URL
         
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
                        url: id,
                        success: function (response) { 
                            Swal.fire({
                                title: response.status,
                                text: response.status_text,
                                icon: response.status_icon,
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "OK"
                            }).then((confirmed) => {
                                window.location.reload();
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>