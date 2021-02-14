define([
     "jQuery",
    "jQueryUI",
    "bootstrap",
    "bootstrapDatepicker",
    "datatables",
    "datatablesBootstrap",
    "jqvalidate",
    "sidebar",
    "select2"
    ], function (
    $,
    jQueryUI,
    bootstrap,
    datatables,
    bootstrapDatepicker,
    datatablesBootstrap,
    jqvalidate,
    sidebar,
    select2,
    ) {
    return {
        table:null,
        init: function () {
            App.initFunc();
            App.initEvent();
            App.initConfirm();

            App.searchTable();
            App.resetSearch();

            $(".dataTables_filter").hide();
            $(".loadingpage").hide();
        },
        initEvent : function(){
            $('.select2').select2();
            $('#datepicker').datepicker({
                defaultViewDate: '01/01/1990',
                uiLibrary: 'bootstrap4',
                format: 'dd/mm/yyyy',
            });
            App.table = $('#table').DataTable({
                "language": {
                    "search": "Cari",
                    "lengthMenu": "Tampilkan _MENU_ baris per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data yang ditampilkan ",
                    "infoFiltered": "(pencarian dari _MAX_ total records)",
                    "paginate": {
                        "first":      "Pertama",
                        "last":       "Terakhir",
                        "next":       "Selanjutnya",
                        "previous":   "Sebelum"
                    },
                },
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"user/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "role_name" },
                    { "data": "name" }, 
                    { "data": "email" }, 
                    { "data": "action" ,"orderable": false}
                ]
            });

            if($("#form").length > 0){
                $("#save-btn").removeAttr("disabled");
                $("#form").validate({
                     rules: {
                        name: {
                            required: true
                        },
                        email: {
                            required: true
                        },
                        kode_kab: {
                            required: true
                        },
                        username: {
                            required: ($("#user_id").length <= 0)
                        },
                        password: {
                            required: ($("#user_id").length <= 0),
                            minlength: 8
                        },
                        password_confirm: {
                            required: ($("#user_id").length <= 0),
                            minlength: 8,
                            equalTo: "#password"
                        },
                        role_id: {
                             required: ($("#user_id").length <= 0),
                        }
                    },
                    messages: {
                        name: {
                            required: "Nama Harus Diisi"
                        },
                        email: {
                            required: "Email Harus Diisi"
                        },
                        nip: {
                            required: "NIP Harus Diisi"
                        },
                        kode_kab: {
                            required: "Kabupaten harus dipilih"
                        },
                        username: {
                            required: "Username Harus Diisi"
                        },
                        password: {
                            required: "Password Harus Diisi",
                            minlength: "Minimal 8 "
                        },
                        password_confirm: {
                            required: "Ulangi Password Harus Diisi",
                            minlength: "Minimal 8 ",
                            equalTo: "Password Tidak Sama"
                        },
                        role_id: {
                            required: "Role Harus Diisi"
                        }
                    },
                    debug:true,

                    errorPlacement: function(error, element) {
                        var name = element.attr('name');
                        console.log(name);
                        var errorSelector = '.form-control-feedback[for="' + name + '"]';
                        var $element = $(errorSelector);
                        if ($element.length) {
                            $(errorSelector).html(error.html());
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    submitHandler : function(form) {
                        form.submit();
                    }
                });
            }

        },

        searchTable:function(){
            $('#search').on('click', function () {
                console.log("SEARCH");
                var name = $("#name").val();
                var company_field = $("#company").val();
                var phone = $("#phone").val();
                var email = $("#email").val();

                App.table.column(3).search(name,true,true);
                App.table.column(4).search(phone,true,true);
                App.table.column(5).search(email,true,true);

                App.table.draw();

            });
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () {
                $("#name").val("");
                $("#company").val("");
                $("#handphone").val("");
                $("#email").val("");

                App.table.search( '' ).columns().search( '' ).draw();
            });
        },

        initConfirm :function(){
            $('#table tbody').on( 'click', '.delete', function () {
                var url = $(this).attr("url");
                App.confirm("Apakah Anda Yakin Untuk Mengubah Ini?",function(){
                   $.ajax({
                      method: "GET",
                      url: url
                    }).done(function( msg ) {
                        App.table.ajax.reload(null,true);
                    });
                })
            });
        }
	}
});
