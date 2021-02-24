$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    dataSource = new kendo.data.DataSource({
        transport: {
            read: {
                url: "/pessoa/grid",
                dataType: "json"
            },
            update: {
                url: "/pessoa",
                method: "POST",
                dataType: "json",
            },
            destroy: {
                url: "/pessoa/destroy",
                dataType: "json",
                method: "DELETE",
            },
            create: {
                url: "/pessoa",
                method: "POST",
                dataType: "json",
            },
            parameterMap: function(options, operation) {
                if (operation !== "read" && options.models) {
                    return { models: kendo.stringify(options.models) };
                }
            }
        },
        batch: true,
        pageSize: 20,
        schema: {
            model: {
                id: "id",
                fields: {
                    id: { editable: false, nullable: true },
                    nome: { validation: { required: true } },
                    nascimento: { type: "date", validation: { required: true, min: 1 } },
                    pais_id: { validation: { required: true } },
                    genero: { nullable: true },
                }
            }
        }
    });

    $("#grid").kendoGrid({
        dataSource: dataSource,
        pageable: true,
        height: 550,
        toolbar: ["create"],
        columns: [
            { field: "nome", title: "Nome" },
            { field: "nascimento", title: "Dt. Nascimento", format: "{0:dd/MM/yyyy}" },
            { field: "genero", title: "Gênero", editor: onDrpGenero },
            { field: "pais_id", title: "Pais", width: "250px", editor: onDrpPais },
            { command: ["edit", "destroy"], title: "Editar", width: "120px" }
        ],
        editable: "popup"
    });
});

function onDrpPais(container, options) {
    $('<input name="pais_id" data-bind="value:' + options.field + '"/>')
        .appendTo(container)
        .kendoDropDownList({
            dataTextField: "nome",
            dataValueField: "id",
            autoBind: false,
            dataSource: new kendo.data.DataSource({
                transport: {
                    read: {
                        url: "/pais",
                        dataType: "json"
                    },
                    schema: {
                        model: {
                            id: "id",
                            value: "nome"
                        }
                    }
                }
            })
        });
}

function onDrpGenero(container, options) {
    $('<input id="genero" name="genero" data-bind="value:' + options.field + '"/>')
        .appendTo(container)
        .kendoDropDownList({
            dataTextField: "nome",
            dataValueField: "id",
            autoBind: false,
            dataSource: new kendo.data.DataSource({
                transport: {
                    read: {
                        url: "/pessoa/genero",
                        dataType: "json"
                    },
                    schema: {
                        model: {
                            id: "id",
                            value: "nome"
                        }
                    }
                }
            })
        });
}