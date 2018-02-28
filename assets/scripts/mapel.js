$(function(){


    // filter elements
    var tahunajaran_id = $('#form-filter').find('#tahunajaran_id');
    var semester_id = $('#form-filter').find('#semester_id');
    var tingkat_id = $('#form-filter').find('#tingkat_id');
    var kelas_id = $('#form-filter').find('#kelas_id');

    var tableKelompokMapel;
    var table;


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
            });
        }
    }

    function loadSelectSemester(){

        if(tahunajaran_id.val() !== ''){

            semester_id.find('option').remove().end().append('<option value=""></option>');
            
            $.ajax({
                url: '/iq/semester/json_where_tahunajaran_id',
                type: 'GET',
                data: {
                    tahunajaran_id: tahunajaran_id.val(),
                },
                success: function(result){
                    result.forEach(function(kelas){
                        semester_id.append('<option value="'+ kelas.id +'">'+ kelas.semester +'</option>');
                    });
                }
            })
        }
    }

    function loadTable(){

        if(tahunajaran_id.val() !== '' && semester_id.val() !== '' && tingkat_id.val() !== '' && kelas_id.val() !== ''){
            
            $('#row-table').show();

            tableKelompokMapel = $('#table-kelompokmapel').bootstrapTable('destroy').bootstrapTable({
                classes: 'table table-striped table-no-bordered',
                toolbar: '#table-toolbar-kelompokmapel',
                url: '/iq/kelompokmapel/json',
                queryParams: function(params) {
                    params.kelas_id = kelas_id.val();
                    params.semester_id = semester_id.val();
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
                            <button type="button" class="btn btn-success btn-xs btn-edit-kelompokmapel" data-id="${value}"><i class="fa fa-pencil"></i></button>
                            <button type="button" class="btn btn-danger btn-xs btn-delete-kelompokmapel" data-id="${value}" data-identifier="${row.kelompokmapel}"><i class="fa fa-trash"></i></button>
                        `;
                    }
                }, {
                    field: 'kelompokmapel',
                    title: 'Kelompok Mapel',
                    sortable: true,
                }]
            });

            table = $('#table').bootstrapTable('destroy').bootstrapTable({
                classes: 'table table-striped table-no-bordered',
                toolbar: '#table-toolbar',
                url: '/iq/mapel/json',
                queryParams: function(params) {
                    params.kelas_id = kelas_id.val();
                    params.semester_id = semester_id.val();
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

                        var format = '';

                        if(row.parent == 1){ // parent
                            format += `<button type="button" class="btn btn-success btn-xs btn-edit" data-id="${value}"><i class="fa fa-pencil"></i></button> `;
                            if(row.has_child == 0){
                                format += `<button type="button" class="btn btn-danger btn-xs btn-delete" data-id="${value}" data-identifier="${row.mapel}"><i class="fa fa-trash"></i></button> `; 
                            }
                        }else if(row.parent == 0){ // sub
                            format += `<button type="button" class="btn btn-success btn-xs btn-edit-sub" data-id="${value}"><i class="fa fa-pencil"></i></button> `;
                            format += `<button type="button" class="btn btn-danger btn-xs btn-delete" data-id="${value}" data-identifier="${row.mapel}"><i class="fa fa-trash"></i></button> `;
                        }

                        return format;
                    }
                }, {
                    field: 'mapel',
                    title: 'Mapel',
                    sortable: true,
                    formatter: function(value, row, index){
                        if(row.parent == '0'){
                            return `<div class="row">
                                <div class="col-xs-11 col-xs-offset-1">
                                    ${value}
                                </div>
                            </div>`;
                        }else if(row.parent == '1'){
                            return value;
                        }
                    }
                }, {
                    field: 'kelompokmapel',
                    title: 'Kelompok Mapel',
                    sortable: true,
                }, {
                    field: 'guru',
                    title: 'Guru',
                    sortable: true,
                    formatter: function(value, row, index){
                        if(row.has_child == 0){
                            return value
                        }else{
                            return;
                        }
                    }
                }, {
                    field: 'kkm',
                    title: 'KKM',
                    sortable: true,
                    formatter: function(value, row, index){
                        if(row.has_child == 0){
                            return value
                        }else{
                            return;
                        }
                    }
                }, {
                    field: 'is_gabungan',
                    title: 'Gabungan Dari Mapel Dayah',
                    sortable: true,
                    formatter: function(value, row, index){
                        if(row.has_child == 0 && value > 0){
                            return row.mapelgabungan;
                        }else{
                            return;
                        }
                    }
                }]
            });
        }else{
            $('#row-table').hide();
        }
    }

    

    tahunajaran_id.on('change', loadSelectSemester);

    tahunajaran_id.on('change', loadSelectKelas);
    tingkat_id.on('change', loadSelectKelas);

    tahunajaran_id.on('change', loadTable);
    semester_id.on('change', loadTable);
    tingkat_id.on('change', loadTable);
    kelas_id.on('change', loadTable);




    // kelompokmapel
    var btnAddKelompokmapel = $('#btn-add-kelompokmapel');
    var modalAddKelompokmapel = $('#modal-add-kelompokmapel');
    var formAddKelompokmapel = $('#form-add-kelompokmapel');

    var modalEditKelompokmapel = $('#modal-edit-kelompokmapel');
    var formEditKelompokmapel = $('#form-edit-kelompokmapel');

    var modalDeleteKelompolmapel = $('#modal-delete-kelompokmapel');
    var formDeleteKelompokmapel = $('#form-delete-kelompokmapel');

    

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
            data: {
                kelompokmapel: formAddKelompokmapel.find('#kelompokmapel').val(),
                kelas_id: kelas_id.val(),
                semester_id: semester_id.val(),
            },
            success: function(result){
                if(result.status == 'success'){
                    tableKelompokMapel.bootstrapTable('refresh');
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
            data: {
                id: formEditKelompokmapel.find('#id').val(),
                kelompokmapel: formEditKelompokmapel.find('#kelompokmapel').val(),
            },
            success: function(result){
                if(result.status == 'success'){
                    tableKelompokMapel.bootstrapTable('refresh');
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
                    tableKelompokMapel.bootstrapTable('refresh');
                    modalDeleteKelompolmapel.modal('hide');
                    formDeleteKelompokmapel.trigger('reset');
                }
            }
        })
    });



    // mapel

    var btnAdd = $('#btn-add');
    var modalAdd = $('#modal-add');
    var formAdd = $('#form-add');

    var btnAddSub = $('#btn-add-sub');
    var modalAddSub = $('#modal-add-sub');
    var formAddSub = $('#form-add-sub');

    var modalEdit = $('#modal-edit');
    var formEdit = $('#form-edit');

    var modalEditSub = $('#modal-edit-sub');
    var formEditSub = $('#form-edit-sub');

    var modalDelete = $('#modal-delete');
    var formDelete = $('#form-delete');

	

    btnAdd.on('click', function(e){
        e.preventDefault();
        modalAdd.modal('show');

        formAdd.find('#kelompokmapel_id').find('option').remove();

        $.ajax({
            url: '/iq/kelompokmapel/json_where_kelas_id_and_semester_id',
            type: 'GET',
            data: {
                kelas_id: kelas_id.val(),
                semester_id: semester_id.val(),
            },
            success: function(result){
                formAdd.find('#kelompokmapel_id').append('<option></option>');
                result.forEach(function(kelompokmapel){
                    formAdd.find('#kelompokmapel_id').append('<option value="'+ kelompokmapel.id +'">'+ kelompokmapel.kelompokmapel +'</option>');
                });
            }
        });

        formAdd.find('#guru_id').find('option').remove();

        $.ajax({
            url: '/iq/guru/json_all',
            type: 'GET',
            success: function(result){
                formAdd.find('#guru_id').append('<option></option>');
                result.forEach(function(guru){
                    formAdd.find('#guru_id').append('<option value="'+ guru.id +'">'+ guru.nama +'</option>');
                });
            }
        });
        formAdd.find('input[type="radio"][name="is_gabungan"][value="0"]').prop('checked', true);
        formAdd.find('.row-mapeldayah').hide();
    });

    formAdd.find('.is_gabungan').on('change', function(){
        var is_gabungan = $(this).val();
        if(is_gabungan == 1){
            formAdd.find('.row-mapeldayah').show();
            $.ajax({
                type: 'GET',
                url: '/iq/mapel/json_mapeldayah',
                data: {
                    kelas_id: kelas_id.val(),
                    semester_id: semester_id.val()
                },
                success: function(result){
                    formAdd.find('#mapeldayah_id').find('option').remove();
                    result.forEach(function(item){
                        console.log(item);
                        formAdd.find('#mapeldayah_id').append('<option value="'+ item.id +'">'+ item.mapel + '('+ item.mapel_hijaiyah +')' +'</option>');
                    });
                }
            });
        }else{
            formAdd.find('#mapeldayah_id').find('option').remove();
            formAdd.find('.row-mapeldayah').hide();
        }
    });

    formEdit.find('.is_gabungan').on('change', function(){
        var is_gabungan = $(this).val();
        if(is_gabungan == 1){
            formEdit.find('.row-mapeldayah').show();
            $.ajax({
                type: 'GET',
                url: '/iq/mapel/json_mapeldayah',
                data: {
                    kelas_id: kelas_id.val(),
                    semester_id: semester_id.val()
                },
                success: function(result){

                    var mapel_id = formEdit.find('#id').val();

                    $.ajax({
                        type: 'GET',
                        url: '/iq/mapel/get_mapeldayah_id_gabungan',
                        data: {
                            mapel_id: mapel_id
                        },
                        success: function(mapeldayah_id_gabungan){
                            console.log(mapeldayah_id_gabungan);
                            formEdit.find('#mapeldayah_id').find('option').remove();

                            result.forEach(function(item){
                                console.log(mapeldayah_id_gabungan.indexOf(item.id));
                                formEdit.find('#mapeldayah_id').append('<option '+ ((mapeldayah_id_gabungan.indexOf(item.id) >= 0) ? 'selected=""' : '') +' value="'+ item.id +'">'+ item.mapel + '('+ item.mapel_hijaiyah +')' +'</option>');
                            });
                        }
                    });
                   
                }
            });
        }else{
            formEdit.find('#mapeldayah_id').find('option').remove();
            formEdit.find('.row-mapeldayah').hide();
        }
    });

    formAdd.on('submit', function(e){
        e.preventDefault();
        formAdd.find('.help-block').remove().end().find('.form-group').removeClass('has-error');

        var formData = {
            mapel: formAdd.find('#mapel').val(),
            kelas_id: kelas_id.val(),
            guru_id: formAdd.find('#guru_id').val(),
            kkm: formAdd.find('#kkm').val(),
            kelompokmapel_id: formAdd.find('#kelompokmapel_id').val(),
            semester_id: semester_id.val(),
            mapeldayah_id: formAdd.find('#mapeldayah_id').val()
        };

        $.ajax({
            url: '/iq/mapel/create',
            type: 'POST',
            data: formData,
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

    btnAddSub.on('click', function(e){
        e.preventDefault();
        modalAddSub.modal('show');

        formAddSub.find('#parent_id').find('option').remove().end().find('has-error').removeClass('has-error');

        $.ajax({
            url: '/iq/mapel/json_parent_mapel',
            type: 'GET',
            data: {
                kelas_id: kelas_id.val(),
                semester_id: semester_id.val(),
            },
            success: function(result){
                formAddSub.find('#parent_id').append('<option></option>');
                result.forEach(function(mapel){
                    formAddSub.find('#parent_id').append('<option value="'+ mapel.id +'">'+ mapel.mapel +'</option>');
                });
            }
        });

        formAddSub.find('#guru_id').find('option').remove();

        $.ajax({
            url: '/iq/guru/json_all',
            type: 'GET',
            success: function(result){
                formAddSub.find('#guru_id').append('<option></option>');
                result.forEach(function(guru){
                    formAddSub.find('#guru_id').append('<option value="'+ guru.id +'">'+ guru.nama +'</option>');
                });
            }
        });

        formAddSub.find('input[type="radio"][name="is_gabungan"][value="0"]').prop('checked', true);
        formAddSub.find('.row-mapeldayah').hide();
    });

    formAddSub.find('.is_gabungan').on('change', function(){
        var is_gabungan = $(this).val();
        if(is_gabungan == 1){
            formAddSub.find('.row-mapeldayah').show();
            $.ajax({
                type: 'GET',
                url: '/iq/mapel/json_mapeldayah',
                data: {
                    kelas_id: kelas_id.val(),
                    semester_id: semester_id.val()
                },
                success: function(result){
                    formAddSub.find('#mapeldayah_id').find('option').remove();
                    result.forEach(function(item){
                        console.log(item);
                        formAddSub.find('#mapeldayah_id').append('<option value="'+ item.id +'">'+ item.mapel + '('+ item.mapel_hijaiyah +')' +'</option>');
                    });
                }
            });
        }else{
            formAddSub.find('#mapeldayah_id').find('option').remove();
            formAddSub.find('.row-mapeldayah').hide();
        }
    });

    formEditSub.find('.is_gabungan').on('change', function(){
        var is_gabungan = $(this).val();
        if(is_gabungan == 1){
            formEditSub.find('.row-mapeldayah').show();
            $.ajax({
                type: 'GET',
                url: '/iq/mapel/json_mapeldayah',
                data: {
                    kelas_id: kelas_id.val(),
                    semester_id: semester_id.val()
                },
                success: function(result){

                    var mapel_id = formEditSub.find('#id').val();

                    $.ajax({
                        type: 'GET',
                        url: '/iq/mapel/get_mapeldayah_id_gabungan',
                        data: {
                            mapel_id: mapel_id
                        },
                        success: function(mapeldayah_id_gabungan){
                            console.log(mapeldayah_id_gabungan);
                            formEditSub.find('#mapeldayah_id').find('option').remove();

                            result.forEach(function(item){
                                console.log(mapeldayah_id_gabungan.indexOf(item.id));
                                formEditSub.find('#mapeldayah_id').append('<option '+ ((mapeldayah_id_gabungan.indexOf(item.id) >= 0) ? 'selected=""' : '') +' value="'+ item.id +'">'+ item.mapel + '('+ item.mapel_hijaiyah +')' +'</option>');
                            });
                        }
                    });
                    /*formEditSub.find('#mapeldayah_id').find('option').remove();
                    result.forEach(function(item){
                        
                        formEditSub.find('#mapeldayah_id').append('<option value="'+ item.id +'">'+ item.mapel + '('+ item.mapel_hijaiyah +')' +'</option>');
                    });*/
                }
            });
        }else{
            formEditSub.find('#mapeldayah_id').find('option').remove();
            formEditSub.find('.row-mapeldayah').hide();
        }
    });


    formAddSub.on('submit', function(e){
        e.preventDefault();
        formAddSub.find('.help-block').remove().end().find('.form-group').removeClass('has-error');
        var formData = {
            mapel: formAddSub.find('#mapel').val(),
            kelas_id: kelas_id.val(),
            guru_id: formAddSub.find('#guru_id').val(),
            kelompokmapel_id: formAddSub.find('#kelompokmapel_id').val(),
            kkm: formAddSub.find('#kkm').val(),
            semester_id: semester_id.val(),
            parent_id: formAddSub.find('#parent_id').val(),
            mapeldayah_id: formAddSub.find('#mapeldayah_id').val()
        };

        $.ajax({
            url: '/iq/mapel/create_sub',
            type: 'POST',
            data: formData,
            success: function(result){
                if(result.status == 'success'){
                    table.bootstrapTable('refresh');
                    modalAddSub.modal('hide');
                    formAddSub.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formAddSub.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    });



    $(document).on('click', '.btn-edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/iq/mapel/find',
            type: 'GET',
            data: {
                id: id
            },
            success: function(result){
                if(result !== ''){
                    var mapel_id = result.id;
                    $.each(result, function(key, value){
                        formEdit.find('#' + key).val(value);

                        if(key == 'kelompokmapel_id'){
                            formEdit.find('#kelompokmapel_id').find('option').remove();

                            $.ajax({
                                url: '/iq/kelompokmapel/json_where_kelas_id_and_semester_id',
                                type: 'GET',
                                data: {
                                    kelas_id: kelas_id.val(),
                                    semester_id: semester_id.val(),
                                },
                                success: function(result){
                                    formEdit.find('#kelompokmapel_id').append('<option></option>');
                                    result.forEach(function(kelompokmapel){
                                        if(value == kelompokmapel.id){
                                            formEdit.find('#kelompokmapel_id').append('<option selected="" value="'+ kelompokmapel.id +'">'+ kelompokmapel.kelompokmapel +'</option>');    
                                        }else{
                                            formEdit.find('#kelompokmapel_id').append('<option value="'+ kelompokmapel.id +'">'+ kelompokmapel.kelompokmapel +'</option>');
                                        }
                                        
                                    });
                                }
                            });
                        }

                        if(key == 'guru_id'){
                            formEdit.find('#guru_id').find('option').remove();

                            $.ajax({
                                url: '/iq/guru/json_all',
                                type: 'GET',
                                success: function(result){
                                    formEdit.find('#guru_id').append('<option></option>');
                                    result.forEach(function(guru){
                                        if(value == guru.id){
                                            formEdit.find('#guru_id').append('<option selected="" value="'+ guru.id +'">'+ guru.nama +'</option>');
                                        }else{
                                            formEdit.find('#guru_id').append('<option value="'+ guru.id +'">'+ guru.nama +'</option>');
                                        }
                                    });
                                }
                            });
                        }

                        if(key == 'is_gabungan'){
                            if(value > 0){
                                formEdit.find('input[type="radio"][name="is_gabungan"][value="1"]').prop('checked', true);
                                formEdit.find('.row-mapeldayah').show();

                                $.ajax({
                                    type: 'GET',
                                    url: '/iq/mapel/json_mapeldayah',
                                    data: {
                                        kelas_id: kelas_id.val(),
                                        semester_id: semester_id.val()
                                    },
                                    success: function(result){

                                        $.ajax({
                                            type: 'GET',
                                            url: '/iq/mapel/get_mapeldayah_id_gabungan',
                                            data: {
                                                mapel_id: mapel_id
                                            },
                                            success: function(mapeldayah_id_gabungan){
                                                console.log(mapeldayah_id_gabungan);
                                                formEdit.find('#mapeldayah_id').find('option').remove();

                                                result.forEach(function(item){
                                                    console.log(mapeldayah_id_gabungan.indexOf(item.id));
                                                    formEdit.find('#mapeldayah_id').append('<option '+ ((mapeldayah_id_gabungan.indexOf(item.id) >= 0) ? 'selected=""' : '') +' value="'+ item.id +'">'+ item.mapel + '('+ item.mapel_hijaiyah +')' +'</option>');
                                                });
                                            }
                                        });
                                    }
                                });
                            }else{
                                formEdit.find('input[type="radio"][name="is_gabungan"][value="0"]').prop('checked', true);
                                formEdit.find('.row-mapeldayah').hide();
                                formEdit.find('#mapeldayah_id').find('option').remove();
                            }
                        }
                    });
                    modalEdit.modal('show');
                }
            }
        });
    });

    $(document).on('click', '.btn-edit-sub', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/iq/mapel/find_sub',
            type: 'GET',
            data: {
                id: id
            },
            success: function(result){
                if(result !== ''){
                    console.log(result);
                    var mapel_id = result.id;

                    $.each(result, function(key, value){

                        formEditSub.find('#' + key).val(value);

                        if(key == 'parent_id'){

                            formEditSub.find('#parent_id').find('option').remove().end().find('has-error').removeClass('has-error');

                            $.ajax({
                                url: '/iq/mapel/json_parent_mapel',
                                type: 'GET',
                                data: {
                                    kelas_id: kelas_id.val(),
                                    semester_id: semester_id.val(),
                                },
                                success: function(result){
                                    formEditSub.find('#parent_id').append('<option></option>');
                                    result.forEach(function(mapel){
                                        if(value == mapel.id){
                                            formEditSub.find('#parent_id').append('<option selected="" value="'+ mapel.id +'">'+ mapel.mapel +'</option>');
                                        }else{
                                            formEditSub.find('#parent_id').append('<option value="'+ mapel.id +'">'+ mapel.mapel +'</option>');
                                        }
                                    });
                                }
                            });
                        }

                        if(key == 'guru_id'){
                            formEditSub.find('#guru_id').find('option').remove();

                            $.ajax({
                                url: '/iq/guru/json_all',
                                type: 'GET',
                                success: function(result){
                                    formEditSub.find('#guru_id').append('<option></option>');
                                    result.forEach(function(guru){
                                        if(value == guru.id){
                                            formEditSub.find('#guru_id').append('<option selected="" value="'+ guru.id +'">'+ guru.nama +'</option>');
                                        }else{
                                            formEditSub.find('#guru_id').append('<option value="'+ guru.id +'">'+ guru.nama +'</option>');
                                        }
                                    });
                                }
                            });
                        }

                        if(key == 'is_gabungan'){
                            if(value > 0){
                                formEditSub.find('input[type="radio"][name="is_gabungan"][value="1"]').prop('checked', true);
                                formEditSub.find('.row-mapeldayah').show();

                                $.ajax({
                                    type: 'GET',
                                    url: '/iq/mapel/json_mapeldayah',
                                    data: {
                                        kelas_id: kelas_id.val(),
                                        semester_id: semester_id.val()
                                    },
                                    success: function(result){

                                        $.ajax({
                                            type: 'GET',
                                            url: '/iq/mapel/get_mapeldayah_id_gabungan',
                                            data: {
                                                mapel_id: mapel_id
                                            },
                                            success: function(mapeldayah_id_gabungan){
                                                console.log(mapeldayah_id_gabungan);
                                                formEditSub.find('#mapeldayah_id').find('option').remove();

                                                result.forEach(function(item){
                                                    console.log(mapeldayah_id_gabungan.indexOf(item.id));
                                                    formEditSub.find('#mapeldayah_id').append('<option '+ ((mapeldayah_id_gabungan.indexOf(item.id) >= 0) ? 'selected=""' : '') +' value="'+ item.id +'">'+ item.mapel + '('+ item.mapel_hijaiyah +')' +'</option>');
                                                });
                                            }
                                        });
                                    }
                                });
                            }else{
                                formEditSub.find('input[type="radio"][name="is_gabungan"][value="0"]').prop('checked', true);
                                formEditSub.find('.row-mapeldayah').hide();
                                formEditSub.find('#mapeldayah_id').find('option').remove();
                            }
                        }
                    });
                    modalEditSub.modal('show');
                }
            }
        });
    });

    formEditSub.on('submit', function(e){
        e.preventDefault();

        formEditSub.find('.help-block').remove().end().find('.form-group').removeClass('has-error');

        $.ajax({
            type: 'POST',
            url: '/iq/mapel/update_sub',
            data: {
                id: formEditSub.find('#id').val(),
                mapel: formEditSub.find('#mapel').val(),
                guru_id: formEditSub.find('#guru_id').val(),
                kelompokmapel_id: formEditSub.find('#kelompokmapel_id').val(),
                kkm: formEditSub.find('#kkm').val(),
                parent_id: formEditSub.find('#parent_id').val(),
                mapeldayah_id: formEditSub.find('#mapeldayah_id').val()
            },
            success: function(result){
                if(result.status == 'success'){
                    table.bootstrapTable('refresh');
                    modalEditSub.modal('hide');
                    formEditSub.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formEditSub.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    });

    formEdit.on('submit', function(e){
        e.preventDefault();

        formEdit.find('.help-block').remove().end().find('.form-group').removeClass('has-error');

        var formData = {

            id: formEdit.find('#id').val(),
            mapel: formEdit.find('#mapel').val(),
            // kelas_id: kelas_id.val(),
            guru_id: formEdit.find('#guru_id').val(),
            kkm: formEdit.find('#kkm').val(),
            kelompokmapel_id: formEdit.find('#kelompokmapel_id').val(),
            // semester_id: semester_id.val(),
            mapeldayah_id: formEdit.find('#mapeldayah_id').val()
        };

        $.ajax({
            type: 'POST',
            url: '/iq/mapel/update',
            data: formData,
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
            url: '/iq/mapel/delete',
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