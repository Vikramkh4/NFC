<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0"><strong><?php echo isset($user) ? 'Update User' : 'Add User'; ?></strong></p>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (!empty($errors)) : ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $field => $error): ?>
                                <p><?= $error ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                    <?php if (isset($validation)): ?>
                        <div class="validation-errors">
                            <?php echo $validation->listErrors(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif;?>

               <form method="post" action="<?= isset($user) ? base_url(AD."usercommunityupdate/".$user['id']) : base_url(AD."/usercommunity") ?>">
    <div class="col-md-6">
        <div class="form-group">
            <label for="user_id" class="form-control-label">User</label>
            <select class="form-control" name="user_id" id="user_id">
                <option value="">Select User</option>
                <?php foreach ($users as $row): ?>
                    <option value="<?= $row['user_id'] ?>" <?= set_select('user_id', $row['user_id'], isset($user) && $user['user_id'] == $row['user_id']); ?>>
                        <?= $row['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="community_id" class="form-control-label">Community</label>
            <select class="form-control" name="community_id" id="community_id">
                <option value="">Select Community</option>
                <?php foreach ($communities as $row): ?>
                    <option value="<?= $row['id'] ?>" <?= set_select('community_id', $row['id'], isset($user) && $user['community_id'] == $row['id']); ?>>
                        <?= $row['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="subcom_id" class="form-control-label">Sub Community</label>
            <select class="form-control" name="subcom_id" id="subcom_id">
                <option value="">Select Sub Community</option>
                <?php if (isset($subcommunities)): ?>
                    <?php foreach ($subcommunities as $row): ?>
                        <option value="<?= $row['id'] ?>" <?= set_select('subcom_id', $row['id'], isset($user) && $user['subcom_id'] == $row['id']); ?>>
                            <?= $row['sub_name'] ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary"><?= isset($user) ? 'Update' : 'Submit'; ?></button>
    </div>
</form>



                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#community_id').change(function() {
            var community_id = $(this).val();
            $.ajax({
                url: '<?= base_url("admin/subcommunity/getSubCommunitiesByCommunity") ?>',
                type: 'POST',
                data: {community_id: community_id},
                dataType: 'json',
                success: function(response) {
                    var subcomSelect = $('#subcom_id');
                    subcomSelect.empty();
                    subcomSelect.append('<option value="">Select Sub Community</option>');
                    $.each(response, function(index, subcommunity) {
                        subcomSelect.append('<option value="' + subcommunity.id + '">' + subcommunity.sub_name + '</option>');
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
