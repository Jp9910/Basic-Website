
// usar um parametro get e pega-lo usando o javascript
const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

$(document).ready(function () {
    getEmpresaAjax();
    $('form').attr('action', '#');
    adicionarFuncaoBotaoExcluir();
    adicionarFuncaoBotaoEnviar();
    $('#navbar').load('/navbar'); // loads the html from route /navbar in the #navbar component
});

function adicionarFuncaoBotaoEnviar()
{
    $('#botao-enviar').click(function() {
        let nome = $('#input-nome').val();
        let request = $.ajax({
            //dados enviados pela url em vez de um payload (qual seria o mais correto?)
            url: "empresa?id="+params.id+"&nome="+nome,
            type: 'PUT',
            // data: {
            //     id: params.id,
            //     nome: nome
            // },
            // application/json; charset=utf-8
            // contentType: "application/x-www-form-urlencoded",
            // dataType: "json",
            success: function(result) {
                $('#teste').append(result);
                $('#p-info').text('Empresa alterada. Recarregando página...');
                $('#p-info').show();
                $('#spinner').show();
                setTimeout(function(){
                    window.location.replace(window.location.href)
                }, 3000)
            }
        }).done(function() {
            console.log( "success" );
        }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#p-info').text(textStatus + ". " + errorThrown);
            $('#p-info').show();
        }).always(function() {
            console.log( "complete" );
        });
        console.log(request);
    });
}

function adicionarFuncaoBotaoExcluir()
{
    $('#botao-excluir').click(function() {
        $.ajax({
            url: "empresa?id="+params.id,
            type: 'DELETE',
            success: function(result) {
                $('#p-info').text('Empresa excluida. Voltando para listagem...');
                $('#p-info').show();
                $('#spinner').show();
                setTimeout(function(){
                    window.location.replace("/empresas")
                }, 3000)
            }
        });
    });
}

function getEmpresaAjax()
{
    $.get("/empresa?id="+params.id, preencherInfoEmpresa ,"json");
}

function preencherInfoEmpresa(data, textStatus, jqXHR)
{
    $('#input-nome').val(data.nome)
}