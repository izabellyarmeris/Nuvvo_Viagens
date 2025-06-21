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

    const searchInput = document.getElementById('searchInput');
    const destinationsGrid = document.getElementById('destinationsGrid');
    const noResultsMessage = document.getElementById('noResultsMessage');

    if (searchInput && destinationsGrid) {
        const cards = destinationsGrid.querySelectorAll('.destination-card');

        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            let foundSomething = false;

            cards.forEach(card => {
                const cardTitle = card.querySelector('.card-title').textContent.toLowerCase();
                if (cardTitle.includes(searchTerm)) {
                    card.style.display = 'block'; 
                    foundSomething = true;
                } else {
                    card.style.display = 'none';
                }
            });

            if (noResultsMessage) {
                noResultsMessage.style.display = foundSomething ? 'none' : 'block';
            }
        });
    }

    
    const cardsToAnimate = document.querySelectorAll('.destination-card');
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