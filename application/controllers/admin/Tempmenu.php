<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tempmenu extends CI_Controller {

	function __construct(){
		parent::__construct();

		if($this->session->userdata(_PREFIX.'login') == FALSE){
			redirect('admin-log-in');
		}
	}

	public function index(){
		if($this->session->userdata(_PREFIX.'login') == TRUE){
			$data = array(
							'content'  	=> 'admin/tempmenu',
							'menu'		=> $this->mmenu->getParent()->result_array(),
							'titlebar' 	=> 'Admin | Temporary Menu',
							'title'	   	=> 'Temporary Menu',
							'result'   	=> '',//$this->mchildsubmisc->getAll()->result_array(),
							'js'		=> ''
						);

			$this->load->view('template/main', $data);
		}else{
			redirect('admin-log-in');
		}
	}

	function saveTemp(){
		$menuid  = $this->input->post('menuid');
		$tempstep= $this->input->post('tempstep');

		if($tempstep == '1'){
			$field 	 = $this->input->post('field');
			$type 	 = $this->input->post('type');
			$element = $this->input->post('element');
			$length  = $this->input->post('length');
			$null 	 = $this->input->post('nullval');
			$show 	 = $this->input->post('show');

			for($i=0;$i<count($field);$i++){
				$id = $menuid.$tempstep.$i;

				$data = array(
								'menutemp_id' 		=> $id,
								'menutemp_menu_id' 	=> $menuid,
								'menutemp_temp_step'=> $tempstep,
								'menutemp_field_1'	=> $field[$i],
								'menutemp_field_2'	=> $type[$i],
								'menutemp_field_3'	=> $element[$i],
								'menutemp_field_4'	=> $length[$i],
								'menutemp_field_5'	=> $null[$i],
								'menutemp_field_6'	=> $show[$i],
							 );

				if($menuid == '' OR $field[$i] == ''){
					$insert = '';

					echo 'Empty Save Temp!';
				}else{
					$where = 'menutemp_id = \''.$id.'\'';
					$checkMenu = $this->mtempmenu->getBywhere($where)->row_array();

					if(count($checkMenu) > 0){
						$delete = $this->mtempmenu->delete(NULL,array('menutemp_id' => $id,));
					}

					$insert = $this->mtempmenu->insert($data);
				
					print_r($data);
				}
			}

			$i = 96;
			for($n=1;$n<4;$n++){ $i++;
				$id = $menuid.$tempstep.$i;

				if($i == 97){
					$field_1 = 'Status';
					$field_2 = 'char';
					$field_3 = $this->input->post('stat_element');
					$field_4 = '1';
					$field_5 = '0';
					$field_6 = $this->input->post('tbl_stat');
				}elseif($i == 98){
					$field_1 = 'Update By';
					$field_2 = 'varchar';
					$field_3 = '10';
					$field_4 = '50';
					$field_5 = '1';
					$field_6 = $this->input->post('tbl_upd_by');
				}else{
					$field_1 = 'Update Date';
					$field_2 = 'datetime';
					$field_3 = '9';
					$field_4 = '';
					$field_5 = '1';
					$field_6 = $this->input->post('tbl_upd_date');					
				}

				$data = array(
								'menutemp_id' 		=> $id,
								'menutemp_menu_id' 	=> $menuid,
								'menutemp_temp_step'=> $tempstep,
								'menutemp_field_1'	=> $field_1,
								'menutemp_field_2'	=> $field_2,
								'menutemp_field_3'	=> $field_3,
								'menutemp_field_4'	=> $field_4,
								'menutemp_field_5'	=> $field_5,
								'menutemp_field_6'	=> $field_6,
							 );

				$where = 'menutemp_id = \''.$id.'\'';
				$checkMenu = $this->mtempmenu->getBywhere($where)->row_array();

				if(count($checkMenu) > 0){
					$delete = $this->mtempmenu->delete(NULL,array('menutemp_id' => $id,));
				}

				$insert = $this->mtempmenu->insert($data);
			}
		}elseif($tempstep == '2'){
			$id 	= $menuid.$tempstep.'0';
			$field1 = $this->input->post('field1');
			$field2 = $this->input->post('field2');
			$field3 = $this->input->post('field3');
			$field4 = $this->input->post('field4');
			$field5 = $this->input->post('field5');
			$field6 = $this->input->post('field6');

			$data = array(
							'menutemp_id' 		=> $id,
							'menutemp_menu_id' 	=> $menuid,
							'menutemp_temp_step'=> $tempstep,
							'menutemp_field_1'	=> $field1,
							'menutemp_field_2'	=> $field2,
							'menutemp_field_3'	=> $field3,
							'menutemp_field_4'	=> $field4,
							'menutemp_field_5'	=> $field5,
							'menutemp_field_6'	=> $field6,
						 );

			$where = 'menutemp_id = \''.$id.'\'';
			$checkMenu = $this->mtempmenu->getBywhere($where)->row_array();

			if(count($checkMenu) > 0){
				$execution = $this->mtempmenu->update($id,$data);
			}else{
				$execution = $this->mtempmenu->insert($data);
			}

			print_r($data);
		}else{

		}
	}

	function deleteTemp(){
		$menuid  = $this->input->post('menuid');
		$tempstep= $this->input->post('tempstep');
		$counter = $this->input->post('counter');

		if($counter != NULL){
			$id = $menuid.$tempstep.$counter;

			$checkField = $this->mtempmenu->getById($id)->row_array();

			if(count($checkField) > 0){
				$delete = $this->mtempmenu->delete($id);
			}

			echo $id;
		}
	}

	function navigation($index = 'next'){
		$menuid = $this->input->post('menuid');

		$getMenu = $this->mmenu->getById($menuid)->row_array();

		if($index == 'next'){
			$data = array('tempstep' => $getMenu['tempstep']+1,);
			$update = $this->mmenu->update($menuid,$data);

			echo 'next';
		}elseif($index == 'back'){
			$data = array('tempstep' => $getMenu['tempstep']-1,);
			$update = $this->mmenu->update($menuid,$data);

			echo 'back';
		}else{
			$getMenu 	= $this->mmenu->getById($menuid)->row_array();

			$where 		= "menutemp_menu_id = '".$menuid."' AND menutemp_temp_step = '1'"; 
			$getField 	= $this->mtempmenu->getByWhere($where)->result_array();

			$where 		= "menutemp_menu_id = '".$menuid."' AND menutemp_temp_step = '1' AND menutemp_field_6 = '1'"; 
			$getTable 	= $this->mtempmenu->getByWhere($where)->result_array();

			$where 		= "menutemp_menu_id = '".$menuid."' AND menutemp_temp_step = '2'"; 
			$getPage 	= $this->mtempmenu->getByWhere($where)->row_array();

			$tablename  = str_replace(' ', '', $getMenu['menu']);
			$tablename  = strtolower($tablename);
			$collumn 	= array();

			$n = 0;
			foreach($getField as $row){
				$NULL = '';

				if($row['menutemp_field_5'] == '1'){
					$NULL = 'NOT NULL';
				}

				$field = str_replace(' ', '', $row['menutemp_field_1']);
				$field = strtolower($field);

				$collumn[$n] = array(
										'0' => $field,
										'1'	=> $row['menutemp_field_2'],
										'2'	=> $row['menutemp_field_4'],
										'3'	=> $NULL,
									);
			
				$n++;
			}

			/* -CREATE DATABASE- */
				$tableParam = array(
									'table' 	=> $tablename,
									'collumn'	=> $collumn,
								   );

				$createDB = $this->marge->db_exec('create',$tableParam);
			/* -CREATE DATABASE- (END) */


			/* -CREATE MAIN PAGE-INDEX- */
				$menuname 	= $getMenu['id'];
				$action 	= array();

				if($getPage['menutemp_field_2'] > 0){
					$action['add'] = true;
				}

				if($getPage['menutemp_field_3'] > 0){
					$action['edit'] = true;
				}

				if($getPage['menutemp_field_4'] > 0){
					$action['preview'] = true;
				}

				if($getPage['menutemp_field_5'] > 0){
					$action['delete'] = true;
				}

				$this->marge->create_viewsindex($getMenu['menu'],$getTable,$action);
			/* -CREATE MAIN PAGE-INDEX- (END) */


			/* -CREATE ADD PAGE- */
				if($getPage['menutemp_field_2'] > 0){
					/* Add Jquery Validation on modal.php */ 
						$path 		= 'application/views/template/modal.php';
						$endtext	= '/* --- end auto generated add --- */';
						$text 		= '';

						$text 	.= "/*add ".$tablename."*/".PHP_EOL;
				        $text 	.= "\t\t\t\t\t<?php break;".PHP_EOL;
				        $text 	.= "\t\t\t\t\t\t\tcase 'add-".$tablename."':".PHP_EOL;
				        $text 	.= "\t\t\t\t\t?>".PHP_EOL;
				        $text 	.= "\t\t\t\t\t/* --- add ".$tablename." --- */".PHP_EOL;

				        // MANDATORY RULES
						$where 		= "menutemp_menu_id = '".$menuid."' AND menutemp_temp_step = '1' AND menutemp_field_5 = '1'"; 
						$mandatory 	= $this->mtempmenu->getByWhere($where)->result_array();

				        if($mandatory > 0){
				        $text 	.= "\t\t\t\t\t\trules: {".PHP_EOL;

				        foreach($mandatory as $row){
						$field = str_replace(' ', '', $row['menutemp_field_1']);
						$field = $tablename.'_'.strtolower($field);

				        $text 	.= "\t\t\t\t\t\t\t".$field.": { required: true },".PHP_EOL;
				    	}

				        $text 	.= "\t\t\t\t\t\t},".PHP_EOL;

				        // MANDATORY MESSAGE
				        $text 	.= "\t\t\t\t\t\tmessages: {".PHP_EOL;

				        foreach($mandatory as $row){
						$field = str_replace(' ', '', $row['menutemp_field_1']);
						$field = $tablename.'_'.strtolower($field);

				        $text 	.= "\t\t\t\t\t\t\t".$field.": {".PHP_EOL;
				        $text 	.= "\t\t\t\t\t\t\t\trequired: \"Please provide a ".$row['menutemp_field_1']."\"".PHP_EOL;
				        $text 	.= "\t\t\t\t\t\t\t},".PHP_EOL;
				    	}

				        $text 	.= "\t\t\t\t\t\t},".PHP_EOL;
				    	}

				    	// SUBMIT VARIABLE
				        $text 	.= "\t\t\t\t\t\tsubmitHandler: function(form) {".PHP_EOL;
				        $text 	.= "\t\t\t\t\t\t\t$('.overlay').show();".PHP_EOL;

				        if($getPage['menutemp_field_2'] == 2){
					        foreach($getField as $row){
							$field = str_replace(' ', '', $row['menutemp_field_1']);
							$field = $tablename.'_'.strtolower($field);
					        	
								// if($row['menutemp_field_3'] == '0' || $row['menutemp_field_3'] == '1' || $row['menutemp_field_3'] == '2'){
							    //      	$text 	.= "\t\t\t\t\t\t\tvar ".$field."   = $(\"#".$field."\").val(); ".PHP_EOL;   
							    //  }else

					    		if($row['menutemp_field_3'] == '3'){ // tinyMCE
					        	$text 	.= "\t\t\t\t\t\t\tvar ".$field."   = tinyMCE.get('".$field."').getContent(); ".PHP_EOL;   
					    		}elseif($row['menutemp_field_3'] == '8'){ // checkbox
						        $text 	.= "\t\t\t\t\t\t\tif ($('input#".$field."').is(':checked')) {".PHP_EOL;
					            $text 	.= "\t\t\t\t\t\t\t\tvar ".$field."   = 1;".PHP_EOL; 
					            $text 	.= "\t\t\t\t\t\t\t}else{".PHP_EOL;
					            $text 	.= "\t\t\t\t\t\t\t\tvar ".$field."   = 0;".PHP_EOL; 
					            $text 	.= "\t\t\t\t\t\t\t}".PHP_EOL;
					    		}elseif($row['menutemp_field_3'] == '9' OR $row['menutemp_field_3'] == '10' OR $row['menutemp_field_3'] == '11'){ // php var
	              			    $text 	.= "";
	              			    }else{
					        	$text 	.= "\t\t\t\t\t\t\tvar ".$field."   = $(\"#".$field."\").val(); ".PHP_EOL;   
	              			    }
					    	}

							$text 	.= PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\tvar modal             = $(\"#successModal\");".PHP_EOL;
							$text 	.= PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t$.post(\"<?php echo site_url('add-".$tablename."');?>\",".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t{";
					        
					        foreach($getField as $row){
							$field = str_replace(' ', '', $row['menutemp_field_1']);
							$field = $tablename.'_'.strtolower($field);

					        $text   .= $field.":".$field.",";
					    	}
					        		
					        $text   .= "},".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\tfunction(data){".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t$('.overlay').hide();".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t$(\"#mAdd\").modal('hide');".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t$('#successModal').modal({backdrop: 'static', keyboard: false})".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\tif(data == 'Success'){".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t\tmodal.find('.modal-body').text('Data Saved..');".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t}else{".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t\tmodal.find('.modal-body').text('Failed Save Data..');".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t}".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t}   ".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t);".PHP_EOL;
					    }else{
				        	$text 	.= "\t\t\t\t\t\t\tform.submit();".PHP_EOL;
					    }

				        $text 	.= "\t\t\t\t\t\t}".PHP_EOL;            
				        $text 	.= "\t\t\t\t\t/* --- add ".$tablename." --- (END)*/".PHP_EOL;

						$data = array( 'path' => $path, 'text' => $text, 'endtext' => $endtext, 'afterendtext' => "\t\t\t\t\t",);

						$this->marge->update_content_file($data);
					/* Add Jquery Validation on modal.php (END) */

					if($getPage['menutemp_field_2'] == '1'){

						/* Add ADD UI on views folder */
							$where = "menutemp_menu_id = '".$menuid."' AND menutemp_temp_step = '1' AND menutemp_field_3 < 4"; 
							$dataElement['01'] = $this->mtempmenu->getByWhere($where)->result_array();

							$where = "menutemp_menu_id = '".$menuid."' AND menutemp_temp_step = '1' AND menutemp_field_3 > 3"; 
							$dataElement['02'] = $this->mtempmenu->getByWhere($where)->result_array();

							$this->marge->create_viewsadd($getMenu['menu'],$dataElement,$action);
						/* Add ADD UI on views folder (END)*/

						/* Add ADD Function on Controller */
							$path1 		= 'application/controllers/admin/'.$tablename.'.php';
							$endtext1	= "}/*END OF FILE*/";
							$text 		= ''.PHP_EOL;

							$text 		.= "\tfunction add(){".PHP_EOL;						

							$text 		.= "\t\t$"."statusPost = $"."this->input->post('statusPost');".PHP_EOL.PHP_EOL;
							$text 		.= "\t\tif(!isset($"."statusPost) || empty($"."statusPost)){".PHP_EOL;
				
							$text 		.= "\t\t\t$"."data = array(".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t\t'titlebar'\t\t=> 'Admin | ".$getMenu['menu']."',".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t\t'menu'\t\t\t=> $"."this->mmenu->getParent()->result_array(),".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t\t'content'\t\t=> 'admin/".$tablename."/add',".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t\t'title'\t\t\t=> 'Add ".$getMenu['menu']."',".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t\t'modal'\t\t\t=> 'template/modal',".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t);".PHP_EOL;

							$text 		.= "\t\t\t$"."this->load->view('template/main',$"."data);".PHP_EOL;	
							$text 		.= "\t\t}else{".PHP_EOL;

							$where 		= "menutemp_menu_id = '".$menuid."' AND menutemp_temp_step = '1' AND menutemp_field_3 = '8'"; 
							$getCB 		= $this->mtempmenu->getByWhere($where)->result_array();

							foreach($getCB as $row){
							$field = str_replace(' ', '', $row['menutemp_field_1']);
							$field = strtolower($field);
							$field = $tablename.'_'.$field;

							$text		.= "\t\t\t$".$field." 	= $"."this->input->post('".$field."');".PHP_EOL.PHP_EOL;
							$text		.= "\t\t\tif(!isset($".$field.")){".PHP_EOL;
							$text		.= "\t\t\t\t$".$field."   = '0';".PHP_EOL;
							$text		.= "\t\t\t}else{".PHP_EOL;
							$text		.= "\t\t\t\t$".$field."   = '1';".PHP_EOL;
							$text		.= "\t\t\t}".PHP_EOL.PHP_EOL;
							}

							$text		.= "\t\t\t$"."data = array(".PHP_EOL;

							foreach($getField as $row){
								$field = str_replace(' ', '', $row['menutemp_field_1']);
								$field = strtolower($field);
								$field = $tablename.'_'.$field;

								if($row['menutemp_field_3'] == '8'){
								$text		.= "\t\t\t\t\t\t\t'".$tablename."_".$field."'\t=> $".$field.",".PHP_EOL;
								}elseif($row['menutemp_field_3'] == '9'){
								$text		.= "\t\t\t\t\t\t\t'".$tablename."_".$field."'\t=> date('Y-m-d H:i:s'),".PHP_EOL;
								}elseif($row['menutemp_field_3'] == '10'){
								$text		.= "\t\t\t\t\t\t\t'".$tablename."_".$field."'\t=> $"."this->session->userdata(_PREFIX.'username'),".PHP_EOL;
								}elseif($row['menutemp_field_3'] == '11'){
								$text		.= "\t\t\t\t\t\t\t'".$tablename."_".$field."'\t=> '',".PHP_EOL;
								}else{
								$text		.= "\t\t\t\t\t\t\t'".$tablename."_".$field."'\t=> $"."this->input->post('".$field."'),".PHP_EOL;									
								}
							}

							$text		.= "\t\t\t\t\t\t);".PHP_EOL.PHP_EOL;

							$text		.= "\t\t\t$"."insert = $"."this->m".$tablename."->insert($"."data);".PHP_EOL.PHP_EOL;

							$text		.= "\t\t\tif($"."insert){".PHP_EOL;
							$text 		.= "\t\t\t\t$"."this->marge->record_activity('Add Data ".$getMenu['menu']."');".PHP_EOL;
							$text		.= "\t\t\t\t$"."this->session->set_flashdata('message', ".PHP_EOL;
							$text		.= "\t\t\t\t'<div id=\"message\" class=\"alert alert-success alert-dismissible\">".PHP_EOL;
        					$text		.= "\t\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>".PHP_EOL;
        					$text		.= "\t\t\t\t\tData Saved".PHP_EOL;
        					$text		.= "\t\t\t\t</div>".PHP_EOL;
        					$text		.= "\t\t\t\t');".PHP_EOL;
							$text		.= "\t\t\t\tredirect('admin-".$tablename."');".PHP_EOL;
							$text		.= "\t\t\t}else{".PHP_EOL;
							$text		.= "\t\t\t\t$"."this->session->set_flashdata('message_', ".PHP_EOL;
							$text		.= "\t\t\t\t'<div id=\"message\" class=\"alert alert-danger alert-dismissible\">".PHP_EOL;
        					$text		.= "\t\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>".PHP_EOL;
        					$text		.= "\t\t\t\t\tFailed Save Data".PHP_EOL;
        					$text		.= "\t\t\t\t</div>".PHP_EOL;
        					$text		.= "\t\t\t\t');".PHP_EOL;
							$text		.= "\t\t\t\tredirect('admin-".$tablename."');".PHP_EOL;
							$text		.= "\t\t\t}".PHP_EOL;	

							$text 		.= "\t\t}".PHP_EOL;
							$text 		.= "\t}";

							$data = array( 'path' => $path1, 'text' => $text, 'endtext' => $endtext1, 'afterendtext' => "",);

							$this->marge->update_content_file($data);
						/* Add ADD Function on Controller (END)*/
					}else{

					}
				}
			/* -CREATE ADD PAGE- (END) */


			/* -CREATE PREVIEW PAGE- */
				if($getPage['menutemp_field_4'] > 0){

					// IF ONE PAGE SAME AS EDIT PAGE
					// ONLY CREATE ON MODAL PAGE
					if($getPage['menutemp_field_2'] == '2'){

					}
				}
			/* -CREATE PREVIEW PAGE- (END) */


			/* -CREATE EDIT PAGE- */
				if($getPage['menutemp_field_3'] > 0){
					/* Add Jquery Validation on modal.php */
						$path 		= 'application/views/template/modal.php';
						$endtext	= '/* --- end auto generated view --- */';
						$text 		= '';

						$text 	.= "/*edit ".$tablename."*/".PHP_EOL;
				        $text 	.= "\t\t\t\t\t<?php break;".PHP_EOL;
				        $text 	.= "\t\t\t\t\t\t\tcase 'edit-".$tablename."-'.$"."param:".PHP_EOL;
				        $text 	.= "\t\t\t\t\t?>".PHP_EOL;
				        $text 	.= "\t\t\t\t\t/* --- edit ".$tablename." --- */".PHP_EOL;

				        // MANDATORY
						$where 		= "menutemp_menu_id = '".$menuid."' AND menutemp_temp_step = '1' AND menutemp_field_5 = '1'"; 
						$mandatory 	= $this->mtempmenu->getByWhere($where)->result_array();

				        if($mandatory > 0){
				        $text 	.= "\t\t\t\t\t\trules: {".PHP_EOL;

				        foreach($mandatory as $row){
						$field = str_replace(' ', '', $row['menutemp_field_1']);
						$field = $tablename.'_'.strtolower($field);

				        $text 	.= "\t\t\t\t\t\t\tv".$field.": { required: true },".PHP_EOL;
				    	}

				        $text 	.= "\t\t\t\t\t\t},".PHP_EOL;

				        // MANDATORY MESSAGE
				        $text 	.= "\t\t\t\t\t\tmessages: {".PHP_EOL;

				        foreach($mandatory as $row){
						$field = str_replace(' ', '', $row['menutemp_field_1']);
						$field = strtolower($field);

				        $text 	.= "\t\t\t\t\t\t\tv".$field.": {".PHP_EOL;
				        $text 	.= "\t\t\t\t\t\t\t\trequired: \"Please provide a ".$row['menutemp_field_1']."\"".PHP_EOL;
				        $text 	.= "\t\t\t\t\t\t\t},".PHP_EOL;
				    	}

				        $text 	.= "\t\t\t\t\t\t},".PHP_EOL;
				    	}

				    	// SUBMIT VARIABLE
				        $text 	.= "\t\t\t\t\t\tsubmitHandler: function(form) {".PHP_EOL;
				        $text 	.= "\t\t\t\t\t\t\t$('.overlay').show();".PHP_EOL;

				        if($getPage['menutemp_field_2'] == 2){
					        foreach($getField as $row){
							$field = str_replace(' ', '', $row['menutemp_field_1']);
							$field = $tablename.'_'.strtolower($field);
					        	
								// if($row['menutemp_field_3'] == '0' || $row['menutemp_field_3'] == '1' || $row['menutemp_field_3'] == '2'){
					   			//      $text 	.= "\t\t\t\t\t\t\tvar ".$field."   = $(\"#".$field."\").val(); ".PHP_EOL;   
					   			// }else

					    		if($row['menutemp_field_3'] == '3'){ // tinyMCE
					        	$text 	.= "\t\t\t\t\t\t\tvar ".$field."   = tinyMCE.get('v".$field."').getContent(); ".PHP_EOL;   
					    		}elseif($row['menutemp_field_3'] == '8'){ // checkbox
						        $text 	.= "\t\t\t\t\t\t\tif ($('input#v".$field."').is(':checked')) {".PHP_EOL;
					            $text 	.= "\t\t\t\t\t\t\t\tvar ".$field."   = 1;".PHP_EOL; 
					            $text 	.= "\t\t\t\t\t\t\t}else{".PHP_EOL;
					            $text 	.= "\t\t\t\t\t\t\t\tvar ".$field."   = 0;".PHP_EOL; 
					            $text 	.= "\t\t\t\t\t\t\t}".PHP_EOL;
					    		}elseif($row['menutemp_field_3'] == '9' OR $row['menutemp_field_3'] == '10' OR $row['menutemp_field_3'] == '11'){ // php var
	              			    $text 	.= "";
	              			    }else{
					        	$text 	.= "\t\t\t\t\t\t\tvar ".$field."   = $(\"#v".$field."\").val(); ".PHP_EOL;   
	              			    }
					    	}

					        $text 	.= "\t\t\t\t\t\t\tvar id   				= $(\"#v".$field."\").val(); ".PHP_EOL;   
							$text 	.= PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\tvar modal             = $(\"#successModal\");".PHP_EOL;
							$text 	.= PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t$.post(\"<?php echo site_url('edit-".$tablename."');?>\",".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t{";
					        
					        $n = 0;
					        foreach($getField as $row){
							$field = str_replace(' ', '', $row['menutemp_field_1']);
							$field = $tablename.'_'.strtolower($field);

							if($n == 0){
								$text .= "id:id,";
							}

					        $text   .= $field.":".$field.",";

					        $n++;
					    	}
					        		
					        $text   .= "},".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\tfunction(data){".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t$('.overlay').hide();".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t$(\"#mAdd\").modal('hide');".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t$('#successModal').modal({backdrop: 'static', keyboard: false})".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\tif(data == 'Success'){".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t\tmodal.find('.modal-body').text('Data Saved..');".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t}else{".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t\tmodal.find('.modal-body').text('Failed Save Data..');".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t\t}".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t\t}   ".PHP_EOL;
					        $text 	.= "\t\t\t\t\t\t\t);".PHP_EOL;
					    }else{
				        	$text 	.= "\t\t\t\t\t\t\tform.submit();".PHP_EOL;
					    }

				        $text 	.= "\t\t\t\t\t\t}".PHP_EOL;            
				        $text 	.= "\t\t\t\t\t/* --- edit ".$tablename." --- (END)*/".PHP_EOL;

						$data = array( 'path' => $path, 'text' => $text, 'endtext' => $endtext, 'afterendtext' => "\t\t\t\t\t",);

						$this->marge->update_content_file($data);
					/* Add Jquery Validation on modal.php (END) */

					if($getPage['menutemp_field_2'] == '1'){

						/* Add EDIT UI on views folder */
							$where = "menutemp_menu_id = '".$menuid."' AND menutemp_temp_step = '1' AND menutemp_field_3 < 4"; 
							$dataElement['01'] = $this->mtempmenu->getByWhere($where)->result_array();

							$where = "menutemp_menu_id = '".$menuid."' AND menutemp_temp_step = '1' AND menutemp_field_3 > 3"; 
							$dataElement['02'] = $this->mtempmenu->getByWhere($where)->result_array();

							$this->marge->create_viewsedit($getMenu['menu'],$dataElement,$action);
						/* Add EDIT UI on views folder (END) */

						/* Add EDIT Function on Controller */
							$path1 		= 'application/controllers/admin/'.$tablename.'.php';
							$endtext1	= "}/*END OF FILE*/";
							$text 		= ''.PHP_EOL;

							$text 		.= "\tfunction edit($"."id = '0', $"."role = NULL){".PHP_EOL;						

							$text 		.= "\t\t$"."statusPost = $"."this->input->post('vstatusPost');".PHP_EOL.PHP_EOL;
							$text 		.= "\t\tif(!isset($"."statusPost) || empty($"."statusPost)){".PHP_EOL;
				
							$text 		.= "\t\t\t$"."get_data = $"."this->m".$tablename."->getById($"."id)->row_array();".PHP_EOL.PHP_EOL;	 
							$text 		.= "\t\t\tif($"."role != NULL){".PHP_EOL;
							$text 		.= "\t\t\t\t$"."role = 'disabled=\"disabled\"';".PHP_EOL;
							$text 		.= "\t\t\t}else{".PHP_EOL;
							$text 		.= "\t\t\t\t$"."role = '';".PHP_EOL;
							$text 		.= "\t\t\t}".PHP_EOL.PHP_EOL;
							$text 		.= "\t\t\t$"."data = array(".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t\t'titlebar'\t 	=> 'Admin | Edit ".$getMenu['menu']."',".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t\t'menu'\t\t	=> $"."this->mmenu->getParent()->result_array(),".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t\t'content'\t	=> 'admin/".$tablename."/edit',".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t\t'title'\t\t	=> 'Edit ".$getMenu['menu']."',".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t\t'modal'\t\t  	=> 'template/modal',".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t\t'result'\t\t	=> $"."get_data,".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t\t'role'\t\t	=> $"."role,".PHP_EOL;
							$text 		.= "\t\t\t\t\t\t);".PHP_EOL.PHP_EOL;
							$text 		.= "\t\t\t$"."this->load->view('template/main',$"."data);".PHP_EOL;

							$text 		.= "\t\t}else{".PHP_EOL;

							$text 		.= "\t\t\t$"."id 		= $"."this->input->post('vid');".PHP_EOL;

							$where 		= "menutemp_menu_id = '".$menuid."' AND menutemp_temp_step = '1' AND menutemp_field_3 = '8'"; 
							$getCB 		= $this->mtempmenu->getByWhere($where)->result_array();

							foreach($getCB as $row){
							$field = str_replace(' ', '', $row['menutemp_field_1']);
							$field = strtolower($field);
							$field = $tablename.'_'.$field;

							$text		.= "\t\t\t$".$field." 	= $"."this->input->post('v".$field."');".PHP_EOL.PHP_EOL;
							$text		.= "\t\t\tif(!isset($".$field.")){".PHP_EOL;
							$text		.= "\t\t\t\t$".$field."   = '0';".PHP_EOL;
							$text		.= "\t\t\t}else{".PHP_EOL;
							$text		.= "\t\t\t\t$".$field."   = '1';".PHP_EOL;
							$text		.= "\t\t\t}".PHP_EOL.PHP_EOL;
							}

							$text		.= "\t\t\t$"."data = array(".PHP_EOL;

							foreach($getField as $row){
								$field = str_replace(' ', '', $row['menutemp_field_1']);
								$field = strtolower($field);
								$field = $tablename.'_'.$field;

								if($row['menutemp_field_3'] == '8'){
								$text		.= "\t\t\t\t\t\t\t'".$tablename."_".$field."'\t=> $".$field.",".PHP_EOL;
								}elseif($row['menutemp_field_3'] == '9'){
								$text		.= "\t\t\t\t\t\t\t'".$tablename."_".$field."'\t=> date('Y-m-d H:i:s'),".PHP_EOL;
								}elseif($row['menutemp_field_3'] == '10'){
								$text		.= "\t\t\t\t\t\t\t'".$tablename."_".$field."'\t=> $"."this->session->userdata(_PREFIX.'username'),".PHP_EOL;
								}elseif($row['menutemp_field_3'] == '11'){
								$text		.= "\t\t\t\t\t\t\t'".$tablename."_".$field."'\t=> '',".PHP_EOL;
								}else{
								$text		.= "\t\t\t\t\t\t\t'".$tablename."_".$field."'\t=> $"."this->input->post('v".$field."'),".PHP_EOL;									
								}
							}

							$text 		.= "\t\t\t\t\t\t);".PHP_EOL;

							$text 		.= "\t\t\t$"."update = $"."this->m".$tablename."->update($"."id,$"."data);".PHP_EOL;
							$text 		.= "\t\t\tif($"."update){".PHP_EOL;
							$text 		.= "\t\t\t\t$"."this->marge->record_activity('Update Data ".$getMenu['menu']."');".PHP_EOL;
							$text 		.= "\t\t\t\t$"."this->session->set_flashdata('message', ".PHP_EOL;
							$text 		.= "\t\t\t\t'<div id=\"message\" class=\"alert alert-success alert-dismissible\">".PHP_EOL;
            				$text 		.= "\t\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>".PHP_EOL;
            				$text 		.= "\t\t\t\t\tData Updated".PHP_EOL;
            				$text 		.= "\t\t\t\t\t\t</div>".PHP_EOL;
            				$text 		.= "\t\t\t\t\t');".PHP_EOL;
							$text 		.= "\t\t\t\tredirect('admin-".$tablename."');".PHP_EOL;
							$text 		.= "\t\t\t}else{".PHP_EOL;
							$text 		.= "\t\t\t\t$"."this->session->set_flashdata('message', ".PHP_EOL;
							$text 		.= "\t\t\t\t'<div id=\"message\" class=\"alert alert-danger alert-dismissible\">".PHP_EOL;
            				$text 		.= "\t\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>".PHP_EOL;
            				$text 		.= "\t\t\t\t\tFailed Update Data".PHP_EOL;
            				$text 		.= "\t\t\t\t\t\t</div>".PHP_EOL;
            				$text 		.= "\t\t\t\t\t');".PHP_EOL;
							$text 		.= "\t\t\t\tredirect('admin-".$tablename."');".PHP_EOL;
							$text 		.= "\t\t\t}".PHP_EOL;

							$text 		.= "\t\t}".PHP_EOL;
							$text 		.= "\t}";

							$data = array( 'path' => $path1, 'text' => $text, 'endtext' => $endtext1, 'afterendtext' => "",);

							$this->marge->update_content_file($data);
						/* Add EDIT Function on Controller */
					}else{

					}
				}
			/* -CREATE EDIT PAGE- (END) */


			/* -CREATE DELETE PAGE- */
				if($getPage['menutemp_field_5'] > 0){
					/* Add DELETE Function on Controller */
						$path 		= 'application/controllers/admin/'.$tablename.'.php';
						$endtext	= "}/*END OF FILE*/";
						$text 		= ''.PHP_EOL;

						$text 	   .= "\tfunction delete(){".PHP_EOL;
						$text 	   .= "\t\t$"."id\t= $"."this->input->post('id');".PHP_EOL.PHP_EOL;

						$text 	   .= "\t\t$"."delete = $"."this->m".$tablename."->delete($"."id);".PHP_EOL.PHP_EOL;

						$text 	   .= "\t\tif($"."delete){".PHP_EOL;
						$text 	   .= "\t\t\t$"."this->marge->record_activity('Delete Data ".$getMenu['menu']."');".PHP_EOL;
						$text 	   .= "\t\t\tdie('Success');".PHP_EOL;
						$text 	   .= "\t\t}else{".PHP_EOL;
						$text 	   .= "\t\t\tdie('Failed #01');".PHP_EOL;
						$text 	   .= "\t\t}".PHP_EOL;
						$text 	   .= "\t}";

						$data = array( 'path' => $path, 'text' => $text, 'endtext' => $endtext, 'afterendtext' => "",);

						$this->marge->update_content_file($data);
					/* Add DELETE Function on Controller (END)*/
				}
			/* -CREATE DELETE PAGE- (END) */


			/* -CREATE MULTIPLE ACTION FUNCTION CONTROLLER- */
				$path2 		= 'application/controllers/admin/'.$tablename.'.php';
				$endtext2	= "}/*END OF FILE*/";
				$text 		= ''.PHP_EOL;

				$text	   .= "\tfunction multiple_action(){".PHP_EOL;
				$text	   .= "\t\t$"."role = $"."this->input->post('role');".PHP_EOL;
				$text	   .= "\t\t$"."id   = $"."this->input->post('id');".PHP_EOL.PHP_EOL;

				$text	   .= "\t\t$"."n = 0;".PHP_EOL;
				$text	   .= "\t\tfor($"."i=0;$"."i<count($"."id);$"."i++){".PHP_EOL;
				$text	   .= "\t\t\t$"."get_id = $"."id[$"."i];".PHP_EOL.PHP_EOL;
	
				$text	   .= "\t\t\tif($"."role == 'publish' || $"."role == 'unpublish'){".PHP_EOL;
				$text	   .= "\t\t\t\tif($"."role == 'publish'){".PHP_EOL;
				$text	   .= "\t\t\t\t\t$"."data = array( '".$tablename."_status' => '1', '".$tablename."_updateby' => $"."this->session->userdata(_PREFIX.'username'), '".$tablename."_updatedate' => date('Y-m-d H:i:s'), );".PHP_EOL;
				$text	   .= "\t\t\t\t}else{".PHP_EOL;
				$text	   .= "\t\t\t\t\t$"."data = array( '".$tablename."_status' => '0', '".$tablename."_updateby' => $"."this->session->userdata(_PREFIX.'username'), '".$tablename."_updatedate' => date('Y-m-d H:i:s'), );".PHP_EOL;
				$text	   .= "\t\t\t\t}".PHP_EOL.PHP_EOL;

				$text	   .= "\t\t\t\t$"."update = $"."this->m".$tablename."->update($"."get_id,$"."data);".PHP_EOL;
				$text	   .= "\t\t\t\tif($"."update){".PHP_EOL;
				$text	   .= "\t\t\t\t\t$"."n++;".PHP_EOL;
				$text	   .= "\t\t\t\t}".PHP_EOL;
				$text	   .= "\t\t\t}elseif($"."role == 'delete'){".PHP_EOL;
				$text	   .= "\t\t\t\t$"."update = $"."this->m".$tablename."->delete($"."get_id);".PHP_EOL;
				$text	   .= "\t\t\t\tif($"."update){".PHP_EOL;
				$text	   .= "\t\t\t\t\t$"."n++;".PHP_EOL;
				$text	   .= "\t\t\t\t}".PHP_EOL;
				$text	   .= "\t\t\t}".PHP_EOL;
				$text	   .= "\t\t}".PHP_EOL.PHP_EOL;

				$text	   .= "\t\tif($"."n == count($"."id)){".PHP_EOL;
				$text	   .= "\t\t\tdie('Success');".PHP_EOL;
				$text	   .= "\t\t}else{".PHP_EOL;
				$text	   .= "\t\t\tdie('Failed');".PHP_EOL;
				$text	   .= "\t\t}".PHP_EOL;
				$text	   .= "\t}".PHP_EOL;

				$data = array( 'path' => $path2, 'text' => $text, 'endtext' => $endtext2, 'afterendtext' => "",);

				$this->marge->update_content_file($data);
			/* -CREATE MULTIPLE ACTION FUNCTION CONTROLLER- (END) */


			$data = array('status' => '1',);
			$update = $this->mmenu->update($menuid,$data);

			// echo $createDB;
		}
	}
}
