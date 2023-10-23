<div class="row">
	<div class="col-xs-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs"> 
				<li class="active"><a href="#general" data-toggle="tab">General</a></li>
				<li><a href="#menu2" data-toggle="tab">Email Setting</a></li>
				<li><a href="#menu3" data-toggle="tab">Misc</a></li>
			</ul>

			<div class="tab-content">
				<!-- MENU 1-->
				<div class="tab-pane active" id="general">
					<form class="form-horizontal">
						<div class="form-group" style="margin-top: 20px;">
							<label for="website_title" class="col-sm-2 control-label">Website Title</label>
							<div class="col-sm-9">
								<input type="text" name="website_title" id="website_title" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label for="website_description" class="col-sm-2 control-label">Website Description</label>
							<div class="col-sm-9">
								<input type="text" name="website_description" id="website_description" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label for="website_message_title" class="col-sm-2 control-label">Website Message Title</label>
							<div class="col-sm-9">
								<input type="text" name="website_message_title" id="website_message_title" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label for="website_message_desc" class="col-sm-2 control-label">Website Message Desc.</label>
							<div class="col-sm-9">
								<!--input type="text" name="website_message_desc" id="website_message_desc" class="form-control" /-->
								<textarea class="form-control" id="website_message_desc" name="website_message_desc">
									
								</textarea>
							</div>
						</div>
					</form>
				</div>
				<!-- MENU 2-->
				<div class="tab-pane" id="menu2">
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-1 control-label">Email To</label>
							<div class="col-sm-9">
								<input type="text" name="emailto" id="emailto" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">Subject</label>
							<div class="col-sm-9">
								<input type="text" name="subject" id="subject" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">Content</label>
							<div class="col-sm-9">
								<textarea class="tinymce" id="emailcontent" id="emailcontent"></textarea>
							</div>
						</div>
					</form>
				</div>
				<!-- MENU 3-->
				<div class="tab-pane" id="menu3">
					
				</div>

			</div>
		</div>
	</div>
</div>