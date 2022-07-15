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
	// Aqui, _event.target_ é equivalente a _this_
	//console.log(event.target.value);
	let filiados = $('.filiado');
	if (event.target.value.length > 0) {
		filiados.each(function (index, element) {
			// element == this
			// Aqui o _this_ não mais se refere ao campo de input, mas sim ao elemento do loop each.
			// Então é preciso usar o parâmetro (event) para pegar o que foi digitado.
			let nome = $(this).find('.nome').text()
			let data = $(this).find('.dataNascimento').text()//.substr(5,7)
			//console.log("mes: "+ data)
			let expRegular = new RegExp(event.target.value, 'i') //flag 'i' indica para ser caseInsensitive
			if (!expRegular.test(nome) && !expRegular.test(data)) {
				$(this).addClass('invisivel');
			}
            else {
				$(this).removeClass('invisivel');
			}

			// Outro jeito de comparar sem usar regex
			// let nome = $(this).find('.nome').text()
			// let comparavel = nome.substr(0, event.target.value.length).toLowerCase()
			// if (!(event.target.value.toLowerCase() == comparavel)) {
			// 	element.classList.add("invisivel");
			// } else{
			// 	element.classList.remove("invisivel");
			// }
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
	let pagina = $('#input-pagina').val();
	let qntPorPag = $('#input-qntPorPag').val();
	$.get("filiados?pagina="+pagina+"&quantidade="+qntPorPag, montarTabelaFiliados, "json");
}


function proximaPagina()
{
	let inputPagina = $('#input-pagina');
	valorDoInput = inputPagina.val()
	inputPagina.val(parseInt(valorDoInput)+1);
	getFiliadosAjax()
}

function paginaAnterior()
{
	let inputPagina = $('#input-pagina');
	valorDoInput = inputPagina.val()
	if(valorDoInput > 1) {
		inputPagina.val(parseInt(valorDoInput)-1);
		getFiliadosAjax()
	}
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
	let colunaUltimaAtualizacao = $('<td>').addClass("ultimaAtualizacao").text(filiado.dataUltimaAtualizacao.date.substr(0,19))
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
	linha.append(colunaUltimaAtualizacao);
	linha.append(colunaEditar);

	return linha
}

//front -> requisição para api para pegar uma informação --> chama uma função do controller -->
//
//--> pega a informação acessando o bd (model) e transformando a info num objeto