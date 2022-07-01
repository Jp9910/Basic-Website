
// usar um parametro get e pega-lo usando o javascript
const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

$(document).ready(function () {
    getUsuarioAjax();
    //M.updateTextFields(); //reinitialize all the Materialize labels on the page if you are dynamically adding inputs.
    $('form').attr('action', '/editar-usuario/'+params.id);
    adicionarFuncaoBotaoExcluir();
});

function adicionarFuncaoBotaoExcluir()
{
    $('#botao-excluir').click(function() {
        //chamar api para excluir usuario
        console.log(3);
    });
}

function getUsuarioAjax()
{
    $.get("usuario/"+params.id, preencherInfoUsuario ,"json");
}

function preencherInfoUsuario(data, textStatus, jqXHR)
{
    console.log(data);
    $('#input-nome').val(data.nome)
    $('#input-login').val(data.login)
}