<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2>Enquiry Details</h2>
                </div>
            </div>
            <div class="panel-body">
                <div class="form-group row">
                    <label class="col-sm-3 control-label">Email:</label>
                    <div class="col-sm-9">
                        <p><?= esc($enquiry['email']) ?></p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label">Name:</label>
                    <div class="col-sm-9">
                        <p><?= esc($enquiry['name']) ?></p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label">Topic:</label>
                    <div class="col-sm-9">
                        <p><?= esc($enquiry['topic']) ?></p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label">Comment:</label>
                    <div class="col-sm-9">
                        <p><?= esc($enquiry['comment']) ?></p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label">Status:</label>
                    <div class="col-sm-9">
                        <p id="status-display" >
                        <?php if ($enquiry['status']): ?>
                            <P>Solved</P>
                            <?php else: ?>
                            <p>Pending</p>
                            <?php endif;?>
                        </p>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-offset-3 col-sm-9">
                        <a href="<?= base_url(AD. 'enquiryview') ?>" class="btn btn-primary">Back to List</a>
                        <?php if ($enquiry['status'] !== 'Solved'): ?>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#statusModal">Solution</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel"><h1>Give Solution Of Query</h1></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="statusForm" method="post" action="<?= base_url(AD. 'enquiryupdateStatus/' . $enquiry['id']) ?>">
                    <div class="form-group">
                        <label for="status">Solution</label>
                            <textarea id="status" class="form-control" name="status" rows="4" placeholder="Enter Solution" required></textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Save </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#statusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var status = $('#status-display').text(); // Current status displayed
        var modal = $(this);
        modal.find('#status').val(status); // Set the current status in the input
    });
</script>

<?= $this->endSection() ?>
