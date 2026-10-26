document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll(".carousel-slide");
    const dots = document.querySelectorAll(".dot");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const progressBar = document.getElementById("carouselProgress");
    const carouselContainer = document.getElementById("mainCarousel");

    if (!slides.length) return;

    let currentIndex = 0;
    const intervalTime = 5000; // 5 segundos
    let slideTimer = null;

    // Atualiza o slide ativo
    function showSlide(index) {
        if (index >= slides.length) {
            currentIndex = 0;
        } else if (index < 0) {
            currentIndex = slides.length - 1;
        } else {
            currentIndex = index;
        }

        slides.forEach((slide, i) => {
            slide.classList.toggle("active", i === currentIndex);
        });

        dots.forEach((dot, i) => {
            dot.classList.toggle("active", i === currentIndex);
        });

        resetProgressBar();
    }

    // Reinicia a animação da barra de progresso
    function resetProgressBar() {
        if (!progressBar) return;
        progressBar.style.transition = "none";
        progressBar.style.width = "0%";

        // Força reflow no DOM para reiniciar CSS transition
        void progressBar.offsetWidth;

        progressBar.style.transition = `width ${intervalTime}ms linear`;
        progressBar.style.width = "100%";
    }

    function nextSlide() {
        showSlide(currentIndex + 1);
    }

    function prevSlide() {
        showSlide(currentIndex - 1);
    }

    function startAutoplay() {
        stopAutoplay();
        resetProgressBar();
        slideTimer = setInterval(nextSlide, intervalTime);
    }

    function stopAutoplay() {
        if (slideTimer) {
            clearInterval(slideTimer);
            slideTimer = null;
        }
        if (progressBar) {
            progressBar.style.transition = "none";
        }
    }

    // Eventos dos botões de controle
    nextBtn?.addEventListener("click", () => {
        nextSlide();
        startAutoplay();
    });

    prevBtn?.addEventListener("click", () => {
        prevSlide();
        startAutoplay();
    });

    // Eventos dos indicadores (dots)
    dots.forEach((dot) => {
        dot.addEventListener("click", (e) => {
            const slideIdx = parseInt(e.target.getAttribute("data-slide"), 10);
            showSlide(slideIdx);
            startAutoplay();
        });
    });

    // Pausar autoplay ao passar o mouse por cima
    carouselContainer?.addEventListener("mouseenter", stopAutoplay);
    carouselContainer?.addEventListener("mouseleave", startAutoplay);

    // Suporte a Gestos Touch (Swipe no Mobile)
    let touchStartX = 0;
    let touchEndX = 0;

    carouselContainer?.addEventListener("touchstart", (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    carouselContainer?.addEventListener("touchend", (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });

    function handleSwipe() {
        const threshold = 40; // distância mínima do swipe em px
        if (touchEndX < touchStartX - threshold) {
            nextSlide();
            startAutoplay();
        } else if (touchEndX > touchStartX + threshold) {
            prevSlide();
            startAutoplay();
        }
    }

    // Inicialização
    showSlide(0);
    startAutoplay();
});