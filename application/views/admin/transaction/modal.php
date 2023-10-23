<div class="modal fade bs-example-modal-lg" id="mView" tabindex="-1" role="dialog" aria-labelledby="viewModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content content">
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
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="mExport" tabindex="-1" role="dialog" aria-labelledby="viewModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form name="mExport" action="<?php echo base_url('export-transaction');?>" method="POST" class="mExport">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-filter"></i>&nbsp;&nbsp;&nbsp;Filter Export Excel</h4>
        </div>
        <div class="modal-body">
          <style>
            .multiselect-native-select .btn-group{
              display: block !important;
            }
            .multiselect-native-select .btn-group>.btn{
              float: none !important;
              border-radius: 0px !important;
              width: 100%;
              text-align: left;
            }
            .multiselect-native-select .btn-group .btn-default{
              background-color: #ffffff !important;
            }
            .multiselect-native-select .caret{
              float: right;
              margin-top: 7px;
            }
            .multiselect-container.dropdown-menu{
              width: 100%;
            }
          </style>

          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label class="form-control-label">Doctor Name (Similar)</label>
                <input class="form-control" type="text" name="doctor" id="doctor" placeholder="Enter doctor name">
              </div>

              <div class="form-group">
                <label class="form-control-label">Location</label>
                <select class="form-control multiple-drop" multiple="multiple" name="location" id="location">
                  <?php $getLocation = $this->mlocation->getAllActive()->result_array();?>
                  <?php foreach($getLocation as $row){ ?>
                  <option value="<?php echo $row['id'];?>"><?php echo $this->marge->capital($row['namelocation']);?></option>
                  <?php } ?>
                </select>
                <input type="hidden" name="valLocation" id="valLocation">
              </div>      

              <div class="form-group">
                <label class="form-control-label">Day</label>
                <select class="form-control multiple-drop" multiple="multiple" name="day" id="day">
                  <option value="1">Monday</option>
                  <option value="2">Tuesday</option>
                  <option value="3">Wednesday</option>
                  <option value="4">Thursday</option>
                  <option value="5">Friday</option>
                  <option value="6">Saturday</option>
                  <option value="7">Sunday</option>
                </select>
                <input type="hidden" name="valDay" id="valDay">
              </div>
            </div>

            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label class="form-control-label">Speciality</label>
                <select class="form-control multiple-drop" multiple="multiple" name="speciality" id="speciality">
                  <?php $getSpeciality = $this->mhighlight->getByMenu('admin-doctor', '1')->result_array();?>
                  <?php foreach($getSpeciality as $row){ ?>
                  <option value="<?php echo $row['highlight_id'];?>"><?php echo $this->marge->capital($row['highlight_title']);?></option>
                  <?php } ?>
                </select>
                <input type="hidden" name="valSpeciality" id="valSpeciality">
              </div>   

              <div class="form-group">
                <label class="form-control-label">Branch</label>
                <select class="form-control multiple-drop" multiple="multiple" name="branch" id="branch">
                  <?php $getBranch = $this->mhospital->getActived()->result_array();?>
                  <?php foreach($getBranch as $row){ ?>
                  <option value="<?php echo $row['idhospital'];?>"><?php echo $this->marge->capital($row['namehospital']);?></option>
                  <?php } ?>
                </select>
                <input type="hidden" name="valBranch" id="valBranch">
              </div>

              <div class="form-group">
                <label class="form-control-label">Period</label>
                <select class="form-control multiple-drop" multiple="multiple" name="time" id="time">
                  <option value="1">Morning</option>
                  <option value="2">Noon</option>
                  <option value="3">Night</option>
                </select>
                <input type="hidden" name="valTime" id="valTime">
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id="exportBtn">Export</button>
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
      vnamecategory: {
        required: true
      }
    },
    messages: {
      vnamecategory: {
        required: "Please provide a Doctor Category"
      }
    },
    submitHandler: function(form) {
      $('.overlay').show();
      var Name      = $("#vnamecategory").val();
      var Picture   = $("#vpicturecategory").val();
      var ID        = $("#id").val();    
      var modal     = $("#successModal");

      $.post("<?php echo site_url('edit-doctorcategory');?>",
        {namecategory:Name,id:ID,picturecategory:Picture},
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
      window.location.replace("<?php echo base_url('doctorcategory');?>");  
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