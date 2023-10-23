<style>
  .overlay{
    z-index: 50;
    background: rgba(255,255,255,0.7);
    border-radius: 3px;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;  
  }
  .overlay i{
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -15px;
    margin-top: -15px;
    color: #000;
    font-size: 30px;
  }
</style>

<div class="modal fade" id="mAdd" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="overlay">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <div class="modal-content">
      <form name="mAdd" method="POST" class="mAdd">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Add <?php echo $title;?></h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="name" class="form-control-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" />
              <input type="hidden" name="opt" id="opt"/>
              <input type="hidden" name="type" id="type"/>
              <input type="hidden" name="path" id="path"/>
            </div>        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="save">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="mView" tabindex="-1" role="dialog" aria-labelledby="viewModal" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="overlay">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <div class="modal-content">
      <form name="mView" method="POST" class="mView">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"><?php echo $title;?></h4>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="edit">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="mEditor" tabindex="-1" role="dialog" aria-labelledby="viewModal" aria-hidden="true">
  <style>
      #veditor { 
              position: relative;
              top: 0;
              right: 0;
              bottom: 0;
              left: 0;
              height: 65vh;
          }

      .modal-header.black{
        background-color: #272822; 
        border-bottom-color: #3c3c3c;
        color: rgb(134, 134, 134);
      }

      .modal-body.black{
        background-color: #2f3129;
      }

      .modal-footer.black{
        background-color: #272822;
        border-top-color: #3c3c3c;
      }
  </style>
  <div class="modal-dialog modal-lg" role="document">
    <div class="overlay">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <div class="modal-content">
      <form name="mEditor" method="POST" class="mView">
        <div class="modal-header black">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Code Editor</h4>
        </div>
        <div class="modal-body black">

        </div>
        <div class="modal-footer black">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="save-editor">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="mPhoto" tabindex="-1" role="dialog" aria-labelledby="viewModal" aria-hidden="true">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: .7; outline: 0; position: fixed; left: 2%; top: 1%;">
    <span aria-hidden="true" style="color: white; font-size: -webkit-xxx-large;">&times;</span>
  </button>
  <div class="modal-dialog modal-lg" role="document" style="margin: 7.5% auto;">
    <div class="modals overlay" style="background: rgba(0,0,0,0);">
      <i class="fa fa-refresh fa-spin"></i>
    </div>

    <div class="modal-content" align="center" style="background-color: rgba(0,0,0,0);box-shadow: 0 0 0 rgba(0,0,0,0);">

    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-sm" id="successModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close closeMessage" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Message</h4>
        </div>
        <div class="modal-body">
          <form id="messageForm">
            <div class="form-group">
              <label id="message"/>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary closeMessage" id="closeMessage" >Close</button>
        </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-sm" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="overlay">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Delete Confirmation</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <input type="hidden" name="path" id="path"/>
              <input type="hidden" name="file" id="file"/>
              <input type="hidden" name="type" id="type"/>
              <input type="hidden" name="opt" id="opt"/>
              Are you sure?
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="deleteConfirm" >Yes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >No</button>
        </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url('assets/plugins/aceEditor/ace.js');?>" type="text/javascript" charset="utf-8"></script>
<script>

