<?php
    $vdata = $vpaciente = $vreceita = $vobs =  "";
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'sistemadesaúdeDB126661';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) AND strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest"){
            $output = json_encode(array(
                'type' => 'error',
                'text' => 'Must be ajax'
            ));
            die($output);
        }
        $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $vdata = TestInput($_POST["mData"]);
        $vpaciente = TestInput($_POST["mPaciente"]);
        $vreceita = TestInput($_POST["mReceita"]);
        $vobs = TestInput($_POST["mObs"]);

        $sql = "SELECT COUNT(*) FROM pacientes WHERE nome LIKE '$vpaciente'";
        $result = $conn->query($sql);
        $exists = ($result->fetchColumn() > 0) ? true : false;
        if(!$exists){
            $conn = null;
            $output = json_encode(array(
                'type' => 'pacienteError',
                'text' => 'Não existe um paciente com este nome cadastrado no sistema'
            ));
            die($output);
        }
        $nome = $_SESSION["nome"];

        $sql = "INSERT INTO consultas(medico, dia, paciente, receita, observações) VALUES
        (
            '$nome',
            '$vdata',
            '$vpaciente',
            '$vreceita',
            '$vobs'
        );";
        $conn->exec($sql);
        $conn = null;

        $output = json_encode(array(
            'type' => 'response',
            'medico' => $_SESSION["nome"],
            'data' => $vdata,
            'paciente' => $vpaciente,
            'receitas' => $vreceita,
            'observaçoes' => $vobs
        ));
        die($output);
    }

    function TestInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>