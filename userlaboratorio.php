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
        <script type="text/javascript">
            $(document).ready(function(){
                if($('#contents tbody tr').length%10 != 0){
                    const tam = 10 - $('#contents tbody tr').length%10;
                    for(i = 0; i < tam; i++){
                        $('#contents tbody').append('<tr style="height: 25.35px;"></tr>');
                    }
                }
                var rowsShown = 10;
                var rowsTotal = $('#contents tbody tr').length;
                var numPages = rowsTotal/rowsShown;
                for(i = 0; i < numPages; i++){
                    var pageNum = i+1;
                    $('#pagination').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
                }
                $('#contents tbody tr').hide();
                $('#contents tbody tr').slice(0, rowsShown).show();
                $('#pagination a:first').addClass('current');
                $('#pagination a').bind('click', function(){

                    $('#pagination a').removeClass('current');
                    $(this).addClass('current');
                    var currPage = $(this).attr('rel');
                    var startItem = currPage * rowsShown;
                    var endItem = startItem + rowsShown;
                    $('#contents tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
                        css('display', 'table-row').animate({opacity:1}, 300);
                });
            })
        </script>
    </head>
    <body id="background">
        <div id="content">
        <a href="login.php">Logout</a>
        <ul id="navbar">
            <li class="nav"><a id="active" href="userlaboratorio.php">Exames</a></li>
            <li class="nav"><a href="userlaboratoriocadastro.php">Exames</a></li>
            <li class="nav"><a href="userlaboratoriodados.php">Usuário</a></li>
        </ul>
        <br><br>

        <div id="dados">
            <h1>Exames</h1>
            <?php
                session_start();
                $server = 'localhost';
                $user = 'root';
                $password = '';
                $db = 'sistemadesaúdeDB126661';

                $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $nome = $_SESSION["nome"];

                $sql = "SELECT COUNT(*) FROM exames WHERE laboratorio LIKE '$nome'";
                $result = $conn->query($sql);
                $exists = ($result->fetchColumn() > 0) ? true : false;

                if($exists){
                    echo '<table style="position: relative; top: 0; bottom: 0; left: 0; right: 0; width: 100%;" id="contents">
                    <tr style="font-weight: bold;"> <th>Data</th> <th>Paciente</th> <th>Tipo de Exame</th> <th>Resultado</th> </tr>';
                    $sql = "SELECT * FROM exames WHERE laboratorio LIKE '$nome'";
                    $result = $conn->query($sql);
                    $data = $result->fetchAll();
                    foreach($data as $row){
                        echo "<tr> <th>".$row['dia']."</th> <th>".$row['paciente']."</th> <th>".$row['tipo']."</th> <th>".$row['resultado']."</th> </tr>";
                    }
                    echo "</table>";
                }
                else{
                    echo '<p>Não existe nenhum exame cadastrado para esta conta</p>';
                }
                $conn = null;
            ?>
            <div id="pagination"></div>
        </div>

        <br><br>
        <div style="display: inline;  background-color: white; position: absolute; width: 98.98%; height: 10%;">
        <div class='contador' style="float: left; margin-left: 50px;">
        <span>Total de exames mensais: <?php
            session_start();
            $server = 'localhost';
            $user = 'root';
            $password = '';
            $db = 'sistemadesaúdeDB126661';
            $total = 0;
            
            $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $nome = $_SESSION["nome"];
            $date = date('Y-m-d');
            $currentDate = explode('-', $date);

            $sql = "SELECT * FROM exames WHERE laboratorio LIKE '$nome'";
            $result = $conn->query($sql);
            $data = $result->fetchAll();

            foreach($data as $row){
                $rowDate = explode('-', $row['dia']);
                
                if($currentDate[0] == $rowDate[0] && $currentDate[1] == $rowDate[1]){
                    $total += 1;
                }
            }
            echo $total;
            $conn = null;
        ?></span>
        </div>
        <div class='contador' style="float: right; margin-right: 50px;">
        <span>Total de exames anuais: <?php
            session_start();
            $server = 'localhost';
            $user = 'root';
            $password = '';
            $db = 'sistemadesaúdeDB126661';
            $total = 0;
            
            $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $nome = $_SESSION["nome"];
            $date = date('Y-m-d');
            $currentDate = explode('-', $date);

            $sql = "SELECT * FROM exames WHERE laboratorio LIKE '$nome'";
            $result = $conn->query($sql);
            $data = $result->fetchAll();

            foreach($data as $row){
                $rowDate = explode('-', $row['dia']);
                
                if($currentDate[0] == $rowDate[0]){
                    $total += 1;
                }
            }
            echo $total;
            $conn = null;
        ?></span>
        </div>
        </div>
        </div>
    </body>
</html>