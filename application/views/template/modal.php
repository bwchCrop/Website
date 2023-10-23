<div class="modal fade" id="mView" tabindex="-1" role="dialog" aria-labelledby="viewModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form name="mView" method="POST" class="mView">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"><?php echo $title;?></h4>
        </div>
        <div class="modal-body">
        <!-- htmlData -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="editBtn">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="mExport" tabindex="-1" role="dialog" aria-labelledby="viewModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form name="mExport" action="<?php echo base_url($this->uri->segment(1).'-export');?>" method="POST" class="mExport">
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

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-filter"></i>&nbsp;&nbsp;&nbsp;Filter Export Excel</h4>
        </div>
        <div class="modal-body">
        <!-- htmlData -->
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
          <button type="button" onclick="close_message('<?php echo base_url().$this->uri->segment(1);?>')" class="btn btn-secondary closeMessage" id="closeMessage" >Close</button>
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
          <h4 class="modal-title" id="exampleModalLabel">Confirmation</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <input type="hidden" name="id" id="id"/>
              <input type="hidden" name="url" id="url"/>
              <input type="hidden" name="role" id="role"/>
              <div class="textForm">
              Are you sure?
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="deleteConfirm" onclick="delete_confirmation()">Yes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >No</button>
        </div>
    </div>
  </div>
</div>

