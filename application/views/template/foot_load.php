<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<!-- jQuery Validation -->
<script src="<?php echo base_url('assets/admin/dist/js/jquery.validate.min.js');?>"></script>
<!-- Additional Validation -->
<script src="<?php echo base_url('assets/admin/dist/js/additional-methods.min.js');?>"></script>
<!-- jQuery MD5 -->
<script src="<?php echo base_url('assets/admin/dist/js/jquery.md5.js');?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/admin/js/jquery-ui.min.js');?>"></script>
<!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/admin/dist/js/app.min.js');?>"></script>
<!-- Timepicker -->
<script src="<?php echo base_url('assets/admin/js/ripples.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/material.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/moment-with-locales.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/bootstrap-material-datetimepicker.js'); ?>"></script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php //echo base_url('assets/dist/js/demo.js');?>"></script> -->

<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url('assets/plugins/colorpicker/bootstrap-colorpicker.min.js');?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<!-- Fancybox -->
<script src="<?php echo base_url('assets/plugins/fancybox/source/jquery.fancybox.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/fancybox/source/jquery.fancybox.pack.js'); ?>"></script>
<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url('assets/plugins/fullcalendar/fullcalendar.min.js'); ?>"></script>
<!-- Editor tinymce -->
<script src="<?php echo base_url('assets/plugins/tinymce/tinymce.min.js'); ?>"></script>
<!-- Multiple Select Dropdown -->
<script src="<?php echo base_url('assets/admin/js/bootstrap-multiselect.js');?>"></script>
<!-- My .js -->
<script src="<?php echo base_url('assets/admin/js/myjs.js?'.date('Ymdhis')); ?>"></script>

<?php 
if(isset($js)){
	echo $js;
} 
?>