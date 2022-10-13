<?php
    session_start();
    if(isset($_SESSION["nome"])){
        $nome = $_SESSION["nome"];
    }
    else{
        $nome = '';
    }

    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'sistemadesaúdeDB126661';

    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT COUNT(*) FROM pacientes WHERE nome LIKE '$nome'";
    $result = $conn->query($sql);
    $exists = ($result->fetchColumn() > 0) ? true : false;
    $conn = null;
    if(!$exists){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Usuário Paciente</title>
        <link rel="stylesheet" type="text/css" href="basics.css">
        <link rel="stylesheet" type="text/css" href="nav.css">
        <link rel="stylesheet" type="text/css" href="form.css">
        <script src="jquery-3.6.0.min.js"></script>
    </head>
    <body id="background">
        <div id="content">
        <a href="login.php">Logout</a>
        <ul id="navbar">
            <li class="nav"><a href="userpacienteexames.php">Exames</a></li>
            <li class="nav"><a href="userpacienteconsultas.php">Consultas</a></li>
            <li class="nav"><a id="active" href="userpacientedados.php">Usuário</a></li>
        </ul>
        <br><br>

        <div class="formdiv">
            <?php
            $server = 'localhost';
            $user = 'root';
            $password = '';
            $db = 'sistemadesaúdeDB126661';
            session_start();
        
            $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $nome = $_SESSION["nome"];
        
            $sql = "SELECT * FROM pacientes WHERE nome LIKE '$nome'";
            $result = $conn->query($sql);
            $data = $result->fetch();

            echo '<p>Nome: '.$data['nome'].'</p>
            <br>

            <p>Endereço: '.$data['endereço'].'</p>
            <br>

            <p>Telefone: '.$data['telefone'].'</p>
            <br>

            <p>E-mail: '.$data['email'].'</p>
            <br>

            <p>Gênero: '.$data['genero'].'</p>
            <br>

            <p>Idade: '.$data['idade'].'</p>
            <br>

            <p>CPF: '.$data['cpf'].'</p>
            <br>';
            $conn = null;?>
        </div>
        </div>

    </body>
</html>