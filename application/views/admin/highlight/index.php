<section class="content-header"s>
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Main Navigation</a></li>
            <li>Category</li>
            <li class="active">Highlight</li>
        </ol>
    </div>
</section>

<div class="box">

    <div class="overlay">
      <i class="fa fa-refresh fa-spin"></i>
    </div>

    <div class="box-header">
        <?php echo $this->session->flashdata('message');?>
        <h3 class="box-title">&nbsp;
            <?php if($role['menudelete'] == '1'){ ?>
            <a href="javascript:void(0);" data-target="#mAdd" data-toggle="modal" class="btn btn-primary" id="add"></i> Add </a>
             <?php } ?>
             Highlight
        </h3> 
    </div>

    <hr class="separator">

    <div class="box-body">
        <table id="example3" class="table table-bordered table-striped">
            <thead>
                <tr>
                	<?php if($role['menuedit'] == '1' && $role['menudelete']){ ?>
                    <th class="icheck">
                        <input type="checkbox" name="chkall" id="chkall" class="minimal chkall" chkurl="<?php echo base_url('admin/highlight/multiple_action');?>">
                    </th>
                	<?php }else{ ?>
                    <th>No.</th>
                    <?php } ?>

                    <th>Title</th>
                    <th>Menu</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=0;
                foreach ($result as $data): $no++;
                ?>
                <tr>
                	<?php if($role['menuedit'] == '1' && $role['menudelete'] == '1'){ ?>
                    <td width="3%">
                        <input type="checkbox" name="cb_menu[]" id="cb_menu[]" data-error=".result" class="minimal chkmenu" value="<?php echo $data['highlight_id'];?>" >
                    </td>
                    <?php }else{ ?>
                    <td width="3%"><?php echo $no;?></td>
                    <?php } ?>

                    <td><?php echo $data['highlight_title'];?></td>
                    <td><?php echo $data['highlight_menu'];?></td>
                    <td><?php $status = array('0'=>'N/A','1'=>'Published',); echo $status[$data['highlight_status']];?></td>
                    <td align="center">
                        <a href="javascript:void(0);" onclick="view_list('<?php echo $data['highlight_id']; ?>','<?php echo base_url('view-highlight');?>')" class="btn bg-green btn-xs edit" data-id="highlight">
                            <i class="fa fa-laptop"></i> View
                        </a>
                        &nbsp;
                        <?php if( $role['menuedit'] == '1'){ ?>
                        <a href="javascript:void(0);" onclick="edit_list('<?php echo $data['highlight_id']; ?>','<?php echo base_url('view-highlight');?>','<?php echo base_url('edit-highlight');?>')" class="btn bg-purple btn-xs edit" data-id="highlight">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <?php } ?>
                        &nbsp;
                        <?php if($role['menudelete'] == '1'){ ?>
                        <a href="javascript:void(0);" onclick="delete_list('<?php echo $data['highlight_id']; ?>','<?php echo base_url('delete-highlight');?>')" class="btn bg-maroon btn-xs delete" data-id="highlight">
                            <i class="fa fa-trash-o"></i> Delete
                        </a>
                        <?php } ?>
                    </td>
                </tr>
                <?php
                endforeach;
            ?>
            </tbody>
        </table>

    </div>
</div>

<div class="modal fade" id="mAdd" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="overlay">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <div class="modal-content">
      <form name="mAdd" method="POST" class="mAdd">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Add <?php echo $title;?></h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="highlight_title" class="form-control-label"><?php echo $title;?> Name</label>
              <input type="text" class="form-control" id="highlight_title" name="highlight_title" >
            </div>          
            <div class="form-group">
              <label for="highlight_menu" class="form-control-label">Group Item</label>
              <select id="highlight_menu" name="highlight_menu" class="form-control">
                  <?php foreach($res_menu as $row){ ?>
                  <option value="<?php echo $row['link'] ?>"><?php echo $row['menu'] ?></option>
                  <?php } ?>
              </select>
            </div>  
            <div class="form-group">
                <input type="checkbox" name="highlight_status" id="highlight_status" class="minimal icheck"/>&nbsp;Publish
            </div>        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="save">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>