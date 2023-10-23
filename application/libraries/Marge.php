<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* -----------------------------------------------------------------------------
 | 
 | File 		: Marge.php (v.1.2) Codeigniter 
 | Author 		: Darmawan Deny - @denyDDF (mailto: deny@kamargelap.id)
 | Date 		: 2017/08/23
 | Coor 		: Designcub3 
 | Method   	: Create Custom MVC, Updating Autoload(model)/Routes/Constants, 
 |			  	  file permission(File Manager), Easy Encrypt & Decrypt String,
 |			  	  Easy Config/Send Email, Easy Config/Upload file, Indonesian FormatDate,
 |			  	  DB Table Operation(CREATE,DROP,DLL..), Delete/Update Content of File
 | Requirement 	: Load Library(encrypt, email), Constants.php(Custom)
 | Note 		: Do not remove/clear any mark/quote inside the file(controllers,
 |				  models,views) that created by this library
 |
 | -----------------------------------------------------------------------------			  
 */

class Marge{

	private $CI;
	private $thisDate;
	private $thisFormat;
	private $thisMonthDate;
	private $allowedTypes;

    public function __construct($params = NULL){
		$this->CI 				= &get_instance();
		$this->thisDate 		= date('Y-m-d H:i:s');
		$this->thisFormat 		= 'Y-m-d H:i:s';
		$this->thisMonthDate 	= date('F');
		$this->uploadPath 		= './uploads/';
		$this->allowedTypes 	= 'zip|gif|jpg|png|pdf|txt|doc|docx|ppt|pptx|xls|xlsx|php|js|css|scss';
    }

    public function db_exec($operation,$field = array()){
		/* -------------------------------------------------------------
		 |	#example $field content (array) :
		 | -------------------------------------------------------------
		 |	$field =  array(
		 |					'table'		=> '',
		 |					'collumn'	=> array(
		 |											'0' => array(
		 |															'0' => fieldname,
		 |															'1' => typedata,
		 |															'2' => length,
		 |															'3' => NULL/NOTNULL,
		 |														),
		 |										),
		 | 				   );
		 |
		 | -------------------------------------------------------------
		 */    	

    	switch ($operation) {
    		case 'create':

    			$query  = "CREATE TABLE "._PREFIX.$field['table']."(
								".$field['table']."_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY
								";
				
				foreach($field['collumn'] as $row){

				$length = '';
				if($row['2'] != ''){
					$length = "(".$row['2'].")";
				}

				$query .= ",".$field['table']."_".$row['0']." ".$row['1'].$length." ".$row['3'];
				
				}								

				$query .= "
							)
						  ";

    			break;

    		case 'alter':
    			$query = "

    			 		 ";
    			
    			break;
    		
    		case 'delete':
    			$query = "

    					 ";
    			
    			break;

    		case 'truncate':
    			$query = "

    					 ";
    			
    			break;

    		case 'drop':
    			$query = "DROP TABLE IF EXISTS "._PREFIX.$field['table'];
    			
    			break;

    		default:
    			$query = "

    					 ";
    			
    			break;
    	}

    	$this->CI->db->query($query);

