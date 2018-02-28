$(function(){

    var btnPrint = $('#btn-print');
    var modalPrint = $('#modal-print');
    var formPrint = $('#form-print');
    btnPrint.on('click', function(e){
        e.preventDefault();
        modalPrint.modal('show');
    });

    formPrint.on('submit', function(e){
        var tahunajaran_id = formPrint.find('#tahunajaran_id');
        var tingkat_id = formPrint.find('#tingkat_id');

        formPrint.find('.has-error').removeClass('has-error').end().find('.help-block').remove();

        if(tahunajaran_id.val() == ''){
            console.log('tahunajaran_id harus dipilih');
            tahunajaran_id.parent().addClass('has-error').append('<p class="help-block">Tahun Ajaran harus dipilih</p>');
            e.preventDefault();
        }
        if(tingkat_id.val() == ''){
            console.log('tingkat_id harus dipilih');
            tingkat_id.parent().addClass('has-error').append('<p class="help-block">Tingkat harus dipilih</p>');
            e.preventDefault();
        }
    });

    var btnAdd = $('#btn-add');
    var modalAdd = $('#modal-add');
    var formAdd = $('#form-add');
    modalAdd.on('hidden.bs.modal', function (e) {
        formAdd.find('.has-error').removeClass('has-error');
        formAdd.find('.help-block').remove();
    });

    var modalEdit = $('#modal-edit');
    var formEdit = $('#form-edit');
    modalEdit.on('hidden.bs.modal', function (e) {
        formEdit.find('.has-error').removeClass('has-error');
        formEdit.find('.help-block').remove();
    });
    

    var modalDelete = $('#modal-delete');
    var formDelete = $('#form-delete');

	var table = $('#table').bootstrapTable({
        classes: 'table table-striped table-no-bordered',
        toolbar: '#table-toolbar',
        url: '/iq/siswa/json',
        
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
                    <button type="button" class="btn btn-danger btn-xs btn-delete" data-id="${value}" data-identifier="${row.nama}"><i class="fa fa-trash"></i> Hapus</button>
                    <a href="/iq/Trackrecord/?siswa_id=${row.id}" class="btn btn-primary btn-xs btn-trackrecord"><i class="fa fa-history"></i> Track Record</a>
                `;
            }
        }, {
            field: 'nis_lokal',
            title: 'NIS Lokal',
            sortable: true,
        }, {
            field: 'nisn',
            title: 'NISN',
            sortable: true,
        },  {
            field: 'nama',
            title: 'Nama',
            sortable: true,
        }, {
            field: 'nama_hijaiyah',
            title: 'Nama Hijaiyah',
            sortable: true,
            formatter: function(value, row, index){
                if(value){
                    return '<span style="font-size: 20px">'+ value +'</span>';
                }else{
                    return '-';
                }
                
            }
        }, {
            field: 'jenis_kelamin',
            title: 'Jenis Kelamin',
            sortable: true,
            formatter: function(value, row, index){

                if(value == 'l'){
                    return 'Laki-laki';
                }else if(value == 'p'){
                    return 'Perempuan';
                }else{
                    return 'Tidak Diketahui';
                }
            }
        }, {
            field: 'tingkat',
            title: 'Tingkat',
            sortable: true,
        }, ]
    });

    btnAdd.on('click', function(e){
        e.preventDefault();
        modalAdd.modal('show');
        console.log(formAdd.find('#nis_lokal'));
        formAdd.find('#nis_lokal').focus();
    });

    formAdd.on('submit', function(e){
        e.preventDefault();
        formAdd.find('.help-block').remove();
        formAdd.find('.form-group').removeClass('has-error');
        $.ajax({
            url: '/iq/siswa/create',
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
            url: '/iq/siswa/find',
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
            url: '/iq/siswa/update',
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
            url: '/iq/siswa/delete',
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


    formAdd.find('#status_siswa').on('change', function(e){
        if($(this).val() == 3){
            formAdd.find('#asal_sekolah_pindah').prop('disabled', false);
        }else{
            // console.log('else');
            formAdd.find('#asal_sekolah_pindah option:first').prop('selected', true);
            formAdd.find('#asal_sekolah_pindah').prop('disabled', true);
        }
    });


});