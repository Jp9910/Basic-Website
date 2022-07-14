//fazer requisição ajax para recuperar os dados necessários

$(document).ready(function () {
	getUsuariosAjax();
});

function getUsuariosAjax()
{
	let pagina = $('#input-pagina').val();
	let qntPorPag = $('#input-qntPorPag').val();
	$.get("usuarios?pagina="+pagina+"&quantidade="+qntPorPag, montarTabelaUsuarios, "json");
}

function proximaPagina()
{
	let inputPagina = $('#input-pagina');
	valorDoInput = inputPagina.val()
	inputPagina.val(parseInt(valorDoInput)+1);
	getUsuariosAjax()
}

function paginaAnterior()
{
	let inputPagina = $('#input-pagina');
	valorDoInput = inputPagina.val()
	if(valorDoInput > 1) {
		inputPagina.val(parseInt(valorDoInput)-1);
		getUsuariosAjax()
	}
}

function montarTabelaUsuarios(data, textStatus, jqXHR)
{
	//escrever o html na página, usando o resultado (data)
	let $tbody = $('tbody');
	$tbody.html('');
	$.each(data, function(){
		let linha = novaLinha(this);
		linha.find('.botao-editar').on('click')
		$tbody.append(linha);
	})
}

function novaLinha(usuario)
{
	let linha = $('<tr>');
	let colunaNome = $('<td>').text(usuario.nome);
	let colunaLogin = $('<td>').text(usuario.login);
	let colunaEditar = $('<td>');
	let link = $("<a>").attr("href","/editar-usuario?id="+usuario.id).addClass("botao-editar");
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