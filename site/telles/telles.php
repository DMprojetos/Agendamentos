<?php
// Iniciar a sessão, caso ainda não esteja iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o usuário está logado
if (!isset($_SESSION['nome'])) {
    // Redirecionar para a página de login
    header("Location: https://dmbarber.dmprojetos.com");
    exit();
}

// Exibir a mensagem de boas-vindas se estiver logado
echo "Bem-vindo, " . $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

       /* Estilos gerais */
       body {
    font-family: 'Arial', sans-serif;
    background-color: #f2f2f2;
    background-image: url('assets/fotofundo.png'); /* Substitua pelo caminho da sua imagem */
    background-size: cover; /* Faz a imagem cobrir toda a área do fundo */
    background-repeat: no-repeat; /* Evita que a imagem se repita */
    background-position: center; /* Centraliza a imagem no fundo */
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 20px;
           
       }


       /* Container principal */
       .container {
    max-width: 700px;
    width: 100%;
    margin: 20px auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.7); /* Fundo semi-transparente */
    backdrop-filter: blur(10px); /* Desfoque de 10px */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    
       }


        /* Logo */
        .logo img {
            width: 100%;
            max-width: 300px;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Imagens de valores e adicionais */
        .imagem-valores img,
        .imagem-adicional img {
            width: 100%;
            max-width: 500px;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        .imagem-valores img:hover,
        .imagem-adicional img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Formulário de Agendamento */
        .form-section {
            background: linear-gradient(145deg, #b4c0e4, #ffffff);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }
        .form-section h2 {
            margin-bottom: 15px;
            color: #4a4a9c;
        }
        .form-section label {
            display: block;
            font-weight: bold;
            color: #333;
            margin: 10px 0 5px;
        }
        .form-section select,
        .form-section input[type="date"],
        .form-section input[type="time"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        .form-section select:focus,
        .form-section input[type="date"]:focus,
        .form-section input[type="time"]:focus {
            border-color: #4a4a9c;
            outline: none;
        }

        .form-section button {
            width: 100%;
            padding: 12px;
            background-color: #4a4a9c;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-section button:hover {
            background-color: #3a3a7c;
        }

        /* Código de Agendamento */
        .codigo-agendamento {
            font-size: 18px;
            color: #4a4a9c;
            font-weight: bold;
            padding: 15px;
            background-color: #f0f4ff;
            border-radius: 5px;
            margin: 20px 0;
        }

        /* Carrossel de Vídeos */
        .carousel {
            margin-top: 30px;
            width: 100%;
        }
        .carousel video {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Slick Carousel dots */
        .slick-dots li button:before {
            font-size: 12px;
            color: #4a4a9c;
        }
        .slick-dots li.slick-active button:before {
            color: #333;
        }

        /* Media Queries para dispositivos móveis */
        @media (max-width: 768px) {
            .form-section {
                padding: 20px;
            }
            .codigo-agendamento {
                font-size: 16px;
            }
            .container {
                padding: 15px;
                box-shadow: none;
            }
        }

    </style>
</head>
<body>

    <!-- Logo -->
    <div class="container logo">
        <img src="assets/logotelles.png" alt="Logo">
    </div>

    <!-- Imagem de Valores -->
    <div class="container imagem-valores">
        <img src="assets/valorestelles.png" alt="Valores">
    </div>

    <!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Horários</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        :root {
            --bg-color: #fff;
            --day-bg-color: #2D2D2D;
            --active-day-color: #FEC810;
            --time-bg-color: #2D2D2D;
            --time-hover-color: #FEC810;
            --confirm-bg-color: #FEC810;
            --confirm-hover-color: #E0B000;
            --text-color: #ffffff;
            --info-bg-color: #2D2D2D;
            --input-bg-color: #ffffff;
            --input-border-color: #cccccc;
            --input-focus-border-color: #FEC810;
        }

        h1,
        h2 {
            font-size: 36px;
            text-align: center;
            color: rgb(255, 255, 255);
        }

        .marqueagendamento {
            background-color: var(--confirm-bg-color);
            color: black;
            border: none;
            padding: 12px;
            /* Ajustado para menos padding */
            width: 96%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 16px;

        }


        .days-selection {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            /* Garante que o input preencha todo o espaço disponível */
            padding: 10px;
            /* Ajuste o padding conforme necessário */
            box-sizing: border-box;
            /* Inclui o padding e a borda no cálculo da largura */
        }

        .day {
            background-color: var(--day-bg-color);
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            color: var(--text-color);
        }

        .day.active {
            background-color: var(--active-day-color);
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            text-align: center;
        }

        .hour-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .col-4 {
            flex: 1 0 30%;
            margin: 5px;
        }

        .btn {
            background-color: var(--day-bg-color);
            padding: 10px;
            border-radius: 10px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s;
            color: var(--text-color);
        }

        .btn:disabled {
            background-color: #d3d3d3;
            /* Cor para botões desabilitados */
            color: #a9a9a9;
            /* Texto cinza claro */
            cursor: not-allowed;
            /* Cursor como proibido */
        }

        .btn-danger {
            background-color: fff;
        }

        .btn-outline-info {
            background-color: #0dcaf0;
        }

        .hidden {
            display: none;
        }

        .info {
            font-size: 14px;
            background-color: var(--info-bg-color);
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid var(--input-border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
            background-color: var(--input-bg-color);
        }


        input[type="text"]:focus {
            outline: none;
            border-color: var(--input-focus-border-color);
        }

        .btn:hover {
            background-color: var(--time-hover-color);
            transition: background-color 0.3s;
        }

        .day:hover {
            background-color: var(--time-hover-color);
        }

        .button-container button:hover {
            background-color: #007bff;
            /* Cor primária do Bootstrap */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
    <h2 class="marqueagendamento">FAÇA SEU AGENDAMENTO</h2>

    <!-- Campos ocultos para armazenar as informações do usuário -->
    <input type="hidden" name="nome" id="inputNome" value="<?php echo isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : ''; ?>">
    <input type="hidden" name="telefone" id="inputTelefone" value="<?php echo isset($_SESSION['telefone']) ? htmlspecialchars($_SESSION['telefone']) : ''; ?>">

    <!-- Botão para prosseguir com o agendamento -->
    <button type="button" id="prosseguir-btn" class="btn btn-primary mt-2">Prosseguir</button>

    <div id="days-container" class="hidden">
        <h1 class="info">Agendamento de Horários</h1>
        <div class="days-selection" id="daysSelection"></div>
    </div>

    <input type="hidden" name="dia" id="inputDia" value="">
    <input type="hidden" name="horario" id="inputHorario" value="09:05">
    <input type="hidden" name="Profissional" id="inputProfissional" value="">

    <div id="professionals-container" class="hidden">
        <h1>Escolha o Profissional</h1>
        <div class="button-container">
            <button type="button" id="telles-btn" class="btn btn-primary">Telles</button>
        </div>
        <div id="hour-buttons" class="hour-buttons row gx-3 mt-3 gy-3 mt-4"></div>
    </div>
</div>


    <script>
    function formatDate(date) {
        const weekdays = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'];
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const weekday = weekdays[date.getDay()];
        return `${day}/${month} - ${weekday}`;
    }

    const daysSelection = document.getElementById('daysSelection');
    const today = new Date();

    document.getElementById('prosseguir-btn').addEventListener('click', function () {
        const inputNome = document.getElementById('inputNome').value;
        const inputTelefone = document.getElementById('inputTelefone').value;

        if (inputNome && inputTelefone) {
            document.getElementById('days-container').classList.remove('hidden');
            daysSelection.innerHTML = '';

            for (let i = 0; i < 7; i++) {
                const nextDate = new Date(today);
                nextDate.setDate(today.getDate() + i);

                // Exibir apenas dias de segunda (1) a sábado (6)
                if (nextDate.getDay() < 1 || nextDate.getDay() > 6) continue;

                const formattedDate = formatDate(nextDate);
                const dayButton = document.createElement('button');
                dayButton.className = 'btn btn-secondary day mx-1';
                dayButton.innerHTML = formattedDate;

                const dataDia = new Date(nextDate.getFullYear(), nextDate.getMonth(), nextDate.getDate());
                dayButton.setAttribute('data-date', dataDia.toISOString().split('T')[0]);

                dayButton.addEventListener('click', function () {
                    document.querySelectorAll('.day').forEach(d => d.classList.remove('active'));
                    this.classList.add('active');
                    document.getElementById('inputDia').value = this.getAttribute('data-date');

                    document.getElementById('professionals-container').classList.add('hidden');
                    document.getElementById('hour-buttons').innerHTML = '';

                    showProfissionals();
                });

                daysSelection.appendChild(dayButton);
            }
        } else {
            alert("Por favor, digite seu nome e telefone.");
        }
    });



    function showProfissionals() {
        document.getElementById('professionals-container').classList.remove('hidden');
        const selectedDate = document.getElementById('inputDia').value;

        document.getElementById('telles-btn').style.display = 'block';
    }

    document.getElementById('telles-btn').addEventListener('click', function () {
        fetchHours('Telles');
    });

    function fetchHours(professional) {
        const selectedDate = document.getElementById('inputDia').value;
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "config/config.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
            if (xhr.status === 200) {
                const unavailableHours = JSON.parse(xhr.responseText);
                generateHourButtons(professional, unavailableHours);
            }
        };
        xhr.send(`professional=${professional}&day=${selectedDate}`);
    }

function generateHourButtons(person, unavailableHours) {
    const hourButtonsContainer = document.getElementById('hour-buttons');
    hourButtonsContainer.innerHTML = '';

    const now = new Date();
    const brasiliaOffset = -3 * 60;
    const currentDate = new Date(now.getTime() + (now.getTimezoneOffset() + brasiliaOffset) * 60 * 1000);
    const selectedDate = document.getElementById('inputDia').value;

    // Converte a data selecionada para um objeto Date e obtém o dia da semana
    const selectedDateObj = new Date(selectedDate + 'T00:00:00'); 
    const selectedDay = selectedDateObj.getUTCDay();
    const isToday = selectedDate === currentDate.toISOString().split('T')[0];

    let hours = [];

    // Verifica se é sexta (5) ou sábado (6) e exibe mensagem
    if (selectedDay === 5 || selectedDay === 6) { 
        const message = document.createElement('p');
        message.className = 'marqueagendamento';
        message.textContent = "Horários por ordem de chegada";
        hourButtonsContainer.appendChild(message);
        return;
    }

    // Define horários com base no dia da semana
    if (selectedDay === 1) { // Segunda-feira
        hours = ['14:00:00', '14:30:00', '15:00:00', '15:30:00', '16:00:00', '16:30:00', '17:00:00', '17:30:00', '18:00:00', '18:30:00', '19:00:00', '19:30:00'];
    } else { // Terça, Quarta, Quinta
        hours = ['09:00:00', '09:30:00', '10:00:00', '10:30:00', '11:00:00', '11:30:00', '12:00:00',
                 '14:00:00', '14:30:00', '15:00:00', '15:30:00', '16:00:00', '16:30:00', '17:00:00', '17:30:00', '18:00:00', '18:30:00', '19:00:00', '19:30:00'];
    }

    hours.forEach(hour => {
        const [hr, min] = hour.split(':');
        const buttonTime = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate(), hr, min);

        if (isToday && buttonTime <= currentDate) return; // Ignora horários passados

        if (!unavailableHours.includes(hour)) {
            const divCol = document.createElement('div');
            divCol.className = 'col-4';

            const button = document.createElement('button');
            button.className = 'btn w-100 days-selection';
            button.textContent = `${hour} - ${person}`;

            button.addEventListener('click', function () {
                finalizeAppointment(person, hour);
            });

            divCol.appendChild(button);
            hourButtonsContainer.appendChild(divCol);
        }
    });
}




    function finalizeAppointment(person, hour) {
        const nome = document.getElementById('inputNome').value;
        const telefone = document.getElementById('inputTelefone').value;
        const profissional = person;
        const dia = document.getElementById('inputDia').value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'config/config.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Agendamento realizado com sucesso!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            } else if (xhr.readyState === 4 && xhr.status !== 200) {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao realizar o agendamento. Tente novamente.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        };

        const params = `nome=${encodeURIComponent(nome)}&telefone=${encodeURIComponent(telefone)}&profissional=${encodeURIComponent(profissional)}&dia=${encodeURIComponent(dia)}&horario=${encodeURIComponent(hour)}`;
        xhr.send(params);
    }
</script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>



</html>

    <!-- Imagem Adicional -->
    <div class="container imagem-adicional">
        <img src="assets/planostelles.png" alt="Imagem Adicional">
    </div>

</body>
</html>
