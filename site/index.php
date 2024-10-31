<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca de Barbearia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body, html {
            height: 100%;
            font-family: Arial, sans-serif;
        }
        /* Fundo */
        body {
            background-image: url('assets/img/fotofundo.jpg'); /* Caminho local da imagem de fundo */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }
        /* Container principal */
        .container {
            text-align: center;
            background: rgba(0, 0, 0, 0.7); /* Mais opaco para melhorar a legibilidade */
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 600px;
        }
        /* Logo */
        .logo img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px; /* Espaçamento inferior da logo */
        }
        /* Barra de pesquisa */
        .search-bar {
            margin-top: 20px;
        }
        .search-bar input[type="text"] {
            width: 75%; /* Diminuído um pouco para melhorar o layout */
            margin: 15px;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            outline: none;
            margin-right: 5px; /* Espaçamento entre o input e o botão */
        }
        .search-bar button {
            padding: 12px 20px;
            font-size: 16px;
            background-color: #444;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s; /* Efeito de transição */
        }
        .search-bar button:hover {
            background-color: #666; /* Cor de fundo mais clara ao passar o mouse */
            margin: 10px;
        }
    </style>
    <script>
function substituirLogo(event) {
    event.preventDefault(); // Previne o envio padrão do formulário

    // Captura o nome da barbearia do input e converte para minúsculas para evitar problemas com maiúsculas/minúsculas
    var nomeBarbearia = document.querySelector('input[name="search"]').value.toLowerCase();

    // Variáveis para armazenar o caminho da nova logo e o link do site
    var novoLogo = '';
    var linkSite = '';

    // Define o caminho da logo e o link do site com base no nome da barbearia
    if (nomeBarbearia === 'baiano') {
        novoLogo = 'assets/img/baianoducorte.png';
        linkSite = 'https://dmbarber.dmprojetos.com/site/baianoducorte/baianoducorte.php';
    } else if (nomeBarbearia === 'telles') {
        novoLogo = 'assets/img/telles.png';
        linkSite = 'https://dmbarber.dmprojetos.com/site/telles/telles.php';
    } else if (nomeBarbearia === 'teste') {
        novoLogo = 'assets/img/teste.png';
        linkSite = 'https://dmbarber.dmprojetos.com/site/teste/teste.php';
    } else {
        // Se o nome da barbearia não corresponder, exibe uma mensagem de erro
        alert("Barbearia não encontrada.");
        return; // Sai da função para não fazer alterações
    }

    // Troca a logo existente pela nova logo e define o link correto, adicionando o texto "Clique na imagem"
    var logoContainer = document.querySelector('.logo');
    logoContainer.innerHTML = `
        <a href="${linkSite}">
            <img src="${novoLogo}" alt="Logo da ${nomeBarbearia}">
        </a>
        <p>Clique na imagem</p>
    `;
}

</script>

</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="assets/img/logo.png" alt="Logo da Barbearia"> <!-- Caminho local da logo -->
        </div>
        <!-- Barra de Pesquisa -->
        <form class="search-bar" onsubmit="substituirLogo(event)">
            <input type="text" placeholder="Pesquise por uma barbearia..." name="search" required>
            <button type="submit">Buscar</button>
        </form>
    </div>
</body>
</html>
