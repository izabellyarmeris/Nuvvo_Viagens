<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'php/conexao.php';

$remembered_email = isset($_COOKIE['remembered_email']) ? htmlspecialchars($_COOKIE['remembered_email']) : '';
$erro = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['email']) || empty($_POST['senha'])) {
        $erro = "Preencha todos os campos.";
    } else {
        try {
            $email = $_POST['email'];
            $senha_digitada = $_POST['senha'];

            $sql_code = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $pdo->prepare($sql_code);
            $stmt->execute(['email' => $email]);
            $usuario = $stmt->fetch();

            if ($usuario && password_verify($senha_digitada, $usuario['senha'])) {
                session_regenerate_id(true); 
                
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                
                setcookie("remembered_email", $_POST['email'], time() + (86400 * 30), "/");

                header("Location: php/viagens.php");
                exit();
            } else {
                $erro = "Falha ao logar! E-mail ou senha incorretos.";
            }
        } catch (PDOException $e) {
            error_log("Erro de Login: " . $e->getMessage());
            $erro = "Falha no sistema. Tente novamente mais tarde.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | NUVSO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/login.css" />
</head>
<body>

    <main class="login-container">
        <div class="background-overlay"></div>
        <div class="login-card">
            <div class="card-header">
                <img src="midia/logo.viagens.png" alt="Logo NUVSO" class="logo">
                <h1 class="title">Bem-vindo de Volta</h1>
                <p class="subtitle">Acesse sua conta para continuar sua jornada.</p>
                
                <?php if ($erro): ?>
                    <p style="color: #ff00c1; background-color: rgba(255,0,193,0.1); padding: 10px; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #ff00c1;">
                        <?php echo htmlspecialchars($erro); ?>
                    </p>
                <?php endif; ?>
            </div>
            
            <form action="index.php" method="POST" class="login-form">
                <div class="input-group">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" id="email" name="email" placeholder="Seu e-mail" value="<?php echo $remembered_email; ?>" required autofocus />
                </div>
                <div class="input-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" id="password" name="senha" placeholder="Sua senha" required />
                </div>
                <button type="submit" class="login-button">Entrar</button>
            </form>

            <div class="card-footer">
                <a href="#">Esqueceu sua senha?</a>
                <a href="cadastro.php" class="footer-link">Não tem uma conta? <strong>Cadastre-se</strong></a>
            </div>
        </div>
    </main>

</body>
</html>