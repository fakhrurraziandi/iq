$(function(){

    var btnAddKelompokmapel = $('#btn-add-kelompokmapel');
    var modalAddKelompokmapel = $('#modal-add-kelompokmapel');
    var formAddKelompokmapel = $('#form-add-kelompokmapel');

    var modalEditKelompokmapel = $('#modal-edit-kelompokmapel');
    var formEditKelompokmapel = $('#form-edit-kelompokmapel');

    var modalDeleteKelompolmapel = $('#modal-delete-kelompokmapel');
    var formDeleteKelompokmapel = $('#form-delete-kelompokmapel');

	var tableKelompokMapel = $('#table-kelompokmapel').bootstrapTable({
        classes: 'table table-striped table-no-bordered',
        toolbar: '#table-toolbar-kelompokmapel',
        url: '/iq/kelompokmapel/json',
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
                    <button type="button" class="btn btn-success btn-xs btn-edit-kelompokmapel" data-id="${value}"><i class="fa fa-pencil"></i> Ubah</button>
                    <button type="button" class="btn btn-danger btn-xs btn-delete-kelompokmapel" data-id="${value}" data-identifier="${row.kelompokmapel}"><i class="fa fa-trash"></i> Hapus</button>
                `;
            }
        }, {
            field: 'kelompokmapel',
            title: 'Kelompok Mapel',
            sortable: true,
        }]
    });

    btnAddKelompokmapel.on('click', function(e){
        e.preventDefault();
        modalAddKelompokmapel.modal('show');
    });

    formAddKelompokmapel.on('submit', function(e){
        e.preventDefault();
        formAddKelompokmapel.find('.help-block').remove();
        formAddKelompokmapel.find('.form-group').removeClass('has-error');
        $.ajax({
            url: '/iq/kelompokmapel/create',
            type: 'POST',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    table.bootstrapTable('refresh');
                    modalAddKelompokmapel.modal('hide');
                    formAddKelompokmapel.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formAddKelompokmapel.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    });

    $(document).on('click', '.btn-edit-kelompokmapel', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/iq/kelompokmapel/find',
            type: 'GET',
            data: {
                id: id
            },
            success: function(result){
                if(result !== ''){
                    $.each(result, function(key, value){
                        formEditKelompokmapel.find('#' + key).val(value);
                    });
                    modalEditKelompokmapel.modal('show');
                }
            }
        });
    });

    formEditKelompokmapel.on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/iq/kelompokmapel/update',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    table.bootstrapTable('refresh');
                    modalEditKelompokmapel.modal('hide');
                    formEditKelompokmapel.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formEditKelompokmapel.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    });


    $(document).on('click', '.btn-delete-kelompokmapel', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var identifier = $(this).data('identifier');

        formDeleteKelompokmapel.find('#id').val(id);
        formDeleteKelompokmapel.find('#identifier').html(identifier);
        modalDeleteKelompolmapel.modal('show');
    });

    formDeleteKelompokmapel.on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/iq/kelompokmapel/delete',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    table.bootstrapTable('refresh');
                    modalDeleteKelompolmapel.modal('hide');
                    formDeleteKelompokmapel.trigger('reset');
                }
            }
        })
    });


});