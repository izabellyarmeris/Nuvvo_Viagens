<?php
include('protecao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUVSO | A Viagem dos Sonhos Começa Aqui</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/viagens.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <header id="siteHeader" class="site-header">
        <div class="header-content">
            <a class="logo-area" href="#">
                <img src="../midia/logo.viagens.png" alt="Logo NUVVO Viagens">
            </a>
            <nav class="main-nav">
                <a href="viagens.php">Destinos</a>
                <a href="pacotes.php">Pacotes</a>
                <a href="sobre.php">Sobre</a>
            </nav>
            <div class="user-area">
                <a href="logout.php" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </div>
    </header>

    <main class="main-content">

        <section class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">Bem-vindo(a) a viagem dos seus sonhos, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h1>
                <p class="hero-subtitle">Descubra destinos que irão transformar sua percepção do mundo. A aventura começa agora.</p>
                <div class="search-bar">
                    <input type="text" id="searchInput" class="search-input" placeholder="Pesquise por um destino...">
                    <button class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </section>

        <section class="destinations-section">
            <h2 class="section-title"><span>Destinos em Destaque</span></h2>
            <div id="destinationsGrid" class="destinations-grid">
                <div class="destination-card">
                    <div class="card-glow"></div>
                    <img src="../midia/carneiros.jpeg" alt="Praia de Carneiros" class="card-image">
                    <div class="card-content">
                        <h3 class="card-title">Praia de Carneiros</h3>
                        <p class="card-description">Um paraíso tropical em Tamandaré, com águas cristalinas e paisagens deslumbrantes.</p>
                        <a href="https://www.tripadvisor.com.br/Attraction_Review-g780931-d2327833-Reviews-Praia_dos_Carneiros-Tamandare_State_of_Pernambuco.html" class="card-button">Explorar</a>
                    </div>
                </div>
                <div class="destination-card">
                    <div class="card-glow"></div>
                    <img src="../midia/marco-zero.jpg" alt="Marco Zero" class="card-image">
                    <div class="card-content">
                        <h3 class="card-title">Marco Zero</h3>
                        <p class="card-description">O coração histórico de Recife, com rica cultura, arquitetura e eventos vibrantes.</p>
                        <a href="https://guia.melhoresdestinos.com.br/marco-zero-108-2110-l.html" class="card-button">Explorar</a>
                    </div>
                </div>
                <div class="destination-card">
                    <div class="card-glow"></div>
                    <img src="../midia/tokio.jpeg" alt="Tokyo" class="card-image">
                    <div class="card-content">
                        <h3 class="card-title">Tokyo</h3>
                        <p class="card-description">Uma metrópole futurista no Japão, combinando tradição com inovação tecnológica.</p>
                        <a href="https://www.japan.travel/pt/destinations/kanto/tokyo/" class="card-button">Explorar</a>
                    </div>
                </div>
            </div>
            <p id="noResultsMessage" class="no-results-message" style="display: none;">Nenhum destino encontrado para sua busca.</p>
        </section>

        <section class="features-section aurora-background">
            <h2 class="section-title"><span>Por que Viajar com a NUVVO?</span></h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-map-marked-alt"></i></div>
                    <h3 class="feature-title">Curadoria Exclusiva</h3>
                    <p class="feature-description">Destinos selecionados a dedo para garantir experiências autênticas e inesquecíveis.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-headset"></i></div>
                    <h3 class="feature-title">Suporte Humanizado</h3>
                    <p class="feature-description">Nossa equipe está disponível 24/7 para que sua única preocupação seja aproveitar.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-star"></i></div>
                    <h3 class="feature-title">Qualidade Premium</h3>
                    <p class="feature-description">Parcerias com os melhores hotéis e serviços para uma viagem com conforto e segurança.</p>
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
                    <li><a href="#">Destinos</a></li>
                    <li><a href="#">Pacotes</a></li>
                    <li><a href="#">Sobre Nós</a></li>
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
            <p>© 2025 NUVSO Viagens. Criado para impressionar.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="viagens.js"></script>
</body>
</html>