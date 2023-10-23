<script>
	$(function() {
		$('.overlay').hide();

		<?php for($i=7; $i <= 15; $i++){ ?>
	        <?php  
	            switch ($i) {
	                case '7' : $titleC = 'home';       $result = $result_home; break;
	                case '8' : $titleC = 'about';      $result = $result_about; break;
	                case '9' : $titleC = 'location';   $result = $result_location; break;
	                case '10': $titleC = 'service';    $result = $result_service; break;
	                case '11': $titleC = 'schedule';   $result = $result_schedule; break;
	                case '12': $titleC = 'special';    $result = $result_special; break;
	                case '13': $titleC = 'membership'; $result = $result_membership; break;
	                case '14': $titleC = 'newsevent'; $result = $result_newsevent; break;
	                case '15': $titleC = 'newsevent'; $result = $result_ig_feed; break;
	                default: $titleC = ''; $result = $result_home; break;
	            }
	        ?>

			delete window.counter_<?php echo $titleC;?>;
			var count_<?php echo $i;?> = '<?php echo count($result);?>';
			if(count_<?php echo $i;?> > 0){ count_<?php echo $i;?> = count_<?php echo $i;?>; }else{ count_<?php echo $i;?> = '1'; }
			var counter_<?php echo $titleC;?> = count_<?php echo $i;?>;  

			$(document).on('click','#add-slide-<?php echo $i;?>',function(e){
				counter_<?php echo $titleC;?>++;
				if(counter_<?php echo $titleC;?>>20){
					alert("20 Picture Max.");
					counter_<?php echo $titleC;?>--;
					$("input[name=slide-<?php echo $i;?>-counter]").val(counter_<?php echo $titleC;?>);
					return false;
				}
				var table = $(".field-slide-<?php echo $i;?>").closest('div');
				// table.append('<div class="input-group input-group-<?php echo $i;?>-'+counter_<?php echo $titleC;?>+'" style="margin-bottom: 5px;"><input type="text" class="form-control" data-toggle="popover" data-trigger="hover focus" data-placement="top" title="Image" data-error=".result" id="slide-<?php echo $i;?>-'+counter_<?php echo $titleC;?>+'" name="slide-<?php echo $i;?>-'+counter_<?php echo $titleC;?>+'" ><div class="input-group-btn"><a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=slide-'.$i.'-'); ?>'+counter_<?php echo $titleC;?>+'<?php echo '&akey='._AKEY;?>" class="iframe-btn" title="File Manager">Browse</a></div></div>');

				table.append('<div class="col-xs-12 input-group-<?php echo $i;?>-'+counter_<?php echo $titleC;?>+'" style="padding:0;"><div class="col-sm-6"><div class="input-group" style="margin-bottom: 5px;"><input type="text" class="form-control" data-toggle="popover" data-trigger="hover focus" data-placement="top" title="Image" data-error=".result" id="slide-<?php echo $i;?>-'+counter_<?php echo $titleC;?>+'" name="slide-<?php echo $i;?>-'+counter_<?php echo $titleC;?>+'" ><div class="input-group-btn"><a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=slide-'.$i.'-'); ?>'+counter_<?php echo $titleC;?>+'<?php echo '&akey='._AKEY;?>" class="iframe-btn" title="File Manager">Browse</a></div></div></div> <div class="col-sm-4" <?php echo ($i != 7)?"style=\"visibility:hidden;\"":""; ?> ><div class="col-xs-12 input-group" style="margin-bottom: 5px;"><input type="text" class="form-control" placeholder="Image URL" id="slideurl-<?php echo $i;?>-'+counter_<?php echo $titleC;?>+'" name="slideurl-<?php echo $i;?>-'+counter_<?php echo $titleC;?>+'"></div></div> <div class="col-sm-2" <?php echo ($i != 7)?"style=\"visibility:hidden;\"":""; ?> ><div class="col-xs-12 input-group" style="margin-bottom: 5px;"><input type="date" class="form-control" placeholder="" id="slidedate-<?php echo $i;?>-'+counter_<?php echo $titleC;?>+'" name="slidedate-<?php echo $i;?>-'+counter_<?php echo $titleC;?>+'"></div></div> </div>');

                $('[data-toggle="popover"]').popover({
                    html: true,
                    content: function(){return '<img style="width:100%;" src="'+$(this).val() +'" />';}
                })

				$("input[name=slide-<?php echo $i;?>-counter]").val(counter_<?php echo $titleC;?>);
			});
		<?php } ?>

		$(document).on('click','.del-slide',function(e){
			var numb = $(this).attr('number');
			var pk = $(this).attr('pk');

			$(".input-group-"+pk+'-'+numb).remove();
		});  
	});
</script>