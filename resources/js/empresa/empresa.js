
$(document).ready(function () {
    getEmpresasAjax();
    adicionarFuncaoBotaoAdicionarEmpresa();
    $('#navbar').load('/navbar'); // loads the html from route /navbar in the #navbar component
});

function adicionarFuncaoBotaoAdicionarEmpresa()
{
    $('#botao-enviar').click(function(e) {
        e.preventDefault();
        let nome = $('#input-nome').val();
        let request = $.ajax({
            url: "empresa",
            type: 'POST',
            data: {
                nome: nome
            },
            success: function(result) {
                getEmpresasAjax();
            }
        });
    });
}

function getEmpresasAjax()
{
	$.get("lista-empresas", montarTabelaEmpresas, "json");
}

function montarTabelaEmpresas(data, textStatus, jqXHR)
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

function novaLinha(empresa)
{
	let linha = $('<tr>');
	let colunaNome = $('<td>').text(empresa.nome);
	let colunaEditar = $('<td>');
	let linkEditar = $("<a>").attr("href","/editar-empresa?id="+empresa.id).addClass("botao-editar");
	let iconeEditar = $("<i>").addClass("small").addClass("material-icons").text("edit");
	//let linkExcluir = $("<a>").attr("href","/excluir-empresa?id="+empresa.id).addClass("botao-excluir");
	//let iconeExcluir = $("<i>").addClass("small").addClass("material-icons").text("delete");
	linkEditar.append(iconeEditar);
	//linkExcluir.append(iconeExcluir);
	colunaEditar.append(linkEditar);
	//colunaEditar.append('&emsp;'); //tab de 4 espaços entre os icones
	//colunaEditar.append(linkExcluir);
	// Os três <td> dentro do <tr>
	linha.append(colunaNome);
	linha.append(colunaEditar);

	return linha
}
