$(function(){

    // filter elements
    var tahunajaran_id = $('#form-filter').find('#tahunajaran_id');
    var tingkat_id = $('#form-filter').find('#tingkat_id');
    var kelas_id = $('#form-filter').find('#kelas_id');

    var tableOutKelas;
    var tableInKelas;


    function loadSelectKelas(){

        if(tahunajaran_id.val() !== '' && tingkat_id.val() !== ''){

            kelas_id.find('option').remove().end().append('<option value=""></option>');
            
            $.ajax({
                url: '/iq/kelas/json_where_tahunajaran_id_tingkat_id',
                type: 'GET',
                data: {
                    tahunajaran_id: tahunajaran_id.val(),
                    tingkat_id: tingkat_id.val(),
                },
                success: function(result){
                    result.forEach(function(kelas){
                        kelas_id.append('<option value="'+ kelas.id +'">'+ kelas.kelas +'</option>');
                    });
                }
            })
        }
    }

    function loadTable(){

        if(tahunajaran_id.val() !== '' && tingkat_id.val() !== '' && kelas_id.val() !== ''){
            
            $('#row-table').show();
            $('#panel-in-kelas').find('span#nama-kelas').html(kelas_id.find('option:selected').text());

            tableOutKelas = $('#table-out-kelas').bootstrapTable('destroy').bootstrapTable({
                classes: 'table table-striped table-no-bordered',
                toolbar: '#table-toolbar',
                url: '/iq/penempatansiswa/json_out_kelas',
                queryParams: function(params) {
                    params.tingkat_id = tingkat_id.val();
                    params.tahunajaran_id = tahunajaran_id.val();
                    console.log(params);
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
                    field: 'nisn',
                    title: 'NISN',
                    sortable: true,
                }, {
                    field: 'nis_lokal',
                    title: 'NIS Lokal',
                    sortable: true,
                }, {
                    field: 'nama',
                    title: 'Nama',
                    sortable: true,
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
                    field: 'id',
                    title: 'Action',
                    class: 'text-nowrap',
                    align: 'center',
                    formatter: function(value, row, index){
                        return `
                            <button type="button" class="btn btn-primary btn-xs btn-in" data-id="${value}"><i class="fa fa-arrow-right"></i></button>
                        `;
                    }
                }]
            });

            tableInKelas = $('#table-in-kelas').bootstrapTable('destroy').bootstrapTable({
                classes: 'table table-striped table-no-bordered',
                toolbar: '#table-toolbar',
                url: '/iq/penempatansiswa/json_in_kelas',
                queryParams: function(params) {
                    params.kelas_id = kelas_id.val();
                    console.log(params);
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
                    align: 'center',
                    formatter: function(value, row, index){
                        return `
                            <button type="button" class="btn btn-danger btn-xs btn-out" data-id="${value}" data-siswa_id="${row.siswa_id}"><i class="fa fa-arrow-left"></i></button>
                        `;
                    }
                }, {
                    field: 'nisn',
                    title: 'NISN',
                    sortable: true,
                }, {
                    field: 'nis_lokal',
                    title: 'NIS Lokal',
                    sortable: true,
                }, {
                    field: 'nama',
                    title: 'Nama',
                    sortable: true,
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
                }]
            });
        }else{
            $('#row-table').hide();
        }
    }

    

    tahunajaran_id.on('change', loadSelectKelas);
    tingkat_id.on('change', loadSelectKelas);

    tahunajaran_id.on('change', loadTable);
    tingkat_id.on('change', loadTable);
    kelas_id.on('change', loadTable);

    $(document).on('click', '.btn-in', function(){
        
        $.ajax({
            url: '/iq/penempatansiswa/siswa_in',
            type: 'POST',
            data: {
                siswa_id: $(this).data('id'),
                kelas_id: kelas_id.val()
            },
            success: function(result){
                if(result == 'success'){
                    loadTable();
                }
            }
        });
    });

    $(document).on('click', '.btn-out', function(){
        $.ajax({
            url: '/iq/penempatansiswa/siswa_out',
            type: 'POST',
            data: {
                id: $(this).data('id'), // penempatansiswa.id
                siswa_id: $(this).data('siswa_id') 
            },
            success: function(result){
                if(result == 'success'){
                    loadTable();
                }
            }
        });
    });

   

    var btnAdd = $('#btn-add');
    var modalAdd = $('#modal-add');
    var formAdd = $('#form-add');

    var modalEdit = $('#modal-edit');
    var formEdit = $('#form-edit');

    var modalDelete = $('#modal-delete');
    var formDelete = $('#form-delete');


	

    btnAdd.on('click', function(e){
        e.preventDefault();
        modalAdd.modal('show');
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


});