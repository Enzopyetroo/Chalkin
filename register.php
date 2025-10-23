<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/CSSlegal.css">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/x-icon" href="Imagens/moço.png">
  <title>Chalkin - Cadastro</title>

  <script>

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    function trimfunc(form){
        form.value = form.value.trim()
    }
    function checarnome(form){
        form.value = form.value.trim()
        var httpc = new XMLHttpRequest();
        var url = "pegar_dados_usuarios.php";
        httpc.open("POST", url, true);

        httpc.onreadystatechange = function() {
            if(httpc.readyState == 4 && httpc.status == 200) {
                var datarray = JSON.parse(httpc.responseText)
 
                for (var i = 0; i < datarray.length; i++){
                    nome = datarray[i].nome
                    
                    if (nome.toLowerCase() == form.value.toLowerCase()){
                        document.getElementById("jatem").innerHTML = "Já tem uma conta com esse nome"
                        document.getElementById("submit").disabled = true;
                        return
                    }else{
                        document.getElementById("jatem").innerHTML = ""
                        document.getElementById("submit").disabled = false;
                    }
                }
                //document.getElementById("logado").innerHTML = "Atualmente logado como: <br>"
                window.scrollTo(0, 99999);
            }
        };
        httpc.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpc.send();
    }
    function checarmail(form){
        form.value = form.value.trim()
        var httpc = new XMLHttpRequest();
        var url = "pegar_dados_usuarios.php";
        httpc.open("POST", url, true);

        httpc.onreadystatechange = function() {
            if(httpc.readyState == 4 && httpc.status == 200) {
                var datarray = JSON.parse(httpc.responseText)
                console.log(datarray)
                for (var i = 0; i < datarray.length; i++){
                    email = datarray[i].email
                    if (email == form.value){
                        document.getElementById("jatememail").innerHTML = "Já tem uma conta com esse email"
                        document.getElementById("submit").disabled = true;
                        return
                    }else{
                        document.getElementById("jatememail").innerHTML = ""
                        document.getElementById("submit").disabled = false;
                    }
                }
                //document.getElementById("logado").innerHTML = "Atualmente logado como: <br>"
                window.scrollTo(0, 99999);
            }
        };
        httpc.send();
    }
    function senhaa(form){
        form.value = form.value.trim()
        if (form.value != document.getElementById('senha').value){
            document.getElementById("senhas").innerHTML = "As senhas não batem"
            document.getElementById("submit").disabled = true;
        }else{
            document.getElementById("senhas").innerHTML = ""
            document.getElementById("submit").disabled = false;
        }
    }
    function senhaa2(form){
        form.value = form.value.trim()
        if (document.getElementById('senhas').innerHTML = "As senhas não batem"){
            if (form.value == document.getElementById('confirmsenha').value){
                document.getElementById("senhas").innerHTML = ""
                document.getElementById("submit").disabled = false;
            }
        }else{
            document.getElementById("senhas").innerHTML = ""
            document.getElementById("submit").disabled = false;
        }
    }
    </script>

  
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-size: 25px;
    }

    .login-container {
      background-color: #90ee90;
      padding: 28px 40px;
      border: 4px solid #102e10;
      width: 500px;
      border-radius: 8px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-top: 10px;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      padding: 10px;
      font-size: 18px;
      border: 2px solid black;
      border-radius: 2px;
    }

    input[type="submit"] {
      margin-top: 20px;
      padding: 10px;
      background-color: #3e943e;
      color: white;
      border: 2px solid black;
      border-radius: 4px;
      cursor: pointer;
      font-size: 25px;
      transition: 0.1s;
    }

    input[type="submit"]:hover {
      filter: brightness(110%);
      scale: 1.025;
    }

    span {
      color: red;
    }

    p {
      margin: 5px 0;
      font-size: 20px;
    }

    .erro{
        color: red;
    }

    .containerCheckers {
        overflow: hidden;
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 100%;
        margin: 0;
        opacity: 0.05;
    }

    .slidingBgCheckers {
        background: url("Imagens/checkers.png");
        height: 100vh;
        width: 300%;
        animation: slide 60s linear infinite;
    }

    @keyframes slide{
        0% {
            transform: translate3d(0, 0, 0);
        }
        100% {
            transform: translate3d(-100vw, 0, 0);
        }
    }

    .MainFlex{
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  height: 100%;
}

.RegisterFlex{
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
}

.barratopo{
  position: relative !important;
}

.login-container{
    width: 500px;
    font-size: 22px;
}
.input{
    height: 35px
}

@media (max-width: 600px) {
    .login-container{
        width: 400px;
        font-size: 20px;
    }
    .input{
        height: 30px
    }
}

@media (max-width: 350px) {
    .login-container{
        width: 300px;
    }
    .input{
        height: 30px
    }
}

@media (max-width: 300px) {
    .login-container{
        width: 200px;
        font-size: 15px;
    }
    .input{
        height: 30px;
    }
}

  </style>
</head>
<body>

<div class="containerCheckers">
  <div class="slidingBgCheckers"></div>
</div>

<div class="MainFlex">

    <?php include 'header.php';?>

    <div class="RegisterFlex">

  <div class="login-container">
        <form action="criarconta.php" method="post">
            <label for="fnome">Nome<span>*</span>:</label>
            <input minlength="3" type="text" id="fnome" name="fnome" placeholder="enzoolegal" required onkeyup="checarnome(this)" class="input">
            <p class="erro" id="jatem"> </p>

            <label for="nomexib">Apelido:</label>
            <input type="text" id="nomexib" name="nomexib" placeholder="Enzo" onkeyup="trimfunc(this)" class="input">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email100%Real@gmail.com" required onkeyup="checarmail(this)" class="input">
            <p class="erro" id="jatememail"> </p>

            <label for="senha">Senha<span>*</span>:</label>
            <input type="password" id="senha" name="senha" placeholder="Senha100%segura123" required autocomplete="off" onkeyup="senhaa2(this)" class="input">
        
            <label for="confirmsenha">Confirmar Senha<span>*</span>:</label>
            <input type="password" id="confirmsenha" name="confirmar" placeholder="Senha100%segura123" required autocomplete="off" onkeyup="senhaa(this)" class="input">
            <p class="erro" id="senhas"> </p>

            <input type="submit" value="Cadastrar" id="submit" class="">
        </form>
  </div>
  </div>

</div>
</body>
</html>
