<section class="content-header" style="padding:0;">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Main Navigation</a></li>
            <li class="active">Gallery</li>
        </ol>
    </div>
</section>

<div class="box">
    <div class="overlay">
      <i class="fa fa-refresh fa-spin"></i>
    </div>

    <div class="box-header" style="padding-bottom: 0px;">
    	<div class="col-xs-12" style="padding-bottom: 15px;">
	        <?php echo $this->session->flashdata('message');?>
		</div>	        

    	<div class="col-xs-12 col-md-8">
    		<div class="box box-solid">
    			<ol class="breadcrumb">
			    	<?php
			    	//SITEMAP 
			    	foreach($paths as $id=>$pat){
						if($pat == '' && $id == 0){
							$a = true;
							echo '<font color=#fff><center>$ root@mytemp : <a href="?path=/">/</a>';
							continue;
						}

						if($pat == '' OR $id<4) continue;

						echo '<a style="padding: 0px 5px;" href="'.base_url('admin-gallery-index/');

						$uponelevel 	= '';
						$thislevel  	= '';
						$thislevelfull  = '';

						for($i=0;$i<=$id;$i++){
							$thislevelfull .= "$paths[$i]";

							echo "$paths[$i]";

							if($i != $id){ 
								$thislevelfull 	.= "+";

								if($i == $id-1){
									$uponelevel .= "$paths[$i]";									
								}else{
									$uponelevel .= "$paths[$i]"."+";									
								}

								echo "+"; 
							}

							if($i>3){
								$thislevel .= "$paths[$i]";

								if($i != $id){ 
									$thislevel .= "+";
								}
							}
						}

						if($id == 4){
							echo '"><i class="fa fa-home"></i></a>  /  ';							
						}else{
							echo '"><i class="fa fa-folder-open"></i>  '.$pat.'</a>  /  ';							
						}
					} 
					?>
				</ol>
			</div>   
    	</div>

    	<div class="col-xs-12 col-md-4">
			<form enctype="multipart/form-data" action="<?php echo base_url('admin/gallery/action/upload');?>" method="POST">
				<div class="form-group">
					<div class="input-group">
						<input class="form-control" type="file" name="file" id="file"/>
						<input type="hidden" id="pathupload" name="pathupload" value="<?php echo $thislevelfull;?>"/>
						<span class="input-group-btn">
							<input class="btn btn-warning" type="submit" id="upload" value="Upload" />	
						</span>
					</div>
				</div>
			</form>    		
    	</div>
    </div>

    <hr style="margin: 0;">
    <style>
    	.mailbox-attachment-icon {
    		overflow: hidden;
		    height: 20vh;
		}
    </style>

    <div class="box-body">
    	<div class="col-xs-12">
    		<?php 
    			$getUri = $this->uri->segment(2); 
    			$exUri = explode('+', $getUri); 
    			if( $getUri != ''){ 
    				if($exUri[count($exUri)-2] == 'documents' && end($exUri) == ''){}elseif(end($exUri) == 'documents'){}else{
    		?>
    		<a class="btn btn-default btn-flat" href="<?php echo base_url('admin-gallery-index/'.$uponelevel);?>"><i class="fa fa-mail-reply"></i></a>
			<?php }} ?>
			<a class="btn btn-default btn-flat add" href="#" data-target="#mAdd" data-toggle="modal" id="add" type="file" opt="cfile" path="<?php echo $thislevel;?>"><i class="fa fa-file"></i></a>
			<a class="btn btn-default btn-flat add" href="#" data-target="#mAdd" data-toggle="modal" id="add" type="dir" opt="cdir" path="<?php echo $thislevel;?>"><i class="fa fa-folder"></i></a>
    	</div>
    	<div class="col-xs-12" style="padding-bottom: 15px; padding-top: 15px;">
			<ul class="mailbox-attachments clearfix">
		    	<?php 
					foreach($scandir as $dir){
						if(!is_dir("$path/$dir") || $dir == '.' || $dir == '..') continue;
						$reppath = str_replace('/','+', $path);

						if(strlen($dir) > 23){
							$dir = substr($dir, 0,11).'....'.substr($dir, -11);
						}
				?>
		            <li style="width: 19%;">
		              <span class="mailbox-attachment-icon"><i class="fa fa-folder"></i></span>

		              <div class="mailbox-attachment-info">
		                <a href="<?php echo base_url('admin-gallery-index/').$reppath.'+'.$dir;?>" class="mailbox-attachment-name"><?php echo $dir;?></a>
		                    <span class="mailbox-attachment-size">
		                      Folder
						      <a class="btn btn-default btn-xs pull-right delete" data-target="#deleteModalx" data-toggle="modal" id="delete" type="dir" opt="rdir" file="<?php echo $dir;?>" path="<?php echo $thislevelfull;?>" href="<?php echo '#';?>" ><i class="fa fa-trash"></i></a>
							  <a class="btn btn-default btn-xs pull-right view" data-target="#mViewx" data-toggle="modal" id="rename" type="file" opt="nfile" file="<?php echo $dir.'+folder';?>" path="<?php echo $thislevelfull;?>" href="<?php echo '#';?>" ><i class="fa fa-text-width"></i></a>
		                    </span>
		              </div>
		            </li>
				<?php } ?>
				<?php 
					foreach($scandir as $files){
						if(!is_file("$path/$files")) continue;
						$size = filesize("$path/$files")/1024;
						$size = round($size,3);

						if($size >= 1024){

							$size = round($size/1024,2).' MB';
						}else{

							$size = $size.' KB';
						}

						$exfile 	= explode('.', $files);
						$countFile 	= count($exfile);
						$sortArray  = $countFile - 1;
						$extension	= $exfile[$sortArray]; 

						if($extension != 'jpg'){
							if($extension != 'png'){
								if($extension != 'gif'){
									if( $extension != 'jpeg'){
										continue;
									}
								}
							}
						}

						if($countFile > 1){
							$pushExFile = $exfile[0].'+'.$exfile[1];
						}else{
							$pushExFile = $files;
						}

						if(strlen($files) > 23){
							$file = substr($files, 0,11).'....'.substr($files, -11);
						}else{
							$file = $files;
						}
				?>
		            <li style="width: 19%;">
		            	<span class="mailbox-attachment-icon">
		            		<?php 
								switch ($extension) {
								    case "php":
								        echo '<i class="fa fa-file-text"></i>';
								        break;
								    case "txt":
								        echo '<i class="fa fa-file-text-o"></i>';
								        break;
								    case "css":
								        echo '<i class="fa fa-file-code-o"></i>';
								        break;
								    case "html":
								        echo '<i class="fa fa-file-code-o"></i>';
								        break;
								    case "js":
								        echo '<i class="fa fa-file-code-o"></i>';
								        break;
								    case "scss":
								        echo '<i class="fa fa-file-code-o"></i>';
								        break;
								    case "docx":
								        echo '<i class="fa fa-file-word-o"></i>';
								        break;
								    case "xlsx":
								        echo '<i class="fa fa-file-excel-o"></i>';
								        break;
								    case "pdf":
								        echo '<i class="fa fa-file-pdf-o"></i>';
								        break;
								    case "pptx":
								        echo '<i class="fa fa-file-powerpoint-o"></i>';
								        break;
								    case "png":
								        echo '<img src="'.base_url().str_replace('+','/',$thislevel).'/'.$files.'" width="100%"/>';
								        break;
								    case "jpg":
								        echo '<img src="'.base_url().str_replace('+','/',$thislevel).'/'.$files.'" width="100%"/>';
								        break;
								    case "gif":
								        echo '<img src="'.base_url().str_replace('+','/',$thislevel).'/'.$files.'" width="100%"/>';
								        break;
								    case "jpeg":
								        echo '<img src="'.base_url().str_replace('+','/',$thislevel).'/'.$files.'" width="100%"/>';
								        break;
								    case "mp4":
								        echo '<i class="fa fa-file-movie-o"></i>';
								        break;
								    case "zip":
								        echo '<i class="fa fa-file-zip-o"></i>';
								        break;
								    default:
								        echo '<i class="fa fa-file-o"></i>';
								}
		            		?>
		            	</span>

		            	<div class="mailbox-attachment-info">
		            		<?php if($extension == 'txt' || $extension == 'php' || $extension == 'css' || $extension == 'html' || $extension == 'js' || $extension == 'scss'){ ?>
		            			<a data-target="#mEditorx" data-toggle="modal" class="mailbox-attachment-name editor" id="editor" type="file" opt="efile" file="<?php echo $pushExFile;?>" path="<?php echo $thislevelfull;?>" href="#"><?php echo $file;?></a>
		            		<?php }elseif($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'jpeg'){ ?>
		            			<a data-target="#mPhotox" data-toggle="modal" class="mailbox-attachment-name photo" id="photo" type="file" opt="efile" file="<?php echo $pushExFile;?>" path="<?php echo $thislevel;?>" href="#"><?php echo $file;?></a>
		            		<?php }else{ ?>
		            			<a class="mailbox-attachment-name" href="<?php echo base_url('admin/gallery/action/filesrc/'.$thislevelfull.'/'.$pushExFile);?>"><?php echo $file;?></a>
		            		<?php } ?>

		            		<span class="mailbox-attachment-size">
		            			<?php echo $size;?>

		            			<a class="btn btn-default btn-xs pull-right delete" data-target="#deleteModalx" data-toggle="modal" id="delete" type="file" opt="rfile" file="<?php echo $pushExFile;?>" path="<?php echo $thislevelfull;?>" href="<?php echo '#';?>" ><i class="fa fa-trash"></i></a>						
		            			<a class="btn btn-default btn-xs pull-right view" data-target="#mViewx" data-toggle="modal" id="rename" type="file" opt="nfile" file="<?php echo $pushExFile;?>" path="<?php echo $thislevelfull;?>" href="<?php echo '#';?>" ><i class="fa fa-text-width"></i></a>
		            			<?php if($extension == 'txt' || $extension == 'php' || $extension == 'css' || $extension == 'html' || $extension == 'js' || $extension == 'scss'){ ?>
		            				<a class="btn btn-default btn-xs pull-right editor" data-target="#mEditorx" data-toggle="modal" id="editor" type="file" opt="efile" file="<?php echo $pushExFile;?>" path="<?php echo $thislevelfull;?>" href="<?php echo '#';?>" ><i class="fa fa-edit"></i></a>
		            			<?php } ?>
		            			<a class="btn btn-default btn-xs pull-right" href="<?php echo base_url('admin/gallery/action/filesrc/'.$thislevelfull.'/'.$pushExFile);?>"><i class="fa fa-cloud-download"></i></a>
		            		</span>
		            	</div>
		            </li>
				<?php } ?>
	        </ul>    		
    	</div>
    </div>
</div>