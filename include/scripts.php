
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= $base_dir ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= $base_dir ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= $base_dir ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= $base_dir ?>/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= $base_dir ?>/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= $base_dir ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= $base_dir ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= $base_dir ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= $base_dir ?>/plugins/moment/moment.min.js"></script>
<script src="<?= $base_dir ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= $base_dir ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= $base_dir ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= $base_dir ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $base_dir ?>/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= $base_dir ?>/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $base_dir ?>/dist/js/demo.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= $base_dir ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){
    brojac = 1;
    $("#addNew").click(function(){
        $('#novaOsobina').append('<div class="form-group"><label for="inputName">Osobina'+brojac+'</label><input type="text" id="'+brojac+'" class="form-control" name="title" value=""></div> <input type="hidden" id="Osobina'+brojac+'" value="'+brojac+'">'); 
      brojac++;
    });

});
</script>
</body>
</html>