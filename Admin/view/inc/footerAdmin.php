<style>
  .member-column {
    border-right: 1px solid #000;
    padding: 10px;
    text-align: center;
  }

  .member-column:last-child {
    border-right: none;
  }
</style>
<footer class="main-footer">
  <div class="container">
    <div class="row text-info-emphasis text-uppercase ">
      <div class="col">
        <div class="member-column ">
          <i class="fa-solid fa-laptop-code"></i> Nguyễn Văn Dụng
        </div>
      </div>
      <div class="col">
        <div class="member-column">
          <i class="fa-solid fa-laptop-code"></i> Phan Văn Hưng
        </div>
      </div>
      <div class="col">
        <div class="member-column">
          <i class="fa-solid fa-laptop-code"></i> Võ Văn Chính
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>

<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(document).ready(function() {

    $('.editbtn1').on('click', function() {

      $('#editmodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.find(".td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#update_id').val(data[0]);
      $('#hname').val(data[1]);
      $('#hloaisp').val(data[2]);
      $('#hhangsp').val(data[3]);
      $('#hgia').val(data[4]);
      $('#hgiasale').val(data[5]);
      $('#image').val(data[6]);


    });
  });
</script>
<script>
  $(document).ready(function() {

    $('.hahaha').on('click', function() {

      $('#editmodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.find(".td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#update_id').val(data[0]);
      $('#nameacount').val(data[1]);
      $('#pass').val(data[2]);
      $('#username').val(data[3]);
      $('#phone').val(data[4]);
      $('#email').val(data[5]);
      $('#date').val(data[6]);
      $('#address').val(data[7]);


    });
  });
</script>
<script>
  $(document).ready(function() {

    $('.deletebtn').on('click', function() {

      $('#deletemodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.find(".td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_id').val(data[0]);

    });
  });
</script>

<script>
  $(document).ready(function() {

    $('.editbtn').on('click', function() {

      $('#editmodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.find(".td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);
      $('#id').val(data[0]);
      $('#name').val(data[1]);
      $('#country').val(data[2]);
      $('#date').val(data[3]);



    });
  });
</script>
<script>
  $(function() {
    $("#example1")
      .DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
      })
      .buttons()
      .container()
      .appendTo("#example1_wrapper .col-md-6:eq(0)");
    $("#example2").DataTable({
      paging: true,
      lengthChange: false,
      searching: false,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
    });
  });
</script>

<script>
  function updateInput(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var selectedText = selectedOption.text;
    var selectedValue = selectedOption.value;
    document.getElementById("hhangsp").value = selectedText;
    document.getElementById("hang_id").value = selectedValue;
  }
</script>
<script>
  function updateInput1(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var selectedText = selectedOption.text;
    var selectedValue = selectedOption.value;
    document.getElementById("hloaisp").value = selectedText;
    document.getElementById("loai_id").value = selectedValue;
  }
</script>
<script>
  $(function() {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>

</body>

</html>