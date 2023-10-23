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
  <div class="modal-dialog" role="document">
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
              <label for="groupName" class="form-control-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" >
            </div>
            <div class="form-group">
              <label for="groupName" class="form-control-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" >
            </div>
            <div class="form-group">
              <label for="groupName" class="form-control-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" >
            </div>
            <div class="form-group">
              <label for="groupName" class="form-control-label">Photo</label>
              <div class="input-group">
                <input type="text" class="form-control" data-error=".result" id="photo" name="photo" >
                <div class="input-group-btn">
                  <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=photo&akey='._AKEY); ?>" class="iframe-btn" title="File Manager">
                      Browse
                  </a>
                </div>
              </div>
              <div class="result has-error"></div>
            </div>
            <div class="form-group">
              <label for="groupName" class="form-control-label">Role</label>
              <!--input type="text" class="form-control" id="role" name="role" -->
              <select class="form-control" id="role" name="role">
                  <option value=""></option>
                  <option value="1">Admin</option>
                  <option value="2">User</option>
              </select>
            </div>
            <div class="form-group">
              <label for="groupName" class="form-control-label">Group Menu</label>
              <!--input type="text" class="form-control" id="menu" name="menu" -->
              <select class="form-control" id="menu" name="menu">
                  <option value=""></option>
                <?php foreach($res_group as $row){ ?>
                  <option value="<?php echo $row['id']; ?>"><?php echo $row['groupname'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="branchSel" class="form-control-label">Branch</label>
              <select class="form-control" id="branch" name="branch">
                  <option value="0">All</option>
                  <?php foreach($res_branch as $row){ ?>
                    <option value="<?php echo $row['idhospital'];?>"><?php echo $row['namehospital'];?></option>
                  <?php } ?>
              </select>
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
  <div class="modal-dialog" role="document">
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
              <input type="hidden" name="id" id="id"/>
              <input type="hidden" name="url" id="url"/>
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
      username: {
        required: true
      },
      name: {
        required: true
      },
      email: {
        required: true
      },
      photo: {
        required: true
      },
      role: {
        required: true
      },
      menu: {
        required: true
      }
    },
    messages: {
      username: {
        required: "Please provide a Username"
      },
      name: {
        required: "Please provide a Name"
      },
      email: {
        required: "Please provide a Email"
      },
      photo: {
        required: "Please provide a Photo"
      },
      role: {
        required: "Please provide a Rolo"
      },
      menu: {
        required: "Please provide a Menu"
      }
    },
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    },
    submitHandler: function(form) {
      $('.overlay').show();
      var Username  = $("#username").val();
      var Name      = $("#name").val();
      var Email     = $("#email").val();
      var Photo     = $("#photo").val();
      var Role      = $("#role").val();
      var Menu      = $("#menu").val();      
      var Branch    = $("#branch").val();      
      var modal     = $("#successModal");

      $.post("<?php echo site_url('add-account');?>",
        {name:Name,username:Username,email:Email,photo:Photo,role:Role,menu:Menu,branch:Branch},
        function(data){
          $('.overlay').hide();
          $("#mAdd").modal('hide');
          $('#successModal').modal({backdrop: 'static', keyboard: false})
          if(data == 'Success'){
            modal.find('.modal-body').text('Data Saved..');
          }else{
            modal.find('.modal-body').text('Failed Save Data..');
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
      vusername: {
        required: true
      },
      vname: {
        required: true
      },
      vemail: {
        required: true
      },
      vphoto: {
        required: true
      },
      vrole: {
        required: true
      },
      vmenu: {
        required: true
      }
    },
    messages: {
      username: {
        required: "Please provide a Username"
      },
      name: {
        required: "Please provide a Name"
      },
      email: {
        required: "Please provide a Email"
      },
      photo: {
        required: "Please provide a Photo"
      },
      role: {
        required: "Please provide a Rolo"
      },
      menu: {
        required: "Please provide a Menu"
      }
    },
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    },
    submitHandler: function(form) {
      $('.overlay').show();
      var Username  = $("#vusername").val();
      var Name      = $("#vname").val();
      var Email     = $("#vemail").val();
      var Photo     = $("#vphoto").val();
      var Role      = $("#vrole").val();
      var Menu      = $("#vmenu").val();      
      var Branch    = $("#branch").val();      
      var modal     = $("#successModal");

      $.post("<?php echo site_url('edit-account');?>",
        {name:Name,username:Username,email:Email,photo:Photo,role:Role,menu:Menu,branch:Branch},
        function(data){
          $('.overlay').hide();
          $("#mView").modal('hide');
          $('#successModal').modal({backdrop: 'static', keyboard: false})
          if(data == 'Success'){
            modal.find('.modal-body').text('Data Updated..');
          }else{
            modal.find('.modal-body').text('Failed Update Data..');
          }
        }   
      );
    }
  });

  $(document).on('click','.closeMessage',function(e){
      e.preventDefault();
      $("#successModal").modal('hide');
      window.location.replace("<?php echo base_url('manage-admin');?>");  
  });

  $(document).on('click','.view',function(e){
    e.preventDefault();
    $('.overlay').show();

    var id  = $(this).attr('pk');
    var url = $(this).attr('url');
    var dataid = $(this).attr('data-id');
    var modal  = $("#mView");

    $.post('<?php echo site_url('');?>'+url,
        {id:id,type:'view'},
        function(data){
          $('.overlay').hide();
          $("#edit").hide();
          if(data != ''){
            $("#mView").modal('show');
            modal.find('.modal-body').html(data);
          }else{
            $("#successModal").modal('show');
            modal.find('.modal-body').text('No Data..');
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

    var id  = $(this).attr('pk');
    var url = $(this).attr('url');

    $("#deleteModal").modal('show');
    $("#id").val(id);
    $("#url").val(url);
  });

  $(document).on('click','#deleteConfirm',function(e){
    e.preventDefault();
    var id    = $("#id").val();
    var url   = $("#url").val();
    var modal = $("#successModal");
      $.post('<?php echo site_url('');?>'+url,
          {id:id},
          function(data){
            if(data == 'Success'){
              $("#deleteModal").modal('hide');
              $('#successModal').modal({backdrop: 'static', keyboard: false})
              modal.find('.modal-body').text('Data Deleted..');
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