<?php
    $vnome = $vendereço = $vtelefone = $vemail = $vespecialidade = "";
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'sistemadesaúdeDB126661';

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

        $vnome = TestInput($_POST["mNome"]);
        $vendereço = TestInput($_POST["mEndereço"]);
        $vtelefone = TestInput($_POST["mTelefone"]);
        $vemail = TestInput($_POST["mEmail"]);
        $vespecialidade = TestInput($_POST["mEspecialidade"]);
        $erro = false;

        $sql = "SELECT COUNT(*) FROM medicos WHERE nome LIKE '$vnome'";
        $result = $conn->query($sql);
        $exists = ($result->fetchColumn() > 0) ? true : false;
        if($exists){
            $conn = null;
            $output = json_encode(array(
                'type' => 'nameError',
                'text' => 'Já existe um médico com este nome'
            ));
            die($output);
        }
        $sql = "SELECT COUNT(*) FROM medicos WHERE telefone LIKE '$vtelefone'";
        $result = $conn->query($sql);
        $exists = ($result->fetchColumn() > 0) ? true : false;
        if($exists){
            $conn = null;
            $output = json_encode(array(
                'type' => 'telefoneError',
                'text' => 'Já existe um médico com este telefone'
            ));
            die($output);
        }

        $sql = "INSERT INTO medicos(nome, endereço, telefone, email, especialidade) VALUES
        (
            '$vnome',
            '$vendereço',
            '$vtelefone',
            '$vemail',
            '$vespecialidade'
        );";
        $conn->exec($sql);
        $conn = null;

        $output = json_encode(array(
            'type' => 'response',
            'nome' => $vnome,
            'endereço' => $vendereço,
            'telefone' => $vtelefone,
            'email' => $vemail,
            'especialidade' => $vespecialidade
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