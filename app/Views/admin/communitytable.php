<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>
<ol class="breadcrumb bc-3">
    <li>
        <a href="index.html"><i class="entypo-home"></i>Home</a>
    </li>
    <li>
        <a href="tables-main.html">Tables</a>
    </li>
    <li class="active">
        <strong> Community Table</strong>
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

    .table-responsive {
        overflow-x: auto;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title"><b><h3><i class="entypo-right-circled"></i>Community Data</h3></b></h1>
                <div class="right-align my-3">
                    <a href="<?= base_url(AD . 'addcommunity') ?>" class="btn btn-default btn-icon icon-left">
                        Add Community
                        <i class="entypo-user-add"></i>
                    </a>
                </div>
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
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable" id="table-1">
                        <thead>
                            <tr>
                            <th>ID</th>
                               
                               <th>Name</th>
                               <th>Brand Name</th>
                               <th>Description</th>
                               <th>Community Logo</th>
                               <th>Location</th>
                               <th>Members Counts</th>
                               <th>Publicly </th>
                               <th>Created By</th>
                               <th>Create Sub Community</th>

                               <th>Date of Creation</th>
                            
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($community as $key => $emp): ?>
                                    <?php
                                        $userModel = new \App\Models\BrandModel();
                                        $brandname = "";
                                        try {
                                         $brand = $userModel->find($emp['brand_id']);
                                         $brandname = $brand['name'];
                                        } catch (\Exception $e) {
                                           $brandname ="Brand Not Found";
                                        }
                                        
                                    ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        
                                      
                                        <td>
                                            <?= $emp['name'] ?>
                                        </td>
                                        <td class="Affiliate-product">
                                            <?= $brandname ?>
                                        </td>
                                        <td >
                                            <?= $emp['description'] ?>
                                        </td>
                                        <td >
                                           <img src="<?=base_url(IMAGE_CUMMUNITY."/".$emp['image'])?>" width="120" />
                                        </td>
                                        <td >
                                            <?= $emp['location'] ?>
                                        </td>
                                        <td >
                                            <?= $emp['numberofmembers'] ?>
                                        </td>
                                        <td >
                                            <?php if($emp['ispublic'] == 1){ echo "Yes";}else{echo "NO";}  ?>
                                        </td>
                                        <td >
                                            <?= $emp['createdby'] ?>
                                        </td>
                                        <td >
                                        <a href="<?=base_url(AD."subcommunity?community_id=$emp[id]")?>"  ><button class="btn btn-primary">Create SubCummunity</button></a>        
                                        </td>
                                        <td >
                                            <?= $emp['createddate'] ?>
                                        </td>
                                        <td>
             
<a   href="<?=base_url(AD."update_community/$emp[id]")?>" class="btn btn-default btn-sm btn-icon icon-left" >
    <i class="entypo-pencil"></i>Edit</a>
    <a href="#" data-href="<?= base_url(AD . "deletecommunity/$emp[id]") ?>" class="confirm_del_btn btn btn-danger btn-sm btn-icon icon-left">
    <i class="entypo-cancel"></i>Delete
</a>


                    </td>
                                        
                                    </tr>
                                <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>ID</th>
                               
                               <th>Name</th>
                               <th>Brand Name</th>
                               <th>Description</th>
                               <th>Community Logo</th>
                               <th>Location</th>
                               <th>Members Counts</th>
                               <th>Publicly </th>
                               <th>Created By</th>
                               <th>Create Sub Community</th>

                               <th>Date of Creation</th>
                            
                               <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
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

<script>
    $(document).ready(function(){
        $('.confirm_del_btn').click(function(e){
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
