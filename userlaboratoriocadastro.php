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
        <title>Usuário Laboratório</title>
        <link rel="stylesheet" type="text/css" href="basics.css">
        <link rel="stylesheet" type="text/css" href="nav.css">
        <link rel="stylesheet" type="text/css" href="form.css">
        <script src="jquery-3.6.0.min.js"></script>
    </head>
    <body id="background">
        <div id="content">
        <a href="login.php">Logout</a>
        <ul id="navbar">
            <li class="nav"><a href="userlaboratorio.php">Exames</a></li>
            <li class="nav"><a id="active" href="userlaboratoriocadastro.php">Exames</a></li>
            <li class="nav"><a href="userlaboratoriodados.php">Usuário</a></li>
        </ul>
        <br><br>

        <div class="formdiv">
        <h1 class="insira">Insira um novo Exame</h1>
        <form method="post" action="postexame.php" id="insertdata">
            <input type="date" name="mData" id="mData" class="addinput">
            <p class="error" id="dataError"></p>
            <br><br>
            <input type="text" placeholder="Nome do Paciente" name="mPaciente" id="mPaciente" class="addinput">
            <p class="error" id="pacienteError"></p>
            <br><br>
            <input type="text" placeholder="Tipo de Exame" name="mTipo" id="mTipo" class="addinput">
            <p class="error" id="tipoError"></p>
            <br><br>
            <input type="text" placeholder="Resultado" name="mResultado" id="mResultado" class="addinput">
            <p class="error" id="resultadoError"></p>
            <br><br>
            <input type='submit'>
        </form>
        <br>
        </div>

        <script type='text/javascript'>
            $("#insertdata").submit(function(event){
                event.preventDefault();
                var proceed = true;
                var form = this;

                if(!$("#mData").val()){
                    proceed = false;
                    $('#dataError').css('display', 'inline');
                    $('#dataError').html('Este campo deve ser preenchido');
                }
                else
                    $("#dataError").css("display", "none");
                
                if(!$("#mPaciente").val()){
                    proceed = false;
                    $('#pacienteError').css('display', 'inline');
                    $('#pacienteError').html('Este campo deve ser preenchido');
                }
                else
                    $("#pacienteError").css("display", "none");

                if(!$("#mTipo").val()){
                    proceed = false;
                    $('#tipoError').css('display', 'inline');
                    $('#tipoError').html('Este campo deve ser preenchido');
                }
                else
                    $("#tipoError").css("display", "none");

                if(!$("#mResultado").val()){
                    proceed = false;
                    $('#resultadoError').css('display', 'inline');
                    $('#resultadoError').html('Este campo deve ser preenchido');
                }
                else
                    $("#resultadoError").css("display", "none");
                
                if(proceed){
                    var postUrl = $(this).attr('action');
                    var requestMethod = $(this).attr('method');
                    var formData = $(this).serialize();

                    $.ajax({
                        url : postUrl,
                        type : requestMethod,
                        dataType : 'json',
                        data : formData
                    })
                    .done(function(response){
                        if(response.type == 'pacienteError'){
                            $('#pacienteError').css('display', 'inline');
                            $('#pacienteError').html(response.text);
                        }
                        else if(response.type == 'response'){
                            $('#pacienteError').css('display', 'none');
                            $(form)[0].reset();
                        }
                    });
                }
            });
        </script>
        </div>
    </body>
</html>