<section class="content-header" style="padding:0;">
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
            <a href="#" data-target="#mAdd" data-toggle="modal" class="btn btn-primary" id="add"></i> Add </a>
             User
        </h3> 
    </div>

    <hr style="margin: 0;">

    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Group Menu</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=0;
                foreach ($result as $data): $no++;
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['name']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php $det = array('1' => 'Admin', '2' => 'User' ); echo $det[$data['role']];?></td>
                    <!-- <td><img src="<?php echo $data['photo']; ?>" style="max-height: 90px;width:auto;"/></td> -->
                    <td><?php echo $data['groupname'];?></td>
                    <td align="center">
                        <a href="#" class="btn bg-olive btn-xs view" data-id="account" pk="<?php echo $data['username']; ?>" url="view-account">
                            <i class="fa fa-laptop"></i> View
                        </a>
                        &nbsp;
                        <a href="#" class="btn bg-purple btn-xs edit" data-id="account" pk="<?php echo $data['username']; ?>"  url1="view-account" url2="edit-account">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        &nbsp;
                        <a href="#" class="btn bg-maroon btn-xs delete" data-id="account" pk="<?php echo $data['username']; ?>" url="delete-account">
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
