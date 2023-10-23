<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filemanager extends CI_Controller {

	function __construct(){
		parent::__construct();

		if($this->session->userdata(_PREFIX.'login') == FALSE){
			$this->session->set_userdata(_PREFIX.'lasturl', current_url());
			redirect('admin-log-in');
		}
	}

	public function index($path = ''){
		if($path != ''){
			$decrypt_path = $this->marge->decrypt($path);

			$path = str_replace('+','/',$decrypt_path);

			if(!$path){
				$path = getcwd();
			}
		}else{
			$path = getcwd().'';
		}

		$path = str_replace('\\','/',$path);
		$paths = explode('/',$path);

		$username = $this->session->userdata(_PREFIX.'username');

		$data = array(
						'titlebar' 	=> 'Admin | Filemanager',
						'menu'		=> $this->mmenu->getParent()->result_array(),
						'content'	=> 'admin/filemanager/index',
						'modal'  	=> 'admin/filemanager/modal',
						'title'		=> 'Filemanager',
						'result'	=> '',//$this->mbrand->getAll()->result_array()
						'path'		=> $path,
						'paths'		=> $paths,
						'scandir' 	=> scandir($path),
						'pa' 		=> getcwd(),
					 );

		$this->load->view('template/main',$data);
	}

	function action($option = '', $get = 'false', $file = ''){
		$path = $this->input->post('path',true);
		$opt  = $this->input->post('opt',true);
		$name = $this->input->post('name',true);
		$type = $this->input->post('type',true);
		if($file == ''){
			$file = $this->input->post('file',true);
		}

		$decrypt_path = $this->marge->decrypt($path);

		if($option == 'filesrc'){
			if($get == 'false'){

				$path 		= str_replace('+', '/', $path);
				$file 		= str_replace('+', '.', $file);

				$filesrc 	= $path.'/'.$file;

				$text  = '';

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
				$path 		= str_replace('+', '/', $decrypt_path);
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

			//File baru VV
			elseif($opt == 'cfile'){
				
				$path = str_replace('+', '/', $decrypt_path); 
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

			//buat folder VV
			if($opt == 'cdir'){

				$path = str_replace('+', '/', $decrypt_path); 
				$patc = "$path/$name";

				if(mkdir($patc)){
					die('Success');
				}else{
					die($patc);
				}
			}
		}
	}

	//TESTING MARGE LIBRARIES
	function sendmail(){
		$link 	= base_url();
		$email 	= 'darmawan@designcub3.com';

		if ($this->agent->is_browser())
		{
		        $agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
		        $agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
		        $agent = $this->agent->mobile();
		}
		else
		{
		        $agent = 'Unidentified User Agent';
		}

		$email_content = '<p style="font-size: 12px;">Well done! You successfully read this important alert message.</p>
						  <p style="font-size: 12px;">	
							  Date    : '.date('d F Y H:i:s').'<br/>
							  Browser : '.$agent.'<br/>
							  OS      : '.$this->agent->platform().'
							  <br/>
						  </p>	
						  <br/>
						  <div style="background: grey; width: 100px; padding: 10px;">
						  <a style="text-decoration: none; padding: 15px; color: #fff;" href="mailto:'.$email.'">Reply</a>
						  </div>	
						 ';

        $data_html = array( 
        					'title'=> 'TEST EMAIL'._PT,
        					'name' => 'Tester',
        					'email_content' => $email_content,
        				  );
		
		$message = $this->load->view('front/template/responsive_email',$data_html,TRUE);


		$data =	array(
	 					'subject'	=> 'TEST EMAIL'._PT,
	 					'from'		=> 'no-reply@'._DOMAIN.','._PT,
	 					'to'		=> $email,
	 					'cc'		=> array('kamargelap29@gmail.com'),
	 					'bcc'		=> array('darmawandeny29@gmail.com'),
	 					'message'	=> $message,
	 					'attach'	=> array(),
	  				 );

		$send = $this->marge->send_mail($data);

		if($send == 'true'){
			echo 'Well done! You successfully read this important alert message.';
		}else{
			echo 'Oh snap! Change a few things up and try submitting again.<br><br>'.$send;
		}
	}

	function upload(){
		$status = $this->input->post('status');

		if($status == '1'){
			$field = array(
							'name' 	=> 'testupload',
							'exec' 	=> 'rename',
							'rename'=> 'upload_'.$this->marge->date_ID(date('Y-m-d H:i:s'),'Y_m_d_His'),
						  );

			$upload = $this->marge->upload($field, 'upload_path=./export/&max_size=900');

			if(is_array($upload)){
				echo '<pre>';
				print_r($upload);
			}else{
				echo $upload;
			}
		}else{
			$view  = "<form action='".base_url('admin/filemanager/upload')."' method='POST'  enctype='multipart/form-data'>";
			$view .= "<input type='hidden' name='status' id='status' value='1'/>";
			$view .= "<input type='file' name='testupload' id='testupload'/>";
			$view .= "<input type='submit' name='submit' value='submit'/>";
			$view .= "</form>";

			echo $view;
		}
	}

	function getip(){
		$get = $this->marge->getUserIP();

		echo $get;
	}

	function activity(){
		$get = $this->marge->record_activity('Masuk');

		echo $get;
	}

	function backup_zip(){
		$get_name 	= 'template-admin';
		$get_ext  	= '.zip';
		$final_name = $get_name.$get_ext;

		$path 	= dirname(__FILE__);
		$xpath 	= explode('\\', $path);
		$countpath = count($xpath);
		$countpath = $countpath - 3;

		$dirpath = '';
		for($i=0; $i < $countpath; $i++) {
			if($i == 0){ $backslash = '';}else{ $backslash = '\\';}

			$dirpath .= $backslash.$xpath[$i];
		}

		// echo $path.'<br>';
		// echo $dirpath.'<br>';
		// echo basename($dirpath);

		$createZIP = $this->marge->create_zip($dirpath, $final_name, $overwrite = true);

		if($createZIP){
			echo 'success';
		}else{
			echo 'failed';
		}
	}
}
