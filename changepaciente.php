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
        $nome = $_SESSION["nome"];

        $sql = "SELECT * FROM pacientes WHERE nome LIKE '$vnome' AND nome NOT LIKE '$nome'";
        $result = $conn->query($sql);
        if($result->numr_rows > 0){
            $conn = null;
            $output = json_encode(array(
                'type' => 'nameError',
                'text' => 'Já existe um paciente com este nome'
            ));
            die($output);
        }
        $sql = "SELECT COUNT(*) FROM pacientes WHERE telefone LIKE '$vtelefone' AND nome NOT LIKE '$nome'";
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

        $sql = "UPDATE pacientes SET
        nome='$vnome',
        endereço='$vendereço',
        telefone='$vtelefone',
        email='$vemail',
        genero='$vgenero',
        idade='$vidade',
        cpf='$vcpf'
        WHERE nome LIKE '$nome';";
        $conn->exec($sql);

        $sql = "UPDATE consultas SET paciente='$vnome' WHERE paciente LIKE '$nome';";
        $conn->exec($sql);

        $sql = "UPDATE exames SET paciente='$vnome' WHERE paciente LIKE '$nome';";
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