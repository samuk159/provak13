<?php

$lixeira=false;
if (isset($_GET['lixeira']))
{
    if ($_GET['lixeira'] == "true" || $_GET['lixeira'] == "1")
	{
	    $lixeira=true;	
	}
}

?>
<form method="post" action="index.php?pg=resultados<?php if ($lixeira) { echo "&lixeira=true";} ?>">
    <input type="text" name="pesquisa" placeholder=" Pesquisar" id="campo_pesquisar"> </input>
	<button type="submit" id="botao_pesquisar"> Pesquisar </button>
</form>
<table id="tabela_resultados">
	<tr id="titulo_tabela"> 	
	    <td width="62%"> <p class="table_text"> Nome </p> </td>
		<td width="8%"> Cidade </td>
		<td width="5%"> Estado </td>
		<td width="10%"> Telefone </td>
        <!--<td width="7%"> </td>-->		
	</tr>
<?php

$pesquisa = " order by nome";	
if (isset($_POST["pesquisa"]))
{ 
    if (!empty($_POST["pesquisa"]))
	{
	    $pesquisa = "&& usuario.nome LIKE '%".$_POST['pesquisa']."%' || usuario.cep LIKE '%".$_POST['pesquisa']."%' || usuario.logradouro LIKE '%".$_POST['pesquisa']."%' || usuario.numero LIKE '%".$_POST['pesquisa']."%' || usuario.complemento LIKE '%".$_POST['pesquisa']."%' || usuario.bairro LIKE '%".$_POST['pesquisa']."%' || usuario.cidade LIKE '%".$_POST['pesquisa']."%' || usuario.estado LIKE '%".$_POST['pesquisa']."%' || telefone.tel LIKE '%".$_POST['pesquisa']."%' order by nome";
    }
}

$sql = "SELECT usuario.codigo, usuario.nome, usuario.cep, usuario.logradouro, usuario.numero, usuario.complemento, usuario.bairro, usuario.cidade, usuario.estado, telefone.tel FROM usuario left join telefone on usuario.codigo=telefone.codigo_usuario WHERE lixeira=";
if ($lixeira)
{ 	
    $selecao = mysqli_query($instcon->conexao, $sql."1".$pesquisa);
}
else
{ 
    $selecao = mysqli_query($instcon->conexao, $sql."0".$pesquisa);	
}

if ($selecao != false)
{
if (mysqli_num_rows($selecao) > 0)
{
	$lastid = "0";
while($linha = mysqli_fetch_array($selecao, MYSQLI_ASSOC))
{    
    $id = $linha['codigo'];

	//Não exibe registros com o mesmo codigo
	if ($id != $lastid)
	{
	    if (!empty($linha['tel']))
		{
		    $tel = $linha['tel'];
			$tel = "(".substr($tel,0,2).") ".substr($tel,2,5)."-".substr($tel,7,4);
		}
		else
		{
			$tel = "";
		}
	?>
	<tr <?php if (!$lixeira) { ?> class="table_items" onclick="document.location = 'index.php?pg=usuario&id=<?php echo $id; ?>';" <?php } ?> > 
	    <td> <p class="table_text"> <?php echo $linha['nome']; ?> </p> </td>
		<td> <p> <?php echo $linha['cidade']; ?> </p> </td>
		<td> <p> <?php echo strtoupper($linha['estado']); ?> </p> </td>
		<td> <p> <?php echo $tel; ?> </p> </td> 
	<?php
	if ($lixeira)
	{
	?>
	    <td> <button type="button" id="botao_restaurar" onclick="confirmacao('Restaurar Registro','Tem certeza de que deseja restaurar este registro?', 'index.php?pg=restaurar&lixeira=true&id=<?php echo $linha['codigo']; ?>');"> Restaurar </button> </td>
		<td> <button type="button" id="botao_excluir" onclick="confirmacao('Excluir Registro','Tem certeza de que deseja excluir este registro?', 'index.php?pg=excluir&lixeira=true&id=<?php echo $linha['codigo']; ?>');"> Excluir </button> </td>
	<?php
	}
	else
	{
	?>
		<!--<td id="celula_link_abrir"> <a href="index.php?pg=usuario&id=<?php echo $id; ?>" id="link_abrir"> Abrir </a> </td>-->
	<?php
	}
	?>
	</tr>
	<?php
	}
	$lastid = $id;
}
}
else if ($pesquisa != "")
{
    echo "<script>alertify.alert('Sem resultados','Não foram encontrados resultados para sua pesquisa');</script>";
}
else
{
	?>
	<tr>
	    <td> <center> Sem resultados </center> </td>
	</tr>
	<?php
}

// Free result set
mysqli_free_result($selecao);
}
?>
</table>