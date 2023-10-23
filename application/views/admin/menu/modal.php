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
            <div class="form-group" style="position: relative;">
              <label for="name" class="form-control-label">Menu Name</label>
              <input type="text" class="form-control textchanged" id="name" name="name" checkUrl="<?php echo base_url('admin/menu/checkName');?>">
              <i class="fa fa-spin fa-refresh pull-right loadchanged" style="position: absolute; right: 15px; bottom: 10px; display: none;"></i>
            </div>
            <div class="form-group">
              <label for="groupName" class="form-control-label">Position</label><br>
                <input type="radio" id="position" name="position" class="minimal position" value="1"> Parent &nbsp;&nbsp;
                <input type="radio" id="position" name="position" class="minimal position" value="2"> Menu &nbsp;&nbsp;
                <input type="radio" id="position" name="position" class="minimal position" value="3"> Sub Menu
            </div>

            <div class="op0">
                <input type="hidden" name="indexparent" id="indexparent" value="<?php echo $max_parent['parent']; ?>"/>
            </div>

            <div class="op2">
              <div class="form-group">
                <label for="parent">Parent</label>
                <select class="form-control parent" id="parent" name="parent">
                  <option value="">Choose..</option>
                  <?php foreach($all_parent as $row){ ?>
                  <option value="<?php echo $row['parent'];?>"><?php echo $row['menu'];?></option>
                  <?php } ?>
                </select>
                <input type="hidden" name="indexmenu" id="indexmenu" />
              </div>
              <div class="form-group">
                <label for="icon" class="form-control-label">Icon</label>
                <input type="text" class="form-control" name="icon" id="icon"/>
              </div>
            </div>

            <div class="op3">
              <div class="form-group">
                <label for="parent">Parent</label>
                <select class="form-control parent" id="parent" name="parent">
                  <option value="">Choose..</option>
                  <?php foreach($menu as $row){ ?>
                  <option value="<?php echo $row['parent'];?>"><?php echo $row['menu'];?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="menu">Menu</label>
                <select class="form-control menu" id="menu" name="menu" disabled="disabled">
                  <option value=""></option>
                </select>
                <input type="hidden" name="indexsubmenu" id="indexsubmenu"/>
              </div>
            </div>  

            <div class="op1">
              <div class="form-group">
                <label for="link" class="form-control-label">Route</label>
                <input type="text" class="form-control" name="link" id="link"/>
              </div>       
              <div class="form-group">
                <label for="url" class="form-control-label">URL</label>
                <input type="text" class="form-control" name="url" id="url"/> 
              </div>
            </div>
            <hr>
            <div class="form-group">
              <!-- <label for="status" class="form-control-label">Status</label> -->
              <!-- <input type="text" class="form-control" name="status" id="status"/> -->
              <label class="label-url" style="width: 100%;">
                  <input type="checkbox" id="staturl" name="staturl" class="minimal" value="0" checked="" />&nbsp;
                  URL Link<br>
              </label>
              <label>
                  <input type="checkbox" id="status" name="status" class="minimal"/>&nbsp;
                  Publish
              </label>

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
              <div class="textForm">
              Are you sure?
              </div>
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
  $('.op0').hide();
  $('.op1').hide();
  $('.op2').hide();
  $('.op3').hide();
  $('.label-url').hide();

  jQuery.validator.addMethod("noSpace", function(value, element) { 
     return value.indexOf(" ") < 0 && value != ""; 
  }, "Space are not allowed");

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
        required: true,
        noSpace: true,
        remote : {
              url: "<?php echo base_url('admin/menu/checkValue/name');?>",
              type: "post"
        }
      },
      link: {
        remote : {
              url: "<?php echo base_url('admin/menu/checkValue/link');?>",
              type: "post"
        }
      },
      url: {
        remote : {
              url: "<?php echo base_url('admin/menu/checkValue/url');?>",
              type: "post"
        }
      }
    },
    messages: {
      name: {
        required: "Please provide a Name",
        remote: "Menu Already Exist"
      },
      link: {
        remote: "Route Already Exist"
      },
      url: {
        remote: "Url Already Exist"
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
      var Status;
      var Staturl;
      var Name      = $("#name").val();
      var Link      = '';//$("#link").val();
      var Url       ;//= $("#url").val();
      var Position  = $('input[name=position]:checked', '#mAdd').val();
      var Icon    = '';

      if ($('input[name=status]').is(':checked')) {
        Status = '2';
      }else{
        Status = '0';
      }

      if ($('input[name=staturl]').is(':checked')) {
        Staturl = '1';
      }else{
        Staturl = '0';
      }

      if(Position == '1'){
        var Parent  = $('#indexparent').val();
        var Menu    = '0';
        var Submenu = '0';
        Staturl     = '0';
      }else if(Position == '2'){
        var Parent  = $('.op2 .parent').val();
        var Menu    = $('#indexmenu').val();
        var Submenu = '0';
        var Icon    = $('.op2 #icon').val();
      }else{
        var Parent  = $('.op3 .parent').val();
        var Menu    = $('#menu').val();
        var Submenu = $('#indexsubmenu').val();
        Staturl     = '1';
      }

      var modal     = $("#successModal");
      //alert(Staturl);
      $.post("<?php echo site_url('add-menu');?>",
        {name:Name,link:Link,url:Url,status:Status,parent:Parent,menu:Menu,submenu:Submenu,icon:Icon,staturl:Staturl},
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
      var modal     = $("#successModal");

      $.post("<?php echo site_url('edit-account');?>",
        {name:Name,username:Username,email:Email,photo:Photo,role:Role,menu:Menu},
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

  $('input[type="radio"]').on('ifChecked', function(event){
    var position = $(this).val();

    if(position == '1'){
      $('.op0').show();
      $('.op1').hide();
      $('.op2').hide();
      $('.op3').hide();
      $('.label-url').hide();
    }else if(position == '2'){
      $('.op0').hide();
      $('.op1').hide();
      $('.op2').show();
      $('.op3').hide();
      $('.label-url').show();
    }else{
      $('.op0').hide();
      $('.op1').hide();
      $('.op2').hide();
      $('.op3').show();
      $('.label-url').hide();
    }
  });

  $(document).on('click','.closeMessage',function(e){
      e.preventDefault();
      $("#successModal").modal('hide');
      window.location.replace("<?php echo base_url('menu');?>");  
  });

  $( ".op2 .parent" ).change(function() {
      var id = $(this).val();
    
      if(id == ''){
        alert('Choose Parent !');
        $("#menu option").remove();
        $('#menu').attr('disabled','disabled')
      }else{
        $('.overlay').show();
        $("#menu option").remove();

        $.post('<?php echo site_url('admin/menu/get_menu');?>',
            {id:id},
            function(data){
              var data   = data.split('|'); 
              var data2  = data[1];
              $('#indexmenu').val(data2);
              $('.overlay').hide();
            }   
        );
      }
  });

  $( ".op3 .parent" ).change(function() {
      var id = $(this).val();
    
      if(id == ''){
        alert('Choose Parent !');
        $("#menu option").remove();
        $('#menu').attr('disabled','disabled')
      }else{
        $('.overlay').show();
        $("#menu option").remove();

        $.post('<?php echo site_url('admin/menu/get_menu');?>',
            {id:id},
            function(data){
              var data   = data.split('|'); 
              var data1  = data[0];
              var data2  = data[1];
              var result = data1.split(',');
              for (var i=0;i<result.length;i++){
                var resultdata = result[i];
                var data = resultdata.split('-');
                $('<option/>').val(data[0]).html(data[1]).appendTo('#menu');
              }
              //$('#indexmenu').val(data2);
              $('#menu').removeAttr('disabled')
              $('.overlay').hide();
            }   
        );
      }
  });

  $(".op3 .menu").change(function(){
      var id1 = $('.op3 .parent').val();
      var id2 = $(this).val();
    
      if(id == ''){
        alert('Choose Menu !');
      }else{
        $('.overlay').show();

        $.post('<?php echo site_url('admin/menu/get_submenu');?>',
            {id1:id1,id2:id2},
            function(data){
              //alert(data);
              $('#indexsubmenu').val(data);
              $('.overlay').hide();
            }   
        );
      }
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

    var id    = $(this).attr('pk');
    var res   = id.split("-");
    var resID = res[0];
    var resMN = res[1];
    var url   = $(this).attr('url');

    $("#deleteModal").modal('show');
    $("#deleteModal").find('.textForm').text('Delete Menu '+resMN+' ?');
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
              modal.find('.modal-body').text(data);
            }
          }   
      );
  });
});
</script>