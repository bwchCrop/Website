<section class="content-header">
	<div class="box box-solid">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Utility</a></li>
			<li class="active">Manage Patient</li>
		</ol>
	</div>
</section>

<div class="box">
	<div class="box-header">
		<?php echo $this->session->flashdata('message');?>
		<h3 class="box-title">&nbsp;
			<?php echo $title;?>
		</h3> 
	</div>

	<hr class="separator">

	<div class="box-body">
        <style>.toolbar-action{display: flex;}</style>
		<table id="example7" class="table table-bordered table-striped">
			<thead>
				<tr>
                    <?php if($role['menuedit'] == '1' && $role['menudelete'] == '1'){ ?>
                    <th width="1%" class="icheck"><input type="checkbox" name="chkall" id="chkall" class="minimal chkall" chkurl="<?php echo base_url('admin/patient/multiple_action');?>"></th>
                    <?php }else{ ?>
                    <th width="1%">No.</th>
                    <?php } ?>

					<th>Patient</th>
					<th>Birthday (Age)</th>
					<th>User</th>
                    <th>Last Doctor Visit</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php $no=0;
				foreach ($result as $data): $no++; $encrypt_id = $this->marge->encrypt($data['patient_id']);
                    $getPatient = $this->mpatient->getTransByPatient($data['patient_id'])->row_array();

                    if(count($getPatient)){
                        $lastvisit  = $this->marge->date_ID($getPatient['transdate'],'d F Y');
                        $visit = $getPatient['name'].' - '.$lastvisit;                        
                    }else{
                        $visit = '-';
                    }
				?>
				<tr>
                    <?php if($role['menuedit'] == '1' && $role['menudelete'] == '1'){ ?>
                    <td><input type="checkbox" name="cb_menu[]" id="cb_menu[]" data-error=".result" class="minimal chkmenu" value="<?php echo $data['patient_id'];?>" ></td>
                    <?php }else{ ?>
                    <td><?php echo $no; ?></td>
                    <?php } ?>

					<td><?php echo $data['patient_name']; ?></td>
					<td><?php echo $this->marge->date_ID($data['patient_birthday'],'d F Y').' <b>('.$this->marge->age($data['patient_birthday']).'Tahun)</b>';?></td>
					<td><?php echo $data['emailaddress']; ?></td>
                    <td><?php echo $visit;?></td>
					<?php if($role['menuedit'] == '1' OR $role['menudelete'] == '1' OR $role['menuread'] == '1'){ ?>
					<td align="center">
                        <a href="javascript:void(0);" onclick="view_list('<?php echo $data['patient_id']; ?>','<?php echo base_url('view-patient');?>')" class="btn bg-green btn-xs edit" data-id="patient">
                            <i class="fa fa-laptop"></i> View
                        </a>
                        &nbsp;
						<?php if($role['menudelete'] == '1'){ ?>
							<a href="javascript:void(0);" onclick="delete_list('<?php echo $data['patient_id'];?>','<?php echo base_url('delete-patient');?>')" class="btn bg-maroon btn-xs delete" data-id="patient">
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
</div>
