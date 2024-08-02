<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="row">
    <div class="col-lg-12">
        <a href="<?= base_url(ADMIN . 'category'); ?>" class="btn btn-primary alignToTitle">
            <i class="entypo-plus"></i> <?= lang('add_new_category'); ?>
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="gallery-env">
    <div class="row">
        <?php foreach ($categories as $category): ?>
            <?php if ($category['parent'] > 0) continue; ?>
            <?php
                $sub_categories = array_filter($categories, function($sub) use ($category) {
                    return $sub['parent'] == $category['id'];
                });
            ?>
            <div class="col-sm-4 on-hover-action" id="category-<?= $category['id']; ?>">
                <article class="album">
                    <header>
                        <a href="javascript:void(0);">
                            <img src="<?= base_url('uploads/category/'.$category['thumbnail']); ?>" alt="<?= $category['name']; ?>" />
                        </a>
                    </header>

                    <section class="album-info">
                        <h3>
                            <a href="javascript:void(0);">
                                <i class="<?= $category['icon_class']; ?>"></i> <?= $category['name']; ?>
                            </a>
                        </h3>
                        <p><?= count($sub_categories) . ' ' . lang('sub_categories'); ?></p>
                    </section>

                    <?php foreach ($sub_categories as $sub_category): ?>
                        <footer class="on-hover-action" id="subcategory-<?= $sub_category['id']; ?>">
                            <div class="album-images-count">
                                <i class="<?= $sub_category['icon_class']; ?>"></i> <?= $sub_category['name']; ?>
                            </div>

                            <div class="album-options" id="subcategory-action-btn-<?= $sub_category['id']; ?>" style="display: none;">
                                <a href="<?= base_url(ADMIN . 'categoryedit1/' . $sub_category['id']); ?>">
                                    <i class="entypo-cog"></i>
                                </a>
                                <a href="#" onclick="confirmDelete('<?= site_url(ADMIN . 'categorydelete/' . $sub_category['id']); ?>');">
                                    <i class="entypo-trash"></i>
                                </a>
                            </div>
                        </footer>
                    <?php endforeach; ?>

                    <div class="category-actions">
                        <a href="<?= base_url(ADMIN . 'categoryedit1/' . $category['id']); ?>" class="btn btn-info" id="category-edit-btn-<?= $category['id']; ?>" style="display: none; margin-right:5px;">
                            <?= lang('edit'); ?>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-red" id="category-delete-btn-<?= $category['id']; ?>" onclick="confirmDelete('<?= site_url(ADMIN . 'categorydelete/' . $category['id']); ?>')" style="margin-right:5px; float: right; display: none;">
                            <?= lang('delete'); ?>
                        </a>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('.on-hover-action').mouseenter(function() {
        var id = $(this).attr('id').split('-')[1];
        $('#category-delete-btn-' + id).show();
        $('#category-edit-btn-' + id).show();
        $('#subcategory-action-btn-' + id).show();
    });

    $('.on-hover-action').mouseleave(function() {
        var id = $(this).attr('id').split('-')[1];
        $('#category-delete-btn-' + id).hide();
        $('#category-edit-btn-' + id).hide();
        $('#subcategory-action-btn-' + id).hide();
    });
});

function confirmDelete(url) {
    if (confirm('Are you sure you want to delete this category?')) {
        window.location.href = url;
    }
}
</script>

<?= $this->endSection() ?>
