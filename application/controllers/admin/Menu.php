<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}	
	}

	public function index($param = ''){
		$data = array(
						'content'  	=> 'admin/menu/index',
						'modal'		=> 'template/modal',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'titlebar' 	=> 'Admin | Menu',
						'title'	   	=> 'Menu',
						'result'   	=> $this->mmenu->getAll()->result_array(),
						'max_parent'=> $this->mmenu->getMaxParent(),
						'all_parent'=> $this->mmenu->getAllParent()->result_array(),
						'js'		=> '',
						'param'		=> $param,
						'role'		=> $this->mgroupmenu->getByUser($this->session->userdata(_PREFIX.'username'),$this->uri->segment(1))->row_array(),
					 );
		$this->load->view('template/main', $data);
	}

	function get_menu(){
		$id 	= $this->input->post('id');
		$index 	= $this->mmenu->getMaxPosition($id);

		$get_menu = $this->mmenu->getPosition($id)->result_array();
		$data = ' - ,';

		foreach($get_menu as $row){
			$data .= $row['position'].'-'.$row['menu'].',';
		}
		$data = rtrim($data,',');
		$data = $data.'|'.$index['position'];
		print_r($data);
	}

	function get_submenu(){
		$id1 	= $this->input->post('id1');
		$id2 	= $this->input->post('id2');
		$index 	= $this->mmenu->getMaxSort($id1,$id2);

		die($index['sort']);
	}

	function sort_menu(){
		$parent 	= $this->input->post('parent');
	
		echo '<pre>';
		for($i=0;$i<count($parent);$i++){
			$ni = $i+1;

			$dataParent = array(
								'no'		=> $ni.'.0.0',
								'parent' 	=> $ni,
								'position'	=> 0,
								'sort'		=> 0,
						 	   );
			// echo $ni.'.0.0 - id:'.$parent[$i];
			// print_r($dataParent);
			$this->mmenu->update($parent[$i],$dataParent);

			$position 	= $this->input->post('position-'.$parent[$i]);
			for($j=0; $j < count($position); $j++){ 
				$nj = $j+1;

				$dataPosition = array(
										'no'		=> $ni.'.'.$nj.'.0',
										'parent' 	=> $ni,
										'position'	=> $nj,
										'sort'		=> 0,
							         );
				//echo '<br>------'.$ni.'.'.$nj.'.0 - id:'.$position[$j];
				// print_r($dataPosition);
				$this->mmenu->update($position[$j],$dataPosition);

				$sort 	= $this->input->post('sort-'.$parent[$i].$position[$j]);
				for ($k=0; $k < count($sort); $k++) { 
					$nk = $k+1;

					$dataSort = array(
										'no'		=> $ni.'.'.$nj.'.'.$nk,
										'parent' 	=> $ni,
										'position'	=> $nj,
										'sort'		=> $nk,
							         );					
					//echo '<br>---------------'.$ni.'.'.$nj.'.'.$nk.' - id:'.$sort[$k];
					// print_r($dataSort);
					$this->mmenu->update($sort[$k],$dataSort);
				}
			}
		}

		redirect('menu');
	}

	function view_menu(){
		$role     = $this->session->userdata(_PREFIX.'role');
		$menurole = $this->session->userdata(_PREFIX.'menurole');

		$id 	= $this->input->post('id');
		$url 	= $this->input->post('url');
		$type 	= $this->input->post('type');

		$get_menu 		= $this->mmenu->getById($id)->row_array();
		$get_submenu 	= $this->mmenu->getAllPosition($get_menu['parent'])->result_array();
		$all_parent 	= $this->mmenu->getAllParent()->result_array();
		$all_menu 		= $this->mmenu->getParent()->result_array();
		$menu 			= '';

		if($get_menu['position'] == '0' && $get_menu['sort'] == '0'){ $menu = 'parent'; $checked1 = 'checked';}else{ $checked1 = '';}
		if($get_menu['position'] != '0' && $get_menu['sort'] == '0'){ $menu = 'menu'; $checked2 = 'checked';}else{ $checked2 = '';}
		if($get_menu['position'] != '0' && $get_menu['sort'] != '0'){ $menu = 'submenu'; $checked3 = 'checked';}else{ $checked3 = '';}

		if(isset($get_menu['url']) && $get_menu['url'] != ''){ $urlchecked = 'checked';}else{ $urlchecked = '';}
		if($get_menu['status'] != '0' ){ $statuschecked = 'checked';}else{ $statuschecked = '';}

		if(count($get_menu) > 0){
		    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}

		    $print  = '
			            <div class="form-group" style="position: relative;">
			              <label for="name" class="form-control-label">Menu Name</label>
			              <input type="hidden" class="form-control" id="vidmenu" name="vidmenu" value="'.$get_menu['id'].'"/>
			              <input type="hidden" class="form-control" id="bakname" name="bakname" value="'.$get_menu['menu'].'"/>
			              <input type="text" class="form-control textchanged" id="vname" name="vname" value="'.$get_menu['menu'].'" checkUrl="'.base_url('admin/menu/checkName').'"  '.$disabled.'>
			              <i class="fa fa-spin fa-refresh pull-right loadchanged"></i>
			            </div>

			            <div class="form-group">
			              <label for="groupName" class="form-control-label">Position</label><br>
			                <input type="radio" id="vposition" name="vposition" class="minimal position" value="1" '.$disabled.' '.$checked1.'> Parent &nbsp;&nbsp;
			                <input type="radio" id="vposition" name="vposition" class="minimal position" value="2" '.$disabled.' '.$checked2.'> Menu &nbsp;&nbsp;
			                <input type="radio" id="vposition" name="vposition" class="minimal position" value="3" '.$disabled.' '.$checked3.'> Sub Menu
			            </div>
			          ';

			// if($menu == 'parent'){
			$print .= '
			            <div class="op0">
			                <input type="hidden" name="vindexparent" id="vindexparent" value="'.$get_menu['parent'].'"/>
			            </div>
					  ';
			// }

			// if($menu == 'menu'){
			$print .= '
			            <div class="op2">
			              <div class="form-group">
			                <label for="parent">Parent</label>
			                <select class="form-control parent" id="vparent" name="vparent" '.$disabled.'>
			                  <option value="">Choose..</option>
			          ';
			           		  foreach($all_parent as $row){ if( $row['parent'] == $get_menu['parent']){ $sel1 = 'selected';}else{ $sel1 = '';}

			$print .= ' 	  <option value="'.$row['parent'].'" '.$sel1.'>'.$row['menu'].'</option>';
			                  }
			$print .= '
			                </select>
			                <input type="hidden" name="vindexmenu" id="vindexmenu" value="'.$get_menu['position'].'"/>
			              </div>
			              <div class="form-group">
			                <label for="icon" class="form-control-label">Icon</label>
			                <input type="text" class="form-control" name="vicon" id="vicon" value="'.$get_menu['icon'].'" '.$disabled.'/>
			              </div>
			            </div>
					  ';
			// }

			// if($menu == 'submenu'){
			$print .= '
			            <div class="op3">
			              <div class="form-group">
			                <label for="parent">Parent</label>
			                <select class="form-control parent" id="vparent" name="vparent" '.$disabled.'>
			                  <option value="">Choose..</option>
			          ';
			                  foreach($all_menu as $row){ if($row['parent'] == $get_menu['parent']){ $sel2 = 'selected';}else{ $sel2 = '';}
			$print .= '  	  <option value="'.$row['parent'].'" '.$sel2.'>'.$row['menu'].'</option>';
			                  }
			$print .= '			                  
			                </select>
			              </div>
			              <div class="form-group">
			                <label for="menu">Menu</label>
			                <select class="form-control menu" id="vmenu" name="vmenu" disabled="disabled">
			          ';
			          		foreach($get_submenu as $row){ if($row['position'] == $get_menu['position']){ $sel3 = 'selected';}else{ $sel3 = '';}
			$print .= '			<option value="'.$row['position'].'" '.$sel3.'>'.$row['menu'].'</option>';
							}
			$print .= '
			                </select>
			                <input type="hidden" name="vindexsubmenu" id="vindexsubmenu"/>
			              </div>
			            </div> 
			          ';
			// }

			$print .= ' <hr>
			            <div class="form-group">
			          ';

			// if($menu == 'menu'){
			$print .= '   <label class="label-url" style="width: 100%;">
			                  <input type="checkbox" id="vstaturl" name="vstaturl" class="minimal" value="0" '.$urlchecked.' '.$disabled.'/>&nbsp;
			                  URL Link<br>
			              </label>
			          ';
			// }

			$print .= '
			              <label>
			                  <input type="checkbox" id="vstatus" name="vstatus" class="minimal" '.$statuschecked.' '.$disabled.'/>&nbsp;
			                  Publish
			              </label>
			            </div>
		    		  ';

			die($print);
		}else{
			die('');
		}
	}

	function edit_menu(){
		$id 	  = $this->input->post('id');
		$menuName = $this->input->post('name');
		$menuTrim = trim($menuName, ' ');

		if($this->input->post('staturl') != '0'){
			$menuLink = 'admin-'.strtolower($menuTrim);
			$menuUrl  = 'admin/'.strtolower($menuTrim);
		}else{
			$menuLink	= '';
			$menuUrl	= '';
		}
		
		$data = array(
						'no'		=> $this->input->post('parent').'.'.$this->input->post('menu').'.'.$this->input->post('submenu'),
						'menu'		=> $this->input->post('name'),
        				'status'	=> $this->input->post('status'),
        				'parent'	=> $this->input->post('parent'),
        				'position'	=> $this->input->post('menu'),
        				'sort'		=> $this->input->post('submenu'),
        				'icon'		=> $this->input->post('icon'),
					 );

		$update = $this->mmenu->update($id,$data);

		if($update){
			// $x = $this->db->last_query();
			die('Success');
		}else{
			die('Failed');
		}
	}

	function reset_menu(){
		$id 		= $this->input->post('id');
		$exid 		= explode('-', $id);

		$menuid 	= $exid[0];
		$tablename 	= strtolower($exid[1]);

		$where 		 = "menutemp_menu_id = '".$menuid."' AND menutemp_temp_step = '2'"; 
		$getPageRole = $this->mtempmenu->getByWhere($where)->row_array();

		/* DROP TABLE */
			$tableParam = array(
								'table' 	=> $tablename,
								'collumn'	=> array(),
							   );

			$createDB = $this->marge->db_exec('drop',$tableParam);

		/* CLEAR VIEWS INDEX.PHP */

			$this->marge->create_viewsindex($tablename);

		/* CLEAR ADD ROWS MODAL.PHP */
			$data =  array(
		 					'path'		=> 'application/views/template/modal.php',
		 					'start'		=> '/*add '.$tablename.'*/',
		 					'end'		=> '/* --- add '.$tablename.' --- (END)*/',
		  				   );
			$this->marge->delete_content_file($data);

		/* CLEAR EDIT ROWS MODAL.PHP */
			$data =  array(
		 					'path'		=> 'application/views/template/modal.php',
		 					'start'		=> '/*edit '.$tablename.'*/',
		 					'end'		=> '/* --- edit '.$tablename.' --- (END)*/',
		  				   );
			$this->marge->delete_content_file($data);

		if($getPageRole['menutemp_field_2'] == '1'){

		/* DELETE VIEW ADD.PHP */
			$viewAddPath	= 'application/views/admin/'.$tablename.'/add.php';
			unlink($viewAddPath);

		/* DELETE VIEW EDIT.PHP */
			$viewEditPath	= 'application/views/admin/'.$tablename.'/edit.php';
			unlink($viewEditPath);

		/* RE-GENERATE/CLEAR CONTROLLER (ADD,DELETE,EDIT) */

			$this->marge->create_controllers($tablename);

		}

		/* UPDATE STATUS MENU */
			$data = array('status' => '2','tempstep' => '1');
			$update = $this->mmenu->update($menuid,$data);

		/* DELETE MENU TEMP */

			$delete = $this->mtempmenu->delete(NULL,array('menutemp_menu_id' => $menuid,));

		if($update){
			die('Success');
		}else{
			die('Failed');
		}
	}

	function addOLD(){
		$data = array(
						'no'		=> $this->input->post('parent').'.'.$this->input->post('menu').'.'.$this->input->post('submenu'),
						'menu'		=> $this->input->post('name'),
        				'link'		=> $this->input->post('link'),
        				'url'		=> $this->input->post('url'),
        				'status'	=> $this->input->post('status'),
        				'parent'	=> $this->input->post('parent'),
        				'position'	=> $this->input->post('menu'),
        				'sort'		=> $this->input->post('submenu'),
        				'icon'		=> $this->input->post('icon')
					 );

		$insert = $this->mmenu->insert($data);

		if($insert){
			die('Success');
		}else{
			die('Failed');
		}
	}

	function add(){
		$menuName = $this->input->post('name');
		$menuTrim = trim($menuName, ' ');

		if($this->input->post('staturl') != '0'){
			$menuLink = 'admin-'.strtolower($menuTrim);
			$menuUrl  = 'admin/'.strtolower($menuTrim);
		}else{
			$menuLink	= '';
			$menuUrl	= '';
		}
		
		$data = array(
						'no'		=> $this->input->post('parent').'.'.$this->input->post('menu').'.'.$this->input->post('submenu'),
						'menu'		=> $this->input->post('name'),
        				'link'		=> $menuLink, //$this->input->post('link'),
        				'url'		=> $menuUrl, //$this->input->post('url'),
        				'status'	=> $this->input->post('status'),
        				'parent'	=> $this->input->post('parent'),
        				'position'	=> $this->input->post('menu'),
        				'sort'		=> $this->input->post('submenu'),
        				'icon'		=> $this->input->post('icon'),
        				'tempstep'  => '1',
					 );
		

		$insert = $this->mmenu->insert($data);
		
		if($this->input->post('menu') != '0'){
			if($this->input->post('staturl') != '0'){
				$this->marge->create_controllers($menuName); 	//$this->create_controllers($menuName);
				$this->marge->create_models($menuName); 		//$this->create_models($menuName);
				$this->marge->create_views($menuName); 			//$this->create_views($menuName);
				$this->marge->update_routes($data); 			//$this->update_routes($data);
				$this->marge->update_autoload($data); 			//$this->update_autoload($data);
			}
		}

		if($insert){
			die('Success');
		}else{
			die('Failed');
		}
	}

	function delete(){
		$data 				= $this->input->post('id');
		$resData 			= explode('-', $data);
		$id					= $resData[0];
		$fileName			= $resData[1];
		$position			= $resData[2];
		$linkurl			= $resData[3];

		if($position != '0' && $linkurl != '0'){
			$this->marge->delete_mvc($fileName);
			$this->marge->delete_routes($fileName);
			$this->marge->delete_autoload($fileName);
		}

		if($this->mmenu->delete($id)){
			$where = "menutemp_menu_id = '".$id."'";

			$this->mtempmenu->delete(NULL,$where);
			$this->mgroupmenu->deleteWhere('idmenu = '.$id);
			die('Success');

		}else{
			die('Failed #001');
		}
	}

	function group_menu(){
		$role     = $this->session->userdata(_PREFIX.'role');
		$menurole = $this->session->userdata(_PREFIX.'menurole');

		if($role != '0'){ 
			$where = "id > '1'"; 
			$where_menu = _PREFIX."menu.id IN (SELECT idmenu FROM "._PREFIX."groupmenu WHERE "._PREFIX."groupmenu.idgroup = ".$menurole.")"; 
		}else{ 
			if($menurole > 0){
				$where = 'id > 0';
			}else{
				$where = 'id IS NOT NULL';
			}
			$where_menu = 'id IS NOT NULL'; 
		}

		$data = array(
						'content'  	=> 'admin/groupmenu/index',
						'modal'  	=> 'template/modal',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'titlebar' 	=> 'Admin | Group Menu',
						'title'	   	=> 'Group Menu',
						'result'   	=> $this->mgroupmenu->getAllGroup($where)->result_array(),
						'data_menu' => $this->mmenu->getMenuToGroup($where_menu)->result_array(),
						'js'		=> '',//$this->js_group_menu()
					 );

		$this->load->view('template/main', $data);
	}

	function checkName(){
	    $name  = $_REQUEST['name'];
	    
	    $name = $this->db->query("SELECT * FROM "._PREFIX."menu WHERE menu = '".$name."'")->row_array();

	    if(count($name) > 0){
	        echo 'false';
	    }
	    else{
	        echo 'true';
	    }
	}

	function checkValue($value){
		if($value == 'name' || $value == 'vname'){
		    $name  = $_REQUEST[$value];
		    $bakname  = $_REQUEST["bakname"];
		    if(isset($name) && $name != ''){
		    	if(isset($bakname) && $bakname != ''){
		    		if($bakname == $name){ 
		    			$checked = NULL;
		    		}else{
			    		$checked = $this->db->query("SELECT * FROM "._PREFIX."menu WHERE menu = '".$name."'")->row_array();
		    		}
		    	}else{
			    	$checked = $this->db->query("SELECT * FROM "._PREFIX."menu WHERE menu = '".$name."'")->row_array();
				}
			}else{
				$checked = 0;
			}
		}elseif($value == 'link'){
		    $link  = $_REQUEST['link'];

		    if(isset($name) && $name != ''){
			    $checked = $this->db->query("SELECT * FROM "._PREFIX."menu WHERE link = '".$link."'")->row_array();
			}else{
				$checked = 0;
			}

		}elseif($value == 'url'){
		    $url  = $_REQUEST['url'];

			if(isset($name) && $name != ''){
			    $checked = $this->db->query("SELECT * FROM "._PREFIX."menu WHERE url = '".$url."'")->row_array();
			}else{
				$checked = 0;
			}
		}
		
		if ($checked) {
			if(count($checked) > 0){
				echo 'false';
			}
			else{
				echo 'true';
			}		
		}else{
			echo 'true';
		}
	}

	function add_group(){
		$auto  = $this->mgroupmenu->autonumberGroup();
		$count = $auto['count'];
		$row   = $auto['row'];
		if($count->id > 0){
			$id = $row ;
		}else{
			$id = '1';
		}

		$data = array(
						'id'		=> $id,
						'groupname' => $this->input->post('name') 
					 );
		$data_menu 	= $this->input->post('menu');
		$data_read 	= $this->input->post('read');
		$data_edit 	= $this->input->post('edit');
		$data_delete= $this->input->post('delete');

		$check_id = $this->mgroupmenu->getIdGroup($id)->row_array();

		if(count($check_id) > 0){
			die('Failed');
		}else{
			$insert = $this->mgroupmenu->insert($data); // Saving Group
			
			if($insert){
				for($i=0;$i<count($data_menu);$i++){
					$data_group_menu = array(
												'idgroup' => $id,
												'idmenu'  => $data_menu[$i],
												'menuall' => '1'
											);
					$this->mgroupmenu->insert_groupmenu($data_group_menu);
				}

				for($i=0;$i<count($data_read);$i++){
					$data_group_menu = array(
												'idgroup' => $id,
												'idmenu'  => $data_read[$i],
												'menuread'=> '1'
											);
					$check = $this->mgroupmenu->getGroupMenuId($id,$data_read[$i])->num_rows();
					
					if($check > 0){
						$this->mgroupmenu->update_groupmenu($id,$data_group_menu,$data_read[$i]);
					}else{
						$this->mgroupmenu->insert_groupmenu($data_group_menu);
					}
				}

				for($i=0;$i<count($data_edit);$i++){
					$data_group_menu = array(
												'idgroup' => $id,
												'idmenu'  => $data_edit[$i],
												'menuedit'=> '1'
											);
					$check = $this->mgroupmenu->getGroupMenuId($id,$data_edit[$i])->num_rows();
					
					if($check > 0){
						$this->mgroupmenu->update_groupmenu($id,$data_group_menu,$data_edit[$i]);
					}else{
						$this->mgroupmenu->insert_groupmenu($data_group_menu);
					}
				}

				for($i=0;$i<count($data_delete);$i++){
					$data_group_menu = array(
												'idgroup' => $id,
												'idmenu'  => $data_delete[$i],
												'menudelete'=> '1'
											);
					$check = $this->mgroupmenu->getGroupMenuId($id,$data_delete[$i])->num_rows();
					
					if($check > 0){
						$this->mgroupmenu->update_groupmenu($id,$data_group_menu,$data_delete[$i]);
					}else{
						$this->mgroupmenu->insert_groupmenu($data_group_menu);
					}
				}

				die('Success');
			}else{
				die('Failed');
			}
		}
	}

	function view_group(){
		$role     = $this->session->userdata(_PREFIX.'role');
		$menurole = $this->session->userdata(_PREFIX.'menurole');

		if($role != '0'){ 
			$where_menu = _PREFIX."menu.id IN (SELECT idmenu FROM "._PREFIX."groupmenu WHERE "._PREFIX."groupmenu.idgroup = ".$menurole.")"; 
		}else{ 
			$where_menu = 'id IS NOT NULL'; 
		}

		$id 	= $this->input->post('id');
		$url 	= $this->input->post('url');
		$type 	= $this->input->post('type');

		$get_group 		= $this->mgroupmenu->getIdGroup($id)->row_array();

		if($type == 'view'){
			$get_groupmenu	= $this->mgroupmenu->getIdGroupMenu($id)->result_array();
		}else{
			$get_groupmenu	= $this->mmenu->getMenuToGroup($where_menu)->result_array();
		}

		if(count($get_group) > 0 && count($get_groupmenu) > 0){
		    if($type == 'edit'){ $disabled = ''; }else{ $disabled = 'disabled="disabled"';}

			$print = '
		            <div class="form-group">
		              <label for="groupName" class="form-control-label">Group Name</label>
		              <input type="text" class="form-control" id="vgroupName" name="vgroupName" value="'.$get_group['groupname'].'" '.$disabled.'>
		              <input type="hidden" id="idGroup" name="idGroup" value="'.$id.'">
		              <input type="hidden" id="url" name="url" value="'.$url.'">
		              <input type="hidden" id="type" name="type" value="Edit">
		            </div>
		            <div class="form-group">
		              <label for="menuList" class="form-control-label">Menu List</label>
		              <div class="form-control outer-table">
		                <table class="table table-bordered">
		                  <thead>
		                    <th>
		                      <td>
		                        <b>Title</b>
		                      </td>
		              ';

		    if($type == 'edit'){
		    $print .= '            
		                      <td align="center">
		                        <input type="checkbox" name="chkall" id="chkall" class="minimal chkall">
		                      	<p>All</p>
		                      </td>
		                      <td align="center">
		                        <input type="checkbox" name="chkreadall" id="chkreadall" class="minimal chkreadall">
		                      	<p>Read</p>
		                      </td>
		                      <td align="center">
		                        <input type="checkbox" name="chkeditall" id="chkeditall" class="minimal chkeditall">
		                      	<p>Edit</p>
		                      </td>
		                      <td align="center">
		                        <input type="checkbox" name="chkdeleteall" id="chkdeleteall" class="minimal chkdeleteall">
		                      	<p>Delete</p>
		                      </td>
		              ';
		    }else{
		    $print .= '            
		    			<td align="center">
		    			Role
		    			</td>
		    		  ';	
		    }

		    $print .= '
		                    </th>
		                  </thead>
		                  <tbody>
		              ';
		    
		    $n = 0; foreach ($get_groupmenu as $row) { $n++; 
            $print .= '
		                <tr>
		                  <td align="center">
		                    '.$n.'
		                  </td>
		                  <td>
		                    '.$row['menu'].'
		                  </td>
		              ';
			$get_checked	= $this->mgroupmenu->getGroupMenuId($id,$row['id'])->row_array();
			if($get_checked['menuall'] 	  == '1'){ $allchecked 	  = 'checked'; $allket    = 'All' ;   }else{ $allchecked 	 = '';$allket    = ''; }
			if($get_checked['menuread']   == '1'){ $readchecked   = 'checked'; $readket   = 'Read';   }else{ $readchecked 	 = '';$readket   = ''; }
			if($get_checked['menuedit']   == '1'){ $editchecked   = 'checked'; $editket   = ',Edit';   }else{ $editchecked 	 = '';$editket   = ''; }
			if($get_checked['menudelete'] == '1'){ $deletechecked = 'checked'; $deleteket = ',Delete'; }else{ $deletechecked  = '';$deleteket = ''; }

		    if($type == 'edit'){
		    
		    $print .= '
		                  <td align="center">
		                    <input type="checkbox" name="cb_menu[]" id="cb_menu[]" data-index="'.($n-1).'" data-error=".result" class="minimal chkmenu" value="'.$row['id'].'" '.$allchecked.'>
		                  </td>
						  <td align="center">
	                        <input type="checkbox" name="cb_read[]" id="cb_read[]" data-index="'.($n-1).'" data-error=".result" class="minimal chkread" value="'.$row['id'].'" '.$readchecked.'>
	                      </td>
	                      <td align="center">
	                        <input type="checkbox" name="cb_edit[]" id="cb_edit[]" data-index="'.($n-1).'" data-error=".result" class="minimal chkedit" value="'.$row['id'].'" '.$editchecked.'>
	                      </td>
	                      <td align="center">
	                        <input type="checkbox" name="cb_delete[]" id="cb_delete[]" data-index="'.($n-1).'" data-error=".result" class="minimal chkdelete" value="'.$row['id'].'" '.$deletechecked.'>
	                      </td>
		              ';
		    }else{

		    $print .= '
		    			<td align="center">
		    			'.$readket.$editket.$deleteket.'
		    			</td>	
		    		  ';	

		    }

		    $print .= '
		                </tr>
            		  ';
		    } 

		   	$print .= '		                     
		                  </tbody>
		                </table>
		              </div>
		              <div class="result has-error"></div>
		             </div>
					<script>
						$(".chkall").click(function () {
						    $("input:checkbox").not(this).prop("checked", this.checked);
						});		
					</script>			 
					  ';

			die($print);
		}else{
			die('');
		}
	}

	function edit_group(){
		$id = $this->input->post('id');

		$data = array(
						'groupname' => $this->input->post('name') 
					 );
		$data_menu  = $this->input->post('menu');
		$data_read 	= $this->input->post('read');
		$data_edit 	= $this->input->post('edit');
		$data_delete= $this->input->post('delete');


		$check_id = $this->mgroupmenu->getIdGroup($id)->row_array();

		if(count($check_id) == 0){
			die('Failed');
		}else{
			$insert = $this->mgroupmenu->update($id,$data); // Saving Group
			
			if($insert){
				$delete = $this->mgroupmenu->delete_groupmenu($id);

				if($delete){
					for($i=0;$i<count($data_menu);$i++) {
						$data_group_menu = array(
													'idgroup' => $id,
													'idmenu'  => $data_menu[$i]
												);
						$this->mgroupmenu->insert_groupmenu($data_group_menu);
					}

					for($i=0;$i<count($data_read);$i++){
						$data_group_menu = array(
													'idgroup' => $id,
													'idmenu'  => $data_read[$i],
													'menuread'=> '1'
												);
						$check = $this->mgroupmenu->getGroupMenuId($id,$data_read[$i])->num_rows();
						
						if($check > 0){
							$this->mgroupmenu->update_groupmenu($id,$data_group_menu,$data_read[$i]);
						}else{
							$this->mgroupmenu->insert_groupmenu($data_group_menu);
						}
					}

					for($i=0;$i<count($data_edit);$i++){
						$data_group_menu = array(
													'idgroup' => $id,
													'idmenu'  => $data_edit[$i],
													'menuedit'=> '1'
												);
						$check = $this->mgroupmenu->getGroupMenuId($id,$data_edit[$i])->num_rows();
						
						if($check > 0){
							$this->mgroupmenu->update_groupmenu($id,$data_group_menu,$data_edit[$i]);
						}else{
							$this->mgroupmenu->insert_groupmenu($data_group_menu);
						}
					}

					for($i=0;$i<count($data_delete);$i++){
						$data_group_menu = array(
													'idgroup' => $id,
													'idmenu'  => $data_delete[$i],
													'menudelete'=> '1'
												);
						$check = $this->mgroupmenu->getGroupMenuId($id,$data_delete[$i])->num_rows();
						
						if($check > 0){
							$this->mgroupmenu->update_groupmenu($id,$data_group_menu,$data_delete[$i]);
						}else{
							$this->mgroupmenu->insert_groupmenu($data_group_menu);
						}
					}

					die('Success');
				}else{
					die('Failed');
				}

			}else{
				die('Failed');
			}
		}
	}

	function delete_group(){
		$id = $this->input->post('id');

		$delete_group 		= $this->mgroupmenu->delete($id);
		$delete_groupmenu	= $this->mgroupmenu->delete_groupmenu($id);

		if($delete_group && $delete_groupmenu){
			die('Success');
		}else{
			die('Failed');
		}
	}

	function multiple_action(){
		$role = $this->input->post('role');
		$id   = $this->input->post('id');

		$n = 0;
		for($i=0;$i<count($id);$i++){
			if($role == 'publish' || $role == 'unpublish'){
				if($role == 'publish'){
					$data = array( 'status' => '1', );
				}else{
					$data = array( 'status' => '0', );
				}

				$update = $this->mmenu->update($id[$i],$data);
				if($update){
					$n++;
				}
			}elseif($role == 'delete'){
				
				$checkDefault = $this->mmenu->getById($id[$i])->row_array();
				$fileName 	  = strtolower($checkDefault['menu']);

				if($checkDefault['default'] != '1'){
					$delete = $this->mmenu->delete($id[$i]);
					
					if($this->mmenu->delete($id[$i])){
						$this->marge->delete_mvc($fileName);
						$this->marge->delete_routes($fileName);
						$this->marge->delete_autoload($fileName);
						$this->mgroupmenu->deleteWhere('idmenu = '.$id[$i]);
						$n++;
					}
					$n = 1;
				}else{
					$n = FALSE;
				}
			}else{
				$n = FALSE;
			}
		}

		if($n == count($id)){
			die('Success');
		}else{
			die('Failed');
		}
	}

	function index_text(){
	    $f = "application/views/template/modal.php";

	    $start = "/*edit childsubmisc*/";
	    $end   = "/* --- edit childsubmisc --- (END)*/";

	    $arr = file($f);
	    $text = '';

	    $n = 0; $row = 0;
	    foreach ($arr as $key=> $line) { $row++;

	        //removing the line
	        if(stristr($line,$start) == true){
	        	
	        	$n = 1;
	        }

	        if($n == 1){
	        	$text .= $row."\t".$arr[$key].'<br>';
	        	unset($arr[$key]);
	        }

	        if(stristr($line,$end) == true){
	        	break;
	        }
	    }

	    echo $text;
	
	    //reindexing array
	    //$arr = array_values($arr);

	    //writing to file
	    //file_put_contents($f, implode($arr));
	}
}
