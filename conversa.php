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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The place for talkin'">
    <meta name="keywords" content="Chat, Text, Talk, Chalkin">
    <meta name="author" content="Enzo">
    <meta property="og:image" content="https://chalkin.ct.ws/Imagens/chalkinbanner.png">
    <meta property="og:url" content="https://chalkin.ct.ws">

    <title>Chalkin</title>

    <link rel="stylesheet" href="css/CSSlegal.css">
    <script src="outros/jsManeiro.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="Imagens/moço.png">
    
    <link rel="preload" href="Imagens/settings2.gif" as="image">
    <link rel="preload" href="Imagens/enviar2.gif" as="image">
    
    <script>
        var nome, corDoNome, numeroImg
        
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
            "moçozoiudo.png",
            "moçosofrido.png",
            "moçotintas.png",
            "moçosus.png",
            "moçowo.png",
            "moçoading.png",
            "moço2d.png",
            "moçobobão.png",
            "cadeele.png",
            "moçodave.png",
            "moçoretro.png",
            "moçotuff.png"
            ]
            
            for (var i = 0; i < fotos.length; i++) {
                var preloadPfp=new Image();
                preloadPfp.src="Imagens/"+fotos[i];
            }
            
            var qtdMensagens = 0
            var podeScrollar, carregado = false
        function mensagem(msg, data, nome, id, corNome, admin, numImg, userId, MostrandoMaisMensagens){
            
            if ( document.getElementById("mensagem"+id) && id != 0 ){
                return
            }
            if (MostrandoMaisMensagens == undefined){
                MostrandoMaisMensagens = false
            }
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
            if (!MostrandoMaisMensagens){
                document.getElementById("mensagens").appendChild(clone)
                window.scrollTo(0, document.body.scrollHeight);
            }else{
                document.getElementById("mensagens").prepend(clone)
            }
            
        }

        function mudarNome(){
            nomepessoa = window.prompt('Escolha um nome')
            if (nomepessoa != "" && nomepessoa != null){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    document.getElementById('mensagens').innerHTML = ""
                    earliestID = "undefined"
                    primeiraChecagem = true
                    mostrarMensagens(undefined, true, -1)
                }
                xhttp.open("GET", `php/functions.php?action=mudarNome&param=${nomepessoa}`, true);
                xhttp.send();
            }

        }

        function mudarCorDoNome(){
            cor = (document.getElementById("color").value).slice(1)
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function(){
                document.getElementById('mensagens').innerHTML = ""
                earliestID = "undefined"
                primeiraChecagem = true
                mostrarMensagens(undefined, true, -1)
            }

            xmlhttp.open("GET", `php/functions.php?action=mudarCorNome&param=${cor}`, true);
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

<!--Perfil-->
    <div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="PerfilModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="PerfilModalLabel">Ta carregando eu acho</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="bodyPerfil">
            <p id="descPerfil">
                <div id="loadingPerfil">
                    <div>
                        <img alt="Carregando" src="Imagens/loading.svg"> 
                    </div>
                </div>
            </p>
            <button data-bs-dismiss="modal" id="editarDesc" style="display:none" onclick='mudarDesc()'>Editar</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<style>
    .semDesc{
        color: gray
    }
    #perfilPfp{
        transition: 0.2s;
        border-radius: 50%;
        border: 1px solid black
    }
    #perfilPfp:hover{
        scale: 2;
        border: 1px solid white;
    }
    #voce{
        color: black;
        background-color: rgba(255, 255, 255, 0.5);
        padding: 3px;
        border-radius: 10px;
        border: 1px solid black
    }
    #editarDesc{
        margin-top: 30px
    }
    #bodyPerfil{
        overflow: auto
    }
</style>

