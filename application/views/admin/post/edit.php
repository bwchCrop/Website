<section class="content-header">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-home"></i> Main Navigation</a></li>
            <li class="">Post</li>
            <li class="active">Edit</li>
        </ol>
    </div>
</section>

<div class="row">
    <form class="mView" action="" method="POST">
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
                        <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $encrypt_id; ?>" />
                        <input type="text" name="title" id="title" class="form-control toSlug" value="<?php echo $result['title']; ?>" post="post" <?php echo $role;?>/>
                    </div>
                    <div class="form-group">
                        <label for="slug" class="form-control-label" >Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control slug" value="<?php echo $result['slug']; ?>" <?php echo $role;?>/>
                    </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content" class="form-control-label">Content</label>
                            
                            <?php if($role == ''){ ?>
                            <textarea class="tinymce" id="content" name="content" ><?php echo set_value('content', $result['content']); ?></textarea>
                            <?php }else{ ?>
                            <div class="col-xs-12" style="border: 1px solid #d2d6de;">
                                <?php echo $result['content'];?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="thumbnailtext" class="form-control-label" >Thumbnail Text</label>
                            <?php if($role == ''){ ?>
                            <div class="input-group">
                                <input type="text" name="thumbnailtext" id="thumbnailtext" class="form-control" value="<?php echo $result['thumbnailtext']; ?>" maxlength="180"/>
                                <div class="input-group-btn">
                                    <a class="btn btn-info generate-thumbnail" href="javascript:void(0);" title="Generate Text">
                                    Generate
                                    </a>
                                </div>
                            </div>
                            <?php }else{ ?>
                            <input type="text" name="thumbnailtext" id="thumbnailtext" class="form-control" value="<?php echo $result['thumbnailtext']; ?>" maxlength="180" <?php echo $role;?>/>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="box">
                <div class="box-header">
                    <div class="col-sm-2" style="padding-left: 20px;">
                        <input type="hidden" name="picture-counter" id="picture-counter" value="<?php if(count($result_picture) > 0){ echo count($result_picture);}else{ echo '1';}?>" />
                        <a id="add-picture" class="btn btn-primary add-picture"> Add Picture</a>
                    </div>
                </div>
                <hr class="separator">
                <div class="box-body">
                    <div class="col-sm-12 field-picture" style="margin-bottom: 15px; padding: 0px;">
                    <?php if(count($result_picture) > 0){ ?>
                        <?php $n=0; foreach($result_picture as $pic){$n++; ?>
                        <div class="col-sm-12">
                            <div class="input-group" style="margin-bottom: 5px;">
                                <input type="text" class="form-control" data-toggle="popover" data-trigger="hover focus" data-img="<?php echo $pic['postpicture'];?>" data-placement="top" title="Image" data-error=".result" id="picture-<?php echo $n; ?>" name="picture-<?php echo $n; ?>" placeholder="Picture <?php echo $n;?>" value="<?php echo $pic['postpicture'];?>">
                                <div class="input-group-btn">
                                    <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=picture-'.$n.'&akey='._AKEY); ?>" class="iframe-btn" title="File Manager">
                                    Browse
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php }else{ ?>
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
                    <?php } ?>
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
                        <select name="category" id="category" class="form-control" site="admin/post/load_store" <?php echo $role;?>>
                        <?php foreach($category as $row){ ?>
                            <?php 
                                if($row['id'] == $result['idcategory']){ $sel = "selected" ; }else{ $sel = ""; }
                             ?>
                            <option value="<?php echo $row['id'];?>" <?php echo $sel; ?> ><?php echo $row['title']; ?></option>
                        <?php } ?>
                        </select>
                    </div>  
                    <?php if($result['idcategory'] == '5'){ ?>
                    <div class="form-group store">
                        <label for="store" class="form-control-label" >Store</label>
                        <select name="store" id="store" class="form-control" <?php echo $role;?>>
                            <option value="0">All</option>
                        <?php foreach($store as $row){ ?>
                            <?php 
                                if($row['idstore'] == $result['idpoststore']){ $sel = "selected" ; }else{ $sel = ""; }
                            ?>
                            <option value="<?php echo $row['idstore'];?>" <?php echo $sel; ?> ><?php echo $row['location']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="image" class="form-control-label">Image</label>
                        <?php if($role == ''){ ?>
                        <div class="input-group">
                            <input type="text" class="form-control"  data-toggle="popover" data-trigger="hover focus" data-placement="top" title="Image" data-error=".result" id="image" name="image" value="<?php echo $result['image']; ?>">
                            <div class="input-group-btn">
                                <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=image&akey='._AKEY); ?>" class="iframe-btn" title="File Manager">
                                Browse
                                </a>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <img src="<?php echo $result['image'];?>" width="100%">
                        <?php } ?>
                        <div class="result has-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail" class="form-control-label">Thumbnail</label>
                        <?php if($role == ''){ ?>                       
                        <div class="input-group">
                            <input type="text" class="form-control"  data-toggle="popover" data-trigger="hover focus" data-placement="top" title="Image" data-error=".result" id="thumbnail" name="thumbnail" value="<?php echo $result['thumbnail']; ?>">
                            <div class="input-group-btn">
                                <a class="btn btn-info iframe-btn" href="<?php echo base_url('assets/plugins/filemanager/dialog.php?type=2&amp;field_id=thumbnail&akey='._AKEY); ?>" class="iframe-btn" title="File Manager">
                                Browse
                                </a>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <img src="<?php echo $result['thumbnail'];?>" width="100%">
                        <?php } ?>
                        <div class="result has-error"></div>
                    </div>
                    <div class="form-group">
                        <label>
                            <?php if($result['status'] == '1'){ $checked = "checked"; }else{ $checked = ""; } ?>
                            <input type="checkbox" id="publish" name="publish" class="minimal" <?php echo $checked;?> <?php echo $role;?>/>&nbsp;
                            Publish
                        </label>
                    </div>
                    <?php if($role == ''){ ?>
                    <div class="form-group">
                        <input class="form-control btn btn-primary" type="submit" id="submit" name="submit" value="Submit"/>
                    </div>
                    <?php } ?>
                </div>
            </div>          
        </div>
    </form>
</div>