<script>
  $(function() {

    /* --- menu --- */
      $('.op0').hide();
      $('.op1').hide();
      $('.op2').hide();
      $('.op3').hide();
      $('.label-url').hide();
    /* --- menu --- */

    /* --- post --- */
      delete window.counter;

      var count_g = '<?php if(isset($result_picture)){ echo count($result_picture);}else{echo 0;}?>';
      if(count_g > 0){
        count_g = count_g;
      }else{
        count_g = '1';
      }
      var counter = count_g;  

      $(document).on('click','#add-picture',function(e){
          counter++;
          if(counter>12){
              alert("12 Picture Max.");
              counter--;
              $("input[name=picture-counter]").val(counter);
              return false;
          }
          var table = $(".field-picture").closest('div');

          $.post(
                  "<?php echo base_url('admin/post/get_append');?>",
                  {counter:counter},
                  function(data){
                    table.append(data);

                    $('[data-toggle="popover"]').popover({
                        html: true,
                        content: function(){return '<img style="width:100%;" src="'+$(this).val() +'" />';}
                    })
                  }
                );
          $("input[name=picture-counter]").val(counter);
      });
    /* --- post --- */

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
          errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
              $(placement).append(error)
            } else {
              error.insertAfter(element);
            }
          },        
          <?php 
            $url = $this->uri->segment(1);
            switch($url){ 
              case 'group-menu': 
          ?>
          /* --- add groupmenu --- */
            rules: {
              groupName   : { required: true },
              'cb_read[]' : { required: true }
            },
            messages: {
              groupName   : { required: "Please provide a Group Name"},
              'cb_read[]' : { required: "Please Choose Menu List"}
            },
            submitHandler: function(form){
              $('.overlay').show();
              var Name  = $("#groupName").val();
              var modal = $("#successModal");
              var vread = [];
              var vmenu = [];
              var vedit = [];
              var vdelete = [];

              $('.chkread:checked').each(function(i){
                vread[i] = $(this).val();
              });

              $('.chkmenu:checked').each(function(i){
                vmenu[i] = $(this).val();
              });

              $('.chkedit:checked').each(function(i){
                vedit[i] = $(this).val();
              });

              $('.chkdelete:checked').each(function(i){
                vdelete[i] = $(this).val();
              });

              $.post("<?php echo site_url('add-group');?>",
                {name:Name,menu:vmenu,read:vread,edit:vedit,delete:vdelete},
                function(data){
                  $('.overlay').hide();
                  $("#mAdd").modal('hide');
                  $('#successModal').modal({backdrop: 'static', keyboard: false})
                  if(data == 'Success'){
                    modal.find('.modal-body').text('Data Saved..');
                  }else{
                    modal.find('.modal-body').text('Failed');
                  }
                }   
              );
            }
          /* --- add groupmenu --- */
          <?php break;
              case 'menu':
          ?>
          /* --- add menu --- */
            rules: {
              name: { required: true, noSpace: true,
                remote : {
                      url: "<?php echo base_url('admin/menu/checkValue/name');?>",
                      type: "post",
                      data: {
                        bakname: function() {
                          return '';
                        }
                      }
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

              $.post("<?php echo site_url('add-menu');?>",
                {name:Name,link:Link,url:Url,status:Status,parent:Parent,menu:Menu,submenu:Submenu,icon:Icon,staturl:Staturl},
                function(data){
                  $('.overlay').hide();
                  $("#mAdd").modal('hide');
                  $('#successModal').modal({backdrop: 'static', keyboard: false});
                  if(data == 'Success'){
                    modal.find('.modal-body').text('Data Saved..');
                  }else{
                    modal.find('.modal-body').text('Failed Save Data..');
                  }
                }   
              ); 
            }
          /* --- add menu --- */
          <?php break;
              case 'add-post':
          ?>
          /* --- add articlepost --- */
            rules: {
              title:      { required: true },
              content:    { required: true },
              idcategory: { required: true }
            },
            messages: {
              title:      { required: "Please provide a Title" },
              content:    { required: "Please provide a Content" },
              idcategory: { required: "Please provide a Category" }
            },
            submitHandler: function(form) {
              $('.overlay').show();
              var Title         = $("#title").val();
              var Content       = tinyMCE.get('content').getContent();
              var Slug          = $("#slug").val();
              var Category      = $("#category").val();
              var Image         = $("#image").val();
              var Thumbnail     = $("#thumbnail").val();
              var Thumbnailtext = $("#thumbnailtext").val();

              var pictureCounter= $("#picture-counter").val();

              var arrPicture    = [];
              var arrGroup      = [];

              for(var i = 1; i <= pictureCounter; i++){
                  var getpicture = $("#picture-"+i).val();
                  //var getgroup = $("#picture-group-"+i).val();

                  arrPicture.push(getpicture);
                  //arrGroup.push(getgroup);
              }

              if ($('input#publish').is(':checked')) {
                var Publish   = 1; 
              }else{
                var Publish   = 0; 
              }

              var Store     = $("#store").val();
              var modal     = $("#successModal");

              $.post("<?php echo site_url('add-post');?>",
                {pictureCounter:pictureCounter,arrPicture:arrPicture,title:Title,content:Content,slug:Slug,category:Category,image:Image,thumbnail:Thumbnail,publish:Publish,store:Store,thumbnailtext:Thumbnailtext},
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
          /* --- add articlepost --- */
          <?php break;
              case 'add-doctor':
          ?>
          /* --- add doctor --- */
            rules: {
              name:{ required: true },
            },
            messages: {
              name:{ required: "Please provide a Doctor Name" },
            },
            submitHandler: function(form) {
              $(".overlay").show();
              form.submit(); 
            }          
          /* --- add doctor --- */
          <?php break;
              case 'admin-highlight':
          ?>
          /* --- add highlight --- */
            rules: {
              highlight_title: { required: true },
              highlight_menu: { required: true }
            },
            messages: {
              highlight_title: {
                required: "Please provide a Highlight Title"
              },
              highlight_menu: {
                required: "Please provide a Menu"
              }
            },
            submitHandler: function(form) {
              $('.overlay').show();
              var highlight_title   = $("#highlight_title").val();    
              var highlight_menu    = $("#highlight_menu").val();    
              var modal             = $("#successModal");

              if ($('input#highlight_status').is(':checked')) {
                var highlight_status   = 1; 
              }else{
                var highlight_status   = 0; 
              }

              $.post("<?php echo site_url('add-highlight');?>",
                {highlight_title:highlight_title, highlight_menu:highlight_menu,highlight_status:highlight_status},
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
          /* --- add highlight --- */
          <?php break;
              case 'admin':
          ?>
          /* --- add dashboard --- */
          /* --- add dashboard --- */

          /* --- auto generated add --- */

					/* --- end auto generated add --- */
          <?php break;
              default: break;
            }
          ?>
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
          errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
              $(placement).append(error)
            } else {
              error.insertAfter(element);
            }
          },
          <?php 
            $url  = $this->uri->segment(1);
            $exurl= explode('-', $url);
            if(count($exurl) > 2){
              $param = $exurl[2];
            }else{
              $param = '';
            }
            switch($url){ 
              case 'group-menu': 
          ?>
          /* --- edit groupmenu --- */
            rules: {
              vgroupName: { required: true },
              'cb_read[]': { required: true }
            },
            messages: {
              vgroupName: { required: "Please provide a Group Name" },
              'cb_read[]': { required: "Please Choose Menu List" }
            },
            submitHandler: function(form) {
              $('.overlay').show();
              var url    = $("#url").val();
              var id     = $("#idGroup").val();
              var Name   = $("#vgroupName").val();
              var modal  = $("#successModal");
              var vread  = [];
              var vmenu  = [];
              var vedit  = [];
              var vdelete = [];

              $('.chkread:checked').each(function(i){
                vread[i] = $(this).val();
              });

              $('.chkmenu:checked').each(function(i){
                vmenu[i] = $(this).val();
              });

              $('.chkedit:checked').each(function(i){
                vedit[i] = $(this).val();
              });

              $('.chkdelete:checked').each(function(i){
                vdelete[i] = $(this).val();
              });

              $.post(url,
                {id:id,name:Name,menu:vmenu,read:vread,edit:vedit,delete:vdelete},
                function(data){
                  $('.overlay').hide();
                  $("#mView").modal('hide');
                  $('#successModal').modal({backdrop: 'static', keyboard: false})
                  if(data == 'Success'){
                    modal.find('.modal-body').text('Data Updated..');
                  }else{
                    modal.find('.modal-body').text('Update Failed..');
                  }
                }   
              );
            }
          /* --- edit groupmenu --- */
          <?php break;
              case 'menu':
          ?>
          /* --- edit menu --- */
            rules: {
              vname: { required: true, noSpace: true,
                remote : {
                      url: "<?php echo base_url('admin/menu/checkValue/vname');?>",
                      type: "post",
                      data: {
                        bakname: function() {
                          return $( "#bakname" ).val();
                        }
                      }
                }
              },
            },
            messages: {
              vname: {
                required: "Please provide a Name",
                remote: "Menu Already Exist",
                notEqual: ""
              },
            },
            submitHandler: function(form) {
              $('.overlay').show();
              var Status;
              var Staturl;
              var Id        = $("#vidmenu").val();
              var Name      = $("#vname").val();
              var Link      = '';//$("#link").val();
              var Url       ;//= $("#url").val();
              var Position  = $('input[name=vposition]:checked', '#mView').val();
              var Icon      = '';

              if ($('input[name=vstatus]').is(':checked')) {
                Status = '1';
              }else{
                Status = '0';
              }

              if ($('input[name=vstaturl]').is(':checked')) {
                Staturl = '1';
              }else{
                Staturl = '0';
              }

              if(Position == '1'){
                var Parent  = $('#vindexparent').val();
                var Menu    = '0';
                var Submenu = '0';
                Staturl     = '0';
              }else if(Position == '2'){
                var Parent  = $('.op2 #vparent').val();
                var Menu    = $('.op2 #vindexmenu').val();
                var Submenu = '0';
                var Icon    = $('.op2 #vicon').val();
              }else{
                var Parent  = $('.op3 #vparent').val();
                var Menu    = $('#vmenu').val();
                var Submenu = $('#vindexsubmenu').val();
                Staturl     = '1';
              }

              var modal     = $("#successModal");

              //alert('name:'+Name+'~link:'+Link+'~url:'+Url+'~status:'+Status+'~parent:'+Parent+'~menu:'+Menu+'~submenu:'+Submenu+'~icon:'+Icon+'~staturl:'+Staturl+'~id:'+Id);

              $.post("<?php echo site_url('edit-menu');?>",
                {name:Name,link:Link,url:Url,status:Status,parent:Parent,menu:Menu,submenu:Submenu,icon:Icon,staturl:Staturl,id:Id},
                function(data){
                  $('.overlay').hide();
                  $("#mAdd").modal('hide');
                  $('#successModal').modal({backdrop: 'static', keyboard: false})
                  if(data == 'Success'){
                    modal.find('.modal-body').text('Data Saved..');
                  }else{
                    modal.find('.modal-body').text(data);
                  }
                }   
              ); 
            }
          /* --- edit menu --- */
          <?php break;
              case 'edit-post-'.$param:
          ?>
          /* --- edit articlepost --- */
            rules: {
              id:         { required: true },
              title:      { required: true },
              idcategory: { required: true },
              content:    { required: true }
            },
            messages: {
              id:         { required: "No ID" },
              title:      { required: "Please provide a Title" },
              idcategory: { required: "Please provide a Category" },
              content:    { required: "Please provide a Content" }
            },
            submitHandler: function(form) {
              $('.overlay').show();
              var Id            = $("#id").val();
              var Title         = $("#title").val();
              var Content       = tinyMCE.get('content').getContent();
              var Slug          = $("#slug").val();
              var Category      = $("#category").val();
              var Image         = $("#image").val();
              var Thumbnail     = $("#thumbnail").val();
              var Thumbnailtext = $("#thumbnailtext").val();

              var pictureCounter= $("#picture-counter").val();

              var arrPicture    = [];
              var arrGroup      = [];

              for(var i = 1; i <= pictureCounter; i++){
                  var getpicture = $("#picture-"+i).val();
                  //var getgroup = $("#picture-group-"+i).val();

                  arrPicture.push(getpicture);
                  //arrGroup.push(getgroup);
              }

              if ($('input#publish').is(':checked')) {
                var Publish   = 1; 
              }else{
                var Publish   = 0; 
              }

              var Store     = $("#store").val();
              var modal     = $("#successModal");

              $.post("<?php echo site_url('edit-post');?>",
                {pictureCounter:pictureCounter,arrPicture:arrPicture,id:Id,title:Title,content:Content,slug:Slug,category:Category,image:Image,thumbnail:Thumbnail,publish:Publish,store:Store,thumbnailtext:Thumbnailtext},
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
          /* --- edit articlepost --- */
          <?php break;
              case 'edit-doctor-'.$param:
          ?>
          /* --- edit doctor --- */
            rules: {
              name:{ required: true },
            },
            messages: {
              name:{ required: "Please provide a Doctor Name" },
            },
            submitHandler: function(form) {
              $(".overlay").show();
              form.submit(); 
            }          
          /* --- add doctor --- */
          <?php break;
              case 'admin-highlight':
          ?>
          /* --- edit highlight --- */
            rules: {
              vhighlight_title: { required: true },
              vhighlight_menu: { required: true }
            },
            messages: {
              vhighlight_title: {
                required: "Please provide a Hoghlight Title"
              },
              vhighlight_menu: {
                required: "Please provide a Menu"
              }
            },
            submitHandler: function(form) {
              $('.overlay').show();
              var highlight_id      = $("#vhighlight_id").val();    
              var highlight_title   = $("#vhighlight_title").val();    
              var highlight_menu    = $("#vhighlight_menu").val();    
              var modal             = $("#successModal");

              $.post("<?php echo site_url('edit-highlight');?>",
                {highlight_id:highlight_id, highlight_title:highlight_title, highlight_menu:highlight_menu},
                function(data){
                  $('.overlay').hide();
                  $("#mView").modal('hide');
                  $('#successModal').modal({backdrop: 'static', keyboard: false})
                  if(data == 'Success'){
                    modal.find('.modal-body').text('Data Saved..');
                  }else{
                    modal.find('.modal-body').text('Failed Save Data..');
                  }
                }   
              );

            }            
          /* --- edit highlight --- */
          <?php break;
              case 'admin':
          ?>
          /* --- edit dashboard --- */
          /* --- edit dashboard --- */

          /* --- auto generated view --- */

					/* --- end auto generated view --- */

          <?php break;
              default: break;
            }
          ?>
      });

      $('#mExport').on('shown.bs.modal', function (e) {
        $(".overlay").show();
        var class_ = '<?php echo $this->uri->segment(1);?>';

        if(class_ == 'admin-patient'){
          var url = '<?php echo base_url()?>'+'admin-patient-loadfilter';
        }

        $.post(
                url,
                {id:''},
                function(data){
                  $("#mExport .modal-body").html(data);
            
                  $('.multiple-dropx').multiselect({
                      //includeSelectAllOption: true,
                      allSelectedText: 'No option left ...',
                      numberDisplayed: 1,
                      onChange: function(element, checked) {
                        var selattr = $(element).parent().attr('id');

                        var dropdown   = $('.multiple-dropx');
                        var dropdownval = [];
                        $(dropdown).each(function(index, dropdown){
                            dropdownval.push([$(this).val()]);
                        });
                        $("#val"+selattr).val(dropdownval);
                      }
                  });

                  $(".overlay").hide();
                }
        );
      })

      <?php if(isset($role['menuread']) OR isset($role['menuedit']) OR isset($role['menudelete'])){ ?>
        <?php if($role['menuedit'] != '1' OR $role['menudelete'] != '1'){ ?>
          $('.toolbar-action').hide();
        <?php } ?>        
      <?php } ?>
  });
</script>