<div class="container-fluid view-wizard">
	<?php 
		$id = $idmenu;

		$typeList = array(
							'0'	=> 'int',
							'1'	=> 'varchar',
							'2' => 'char',
							'3' => 'date',
							'4' => 'datetime (Not Yet)',
							'5' => 'longtext',
						 );

		$elementList = array(
								'0'	=> 'text',
								'1' => 'hidden',
								'2'	=> 'textarea',
								'3' => 'tinymce',
								'4' => 'date',
								'5' => 'dropdown (Not Yet)',
								'6' => 'imageupload (Not Yet)',
								'7' => 'fileupload (Not Yet)',
								'8' => 'checkbox',
								'9' => 'date_now',
								'10'=> 'user_session',
								'11'=> 'not_visible',
						 	); 	
 	
		$pageList = array(
							'1' => 'Main - View',
							'2' => 'Add - View',
							'3' => 'Edit - View',
							'4' => 'Preview - View',
							'5' => 'Delete - View',
						 );
 	?>
	
	<?php if($tempstep == '1'){ ?>
		<?php

			$where = _PREFIX.'menutemp.menutemp_menu_id = \''.$id.'\' AND '._PREFIX.'menutemp.menutemp_temp_step = \''.$tempstep.'\' AND '._PREFIX.'menutemp.menutemp_id < \''.$id.$tempstep.'97\'';
			$checkTempStep = $this->mtempmenu->getByWhere($where)->result_array();

			$where = _PREFIX.'menutemp.menutemp_menu_id = \''.$id.'\' AND '._PREFIX.'menutemp.menutemp_temp_step = \''.$tempstep.'\' AND '._PREFIX.'menutemp.menutemp_id > \''.$id.$tempstep.'96\'';
			$checkTempStep2 = $this->mtempmenu->getByWhere($where)->result_array();

			if(count($checkTempStep) > 0){
				$result = $checkTempStep;
				$result2 = $checkTempStep2;
			}else{
				$result = array(
								'0' => array(
												'menutemp_id' 			=> '',
												'menutemp_menu_id'		=> '',
												'menutemp_temp_step'	=> '',
												'menutemp_field_1'		=> '',
												'menutemp_field_2'		=> '',
												'menutemp_field_3'		=> '',
												'menutemp_field_4'		=> '',
												'menutemp_field_5'		=> '',
												'menutemp_field_6'		=> '',												
										    ),
							   );

				$result2 = '';
			}
		?>
		<div class="row row-database" align="center">
			<div class="box" align="left">
			    <div class="box-header" align="left">
			        <?php echo $this->session->flashdata('message');?>
                    <h3 class="box-title">&nbsp;View Wizard - Data List</h3> 
			    </div>

			    <hr class="separator">

		        <div class="box-body">
				    <i style="color:red;">*primary key will automatically added (datatype : int AUTO_INCREMENT)</i>
		        	<table class="table table-bordered" style="margin: 10px 0px;">  
		        		<thead>
		        			<tr>
		        				<td width="1%" class="no-right"></td>
		        				<td width="30%">Field</td>
		        				<td width="20%">Type</td>
		        				<td width="25%">Element</td>
		        				<td width="15">Length</td>
		        				<td width="5%">NULL</td>
		        				<td width="5%">Show</td>
		        			</tr>
		        		</thead>
	        			<input type="hidden" name="field-counter" id="field-counter">
	        			<input type="hidden" name="menu-id" id="menu-id" value="<?php echo $id;?>">
	        			<input type="hidden" name="temp-step" id="temp-step" value="<?php echo $tempstep;?>">
		        		<tbody class="tbody">
		        			<?php $n = 0; foreach($result as $row){ $n++;?>
							<tr>
								<td class="no-right" align="center">
									<a href="javascript:void(0);" class="delete close" counter="<?php echo ($n-1);?>"><i class="fa fa-close" ></i></a>
								</td>
		        				<td align="center">
		        					<input type="text" class="form-control value" name="value-<?php echo $n;?>" id="value-<?php echo $n;?>" value="<?php echo $row['menutemp_field_1'] ?>"/>
		        				</td>
		        				<td align="center">
		        					<select class="form-control type" name="type-<?php echo $n;?>" id="type-<?php echo $n;?>">
		        						<?php for($i=0;$i<count($typeList);$i++){ if($row['menutemp_field_2'] == $typeList[$i]){ $option = 'selected';}else{ $option = '';} ?>
		        						<option value="<?php echo $typeList[$i];?>" <?php echo $option;?> > <?php echo $typeList[$i];?></option>
		        						<?php } ?>
		        					</select>
		        				</td>
		        				<td align="center">
		        					<select type="text" class="form-control element" name="element-<?php echo $n;?>" id="element-<?php echo $n;?>">
		        						<?php for($i=0;$i<count($elementList);$i++){ if($row['menutemp_field_3'] == $i){ $option = 'selected';}else{ $option = '';}  ?>
		        						<option value="<?php echo $i;?>" <?php echo $option;?> > <?php echo $elementList[$i];?></option>
		        						<?php } ?>
		        					</select>
		        				</td>
		        				<td align="center">
		        					<input type="text" class="form-control length" name="length-<?php echo $n;?>" id="length-<?php echo $n;?>" value="<?php echo $row['menutemp_field_4'] ?>"/>
		        				</td>
		        				<td align="center">
		        					<?php if($row['menutemp_field_5'] == '0'){ $option = 'checked';}else{ $option = '';}  ?>
		        					<input type="checkbox" class="minimal mandatory" name="mandatory-<?php echo $n;?>" id="mandatory-<?php echo $n;?>" <?php echo $option;?>/>
		        				</td>
		        				<td align="center">
		        					<?php if($row['menutemp_field_6'] == '1'){ $option = 'checked';}else{ $option = '';}  ?>
		        					<input type="checkbox" class="minimal table" name="table-<?php echo $n;?>" id="table-<?php echo $n;?>" <?php echo $option;?>/>
		        				</td>
		        			</tr>	
		        			<?php } ?>	
		        		</tbody>
		        		<tbody class="tbody-dummy" style="border-top: 0px;">
							<tr>
								<td class="no-right" align="center">
								</td>
		        				<td align="center">
		        					<input type="text" class="form-control" name="dummy-1a" id="dummy-1a" value="Status" disabled="disabled" />
		        				</td>
		        				<td align="center">
		        					<select class="form-control type" name="dummy-1b" id="dummy-1b" disabled="disabled">
		        						<option value="char" selected>char</option>
		        					</select>
		        				</td>
		        				<td align="center">
		        					<?php if($result2 != ''){ if($result2[0]['menutemp_field_3'] == '8'){ $opt = 'selected'; }else{ $opt = ''; } }else{ $opt = ''; }?>
		        					<select class="form-control element" name="dummy-1c" id="dummy-1c">
		        						<option value="11">not_visible</option>
		        						<option value="8" <?php echo $opt;?> >checkbox</option>
		        					</select>
		        				</td>
		        				<td align="center">
		        					<input type="text" class="form-control length" name="dummy-1d" id="dummy-1d" value="1" disabled="disabled" />
		        				</td>
		        				<td align="center">
		        					<input type="checkbox" class="minimal mandatory" name="dummy-1e" id="dummy-1e" disabled="disabled" checked />
		        				</td>
		        				<td align="center">
		        					<?php if($result2 != ''){ if($result2[0]['menutemp_field_6'] == '1'){ $tbl = 'checked'; }else{ $tbl = ''; } }else{ $tbl = '';}?>
		        					<input type="checkbox" class="minimal table" name="dummy-1f" id="dummy-1f" <?php echo $tbl;?>/>
		        				</td>
		        			</tr>

							<tr>
								<td class="no-right" align="center">
								</td>
		        				<td align="center">
		        					<input type="text" class="form-control" name="dummy-2a" id="dummy-2a" value="Update by" disabled="disabled" />
		        				</td>
		        				<td align="center">
		        					<select class="form-control type" name="dummy-2b" id="dummy-2b" disabled="disabled">
		        						<option value="varchar" selected>varchar</option>
		        					</select>
		        				</td>
		        				<td align="center">
		        					<select class="form-control element" name="dummy-2c" id="dummy-2c" disabled="disabled">
		        						<option value="user_session" selected>user_session</option>
		        					</select>
		        				</td>
		        				<td align="center">
		        					<input type="text" class="form-control length" name="dummy-2d" id="dummy-2d" value="50" disabled="disabled" />
		        				</td>
		        				<td align="center">
		        					<input type="checkbox" class="minimal mandatory" name="dummy-2e" id="dummy-2e" disabled="disabled"/>
		        				</td>
		        				<td align="center">
		        					<?php if($result2 != ''){ if($result2[1]['menutemp_field_6'] == '1'){ $tbl = 'checked'; }else{ $tbl = ''; } }else{ $tbl = '';}?>
		        					<input type="checkbox" class="minimal table" name="dummy-2f" id="dummy-2f" <?php echo $tbl;?>/>
		        				</td>
		        			</tr>

							<tr>
								<td class="no-right" align="center">
								</td>
		        				<td align="center">
		        					<input type="text" class="form-control" name="dummy-3a" id="dummy-3a" value="Update Date" disabled="disabled" />
		        				</td>
		        				<td align="center">
		        					<select class="form-control type" name="dummy-3b" id="dummy-3b" disabled="disabled">
		        						<option value="datetime" selected>datetime</option>
		        					</select>
		        				</td>
		        				<td align="center">
		        					<select class="form-control element" name="dummy-3c" id="dummy-3c" disabled="disabled">
		        						<option value="date_now" selected>date_now</option>
		        					</select>
		        				</td>
		        				<td align="center">
		        					<input type="text" class="form-control length" name="dummy-3d" id="dummy-3d" value="" disabled="disabled" />
		        				</td>
		        				<td align="center">
		        					<input type="checkbox" class="minimal mandatory" name="dummy-3e" id="dummy-3e" disabled="disabled"/>
		        				</td>
		        				<td align="center">
		        					<?php if($result2 != ''){ if($result2[2]['menutemp_field_6'] == '1'){ $tbl = 'checked'; }else{ $tbl = ''; } }else{ $tbl = '';}?>
		        					<input type="checkbox" class="minimal table" name="dummy-3f" id="dummy-3f" <?php echo $tbl;?>/>
		        				</td>
		        			</tr>
		        		</tbody>
		        	</table>
		        	<a href="javascript:void(0);" style="width: 100%;" class="btn btn-default" id="add-field">Add More</a>
		        </div>

		        <div class="box-footer">
		            <input type="button" name="submitNext" class="btn bg-navy pull-right navigation-page" value="Next">
		        </div>  
			</div>
		</div>
	<?php }elseif($tempstep == '2'){ ?>
		<?php
			$where = _PREFIX.'menutemp.menutemp_menu_id = \''.$id.'\' AND '._PREFIX.'menutemp.menutemp_temp_step = \''.$tempstep.'\'';
			$checkTempStep = $this->mtempmenu->getByWhere($where)->result_array();

			if(count($checkTempStep) > 0){
				$result = $checkTempStep;
			}else{
				$result = array(
								'0' => array(
												'menutemp_id' 			=> '',
												'menutemp_menu_id'		=> '',
												'menutemp_temp_step'	=> '',
												'menutemp_field_1'		=> '',
												'menutemp_field_2'		=> '',
												'menutemp_field_3'		=> '',
												'menutemp_field_4'		=> '',
												'menutemp_field_5'		=> '',
												'menutemp_field_6'		=> '',												
										    ),
							   );
			}
		?>
		<div class="row row-view" align="center">
			<div class="box" align="left">
			    <div class="box-header" align="left">
			        <?php echo $this->session->flashdata('message');?>
                    <h3 class="box-title">&nbsp;View Wizard - Choose View List</h3> 
			    </div>

			    <hr class="separator">

		        <div class="box-body">
        			<input type="hidden" name="menu-id" id="menu-id" value="<?php echo $id;?>">
        			<input type="hidden" name="temp-step" id="temp-step" value="<?php echo $tempstep;?>">
		        	
		        	<div class="col-xs-12">
			        	<div class="form-group">
		   					<input type="checkbox" class="minimal" name="main" id="main" checked disabled/>&nbsp;&nbsp;&nbsp;Main - View
			        	</div>
			        	<div class="form-group">
			        		<?php if($result[0]['menutemp_field_2'] > 0){$option = 'checked'; $col='in';}else{$option = ''; $col='';} ?>
		   					<input type="checkbox" class="minimal" name="add" id="add" <?php echo $option;?>/>&nbsp;&nbsp;&nbsp;Add - View
				        	<div class="collapse col-xs-12 <?php echo $col;?>" id="add-option">
							  <div class="well">
							  	<?php 
							  		  $option1 = ''; $option2 = '';
							  		  if($result[0]['menutemp_field_2'] == 1){
							  			$option1 = 'checked'; $option2 = '';
							  		  }elseif($result[0]['menutemp_field_2'] == 2){
							  		  	$option1 = ''; $option2 = 'checked';
							  		  }
							  	?>
					        	<div class="form-group">
				   					<input type="radio" class="minimal" name="addview" id="addview" value="0" <?php echo $option1;?>/>&nbsp;&nbsp;&nbsp;One Page
					        	</div>
					        	<div class="form-group">
				   					<input type="radio" class="minimal" name="addview" id="addview" value="1" disabled="disabled"/><?php echo $option2;?>&nbsp;&nbsp;&nbsp;Modal Page (Not Yet)
					        	</div>
							  </div>
							</div>
			        	</div>
			        	<div class="form-group">
			        		<?php if($result[0]['menutemp_field_3'] > 0){$option = 'checked';}else{$option = '';} ?>
		   					<input type="checkbox" class="minimal" name="edit" id="edit" <?php echo $option;?>/>&nbsp;&nbsp;&nbsp;Edit - View
			        	</div>
			        	<div class="form-group">
			        		<?php if($result[0]['menutemp_field_4'] > 0){$option = 'checked';}else{$option = '';} ?>
		   					<input type="checkbox" class="minimal" name="preview" id="preview" <?php echo $option;?>/>&nbsp;&nbsp;&nbsp;Preview - View
			        	</div>
			        	<div class="form-group">
			        		<?php if($result[0]['menutemp_field_5'] > 0){$option = 'checked';}else{$option = '';} ?>
		   					<input type="checkbox" class="minimal" name="delete" id="delete" <?php echo $option;?>/>&nbsp;&nbsp;&nbsp;Delete - View
			        	</div>		        		
		        	</div>
		        </div>

		        <div class="box-footer">
		            <input type="button" name="submitBack" class="btn bg-orange pull-left navigation-page" value="Back">
		            <input type="button" name="submitNext" class="btn bg-navy pull-right navigation-page" value="Next">
		        </div>  
			</div>
		</div>
	<?php }else{ ?>
		<?php 
			$where = _PREFIX.'menutemp.menutemp_menu_id = \''.$id.'\' AND '._PREFIX.'menutemp.menutemp_temp_step = \'1\'';
			$checkTempStep1 = $this->mtempmenu->getByWhere($where)->result_array();

			$where = _PREFIX.'menutemp.menutemp_menu_id = \''.$id.'\' AND '._PREFIX.'menutemp.menutemp_temp_step = \'2\'';
			$checkTempStep2 = $this->mtempmenu->getByWhere($where)->row_array();
		?>
		<div class="row row-confirmation" align="center">
			<div class="box" align="left">
			    <div class="box-header" align="left">
			        <?php echo $this->session->flashdata('message');?>
                    <h3 class="box-title">&nbsp;View Wizard - Confirmation : Create View</h3> 
			    </div>

			    <hr class="separator">

		        <div class="box-body">
        			<input type="hidden" name="menu-id" id="menu-id" value="<?php echo $id;?>">
        			<input type="hidden" name="temp-step" id="temp-step" value="<?php echo $tempstep;?>">
		        
        			<div class="col-xs-12" align="center">
        				<h1><i class="fa fa-magic"></i></h1>
        				<h1>Finishing up...</h1>
        			</div>
		        </div>

		        <div class="box-footer">
		            <input type="button" name="submitBack" class="btn bg-orange pull-left navigation-page" value="Back">
		            <input type="button" name="submitNext" class="btn btn-success pull-right navigation-page" value="Create View">
		        </div>  
			</div>
		</div>
	<?php } ?>
