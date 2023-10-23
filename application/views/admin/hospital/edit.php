<section class="content-header">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Main Navigation</a></li>
            <li class="">Post</li>
            <li class="">Hospital</li>
            <li class="active">Edit</li>
        </ol>
    </div>
</section>

<div class="row">
    <form class="mView" action="" method="POST">
        <div class="col-md-9">
            <div class="box bottom-margin">
                <!-- <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div> -->
                <div class="box-header">
                    <?php echo $this->session->flashdata('message');?>
                    <h3 class="box-title">&nbsp;
                        <a href="<?php echo base_url('admin-hospital'); ?>" class="btn btn-primary" id="add"><i class="fa fa-reply"></i></a>
                        &nbsp; Hospital
                    </h3> 
                </div>
                <hr class="separator">      
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="namehospital" class="form-control-label" >Hospital Name</label>
                            <input type="hidden" name="idhospital" id="idhospital" value="<?php echo $encrypt_id ?>" />
                            <input type="text" name="namehospital" id="namehospital" class="form-control" value="<?php echo $result['namehospital'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description" class="form-control-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?php echo set_value('content', $result['description']); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address" class="form-control-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3"><?php echo set_value('content', $result['addresshospital']); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box bottom-margin">   
                <div class="box-body">
                    <div class="col-xs-12 field-map" style="margin-bottom: 15px;">
                       <div class="input-map" style="margin-bottom: 5px;">
                            <div class="col-md-6" style="padding-left: 0px;">
                            <label class="form-control-label">Longitude</label>
                            </div>
                            <div class="col-md-6" >
                            <label class="form-control-label">Latitude</label>
                            </div>      
                            <!-- <div class="col-md-12" style="padding-left: 0px;">
                                <label class="form-control-label">Map URL</label>
                            </div>  -->                       
                        </div>
                       <div class="col-md-12 input-map" style="margin-bottom: 5px; padding: 0px;">
                            <div class="col-md-6" style="padding-left: 0px;">
                                <input type="text" class="form-control" name="longitude" id="longitude" value="<?php echo $result['longitude'];?>">
                            </div>
                            <div class="col-md-6" style="padding-right:0px;">
                                <input type="text" class="form-control" name="latitude" id="latitude" value="<?php echo $result['latitude'];?>">
                            </div>
                            <!-- <div class="col-md-12" style="padding:0px;">
                                <input type="text" class="form-control" name="mapurl" id="mapurl" value="<?php echo $result['mapurl'];?>">
                            </div> -->
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="picture" class="form-control-label">Web Banner</label>
                            <div class="input-group">
                                <input type="text" class="form-control" data-toggle="popover" data-trigger="hover focus" data-placement="top" title="Image"  data-error=".result" id="image" name="image" value="<?php echo $result['image'];?>">
                                <div class="input-group-btn">
                                    <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=image&akey='._AKEY); ?>" class="iframe-btn" title="File Manager">
                                    Browse
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">   
                <div class="box-body">
                    <div class="col-xs-12 field-map" style="margin-bottom: 15px;">
                       <div class="input-map" style="margin-bottom: 5px;">
                            <div class="col-md-6" style="padding-left: 0px;">
                            <label class="form-control-label">Services</label>
                            </div>
                            <div class="col-md-6" >
                            <label class="form-control-label">Facilities</label>
                            </div>                           
                        </div>
                        <div class="col-md-12 input-map" style="margin-bottom: 5px; padding: 0px;">
                            <div class="col-md-6" style="padding-left: 0px;">
                                <?php foreach($resultServ as $rowS){ ?>
                                <?php $getSF = $this->db->query("SELECT * FROM "._PREFIX."hospital_detail tbldetail WHERE tbldetail.hospital_detail_idhospital = '".$decrypt_id."' AND tbldetail.hospital_detail_idpost = '".$rowS['post_id']."'")->num_rows();?>
                                <label style="font-weight: 500;">
                                    <input type="checkbox" id="services" name="services" class="minimal" value="<?php echo $rowS['post_id'];?>" <?php if($getSF > 0){ echo 'checked';}?> />&nbsp;
                                    <?php echo $rowS['post_title'];//.' ('.$rowS['post_id'].')';?>
                                </label><br>
                                <?php } ?>
                            </div>
                            <div class="col-md-6" style="padding-right:0px;">
                                <?php foreach($resultFac as $rowF){ ?>
                                <?php $getSF = $this->db->query("SELECT * FROM "._PREFIX."hospital_detail tbldetail WHERE tbldetail.hospital_detail_idhospital = '".$decrypt_id."' AND tbldetail.hospital_detail_idpost = '".$rowF['post_id']."'")->num_rows();?>
                                <label style="font-weight: 500;">
                                    <input type="checkbox" id="facilities" name="facilities" class="minimal" value="<?php echo $rowF['post_id'];?>" <?php if($getSF > 0){ echo 'checked';}?> />&nbsp;
                                    <?php echo $rowF['post_title'];?>
                                </label><br>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box">
            <!-- <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div> -->
                <div class="box-header">
                    <?php echo $this->session->flashdata('message');?>
                    <h3 class="box-title">&nbsp;</h3> 
                </div>
                <hr style="margin: 0;">      
                <div class="box-body">
                    <div class="form-group">
                        <label for="picture" class="form-control-label">Thumbnail</label>
                        <div class="input-group">
                            <input type="text" class="form-control" data-toggle="popover" data-trigger="hover focus" data-placement="bottom" title="Image"  data-error=".result" id="picture" name="picture" value="<?php echo $result['picture'];?>">
                            <div class="input-group-btn">
                                <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=picture&akey='._AKEY); ?>" class="iframe-btn" title="File Manager">
                                Browse
                                </a>
                            </div>
                        </div>
                        <div class="result has-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="form-control-label" >Location</label>
                        <!-- <input type="text" name="location" id="location" class="form-control" value="<?php echo $result['location'] ?>" /> -->
                        <select class="form-control" name="location" id="location">
                            <?php foreach($location as $row){ if($row['id'] == $result['location']){ $opt = 'selected';}else{ $opt = '';}?>
                            <option value="<?php echo $row['id'];?>" <?php echo $opt;?>><?php echo $row['namelocation'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city" class="form-control-label" >City</label>
                        <input type="text" name="city" id="city" class="form-control" value="<?php echo $result['city'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-control-label" >Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="<?php echo $result['email'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-control-label" >Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $result['phone'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="whatsapp" class="form-control-label" >Whatsapp</label>
                        <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="<?php echo $result['whatsapp'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="ugd" class="form-control-label" >UGD</label>
                        <input type="text" name="ugd" id="ugd" class="form-control" value="<?php echo $result['ugd'] ?>"/>
                    </div>

                    <div class="form-group">
                        <label>
                            <?php if($result['status'] == '1'){ $check = 'checked'; }else{ $check = ''; } ?>
                            <input type="checkbox" id="publish" name="publish" class="minimal" <?php echo $check;?>/>&nbsp;
                            Publish
                        </label>
                    </div>
                    <div class="form-group">
                        <input class="form-control btn btn-primary" type="submit" id="submit" name="submit" value="Update"/>
                    </div>
                </div>
            </div>          
        </div>
    </form>
</div>
<script src="<?php echo base_url('assets/front/js/jquery.min.js');?>" ></script>
<script>
$(function() {
  $('[data-toggle="popover"]').popover({
      html: true,
      content: function(){return '<img style="width:100%;" src="'+$(this).val() + '" />';}
  })
});
</script>
