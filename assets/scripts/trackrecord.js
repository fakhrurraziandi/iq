$(function(){

    var btnAdd = $('#btn-add');
    var modalAdd = $('#modal-add');
    var formAdd = $('#form-add');

    var modalEdit = $('#modal-edit');
    var formEdit = $('#form-edit');

    var modalDelete = $('#modal-delete');
    var formDelete = $('#form-delete');

	var table = $('#table').bootstrapTable({
        classes: 'table table-striped table-no-bordered',
        toolbar: '#table-toolbar',
        url: '/iq/trackrecord/json',
        queryParams: function(params) {
            params.siswa_id = $('#hidden_siswa_id').val();
            return params;
        },
        sidePagination: 'server',
        pagination: true,
        paginationLoop: true,
        pageList: [5, 10, 20, 50, 100, 200],
        search: true,
        showRefresh: true,
        checkbox: true,
        columns: [{
            field: 'id',
            title: 'Action',
            class: 'text-nowrap',
            formatter: function(value, row, index){
                return `
                    <button type="button" class="btn btn-success btn-xs btn-edit" data-id="${value}"><i class="fa fa-pencil"></i> Ubah</button>
                    <button type="button" class="btn btn-danger btn-xs btn-delete" data-id="${value}" data-identifier="${row.deskripsi}"><i class="fa fa-trash"></i> Hapus</button>
                `;
            }
        }, {
            field: 'tanggal',
            title: 'Tanggal',
            sortable: true,
        }, {
            field: 'jenistrackrecord',
            title: 'Jenis',
            sortable: true,
        }, {
            field: 'deskripsi',
            title: 'Deskripsi',
            sortable: true,
        }]
    });

    btnAdd.on('click', function(e){
        e.preventDefault();
        modalAdd.modal('show');
    });

    formAdd.on('submit', function(e){
        e.preventDefault();
        formAdd.find('.help-block').remove();
        formAdd.find('.form-group').removeClass('has-error');
        $.ajax({
            url: '/iq/trackrecord/create',
            type: 'POST',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    table.bootstrapTable('refresh');
                    modalAdd.modal('hide');
                    formAdd.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formAdd.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    });

    $(document).on('click', '.btn-edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/iq/trackrecord/find',
            type: 'GET',
            data: {
                id: id
            },
            success: function(result){
                if(result !== ''){
                    $.each(result, function(key, value){
                        formEdit.find('#' + key).val(value);
                    });
                    modalEdit.modal('show');
                }
            }
        });
    });

    formEdit.on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/iq/trackrecord/update',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    table.bootstrapTable('refresh');
                    modalEdit.modal('hide');
                    formEdit.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formEdit.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    });


    $(document).on('click', '.btn-delete', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var identifier = $(this).data('identifier');

        formDelete.find('#id').val(id);
        formDelete.find('#identifier').html(identifier);
        modalDelete.modal('show');
    });

    formDelete.on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/iq/trackrecord/delete',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    table.bootstrapTable('refresh');
                    modalDelete.modal('hide');
                    formDelete.trigger('reset');
                }
            }
        })
    });

    modalAdd.on('hidden.bs.modal', function(e){
        formAdd.trigger('reset');
    });
    modalEdit.on('hidden.bs.modal', function(e){
        formEdit.trigger('reset');
    });


});