// Call the dataTables jQuery plugin
$(document).ready(function () {
	var table = $('#candidateDataTable').DataTable({
		"dom": "<'row'<'col-sm-6 col-md-3'f><'col-sm-6 col-md-6 text-right'p><'col-sm-12 col-md-3 text-right'B>>" +
			"rt" +
			"<'row'<'col-sm-6 col-md-5'i>>",
		"processing": true,
		"serverSide": true,
		"ajax": APIPATH,
		"lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]],
		"order": [[0, 'desc']],
		"columnDefs": [
			{ "targets": 0, "name": "id", 'searchable': false, 'orderable': false },
			{ "targets": 1, "name": "name", 'searchable': true, 'orderable': true },
			{ "targets": 2, "name": "company_name", 'searchable': true, 'orderable': true },
			{ "targets": 3, "name": "email", 'searchable': true, 'orderable': true },
			{ "targets": 4, "name": "designation", 'searchable': true, 'orderable': true },
			{ "targets": 5, "name": "button", 'searchable': false, 'orderable': false }
		],
		buttons: [
			"pageLength",
			{
				extend: 'excelHtml5',
				text: 'Excel',
				filename: 'MyDataTableExport',
				exportOptions: {
					columns: [0, 1, 2, 3, 4]
				}
			},
			{
				text: 'Reset Filter',
				action: function (e, dt, node, config) {
					dt.search('').columns().search('').draw();
				}
			}
		]
	});

	$('#select_all').on('click', function () {
		$('.row_checkbox').prop('checked', this.checked);
		toggleDeleteButton();
	});

	$('#candidateDataTable tbody').on('change', '.row_checkbox', function () {

		if (!this.checked) {
			$('#select_all').prop('checked', false);
		}

		if ($('.row_checkbox:checked').length === $('.row_checkbox').length) {
			$('#select_all').prop('checked', true);
		}
		toggleDeleteButton();
	});

	function toggleDeleteButton() {
		if ($('.row_checkbox:checked').length > 0) {
			$('.btn-delete-all').prop('disabled', false);
		} else {
			$('.btn-delete-all').prop('disabled', true);
		}
	}

	$('.btn-delete-all').on('click', function (e) {
		e.preventDefault();
		if ($('.row_checkbox:checked').length > 0) {
			$('#confirmDeleteModal').modal('show');
		} else {
			alert('Please select at least one record to delete.');
		}
	});

	$('#confirmDeleteBtn').on('click', function () {
		$('#confirmDeleteModal').modal('hide');
		$('#bulk_delete_form').submit();
	});


	table.on('draw', function () {
		$('#select_all').prop('checked', false);
		toggleDeleteButton();
	});

});
