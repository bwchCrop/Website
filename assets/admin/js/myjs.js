function start_icheck(){
	/* ===  iCheck for checkbox and radio inputs  === */  
    var triggeredByChild = false;

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });

    $('#chkall').on('ifChecked', function (event) {
        $('.chkmenu').iCheck('check');
        triggeredByChild = false;
    });

    $('#chkall').on('ifUnchecked', function (event) {
        if (!triggeredByChild) {
            $('.chkmenu').iCheck('uncheck');
        }
        triggeredByChild = false;
    });

    $('.chkmenu').on('ifUnchecked', function (event) {
        triggeredByChild = true;
        $('#chkall').iCheck('uncheck');
    });

    $('.chkmenu').on('ifChecked', function (event) {
        if ($('.chkmenu').filter(':checked').length == $('.chkmenu').length) {
            $('#chkall').iCheck('check');
        }
    });

    $('.chkchoose').on('ifUnchecked', function (event) {
        triggeredByChild = true;
        $('#chkall').iCheck('uncheck');
    });

    $('.chkchoose').on('ifChecked', function (event) {
        if ($('.chkchoose').filter(':checked').length == $('.chkchoose').length) {
            $('#chkall').iCheck('check');
        }
    });
}

function privilege_icheck(check,privilege,num){
	if(check == 'checked'){
		switch(privilege) {
		    case 'menu':
			        $('.chkread').eq(num).iCheck('check');
			        $('.chkedit').eq(num).iCheck('check');
			        $('.chkdelete').eq(num).iCheck('check');

			        $('#mView .chkread').eq(num).iCheck('check');
			        $('#mView .chkedit').eq(num).iCheck('check');
			        $('#mView .chkdelete').eq(num).iCheck('check');
		        break;
		    case 'edit':
		        $('.chkread').eq(num).iCheck('check');

		        $('#mView .chkread').eq(num).iCheck('check');
		        break;
		    case 'delete':
		        $('.chkread').eq(num).iCheck('check');

		        $('#mView .chkread').eq(num).iCheck('check');
		        break;
		}		
	}else{
		switch(privilege) {
		    case 'read':
		        $('.chkmenu').eq(num).iCheck('uncheck');
		        $('.chkedit').eq(num).iCheck('uncheck');
		        $('.chkdelete').eq(num).iCheck('uncheck');

		        $('#mView .chkmenu').eq(num).iCheck('uncheck');
		        $('#mView .chkedit').eq(num).iCheck('uncheck');
		        $('#mView .chkdelete').eq(num).iCheck('uncheck');
		        break;
		    case 'edit':
		    	if($('.chkdelete').prop(':checked') == false){
		        	$('.chkread').eq(num).iCheck('uncheck');
		    	}
		    	$('.chkmenu').eq(num).iCheck('uncheck');

		    	if($('#mView .chkdelete').prop(':checked') == false){
		        	$('#mView .chkread').eq(num).iCheck('uncheck');
		    	}
		    	$('#mView .chkmenu').eq(num).iCheck('uncheck');
		        break;
		    case 'delete':
		    	if($('.chkedit').prop(':checked') == false){
		        	$('.chkread').eq(num).iCheck('uncheck');
		        }
		        $('.chkmenu').eq(num).iCheck('uncheck');

		    	if($('#mView .chkedit').prop(':checked') == false){
		        	$('#mView .chkread').eq(num).iCheck('uncheck');
		        }
		        $('#mView .chkmenu').eq(num).iCheck('uncheck');
		        break;
		}	
	}
}

function view_list(id,url){
    $('.overlay').show();
    var modal  	= $("#mView");

    $.post(url,
      	{id:id,type:'view'},
      	function(data){
	        $('.overlay').hide();
	        $("#editBtn").hide();
	        if(data != ''){
	          $("#mView").modal('show');
	          modal.find('.modal-body').html(data);
	          $('.overlay').hide();
	        }else{
	          $("#successModal").modal('show');
	          modal.find('.modal-body').text('No Data..');
 			  $('.overlay').hide();
	        }
      	}   
    );	
}

function edit_list(id,url1,url2){
    $('.overlay').show();
    var modal  = $("#mView");

    $.post(url1,
        {url:url2,id:id,type:'edit'},
        function(data){
          $('.overlay').hide();
          if(data != ''){
            $("#mView").modal('show');
            $("#editBtn").show();
            modal.find('.modal-body').html(data);
          }else{
            $("#mView").modal('show');
            modal.find('.modal-body').text('No Data..');
          }
        }   
    );
}

