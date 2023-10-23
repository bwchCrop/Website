<section class="content-header" style="padding:0;">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Main Navigation</a></li>
            <li class="active">Personalise</li>
        </ol>
    </div>
</section>
<?php echo $this->session->flashdata('message_');?>
<form action="<?php echo base_url('save-personalise');?>" method="POST">
    <?php for($i=7; $i <= 15; $i++){ ?>
        <?php  
            switch ($i) {
                case '7' : $titleP = 'Home';       $result = $result_home; break;
                case '8' : $titleP = 'About';      $result = $result_about; break;
                case '9' : $titleP = 'Location';   $result = $result_location; break;
                case '10': $titleP = 'Service';    $result = $result_service; break;
                case '11': $titleP = 'Schedule';   $result = $result_schedule; break;
                case '12': $titleP = 'Special';    $result = $result_special; break;
                case '13': $titleP = 'Membership'; $result = $result_membership; break;
                case '14': $titleP = 'News Event'; $result = $result_newsevent; break;
                case '15': $titleP = 'Instagram Feed'; $result = $result_ig_feed; break;
                default: $titleP = ''; $result = $result_home; break;
            }
        ?>
        <div class="box" style="margin-bottom: 15px;">
            <div class="box-header">
                <h3 class="box-title">&nbsp;
                    <a href="javascript:void(0);" class="btn btn-primary add-slide-<?php echo $i;?>" id="add-slide-<?php echo $i;?>"></i> Add </a>
                    <input type="hidden" name="slide-<?php echo $i;?>-counter" value="<?php if(count($result) > 0){ echo count($result); }else{ echo '1';} ?>" />
                     Personalise <?php echo $titleP;?>
                </h3> 
            </div>
            <hr style="margin: 0;">      
            <div class="box-body">
                <div class="col-xs-12 field-slide-<?php echo $i;?>" style="padding: 0;">
                    <?php if(count($result)>0){ ?>
                        <?php $n=0;foreach($result as $row){ $n++; ?>
                        <div class="col-xs-12 input-group-<?php echo $i.'-'.$n;?>" style="padding: 0;">
                            <div class="col-sm-6">
                                <div class="input-group" style="margin-bottom: 5px;">
                                    <?php if($n>1){ ?>
                                    <div class="input-group-btn">
                                        <a class="btn btn-danger del-slide" href="javascript:void(0);" number="<?php echo $n;?>" pk="<?php echo $i;?>">
                                        x
                                        </a>
                                    </div>
                                    <?php } ?>
                                    <input type="text" class="form-control" data-toggle="popover" data-trigger="hover focus" data-placement="top" title="Image" id="slide-<?php echo $i.'-'.$n;?>" name="slide-<?php echo $i.'-'.$n;?>" value="<?php echo $row['image'];?>">
                                    <div class="input-group-btn">
                                        <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=slide-'.$i.'-'.$n.'&akey='._AKEY); ?>" class="iframe-btn" title="File Manager">
                                        Browse
                                        </a>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-sm-3" <?php echo ($i != 7)? 'style="visibility:hidden;"' : ''; ?> >
                                <div class="col-xs-12 input-group" style="margin-bottom: 5px;">
                                    <input type="text" class="form-control" placeholder="Image URL" id="slideurl-<?php echo $i.'-'.$n;?>" name="slideurl-<?php echo $i.'-'.$n;?>" value="<?php echo $row['attach'];?>">
                                </div>                            
                            </div>
                            <div class="col-sm-1" <?php echo ($i != 7)? 'style="visibility:hidden;"' : ''; ?> >
                                <div class="col-xs-12 input-group" style="margin-bottom: 5px;">
                                    <input type="number" class="form-control" placeholder="Order Asc" id="slideorder-<?php echo $i.'-'.$n;?>" name="slideorder-<?php echo $i.'-'.$n;?>" value="<?php echo $row['sort'];?>">
                                </div>                            
                            </div>
                            <div class="col-md-2" <?php echo ($i != 7)? 'style="visibility:hidden;"' : ''; ?>>
                                <div class="col-xs-12 input-group" style="margin-bottom: 5px;">
                                    <?php 
                                        if($row['date'] != '0000-00-00 00:00:00'){
                                            $rowdate = $row['date'];
                                        }else{
                                            $rowdate = date('Y-m-d', strtotime('+1 year')); 
                                        }
                                    ?>

                                    <input type="date" class="form-control" placeholder="Expired Date" id="slidedate-<?php echo $i.'-'.$n;?>" name="slidedate-<?php echo $i.'-'.$n;?>" value="<?php echo date('Y-m-d', strtotime($rowdate));?>">
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php }else{ ?>
                        <div class="col-xs-12 input-group-<?php echo $i;?>-1" style="padding: 0;">
                            <div class="col-sm-6">
                                <div class="input-group" style="margin-bottom: 5px;">
                                    <input type="text" class="form-control" data-toggle="popover" data-trigger="hover focus" data-placement="top" title="Image" id="slide-<?php echo $i;?>-1" name="slide-<?php echo $i;?>-1" >
                                    <div class="input-group-btn">
                                        <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=slide-'.$i.'-1'.'&akey='._AKEY); ?>" class="iframe-btn" title="File Manager">
                                        Browse
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" <?php echo ($i != 7)? 'style="visibility:hidden;"' : ''; ?> >
                                <div class="col-xs-12 input-group" style="margin-bottom: 5px;">
                                    <input type="text" class="form-control" placeholder="Image URL" id="slideurl-<?php echo $i;?>-1" name="slideurl-<?php echo $i;?>-1" >
                                </div>
                            </div>
                        </div>    
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary" value="Save">
            <a href="<?php echo base_url('admin-personalise');?>" class="btn btn-default" >Cancel</a>
        </div>
    </div>
</form>
<script src="<?php echo base_url('assets/front/js/jquery.min.js');?>" ></script>
<script>
$(function() {
  $('.overlay').hide();

  $('[data-toggle="popover"]').popover({
      html: true,
      content: function(){return '<img style="width:100%;" src="'+$(this).val() + '" />';}
  })
});
</script>

