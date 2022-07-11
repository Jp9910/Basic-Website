//fazer requisição ajax para recuperar os dados necessários

$(document).ready(function () {
	getFiliadosAjax();
	$('#botao-atualizar').on('click', function(){
		getFiliadosAjax();
	});
});

function getFiliadosAjax()
{
	$.get("filiados", montarTabelaFiliados, "json");
}

function montarTabelaFiliados(data, textStatus, jqXHR)
{
	let $tbody = $('tbody');
    $tbody.html('');
	$.each(data, function(){
		let linha = novaLinha(this);
		linha.find('.botao-editar').on('click')
		$tbody.append(linha);
	})
}

function novaLinha(filiado)
{
	let linha = $('<tr>');
	let colunaNome = $('<td>').text(filiado.nome);
	let colunaCPF = $('<td>').text(filiado.CPF);
	let colunaRG = $('<td>').text(filiado.RG);
	let colunaDataNascimento = $('<td>').text(filiado.dataNascimento.date.substr(0,10));
	let colunaIdade = $('<td>').text(filiado.idade);
	let colunaTelefone = $('<td>').text(filiado.telefone);
	let colunaCelular = $('<td>').text(filiado.celular);
	let colunaEmpresa = $('<td>').text(filiado.empresa);
	let colunaCargo = $('<td>').text(filiado.cargo);
	let colunaSituacao = $('<td>').text(filiado.situacao);
	let colunaEditar = $('<td>');
	let link = $("<a>").attr("href","/editar-filiado?id="+filiado.id).addClass("botao-editar");
	let icone = $("<i>").addClass("small").addClass("material-icons").text("edit");
	// Icone dentro do <a>
	link.append(icone);
	// <a> dentro do <td>
	colunaEditar.append(link);
	// Os três <td> dentro do <tr>
	linha.append(colunaNome);
	linha.append(colunaCPF);
	linha.append(colunaRG);
	linha.append(colunaDataNascimento);
	linha.append(colunaIdade);
	linha.append(colunaTelefone);
	linha.append(colunaCelular);
	linha.append(colunaEmpresa);
	linha.append(colunaCargo);
	linha.append(colunaSituacao);
	linha.append(colunaEditar);

	return linha
}

//front -> requisição para api para pegar uma informação --> chama uma função do controller -->
//
//--> pega a informação acessando o bd (model) e transformando a info num objeto