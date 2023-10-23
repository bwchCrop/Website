<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}	
	}

	public function index($path = ''){
		// set_time_limit(0);
		// error_reporting(0);

		// if(get_magic_quotes_gpc()){
		// 	foreach($_POST as $key=>$value){
		// 		$_POST[$key] = stripslashes($value);
		// 	}
		// }

		if($path != ''){//if(isset($_GET['path'])){ 
			$path = str_replace('+','/',$path); //$_GET['path'];
		}else{
			$path = getcwd().'/documents';
		}

		$path = str_replace('\\','/',$path);
		$paths = explode('/',$path);

		$username = $this->session->userdata(_PREFIX.'username');

		$data = array(
						'titlebar' 	=> 'Admin | Gallery',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'content'	=> 'admin/gallery/index_',
						'modal'  	=> 'admin/gallery/modal',
						'title'		=> 'Gallery',
						'result'	=> '',//$this->mbrand->getAll()->result_array()
						'path'		=> $path,
						'paths'		=> $paths,
						'scandir' 	=> scandir($path),
						'pa' 		=> getcwd(),
					 );

		$this->load->view('template/main',$data);
	}

	public function index_($path = ''){
		// set_time_limit(0);
		// error_reporting(0);

		// if(get_magic_quotes_gpc()){
		// 	foreach($_POST as $key=>$value){
		// 		$_POST[$key] = stripslashes($value);
		// 	}
		// }

		if($path != ''){//if(isset($_GET['path'])){ 
			$path = str_replace('+','/',$path); //$_GET['path'];
		}else{
			$path = getcwd().'/documents';
		}

		$path = str_replace('\\','/',$path);
		$paths = explode('/',$path);

		$username = $this->session->userdata(_PREFIX.'username');

		$data = array(
						'titlebar' 	=> 'Admin | Gallery',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'content'	=> 'admin/gallery/index_',
						'modal'  	=> 'admin/gallery/modal',
						'title'		=> 'Gallery',
						'result'	=> '',//$this->mbrand->getAll()->result_array()
						'path'		=> $path,
						'paths'		=> $paths,
						'scandir' 	=> scandir($path),
						'pa' 		=> getcwd(),
					 );

		$this->load->view('template/main',$data);
	}

	function action($option = '', $get = 'false', $file = ''){ //, $path = '', $opt = '', $name = '', $type = ''){
		$path = $this->input->post('path',true);
		$opt  = $this->input->post('opt',true);
		$name = $this->input->post('name',true);
		$type = $this->input->post('type',true);
		if($file == ''){
			$file = $this->input->post('file',true);
		}

		if($option == 'filesrc'){
			if($get == 'false'){

				//echo "<tr><td><center>Current File : ";
				//echo $_GET['filesrc'];
				$path 		= str_replace('+', '/', $path);
				$file 		= str_replace('+', '.', $file);

				$filesrc 	= $path.'/'.$file;

				$text  = '';
				// $text .=  '<div class="form-group">';
				// $text .= '	<textarea class="form-control" rows="18">';
				// $text .= 	htmlspecialchars(file_get_contents($filesrc));
				// $text .= '	</textarea></div>';

				$text .= '	<input type="hidden" id="opt" name="opt" value="'.$opt.'"> ';
				$text .= '	<input type="hidden" id="type" name="type" value="'.$type.'"> ';
				$text .= '	<input type="hidden" id="path" name="path" value="'.$path.'"> ';
				$text .= '	<input type="hidden" id="file" name="file" value="'.$file.'"> ';
				$text .= '	<div id="veditor">';
				$text .= 	htmlspecialchars(file_get_contents($filesrc));
				$text .= '	</div>';

				die($text);
			}elseif($get == 'photo'){
				$file 		= $this->input->post('file',true);
				$path 		= str_replace('+', '/', $path);
				$file 		= str_replace('+', '.', $file);
				$filesrc 	= base_url().$path.'/'.$file;
				$text 		= '';

				$text .= '<img src="'.$filesrc.'" style="box-shadow: 0 3px 9px rgba(0,0,0,.5); max-width:100%;" />';

				die($text);				
			}else{
				$Pathfile 	= str_replace('+', '/', $get);
				$file 		= explode('+', $file);
				$filename 	= $file[0].'.'.$file[1];
 				$data = file_get_contents($Pathfile.$filename);

				force_download($filename,$data);
			}
		}elseif($option == 'option' && $opt != 'delete' && $type == 'file'){
			//Chmod
			if($opt == 'chmod'){
				if(isset($_POST['perm'])){
					if(chmod($_POST['path'],$_POST['perm'])){
						echo '<font color="green">Change Permission Done </font><br />';
					}else{
						echo '<font color="red">Change Permission Error </font><br />';
					}
				}

				$patc = "$path/$name";

				echo '<form method="POST">
				Permission : <input name="perm" type="text" size="4" value="'.substr(sprintf('%o', fileperms($patc)), -4).'" />
				<input type="hidden" name="path" value="'.$_POST['path'].'">
				<input type="hidden" name="opt" value="chmod">
				<input type="submit" value="Go" />
				</form>';
			}

			//
			elseif($opt == 'btw'){
				$cwd = getcwd();
				 echo '<form action="?option&path='.$cwd.'&opt=delete&type=buat" method="POST">
						New Name : <input name="name" type="text" size="20" value="Folder" />
						<input type="hidden" name="path" value="'.$cwd.'">
						<input type="hidden" name="opt" value="delete">
						<input type="submit" value="Go" />
						</form>';
			}

			//Rename file V
			elseif($opt == 'nfile'){
				$exfile 	= explode('+', $file);
				$refile 	= str_replace('+', '.', $file);
				$repath 	= str_replace('+', '/', $path);

				if(count($exfile) > 1){ $ext = $exfile[1]; }else{ $ext = 'dir'; }

				if($get == 'false'){

					$patc 	= "$path/$name";
					$text 	= '';

					$text .=   	'<div class="form-group">
					              <label for="name" class="form-control-label">Name</label>
					              <input type="text" class="form-control" id="name" name="name" value="'.$name.'"/>
					              <input type="hidden" name="oldname" id="oldname" value="'.$name.'"/>
					              <input type="hidden" name="opt" id="opt" value="'.$opt.'"/>
					              <input type="hidden" name="type" id="type"/ value="'.$type.'">
					              <input type="hidden" name="path" id="path"/ value="'.$path.'">
					              <input type="hidden" name="ext" id="ext"/ value="'.$ext.'">
					            </div>';

					die($text);
				}else{
					$ext     = $this->input->post('ext',true);
					$oldname = $this->input->post('oldname',true);

					if($ext == 'folder'){
						$old 	= $repath.'/'.$oldname;
						$new 	= $repath.'/'.$name;
					}else{
						$old 	= $repath.'/'.$oldname.'.'.$ext;
						$new 	= $repath.'/'.$name.'.'.$ext;
					}

					if(rename($old, $new)){
						die('Success');
					}else{
						die($old.' - '.$new);
					}
				}
			}

			//File baru V
			elseif($opt == 'cfile'){
				
				$path = str_replace('+', '/', $path); 
				$patc = "$path/$name."."php";

				$fp = fopen($patc,'w');

				if(fwrite($fp,'test')){
					fclose($fp);
					die('Success');
				}else{
					fclose($fp);
					die($path);
				}
			}

			//Edited file V
			elseif($opt == 'efile'){
				$path = str_replace('+', '/', $path); 
				$patc = "$path/$file";

				if(isset($_POST['code'])){
					$content 	= $this->input->post('code'); 
					$fp 		= fopen($patc,'w');

					if(fwrite($fp,$content)){
						fclose($fp);
						die('Success');
					}else{
						fclose($fp);
						die($path);
					}
				}
			}

			//Delete file V
			elseif($opt == 'rfile'){
				$exfile 	= explode('+', $file);
				$refile 	= str_replace('+', '.', $file);
				$repath 	= str_replace('+', '/', $path);

				$patc = "$repath/$refile";

				if(unlink($patc)){
					die('Success');
				}else{
					die($patc);
				}
			}
		}elseif($option == 'upload'){
			$path 	= $this->input->post('pathupload');
			$repath = str_replace('+', '/', $path);
			$file 	= $this->input->post('file');
			if(isset($_FILES['file'])){
				if(copy($_FILES['file']['tmp_name'],$repath.'/'.$_FILES['file']['name'])){
					$this->session->set_flashdata('message', 
					'<div id="message" class="alert alert-success alert-dismissible">
	                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                	File Uploaded..
	              	 </div>
	              	');
					redirect('admin-gallery-index/'.$path);
				}else{
					$this->session->set_flashdata('message', 
					'<div id="message" class="alert alert-danger alert-dismissible">
	                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                	Upload Failed..
	              	 </div>
	              	');
					redirect('admin-gallery-index/'.$path);
				}
			}else{
				$this->session->set_flashdata('message', 
				'<div id="message" class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	Upload Failed..
              	 </div>
              	');
				redirect('admin-gallery-index/'.$path);
			}
		}else{
				
			$patc = "$path/$name";

			//Delete dir V
			if($opt == 'rdir'){
				$repath 	= str_replace('+', '/', $path);

				$patc = "$repath/$file";

				if(rmdir($patc)){
					die('Success');
				}else{
					die($patc);
				}
			}

			//buat folder V
			if($opt == 'cdir'){

				$path = str_replace('+', '/', $path); 
				$patc = "$path/$name";

				if(mkdir($patc)){
					die('Success');
				}else{
					die($patc);
				}
			}
		}
	}
}
