<style>
.barratopo{
    background-color: var(--corPrincipal);
    border-bottom: 0.2rem solid var(--corPrincipalBorda);
    width: 100%;
    height: 100px;
    min-height: 35px;
    z-index: 10;
    position: fixed;
    top: 0;
    justify-content: space-around;
}

.barratopo a{
    font-size: 25px
}

#botaoConfig{
    text-align: left;
    margin-left: 10px;
    opacity: 0;
}
#imgConfig{
    flex: 1;
    text-align: left;
    width: 40px;
    height: 40px;
    cursor:initial;
    transition: 0.1s;
}
#imgConfig:hover{
    scale: 1.1;
    filter: brightness(200%);
}

#coisosdelogin{
    margin-top: 15px;
    margin-right: 10px;
    flex: 1;
    text-align: right;
}

#register{
    background-color: lightblue;
    right: 0;
    height: 45%;
    margin-right: 5px;
}
#login{
    background-color: lightgreen;
    right: 0;
    height: 45%;
}
.botoesLogineRegister:hover{
    scale: 1.05;
    filter: brightness(105%);
}
#mocoIcon{
    margin-left: 10px;
}

.Chalkin>a>span{
    color: var(--corTexto)
}

.Chalkin:hover{
    transition:0.2s;
    scale: 1.05
}
.Chalkin:hover #mocoIcon{
   content: url("Imagens/moçofeliz.png");
   scale: 1.1;
}

.offcanvas{
    z-index: 21;
    background-color: var(--corPrincipal);
    color: var(--corTexto)
    box-shadow: black -3px -1px 10px 1px;
}

.modal-backdrop{
    z-index: 20;
}

#logado{
    width: fit-content;
    justify-self: right;
    text-align: center;
}

.flexCoisa{
    flex: 1
}

input[type="color"]{
    transition: 0.2s;
}
input[type="color"]:hover{
    scale: 1.05;
}
.buttonPfpModal{
    width: 50px;
    height: 50px;
    font-size: 35px;
}
.divPfpModal{
    display: flex;
    justify-content: space-evenly;
    align-items: center;
}
.pikmin{
    bottom: 0;
    display: none;
    position: absolute;
}
.btnLogout{
    background-color: #ff4d4d;
    color: white;
    border: 1px solid #ff0000;
}
.buttonHeader{
    padding: 5px;
    border-radius: 5px;
}

@media (max-width: 720px) {
    #register{
        width: 100px;
        font-size: 16px;
    }
    #login{
        width: 80px;
        font-size: 16px;
    }
}

@media (max-width: 590px) {
    #register{
        width: 80px;
        font-size: 12px;
    }
    #login{
        width: 60px;
        font-size: 12px;
    }
    #logado{
        font-size: 12px;
    }
}

@media (max-width: 466px) {
    #register{
        width: 60px;
        font-size: 8px;
    }
    #login{
        width: 40px;
        font-size: 8px;
    }
    #logado{
        font-size: 8px;
    }
}
</style>

<nav class="navbar fixed-top navbar-light barratopo" id="header">

    <div class="flexCoisa" id="botaoConfig">
        <img src="Imagens/settings.svg" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" disabled id="imgConfig">
    </div>

    <div class="pikmin" id="sticker">
        <img onclick="EnviouMsg(null, '<img src=Imagens/pikmin.gif width=`300` height=`300`>' )" src="Imagens/pikmin.gif" width="30" height="30">
    </div>

    <div class="flexCoisa Chalkin">
        <a class="navbar-brand" href="index.php">
            <img src="Imagens/moço.png" width="30" height="30" class="d-inline-block align-top" id="mocoIcon" alt="">
                <span>Chalkin</span>
        </a>
    </div>

    <div id="coisosdelogin" class="flexCoisa">
        <a href="register.php"><button id="register" class="botoesLogineRegister">Criar conta</button></a>
        <a href="login.php"><button id="login" class="botoesLogineRegister">Login</button></a>
        <p id="logado" style="display: none">Atualmente logado como: <br>(SEU NOME)</p>
    </div>
</nav>




