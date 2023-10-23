<section class="content-header" style="padding:0;">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Main Navigation</a></li>
            <li>Category</li>
            <li class="active">Doctor Category</li>
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
             Doctor Category
        </h3> 
    </div>

    <hr style="margin: 0;">

    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Doctor Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=0;
                foreach ($result as $data): $no++;
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['namecategory']; ?></td>
                    <td align="center">
                        <a href="#" class="btn bg-purple btn-xs edit" data-id="doctorcategory" pk="<?php echo $data['id']; ?>"  url1="view-doctorcategory" url2="edit-doctorcategory">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        &nbsp;
                        <a href="#" class="btn bg-maroon btn-xs delete" data-id="doctorcategory" pk="<?php echo $data['id']; ?>" url="delete-doctorcategory">
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
