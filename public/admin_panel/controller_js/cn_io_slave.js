// $(function () {
//     var table = $('#cims_data_table').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: {
//             url: base_url + "/admin/io-slave/data-table",
//             data: function (d) {
//                 d.master_device_name = $('#master_device_name').val();
//                 d.master_device_id = $('#master_device_id').val();
//                 d.slave_device_name = $('#slave_device_name').val();
//             }
//         },
//         columns: [{
//             data: 'DT_RowIndex',
//             name: 'DT_RowIndex'
//         },


//         {
//             data: 'master_device_name',
//             name: 'master_device_name'
//         },


//         {
//             data: 'master_device_id',
//             name: 'master_device_id'
//         },

        
//         {
//             data: 'io_slave_name',
//             name: 'io_slave_name'
//         },

//         {
//             data: 'slave_device_image',
//             name: 'slave_device_image'
//         },

//         {
//             data: 'slave_device_name',
//             name: 'slave_device_name'
//         },

//         {
//             data: 'io_device_status',
//             name: 'io_device_status'
//         },

//         {
//             data: 'status',
//             name: 'status',
//             orderable: false,
//             searchable: false
//         },
//         {
//             data: 'action',
//             name: 'action',
//             orderable: false,
//             searchable: false
//         },
//         ]
//     });

//     function reload_table() {
//         table.DataTable().ajax.reload(null, false);
//     }

//     $('#master_device_name, #master_device_id, #slave_device_name').change(function (){
//         table.ajax.reload(null, false);
//     });

// })



// $(function () {
//     var table = $('#cims_data_table').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: {
//             url: base_url + "/admin/io-slave/data-table",
//             data: function (d) {
//                 d.master_device_name = $('#master_device_name').val();
//                 d.master_device_id = $('#master_device_id').val();
//                 d.slave_device_name = $('#slave_device_name').val();
//             }
//         },
//         columns: [
//             { data: 'DT_RowIndex', name: 'DT_RowIndex' },
//             { data: 'master_device_name', name: 'master_device_name' },
//             { data: 'master_device_id', name: 'master_device_id' },
//             { data: 'io_slave_name', name: 'io_slave_name' },
//             { data: 'slave_device_image', name: 'slave_device_image' },
//             { data: 'slave_device_name', name: 'slave_device_name' },
//             { data: 'io_device_status', name: 'io_device_status' },
//             { data: 'status', name: 'status', orderable: false, searchable: false },
//             { data: 'action', name: 'action', orderable: false, searchable: false },
//         ]
//     });

//     // Reload table when any filter changes
//     $('#master_device_name, #master_device_id, #slave_device_name').on('change', function () {
//         table.ajax.reload(null, false);
//     });
// });


$(function () {
    var table = $('#cims_data_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "/admin/io-slave/data-table",
            data: function (d) {
                d.master_device_name = $('#master_device_name').val();
                d.master_device_id = $('#master_device_id').val();
                d.slave_device_name = $('#slave_device_name').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'master_device_name', name: 'master_device_name' },
            { data: 'master_device_id', name: 'master_device_id' },
            { data: 'io_slave_name', name: 'io_slave_name' },
            { data: 'slave_device_image', name: 'slave_device_image' },
            { data: 'slave_device_name', name: 'slave_device_name' },
            { data: 'io_device_status', name: 'io_device_status' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    setInterval(function () {
        table.ajax.reload(null, false); 
    }, 1000); 
    
    $('#master_device_name, #master_device_id, #slave_device_name').on('change', function () {
        table.ajax.reload(null, false);
    });
});
