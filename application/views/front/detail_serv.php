<?php if($load == 'detail_services'){ ?>

	<div class="col-xs-12 header titleS">
		<div class="col-xs-12 no-pad header-title" align="center">
			<h1 class="italic purple"><?php echo $resultData['post_title'];?></h3>
		</div>
	</div>	

	<div class="col-xs-12 content coe" align="left">
		<?php 
			$print = '';

			$content 		= $resultData['content'];
			$splitContent 	= explode('<hr />', $content); 

			if(count($splitContent) > 1){
				$print .= $splitContent[0];

				$print .= '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
				for($i=1;$i<count($splitContent);$i++){
					$exSplitContent = explode('<h1>', $splitContent[$i]);
					$exSplitImage   = explode('src="', $splitContent[$i]);

					if(count($exSplitContent) > 1){
						$endSplitContent= explode('</h1>', $exSplitContent[1]);
						$collpaseTitle  = $endSplitContent[0];

						if(count($exSplitImage)>1){
							$endSplitImage  = explode('"', $exSplitImage[1]);
							$link 			= $endSplitImage[0];
						}else{
							$endSplitImage  = '';
							$link 			= '';
						}

						if($i == 1){
							$collpased = '';
							$in 	   = 'in';
						}else{
							$collpased = 'class="collpased"';
							$in 	   = '';
						}

					  	$print .= '<div class="panel panel-default">';
						$print .= '    <div class="panel-heading" role="tab" id="heading'.$i.'">';
						$print .= '	      <h4 class="panel-title">';
						$print .= '	        <a '.$collpased.' role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'" aria-expanded="true" aria-controls="collapse'.$i.'">';
						$print .= '	         	'.$collpaseTitle;
						$print .= '	        </a>';
						$print .= '	      </h4>';
						$print .= '    </div>';
						$print .= '    <div id="collapse'.$i.'" class="panel-collapse collapse '.$in.'" role="tabpanel" aria-labelledby="heading'.$i.'">';
						$print .= '	      <div class="panel-body">';
						$print .= '			  <div class="col-xs-12 no-pad"><img class="mobile" src="'.$link.'" width="100%"></div>';
						$print .= '	          '.$splitContent[$i]; 
						$print .= '	      </div>';
						$print .= '    </div>';
					  	$print .= '</div>';
					}
				}
				$print .= '</div>';
			}else{
				$print .= $content;
			}

			echo $print;
		?>
	</div>

	<?php if(count($resultImage) > 1){ ?>
		<div class="col-xs-12 slider-newsevent">
			<div class="col-xs-12 slider-for">
			<?php foreach($resultImage as $row){ ?>
				<div class="col-sm-12">
					<img src="<?php echo $row['postpicture'];?>" width="100%">
				</div>		
			<?php } ?>
			</div>

			<div class="col-xs-12 slider-nav">
			<?php foreach($resultImage as $row){ ?>
				<div class="col-sm-3">
					<img src="<?php echo $row['postpicture'];?>" width="100%">
				</div>
			<?php } ?>
			</div>
		</div>
	<?php }else{ ?>
		<div class="col-xs-12">
			<?php foreach($resultImage as $row){ ?>
			<div class="col-xs-12 no-pad">
				<img src="<?php echo $row['postpicture'];?>" width="100%">
			</div>
			<?php } ?>
		</div>
	<?php } ?>


	<div class="col-xs-12 header">
		<div class="col-xs-12 no-pad header-title" align="center">
			<h1 class="italic purple">Services</h3>
		</div>
	</div>
	<div class="col-xs-12 no-pad">
		<?php foreach($service as $row){ ?>
		<div class="col-sm-4 no-pad-left curs-point" onclick="loadDivPage('services','detail_services','<?php echo $row['post_id'];?>')">
			<div class="col-xs-12 service-list no-pad">
				<div class="container-image" align="center" style="padding-top: 37.5%;color: white;font-family: 'Quenda';font-size: 1.5em;/*font-family: 'Museo Sans 900';font-size: 1.25em;*/letter-spacing: 1px;">
					<b><?php echo strtoupper(str_replace(' (', '<br>(',$row['post_title']));?></b>
				</div>
				<img src="<?php echo $row['thumbnail'];?>">
			</div>						
		</div>
		<?php } ?>
	</div>
	
<?php } ?>
