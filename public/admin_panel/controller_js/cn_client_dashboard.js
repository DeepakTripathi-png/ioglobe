$(function (){
    var table = $('#cims_data_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/admin/dashboard/client_dashboard_data_table",
            data: function (d) {
                d.master_device_id = $('#device_id').val(); 
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'io_slave_name', name: 'io_slave_name' },
            { data: 'slave_device_image', name: 'slave_device_image' },
            { data: 'slave_device_name', name: 'slave_device_name' },
            { data: 'io_device_status', name: 'io_device_status' },
            { data: 'acknowledge', name: 'acknowledge' }
        ]
    });

    table.ajax.reload(null, false);
});
