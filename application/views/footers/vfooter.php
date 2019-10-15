<!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?=base_url()?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
 <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href="#">TeamIS2020</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
  <script type="text/javascript">
    $( document ).ready(
      $(function () {
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    })
        //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  }));
  </script>
</body>
</html>
