<style>
.barratopo{
    background-color: #90ee90;
    border-bottom: 0.2rem solid #008000;
    width: 100%;
    height: 100px;
    min-height: 35px;
    z-index: 10;
    position: fixed;
    top: 0;
}
#coisosdelogin{
    position: fixed;
    right: 0;
    margin-top: 15px;
    margin-right: 10px;
}

#register{
    background-color: lightblue;
    right: 0;
    height: 30%;
    margin-right: 5px;
}
#login{
    background-color: lightgreen;
    right: 0;
    height: 30%;
}
.botoes:hover{
    scale: 1.05;
    filter: brightness(105%);
}
#mocoIcon{
    margin-left: 10px;
}

.navbar-brand:hover{
    transition:0.2s;
    scale: 1.05
}
.navbar-brand:hover #mocoIcon{
   content: url("Imagens/moçonarizfeliz.png");
}

</style>

<nav class="navbar fixed-top navbar-light barratopo id="header">
  <a class="navbar-brand" href="aaaaa.php">
    <img src="Imagens/moço.png" width="30" height="30" class="d-inline-block align-top" id="mocoIcon" alt="">
    Chalkin
  </a>
  <div id="coisosdelogin">
            <a href="register.php"><button id="register" class="botoes">Criar conta</button></a>
            <a href="login.php"><button id="login" class="botoes">Login</button></a>
            <p id="logado" style="display: none;">Atualmente logado como: <br>(SEU NOME)</p>
        </div>
</nav>