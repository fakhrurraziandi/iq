$(function(){


    // filter elements
    var tahunajaran_id = $('#form-filter').find('#tahunajaran_id');
    var semester_id = $('#form-filter').find('#semester_id');
    var tingkat_id = $('#form-filter').find('#tingkat_id');
    var kelas_id = $('#form-filter').find('#kelas_id');
    

    
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

            $.ajax({
                url: '/iq/persentasepenilaian/json',
                type: 'GET',
                data: {
                    mapel_id: mapel_id.val(),
                },
                success: function(result){

                    var persentasepenilaian = result.rows[0];

                    table = $('#table').bootstrapTable('destroy').bootstrapTable({
                        classes: 'table table-striped table-bordered',
                        toolbar: '#table-toolbar',
                        url: '/iq/penilaian/json',
                        queryParams: function(params) {
                            params.mapel_id = mapel_id.val();
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
                                    rowspan: 3,
                                    valign: 'middle',
                                    formatter: function(value, row, index){

                                        
                                        // not as parent
                                        var buttons = ``;
                                        
                                        if(row.penilaian_id == null){
                                            buttons += `<button type="button" class="btn btn-success btn-xs btn-add" data-penempatansiswa_id="${value}" data-nama_siswa="${row.nama}"><i class="fa fa-plus"></i></button>`
                                        }else{
                                            buttons += `<button type="button" class="btn btn-success btn-xs btn-edit" data-penilaian_id="${row.penilaian_id}" data-nama_siswa="${row.nama}"><i class="fa fa-pencil"></i></button>`
                                        }
                                        return buttons;
                                        
                                    }
                                }, {
                                    field: 'nisn',
                                    title: 'NISN',
                                    rowspan: 3,
                                    valign: 'middle',
                                }, {
                                    field: 'nis_lokal',
                                    title: 'NIS',
                                    rowspan: 3,
                                    valign: 'middle',
                                }, {
                                    field: 'nama',
                                    title: 'Nama',
                                    valign: 'middle',
                                    class: 'text-nowrap',
                                    rowspan: 3,
                                    
                                }, {
                                    title: 'Pengetahuan',
                                    colspan: 5,
                                    align: 'center',
                                    valign: 'middle',
                                }, {
                                    title: 'Keterampilan',
                                    colspan: 7,
                                    align: 'center',
                                    valign: 'middle',
                                }, {
                                    title: 'Sikap Spriritual dan Sosial',
                                    colspan: 6,
                                    align: 'center',
                                    valign: 'middle',
                                }, {
                                    title: 'Deskripsi',
                                    colspan: 6,
                                    align: 'center',
                                    valign: 'middle',
                                }
                            ],
                            [
                                {
                                    title: persentasepenilaian.pengetahuan_tnh + '%',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {   
                                    title: persentasepenilaian.pengetahuan_nilai_uts + '%',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {   
                                    title: persentasepenilaian.pengetahuan_nilai_uas + '%',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'pengetahuan_nilai_rapor_dayah',
                                    title: 'Nilai Rapor Dayah',
                                    align: 'center',
                                    valign: 'middle',
                                    rowspan: 2,
                                },
                                {
                                    field: 'pengetahuan_nilai_rapor_sekolah',
                                    title: 'Nilai Rapor Sekolah',
                                    align: 'center',
                                    valign: 'middle',
                                    rowspan: 2,
                                },
                                {   
                                    title: persentasepenilaian.keterampilan_tnh + '%',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {   
                                    title: persentasepenilaian.keterampilan_projek + '%',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {   
                                    title: persentasepenilaian.keterampilan_porto + '%',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {   
                                    title: persentasepenilaian.keterampilan_nilai_uts + '%',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {   
                                    title: persentasepenilaian.keterampilan_nilai_uas + '%',  
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'keterampilan_total_nilai',
                                    title: 'Total Nilai',
                                    align: 'center',
                                    valign: 'middle',
                                    rowspan: 2,
                                },
                                {
                                    field: 'keterampilan_nilai_rapor_sekolah',
                                    title: 'Nilai Rapor Sekolah',
                                    align: 'center',
                                    valign: 'middle',
                                    rowspan: 2,
                                },
                                {   
                                    title: persentasepenilaian.sikap_tnh + '%',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {   
                                    title: persentasepenilaian.sikap_pd + '%',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {   
                                    title: persentasepenilaian.sikap_ps + '%',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {   
                                    title: persentasepenilaian.sikap_jurnal + '%',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {   
                                    title: persentasepenilaian.sikap_nilai_akhir + '%',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'sikap_nilai_rapor_sekolah',
                                    title: 'Nilai Rapor Sekolah',
                                    align: 'center',
                                    valign: 'middle',
                                    rowspan: 2,
                                },
                                {
                                    title: 'Pengetahuan',
                                    align: 'center',
                                    valign: 'middle',
                                    colspan: 2,
                                },
                                {
                                    title: 'Keterampilan',
                                    align: 'center',
                                    valign: 'middle',
                                    colspan: 2,
                                },
                                {
                                    title: 'Sikap Spiritual dan Sosial',
                                    align: 'center',
                                    valign: 'middle',
                                    colspan: 2,
                                },
                            ],
                            [
                                {
                                    field: 'pengetahuan_tnh',
                                    title: 'TNH',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'pengetahuan_nilai_uts',
                                    title: 'UTS',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'pengetahuan_nilai_uas',
                                    title: 'UAS',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'keterampilan_tnh',
                                    title: 'TNH',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'keterampilan_projek',
                                    title: 'Projek',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'keterampilan_porto',
                                    title: 'Porto',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'keterampilan_nilai_uts',
                                    title: 'UTS',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'keterampilan_nilai_uas',
                                    title: 'UAS',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'sikap_tnh',
                                    title: 'TNH',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'sikap_pd',
                                    title: 'PD',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'sikap_ps',
                                    title: 'PS',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'sikap_jurnal',
                                    title: 'Jurnal',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'sikap_nilai_akhir',
                                    title: 'Nilai Akhir',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'pengetahuan_predikat_huruf',
                                    title: 'Pred',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'pengetahuan_predikat_deskripsi',
                                    title: 'Deskripsi',
                                    valign: 'middle',
                                    align: 'left',
                                    class: 'text-nowrap'
                                },
                                {
                                    field: 'keterampilan_predikat_huruf',
                                    title: 'Pred',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'keterampilan_predikat_deskripsi',
                                    title: 'Deskripsi',
                                    valign: 'middle',
                                    align: 'left',
                                    class: 'text-nowrap'
                                },
                                {
                                    field: 'sikap_predikat_huruf',
                                    title: 'Pred',
                                    valign: 'middle',
                                    align: 'center',
                                },
                                {
                                    field: 'sikap_predikat_deskripsi',
                                    title: 'Deskripsi',
                                    valign: 'middle',
                                    align: 'left',
                                    class: 'text-nowrap'
                                },
                            ]
                        ]
                    });
                }
            });

                    

            tablePersentasepenilaian = $('#table-persentasepenilaian').bootstrapTable('destroy').bootstrapTable({
                classes: 'table table-striped table-bordered',
                toolbar: '#table-toolbar',
                url: '/iq/persentasepenilaian/json',
                queryParams: function(params) {
                    params.mapel_id = mapel_id.val();
                    return params;
                },
                sidePagination: 'server',
                pagination: true,
                paginationLoop: true,
                pageList: [5, 10, 20, 50, 100, 200],
                showRefresh: true,
                checkbox: true,
                columns: [
                    [
                        {
                            field: 'id',
                            title: 'Action',
                            rowspan: 2,
                            valign: 'middle',
                            formatter: function(value, row, index){

                                
                                // not as parent
                                var buttons = ``;
                                
                                if(value == null){
                                    buttons += `<button type="button" class="btn btn-success btn-xs btn-add-persentasepenilaian" data-mapel_id="${row.mapel_id}"><i class="fa fa-plus"></i></button>`
                                }else{
                                    buttons += `<button type="button" class="btn btn-success btn-xs btn-edit-persentasepenilaian" data-id="${value}"><i class="fa fa-pencil"></i></button>`
                                }
                                return buttons;
                                
                            }
                        }, {
                            title: 'Pengetahuan',
                            colspan: 3,
                            align: 'center',
                            valign: 'middle',
                        }, {
                            title: 'Keterampilan',
                            colspan: 5,
                            align: 'center',
                            valign: 'middle',
                        }, {
                            title: 'Sikap Spriritual dan Sosial',
                            colspan: 5,
                            align: 'center',
                            valign: 'middle',
                        }
                    ],
                    [
                        {
                            field: 'pengetahuan_tnh',
                            title: 'TNH',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        },
                        {
                            field: 'pengetahuan_nilai_uts',
                            title: 'UTS',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        },
                        {
                            field: 'pengetahuan_nilai_uas',
                            title: 'UAS',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        },
                        {
                            field: 'keterampilan_tnh',
                            title: 'TNH',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        },
                        {
                            field: 'keterampilan_projek',
                            title: 'Projek',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        },
                        {
                            field: 'keterampilan_porto',
                            title: 'Porto',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        },
                        {
                            field: 'keterampilan_nilai_uts',
                            title: 'UTS',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        },
                        {
                            field: 'keterampilan_nilai_uas',
                            title: 'UAS',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        },
                        {
                            field: 'sikap_tnh',
                            title: 'TNH',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        },
                        {
                            field: 'sikap_pd',
                            title: 'PD',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        },
                        {
                            field: 'sikap_ps',
                            title: 'PS',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        },
                        {
                            field: 'sikap_jurnal',
                            title: 'Jurnal',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        },
                        {
                            field: 'sikap_nilai_akhir',
                            title: 'Nilai Akhir',
                            valign: 'middle',
                            align: 'center',
                            formatter: function(value, row, index){
                                return value + '%';
                            }
                        }
                    ]
                ]
            });

            tablePredikatpengetahuan = $('#table-predikatpengetahuan').bootstrapTable('destroy').bootstrapTable({
                classes: 'table table-striped table-bordered',
                toolbar: '#table-toolbar',
                url: '/iq/predikatpengetahuan/json',
                queryParams: function(params) {
                    params.mapel_id = mapel_id.val();
                    return params;
                },
                sidePagination: 'server',
                search: true,
                pagination: true,
                paginationLoop: true,
                pageList: [5, 10, 20, 50, 100, 200],
                showRefresh: true,
                checkbox: true,
                columns: [

                    {
                        field: 'id',
                        title: 'Action',
                        valign: 'middle',
                        align: 'center',
                        formatter: function(value, row, index){
                            
                            var buttons = ``;
                            buttons += `<button type="button" class="btn btn-success btn-xs btn-edit-predikatpengetahuan" data-id="${value}"><i class="fa fa-pencil"></i></button>`;
                            
                            return buttons;
                            
                        }
                    },{
                        field: 'huruf',
                        title: 'Huruf',
                        valign: 'middle',
                        align: 'center',
                    },
                    {
                        field: 'lebih_kecil_atau_sama_dengan',
                        title: '<=',
                        valign: 'middle',
                        align: 'center',
                    },
                    {
                        field: 'deskripsi',
                        title: 'Deskripsi',
                        valign: 'middle',
                    }
                    
                ]
            });

            tablePredikatketerampilan = $('#table-predikatketerampilan').bootstrapTable('destroy').bootstrapTable({
                classes: 'table table-striped table-bordered',
                toolbar: '#table-toolbar',
                url: '/iq/predikatketerampilan/json',
                queryParams: function(params) {
                    params.mapel_id = mapel_id.val();
                    return params;
                },
                sidePagination: 'server',
                search: true,
                pagination: true,
                paginationLoop: true,
                pageList: [5, 10, 20, 50, 100, 200],
                showRefresh: true,
                checkbox: true,
                columns: [

                    {
                        field: 'id',
                        title: 'Action',
                        valign: 'middle',
                        align: 'center',
                        formatter: function(value, row, index){
                            
                            var buttons = ``;
                            buttons += `<button type="button" class="btn btn-success btn-xs btn-edit-predikatketerampilan" data-id="${value}"><i class="fa fa-pencil"></i></button>`;
                            
                            return buttons;
                            
                        }
                    },{
                        field: 'huruf',
                        title: 'Huruf',
                        valign: 'middle',
                        align: 'center',
                    },
                    {
                        field: 'lebih_kecil_atau_sama_dengan',
                        title: '<=',
                        valign: 'middle',
                        align: 'center',
                        class: 'text-nowrap',
                    },
                    {
                        field: 'deskripsi',
                        title: 'Deskripsi',
                        valign: 'middle',
                    }
                    
                ]
            });

            tablePredikatsikap = $('#table-predikatsikap').bootstrapTable('destroy').bootstrapTable({
                classes: 'table table-striped table-bordered',
                toolbar: '#table-toolbar',
                url: '/iq/predikatsikap/json',
                queryParams: function(params) {
                    params.mapel_id = mapel_id.val();
                    return params;
                },
                sidePagination: 'server',
                search: true,
                pagination: true,
                paginationLoop: true,
                pageList: [5, 10, 20, 50, 100, 200],
                showRefresh: true,
                checkbox: true,
                columns: [

                    {
                        field: 'id',
                        title: 'Action',
                        valign: 'middle',
                        align: 'center',
                        formatter: function(value, row, index){
                            
                            var buttons = ``;
                            buttons += `<button type="button" class="btn btn-success btn-xs btn-edit-predikatsikap" data-id="${value}"><i class="fa fa-pencil"></i></button>`;
                            
                            return buttons;
                            
                        }
                    },{
                        field: 'huruf',
                        title: 'Huruf',
                        valign: 'middle',
                        align: 'center',
                    },
                    {
                        field: 'lebih_kecil_atau_sama_dengan',
                        title: '<=',
                        valign: 'middle',
                        align: 'center',
                        class: 'text-nowrap',
                    },
                    {
                        field: 'deskripsi',
                        title: 'Deskripsi',
                        valign: 'middle',
                    }
                    
                ]
            });
        }else{
            $('#row-table').hide();
        }
    }

    

    tahunajaran_id.on('change', loadSelectSemester);

    tahunajaran_id.on('change', loadSelectKelas);
    tingkat_id.on('change', loadSelectKelas);

    semester_id.on('change', loadSelectMapel);
    kelas_id.on('change', loadSelectMapel);

    tahunajaran_id.on('change', loadTable);
    semester_id.on('change', loadTable);
    tingkat_id.on('change', loadTable);
    kelas_id.on('change', loadTable);
    mapel_id.on('change', loadTable);

    





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