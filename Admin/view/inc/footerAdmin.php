<style>
  .member-column {
    border-right: 1px solid #000;
    padding: 10px;
    text-align: center;
  }

  .member-column:last-child {
    border-right: none;
  }

  #back-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: none;
    cursor: pointer;
    font-size: xx-large;

  }

  #back-to-top.show {
    display: block;
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
<a href="#" id="back-to-top" title="Back to top"> <i class="fa-sharp fa-solid fa-circle-up"></i> </a>
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
<!-- Page specific script -->
<script>
  var backToTop = document.querySelector('#back-to-top');

  window.addEventListener('scroll', function() {
    if (window.pageYOffset > 100) {
      backToTop.classList.add('show');
    } else {
      backToTop.classList.remove('show');
    }
  });

  backToTop.addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
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
  document.getElementById('delete-selected').addEventListener('click', function(event) {
    var checkboxes = document.querySelectorAll('.checkbox');
    var checkedCount = 0;
    checkboxes.forEach(function(checkbox) {
      if (checkbox.checked) {
        checkedCount++;
      }
    });

    if (checkedCount === 0) {
      event.preventDefault(); // Ngăn chặn hành động submit form
      alert('Hãy chọn ít nhất một checkbox.');
    } else {
      var confirmation = confirm('Bạn chắc chắn muốn xóa không?');
      if (!confirmation) {
        event.preventDefault(); // Ngăn chặn hành động submit form
        checkboxes.forEach(function(checkbox) {
          checkbox.checked = false; // Đặt lại trạng thái checkbox về không chọn
        });
      }
    }
  });
  document.getElementById('select-all').addEventListener('click', function(event) {
    var checkboxes = document.querySelectorAll('.checkbox');
    var selectAllCheckbox = event.target;
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = selectAllCheckbox.checked; // Đặt trạng thái checkbox theo trạng thái của checkbox "Chọn Tất Cả"
    });
  });
</script>

<script>
  $(function() {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>

</body>

</html>