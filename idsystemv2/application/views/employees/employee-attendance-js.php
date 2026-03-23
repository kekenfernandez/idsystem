<script>
var attendanceTable = $('#datatable-employee').DataTable({
  "order": [],
  "pageLength": 50,
});

var buttons = new $.fn.dataTable.Buttons(attendanceTable, {
  buttons: [{
      extend: 'excelHtml5',
      className: 'btn',
      title: '<?= $employee['full_name']; ?>'
    },
    {
      extend: 'pdfHtml5',
      className: 'btn',
      title: '<?= $employee['full_name']; ?>'
    },
    {
      extend: 'print',
      className: 'btn',
      title: '<?= $employee['full_name']; ?>'
    }
  ]
}).container().appendTo($('#data-buttons'));
</script>
</body>

</html>