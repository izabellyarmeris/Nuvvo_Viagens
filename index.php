<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/plain; charset=utf-8');

echo "=====================================================\n";
echo "DIAGNÓSTICO DE VARIÁVEIS DE AMBIENTE DO RAILWAY\n";
echo "=====================================================\n\n";

echo "--- VERIFICANDO VARIÁVEIS DO BANCO DE DADOS ---\n";

$db_host = getenv('MYSQLHOST');
$db_name = getenv('MYSQLDATABASE');
$db_user = getenv('MYSQLUSER');
$db_pass_exists = getenv('MYSQLPASSWORD') !== false;

if (!empty($db_host)) {
    echo "✅ SUCESSO! Variáveis do MySQL foram encontradas:\n";
    echo "MYSQLHOST:     " . $db_host . "\n";
    echo "MYSQLDATABASE: " . $db_name . "\n";
    echo "MYSQLUSER:     " . $db_user . "\n";
    echo "MYSQLPASSWORD: " . ($db_pass_exists ? 'Existe (oculta por segurança)' : 'NÃO EXISTE') . "\n\n";
    echo "Se você vê isso, o problema é outro. Mas se não, continue lendo.\n\n";
} else {
    echo "❌ FALHA CRÍTICA! Nenhuma variável como 'MYSQLHOST' foi encontrada.\n";
    echo "Isso prova que o serviço PHP não está recebendo as informações do serviço de Banco de Dados, apesar de estarem ligados na interface.\n";
    echo "Isso pode ser um bug ou um atraso na sincronização do Railway.\n\n";
}

echo "--- LISTA COMPLETA DE TODAS AS VARIÁVEIS DISPONÍVEIS ---\n";
print_r(getenv());

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