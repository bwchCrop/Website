<section class="content-header">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Main Navigation</a></li>
            <li class="">Post</li>
            <li class="">Doctor</li>
            <li class="active">View/Edit</li>
        </ol>
    </div>
</section>

<form class="mView" action="<?php echo base_url('edit-doctor'); ?>" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-9">
            <div class="box bottom-margin">
                <div class="box-header">
                    <?php echo $this->session->flashdata('message');?>
                    <h3 class="box-title">&nbsp;
                        <a href="<?php echo base_url('admin-doctor'); ?>" class="btn btn-primary" id="add"><i class="fa fa-reply"></i></a>
                        &nbsp; doctor
                    </h3> 
                </div>
                <hr class="separator">      
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="form-control-label" >doctor Name</label>
                            <input type="hidden" name="iddoctor" id="iddoctor" class="form-control" value="<?php echo $result['iddoctor'];?>" />
                            <input type="text" name="name" id="name" class="form-control toSlug" value="<?php echo $result['name'];?>" post="doctor"/>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="form-control-label" >Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control slug"  value="<?php echo $result['slug'];?>"/>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description" class="form-control-label">Description</label>
                            <textarea class="tinymce" id="description" name="description"><?php echo set_value('content', $result['description']); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box bottom-margin collapsed-box">
                <div class="box-header">
                    <h3 class="box-title">&nbsp;
                        &nbsp;&nbsp;Description 2
                        <input type="hidden" name="dimension-counter" value="1" />                      
                    </h3> 
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <hr style="margin: 0;">      
                <div class="box-body">
                    <div class="col-md-12 field-dimension" style="margin-bottom: 15px;">
                        <div class="form-group">
                            <textarea class="tinymce" id="spesification" name="spesification"><?php echo set_value('content', $result['spesification']); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="box bottom-margin collapsed-box">
                <div class="box-header">
                    <h3 class="box-title">&nbsp;
                        &nbsp;&nbsp;Description 3
                        <input type="hidden" name="dimension-counter" value="1" />                      
                    </h3> 
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <hr style="margin: 0;">      
                <div class="box-body">
                    <div class="col-md-12 field-dimension" style="margin-bottom: 15px;">
                        <div class="form-group">
                            <textarea class="tinymce" id="care" name="care"><?php echo set_value('content', $result['care']); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box bottom-margin">
                <div class="box-header">
                    <h3 class="box-title">&nbsp;
                        &nbsp;&nbsp;
                        Schedule
                        <input type="hidden" name="schedule-counter" value="1" />
                    </h3> 
                </div>
                <hr class="separator">      
                <div class="box-body">
                    <div class="col-md-12 field-schedule">
                        <div class="form-group col-md-4 no-padding-l">
                            <label class="form-control-label">Hospital</label>
                            <select id="hospital" name="hospital" class="form-control">
                                <?php foreach($hospital as $row){ ?>
                                <option value="<?php echo $row['idhospital'].'|'.$row['namehospital'];?>"><?php echo $row['namehospital'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-control-label">Day</label>
                            <?php 
                                $day = array(
                                                '1' => 'Monday',
                                                '2' => 'Tuesday',
                                                '3' => 'Wednesday',
                                                '4' => 'Thursday',
                                                '5' => 'Friday',
                                                '6' => 'Saturday',
                                                '7' => 'Sunday',
                                             );
                            ?>
                            <select id="schedule_day" name="schedule_day" class="form-control">
                                <?php $n=0; foreach($day as $row){ $n++;?>
                                <option value="<?php echo $row;?>" idday="<?php echo $n;?>"><?php echo $row;?></option>
                                <?php } ?>
                            </select>                            
                        </div>

                        <div class="form-group col-md-2">
                            <label class="form-control-label">Start Time</label>
                            <div class="form-control-wrapper">
                                <input type="text" id="starttime" class="form-control time-picker start" placeholder="Start Time">
                            </div>
                        </div>
                        <div class="form-group col-md-2 no-padding-r">
                            <label class="form-control-label">End Time</label>
                            <div class="form-control-wrapper">
                                <input type="text" id="endtime" class="form-control time-picker end" placeholder="End Time">
                            </div>
                        </div>
                        <div class="form-group col-md-1">
                            <label class="form-control-label">App.</label>
                            <input type="checkbox" id="byappointment" name="byappointment" class="minimal" value="1" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <a class="col-md-12 btn btn-default" id="addtoschedule"><i class="fa fa-arrow-circle-down"></i>&nbsp; Add to Schedule &nbsp;<i class="fa fa-arrow-circle-down"></i></a>
                    </div>
                </div>
                <hr class="separator">  
                <div class="box-body">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped" id="example0">
                            <thead>
                                <tr>
                                    <td width="1%" class="no-right"></td>
                                    <td width="39%"><b>Hospital</b></td>
                                    <td width="25%"><b>Day</b></td>
                                    <td width="15%"><b>Start Time</b></td>
                                    <td width="15%"><b>End Time</b></td>
                                    <td width="5%"><b>App.</b></td>
                                </tr>
                            </thead>
                            <tbody id="scheduleTemp">
                                <?php if(count($schedule_temp) > 0){ ?>
                                    <?php $n=0; foreach($schedule_temp as $row){ $n++; if($role != NULL){$index=$n;}else{$index=$row['idindex'];} ?>
                                        <tr>
                                            <td class="no-right" align="center">
                                                <?php if($row['idhospital'] == $this->session->userdata(_PREFIX.'branch') || $this->session->userdata(_PREFIX.'branch') == 0){ ?>
                                                    <a href="javascript:void(0);" class="close" onclick="deleteScheduleTemp('<?php echo $index.'|'.$row['idschedule'];?>')"><i class="fa fa-close"></i></a>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $row['namehospital'];?></td>
                                            <td><?php echo $row['day'];?></td>
                                            <td><?php echo date('H:i',strtotime($row['starttime']));?></td>
                                            <td><?php echo date('H:i',strtotime($row['endtime']));?></td>
                                            <td><?php if($row['appointment']=='1'){echo 'Yes';}else{echo 'No';}?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box">    
                <div class="box-body">    
                    <div class="form-group" style="display: none;">
                        <label for="doctorcategory" class="form-control-label" >Parent Category</label>
                        <?php if(isset($doctorcategory) || count($doctorcategory) > 0){ ?>
                            <select name="doctorcategory" id="doctorcategory" class="form-control">
                            <?php foreach($doctorcategory as $row1){ ?>
                                <option value="<?php echo $row1['id'];?>"><?php echo $row1['namecategory']; ?></option>
                            <?php } ?>
                            </select>
                        <?php }else{ ?>
                            <input type="text" name="doctorcategory" placeholder="Data Empty..." disabled="disabled">
                        <?php } ?>
                    </div>  
                    <div class="form-group" style="display: none;">
                        <label for="subcategory1" class="form-control-label" >Category</label>
                        <?php if(isset($subcategory1) || count($subcategory1) > 0){ ?>
                            <select name="subcategory1" id="subcategory1" class="form-control">
                            <?php foreach($subcategory1 as $row2a){ ?>
                                <option value="<?php echo $row2a['cat_id'];?>"><?php echo $row2a['cat_name']; ?></option>
                            <?php } ?>
                            </select>
                        <?php }else{ ?>
                            <input type="text" name="subcategory1" placeholder="Data Empty..." disabled="disabled">
                        <?php } ?>
                    </div> 
                    <div class="form-group" style="display: none;">
                        <label for="itemcategory" class="form-control-label" >Sub Category</label>
                        <?php if(isset($itemcategory) || count($itemcategory) > 0){ ?>
                            <select name="itemcategory" id="itemcategory" class="form-control">
                            <?php foreach($itemcategory as $row2b){ ?>
                                <option value="<?php echo $row2b['item_id'];?>"><?php echo $row2b['item_name']; ?></option>
                            <?php } ?>
                            </select>
                        <?php }else{ ?>
                            <input type="text" name="itemcategory" placeholder="Data Empty..." disabled="disabled">
                        <?php } ?>
                    </div> 
                    <div class="form-group" style="display: none;">
                        <label for="locationcategory" class="form-control-label" >Location</label>
                        <?php if(isset($locationcategory) || count($locationcategory) > 0){ ?>
                            <select name="locationcategory" id="locationcategory" class="form-control">
                            <?php foreach($locationcategory as $row3){ ?>
                                <option value="<?php echo $row3['id'];?>"><?php echo $row3['namelocation']; ?></option>
                            <?php } ?>
                            </select>
                        <?php }else{ ?>
                            <input type="text" name="locationcategory" placeholder="Data Empty..." disabled="disabled">
                        <?php } ?>
                    </div> 
                    <div class="form-group" style="display: none;">
                        <label for="price" class="form-control-label" >Price</label>
                        <input type="text" name="price" id="price" class="form-control"/>
                    </div>                             
                    <div class="form-group">
                        <label for="highlight" class="form-control-label" >Specialist</label>
                        <input type="hidden" name="highlight_flag" id="highlight_flag" value="1"/>
                        <?php foreach($highlight as $row_high){ ?>
                        <?php $getHighlight = $this->mhighlight->getByDetail($result['iddoctor'],$row_high['highlight_id'])->num_rows();?>
                        <label>
                            <input type="checkbox" id="highlight[]" name="highlight[]" class="minimal" value="<?php echo $row_high['highlight_id'];?>" <?php if($getHighlight > 0){ echo 'checked';}?> />&nbsp;
                            <?php echo $row_high['highlight_title'];?>
                        </label><br>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>
                        	<?php if($result['status'] == '1'){ $check = 'checked'; }else{ $check =''; } ?>
                            <input type="checkbox" id="publish" name="publish" class="minimal" value="1" <?php echo $check;?>/>&nbsp;
                            Publish
                        </label>
                    </div>
                    <?php if($role != 'disabled="disabled"'){ ?>
                    <div class="form-group">
                        <input class="form-control btn btn-primary" type="submit" id="btnsubmit" name="btnsubmit" value="Update"/>
                    </div>
                    <?php } ?>
                </div>
            </div>      
        </div>
    </div>
</form>
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<script>
    function clearFormSchedule(){
        document.getElementById('hospital').value ='1|Brawijaya Clinic Kemang';
        document.getElementById('schedule_day').value ='Monday';
        $("#starttime").val('08:00');
        $("#endtime").val('21:00');
        $('input[name=byappointment]').iCheck('uncheck');
    }

    function deleteScheduleTemp(getvalue){
        $(".overlay").show();
        var splitvalue  = getvalue.split('|');
        var indexid     = splitvalue[0];
        var scheduleid  = splitvalue[1];
        var slug        = $("#slug").val();

        var answer = confirm("Are you sure delete schedule? ");
        if(answer) {
            $.post(
                '<?php echo base_url('admin/doctor/deletescheduletemp');?>',
                {indexid:indexid,scheduleid:scheduleid,slug:slug},
                function(data){
                    $("#example0").find('#scheduleTemp').html(data);
                    clearFormSchedule();
                    $(".overlay").hide();
                }
            );
        }else{
            clearFormSchedule();
            $(".overlay").hide();
        }
    }

    $(document).ready(function(){
        
        $("#addtoschedule").click(function(){
            $(".overlay").show();

            var hospital        = $("#hospital").val();
            var hospitalsplit   = hospital.split('|');
            var hospitalid      = hospitalsplit[0];
            var hospitalname    = hospitalsplit[1];
            var schedule_day    = $("#schedule_day").val();
            var idschedule_day  = $("#schedule_day").find('option:selected').attr('idday');
            var starttime       = $("#starttime").val();
            var endtime         = $("#endtime").val();
            var slug            = $("#slug").val();

            if ($('input[name=byappointment]').is(':checked')) {
                var byappointment = '1';
            }else{
                var byappointment = '0';
            }

            $.post(
                '<?php echo base_url('admin/doctor/addscheduletemp');?>',
                {hospitalid:hospitalid,hospitalname:hospitalname,schedule_day:schedule_day,idschedule_day:idschedule_day,starttime:starttime,endtime:endtime,byappointment:byappointment,slug:slug},
                function(data){
                    $("#example0").find('#scheduleTemp').html(data);
                    clearFormSchedule();
                    $(".overlay").hide();
                }
            );
        });
    });
</script>