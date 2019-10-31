new IOService({
    name: 'Financeiro',
},
    function (self) {
        $(this).attr('aria-pressed', true);

        let form = document.getElementById(self.dfId);
        let fv1 = FormValidation.formValidation(
            form,
            {
                fields: {
                    first_name: {
                        validators: {
                            notEmpty: {
                                enabled: true,
                                message: 'O nome é obrigatório'
                            },
                        }
                    },
                    last_name: {
                        validators: {
                            notEmpty: {
                                enabled: true,
                                message: 'O sobrenome é obrigatório'
                            },
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                enabled: true,
                                message: 'O email é obrigatória'
                            },
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'A senha é obrigatória'
                            },
                        }
                    },
                    confirm_password: {
                        validators: {
                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'A senha e a confirmação de senha devem ser iguais'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    icon: new FormValidation.plugins.Icon({
                        valid: 'fv-ico ico-check',
                        invalid: 'fv-ico ico-close',
                        validating: 'fv-ico ico-gear ico-spin'
                    }),
                },
            }).setLocale('pt_BR', FormValidation.locales.pt_BR);
        self.fv = [fv1];

        self.wizardActions(function () {
        });

        self.dt = $('#default-table').DataTable({
            aaSorting: [[0, "desc"]],
            ajax: self.path + '/list',
            initComplete: function () {
                //parent call
                let api = this.api();
                this.teste = 10;
                $.fn.dataTable.defaults.initComplete(this);

                //pickadate objects initialization
                $('#ft_dtini').pickadate({
                }).pickadate('picker').on('set', function (t) {
                    $('#ft_dtfim').pickadate().pickadate('picker').clear();
                    if (t.select !== undefined)
                        $('#ft_dtfim').pickadate().pickadate('picker').set('min', new Date(t.select));
                    else
                        $('#ft_dtfim').pickadate().pickadate('picker').set('min', false)
                    api.draw()
                });

                $('#ft_dtfim').pickadate().pickadate('picker').on('render', function () {
                    api.draw()
                });

                api.addDTBetweenDatesFilter({
                    column: 'created_at',
                    min: $('#ft_dtini'),
                    max: $('#ft_dtfim')
                });

                api.addDTSelectFilter([
                    { el: $('#ft_status'), column: 'status' },
                    //verificar cats e subcats durante os filtros, tem que fazer outras N verificações
                    //{ el: $('#ft_category'), column: 'categories', format: "|{{value}}|" },
                    //{ el: $('#ft_subcategory'), column: 'categories', format: "|{{value}}|" },
                ]);
                /*$("#ft_category").change(function (e) {
                    if ($(this).val() == '')
                        $("#ft_subcategory").prop('disabled', 'disabled').find('option').remove().end();
                    else
                        $.ajax({
                            url: '/categories/list/' + $(this).val(),
                            dataType: "json",
                            success: function (data) {
                                if (data.length > 0) {
                                    $("#ft_subcategory").removeAttr('disabled');
                                    let arr = [{ value: '', text: '' }];
                                    $.each(data, function (i, item) {
                                        arr.push({ value: item.id, text: item.category });
                                    });
                                    refreshSelect($("#ft_subcategory"), arr);
                                }
                                else
                                    $("#ft_subcategory").prop('disabled', 'disabled').find('option').remove();
                            }
                        });
                });*/
            },
            footerCallback: function (row, data, start, end, display) {

            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nome_fantasia', name: 'nome_fantasia' },
                { data: 'forma_pgto', name: 'forma_pgto' },
                { data: 'vencimento', name: 'vencimento' },
                { data: 'valorp', name: 'valorp' },
                { data: 'parcela', name: 'parcela' },
                { data: 'parcela_parcial', name: 'parcela_parcial' },
                { data: 'actions', name: 'actions' }
            ],
            columnDefs:
                [
                    { targets: '__dt_', width: "5%", searchable: false, orderable: true },
                    { targets: '__dt_contrato', width: "10%", searchable: true, orderable: true },
                    {
                        targets: '__dt_valor', width: "12%", className: "text-right", searchable: true, orderable: true, render: function (data) {
                            data = parseFloat(data).toFixed(2);
                            return data;
                        }
                    },
                    { targets: '__dt_parcelas', width: "10%", orderable: true, class: "text-center" },
                    { targets: '__dt_status', width: "10%", orderable: true, class: "text-center" },
                    {
                        targets: '__dt_data-pedido', width: "15%", className: "text-center", searchable: true, orderable: true, render: function (data, type, row, y) {
                            return data.substr(8, 2) + '/' + data.substr(5, 2) + '/' + data.substr(0, 4) + data.substr(10, 6);
                        }
                    },
                    {
                        targets: '__dt_acoes', width: "7%", className: "text-center", searchable: false, orderable: false, render: function (data, type, row, y) {
                            return self.dt.addDTButtons({
                                buttons: [
                                    { ico: 'ico-eye', _class: 'text-primary', title: 'Visualizar Documentos' },
                                    { ico: 'ico-book-users', _class: row.status == "serasa" ? 'text-info' : 'invisible', title: 'Validar Serasa' },
                                    { ico: 'ico-check', _class: row.status == "contrato" ? 'text-success' : 'invisible', title: 'Autorizar Contrato' },
                                    { ico: 'ico-trash', _class: 'text-danger', title: 'Excluir' }
                                ]
                            });
                        }
                    }
                ]
        }).on('click', ".btn-dt-button[data-original-title=Editar]", function () {
            var data = self.dt.row($(this).parents('tr')).data();
            self.view(data.id);
        }).on('click', '.ico-trash', function () {
            var data = self.dt.row($(this).parents('tr')).data();
            self.delete(data.id);
        }).on('click', '.ico-eye', function () {
            var data = self.dt.row($(this).parents('tr')).data();
            $.ajax({
                url: '/admin/contrato/listUploads/' + data.id,
                method: 'GET',
                beforeSend: function () {
                    HoldOn.open({ message: "Carregando dados, aguarde...", theme: 'sk-bounce' });
                },
                success: function (data) {
                    HoldOn.close();
                    if (data.success) {
                        //
                        $('#default-tablist-container #tabdefault-tablist2').html(data.message);
                        $('.nav-link[aria-controls="tabdefault-tablist2"]').show();
                        $('#default-tablist .nav-link[aria-controls="tabdefault-tablist2"]').addClass('active');
                        $('#default-tablist .nav-link[aria-controls="tabdefault-tablist1"]').removeClass('active');
                        $('#default-tablist-container #tabdefault-tablist2').addClass('active');
                        $('#default-tablist-container #tabdefault-tablist1').removeClass('active');
                        $('#default-tablist .nav-link[aria-controls="tabdefault-tablist1"]').click(function () {
                            $('.nav-link[aria-controls="tabdefault-tablist2"]').hide();
                        });
                    } else {
                        swal({
                            title: "Não foi possível carregar os documentos.",
                            confirmButtonText: 'OK',
                            type: "error",
                        });
                    }
                },
                error: function (ret) {
                    self.defaults.ajax.onError(ret, self.callbacks.create.onError);
                }
            });//end ajax
        }).on('click', '.ico-check', function () {
            var data = self.dt.row($(this).parents('tr')).data();
            $.ajax({
                url: '/admin/contrato/createActivation/' + data.id,
                method: 'GET',
                beforeSend: function () {
                    HoldOn.open({ message: "Executando, aguarde...", theme: 'sk-bounce' });
                },
                success: function (data) {
                    HoldOn.close();
                    if (data.success) {
                        //
                    } else {
                        swal({
                            title: "Não foi possível carregar os documentos.",
                            confirmButtonText: 'OK',
                            type: "error",
                        });
                    }
                },
                error: function (ret) {
                    self.defaults.ajax.onError(ret, self.callbacks.create.onError);
                }
            });//end ajax
        }).on('draw.dt', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        self.callbacks.view = view(self);

        self.callbacks.update.onSuccess = function (data) {
            if (data.email)
                toastr.success("Clique no link presente no email para ativar o cadastro", "Um email de confirmação foi enviado para " + data.email, { timeOut: 10000 })
            self.tabs['listar'].tab.tab('show');
        }

        self.callbacks.create.onSuccess = function (data) {
            toastr.success("Clique no link presente no email para ativar o cadastro", "Um email de confirmação foi enviado para " + data.data, { timeOut: 10000 })
            self.dt.ajax.reload();
            self.dt.draw(true);
            self.tabs['listar'].tab.tab('show');
        }

        self.callbacks.unload = function (self) {
            $(".aanjulena-btn-toggle").aaDefaultState();

            $('#__sl-main-group').find('.list-group-item').each(function (i, obj) {
                let appended = false;
                $('.__sl-box-source').each(function (j, source) {
                    if ($(source).find('.list-group-item').length < 9 && !appended) {
                        $(obj).appendTo($(source));
                        appended = true;
                    }
                });
            });

            self.fv[0].enableValidator('password');

        }

    }

);

//CRUD CallBacks
function view(self) {
    return {
        onSuccess: function (data) {
            $("[name='first_name']").val(data.first_name);
            $("[name='last_name']").val(data.last_name);
            $("[name='email']").val(data.email);
            $("#admin").aaToggle(data.admin);
            for (var permission in data.permissions) {
                $('input[name="permissions[' + permission + ']"]').prop("checked", true);
            }
            self.fv[0].disableValidator('password');
        },
        onError: function (self) {
            console.log('executa algo no erro do callback');
        }
    }
}
