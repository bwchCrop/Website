<section class="content-header" style="padding:0;">
    <div class="box box-solid">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Main Navigation</a></li>
            <li>Service</li>
            <li class="active">Newsletter</li>
        </ol>
    </div>
</section>

<div class="box">

    <div class="overlay">
      <i class="fa fa-refresh fa-spin"></i>
    </div>

    <div class="box-header">
        <?php echo $this->session->flashdata('message_');?>
        <h3 class="box-title">&nbsp;
            <a href="#" class="btn btn-primary" id="export"></i> Export </a>
             Newsletter
        </h3> 
    </div>

    <hr style="margin: 0;">

    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Newsletter</th>
                    <th>Status</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
            <?php $no=0;
                foreach ($result as $data): $no++;
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['newsletter']; ?></td>
                    <td><?php if($data['status'] == '1'){ echo 'Berlangganan'; }else{ echo 'Tidak Berlangganan' ;}; ?></td>
                    <!-- <td align="center">
                        <a href="#" class="btn bg-olive btn-xs view" data-id="newsletter" pk="<?php echo $data['idnewsletter']; ?>" url="view-newsletter">
                            <i class="fa fa-laptop"></i> View
                        </a>
                        &nbsp;
                        <a href="#" class="btn bg-purple btn-xs edit" data-id="category" pk="<?php echo $data['id']; ?>"  url1="view-category" url2="edit-category">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        &nbsp;
                        <a href="#" class="btn bg-maroon btn-xs delete" data-id="category" pk="<?php echo $data['id']; ?>" url="delete-category">
                            <i class="fa fa-trash-o"></i> Delete
                        </a>
                    </td> -->
                </tr>
                <?php
                endforeach;
            ?>
            </tbody>
        </table>

    </div>
</div>

<script src="<?php echo base_url('assets/front/js/jquery.min.js');?>" ></script>
<script>
    $(function(){
        $('#export').click(function(){
            $(".overlay").show();
            $.post('<?php echo site_url('export-newsletter');?>',
                  {id:'1'},
                  function(data){
                    $(".overlay").hide();
                    if(data != 'Failed'){
                      // $("#deleteModal").modal('hide');
                      // $('#successModal').modal({backdrop: 'static', keyboard: false})
                      // modal.find('.modal-body').text('Data Deleted..');
                      window.location.href = "<?php echo site_url('download-newsletter-');?>"+data;
                    }else{
                      $('#successModal').modal({backdrop: 'static', keyboard: false})
                      modal.find('.modal-body').text('Failed..');
                    }
                  }  
            );
        });
    });

   // <a href="'.base_url().'download/textfile/'.$msg['filename'].'/'.$TYPE.'">Klik Disini untuk download textfile</a>
</script>
