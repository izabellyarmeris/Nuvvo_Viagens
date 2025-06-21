<?php

include('php/conexao.php');

$erro = null;
$sucesso = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  
    if (empty($_POST['nome']) || empty($_POST['sobrenome']) || empty($_POST['email']) || empty($_POST['senha'])) {
        $erro = "Todos os campos são obrigatórios.";
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $erro = "Formato de e-mail inválido.";
    } else if (strlen($_POST['senha']) < 6) {
        $erro = "A senha deve ter no mínimo 6 caracteres.";
    } else if ($_POST['senha'] !== $_POST['confirmar_senha']) {
        $erro = "As senhas não coincidem.";
    } else {
   
        $email = $mysqli->real_escape_string($_POST['email']);
        $sql_check = "SELECT id FROM usuarios WHERE email = '$email'";
        $result_check = $mysqli->query($sql_check);

        if ($result_check->num_rows > 0) {
            $erro = "Este e-mail já está cadastrado.";
        } else {
         
            $nome = $mysqli->real_escape_string($_POST['nome']);
            $sobrenome = $mysqli->real_escape_string($_POST['sobrenome']);
            $dataNasc = $mysqli->real_escape_string($_POST['dataNasc']);

                        $senha_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare("INSERT INTO usuarios (nome, sobrenome, data_nascimento, email, senha) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $nome, $sobrenome, $dataNasc, $email, $senha_hash);

            if ($stmt->execute()) {
              
                setcookie("remembered_email", $_POST['email'], time() + (86400 * 30), "/");

               
                header("Location: cadastro_sucesso.php?status=success");
                exit();
            } else {
                $erro = "Falha ao cadastrar. Tente novamente. Erro: " . $stmt->error;
            }
            $stmt->close();
        }
    }
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crie sua Conta | NUVSO</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" href="css/cadastro.css" /> 
</head>
<body>

    <main class="register-container">
        <div class="register-card">
            <div class="card-header">
                <a href="index.php"><img src="midia/logo.viagens.png" alt="Logo NUVSO" class="logo"></a>
                <h1 class="title">Crie Sua Conta</h1>
                <p class="subtitle">Vamos começar sua jornada conosco.</p>
                <?php if ($erro): ?>
                    <p style="color: #ff00c1; margin-bottom: 1rem;"><?php echo $erro; ?></p>
                <?php endif; ?>
            </div>
            
            <form action="cadastro.php" method="post" class="register-form">
                <div class="form-row">
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" name="nome" id="name" placeholder="Nome" required autofocus />
                    </div>
                    <div class="input-group">
                        <i class="fas fa-user-friends input-icon"></i>
                        <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" required />
                    </div>
                </div>
                <div class="input-group">
                    <i class="fas fa-calendar-alt input-icon"></i>
                    <input type="text" name="dataNasc" id="data-nascimento" placeholder="Data de Nascimento" onfocus="(this.type='date')" onblur="(this.type='text')" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" id="email" placeholder="Seu e-mail" required />
                </div>
                <div class="form-row">
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="senha" id="senha" placeholder="Crie uma senha" required />
                    </div>
                    <div class="input-group">
                        <i class="fas fa-check-circle input-icon"></i>
                        <input type="password" name="confirmar_senha" id="confirmar-senha" placeholder="Confirme a senha" required />
                    </div>
                </div>
                <button type="submit" class="register-button">Criar Conta</button>
            </form>

            <div class="card-footer">
                <a href="index.php" class="footer-link">Já tem uma conta? <strong>Faça login</strong></a>
            </div>
        </div>
        <div class="background-overlay"></div>
    </main>

</body>
</html>