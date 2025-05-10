// Gestionnaire d'événements global
document.addEventListener('DOMContentLoaded', function() {
  // Navbar scroll effect
  const navbar = document.querySelector('.navbar');
  if (navbar) {
    window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
        dropdownMenu.classList.remove('show'); // Ferme le menu déroulant au scroll
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  }

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
        // Fermer le menu après clic sur un lien
        const dropdownMenu = document.getElementById('dropdownMenu');
        if (dropdownMenu) dropdownMenu.classList.remove('show');
      }
    });
  });

  // Initialize carousel
  const carousel = document.getElementById('carouselTemoignages');
  if (carousel) {
    new bootstrap.Carousel(carousel, {
      interval: 5000,
      wrap: true
    });
  }

  // Animation on scroll
  function animateOnScroll() {
    document.querySelectorAll('.animate__animated').forEach(element => {
      const elementPosition = element.getBoundingClientRect().top;
      if (elementPosition < window.innerHeight / 1.2) {
        const animationClass = element.classList.item(1);
        element.classList.add(animationClass);
      }
    });
  }
  window.addEventListener('load', animateOnScroll);
  window.addEventListener('scroll', animateOnScroll);

  // Floating labels enhancement
  document.querySelectorAll('.floating-label input, .floating-label select, .floating-label textarea').forEach(el => {
    const label = el.parentNode.querySelector('label');
    if (label) {
      el.addEventListener('focus', () => {
        label.style.color = '#2c7be5';
      });
      
      el.addEventListener('blur', () => {
        if (!el.value) label.style.color = '#6c757d';
      });
      
      if (el.value) {
        label.style.top = '-10px';
        label.style.fontSize = '12px';
      }
    }
  });

  // Gestion du menu profil améliorée
  const dropdownButton = document.getElementById('dropdownMenuButton');
  const dropdownMenu = document.getElementById('dropdownMenu');

  if (dropdownButton && dropdownMenu) {
    // Ouvrir/fermer le menu avec animation
    dropdownButton.addEventListener('click', function(e) {
      e.stopPropagation();
      dropdownMenu.classList.toggle('show');
      
      // Animation d'ouverture/fermeture
      if (dropdownMenu.classList.contains('show')) {
        dropdownMenu.style.display = 'block';
        dropdownMenu.style.opacity = '0';
        dropdownMenu.style.transform = 'translateY(-10px)';
        let opacity = 0;
        const fadeIn = setInterval(() => {
          opacity += 0.1;
          dropdownMenu.style.opacity = opacity;
          dropdownMenu.style.transform = `translateY(${-10 * (1 - opacity)}px)`;
          if (opacity >= 1) clearInterval(fadeIn);
        }, 20);
      } else {
        let opacity = 1;
        const fadeOut = setInterval(() => {
          opacity -= 0.1;
          dropdownMenu.style.opacity = opacity;
          dropdownMenu.style.transform = `translateY(${-10 * (1 - opacity)}px)`;
          if (opacity <= 0) {
            clearInterval(fadeOut);
            dropdownMenu.style.display = 'none';
          }
        }, 20);
      }
    });

    // Fermer le menu au clic ailleurs
    document.addEventListener('click', function() {
      if (dropdownMenu.classList.contains('show')) {
        let opacity = 1;
        const fadeOut = setInterval(() => {
          opacity -= 0.1;
          dropdownMenu.style.opacity = opacity;
          dropdownMenu.style.transform = `translateY(${-10 * (1 - opacity)}px)`;
          if (opacity <= 0) {
            clearInterval(fadeOut);
            dropdownMenu.style.display = 'none';
            dropdownMenu.classList.remove('show');
          }
        }, 20);
      }
    });
  }

  // Gestion des modales améliorée
  function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
      modal.style.display = 'block';
      document.body.style.overflow = 'hidden'; // Empêche le scroll
    }
  }

  function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
      modal.style.display = 'none';
      document.body.style.overflow = ''; // Rétablit le scroll
    }
  }

  // Fermer la modale en cliquant à l'extérieur ou sur ESC
  window.onclick = function(event) {
    ['loginModal', 'signupModal'].forEach(id => {
      const modal = document.getElementById(id);
      if (modal && event.target === modal) {
        closeModal(id);
      }
    });
  };

  document.onkeydown = function(e) {
    e = e || window.event;
    if (e.key === 'Escape') {
      ['loginModal', 'signupModal'].forEach(id => {
        const modal = document.getElementById(id);
        if (modal && modal.style.display === 'block') {
          closeModal(id);
        }
      });
    }
  };
});