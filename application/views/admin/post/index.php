<section class="content-header">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-home"></i>&nbsp; Main Navigation</a></li>
            <li>Post</li>
            <li class="active">Article</li>
        </ol>
    </div>
</section>

<div class="box">

    <!-- <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div> -->

    <div class="box-header">
        <?php echo $this->session->flashdata('message');?>
        <h3 class="box-title">&nbsp;
            <?php if($role['menudelete'] == '1'){ ?>
                <a href="<?php echo base_url('add-post'); ?>" class="btn btn-primary" id="add"></i> Add </a>
            <?php } ?>
            <?php echo $title;?>
        </h3> 
    </div>

    <hr class="separator">

    <div class="box-body">
        <table id="example3" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <?php if($role['menuedit'] == '1' && $role['menudelete'] == '1'){ ?>
                    <th class="icheck">
                        <input type="checkbox" name="chkall" id="chkall" class="minimal chkall" chkurl="<?php echo base_url('admin/post/multiple_action');?>">
                    </th>
                    <?php }else{ ?>
                    <th width="3%">No.</th>
                    <?php } ?>
                    <th>Title</th>
                    <th width="10%">Category</th>
                    <th width="10%">Status</th>
                    <th width="10%">Published<sub>Date</sub></th>
                    <th width="15%">Published<sub>By</sub></th>

                    <?php if($role['menuedit'] == '1' OR $role['menudelete'] == '1' OR $role['menuread'] == '1'){ ?>
                    <th width="20%">Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
            <?php $no=0;
                foreach ($result as $data): $no++; $encrypt_id = $this->marge->encrypt($data['post_id']);
                ?>
                <tr>
                    <?php if($role['menuedit'] == '1' && $role['menudelete'] == '1'){ ?>
                    <td>
                        <input type="checkbox" name="cb_menu[]" id="cb_menu[]" data-error=".result" class="minimal chkmenu" value="<?php echo $encrypt_id;?>" >
                    </td>
                    <?php }else{ ?>
                    <td><?php echo $no;?></td>
                    <?php } ?>
                    <td><?php echo $data['post_title']; ?></td>
                    <td><?php echo $data['cat_title']; ?></td>
                    <td><?php $stat = array('1' => 'Published', '0' => 'N/A' ); echo $stat[$data['status']]; ?></td>
                    <td><?php echo date('d/F/Y',strtotime($data['date']));?></td>
                    <td><?php echo $data['user'] ?></td>

                    <?php if($role['menuedit'] == '1' OR $role['menudelete'] == '1' OR $role['menuread'] == '1'){ ?>
                    <td align="center">     
                        <?php if($role['menuread'] == '1'){ ?>
                            <a href="<?php echo base_url('view-post-'.$encrypt_id); ?>" class="btn bg-green btn-xs" data-id="post" pk="<?php echo $data['post_id']; ?>"  url1="view-post" url2="edit-post">
                                <i class="fa fa-laptop"></i> View
                            </a>
                        <?php } ?>
                        &nbsp;
                        <?php if($role['menuedit'] == '1'){ ?>
                            <a href="<?php echo base_url('edit-post-'.$encrypt_id); ?>" class="btn bg-purple btn-xs" data-id="post" pk="<?php echo $data['post_id']; ?>"  url1="view-post" url2="edit-post">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        <?php } ?>
                        &nbsp;
                        <?php if($role['menudelete'] == '1'){ ?>
                            <?php if($data['post_id'] < 712 || $data['post_id'] > 717){ ?>
                            <a href="javascript:void(0);" onclick="delete_list('<?php echo $encrypt_id;?>','<?php echo base_url('delete-post');?>')" class="btn bg-maroon btn-xs delete" data-id="post">
                                <i class="fa fa-trash-o"></i> Delete
                            </a>
                            <?php }else{ ?>
                            <a href="javascript:void(0);" class="btn bg-maroon btn-xs delete" disabled="disabled">
                                <i class="fa fa-trash-o"></i> Delete
                            </a>
                            <?php } ?>
                        <?php } ?>
                    </td>
                    <?php } ?>
                </tr>
                <?php
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
</div>