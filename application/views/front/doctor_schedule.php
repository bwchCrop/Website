<section class="content container-fluid">
	<div class="row container schedule">
		<div class="col-xs-12 header titleS" align="center">
			<h1 class="italic purple">DOCTOR'S SCHEDULE</h1>
		</div>

		<input id="tmGroupId" type="hidden" name="tmGroupId" value="<?= $idTm ?? '';  ?>"/>

		<div id="grouping_container">
			<?php if(empty($idTm)){?>
				<input id="grouping_predefined_id" type="hidden" name="grouping_predefined_id" value="2"/>
			<?php }else{ ?>
				<input id="grouping_predefined_id" type="hidden" name="grouping_predefined_id" value="<?php echo $idTm ?>"/>
			<?php }?>

			<?php if(empty($idTm)){?>
				<input id="rs_predefined_id" type="hidden" name="rs_predefined_id" value="0"/>
			<?php }else{ ?>
				<input id="rs_predefined_id" type="hidden" name="rs_predefined_id" value="<?php echo $idRS ?>"/>
			<?php }?>
			<div id="grouping_select_wrapper" class="select_item">
				<select id="grouping_select_dropdown"></select>
				<div id="rsButton"></div>
			</div>
			<div id="messageSchedule"></div>
			<div id="grouping_list"></div>
		</div>
	</div>
</section>