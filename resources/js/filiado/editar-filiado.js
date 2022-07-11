
// usar um parametro get e pega-lo usando o javascript
const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

$(document).ready(function () {
    getFiliadoAjax();
    $('form').attr('action', '#');
    adicionarFuncaoBotaoExcluir();
    adicionarFuncaoBotaoEnviar();
    $('#navbar').load('/navbar'); // loads the html from route /navbar in the #navbar component
});

function adicionarFuncaoBotaoEnviar()
{
    $('#botao-enviar').click(function() {
        $.ajax({
            url: "filiado?id="+params.id,
            type: 'PUT',
            data: {
                id: params.id,
                nome: $('#input-nome').val(),
                telefone: $('#input-telefone').val(),
                celular: $('#input-celular').val(),
                empresa: $('#input-empresa').val(),
                cargo: $('#input-cargo').val(),
                situacao: $('#input-situacao').val()
            },
            success: function(result) {
                $('#teste').append(result);
                $('#p-info').text('Filiado alterado. Recarregando página...');
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
            url: "filiado?id="+params.id,
            type: 'DELETE',
            success: function(result) {
                $('#p-info').text('Filiado excluido. Voltando para listagem...');
                $('#p-info').show();
                $('#spinner').show();
                setTimeout(function(){
                    window.location.replace("/listar-filiados")
                }, 3000)
            }
        });
    });
}

function getFiliadoAjax()
{
    $.get("/filiado?id="+params.id, preencherInfoFiliado ,"json");
}

function preencherInfoFiliado(data, textStatus, jqXHR)
{
    $('#input-nome').val(data.nome)
    $('#input-CPF').val(data.CPF)
    $('#input-RG').val(data.RG)
    $('#input-dataNascimento').val(data.dataNascimento.date.substr(0,10))
    $('#input-idade').val(data.idade)
    $('#input-telefone').val(data.telefone)
    $('#input-celular').val(data.celular)
    $('#input-empresa').val(data.empresa)
    $('#input-cargo').val(data.cargo)
    $('#input-situacao').val(data.situacao)
}