<section class="content-header">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Main Navigation</a></li>
            <li class="">Doctor Profile</li>
            <li class="active">Edit</li>
        </ol>
    </div>
</section>

<div class="row">
    <form class="mView" action="<?php echo base_url('edit-api_doctor_scheduler'); ?>" method="POST">
        <div class="col-md-9">
            <div class="box bottom-margin">
                <!-- <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div> -->
                <div class="box-header">
                    <?php echo $this->session->flashdata('message'); ?>
                    <h3 class="box-title">
                        &nbsp; Doctor Profile
                    </h3>
                </div>
                <hr class="separator">
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Doctor Name</label>
                            <input type="hidden" name="id" id="id" value="<?php echo $result['id']  ?>" />
                            <input type="text" disabled name="name" id="name" class="form-control" value="<?php echo $result['name'] ?? NULL ?>" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Hospital</label>
                            <input type="text" value="<?php echo $result['hospital'] ?? NULL ?>" disabled name="hospital" id="hospital" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Specialist</label>
                            <input type="text" value="<?php echo $result['specialist'] ?? NULL ?>" disabled name="specialist" id="specialist" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description" class="form-control-label">Description</label>
                            <textarea class="form-control tinymce" rows="4" id="description" name="description"><?php echo set_value('content', $result['description']); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box">
                <!-- <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div> -->
                <div class="box-header">
                    <?php echo $this->session->flashdata('message'); ?>
                    <h3 class="box-title">&nbsp;</h3>
                </div>
                <hr style="margin: 0;">
                <div class="box-body">
                    <div class="form-group">
                        <label for="picture" class="form-control-label">Image</label>
                        <div class="input-group">
                            <input type="text" class="form-control" data-toggle="popover" data-trigger="hover focus" data-placement="bottom" title="Image" data-error=".result" id="image" name="image" value="<?php echo $result['image'] ?? NULL; ?>">
                            <div class="input-group-btn">
                                <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=image&akey=' . _AKEY); ?>" class="iframe-btn" title="File Manager">
                                    Browse
                                </a>
                            </div>
                        </div>
                        <div class="result has-error"></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control btn btn-primary" type="submit" id="submit" name="submit" value="Update" />
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