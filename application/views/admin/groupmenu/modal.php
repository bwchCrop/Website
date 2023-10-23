<div class="modal fade" id="mAddGroup" tabindex="-1" role="dialog" aria-labelledby="groupModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="overlay">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <div class="modal-content">
      <form name="mAddGroup" method="POST" class="mAddGroup">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Add Group Menu</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="groupName" class="form-control-label">Group Name</label>
              <input type="text" class="form-control" id="groupName" name="groupName" >
            </div>
            <div class="form-group">
              <label for="menuList" class="form-control-label">Menu List</label>
              <div class="form-control" style="height: 250px !important; overflow-y: scroll; overflow-x: hidden;">
                <table class="table table-bordered">
                  <thead>
                    <th>
                      <td>
                        <b>Title</b>
                      </td>
                      <td align="center">
                        <input type="checkbox" name="chkall" id="chkall" class="minimal chkall">
                      </td>
                      <td align="center">
                        <input type="checkbox" name="chkreadall" id="chkreadall" class="minimal chkreadall">
                      </td>
                      <td align="center">
                        <input type="checkbox" name="chkeditall" id="chkeditall" class="minimal chkeditall">
                      </td>
                      <td align="center">
                        <input type="checkbox" name="chkdeleteall" id="chkdeleteall" class="minimal chkdeleteall">
                      </td>
                    </th>
                  </thead>
                  <tbody>
                    <?php $n = 0; foreach ($data_menu as $row) { $n++; ?>
                    <tr>
                      <td align="center">
                        <?php echo $n; ?>
                      </td>
                      <td>
                        <?php echo $row['menu']; ?>
                      </td>
                      <td align="center">
                        <input type="checkbox" name="cb_menu[]" id="cb_menu[]" data-error=".result" class="minimal chkmenu" value="<?php echo $row['id'];?>" >
                      </td>
                      <td align="center">
                        <input type="checkbox" name="cb_read[]" id="cb_read[]" data-error=".result" class="minimal chkread" value="<?php echo $row['id'];?>" >
                      </td>
                      <td align="center">
                        <input type="checkbox" name="cb_edit[]" id="cb_edit[]" data-error=".result" class="minimal chkedit" value="<?php echo $row['id'];?>" >
                      </td>
                      <td align="center">
                        <input type="checkbox" name="cb_delete[]" id="cb_delete[]" data-error=".result" class="minimal chkdelete" value="<?php echo $row['id'];?>" >
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="result has-error"></div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="saveGroup">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="mViewGroup" tabindex="-1" role="dialog" aria-labelledby="groupModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="overlay">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <div class="modal-content">
      <form name="mViewGroup" method="POST" class="mViewGroup">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Group Menu</h4>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="editBtn">Update</button>
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

  $(".mAddGroup").validate({
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
      groupName: {
        required: true
      },
      'cb_menu[]': {
        required: true
      }
    },
    messages: {
      groupName: {
        required: "Please provide a Group Name"
      },
      'cb_menu[]': {
        required: "Please Choose Menu List"
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
      var Name   = $("#groupName").val();
      var modal  = $("#successModal");
      var val = [];
      $('.chkmenu:checked').each(function(i){
        val[i] = $(this).val();
      });

      $.post("<?php echo site_url('add-group');?>",
        {name:Name,menu:val},
        function(data){
          $('.overlay').hide();
          $("#mAddGroup").modal('hide');
          $('#successModal').modal({backdrop: 'static', keyboard: false})
          if(data == 'Success'){
            modal.find('.modal-body').text('Data Saved..');
          }else{
            modal.find('.modal-body').text('Failed');
          }
        }   
      );
    }
  });

  $(".mViewGroup").validate({
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
      vgroupName: {
        required: true
      },
      'cb_menu[]': {
        required: true
      }
    },
    messages: {
      vgroupName: {
        required: "Please provide a Group Name"
      },
      'cb_menu[]': {
        required: "Please Choose Menu List"
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
      var url     = $("#url").val();
      var id     = $("#idGroup").val();
      var Name   = $("#vgroupName").val();
      var modal  = $("#successModal");
      var val = [];
      $('.chkmenu:checked').each(function(i){
        val[i] = $(this).val();
      });

      $.post("<?php echo site_url('');?>"+url,
        {id:id,name:Name,menu:val},
        function(data){
          $('.overlay').hide();
          $("#mViewGroup").modal('hide');
          $('#successModal').modal({backdrop: 'static', keyboard: false})
          if(data == 'Success'){
            modal.find('.modal-body').text('Data Updated..');
          }else{
            modal.find('.modal-body').text('Update Failed..');
          }
        }   
      );
    }
  });

  $('.modal').on('shown.bs.modal', function (e) {
    var triggeredByChild = false;
    
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({checkboxClass: 'icheckbox_minimal-blue',radioClass: 'iradio_minimal-blue'});
  
    // CHKALL
      $('.chkall').on('ifChecked', function (event) {
        $('.chkmenu').iCheck('check'); triggeredByChild = false;
      });

      $('.chkall').on('ifUnchecked', function (event) {
        if(!triggeredByChild){ $('.chkmenu').iCheck('uncheck');} triggeredByChild = false;
      });

      $('.chkmenu').on('ifUnchecked', function (event) {
        triggeredByChild = true; $('#chkall').iCheck('uncheck');
      });

      $('.chkmenu').on('ifChecked', function (event) {
        if($('.chkmenu').filter(':checked').length == $('.chkmenu').length) {
          $('#chkall').iCheck('check');
        }
      });

    // CHKREAD
      $('.chkreadall').on('ifChecked', function (event) {
        $('.chkread').iCheck('check'); triggeredByChild = false;
      });

      $('.chkreadall').on('ifUnchecked', function (event) {
        if(!triggeredByChild){ $('.chkread').iCheck('uncheck');} triggeredByChild = false;
      });

      $('.chkread').on('ifUnchecked', function (event) {
        triggeredByChild = true; $('#chkreadall').iCheck('uncheck');
      });

      $('.chkread').on('ifChecked', function (event) {
        if($('.chkread').filter(':checked').length == $('.chkread').length) {
          $('#chkreadall').iCheck('check');
        }
      });

    // CHKEDIT
      $('.chkeditall').on('ifChecked', function (event) {
        $('.chkedit').iCheck('check'); triggeredByChild = false;
      });

      $('.chkeditall').on('ifUnchecked', function (event) {
        if(!triggeredByChild){ $('.chkedit').iCheck('uncheck');} triggeredByChild = false;
      });

      $('.chkedit').on('ifUnchecked', function (event) {
        triggeredByChild = true; $('#chkeditall').iCheck('uncheck');
      });

      $('.chkedit').on('ifChecked', function (event) {
        if($('.chkedit').filter(':checked').length == $('.chkedit').length) {
          $('#chkeditall').iCheck('check');
        }
      });

    // CHKDELETE
      $('.chkdeleteall').on('ifChecked', function (event) {
        $('.chkdelete').iCheck('check'); triggeredByChild = false;
      });

      $('.chkdeleteall').on('ifUnchecked', function (event) {
        if(!triggeredByChild){ $('.chkdelete').iCheck('uncheck');} triggeredByChild = false;
      });

      $('.chkdelete').on('ifUnchecked', function (event) {
        triggeredByChild = true; $('#chkdeleteall').iCheck('uncheck');
      });

      $('.chkdelete').on('ifChecked', function (event) {
        if($('.chkdelete').filter(':checked').length == $('.chkdelete').length) {
          $('#chkdeleteall').iCheck('check');
        }
      });
  })

  $(document).on('click','.closeMessage',function(e){
      e.preventDefault();
      $("#successModal").modal('hide');
      window.location.replace("<?php echo base_url('group-menu');?>");  
  });

  $(document).on('click','.view',function(e){
    e.preventDefault();
    $('.overlay').show();

    var id  = $(this).attr('pk');
    var url = $(this).attr('url');
    var dataid = $(this).attr('data-id');
    var modal  = $("#mViewGroup");

    $.post(url,
      {id:id,type:'view'},
      function(data){
        $('.overlay').hide();
        $("#editBtn").hide();
        if(data != ''){
          $("#mViewGroup").modal('show');
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
    var modal  = $("#mViewGroup");

    $.post('<?php echo site_url('');?>'+url1,
        {url:url2,id:id,type:'edit'},
        function(data){
          $('.overlay').hide();
          if(data != ''){
            $("#mViewGroup").modal('show');
            $("#editBtn").show();
            modal.find('.modal-body').html(data);
          }else{
            $("#mViewGroup").modal('show');
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
    $(".overlay").show();
    var id    = $("#id").val();
    var url   = $("#url").val();
    var modal = $("#successModal");
      $.post(url,
          {id:id},
          function(data){
            $(".overlay").hide();
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