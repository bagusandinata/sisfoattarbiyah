</div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?php echo base_url("assets/node_modules/jquery/dist/jquery.min.js");?>"></script>
  <script src="<?php echo base_url("assets/node_modules/popper.js/dist/umd/popper.min.js");?>"></script>
  <script src="<?php echo base_url("assets/node_modules/bootstrap/dist/js/bootstrap.min.js");?>"></script>
  <script src="<?php echo base_url("assets/vendor/Select2/dist/js/select2.min.js")?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?php echo base_url("assets/node_modules/chart.js/dist/Chart.min.js");?>"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo base_url("assets/js/off-canvas.js");?>"></script>
  <script src="<?php echo base_url("assets/js/misc.js")?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo base_url("assets/js/dashboard.js");?>"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5NXz9eVnyJOA81wimI8WYE08kW_JMe8g&callback=initMap" async defer></script>
  <script src="<?php echo base_url("assets/js/maps.js");?>"></script>
  <script type="text/javascript">
      var data = [
          {
              id: 0,
              text: 'enhancement'
          },
          {
              id: 1,
              text: 'bug'
          },
          {
              id: 2,
              text: 'duplicate'
          },
          {
              id: 3,
              text: 'invalid'
          },
          {
              id: 4,
              text: 'wontfix'
          }
      ];

      $("#selectjenjang").select2({
        placeholder: "Pilih Jenjang Pendidikan",
        allowClear : true,
        data : data
      });
      $("#selectmapel").select2({
        placeholder: "Pilih Mata Pelajaran",
        allowClear : true,
        data : data
      });
      $("#selectkelas").select2({
        placeholder: "Pilih Kelas",
        allowClear : true,
        data : data
      });

      function selectjenjang(){
        document.getElementById("#selectmapel").disabled=false;
      }
  </script>
  <!-- End custom js for this page-->
</body>

</html>
