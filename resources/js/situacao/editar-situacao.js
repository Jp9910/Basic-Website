
// usar um parametro get e pega-lo usando o javascript
const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

$(document).ready(function () {
    getSituacaoAjax();
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
            url: "situacao?id="+params.id+"&nome="+nome,
            type: 'PUT',
            success: function(result) {
                $('#teste').append(result);
                $('#p-info').text('Situacao alterado. Recarregando página...');
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
            url: "situacao?id="+params.id,
            type: 'DELETE',
            success: function(result) {
                $('#p-info').text('Situacao excluido. Voltando para listagem...');
                $('#p-info').show();
                $('#spinner').show();
                setTimeout(function(){
                    window.location.replace("/situacoes")
                }, 3000)
            }
        });
    });
}

function getSituacaoAjax()
{
    $.get("/situacao?id="+params.id, preencherInfoSituacao ,"json");
}

function preencherInfoSituacao(data, textStatus, jqXHR)
{
    $('#input-nome').val(data.nome)
}