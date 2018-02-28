$(function(){


    // filter elements
    var tahunajaran_id = $('#form-filter').find('#tahunajaran_id');
    var semester_id = $('#form-filter').find('#semester_id');
    var tingkat_id = $('#form-filter').find('#tingkat_id');
    var kelas_id = $('#form-filter').find('#kelas_id');

    
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

            table = $('#table').bootstrapTable('destroy').bootstrapTable({
                classes: 'table table-striped table-no-bordered',
                toolbar: '#table-toolbar',
                url: '/iq/mapeldayah/json',
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

                        format += `<button type="button" class="btn btn-success btn-xs btn-edit" data-id="${value}"><i class="fa fa-pencil"></i></button> `;
                        format += `<button type="button" class="btn btn-danger btn-xs btn-delete" data-id="${value}" data-identifier="${row.mapel}"><i class="fa fa-trash"></i></button> `;

                        return format;
                    }
                }, {
                    field: 'mapel',
                    title: 'Nama Mapel',
                    sortable: true
                }, {
                    field: 'mapel_hijaiyah',
                    title: 'Nama Mapel Hijaiyah',
                    sortable: true,
                    formatter: function(value, row, index){
                        return `<span style="font-size: 20px;">${value}<span>`;
                    }
                }, {
                    field: 'guru',
                    title: 'Guru',
                    sortable: true,
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




    // mapel

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
    });

    formAdd.on('submit', function(e){
        e.preventDefault();
        formAdd.find('.help-block').remove().end().find('.form-group').removeClass('has-error');
        var formData = {
            mapel: formAdd.find('#mapel').val(),
            mapel_hijaiyah: formAdd.find('#mapel_hijaiyah').val(),
            kelas_id: kelas_id.val(),
            guru_id: formAdd.find('#guru_id').val(),
            semester_id: semester_id.val()
        };

        $.ajax({
            url: '/iq/mapeldayah/create',
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



    $(document).on('click', '.btn-edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '/iq/mapeldayah/find',
            type: 'GET',
            data: {
                id: id
            },
            success: function(result){
                if(result !== ''){
                    $.each(result, function(key, value){

                        formEdit.find('#' + key).val(value);

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
            url: '/iq/mapeldayah/update',
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
            url: '/iq/mapeldayah/delete',
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