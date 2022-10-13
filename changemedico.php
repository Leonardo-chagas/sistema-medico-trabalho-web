<?php
    $vnome = $vendereço = $vtelefone = $vemail = $vespecialidade = "";
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'sistemadesaúdeDB126661';
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["nome"])){

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
        $nome = $_SESSION["nome"];

        $sql = "SELECT COUNT(*) FROM medicos WHERE nome LIKE '$vnome' AND nome NOT LIKE '$nome'";
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
        $sql = "SELECT COUNT(*) FROM medicos WHERE telefone LIKE '$vtelefone' AND nome NOT LIKE '$nome'";
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

        $sql = "UPDATE medicos SET
        nome='$vnome',
        endereço='$vendereço',
        telefone='$vtelefone',
        email='$vemail',
        especialidade='$vespecialidade'
        WHERE nome LIKE '$nome';";
        $conn->exec($sql);

        $sql = "UPDATE consultas SET medico='$vnome' WHERE medico LIKE '$nome';";
        $conn->exec($sql);

        $_SESSION["nome"] = $vnome;
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