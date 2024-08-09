<?= $this->extend('vendor3/layouts/main') ?>

<?= $this->section('content') ?>

<ol class="breadcrumb bc-3">
    <li>
        <a href="index.html"><i class="entypo-home"></i>Home</a>
    </li>
    <li>
        <a href="tables-main.html">Tables</a>
    </li>
    <li class="active">
        <strong> Brand Table</strong>
    </li>
</ol>

<style>
     .right-align {
    display: flex;
    justify-content: flex-end;
    align-items: center; /* Align items vertically centered */
}

.right-align .btn {
    margin-right: 20px; /* Adjusts the right margin */
    margin-top: 20px;  /* Adjust this value to move the button down */
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
                <h1 class="panel-title"><b><h3><i class="entypo-right-circled"></i>Brand Data</h3></b></h1>
                <div class="right-align my-3">
                    <a href="<?= base_url(VD . 'addBrand2') . '?user_id=' . session()->get('user_id') ?>" class="btn btn-default btn-icon icon-left">
                        Add Brand  
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
                                <th>Id</th>
                                <th>Name</th>
                                
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Image</th>
                                <th>Address</th>
                                <th>Website</th>
                                <th>Google Review Link</th>
                                <th>Enquire Link</th>
                                <th>Social Media</th>
                                <th>Actions</th>
                                <th>Brand</th>
                                <th>Services</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($brand as $key => $emp): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $emp['name'] ?></td>
                                    
                                    <td><?= $emp['email'] ?></td>
                                    <td><?= $emp['phone_no'] ?></td>
                                    <td><img src="<?=base_url("/uploads/$emp[logo]")?>" width="70" alt="logo"></td>
                                    <td><?= $emp['address'] ?></td>
                                    <td><a target="_blank" href="<?= $emp['website'] ?>">Website</a></td>
                                    <td><a target="_blank" href="<?= $emp['google_review'] ?>">Reviews</a></td>
                                    <td><a target="_blank" href="<?= $emp['enqlink'] ?>">Enquire Link</a></td>
                                    <td>
                                        <a href="<?= $emp['twitter'] ?>"><i class="entypo-twitter"></i></a>
                                        <a href="<?= $emp['instagram'] ?>"><i class="entypo-instagram"></i></a>
                                        <a href="<?= $emp['facebook'] ?>"><i class="entypo-facebook"></i></a>
                                        <a href="<?= $emp['others'] ?>"><i class="entypo-flickr"></i></a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url(VD); ?>editbrand2/<?=$emp['id']."?user_id=".session()->get('user_id')?>" class="btn btn-default btn-sm btn-icon icon-left">
                                            <i class="entypo-pencil"></i> Edit
                                        </a>
                                        <a data-href="<?= base_url(VD); ?>deletebrand2/<?=$emp['id']?>" class="confirm_del_btn btn btn-danger btn-sm btn-icon icon-left">
                                            <i class="entypo-cancel"></i> Delete
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url(VD); ?>prtable2?brand_id=<?=$emp['id']?>" class="btn btn-blue btn-icon icon-left">
                                            <i class="entypo-suitcase"></i> Product
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url(VD); ?>srtable2?brand_id=<?=$emp['id'] ?>" class="btn btn-green btn-icon icon-left">
                                            <i class="entypo-chart-bar"></i> Services
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
                                <th>Image</th>
                                <th>Address</th>
                                <th>Website</th>
                                <th>Google Review Link</th>
                                <th>Enquire Link</th>
                                <th>Social Media</th>
                                <th>Actions</th>
                                <th>Brand</th>
                                <th>Services</th>
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
