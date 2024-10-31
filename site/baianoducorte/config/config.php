<?php
// Configurações do banco de dados
$servername = "127.0.0.1:3306";
$username = "u870367221_BaianoduCorte";
$password = "Deividlps120@";
$dbname = "u870367221_BaianoduCorte";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Processar a requisição de horários indisponíveis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['professional'])) {
    $professional = $_POST['professional'];
    $day = $_POST['day']; // Supondo que a data também seja enviada

    // Consulta para buscar horários agendados para o profissional no dia específico
    $stmt = $conn->prepare("SELECT horario FROM agendamentosbaiano WHERE profissional = ? AND dia = ?");
    $stmt->bind_param("ss", $professional, $day);
    $stmt->execute();
    $result = $stmt->get_result();

    $unavailableHours = [];
    while ($row = $result->fetch_assoc()) {
        $unavailableHours[] = $row['horario'];
    }

    // Retorna os horários indisponíveis em formato JSON
    echo json_encode($unavailableHours);

    $stmt->close();
    $conn->close();
    exit;
}

// Processar o agendamento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['telefone'], $_POST['profissional'], $_POST['dia'], $_POST['horario'])) {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $profissional = $_POST['profissional'];
    $dia = $_POST['dia'];
    $horario = date('H:i', strtotime($_POST['horario']));

    // Verificar se os dados estão completos
    if ($nome && $telefone && $profissional && $dia && $horario) {
        // Prepara a consulta
        $stmt = $conn->prepare("INSERT INTO agendamentosbaiano (nome, telefone, profissional, dia, horario) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nome, $telefone, $profissional, $dia, $horario); // Corrigido "sssss"

        if ($stmt->execute()) {
            echo "Agendamento realizado com sucesso!";
        } else {
            echo "Erro ao agendar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Todos os campos são obrigatórios.";
    }

    $conn->close();
}
?>