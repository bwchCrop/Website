<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('front/template/appointments/head') ?>

<body class="is-block is-flex-tablet is-flex-direction-column is-justify-content-space-around" style="min-height: 100vh;">
<section class="section pt-4">
    <div class="container">
        <div class="content">
            <h4 class="title is-size-4 has-text-centered"><?= $title; ?></h4>
        </div>

        <?php $this->load->view($content); ?>
    </div>
</section>
<footer class="footer pb-1 py-2 mt-auto mb-0">
    <div class="content has-text-centered">
        <a href="<?= base_url(); ?>" class="is-block has-text-centered">
            <img width="300" height="40" src="<?= base_url('assets/img/logo/logo_bw_transparent.png'); ?>" alt="Brawijaya Hospital">
        </a>
        <p class="is-size-7">
            © <?= date('Y'); ?> Copyright Brawijaya Hospital
        </p>
    </div>
</footer>
</body>
<?php $this->load->view('front/template/appointments/foot') ?>
</html>