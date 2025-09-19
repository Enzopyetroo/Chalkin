<?php
session_start();

if (empty($_SESSION["id"])){
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
    <meta property="og:image" content="https://chalkin.ct.ws/Imagens/chalkinbanner.png">
    <meta property="og:url" content="https://chalkin.ct.ws">

    <title>Chalkin</title>

    <link rel="stylesheet" href="css/CSSlegal.css">
    <script src="jsManeiro.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="Imagens/moço.png">
    
    <script>
        var nome, corDoNome, numeroImg
        var numMensagens = 50

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
            "moco_way.png",
        ]

        function mensagem(msg, data, nome, id, corNome, admin, numImg, userId){
            const node = document.getElementById("msgplaceholder")
            const clone = node.cloneNode(true)
            clone.style.display = "flex"
            clone.id = "mensagem"+id
            clone.childNodes[1].setAttribute("data-userid", userId); 
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

        function mudarNome(){
            nomepessoa = window.prompt('Escolha um nome')
            if (nomepessoa != "" && nomepessoa != null){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    mostrarMensagens()
                }
                xhttp.open("GET", `functions.php?action=mudarNome&param=${nomepessoa}`, true);
                xhttp.send();
            }

        }

        function corDoNome(){
            cor = (document.getElementById("color").value).slice(1)
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function(){
                mostrarMensagens()
            }

            xmlhttp.open("GET", `functions.php?action=mudarCorNome&param=${cor}`, true);
            xmlhttp.send();
        }

    </script>
</head>
<body id="body">
    <?php include 'header.php' ?>
    <main id="main">
    <style>
        #containerGif {
            overflow: hidden;
            position: fixed;
            z-index: -1;
            width: 100%;
            height: 100%;
            margin: 0;
            opacity: 0.5;
        }

        #slidingBgGif {
            background: "";
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
    <div id="containerGif">
        <div id="slidingBgGif"></div>
    </div>



    <div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="PerfilModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="PerfilModalLabel">Ta carregando eu acho</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bodyPerfil">
            Tenta esperar
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<script>
    function VerPerfil(ts){
        var httpc = new XMLHttpRequest();
        httpc.open("POST", "pegar_dados_usuarios.php", true);

        httpc.onreadystatechange = function() {
            if(httpc.readyState == 4 && httpc.status == 200) {

                var datarray = JSON.parse(httpc.responseText)

                for (var i = 0; i < datarray.length; i++){
                    if (datarray[i].id == ts.dataset.userid){
                        document.getElementById("PerfilModalLabel").innerText = datarray[i].nome_exib+" ("+datarray[i].nome.toLowerCase()+")"
                        document.getElementById("PerfilModalLabel").innerHTML = `<img src=${ts.src} width='30'>  ` + document.getElementById("PerfilModalLabel").innerText
                        
                        if (datarray[i].admin == 1){
                            document.getElementById("bodyPerfil").innerHTML = datarray[i].descri
                        }else{
                            document.getElementById("bodyPerfil").innerText = datarray[i].descri
                        }
                        
                        return
                    }
                }

            }
        };
        httpc.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpc.send();
    }
</script>

        <div class="mensagem" id="msgplaceholder">
            <img alt="Pfp" src="Imagens/moço.png" id="pfp"  data-bs-toggle="modal" data-bs-target="#perfilModal" onclick="VerPerfil(this)" data-userid="0"> 
            <div id="usuario">       
                <p id="nomenamensagem">Moço</p>      
                <p id="conteudomensagem">teste teste teste teste teste teste teste teste teste </p>
            </div>
            
        </div>
        <br>

        </div>
        
        <div id="mensagens">
            <!--Todas as mensagens do site aparecem aqui!-->
        </div>

    </main>

    <footer class="barrafundo" id="footer" onsubmit="return false">
        <div id="msgarea">
            <form id="form" method="post">
                <div class="footerFlex">
                    <input type="text" id="escrevermsg" name="escrevermsg" placeholder="Enviar mensagem..." maxlength="2000" minlength="1" autocomplete="off">
                    <input type="image" src="Imagens/enviar.png" id="enviarmsg" value="Enviar" onclick="EnviouMsg(this.form)">
                <div>
            </form>
        </div>
    </footer>

<div id="loading">
    <div>
        <img alt="Carregando" src="Imagens/loading.svg"> 
    </div>
</div>

