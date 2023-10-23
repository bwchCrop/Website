<section class="content-header">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Main Navigation</a></li>
            <li class="">Post</li>
            <li class="">Hospital</li>
            <li class="active">Add</li>
        </ol>
    </div>
</section>

<div class="row">
    <form class="mAdd" action="" method="POST">
        <div class="col-md-9">
            <div class="box bottom-margin">
                <!-- <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div> -->
                <div class="box-header">
                    <?php echo $this->session->flashdata('message'); ?>
                    <h3 class="box-title">&nbsp;
                        <a href="<?php echo base_url('admin-hospital'); ?>" class="btn btn-primary" id="add"><i class="fa fa-reply"></i></a>
                        &nbsp; Hospital
                    </h3>
                </div>
                <hr class="separator">
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="namehospital" class="form-control-label">Hospital Name</label>
                            <input type="text" name="namehospital" id="namehospital" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address" class="form-control-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <!-- <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div> -->
                <div class="box-header">
                    <h3 class="box-title">Map Detail</h3>
                </div>
                <hr class="separator">
                <div class="box-body">
                    <div class="col-xs-12 field-map" style="margin-bottom: 15px;">
                        <div class="input-map" style="margin-bottom: 5px;">
                            <div class="col-md-6" style="padding-left: 0px;">
                                <label class="form-control-label">Longitude</label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-control-label">Latitude</label>
                            </div>
                            <!-- <div class="col-md-12" style="padding-left: 0px;">
                                <label class="form-control-label">Map URL</label>
                            </div>  -->
                        </div>
                        <div class="col-md-12 input-map" style="margin-bottom: 5px; padding: 0px;">
                            <div class="col-md-6" style="padding-left: 0px;">
                                <input type="text" class="form-control" name="longitude" id="longitude">
                            </div>
                            <div class="col-md-6" style="padding-right:0px;">
                                <input type="text" class="form-control" name="latitude" id="latitude">
                            </div>
                            <!-- <div class="col-md-12" style="padding:0px;">
                                <input type="text" class="form-control" name="mapurl" id="mapurl">
                            </div> -->
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="picture" class="form-control-label">Web Banner</label>
                            <div class="input-group">
                                <input type="text" class="form-control" data-toggle="popover" data-trigger="hover focus" data-placement="top" title="Image" data-error=".result" id="image" name="image">
                                <div class="input-group-btn">
                                    <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=image&akey=' . _AKEY); ?>" class="iframe-btn" title="File Manager">
                                        Browse
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box" style="margin-bottom: 0px;">
                <!-- <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div> -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="picture" class="form-control-label">Thumbnail</label>
                        <div class="input-group">
                            <input type="text" class="form-control" data-toggle="popover" data-trigger="hover focus" data-placement="bottom" title="Image" data-error=".result" id="picture" name="picture">
                            <div class="input-group-btn">
                                <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=picture&akey=' . _AKEY); ?>" class="iframe-btn" title="File Manager">
                                    Browse
                                </a>
                            </div>
                        </div>
                        <div class="result has-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="form-control-label">Location</label>
                        <!-- <input type="text" name="location" id="location" class="form-control"/> -->
                        <select class="form-control" name="location" id="location">
                            <?php foreach ($result_location as $row) { ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['namelocation']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city" class="form-control-label">City</label>
                        <input type="text" name="city" id="city" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-control-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-control-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="ugd" class="form-control-label">UGD</label>
                        <input type="text" name="ugd" id="ugd" class="form-control" value="<?php echo $result['ugd'] ?>" />
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="publish" name="publish" class="minimal" />&nbsp;
                            Publish
                        </label>
                    </div>
                    <div class="form-group">
                        <input class="form-control btn btn-primary" type="submit" id="submit" name="submit" value="Submit" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="<?php echo base_url('assets/front/js/jquery.min.js'); ?>"></script>
<script>
    $(function() {
        $('[data-toggle="popover"]').popover({
            html: true,
            content: function() {
                return '<img style="width:100%;" src="' + $(this).val() + '" />';
            }
        })
    });
</script>