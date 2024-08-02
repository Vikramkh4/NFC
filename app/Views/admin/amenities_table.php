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
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title"> <b><?= $page_name ?></b></h1>
                <div class="right-align my-3">
                <a href="<?= base_url('/admin/amenities') ?>" class="btn btn-default btn-icon icon-left">
                        Add Amenity
                        <i class="entypo-user-add"></i>
                    </a>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Amenity Title</th>
                            <th>Icon</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($amenities)) : ?>
                            <?php foreach ($amenities as $amenity) : ?>
                                <tr>
                                    <td><?= $amenity['name'] ?></td>
                                    <td><i class="<?= esc($amenity['icon']); ?>"></i></td>
                                    <td>
                                    <a href="<?= base_url('admin/edit_amenity/' . $amenity['id']) ?>" class="btn btn-default btn-sm btn-icon icon-left">
    <i class="entypo-pencil"></i>
    Edit
</a>

						
						<a href="<?= base_url('admin/delete/' . $amenity['id']) ?>" class="btn btn-danger btn-sm btn-icon icon-left">
							<i class="entypo-cancel"></i>
							Delete
						</a>
                            </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2">No amenities found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
