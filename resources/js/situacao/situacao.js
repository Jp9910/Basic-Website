
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
	$.get("lista-situacaos", montarTabelaSituacaos, "json");
}

function montarTabelaSituacaos(data, textStatus, jqXHR)
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
