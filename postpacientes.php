<?php
    $vnome = $vendereço = $vtelefone = $vemail = $vgenero = $vidade = $vcpf = "";
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
        $vgenero = TestInput($_POST["mGenero"]);
        $vidade = TestInput($_POST["mIdade"]);
        $vcpf = TestInput($_POST["mCPF"]);

        $sql = "SELECT COUNT(*) FROM pacientes WHERE nome LIKE '$vnome'";
        $result = $conn->query($sql);
        $exists = ($result->fetchColumn() > 0) ? true : false;
        if($exists){
            $conn = null;
            $output = json_encode(array(
                'type' => 'nameError',
                'text' => 'Já existe um paciente com este nome'
            ));
            die($output);
        }
        $sql = "SELECT COUNT(*) FROM pacientes WHERE telefone LIKE '$vtelefone'";
        $result = $conn->query($sql);
        $exists = ($result->fetchColumn() > 0) ? true : false;
        if($exists){
            $conn = null;
            $output = json_encode(array(
                'type' => 'telefoneError',
                'text' => 'Já existe um paciente com este telefone'
            ));
            die($output);
        }

        $sql = "INSERT INTO pacientes(nome, endereço, telefone, email, genero, idade, cpf) VALUES
        (
            '$vnome',
            '$vendereço',
            '$vtelefone',
            '$vemail',
            '$vgenero',
            '$vidade',
            '$vcpf'
        );";
        $conn->exec($sql);
        $conn = null;

        $output = json_encode(array(
            'type' => 'response',
            'nome' => $vnome,
            'endereço' => $vendereço,
            'telefone' => $vtelefone,
            'email' => $vemail,
            'genero' => $vgenero,
            'idade' => $vidade,
            'cpf' => $vcpf
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