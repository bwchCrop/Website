<section class="content-header">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-home"></i> Utility</a></li>
            <li class="active">Setting</li>
            <li class="active">Menu</li>
        </ol>
    </div>
</section>

<div class="box">
    <!-- <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div> -->

    <div class="box-header">
        <?php echo $this->session->flashdata('message');?>
        <h3 class="box-title">&nbsp;
            <a href="#" data-target="#mAdd" data-toggle="modal" class="btn btn-primary" id="add"><i class="fa  fa-plus"></i> Add </a>
             &nbsp; Menu
        </h3> 

        <div class="box-tools menu-tab">
            <ul class="pagination pagination-sm no-margin pull-right">
              <li><a href="<?php echo base_url('menu');?>"><i class="fa fa-th-list"></i></a></li>
              <li><a href="<?php echo base_url('menu/sorting');?>"><i class="fa fa-unsorted"></i></a></li>
            </ul>
        </div>
    </div>

    <hr class="separator">

    <?php if($param == 'sorting'){ ?>
        <form action="<?php echo base_url('admin/menu/sort_menu');?>" method="POST">
            <div class="box-body">
                <ul class="todo-list todo-list-parent">
                    <?php $x=0; foreach($all_parent as $parent){ $x++; ?>
                        <li>
                            <span class="handle" nil="1">
                                <i class="fa fa-ellipsis-v"></i>
                                <i class="fa fa-ellipsis-v"></i>
                            </span>
                            <input type="hidden" name="parent[]" class="parent" id="parent[]" value="<?php echo $parent['id'];?>" idgroup="<?php echo $parent['parent'];?>">
                            <a href="javascript:void(0);" class="text text-parent" counter="<?php echo $x;?>"><?php echo $parent['menu'];?></a>
                            
                            <?php $getPosition = $this->mmenu->getAllPosition($parent['parent'])->result_array();?>
                            <?php if(count($getPosition) > 0){ ?>
                                <ul class="todo-list todo-list-position <?php echo $x;?>">
                                <?php $y=0; foreach ($getPosition as $position) { $y++; ?>
                                    <?php $getSort = $this->mmenu->getAllSort($parent['parent'],$position['position'])->result_array();?>
                                    <li >
                                        <span class="handle" nil="1">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                        <input type="hidden" name="position-<?php echo $parent['id'];?>[]" class="position" id="position-<?php echo $parent['id'];?>[]" value="<?php echo $position['id'];?>" idgroup="<?php echo $position['position'];?>">
                                        <a href="javascript:void(0);" class="text text-position" counter="<?php echo $y;?>"><?php echo $position['menu'];?></a>

                                        <?php if(count($getSort)>0){ ?>
                                            <ul class="todo-list todo-list-sort <?php echo $y;?>">
                                                <?php foreach ($getSort as $sort) { ?>
                                                <li>
                                                    <span class="handle" nil="1">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </span>
                                                    <input type="hidden" name="sort-<?php echo $parent['id'].$position['id'];?>[]" class="sort" id="sort-<?php echo $parent['id'].$position['id'];?>[]" value="<?php echo $sort['id'];?>" idgroup="<?php echo $sort['sort'];?>">
                                                    <span class="text"><?php echo $sort['menu'];?></span>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>

                                    </li>
                                <?php } ?>
                                </ul>
                            <?php } ?>

                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="box-footer">
                <input type="submit" name="submitMenusort" class="btn btn-primary pull-right" value="Save">
            </div>  
        </form>
    <?php }else{ ?>
        <div class="box-body">
            <table id="example4" class="table table-bordered table-striped scroll">
                <thead>
                    <tr>
                    <?php if($role['menuedit'] == '1' && $role['menudelete'] == '1'){ ?>
                        <th class="icheck">
                            <input type="checkbox" name="chkall" id="chkall" class="minimal chkall" chkurl="<?php echo base_url('admin/menu/multiple_action');?>" disabled="disabled">
                        </th>
                    <?php }else{ ?>
                        <th>No.</th>
                    <?php } ?>

                        <th>Menu</th>
                        <th>Position</th>
                        <th>Status</th>

                        <?php if($role['menuedit'] == '1' OR $role['menudelete'] == '1' OR $role['menuread'] == '1'){ ?>
                        <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                <?php $no=0;
                    foreach ($result as $data): $no++;
                    ?>
                    <tr>
                        <?php 
                            if($data['default'] == '1'){ 
                                $dis = 'style="pointer-events: none;" disabled="disabled"'; 
                                $def = '<span class="label label-primary pull-right" style="background-color:#d2d6de !important;">Default</span>';
                            }else{ 
                                $getMenuWizard = $this->mtempmenu->getByWhere("menutemp_menu_id = '".$data['id']."'")->num_rows();

                                $dis = ''; 

                                if($getMenuWizard>0){
                                    $def = '<span onclick="delete_list(\''.$data['id'].'-'.$data['menu'].'-reset\' , \''.base_url('reset-menu').'\')" class="label label-danger pull-right" val="'.$data['id'].'">Reset</span>';
                                }else{
                                    $def = '';
                                }
                            }
                        ?>

                        <?php if($role['menuedit'] == '1' && $role['menudelete'] == '1'){ ?>
                        <td width="3%">
                            <input type="checkbox" name="cb_menu[]" id="cb_menu[]" data-error=".result" class="minimal chkmenu" value="<?php echo $data['id'];?>" >
                        </td>
                        <?php }else{ ?>
                        <td width="3%"><?php echo $no; ?></td>
                        <?php } ?>

                        <td width="60%">
                            <?php echo $data['menu']; echo $def; ?>
                        </td>
                        <td>
                        <?php 
                            if($data['position']=='0'&&$data['sort']=='0'){
                                echo 'Parent';
                            }elseif($data['position']!='0'&&$data['sort']=='0'){
                                echo 'Menu';
                            }else{
                                echo 'Sub Menu';
                            }

                            if(!isset($data['url']) && $data['url'] == ''){
                                $linkurl = '0';
                            }else{
                                $linkurl = '1';
                            }
                        ?>    
                        </td>
                        <td align="center">
                        <?php if($data['status'] == '1'){ ?>
                            <span class="label label-success">Active</span>
                        <?php }elseif($data['status'] == '2'){ ?>
                            <span class="label label-warning">Blank</span>
                        <?php }else{ ?>
                            <span class="label label-danger">Nonactive</span>
                        <?php } ?>
                        </td>

                        <?php if($role['menuedit'] == '1' OR $role['menudelete'] == '1' OR $role['menuread'] == '1'){ ?>
                        <td width="30%" align="center">
                            <a href="javascript:void(0);" onclick="view_list('<?php echo $data['id'];?>', '<?php echo base_url('view-menu');?>')" class="btn bg-olive btn-xs view" data-id="group">
                                <i class="fa fa-laptop"></i> View
                            </a>
                            &nbsp;
                            <?php if($role['menuedit'] == '1'){ ?>
                            <a href="javascript:void(0);" onclick="edit_list('<?php echo $data['id'];?>','<?php echo base_url('view-menu');?>','<?php echo base_url('edit-menu');?>')" class="btn bg-purple btn-xs edit" data-id="group" pk="<?php echo $data['id']; ?>"  url1="view-groupmenu" url2="edit-groupmenu">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <?php } ?>
                            &nbsp;
                            <?php if($role['menudelete'] == '1'){ ?>
                            <a href="javascript:void(0);" onclick="delete_list('<?php echo $data['id'].'-'.$data['menu'].'-'.$data['position'].'-'.$linkurl;?>', '<?php echo base_url('delete-menu');?>')" class="btn bg-maroon btn-xs delete" data-id="group" <?php echo $dis;?> >
                                <i class="fa fa-trash-o"></i> Delete
                            </a>
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
    <?php } ?>
</div>

<div class="modal fade" id="mAdd" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <!-- <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div> -->
    <div class="modal-content">
      <form name="mAdd" method="POST" class="mAdd">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Add <?php echo $title;?></h4>
        </div>
        <div class="modal-body">
            <div class="form-group" style="position: relative;">
              <label for="name" class="form-control-label">Menu Name</label>
              <input type="text" class="form-control textchanged" id="name" name="name" checkUrl="<?php echo base_url('admin/menu/checkName');?>">
              <i class="fa fa-spin fa-refresh pull-right loadchanged"></i>
            </div>
            <div class="form-group">
              <label for="groupName" class="form-control-label">Position</label><br>
                <input type="radio" id="position" name="position" class="minimal position" value="1"> Parent &nbsp;&nbsp;
                <input type="radio" id="position" name="position" class="minimal position" value="2"> Menu &nbsp;&nbsp;
                <input type="radio" id="position" name="position" class="minimal position" value="3"> Sub Menu
            </div>

            <div class="op0">
                <input type="hidden" name="indexparent" id="indexparent" value="<?php echo $max_parent['parent']; ?>"/>
            </div>

            <div class="op2">
              <div class="form-group">
                <label for="parent">Parent</label>
                <select class="form-control parent" id="parent" name="parent">
                  <option value="">Choose..</option>
                  <?php foreach($all_parent as $row){ ?>
                  <option value="<?php echo $row['parent'];?>"><?php echo $row['menu'];?></option>
                  <?php } ?>
                </select>
                <input type="hidden" name="indexmenu" id="indexmenu" />
              </div>
              <div class="form-group">
                <label for="icon" class="form-control-label">Icon</label>
                <input type="text" class="form-control" name="icon" id="icon"/>
              </div>
            </div>

            <div class="op3">
              <div class="form-group">
                <label for="parent">Parent</label>
                <select class="form-control parent" id="parent" name="parent">
                  <option value="">Choose..</option>
                  <?php foreach($menu as $row){ ?>
                  <option value="<?php echo $row['parent'];?>"><?php echo $row['menu'];?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="menu">Menu</label>
                <select class="form-control menu" id="menu" name="menu" disabled="disabled">
                  <option value=""></option>
                </select>
                <input type="hidden" name="indexsubmenu" id="indexsubmenu"/>
              </div>
            </div>  

            <div class="op1">
              <div class="form-group">
                <label for="link" class="form-control-label">Route</label>
                <input type="text" class="form-control" name="link" id="link"/>
              </div>       
              <div class="form-group">
                <label for="url" class="form-control-label">URL</label>
                <input type="text" class="form-control" name="url" id="url"/> 
              </div>
            </div>
            
            <hr>

            <div class="form-group">
              <label class="label-url" style="width: 100%;">
                  <input type="checkbox" id="staturl" name="staturl" class="minimal" value="0" checked="" />&nbsp;
                  URL Link<br>
              </label>
              <label>
                  <input type="checkbox" id="status" name="status" class="minimal"/>&nbsp;
                  Publish
              </label>
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