$(function() {
  	$('.overlay').hide();

  	$(".mAdd").validate({
	    debug: true,
	    errorClass:'help-block',
	    validClass:'help-block',
	    errorElement:'span',
	    highlight: function (element, errorClass, validClass) { 
	      $(element).parents(".has-success").removeClass("has-success"); 
	      $(element).parents("div.form-group").addClass("has-error"); 
	    }, 
	    unhighlight: function (element, errorClass, validClass) { 
	      $(element).parents(".has-error").removeClass("has-error"); 
	      $(element).parents("div.form-group").addClass("has-success"); 
	    },
	    rules: {
	      name: {
	        required: true
	      }
	    },
	    messages: {
	      name: {
	        required: "Please provide a File Name"
	      }
	    },
	    submitHandler: function(form) {
	      $('.overlay').show();
	      var name     = $("#name").val();
	      var opt      = $("#opt").val();         
	      var type     = $("#type").val();         
	      var path     = $("#path").val();         
	      var modal    = $("#successModal");
	      path = path.replace(/\\/g, "+");

	      // alert(path);
	      $.post("<?php echo base_url('admin/filemanager/action/option');?>",
	        {name:name,opt:opt,type:type,path:path},
	        function(data){
	          $('.overlay').hide();
	          $("#mAdd").modal('hide');
	          $('#successModal').modal({backdrop: 'static', keyboard: false})
	          if(data == 'Success'){
	            modal.find('.modal-body').text('File Created..');
	          }else{
	            modal.find('.modal-body').text(data);
	          }
	        }   
	      );

	    }
  	});

  	$(".mView").validate({
	    debug: true,
	    errorClass:'help-block',
	    validClass:'help-block',
	    errorElement:'span',
	    highlight: function (element, errorClass, validClass) { 
	      $(element).parents(".has-success").removeClass("has-success"); 
	      $(element).parents("div.form-group").addClass("has-error"); 

	    }, 
	    unhighlight: function (element, errorClass, validClass) { 
	      $(element).parents(".has-error").removeClass("has-error"); 
	      $(element).parents("div.form-group").addClass("has-success"); 
	    },
	    rules: {
	      name: {
	        required: true
	      }
	    },
	    messages: {
	      name: {
	        required: "Please provide a Name"
	      }
	    },
	    submitHandler: function(form) {
	      $('.overlay').show();
	 
	      var opt     = $('.mView #opt').val();
	      var type    = $('.mView #type').val();
	      var path    = $('.mView #path').val();
	      var file    = $('.mView #name').val();
	      var ext     = $('.mView #ext').val();
	      var oldname = $('.mView #oldname').val();
	      var modal   = $("#successModal");
	      
	      $.post("<?php echo base_url('admin/filemanager/action/option/true/');?>"+file+'+'+ext,
	        {path:path,opt:opt,type:type,name:file,oldname:oldname,ext:ext},
	        function(data){
	          $('.overlay').hide();
	          $("#mView").modal('hide');
	          $('#successModal').modal({backdrop: 'static', keyboard: false})
	          if(data == 'Success'){
	            modal.find('.modal-body').text('File Updated..');
	          }else{
	            modal.find('.modal-body').text(data);
	          }
	        }   
	      );
	    }
  	});

  	$(document).on('click','.closeMessage',function(e){
      e.preventDefault();
      $("#successModal").modal('hide');
      var urlext = '<?php echo $this->uri->segment(2);?>';

      if(urlext == ''){
        window.location.replace("<?php echo base_url('admin-filemanager');?>");  
      }else{
        window.location.replace("<?php echo base_url('admin-filemanager-index/');?>"+urlext);  
      }
  	});

	$(document).on('click','.add',function(e){
	    var opt  = $(this).attr('opt');
	    var type = $(this).attr('type');
	    var path = $(this).attr('path');

	    $('#mAdd').on('shown.bs.modal', function (e) {
	      $("#opt").val(opt);
	      $("#type").val(type);
	      $("#path").val(path);
	    })
	});

  	$(document).on('click','.view',function(e){
	    e.preventDefault();
	    $('.overlay').show();

	    var opt     = $(this).attr('opt');
	    var type    = $(this).attr('type');
	    var path    = $(this).attr('path');
	    var file    = $(this).attr('file');
	    var modal   = $("#mView");
	    var exfile  = file.split('+');

	    $.post('<?php echo base_url('admin/filemanager/action/option/false/');?>'+file,
	      {path:path,opt:opt,type:type,name:exfile[0]},
	      function(data){
	        $('.overlay').hide();
	        $('.modal-content img').hide();
	        if(data != ''){
	          $("#mView").modal('show');
	          modal.find('.modal-body').html(data);
	        }else{
	          $("#successModal").modal('show');
	          modal.find('.modal-body').text('File Not Found..');
	        }
	      }   
	    );
  	});

  	$(document).on('click','.editor',function(e){
	    e.preventDefault();
	    $('.overlay').show();

	    var path  = $(this).attr('path');
	    var file  = $(this).attr('file');
	    var opt   = $(this).attr('opt');
	    var type  = $(this).attr('type');

	    var modal = $("#mEditor");
	    var exfile = file.split('+');
	    var mode;

	    $.post('<?php echo base_url('admin/filemanager/action/filesrc/false/');?>',
	        {path:path,file:file,opt:opt,type:type},
	        function(data){
	          $('.overlay').hide();
	          if(data != ''){
	            $("#mEditor").modal('show');
	            modal.find('.modal-body').html(data);

	            if(exfile[1] == 'js'){
	              mode = 'javascript';
	            }else if(exfile[1] == 'php'){
	              mode = 'php';
	            }else if(exfile[1] == 'css' || exfile[1] == 'scss'){
	              mode = 'css';
	            }else if(exfile[1] == 'html'){
	              mode = 'html';
	            }else{
	              mode = 'textfile';
	            }

	            var editor = ace.edit("veditor");
	            editor.setTheme("ace/theme/monokai");
	            editor.getSession().setMode("ace/mode/"+mode);
	          }else{
	            $("#successModal").modal('show');
	            modal.find('.modal-body').text('No Data..');
	          }
	        }   
	    );
  	});

  	$(document).on('click','.photo',function(e){
	    e.preventDefault();
	    $('.overlay').show();

	    var path   = $(this).attr('path');
	    var file   = $(this).attr('file');
	    var modal  = $("#mPhoto");
	    var exfile = file.split('+');
	    var mode;

	    $.post('<?php echo base_url('admin/filemanager/action/filesrc/photo');?>',
	      {path:path,file:file},
	      function(data){
	        $('.overlay').hide();
	        $('.modal-content img').hide();
	        if(data != ''){
	          $("#mPhoto").modal('show');
	          modal.find('.modal-content').html(data);
	          $('.modal-content img').show();
	        }else{
	          $("#successModal").modal('show');
	          modal.find('.modal-body').text('File Not Found..');
	        }
	      }   
	    );
  	});

  	$(document).on('click','#save-editor',function(e){
	    e.preventDefault();
	    var editor  = ace.edit("veditor");
	    var code    = editor.getValue();
	    var path    = $("#mEditor #path").val();
	    var opt     = $("#mEditor #opt").val();
	    var type    = $("#mEditor #type").val();
	    var file    = $("#mEditor #file").val();
	    var meditor = $("#mEditor");
	    var modal = $("#successModal");

	    //SETVALUE ---> editor.setValue("new code here");

	    // alert(path+'<br>'+opt+'<br>'+type+'<br>'+file+'<br>'+code);

	    $.post('<?php echo base_url('admin/filemanager/action/option/false/');?>',
	        {path:path,opt:opt,type:type,file:file,code:code},
	        function(data){
	          $('.overlay').hide();
	          if(data == 'Success'){
	            meditor.modal('hide');
	            $('#successModal').modal({backdrop: 'static', keyboard: false})
	            modal.find('.modal-body').text('Save Changes..');
	          }else{
	            meditor.modal('hide');
	            $('#successModal').modal({backdrop: 'static', keyboard: false})
	            modal.find('.modal-body').text(data);
	          }
	        }   
	    );
  	});

  	$(document).on('click','.edit',function(e){
	    e.preventDefault();
	    $('.overlay').show();

	    var id  = $(this).attr('pk');
	    var url1 = $(this).attr('url1');
	    var url2 = $(this).attr('url2');
	    var dataid = $(this).attr('data-id');
	    var modal  = $("#mView");

	    $.post('<?php echo site_url('');?>'+url1,
	        {url:url2,id:id,type:'edit'},
	        function(data){
	          $('.overlay').hide();
	          if(data != ''){
	            $("#mView").modal('show');
	            $("#edit").show();
	            modal.find('.modal-body').html(data);
	          }else{
	            $("#mView").modal('show');
	            modal.find('.modal-body').text('No Data..');
	          }
	        }   
	    );
  	});  

  	$(document).on('click','.delete',function(e){
	    e.preventDefault();

	    var xfile  = $(this).attr('file');
	    var path  = $(this).attr('path');
	    var opt   = $(this).attr('opt');
	    var type  = $(this).attr('type');

	    $("#deleteModal").modal('show');
	    $("#deleteModal #file").val(xfile);
	    $("#path").val(path);
	    $("#opt").val(opt);
	    $("#type").val(type);
  	});

  	$(document).on('click','#deleteConfirm',function(e){
	    e.preventDefault();
	    $('.overlay').show();
	    var file  = $('#deleteModal #file').val();
	    var path  = $('#path').val();
	    var opt   = $('#opt').val();
	    var type  = $('#type').val();
	    var modal = $("#successModal");

	      $.post('<?php echo base_url('admin/gallery/action/option/false/');?>',
	          {path:path,opt:opt,type:type,file:file},
	          function(data){
	            $('.overlay').hide();
	            if(data == 'Success'){
	              $("#deleteModal").modal('hide');
	              $('#successModal').modal({backdrop: 'static', keyboard: false})
	              modal.find('.modal-body').text('File Deleted..');
	            }else{
	              $("#deleteModal").modal('hide');
	              $('#successModal').modal({backdrop: 'static', keyboard: false})
	              modal.find('.modal-body').text('Failed..');
	            }
	          }   
	      );
  	});
});
</script>
