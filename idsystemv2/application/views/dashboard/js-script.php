<script>
var dashboardTable = $('#datatable-dashboard').DataTable({
  "order": [],
  "pageLength": 50,
});

let date = new Date().toLocaleDateString();

var buttons = new $.fn.dataTable.Buttons(dashboardTable, {
  buttons: [{
      extend: 'excelHtml5',
      className: 'btn',
      title: 'Daily Record_' + date
    },
    {
      extend: 'pdfHtml5',
      className: 'btn',
      title: 'Daily Record_' + date
    },
    {
      extend: 'print',
      className: 'btn',
      title: 'Daily Record_' + date
    }
  ]
}).container().appendTo($('#data-buttons'));


function preview() {
  imagePreview.src = URL.createObjectURL(event.target.files[0]);
}

function confirmDelete() {
  return confirm('Are you sure you want to delete this?');
}
</script>
</body>

</html>