
$(document).ready(function () {
	buscarEmpresasAjax();
	buscarCargosAjax();
	buscarSituacaosAjax();
	adicionarFuncaoBotaoAdicionarFiliado();
	adicionarFuncaoBotaoAdicionarDependente();
	adicionarFuncaoBotaoRemoverDependente();
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

function adicionarFuncaoBotaoAdicionarDependente()
{
	$('#botao-adicionar-dependente').click(function(e){
		// Criando as tags html dinamicamente
		// e.preventDefault();
		// let qntDependentes = $('#qnt-dependentes');
		// let valorQnt = qntDependentes.val();
		// qntDependentes.val(parseInt(valorQnt)+1);
		// let section = $('#section-dependentes');
		// linha = $('<div>').addClass("row");
		// 	divNome = $('<div>').addClass("input-field col s3 offset-s2");
		// 		i = $('<i>').addClass("material-icons prefix").text('person');
		// 		input = $('<input>').attr({id:"input-dependente-nome", name:"dependente-nome", type:"text"});
		// 		label = $('<label>').attr("for","input-dependente-"+qntDependentes+"-nome").text("Nome do dependente");
		
		// divNome.append(i).append(input).append(label);
		// linha.append(divNome);
		// section.append(linha);

		// Mais fácil retornar html puro
		let qntDependentes = $('#qnt-dependentes');
		let valorQnt = qntDependentes.val();
		valorQnt = parseInt(valorQnt) + 1;
		qntDependentes.val(valorQnt);
		let section = $('#section-dependentes');
		section.append(`
		<div class="row" id="dependente-${valorQnt}">
			<div class="input-field col s3 offset-s2">
				<i class="material-icons prefix">person</i>
				<input id="input-dependente-${valorQnt}-nome" name="dependente-${valorQnt}-nome" type="text">
				<label for="input-dependente-${valorQnt}-nome">Nome do dependente ${valorQnt}</label>
			</div>
			<div class="input-field col s3">
				<i class="material-icons prefix">date_range</i>
				<input id="input-dependente-${valorQnt}-dataNascimento" name="dependente-${valorQnt}-dataNascimento" type="date">
				<label for="input-dependente-${valorQnt}-dataNascimento">Data de nascimento do dependente ${valorQnt}</label>
			</div>
			<div class="input-field col s3">
				<i class="material-icons prefix">supervisor_account</i>
				<input id="input-dependente-${valorQnt}-parentesco" name="dependente-${valorQnt}-parentesco" type="text">
				<label for="input-dependente-${valorQnt}-parentesco">Grau de Parentesco do dependente ${valorQnt}</label>
			</div>
		</div>
		`);
	});
}

function adicionarFuncaoBotaoRemoverDependente()
{
	$('#botao-remover-dependente').click(function(e){
		e.preventDefault();
		let qntDependentes = $('#qnt-dependentes');
		let valorQnt = qntDependentes.val();
		$(`#dependente-${valorQnt}`).remove()
		valorQnt = parseInt(valorQnt) - 1;
		qntDependentes.val(valorQnt);
	});
}