function delete_list(id,url){
    var res   = id.split("-");	

    $("#deleteModal").modal('show');
    $("#id").val(id);
    $("#url").val(url);

    if(res.length > 1){
	    var resID = res[0];
	    var resMN = res[1];
	    var resRL = res[2];

	    if(resRL == 'reset'){
    		$("#role").val(resRL);
    		$("#deleteModal").find('.textForm').text('Reset Menu '+resMN+' ?');
	    }else{
    		$("#role").val('delete');
    		$("#deleteModal").find('.textForm').text('Delete Menu '+resMN+' ?');
    	}
    }
}

function delete_confirmation(){
    $(".overlay").show();
    var xmessage;
    var id    = $("#id").val();
    var url   = $("#url").val();
    var role   = $("#role").val();
    var modal = $("#successModal");

    if(role == 'reset'){
    	xmessage = 'Reset Menu Successfully!';
    }else{
    	xmessage = 'Data Deleted..';
    }

  	$.post(url,
      	{id:id},
      	function(data){
	        $(".overlay").hide();
	        
	        if(data == 'Success'){
	          	$("#deleteModal").modal('hide');
	          	$('#successModal').modal({backdrop: 'static', keyboard: false})
	          	modal.find('.modal-body').text(xmessage);
	        }else{
	          	$("#deleteModal").modal('hide');
	          	$('#successModal').modal({backdrop: 'static', keyboard: false})
	          	modal.find('.modal-body').text('Failed.. ('+data+')');
	        }
      	}   
  	);
}

function close_message(url){
	$(".overlay").show();
    $("#successModal").modal('hide');
    window.location.replace(url);  
}

