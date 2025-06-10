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
        h1{
            font-size: 60px;
            margin-top: 50px;
        }
        .Coisa{
            position:fixed;
            background-color: #90ee90;
            border: 5px solid black;
            border-radius: 20px;
            width: 30%;
            height: 70%;
            top: 75%;
            right: 50%;
            font-size: 30px;
            transform: translate(50%, -75%);
            justify-content: center;
            line-break: strict;
        }
        form{
            margin-top: 25%;
        }
        .border{
            border: 2px solid black !important
        }
        ::placeholder{
            color:rgb(172, 172, 172);
            opacity: 1;
        }
        input[type="text"],input[type="password"]{
            width: 40%;
            height: 25px;
            margin-top: 10px;
            font-size: 15px !important;
        }
        input[type="button"]{
            width: 15%;
            height: 30px;
            font-size: 20px;
            font-size: 15px !important;
            transition: 0.1s;
        }

        #chalkin{
            position: absolute;
            top: 50%;
            right: 50%;
            transform: translate(50%, -50%);
            z-index: 0;
            width: 100%;
            opacity: 0.1;
            filter: blur(10px);
            font-size: 400px;
        }
        span{
            color: red;
            font-size: 20px;
            display: none;
        }
        #submit:active{
            scale: 0.98;
        }
                @media only screen and (max-width: 1500px) {
            .coisa{
                width: 50%;
            }
        }
        @media only screen and (max-width: 1000px) {
            .coisa{
                width: 70%;
            }
        }
        @media only screen and (max-width: 600px) {
            .coisa{
                width: 100%;
                height: 100%;
                transform: translate(50%, -50%);
            }
            #titulo {
                font-size:45px;
            }
            #submit{
                width: 30%;
                height: 5%
            }
            input[type="text"],input[type="password"],input[type="email"]{
                width: 70%;
            }
        }
        @media only screen and (max-height: 800px) {
            #submit{
                height: 5%
            }
            input[type="text"],input[type="password"],input[type="email"]{
                height: 25px;
            }
        }
        @media only screen and (max-width: 300px) {
            label{
                font-size: 20px
            }
            #titulo {
                font-size:30px;
            }
            #submit{
                width: 50%;
            }
        }
    </style>
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

<?php include 'header.php'?>

<br><br><br><br><br>
<marquee id="chalkin">Chalkin</marquee>
<h1 id="titulo">LOGIN</h1>
    <div class="Coisa">
        <br>
            <form action="" method="post">
                <label for="fnome">Nome/Email:</label><br>
                <input class="border" minlength="3" type="text" id="fnome" name="fnome" placeholder="enzoolegal" required onkeyup="trimfunc(this)">
                <p style="font-size:20px" id="jatem"> </p>
                <br>

                <label for="senha" minlength="6">Senha:</label><br>
                <input class="border" type="password" id="senha" name="senha" placeholder="Senha100%segura123" required autocomplete="off" onkeyup="trimfunc(this)"><br><br>

                <!--<input type="checkbox"><label style="font-size: 20px;"> Me manter logado</label><br><br>-->
                <input class="border botoes" type="button" value="Logar" id="submit" onclick="submitform()"><br><br>
                <span id="falhou">Email ou senha incorreta</span>
            </form>
    </div>
</body>
</html>