$(function () {
    var table = $('#cims_data_table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/device/data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        
        {
            data: 'site_name',
            name: 'site_name'
        },

        {
            data: 'site_address',
            name: 'site_address'
        },

        // {
        //     data: 'device_type',
        //     name: 'device_type'
        // },

        {
            data: 'device_id',
            name: 'device_id'
        },

        
        {
            data: 'date',
            name: 'date'
        },
      
        {
            data: 'status',
            name: 'status',
            orderable: false,
            searchable: false
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
        ]
    });

    function reload_table() {
        table.DataTable().ajax.reload(null, false);
    }
})