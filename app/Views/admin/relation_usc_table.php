<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>
<style>
    .right-align {
        display: flex;
        justify-content: flex-end;
        align-items: center; /* Align items vertically centered */
    }

    .right-align .btn {
        margin-right: 10px; /* Adjusts the right margin */
        margin-top: 10px;  /* Adjust this value to move the button down */
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<hr style="margin-top:0px;" />

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">
                    <b><h4><i class="entypo-right-circled"></i>USER COMMUNITY DATA</h4></b>
                </h1>
                <div class="right-align my-3">
                    <a href="<?= base_url(AD.'usercommunity') ?>" class="btn btn-default btn-icon icon-left">
                        Add User Community
                        <i class="entypo-user-add"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>
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
                <div class="table-responsive p-0">
                    <table class="table table-bordered datatable" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Community</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sub Community</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $key => $emp) : ?>
                                <tr>
                                    <td><?= esc($key + 1) ?></td>
                                    <td>
                                        <?php
                                        $userModel = new \App\Models\UserModel();
                                        try {
                                            $user = $userModel->find($emp['user_id']);
                                            echo esc($user['name']);
                                        } catch (\Exception $e) {
                                            echo "USER_NOT_RELATED";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $CommunityModel = new \App\Models\CommunityModel();
                                        try {
                                            $community = $CommunityModel->find($emp['community_id']);
                                            echo esc($community['name']);
                                        } catch (\Exception $e) {
                                            echo "COMMUNITY_NOT_RELATED";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $SubCommunityModel = new \App\Models\SubCommunityModel();
                                        try {
                                            $subCommunity = $SubCommunityModel->find($emp['subcom_id']);
                                            echo esc($subCommunity['sub_name']);
                                        } catch (\Exception $e) {
                                            echo "SUB_COMMUNITY_NOT_RELATED";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url(AD . 'usercommunityupdate/' . $emp['id']) ?>" class="btn btn-default btn-sm btn-icon icon-left">
                                            <i class="entypo-pencil"></i>
                                            Edit
                                        </a>
                                        <a data-href="<?= base_url(AD . 'deleteservices/' . $emp['id']) ?>" class="btn btn-danger btn-sm btn-icon icon-left confirm_del_btn">
                                            <i class="entypo-cancel"></i>
                                            Delete
                                        </a>
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
<!-- Imported styles on this page -->
<link rel="stylesheet" href="<?= base_url();?>assets2/js/datatables/datatables.css">
<link rel="stylesheet" href="<?= base_url();?>assets2/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?= base_url();?>assets2/js/select2/select2.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Imported scripts on this page -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        $('.confirm_del_btn').click(function(e){
            e.preventDefault();
            var href = $(this).data('href'); // Use data-href attribute for the URL
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
                        url: href, // Use the data-href attribute for the AJAX request
                        type: 'GET', // or 'POST' depending on your controller method
                        success: function (response) {
                            Swal.fire({
                                title: response.status,
                                text: response.status_text,
                                icon: response.status_icon,
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "OK"
                            }).then((confirmed) => {
                                if (confirmed.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        },
                        error: function (response) {
                            Swal.fire({
                                title: "Error!",
                                text: "An error occurred while deleting the community.",
                                icon: "error",
                                showCancelButton: false,
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
