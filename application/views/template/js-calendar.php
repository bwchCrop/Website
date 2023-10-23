<script src="<?php echo base_url('assets/js/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/fullcalendar.min.js'); ?>"></script>
<script>
	jQuery(document).ready(function() {      
		$('.overlay').hide(); 

		var zone = "05:30";  //Change this to your timezone

		$.ajax({
			url: "<?php echo base_url('admin-calendar'); ?>",
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
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			droppable: true, 
			slotDuration: '00:30:00',
			eventReceive: function(event){
				$('.overlay').show();
				var title = event.title;
				var start = event.start.format("YYYY-MM-DD[T]HH:mm:SS");
				var backgroundColor = hexc(event.backgroundColor);
				var borderColor = hexc(event.borderColor);
				$.ajax({
		    		url: "<?php echo base_url('admin-calendar'); ?>",
		    		data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone+'&backcolor='+backgroundColor+'&bordercolor='+borderColor,
		    		type: 'POST',
		    		dataType: 'json',
		    		success: function(response){
						$('.overlay').hide();
		    			event.id = response.eventid;
		    			$('#calendar').fullCalendar('updateEvent',event);
		    		},
		    		error: function(e){
		    			console.log(e.responseText);

		    		}
		    	});
				$('#calendar').fullCalendar('updateEvent',event);
				console.log(event);
			},
			eventDrop: function(event, delta, revertFunc) {
				$('.overlay').show();
		        var title = event.title;
		        var start = event.start.format();
		        var end = (event.end == null) ? start : event.end.format();
		        $.ajax({
					url: "<?php echo base_url('admin-calendar'); ?>",
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
		          var title = prompt('Event Title:', event.title, { buttons: { Ok: true, Cancel: false} });
		          if (title){
					  $('.overlay').show();
		              event.title = title;
		              console.log('type=changetitle&title='+title+'&eventid='+event.id);
		              $.ajax({
				    		url: "<?php echo base_url('admin-calendar'); ?>",
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
			},
			eventResize: function(event, delta, revertFunc) {
				$('.overlay').show();
				console.log(event);
				var title = event.title;
				var end = event.end.format();
				var start = event.start.format();
		        $.ajax({
					url: "<?php echo base_url('admin-calendar'); ?>",
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
				    		url: "<?php echo base_url('admin-calendar'); ?>",
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
				url: "<?php echo base_url('admin-calendar'); ?>",
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
    });
</script>