
// usar um parametro get e pega-lo usando o javascript
const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

$(document).ready(function () {
    getCargoAjax();
    $('form').attr('action', '#');
    adicionarFuncaoBotaoExcluir();
    adicionarFuncaoBotaoEnviar();
    $('#navbar').load('/navbar'); // loads the html from route /navbar in the #navbar component
});

function adicionarFuncaoBotaoEnviar()
{
    $('#botao-enviar').click(function() {
        let nome = $('#input-nome').val();
        $.ajax({
            url: "cargo?id="+params.id+"&nome="+nome,
            type: 'PUT',
            success: function(result) {
                $('#teste').append(result);
                $('#p-info').text('Cargo alterado. Recarregando página...');
                $('#p-info').show();
                $('#spinner').show();
                setTimeout(function(){
                    window.location.replace(window.location.href)
                }, 3000)
            }
        }).fail(function(jqXHR, textStatus, errorThrown){
            $('#p-info').text(textStatus + ". " + errorThrown);
            $('#p-info').show();
        });
    });
}

function adicionarFuncaoBotaoExcluir()
{
    $('#botao-excluir').click(function() {
        $.ajax({
            url: "cargo?id="+params.id,
            type: 'DELETE',
            success: function(result) {
                $('#p-info').text('Cargo excluido. Voltando para listagem...');
                $('#p-info').show();
                $('#spinner').show();
                setTimeout(function(){
                    window.location.replace("/cargos")
                }, 3000)
            }
        });
    });
}

function getCargoAjax()
{
    $.get("/cargo?id="+params.id, preencherInfoCargo ,"json");
}

function preencherInfoCargo(data, textStatus, jqXHR)
{
    $('#input-nome').val(data.nome)
}