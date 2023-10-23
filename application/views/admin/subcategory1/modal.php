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
              <label for="subcategory1" class="form-control-label">Group Item Category</label>
              <input type="text" class="form-control" id="subcategory1" name="subcategory1" >
            </div>  
            <div class="form-group">
              <label for="category" class="form-control-label">Category</label>
              <select class="form-control" id="category" name="category" >
                <?php foreach ($result_group as $row) { ?>
                  <option value="<?php echo $row['id'];?>"><?php echo $row['namecategory'];?></option>
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
      subcategory1: {
        required: true
      }
    },
    messages: {
      subcategory1: {
        required: "Please provide a Group Item Category"
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
      var subcategory1  = $("#subcategory1").val();   
      var category  = $("#category").val(); 
      var modal     = $("#successModal");

      $.post("<?php echo site_url('add-groupitemcategory');?>",
        {subcategory1:subcategory1,category:category},
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
      vname: {
        required: true
      }
    },
    messages: {
      vname: {
        required: "Please provide a Category Name"
      }
    },
    submitHandler: function(form) {
      $('.overlay').show();
      var Name  = $("#vsubcategory1").val();
      var category = $("#vcategory").val();
      var ID    = $("#id").val();    
      var modal = $("#successModal");

      $.post("<?php echo site_url('edit-groupitemcategory');?>",
        {subcategory1:Name,id:ID,category:category},
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
      window.location.replace("<?php echo base_url('groupitemcategory');?>");  
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
    $(".overlay").show();
    var id    = $("#id").val();
    var url   = $("#url").val();
    var modal = $("#successModal");
      $.post('<?php echo site_url('');?>'+url,
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