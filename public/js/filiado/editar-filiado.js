
// usar um parametro get e pega-lo usando o javascript
const params = new Proxy(new URLSearchParams(window.location.search), {
	get: (searchParams, prop) => searchParams.get(prop),
});

$(document).ready(function () {
	$('#spinner').show();
	buscarEmpresasAjax();
	buscarCargosAjax();
	buscarSituacaosAjax();
	getFiliadoAjax();
	$('form').attr('action', '#');
	adicionarFuncaoBotaoExcluir();
	adicionarFuncaoBotaoEnviar();
	$('#navbar').load('/navbar'); // loads the html from route /navbar in the #navbar component
});

function adicionarFuncaoBotaoEnviar()
{
	$('#botao-enviar').click(function() {
		$.ajax({
			url: "filiado?id="+params.id,
			type: 'PUT',
			data: {
				id: params.id,
				nome: $('#input-nome').val(),
				telefone: $('#input-telefone').val(),
				celular: $('#input-celular').val(),
				empresa: $('#select-empresa').val(),
				cargo: $('#select-cargo').val(),
				situacao: $('#select-situacao').val()
			},
			success: function(result) {
				$('#teste').append(result);
				$('#p-info').text('Filiado alterado. Recarregando página...');
				$('#p-info').show();
				$('#spinner').show();
				setTimeout(function(){
					window.location.replace(window.location.href)
				}, 3000)
			}
		}).fail(function(jqXHR, textStatus, errorThrown){
			$('#p-info').text(textStatus + ". " + errorThrown);
			$('#p-info').show();
		});
	});
}

function adicionarFuncaoBotaoExcluir()
{
	$('#botao-excluir').click(function() {
		$.ajax({
			url: "filiado?id="+params.id,
			type: 'DELETE',
			success: function(result) {
				$('#p-info').text('Filiado excluido. Voltando para listagem...');
				$('#p-info').show();
				$('#spinner').show();
				setTimeout(function(){
					window.location.replace("/listar-filiados")
				}, 3000)
			}
		});
	});
}

function getFiliadoAjax()
{
	$.get("/filiado?id="+params.id, preencherInfoFiliado ,"json");
}

function preencherInfoFiliado(data, textStatus, jqXHR)
{
	setTimeout(function(){
		$('#input-nome').val(data.nome);
		$('#input-CPF').val(data.CPF);
		$('#input-RG').val(data.RG);
		$('#input-dataNascimento').val(data.dataNascimento.date.substr(0,10));
		$('#input-idade').val(data.idade);
		$('#input-telefone').val(data.telefone);
		$('#input-celular').val(data.celular);
		$('#select-empresa').val(data.empresa);
		$('#select-cargo').val(data.cargo);
		$('#select-situacao').val(data.situacao);
		$('#spinner').hide();
	}, 500)
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