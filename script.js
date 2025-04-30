// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });
  
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
      }
    });
  });
  
  // Initialize carousel
  const myCarousel = new bootstrap.Carousel('#carouselTemoignages', {
    interval: 5000,
    wrap: true
  });
  
  // Animation on scroll
  function animateOnScroll() {
    const elements = document.querySelectorAll('.animate__animated');
    
    elements.forEach(element => {
      const elementPosition = element.getBoundingClientRect().top;
      const screenPosition = window.innerHeight / 1.2;
      
      if (elementPosition < screenPosition) {
        const animationClass = element.classList.item(1); // Get the animation class
        element.classList.add(animationClass);
      }
    });
  }
  
  window.addEventListener('load', animateOnScroll);
  window.addEventListener('scroll', animateOnScroll);
  
  // Floating labels enhancement
  document.querySelectorAll('.floating-label input, .floating-label select, .floating-label textarea').forEach(el => {
    el.addEventListener('focus', () => {
      el.parentNode.querySelector('label').style.color = '#2c7be5';
    });
    
    el.addEventListener('blur', () => {
      if (!el.value) {
        el.parentNode.querySelector('label').style.color = '#6c757d';
      }
    });
    
    // Initialize labels for prefilled values
    if (el.value) {
      el.parentNode.querySelector('label').style.top = '-10px';
      el.parentNode.querySelector('label').style.fontSize = '12px';
    }
  });
  