//fazer requisição ajax para recuperar os dados necessários

getUsuariosAjax();

function getUsuariosAjax(){
    $.get("usuarios", montarTabelaUsuarios, "json");
}

function editarUsuario()
{
    ;
}

function montarTabelaUsuarios(data, textStatus, jqXHR)
{
    //escrever o html na página, usando o resultado (data)
    console.log(data);
    console.log(textStatus);
    console.log(jqXHR);
    let tbody = $('tbody');
    $.each(data, function(){
        let linha = novaLinha(this);
        linha.find('.botao-editar').on('click')
        tbody.append(linha);
    })
}

function novaLinha(usuario)
{
    let linha = $('<tr>');
    let colunaNome = $('<td>').text(usuario.nome);
    let colunaLogin = $('<td>').text(usuario.login);
    let colunaEditar = $('<td>');
    let link = $("<a>").attr("href","#").addClass("botao-editar");
    let icone = $("<i>").addClass("small").addClass("material-icons").text("edit");
    // Icone dentro do <a>
    link.append(icone);
    // <a> dentro do <td>
    colunaEditar.append(link);
    // Os três <td> dentro do <tr>
    linha.append(colunaNome);
    linha.append(colunaLogin);
    linha.append(colunaEditar);

    return linha
}

//front -> requisição para api para pegar uma informação --> chama uma função do controller -->
//
//--> pega a informação acessando o bd (model) e transformando a info num objeto