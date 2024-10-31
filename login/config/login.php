<?php
// Iniciar a sessão
session_start();

// Configurações do banco de dados
$servername = "127.0.0.1:3306";
$username = "u870367221_Painel";
$password = "Deividlps120@";
$dbname = "u870367221_Painel";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando se há erros na conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Verificar se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Sanitizar os dados (para evitar SQL injection)
    $email = $conn->real_escape_string($email);

    // Verificar se o usuário existe no banco de dados
    $sql = "SELECT * FROM loginsite WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // O email foi encontrado
        $user = $result->fetch_assoc();
        
        // Verificar se a senha está correta usando password_verify()
        if (password_verify($senha, $user['senha'])) {
            // Senha correta, o login é bem-sucedido

            // Armazenar informações do usuário na sessão
            $_SESSION['nome'] = $user['nome']; // Assume que o nome está na coluna 'nome'
            $_SESSION['telefone'] = $user['telefone']; // Assume que o telefone está na coluna 'telefone'
            $_SESSION['loggedin'] = true;

            // Redirecionar para a página inicial ou qualquer página protegida
            header('Location: https://dmbarber.dmprojetos.com/site/');
            exit(); // Sempre use exit() após o header para garantir que o script pare aqui
        } else {
            // Senha incorreta
            echo "Senha incorreta!";
        }
    } else {
        // Email não encontrado
        echo "Email não encontrado!";
    }
} else {
    // Caso os dados do formulário não sejam enviados via POST
    echo "Método de requisição inválido.";
}

// Fechar a conexão
$conn->close();
?>
