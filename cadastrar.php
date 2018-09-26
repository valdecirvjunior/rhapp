<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="main.css" />
	<script src="main.js"></script>
</head>
<body>
<?php
require('verifica.php');
include ('config.php');  

if ($_SESSION["UsuarioNivel"] != "adm") echo "<script>alert('Você não é Administrador!');top.location.href='menu.php';</script>"; 

?>

<font size=7 color=red> Entrei no Cadastro - <?php echo $_SESSION["nome_usuario"]; ?></font>

<?php
$id = @$_REQUEST['id'];

if (@$_REQUEST['botao'] == "Excluir") {
		$query_excluir = "
			DELETE FROM usuario WHERE id='$id'
		";
		$result_excluir = mysqli_query($con,$query_excluir);
		
		if ($result_excluir) echo "<h2> Registro excluido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui excluir!!!</h2>";

		echo "Excluir - $query_excluir";
}

if (@$_REQUEST['id'] and !@$_REQUEST['botao'])
{
	$query = "
		SELECT * FROM usuario WHERE id='{$_REQUEST['id']}'
	";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_assoc($result);
	//echo "<br> $query";	
	foreach( $row as $key => $value )
	{
		$_POST[$key] = $value;
	}
}

if (@$_REQUEST['botao'] == "Gravar") 
{
	/*$arquivo =  $_FILES["arquivo"]["name"];
	$arquivoTmp =  $_FILES["arquivo"]["tmp_name"];
	$destino = "/imagens/". $arquivo;

	ini_set( 'display_errors', true );
error_reporting( E_ALL );

// Caminho de onde ficará o anexo
  $caminho_anexo = "/imagens/" . $arquivo;


  var_dump( is_writable("/imagens/") ); //informe oque retornar desse dump
  echo '<br />',$caminho_anexo;
	echo '<br>'.shell_exec("whoami").'<br>';

// Faz o upload do anexo para seu respectivo caminho
 //move_uploaded_file($arquivoTmp, $caminho_anexo);

	if (move_uploaded_file($arquivo, $destino)) {
            echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
            echo ' < img src = "' . $destino . '" />';
        }
        else {
						echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
						echo $destino.'.<br />';
						echo $arquivo.'.<br />';
						print_r($_FILES);
						echo ' <img src = "' . $_FILES["arquivo"]["tmp_name"] . '" />';
					}
	*/

	if(!empty($_FILES['arquivo']))
  {
    $path = "imagem/";
	$path = $path . basename( $_FILES['arquivo']['name']);
	$arquivo = basename( $_FILES['arquivo']['name']);
    if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['arquivo']['name']). 
	  " has been uploaded";
	  echo '<img src = "' . $path . '" />';
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }

	$senha = md5($_POST['senha']);//md5($_POST['senha']);
	if (!$_REQUEST['id'])
	{
		$insere = "INSERT into usuario ( login, senha, nivel, imagem) VALUES ( '{$_POST['login']}', '$senha', '{$_POST['nivel']}', '$arquivo');";
		$result_insere = mysqli_query($con,$insere);
		
		if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui inserir!!!</h2>";
		
		echo "Gravar - $insere";
	} else 	
	{
		$insere = "UPDATE usuario SET 
					login = '{$_POST['login']}'
					, senha = '$senha'
					, nivel = '{$_POST['nivel']}'
					, imagem = '$arquivo'
					WHERE id = '{$_REQUEST['id']}'
				";
		$result_update = mysqli_query($con,$insere);

		if ($result_update) echo "<h2> Registro atualizado com sucesso!!!</h2>";
		else echo "<h2> Nao consegui atualizar!!!</h2>";
		
		echo "Atualizar - $insere";
	}
}
?>

<form action="cadastrar.php" method="POST" name="usuario" enctype="multipart/form-data" >
<table width="200" border="1">
  <tr>
    <td colspan="2">Cadastro de Usuarios</td>
  </tr>
  <tr>
    <td width="53">Cod.</td>
    <td width="131"><?php echo @$_POST['id']; ?>&nbsp;
  </tr>
  <tr>
    <td>Login:</td>
    <td><input type="text" name="login" value="<?php echo @$_POST['login']; ?>"></td>
  </tr>
  <tr>
    <td>Senha:</td>
    <td><input type="text" name="senha" value="<?php echo @$_POST['senha']; ?>"></td>
  </tr>
 <tr>
    <td>Nivel:</td>
    <td><input type="text" name="nivel" value="<?php echo @$_POST['nivel']; ?>"></td>
  </tr>
  <tr>
	<td>Selecione uma imagem:</td>
	<td><input name="arquivo" id="arquivo" type="file" value="<?php echo @$_POST['imagem']; ?>" /></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><input type="submit" value="Gravar" name="botao"> - <input type="submit" value="Excluir" name="botao">
    -
    <input type="reset" value="Novo" name="novo"> 	<input type="hidden" name="id" value="<?php echo @$_REQUEST['id'] ?>" />
</td>
    </tr>	
</table>
</form>


</body>
</html>
