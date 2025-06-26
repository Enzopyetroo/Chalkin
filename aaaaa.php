<?php
session_start();

if (empty($_SESSION["nome"])){
    header("Location: index.php");
}
?>

<!DOCTYPE php>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The place for talkin'">
    <meta name="keywords" content="Chat, Text, Talk, Chalkin">
    <meta name="author" content="Enzo">

    <title>Chalkin</title>
    <link rel="stylesheet" href="CSSlegal.css">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="Imagens/moço.png">
    <script>
          
        var fotos = [
            "moço.png",
            "moçofeliz.png",
            "moçotriste.png",
            "moçobravo.png",
            "moçodomal.png",
            "moçoeh.png",
            "moçonarizfeliz.png",
            "moçonariztriste.png",
            "moçosilly.png",
            "moçosurpreso.png",
            "oçom.png",
            "pikmin.gif",
        ]
        function mensagem(msg, data, nome, id, corNome, admin, numImg){
            const node = document.getElementById("msgplaceholder")
            const clone = node.cloneNode(true)
            clone.style.display = "flex"
            clone.id = "mensagem"+id

            if (admin == 1){
                clone.childNodes[3].childNodes[3].innerHTML = msg
            }else{
                clone.childNodes[3].childNodes[3].innerText = msg
            }

            if (numImg == null || numImg == undefined){
                numImg = 0
            }

            clone.childNodes[1].src = "Imagens/"+fotos[numImg]
            clone.childNodes[3].childNodes[1].innerHTML = "<strong><u>"+nome+"</u></strong> "+data
            clone.childNodes[3].childNodes[1].style.color = corNome
            document.getElementById("mensagens").appendChild(clone)
            window.scrollTo(0, document.body.scrollHeight);
        }

        function teste(){
            nomepessoa = window.prompt('Escolha um nome')
            if (nomepessoa != ""){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    mostrarMensagens()
                }
                xhttp.open("post", "mudarnome.php?nomepessoa="+nomepessoa, true);
                xhttp.send();
            }
        }

        function corDoNome(){
                cor = document.getElementById("color").value
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    mostrarMensagens()
                }
                xhttp.open("POST", "mudarcordenome.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("cor="+cor);
        }

        function teste2(){
            nomepessoa = window.prompt('Escolha um nome')
        }
        
        function inputToURL(inputElement){
            var file = document.querySelector('input[type=file]')['files'][0];
            let reader = new FileReader();
            console.log("next");

            reader.onload = function () {
                base64String = reader.result.replace("data:", "")
                    .replace(/^.+,/, "");

                imageBase64Stringsep = base64String;

                // alert(imageBase64Stringsep);
                console.log(base64String);
                document.getElementById("pfp").src = 'data:image/png;base64,'+base64String//window.URL.createObjectURL(file)
        }
        reader.readAsDataURL(file);
    }
    </script>
</head>
<body id="body">
    <?php include 'header.php' ?>
    <main id="main">
        <div class="mensagem" id="msgplaceholder">
            <img alt="Pfp" src="Imagens/moço.png" id="pfp"> 
            <div id="usuario">       
                <p id="nomenamensagem">Moço</p>      
                <p id="conteudomensagem">teste teste teste teste teste teste teste teste teste </p>
            </div>
            
        </div>
        <br>
        <div style="width: 100%; position:fixed; z-index: 20">
        <br>
        <br><button onclick="teste()">botão de teste pra definir nome</button> <br><br>
        <label for="Cor">Definir cor do nome</label><br>
        <input id="color" type="color" name="Cor"><button onclick="corDoNome()">enviar</button><br>
        
        <!--<br><br><label>Definir foto</label>
        <br><input type="file" id="myfile" name="myfile" onchange="inputToURL(this)">
        <button onclick="document.getElementById('pfp').src = 'Imagens/moço.png'">Remover foto</button>-->
        </div>
     
        <div id="mensagens"></div>
    </main>

    <footer class="barrafundo" id="footer" onsubmit="return false">
        <div id="msgarea">
            <form id="form" method="post">
            <input type="text" id="escrevermsg" name="escrevermsg" placeholder="Enviar mensagem..." maxlength="2000" minlength="1" autocomplete="off">
            <input type="image" src="Imagens/enviar.png" id="enviarmsg" value="Enviar" onclick="EnviouMsg(this.form)">
        </div>
        </form>
    </footer>

