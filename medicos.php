<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Médicos</title>
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
            <li class="nav"><a id="active" href="medicos.php">Medicos</a></li>
            <li class="nav"><a href="laboratorios.php">Laboratorios</a></li>
            <li class="nav"><a href="pacientes.php">Pacientes</a></li>
            <li class="nav"><a href="cadastros.php">Cadastrar</a></li>
        </ul>
        <br><br>

        <div id="dados">
            <table style="position: relative; top: 0; bottom: 0; left: 0; right: 0; width: 100%;" id="contents">
                <tr style="font-weight: bold;"> <th>Nome</th> <th>Endereço</th> <th>Telefone</th> <th>E-mail</th> <th>Especialidade</th> </tr>
                <?php
                    $server = 'localhost';
                    $user = 'root';
                    $password = '';
                    $db = 'sistemadesaúdeDB126661';

                    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "SELECT * FROM medicos";
                    $result = $conn->query($sql);
                    $data = $result->fetchAll();

                    foreach($data as $row){
                        echo "<tr> <th>".$row['nome']."</th> <th>".$row['endereço']."</th> <th>".$row['telefone']."</th> <th>".$row['email'].".</th> <th>".$row['especialidade']."</th> </tr>";
                    }
                    $conn = null;
                ?>
            </table>
            <div id="pagination"></div>
        </div>
        </div>
    </body>
</html>