<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $cdbarras = @$_POST['cdbarras'];
        $nomeproduto = @$_POST['nomeproduto'];
        $segmento = @$_POST['segmento'];
        $categoria = @$_POST['categoria'];
        $pccusto = @$_POST['pccusto'];
        $mgvenda = @$_POST['mgvenda'];
        $pcvenda = @$_POST['pcvenda'];
        $estoque = @$_POST['estoque'];
        $dtcadastro =@$_POST['dtcadastro'];
        $lastupdate = $_SESSION["nome_usuario"];
        //$file_name = $_FILES['image']['name'];
        $id = $_REQUEST['id'];
    
        // echo $nome;
        // echo $sbnome;
        // echo $fone;
        // echo $cep;
        // echo $rua;
        // echo $numero;
        // echo $bairro;
        // echo $cidade;
        // echo $uf;
        //echo $file_name;
        
        //$query= "INSERT INTO produto (cdbarras,nomeproduto,segmento,categoria,pccusto,mgvenda,pcvenda,estoque,dtcadastro)values('$cdbarras','$nomeproduto','$segmento','$categoria','$pccusto','$mgvenda','$pcvenda','$estoque','$dtcadastro')";
        $query = "UPDATE produto 
        SET 
        cdbarras='$cdbarras', 
        nomeproduto='$nomeproduto', 
        segmento ='$segmento',
        categoria='$categoria',
        pccusto=$pccusto,
        mgvenda='$mgvenda',
        pcvenda=$pcvenda,
        estoque=$estoque,
        lastupdate='$lastupdate' 
        where id=$id";
        //echo $query;
        $result=mysqli_query($con,$query);
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>