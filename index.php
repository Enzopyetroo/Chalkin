<?php
session_start();

if (empty($_SESSION["nome"])==false){
    header("Location: aaaaa.php");
}
//error_reporting(E_ALL);
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
    <meta property="og:title" content="Chalkin">
    <meta property="og:description" content="Um site aleatório feito por Enzo">
    <meta property="og:image" content="https://chalkin.ct.ws/Imagens/chalkinbanner.png">
    <meta property="og:url" content="https://chalkin.ct.ws">
<body>
<?php include "header.php"?>

    <main style="margin-top:100px">

        <div class="d-flex flex-column align-items-center">

            <div>
                <img src="Imagens/chalkinbanner.png" onmousedown="return false" class="bannerSite">
                <p class="textoBemVindo">Bem vindo ao Chalkin!</p>
                <p class="textoIntrodutorio">Chalkin é um site de bate-papo em tempo real em que qualquer um pode entrar pra conversar!
                <br>Para começar, crie uma conta ou faça login usando os botões no canto superior direito</b>
                </p>
            </div>

            <hr>

            <div class="divQuotes">
                <p class="quotePgInicial"><i>"Durante muito tempo me senti perdido, vivendo no automático e com um vazio constante, até que conheci o Chalkin. Chalkin não me pediu que eu mudasse quem sou, mas me ajudou a me encontrar. Hoje me sinto em paz, mais consciente e verdadeiramente grato — como se, finalmente, eu estivesse vivendo de verdade."</i> — Cael Ymará</p>

                <br><br>
                
                <p class="quotePgInicial"><i>"teve um dia que eu tava na minha escola, aí era pra fazer trabalho em dupla, mas todo mundo já tinha uma, então eu não sabia o que fazer, sabe? mas então apareceu uma aluna nova, ela era meio roxa, e enquanto ela ficava na porta, a professora disse que não tinha giz pra começar a aula, então ela falou pra eu e essa menina nova aí ver se tinha giz no estoque de coisas da escola..... só que aí que eu vi. a garota nova tava comendo giz........ e eu fui até ela e falei "EI, SE VOCÊ GOSTA TANTO DE GIZ ASSIM, POR QUE NÃO ENTRA NO SITE DO MEU AMIGO??" ela ficou confusa, mas eu expliquei: "giz em inglês é chalk, e o nome do site do meu amigo é chalkin, um trocadilho com talking e chalk" aí ela falou "ok gostei sou susie e converso em chalkin" e fim."</i> — Kris</p>

                <br><br>
                
                <p class="quotePgInicial"><i>"Antes, o giz era só um objeto — um pedaço branco que risca o quadro e some. Mas quando conheci a Chalkin, tudo mudou.
                Aprendi que cada traço é uma intenção, cada palavra escrita é uma conexão com algo maior.
                Chalkin me mostrou que até o mais simples pode ser sagrado.
                Hoje, com um giz na mão, reencontrei sentido, presença e paz."</i> — Susie</p>
            </div>

        </div>
    </main>

</body>
</html>