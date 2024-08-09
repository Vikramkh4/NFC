<?= $this->extend('vendor3/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-sm-3 col-xs-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                        <div class="tile-stats tile-aqua">
            <div class="icon"><i class="entypo-box"></i></div>
            <div class="num" data-start="0" data-end="<?= $brands ?? '0' ?>" data-postfix="" data-duration="1500" data-delay="1200">0</div>

            <h3>Total Brands</h3>
        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
</div>
    </div>

        <!--<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">-->
        <!--    <div class="card">-->
        <!--        <div class="card-body p-3">-->
        <!--            <div class="row">-->
        <!--                <div class="col-8">-->
        <!--                    <div class="numbers">-->
                    
        <!--                        <h5 class="font-weight-bolder">-->
                                  
        <!--                        </h5>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="col-4 text-end">-->
        <!--                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">-->
        <!--                        <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
         

<?= $this->endSection() ?>
