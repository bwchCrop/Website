<section class="content-header" style="padding:0;">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Main Navigation</a></li>
            <li>Category</li>
            <li class="active">Item Category</li>
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
             Item Category
        </h3> 
    </div>

    <hr style="margin: 0;">

    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item Category</th>
                    <th>Group Item</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=0;
                foreach ($result as $data): $no++;
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['subcategory2']; ?></td>
                    <td><?php echo $data['subcategory1']; ?></td>
                    <td align="center">
                        <!--a href="#" class="btn bg-olive btn-xs view" data-id="category" pk="<?php echo $data['id']; ?>" url="view-category">
                            <i class="fa fa-laptop"></i> View
                        </a-->
                        &nbsp;
                        <a href="#" class="btn bg-purple btn-xs edit" data-id="itemcategory" pk="<?php echo $data['id']; ?>"  url1="view-itemcategory" url2="edit-itemcategory">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        &nbsp;
                        <a href="#" class="btn bg-maroon btn-xs delete" data-id="itemcategory" pk="<?php echo $data['id']; ?>" url="delete-itemcategory">
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
