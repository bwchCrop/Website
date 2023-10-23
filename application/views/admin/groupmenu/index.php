<section class="content-header">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Utility</a></li>
            <li class="active">Setting</li>
            <li class="active">Group Menu</li>
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
            <a href="#" data-target="#mAdd" data-toggle="modal" class="btn btn-primary" id="add"><i class="fa  fa-plus"></i> Add </a>
             &nbsp;Group Menu
        </h3> 
    </div>

    <hr class="separator">

    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Group</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=0;
                foreach ($result as $data): $no++;
                ?>
                <tr>
                    <td width="10%"><?php echo $no; ?></td>
                    <td width="60%"><?php echo $data['groupname']; ?></td>
                    <td width="30%" align="center">
                        <a href="javascript:void(0);" onclick="view_list('<?php echo $data['id'].'\',\''.base_url('view-groupmenu');?>')" class="btn bg-olive btn-xs view" data-id="group">
                            <i class="fa fa-laptop"></i> View
                        </a>
                        &nbsp;
                        <a href="javascript:void(0);" onclick="edit_list('<?php echo $data['id'].'\',\''.base_url('view-groupmenu');?>','<?php echo base_url('edit-groupmenu');?>')" class="btn bg-purple btn-xs edit" data-id="group">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        &nbsp;
                        <a href="javascript:void(0);" 
                           <?php if($data['id'] == '0' || $data['id'] == '1'){ ?>
                           disabled="disabled" style="pointer-events: none;"
                           <?php }else{ ?>
                           onclick="delete_list('<?php echo $data['id'].'\',\''.base_url('delete-groupmenu');?>')" 
                           <?php } ?>
                           class="btn bg-maroon btn-xs delete"  data-id="group">
                            <i class="fa fa-trash-o"></i> Delete
                        </a>
                    </td>
                </tr>
                <?php
                endforeach;
            ?>
            </tbody>
        </table>

    </div>
</div>

<div class="modal fade" id="mAdd" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
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
              <label for="groupName" class="form-control-label">Group Name</label>
              <input type="text" class="form-control" id="groupName" name="groupName" >
            </div>
            <div class="form-group">
              <label for="menuList" class="form-control-label">Menu List</label>
              <div class="form-control outer-table">
                <table class="table table-bordered">
                  <thead>
                    <th>
                      <td>
                        <b>Title</b>
                      </td>
                      <td align="center">
                        <input type="checkbox" name="chkall" id="chkall" class="minimal chkall">
                        <p>All</p>
                      </td>
                      <td align="center">
                        <input type="checkbox" name="chkreadall" id="chkreadall" class="minimal chkreadall">
                        <p>Read</p>
                      </td>
                      <td align="center">
                        <input type="checkbox" name="chkeditall" id="chkeditall" class="minimal chkeditall">
                        <p>Edit</p>
                      </td>
                      <td align="center">
                        <input type="checkbox" name="chkdeleteall" id="chkdeleteall" class="minimal chkdeleteall">
                        <p>Delete</p>
                      </td>
                    </th>
                  </thead>
                  <tbody>
                    <?php $n = 0; foreach ($data_menu as $row) { $n++; ?>
                    <tr>
                      <td align="center">
                        <?php echo $n; ?>
                      </td>
                      <td>
                        <?php echo $row['menu']; ?>
                      </td>
                      <td align="center">
                        <input type="checkbox" name="cb_menu[]" id="cb_menu[]" data-index="<?php echo $n-1;?>" data-error=".result" class="minimal chkmenu" value="<?php echo $row['id'];?>" >
                      </td>
                      <td align="center">
                        <input type="checkbox" name="cb_read[]" id="cb_read[]" data-index="<?php echo $n-1;?>" data-error=".result" class="minimal chkread" value="<?php echo $row['id'];?>" >
                      </td>
                      <td align="center">
                        <input type="checkbox" name="cb_edit[]" id="cb_edit[]" data-index="<?php echo $n-1;?>" data-error=".result" class="minimal chkedit" value="<?php echo $row['id'];?>" >
                      </td>
                      <td align="center">
                        <input type="checkbox" name="cb_delete[]" id="cb_delete[]" data-index="<?php echo $n-1;?>" data-error=".result" class="minimal chkdelete" value="<?php echo $row['id'];?>" >
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="result has-error"></div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="saveGroup">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>