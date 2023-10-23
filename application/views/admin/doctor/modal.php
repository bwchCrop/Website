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

  $('#doctorcategory').change(function(){ 
      $('#itemcategory').attr('disabled','disabled');
      var id = $(this).val(); 
      $.post('<?php echo base_url('admin/doctor/load_cat');?>', {id:id}, function(data){
          $('#itemcategory').html(data);
          $('#itemcategory').removeAttr('disabled');
      });
  });

  $(document).on('click','.closeMessage',function(e){
      e.preventDefault();
      $("#successModal").modal('hide');
      window.location.replace("<?php echo base_url('admin-doctor');?>");  
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
    $('.overlay').show();
    e.preventDefault();
    var id    = $("#id").val();
    var url   = $("#url").val();
    var modal = $("#successModal");
      $.post('<?php echo site_url('');?>'+url,
          {id:id},
          function(data){
            $('.overlay').hide();
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

  delete window.counter;

  var count_g = '<?php echo count($result_schedule);?>';
  if(count_g > 0){
    count_g = count_g;
  }else{
    count_g = '1';
  }
  var counter = count_g;  

  $(document).on('click','#add-schedule',function(e){
      counter++;
      if(counter>7){
          alert("7 Schedule Max.");
          counter--;
          $("input[name=schedule-counter]").val(counter);
          return false;
      }
      
      var table = $(".field-schedule").closest('div');
      table.append('<div class="input-group" style="margin-bottom: 5px;"><input type="text" class="form-control" data-error=".result" id="schedule-'+counter+'" name="schedule-'+counter+'" ><div class="input-group-btn"><a class="btn btn-info iframe-btn" href="'+'<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=schedule-'); ?>'+counter+'<?php echo '&akey='._AKEY;?>" class="iframe-btn" title="File Manager">Browse</a></div></div>');
      $("input[name=schedule-counter]").val(counter);
  });
});
</script>

