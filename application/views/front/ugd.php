<section class="content container-fluid">

    <div class="row back-gradient" id="ugd" style="padding-bottom: 30px;">
        <div class="col-xs-12 no-pad" align="center">
            <div class="col-xs-12" style="margin-bottom: 30px;">
                <h1 class="italic purple">
                    Emergency Services Call (UGD)
                </h1>
            </div>

            <div class="col-xs-12 no-pad">
                <div class="container">
                    <div class="row">
                        <?php foreach ($ugds as $ugd) : ?>
                            <div class="col-md-4">
                                <div class="branchlist">
                                    <h4><?= $ugd['namehospital']; ?></h4>
                                    <img src="<?= base_url('assets/img/icons/ugd.png'); ?>" alt="">
                                    <a href="tel:<?= $ugd['ugd']; ?>"><?= $ugd['ugd']; ?></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>