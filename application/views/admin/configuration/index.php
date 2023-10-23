<section class="content-header" style="padding:0;">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Main Navigation</a></li>
            <li class="active">Configuration</li>
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
	        <h3 class="box-title">Configuration</h3>
		</div>	        
    </div>

    <hr style="margin: 0;">

	<form id="frmConstant" action="<?php echo base_url('edit-configuration');?>" method="POST">
	    <div class="box-body">
	    	<div class="col-xs-12">
		    	<div class="form-group">
				    <?php $webtitle = explode("'", $lines[13]);?>
		    		<label class="form-control-label">Web title</label>&nbsp;<i style="font-size: x-small;">file constants.php for define _WEBTITLE</i>
		    		<input class="form-control" type="text" name="webtitle" id="webtitle" value="<?php echo $webtitle[3];?>" />
		    	</div>    	
		    	<div class="form-group">
				    <?php $customcolor = explode(",", $lines[18]);?>
				    <?php $customcolor = explode(")", $customcolor[1]);?>
		    		<label class="form-control-label">Custom Color</label>&nbsp;<i style="font-size: x-small;">file constants.php for define _CUSTOMCOLOR</i>
		    		<input class="form-control" type="text" name="customcolor" id="customcolor" value="<?php echo $customcolor[0];?>" />
		    	</div>   
		    	<div class="form-group">
				    <?php $coloradmin = explode("'", $lines[19]);?>
		    		<label class="form-control-label">Color Admin</label>&nbsp;<i style="font-size: x-small;">file constants.php for define _COLORADMIN ; if using this option _CUSTOMCOLOR must be TRUE</i>
		    		<input class="form-control" type="text" name="coloradmin" id="coloradmin" value="<?php echo $coloradmin[3];?>" />
		    	</div>  
		    	<div class="form-group">
				    <?php $colortheme = explode("'", $lines[20]);?>
		    		<label class="form-control-label">Color Theme</label>&nbsp;<i style="font-size: x-small;">file constants.php for define _COLORTHEME ; if using this option _CUSTOMCOLOR must be FALSE (fill this field using admin-LTE themes, ex : skin-black-light, skin-blue, skin-red, .. etc.)</i>
		    		<input class="form-control" type="text" name="colortheme" id="colortheme" value="<?php echo $colortheme[3];?>" />
		    	</div> 
		    	<div class="form-group">
				    <?php $pt = explode("'", $lines[22]);?>
		    		<label class="form-control-label">PT</label>&nbsp;<i style="font-size: x-small;">file constants.php for define _PT ; Corporation Name</i>
		    		<input class="form-control" type="text" name="pt" id="pt" value="<?php echo $pt[3];?>" />
		    	</div>   
		    	<div class="form-group">
				    <?php $year = explode("'", $lines[23]);?>
		    		<label class="form-control-label">Year</label>&nbsp;<i style="font-size: x-small;">file constants.php for define _YEAR; </i>
		    		<input class="form-control" type="text" name="year" id="year" value="<?php echo $year[3];?>" />
		    	</div>  
		    	<div class="form-group">
				    <?php $domain = explode("'", $lines[24]);?>
		    		<label class="form-control-label">Domain</label>&nbsp;<i style="font-size: x-small;">file constants.php for define _DOMAIN ; sender domain alias for send mail config</i>
		    		<input class="form-control" type="text" name="domain" id="domain" value="<?php echo $domain[3];?>" />
		    	</div> 
		    	<div class="form-group">
				    <?php $usermail = explode("'", $lines[25]);?>
		    		<label class="form-control-label">User Email</label>&nbsp;<i style="font-size: x-small;">file constants.php for define _USEREMAIL ; Email Account for send mail config</i>
		    		<input class="form-control" type="text" name="usermail" id="usermail" value="<?php echo $usermail[3];?>" />
		    	</div>   
		    	<div class="form-group">
				    <?php $emailpass = explode("'", $lines[26]);?>
		    		<label class="form-control-label">Pass Email</label>&nbsp;<i style="font-size: x-small;">file constants.php for define _EMAILPASS ; Password of Email Account for send mail config</i>
		    		<input class="form-control" type="password" name="emailpass" id="emailpass" value="<?php echo $emailpass[3];?>" />
		    	</div>  
		    	<div class="form-group">
				    <?php $encryptkey = explode("'", $lines[27]);?>
		    		<label class="form-control-label">Encrypt Key</label>&nbsp;<i style="font-size: x-small;">file constants.php for define _ENCRYPTKEY</i>
		    		<input class="form-control" type="text" name="encryptkey" id="encryptkey" value="<?php echo $encryptkey[3];?>" />
		    	</div>   
		    	<div class="form-group">
				    <?php $prefix = explode("'", $lines[21]);?>
		    		<label class="form-control-label" style="color: red;">Prefix</label>&nbsp;<i style="font-size: x-small;color: red;">file constants.php for define _PREFIX ; database table alias (ex : mytemp_ for table mytemp_user, mytemp_category , mytemp_.. etc.)</i>
		    		<input class="form-control" type="text" name="prefix" id="prefix" value="<?php echo $prefix[3];?>" />
		    	</div> 
		    	<div class="form-group">
				    <?php $akey = explode("'", $lines[28]);?>
		    		<label class="form-control-label" style="color: red;">Filemanager Acc.Key</label>&nbsp;<i style="font-size: x-small;color: red;">file constants.php for define _AKEY ; responsive file manager access key, must be match with akey on filemanager/config/config.php (plugins)</i>
		    		<input class="form-control" type="text" name="akey" id="akey" value="<?php echo $akey[3];?>" />
		    	</div>   
		    	<div class="form-group">
				    <?php $csemail = explode("'", $lines[29]);?>
		    		<label class="form-control-label">Email Receiver</label>&nbsp;<i style="font-size: x-small;">file constants.php for define _CSEMAIL ; default contact to receive email from user</i>
		    		<input class="form-control" type="text" name="csemail" id="csemail" value="<?php echo $csemail[3];?>" />
		    	</div> 
		    	<div class="form-group">
				    <?php $protocol = explode("'", $lines[30]);?>
		    		<label class="form-control-label">Protocol</label>&nbsp;<i style="font-size: x-small;">file constants.php for define _PROTOCOL ; default protocol for config send_email</i>
		    		<input class="form-control" type="text" name="protocol" id="protocol" value="<?php echo $protocol[3];?>" />
		    	</div>        		
	    	</div>
	    </div>
	    <div class="box-footer">
	    	<div class="col-xs-12">
		    	<input class="btn btn-primary pull-right" type="submit" name="submitConstant" Value="Save">
	    	</div>
	    </div>
	</form>
</div>