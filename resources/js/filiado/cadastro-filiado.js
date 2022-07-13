
$(document).ready(function () {
	getFiliadosAjax();
	adicionarFuncaoBotaoAdicionarFiliado();
	$('#navbar').load('/navbar'); // loads the html from route /navbar in the #navbar component
});

function adicionarFuncaoBotaoAdicionarFiliado()
{
	$('#botao-enviar').click(function(e) {
		e.preventDefault();
		$('#botao-enviar').attr("disabled","true");
		$.ajax({
			url: "filiado",
			type: 'POST',
			data: {
				nome: $('#input-nome').val(),
				CPF: $('#input-CPF').val(),
				RG: $('#input-RG').val(),
				dataNascimento: $('#input-dataNascimento').val(),
				idade: $('#input-idade').val(),
				telefone: $('#input-telefone').val(),
				celular: $('#input-celular').val(),
				empresa: $('#input-empresa').val(),
				cargo: $('#input-cargo').val(),
				situacao: $('#input-situacao').val()
			},
			success: function(result) {
				$('#teste').append(result);
				getFiliadosAjax();
				$('#p-info').text('Filiado "'+$('#input-nome').val()+'" adicionado.');
				$('#p-info').show();
				$('#spinner').show();
				setTimeout(function(){
					window.location.replace(window.location.href)
				}, 3000);
			}
		}).fail(function(jqXHR, textStatus, errorThrown){
			$('#p-info').text(textStatus + ". " + errorThrown);
			$('#p-info').show();
		});
	});
}

function getFiliadosAjax()
{
	$.get("lista-filiados", montarTabelaFiliados, "json");
}

function montarTabelaFiliados(data, textStatus, jqXHR)
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

function novaLinha(filiado)
{
	let linha = $('<tr>');
	let colunaNome = $('<td>').text(filiado.nome);
	let colunaEditar = $('<td>');
	let linkEditar = $("<a>").attr("href","/editar-filiado?id="+filiado.id).addClass("botao-editar");
	let iconeEditar = $("<i>").addClass("small").addClass("material-icons").text("edit");
	linkEditar.append(iconeEditar);
	colunaEditar.append(linkEditar);
	linha.append(colunaNome);
	linha.append(colunaEditar);

	return linha
}