<script>

    var adm = '<?php echo $_SESSION["admin"];?>';
    if (adm && adm == 1){
        document.getElementById("sticker").style.display = "block"
    }
    </script>

<!--Sidebar-->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">

  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Configurações</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <hr>

  <div class="offcanvas-body">
        <br>

        <br>
        <button onclick="mudarNome()" class="buttonHeader">
            Mudar nome de exibição
        </button> 
        
        <br><br>

        <label for="Cor">Mudar cor do nome</label><br>
        <input id="color" type="color" name="Cor" style="margin-right: 10px; padding: 5px;">
            <button onclick="corDoNome()" class="buttonHeader">
                enviar
            </button> 
            
        <br><br>

        <button type="button" data-bs-toggle="modal" data-bs-target="#PfpModal" class="buttonHeader">
            Mudar foto de perfil
        </button>

        <br><br>

        <button type="button" data-bs-toggle="modal" data-bs-target="#temaModal" class="buttonHeader">
            Mudar tema
        </button>

        <br><br>

        <button class="btnLogout buttonHeader" onclick="Logoff()">
            Deslogar da conta
        </button>

        <script>
            function Logoff() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        window.location.replace("index.php")
                    }
                };
                xmlhttp.open("GET", "functions.php?action=logoff", true);
                xmlhttp.send();
            }
        </script>
  </div>
</div>

<!--Modal-->

<style>
    .modal-header{
        border-bottom: 1px solid var(--corPrincipalBorda)
    }

    .modal-content{
        background-color: var(--corPrincipal);
        color: var(--corTexto)
    }

    .modal-footer{
        border-top: 1px solid var(--corPrincipalBorda)
    }
     .modal-footer .btn{
        transition: 0.1s;
    }
    .modal-footer .btn-primary{
        background-color: var(--corPrincipalBorda);
        border: 1px solid var(--corPrincipalBorda);
    }
    .modal-footer .btn-primary:hover{
        filter: brightness(110%);
    }
    .modal-footer .btn:active{
        scale: 1.025;
        filter: brightness(100%);
        border: 1px solid #4b004b
    }
    .modal-footer .btn-primary:active{
        background-color: var(--corPrincipalBorda);
    }
</style>

<div class="modal fade" id="PfpModal" tabindex="-1" aria-labelledby="PfpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="PfpModalLabel">Escolha sua foto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
        <div class="divPfpModal">
            <button class="buttonPfpModal" onclick="leftPfp()"><</button>
            <img style="width: 200px;" src="Imagens/moço.png" id="pfpModal" alt="Pfp">
            <button class="buttonPfpModal" onclick="rightPfp()">></button>
        </div>
        <p id="numeroPfps">0 / 0</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
        onclick="salvarPfp()">Salvar</button>
      </div>
    </div>
  </div>
</div>
<script>
    document.getElementById("numeroPfps").innerText = "0 / " + (fotos.length -1);
var fotoAtual = 0
    function leftPfp(){
        if(fotoAtual == 0){
            fotoAtual = fotos.length -1
        }else{
            fotoAtual -= 1
        }
        document.getElementById("pfpModal").src = "Imagens/"+fotos[fotoAtual];
        document.getElementById("numeroPfps").innerText = fotoAtual + " / " + (fotos.length -1) ;
    }
    function rightPfp(){
        if(fotoAtual == fotos.length-1){
            fotoAtual = 0
        }else{
            fotoAtual += 1
        }
        document.getElementById("pfpModal").src = "Imagens/"+fotos[fotoAtual];
        document.getElementById("numeroPfps").innerText = fotoAtual + " / " + (fotos.length -1);
    }

    function salvarPfp(){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            mostrarMensagens()
        }
        xhttp.open("GET", `functions.php?action=mudarFoto&param=${fotoAtual}`, true);
        xhttp.send();
    }