<script>
   function fixhr(val){
    
        if (val <= 9){
            return "0"+val
        }else{
            return val
        }
    }
    function fixmt(val){
        if (val+1 <= 9){
            return "0"+(val+1)
        }else{
            return val
        }
    }

    function EnviouMsg(form, figurinhaConteudo){
        document.documentElement.style.scrollBehavior = "smooth"
        if (!figurinhaConteudo){
            
            var inputValue = form.escrevermsg.value;
            for (var i = 0; i < inputValue.length; i++) {
            if (inputValue.charAt(i) != " "){
                podeEnviar = true
            } 
            }
            if (podeEnviar == true){
                var date = new Date()
                var minutes = date.getMinutes()

                var datanamensagem = fixhr(date.getDate())+"/"+fixmt(date.getMonth())+" | "+
                fixhr(date.getHours())+":"+fixhr(minutes)
                var podeEnviar = false
                mensagem(inputValue, datanamensagem, nome, 0, corDoNome, 0, numeroImg)
                document.getElementById("form").reset(); 

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    setTimeout(mostrarMensagens, 1000);
                }
                xhttp.open("GET", `functions.php?action=enviarMsg&param=${inputValue}`, true);
                xhttp.send();
            }
        }else{
                var date = new Date()
                var minutes = date.getMinutes()

                var datanamensagem = fixhr(date.getDate())+"/"+fixmt(date.getMonth())+" | "+
                fixhr(date.getHours())+":"+fixhr(minutes)

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    mostrarMensagens()
                }
                xhttp.open("GET", `functions.php?action=enviarMsg&param=${figurinhaConteudo}`, true);
                xhttp.send();
        }
    }
    var ScrollarProFundo = true
    var IdPrimeiraMensagem = 0
    window.addEventListener('scroll', () => {

        const currentScrollY = window.scrollY;
        if (currentScrollY <= 0){

            numMensagens += 50
            ScrollarProFundo = false
            var mensagens = document.getElementById('mensagens'),
            IdPrimeiraMensagem = document.getElementById('mensagens').getElementsByTagName('div')[0].id
            mostrarMensagens(ScrollarProFundo, IdPrimeiraMensagem)
        } 
    });

    var executarChecagemTema = true;
    function mostrarMensagens(scroll, idprim){
        if (scroll == undefined){
            scroll = true
        }

        document.documentElement.style.scrollBehavior = "auto"
        console.log("mostrando mensagens")
        var httpc = new XMLHttpRequest();
        httpc.open("POST", "pegar_dados.php", true);

        var data = new Date();

        httpc.onreadystatechange = function() {
            if(httpc.readyState == 4 && httpc.status == 200) {

                var datarray = JSON.parse(httpc.responseText)
                //console.log(datarray)
                document.getElementById('mensagens').innerHTML = "<p>carregando mais mensagens...</p>"

                for (var i = 0; i < datarray.length; i++){

                    var date = new Date(datarray[i].datamensagem.toString())
                    var minutes = date.getMinutes()

                    var datanamensagem = fixhr(date.getDate())+"/"+fixmt(date.getMonth())+" | "+
                    fixhr(date.getHours())+":"+fixhr(minutes)
                    mensagem(datarray[i].conteudo, datanamensagem, datarray[i].nome_exib, datarray[i].id_msg, datarray[i].cor_nome, datarray[i].admin, datarray[i].numImg, datarray[i].idusuario)

                    if (datarray[i].idusuario == <?php echo $_SESSION["id"];?>){

                        nome = datarray[i].nome
                        corDoNome = datarray[i].cor_nome
                        numeroImg = datarray[i].numImg

                        if (executarChecagemTema == true){
                            temaCustom(datarray[i])
                        }
                    }
                }

                document.getElementById('logado').innerHTML = `Atualmente logado como: <br>${nome}`
                document.getElementById('logado').style.display = "block"
                document.getElementById('loading').style.display = "none"
            }
            
        };
        httpc.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpc.send("numMensagens="+numMensagens);
        
        if (scroll == true){
            window.scrollTo(0, document.body.scrollHeight);
        }else{
            scroll = true
            setTimeout(function(){ scrl(idprim); }, 200);
        }
    }
    function scrl(id){  
        console.log(document.getElementById(id))
        document.getElementById(id).scrollIntoView({ behavior: "instant"});
        scroll(0, window.scrollY-100)
    }
    function temaCustom(data){
        executarChecagemTema = false
        
        document.documentElement.style.setProperty("--corPrincipal", `#${data.cor1}`);
        document.documentElement.style.setProperty("--corPrincipalBorda", `#${data.cor2}`);
        document.documentElement.style.setProperty("--corFundo", `#${data.cor3}`);
        document.documentElement.style.setProperty("--corTexto", `#${data.cor4}`);
        document.getElementById("slidingBgGif").style.backgroundImage = "url("+data.gifbg+")"

        document.getElementById("cor1Input").value = "#"+data.cor1
        document.getElementById("cor2Input").value = "#"+data.cor2
        document.getElementById("cor3Input").value = "#"+data.cor3
        document.getElementById("cor4Input").value = "#"+data.cor4
    }

    var qtdMensagens = 0
    function ChecarMensagens(){
        var httpc = new XMLHttpRequest();
        var url = "checarMensagens.php";
        httpc.open("POST", url, true);

        httpc.onreadystatechange = function() {
            if(httpc.readyState == 4 && httpc.status == 200) {
                console.log("check")
                if (httpc.responseText != qtdMensagens){
                    mostrarMensagens()
                }
                qtdMensagens = httpc.responseText
            }
        };
        httpc.send();
    }

    ChecarMensagens()

    setInterval(ChecarMensagens, 1000);
</script>
</body>
</html>
