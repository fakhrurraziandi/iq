$(function(){


    // filter elements
    var tahunajaran_id = $('#form-filter').find('#tahunajaran_id');
    var semester_id = $('#form-filter').find('#semester_id');
    var tingkat_id = $('#form-filter').find('#tingkat_id');
    var kelas_id = $('#form-filter').find('#kelas_id');
    var mapeldayah_id = $('#form-filter').find('#mapeldayah_id');

    
    var table;
    var tablePersentasepenilaian;
    var tablePredikatpengetahuan;
    var tablePredikatketerampilan;
    var tablePredikatsikap;


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

            

            table = $('#table').bootstrapTable('destroy').bootstrapTable({
                classes: 'table table-striped table-bordered',
                toolbar: '#table-toolbar',
                url: '/iq/penilaiantahfizh/json',
                queryParams: function(params) {
                    params.mapeldayah_id = mapeldayah_id.val();
                    params.kelas_id = kelas_id.val();
                    
                    return params;
                },
                sidePagination: 'server',
                pagination: true,
                paginationLoop: true,
                pageList: [5, 10, 20, 50, 100, 200],
                search: true,
                showRefresh: true,
                checkbox: true,
                columns: [
                    [
                        {
                            field: 'id',
                            title: 'Action',
                            
                            valign: 'middle',
                            formatter: function(value, row, index){

                                
                                // not as parent
                                var buttons = ``;
                                
                                if(row.penilaiantahfizh_id == null){
                                    buttons += `<button type="button" class="btn btn-success btn-xs btn-add" data-penempatansiswa_id="${value}" data-nama_siswa="${row.nama}"><i class="fa fa-plus"></i></button>`
                                }else{
                                    buttons += `<button type="button" class="btn btn-success btn-xs btn-edit" data-penilaiantahfizh_id="${row.penilaiantahfizh_id}" data-nama_siswa="${row.nama}"><i class="fa fa-pencil"></i></button>`
                                }
                                return buttons;
                                
                            }
                        }, {
                            field: 'nisn',
                            title: 'NISN',
                            
                            valign: 'middle',
                        }, {
                            field: 'nis_lokal',
                            title: 'NIS',
                            valign: 'middle',
                        }, {
                            field: 'nama',
                            title: 'Nama',
                            valign: 'middle',
                            class: 'text-nowrap',
                        }, {
                            field: 'jumlah_hafalan',
                            title: 'Jumlah Hafalan',
                            valign: 'middle',
                            formatter: function(value, row, index){
                                if(value == null) return;
                                return value + ' Juz';
                            }
                        }, {
                            field: 'hafalan_yang_diujiankan',
                            title: 'Hafalan Yang Diujiankan',
                            valign: 'middle',
                            formatter: function(value, row, index){
                                if(value == null) return;
                                return value + ' Juz';
                            }
                        }, {
                            field: 'nilai',
                            title: 'Nilai',
                            valign: 'middle',
                        } 
                    ],
                    
                ]
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

    





    // penilaian
    var modalAdd = $('#modal-add');
    var formAdd = $('#form-add');

    var modalEdit = $('#modal-edit');
    var formEdit = $('#form-edit');

    var modalDelete = $('#modal-delete');
    var formDelete = $('#form-delete');
    
    $(document).on('click', '.btn-add', function(e){
        e.preventDefault();
        modalAdd.modal('show');


        modalAdd.find('span#nama_siswa').html($(this).data('nama_siswa'));

        // hidden input
        formAdd.find('#penempatansiswa_id').val($(this).data('penempatansiswa_id'));
        
    });

    formAdd.find('#jumlah_hafalan').on('change', function(){
        var jumlah_hafalan = $(this).val();
        formAdd.find('#hafalan_yang_diujiankan').find('option').remove();
        for(var i = 1; i <= jumlah_hafalan; i++){
            formAdd.find('#hafalan_yang_diujiankan').append('<option value="'+ i +'">'+ i  +' Juz </option>');
        }
    });

    formAdd.on('submit', function(e){
        e.preventDefault();
        formAdd.find('.help-block').remove().end().find('.form-group').removeClass('has-error');
        

        $.ajax({
            url: '/iq/penilaiantahfizh/create',
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
        var id = $(this).data('penilaiantahfizh_id');
        modalEdit.find('span#nama_siswa').html($(this).data('nama_siswa'));
        $.ajax({
            url: '/iq/penilaiantahfizh/find',
            type: 'GET',
            data: {
                id: id
            },
            success: function(result){
                if(result !== ''){
                    $.each(result, function(key, value){
                        
                        if(key == 'hafalan_yang_diujiankan'){
                            
                            var jumlah_hafalan = formEdit.find('#jumlah_hafalan').val();
                            formEdit.find('#hafalan_yang_diujiankan').find('option').remove();
                            for(var i = 1; i <= jumlah_hafalan; i++){
                                if(i == value){
                                    formEdit.find('#hafalan_yang_diujiankan').append('<option selected="" value="'+ i +'">'+ i  +' Juz </option>');    
                                }else{
                                    formEdit.find('#hafalan_yang_diujiankan').append('<option value="'+ i +'">'+ i  +' Juz </option>');    
                                }   
                            }
                        }else{
                            formEdit.find('#' + key).val(value);    
                        }
                    });
                    modalEdit.modal('show');

                }
            }
        });
    });

    formEdit.find('#jumlah_hafalan').on('change', function(){
        var jumlah_hafalan = $(this).val();
        formEdit.find('#hafalan_yang_diujiankan').find('option').remove();
        for(var i = 1; i <= jumlah_hafalan; i++){
            formEdit.find('#hafalan_yang_diujiankan').append('<option value="'+ i +'">'+ i  +' Juz </option>');
        }
    });

    formEdit.on('submit', function(e){
        e.preventDefault();

        formEdit.find('.help-block').remove().end().find('.form-group').removeClass('has-error');

        $.ajax({
            type: 'POST',
            url: '/iq/penilaiantahfizh/update',
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




    // persentasepenilaian

    // penilaian
    var modalAddPersentasepenilaian = $('#modal-add-persentasepenilaian');
    var formAddPersentasepenilaian = $('#form-add-persentasepenilaian');

    var modalEditPersentasepenilaian = $('#modal-edit-persentasepenilaian');
    var formEditPersentasepenilaian = $('#form-edit-persentasepenilaian');
    
    $(document).on('click', '.btn-add-persentasepenilaian', function(e){
        e.preventDefault();
        modalAddPersentasepenilaian.modal('show');

        // hidden input
        formAddPersentasepenilaian.find('#mapeldayah_id').val(mapeldayah_id.val());
        
    });

    formAddPersentasepenilaian.on('submit', function(e){
        e.preventDefault();
        formAddPersentasepenilaian.find('.help-block').remove().end().find('.form-group').removeClass('has-error');
        

        $.ajax({
            url: '/iq/persentasepenilaiandayah/create',
            type: 'POST',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    loadTable();
                    modalAddPersentasepenilaian.modal('hide');
                    formAddPersentasepenilaian.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formAddPersentasepenilaian.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    });


    $(document).on('click', '.btn-edit-persentasepenilaian', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        
        $.ajax({
            url: '/iq/persentasepenilaiandayah/find',
            type: 'GET',
            data: {
                id: id
            },
            success: function(result){
                if(result !== ''){
                    $.each(result, function(key, value){
                        formEditPersentasepenilaian.find('#' + key).val(value);
                    });
                    modalEditPersentasepenilaian.modal('show');

                }
            }
        });
    });

    formEditPersentasepenilaian.on('submit', function(e){
        e.preventDefault();

        formEditPersentasepenilaian.find('.help-block').remove().end().find('.form-group').removeClass('has-error');

        $.ajax({
            type: 'POST',
            url: '/iq/persentasepenilaiandayah/update',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    loadTable();
                    modalEditPersentasepenilaian.modal('hide');
                    formEditPersentasepenilaian.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formEditPersentasepenilaian.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    });



    // predikatpengetahuan
    var modalEditPredikatpengetahuan = $('#modal-edit-predikatpengetahuan');
    var formEditPredikatpengetahuan = $('#form-edit-predikatpengetahuan');

    $(document).on('click', '.btn-edit-predikatpengetahuan', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        
        $.ajax({
            url: '/iq/predikatpengetahuan/find',
            type: 'GET',
            data: {
                id: id
            },
            success: function(result){
                if(result !== ''){
                    $.each(result, function(key, value){
                        if(key == 'operator'){
                            formEditPredikatpengetahuan.find('#' + key).html(value);
                        }else{
                            formEditPredikatpengetahuan.find('#' + key).val(value);    
                        }
                        
                    });
                    modalEditPredikatpengetahuan.modal('show');

                }
            }
        });
    });

    formEditPredikatpengetahuan.on('submit', function(e){
        e.preventDefault();

        formEditPredikatpengetahuan.find('.help-block').remove().end().find('.form-group').removeClass('has-error');

        $.ajax({
            type: 'POST',
            url: '/iq/predikatpengetahuan/update',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    loadTable();
                    modalEditPredikatpengetahuan.modal('hide');
                    formEditPredikatpengetahuan.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formEditPredikatpengetahuan.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    }); 


    // predikatketerampilan
    var modalEditPredikatketerampilan = $('#modal-edit-predikatketerampilan');
    var formEditPredikatketerampilan = $('#form-edit-predikatketerampilan');

    $(document).on('click', '.btn-edit-predikatketerampilan', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        
        $.ajax({
            url: '/iq/predikatketerampilan/find',
            type: 'GET',
            data: {
                id: id
            },
            success: function(result){
                if(result !== ''){
                    $.each(result, function(key, value){
                        if(key == 'operator'){
                            formEditPredikatketerampilan.find('#' + key).html(value);
                        }else{
                            formEditPredikatketerampilan.find('#' + key).val(value);    
                        }
                        
                    });
                    modalEditPredikatketerampilan.modal('show');

                }
            }
        });
    });

    formEditPredikatketerampilan.on('submit', function(e){
        e.preventDefault();

        formEditPredikatketerampilan.find('.help-block').remove().end().find('.form-group').removeClass('has-error');

        $.ajax({
            type: 'POST',
            url: '/iq/predikatketerampilan/update',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    loadTable();
                    modalEditPredikatketerampilan.modal('hide');
                    formEditPredikatketerampilan.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formEditPredikatketerampilan.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    });



    // predikatsikap
    var modalEditPredikatsikap = $('#modal-edit-predikatsikap');
    var formEditPredikatsikap = $('#form-edit-predikatsikap');

    $(document).on('click', '.btn-edit-predikatsikap', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        
        $.ajax({
            url: '/iq/predikatsikap/find',
            type: 'GET',
            data: {
                id: id
            },
            success: function(result){
                if(result !== ''){
                    $.each(result, function(key, value){
                        if(key == 'operator'){
                            formEditPredikatsikap.find('#' + key).html(value);
                        }else{
                            formEditPredikatsikap.find('#' + key).val(value);    
                        }
                        
                    });
                    modalEditPredikatsikap.modal('show');

                }
            }
        });
    });

    formEditPredikatsikap.on('submit', function(e){
        e.preventDefault();

        formEditPredikatsikap.find('.help-block').remove().end().find('.form-group').removeClass('has-error');

        $.ajax({
            type: 'POST',
            url: '/iq/predikatsikap/update',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    loadTable();
                    modalEditPredikatsikap.modal('hide');
                    formEditPredikatsikap.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formEditPredikatsikap.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    });

});