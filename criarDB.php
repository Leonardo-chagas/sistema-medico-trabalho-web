<!DOCTYPE html>
<html>
    <body>
        <?php
        $server = 'localhost';
        $user = 'root';
        $password = '';
        $db = 'sistemadesaúdeDB126661';

        try{
            $conn = new PDO("mysql:host=$server", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "CREATE DATABASE IF NOT EXISTS $db";
            $conn->exec($sql);

            $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "CREATE TABLE IF NOT EXISTS medicos (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                nome VARCHAR(100) NOT NULL,
                endereço VARCHAR(100) NOT NULL,
                telefone VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                especialidade VARCHAR(100) NOT NULL,
                PRIMARY KEY (id)
            );";
            $conn->exec($sql);

            $sql = "CREATE TABLE IF NOT EXISTS laboratorios (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                nome VARCHAR(100) NOT NULL,
                endereço VARCHAR(100) NOT NULL,
                telefone VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                exames VARCHAR(100) NOT NULL,
                cnpj VARCHAR(100) NOT NULL,
                PRIMARY KEY (id)
            );";
            $conn->exec($sql);

            $sql = "CREATE TABLE IF NOT EXISTS pacientes (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                nome VARCHAR(100) NOT NULL,
                endereço VARCHAR(100) NOT NULL,
                telefone  VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                genero VARCHAR(100) NOT NULL,
                idade INT UNSIGNED NOT NULL,
                cpf VARCHAR(100) NOT NULL,
                PRIMARY KEY (id)
            );";
            $conn->exec($sql);

            $sql = "CREATE TABLE IF NOT EXISTS consultas (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                medico VARCHAR(100) NOT NULL,
                dia DATE NOT NULL,
                paciente VARCHAR(100) NOT NULL,
                receita VARCHAR(100) NOT NULL,
                observações VARCHAR(100) NOT NULL,
                PRIMARY KEY (id)
            );";
            $conn->exec($sql);

            $sql = "CREATE TABLE IF NOT EXISTS exames (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                laboratorio VARCHAR(100) NOT NULL,
                dia DATE NOT NULL,
                paciente VARCHAR(100) NOT NULL,
                tipo VARCHAR(100) NOT NULL,
                resultado VARCHAR(100) NOT NULL,
                PRIMARY KEY (id)
            );";

            $conn->exec($sql);
            echo "Banco de dados foi criado";
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
        ?>
    </body>
</html>