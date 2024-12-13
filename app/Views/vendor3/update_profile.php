<?= $this->extend('vendor3/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row">

        <div class="col-md-8">
            <div class="card">
                <?php if(session()->get("success")):?>
                <div class="alert alert-success" role="alert">
                    <?=session()->get("success")?>
                </div>
                <?php endif;?>
                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-primary" data-collapsed="0">

                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h2><i class="entypo-right-circled"></i>Profile</h2>
                                </div>

                                <div class="panel-options">
                                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"
                                        class="bg"><i class="entypo-cog"></i></a>
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                                </div>
                            </div>

                            <div class="panel-body">
                                <form action="<?=base_url(VD."update_profile")?>" method="POST">
                                    <input type="hidden" value="<?=$profile['user_id']?>" name="id" />
                                    <div class="card-body">
                                        <!--<p class="text-uppercase text-sm">User Information</p>-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Username</label>
                                                    <input class="form-control" type="text" name="name"
                                                        value="<?=$profile['name']?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Email
                                                        address</label>
                                                    <input class="form-control" type="email" name="email"
                                                        value="<?=$profile['email']?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Phone
                                                        No</label>
                                                    <input class="form-control" name="phone_no" type="text"
                                                        value="<?=$profile['phone_no']?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">


                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <input class="btn btn-primary form-control" type="submit"
                                                        value="Submit" />
                                                </div>
                                            </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
<?= $this->endSection() ?>