$(function(){


    // filter elements
    var tahunajaran_id = $('#form-filter').find('#tahunajaran_id');
    var semester_id = $('#form-filter').find('#semester_id');
    var tingkat_id = $('#form-filter').find('#tingkat_id');
    var kelas_id = $('#form-filter').find('#kelas_id');
    var mapel_id = $('#form-filter').find('#mapel_id');

    
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
                url: '/iq/extrakurikuler/json_extrakurikuler',
                type: 'GET',
                data: {
                    tahunajaran_id: tahunajaran_id.val(),
                    tingkat_id: tingkat_id.val(),
                },
                success: function(result){

                    // var persentasepenilaian = result.rows[0];

                    var tableColumns = [
                        [
                            {
                                field: 'id',
                                title: 'Action',
                                valign: 'middle',
                                rowspan: 2,
                                formatter: function(value, row, index){

                                    
                                    // not as parent
                                    var buttons = ``;
                                    
                                    if(row.has_penilaianextrakurikuler == '0'){
                                        buttons += `<button type="button" class="btn btn-success btn-xs btn-add" data-penempatansiswa_id="${value}" data-nama_siswa="${row.nama}"><i class="fa fa-plus"></i></button>`
                                    }else{
                                        buttons += `<button type="button" class="btn btn-success btn-xs btn-edit" data-penempatansiswa_id="${value}" data-nama_siswa="${row.nama}"><i class="fa fa-pencil"></i></button>`
                                    }
                                    return buttons;
                                    
                                }
                            }, {
                                field: 'nisn',
                                title: 'NISN',
                                valign: 'middle',
                                rowspan: 2,
                            }, {
                                field: 'nis_lokal',
                                title: 'NIS',
                                valign: 'middle',
                                rowspan: 2,
                            }, {
                                field: 'nama',
                                title: 'Nama',
                                valign: 'middle',
                                class: 'text-nowrap',
                                rowspan: 2,
                            }
                        ], 
                        [], 
                    ];

                    
                    var args = [4, 0];
                    result.forEach(function(extrakurikuler){
                        args.push({
                            title: extrakurikuler.extrakurikuler,
                            align: 'center',
                            valign: 'middle',
                            class: 'text-nowrap',
                            colspan: 2
                        });
                    });

                    Array.prototype.splice.apply(tableColumns[0], args);

                    var args = [0, 0];
                    result.forEach(function(extrakurikuler){
                        args.push({
                            title: 'predikat',
                            field: extrakurikuler.extrakurikuler.toLowerCase().replace(' ', '_') + '_predikat' ,
                            align: 'center',
                            valign: 'middle',
                            class: 'text-nowrap',
                        }, {
                            title: 'keterangan',
                            field: extrakurikuler.extrakurikuler.toLowerCase().replace(' ', '_') + '_keterangan' ,
                            align: 'center',
                            valign: 'middle',
                            class: 'text-nowrap',
                        });
                    });

                    Array.prototype.splice.apply(tableColumns[1], args);

                    table = $('#table').bootstrapTable('destroy').bootstrapTable({
                        classes: 'table table-striped table-bordered',
                        toolbar: '#table-toolbar',
                        url: '/iq/penilaianextrakurikuler/json',
                        queryParams: function(params) {
                            params.tahunajaran_id = tahunajaran_id.val();
                            params.semester_id = semester_id.val();
                            params.tingkat_id = tingkat_id.val();
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
                        columns: tableColumns
                    });
                }
            });

            tableExtrakurikuler = $('#table-extrakurikuler').bootstrapTable('destroy').bootstrapTable({
                classes: 'table table-striped table-bordered',
                toolbar: '#table-toolbar-extrakurikuler',
                url: '/iq/extrakurikuler/json',
                queryParams: function(params) {
                    params.tahunajaran_id = tahunajaran_id.val();
                    params.tingkat_id = tingkat_id.val();
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
                            buttons += `<button type="button" class="btn btn-success btn-xs btn-edit-extrakurikuler" data-id="${value}"><i class="fa fa-pencil"></i></button> `;
                            buttons += `<button type="button" class="btn btn-danger btn-xs btn-delete-extrakurikuler" data-id="${value}" data-indentifier="${row.extrakurikuler}"><i class="fa fa-trash"></i></button>`;
                            
                            return buttons;
                            
                        }
                    },
                    {
                        field: 'extrakurikuler',
                        title: 'Extrakurikuler',
                        valign: 'middle',
                        align: 'center',
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

    tahunajaran_id.on('change', loadTable);
    semester_id.on('change', loadTable);
    tingkat_id.on('change', loadTable);
    kelas_id.on('change', loadTable);
    mapel_id.on('change', loadTable);

    


    // extrakurikuler
    var modalAddExtrakurikuler = $('#modal-add-extrakurikuler');
    var formAddExtrakurikuler = $('#form-add-extrakurikuler');

    var modalEditExtrakurikuler = $('#modal-edit-extrakurikuler');
    var formEditExtrakurikuler = $('#form-edit-extrakurikuler');

    var modalDeleteExtrakurikuler = $('#modal-delete-extrakurikuler');
    var formDeleteExtrakurikuler = $('#form-delete-extrakurikuler');

    $(document).on('click', '#btn-add-extrakurikuler', function(e){
        e.preventDefault();
        formAddExtrakurikuler.find('#tahunajaran_id').val(tahunajaran_id.val());
        formAddExtrakurikuler.find('#tingkat_id').val(tingkat_id.val());
        modalAddExtrakurikuler.modal('show');
    });

    formAddExtrakurikuler.on('submit', function(e){
        e.preventDefault();
        formAddExtrakurikuler.find('.help-block').remove().end().find('.form-group').removeClass('has-error');
        

        $.ajax({
            url: '/iq/extrakurikuler/create',
            type: 'POST',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    loadTable();
                    modalAddExtrakurikuler.modal('hide');
                    formAddExtrakurikuler.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formAddExtrakurikuler.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    });

    $(document).on('click', '.btn-edit-extrakurikuler', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/iq/extrakurikuler/find',
            type: 'GET',
            data: {
                id: id
            },
            success: function(result){
                if(result !== ''){
                    $.each(result, function(key, value){
                        formEditExtrakurikuler.find('#' + key).val(value);
                    });
                    modalEditExtrakurikuler.modal('show');

                }
            }
        });
    });

    formEditExtrakurikuler.on('submit', function(e){
        e.preventDefault();

        formEditExtrakurikuler.find('.help-block').remove().end().find('.form-group').removeClass('has-error');

        $.ajax({
            type: 'POST',
            url: '/iq/extrakurikuler/update',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    loadTable();
                    modalEditExtrakurikuler.modal('hide');
                    formEditExtrakurikuler.trigger('reset');
                }else if(result.status == 'error'){
                    $.each(result.error_messages, function(key, value){
                        formEditExtrakurikuler.find('#' + key).after(`<p class="help-block">${value}</p>`).parent().addClass('has-error');
                    });
                }
            }
        });
    });

    $(document).on('click', '.btn-delete-extrakurikuler', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var identifier = $(this).data('identifier');

        console.log('btn-delete clicked');

        formDeleteExtrakurikuler.find('#id').val(id);
        formDeleteExtrakurikuler.find('#identifier').html(identifier);
        modalDeleteExtrakurikuler.modal('show');
    });

    formDeleteExtrakurikuler.on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/iq/extrakurikuler/delete',
            data: $(this).serialize(),
            success: function(result){
                if(result.status == 'success'){
                    loadTable();
                    modalDeleteExtrakurikuler.modal('hide');
                    formDeleteExtrakurikuler.trigger('reset');
                }
            }
        })
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
        modalAdd.find('span#nama_siswa').html($(this).data('nama_siswa'));

        formAdd.find('#penempatansiswa_id').val($(this).data('penempatansiswa_id'));
        formAdd.find('#semester_id').val(semester_id.val());

        
        modalAdd.find('#modal-body-add-penilaiankurikulum').empty();
        $.ajax({
            url: '/iq/extrakurikuler/json_extrakurikuler',
            type: 'GET',
            data: {
                tahunajaran_id: tahunajaran_id.val(),
                tingkat_id: tingkat_id.val(),
            },
            success: function(result){
                result.forEach(function(extrakurikuler){
                    var html = `
                        <div class="row row-penilaianextrakurikuler">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>${extrakurikuler.extrakurikuler}</h4>
                                        <hr />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="predikat[${extrakurikuler.id}]">Predikat</label>
                                            <input type="text" class="form-control" id="predikat[${extrakurikuler.id}]" name="predikat[${extrakurikuler.id}]">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="keterangan[${extrakurikuler.id}]">Keterangan</label>
                                            <textarea name="keterangan[${extrakurikuler.id}]" id="keterangan[${extrakurikuler.id}]" cols="30" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    modalAdd.find('#modal-body-add-penilaiankurikulum').append(html);
                });
            }
        });
        
    });

    formAdd.on('submit', function(e){
        e.preventDefault();
        formAdd.find('.help-block').remove().end().find('.form-group').removeClass('has-error');
        

        $.ajax({
            url: '/iq/penilaianextrakurikuler/create',
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
        
        modalEdit.find('span#nama_siswa').html($(this).data('nama_siswa'));

        var penempatansiswa_id = $(this).data('penempatansiswa_id');

        formEdit.find('#penempatansiswa_id').val(penempatansiswa_id);
        formEdit.find('#semester_id').val(semester_id.val());

        $.ajax({
            url: '/iq/penilaianextrakurikuler/find',
            type: 'GET',
            data: {
                tahunajaran_id     : tahunajaran_id.val(),
                tingkat_id         : tingkat_id.val(),
                penempatansiswa_id : penempatansiswa_id,
                semester_id        : semester_id.val(),
            },
            success: function(result){

                modalEdit.find('#modal-body-edit-penilaiankurikulum').empty();

                result.forEach(function(extrakurikuler){
                    var html = `
                        <div class="row row-penilaianextrakurikuler">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>${extrakurikuler.extrakurikuler}</h4>
                                        <hr />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="predikat[${extrakurikuler.id}]">Predikat</label>
                                            <input type="text" class="form-control" id="predikat[${extrakurikuler.id}]" name="predikat[${extrakurikuler.id}]" value="${extrakurikuler.predikat || ''}">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="keterangan[${extrakurikuler.id}]">Keterangan</label>
                                            <textarea name="keterangan[${extrakurikuler.id}]" id="keterangan[${extrakurikuler.id}]" cols="30" rows="2" class="form-control">${extrakurikuler.keterangan || ''}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    modalEdit.find('#modal-body-edit-penilaiankurikulum').append(html);
                });

                modalEdit.modal('show');

            }
        });
    });

    formEdit.on('submit', function(e){
        e.preventDefault();

        formEdit.find('.help-block').remove().end().find('.form-group').removeClass('has-error');

        $.ajax({
            type: 'POST',
            url: '/iq/penilaianextrakurikuler/update',
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

});