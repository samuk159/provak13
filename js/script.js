$(document).ready(function()
{
    $("#cep").mask("99999-999");
	$(".telefone").mask("(99)99999-9999");
});

function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('logradouro').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('logradouro').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
			alertify.error("CEP não encontrado");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('logradouro').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
				alertify.error("Formato de CEP inválido");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
	
function add_telefone()
{
	/*if ($('#telefone2').is(':hidden'))
	{
	    $("#telefone2").show();	 
		check_telefones();
        return false;		
	}
	if ($('#telefone3').is(':hidden'))
	{
	    $("#telefone3").show();
        check_telefones();		
        return false;		
	}
	if ($('#telefone4').is(':hidden'))
	{
	    $("#telefone4").show();	
        check_telefones();		
        return false;		
	}
	if ($('#telefone5').is(':hidden'))
	{
	    $("#telefone5").show();	
        check_telefones();		
        return false;		
	}*/
};

function check_telefones()
{
    /*if ($('#telefone2').is(':visible') && $('#telefone3').is(':visible') && $('#telefone4').is(':visible') && $('#telefone5').is(':visible'))
	{
        document.getElementById('addtel').style.display = 'none';	 	
	}*/		
};

function toggleRow(e)
{
    var subRow = e.parentNode.parentNode.nextElementSibling;
    subRow.style.display = 'table-row'; /*subRow.style.display === 'none' ? 'table-row' : 'none';*/  
	$(e).mask("(99)99999-9999");
}

/*function checksubRowdISPLAY(id)
{
    if (document.getElementById(id).parentNode.parentNode.nextElementSibling.style.display === 'none')
	{
	    return true;	
	}
	else
	{
		return false;
	}
}*/

function botao(e)
{
	e.value='';
	e.style.background = "#FFFFFF";
}

 // confirm dialog 
function confirmacao(title, msg, link)
{
     var conf = alertify.confirm(title, msg, function()
	 {
	     //alertify.success("OK");	
         location.href=link;     	 
	 }, function()
	 {
	     alertify.error("Operação Cancelada");  	 
	 });
	 conf.set('labels', {ok:'Sim', cancel:'Cancelar'});
} 
