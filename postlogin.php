<?php
    $vnome = $vtipo = "";
    $passou = 'não passou';
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'sistemadesaúdeDB126661';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) AND strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest"){
            $output = json_encode(array(
                'type' => 'err',
                'text' => 'Must be ajax'
            ));
            die($output);
        }
        $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $vnome = TestInput($_POST["mNome"]);
        $vtipo = TestInput($_POST["mTipo"]);

        if($vtipo == "Medico"){
            $passou = 'passou sim';
            $sql = "SELECT COUNT(*) FROM medicos WHERE nome LIKE '$vnome'";
            $result = $conn->query($sql);
            $exists = ($result->fetchColumn() > 0) ? true : false;
            if(!$exists){
                $conn = null;
                $output = json_encode(array(
                    'type' => 'error',
                    'text' => 'não existe um médico com este nome cadastrado no sistema'
                ));
                die($output);
            }
        }
        else if($vtipo == "Laboratorio"){
            $sql = "SELECT COUNT(*) FROM laboratorios WHERE nome LIKE '$vnome'";
            $result = $conn->query($sql);
            $exists = ($result->fetchColumn() > 0) ? true : false;
            if(!$exists){
                $conn = null;
                $output = json_encode(array(
                    'type' => 'error',
                    'text' => 'não existe um laboratório com este nome cadastrado no sistema'
                ));
                die($output);
            }
        }
        else if($vtipo == "Paciente"){
            $sql = "SELECT COUNT(*) FROM pacientes WHERE nome LIKE '$vnome'";
            $result = $conn->query($sql);
            $exists = ($result->fetchColumn() > 0) ? true : false;
            if(!$exists){
                $conn = null;
                $output = json_encode(array(
                    'type' => 'error',
                    'text' => 'não existe um paciente com este nome cadastrado no sistema'
                ));
                die($output);
            }
        }

        session_start();
        $_SESSION["nome"] = $vnome;
        $conn = null;

        $output = json_encode(array(
            'type' => 'done',
            'page' => $vtipo,
            'passou' => $passou
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