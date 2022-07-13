
$(document).ready(function () {
	getCargosAjax();
	adicionarFuncaoBotaoAdicionarCargo();
	$('#navbar').load('/navbar'); // loads the html from route /navbar in the #navbar component
});

function adicionarFuncaoBotaoAdicionarCargo()
{
	$('#botao-enviar').click(function(e) {
		e.preventDefault();
		let nome = $('#input-nome').val();
		$.ajax({
			url: "cargo",
			type: 'POST',
			data: {
				nome: nome
			},
			success: function(result) {
				getCargosAjax();
				$('#p-info').text('Cargo "'+nome+'" adicionado.');
				$('#p-info').show();
			}
		}).fail(function(jqXHR, textStatus, errorThrown){
			$('#p-info').text(textStatus + ". " + errorThrown);
			$('#p-info').show();
		});
	});
}

function getCargosAjax()
{
	$.get("lista-cargos", montarTabelaCargos, "json");
}

function montarTabelaCargos(data, textStatus, jqXHR)
{
	console.log(data);
	console.log(textStatus);
	console.log(jqXHR);
	let $tbody = $('tbody');
	$tbody.html('');
	$.each(data, function(){
		let linha = novaLinha(this);
		linha.find('.botao-editar').on('click')
		$tbody.append(linha);
	})
}

function novaLinha(cargo)
{
	let linha = $('<tr>');
	let colunaNome = $('<td>').text(cargo.nome);
	let colunaEditar = $('<td>');
	let linkEditar = $("<a>").attr("href","/editar-cargo?id="+cargo.id).addClass("botao-editar");
	let iconeEditar = $("<i>").addClass("small").addClass("material-icons").text("edit");
	linkEditar.append(iconeEditar);
	colunaEditar.append(linkEditar);
	linha.append(colunaNome);
	linha.append(colunaEditar);

	return linha
}
