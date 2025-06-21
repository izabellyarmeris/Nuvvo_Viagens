<?php
// Proteção de login para a página
include('protecao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós | NUVVO Viagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --primary-blue: #00132b;
            --dark-blue-rgb: 0, 19, 43;
            --accent-cyan: #00f6ff;
            --accent-magenta: #ff00c1;
            --text-light: #e0e6f0;
            --text-dark: #333;
            --text-muted: #8a96a9;
            --border-color: rgba(255, 255, 255, 0.1);
            --border-radius: 16px;
            --font-main: 'Poppins', sans-serif;
        }

        ::selection {
            background-color: var(--accent-cyan);
            color: var(--primary-blue);
        }

        body {
            font-family: var(--font-main);
            background-color: var(--primary-blue);
            color: var(--text-light);
            line-height: 1.7;
            overflow-x: hidden;
        }

        /* --- CABEÇALHO (HEADER) --- */
        .site-header {
            background-color: rgba(var(--dark-blue-rgb), 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.3s ease-in-out;
        }
        .header-content {
            max-width: 1200px; margin: 0 auto; padding: 0 1rem;
            display: flex; justify-content: space-between; align-items: center;
        }
        .logo-area img { height: 40px; }
        .main-nav { display: flex; gap: 2rem; }
        .main-nav a {
            color: var(--text-light); text-decoration: none; font-weight: 500;
            position: relative; transition: color 0.3s;
        }
        .main-nav a::after {
            content: ''; position: absolute; bottom: -5px; left: 0; width: 100%; height: 2px;
            background: linear-gradient(90deg, var(--accent-cyan), var(--accent-magenta));
            transform: scaleX(0); transform-origin: right; transition: transform 0.4s ease-out;
        }
        .main-nav a:hover { color: #fff; }
        .main-nav a:hover::after, .main-nav a.active::after { transform: scaleX(1); transform-origin: left; }
        .logout-button {
            color: #fff; background: linear-gradient(90deg, var(--accent-cyan), var(--accent-magenta));
            padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none;
            font-weight: 500; transition: transform 0.3s, box-shadow 0.3s;
        }
        .logout-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 0, 193, 0.4);
        }
        
        /* --- ESTILOS GERAIS DE CONTEÚDO --- */
        .main-content { max-width: 1200px; margin: 0 auto; padding: 2rem 1rem; }
        .section-title {
            text-align: center; font-size: 2.5rem; font-weight: 700;
            margin-bottom: 3rem;
        }
        .section-title span {
            background: linear-gradient(90deg, var(--accent-cyan), var(--accent-magenta));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .animated-card {
            opacity: 0; transform: translateY(30px);
        }
        .animated-card.visible {
            opacity: 1; transform: translateY(0); transition: opacity 0.6s ease, transform 0.6s ease;
        }

        /* --- SEÇÃO HERO "SOBRE NÓS" --- */
        .hero-section {
            position: relative; padding: 6rem 2rem; text-align: center;
            border-radius: var(--border-radius); overflow: hidden; margin-bottom: 5rem;
        }
        .hero-section::before {
            content: ''; position: absolute; inset: 0;
            background: url('https://images.unsplash.com/photo-1522199755839-a2bacb67c546?q=80&w=2072&auto=format&fit=crop') no-repeat center center/cover;
            animation: kenburns 20s ease-in-out infinite; z-index: -1;
        }
        .hero-section::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(var(--dark-blue-rgb), 1), rgba(var(--dark-blue-rgb), 0.5));
        }
        @keyframes kenburns {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.1) rotate(1deg); }
        }
        .hero-content { position: relative; z-index: 1; }
        .hero-title {
            font-size: 3.5rem; font-weight: 800;
            color: #fff;
        }
        .hero-subtitle {
            font-size: 1.2rem; margin: 1rem auto 0;
            max-width: 700px; color: var(--text-light); opacity: 0.9;
        }

        /* --- SEÇÃO "NOSSA EQUIPE" --- */
        .team-section { margin-bottom: 5rem; }
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
        }
        .team-card {
            position: relative;
            background-color: rgba(var(--dark-blue-rgb), 0.5);
            border-radius: var(--border-radius);
            overflow: hidden;
            border: 1px solid var(--border-color);
            text-align: center;
            padding: 2rem;
            transition: transform 0.4s ease;
        }
         .team-card:hover { transform: translateY(-10px); }
        .team-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--border-color);
            margin-bottom: 1.5rem;
            box-shadow: 0 0 20px rgba(0, 246, 255, 0.3);
        }
        .team-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.25rem;
        }
        .team-role {
            font-size: 1rem;
            color: var(--accent-cyan);
            margin-bottom: 1rem;
        }
        .team-bio {
            font-size: 0.9rem;
            color: var(--text-light);
            opacity: 0.8;
        }
        /* Efeito de Borda Neon nos cards da equipe */
        .card-glow {
            position: absolute; inset: -2px;
            background: conic-gradient(from 90deg at 50% 50%, var(--accent-cyan), var(--accent-magenta), var(--accent-cyan));
            z-index: -1; border-radius: 18px;
            opacity: 0; transition: opacity 0.4s;
            animation: spin 4s linear infinite paused;
        }
        .team-card:hover .card-glow {
            opacity: 1;
            animation-play-state: running;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* --- SEÇÃO DE DESTAQUES (AURORA) --- */
        .features-section {
            position: relative; padding: 5rem 2rem; border-radius: var(--border-radius);
            overflow: hidden; color: #fff; margin-bottom: 5rem;
        }
        .aurora-background::before, .aurora-background::after {
            content: ''; position: absolute; z-index: -1; width: 400px; height: 400px;
            border-radius: 50%; filter: blur(100px); opacity: 0.4;
        }
        .aurora-background::before {
            background: radial-gradient(circle, var(--accent-cyan), transparent 60%);
            top: -100px; left: -100px; animation: move-aurora-1 15s infinite;
        }
        .aurora-background::after {
            background: radial-gradient(circle, var(--accent-magenta), transparent 60%);
            bottom: -100px; right: -100px; animation: move-aurora-2 15s infinite;
        }
        @keyframes move-aurora-1 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(100px, 100px); }
        }
        @keyframes move-aurora-2 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-100px, -100px); }
        }
        .features-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5rem; position: relative; z-index: 1;
        }
        .feature-item {
            background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px);
            padding: 2rem; border-radius: var(--border-radius);
            border: 1px solid var(--border-color); text-align: center;
        }
        .feature-icon {
            font-size: 3rem; margin-bottom: 1rem;
            background: linear-gradient(90deg, var(--accent-cyan), var(--accent-magenta));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .feature-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; }

         /* --- RODAPÉ (FOOTER) --- */
        .site-footer {
            background: #000a1a; color: rgba(255, 255, 255, 0.6);
            padding: 3rem 1rem 1rem; margin-top: 4rem;
            border-top: 1px solid var(--border-color);
        }
        .footer-content {
            max-width: 1200px; margin: 0 auto; display: grid;
            grid-template-columns: 2fr 1fr 1fr; gap: 2rem; margin-bottom: 2rem;
        }
        .footer-title {
            font-size: 1.1rem; font-weight: 600;
            color: #fff; margin-bottom: 1rem;
        }
        .footer-links { list-style: none; padding: 0; }
        .footer-links li a {
            color: rgba(255, 255, 255, 0.6); text-decoration: none;
            transition: color 0.3s; padding-bottom: 0.5rem; display: inline-block;
        }
        .footer-links li a:hover { color: var(--accent-cyan); }
        .social-icons a {
            color: rgba(255, 255, 255, 0.6); font-size: 1.2rem;
            margin-right: 1.5rem; transition: color 0.3s, transform 0.3s;
            display: inline-block;
        }
        .social-icons a:hover { color: var(--accent-cyan); transform: translateY(-2px); }
        .footer-bottom {
            text-align: center; border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem; font-size: 0.9rem;
        }

        /* --- RESPONSIVIDADE --- */
        @media (max-width: 992px) {
            .main-nav { display: none; } /* Esconde a navegação principal em telas menores */
            .footer-content { grid-template-columns: 1fr; text-align: center; }
        }
        @media (max-width: 768px) {
            .hero-title { font-size: 2.5rem; }
            .section-title { font-size: 2rem; }
        }
    </style>
