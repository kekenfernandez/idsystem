<script>
$(document).ready(function() {
  $('.js-select').select2();
});

var attendanceTable = $('#datatable-attendance').DataTable({
  "order": [],
  "pageLength": 10,
});

// let date = new Date().toLocaleDateString();

var buttons = new $.fn.dataTable.Buttons(attendanceTable, {
  buttons: [{
      extend: 'excelHtml5',
      className: 'btn',
      title: 'Attendance Record'
    },
    {
      extend: 'pdfHtml5',
      className: 'btn',
      title: 'Attendance Record'
    },
    {
      extend: 'print',
      className: 'btn',
      title: 'Attendance Record'
    }
  ]
}).container().appendTo($('#data-buttons'));
</script>

</body>

</html>