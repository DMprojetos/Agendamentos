<?php
// Configurações do banco de dados
$servername = "127.0.0.1:3306";
$username = "u870367221_Painel";
$password = "Deividlps120@";
$dbname = "u870367221_Painel";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se houve erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber os dados do formulário e sanitizá-los
$nome = $conn->real_escape_string($_POST['nome']);
$email = $conn->real_escape_string($_POST['email']);
$telefone = $conn->real_escape_string($_POST['telefone']); // Adicionado para capturar o telefone
$senha = $_POST['senha'];
$confirmar_senha = $_POST['confirmar_senha'];

// Verificar se as senhas coincidem
if ($senha !== $confirmar_senha) {
    echo "<script>alert('As senhas não coincidem!'); window.history.back();</script>";
    exit;
}

// Verificar se o email já está cadastrado
$email_verificado = $conn->query("SELECT * FROM loginsite WHERE email='$email'");
if ($email_verificado->num_rows > 0) {
    // Redireciona para a URL se o email já estiver cadastrado
    echo "<script>window.location.href = 'http://dmbarber.dmprojetos.com';</script>";
    exit; // Importante parar a execução do script
}

// **ARMAZENANDO A SENHA DE FORMA SEGURA**
$senha_armazenada = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha

// Preparar a consulta SQL
$stmt = $conn->prepare("INSERT INTO loginsite (nome, email, telefone, senha) VALUES (?, ?, ?, ?)"); // Adicionado telefone
$stmt->bind_param("ssss", $nome, $email, $telefone, $senha_armazenada); // Adicionado telefone

// Executar a consulta
// Executar a consulta
if ($stmt->execute()) {
    // Em vez de apenas imprimir uma mensagem, use JavaScript para exibir um alerta
    echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href = '../index.html';</script>";
    exit; // Importante parar a execução após redirecionar
} else {
    // Alerta em caso de erro
    echo "<script>alert('Erro ao cadastrar: " . addslashes($stmt->error) . "'); window.history.back();</script>";
    exit; // Importante parar a execução após exibir o alerta
}


// Fechar a conexão
$stmt->close();
$conn->close();
?>
