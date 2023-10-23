<!--
<section class="content-header">
	<div class="box box-solid">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i> Utility</a></li>
			<li class="active">Manage timepicker</li>
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
		<table id="example3" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="3%">No.</th>
					<th>name</th>
					<th>Status</th>
					<th>Update By</th>
					<th>Update Date</th>
				</tr>
			</thead>
			<tbody>
			<?php $no=0;
				foreach ($result as $data): $no++;
				?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $data['timepicker_name']; ?></td>
					<td><?php echo $data['timepicker_status']; ?></td>
					<td><?php echo $data['timepicker_updateby']; ?></td>
					<td><?php echo $data['timepicker_updatedate']; ?></td>
				</tr>
				<?php
				endforeach;
			?>
			</tbody>
		</table>
	</div>
</div>
-->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<div class="container well">
			<div class="row">
				<div class="col-md-6">
					<h1>Bootstrap Material DatePicker</h1>
				</div>
			</div>
		</div>
		<div class="container well">
			<div class="row">
				<div class="col-md-6">
					<h2>Date Picker</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-control-wrapper">
						<input type="text" id="date" class="form-control floating-label date-picker" placeholder="Date">
						<input type="text" id="weekday" class="form-control" value="[1,7]">
					</div>
				</div>
				<div class="col-md-6">
					<code>
						<p>Code</p>
						$('#date').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
					</code>
				</div>
			</div>
		</div>
		<div class="container well">
			<div class="row">
				<div class="col-md-6">
					<h2>Time Picker</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-control-wrapper">
						<input type="text" id="time" class="form-control floating-label time-picker" placeholder="Time">
					</div>
				</div>
				<div class="col-md-6">
					<code>
						<p>Code</p>
						$('#time').bootstrapMaterialDatePicker({ date: false });
					</code>
				</div>
			</div>
		</div>
		<div class="container well">
			<div class="row">
				<div class="col-md-6">
					<h2>Date Time Picker</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-control-wrapper">
						<input type="text" id="date-format" class="form-control floating-label date-format-picker" placeholder="Begin Date Time">
					</div>
				</div>
				<div class="col-md-6">
					<code>
						<p>Code</p>
						$('#date-format').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm' });
					</code>
				</div>
			</div>
		</div>
		<div class="container well">
			<div class="row">
				<div class="col-md-6">
					<h2>French Locales (Week starts at Monday)</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-control-wrapper">
						<input type="text" id="date-fr" class="form-control floating-label date-fr-picker" value="18/03/2015 08:00" placeholder="Date de début">
					</div>
				</div>
				<div class="col-md-6">
					<code>
						<p>Code</p>
						$('#date-fr').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', lang : 'fr', weekStart : 1, cancelText : 'ANNULER' });
					</code>
				</div>
			</div>
		</div>
		<div class="container well">
			<div class="row">
				<div class="col-md-6">
					<h2>Min Date set</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-control-wrapper">
						<input type="text" id="min-date" class="form-control floating-label min-date-picker" placeholder="Start Date">
					</div>
				</div>
				<div class="col-md-6">
					<code>
						<p>Code</p>
						$('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });
					</code>
				</div>
			</div>
		</div>
		<div class="container well">
			<div class="row">
				<div class="col-md-6">
					<h2>Events</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<div class="form-control-wrapper">
								<input type="text" id="date-start" class="form-control floating-label date-start-picker" placeholder="Start Date">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-control-wrapper">
								<input type="text" id="date-end" class="form-control floating-label date-end-picker" placeholder="End Date">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<code>
								<p>Code</p>
								$('#date-end').bootstrapMaterialDatePicker({ weekStart : 0 });<br />
								$('#date-start').bootstrapMaterialDatePicker({ weekStart : 0 }).on('change', function(e, date)<br />
								{<br />
									$('#date-end').bootstrapMaterialDatePicker('setMinDate', date);<br />
								});
							</code>
						</div>
					</div>
				</div>
			</div>
		</div>