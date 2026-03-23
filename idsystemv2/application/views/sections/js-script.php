<!-- <script type="text/javascript"
  src="<?= base_url('assets/admin/vendor/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js'); ?>">
</script> -->

<script>
var dTable = $('#datatable-sections').DataTable({
  "order": [],
  "pageLength": 25,
  // 'columnDefs': [{
  //   'targets': 0,
  //   'checkboxes': {
  //     'selectRow': true
  //   }
  // }]
});

var buttons = new $.fn.dataTable.Buttons(dTable, {
  buttons: [{
      extend: 'excelHtml5',
      className: 'btn',
      exportOptions: {
        columns: 'th:not(:last-child)'
      }
    },
    {
      extend: 'pdfHtml5',
      className: 'btn',
      exportOptions: {
        columns: 'th:not(:last-child)'
      }
    },
    {
      extend: 'print',
      className: 'btn',
      exportOptions: {
        columns: 'th:not(:last-child)'
      }
    }
  ]
}).container().appendTo($('#data-buttons'));


function confirmDelete() {
  return confirm('Are you sure you want to delete this?');
}

function confirmRemove() {
  return confirm('Are you sure you want to remove this member?')
}

$(document).ready(function() {
  $('.js-select').select2();
});
</script>
</body>

</html>