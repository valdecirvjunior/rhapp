<html>
<head>
<title>Relat&oacute;rio de Usuario</title>
<?php include ('config.php');  ?>
</head>
<body>
<meta charset=utf-8>
<font size=7 color=red> Entrei no Relatório - <?php require('verifica.php'); echo $_SESSION["nome_usuario"]; ?></font>


<form action="relatorio.php?botao=gravar" method="post" name="form1">
<table width="95%" border="1" align="center">
  <tr>
    <td colspan=5 align="center">Relat&oacute;rio de Usuarios</td>
  </tr>
  <tr>
    <td width="18%" align="right">Login:</td>
    <td width="26%"><input type="text" name="login"  /></td>
    <td width="17%" align="right">Senha:</td>
    <td width="18%"><input type="text" name="senha" size="3" /></td>
    <td width="17%" align="right">Nivel:</td>
    <td width="18%"><input type="text" name="nivel" size="3" /></td>
    <td width="21%"><input type="submit" name="botao" value="Gerar" /></td>
  </tr>
</table>
</form>

<?php if (@$_REQUEST['botao'] == "Gerar") { ?>

<table width="95%" border="1" align="center">
  <tr bgcolor="#9999FF">
    <th width="5%">C&oacute;d</th>
    <th width="30%">Login</th>
    <th width="15%">Senha</th>
    <th width="12%">Nivel</th>
	<th width="12%">Imagem</th>
  </tr>

<?php

	$login = $_POST['login'];
	$senha = $_POST['senha'];
	$nivel = $_POST['nivel'];
	$imagem = @$_POST['imagem'];
	
	$query = "SELECT *
			  FROM usuario 
			  WHERE id > 0 ";
	$query .= ($login ? " AND login LIKE '%$login%' " : "");
	$query .= ($senha ? " AND senha = '$senha' " : "");
	$query .= ($nivel ? " AND nivel = '$nivel' " : "");
	$query .= " ORDER by id";
	$result = mysqli_query($con, $query);

/*	
	echo "<pre>";
	echo $query;
	echo mysql_error();
	echo "</pre>";
*/
	while ($coluna=mysqli_fetch_array($result)) 
	{
		
	?>
    
    <tr>
      <th width="5%"><?php echo $coluna['id']; ?></th>
      <th width="30%"><?php echo $coluna['login']; ?></th>
      <th width="15%"><?php echo $coluna['senha']; ?></th>
      <th width="12%"><?php echo $coluna['nivel']; ?></th>
	  <th width="12%"><?php  echo '<img  src = "imagem/' .$coluna['imagem'] . '" />'; ?></th>
        <td>
        <a 
            href="cadastrar.php?pag=cliente&id=<?php echo $coluna['id']; ?>"
            >editar</a>
        </td>

    </tr>

    <?php
	
	} // fim while
?>
</table>
<?php	
}
?>
</body>
</html>
