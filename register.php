<!DOCTYPE php>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chalkin - Register</title>
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
        #formulario>*{
            border: none;
        }
        .border{
            border: 2px solid black !important
        }
        ::placeholder{
            color:rgb(172, 172, 172);
            opacity: 1;
        }
        input[type="text"],input[type="password"],input[type="email"]{
            width: 40%;
            height: 25px;
            margin-top: 10px;
            font-size: 15px !important;
        }
        input[type="submit"]{
            width: 15%;
            height: 30px;
            font-size: 20px;
        }
        input[type="submit"]:hover{
            scale: 1.05;
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
    function checarnome(form){
        form.value = form.value.trim()
        var httpc = new XMLHttpRequest();
        var url = "pegar_dados.php";
        httpc.open("POST", url, true);

        httpc.onreadystatechange = function() {
            if(httpc.readyState == 4 && httpc.status == 200) {
                var datarray = JSON.parse(httpc.responseText)
                console.log(datarray)
                for (var i = 0; i < datarray.length; i++){
                    nome = datarray[i].nome
                    if (nome == form.value){
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
        httpc.send('lorem=ipsum&foo=bar');
    }
    function checarmail(form){
        form.value = form.value.trim()
        var httpc = new XMLHttpRequest();
        var url = "pegar_dados.php";
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
        httpc.send('lorem=ipsum&foo=bar');
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
<body id="body">

<?php include 'header.php'?>

<br><br><br><br><br>
<marquee id="chalkin">Chalkin</marquee>
<h1 id="Titulo">CRIAR CONTA</h1>
    <div class="Coisa">
        <br>
            <form action="criarconta.php" method="post">
                <label for="fnome">Nome<span>*</span>:</label><br>
                <input class="border" minlength="3" type="text" id="fnome" name="fnome" placeholder="enzoolegal" required onkeyup="checarnome(this)">
                <p style="font-size:20px" id="jatem"> </p>
                <br>

                <label for="nomexib">Apelido:</label><br>
                <input class="border" type="text" id="nomexib" name="nomexib" placeholder="Enzo" onkeyup="trimfunc(this)"><br><br>

                <label for="email">Email:</label><br>
                <input class="border" type="email" id="email" name="email" placeholder="Email100%Real@gmail.com" required onkeyup="checarmail(this)">
                <p style="font-size:20px" id="jatememail"> </p><br>

                <label for="senha" minlength="6">Senha<span>*</span>:</label><br>
                <input class="border" type="password" id="senha" name="senha" placeholder="Senha100%segura123" required autocomplete="off" onkeyup="senhaa2(this)"><br><br>

                <label for="senha" minlength="6">Confirmar Senha<span>*</span>:</label><br>
                <input class="border" type="password" id="confirmsenha" name="confirmar" placeholder="Senha100%segura123" required autocomplete="off" onkeyup="senhaa(this)">
                <p style="font-size:20px" id="senhas"> </p>
                <br>

                <input class="border" type="submit" value="Enviar" id="submit">
            </form>
    </div>
</body>
</html>