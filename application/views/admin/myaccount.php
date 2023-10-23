<section class="content-header" style="padding:0;">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Utility</a></li>
            <li class="active">Setting</li>
            <li class="active">My Account</li>
        </ol>
    </div>
</section>

<div class="row">
	<!-- left column -->
	<div class="col-md-8">
		<!-- general form elements -->
		<div class="box">
			<div class="box-header with-border">
        		<?php echo $this->session->flashdata('message');?>
				<h3 class="box-title"><?php echo $title;?></h3>
			</div>
			<!-- form start -->
			<form name="myaccount-info" action="<?php echo base_url('change-info'); ?>" method="POST" role="form">
				<div class="box-body">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo $result['name'];?>">
					</div>
					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Password" value="<?php echo $result['email'];?>">
					</div>
		            <div class="form-group">
		              <label for="photo" class="form-control-label">Photo</label>
              		  <div class="input-group">
			              <input type="text" class="form-control" id="photo" data-error=".result" name="photo" value="<?php echo $result['photo'];?>">
		                  <div class="input-group-btn">
		                    <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=photo&akey='._AKEY);?>" class="iframe-btn" title="File Manager">
		                        Browse
		                    </a>
		                  </div>
		              </div>
		              <div class="result has-error"></div>
		            </div>
					<!--div class="checkbox">
						<label>
							<input type="checkbox"> Check me out
						</label>
					</div-->
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-4">
		<div class="box">
				<div class="overlay">
					<i class="fa fa-refresh fa-spin"></i>
				</div>

				<div class="box-header with-border">
			        <?php echo $this->session->flashdata('message_');?>
					<h3 class="box-title">Change Password</h3>
				</div>
				<!-- form start -->
			<form name="myaccount-password" role="form" action="<?php echo base_url('change-password');?>" method="post">
				<div class="box-body">
					<div class="form-group">
						<label for="oldpassword">Your Password</label>
						<input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Your Password">
						<input type="hidden" class="form-control" id="hidden_pass" name="hidden_pass">
					</div>
					<hr style="margin: 0;">
					<div class="form-group val">
						<label for="newpassword">New Password</label>
						<input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password">
					</div>
					<div class="form-group val">
						<label for="retypepassword">Re-type Password</label>
						<input type="password" class="form-control" id="retypepassword" name="retypepassword" placeholder="Re-type Password">
					</div>
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<button type="submit" class="btn btn-primary" id="btn-change">Change</button>
				</div>
			</form>

		</div>
	</div>
</div>