</div>

<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<script>
	function autoSave(){
    	var menuid 		= $('#menu-id').val();
    	var tempstep 	= $('#temp-step').val();

		if(tempstep == '1'){
    		var nil 		= 0;
	    	var value 		= [];
	    	var type 		= [];
	    	var element 	= [];
	    	var length  	= [];
	    	var mandatory 	= [];
	    	var table 		= [];

	    	var tbl_stat	 = 0;
	    	var tbl_upd_by	 = 0;
	    	var tbl_upd_date = 0;
	    	var stat_element = $("#dummy-1c").val();

	    	if($("#dummy-1f").is(":checked")){
	    		tbl_stat		= 1;
	    	}

	    	if($("#dummy-2f").is(":checked")){
	    		tbl_upd_by		= 1;
	    	}

	    	if($("#dummy-3f").is(":checked")){
	    		tbl_upd_date	= 1;
	    	}

	    	$('.value').each(function(i){
	    		var z = i + 1;

	    		value[i] 	= $("#value-"+z).val();
	    	 	type[i]	 	= $("#type-"+z).val();
	    	 	element[i]	= $("#element-"+z).val();
	    	 	length[i]	= $("#length-"+z).val();

	    	 	if($("#mandatory-"+z).is(":checked")){
	    	 		mandatory[i] = 0;
	    	 	}else{
	    	 		mandatory[i] = 1;
	    	 	}

	    	 	if($("#table-"+z).is(":checked")){
	    	 		table[i] = 1;
	    	 	}else{
	    	 		table[i] = 0;
	    	 	}

	    		nil++;
	    	});

			$.post(
				'<?php echo base_url("admin/tempmenu/saveTemp");?>',
				{menuid:menuid, tempstep:tempstep, field:value, type:type, element:element, length:length, nullval:mandatory, show:table, stat_element:stat_element, tbl_stat:tbl_stat, tbl_upd_by:tbl_upd_by, tbl_upd_date:tbl_upd_date},
				function(data){
					//console.log(data);
					var s = data;
				}
			);
		}else if(tempstep == '2'){
			var page;
			var field1 = 0;
			var field2 = 0;
			var field3 = 0;
			var field4 = 0;
			var field5 = 0;
			var field6 = 0;

    	 	if($("#add").is(":checked")){
    	 		if($("#addview:checked").val() == 0){
    	 			page = 1;
    	 		}else{
    	 			page = 2;
    	 		}

    	 		field2 = page;
    	 	}else{
    	 		page = 1;
    	 	}

    	 	if($("#main").is(":checked")){ 		field1 = 1;}
    	 	if($("#delete").is(":checked")){ 	field5 = 1;}
    	 	if($("#edit").is(":checked")){ 		field3 = page;}
    	 	if($("#preview").is(":checked")){ 	field4 = page;}

			$.post(
				'<?php echo base_url("admin/tempmenu/saveTemp");?>',
				{menuid:menuid, tempstep:tempstep, field1:field1, field2:field2, field3:field3, field4:field4, field5:field5, field6:field6},
				function(data){
					console.log(page);
					var s = data;
				}
			);
		}
	}

	$(function() {
	  	delete window.counter;

	  	var save;
	  	var counter;
	  	var count_field = '<?php echo count($result);?>';
    	var triggeredByChild = false;

		save = setInterval(autoSave,15000);
	  	
	  	if(count_field > 0){ count_field = count_field;}else{ count_field = '1';}
	  	counter = count_field;  

	  	$(document).on('click','#add-field',function(e){
	      	counter++;
	      	if(counter>25){
	          	alert("15 Field Max.");
	          	counter--;
	          	$("input[name=field-counter]").val(counter);
	          	return false;
	      	}
	      
	      	var table = $(".tbody").closest('tbody');

	      	table.append('<tr><td class="no-right" align="center"><a href="javascript:void(0);" class="delete close" counter="'+(counter-1)+'"><i class="fa fa-close"></i></a></td><td align="center"><input type="text" class="form-control value" name="value-'+counter+'" id="value-'+counter+'" value=""/></td><td align="center"><select class="form-control type" name="type-'+counter+'" id="type-'+counter+'"><?php for($i=0;$i<count($typeList);$i++){ ?><option value="<?php echo $typeList[$i];?>"><?php echo $typeList[$i];?></option><?php } ?></select></td><td align="center"><select type="text" class="form-control element" name="element-'+counter+'" id="element-'+counter+'"><?php for($i=0;$i<count($elementList);$i++){?><option value="<?php echo $i;?>"><?php echo $elementList[$i];?></option><?php } ?></select></td><td align="center"><input type="text" class="form-control length" name="length-'+counter+'" id="length-'+counter+'" value=""/></td><td align="center"><input type="checkbox" class="minimal mandatory" name="mandatory-'+counter+'" id="mandatory-'+counter+'" checked/></td><td align="center"><input type="checkbox" class="minimal table" name="table-'+counter+'" id="table-'+counter+'"/></td></tr>');

	      	$("input[name=field-counter]").val(counter);

	      	start_icheck();
	  	});

	  	$(document).on('click','.navigation-page',function(e){
	  		$('.overlay').show();
			clearInterval(save);
			//console.log("interval stopped!");

			var menuid 	= $('#menu-id').val();
			var url     = '<?php echo $this->uri->segment(1);?>';
			var nav 	= $(this).val();

			if(nav == 'Next'){
				autoSave();

				$.post(
					'<?php echo base_url();?>'+'admin-tempnavigation-next' ,
					{menuid: menuid},
					function(data){
						console.log(data);
						window.location.href = "<?php echo base_url('');?>"+url;
					}
				);
			}else if(nav == 'Back'){
				autoSave();

				$.post(
					'<?php echo base_url();?>'+'admin-tempnavigation-back' ,
					{menuid: menuid},
					function(data){
						console.log(data);
						window.location.href = "<?php echo base_url('');?>"+url;
					}
				);
			}else{
				$.post(
					'<?php echo base_url();?>'+'admin-tempnavigation-finish' ,
					{menuid: menuid},
					function(data){
						console.log(data);
						window.location.href = "<?php echo base_url('');?>"+url;
					}
				);
			}
	  	});

	  	$(document).on('click','.delete',function(e){
	  		$('.overlay').show();
			clearInterval(save);

	    	var menuid 		= $('#menu-id').val();
	    	var tempstep 	= $('#temp-step').val();
			var counter		= $(this).attr('counter');
			var url     	= '<?php echo $this->uri->segment(1);?>';
    		var answer 		= confirm("Are you sure delete this field? ");

			if(answer) {
				$.post(
					'<?php echo base_url();?>'+'admin-tempdelete' ,
					{menuid: menuid, tempstep: tempstep, counter: counter},
					function(data){
						//console.log(data);
						window.location.href = "<?php echo base_url('');?>"+url;
					}
				);
			}else{
	  			$('.overlay').hide();
			}
	  	});

	    $(document).on('ifChecked','.minimal',function (e) {
	    	var value = $(this).attr('name');

    		$('#'+value+'-option').collapse('show');

	        triggeredByChild = false;
	    });

	    $(document).on('ifUnchecked','.minimal',function (e) {
	    	var value = $(this).attr('name');

	        if (!triggeredByChild) {
	    		$('#'+value+'-option').collapse('hide');
	        }

	        triggeredByChild = false;
	    });
	})
</script>