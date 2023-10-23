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
      namehospital: {
        required: true
      },
      description: {
        required: true
      },
      location: {
        required: true
      },
      address: {
        required: true
      },
      picture: {
        required: true
      },
      longitude: {
        required: true
      },
      latitude: {
        required: true
      }
    },
    messages: {
      namehospital: {
        required: "Please provide a Hospital Name"
      },
      description: {
        required: "Please provide a Description"
      },
      location: {
        required: "Please provide a Location"
      },
      address: {
        required: "Please provide a Address"
      },
      picture: {
        required: "Please provide a Picture"
      },
      longitude: {
        required: "Please provide a Longitude"
      },
      latitude: {
        required: "Please provide a Latitude"
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
      var Namehospital = $("#namehospital").val();
      var Location = $("#location").val();
      var Description = $("#description").val();
      var Address   = $("#address").val();//tinyMCE.get('address').getContent();
      var Image     = $("#picture").val();
      var Banner    = $("#image").val();
      var Longitude = $("#longitude").val();
      var Latitude  = $("#latitude").val();
      var mapurl    = $("#mapurl").val();
      var city      = $("#city").val();
      var email     = $("#email").val();
      var phone     = $("#phone").val();
      var ugd     = $("#ugd").val();

      if ($('input#publish').is(':checked')) {
        var Publish   = 1; 
      }else{
        var Publish   = 0; 
      }
      var modal     = $("#successModal");

      //alert(Namehospital+Location+Address+Image+Longitude+Latitude+Publish);
      $.post("<?php echo site_url('add-hospital');?>",
        {namehospital:Namehospital,description:Description,location:Location,addresshospital:Address,picture:Image,image:Banner,longitude:Longitude,latitude:Latitude,publish:Publish,mapurl:mapurl,city:city,email:email,phone:phone,ugd:ugd},
        function(data){
          $('.overlay').hide();
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
      namehospital: {
        required: true
      },
      description: {
        required: true
      },
      location: {
        required: true
      },
      address: {
        required: true
      },
      picture: {
        required: true
      },
      longitude: {
        required: true
      },
      latitude: {
        required: true
      }
    },
    messages: {
      namehospital: {
        required: "Please provide a Hospital Name"
      },
      description: {
        required: "Please provide a Description"
      },
      location: {
        required: "Please provide a Location"
      },
      address: {
        required: "Please provide a Address"
      },
      picture: {
        required: "Please provide a Picture"
      },
      longitude: {
        required: "Please provide a Longitude"
      },
      latitude: {
        required: "Please provide a Latitude"
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
      var Idhospital   = $("#idhospital").val();
      var Description = $("#description").val();
      var Namehospital = $("#namehospital").val();
      var Location  = $("#location").val();
      var Address   = $("#address").val();//tinyMCE.get('address').getContent();
      var Image     = $("#picture").val();
      var Banner    = $("#image").val();
      var Longitude = $("#longitude").val();
      var Latitude  = $("#latitude").val();
      var mapurl    = $("#mapurl").val();
      var city      = $("#city").val();
      var email     = $("#email").val();
      var phone     = $("#phone").val();
      var ugd     = $("#ugd").val();

      var services = []; 
      $("input:checkbox[name=services]:checked").each(function(){
          services.push($(this).val());
      });

      var facilities = []; 
      $("input:checkbox[name=facilities]:checked").each(function(){
          facilities.push($(this).val());
      });

      if ($('input#publish').is(':checked')) {
        var Publish   = 1; 
      }else{
        var Publish   = 0; 
      }
      var modal     = $("#successModal");

      $.post("<?php echo site_url('edit-hospital');?>",
        {idhospital:Idhospital,description:Description,namehospital:Namehospital,location:Location,addresshospital:Address,picture:Image,image:Banner,longitude:Longitude,latitude:Latitude,publish:Publish,mapurl:mapurl,city:city,email:email,phone:phone,ugd:ugd,facilities:facilities,services:services},
        function(data){
          $('.overlay').hide();
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
      window.location.replace("<?php echo base_url('admin-hospital');?>");  
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

