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

    $sql = "SELECT COUNT(*) FROM laboratorios WHERE nome LIKE '$nome'";
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
        <title>Usuário Médico</title>
        <link rel="stylesheet" type="text/css" href="basics.css">
        <link rel="stylesheet" type="text/css" href="nav.css">
        <link rel="stylesheet" type="text/css" href="form.css">
        <script src="jquery-3.6.0.min.js"></script>
    </head>
    <body id="background">
        <div id="content">
        <a href="login.php">Logout</a>
        <ul id="navbar">
            <li class="nav"><a href="userlaboratorio.php">Consultas</a></li>
            <li class="nav"><a href="userlaboratoriocadastro.php">Exames</a></li>
            <li class="nav"><a id="active" href="userlaboratoriodados.php">Usuário</a></li>
        </ul>
        <br><br>
        <?php
        session_start();
        ?>

        <div class="formdiv">
            <br>
        <form method="post" action="changelaboratorio.php" id="insertData">
            <?php
            session_start();
            $server = 'localhost';
            $user = 'root';
            $password = '';
            $db = 'sistemadesaúdeDB126661';

            $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $nome = $_SESSION["nome"];

            $sql = "SELECT * FROM laboratorios WHERE nome LIKE '$nome'";
            $result = $conn->query($sql);
            $data = $result->fetch();

            echo '<span>Nome: </span><input type="text" placeholder="Nome" name="mNome" id="mNome" value='.$nome.' class="addinput">
            <p class="error" id="nomeError"><p>
            <br>

            <span>Endereço: </span><input type="text" placeholder="Endereço" name="mEndereço" id="mEndereço" value='.$data['endereço'].' class="addinput">
            <p class="error" id="endereçoError"><p>
            <br>

            <span>Telefone: </span><input type="text" placeholder="Telefone" name="mTelefone" id="mTelefone" value='.$data['telefone'].' class="addinput">
            <p class="error" id="telefoneError"><p>
            <br>

            <span>E-mail: </span><input type="email" placeholder="E-mail" name="mEmail" id="mEmail" value='.$data['email'].' class="addinput">
            <p class="error" id="emailError"><p>
            <br>

            <span>Exames: </span><input type="text" placeholder="Especialidade" name="mExames" id="mExames" value='.$data['exames'].' class="addinput">
            <p class="error" id="exameError"><p>
            <br>

            <span>CNPJ: </span><input type="text" placeholder="Especialidade" name="mCNPJ" id="mCNPJ" value='.$data['cnpj'].' class="addinput">
            <p class="error" id="exameError"><p>
            <br>';
            $conn = null;?>

            <input type="submit">
        </form>
        </div>

        <p id="test"></p>
        <script type="text/javascript">
            $("#insertData").submit(function(event){
                event.preventDefault();
                var proceed = true;
                var form = this;

                if(!$("#mNome").val()){
                    proceed = false;
                    $("#nomeError").css('display', 'inline');
                    $("#nomeError").html("Este campo deve ser preenchido");
                }
                else
                    $("#nomeError").css('display', 'none');

                if(!$("#mEndereço").val()){
                    proceed = false;
                    $("#endereçoError").css('display', 'inline');
                    $("#endereçoError").html("Este campo deve ser preenchido");
                }
                else
                    $("#endereçoError").css('display', 'none');

                if(!$("#mTelefone").val()){
                    proceed = false;
                    $("#telefoneError").css('display', 'inline');
                    $("#telefoneError").html("Este campo deve ser preenchido");
                }
                else
                    $("#telefoneError").css('display', 'none');

                if(!$("#mEmail").val()){
                    proceed = false;
                    $("#emailError").css('display', 'inline');
                    $("#emailError").html("Este campo deve ser preenchido");
                }
                else
                    $("#emailError").css('display', 'none');

                if(!$("#mExames").val()){
                    proceed = false;
                    $("#exameError").css('display', 'inline');
                    $("#exameError").html("Este campo deve ser preenchido");
                }
                else
                    $("#exameError").css('display', 'none');
                
                if(!$("#mCNPJ").val()){
                    proceed = false;
                    $("#cnpjError").css('display', 'inline');
                    $("#cnpjError").html("Este campo deve ser preenchido");
                }
                else
                    $("#cnpjError").css('display', 'none');

                if(proceed){
                    var postUrl = $(this).attr("action");
                    var requestMethod = $(this).attr("method");
                    var formData = $(this).serialize();

                    $.ajax({
                        url : postUrl,
                        type : requestMethod,
                        dataType : 'json',
                        data : formData
                    })
                    .done(function(response){
                        if(response.type == 'nameError'){
                            $("#nomeError").css('display', 'inline');
                            $("#nomeError").html('Já existe um laboratório com este nome');
                        }
                        else if(response.type == "telefoneError"){
                            $("#telefoneError").css('display', 'inline');
                            $("#telefoneError").html('Já existe um laboratório com este telefone');
                        }
                        else if(response.type == "erro"){
                            alert("Deu algum erro bicho");
                        }
                    });
                }
            });
        </script>
        </div>
    </body>
</html>