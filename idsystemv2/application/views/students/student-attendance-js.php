<script>
var attendanceTable = $('#datatable-attendance').DataTable({
  "order": [],
  "pageLength": 50,
});

var buttons = new $.fn.dataTable.Buttons(attendanceTable, {
  buttons: [{
      extend: 'excelHtml5',
      className: 'btn',
      title: '<?= $student['full_name'] .' '. $student['grade_level'].'-'.$student['section_name'] ?>'
    },
    {
      extend: 'pdfHtml5',
      className: 'btn',
      title: '<?= $student['full_name'] .' '. $student['grade_level'].'-'.$student['section_name'] ?>'
    },
    {
      extend: 'print',
      className: 'btn',
      title: '<?= $student['full_name'] .' '. $student['grade_level'].'-'.$student['section_name'] ?>'
    }
  ]
}).container().appendTo($('#data-buttons'));
</script>
</body>

</html>