<script>
    document.getElementById("botaoConfig").style.opacity = "1";
    document.getElementById("imgConfig").disabled = false;
    document.getElementById("imgConfig").style.cursor = "pointer";

    var useridPerfil, userpfpPerfil

    function VerPerfil(ts){
        document.getElementById("descPerfil").innerHTML = ""
        document.getElementById("loadingPerfil").style.display = "flex"
        document.getElementById("PerfilModalLabel").innerHTML = "<img src='Imagens/moço.png' id='perfilPfp' width='50'>"

        var httpc = new XMLHttpRequest();
        httpc.open("POST", "php/pegar_dados_usuarios.php", true);

        httpc.onreadystatechange = function() {
            if(httpc.readyState == 4 && httpc.status == 200) {

                var datarray = JSON.parse(httpc.responseText)

                for (var i = 0; i < datarray.length; i++){
                    if (datarray[i].id == ts.dataset.userid){
                        document.getElementById("loadingPerfil").style.display = "none"
                        document.getElementById("editarDesc").style.display = "none"
                        
                        //const Modal = new bootstrap.Modal(document.getElementById('perfilModal'));
                        //Modal.show();

                        useridPerfil = ts.dataset.userid
                        userpfpPerfil = ts.src

                        document.getElementById("PerfilModalLabel").innerText = datarray[i].nome_exib+" ("+datarray[i].nome.toLowerCase()+")"
                        document.getElementById("PerfilModalLabel").innerHTML = `<img src=${userpfpPerfil} id='perfilPfp' width='50'>  ` + document.getElementById("PerfilModalLabel").innerText

                        if (ts.dataset.userid == '<?php echo $_SESSION["id"];?>'){
                            document.getElementById("PerfilModalLabel").innerHTML += " <span id='voce'>(você)</span>"
                            document.getElementById("editarDesc").style.display = "inline"
                        }
                        
                        var descri
                        if (datarray[i].descri == ""){
                            descri = "<p class='semDesc'>(sem descrição)</p>"
                        }else{
                            descri = datarray[i].descri
                        }
                        
                        if (datarray[i].admin == 1){
                            document.getElementById("descPerfil").innerHTML = descri
                        }else{
                            document.getElementById("descPerfil").innerHTML = ""
                            if (descri != "<p class='semDesc'>(sem descrição)</p>"){

                                document.getElementById("descPerfil").innerText += descri
                                
                            }else{
                                document.getElementById("descPerfil").innerHTML = descri
                            }
                        }      
                        
                        return
                    }
                }

            }
        };
        httpc.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpc.send();
    }

    function mudarDesc(){
        if (useridPerfil != <?php echo $_SESSION["id"];?>){
            return
        }
        var descricao = window.prompt('Escreva sua nova descrição (deixe vazio para remover)')
            if (descricao != null){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    var ts = {dataset: {userid: useridPerfil}, src: userpfpPerfil};
                    VerPerfil(ts)
                }
                xhttp.open("GET", `php/functions.php?action=mudarDesc&param=${descricao}`, true);
                xhttp.send();
            }
    }
</script>
<!--Fim Perfil-->

        <div class="mensagem" id="msgplaceholder">
            <img alt="Pfp" src="Imagens/moço.png" id="pfp" onclick="VerPerfil(this)" data-userid="0" data-bs-toggle="modal" data-bs-target="#PerfilModal"> 
            <div id="usuario">       
                <p id="nomenamensagem">Moço</p>      
                <p id="conteudomensagem">teste teste teste teste teste teste teste teste teste </p>
            </div>
        </div>
        
        <div id="mensagens">
            <!--Todas as mensagens do site aparecem aqui! :D-->
        </div>

    </main>

    <footer class="barrafundo" id="footer" onsubmit="return false">
        <div id="msgarea">
            <form id="formFooter" method="post">
                <div class="footerFlex">
                    <img id="sticker" src="Imagens/pikmin.gif" onclick="EnviouMsg('<img src=Imagens/pikmin.gif width=`300` height=`300`>' )"  width="30" height="30">
                    <input type="text" id="escrevermsg" name="escrevermsg" placeholder="Enviar mensagem..." maxlength="2000" minlength="1" autocomplete="off">
                    <img src="Imagens/enviar1.png" id="enviarmsg" value="Enviar" onclick="EnviouMsg()">

                    <input type="submit" style="display: none" onclick="EnviouMsg()"> <!--isso só existe pro enter funcionar-->
                </div>
            </form>
        </div>
    </footer>