</script>
<div class="modal fade" id="temaModal" tabindex="-1" aria-labelledby="PfpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="PfpModalLabel">Escolha um tema</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <select id="temaSelect" onchange="Selecionado(this)">

        </select>

        <div id="Customizar">
            <hr>

            <label for="cor1">Cor Principal</label>
            <input name="cor1" type="color" id="cor1Input">
            <br>

            <label for="cor2">Cor da Borda</label>
            <input name="cor2" type="color" id="cor2Input">
            <br>

            <label for="cor3">Cor do Fundo</label>
            <input name="cor3" type="color" id="cor3Input">
            <br>

            <label for="cor4">Cor do Texto</label>
            <input name="cor4" type="color" id="cor4Input">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
        onclick="salvarTema()">Salvar</button>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById("Customizar").style.display = "none"

function Selecionado(coisa){
    if (coisa.value == "Customizar"){
        console.log(coisa.value)
        document.getElementById("Customizar").style.display = "block"
    }else{
        document.getElementById("Customizar").style.display = "none"
    }
}

var Temas = [
    {
        Tema: "Normal",
        cor1: "90ee90",
        cor2: "008000",
        cor3: "a9a9a9",
        cor4: "000000"
    },

    {   
        Tema: "Escuro",
        cor1: "2d2868",
        cor2: "0a062b",
        cor3: "1e1e1e",
        cor4: "ffffff"
    },

    {   
        Tema: "EVIL",
        cor1: "640404",
        cor2: "3d0000",
        cor3: "180202",
        cor4: "ed4444",
        bg: "https://i.pinimg.com/originals/b7/21/34/b72134112b54864e4948865375ecbb11.gif"
    },
    {   
        Tema: "Customizar",
    },
]
var html = ""
for (i = 0; i < Temas.length; i++) {
    html += `<option>`
    html+=Temas[i].Tema
    html+="</option>"
}

document.getElementById("temaSelect").innerHTML = html

function salvarTema(){
    var tema = document.getElementById("temaSelect").value
    
    var cor1 = "90ee90"
    var cor2 = "008000"
    var cor3 = "a9a9a9"
    var cor4 = "000000"
    if (tema != "Customizar"){
        for (i = 0; i < Temas.length; i++) {
            if (Temas[i].Tema == tema){
                cor1 = Temas[i].cor1
                cor2 = Temas[i].cor2
                cor3 = Temas[i].cor3
                cor4 = Temas[i].cor4

                if (Temas[i].bg){
                    var bg = Temas[i].bg
                    document.getElementById("slidingBgGif").style.backgroundImage = "url("+Temas[i].bg+")"
                }else{
                    document.getElementById("slidingBgGif").style.backgroundImage = ""
                }
            }
        }
    }else{
        var cor1 = (document.getElementById("cor1Input").value).slice(1)
        var cor2 = (document.getElementById("cor2Input").value).slice(1)
        var cor3 = (document.getElementById("cor3Input").value).slice(1)
        var cor4 = (document.getElementById("cor4Input").value).slice(1)
    }

    document.documentElement.style.setProperty("--corPrincipal", `#${cor1}`);
    document.documentElement.style.setProperty("--corPrincipalBorda", `#${cor2}`);
    document.documentElement.style.setProperty("--corFundo", `#${cor3}`);
    document.documentElement.style.setProperty("--corTexto", `#${cor4}`);

    document.getElementById("cor1Input").value = "#"+cor1
    document.getElementById("cor2Input").value = "#"+cor2
    document.getElementById("cor3Input").value = "#"+cor3
    document.getElementById("cor4Input").value = "#"+cor4

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        mostrarMensagens()
    }

    if (tema != "Customizar"){
        xhttp.open("GET", `mudarTema.php?cor1=${cor1}&cor2=${cor2}&cor3=${cor3}&cor4=${cor4}&bg=${bg}`, true);
    }else{
        xhttp.open("GET", `mudarTema.php?cor1=${cor1}&cor2=${cor2}&cor3=${cor3}&cor4=${cor4}`, true);
    }
    
    xhttp.send();

}

var path = window.location.pathname;
var page = path.split("/").pop();
if (page == "aaaaa.php"){
    document.getElementById("botaoConfig").style.opacity = "1";
    document.getElementById("imgConfig").disabled = false;
    document.getElementById("imgConfig").style.cursor = "pointer";
}

</script>