    	return $query;
    }

	public function encrypt($string = ''){
		$strencrypt = $this->CI->encryption->encrypt($string);
		$strencrypt = str_replace(array('/'), array('_'), $strencrypt);

		return $strencrypt;
	}

	public function decrypt($string = ''){
		$strdecrypt = str_replace(array('_'), array('/'), $string);
		$strdecrypt = $this->CI->encryption->decrypt($strdecrypt);

		return $strdecrypt;
	}

	public function send_mail($data = '', $config = FALSE){
        
		/* -------------------------------------------------------------
		 |	#example $config content (array) :
		 | -------------------------------------------------------------
		 |	$config = array(
		 |					'protocol'	=> '',
		 |					'smtp_host'	=> '',
		 |					'smtp_port'	=> '',
		 |					'smtp_user'	=> '',
		 |					'smtp_pass'	=> '',
		 |					'charset'	=> '',
		 |					'mailtype'	=> '',
		 |					'newline'	=> '',
		 | 				   );
		 |
		 | -------------------------------------------------------------
		 */

		if( !is_array( $config ) ){//&& !$config instanceof Traversable ){
			
			if($config == FALSE){
				$config = _PROTOCOL;
			}

			if( $config == 'smtp' ){
				$config 			 = array();
		        $config['protocol']  = "smtp";
		        $config['smtp_host'] = "ssl://smtp.gmail.com";
		        $config['smtp_port'] = "465";
		        $config['smtp_user'] = _USEREMAIL;
		        $config['smtp_pass'] = _EMAILPASS;
			}elseif( $config == 'mail' ){
				$config 			= array();
		        $config['protocol'] = "mail";
			}else{
				$config 			= array();
		        $config['protocol'] = "sendmail";
			}

	    	$config['charset'] 	= "utf-8";
	    	$config['mailtype'] = "html";
	    	$config['newline'] 	= "\r\n";
		}else{
			if( !isset($config['charset']) || $config['charset'] == ''  ){
		    	$config['charset'] 	= "utf-8";
			}

			if( !isset($config['mailtype']) || $config['mailtype'] == ''  ){
		    	$config['mailtype'] = "html";
			}

			if( !isset($config['newline']) || $config['newline'] == ''  ){
		    	$config['newline'] 	= "\r\n";
			}			
		}


		/* -------------------------------------------------------------
		 |	#example $data content (array) :
		 | -------------------------------------------------------------
		 |	$data 	= array(
		 |					'subject'	=> '',
		 |					'from'		=> '',
		 |					'to'		=> array(),
		 |					'cc'		=> array(),
		 |					'bcc'		=> array(),
		 |					'message'	=> '',
		 |					'attach'	=> array(),
		 | 				   );
		 |
		 | -------------------------------------------------------------
		 */

		// Check $data is array
		if(is_array( $data )){

		/* ---- Email Subject ---- */
	    	if ( !isset($data['subject']) || $data['subject'] == '' ){

	    		$subject = 'SU : EMAIL TESTING ( '.date('M d, Y - H:i:s').') ';
	    	}else{

	    		$subject = $data['subject'];
	    	}
	    /* -- End Email Subject -- */

		/* ---- Email From ---- */ 
	    	if ( !isset($data['from']) || $data['from'] == '' ){
	    		$from 		= 'no-reply@'._DOMAIN;
	    		$aliasFrom 	= _PT;
	    	}else{
	    		$from 		= $data['from'];
	    		$result 	= explode(',', $from);

	    		if(count($result)>1){
		    		$from 		= $result[0];
		    		$aliasFrom	= $result[1];
	    		}else{
		    		$from 		= $from;
		    		$aliasFrom	= '';
	    		}
	     	}
	    /* -- End Email From -- */

		/* ---- Email To ---- */
	        if(is_array( $data['to'] )){	
	        	$count 	= count($data['to']);

	        	if($count > 0){
	        		$to = '';
	        		for($i=0 ; $i<$count ; $i++){
	        			if( $count == $i+1){
		        			$to .= $data['to'][$i];
	        			}else{
		        			$to .= $data['to'][$i].',';
	        			}
	        		}
	        	}else{ 
	        		$to = _CSEMAIL;
	        	}
	        }else{
	        	if ( !isset($data['to']) || $data['to'] == '' ){
	        		$to = _CSEMAIL;
	        	}else{
	        		$to = $data['to'];
	        	}
	        }
	    /* -- End Email To -- */

		/* ---- Email Message ---- */
	    	if( !isset($data['message']) || $data['message'] == '' ){

	    		$message = 'Well done! You successfully send email message.';
	    	}else{

	    		$message = $data['message'];
	    	}
	    /* -- End Email Message -- */

       	/* ---- Email CC ---- */
    		$cc = '';

	        if(is_array( $data['cc'] )) {
	        	
	        	$count 	= count($data['cc']);

	        	if($count > 0){

	        		for($i=0 ; $i<$count ; $i++){
	        			if( $count == $i+1){
		        			$cc .= $data['cc'][$i];
	        			}else{
		        			$cc .= $data['cc'][$i].',';
	        			}
	        		}

			        //$this->CI->email->cc($cc);
	        	}
	        }else{

	        	if ( isset($data['cc']) || $data['cc'] != '' ){
			        //$this->CI->email->cc($data['cc']);
			        $cc = $data['cc'];
	        	}
	        }
	    /* -- End Email CC -- */

	    /* ---- Email BCC ---- */
    		$bcc = '';

	        if (is_array( $data['bcc'] )) {
	        	
	        	$count 	= count($data['bcc']);

	        	if($count > 0){

	        		for($i=0 ; $i<$count ; $i++){
	        			if( $count == $i+1){
		        			$bcc .= $data['bcc'][$i];
	        			}else{
		        			$bcc .= $data['bcc'][$i].',';
	        			}
	        		}

			        //$this->CI->email->bcc($bcc);
	        	}
	        }else{

	        	if ( isset($data['bcc']) || $data['bcc'] != '' ){
			        //$this->CI->email->bcc($data['bcc']);
			        $bcc = $data['bcc'];
	        	}
	        }
	    /* -- End Email BCC -- */

       	/* ---- Email Attach ---- */
	        if (is_array( $data['attach'] )) {
	        	$count 	= count($data['attach']);

	        	if($count > 0){
	        		for($i=0 ; $i<$count ; $i++){
			        	$this->CI->email->attach($data['attach'][$i]);
	        		}
	        	}
	        }else{
	        	if( isset($data['attach']) || $data['attach'] != '' ){
			        $this->CI->email->attach($data['attach']);
	        	}
	        }
       	/* -- End Email Attach -- */
		}else{
	    	
	    	$subject 	= 'SU : EMAIL TESTING ( '.date('M d, Y - H:i:s').') ';
    		$from 		= 'no-reply@'._DOMAIN;
    		$aliasFrom 	= _PT;
	        $to 		= _CSEMAIL;
	    	$message 	= 'Well done! You successfully send email message.';
		}

        $this->CI->email->initialize($config);
        $this->CI->email->subject($subject);
        $this->CI->email->from($from, $aliasFrom);
        $this->CI->email->to($to);

        if($cc  != ''){ $this->CI->email->cc($cc)  ; }
        if($bcc != ''){ $this->CI->email->bcc($bcc); }
        
        $this->CI->email->message($message);

        if($this->CI->email->send()){
        	return 'true';
        }else{
        	return $this->CI->email->print_debugger();
        }
	}

	public function upload($field = FALSE, $config = FALSE){

		/* -------------------------------------------------------------
		 |	#example $config content (array) :
		 | -------------------------------------------------------------
		 |	$config = array(
		 |						'upload_path' 	=> '',
		 |						'allowed_types' => 'zip|gif|jpg|png|pdf|txt|doc|docx|ppt|pptx|xls|xlsx|php|js|css|scss',
		 |				        'max_size' 		=> '2048',
		 |						'encrypt_name' 	=> FALSE,
		 |						'remove_spaces'	=> TRUE,
		 |						'overwrite'		=> FALSE,
		 |						'max_width' 	=> '0',
		 |						'max_height' 	=> '0',
		 |						'min_width' 	=> '0',
		 |						'min_height' 	=> '0',
		 | 				   );
		 |
		 | -------------------------------------------------------------
		 */

        //configure upload 
		if( !is_array( $config ) ){
			
			if($config == FALSE){

				$config = array(
								'upload_path' 	=> $this->uploadPath,
								'allowed_types' => $this->allowedTypes,
						        'max_size' 		=> '2048',
								'encrypt_name' 	=> FALSE,
								'remove_spaces'	=> TRUE,
								'overwrite'		=> TRUE,
								// 'max_width' 	=> '0',
								// 'max_height' => '0',
								// 'min_width' 	=> '0',
								// 'min_height' => '0',
							   );
			}else{
				$xconfig = explode('=', $config);

				if(count($xconfig) > 1){
					$dconfig = explode('&', $config);
					$config  = array();

					for($i=0; $i<count($dconfig); $i++){
						$xconfig = explode('=', $dconfig[$i]);

						$configkey = $xconfig[0];
						$configval = $xconfig[1];

						$config[$configkey] = $configval;
					}
				}else{
					$xconfig = explode(',', $config);
					$config  = array();

					if(count($xconfig) == 1){
						$config['upload_path'] 		= $xconfig[0];
					}elseif(count($xconfig) == 2){
						$config['upload_path'] 		= $xconfig[0];
						$config['allowed_types'] 	= $xconfig[1];
					}elseif(count($xconfig) == 3){
						$config['upload_path'] 		= $xconfig[0];
						$config['allowed_types'] 	= $xconfig[1];
						$config['max_size'] 		= $xconfig[2];
					}
				}
			}
		}

		if(!isset($config['upload_path']) OR $config['upload_path'] == ''){

			$config['upload_path'] = $this->uploadPath;
		}

		if(!isset($config['allowed_types']) OR $config['allowed_types'] == ''){

			$config['allowed_types'] = $this->allowedTypes;
		}

		if(!isset($config['overwrite']) OR $config['overwrite'] == '' OR $config['overwrite'] == 'TRUE'){
			$config['overwrite'] = TRUE;
			}else{
			$config['overwrite'] = FALSE;
		}

		if(!isset($config['remove_spaces']) OR $config['remove_spaces'] == '' OR $config['remove_spaces'] == 'TRUE'){
			$config['remove_spaces'] = TRUE;
			}else{
			$config['remove_spaces'] = FALSE;
		}

		if($config['encrypt_name'] == 'TRUE'){
			$config['encrypt_name'] = TRUE;
			}else{
			$config['encrypt_name'] = FALSE;
		}

        $this->CI->load->library('upload', $config);

		/* -------------------------------------------------------------
		 |	#example $field content (array parameter) :
		 | -------------------------------------------------------------
		 |	$fileData = array(
		 |						'name' 			=> 'inputname',
		 |						'exec' 			=> 'default/rename',
		 |				        'rename' 		=> 'renamefile',
		 | 				   	 );
		 |
		 | -------------------------------------------------------------
		 */

		//configure field
		if(is_array($field)){
			$fieldname = $field['name'];

			$fileData = array();
			$fileData = $field;
			$fileData['file'] = $_FILES[$fieldname];
		}else{
			$fieldname = $field;

			$fileData = array(
								'file'		=> $_FILES[$fieldname],
								'exec'		=> 'default',
								'name'		=> $fieldname,
								'rename'	=> '',
							 );									 	
		}

        //check file attached
        if(!empty($fileData['file']['name'])){

	        //upload failed
	        if(!$this->CI->upload->do_upload($fileData['name'])){
	            $error = $this->CI->upload->display_errors();

	            return $error;
	        }else{

	            //upload success
	            $file_data = $this->CI->upload->data();
	            $file_name = $file_data['file_name'];

	            if($fileData['exec'] == 'rename'){

		            $file_ext  = explode('.', $file_name);
		            $file_renm = $fileData['rename'].'.'.end($file_ext);
		            $file_path = $config['upload_path'].$file_renm;

		            if(file_exists($file_path)){

			            //delete old file renamed
						if(unlink($config['upload_path'].$file_renm)){	

				            //rename file upload
				            if(move_uploaded_file($fileData['file']["tmp_name"], $file_path)){

				            	//delete file upload that unrename
			            		if(unlink($config['upload_path'].$file_name)){
									return 'true';
								}else{
									return 'true';
								}		            		
			            	}else{
								return 'error #02A : rename failed';
			            	}
			        	}else{
			        		return 'error #01 : delete old file failed';
			        	}
			        }else{

			            //rename file upload
			            if(move_uploaded_file($fileData['file']["tmp_name"], $file_path)){

			            	//delete file upload that unrename
		            		if(unlink($config['upload_path'].$file_name)){
								return 'true';
							}else{
								return 'true';
							}		            		
		            	}else{
							return 'error #02B : rename failed (in condition: old file doesnt exixt)';
		            	}
			        }
	        	}else{
	        		return 'true';
	        	}
	        }
	    }else{
			return 'error #00 : input file not found';
	    }
	}

	public function getDirItems($dir, &$results = array()){
	    $files = scandir($dir);
	    foreach($files as $key => $value){
	        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
	        list($unused_path, $used_path) = explode(basename($dir).'/', $path);
	        $file_name = $dir.DIRECTORY_SEPARATOR.$value;
	        if(!is_dir($path)) {
	            $results[] = $used_path;
	        } else if($value != "." && $value != "..") {
	            $this->getDirItems($path, $results);
	            $results[] = $value.'/';
	        }
	    }
	    return $results;
	}

	public function create_zip($dir, $destination = '', $overwrite = false){

	    // Next Step
	    $files = array();
	    $files = $this->getDirItems($dir);//$results;

		// if the zip file already exists and overwrite is false, return false
		if(file_exists($destination) && !$overwrite) { return false; }

		$valid_files = array();

		if(is_array($files)) {
			foreach($files as $file) {
				if(file_exists($file)) {
					$valid_files[] = $file;
				}
			}
		}

		if(count($valid_files)){
			$zip = new ZipArchive();
			if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
				return false;
			}

			foreach($valid_files as $file) {
				$zip->addFile($file,$file);
			}

			//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
			
			$zip->close();
			
			return file_exists($destination);
		}else{
			return false;
		}
	}

	public function get_ip(){
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

	public function get_agent(){
		if ($this->CI->agent->is_browser()){
		    $agent = $this->CI->agent->browser().' '.$this->CI->agent->version();
		}
		elseif ($this->CI->agent->is_robot()){
		    $agent = $this->CI->agent->robot();
		}
		elseif ($this->CI->agent->is_mobile()){
		    $agent = $this->CI->agent->mobile();
		}
		else{
		    $agent = '(Unidentified User Agent)';
		}

		return $agent;
	}

	public function record_activity($action = 'Login', $user = ''){
		$time 		= '['.date('Y/m/d H:i:s').']';

		if($user == ''){
		    $user 	= '['.$this->CI->session->userdata(_PREFIX.'username').']';
		}else{
		    $user   = '['.$user.']';
		}

		$ip 		= '['.$this->get_ip().']';
		$action 	= ' '.$action;
		$page		= ' on this url : '.current_url();
		$browser	= ' using '.$this->get_agent().' ('.$this->CI->agent->platform().')';
		
		$print 		= $time.$user.$ip.$action.$page.$browser;

		$data = array(
						'text' 		=> $print.PHP_EOL,
						'path' 		=> 'system/activity_log.txt',
						//'endtext' 	=> '/*-END-ACTIVITY-*/',
					 );

		$this->update_content_file($data);

		return $print;
	}

	public function date_ID($date = NULL, $format = NULL){
		if($date == NULL)	{ $date 	= $this->thisDate;}
		if($format == NULL)	{ $format 	= $this->thisFormat;}

		$month 		= date('m',strtotime($date));
		$thismonth	= date('F');

		switch ($month) {
		    case "01":
		        $month = 'Januari';
		        break;
		    case "02":
		        $month = 'Februari';
		        break;
		    case "03":
		        $month = 'Maret';
		        break;
		    case "04":
		        $month = 'April';
		        break;
		    case "05":
		        $month = 'Mei';
		        break;
		    case "06":
		        $month = 'Juni';
		        break;
		    case "07":
		        $month = 'Juli';
		        break;
		    case "08":
		        $month = 'Agustus';
		        break;
		    case "09":
		        $month = 'September';
		        break;
		    case "10":
		        $month = 'Oktober';
		        break;
		    case "11":
		        $month = 'November';
		        break;
		    case "12":
		        $month = 'Desember';
		        break;
		    default:
		    	$month = $thismonth;
		    	break;
		}

        $resultDate = $this->date_format($format, $month, $date);

		return $resultDate;
	}

	public function date_Format($format = NULL, $month = NULL, $getDate = NULL){
		if($format == NULL)		{ $format 	= $this->thisFormat;}
		if($month == NULL)		{ $month 	= $this->thisMonthDate;}
		if($getDate == NULL)	{ $getDate 	= $this->thisDate;}

		$countChar	= strlen($format);
		$date 		= '';

		for($i=0; $i < $countChar; $i++) { 
			$char 	= substr($format, $i, 1);

			switch ($char) {
				case ' ':
					$date .= ' ';
					break;
				case '/':
					$date .= '/';
					break;
				case '-':
					$date .= '-';
					break;
				case '.':
					$date .= '.';
					break;
				case ',':
					$date .= ',';
					break;
				case ':':
					$date .= ':';
					break;
				case ';':
					$date .= ';';
					break;
				case 'y':
					$date .= date('y',strtotime($getDate));
					break;
				case 'Y':
					$date .= date('Y',strtotime($getDate));
					break;
				case 'm':
					$date .= $month;
					break;
				case 'M':
					$date .= $month;
					break;
				case 'F':
					$date .= $month;
					break;
				case 'd':
					$date .= date('d',strtotime($getDate));
					break;
				case 'D':
					$date .= date('D',strtotime($getDate));
					break;
				case 'H':
					$date .= date('H',strtotime($getDate));
					break;
				case 'h':
					$date .= date('h',strtotime($getDate));
					break;
				case 'i':
					$date .= date('i',strtotime($getDate));
					break;
				case 'I':
					$date .= date('I',strtotime($getDate));
					break;
				case 's':
					$date .= date('s',strtotime($getDate));
					break;
				case 'S':
					$date .= date('S',strtotime($getDate));
					break;
				default:
					$date .= $char;
					break;
			}
		}

		return $date;
	}

	public function capital($str = NULL){
		$word  = '';
		$exstr = explode(' ', $str);

		if(count($exstr) > 1){
			for($i = 0; $i < count($exstr); $i++){
				if($i > 0){
					$word  .= ' ';
				}

				$first 	 = substr($exstr[$i], 0,1);
				$firstUp = strtoupper($first);

				$next 	 = substr($exstr[$i], 1);
				$nextLow = strtolower($next);

				$word 	 .= $firstUp.$nextLow;	
			}
		}else{
			$first 	 = substr($str, 0,1);
			$firstUp = strtoupper($first);

			$next 	 = substr($str, 1);
			$nextLow = strtolower($next);

			$word 	 = $firstUp.$nextLow;			
		}

		return $word;
	}

	public function sex($id = NULL){
		switch ($id) {
			case '1':
				$string = 'Laki - Laki';
				break;
			case '0':
				$string = 'Perempuan';
				break;
			default:
				$string = 'Undefined';
				break;
		}

		return $string;
	}

	public function age($datebirth = NULL, $format = NULL){ 
		if($datebirth == NULL){
			return '0';
		}else{
			$todaydate    = date('Y-m-d');
			$date 		  = $datebirth;//date('Y-m-d',$datebirth); 
			$explodetoday = explode('-', $todaydate);
			$explodedate  = explode('-', $date);

			$thisyear 	= $explodetoday[0];
			$thismonth 	= $explodetoday[1];
			$thisday 	= $explodetoday[2];

			$birthYear  = $explodedate[0];
			$birthmonth = $explodedate[1];
			$birthday	= $explodedate[2];

			$age = $thisyear - $birthYear; // 2017 - 2000 = 17

			if($birthmonth > $thismonth){ // NOVEMBER *NOW-SEPTEMBER : AGE != 17 => AGE == 16
				$age = $age - 1;
			}elseif($birthmonth == $thismonth){
				if($birthday > $thisday){
					$age = $age - 1;
				}
			}

			return $age;
		}
	}

	/* --------------------- CREATE,UPDATE,DELETE MVC --------------------- */

	public function create_controllers($fileName,$action = NULL){
		$subs1 		= substr($fileName, 0,1);
		$subs2 		= substr($fileName, 1);
		$capital 	= strtoupper($subs1);
		$lower 		= strtolower($subs2);
		$path		= 'application/controllers/admin/'.$capital.$lower.'.php';
		$text		= '';

		$text	.= "<?php".PHP_EOL;
		$text   .= "defined('BASEPATH') OR exit('No direct script access allowed');".PHP_EOL;
		$text   .= PHP_EOL;
		$text	.= "class ".$fileName." extends CI_Controller {".PHP_EOL;
		$text   .= PHP_EOL;
		$text	.= "\tfunction __construct(){".PHP_EOL;
		$text	.= "\t\tparent::__construct();".PHP_EOL;
		$text	.= PHP_EOL;
		$text	.= "\t\tif($"."this->session->userdata(_PREFIX.'login') == FALSE){".PHP_EOL;
		$text   .= "\t\t\t$"."this->session->set_userdata(_PREFIX.'lasturl', current_url());".PHP_EOL;
		$text	.= "\t\t\tredirect('admin-log-in');".PHP_EOL;
		$text	.= "\t\t}".PHP_EOL;
		$text	.= "\t}".PHP_EOL;
		$text	.= PHP_EOL;
		$text	.= "\tpublic function index(){".PHP_EOL;
		$text	.= "\t\t$"."data = array(".PHP_EOL;
		$text	.= "\t\t\t\t\t\t'content'  	=> 'admin/".strtolower($fileName)."/index',".PHP_EOL;
		$text	.= "\t\t\t\t\t\t'modal'		=> 'template/modal',".PHP_EOL; //'admin/".strtolower($fileName)."/modal',".PHP_EOL;
		$text	.= "\t\t\t\t\t\t'menu'		=> $"."this->mmenu->getParent()->result_array(),".PHP_EOL;
		$text	.= "\t\t\t\t\t\t'titlebar' 	=> 'Admin | ".$fileName."',".PHP_EOL;
		$text	.= "\t\t\t\t\t\t'title'	   	=> '".$fileName."',".PHP_EOL;
		$text	.= "\t\t\t\t\t\t'js'		=> '',".PHP_EOL;
		$text	.= "\t\t\t\t\t\t'role'		=> $"."this->mgroupmenu->getByUser($"."this->session->userdata(_PREFIX.'username'),$"."this->uri->segment(1))->row_array()".PHP_EOL;
		$text	.= "\t\t\t\t\t);".PHP_EOL;
		$text   .= PHP_EOL;
		$text 	.= "\t\t$"."where 		= _PREFIX.'menu.link = \''.$"."this->uri->segment(1).'\'';".PHP_EOL;
		$text 	.= "\t\t$"."checkMenu 	= $"."this->mmenu->getByWhere($"."where)->row_array();".PHP_EOL;
		$text   .= PHP_EOL;
		$text 	.= "\t\tif($"."checkMenu['status'] == '2'){".PHP_EOL;
		$text 	.= "\t\t\t$"."data['result']   	= '';".PHP_EOL;
		$text 	.= "\t\t\t$"."data['content'] 	= 'admin/tempmenu';".PHP_EOL;
		$text 	.= "\t\t\t$"."data['idmenu']	= $"."checkMenu['id'];".PHP_EOL;
		$text 	.= "\t\t\t$"."data['tempstep'] 	= $"."checkMenu['tempstep'];".PHP_EOL;
		$text 	.= "\t\t}else{".PHP_EOL;
		$text 	.= "\t\t\t$"."data['result']   	= $"."this->m".strtolower($capital).$lower."->getAll()->result_array();".PHP_EOL;
		$text 	.= "\t\t}".PHP_EOL;
		$text   .= PHP_EOL;
		$text	.= "\t\t$"."this->load->view('template/main', $"."data);".PHP_EOL;							
		$text	.= "\t}".PHP_EOL;	

		if($action != NULL){
			
		$text 	.= "";
		
		}

		$text	.= "}/*END OF FILE*/".PHP_EOL;					
		
		$open	= fopen($path, "w");
		$kb		= fwrite($open, $text);

		return 'true';
	}

	public function create_models($fileName){
		$path		= 'application/models/M'.strtolower($fileName).'.php';
		$text		= '';

		$text	   .= "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');".PHP_EOL;
		$text	   .= PHP_EOL;
		$text	   .= "class M".strtolower($fileName)." extends CI_Model{".PHP_EOL;
		$text	   .= PHP_EOL;
		$text	   .= "\tpublic function __construct(){".PHP_EOL;
		$text	   .= "\t\tparent::__construct();".PHP_EOL;	
		$text	   .= "\t\t$"."this->table = _PREFIX.'".strtolower($fileName)."';".PHP_EOL;	
		$text	   .= "\t\t$"."this->load->database();".PHP_EOL;	
		$text	   .= "\t}".PHP_EOL;	
		$text	   .= PHP_EOL;	
		$text	   .= "\tpublic function getAll(){".PHP_EOL;	
		$text	   .= "\t\t$"."sql = $"."this->db->get($"."this->table);".PHP_EOL;	
		$text	   .= PHP_EOL;	
		$text	   .= "\t\treturn $"."sql;".PHP_EOL;	
		$text	   .= "\t}".PHP_EOL;	
		$text	   .= PHP_EOL;	
		$text	   .= "\tpublic function getById($"."id){".PHP_EOL;	
		$text	   .= "\t\t$"."this->db->where('".$fileName."_id',$"."id);".PHP_EOL;	
		$text	   .= "\t\t$"."sql = $"."this->db->get($"."this->table);".PHP_EOL;	
		$text	   .= PHP_EOL;	
		$text	   .= "\t\treturn $"."sql;".PHP_EOL;	
		$text	   .= "\t}".PHP_EOL;	
		$text	   .= PHP_EOL;	
		$text	   .= "\tpublic function insert($"."data){".PHP_EOL;	
		$text	   .= "\t\treturn $"."this->db->insert($"."this->table,$"."data);".PHP_EOL;	
		$text	   .= "\t}".PHP_EOL;	
		$text	   .= PHP_EOL;	
		$text	   .= "\tpublic function delete($"."id){".PHP_EOL;	
		$text	   .= "\t\t$"."sql = $"."this->db->delete($"."this->table,array('".$fileName."_id' => $"."id));".PHP_EOL;	
		$text	   .= PHP_EOL;	
		$text	   .= "\t\treturn $"."sql;".PHP_EOL;	
		$text	   .= "\t}".PHP_EOL;	
		$text	   .= PHP_EOL;	
		$text	   .= "\tpublic function update($"."id,$"."data){".PHP_EOL;	
		$text	   .= "\t\t$"."this->db->where('".$fileName."_id',$"."id);".PHP_EOL;	
		$text	   .= "\t\t$"."sql = $"."this->db->update($"."this->table,$"."data);".PHP_EOL;	
		$text	   .= PHP_EOL;	
		$text	   .= "\t\treturn $"."sql; ".PHP_EOL;	
		$text	   .= "\t}".PHP_EOL;	
		$text	   .= "}".PHP_EOL;					
		
		$open	= fopen($path, "w");
		$kb		= fwrite($open, $text);

		return 'true';
	}

	public function create_views($fileName){
		$path		= 'application/views/admin/'.strtolower($fileName);
		$createDir   = mkdir($path, 0700);

		if($createDir){	
			$this->create_viewsindex($fileName);
			// $this->create_viewsmodal($fileName);
		}

		return 'true';
	}

	public function create_viewsindex($fileName,$data = NULL,$action = NULL){

		$tablename  = str_replace(' ', '', $fileName);
		$tablename  = strtolower($tablename);

		$path		= 'application/views/admin/'.strtolower($tablename).'/index.php';
		$text		= '';

		if($data != NULL){
			$text 	   .= "<section class=\"content-header\">".PHP_EOL;
			$text 	   .= "\t<div class=\"box box-solid\">".PHP_EOL;
			$text 	   .= "\t\t<ol class=\"breadcrumb\">".PHP_EOL;
			$text 	   .= "\t\t\t<li><a href=\"<?php echo base_url(''); ?>\"><i class=\"fa fa-dashboard\"></i> Utility</a></li>".PHP_EOL;
			$text 	   .= "\t\t\t<li class=\"active\">Manage ".$fileName."</li>".PHP_EOL;
			$text 	   .= "\t\t</ol>".PHP_EOL;
			$text 	   .= "\t</div>".PHP_EOL;
			$text 	   .= "</section>".PHP_EOL.PHP_EOL;

			$text 	   .= "<div class=\"box\">".PHP_EOL;
			$text 	   .= "\t<div class=\"box-header\">".PHP_EOL;
			$text 	   .= "\t\t<?php echo $"."this->session->flashdata('message');?>".PHP_EOL;
			$text 	   .= "\t\t<h3 class=\"box-title\">&nbsp;".PHP_EOL;

		// ACTION ADD PAGE (BOX)
			if($action['add'] == true){
            $text 	   .= "\t\t\t<?php if($"."role['menudelete'] == '1'){ ?>".PHP_EOL;
            $text 	   .= "\t\t\t\t<a href=\"<?php echo base_url('add-".$tablename."'); ?>\" class=\"btn btn-primary\" id=\"add\"></i> Add </a>".PHP_EOL;
            $text 	   .= "\t\t\t<?php } ?>".PHP_EOL;
        	}

            $text 	   .= "\t\t\t<?php echo $"."title;?>".PHP_EOL;
			$text 	   .= "\t\t</h3> ".PHP_EOL;
			$text 	   .= "\t</div>".PHP_EOL.PHP_EOL;

			$text 	   .= "\t<hr class=\"separator\">".PHP_EOL.PHP_EOL;

			$text 	   .= "\t<div class=\"box-body\">".PHP_EOL;
			$text 	   .= "\t\t<table id=\"example3\" class=\"table table-bordered table-striped\">".PHP_EOL;
			$text 	   .= "\t\t\t<thead>".PHP_EOL;
			$text 	   .= "\t\t\t\t<tr>".PHP_EOL;
                    
		// ACTION EDIT & DELETE (HEADER)
			if($action['delete'] == true && $action['edit'] == true){
            $text 	   .= "\t\t\t\t\t<?php if($"."role['menuedit'] == '1' && $"."role['menudelete'] == '1'){ ?>".PHP_EOL;
            $text 	   .= "\t\t\t\t\t<th class=\"icheck\">".PHP_EOL;
            $text 	   .= "\t\t\t\t\t\t<input type=\"checkbox\" name=\"chkall\" id=\"chkall\" class=\"minimal chkall\" chkurl=\"<?php echo base_url('admin/".$tablename."/multiple_action');?>\">".PHP_EOL;
            $text 	   .= "\t\t\t\t\t</th>".PHP_EOL;
            $text 	   .= "\t\t\t\t\t<?php }else{ ?>".PHP_EOL;
            $text 	   .= "\t\t\t\t\t<th width=\"3%\">No.</th>".PHP_EOL;
            $text 	   .= "\t\t\t\t\t<?php } ?>".PHP_EOL;
	        }else{
            $text 	   .= "\t\t\t\t\t<th width=\"3%\">No.</th>".PHP_EOL;	        	
	        }

			foreach($data as $row){
			$text 	   .= "\t\t\t\t\t<th>".$row['menutemp_field_1']."</th>".PHP_EOL;
			}

		// ACTION EDIT OR DELETE OR PREVIEW (HEADER ACTION)
			if($action['delete'] == true OR $action['edit'] == true OR $action['preview'] == true){
			$text 	   .= "\t\t\t\t\t<th>Action</th>".PHP_EOL;
			}

			$text 	   .= "\t\t\t\t</tr>".PHP_EOL;
			$text 	   .= "\t\t\t</thead>".PHP_EOL;
	        $text 	   .= "\t\t\t<tbody>".PHP_EOL;
	        $text 	   .= "\t\t\t<?php $"."no=0;".PHP_EOL;
	        $text 	   .= "\t\t\t\tforeach ($"."result as $"."data): $"."no++;".PHP_EOL;
	        $text 	   .= "\t\t\t\t?>".PHP_EOL;
	        $text 	   .= "\t\t\t\t<tr>".PHP_EOL;

	        $n = 0;
			foreach($data as $row){
			$datafield  = str_replace(' ', '', $row['menutemp_field_1']);
			$datafield  = strtolower($datafield);
	        $datafield  = $tablename.'_'.$datafield;

	        if($n == 0){

			// ACTION EDIT & DELETE (CHK CONTENT TABLE)
				if($action['delete'] == true && $action['edit'] == true){
                $text  .= "\t\t\t\t\t<?php if($"."role['menuedit'] == '1' && $"."role['menudelete'] == '1'){ ?>".PHP_EOL;
            	$text  .= "\t\t\t\t\t<td width=\"3%\">".PHP_EOL;
            	$text  .= "\t\t\t\t\t\t<input type=\"checkbox\" name=\"cb_menu[]\" id=\"cb_menu[]\" data-error=\".result\" class=\"minimal chkmenu\" value=\"<?php echo $"."data['".$tablename."_id'];?>\" >".PHP_EOL;
            	$text  .= "\t\t\t\t\t</td>".PHP_EOL;
                $text  .= "\t\t\t\t\t<?php }else{ ?>".PHP_EOL;
                $text  .= "\t\t\t\t\t<td><?php echo $"."no;?></td>".PHP_EOL;
                $text  .= "\t\t\t\t\t<?php } ?>".PHP_EOL;
            	}else{
                $text  .= "\t\t\t\t\t<td><?php echo $"."no;?></td>".PHP_EOL;
            	}
	        	$text  .= "\t\t\t\t\t<td><?php echo $"."data['".$datafield."']; ?></td>".PHP_EOL;
	        }else{
	        	$text  .= "\t\t\t\t\t<td><?php echo $"."data['".$datafield."']; ?></td>".PHP_EOL;
	    	}

	    	$n++;
	    	}

		// ACTION EDIT OR DELETE OR PREVIEW
			if($action['delete'] == true OR $action['edit'] == true OR $action['preview'] == true){
			$text 	   .= "\t\t\t\t\t<?php if($"."role['menuedit'] == '1' OR $"."role['menudelete'] == '1' OR $"."role['menuread'] == '1'){ ?>".PHP_EOL;
			$text 	   .= "\t\t\t\t\t<td align=\"center\">".PHP_EOL;

			// ACTION PREVIEW PAGE
				if($action['preview'] == true){
				$text  .= "\t\t\t\t\t\t<?php if($"."role['menuread'] == '1'){ ?>".PHP_EOL;
				$text  .= "\t\t\t\t\t\t\t<a href=\"<?php echo base_url('view-".$tablename."-'.$"."data['".$tablename."_id']); ?>\" class=\"btn bg-green btn-xs\" data-id=\"post\" pk=\"<?php echo $"."data['".$tablename."_id']; ?>\"  url1=\"view-".$tablename."\" url2=\"edit-".$tablename."\">".PHP_EOL;
				$text  .= "\t\t\t\t\t\t\t\t<i class=\"fa fa-laptop\"></i> View".PHP_EOL;
				$text  .= "\t\t\t\t\t\t\t</a>".PHP_EOL;
				$text  .= "\t\t\t\t\t\t<?php } ?>".PHP_EOL;
				$text  .= "\t\t\t\t\t\t&nbsp;".PHP_EOL;
				}

			// ACTION EDIT PAGE
				if($action['edit'] == true){
				$text  .= "\t\t\t\t\t\t<?php if($"."role['menuedit'] == '1'){ ?>".PHP_EOL;
				$text  .= "\t\t\t\t\t\t\t<a href=\"<?php echo base_url('edit-".$tablename."-'.$"."data['".$tablename."_id']); ?>\" class=\"btn bg-purple btn-xs\" data-id=\"post\" pk=\"<?php echo $"."data['".$tablename."_id']; ?>\"  url1=\"view-".$tablename."\" url2=\"edit-".$tablename."\">".PHP_EOL;
				$text  .= "\t\t\t\t\t\t\t\t<i class=\"fa fa-edit\"></i> Edit".PHP_EOL;
				$text  .= "\t\t\t\t\t\t\t</a>".PHP_EOL;
				$text  .= "\t\t\t\t\t\t<?php } ?>".PHP_EOL;
				$text  .= "\t\t\t\t\t\t&nbsp;".PHP_EOL;
				}

			// ACTION DELETE
				if($action['delete'] == true){
				$text  .= "\t\t\t\t\t\t<?php if($"."role['menudelete'] == '1'){ ?>".PHP_EOL;
				$text  .= "\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"delete_list('<?php echo $"."data['".$tablename."_id'];?>','<?php echo base_url('delete-".$tablename."');?>')\" class=\"btn bg-maroon btn-xs delete\" data-id=\"".$tablename."\">".PHP_EOL;
				$text  .= "\t\t\t\t\t\t\t\t<i class=\"fa fa-trash-o\"></i> Delete".PHP_EOL;
				$text  .= "\t\t\t\t\t\t\t</a>".PHP_EOL;
				$text  .= "\t\t\t\t\t\t<?php } ?>".PHP_EOL;
				}

			$text 	   .= "\t\t\t\t\t</td>".PHP_EOL;
			$text 	   .= "\t\t\t\t\t<?php } ?>".PHP_EOL;
            }

	        /*
		        $text 	   .= "\t\t\t\t\t\t<a href=\"#\" class=\"btn bg-olive btn-xs view\" data-id=\"account\" pk=\"<?php echo $"."data['username']; ?>\" url=\"view-account\">".PHP_EOL;
		        $text 	   .= "\t\t\t\t\t\t\t<i class=\"fa fa-laptop\"></i> View".PHP_EOL;
		        $text 	   .= "\t\t\t\t\t\t</a>".PHP_EOL;
		        $text 	   .= "\t\t\t\t\t\t&nbsp;".PHP_EOL;
		        $text 	   .= "\t\t\t\t\t\t<a href=\"#\" class=\"btn bg-purple btn-xs edit\" data-id=\"account\" pk=\"<?php echo $"."data['username']; ?>\"  url1=\"view-account\" url2=\"edit-account\">".PHP_EOL;
		        $text 	   .= "\t\t\t\t\t\t\t<i class=\"fa fa-edit\"></i> Edit".PHP_EOL;
		        $text 	   .= "\t\t\t\t\t\t</a>".PHP_EOL;
		        $text 	   .= "\t\t\t\t\t\t&nbsp;".PHP_EOL;
		        $text 	   .= "\t\t\t\t\t\t<a href=\"#\" class=\"btn bg-maroon btn-xs delete\" data-id=\"account\" pk=\"<?php echo $"."data['username']; ?>\" url=\"delete-account\">".PHP_EOL;
		        $text 	   .= "\t\t\t\t\t\t\t<i class=\"fa fa-trash-o\"></i> Delete".PHP_EOL;
		        $text 	   .= "\t\t\t\t\t\t</a>".PHP_EOL;
	        */

	        $text 	   .= "\t\t\t\t</tr>".PHP_EOL;
	        $text 	   .= "\t\t\t\t<?php".PHP_EOL;
	        $text 	   .= "\t\t\t\tendforeach;".PHP_EOL;
	        $text 	   .= "\t\t\t?>".PHP_EOL;
	        $text 	   .= "\t\t\t</tbody>".PHP_EOL;
	        $text 	   .= "\t\t</table>".PHP_EOL;
	    }

		$text 	   .= "\t</div>".PHP_EOL;
		$text 	   .= "</div>".PHP_EOL;

		$open= fopen($path, "w");
		$kb= fwrite($open, $text);

		return 'true';
	}

	public function create_viewsadd($fileName,$data = NULL,$action = NULL){
		/* -------------------------------------------------------------
		 |	#example $data content (array) :
		 | -------------------------------------------------------------
		 |	$data =  array(
		 |					'01'	=> array(), /* Element Textbox,Textarea,TinyMCE
		 |					'02'	=> array(), /* Date,Checkbox,Combobox,imageUpload,fileUpload
		 | 				   );
		 |
		 | -------------------------------------------------------------
		 */    	


		$tablename  = str_replace(' ', '', $fileName);
		$tablename  = strtolower($tablename);

		$path		= 'application/views/admin/'.$tablename.'/add.php';
		$text		= '';

		if($data != NULL){

			$text 	.= "<section class=\"content-header\">".PHP_EOL;
			$text 	.= "\t<div class=\"box box-solid\">".PHP_EOL;
			$text 	.= "\t\t<ol class=\"breadcrumb\">".PHP_EOL;
			$text 	.= "\t\t\t<li><a href=\"<?php echo base_url(''); ?>\"><i class=\"fa fa-dashboard\"></i> Main Navigation</a></li>".PHP_EOL;
			$text 	.= "\t\t\t<li class=\"\">".$fileName."</li>".PHP_EOL;
			$text 	.= "\t\t\t<li class=\"active\">Add</li>".PHP_EOL;
			$text 	.= "\t\t</ol>".PHP_EOL;
			$text 	.= "\t</div>".PHP_EOL;
			$text 	.= "</section>".PHP_EOL;

			$text 	.= "<form class=\"mAdd\" action=\"<?php echo base_url('add-".$tablename."');?>\" method=\"POST\" enctype=\"multipart/form-data\">".PHP_EOL;
			$text 	.= "\t<div class=\"row\">".PHP_EOL;
			$text 	.= "\t\t<div class=\"col-md-9\">".PHP_EOL;
			$text 	.= "\t\t\t<div class=\"box bottom-margin\">".PHP_EOL;
            $text 	.= "\t\t\t\t<div class=\"box-header\">".PHP_EOL;
            $text 	.= "\t\t\t\t\t<?php echo $"."this->session->flashdata('message');?>".PHP_EOL;
            $text 	.= "\t\t\t\t\t<h3 class=\"box-title\">&nbsp;".PHP_EOL;
            $text 	.= "\t\t\t\t\t\t<a href=\"<?php echo base_url('admin-".$tablename."'); ?>\" class=\"btn btn-primary\" id=\"add\"><i class=\"fa fa-reply\"></i></a>".PHP_EOL;
            $text 	.= "\t\t\t\t\t\t&nbsp; ".$fileName.PHP_EOL;
            $text 	.= "\t\t\t\t\t</h3>".PHP_EOL; 
            $text 	.= "\t\t\t\t</div>".PHP_EOL;
            $text 	.= "\t\t\t\t<hr class=\"separator\">".PHP_EOL;      
            $text 	.= "\t\t\t\t<div class=\"box-body\">".PHP_EOL;

			foreach($data['01'] as $row){
				$field 	 = str_replace(' ', '', $row['menutemp_field_1']);
				$field 	 = strtolower($field);
				$field 	 = $tablename.'_'.$field;
				$element = $row['menutemp_field_3'];

				if($element == '1'){ // inputHidden
					$element = "<input type=\"hidden\" name=\"".$field."\" id=\"".$field."\" />";
				}elseif($element == '2'){ // inputTextarea
					$element = "<textarea name=\"".$field."\" id=\"".$field."\" class=\"form-control\" rows=\"5\"></textarea>";
				}elseif($element == '3'){ // inputTinyMCE
					$element = "<textarea class=\"tinymce\" id=\"".$field."\" name=\"".$field."\"></textarea>";
				}else{ // inputText
					$element = "<input type=\"text\" name=\"".$field."\" id=\"".$field."\" class=\"form-control\"/>";
				}

                $text 	.= "\t\t\t\t\t<div class=\"col-xs-12\">".PHP_EOL;
                $text 	.= "\t\t\t\t\t\t<div class=\"form-group\">".PHP_EOL;
                $text 	.= "\t\t\t\t\t\t\t<label for=\"name\" class=\"form-control-label\" >".$row['menutemp_field_1']."</label>".PHP_EOL;
                $text 	.= "\t\t\t\t\t\t\t".$element.PHP_EOL;
                $text 	.= "\t\t\t\t\t\t</div>".PHP_EOL;
                $text 	.= "\t\t\t\t\t</div>".PHP_EOL;
			}

            $text 	.= "\t\t\t\t</div>".PHP_EOL;
			$text 	.= "\t\t\t</div>".PHP_EOL;
			$text 	.= "\t\t</div>".PHP_EOL;
			$text 	.= "\t\t<div class=\"col-md-3\">".PHP_EOL;
			$text 	.= "\t\t\t<div class=\"box\">".PHP_EOL;
			$text 	.= "\t\t\t\t<div class=\"box-body\">".PHP_EOL;

			foreach($data['02'] as $row){
				$field 	 = str_replace(' ', '', $row['menutemp_field_1']);
				$field 	 = strtolower($field);
				$field 	 = $tablename.'_'.$field;
				$element = $row['menutemp_field_3'];

				if($element == '4'){ // inputDate
					$elementPrint = "<input type=\"date\" name=\"".$field."\" id=\"".$field."\" class=\"form-control\"/>";
				}elseif($element == '5'){ // dropdown
					$elementPrint = "<input type=\"text\" name=\"".$field."\" id=\"".$field."\" class=\"form-control\"/>";
				}elseif($element == '6'){ // imageupload
					$elementPrint = "<input type=\"text\" name=\"".$field."\" id=\"".$field."\" class=\"form-control\"/>";
				}elseif($element == '7'){ // fileupload
					$elementPrint = "<input type=\"text\" name=\"".$field."\" id=\"".$field."\" class=\"form-control\"/>";
				}elseif($element == '8'){ // checkbox
					$elementPrint = "<style>.icheckbox_minimal-blue{ float: left; margin-right: 5px; margin-top: 1px;}</style>".PHP_EOL.
									"<input type=\"checkbox\" name=\"".$field."\" id=\"".$field."\" class=\"form-control minimal\"/>";
				}elseif($element == '9' || $element == '10' || $element == '11'){
					$elementPrint = "";
				}else{ // inputText
					$elementPrint = "<input type=\"text\" name=\"".$field."\" id=\"".$field."\" class=\"form-control\"/>";
				}

				if($element < 9){
                $text 	.= "\t\t\t\t\t<div class=\"form-group\">".PHP_EOL;
                $text 	.= "\t\t\t\t\t\t<label for=\"name\" class=\"form-control-label\" >".$row['menutemp_field_1']."</label>".PHP_EOL;
                $text 	.= "\t\t\t\t\t\t".$elementPrint.PHP_EOL;
                $text 	.= "\t\t\t\t\t</div>".PHP_EOL;
            	}
			}

			$text 	.= "\t\t\t\t\t<div class=\"form-group\">".PHP_EOL;
            $text 	.= "\t\t\t\t\t\t<input type=\"hidden\" name=\"statusPost\" id=\"statusPost\" value=\"1\" />".PHP_EOL;
            $text 	.= "\t\t\t\t\t\t<input class=\"form-control btn btn-primary\" type=\"submit\" id=\"btnsubmit\" name=\"btnsubmit\" value=\"Submit\"/>".PHP_EOL;
            $text 	.= "\t\t\t\t\t</div>".PHP_EOL;
			$text 	.= "\t\t\t\t</div>".PHP_EOL;			
			$text 	.= "\t\t\t</div>".PHP_EOL;
			$text 	.= "\t\t</div>".PHP_EOL;
			$text 	.= "\t</div>".PHP_EOL;
			$text 	.= "</form>".PHP_EOL;
		}

		$open= fopen($path, "w");
		$kb= fwrite($open, $text);

		return 'true';
	}

	public function create_viewsedit($fileName,$data = NULL,$action = NULL){
		/* -------------------------------------------------------------
		 |	#example $data content (array) :
		 | -------------------------------------------------------------
		 |	$data =  array(
		 |					'01'	=> array(), /* Element Textbox,Textarea,TinyMCE
		 |					'02'	=> array(), /* Date,Checkbox,Combobox,imageUpload,fileUpload
		 | 				   );
		 |
		 | -------------------------------------------------------------
		 */    	


		$tablename  = str_replace(' ', '', $fileName);
		$tablename  = strtolower($tablename);

		$path		= 'application/views/admin/'.$tablename.'/edit.php';
		$text		= '';

		if($data != NULL){

			$text 	.= "<section class=\"content-header\">".PHP_EOL;
			$text 	.= "\t<div class=\"box box-solid\">".PHP_EOL;
			$text 	.= "\t\t<ol class=\"breadcrumb\">".PHP_EOL;
			$text 	.= "\t\t\t<li><a href=\"<?php echo base_url(''); ?>\"><i class=\"fa fa-dashboard\"></i> Main Navigation</a></li>".PHP_EOL;
			$text 	.= "\t\t\t<li class=\"\">".$fileName."</li>".PHP_EOL;
			$text 	.= "\t\t\t<li class=\"active\">Edit</li>".PHP_EOL;
			$text 	.= "\t\t</ol>".PHP_EOL;
			$text 	.= "\t</div>".PHP_EOL;
			$text 	.= "</section>".PHP_EOL;

			$text 	.= "<form class=\"mView\" action=\"<?php echo base_url('edit-".$tablename."');?>\" method=\"POST\" enctype=\"multipart/form-data\">".PHP_EOL;
			$text 	.= "\t<div class=\"row\">".PHP_EOL;
			$text 	.= "\t\t<div class=\"col-md-9\">".PHP_EOL;
			$text 	.= "\t\t\t<div class=\"box bottom-margin\">".PHP_EOL;
            $text 	.= "\t\t\t\t<div class=\"box-header\">".PHP_EOL;
            $text 	.= "\t\t\t\t\t<?php echo $"."this->session->flashdata('message');?>".PHP_EOL;
            $text 	.= "\t\t\t\t\t<h3 class=\"box-title\">&nbsp;".PHP_EOL;
            $text 	.= "\t\t\t\t\t\t<a href=\"<?php echo base_url('admin-".$tablename."'); ?>\" class=\"btn btn-primary\" id=\"add\"><i class=\"fa fa-reply\"></i></a>".PHP_EOL;
            $text 	.= "\t\t\t\t\t\t&nbsp; ".$fileName.PHP_EOL;
            $text 	.= "\t\t\t\t\t</h3>".PHP_EOL; 
            $text 	.= "\t\t\t\t</div>".PHP_EOL;
            $text 	.= "\t\t\t\t<hr class=\"separator\">".PHP_EOL;      
            $text 	.= "\t\t\t\t<div class=\"box-body\">".PHP_EOL;

            $n = 0;
			foreach($data['01'] as $row){
				$field 	 = str_replace(' ', '', $row['menutemp_field_1']);
				$field 	 = strtolower($field);
				$field 	 = $tablename.'_'.$field;
				$element = $row['menutemp_field_3'];

				if($element == '1'){ // inputHidden
					$element = "<input type=\"hidden\" name=\"v".$field."\" id=\"v".$field."\" value=\"<?php echo $"."result['".$tablename."_".$field."'];?>\" />";
				}elseif($element == '2'){ // inputTextarea
					$element = "<textarea name=\"v".$field."\" id=\"v".$field."\" class=\"form-control\" rows=\"5\"><?php echo $"."result['".$tablename."_".$field."'];?></textarea>";
				}elseif($element == '3'){ // inputTinyMCE
					$element = "<textarea class=\"tinymce\" id=\"v".$field."\" name=\"v".$field."\"><?php echo set_value('content', $"."result['".$tablename."_".$field."']);?></textarea>";
				}else{ // inputText
					$element = "<input type=\"text\" name=\"v".$field."\" id=\"v".$field."\" class=\"form-control\" value=\"<?php echo $"."result['".$tablename."_".$field."'];?>\" />";
				}

				if($n == 0){
					$element .= PHP_EOL."\t\t\t\t\t\t\t<input type=\"hidden\" name=\"vid\" id=\"vid\" value=\"<?php echo $"."result['".$tablename."_id'];?>\" />";
				}

                $text 	.= "\t\t\t\t\t<div class=\"col-xs-12\">".PHP_EOL;
                $text 	.= "\t\t\t\t\t\t<div class=\"form-group\">".PHP_EOL;
                $text 	.= "\t\t\t\t\t\t\t<label for=\"name\" class=\"form-control-label\" >".$row['menutemp_field_1']."</label>".PHP_EOL;
                $text 	.= "\t\t\t\t\t\t\t".$element.PHP_EOL;
                $text 	.= "\t\t\t\t\t\t</div>".PHP_EOL;
                $text 	.= "\t\t\t\t\t</div>".PHP_EOL;
            $n++;
			}

            $text 	.= "\t\t\t\t</div>".PHP_EOL;
			$text 	.= "\t\t\t</div>".PHP_EOL;
			$text 	.= "\t\t</div>".PHP_EOL;
			$text 	.= "\t\t<div class=\"col-md-3\">".PHP_EOL;
			$text 	.= "\t\t\t<div class=\"box\">".PHP_EOL;
			$text 	.= "\t\t\t\t<div class=\"box-body\">".PHP_EOL;

			foreach($data['02'] as $row){
				$field 	 = str_replace(' ', '', $row['menutemp_field_1']);
				$field 	 = strtolower($field);
				$field 	 = $tablename.'_'.$field;
				$element = $row['menutemp_field_3'];

				if($element == '4'){ // inputDate
					$elementPrint = "<input type=\"date\" name=\"v".$field."\" id=\"v".$field."\" class=\"form-control\" value=\"<?php echo date('Y-m-d',strtotime($"."result['".$tablename."_".$field."']));?>\"/>";
				}elseif($element == '5'){ // dropdown
					$elementPrint = "<input type=\"text\" name=\"v".$field."\" id=\"v".$field."\" class=\"form-control\" value=\"<?php echo $"."result['".$tablename."_".$field."'];?>\"/>";
				}elseif($element == '6'){ // imageupload
					$elementPrint = "<input type=\"text\" name=\"v".$field."\" id=\"v".$field."\" class=\"form-control\" value=\"<?php echo $"."result['".$tablename."_".$field."'];?>\"/>";
				}elseif($element == '7'){ // fileupload
					$elementPrint = "<input type=\"text\" name=\"v".$field."\" id=\"v".$field."\" class=\"form-control\" value=\"<?php echo $"."result['".$tablename."_".$field."'];?>\"/>";
				}elseif($element == '8'){ // checkbox
					$elementPrint = "<?php $"."check = ''; if($"."result['".$tablename."_".$field."'] == '1'){ $"."check = 'checked';}?>".PHP_EOL.
									"<style>.icheckbox_minimal-blue{ float: left; margin-right: 5px; margin-top: 1px;}</style>".PHP_EOL.
									"<input type=\"checkbox\" name=\"v".$field."\" id=\"v".$field."\" class=\"form-control minimal\" <?php echo $"."check;?>/>";
				}elseif($element == '9' || $element == '10' || $element == '11'){
					$elementPrint = "";
				}else{ // inputText
					$elementPrint = "<input type=\"text\" name=\"v".$field."\" id=\"v".$field."\" class=\"form-control\" value=\"<?php echo $"."result['".$tablename."_".$field."'];?>\"/>";
				}

				if($element < 9){
                $text 	.= "\t\t\t\t\t<div class=\"form-group\">".PHP_EOL;
                $text 	.= "\t\t\t\t\t\t<label for=\"name\" class=\"form-control-label\" >".$row['menutemp_field_1']."</label>".PHP_EOL;
                $text 	.= "\t\t\t\t\t\t".$elementPrint.PHP_EOL;
                $text 	.= "\t\t\t\t\t</div>".PHP_EOL;
            	}
			}

			$text 	.= "\t\t\t\t\t<?php if($"."role == ''){ ?>".PHP_EOL;
			$text 	.= "\t\t\t\t\t<div class=\"form-group\">".PHP_EOL;
            $text 	.= "\t\t\t\t\t\t<input type=\"hidden\" name=\"vstatusPost\" id=\"vstatusPost\" value=\"1\" />".PHP_EOL;
            $text 	.= "\t\t\t\t\t\t<input class=\"form-control btn btn-primary\" type=\"submit\" id=\"btnsubmit\" name=\"btnsubmit\" value=\"Submit\"/>".PHP_EOL;
            $text 	.= "\t\t\t\t\t</div>".PHP_EOL;
			$text 	.= "\t\t\t\t\t<?php } ?>".PHP_EOL;

			$text 	.= "\t\t\t\t</div>".PHP_EOL;			
			$text 	.= "\t\t\t</div>".PHP_EOL;
			$text 	.= "\t\t</div>".PHP_EOL;
			$text 	.= "\t</div>".PHP_EOL;
			$text 	.= "</form>".PHP_EOL;
		}

		$open= fopen($path, "w");
		$kb= fwrite($open, $text);

		return 'true';
	}

	public function create_viewsmodal($fileName){
		$path		= 'application/views/admin/'.strtolower($fileName).'/modal.php';
		$text		= '';

		$text	   .= "".PHP_EOL;					
		
		$open= fopen($path, "w");
		$kb= fwrite($open, $text);

		return 'true';
	}

	public function update_constants(){
		$reading = fopen('application/config/constants.php', 'r');
		$writing = fopen('application/config/constants.tmp', 'w');

		$webtitle 		= $this->CI->input->post('webtitle', true);
		$customcolor 	= $this->CI->input->post('customcolor', true);
		$coloradmin 	= $this->CI->input->post('coloradmin', true);
		$colortheme 	= $this->CI->input->post('colortheme', true);
		$prefix 		= $this->CI->input->post('prefix', true);
		$pt 			= $this->CI->input->post('pt', true);
		$year 			= $this->CI->input->post('year', true);
		$domain 		= $this->CI->input->post('domain', true);
		$usermail 		= $this->CI->input->post('usermail', true);
		$emailpass 		= $this->CI->input->post('emailpass', true);
		$encryptkey 	= $this->CI->input->post('encryptkey', true);
		$akey 			= $this->CI->input->post('akey', true);
		$csemail 		= $this->CI->input->post('csemail', true);
		$protocol 		= $this->CI->input->post('protocol', true);

		$replaced = false;

		while(!feof($reading)){
		  	$line = fgets($reading);

		  	if(stristr($line, '_WEBTITLE')){
		    	$line = "define('_WEBTITLE','".$webtitle."');".PHP_EOL;
		    	$replaced = true;
		  	}elseif(stristr($line, '_CUSTOMCOLOR')){
		    	$line = "define('_CUSTOMCOLOR', ".$customcolor.");".PHP_EOL;
		    	$replaced = true;
		  	}elseif(stristr($line, '_COLORADMIN')){
		    	$line = "define('_COLORADMIN','".$coloradmin."');".PHP_EOL;
		    	$replaced = true;
		  	}elseif(stristr($line, '_COLORTHEME')){
		    	$line = "define('_COLORTHEME','".$colortheme."');".PHP_EOL;
		    	$replaced = true;
		  	}elseif(stristr($line, '_PREFIX')){
		    	$line = "define('_PREFIX','".$prefix."');".PHP_EOL;
		    	$replaced = true;
		  	}elseif(stristr($line, '_PT')){
		    	$line = "define('_PT','".$pt."');".PHP_EOL;
		    	$replaced = true;
		  	}elseif(stristr($line, '_YEAR')){
		    	$line = "define('_YEAR','".$year."');".PHP_EOL;
		    	$replaced = true;
		  	}elseif(stristr($line, '_DOMAIN')){
		    	$line = "define('_DOMAIN','".$domain."');".PHP_EOL;
		    	$replaced = true;
		  	}elseif(stristr($line, '_USEREMAIL')){
		    	$line = "define('_USEREMAIL','".$usermail."');".PHP_EOL;
		    	$replaced = true;
		  	}elseif(stristr($line, '_EMAILPASS')){
		    	$line = "define('_EMAILPASS','".$emailpass."');".PHP_EOL;
		    	$replaced = true;
		  	}elseif(stristr($line, '_ENCRYPTKEY')){
		    	$line = "define('_ENCRYPTKEY','".$encryptkey."');".PHP_EOL;
		    	$replaced = true;
		    }elseif(stristr($line, '_AKEY')){
		    	$line = "define('_AKEY','".$akey."');".PHP_EOL;
		    	$replaced = true;
		  	}elseif(stristr($line, '_CSEMAIL')){
		    	$line = "define('_CSEMAIL','".$csemail."');".PHP_EOL;
		    	$replaced = true;
		  	}elseif(stristr($line, '_PROTOCOL')){
		    	$line = "define('_PROTOCOL','".$protocol."');".PHP_EOL;
		    	$replaced = true;
		  	}

		  	fputs($writing, $line);
		}

		fclose($reading); 
		fclose($writing);
		
		if($replaced){
		  	rename('application/config/constants.tmp', 'application/config/constants.php');
		}else{
		  	unlink('application/config/constants.tmp');
		}

		return 'true';	
	}

	public function update_routes($data){
		$menu 			= trim($data['menu'],' ');
		$menu 			= strtolower($menu);
		$datalink 		= 'admin/'.$menu;

		$text 			= PHP_EOL."\t#".strtoupper($menu).' ('.$datalink.')'.PHP_EOL; //"\t//text here";
		$text 		   .= "\t$"."route['admin-".$menu."']\t=\t'".$datalink."';".PHP_EOL;
		$text 		   .= "\t$"."route['add-".$menu."']\t=\t'".$datalink."/add';".PHP_EOL;
		$text 		   .= "\t$"."route['view-".$menu."']\t=\t'".$datalink."/view';".PHP_EOL;
		$text 		   .= "\t$"."route['delete-".$menu."']\t=\t'".$datalink."/delete';".PHP_EOL;
		$text 		   .= "\t$"."route['edit-".$menu."']\t=\t'".$datalink."/edit';".PHP_EOL;
		$text 		   .= "\t$"."route['view-".$menu."-(:any)']\t=\t'".$datalink."/edit/$1/view';".PHP_EOL;
		$text 		   .= "\t$"."route['delete-".$menu."-(:any)']\t=\t'".$datalink."/delete/$1';".PHP_EOL;
		$text 		   .= "\t$"."route['edit-".$menu."-(:any)']\t=\t'".$datalink."/edit/$1';";

		$filecontent 	= file_get_contents('application/config/routes.php');

		$pos 			= strpos($filecontent, '#============== FRONT ================');
		$filecontent 	= substr($filecontent, 0, $pos).$text."\r\n\t".substr($filecontent, $pos);
		file_put_contents("application/config/routes.php", $filecontent);

		return 'true';
	}

	public function update_autoload($data){
		$menu 			= trim($data['menu'],' ');
		$menu 			= strtolower($menu);
		$datalink 		= 'm'.$menu;

		$text 			= "'".$datalink."',";

		$filecontent 	= file_get_contents('application/config/autoload.php');

		$pos 			= strpos($filecontent, ');/*-END-AUTOLOAD-MODEL-*/');
		$filecontent 	= substr($filecontent, 0, $pos).$text."\r\n\t\t\t\t\t\t\t".substr($filecontent, $pos);
		file_put_contents("application/config/autoload.php", $filecontent);

		return 'true';
	}

	public function update_content_file($data){

		/* -------------------------------------------------------------
		 |	#example $data content (array) :
		 | -------------------------------------------------------------
		 |	$data =  array(
		 |					'path'		=> '',
		 |					'text'		=> '',
		 |					'endtext'	=> '',
		 | 				   );
		 |
		 | -------------------------------------------------------------
		 */    	

		$text = $data['text'];

		if(!file_exists($data['path'])){
			$fp = fopen($data['path'],'w');
			fwrite($fp,'');
			fclose($fp);
		}

		$filecontent 	= file_get_contents($data['path']);

		if(!isset($data['afterendtext'])){ $afterendtext = ''; }else{ $afterendtext = $data['afterendtext']; }

		if(isset($data['endtext']) AND $data['endtext'] != ''){
			$pos 			= strpos($filecontent, $data['endtext']);
			$filecontent 	= substr($filecontent, 0, $pos).$text."\r\n".$afterendtext.substr($filecontent, $pos);
			file_put_contents($data['path'], $filecontent);
		}else{
			file_put_contents($data['path'], $text, FILE_APPEND);
		}

		return 'true';
	}

	public function delete_mvc($fileName){
		$pathController 	= 'application/controllers/admin/'.$fileName.'.php';
		$pathModel			= 'application/models/M'.strtolower($fileName).'.php';
		$pathView			= 'application/views/admin/'.strtolower($fileName);
		$pathView1			= 'application/views/admin/'.strtolower($fileName).'/index.php';
		// $pathView2			= 'application/views/admin/'.strtolower($fileName).'/modal.php';

		unlink($pathController);
		unlink($pathModel);
		unlink($pathView1);
		// unlink($pathView2);
		rmdir($pathView);

		return 'true';
	}

	public function delete_routes($fileName){
		$reading = fopen('application/config/routes.php', 'r');
		$writing = fopen('application/config/routes.tmp', 'w');
		$text	 = 'admin/'.strtolower($fileName);

		$replaced = false;

		while(!feof($reading)){
		  	$line = fgets($reading);

		  	if(stristr($line,$text)){
		    	$line = "";
		    	$replaced = true;
		  	}

		  	fputs($writing, $line);
		}

		fclose($reading); 
		fclose($writing);
		
		if($replaced){
		  	rename('application/config/routes.tmp', 'application/config/routes.php');
		}else{
		  	unlink('application/config/routes.tmp');
		}

		return 'true';
	}

	public function delete_autoload($fileName){
		$reading = fopen('application/config/autoload.php', 'r');
		$writing = fopen('application/config/autoload.tmp', 'w');
		$text	 = "m".strtolower($fileName);

		$replaced = false;

		while(!feof($reading)){
		  	$line = fgets($reading);

		  	if(stristr($line,$text)){
		    	$line = "";
		    	$replaced = true;
		  	}

		  	fputs($writing, $line);
		}

		fclose($reading); 
		fclose($writing);
		
		if($replaced){
		  	rename('application/config/autoload.tmp', 'application/config/autoload.php');
		}else{
		  	unlink('application/config/autoload.tmp');
		}

		return 'true';
	}

	public function delete_content_file($data){

		/* -------------------------------------------------------------
		 |	#example $data content (array) :
		 | -------------------------------------------------------------
		 |	$data =  array(
		 |					'path'		=> '',
		 |					'start'		=> '',
		 |					'end'		=> '',
		 | 				   );
		 |
		 | -------------------------------------------------------------
		 */    	

	    $file  = $data['path'];

	    $start = $data['start'];

	    $end   = $data['end'];

	    $arr  = file($file);
	    $text = '';

	    $n = 0; $row = 0;
	    foreach($arr as $key => $line){ $row++;

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
	
	    //reindexing array
	    $arr = array_values($arr);

	    //writing to file
	    file_put_contents($file, implode($arr));

	    return 'true';
	}

	public function get_icon($extension = '', $level = '', $files =''){
		$level = $this->decrypt($level);

		switch ($extension) {
		    case "php":
		        return '<i class="fa fa-file-text"></i>';
		    case "txt":
		        return '<i class="fa fa-file-text-o"></i>';
		    case "css":
		        return '<i class="fa fa-file-code-o"></i>';
		    case "html":
		        return '<i class="fa fa-file-code-o"></i>';
		    case "js":
		        return '<i class="fa fa-file-code-o"></i>';
		    case "scss":
		        return '<i class="fa fa-file-code-o"></i>';
		    case "docx":
		        return '<i class="fa fa-file-word-o"></i>';
		    case "xlsx":
		        return '<i class="fa fa-file-excel-o"></i>';
		    case "pdf":
		        return '<i class="fa fa-file-pdf-o"></i>';
		    case "pptx":
		        return '<i class="fa fa-file-powerpoint-o"></i>';
		    case "png":
		        return '<img src="'.base_url().str_replace('+','/',$level).'/'.$files.'" width="100%"/>';
		    case "jpg":
		        return '<img src="'.base_url().str_replace('+','/',$level).'/'.$files.'" width="100%"/>';
		    case "gif":
		        return '<img src="'.base_url().str_replace('+','/',$level).'/'.$files.'" width="100%"/>';
		    case "jpeg":
		        return '<img src="'.base_url().str_replace('+','/',$level).'/'.$files.'" width="100%"/>';
		    case "mp4":
		        return '<i class="fa fa-file-movie-o"></i>';
		    case "zip":
		        return '<i class="fa fa-file-zip-o"></i>';
		    default:
		        return '<i class="fa fa-file-o"></i>';
		}
	}
}