<script>
   
    const month = ["01","02","03","04","05","06","07","08","09","10","11","12"];
    const hours = ["00", "01","02","03","04","05","06","07","08","09","10","11","12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"];
    var nome = '<?php echo $_SESSION["nome"];?>'

    function EnviouMsg(form){

        document.documentElement.style.scrollBehavior = "smooth"
        var inputValue = form.escrevermsg.value;
        for (var i = 0; i < inputValue.length; i++) {
         if (inputValue.charAt(i) != " "){
            podeEnviar = true
         } 
        }
        if (podeEnviar == true){
            var date = new Date()
            var minutes = date.getMinutes()
            if (minutes <= 9){
                minutes = "0"+minutes
            }
            var datanamensagem = date.getDate()+"/"+month[date.getMonth()]+" | "+
            hours[date.getHours()]+":"+minutes
            const xhttp = new XMLHttpRequest();
            var podeEnviar = false
            mensagem(inputValue, datanamensagem, nome)
            document.getElementById("form").reset();
            xhttp.open("post", "enviarmsg.php?msg="+inputValue, true);
            xhttp.send();
            setTimeout(mostrarMensagens, 1000);
        }
    }

    var ultimaData = null;
    function mostrarMensagens(){

        document.documentElement.style.scrollBehavior = "auto"
        console.log("mostrando mensagens")
        var httpc = new XMLHttpRequest();
        httpc.open("POST", "pegar_dados.php", true);

        var data = new Date();

        httpc.onreadystatechange = function() {
            if(httpc.readyState == 4 && httpc.status == 200) {

                var datarray = JSON.parse(httpc.responseText)
                console.log(datarray)
                document.getElementById('mensagens').innerHTML = ""

                for (var i = 0; i < datarray.length; i++){

                    var date = new Date(datarray[i].datamensagem.toString())
                    var minutes = date.getMinutes()
                    if (minutes <= 9){
                        minutes = "0"+minutes
                    }
                    var datanamensagem = date.getDate()+"/"+month[date.getMonth()]+" | "+
                    hours[date.getHours()]+":"+minutes
                    mensagem(datarray[i].conteudo, datanamensagem, datarray[i].nome_exib, datarray[i].id_msg, datarray[i].cor_nome, datarray[i].admin, datarray[i].numImg)
                }

                document.getElementById('logado').innerHTML = "Atualmente logado como: <br>"+'<?php echo $_SESSION["nome"];?>'
                document.getElementById('logado').style.display = "block"
                window.scrollTo(0, document.body.scrollHeight);
            }
            
        };
        httpc.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        if (ultimaData != null){
            httpc.send("data="+ultimaData);
        }else{
            httpc.send();
            console.log("Enviando sem data")
        }
        ultimaData = data.getTime()
    }

    var qtdMensagens = 0
    function ChecarMensagens(){
        var httpc = new XMLHttpRequest();
        var url = "checarMensagens.php";
        httpc.open("POST", url, true);

        httpc.onreadystatechange = function() {
            if(httpc.readyState == 4 && httpc.status == 200) {
                console.log("check")
                if (httpc.responseText > qtdMensagens){
                    mostrarMensagens()
                }
                qtdMensagens = httpc.responseText
            }
        };
        httpc.send();
    }

    ChecarMensagens()

    setInterval(ChecarMensagens, 1000);

    //setInterval(mostrarMensagens, 5000);
</script>
</body>
</html>