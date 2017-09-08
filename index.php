<html>
<head>
    <title> Página Inicial </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="js/alertify.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/jquery.mask.js"></script>
    <link rel = "stylesheet" href = "css/alertify.css" />
	<link rel = "stylesheet" href = "css/css.css" />
</head>
<body>
    <?php
    require 'conexao/conexao.php'; 
    $instcon = Conexao::getInstance();
	$selected_page = "resultados";
	//$alert = null;
	
	if (isset($_GET['pg']))
	{
		switch ($_GET['pg'])
		{
		    case "resultados":
		    {
		        $pagina = "paginas/resultados.php";	
				$selected_page = "resultados";
				if (isset($_GET['lixeira']))
				{
				    if ($_GET['lixeira'] == "true" || $_GET['lixeira'] == "1")
	                {
	                    $selected_page = "lixeira";	
	                }
				}
                break;			
		    }	
            case "usuario":
		    {
		        $pagina = "paginas/usuario.php";
                break;			
		    }
            case "cadastrar":
		    {
		        $pagina = "paginas/cadastrar.php";
				$selected_page = "cadastrar";
                break;			
		    }				
            case "salvar":
		    {
		        $pagina = "paginas/resultados.php";	
				$selected_page = "resultados";
			    if ($_POST)
                {
	
	                $nome = $_POST['nome'];
                    $cep = $_POST['cep'];
	                $cep = str_replace("-","",$cep);
                    $logradouro = $_POST['logradouro'];
                    $numero = $_POST['numero'];
                    $complemento = $_POST['complemento'];
                    $bairro = $_POST['bairro'];
                    $cidade = $_POST['cidade'];
                    $uf = $_POST['uf'];
                    $telefones = array();
	
	                $insert = mysqli_query($instcon->conexao, "INSERT INTO usuario (nome, cep, logradouro, numero, complemento, bairro, cidade, estado, lixeira) VALUES ('$nome','$cep','$logradouro','$numero','$complemento','$bairro','$cidade','$uf','0')");
	                if ($insert)
	                { 
	                    $id = mysqli_insert_id($instcon->conexao); 
	                    for ($i=1;$i<=5;$i++)
	                    {
	                        if (!empty($_POST['telefone'.$i]))
	                        {
			                    //array_push($telefones,$_POST['telefone'.$i]);
				                $tel = $_POST['telefone'.$i]; 
				                $tel = str_replace("-","",$tel);
				                $tel = str_replace("(","",$tel);
				                $tel = str_replace(")","",$tel);
			                    $insert_tel = mysqli_query($instcon->conexao, "INSERT INTO telefone (tel, codigo_usuario) VALUES ('$tel','$id')");
	                        }
	                    }
	                }
	                else
	                {
		                $insert_tel = false;
	                }

	                if ($insert && $insert_tel)
	                {
		                echo "<script>alertify.success(\"Dados Cadastrados com Sucesso\");</script>";
	                }
	                else
	                {
	                    echo "<script>alertify.error(\"Não foi possível salvar os Dados\");</script>";
                        mysqli_query($instcon->conexao, "DELETE FROM usuario WHERE codigo=$id");		
	                }
					unset($_POST);
                }
                break;			
		    }
			case "atualizar":
		    {
			    $pagina = "paginas/resultados.php"; 
				$selected_page = "resultados";
				if ($_POST)
                {	
	                $nome = $_POST['nome'];
                    $cep = $_POST['cep'];
	                $cep = str_replace("-","",$cep);
                    $logradouro = $_POST['logradouro'];
                    $numero = $_POST['numero'];
                    $complemento = $_POST['complemento'];
                    $bairro = $_POST['bairro'];
                    $cidade = $_POST['cidade'];
                    $uf = $_POST['uf'];
                    $telefones = array();
					$id = $_GET["id"]; 
	
	                $update = mysqli_query($instcon->conexao, "UPDATE usuario SET nome='$nome', cep='$cep', logradouro='$logradouro', numero='$numero', complemento='$complemento', bairro='$bairro', cidade='$cidade', estado='$uf' WHERE codigo=$id");
                    $selecao_tel = mysqli_query($instcon->conexao, "SELECT * FROM telefone WHERE codigo_usuario=$id"); 
                    if ($selecao_tel != false)
                    {  
                        while($linha = mysqli_fetch_array($selecao_tel, MYSQLI_NUM))
                        { 
						 	array_push($telefones, $linha[0]);    
                        }
                    }
                    else
                    {
	                    $telefones = null;
                    }  			
	                if ($update && $telefones != null)
	                { 
	                    for ($i=1;$i<=5;$i++)
	                    { 
	                        if (!empty($_POST['telefone'.$i]) && isset($telefones[$i-1]))
	                        { 
			                    if ($_POST['telefone'.$i] != "Adicionar Telefone")
								{ 
								//array_push($telefones,$_POST['telefone'.$i]);
				                $tel = $_POST['telefone'.$i]; 
				                $tel = str_replace("-","",$tel);
				                $tel = str_replace("(","",$tel);
				                $tel = str_replace(")","",$tel);
								$codtel = $telefones[$i-1]; 
			                    $update_tel = mysqli_query($instcon->conexao, "UPDATE telefone SET tel='$tel' WHERE codigo=$codtel"); 
								}
	                        }
	                    }
	                }
	                else if ($telefones == null)
	                { 
		                for ($i=1;$i<=5;$i++)
	                    { 
	                        if (!empty($_POST['telefone'.$i]))
	                        { 
			                    if ($_POST['telefone'.$i] != "Adicionar Telefone")
								{
								//array_push($telefones,$_POST['telefone'.$i]);
				                $tel = $_POST['telefone'.$i]; 
				                $tel = str_replace("-","",$tel); 
				                $tel = str_replace("(","",$tel); 
				                $tel = str_replace(")","",$tel); 
								}
	                        }
	                    }    
	                } 
					else
					{  
					    $update_tel = false;	
					} 

					if ($update && $update_tel)
	                {
		                echo "<script>alertify.success(\"Dados Salvos com Sucesso\");</script>";
	                }
	                else
	                {
	                    echo "<script>alertify.error(\"Não foi possível salvar os Dados\");</script>";		
	                }
					unset($_POST);
                }
				break;	
			}
			case "excluir":
			{
				$pagina = "paginas/resultados.php";
				$selected_page = "lixeira";
				$id = $_GET["id"];
				$selecao = mysqli_query($instcon->conexao, "SELECT nome FROM usuario WHERE codigo=$id");
				$linha = mysqli_fetch_array($selecao, MYSQLI_ASSOC);
				$nome = $linha['nome'];
				$excluir_tel = mysqli_query($instcon->conexao, "DELETE FROM telefone WHERE codigo_usuario=$id");
				$excluir = mysqli_query($instcon->conexao, "DELETE FROM usuario WHERE codigo=$id");

				if ($excluir && $excluir_tel)
	            {
		            echo "<script>alertify.success(\"Registro do usuário ".$nome." excluídos com Sucesso\");</script>";
	            }
	            else
	            {
	                echo "<script>alertify.error(\"Não foi possível apagar os Dados do usuário ".$nome."\");</script>";		
	            }
				break;
			}
			case "sendtotrash":
			{
			    $pagina = "paginas/resultados.php";
				$selected_page = "resultados";
				$id = $_GET["id"];
				$selecao = mysqli_query($instcon->conexao, "SELECT nome FROM usuario WHERE codigo=$id");
				$linha = mysqli_fetch_array($selecao, MYSQLI_ASSOC);
				$nome = $linha['nome'];
                $update = mysqli_query($instcon->conexao, "UPDATE usuario SET lixeira='1' WHERE codigo=$id");
                if ($update)
	            {
		            echo "<script>alertify.success(\"Registro do usuário ".$nome." enviado para a lixeira\");</script>";
	            }
	            else
	            {
	                echo "<script>alertify.error(\"Não foi possível enviar o registro do usuário ".$nome." para a lixeira\");</script>";		
	            }	
                break;				
			}
			case "restaurar":
			{
			    $pagina = "paginas/resultados.php";
				$selected_page = "lixeira";
				$id = $_GET["id"];
				$selecao = mysqli_query($instcon->conexao, "SELECT nome FROM usuario WHERE codigo=$id");
				$linha = mysqli_fetch_array($selecao, MYSQLI_ASSOC);
				$nome = $linha['nome'];
                $update = mysqli_query($instcon->conexao, "UPDATE usuario SET lixeira='0' WHERE codigo=$id");
                if ($update)
	            {
		            echo "<script>alertify.success(\"Registro do usuário ".$nome." restaurado com Sucesso\");</script>";
	            }
	            else
	            {
	                echo "<script>alertify.error(\"Não foi possível restuarar o registro do usuário ".$nome."\");</script>";		
	            }	
                break;				
			}
            default:
			{
				$pagina = "paginas/resultados.php";
				$selected_page = "resultados";
				break;
			}			
		}
	}
	else
	{
		$pagina = "paginas/resultados.php";
	}
			
	$trash_count = mysqli_query($instcon->conexao,"select count(*) as 'count' from usuario where lixeira=1");
	$row = mysqli_fetch_assoc($trash_count);
    $items_in_trash = $row['count'];
	
    ?>
    <div id="cabecalho">
	    <img src="images/crowd_icon.png" id="home_img">
		<h1 id="home_titulo"> CRUD de Usuários </h1>
	</div>
	<div id="menu">
	<ul>
	    <li <?php if ($selected_page == "resultados"){ echo "style='background-color: #0059b3;'"; } ?> > <a href="index.php?pg=resultados" id="pagina_inicial"> Página Inicial </a> </li>
		<li <?php if ($selected_page == "cadastrar"){ echo "style='background-color: #0059b3;'"; } ?> > <a href="index.php?pg=cadastrar" id="cadastrar_novo_usuario"> Cadastrar Novo Usuário </a> </li>
	    <li <?php if ($selected_page == "lixeira"){ echo "style='background-color: #0059b3;'"; } ?> > <a href="index.php?pg=resultados&lixeira=true" id="lixeira"> Lixeira <span id="items_in_trash"> <?php if ($items_in_trash > 0) { echo $items_in_trash; } ?> </span> </a> </li>
	<ul>
	</div>
	<?php
	
	if (isset($pagina))
	{
		include $pagina;
	}
    
	?>
</body>
</html>