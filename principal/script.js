const slides = Array.isArray(window.heroSlides) ? window.heroSlides : [];
const heroImage = document.getElementById('heroRotatingImage');
const heroLabel = document.getElementById('heroRotatingLabel');
const heroScientific = document.getElementById('heroRotatingScientific');
const speciesSearch = document.getElementById('speciesSearch');
const speciesFilters = Array.from(document.querySelectorAll('.species-filter'));
const speciesCards = Array.from(document.querySelectorAll('.species-card'));
const contactForm = document.getElementById('contactForm');
const contactStatus = document.getElementById('contactStatus');

if (heroImage && heroLabel && heroScientific && slides.length > 1) {
    let currentIndex = 0;

    const applySlide = (index) => {
        const slide = slides[index];
        heroImage.classList.add('is-fading');

        window.setTimeout(() => {
            heroImage.src = slide.src;
            heroImage.alt = slide.alt;
            heroLabel.textContent = slide.label;
            heroScientific.textContent = slide.scientific;
            heroImage.classList.remove('is-fading');
        }, 320);
    };

    window.setInterval(() => {
        currentIndex = (currentIndex + 1) % slides.length;
        applySlide(currentIndex);
    }, 10000);
}

if (speciesCards.length > 0) {
    let activeFilter = 'todas';

    const normalize = (value) =>
        value
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '');

    const applySpeciesFilters = () => {
        const searchTerm = normalize(speciesSearch ? speciesSearch.value : '');

        speciesCards.forEach((card) => {
            const category = normalize(card.dataset.category || '');
            const searchBase = normalize(card.dataset.search || '');
            const matchesFilter = activeFilter === 'todas' || category === normalize(activeFilter);
            const matchesSearch = searchTerm === '' || searchBase.includes(searchTerm);
            const shouldShow = matchesFilter && matchesSearch;

            card.style.display = shouldShow ? '' : 'none';
        });
    };

    speciesFilters.forEach((button) => {
        button.addEventListener('click', () => {
            activeFilter = button.dataset.filter || 'todas';
            speciesFilters.forEach((item) => item.classList.toggle('is-active', item === button));
            applySpeciesFilters();
        });
    });

    if (speciesSearch) {
        speciesSearch.addEventListener('input', applySpeciesFilters);
    }
}

if (contactForm) {
    contactForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(contactForm);
        const nome = String(formData.get('nome') || '').trim();
        const email = String(formData.get('email') || '').trim();
        const mensagem = String(formData.get('mensagem') || '').trim();
        const destino = window.contactConfig && window.contactConfig.email ? window.contactConfig.email : '';

        if (!nome || !email || !mensagem || !destino) {
            if (contactStatus) {
                contactStatus.hidden = false;
                contactStatus.className = 'form-status form-status--erro';
                contactStatus.textContent = 'Preencha todos os campos para abrir o email.';
            }
            return;
        }

        const assunto = encodeURIComponent('Nova mensagem do site Guia das Abelhas');
        const corpo = encodeURIComponent(
            `Nova mensagem recebida pelo site.\r\n\r\nNome: ${nome}\r\nEmail: ${email}\r\n\r\nMensagem:\r\n${mensagem}`
        );

        if (contactStatus) {
            contactStatus.hidden = false;
            contactStatus.className = 'form-status form-status--sucesso';
            contactStatus.textContent = 'Seu aplicativo de email sera aberto para voce enviar a mensagem.';
        }

        window.location.href = `mailto:${destino}?subject=${assunto}&body=${corpo}`;
    });
}
