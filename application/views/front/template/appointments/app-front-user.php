<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo _WEBTITLE; ?> <?= $title? '| '.$title : ""; ?></title>

<link rel="stylesheet" href="<?= base_url('assets/bulma/css/bulma.min.css'); ?>">
<link href="https://cdn.datatables.net/v/bm/jq-3.6.0/dt-1.13.4/date-1.4.0/sb-1.4.2/sp-2.1.2/datatables.min.css" rel="stylesheet"/>
<script src="https://cdn.datatables.net/v/bm/jq-3.6.0/dt-1.13.4/date-1.4.0/sb-1.4.2/sp-2.1.2/datatables.min.js"></script>

<body class="is-block is-flex-tablet is-flex-direction-column is-justify-content-space-around" style="min-height: 100vh;">
<section class="section pt-4">
    <div class="container">
        <div class="content">
            <h4 class="title is-size-4 has-text-centered"><?= $title; ?></h4>
            <?php 
             $userdata = $this->session->userdata();
             $branch = $userdata['branch_name'] ?? null;
            ?>
            <?php if(!empty($branch)): ?>
             <form action="/appointment/logout" method="POST">
                 <button class="button is-small is-danger">Logout</button>
             </form>
            <?php endif; ?>
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
<script>
    $(document).ready(function () {
        $('#example').DataTable();
        
        setInterval(function() {
            window.location.reload();
        }, 300000);
    });
</script>
</html>
