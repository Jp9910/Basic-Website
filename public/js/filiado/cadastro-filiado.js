
$(document).ready(function () {
	buscarEmpresasAjax();
	buscarCargosAjax();
	buscarSituacaosAjax();
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
				empresa: $('#select-empresa').val(),
				cargo: $('#select-cargo').val(),
				situacao: $('#select-situacao').val()
			},
			success: function(result) {
				$('#teste').append(result);
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

function buscarEmpresasAjax()
{
	$.get("/all-empresas", montarSelectEmpresas, "json");
}

function buscarCargosAjax()
{
	$.get("/all-cargos", montarSelectCargos, "json");
}

function buscarSituacaosAjax()
{
	$.get("/all-situacaos", montarSelectSituacaos, "json");
}

function montarSelectEmpresas(data)
{
	let select = $('#select-empresa');
	data.forEach(element => {
		let option = $('<option>').attr('value',element.id).text(element.nome);
		select.append(option);
	});
}

function montarSelectCargos(data)
{
	let select = $('#select-cargo');
	data.forEach(element => {
		let option = $('<option>').attr('value',element.id).text(element.nome);
		select.append(option);
	});
}

function montarSelectSituacaos(data)
{
	let select = $('#select-situacao');
	data.forEach(element => {
		let option = $('<option>').attr('value',element.id).text(element.nome);
		select.append(option);
	});
}