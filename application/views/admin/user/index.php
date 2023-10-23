<section class="content-header">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Utility</a></li>
            <li class="active">Manage User</li>
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
<!--             <a href="#" data-target="#mAdd" data-toggle="modal" class="btn btn-primary" id="add"></i> Add </a>
 -->             User
        </h3> 
    </div>

    <hr style="margin: 0;">

    <div class="box-body">
        <table id="example6" class="table table-bordered table-striped">
            <input type="hidden" id="export-direct" data-url="<?php echo base_url($this->uri->segment(1).'-export');?>" value="1">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <!-- <th>Last Name</th> -->
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Last Login</th>
                    <th>Total Login</th>
                    <!-- <th>Provider</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=0;
                foreach ($result as $data): $no++;
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['firstname']; ?></td>
                    <!-- <td><?php echo $data['lastname']; ?></td> -->
                    <td><?php echo $data['emailaddress']; ?></td>
                    <td><?php echo $data['phone']; ?></td>
                    <td><?php echo date('d-m-Y H:i',strtotime($data['lastlogin']));?></td>
                    <td><?php echo number_format($data['countlogin']);?></td>
                    <!-- <td><?php if($data['oauth_provider'] == ''){ echo 'Web Register'; }else{ echo $data['oauth_provider']; } ;?></td> -->
                    <td align="center">
                        <a href="javascript:void(0);" onclick="view_list('<?php echo $data['id']; ?>','<?php echo base_url('view-user');?>')" class="btn bg-green btn-xs edit" data-id="user">
                            <i class="fa fa-laptop"></i> View
                        </a>
                        <!--
                        &nbsp;
                        <a href="#" class="btn bg-purple btn-xs edit" data-id="user" pk="<?php echo $data['id']; ?>"  url1="view-user" url2="edit-user">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        -->
                        &nbsp;
                        <!-- <a href="#" class="btn bg-maroon btn-xs delete" data-id="user" pk="<?php echo $data['id']; ?>" url="delete-user">
                            <i class="fa fa-trash-o"></i> Delete
                        </a> -->
                    </td>
                </tr>
                <?php
                endforeach;
            ?>
            </tbody>
        </table>

    </div>
</div>