function create_slug(slug){
	slug = slug.toLowerCase();
	slug = slug.replace(/[&[\/\\#,+()$~@^=`_;|%.'":*!?<>{}\]]/g, '');
	slug = slug.split(' ').join('-');
	return slug;
}

function time_picker(disabledDays){
	if (typeof(disabledDays)==='undefined') disabledDays = [];

	$('.date-picker').bootstrapMaterialDatePicker({
		time: false,
		clearButton: true,
		disabledDays: disabledDays,
	});

	$('.time-picker').bootstrapMaterialDatePicker({
		date: false,
		shortTime: false,
		format: 'HH:mm',
	});

	$('.time-picker.start').bootstrapMaterialDatePicker('setDate', '08:00');
	$('.time-picker.end').bootstrapMaterialDatePicker('setDate', '21:00');

	$('.date-format-picker').bootstrapMaterialDatePicker({
		format: 'dddd DD MMMM YYYY - HH:mm'
	});

	$('.date-fr-picker').bootstrapMaterialDatePicker({
		format: 'DD/MM/YYYY HH:mm',
		lang: 'fr',
		weekStart: 1, 
		cancelText : 'ANNULER',
		nowButton : true,
		switchOnClick : true
	});

	$('.date-end-picker').bootstrapMaterialDatePicker({
		weekStart: 0, format: 'DD/MM/YYYY HH:mm'
	});
	$('.date-start-picker').bootstrapMaterialDatePicker({
		weekStart: 0, format: 'DD/MM/YYYY HH:mm', shortTime : true
	}).on('change', function(e, date){
		$('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
	});

	$('.min-date-picker').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });

	$.material.init()
}

jQuery(document).ready(function() {      
	$('.overlay').hide(); 
    $('#message').fadeOut(3500); 
    $(".my-colorpicker1").colorpicker();
    $(".my-colorpicker2").colorpicker();

    var x_timer;  
	var pathArray	= location.href.split( '/' );
	var protocol 	= pathArray[0];
	var host 		= pathArray[2];

	var base_url = protocol + '//' + host + '/'; // live
    // var base_url = base_url + "revamp/"; // localhost

    start_icheck();

 	$("#test-load").click(function(){
		var i;
		for (i = 0; i <= 10000; ++i) {
		   var x = i / 100;
		   $('#persen').val(x+'%');
		   $('.cek-progress').css('width', x+'%');
		}
	});

	/* -- MULTIPLE DROPDOWN -- */
        $('.multiple-drop').multiselect({
        	//includeSelectAllOption: true,
            allSelectedText: 'No option left ...',
            numberDisplayed: 1,
		    onChange: function(element, checked) {
		        var sel1   = $('.multiple-drop#speciality option:selected');
		        var speciality = [];
		        $(sel1).each(function(index, sel1){
		            speciality.push([$(this).val()]);
		        });
		        $("#valSpeciality").val(speciality);

		        var sel2   = $('.multiple-drop#location option:selected');
		        var location = [];
		        $(sel2).each(function(index, sel2){
		            location.push([$(this).val()]);
		        });
		        $("#valLocation").val(location);

		        var sel3   = $('.multiple-drop#branch option:selected');
		        var branch = [];
		        $(sel3).each(function(index, sel3){
		            branch.push([$(this).val()]);
		        });
		        $("#valBranch").val(branch);

		        var sel4   = $('.multiple-drop#day option:selected');
		        var day = [];
		        $(sel4).each(function(index, sel4){
		            day.push([$(this).val()]);
		        });
		        $("#valDay").val(day);

		        var sel5   = $('.multiple-drop#time option:selected');
		        var time = [];
		        $(sel5).each(function(index, sel5){
		            time.push([$(this).val()]);
		        });
		        $("#valTime").val(time);
		    }
        });
	/* -- MULTIPLE DROPDOWN -- */

 	/* -- DATATABLE -- */
	    $("#example0").DataTable({
	    	"paging": false,
	    	"searching": false,
	    	"ordering": false,
	    	"info": false,
	      	"lengthChange": false,
	    });

	    $("#example1").DataTable();
	    
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
	    });

	    $('#example3').DataTable({
	        "dom": '<"toolbar-action">lfrtip',
	        initComplete: function(){
	            $("div.toolbar-action").html('<div class="dropdown"><button class="form-control input-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action &nbsp;<span class="caret"></span></button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1"><li><a href="#" class="action-checkbox" role="publish"><i class="fa fa-check"></i>Publish</a></li><li><a href="#" class="action-checkbox" role="unpublish"><i class="fa fa-times"></i> Unpublish</a></li><li><a href="#" class="action-checkbox" role="delete"><i class="fa fa-trash"></i> Delete</a></li><li role="separator" class="divider"></li><li><a href="javascript:void(0);"><i class="fa fa-reply"></i> Cancel</a></li></ul></div>');           
	        },
	        fnDrawCallback: function( oSettings ){
		        start_icheck();	        
		    }  
	    });

	    $('#example4').DataTable({
	    	"scrollY":        "40vh",
	        "scrollCollapse": true,
	        "paging":         false,
	        "dom": '<"toolbar-action">lfrtip',
	        initComplete: function(){
	            $("div.toolbar-action").html('<div class="dropdown"><button class="form-control input-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action &nbsp;<span class="caret"></span></button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1"><li><a href="#" class="action-checkbox" role="publish">Publish</a></li><li><a href="#" class="action-checkbox" role="unpublish">Unpublish</a></li><li><a href="#" class="action-checkbox" role="delete">Delete</a></li><li role="separator" class="divider"></li><li><a href="javascript:void(0);">Cancel</a></li></ul></div>');           
	        },
	        fnDrawCallback: function( oSettings ){
		        start_icheck();				        
		    } 
	    });

	    $('#example5').DataTable({
	        "dom": '<"toolbar-action">lfrtip',
	        initComplete: function(){
	            $("div.toolbar-action").html('<div class="dropdown"><button class="form-control input-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action &nbsp;<span class="caret"></span></button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1"><li><a href="#" class="action-checkbox" role="delete"><i class="fa fa-trash"></i> Delete</a></li><li role="separator" class="divider"></li><li><a href="javascript:void(0);"><i class="fa fa-reply"></i> Cancel</a></li></ul></div>');           
	        },
	        fnDrawCallback: function( oSettings ){
		        start_icheck();	        
		    }  
	    });

	    $('#example6').DataTable({
	        "dom": '<"toolbar-action">lfrtip',
	        initComplete: function(){
	            $("div.toolbar-action").html('<button class="btn btn-flat bg-green export-excel" style="padding:4px 12px;"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp;Export .xlsx</button>');           
	        },
	        fnDrawCallback: function( oSettings ){
		        start_icheck();	        
		    }  
	    });

	    $('#example7').DataTable({
	        "dom": '<"toolbar-action">lfrtip',
	        initComplete: function(){
	            $("div.toolbar-action").html('<div class="dropdown"><button class="form-control input-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action &nbsp;<span class="caret"></span></button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1"><li><a href="#" class="action-checkbox" role="delete"><i class="fa fa-trash"></i> Delete</a></li><li role="separator" class="divider"></li><li><a href="javascript:void(0);"><i class="fa fa-reply"></i> Cancel</a></li></ul></div><button class="btn btn-flat bg-green export-excel" style="padding:4px 12px; margin-left:10px;"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp;Export .xlsx</button>');           
	        },
	        fnDrawCallback: function( oSettings ){
		        start_icheck();	        
		    }  
	    });

	    $(".action-checkbox").click(function(){
	    	$('.overlay').show();
	    	var role = $(this).attr("role");
	        var modal  = $("#successModal");
	        var url = $(".chkall").attr('chkurl');
	    	var val = [];
	    	var nil = 0;
	    	$('.chkmenu:checked').each(function(i){
	    		val[i] = $(this).val();
	    		nil++;
	    	});

	    	if(nil == 0){
	    		$('#successModal').modal('show');
	    		modal.find('.modal-body').text('No Data Selected');
	    	}else{
	    		var answer = confirm("Are you sure "+role+" multiple data ? ");
				if(answer) {
		    		$.post(url,
		    			{role:role,id:val},
		    			function(data){
		    				$('#successModal').modal({backdrop: 'static', keyboard: false})
		    				if(data == 'Success'){
		    					if(role == 'delete'){
		    						modal.find('.modal-body').text('Data Deleted..');
		    					}else{
		    						modal.find('.modal-body').text('Data Updated..');
		    					}
		    				}else{
		    					modal.find('.modal-body').text('Failed');
		    				}
		    			}   
		    		);
	    		}else{
	    			$('.overlay').hide();
	    		}
	        }

			modal.on('hidden.bs.modal', function (e) {
			    $('.overlay').hide();
			    $('.chkall').iCheck("uncheck");
			    $('.chkmenu').iCheck("uncheck");
			})
	    });

		$(".chkall").click(function () {
		
		    $('input:checkbox').not(this).prop('checked', this.checked);
		});
	/* -- DATATABLE -- */

	/* -- MANAGER -- */
		$('.iframe-btn').fancybox({
	        'autoSize'		: false,
	        'autoDimensions': false,
	        'width'			: 880,
			'height'		: 1000,
			'type'			: 'iframe',
			'autoScale'  	: false,
			'filemanager_title'	: 'File Manager',
		});
		
		tinymce.init({
			selector		: 'textarea.tinymce',
			height			: "160",
			theme			: 'modern',
			relative_urls	: false,
			remove_script_host : false,
			external_filemanager_path 	: 'assets/plugins/filemanager/', 
			external_plugins			: { 'filemanager' : '../../../assets/plugins/tinymce/plugins/responsivefilemanager/plugin.min.js' }, 
			filemanager_title			: 'File Manager', 
			filemanager_access_key		:"kamargelap11" ,
			plugins: [
				'advlist autolink lists link image charmap print preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen',
				'insertdatetime media nonbreaking save table contextmenu directionality',
				'emoticons template paste textcolor colorpicker textpattern responsivefilemanager'
			],
			toolbar1		: 'insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link responsivefilemanager | forecolor backcolor',
			image_advtab	: true,
			templates: [
				{title: 'Test template 1', content: 'Test 1'},
				{title: 'Test template 2', content: 'Test 2'}
			],
		   	setup : function(ed){
				var ctrlDown = false,
			    	ctrlKey  = 17,
			    	cmdKey   = 91,
			    	spaceKey = 32;

		   		ed.on('keydown', function(e) {
			        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
		   		}).on('keyup', function(e) {
			        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = false;
			    });

				ed.on('keydown', function(e) {
					var keyCode = e.keyCode || e.which; 
					var val 	= ed.getContent();
				    val 		= val.toLowerCase();
				    val 		= val.replace('&nbsp;','');
				    val 		= val.replace(' ','');

				 	if(ctrlDown && e.keyCode == spaceKey){
				 		if( '<p>lorem</p>' == val ){
						 	ed.setContent('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'); // inserts tab
						 	e.preventDefault();
					 		return false;
				 		}else{
						 	ed.execCommand( 'mceInsertContent', false, '&nbsp;' );
					 		return false;
				 		}
				 	}
			 	});
	        }
		});
	/* -- MANAGER -- */

	/* --- Timepicker --- */
		var weekday = $('#weekday').val();

		time_picker(weekday);
	/* --- Timepicker --- */

	/* --- Calendar --- */
		var zone = '';//"05:30";  //Change this to your timezone

		$.ajax({
			url: base_url+"admin-calendar",
	        type: 'POST', 
	        data: 'type=fetch',
	        async: false,
	        success: function(s){
	        	json_events = s;
	        }
		});

		var currentMousePos = {
		    x: -1,
		    y: -1
		};
		
		jQuery(document).on("mousemove", function (event) {
	        currentMousePos.x = event.pageX;
	        currentMousePos.y = event.pageY;
	    });

	    function ini_events(ele) {
	      	ele.each(function () {
			//$('#external-events .external-event').each(function() {
				$(this).data('event', {
					title: $.trim($(this).text()), 
					backgroundColor: $(this).css("background-color"),
					borderColor: $(this).css("border-color"),
					stick: true 
				});

				$(this).draggable({
					zIndex: 999,
					revert: true,      
					revertDuration: 0  
				});
			//});
	      	});
	    }	

	    ini_events($('#external-events .external-event'));

		$('#calendar').fullCalendar({
			events: JSON.parse(json_events),
			//events: [{"id":"14","title":"New Event","start":"2016-11-24T16:00:00+04:00","allDay":false}],
			utc: true,
			height: 450,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			droppable: true, 
			//slotDuration: '00:30:00',
			eventReceive: function(event){
				$('.overlay').show();
				var title = event.title;
				var start = event.start.format("YYYY-MM-DD[T]HH:mm:SS");
				var backgroundColor = hexc(event.backgroundColor);
				var borderColor = hexc(event.borderColor);
				var starttime = event.start.format("HH:mm:SS");
				var endtime = event.end;
				var all_day = '';

				if(starttime == "00:00:00" && endtime == null){
					all_day = 'true';
				}else{
					all_day = 'false';
				}

		        if ($('#drop-remove').is(':checked')) {
					$(".external-event").filter(function () {
					    return $(this).text() == title;
					}).remove();		        	
		        }

				$.ajax({
		    		url: base_url+"admin-calendar",
		    		data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone+'&backcolor='+backgroundColor+'&bordercolor='+borderColor+'&all_day='+all_day,
		    		type: 'POST',
		    		dataType: 'json',
		    		success: function(response){
						$('.overlay').hide();
		    			event.id = response.eventid;
		    			$('#calendar').fullCalendar('updateEvent',event);
		    		},
		    		error: function(e){
		    			//console.log(e.responseText);
		    			window.location.replace(base_url);  
		    		}
		    	});
				$('#calendar').fullCalendar('updateEvent',event);

				//console.log(event);
			},
			eventDrop: function(event, delta, revertFunc) {
				$('.overlay').show();
		        var title = event.title;
		        var start = event.start.format();
		        var end = (event.end == null) ? start : event.end.format();
		        $.ajax({
					url: base_url+"admin-calendar",
					data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						$('.overlay').hide();
						if(response.status != 'success')		    				
						revertFunc();
					},
					error: function(e){		    			
						revertFunc();
						alert('Error processing your request: '+e.responseText);
					}
				});
		    },
		    eventClick: function(event, jsEvent, view) {
		    	console.log(event.id);

		        var str   = event.id;
		        var param = str.split("-");

		        console.log('11');
		        if(param.length > 1){
		        	window.location.href = base_url+"admin-transaction";
		        }else{
		          	var title = prompt('Event Title:', event.title, { buttons: { Ok: true, Cancel: false} });
		          	if (title){
					  	$('.overlay').show();
		              	event.title = title;
		              	console.log('type=changetitle&title='+title+'&eventid='+event.id);
		              	$.ajax({
				    		url: base_url+"admin-calendar",
				    		data: 'type=changetitle&title='+title+'&eventid='+event.id,
				    		type: 'POST',
				    		dataType: 'json',
				    		success: function(response){	
								$('.overlay').hide();
				    			if(response.status == 'success')			    			
		              				$('#calendar').fullCalendar('updateEvent',event);
				    		},
				    		error: function(e){
				    			alert('Error processing your request: '+e.responseText);
				    		}
				    	});
		          	}
		        }
			},
			eventResize: function(event, delta, revertFunc) {
				$('.overlay').show();
				console.log(event);
				var title = event.title;
				var end = event.end.format();
				var start = event.start.format();
		        $.ajax({
					url: base_url+"admin-calendar",
					data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						$('.overlay').hide();
						if(response.status != 'success')		    				
						revertFunc();
					},
					error: function(e){		    			
						revertFunc();
						alert('Error processing your request: '+e.responseText);
					}
				});
		    },
			eventDragStop: function (event, jsEvent, ui, view) {
			    if (isElemOverDiv()) {
			    	var con = confirm('Are you sure to delete this event permanently?');
			    	if(con == true) {
						$('.overlay').show();
						$.ajax({
				    		url: base_url+"admin-calendar",
				    		data: 'type=remove&eventid='+event.id,
				    		type: 'POST',
				    		dataType: 'json',
				    		success: function(response){
				    			console.log(response);
				    			if(response.status == 'success'){
									$('.overlay').hide();
				    				$('#calendar').fullCalendar('removeEvents');
            						getFreshEvents();
            					}
				    		},
				    		error: function(e){	
				    			alert('Error processing your request: '+e.responseText);
				    		}
			    		});
					}   
				}
			}
		});
	
		function getFreshEvents(){
			$.ajax({
				url: base_url+"admin-calendar",
		        type: 'POST',
		        data: 'type=fetch',
		        async: false,
		        success: function(s){
		        	freshevents = s;
		        }
			});
			$('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
		}

		function isElemOverDiv() {
	        var trashEl = jQuery('#trash');

	        var ofs = trashEl.offset();

	        var x1 = ofs.left;
	        var x2 = ofs.left + trashEl.outerWidth(true);
	        var y1 = ofs.top;
	        var y2 = ofs.top + trashEl.outerHeight(true);

	        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
	            currentMousePos.y >= y1 && currentMousePos.y <= y2) {
	            return true;
	        }
	        return false;
	    }

	    function hexc(colorval) {
		    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		    delete(parts[0]);
		    for (var i = 1; i <= 3; ++i) {
		        parts[i] = parseInt(parts[i]).toString(16);
		        if (parts[i].length == 1) parts[i] = '0' + parts[i];
		    }
		    //backgroundColor = '#' + parts.join('');
		    return '#' + parts.join('');
		}

	    /* ADDING EVENTS */
	    var currColor = "#3c8dbc"; //Red by default
	    var colorChooser = $("#color-chooser-btn");

	    $("#color-chooser > li > a").click(function (e) {
	      	e.preventDefault();
	      	currColor = $(this).css("color");
	      	$('#add-new-event').css({"background-color": currColor, "border-color": currColor});
	    });

	    $("#add-new-event").click(function (e) {
	      	e.preventDefault();
	      	var val = $("#new-event").val();
	      	if (val.length == 0) {
	        	return;
	      	}

	      	var event = $("<div />");
	      	event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
	      	event.html(val);
	      	$('#external-events').prepend(event);

	      	ini_events(event);

	      	$("#new-event").val("");
	    });		
	/* --- Calendar --- */

  	/* --- menu --- */

      	$(".connectedSortable").sortable({
        	placeholder: "sort-highlight",
	        connectWith: ".connectedSortable",
	        handle: ".box-header, .nav-tabs",
	        forcePlaceholderSize: true,
	        zIndex: 999999
      	});

      	$(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

      	$(".todo-list").sortable({
	        placeholder: "sort-highlight",
	        handle: ".handle",
	        forcePlaceholderSize: true,
	        zIndex: 999999,
      	});

      	$('.text-parent').click(function(){
	        var counter  = $(this).attr('counter');
	        var position = $('.todo-list-position.'+counter);

	        if(position.css('display') == 'none'){
	            $('.todo-list-position').css('display','none');
	            position.css('display','block');
	        }else{
	            $('.todo-list-position').css('display','none');
	            position.css('display','none');
	        }
      	});

      	$('.text-position').click(function(){
	        var counter  = $(this).attr('counter');
	        var sort = $('.todo-list-sort.'+counter);

	        if(sort.css('display') == 'none'){
	            $('.todo-list-sort').css('display','none');
	            sort.css('display','block');
	        }else{
	            $('.todo-list-sort').css('display','none');
	            sort.css('display','none');
	        }
      	});
  	/* --- menu --- */

  	/* --- product --- */
	  $('#prdcategory').change(function(){ 
	      $('#itemcategory').attr('disabled','disabled');
	      $('#subcategory1').attr('disabled','disabled');
	      var id = $(this).val(); 
	      $.post(base_url+'admin/product/load_maincat', {id:id}, function(data){
	          $('#subcategory1').html(data);
	          $('#subcategory1').removeAttr('disabled');
	          var idsub = $('#subcategory1').val();

		      $.post(base_url+'admin/product/load_subcat', {id1:id,id2:idsub}, function(data){
		          $('#itemcategory').html(data);
		          $('#itemcategory').removeAttr('disabled');
		      });
	      });
	  });

	  $('#subcategory1').change(function(){ 
	      $('#itemcategory').attr('disabled','disabled');
	      var id1 = $('#prdcategory').val(); 
	      var id2 = $(this).val(); 

	      $.post(base_url+'admin/product/load_subcat', {id1:id1,id2:id2}, function(data){
	          $('#itemcategory').html(data);
	          $('#itemcategory').removeAttr('disabled');
	      });
	  });
  	/* --- product --- */

  	/* --- auto lorem ipsum --- */
		var ctrlDown = false,
	    	ctrlKey  = 17,
	    	cmdKey   = 91,
	    	spaceKey = 32;

	    $(document).keydown(function(e) {
	        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
	    }).keyup(function(e) {
	        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = false;
	    });

		$(document).on('keydown', 'input[type=text],textarea', function(e) { 
		    var keyCode = e.keyCode || e.which; 
		    var val 	= $(this).val();
		    val 		= val.toLowerCase();
		    val 		= val.trim(' ');

	        if (ctrlDown && e.keyCode == spaceKey ){
		      e.preventDefault(); 

		      if(val == 'lorem'){
		        $(this).val('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
		      }else{
		      	$(this).val(val+' ');
		      }
		    } 
	  	});
  	/* --- auto lorem ipsum --- */

	$(document).on('keyup', 'input.toSlug', function(e) { 
		var text 		= $(this).val();
		var attr 		= $(this).attr('post');
		var slug 		= create_slug(text);

		var url_check 	= base_url+'admin/'+attr+'/check_slug';
	
	    $.post(url_check, {slug:slug}, function(data){
	    	if(data == 'OK'){
	    		slug = slug;
	    	}else{
	    		slug = data+'-'+slug;
	    	}
	    
			$(".slug").val(slug);
	    });
  	});

  	$(document).on('onchange', 'input.toSlug', function(e) { 
		var text 		= $(this).val();
		var url_check 	= base_url+'admin/post/check_slug';
	
	    $.post(url_check, {slug:text}, function(data){
	    	if(data == 'OK'){
	    		slug = slug;
	    	}else{
	    		slug = data+'-'+slug;
	    	}
	    
			$(".slug").val(slug);
	    });
  	});

	$(document).on('click', '.generate-thumbnail', function(e) { 
		var text = tinyMCE.get('content').getContent({ format: 'text' });
		var text = text.substring(0, 180);

		$("#thumbnailtext").val(text);
  	});

  	$(document).on('click', '.export-excel', function(e) {
  		var direct = $('#export-direct').val();

  		if(direct == '1'){
  			var url = $('#export-direct').attr('data-url');

  			window.location.href = url;
  		}else{
	  		$('#mExport').modal('show');
  		}
  	});

    $('.mAdd .store').hide(); 

    $('[data-toggle="popover"]').popover({
        html: true,
        content: function(){return '<img style="width:100%;" src="'+$(this).val() + '" />';}
    })   

    $('#category').change(function(){ 
    	$('.overlay').show();
        var id = $(this).val(); 
        var url= $(this).attr('site');
        if(id == '6'){
            $.post(url, {id:id}, function(data){
                $('.store').show();
                $('#store').html(data);
	            $(".overlay").hide();
            });
        }else{
            $('.store').hide();
            $(".overlay").hide();
        }
    });  

	$('.modal').on('show.bs.modal', function (e) {
	    $('.overlay').show();
	});

    $('.modal').on('shown.bs.modal', function (e) {
        var triggeredByChild = false;

    	$('.overlay').hide();
    
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({checkboxClass: 'icheckbox_minimal-blue',radioClass: 'iradio_minimal-blue'});
  
        // CHKALL
          $('.chkall').on('ifChecked', function (event) {
            $('.chkmenu').iCheck('check'); triggeredByChild = false;
          });

          $('.chkall').on('ifUnchecked', function (event) {
            if(!triggeredByChild){ $('.chkmenu').iCheck('uncheck');} triggeredByChild = false;
          });

          $('.chkmenu').on('ifUnchecked', function (event) {
          	var num = $(this).data('index');
            triggeredByChild = true; $('#chkall').iCheck('uncheck');
          	privilege_icheck('uncheck','menu', num);
          });

          $('.chkmenu').on('ifChecked', function (event) {
          	var num = $(this).data('index');
            if($('.chkmenu').filter(':checked').length == $('.chkmenu').length) {
              $('#chkall').iCheck('check');
            }
        	privilege_icheck('checked','menu', num);
          });

        // CHKREAD
          $('.chkreadall').on('ifChecked', function (event) {
            $('.chkread').iCheck('check'); triggeredByChild = false;
          });

          $('.chkreadall').on('ifUnchecked', function (event) {
            if(!triggeredByChild){ $('.chkread').iCheck('uncheck');} triggeredByChild = false;
          });

          $('.chkread').on('ifUnchecked', function (event) {
          	var num = $(this).data('index');
            triggeredByChild = true; $('#chkreadall').iCheck('uncheck');
          	privilege_icheck('uncheck','read', num);
          });

          $('.chkread').on('ifChecked', function (event) {
          	var num = $(this).data('index');
            if($('.chkread').filter(':checked').length == $('.chkread').length) {
              $('#chkreadall').iCheck('check');
            }
        	privilege_icheck('checked','read', num);
          });

        // CHKEDIT
          $('.chkeditall').on('ifChecked', function (event) {
            $('.chkedit').iCheck('check'); triggeredByChild = false;
          });

          $('.chkeditall').on('ifUnchecked', function (event) {
            if(!triggeredByChild){ $('.chkedit').iCheck('uncheck');} triggeredByChild = false;
          });

          $('.chkedit').on('ifUnchecked', function (event) {
          	var num = $(this).data('index');
            triggeredByChild = true; $('#chkeditall').iCheck('uncheck');
          	privilege_icheck('uncheck','edit', num);
          });

          $('.chkedit').on('ifChecked', function (event) {
          	var num = $(this).data('index');
            if($('.chkedit').filter(':checked').length == $('.chkedit').length) {
              $('#chkeditall').iCheck('check');
            }
        	privilege_icheck('checked','edit', num);
          });

        // CHKDELETE
          $('.chkdeleteall').on('ifChecked', function (event) {
            $('.chkdelete').iCheck('check'); triggeredByChild = false;
          });

          $('.chkdeleteall').on('ifUnchecked', function (event) {
            if(!triggeredByChild){ $('.chkdelete').iCheck('uncheck');} triggeredByChild = false;
          });

          $('.chkdelete').on('ifUnchecked', function (event) {
          	var num = $(this).data('index');
            triggeredByChild = true; $('#chkdeleteall').iCheck('uncheck');
          	privilege_icheck('uncheck','delete', num);
          });

          $('.chkdelete').on('ifChecked', function (event) {
          	var num = $(this).data('index');
            if($('.chkdelete').filter(':checked').length == $('.chkdelete').length) {
              $('#chkdeleteall').iCheck('check');
            }
        	privilege_icheck('checked','delete', num);
          });

    	/* --- menu --- */
    		if($('input[name=vposition]').is(':checked')){ 
			    var position = $('input[name=vposition]:checked').val();


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
    		}

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

		  	$(".op2 #parent, .op2 #vparent" ).change(function() {
		      	var id = $(this).val();
		      	if(id == ''){
		        	alert('Choose Parent !');
		        	$("#menu option").remove();
		        	$('#menu').attr('disabled','disabled')
		      	}else{
			        $('.overlay').show();
			        $("#menu option").remove();

			        $.post(base_url+'admin/menu/get_menu',
			            {id:id},
			            function(data){
		              		var data   = data.split('|'); 
		              		var data2  = data[1];
		              		$('.op2 #indexmenu').val(data2);
		              		$('.op3 #vindexmenu').val(data2);
		              		$('.overlay').hide();
		            	}   
		        	);
		      	}
		  	});

		  	$(".op3 #parent, .op3 #vparent" ).change(function() {
		      	var id = $(this).val();
		      	if(id == ''){
			        alert('Choose Parent !');
			        $(".menu option").remove();
			        $('.menu').attr('disabled','disabled')
		      	}else{
			        $('.overlay').show();
			        $(".menu option").remove();

			        $.post(base_url+'admin/menu/get_menu',
			            {id:id},
			            function(data){
			              	var data   = data.split('|'); 
			              	var data1  = data[0];
			              	var data2  = data[1];
			              	var result = data1.split(',');
			              	for (var i=0;i<result.length;i++){
			                	var resultdata = result[i];
			                	var data = resultdata.split('-');
			                	$('<option/>').val(data[0]).html(data[1]).appendTo('.menu');
			              	}
			              	//$('#indexmenu').val(data2);
			              	$('.menu').removeAttr('disabled')
			              	$('.overlay').hide();
			            }   
		        	);
		      	}
		  	});

		  	$(".op3 #menu, .op3 #vmenu").change(function(){
			    var id1 = $(this).parent().parent().find('.parent').val();//$('.op3 .parent').val();
			    var id2 = $(this).val();

		      	if(id == ''){
			        alert('Choose Menu !');
		      	}else{
			        $('.overlay').show();

			        $.post(base_url+'admin/menu/get_submenu',
			            {id1:id1,id2:id2},
			            function(data){
			              	$('.op3 #indexsubmenu').val(data);
			              	$('.op3 #vindexsubmenu').val(data);
			              	$('.overlay').hide();
			            }   
			        );
		      	}
		  	});
    })

    /*
	    $(".textchanged").keyup(function (e){
	        clearTimeout(x_timer);
	        var text = $(this).val();
	        var url  = $(this).attr('checkUrl');
	        x_timer = setTimeout(function(){ checkText(text,url); }, 1000);    	
	    }); 

	    function checkText(text,url){
	        $('.loadchanged').show();
	        $.post(url, {'text':text}, function(data) {
	        	if(data=='Success'){
	              	$('.loadchanged').hide();
	              	$("button[type=submit]").removeAttr('disabled');
	              	$(".textchanged").closest('.form-group').removeClass('has-error');
	        	}else{
	              	$('.loadchanged').hide();
	              	$("button[type=submit]").attr('disabled',true);
	              	$(".textchanged").closest('.form-group').addClass('has-error');
	            }
	        });
	    }
    */
});