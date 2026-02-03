/* ============================================
   VAZUZA FISHERHOUSE - JavaScript
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {
    // Header scroll effect
    initHeader();

    // Mobile menu
    initBurger();

    // Smooth scroll
    initSmoothScroll();

    // Form handling
    initBookingForm();

    // Animations on scroll
    initScrollAnimations();

    // Set min date for booking
    initDateInputs();
});

/* ============================================
   HEADER
   ============================================ */
function initHeader() {
    const header = document.getElementById('header');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
}

/* ============================================
   BURGER MENU
   ============================================ */
function initBurger() {
    const burger = document.getElementById('burger');
    const nav = document.getElementById('nav');

    if (!burger || !nav) return;

    burger.addEventListener('click', () => {
        burger.classList.toggle('active');
        nav.classList.toggle('active');
        document.body.classList.toggle('menu-open');
    });

    // Close menu on link click
    nav.querySelectorAll('.nav__link').forEach(link => {
        link.addEventListener('click', () => {
            burger.classList.remove('active');
            nav.classList.remove('active');
            document.body.classList.remove('menu-open');
        });
    });
}

/* ============================================
   SMOOTH SCROLL
   ============================================ */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (!targetElement) return;

            const headerHeight = document.getElementById('header').offsetHeight;
            const targetPosition = targetElement.offsetTop - headerHeight - 20;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        });
    });
}

/* ============================================
   BOOKING FORM
   ============================================ */
function initBookingForm() {
    const form = document.getElementById('bookingForm');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;

        // Disable button and show loading
        submitBtn.disabled = true;
        submitBtn.textContent = 'Отправляем...';

        // Collect form data
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        try {
            // Here you would send to your backend
            // For now, simulate a delay
            await new Promise(resolve => setTimeout(resolve, 1500));

            // Success!
            showNotification('success', 'Заявка отправлена! Мы свяжемся с вами в ближайшее время.');
            form.reset();

        } catch (error) {
            showNotification('error', 'Произошла ошибка. Пожалуйста, попробуйте позже или позвоните нам.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }
    });
}

function initDateInputs() {
    const checkIn = document.getElementById('checkIn');
    const checkOut = document.getElementById('checkOut');

    if (!checkIn || !checkOut) return;

    // Set min date to today
    const today = new Date().toISOString().split('T')[0];
    checkIn.min = today;
    checkOut.min = today;

    // Update checkout min date when checkin changes
    checkIn.addEventListener('change', () => {
        const nextDay = new Date(checkIn.value);
        nextDay.setDate(nextDay.getDate() + 1);
        checkOut.min = nextDay.toISOString().split('T')[0];

        // If checkout is before checkin, reset it
        if (checkOut.value && checkOut.value <= checkIn.value) {
            checkOut.value = '';
        }
    });
}

/* ============================================
   NOTIFICATIONS
   ============================================ */
function showNotification(type, message) {
    // Remove existing notifications
    const existing = document.querySelector('.notification');
    if (existing) existing.remove();

    // Create notification
    const notification = document.createElement('div');
    notification.className = `notification notification--${type}`;
    notification.innerHTML = `
        <span class="notification__icon">${type === 'success' ? '✓' : '✕'}</span>
        <span class="notification__message">${message}</span>
        <button class="notification__close">&times;</button>
    `;

    // Add styles
    Object.assign(notification.style, {
        position: 'fixed',
        top: '100px',
        right: '20px',
        padding: '16px 24px',
        borderRadius: '12px',
        display: 'flex',
        alignItems: 'center',
        gap: '12px',
        zIndex: '9999',
        animation: 'slideIn 0.3s ease',
        backgroundColor: type === 'success' ? '#1a3d1a' : '#3d1a1a',
        border: `1px solid ${type === 'success' ? '#4ade80' : '#ff4a4a'}`,
        color: '#fff',
        boxShadow: '0 8px 30px rgba(0,0,0,0.3)'
    });

    document.body.appendChild(notification);

    // Close button
    notification.querySelector('.notification__close').addEventListener('click', () => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    });

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
}

// Add animation keyframes
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    /* Mobile nav styles */
    @media (max-width: 768px) {
        .nav.active {
            display: flex !important;
            flex-direction: column;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(10, 10, 10, 0.98);
            padding: 2rem;
            gap: 1.5rem;
            animation: fadeIn 0.3s ease;
        }
        
        .nav.active .nav__link {
            font-size: 1.25rem;
        }
        
        .burger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        
        .burger.active span:nth-child(2) {
            opacity: 0;
        }
        
        .burger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }
        
        body.menu-open {
            overflow: hidden;
        }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
`;
document.head.appendChild(style);

/* ============================================
   SCROLL ANIMATIONS
   ============================================ */
function initScrollAnimations() {
    const elements = document.querySelectorAll('.section__header, .amenity-card, .about__content, .about__image, .gallery__item, .booking__info, .booking__form-wrapper');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
                entry.target.style.opacity = '1';
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    elements.forEach(el => {
        el.style.opacity = '0';
        observer.observe(el);
    });
}

// Add fadeInUp animation
const animStyle = document.createElement('style');
animStyle.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(animStyle);

/* ============================================
   PHONE MASK (optional enhancement)
   ============================================ */
const phoneInput = document.getElementById('phone');
if (phoneInput) {
    phoneInput.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '');

        if (value.length > 0) {
            if (value[0] === '8') value = '7' + value.slice(1);
            if (value[0] !== '7') value = '7' + value;
        }

        let formatted = '';
        if (value.length > 0) formatted = '+' + value[0];
        if (value.length > 1) formatted += ' (' + value.slice(1, 4);
        if (value.length > 4) formatted += ') ' + value.slice(4, 7);
        if (value.length > 7) formatted += '-' + value.slice(7, 9);
        if (value.length > 9) formatted += '-' + value.slice(9, 11);

        e.target.value = formatted;
    });
}
