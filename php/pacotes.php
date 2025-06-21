<?php
// Proteção de login para a página
include('protecao.php'); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacotes de Viagem | NUVSO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --primary-blue: #000c1f;
            --secondary-blue: #00132b;
            --dark-blue-rgb: 0, 19, 43;
            --accent-cyan: #00f6ff;
            --accent-magenta: #ff00c1;
            --text-light: #e0e6f0;
            --text-muted: #8a96a9;
            --border-color: rgba(255, 255, 255, 0.1);
            --border-radius: 12px;
            --font-main: 'Poppins', sans-serif;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: var(--font-main);
            background-color: var(--primary-blue);
            color: var(--text-light);
            line-height: 1.6;
        }
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .site-header {
            background-color: rgba(var(--dark-blue-rgb), 0.7);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            position: sticky; top: 0; z-index: 1000;
            border-bottom: 1px solid var(--border-color);
        }
        .header-content {
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
        .main-nav a:hover, .main-nav a.active { color: #fff; }
        .main-nav a:hover::after, .main-nav a.active::after { transform: scaleX(1); transform-origin: left; }
        .logout-button {
            color: #fff; background: linear-gradient(90deg, var(--accent-cyan), var(--accent-magenta));
            padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none;
            font-weight: 500; transition: transform 0.3s, box-shadow 0.3s;
        }
        .logout-button:hover {
            transform: translateY(-2px); box-shadow: 0 4px 15px rgba(255, 0, 193, 0.4);
        }
        .hero-section {
            padding: 4rem 0;
            text-align: center;
            /* ATUALIZAÇÃO DO GIF DE FUNDO */
            background: linear-gradient(180deg, rgba(var(--dark-blue-rgb), 0.2) 0%, var(--primary-blue) 100%), url('../midia/viagens.fundo.gif') no-repeat center center/cover;
        }
        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }
        .hero-subtitle {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
        }
        .search-form {
            background: rgba(var(--dark-blue-rgb), 0.6);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            max-width: 1000px;
            margin: 0 auto;
            backdrop-filter: blur(5px);
        }
        .search-form .input-group {
            flex: 1;
            display: flex;
            align-items: center;
            background: rgba(0,0,0,0.2);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            min-width: 180px;
        }
        .search-form .input-group i {
            color: var(--text-muted);
            margin-right: 0.75rem;
        }
        .search-form .input-group input {
            background: transparent;
            border: none;
            color: var(--text-light);
            width: 100%;
            font-size: 1rem;
        }
        .search-form .input-group input:focus { outline: none; }
        .search-form button {
            flex-basis: 150px;
            padding: 0.75rem 1rem;
            border: none; border-radius: 8px;
            font-weight: 600; font-size: 1.1rem;
            color: #fff; background: linear-gradient(90deg, var(--accent-cyan), var(--accent-magenta));
            cursor: pointer; transition: all 0.3s;
        }
        .search-form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(255, 0, 193, 0.4);
        }
        .packages-section {
            padding: 4rem 0;
        }
        .section-title {
            text-align: center; font-size: 2.5rem; font-weight: 700;
            margin-bottom: 3rem;
        }
        .section-title span {
            background: linear-gradient(90deg, var(--accent-cyan), var(--accent-magenta));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--accent-cyan);
        }
        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }
        .package-card {
            background: var(--secondary-blue);
            border-radius: var(--border-radius);
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: transform 0.4s ease, box-shadow 0.4s ease, opacity 0.4s ease;
            position: relative;
            text-decoration: none;
        }
        .package-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .card-image-container {
            position: relative;
            overflow: hidden;
            aspect-ratio: 16 / 10;
        }
        .card-image {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .package-card:hover .card-image {
            transform: scale(1.05);
        }
        .card-badge {
            position: absolute;
            top: 1rem; right: 1rem;
            background: linear-gradient(90deg, var(--accent-cyan), var(--accent-magenta));
            color: #fff;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .card-content { padding: 1.5rem; }
        .card-title {
            font-size: 1.3rem; font-weight: 600;
            margin-bottom: 1rem; color: #fff;
        }
        .card-price {
            font-size: 2rem; font-weight: 700;
            background: linear-gradient(90deg, var(--accent-cyan), var(--accent-magenta));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.25rem;
        }
        .card-price-details {
            font-size: 0.8rem; color: var(--text-muted);
            margin-bottom: 1.5rem;
        }
        .card-features {
            display: flex; flex-wrap: wrap;
            gap: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }
        .feature-item {
            display: flex; align-items: center;
            font-size: 0.9rem; color: var(--text-muted);
        }
        .feature-item i { margin-right: 0.5rem; color: var(--accent-cyan); }
        .no-results-message {
            grid-column: 1 / -1;
            text-align: center;
            font-size: 1.2rem;
            color: var(--text-muted);
            padding: 3rem;
            display: none;
        }
        .package-card.single-result {
            grid-column: 1 / -1;
            max-width: 450px;
            margin: 0 auto;
        }
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
    </style>
</head>
<body>

    <header id="siteHeader" class="site-header">
        <div class="container header-content">
            <a class="logo-area" href="viagens.php">
                <img src="../midia/logo.viagens.png" alt="Logo NUVSO Viagens">
            </a>
            <nav class="main-nav">
                <a href="viagens.php">Destinos</a>
                <a href="pacotes.php" class="active">Pacotes</a>
                <a href="sobre.php">Sobre</a>
            </nav>
            <div class="user-area">
                <a href="logout.php" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </div>
    </header>

    <main>
        <section class="hero-section">
            <div class="container">
                <h1 class="hero-title">Encontre o Pacote Perfeito</h1>
                <p class="hero-subtitle">Seu próximo destino inesquecível está a apenas uma busca de distância.</p>
                <form action="#" method="GET" class="search-form" onsubmit="return false;">
                    <div class="input-group">
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="text" id="destinationSearchInput" placeholder="Pesquise por cidade ou estado...">
                    </div>
                    <div class="input-group">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="text" placeholder="Data de Entrada" onfocus="(this.type='date')">
                    </div>
                    <div class="input-group">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="text" placeholder="Data de Saída" onfocus="(this.type='date')">
                    </div>
                    <button type="submit">Pesquisar</button>
                </form>
            </div>
        </section>

        <section class="packages-section">
            <div class="container">
                <h2 class="section-title"><span>Pacotes em Destaque</span></h2>
                <div class="packages-grid">
                    
                    <a href="#" class="package-card" style="text-decoration: none;">
                        <div class="card-image-container">
                            <img src="../midia/gramado.jpg" alt="Gramado, RS" class="card-image">
                            <div class="card-badge">Imperdível</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Pacote Gramado & Canela (RS)</h3>
                            <p class="card-price">R$ 980</p><p class="card-price-details">por pessoa + taxas</p>
                            <div class="card-features">
                                <div class="feature-item"><i class="fas fa-plane"></i> Aéreo</div><div class="feature-item"><i class="fas fa-hotel"></i> 4 Diárias</div><div class="feature-item"><i class="fas fa-coffee"></i> Café da Manhã</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="package-card" style="text-decoration: none;">
                        <div class="card-image-container">
                             <img src="../midia/bahia.jpg" alt="Salvador, BA" class="card-image">
                             <div class="card-badge">Mais Vendido</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Pacote Salvador Histórico (Bahia)</h3>
                            <p class="card-price">R$ 1250</p><p class="card-price-details">por pessoa + taxas</p>
                            <div class="card-features">
                                <div class="feature-item"><i class="fas fa-plane"></i> Aéreo</div><div class="feature-item"><i class="fas fa-hotel"></i> 5 Diárias</div><div class="feature-item"><i class="fas fa-map-marked-alt"></i> Tour Pelourinho</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="package-card" style="text-decoration: none;">
                        <div class="card-image-container">
                             <img src="../midia/amazonia.jpeg" alt="Amazônia" class="card-image">
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Aventura na Amazônia</h3>
                            <p class="card-price">R$ 2100</p><p class="card-price-details">por pessoa + taxas</p>
                            <div class="card-features">
                                <div class="feature-item"><i class="fas fa-plane"></i> Aéreo</div><div class="feature-item"><i class="fas fa-bed"></i> 3 Diárias em Lodge</div><div class="feature-item"><i class="fas fa-binoculars"></i> Excursões</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="package-card" style="text-decoration: none;">
                        <div class="card-image-container">
                             <img src="../midia/riodejaneiro.jpg" alt="Rio de Janeiro" class="card-image">
                             <div class="card-badge">Popular</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Cidade Maravilhosa: Rio de Janeiro</h3>
                            <p class="card-price">R$ 1450</p><p class="card-price-details">por pessoa + taxas</p>
                            <div class="card-features">
                                <div class="feature-item"><i class="fas fa-plane"></i> Aéreo</div><div class="feature-item"><i class="fas fa-hotel"></i> 5 Diárias</div><div class="feature-item"><i class="fas fa-mountain"></i> Tour Pão de Açúcar</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="package-card" style="text-decoration: none;">
                        <div class="card-image-container">
                             <img src="../midia/marco-zero.jpg" alt="Recife" class="card-image">
                             <div class="card-badge">Cultura</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Encantos de Recife & Olinda</h3>
                            <p class="card-price">R$ 1100</p><p class="card-price-details">por pessoa + taxas</p>
                            <div class="card-features">
                                <div class="feature-item"><i class="fas fa-plane"></i> Aéreo</div><div class="feature-item"><i class="fas fa-hotel"></i> 4 Diárias</div><div class="feature-item"><i class="fas fa-umbrella-beach"></i> City Tour</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="package-card" style="text-decoration: none;">
                        <div class="card-image-container">
                             <img src="../midia/saopaulo.jpg" alt="São Paulo" class="card-image">
                             <div class="card-badge">Urbano</div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Descubra São Paulo</h3>
                            <p class="card-price">R$ 850</p><p class="card-price-details">por pessoa + taxas</p>
                            <div class="card-features">
                                <div class="feature-item"><i class="fas fa-plane"></i> Aéreo</div><div class="feature-item"><i class="fas fa-hotel"></i> 3 Diárias</div><div class="feature-item"><i class="fas fa-building"></i> Tour Av. Paulista</div>
                            </div>
                        </div>
                    </a>

                    <p class="no-results-message">Nenhum pacote encontrado para sua busca.</p>
                </div>
            </div>
        </section>
    </main>
    
    <footer class="site-footer">
        <div class="footer-content container">
            <div class="footer-column">
                <img src="../midia/logo.viagens.png" alt="Logo NUVSO" style="height: 50px; margin-bottom: 1rem;">
                <p>A aventura da sua vida está a um clique de distância.</p>
            </div>
            <div class="footer-column">
                <h4 class="footer-title">Navegação</h4>
                <ul class="footer-links">
                    <li><a href="viagens.php">Destinos</a></li>
                    <li><a href="pacotes.php">Pacotes</a></li>
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
            const searchInput = document.getElementById('destinationSearchInput');
            const packageCards = document.querySelectorAll('.package-card');
            const noResultsMessage = document.querySelector('.no-results-message');

            function normalizeText(text) {
                return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            }

            searchInput.addEventListener('input', () => {
                const searchTerm = normalizeText(searchInput.value.toLowerCase().trim());
                const visibleCardsList = [];

                packageCards.forEach(card => {
                    const cardTitle = normalizeText(card.querySelector('.card-title').textContent.toLowerCase());
                    const shouldBeVisible = cardTitle.includes(searchTerm);
                    
                    card.style.display = shouldBeVisible ? 'block' : 'none';
                    card.classList.remove('single-result');

                    if (shouldBeVisible) {
                        visibleCardsList.push(card);
                    }
                });

                noResultsMessage.style.display = visibleCardsList.length === 0 ? 'block' : 'none';

                if (visibleCardsList.length === 1) {
                    visibleCardsList[0].classList.add('single-result');
                }
            });
        });
    </script>

</body>
</html>