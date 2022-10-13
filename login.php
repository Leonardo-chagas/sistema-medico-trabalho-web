<?php
session_start();
$_SESSION["nome"] = '';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="basics.css">
        <link rel="stylesheet" type="text/css" href="nav.css">
        <link rel="stylesheet" type="text/css" href="form.css">
        <script src="jquery-3.6.0.min.js"></script>
    </head>
    <body id='background'>
    
        <div id="login">
            <h1 id="loginText">Login</h1>
            <a href="medicos.php" style="font-family: Arial, Helvetica, sans-serif;position:relative;left:150px;">Fazer login como admin</a>
            <br><br>
            <form method="post" id="loginForm" action="postlogin.php">
                <p class="error" id="nomeError"><p>
                <input type="text" placeholder="Nome" name="mNome" id="mNome" style="position:relative;left:80px;height:25px;font-size:25px;border-radius:5px;">
                <br><br>
                <p class="error" id="tipoError"><p>
                <input type="radio" name="mTipo" value="Medico" id="medico" class="selectType">Medico
                <input type="radio" name="mTipo" value="Laboratorio" id="laboratorio" class="selectType">Laboratorio
                <input type="radio" name="mTipo" value="Paciente" id="paciente" class="selectType">Paciente
                <br><br><br>
                <input type="submit" value="Fazer Login" style="position:relative;left:170px;width:150px;height:30px;border-radius:5px;font-size:20px;">
            </form>
        </div>

        <script type="text/javascript">
            $("#loginForm").submit(function(event){
                event.preventDefault();
                var proceed = true;
                var form = this;

                if(!$("#mNome").val()){
                    proceed = false;
                    $("#nomeError").css("display", "inline");
                    $("#nomeError").html("Você deve preencher o campo abaixo");
                }
                else
                    $("#nomeError").css("display", "none");

                if(!$("#medico").is(":checked") && !$("#laboratorio").is(":checked") && !$("#paciente").is(":checked")){
                    proceed = false;
                    $("#tipoError").css("display", "inline");
                    $("#tipoError").html("Você deve escolher uma das opções abaixo");
                }
                else
                    $("#tipoError").css("display", "none");
                
                if(proceed){
                    var tipo = '';
                    if($("#medico").is(":checked"))
                        tipo = 'medico';
                    else if($("#laboratorio").is(":checked"))
                        tipo = 'laboratorio';
                    else if($("#paciente").is(":checked"))
                        tipo = 'paciente';

                    var postUrl = $(this).attr("action");
                    var requestMethod = $(this).attr("method");
                    var formData = $(this).serialize();

                    $.ajax({
                        url : postUrl,
                        type : requestMethod,
                        dataType : "json",
                        data : formData
                    })
                    .done(function(response){
                        if(response.type == "error"){
                            $("#nomeError").css("display", "inline");
                            $("#nomeError").html(response.text);
                        }
                        else if(response.type == "done"){
                            $("#nomeError").css("display", "none");

                            if(response.page == "Medico"){
                                window.location = "usermedico.php";
                            }
                            else if(response.page == "Laboratorio"){
                                window.location = "userlaboratorio.php";
                            }
                            else if(response.page == "Paciente"){
                                window.location = "userpacienteexames.php";
                            }

                            $(form)[0].reset();
                        }
                    });
                }
            });
        </script>
    </body>
</html>