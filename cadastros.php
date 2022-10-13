
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Cadastrar</title>
        <link rel="stylesheet" type="text/css" href="basics.css">
        <link rel="stylesheet" type="text/css" href="nav.css">
        <link rel="stylesheet" type="text/css" href="form.css">
        <script src="jquery-3.6.0.min.js"></script>
    </head>
    <body id="background">
        <div id="content">
        <a href="login.php">Logout</a>
        <ul id="navbar">
            <li class="nav"><a href="medicos.php">Medicos</a></li>
            <li class="nav"><a href="laboratorios.php">Laboratorios</a></li>
            <li class="nav"><a href="pacientes.php">Pacientes</a></li>
            <li class="nav"><a id="active" href="cadastros.php">Cadastrar</a></li>
        </ul>
        <br><br>
        <div class="formdiv">
        <h1 class="insira">Insira um novo médico</h1>
        <form method="post" action="postmedicos.php" id="insertMedico">
            <input type="text" placeholder="Nome" name="mNome" id="mNomeMedico" class="addinput">
            <p class="error" id="nomeErrorMedico"></p>
            <br><br>
            <input type="text" placeholder="Endereço" name="mEndereço" id="mEndereçoMedico" class="addinput">
            <p class="error" id="endereçoErrorMedico"></p>
            <br><br>
            <input type="text" placeholder="Telefone" name="mTelefone" id="mTelefoneMedico" class="addinput">
            <p class="error" id="telefoneErrorMedico"></p>
            <br><br>
            <input type="email" placeholder="E-mail" name="mEmail" id="mEmailMedico" class="addinput">
            <p class="error" id="emailErrorMedico"></p>
            <br><br>
            <input type="text" placeholder="Especialidade" name="mEspecialidade" id="mEspecialidade" class="addinput">
            <p class="error" id="especialidadeError"></p>
            <br><br>
            <input type="submit">
            <br>
        </form>
        </div>
        <br>
        <div class="formdiv">
        <h1 class="insira">Insira um novo laboratório</h1>
        <form method="post" action="postlaboratorios.php" id="insertLaboratorio">
            <input type="text" placeholder="Nome" name="mNome" id="mNomeLab" class="addinput">
            <p class="error" id="nomeErrorLab"></p>
            <br><br>
            <input type="text" placeholder="Endereço" name="mEndereço" id="mEndereçoLab" class="addinput">
            <p class="error" id="endereçoErrorLab"></p>
            <br><br>
            <input type="text" placeholder="Telefone" name="mTelefone" id="mTelefoneLab" class="addinput">
            <p class="error" id="telefoneErrorLab"></p>
            <br><br>
            <input type="email" placeholder="E-mail" name="mEmail" id="mEmailLab" class="addinput">
            <p class="error" id="emailErrorLab"></p>
            <br><br>
            <input type="text" placeholder="Tipos de Exame" name="mExames" id="mExames" class="addinput">
            <p class="error" id="exameError"></p>
            <br><br>
            <input type="text" placeholder="CNPJ" name="mCNPJ" id="mCNPJ" class="addinput">
            <p class="error" id="cnpjError"></p>
            <br><br>
            <input type="submit">
            <br>
        </form>
        </div>
        <br>
        <div class="formdiv">
        <h1 class="insira">Insira um novo paciente</h1>
        <form method="post" action="postpacientes.php" id="insertPaciente" >
            <input type="text" placeholder="Nome" name="mNome" id="mNomePaciente" class="addinput">
            <p class="error" id="nomeErrorPaciente"></p>
            <br><br>
            <input type="text" placeholder="Endereço" name="mEndereço" id="mEndereçoPaciente" class="addinput">
            <p class="error" id="endereçoErrorPaciente"></p>
            <br><br>
            <input type="text" placeholder="Telefone" name="mTelefone" id="mTelefonePaciente" class="addinput">
            <p class="error" id="telefoneErrorPaciente"></p>
            <br><br>
            <input type="email" placeholder="E-mail" name="mEmail" id="mEmailPaciente" class="addinput">
            <p class="error" id="emailErrorPaciente"></p>
            <br><br>
            Gênero: <input type="radio" name="mGenero" value="masculino" id="masculino"> Masculino
            <input type="radio" name="mGenero" value="feminino" id="feminino"> Feminino
            <input type="radio" name="mGenero" value="outro" id="outro"> Outro
            <p class="error" id="generoError"></p>
            <br><br>
            <input type="number" placeholder="Idade" name="mIdade" id="mIdade" class="addinput">
            <p class="error" id="idadeError"></p>
            <br><br>
            <input type="text" placeholder="CPF" name="mCPF" id="mCPF" class="addinput">
            <p class="error" id="cpfError"></p>
            <br><br>
            <input type="submit">
            <br>
        </form>
        </div>

        <script type="text/javascript">
            $("#insertMedico").submit(function(event){
                event.preventDefault();
                var proceed = true;
                var form = this;

                if(!$("#mNomeMedico").val()){
                    proceed = false;
                    $("#nomeErrorMedico").css('display', 'inline');
                    $("#nomeErrorMedico").html("Este campo deve ser preenchido");
                }
                else
                    $("#nomeErrorMedico").css('display', 'none');

                if(!$("#mEndereçoMedico").val()){
                    proceed = false;
                    $("#endereçoErrorMedico").css('display', 'inline');
                    $("#endereçoErrorMedico").html("Este campo deve ser preenchido");
                }
                else
                    $("#endereçoErrorMedico").css('display', 'none');

                if(!$("#mTelefoneMedico").val()){
                    proceed = false;
                    $("#telefoneErrorMedico").css('display', 'inline');
                    $("#telefoneErrorMedico").html("Este campo deve ser preenchido");
                }
                else
                    $("#telefoneErrorMedico").css('display', 'none');

                if(!$("#mEmailMedico").val()){
                    proceed = false;
                    $("#emailErrorMedico").css('display', 'inline');
                    $("#emailErrorMedico").html("Este campo deve ser preenchido");
                }
                else
                    $("#emailErrorMedico").css('display', 'none');

                if(!$("#mEspecialidade").val()){
                    proceed = false;
                    $("#especialidadeError").css('display', 'inline');
                    $("#especialidadeError").html("Este campo deve ser preenchido");
                }
                else
                    $("#especialidadeError").css('display', 'none');

                if(proceed){
                    var postUrl = $(this).attr("action");
                    var requestMethod = $(this).attr("method");
                    var formData = $(this).serialize();

                    $.ajax({
                        url : postUrl,
                        type : requestMethod,
                        dataType : 'json',
                        data : formData
                    })
                    .done(function(response){
                        if(response.type == 'nameError'){
                            $("#nomeErrorMedico").css('display', 'inline');
                            $("#nomeErrorMedico").html('Já existe um médico com este nome');
                        }
                        else{
                            $("#nomeErrorMedico").css('display', 'none');
                        }
                        if(response.type == "telefoneError"){
                            $("#telefoneErrorMedico").css('display', 'inline');
                            $("#telefoneErrorMedico").html('Já existe um médico com este telefone');
                        }
                        else{
                            $("#telefoneErrorMedico").css('display', 'none');
                        }
                        if(response.type == "response"){
                            $(form)[0].reset();
                        }
                    });
                }
            });
            $("#insertLaboratorio").submit(function(event){
                event.preventDefault();
                var proceed = true;
                var form = this;

                if(!$("#mNomeLab").val()){
                    proceed = false;
                    $("#nomeErrorLab").css('display', 'inline');
                    $("#nomeErrorLab").html("Este campo deve ser preenchido");
                }
                else
                    $("#nomeErrorLab").css('display', 'none');

                if(!$("#mEndereçoLab").val()){
                    proceed = false;
                    $("#endereçoErrorLab").css('display', 'inline');
                    $("#endereçoErrorLab").html("Este campo deve ser preenchido");
                }
                else
                    $("#endereçoErrorLab").css('display', 'none');

                if(!$("#mTelefoneLab").val()){
                    proceed = false;
                    $("#telefoneErrorLab").css('display', 'inline');
                    $("#telefoneErrorLab").html("Este campo deve ser preenchido");
                }
                else
                    $("#telefoneErrorLab").css('display', 'none');

                if(!$("#mEmailLab").val()){
                    proceed = false;
                    $("#emailErrorLab").css('display', 'inline');
                    $("#emailErrorLab").html("Este campo deve ser preenchido");
                }
                else
                    $("#emailErrorLab").css('display', 'none');

                if(!$("#mExames").val()){
                    proceed = false;
                    $("#exameError").css('display', 'inline');
                    $("#exameError").html("Este campo deve ser preenchido");
                }
                else
                    $("#exameError").css('display', 'none');
                
                if(!$("#mCNPJ").val()){
                    proceed = false;
                    $("#cnpjError").css('display', 'inline');
                    $("#cnpjError").html("Este campo deve ser preenchido");
                }
                else
                    $("#cnpjError").css('display', 'none');

                if(proceed){
                    var postUrl = $(this).attr("action");
                    var requestMethod = $(this).attr("method");
                    var formData = $(this).serialize();

                    $.ajax({
                        url : postUrl,
                        type : requestMethod,
                        dataType : 'json',
                        data : formData
                    })
                    .done(function(response){
                        if(response.type == 'nameError'){
                            $("#nomeErrorLab").css('display', 'inline');
                            $("#nomeErrorLab").html('Já existe um laboratório com este nome');
                        }
                        else{
                            $("#nomeErrorLab").css('display', 'none');
                        }
                        if(response.type == "telefoneError"){
                            $("#telefoneErrorLab").css('display', 'inline');
                            $("#telefoneErrorLab").html('Já existe um laboratório com este telefone');
                        }
                        else{
                            $("#telefoneErrorLab").css('display', 'none');
                        }
                        if(response.type == "response"){
                            $(form)[0].reset();
                        }
                    });
                }
            });
            $("#insertPaciente").submit(function(event){
                event.preventDefault();
                var proceed = true;
                var form = this;

                if(!$("#mNomePaciente").val()){
                    proceed = false;
                    $("#nomeErrorPaciente").css('display', 'inline');
                    $("#nomeErrorPaciente").html("Este campo deve ser preenchido");
                }
                else
                    $("#nomeErrorPaciente").css('display', 'none');

                if(!$("#mEndereçoPaciente").val()){
                    proceed = false;
                    $("#endereçoErrorPaciente").css('display', 'inline');
                    $("#endereçoErrorPaciente").html("Este campo deve ser preenchido");
                }
                else
                    $("#endereçoErrorPaciente").css('display', 'none');

                if(!$("#mTelefonePaciente").val()){
                    proceed = false;
                    $("#telefoneErrorPaciente").css('display', 'inline');
                    $("#telefoneErrorPaciente").html("Este campo deve ser preenchido");
                }
                else
                    $("#telefoneErrorPaciente").css('display', 'none');

                if(!$("#mEmailPaciente").val()){
                    proceed = false;
                    $("#emailErrorPaciente").css('display', 'inline');
                    $("#emailErrorPaciente").html("Este campo deve ser preenchido");
                }
                else
                    $("#emailErrorPaciente").css('display', 'none');

                if(!$("#masculino").is(":checked") && !$("#feminino").is(":checked") && !$("#outro").is(":checked")){
                    proceed = false;
                    $("#generoError").css('display', 'inline');
                    $("#generoError").html("Você deve escolher uma das opções acima");
                }
                else
                    $("#generoError").css('display', 'none');
                
                if(!$("#mIdade").val()){
                    proceed = false;
                    $("#idadeError").css('display', 'inline');
                    $("#idadeError").html("Este campo deve ser preenchido");
                }
                else
                    $("#idadeError").css('display', 'none');
                
                    if(!$("#mCPF").val()){
                    proceed = false;
                    $("#cpfError").css('display', 'inline');
                    $("#cpfError").html("Este campo deve ser preenchido");
                }
                else
                    $("#cpfError").css('display', 'none');

                if(proceed){
                    var postUrl = $(this).attr("action");
                    var requestMethod = $(this).attr("method");
                    var formData = $(this).serialize();

                    $.ajax({
                        url : postUrl,
                        type : requestMethod,
                        dataType : 'json',
                        data : formData
                    })
                    .done(function(response){
                        if(response.type == 'nameError'){
                            $("#nomeErrorPaciente").css('display', 'inline');
                            $("#nomeErrorPaciente").html('Já existe um paciente com este nome');
                        }
                        else{
                            $("#nomeErrorPaciente").css('display', 'none');
                        }
                        if(response.type == "telefoneError"){
                            $("#telefoneErrorPaciente").css('display', 'inline');
                            $("#telefoneErrorPaciente").html('Já existe um paciente com este telefone');
                        }
                        else{
                            $("#telefoneErrorPaciente").css('display', 'none');
                        }
                        if(response.type == "response"){
                            $(form)[0].reset();
                        }
                    });
                }
            });
        </script>
        </div>
    </body>
</html>