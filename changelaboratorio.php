<?php
    $vnome = $vendereço = $vtelefone = $vemail = $vexames = $vcnpj = "";
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
        $vexames = TestInput($_POST["mExames"]);
        $vcnpj = TestInput($_POST["mCNPJ"]);
        $nome = $_SESSION["nome"];

        $sql = "SELECT COUNT(*) FROM laboratorios WHERE nome LIKE '$vnome' AND nome NOT LIKE '$nome'";
        $result = $conn->query($sql);
        $exists = ($result->fetchColumn() > 0) ? true : false;
        if($exists){
            $conn = null;
            $output = json_encode(array(
                'type' => 'nameError',
                'text' => 'Já existe um laboratório com este nome'
            ));
            die($output);
        }
        $sql = "SELECT COUNT(*) FROM laboratorios WHERE telefone LIKE '$vtelefone' AND nome NOT LIKE '$nome'";
        $result = $conn->query($sql);
        $exists = ($result->fetchColumn() > 0) ? true : false;
        if($exists){
            $conn = null;
            $output = json_encode(array(
                'type' => 'telefoneError',
                'text' => 'Já existe um laboratório com este telefone'
            ));
            die($output);
        }

        $sql = "UPDATE laboratorios SET 
        nome='$vnome',
        endereço='$vendereço',
        telefone='$vtelefone',
        email='$vemail',
        exames='$vexames',
        cnpj='$vcnpj'
        WHERE nome LIKE '$nome';";
        $conn->exec($sql);
        
        $sql = "UPDATE exames SET laboratorio='$vnome' WHERE laboratorio LIKE '$nome';";
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