<div id="loading">
    <div>
        <img alt="Carregando" src="Imagens/loading.svg"> 
    </div>
</div>

<script>
    var adm = '<?php echo $_SESSION["admin"];?>';
    if (adm && adm == 1){
        document.getElementById("sticker").style.display = "block"
    }

   function fixhr(val){
    
        if (val <= 9){
            return "0"+val
        }else{
            return val
        }
    }
    function fixmt(val){
        if (val+1 >= 10){
            return val+1
        }else{
            return "0"+(val+1)
        }
    }

    function EnviouMsg(figurinhaConteudo){

        document.documentElement.style.scrollBehavior = "smooth"

            var inputValue, admin
            if (figurinhaConteudo){
                inputValue = figurinhaConteudo
                admin = 1
            }else{
                inputValue = document.getElementById("escrevermsg").value
                admin = 0
            }

            for (var i = 0; i < inputValue.length; i++) {
            if (inputValue.charAt(i) != " "){
                podeEnviar = true
            }
            
            }
            if (podeEnviar == true){
                
                var podeEnviar = false
                var date = new Date()
                var minutes = date.getMinutes()
                var unix = Math.floor(date.getTime() / 1000)
                var datanamensagem = fixhr(date.getDate())+"/"+fixmt(date.getMonth())+" | "+
                fixhr(date.getHours())+":"+fixhr(minutes)

                mensagem(inputValue, datanamensagem, nomexib, 0, corDoNome, admin, numeroImg, <?php echo $_SESSION["id"];?>)
                document.getElementById("formFooter").reset(); 

                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                    //setTimeout(mostrarMensagens, 1000);
                }
                xhttp.open("GET", `php/functions.php?action=enviarMsg&param=${inputValue}&param2=${unix}`, true);
                xhttp.send();
            }
    }

    var ScrollarProFundo = true
    var IdPrimeiraMensagem = 0
    window.addEventListener('scroll', () => {

        if (window.scrollY <= 0){
            if (carregado){
                podeScrollar = false
                ScrollarProFundo = false
                var mensagens = document.getElementById('mensagens'),
                IdPrimeiraMensagem = document.getElementById('mensagens').getElementsByTagName('div')[0].id
                mostrarMensagens(ScrollarProFundo, IdPrimeiraMensagem)
            }
        } 
    });

    var primeiraChecagem = true
    var earliestID = "undefined"
    var executarChecagemTema = true;
    function mostrarMensagens(scroll, idprim){

        if (scroll == undefined){
            scroll = true
        }

        document.documentElement.style.scrollBehavior = "auto"

        var httpc = new XMLHttpRequest();
        httpc.open("POST", "php/pegar_dados.php", true);

        var data = new Date();

        httpc.onreadystatechange = function() {
            if(httpc.readyState == 4 && httpc.status == 200) {

                var datarray = JSON.parse(httpc.responseText)
                //document.getElementById('mensagens').innerHTML = "<p>carregando mais mensagens...</p>"
                
                if (!primeiraChecagem){
                    datarray.reverse();
                }

                for (var i = 0; i < datarray.length; i++){
                    var date
                    
                    var check = Number(datarray[i].datamensagem)
                    if (!isNaN(check)){
                        var dateUnix = datarray[i].datamensagem * 1000
                        date = new Date(dateUnix)
                    }else{
                        date = new Date(datarray[i].datamensagem.toString())    
                    }
                        
                    minutes = date.getMinutes()
                    var datanamensagem = fixhr(date.getDate())+"/"+fixmt(date.getMonth())+" | "+
                    fixhr(date.getHours())+":"+fixhr(minutes)
                    mensagem(datarray[i].conteudo, datanamensagem, datarray[i].nome_exib, datarray[i].id_msg, datarray[i].cor_nome, datarray[i].admin, datarray[i].numImg, datarray[i].idusuario, !primeiraChecagem)
                }
                
                httpc.abort()
                primeiraChecagem = false

                earliestID = Number((document.getElementById('mensagens').querySelector(':nth-child(1)').id).replace("mensagem", ""))

                setTimeout(nomExib)
            }
            
        };
        httpc.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpc.send("earliestID="+earliestID);


        if (!scroll){

            scroll = true
            setTimeout(function(){ scrl(idprim); });
        }
    }

    function mostrarNovaMensagem(){
        document.documentElement.style.scrollBehavior = "auto"

        var httpc = new XMLHttpRequest();
        httpc.open("POST", "php/pegar_dados.php", true);

        var data = new Date();

        httpc.onreadystatechange = function() {
            if(httpc.readyState == 4 && httpc.status == 200) {

                    var datarray = JSON.parse(httpc.responseText)
                    var newestMsg = datarray[datarray.length-1]

                    if (newestMsg.idusuario != <?php echo $_SESSION["id"];?>){
                        var check = Number(datarray[i].datamensagem)
                        if (!isNaN(check)){
                            var dateUnix = datarray[i].datamensagem * 1000
                            date = new Date(dateUnix)
                        }else{
                            date = new Date(datarray[i].datamensagem.toString())    
                        }
                        
                        minutes = date.getMinutes()
                        var datanamensagem = fixhr(date.getDate())+"/"+fixmt(date.getMonth())+" | "+
                        fixhr(date.getHours())+":"+fixhr(minutes)
                        
                        mensagem(newestMsg.conteudo, datanamensagem, newestMsg.nome_exib, newestMsg.id_msg, newestMsg.cor_nome, newestMsg.admin, newestMsg.numImg, newestMsg.idusuario, false)
                    }

            }
            
        };
        httpc.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpc.send("earliestID=-1");
    }

    function nomExib(){
        var httpc2 = new XMLHttpRequest();
        httpc2.open("POST", "php/pegar_dados_usuarios.php", true);
                
        httpc2.onreadystatechange = function() {
            if(httpc2.readyState == 4 && httpc2.status == 200) {

                var datarrayusuario = JSON.parse(httpc2.responseText)
                for (var i = 0; i < datarrayusuario.length; i++){
                    
                    if (datarrayusuario[i].id == <?php echo $_SESSION["id"];?>){

                        nome = datarrayusuario[i].nome
                        nomexib = datarrayusuario[i].nome_exib
                        corDoNome = datarrayusuario[i].cor_nome
                        numeroImg = datarrayusuario[i].numImg

                        if (executarChecagemTema == true){
                            temaCustom(datarrayusuario[i])
                        }
                    }
                }
                document.getElementById('logado').innerHTML = `Atualmente logado como: <br>${nomexib} (${nome.toLowerCase()})`
                document.getElementById('logado').style.display = "block"
                document.getElementById('loading').style.display = "none"
                carregado = true
            }
        }
        httpc2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpc2.send();
    }

    function scrl(id){ 
        document.getElementById(id).scrollIntoView({ behavior: "instant"});
        scroll(0, window.scrollY-100)
        podeScrollar = true
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

        if (data.cor4 == "ffffff"){
            document.getElementById("imgConfig").style.filter = 'none'
        }else{
            document.getElementById("imgConfig").style.filter = 'invert(100%)'
        }
        
    }

    function ChecarMensagens(){
        var httpch = new XMLHttpRequest();
        var url = "php/checarMensagens.php";
        httpch.open("POST", url, true);

        httpch.onreadystatechange = function() {
            if(httpch.readyState == 4 && httpch.status == 200) {
                if (httpch.responseText != qtdMensagens){
                    //earliestID = "undefined"

                    if (qtdMensagens != 0){
                        if(httpch.responseText > qtdMensagens){
                            mostrarNovaMensagem()
                        }else if(httpch.responseText < qtdMensagens){
                            window.location.reload();
                        }
                    }else{
                        primeiraChecagem = true
                        mostrarMensagens(undefined, true)
                    }
                    
                    
                }
                qtdMensagens = httpch.responseText
            }
        };
        httpch.send();
    }

    ChecarMensagens()

    setInterval(ChecarMensagens, 1000);
</script>
</body>
</html>
