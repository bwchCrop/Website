<head lang="id">
  <title><?php echo _WEBTITLE; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="<?= substr("We started humbly as Brawijaya Women & Children Hospital on the 17th of September 2006, located in Antasari South Jakarta. Our commitment kept growing from providing healthcare services for Women & Children to expanding our services to General Hospitals in the most prominent areas. All the way from Jakarta to Bandung.", 0, 170); ?> ">

  <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('assets/img/favicon-bwch.ico'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/front/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/front/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/front/slick/slick.css'); ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('assets/front/slick/slick-theme.css'); ?>" type="text/css" />
  <!-- Bootstrap Material Timepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/bootstrap-material-datetimepicker.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/ripples.min.css'); ?>">

  <?php if(ENVIRONMENT === 'production'): ?>
    <link rel="stylesheet" href="<?= base_url('assets/front/css/revamp/styles.min.css?' . '202404'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/style.css?' . '202404'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/enhancements/style.css?' . '202404'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/style-2.css?' . '202404'); ?>">
  <?php else: ?>
    <link rel="stylesheet" href="<?= base_url('assets/front/css/revamp/styles.min.css?' . CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/style.css?' . CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/enhancements/style.css?' . CACHE_VERSION); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/front/css/style-2.css?' . CACHE_VERSION); ?>">
  <?php endif; ?>
  
  
  <!-- Sweetalert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">


  <script>
    const API_URL = '<?= API_URL ?>';
    const PROFILE_ENABLED = <?= intval(_ENABLE_PROFILE_DOCTOR ?? 0 )?>;
    const ENABLE_APPOINTMENT_ALL = <?= intval(_ENABLE_APPOINTMENT_ALL ?? 0 )?>;
  </script>

  <?php if (ENVIRONMENT === 'production') { ?>
    <!-- Google Tag Manager -->
    <script>
      (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
          'gtm.start': new Date().getTime(),
          event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s),
          dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', 'GTM-5LNTN3N');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Google Analytic -->
    <script>
      (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

      ga('create', 'UA-60584344-1', 'auto');
      ga('send', 'pageview');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
      ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '250334083195107');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=250334083195107&ev=PageView&noscript=1"></noscript>
    <!-- End Facebook Pixel Code -->
  <?php } ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>


  <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->


  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>