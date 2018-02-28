$(function(){


    // filter elements
    var tahunajaran_id = $('#form-filter').find('#tahunajaran_id');
    var semester_id = $('#form-filter').find('#semester_id');
    var tingkat_id = $('#form-filter').find('#tingkat_id');
    var kelas_id = $('#form-filter').find('#kelas_id');
    var mapel_id = $('#form-filter').find('#mapel_id');

    
    var table;


    function loadTable(){

        if(tahunajaran_id.val() !== '' && tingkat_id.val() !== '' && kelas_id.val() !== '' && mapel_id.val() !== ''){
            
            $('#row-table').show();

            table = $('#table').bootstrapTable('destroy').bootstrapTable({
                classes: 'table table-striped table-bordered',
                toolbar: '#table-toolbar',
                url: '/iq/kenaikankelas/json',
                queryParams: function(params) {
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
                            align: 'center',
                            formatter: function(value, row, index){
                                // onsole.log(typeof row.status_kenaikankelas, row.status_kenaikankelas, (row.status_kenaikankelas == null));
                                if(row.status_kenaikankelas == null){
                                    var buttons = '';
                                    buttons += `<a class="btn btn-warning btn-xs btn-tinggal-kelas" data-penempatansiswa_id="${value}" data-siswa_nama="${row.nama}" data-siswa_id="${row.siswa_id}"><i class="fa fa-minus"></i> Tinggal Kelas</a> `;
                                    buttons += `<a class="btn btn-success btn-xs btn-naik-kelas" data-penempatansiswa_id="${value}" data-siswa_nama="${row.nama}" data-siswa_id="${row.siswa_id}"><i class="fa fa-level-up"></i> Naik Kelas</a>`;    
                                    return buttons;
                                }else{
                                    if(row.status_kenaikankelas == 1){
                                        return 'Naik Kelas';
                                    }

                                    if(row.status_kenaikankelas == 0){
                                        return 'Tinggal Kelas';
                                    }
                                }
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
                            
                        }
                    ]
                   
                ]
            });

        }else{
            $('#row-table').hide();
        }
    }

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

    


    tahunajaran_id.on('change', loadSelectKelas);
    tingkat_id.on('change', loadSelectKelas);

    tahunajaran_id.on('change', loadTable);
    tingkat_id.on('change', loadTable);
    kelas_id.on('change', loadTable);

    


    // Naik Kelas
    var modalNaikKelas = $('#modal-naik-kelas');
    var formNaikKelas = $('#form-naik-kelas');
    $(document).on('click', '.btn-naik-kelas', function(e){
        e.preventDefault();
        var siswa_nama = $(this).data('siswa_nama');
        var siswa_id = $(this).data('siswa_id');
        var penempatansiswa_id = $(this).data('penempatansiswa_id');

        formNaikKelas.find('#identifier').html(siswa_nama);
        formNaikKelas.find('#siswa_id').val(siswa_id);
        formNaikKelas.find('#penempatansiswa_id').val(penempatansiswa_id);

        console.log(siswa_nama, siswa_id, penempatansiswa_id);
        modalNaikKelas.modal('show');
    });

    formNaikKelas.on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/iq/kenaikankelas/naikkelas',
            type: 'POST',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    table.bootstrapTable('refresh');
                    modalNaikKelas.modal('hide');
                    formNaikKelas.trigger('reset');
                }
            }
        });
    });

    // Tinggal Kelas
    var modalTinggalKelas = $('#modal-tinggal-kelas');
    var formTinggalKelas = $('#form-tinggal-kelas');
    $(document).on('click', '.btn-tinggal-kelas', function(e){
        e.preventDefault();
        var siswa_nama = $(this).data('siswa_nama');
        var siswa_id = $(this).data('siswa_id');
        var penempatansiswa_id = $(this).data('penempatansiswa_id');

        formTinggalKelas.find('#identifier').html(siswa_nama);
        formTinggalKelas.find('#siswa_id').val(siswa_id);
        formTinggalKelas.find('#penempatansiswa_id').val(penempatansiswa_id);

        console.log(siswa_nama, siswa_id, penempatansiswa_id);
        modalTinggalKelas.modal('show');
    });

    formTinggalKelas.on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/iq/kenaikankelas/tinggalkelas',
            type: 'POST',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    table.bootstrapTable('refresh');
                    modalTinggalKelas.modal('hide');
                    formTinggalKelas.trigger('reset');
                }
            }
        });
    });




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

        formAdd.find('#kelompokmapel_id').find('option').remove();

        modalAdd.find('span#nama_siswa').html($(this).data('nama_siswa'));

        // hidden input
        formAdd.find('#penempatansiswa_id').val($(this).data('penempatansiswa_id'));
        formAdd.find('#mapel_id').val(mapel_id.val());
        
    });

    formAdd.on('submit', function(e){
        e.preventDefault();
        formAdd.find('.help-block').remove().end().find('.form-group').removeClass('has-error');
        

        $.ajax({
            url: '/iq/penilaian/create',
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
        var id = $(this).data('penilaian_id');
        modalEdit.find('span#nama_siswa').html($(this).data('nama_siswa'));
        $.ajax({
            url: '/iq/penilaian/find',
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

        formEdit.find('.help-block').remove().end().find('.form-group').removeClass('has-error');

        $.ajax({
            type: 'POST',
            url: '/iq/penilaian/update',
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
        formAddPersentasepenilaian.find('#mapel_id').val(mapel_id.val());
        
    });

    formAddPersentasepenilaian.on('submit', function(e){
        e.preventDefault();
        formAddPersentasepenilaian.find('.help-block').remove().end().find('.form-group').removeClass('has-error');
        

        $.ajax({
            url: '/iq/persentasepenilaian/create',
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
            url: '/iq/persentasepenilaian/find',
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
            url: '/iq/persentasepenilaian/update',
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