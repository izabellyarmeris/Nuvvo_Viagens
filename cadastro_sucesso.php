<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro Realizado! | NUVSO</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/cadastro.css" /> 
    <style>
        .success-icon {
            font-size: 5rem;
            color: #00f6ff;
            margin-bottom: 1.5rem;
            animation: pop-in 0.5s ease-out;
        }
        @keyframes pop-in {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>
    <main class="register-container">
        <div class="background-overlay"></div>
        <div class="register-card">
            <div class="card-header" style="text-align: center;">
                <i class="fas fa-check-circle success-icon"></i>
                <h1 class="title">Cadastro Realizado!</h1>
                <p class="subtitle">Sua conta foi criada com sucesso. Agora você já pode explorar os melhores destinos conosco.</p>
            </div>
            
            <a href="index.php" class="register-button" style="text-decoration: none;">Ir para tela de Login</a>
        </div>
    </main>
</body>
</html>