
$(document).ready(function () {
	getSituacaosAjax();
	adicionarFuncaoBotaoAdicionarSituacao();
	$('#navbar').load('/navbar'); // loads the html from route /navbar in the #navbar component
});

function adicionarFuncaoBotaoAdicionarSituacao()
{
	$('#botao-enviar').click(function(e) {
		e.preventDefault();
		let nome = $('#input-nome').val();
		$.ajax({
			url: "situacao",
			type: 'POST',
			data: {
				nome: nome
			},
			success: function(result) {
				getSituacaosAjax();
				$('#p-info').text('Situacao "'+nome+'" adicionado.');
				$('#p-info').show();
			}
		}).fail(function(jqXHR, textStatus, errorThrown){
			$('#p-info').text(textStatus + ". " + errorThrown);
			$('#p-info').show();
		});
	});
}

function getSituacaosAjax()
{
	let pagina = $('#input-pagina').val();
	let qntPorPag = $('#input-qntPorPag').val();
	$.get("lista-situacaos?pagina="+pagina+"&quantidade="+qntPorPag, montarTabelaSituacaos, "json");
}

function proximaPagina()
{
	let inputPagina = $('#input-pagina');
	valorDoInput = inputPagina.val()
	inputPagina.val(parseInt(valorDoInput)+1);
	getSituacaosAjax()
}

function paginaAnterior()
{
	let inputPagina = $('#input-pagina');
	valorDoInput = inputPagina.val()
	if(valorDoInput > 1) {
		inputPagina.val(parseInt(valorDoInput)-1);
		getSituacaosAjax()
	}
}

function montarTabelaSituacaos(data, textStatus, jqXHR)
{
	let $tbody = $('tbody');
	$tbody.html('');
	$.each(data, function(){
		let linha = novaLinha(this);
		linha.find('.botao-editar').on('click')
		$tbody.append(linha);
	})
}

function novaLinha(situacao)
{
	let linha = $('<tr>');
	let colunaNome = $('<td>').text(situacao.nome);
	let colunaEditar = $('<td>');
	let linkEditar = $("<a>").attr("href","/editar-situacao?id="+situacao.id).addClass("botao-editar");
	let iconeEditar = $("<i>").addClass("small").addClass("material-icons").text("edit");
	linkEditar.append(iconeEditar);
	colunaEditar.append(linkEditar);
	linha.append(colunaNome);
	linha.append(colunaEditar);

	return linha
}
