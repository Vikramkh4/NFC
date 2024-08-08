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
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
            <a href="<?=base_url(AD.'enquiry?brand_id='. $_GET['brand_id'])?>" class="btn btn-default btn-icon icon-left" style="float: right; margin-bottom: 10px;">
        Add Enquiry
        <i class="entypo-user-add"></i>
    </a>
                <div class="panel-title">
                    <h2>Enquiries</h2>
                    
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Topic</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($enquiries  as $key => $enquiry): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $enquiry['email'] ?></td>
                                <td><?= $enquiry['name'] ?></td>
                                <td><?= $enquiry['topic'] ?></td>
                                <td><?= $enquiry['comment'] ?></td>
                                <td>
                                    <?php if ($enquiry['status']): ?>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#statusModal" data-status="<?= $enquiry['status'] ?>">Solved</button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#statusModal" data-status="Pending">Pending</button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url(AD. 'enquiryshow/' . $enquiry['id']) ?>" class="btn btn-info">View Details</a>
                                    <a href="<?= base_url('admin/enquirydelete/' . $enquiry['id']) ?>" data-href="<?= base_url('admin/enquirydelete/' . $enquiry['id']) ?>" class="btn btn-danger btn-sm btn-icon icon-left confirm_del_btn">
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

<!-- Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel"><h2>Enquiry Solution</h2></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="statusContent">Status details will appear here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#statusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var status = button.data('status'); // Extract status from data-* attributes

        var modal = $(this);
        modal.find('.modal-body #statusContent').text(status); // Set the status in the modal
    });
</script>
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
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
                            text: "There was an error deleting the Enquiry. Please try again.",
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
