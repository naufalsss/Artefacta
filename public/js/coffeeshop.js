document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll('.slide');
  let currentSlide = 0;

  setInterval(() => {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
  }, 4000);
});

document.addEventListener("DOMContentLoaded", () => {
    const reveals = document.querySelectorAll(
        ".hero-artifact, .concept-text, .connection-text, .artifact"
    );

    reveals.forEach(el => el.classList.add("reveal"));

    const observer = new IntersectionObserver(
        entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("active");
                }
            });
        },
        { threshold: 0.2 }
    );

    reveals.forEach(el => observer.observe(el));
});



