<section class="content-header">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Main Navigation</a></li>
            <li class="">Post</li>
            <li class="active">Add</li>
        </ol>
    </div>
</section>

<div class="row">
    <form class="mAdd" action="" method="POST">
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <?php echo $this->session->flashdata('message');?>
                    <h3 class="box-title">&nbsp;
                        <a href="<?php echo base_url('admin-post'); ?>" class="btn btn-primary" id="add"><i class="fa fa-reply"></i></a>
                        &nbsp; Post
                    </h3> 
                </div>
                <hr class="separator">      
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title" class="form-control-label" >Title</label>
                            <input type="text" name="title" id="title" class="form-control toSlug" post="post"/>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="form-control-label" >Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control slug"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content" class="form-control-label">Content</label>
                            <textarea class="tinymce" id="content" name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="thumbnailtext" class="form-control-label" >Thumbnail Text</label>
                            <div class="input-group">
                                <input type="text" name="thumbnailtext" id="thumbnailtext" class="form-control" maxlength="180"/>
                                <div class="input-group-btn">
                                    <a class="btn btn-info generate-thumbnail" href="javascript:void(0);" title="Generate Text">
                                    Generate
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="box">
                <div class="box-header">
                    <div class="col-sm-2" style="padding-left: 20px;">
                        <input type="hidden" name="picture-counter" id="picture-counter" value="1" />
                        <a id="add-picture" class="btn btn-primary add-picture"> Add Picture</a>
                    </div>
                </div>
                <hr class="separator">
                <div class="box-body">
                    <div class="col-sm-12 field-picture" style="margin-bottom: 15px; padding: 0px;">
                        <div class="col-sm-12">
                            <div class="input-group" style="margin-bottom: 5px;">
                                <input type="text" class="form-control" data-toggle="popover" data-trigger="hover focus" data-placement="top" title="Image" data-error=".result" id="picture-1" name="picture-1" placeholder="Picture 1">
                                <div class="input-group-btn">
                                    <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=picture-1&akey='._AKEY); ?>" class="iframe-btn" title="File Manager">
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
            <div class="box">
            <!-- <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div> -->
                <div class="box-header">
                    <?php echo $this->session->flashdata('message');?>
                    <h3 class="box-title">&nbsp;</h3> 
                </div>
                <hr class="separator">      
                <div class="box-body">
                    <div class="form-group">
                        <label for="category" class="form-control-label" >Category</label>
                        <select name="category" id="category" class="form-control" site="admin/post/load_store">
                        <?php foreach($category as $row){ ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['title']; ?></option>
                        <?php } ?>
                        </select>
                    </div>  
                    <div class="form-group store">
                        <label for="store" class="form-control-label" >Store</label>
                        <select name="store" id="store" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-control-label">Image</label>
                        <div class="input-group">
                            <input type="text" class="form-control"  data-toggle="popover" data-trigger="hover focus" data-placement="top" title="Image" data-error=".result" id="image" name="image" >
                            <div class="input-group-btn">
                                <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=image&akey='._AKEY); ?>" class="iframe-btn" title="File Manager">
                                Browse
                                </a>
                            </div>
                        </div>
                        <div class="result has-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail" class="form-control-label">Thumbnail</label>
                        <div class="input-group">
                            <input type="text" class="form-control"  data-toggle="popover" data-trigger="hover focus" data-placement="top" title="Image" data-error=".result" id="thumbnail" name="thumbnail" >
                            <div class="input-group-btn">
                                <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=thumbnail&akey='._AKEY); ?>" class="iframe-btn" title="File Manager">
                                Browse
                                </a>
                            </div>
                        </div>
                        <div class="result has-error"></div>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="publish" name="publish" class="minimal" />&nbsp;
                            Publish
                        </label>
                    </div>
                    <div class="form-group">
                        <input class="form-control btn btn-primary" type="submit" id="submit" name="submit" value="Submit"/>
                    </div>
                </div>
            </div>          
        </div>
    </form>
</div>