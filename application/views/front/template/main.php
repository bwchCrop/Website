<!DOCTYPE html>
<!ELEMENT h1  %Inline;>
<!ENTITY % Inline "(#PCDATA | %inline; | %misc.inline;)*">
<!ENTITY % inline "a | %special; | %fontstyle; | %phrase; | %inline.forms;">
<!ENTITY % special "%special.pre; | object | img ">
<html>
	<?php $this->load->view('front/template/head_load');?>
	<?php $this->load->view('front/template/head2'); ?>
<body>
	<?php if(ENVIRONMENT === 'production') {?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5LNTN3N"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php } ?>

    <?php $this->load->view($content); ?>
</body>
	<?php $this->load->view('front/template/foot'); ?>
	<?php $this->load->view('front/template/foot_load');?>	
</html>