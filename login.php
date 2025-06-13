<!DOCTYPE php>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chalkin - Login</title>
    <link rel="stylesheet" href="CSSlegal.css">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="Imagens/moço.png">
    <style>
    body, html {
      height: 100%;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 25px;
    }

    .login-container {
      background-color: #90ee90;
      padding: 40px;
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

    input {
      padding: 10px;
      font-size: 18px;
      border: 2px solid black;
      border-radius: 2px;
    }

    #submit {
      margin-top: 20px;
      padding: 10px;
      background-color:#3e943e;
      color: white;
      border: 2px solid black;
      border-radius: 4px;
      cursor: pointer;
      font-size: 25px;
      transition: 0.1s;
    }

    #submit:hover {
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

  </style>
</head>
<body>


    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    function trimfunc(form){
        form.value = form.value.trim()
    }

    function submitform(){
        document.getElementById("falhou").style.display = "none"
        var httpc = new XMLHttpRequest();
        var url = "logarnaconta.php";
        httpc.open("POST", url, true);

        httpc.onreadystatechange = function() {
            if(httpc.readyState == 4 && httpc.status == 200) {
                var coisa = httpc.responseText.trim()
                console.log(coisa)
                if(coisa == "Login successful"){
                    document.getElementById("falhou").style.display = "none"
                    window.location.replace("aaaaa.php")
                }
                if (coisa = "Login failed"){
                    document.getElementById("falhou").style.display = "block"
                }
            }
        }
        var nome = document.getElementById("fnome").value.toString()
        var senha = document.getElementById("senha").value.toString()
        httpc.open("post", "logarnaconta.php", true);
        httpc.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpc.send("fnome="+nome+"&senha="+senha);
    }
    </script>
<body id="body">
<div class="containerCheckers">
  <div class="slidingBgCheckers"></div>
</div>
<?php include 'header.php'?>

<div class="login-container">
    <div class="Coisa">
        <br>
            <form action="" method="post">
                <label for="fnome">Nome/Email:</label>
                <input minlength="3" type="text" id="fnome" name="fnome" placeholder="enzoolegal" required onkeyup="trimfunc(this)">
                <br>

                <label for="senha" minlength="6">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Senha100%segura123" required autocomplete="off" onkeyup="trimfunc(this)"><br>

                <!--<input type="checkbox"><label style="font-size: 20px;"> Me manter logado</label><br><br>-->
                <input class="botoes" type="button" value="Logar" id="submit" onclick="submitform()"><br>
                <span style="display: none;" id="falhou">Email ou senha incorreta</span>
            </form>
    </div>
</div>
</body>
</html>