<script>
function preview() {
  imagePreview.src = URL.createObjectURL(event.target.files[0]);
}

var dTable = $('#datatable-employees').DataTable({
  "order": [],
  "pageLength": 50
});


var buttons = new $.fn.dataTable.Buttons(dTable, {

  buttons: [{
      extend: 'excelHtml5',
      className: 'btn',
      title: 'Employee List',
      exportOptions: {
        columns: 'th:not(:last-child)'
      }
    },
    {
      extend: 'pdfHtml5',
      className: 'btn',
      title: 'Employee List',
      exportOptions: {
        columns: 'th:not(:last-child)'
      }
    },
    {
      extend: 'print',
      className: 'btn',
      title: 'Employee List',
      exportOptions: {
        columns: 'th:not(:last-child)'
      }
    }
  ]
}).container().appendTo($('#data-buttons'));


function confirmDelete() {
  return confirm('Are you sure you want to delete this?');
}
</script>
</body>

</html>