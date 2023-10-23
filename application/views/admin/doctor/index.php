<section class="content-header">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-home"></i> Main Navigation</a></li>
            <li>Post</li>
            <li class="active">doctor</li>
        </ol>
    </div>
</section>

<div class="box">

    <!-- <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div> -->

    <div class="box-header">
        <?php echo $this->session->flashdata('message_');?>
        <h3 class="box-title">&nbsp;
            <?php if($role['menudelete'] == '1'){ ?>
            <a href="<?php echo base_url('add-doctor'); ?>" class="btn btn-primary" id="add"></i> Add </a>
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
                    <th width="1%" class="icheck"><input type="checkbox" name="chkall" id="chkall" class="minimal chkall" chkurl="<?php echo base_url('admin/doctor/multiple_action');?>"></th>
                    <?php }else{ ?>
                    <th width="1%">No.</th>
                    <?php } ?>

                    <th>Doctor</th>
                    <th width="25%">Specialist</th>
                    <th width="10%">Status</th>
                    <th width="10%">Latest<sub>Update</sub></th>
                    <th width="10%">Update<sub>By</sub></th>

                    <?php if($role['menuedit'] == '1' OR $role['menudelete'] == '1' OR $role['menuread'] == '1'){ ?>
                    <th width="20%">Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
            <?php $no=0;
                foreach ($result as $data): $no++; $encrypt_id = $this->marge->encrypt($data['iddoctor']);
                ?>
                <tr>
                    <?php if($role['menuedit'] == '1' && $role['menudelete'] == '1'){ ?>
                    <td><input type="checkbox" name="cb_menu[]" id="cb_menu[]" data-error=".result" class="minimal chkmenu" value="<?php echo $encrypt_id;?>" ></td>
                    <?php }else{ ?>
                    <td><?php echo $no; ?></td>
                    <?php } ?>

                    <td><?php echo $data['name']; ?></td>

                    <td>
                        <ul style="padding-left: 20px;">
                        <?php 
                            $getSpecialist = $this->mhighlight->getJoinByIdDetail($data['iddoctor'])->result_array();
                            $n = 0;
                            foreach($getSpecialist as $row){ $n++;
                                echo '<li>'.$row['highlight_title'].'</li>';
                            }
                        ?>
                        </ul>
                    </td>

                    <td><?php $stat = array('1' => 'Published', '0' => 'N/A' , '' => 'N/A'); echo $stat[$data['status']]; ?></td>
                    <td><?php echo date('d/F/Y',strtotime($data['latestupdate']));?></td>
                    <td><?php echo $data['updateby'] ?></td>

                    <?php if($role['menuedit'] == '1' OR $role['menudelete'] == '1' OR $role['menuread'] == '1'){ ?>
                    <td align="center">
                        <?php if($role['menuread'] == '1'){ ?>
                        <a href="<?php echo base_url('view-doctor-'.$encrypt_id); ?>" class="btn bg-green btn-xs" data-id="doctor">
                            <i class="fa fa-laptop"></i> View
                        </a>
                        <?php } ?>
                        &nbsp;
                        <?php if($role['menuedit'] == '1'){ ?>
                        <a href="javascript:void(0);" onclick="window.location.href = '<?php echo base_url("edit-doctor-".$encrypt_id); ?>';" class="btn bg-purple btn-xs" data-id="doctor">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <?php } ?>
                        &nbsp;
                        <?php if($role['menudelete'] == '1'){ ?>
                            <?php if($this->session->userdata(_PREFIX.'branch') == '0'){ ?>
                                <a href="javascript:void(0);" onclick="delete_list('<?php echo $encrypt_id;?>','<?php echo base_url('delete-doctor');?>')" class="btn bg-maroon btn-xs delete" data-id="doctor">
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
