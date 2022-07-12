//fazer requisição ajax para recuperar os dados necessários

$(document).ready(function () {
	getFiliadosAjax();
	$('#botao-atualizar').on('click', function(){
		getFiliadosAjax();
	});
	$('#input-filtro').on('input', filtrarFiliados);
});

function filtrarFiliados(event)
{
	//console.log(event.target.value); // igual a console.log(this.value);
	console.log(this.value);
	let filiados = $('.filiado');
	if (this.value.length > 0) {
		filiados.each(function (index, element) {
			// element == this
			let nome = $(this).find('.nome').text()
			let expRegular = new RegExp(this.value, 'i') //flag 'i' indica para ser caseInsensitive
			if (!expRegular.test(nome)) {
				$(this).addClass('invisivel');
				console.log(nome + true)
			}
            else {
				$(this).removeClass('invisivel');
				console.log(nome + false)
			}
		});
	} else {
		filiados.each(function (index, element) {
			// element == this
			$(this).removeClass('invisivel');
		});
	}
}

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
	let linha = $('<tr>').addClass("filiado");
	let colunaNome = $('<td>').addClass("nome").text(filiado.nome);
	let colunaCPF = $('<td>').addClass("CPF").text(filiado.CPF);
	let colunaRG = $('<td>').addClass("RG").text(filiado.RG);
	let colunaDataNascimento = $('<td>').addClass("dataNascimento").text(filiado.dataNascimento.date.substr(0,10));
	let colunaIdade = $('<td>').addClass("idade").text(filiado.idade);
	let colunaTelefone = $('<td>').addClass("telefone").text(filiado.telefone);
	let colunaCelular = $('<td>').addClass("celular").text(filiado.celular);
	let colunaEmpresa = $('<td>').addClass("empresa").text(filiado.empresa);
	let colunaCargo = $('<td>').addClass("cargo").text(filiado.cargo);
	let colunaSituacao = $('<td>').addClass("situacao").text(filiado.situacao);
	let colunaEditar = $('<td>').addClass("editar");
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