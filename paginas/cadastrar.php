<!--<html>
<head>
<title> Cadastrar Novo Usuário </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/jquery-3.1.1.js"></script>
<script type="text/javascript" src="../js/alertify.min.js"></script>
<script type="text/javascript" src="../js/script.js"></script>
<script type="text/javascript" src="../js/jquery.mask.js"></script>
<link rel = "stylesheet" href = "../css/alertify.css" />
<link rel = "stylesheet" href = "../css/css.css" />
</head>
<body>-->
<form id="formcadastro" method="post" action="index.php?pg=salvar">
<table id="tabela_cadastro">
<tr>
    <td> <label> Nome de Usuário: </label> </td>	
</tr>
<tr>
    <td> <input type="text" name="nome" maxlength="100" required="required"> </input> </td>
</tr>
<tr>
    <td> <label> CEP: </label> </td>
</tr>
<tr>
	<td> <input type="text" name="cep" id="cep" value="" minlength="8" maxlength="8" placeholder="00000-000" onblur="pesquisacep(this.value);"> </input> </td>
</tr>
<tr>
	<td> <label> Logradouro: </label> </td>
	<td> <label> Número: </label> </td>
	<td> <label> Complemento: </label> </td>
</tr>
<tr>    
	<td> <input type="text" name="logradouro" id="logradouro" maxlength="100" required="required"> </input> </td>
	<td> <input type="number" name="numero" maxlength="5"> </input> </td>
	<td> <input type="text" name="complemento" maxlength="100"> </input> </td>
</tr>
<tr>
    <td> <label> Bairro: </label> </td>
	<td> <label> Cidade: </label> </td>
	<td> <label> Estado: </label> </td>
</tr>
<tr>
    <td> <input type="text" name="bairro" id="bairro" maxlength="100"> </input> </td>
	<td> <input type="text" name="cidade" id="cidade" maxlength="100"> </input> </td>
	<td>
	    <select name="uf" id="uf">
            <option value="AC"> Acre <option>
	        <option value="AL"> Alagoas <option>
	        <option value="AP"> Amapá <option>
	        <option value="AM"> Amazonas <option>
	        <option value="BA"> Bahia <option>
	        <option value="CE"> Ceará <option>
	        <option value="DF"> Distrito Federal <option>
	        <option value="ES"> Espírito Santo <option>
	        <option value="GO"> Goiás <option>
	        <option value="MA"> Maranhão <option>
	        <option value="MT"> Mato Grosso <option>
	        <option value="MS"> Mato Grosso do Sul <option>
	        <option value="MG"> Minas Gerais <option>
	        <option value="PA"> Pará <option>
	        <option value="PB"> Paraíba <option>
	        <option value="PR"> Paraná <option>
	        <option value="PE"> Pernambuco <option>
	        <option value="PI"> Piauí <option>
	        <option value="RJ"> Rio de Janeiro <option>
	        <option value="RN"> Rio Grande do Norte <option>
	        <option value="RS"> Rio Grande do Sul <option>
	        <option value="RO"> Rondônia <option>
	        <option value="RR"> Roraima <option>
	        <option value="SC"> Santa Catarina <option>
	        <option value="SP"> São Paulo <option>
	        <option value="SE"> Sergipe <option>
	        <option value="TO"> Tocantins <option>
</select>
	</td>
</tr>
<tr>
    <td> <h1> Telefones: </h1> </td>
</tr>
<!---
<tr> <td> <input type="text" name="telefone1" class="telefone" id="telefone1" maxlength="10" maxlength="11" required="required" placeholder="(00) 00000-0000" value=""> </input> </td> </tr> 
<tr id="telefone2" class="remaining_tel_fields"> <td> <input type="text" name="telefone2" class="telefone" maxlength="11" maxlength="11" placeholder="(00) 00000-0000" value=""> </input> </td> </tr> 
<tr id="telefone3" class="remaining_tel_fields"> <td> <input type="text" name="telefone3" class="telefone" maxlength="11" maxlength="11" placeholder="(00) 00000-0000" value=""> </input> </td> </tr> 
<tr id="telefone4" class="remaining_tel_fields"> <td> <input type="text" name="telefone4" class="telefone" maxlength="11" maxlength="11" placeholder="(00) 00000-0000" value=""> </input> </td> </tr> 
<tr id="telefone5" class="remaining_tel_fields"> <td> <input type="text" name="telefone5" class="telefone" maxlength="11" maxlength="11" placeholder="(00) 00000-0000" value=""> </input> </td> </tr> 
<tr> <td> <button type="button" id="addtel" onclick="add_telefone();"> Adicionar Telefone </button> </td> 
<td> </td>-->
<tr>
    <td> <label> Telefone 1: </label> </td>
  	<td> <input type="text" name="telefone1" id="telefone1" minlength="11" maxlength="11" placeholder="(00) 00000-0000"> </input> </td>
</tr>
<tr>
    <td> <label> Telefone 2: </label> </td>
  	<td> <input type="text" name="telefone2" id="telefone2" minlength="11" maxlength="11" placeholder="(00) 00000-0000" onfocus="botao(this);" onclick="toggleRow(this);" value="Adicionar Telefone"> </input> </td>
</tr>
<tr class="remaining_tel_fields">
    <td> <label> Telefone 3: </label> </td>
  	<td> <input type="text" name="telefone3" id="telefone3" minlength="11" maxlength="11" placeholder="(00) 00000-0000" onfocus="botao(this);" onclick="toggleRow(this);" value="Adicionar Telefone"> </input> </td>
</tr>
<tr class="remaining_tel_fields">
    <td> <label> Telefone 4: </label> </td>
  	<td> <input type="text" name="telefone4" id="telefone4" minlength="11" maxlength="11" placeholder="(00) 00000-0000" onfocus="botao(this);" onclick="toggleRow(this);" value="Adicionar Telefone"> </input> </td>
</tr>
<tr class="remaining_tel_fields">
    <td> <label> Telefone 5: </label> </td>
  	<td> <input type="text" name="telefone5" id="telefone5" minlength="11" maxlength="11" placeholder="(00) 00000-0000" onfocus="botao(this);" onclick="toggleRow(this);" value="Adicionar Telefone"> </input> </td>
</tr>
</table>
<button type="submit" id="botao_cadastrar"> Cadastrar </button> 
</form> 

<!--
</body>
</html> -->
