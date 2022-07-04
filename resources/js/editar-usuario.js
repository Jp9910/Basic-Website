
// usar um parametro get e pega-lo usando o javascript
const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

$(document).ready(function () {
    getUsuarioAjax();
    //M.updateTextFields(); //reinitialize all the Materialize labels on the page if you are dynamically adding inputs.
    $('form').attr('action', '/editar-usuario/'+params.id);
    adicionarFuncaoBotaoExcluir();
    adicionarFuncaoBotaoEnviar();
});

function adicionarFuncaoBotaoEnviar()
{
    $('#botao-enviar').click(function() {
        let nome = $('#input-nome').val();
        let login = $('#input-login').val();
        let senha = $('#input-senha').val();
        let isAdmin = $("input[type='radio'][name='tipo_usuario']:checked").val();
        console.log(nome,login,senha,isAdmin);
        $.ajax({
            url: "usuario/"+params.id,
            type: 'PUT',
            data: {
                //não está aparecendo no $_REQUEST ?
                nome: nome,
                login: login,
                senha: senha,
                tipo_usuario: isAdmin
            },
            success: function(result) {
                $('#teste').append(result);
                $('#p-info').text('Usuário alterado. Recarregando página...');
                $('#p-info').show();
                $('#spinner').show();
                setTimeout(function(){
                    //window.location.replace(window.location.href)
                }, 3000)
            }
        })  .done(function() {
            console.log( "success" );
          })
          .fail(function() {
            console.log( "error" );
          })
          .always(function() {
            console.log( "complete" );
          });
         ;
    });
}

function adicionarFuncaoBotaoExcluir()
{
    $('#botao-excluir').click(function() {
        $.ajax({
            url: "usuario/"+params.id,
            type: 'DELETE',
            success: function(result) {
                $('#p-info').text('Usuário excluido. Redirecionando...');
                $('#p-info').show();
                $('#spinner').show();
                setTimeout(function(){
                    window.location.replace("/listar-usuarios")
                }, 3000)
            }
        });
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