<?php

$id = $_GET["id"];

$selecao = mysqli_query($instcon->conexao, "SELECT * FROM usuario WHERE codigo = $id && lixeira<>1");
$selecao_tel = mysqli_query($instcon->conexao, "SELECT * FROM telefone WHERE codigo_usuario = $id");

$dados = mysqli_fetch_array($selecao, MYSQLI_ASSOC);
if ($selecao_tel != false)
{
	$telefones = array();
    while($linha = mysqli_fetch_array($selecao_tel, MYSQLI_NUM))
    {
	    array_push($telefones, $linha[1]);    
    }
}
else
{
	$telefones = null;
}

$nome = $dados['nome'];
$cep = $dados['cep'];
$logradouro = $dados['logradouro'];
$numero = $dados['numero'];
$complemento = $dados['complemento'];
$bairro = $dados['bairro'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
?>

<form id="formcadastro" method="post" action="index.php?pg=atualizar&id=<?php echo $id ?>">
<table width="85%" id="tabela_usuario">
<tr>
    <td> <label> Nome: </label> </td>
</tr>
<tr>
	<td> <input type="text" name="nome" maxlength="100" required="required" value="<?php echo $nome ?>"> </input> </td>
</tr>
<tr>
    <td> <label> CEP: </label> </td>
</tr>
<tr>
	<td> <input type="text" name="cep" id="cep" minlength="8" maxlength="8" placeholder="00000-000" onblur="pesquisacep(this.value);" value="<?php echo $cep ?>"> </input> </td>
</tr>
<tr>
	<td> <label> Logradouro: </label> </td>
	<td> <label> Número: </label> </td>
	<td> <label> Complemento: </label> </td>
</tr>
<tr>
	<td> <input type="text" name="logradouro" id="logradouro" maxlength="100" required="required" value="<?php echo $logradouro ?>"> </input> </td>
	<td> <input type="number" name="numero" maxlength="5" value="<?php echo $numero ?>"> </input> </td>
	<td> <input type="text" name="complemento" maxlength="100" value="<?php echo $complemento ?>"> </input> </td>
</tr>
<tr>
    <td> <label> Bairro: </label> </td>
	<td> <label> Cidade: </label> </td>
	<td> <label> Estado: </label> </td>
</tr>
<tr>
	<td> <input type="text" name="bairro" id="bairro" maxlength="100" value="<?php echo $bairro ?>"> </input> </td>
	<td> <input type="text" name="cidade" id="cidade" maxlength="100" value="<?php echo $cidade ?>"> </input> </td>
	<td>
	    <select name="uf" id="uf" value="<?php echo $estado ?>">
            <option value="AC" <?php if (strcasecmp($estado, "ac") == 0) { echo "selected"; }?>> Acre <option>
	        <option value="AL" <?php if (strcasecmp($estado, "al") == 0) { echo "selected"; }?>> Alagoas <option>
	        <option value="AP" <?php if (strcasecmp($estado, "ap") == 0) { echo "selected"; }?>> Amapá <option>
	        <option value="AM" <?php if (strcasecmp($estado, "am") == 0) { echo "selected"; }?>> Amazonas <option>
	        <option value="BA" <?php if (strcasecmp($estado, "ba") == 0) { echo "selected"; }?>> Bahia <option>
	        <option value="CE" <?php if (strcasecmp($estado, "ce") == 0) { echo "selected"; }?>> Ceará <option>
	        <option value="DF" <?php if (strcasecmp($estado, "df") == 0) { echo "selected"; }?>> Distrito Federal <option>
	        <option value="ES" <?php if (strcasecmp($estado, "es") == 0) { echo "selected"; }?>> Espírito Santo <option>
	        <option value="GO" <?php if (strcasecmp($estado, "go") == 0) { echo "selected"; }?>> Goiás <option>
	        <option value="MA" <?php if (strcasecmp($estado, "ma") == 0) { echo "selected"; }?>> Maranhão <option>
	        <option value="MT" <?php if (strcasecmp($estado, "mt") == 0) { echo "selected"; }?>> Mato Grosso <option>
	        <option value="MS" <?php if (strcasecmp($estado, "ms") == 0) { echo "selected"; }?>> Mato Grosso do Sul <option>
	        <option value="MG" <?php if (strcasecmp($estado, "mg") == 0) { echo "selected"; }?>> Minas Gerais <option>
	        <option value="PA" <?php if (strcasecmp($estado, "pa") == 0) { echo "selected"; }?>> Pará <option>
	        <option value="PB" <?php if (strcasecmp($estado, "pb") == 0) { echo "selected"; }?>> Paraíba <option>
	        <option value="PR" <?php if (strcasecmp($estado, "pr") == 0) { echo "selected"; } ?>> Paraná <option>
	        <option value="PE" <?php if (strcasecmp($estado, "pe") == 0) { echo "selected"; }?>> Pernambuco <option>
	        <option value="PI" <?php if (strcasecmp($estado, "pi") == 0) { echo "selected"; }?>> Piauí <option>
	        <option value="RJ" <?php if (strcasecmp($estado, "rj") == 0) { echo "selected"; }?>> Rio de Janeiro <option>
	        <option value="RN" <?php if (strcasecmp($estado, "rn") == 0) { echo "selected"; }?>> Rio Grande do Norte <option>
	        <option value="RS" <?php if (strcasecmp($estado, "rs") == 0) { echo "selected"; }?>> Rio Grande do Sul <option>
	        <option value="RO" <?php if (strcasecmp($estado, "ro") == 0) { echo "selected"; }?>> Rondônia <option>
	        <option value="RR" <?php if (strcasecmp($estado, "rr") == 0) { echo "selected"; }?>> Roraima <option>
	        <option value="SC" <?php if (strcasecmp($estado, "sc") == 0) { echo "selected"; }?>> Santa Catarina <option>
	        <option value="SP" <?php if (strcasecmp($estado, "sp") == 0) { echo "selected"; }?>> São Paulo <option>
	        <option value="SE" <?php if (strcasecmp($estado, "se") == 0) { echo "selected"; }?>> Sergipe <option>
	        <option value="TO" <?php if (strcasecmp($estado, "to") == 0) { echo "selected"; }?>> Tocantins <option>
        </select> 
	</td>
</tr>
<tr>
	
</tr>
<tr>
    <td> <label> Estado: </label> </td>
	<td> 
	
	</td>
</tr>
<tr>
    <td colspan="2"> <h1> Telefones: </h1> </td>
</tr>
<?php
if ($telefones != null)
{
	$i = 1;
	$required = "required='required'";
	foreach($telefones as $telefone)
	{
		if ($i == 1)
		{
		    $required = "required='required'";	
		}
		else
		{
		    $required = "";		
		}
		?>
		<tr>
            <td> <label> Telefone <?php echo $i ?>: </label> </td>
			<td> <input type="text" name="telefone<?php echo $i ?>" class="telefone" minlength="11" maxlength="11" <?php echo $required ?> placeholder="(00) 00000-0000" value="<?php echo $telefone ?>"> </input> </td>
        </tr>
		<?php
		$i++;
	}
	
	$tel_fields = count($telefones);
	
}
else
{
    $tel_fields = 0;
}

$remaining_tel_fields = 5 - $tel_fields;	
	
for ($i=0;$i<$remaining_tel_fields;$i++)
{
	if ($i+$tel_fields+1 == 1)
	{
	    $required = "required='required'";	
		$value = "";
	}
	else
	{
		$required = "";
		$value = "Adicionar Telefone"; 
	} 
	/*if ($i+$tel_fields+1 == 5)
	{
	    $value = "";	
		$botao = "";
	}*/
	?>
	<tr <?php if ($i+$tel_fields+1 > 2 && $i+$tel_fields+1 > $tel_fields+1) { ?> class="remaining_tel_fields" <?php } ?> >
        <td> <label> Telefone <?php echo $i+$tel_fields+1 ?>: </label> </td>
    	<td> <input type="text" name="telefone<?php echo $i+$tel_fields+1 ?>" id="telefone<?php echo $i+$tel_fields+1 ?>" minlength="11" maxlength="11" <?php echo $required ?> placeholder="(00) 00000-0000" value="<?php echo $value ?>" onfocus="botao(this);" <?php if ($i+$tel_fields+1 > 1) { ?> onclick="toggleRow(this);" <?php } ?> > </input> </td>
    </tr>	
    <?php    	
}
	
?>
</table>
<button type="button" id="botao_send_to_trash" onclick="confirmacao('Enviar Registro para a Lixeira','Tem certeza de que deseja enviar este registro para a lixeira?', 'index.php?pg=sendtotrash&id=<?php echo $id; ?>');"> Enviar para a Lixeira </button>
<button type="submit" id="botao_salvar"> Salvar </button>
</form>