</head>
<body>

    <header id="siteHeader" class="site-header">
        <div class="header-content">
            <a class="logo-area" href="viagens.php">
                <img src="../midia/logo.viagens.png" alt="Logo NUVSO Viagens">
            </a>
            <nav class="main-nav">
                <a href="viagens.php">Destinos</a>
                <a href="pacotes.php">Pacotes</a>
                <a href="sobre.php" class="active">Sobre</a>
            </nav>
            <div class="user-area">
                <a href="logout.php" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </div>
    </header>

    <main class="main-content">

        <section class="hero-section animated-card">
            <div class="hero-content">
                <h1 class="hero-title">Nossa Missão é Redefinir a Arte de Viajar</h1>
                <p class="hero-subtitle">Acreditamos que cada viagem é uma oportunidade de crescimento, descoberta e conexão. A NUVSO nasceu do desejo de transformar simples passeios em experiências de vida inesquecíveis.</p>
            </div>
        </section>
        
        <section class="team-section">
            <h2 class="section-title"><span>Conheça Nossa Equipe</span></h2>
            <div class="team-grid">
                <div class="team-card animated-card">
                    <div class="card-glow"></div>
                    <img src="../midia/perfil.izabelly.jpg" alt="Foto de um membro da equipe" class="team-photo">
                    <h3 class="team-name">Izabelly Armeris</h3>
                    <p class="team-role">Fundadora & CEO</p>
                    <p class="team-bio">Fundadora & CEO da NUVVO, com especialização em segurança e cloud computing. Lidera a Nuar com foco em inovação e proteção de dados.</p>
                </div>
                <div class="team-card animated-card" style="transition-delay: 0.2s;">
                    <div class="card-glow"></div>
                    <img src="../midia/PERFILWILL.jpg" alt="Foto de um membro da equipe" class="team-photo">
                    <h3 class="team-name">Willians Ferreira</h3>
                    <p class="team-role">Desenvolvedor e opera em Segurança da informação</p>
                    <p class="team-bio">Desenvolvedor com ampla experiência em Segurança da Informação. É responsável por criar soluções robustas e proteger a infraestrutura digital da empresa.</p>
                </div>
                <div class="team-card animated-card" style="transition-delay: 0.4s;">
                    <div class="card-glow"></div>
                    <img src="../midia/perfil.gustavo.png" alt="Foto de um membro da equipe" class="team-photo">
                    <h3 class="team-name">Gustavo Alves</h3>
                    <p class="team-role">Desenvolvedor back-end e especialista em Banco de dados</p>
                    <p class="team-bio">Gustavos Garante a performance e a integridade dos dados que sustentam nossas operações.</p>
                </div>
            </div>
        </section>

        <section class="features-section aurora-background animated-card">
             <h2 class="section-title"><span>Nossos Pilares</span></h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-compass"></i></div>
                    <h3 class="feature-title">Paixão por Explorar</h3>
                    <p class="feature-description">Somos movidos pela curiosidade e pelo desejo de descobrir o novo, o belo e o autêntico.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3 class="feature-title">Compromisso Total</h3>
                    <p class="feature-description">Sua segurança e satisfação são nossa prioridade máxima em cada etapa da jornada.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-lightbulb"></i></div>
                    <h3 class="feature-title">Inovação Constante</h3>
                    <p class="feature-description">Buscamos incessantemente novas tecnologias e ideias para tornar suas viagens ainda melhores.</p>
                </div>
            </div>
        </section>

    </main>

    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-column">
                <img src="../midia/logo.viagens.png" alt="Logo NUVSO" style="height: 50px; margin-bottom: 1rem;">
                <p>A aventura da sua vida está a um clique de distância.</p>
            </div>
            <div class="footer-column">
                <h4 class="footer-title">Navegação</h4>
                <ul class="footer-links">
                    <li><a href="viagens.php">Destinos</a></li>
                    <li><a href="#">Pacotes</a></li>
                    <li><a href="sobre.php">Sobre Nós</a></li>
                    <li><a href="#">Contato</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4 class="footer-title">Siga-nos</h4>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© <?php echo date("Y"); ?> NUVSO Viagens. Criado para impressionar.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const siteHeader = document.getElementById('siteHeader');
            if (siteHeader) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        siteHeader.classList.add('scrolled');
                    } else {
                        siteHeader.classList.remove('scrolled');
                    }
                });
            }

            const cardsToAnimate = document.querySelectorAll('.animated-card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            cardsToAnimate.forEach(card => {
                observer.observe(card);
            });
        });
    </script>

</body>
</html>