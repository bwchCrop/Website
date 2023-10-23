<div class="col-md-12 adesco-footer">
	<div class="col-md-2" align="right">
		<h1>ADESCO</h1>
	</div>
	<div class="col-md-2" style="min-width: 170px; width: 16%; padding-left: 0px;">
		<ul class="list-group">
			<li class="list-group-item"><b>NAVIGATION</b></li>
			<li class="list-group-item"><a href="#">HOME</a></li>
			<li class="list-group-item"><a href="#">ABOUT US</a></li>
			<li class="list-group-item"><a href="#">NEWS & EVENT</a></li>
			<li class="list-group-item"><a href="#">CAREERS</a></li>
			<li class="list-group-item"><a href="#">CONTACT</a></li>
			<li class="list-group-item">&nbsp;</li>
			<li class="list-group-item back"><a href="#"><i class="glyphicon glyphicon-upload"></i> BACK TO TOP</a></li>
		</ul>
	</div>
	<div class="col-md-3">
		<ul class="list-group">
			<li class="list-group-item"><b>OUR BRANDS</b></li>
			<li class="list-group-item"><a href="#">BATAVIA SEKOTENG</a></li>
			<li class="list-group-item"><a href="#">BEBEK BENGIN</a></li>
			<li class="list-group-item"><a href="#">OCEAN STAR</a></li>
			<li class="list-group-item"><a href="#">BALI SEAFODD</a></li>
			<li class="list-group-item"><a href="#">ILLY</a></li>
			<li class="list-group-item"><a href="#">SALERO</a></li>
			<li class="list-group-item"><a href="#">TEA & PETALS</a></li>
		</ul>
	</div>
	<div class="col-md-5" align="right">
		<ul class="list-group">
			<li class="list-group-item"><b>FOLLOW OUR SOCIAL MEDIA</b></li>
			<li class="list-group-item">&nbsp;</li>
			<li class="list-group-item" style="padding-bottom: 50px;" align="right">
				<div class="col-sm-2 col-sm-offset-8">
					<a href="#"><div class="icon-facebook"></div></a>
				</div>
				<div class="col-sm-2">
					<a href="#"><div class="icon-instagram"></div></a>
				</div>
			</li>
			<li class="list-group-item">&nbsp;</li>
			<li class="list-group-item">&nbsp;</li>
			<li class="list-group-item">ALL RIGHT RESERVED</li>
			<li class="list-group-item"><b>Mahanaim Group Indonesia c 2016. Jakarta, Indonesia.</b></li>
		</ul>
	</div>
</div>
<script src="<?php echo base_url('assets/front/js/jquery.min.js');?>" ></script>
<script src="<?php echo base_url('assets/front/js/tether.min.js');?>" ></script>
<script src="<?php echo base_url('assets/front/js/bootstrap.min.js');?>" ></script>
<script type="text/javascript" src="<?php echo base_url('assets/front/slick/slick.min.js');?>" ></script>
<script type="text/javascript" src="<?php echo base_url('assets/front/js/jquery-migrate-1.2.1.min.js');?>"></script>
<script>
	jQuery(document).ready(function() {  
		var offset = 250;
		 
		var duration = 650;

		jQuery('.back').click(function(event) {
			event.preventDefault();
			jQuery('html, body').animate({scrollTop: 0}, duration);
			return false;
		})

		$('.adesco-autoplay-gallery').slick({
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  autoplay: true,
		  autoplaySpeed: 2000,
		  prevArrow: false,
    	  nextArrow: false,
		});

		$('button.prev').click(function(){
		    $(".adesco-autoplay-gallery").slick('slickPrev');
		});

		$('button.next').click(function(){
		    $(".adesco-autoplay-gallery").slick('slickNext');
		});

	    $(document).on('click','.our-brand-list',function(e){
	        e.preventDefault();
			var id = $(this).attr('adescoid');

	       	var main  = "<?php echo base_url('ourbrand/trans/');?>"+id;
			$("#adesco-section").load(main);
	    });
	});
</script>
