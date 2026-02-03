<!-- index.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Дом у воды Хлепень | Вазузское водохранилище</title>

<!-- FAVICONS (все файлы должны лежать рядом с index.php) -->
<link rel="icon" href="favicon.ico" sizes="any">
<link rel="icon" type="image/svg+xml" href="favicon.svg" sizes="any">
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32.png">
<meta name="theme-color" content="#0b2d3a">

<style>
*{margin:0;padding:0;box-sizing:border-box}

/* ─────────────────────────────────────────────────────────
   THEME / VARIABLES
───────────────────────────────────────────────────────── */
:root{
  --primary:#1b4d6b;
  --primary-2:#0b2d3a;
  --accent:#67d1ff;
  --accent-2:#8ef3ff;

  --text:#0b1b24;
  --muted:#4b6472;
  --card:#ffffff;
  --card2:#f7fbff;
  --border:rgba(27,77,107,0.18);

  --shadow:0 12px 34px rgba(0,0,0,0.12);
  --shadow2:0 18px 60px rgba(0,0,0,0.18);

  --gradient:linear-gradient(135deg,#0b2d3a,#1b4d6b 45%,#1b6f91);
  --heroOverlay:linear-gradient(rgba(3,18,26,0.50),rgba(3,18,26,0.60));
  --btnGrad:linear-gradient(135deg,#2b9cff,#67d1ff);
  --btnGrad2:linear-gradient(135deg,#0e3d55,#1b4d6b);
  --focusGlow:0 0 0 4px rgba(103,209,255,0.22);
}

body{
  /* Фолбэк для emoji/символов (исправляет квадраты вместо 🌳/₽ и т.п.) */
  font-family:'Segoe UI','Segoe UI Emoji','Segoe UI Symbol','Apple Color Emoji','Noto Color Emoji',sans-serif;
  line-height:1.6;
  color:var(--text);
  overflow-x:hidden;
  cursor:auto;
  background:linear-gradient(180deg,#f9fcff,#f3fbff 40%,#ffffff);
}

/* ─────────────────────────────────────────────────────────
   SERVICE UI
───────────────────────────────────────────────────────── */
.copy-notification{
  position:fixed;top:20px;right:20px;
  background:linear-gradient(135deg,#2fdc88,#1bbf78);
  color:white;padding:14px 20px;border-radius:12px;
  box-shadow:0 12px 30px rgba(0,0,0,0.22);
  z-index:10001;opacity:0;transform:translateY(-18px);
  transition:all .25s;pointer-events:none;font-weight:800
}
.copy-notification.show{opacity:1;transform:translateY(0)}

.loading-overlay{
  position:fixed;inset:0;background:rgba(0,0,0,0.75);
  display:none;align-items:center;justify-content:center;
  z-index:10000
}
.loading-overlay.active{display:flex}
.loading-content{text-align:center;color:white}
.spinner{
  width:60px;height:60px;border:4px solid rgba(255,255,255,0.3);
  border-top-color:white;border-radius:50%;
  animation:spin 1s linear infinite;margin:0 auto 18px
}
@keyframes spin{to{transform:rotate(360deg)}}

/* ─────────────────────────────────────────────────────────
   NAV
───────────────────────────────────────────────────────── */
nav{
  position:fixed;top:0;width:100%;
  padding:18px 50px;
  background:rgba(11,45,58,0.92);
  backdrop-filter:blur(10px);
  z-index:1000;border-bottom:1px solid rgba(255,255,255,0.06)
}
.nav-container{max-width:1400px;margin:0 auto;display:flex;justify-content:space-between;align-items:center}
.logo{
  font-size:1.45rem;font-weight:900;color:white;letter-spacing:0.2px;
  display:flex;align-items:center;gap:10px
}
.logo-badge{
  display:inline-flex;align-items:center;justify-content:center;
  width:34px;height:34px;border-radius:12px;
  background:rgba(255,255,255,0.10);
  border:1px solid rgba(255,255,255,0.16)
}
.logo-title{display:inline-flex;align-items:center;gap:6px}
.logo-title span{opacity:0.92}
.nav-links{display:flex;gap:26px;list-style:none}
.nav-links a{
  color:rgba(255,255,255,0.92);text-decoration:none;transition:color .2s;
  cursor:pointer;font-weight:700
}
.nav-links a:hover{color:var(--accent)}

/* ─────────────────────────────────────────────────────────
   HERO
───────────────────────────────────────────────────────── */
.hero{
  min-height:100vh;display:flex;align-items:center;
  padding:8rem 5% 4rem;background:var(--gradient);
  position:relative;overflow:hidden
}
.hero::before{content:'';position:absolute;inset:0;background:var(--heroOverlay)}
.hero-container{max-width:1400px;margin:0 auto;position:relative;z-index:2;text-align:center}
.hero-content h1{
  font-size:clamp(2.55rem,5vw,4.05rem);
  color:white;margin-bottom:18px;
  text-shadow:0 14px 35px rgba(0,0,0,0.35)
}
.hero-subtitle{
  font-size:clamp(1.15rem,2vw,1.5rem);
  color:rgba(255,255,255,0.92);
  margin-bottom:30px
}
.hero-features{display:flex;gap:22px;justify-content:center;margin-bottom:40px;flex-wrap:wrap;color:white}
.hero-feature{display:flex;align-items:center;gap:8px;font-size:1.05rem;font-weight:700}
.hero-feature::before{
  content:"✓";display:inline-block;width:24px;height:24px;
  background:rgba(103,209,255,0.95);
  color:#003245;border-radius:50%;
  text-align:center;line-height:24px;font-weight:1000
}
.cta-buttons{display:flex;gap:16px;justify-content:center;flex-wrap:wrap}

/* нижняя волна */
.water-effect{
  position:absolute;bottom:0;left:0;right:0;height:130px;
  background:
    url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 160"><path fill="rgba(255,255,255,0.14)" d="M0,80 Q240,40 480,80 T960,80 T1440,80 L1440,160 L0,160 Z"/><path fill="rgba(103,209,255,0.10)" d="M0,110 Q260,80 520,110 T1040,110 T1560,110 L1560,160 L0,160 Z"/></svg>');
  background-size:1200px 160px;
  animation:wave 10s linear infinite;
  z-index:1;pointer-events:none
}
@keyframes wave{0%{background-position:0 0}100%{background-position:1200px 0}}

/* ─────────────────────────────────────────────────────────
   SECTIONS / CARDS
───────────────────────────────────────────────────────── */
section{padding:80px 5%;max-width:1400px;margin:0 auto}
.section-title{
  font-size:clamp(2rem,4vw,3rem);
  text-align:center;margin-bottom:18px;color:var(--primary);
  letter-spacing:0.2px
}
.section-subtitle{text-align:center;font-size:1.15rem;color:var(--muted);margin-bottom:56px}

.features-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:26px}
.feature-card{
  background:linear-gradient(180deg,var(--card),var(--card2));
  padding:38px 30px;border-radius:22px;
  box-shadow:var(--shadow);
  text-align:center;transition:all .28s;
  border:1px solid var(--border);
  position:relative;overflow:hidden
}
.feature-card::after{
  content:"";position:absolute;inset:-2px;
  background:radial-gradient(closest-side, rgba(103,209,255,0.22), transparent 65%);
  opacity:0;transition:opacity .28s
}
.feature-card:hover{
  transform:translateY(-10px);
  box-shadow:var(--shadow2);
  border-color:rgba(43,156,255,0.35)
}
.feature-card:hover::after{opacity:1}
.feature-icon{font-size:3rem;margin-bottom:18px;display:block}
.feature-card h3{font-size:1.5rem;margin-bottom:12px;color:var(--primary);font-weight:900}

/* ─────────────────────────────────────────────────────────
   BUTTONS
───────────────────────────────────────────────────────── */
.btn{
  padding:14px 36px;font-size:1.05rem;border:none;border-radius:999px;
  cursor:pointer;transition:all .25s;text-decoration:none;display:inline-block;
  font-weight:900;letter-spacing:0.15px
}
.btn-primary{
  background:var(--btnGrad);
  color:#062231;
  box-shadow:0 14px 30px rgba(43,156,255,0.28);
  border:1px solid rgba(255,255,255,0.25)
}
.btn-primary:hover{transform:translateY(-4px) scale(1.03);box-shadow:0 18px 40px rgba(43,156,255,0.35)}
.btn-secondary{
  background:transparent;color:white;border:2px solid rgba(255,255,255,0.85)
}
.btn-secondary:hover{background:rgba(255,255,255,0.95);color:#062231}

/* ─────────────────────────────────────────────────────────
   GALLERY
───────────────────────────────────────────────────────── */
.gallery{background:linear-gradient(180deg,#f1f9ff,#ffffff)}
.gallery-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(350px,1fr));gap:18px}
.gallery-item{
  position:relative;overflow:hidden;border-radius:18px;height:310px;
  cursor:pointer;transition:all .28s;background-size:cover;background-position:center;
  background-color:#dfeaf3;
  border:2px solid rgba(43,156,255,0.22);
  box-shadow:0 14px 34px rgba(0,0,0,0.14)
}
.gallery-item::before{
  content:"";position:absolute;inset:10px;border-radius:14px;
  border:1px solid rgba(255,255,255,0.55);
  box-shadow:inset 0 0 0 1px rgba(11,45,58,0.18);
  pointer-events:none
}
.gallery-item:hover{
  transform:translateY(-6px) scale(1.02);
  box-shadow:0 22px 54px rgba(0,0,0,0.22);
  border-color:rgba(43,156,255,0.45)
}
.gallery-item::after{
  content:attr(data-title);
  position:absolute;bottom:0;left:0;right:0;padding:18px 18px 16px;
  background:linear-gradient(to top,rgba(0,0,0,0.78),transparent);
  color:white;font-size:1.15rem;font-weight:900;letter-spacing:0.2px
}

/* ─────────────────────────────────────────────────────────
   BOOKING
───────────────────────────────────────────────────────── */
.booking-section{background:linear-gradient(135deg,#f3fbff,#e8f6ff);padding:80px 5%}
.booking-container{
  max-width:920px;margin:0 auto;
  background:linear-gradient(180deg,#ffffff,#f7fbff);
  border-radius:24px;padding:42px;
  box-shadow:var(--shadow2);
  border:1px solid rgba(43,156,255,0.16)
}
.booking-steps{display:flex;justify-content:space-between;margin-bottom:36px;position:relative}
.booking-steps::before{content:'';position:absolute;top:25px;left:10%;right:10%;height:2px;background:rgba(11,45,58,0.12);z-index:0}
.booking-step{text-align:center;flex:1;position:relative;z-index:1}
.step-circle{
  width:50px;height:50px;border-radius:50%;
  background:rgba(11,45,58,0.10);
  margin:0 auto 10px;display:flex;align-items:center;justify-content:center;
  font-weight:1000;transition:all .25s;color:var(--primary)
}
.step-circle.active{
  background:var(--btnGrad);
  color:#05202c;box-shadow:0 0 0 6px rgba(103,209,255,0.16)
}
.step-circle.completed{background:linear-gradient(135deg,#2fdc88,#1bbf78);color:white}
.step-label{font-size:0.92rem;color:var(--muted);font-weight:800}

.calendar-container{display:grid;grid-template-columns:1fr 1fr;gap:26px;margin-bottom:24px}
.calendar{
  background:linear-gradient(180deg,#ffffff,#f6fbff);
  padding:20px;border-radius:18px;
  border:1px solid rgba(43,156,255,0.16);
  box-shadow:0 12px 26px rgba(0,0,0,0.07)
}
.calendar-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px}
.calendar-title{font-size:1.15rem;font-weight:1000;color:#1a2f3a}
.calendar-nav{
  background:var(--btnGrad2);color:white;border:none;
  width:38px;height:38px;border-radius:50%;
  cursor:pointer;font-size:1.25rem;transition:all .2s;
  box-shadow:0 10px 18px rgba(0,0,0,0.18)
}
.calendar-nav:hover{transform:scale(1.08);filter:brightness(1.1)}
.calendar-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:5px}
.weekday-header{text-align:center;font-weight:900;font-size:0.8rem;color:#5c7a8b;padding:5px}

.calendar-day{
  padding:10px;text-align:center;border-radius:10px;
  cursor:pointer;transition:all .2s;font-size:0.9rem;
  font-weight:800;color:#1b2f3a;
  background:rgba(11,45,58,0.03);
  border:1px solid rgba(43,156,255,0.10)
}
.calendar-day.disabled{
  color:#b9c9d2;cursor:not-allowed;background:rgba(11,45,58,0.02);
  border-color:rgba(11,45,58,0.06)
}

/* ЗАНЯТО (не оплачено) */
.calendar-day.booked{
  background:linear-gradient(135deg,#ffe5e9,#ffd0d7);
  color:#9c1831;
  border-color:rgba(156,24,49,0.18)
}
.calendar-day.booked::after{
  content:'✕';position:absolute;top:2px;right:6px;font-size:0.75rem
}

/* ОПЛАЧЕНО */
.calendar-day.paid{
  background:linear-gradient(135deg,#d9fff2,#b7ffe9);
  color:#0a6b4a;
  border-color:rgba(10,107,74,0.18)
}
.calendar-day.paid::after{
  content:'✓';position:absolute;top:2px;right:6px;font-size:0.75rem
}

/* чтобы ::after работал */
.calendar-day.booked,
.calendar-day.paid{position:relative}

/* дата занята, но может быть выбрана как "дата выезда" */
.calendar-day.can-checkout{
  cursor:pointer;
  outline:2px dashed rgba(43,156,255,0.35);
  outline-offset:0;
}

.calendar-day:not(.disabled):hover{
  background:rgba(103,209,255,0.18);
  transform:scale(1.05);
  border-color:rgba(43,156,255,0.26)
}
.calendar-day.selected{
  background:var(--btnGrad) !important;
  color:#05202c !important;
  font-weight:1000 !important;
  outline:none !important;
}
.calendar-day.in-range{background:rgba(43,156,255,0.14)}

.booking-summary{
  background:linear-gradient(135deg,#0e3d55,#1b4d6b);
  color:white;padding:24px;border-radius:18px;margin-bottom:18px;
  border:1px solid rgba(255,255,255,0.10);
  box-shadow:0 16px 36px rgba(0,0,0,0.18)
}
.summary-row{display:flex;justify-content:space-between;margin-bottom:12px;font-size:1.05rem;font-weight:800}
.summary-total{font-size:1.7rem;font-weight:1100;border-top:1px solid rgba(255,255,255,0.22);padding-top:14px;margin-top:12px}

.form-group{margin-bottom:18px}
.form-group label{display:block;margin-bottom:8px;font-weight:900;color:#153241}
.form-group input,.form-group textarea{
  width:100%;padding:12px 14px;border:2px solid rgba(43,156,255,0.14);
  border-radius:14px;font-size:1rem;transition:all .2s;font-family:inherit;
  background:linear-gradient(180deg,#ffffff,#f6fbff);
  box-shadow:0 10px 18px rgba(0,0,0,0.05)
}
.form-group textarea{resize:vertical;min-height:88px}
.form-group input:focus,.form-group textarea:focus{
  outline:none;border-color:rgba(43,156,255,0.55);
  box-shadow:var(--focusGlow),0 12px 22px rgba(0,0,0,0.07)
}

.field-error{
  margin-top:8px;
  color:#b42318;
  font-weight:900;
  font-size:0.92rem;
  display:none;
}
.field-error.show{display:block}

.booking-nav-buttons{display:flex;gap:12px;margin-top:26px}
.booking-nav-buttons button{
  flex:1;padding:14px;border:none;border-radius:14px;font-size:1.05rem;
  font-weight:1000;cursor:pointer;transition:all .2s
}
.btn-back{
  background:linear-gradient(180deg,#ffffff,#f2f7fb);
  color:#143241;border:1px solid rgba(11,45,58,0.12)
}
.btn-back:hover{transform:translateY(-2px);box-shadow:0 14px 26px rgba(0,0,0,0.08)}
.btn-next{
  background:var(--btnGrad);color:#05202c;border:1px solid rgba(255,255,255,0.26)
}
.btn-next:hover{transform:translateY(-2px);box-shadow:0 18px 36px rgba(43,156,255,0.28)}
.btn-next:disabled{background:rgba(11,45,58,0.12);cursor:not-allowed;color:rgba(11,45,58,0.45);box-shadow:none}

.confirm-button{
  width:100%;padding:16px;background:linear-gradient(135deg,#2fdc88,#1bbf78);
  color:white;border:none;border-radius:14px;font-size:1.15rem;font-weight:1100;
  cursor:pointer;transition:all .2s;box-shadow:0 18px 34px rgba(47,220,136,0.22)
}
.confirm-button:hover{transform:translateY(-2px);box-shadow:0 22px 44px rgba(47,220,136,0.30)}
.confirm-button:disabled{background:rgba(11,45,58,0.12);cursor:not-allowed;color:rgba(11,45,58,0.45);box-shadow:none}

.pay-button{
  width:100%;padding:16px;background:linear-gradient(135deg,#ffd54f,#ffb300);
  color:#2a1c00;border:none;border-radius:14px;font-size:1.15rem;font-weight:1100;
  cursor:pointer;transition:all .2s;box-shadow:0 18px 34px rgba(255,179,0,0.22)
}
.pay-button:hover{transform:translateY(-2px);box-shadow:0 22px 44px rgba(255,179,0,0.28)}
.pay-button:disabled{background:rgba(11,45,58,0.12);cursor:not-allowed;color:rgba(11,45,58,0.45);box-shadow:none}

.success-message{
  background:linear-gradient(135deg,#2fdc88,#1bbf78);
  color:white;padding:28px;border-radius:18px;text-align:center;display:none;
  box-shadow:0 18px 44px rgba(0,0,0,0.18)
}
.success-message.show{display:block}
.success-message h3{font-size:1.9rem;margin-bottom:12px}
.success-message p{font-size:1.05rem;line-height:1.8}

/* ─────────────────────────────────────────────────────────
   MAP / LOCATION
───────────────────────────────────────────────────────── */
.map-section{padding:0;margin-top:80px}
.map-container{display:grid;grid-template-columns:1fr 1fr;min-height:520px}
.map-info{padding:58px;background:linear-gradient(180deg,#f2faff,#ffffff)}
.map-info h2{font-size:2.35rem;color:var(--primary);margin-bottom:26px;font-weight:1100}
.location-item{
  display:flex;align-items:center;margin-bottom:14px;font-size:1.05rem;
  padding:12px 14px;background:linear-gradient(180deg,#ffffff,#f6fbff);
  border-radius:14px;cursor:pointer;transition:all .2s;
  border:1px solid rgba(43,156,255,0.14);
  box-shadow:0 12px 22px rgba(0,0,0,0.06);
  font-weight:800;color:#123040
}
.location-item:hover{transform:translateX(5px);box-shadow:0 18px 36px rgba(0,0,0,0.10)}
.location-item::before{content:"📍";margin-right:12px;font-size:1.25rem}

.map-buttons{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:22px}
.map-btn{
  padding:12px 14px;font-size:0.95rem;border:1px solid rgba(43,156,255,0.20);
  background:var(--btnGrad);color:#05202c;border-radius:14px;cursor:pointer;
  transition:all .2s;font-weight:1000;text-decoration:none;display:inline-block;text-align:center;
  box-shadow:0 14px 26px rgba(43,156,255,0.22)
}
.map-btn:hover{transform:translateY(-2px);filter:brightness(1.05)}
#map{width:100%;height:100%;min-height:520px}

/* ─────────────────────────────────────────────────────────
   FOOTER + DOCS
───────────────────────────────────────────────────────── */
footer{
  background:linear-gradient(180deg,#071e28,#04141b);
  color:white;padding:60px 5% 30px
}
.footer-content{
  max-width:1200px;margin:0 auto;
  display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
  gap:38px;margin-bottom:34px
}
.footer-column h4{margin-bottom:18px;color:var(--accent);font-size:1.18rem;font-weight:1000}
.footer-column ul{list-style:none}
.footer-column li{margin-bottom:11px}
.footer-column a{color:rgba(255,255,255,0.82);text-decoration:none;transition:color .2s;cursor:pointer;font-weight:700}
.footer-column a:hover{color:var(--accent-2)}
.footer-bottom{text-align:center;padding-top:26px;border-top:1px solid rgba(255,255,255,0.10);color:rgba(255,255,255,0.68)}

.doc-links{display:flex;flex-direction:column;gap:10px;margin-top:10px}
.doc-link{
  display:inline-flex;align-items:center;gap:10px;
  padding:0;border:none;background:transparent;box-shadow:none;
  color:rgba(255,255,255,0.86);
  font-weight:900;cursor:pointer;transition:color .2s, transform .2s;
  text-decoration:none
}
.doc-link:hover{color:var(--accent-2);transform:translateX(2px)}
.doc-link:active{transform:translateX(0)}
.doc-emoji{width:22px;text-align:center}

/* ─────────────────────────────────────────────────────────
   MODAL DOCS
───────────────────────────────────────────────────────── */
.modal-overlay{
  position:fixed;inset:0;background:rgba(0,0,0,0.70);
  display:none;align-items:center;justify-content:center;
  z-index:11000;padding:18px
}
.modal-overlay.show{display:flex}
.modal{
  width:min(980px,95vw);
  max-height:85vh;
  background:linear-gradient(180deg,#ffffff,#f7fbff);
  border-radius:18px;
  border:1px solid rgba(43,156,255,0.18);
  box-shadow:0 26px 90px rgba(0,0,0,0.35);
  overflow:hidden;
}
.modal-header{
  display:flex;align-items:center;justify-content:space-between;
  padding:16px 18px;
  background:linear-gradient(135deg,#0e3d55,#1b4d6b);
  color:white
}
.modal-title{font-weight:1100;font-size:1.05rem;letter-spacing:0.2px}
.modal-close{
  border:none;background:rgba(255,255,255,0.14);color:white;
  width:36px;height:36px;border-radius:10px;cursor:pointer;font-size:18px;font-weight:1100;
  transition:all .2s
}
.modal-close:hover{background:rgba(255,255,255,0.22);transform:scale(1.03)}
.modal-body{
  padding:18px 18px 20px;
  overflow:auto;
  color:#0b1b24
}
.modal-body h3{margin:12px 0 10px;color:#0e3d55;font-weight:1100}
.modal-body p{margin:10px 0;color:#2a4655}
.modal-body ul{margin:10px 0 10px 20px}
.modal-body li{margin:6px 0}

/* ─────────────────────────────────────────────────────────
   MOBILE
───────────────────────────────────────────────────────── */
@media (max-width:768px){
  .calendar-container{grid-template-columns:1fr}
  .nav-links{display:none}
  body{cursor:auto!important}
}
</style>
</head>

<body class="winter-theme">
<div class="copy-notification" id="copyNotification">✓ Скопировано!</div>

<div class="loading-overlay" id="loadingOverlay">
  <div class="loading-content">
    <div class="spinner"></div>
    <div style="font-size:1.2rem;font-weight:900">Обработка...</div>
  </div>
</div>

<nav>
  <div class="nav-container">
    <div class="logo">
      <span class="logo-badge">🎄</span>
      <span class="logo-title">Дом у воды <span>❄️</span></span>
    </div>
    <ul class="nav-links">
      <li><a onclick="scrollToSection('features')">О доме</a></li>
      <li><a onclick="scrollToSection('gallery')">Галерея</a></li>
      <li><a onclick="scrollToSection('booking')">Бронирование</a></li>
      <li><a onclick="scrollToSection('location')">Как добраться</a></li>
    </ul>
  </div>
</nav>

<section class="hero">
  <div class="hero-container">
    <div class="hero-content">
      <h1>Дом у воды на Вазузском водохранилище</h1>
      <p class="hero-subtitle">Премиум отдых для рыбаков и охотников в 220 км от Москвы</p>

      <div class="hero-features">
        <div class="hero-feature">130 м² комфорта</div>
        <div class="hero-feature">Прямой выход к воде</div>
        <div class="hero-feature">Баня-бочка</div>
        <div class="hero-feature">До 8 гостей</div>
      </div>

      <div class="cta-buttons">
        <button class="btn btn-primary" onclick="scrollToSection('booking')">Забронировать</button>
        <button class="btn btn-secondary" onclick="scrollToSection('gallery')">Смотреть фото</button>
      </div>
    </div>
  </div>
  <div class="water-effect"></div>
</section>

<section id="features">
  <h2 class="section-title">Всё для идеального отдыха</h2>
  <p class="section-subtitle">Мы продумали каждую деталь вашего комфорта</p>

  <div class="features-grid">
    <div class="feature-card">
      <span class="feature-icon">🎣</span>
      <h3>Рыбалка мечты</h3>
      <p>Щука, судак, лещ круглый год</p>
    </div>
    <div class="feature-card">
      <span class="feature-icon">🏡</span>
      <h3>Современный дом</h3>
      <p>3 спальни, 2 санузла, кухня</p>
    </div>
    <div class="feature-card">
      <span class="feature-icon">♨️</span>
      <h3>Баня-бочка</h3>
      <p>На 6 человек с видом на воду</p>
    </div>
    <div class="feature-card">
      <span class="feature-icon">⚓</span>
      <h3>Причал</h3>
      <p>Спуск к воде, причал для лодок</p>
    </div>
    <div class="feature-card">
      <span class="feature-icon">🔥</span>
      <h3>Барбекю</h3>
      <p>Беседка, мангал, коптильня</p>
    </div>
    <div class="feature-card">
      <span class="feature-icon">🌳</span>
      <h3>Уединение</h3>
      <p>Природа и тишина</p>
    </div>
  </div>
</section>

<section id="booking" class="booking-section">
  <div class="booking-container">
    <h2 class="section-title" style="margin-bottom:10px">Бронирование</h2>
    <p class="section-subtitle" style="margin-bottom:36px">Выберите даты и оформите бронь</p>

    <div class="booking-steps">
      <div class="booking-step">
        <div class="step-circle active" id="step1Circle">1</div>
        <div class="step-label">Даты</div>
      </div>
      <div class="booking-step">
        <div class="step-circle" id="step2Circle">2</div>
        <div class="step-label">Контакты</div>
      </div>
      <div class="booking-step">
        <div class="step-circle" id="step3Circle">3</div>
        <div class="step-label">Финиш</div>
      </div>
    </div>

    <div id="bookingStep1">
      <div class="calendar-container">
        <div class="calendar">
          <div class="calendar-header">
            <button class="calendar-nav" onclick="changeMonth(-1)">‹</button>
            <div class="calendar-title" id="calendarTitle">Январь 2026</div>
            <button class="calendar-nav" onclick="changeMonth(1)">›</button>
          </div>

          <div class="calendar-grid">
            <div class="weekday-header">Пн</div>
            <div class="weekday-header">Вт</div>
            <div class="weekday-header">Ср</div>
            <div class="weekday-header">Чт</div>
            <div class="weekday-header">Пт</div>
            <div class="weekday-header">Сб</div>
            <div class="weekday-header">Вс</div>
          </div>
          <div class="calendar-grid" id="calendarDays"></div>
        </div>

        <div>
          <div class="booking-summary" id="bookingSummary" style="display:none">
            <div class="summary-row">
              <span>Заезд:</span>
              <span id="checkInDate">-</span>
            </div>
            <div class="summary-row">
              <span>Выезд:</span>
              <span id="checkOutDate">-</span>
            </div>
            <div class="summary-row">
              <span>Ночей:</span>
              <span id="nightsCount">0</span>
            </div>
            <div class="summary-total">
              <div class="summary-row" style="margin:0">
                <span>Итого:</span>
                <span id="totalPrice">0&#8381;</span>
              </div>
            </div>
          </div>

          <div style="margin-top:16px;padding:16px;border-radius:18px;background:linear-gradient(180deg,#ffffff,#f6fbff);border:1px solid rgba(43,156,255,0.14);box-shadow:0 12px 22px rgba(0,0,0,0.06)">
            <h4 style="margin-bottom:10px;color:#123040;font-weight:1100">Информация о ценах</h4>
            <div style="margin-bottom:8px"><strong>Будни:</strong> 7 500&#8381;/сутки</div>
            <div style="margin-bottom:8px"><strong>Выходные:</strong> 10 000&#8381;/сутки</div>
            <div style="margin-bottom:8px"><strong>Минимум:</strong> 2 ночи</div>
          </div>

          <div class="booking-nav-buttons">
            <button class="btn-next" onclick="goToStep(2)" id="step1Next" disabled>Далее →</button>
          </div>
        </div>
      </div>
    </div>

    <div id="bookingStep2" style="display:none">
      <div class="form-group">
        <label>Имя и Фамилия *</label>
        <input type="text" id="guestName" placeholder="Иван Иванов" required>
        <div class="field-error" id="errName"></div>
      </div>
      <div class="form-group">
        <label>Телефон *</label>
        <input type="tel" id="guestPhone" placeholder="+7 (999) 123-45-67" required>
        <div class="field-error" id="errPhone"></div>
      </div>
      <div class="form-group">
        <label>Email *</label>
        <input type="email" id="guestEmail" placeholder="example@mail.ru" required>
        <div class="field-error" id="errEmail"></div>
      </div>
      <div class="form-group">
        <label>Количество гостей *</label>
        <input type="number" id="guestCount" min="1" max="8" value="2" required>
        <div class="field-error" id="errGuests"></div>
      </div>
      <div class="form-group">
        <label>Комментарий</label>
        <textarea id="guestComment" placeholder="Например: нужна детская кроватка, планируем с лодкой и т.д."></textarea>
      </div>

      <div class="booking-nav-buttons">
        <button class="btn-back" onclick="goToStep(1)">← Назад</button>
        <button class="btn-next" onclick="goToStep(3)" id="step2Next">Далее →</button>
      </div>
    </div>

    <div id="bookingStep3" style="display:none">
      <div class="booking-summary">
        <div class="summary-row">
          <span>Период:</span>
          <span id="finalDates">-</span>
        </div>
        <div class="summary-row">
          <span>Гостей:</span>
          <span id="finalGuests">-</span>
        </div>
        <div class="summary-total">
          <div class="summary-row" style="margin:0">
            <span>К оплате:</span>
            <span id="finalTotal">0&#8381;</span>
          </div>
        </div>
      </div>

      <button class="pay-button" onclick="payAndConfirm()" id="payBtn">Оплатить и подтвердить</button>
      <div style="height:10px"></div>
      <button class="confirm-button" onclick="sendRequest()" id="requestBtn">Отправить заявку (ожидает подтверждения)</button>

      <div style="text-align:center;color:#56707f;font-size:0.95rem;margin-top:18px;font-weight:800">
        Оплаченная бронь — подтверждается сразу. Неоплаченная — попадёт в очередь и будет подтверждена после проверки.
      </div>

      <div class="booking-nav-buttons">
        <button class="btn-back" onclick="goToStep(2)">← Назад</button>
      </div>

      <div class="success-message" id="successMessage" style="margin-top:18px">
        <h3>🎉 Готово!</h3>
        <p id="successText">Заявка отправлена.</p>
      </div>
    </div>

  </div>
</section>

<section id="gallery" class="gallery">
  <h2 class="section-title">Фотогалерея</h2>
  <p class="section-subtitle">12 фото (подписи временные)</p>
  <div class="gallery-grid">
    <div class="gallery-item" data-title="Фото 1" style="background-image:url('photos/1.jpg')"></div>
    <div class="gallery-item" data-title="Фото 2" style="background-image:url('photos/2.jpg')"></div>
    <div class="gallery-item" data-title="Фото 3" style="background-image:url('photos/3.jpg')"></div>
    <div class="gallery-item" data-title="Фото 4" style="background-image:url('photos/4.jpg')"></div>
    <div class="gallery-item" data-title="Фото 5" style="background-image:url('photos/5.jpg')"></div>
    <div class="gallery-item" data-title="Фото 6" style="background-image:url('photos/6.jpg')"></div>
    <div class="gallery-item" data-title="Фото 7" style="background-image:url('photos/7.jpg')"></div>
    <div class="gallery-item" data-title="Фото 8" style="background-image:url('photos/8.jpg')"></div>
    <div class="gallery-item" data-title="Фото 9" style="background-image:url('photos/9.jpg')"></div>
    <div class="gallery-item" data-title="Фото 10" style="background-image:url('photos/10.jpg')"></div>
    <div class="gallery-item" data-title="Фото 11" style="background-image:url('photos/11.jpg')"></div>
    <div class="gallery-item" data-title="Фото 12" style="background-image:url('photos/12.jpg')"></div>
  </div>
</section>

<section id="location" class="map-section">
  <div class="map-container">
    <div class="map-info">
      <h2>Как добраться</h2>

      <div class="location-item" onclick="copyText('деревня Хлепень, Сычёвский район, Смоленская область, Россия')">
        деревня Хлепень, Сычёвский р-н, Смоленская обл.
      </div>
      <div class="location-item" onclick="copyText('220 км от Москвы по Новорижскому шоссе, 3.5 часа на автомобиле. 17 км от г. Сычёвка')">
        220 км от Москвы • 17 км от г. Сычёвка
      </div>
      <div class="location-item" onclick="copyText('55.96231083712601, 34.46818181000816')">
        55.96231, 34.46818
      </div>

      <div class="map-buttons">
        <a href="yandexnavi://build_route_on_map?lat_to=55.96231&lon_to=34.46818" class="map-btn">🚗 Яндекс Навигатор</a>
        <a href="dgis://2gis.ru/routeSearch/rsType/car/to/34.46818,55.96231" class="map-btn">🚗 2ГИС</a>
        <button class="map-btn" onclick="shareLocation()">📤 Поделиться</button>
        <button class="map-btn" onclick="copyText('деревня Хлепень, 55.96231, 34.46818')">📋 Копировать</button>
      </div>
    </div>

    <div id="map"></div>
  </div>
</section>

<footer id="docs">
  <div class="footer-content">

    <div class="footer-column">
      <h4>Контакты</h4>
      <ul>
        <li>📞 <a href="tel:+79964159405">+7 (996) 415-94-05</a></li>
        <li>📧 <a href="mailto:sales@vazuza-fisherhouse.ru">sales@vazuza-fisherhouse.ru</a></li>
        <li>📍 д. Хлепень, Смоленская обл.</li>
        <li>🌐 <a href="/" id="siteLinkFooter">vazuza-fisherhouse.ru</a></li>
      </ul>
    </div>

    <div class="footer-column">
      <h4>Документы</h4>
      <div class="doc-links">
        <a class="doc-link" onclick="openDoc('offer')"><span class="doc-emoji">📄</span>Оферта</a>
        <a class="doc-link" onclick="openDoc('privacy')"><span class="doc-emoji">🔒</span>Конфиденциальность</a>
        <a class="doc-link" onclick="openDoc('rules')"><span class="doc-emoji">🏡</span>Правила проживания</a>
        <a class="doc-link" onclick="openDoc('agreement')"><span class="doc-emoji">🧾</span>Соглашение</a>
      </div>
    </div>

    <div class="footer-column">
      <h4>Информация</h4>
      <ul>
        <li>Арендодатель: Емельянов Е.Ю.</li>
        <li>ИНН: 504409892030</li>
        <li>Режим работы: 24/7</li>
        <li>Заезд: с 14:00</li>
      </ul>
    </div>

    <div class="footer-column">
      <h4>Мы в соцсетях</h4>
      <ul>
        <li><a href="#">Telegram</a></li>
        <li><a href="#">WhatsApp</a></li>
        <li><a href="#">VK</a></li>
        <li><a href="#">Instagram</a></li>
      </ul>
    </div>

  </div>

  <div class="footer-bottom">
    <p>&copy; 2026 Дом у воды Хлепень. Все права защищены.</p>
    <p style="margin-top:10px">Емельянов Евгений Юрьевич, ИНН 504409892030</p>
  </div>
</footer>

<!-- MODAL DOCS -->
<div class="modal-overlay" id="docModal">
  <div class="modal" role="dialog" aria-modal="true">
    <div class="modal-header">
      <div class="modal-title" id="docTitle">Документ</div>
      <button class="modal-close" onclick="closeDoc()" aria-label="Закрыть">×</button>
    </div>
    <div class="modal-body" id="docBody"></div>
  </div>
</div>

<script src="https://api-maps.yandex.ru/2.1/?apikey=YOUR_API_KEY&lang=ru_RU"></script>
<script>
/* ─────────────────────────────────────────────────────────
   CONFIG
───────────────────────────────────────────────────────── */
const CONFIG = {
  // СЮДА ВСТАВИТЬ ТОЛЬКО Web App URL вида:
  // https://script.google.com/macros/s/AKfycb.../exec
  GOOGLE_APPS_SCRIPT_URL: "https://script.google.com/macros/s/AKfycbxIBZONriLNxz2Qh8r6zNnQ-J7rXf_uDK1UZzXXwtMJzEJaGFVwDtHBiJIoaQ_SxUMK/exec",

  // Если нет оплаты — оставить пусто
  YOOKASSA_PAYMENT_URL: "",
};

const SITE_ORIGIN = location.origin;

/* ─────────────────────────────────────────────────────────
   helpers: Apps Script URL
───────────────────────────────────────────────────────── */
function getAppsScriptUrl_(){
  const u = String(CONFIG.GOOGLE_APPS_SCRIPT_URL || '').trim();
  if(!u) return '';
  const ok = /^https:\/\/script\.google\.com\/macros\/s\/[A-Za-z0-9_-]+\/(exec|dev)(\?.*)?$/.test(u);
  return ok ? u : '';
}
function buildAppsScriptUrl_(params){
  const base = getAppsScriptUrl_();
  if(!base) return '';
  const url = new URL(base);
  if(params){
    for(const [k,v] of Object.entries(params)){
      url.searchParams.set(k, String(v));
    }
  }
  return url.toString();
}

/* ─────────────────────────────────────────────────────────
   NAV
───────────────────────────────────────────────────────── */
function scrollToSection(id){
  const el=document.getElementById(id);
  if(el) el.scrollIntoView({behavior:'smooth'});
}
window.addEventListener('scroll',()=>{
  const navbar=document.querySelector('nav');
  navbar.style.background = window.scrollY>100 ? 'rgba(11,45,58,0.96)' : 'rgba(11,45,58,0.92)';
});

/* ─────────────────────────────────────────────────────────
   COPY + SHARE
───────────────────────────────────────────────────────── */
function copyText(text){
  navigator.clipboard.writeText(text).then(()=>{
    const n=document.getElementById('copyNotification');
    n.classList.add('show');
    setTimeout(()=>n.classList.remove('show'),1800);
  });
}
function shareLocation(){
  const text='Дом у воды Хлепень\nд. Хлепень, Смоленская область\n55.96231, 34.46818';
  const url=SITE_ORIGIN;
  if(navigator.share){
    navigator.share({title:'Дом у воды Хлепень',text, url}).catch(()=>{});
  }else{
    copyText(text+' '+url);
    alert('Ссылка и адрес скопированы в буфер обмена.');
  }
}

/* ─────────────────────────────────────────────────────────
   MAP
───────────────────────────────────────────────────────── */
ymaps.ready(()=>{
  const map=new ymaps.Map("map",{center:[55.96231083712601,34.46818181000816],zoom:15,controls:['zoomControl','fullscreenControl']});
  const placemark=new ymaps.Placemark([55.96231083712601,34.46818181000816],{
    balloonContent:'<strong>Дом у воды Хлепень</strong><br>д. Хлепень, Смоленская область<br>☎️ +7 (996) 415-94-05',
    hintContent:'Дом у воды'
  },{preset:'islands#blueHomeIcon'});
  map.geoObjects.add(placemark);
});

/* ─────────────────────────────────────────────────────────
   DOC MODALS (оставил как было)
───────────────────────────────────────────────────────── */
const DOCS = { /* ... ваш блок DOCS без изменений ... */ };
/* чтобы не раздувать файл тут в ответе — оставьте ваш текущий DOCS как есть (он уже в вашем файле) */

/* ВАЖНО: если у Вас в текущем index.php уже есть DOCS/openDoc/closeDoc — оставьте его. */

/* ─────────────────────────────────────────────────────────
   BOOKING SYSTEM
   GET ожидаем:
   { ok:true, bookedDates:["YYYY-MM-DD"], paidDates:["YYYY-MM-DD"] }
   bookedDates = занятые НОЧИ (checkIn..checkOut-1)
   paidDates   = подмножество bookedDates, оплаченные
───────────────────────────────────────────────────────── */
let currentMonth=new Date();
let checkIn=null;
let checkOut=null;
let currentStep=1;

const RUB = '\u20BD';
const prices={weekday:7500,weekend:10000};

let unavailableDatesSet = new Set(); // занятые ночи
let paidDatesSet = new Set();        // оплаченные ночи

function isoDate(d){
  const z = new Date(d);
  z.setHours(0,0,0,0);
  const y = z.getFullYear();
  const m = String(z.getMonth()+1).padStart(2,'0');
  const day = String(z.getDate()).padStart(2,'0');
  return `${y}-${m}-${day}`;
}
function isUnavailableNight(date){
  return unavailableDatesSet.has(isoDate(date));
}
function isPaidNight(date){
  return paidDatesSet.has(isoDate(date));
}

async function loadBookedDates(){
  const url = buildAppsScriptUrl_({ action:'getBookedDates' });
  if(!url) return;

  try{
    const res = await fetch(url, { method:'GET', cache:'no-store' });
    const data = await res.json();

    const booked = Array.isArray(data?.bookedDates) ? data.bookedDates : [];
    const paid   = Array.isArray(data?.paidDates) ? data.paidDates : [];

    unavailableDatesSet = new Set(booked);
    paidDatesSet = new Set(paid);
  }catch(err){
    console.error('Ошибка загрузки занятых дат:', err);
  }
}

/* Проверка диапазона на занятые ночи (inclusive) */
function rangeHasUnavailable(start,endInclusive){
  if(!start || !endInclusive) return false;
  const s = new Date(start); s.setHours(0,0,0,0);
  const e = new Date(endInclusive); e.setHours(0,0,0,0);
  for(let d=new Date(s); d<=e; d.setDate(d.getDate()+1)){
    if(isUnavailableNight(d)) return true;
  }
  return false;
}

function renderCalendar(){
  const year=currentMonth.getFullYear();
  const month=currentMonth.getMonth();
  const firstDay=new Date(year,month,1);
  const lastDay=new Date(year,month+1,0);
  const startDay=firstDay.getDay()||7;

  document.getElementById('calendarTitle').textContent = firstDay.toLocaleDateString('ru-RU',{month:'long',year:'numeric'});
  const daysGrid=document.getElementById('calendarDays');
  daysGrid.innerHTML='';

  for(let i=1;i<startDay;i++){
    const empty=document.createElement('div');
    daysGrid.appendChild(empty);
  }

  for(let day=1;day<=lastDay.getDate();day++){
    const dayEl=document.createElement('div');
    dayEl.className='calendar-day';
    dayEl.textContent=day;

    const date=new Date(year,month,day);
    const today=new Date(); today.setHours(0,0,0,0);

    // прошлое
    if(date<today){
      dayEl.classList.add('disabled');
      daysGrid.appendChild(dayEl);
      continue;
    }

    const unavailable = isUnavailableNight(date);
    const paid = isPaidNight(date);

    // ВАЖНО: занятые ночи показываем, но:
    // - нельзя начинать бронирование (checkIn) на занятый день
    // - можно выбрать занятый день как дату ВЫЕЗДА (checkOut), если checkIn уже выбран
    if(unavailable){
      dayEl.classList.add(paid ? 'paid' : 'booked');

      const canUseAsCheckout = (checkIn && !checkOut && date > checkIn);
      if(canUseAsCheckout){
        dayEl.classList.add('can-checkout');
        dayEl.onclick = ()=>selectDate(date, { allowEndOnUnavailable:true });
      }else{
        dayEl.style.cursor='not-allowed';
        dayEl.onclick = ()=> {
          const msg = paid ? 'Эта дата занята (ОПЛАЧЕНО).' : 'Эта дата занята.';
          alert(msg + ' Выберите другую дату.');
        };
      }
    }else{
      dayEl.onclick=()=>selectDate(date, { allowEndOnUnavailable:false });
    }

    // подсветки
    if(checkIn && date.getTime()===checkIn.getTime()) dayEl.classList.add('selected');
    if(checkOut && date.getTime()===checkOut.getTime()) dayEl.classList.add('selected');
    if(checkIn && checkOut && date>checkIn && date<checkOut) dayEl.classList.add('in-range');

    daysGrid.appendChild(dayEl);
  }
}

function changeMonth(delta){
  currentMonth.setMonth(currentMonth.getMonth()+delta);
  renderCalendar();
}

function selectDate(date, opts){
  const allowEndOnUnavailable = !!opts?.allowEndOnUnavailable;

  // Если пользователь пытается начать на занятый день — запрет
  if(!checkIn || checkOut){
    if(isUnavailableNight(date)){
      alert(isPaidNight(date) ? 'Эта дата занята (ОПЛАЧЕНО). Выберите другую.' : 'Эта дата занята. Выберите другую.');
      return;
    }
    checkIn = new Date(date); checkIn.setHours(0,0,0,0);
    checkOut = null;
    renderCalendar();
    updateSummary();
    return;
  }

  // тут checkIn уже есть, checkOut ещё нет
  const d = new Date(date); d.setHours(0,0,0,0);

  // клик назад — меняем checkIn, но только если свободно
  if(d < checkIn){
    if(isUnavailableNight(d)){
      alert(isPaidNight(d) ? 'Эта дата занята (ОПЛАЧЕНО). Выберите другую.' : 'Эта дата занята. Выберите другую.');
      return;
    }
    checkIn = d;
    checkOut = null;
    renderCalendar();
    updateSummary();
    return;
  }

  // пытаемся поставить checkOut
  // checkOut может быть занятым днём, но это допустимо как "дата выезда"
  if(isUnavailableNight(d) && !allowEndOnUnavailable){
    alert(isPaidNight(d) ? 'Эта дата занята (ОПЛАЧЕНО). Выберите другую.' : 'Эта дата занята. Выберите другую.');
    return;
  }

  checkOut = d;

  // проверяем, что ночи (checkIn..checkOut-1) свободны
  const lastNight = new Date(checkOut);
  lastNight.setDate(lastNight.getDate()-1);

  if(rangeHasUnavailable(checkIn, lastNight)){
    alert('В выбранном периоде есть занятые (или оплаченные) ночи. Выберите другой диапазон.');
    checkOut = null;
  }

  renderCalendar();
  updateSummary();
}

function updateSummary(){
  if(!checkIn || !checkOut){
    document.getElementById('bookingSummary').style.display='none';
    document.getElementById('step1Next').disabled=true;
    return;
  }

  const nights = Math.ceil((checkOut - checkIn)/(1000*60*60*24));
  if(nights < 2){
    // Это сообщение показываем ТОЛЬКО когда реально выбраны обе даты и ночей < 2
    alert('Минимальное бронирование — 2 ночи');
    checkOut=null;
    renderCalendar();
    updateSummary();
    return;
  }

  let total=0;
  for(let d=new Date(checkIn); d<checkOut; d.setDate(d.getDate()+1)){
    const day=d.getDay();
    total += (day===0||day===6)?prices.weekend:prices.weekday;
  }

  document.getElementById('bookingSummary').style.display='block';
  document.getElementById('checkInDate').textContent = checkIn.toLocaleDateString('ru-RU');
  document.getElementById('checkOutDate').textContent = checkOut.toLocaleDateString('ru-RU');
  document.getElementById('nightsCount').textContent = nights;
  document.getElementById('totalPrice').textContent = total.toLocaleString('ru-RU') + RUB;
  document.getElementById('step1Next').disabled=false;
}

/* ─────────────────────────────────────────────────────────
   ВАЛИДАЦИЯ КОНТАКТОВ
───────────────────────────────────────────────────────── */
function setErr(id, msg){
  const el = document.getElementById(id);
  if(!el) return;
  if(msg){
    el.textContent = msg;
    el.classList.add('show');
  }else{
    el.textContent = '';
    el.classList.remove('show');
  }
}
function validateEmail(email){
  return /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(String(email||'').trim());
}
function validatePhone(phone){
  const digits = String(phone||'').replace(/\D/g,'');
  return digits.length >= 10; // минимум 10 цифр (для РФ обычно 11, но пусть будет мягче)
}
function validateGuestFields(showAlerts){
  const name = document.getElementById('guestName')?.value.trim() || '';
  const phone = document.getElementById('guestPhone')?.value.trim() || '';
  const email = document.getElementById('guestEmail')?.value.trim() || '';
  const guestsRaw = document.getElementById('guestCount')?.value || '0';
  const guests = Number(guestsRaw);

  let ok = true;

  setErr('errName', '');
  setErr('errPhone', '');
  setErr('errEmail', '');
  setErr('errGuests', '');

  if(!name){
    ok = false;
    setErr('errName','Укажите имя и фамилию.');
  }
  if(!phone || !validatePhone(phone)){
    ok = false;
    setErr('errPhone','Укажите корректный телефон (минимум 10 цифр).');
  }
  if(!email || !validateEmail(email)){
    ok = false;
    setErr('errEmail','Укажите корректный email.');
  }
  if(!Number.isFinite(guests) || guests < 1 || guests > 8){
    ok = false;
    setErr('errGuests','Количество гостей: от 1 до 8.');
  }

  if(!ok && showAlerts){
    alert('Проверьте поля: имя, телефон, email и количество гостей.');
  }
  return ok;
}

/* ─────────────────────────────────────────────────────────
   STEPS
───────────────────────────────────────────────────────── */
function goToStep(step){
  // перед переходом на шаг 3 — валидируем контакты
  if(step === 3){
    const ok = validateGuestFields(true);
    if(!ok) return;
  }

  document.getElementById(`bookingStep${currentStep}`).style.display='none';
  document.getElementById(`step${currentStep}Circle`).classList.remove('active');

  if(step<currentStep){
    for(let i=currentStep;i>step;i--){
      document.getElementById(`step${i}Circle`).classList.remove('completed');
    }
  }else{
    document.getElementById(`step${currentStep}Circle`).classList.add('completed');
  }

  currentStep=step;
  document.getElementById(`bookingStep${currentStep}`).style.display='block';
  document.getElementById(`step${currentStep}Circle`).classList.add('active');

  if(step===3){
    let total=0;
    for(let d=new Date(checkIn); d<checkOut; d.setDate(d.getDate()+1)){
      const day=d.getDay();
      total+=(day===0||day===6)?prices.weekend:prices.weekday;
    }
    document.getElementById('finalDates').textContent=`${checkIn.toLocaleDateString('ru-RU')} - ${checkOut.toLocaleDateString('ru-RU')}`;
    document.getElementById('finalGuests').textContent=`${document.getElementById('guestCount').value} чел.`;
    document.getElementById('finalTotal').textContent=total.toLocaleString('ru-RU') + RUB;
  }
}

/* ─────────────────────────────────────────────────────────
   PAYLOAD + POST
───────────────────────────────────────────────────────── */
function getBookingPayload(status){
  if(!validateGuestFields(true)) return null;

  if(!checkIn || !checkOut){
    alert('Не выбраны даты заезда/выезда. Вернитесь на шаг 1 и выберите период.');
    return null;
  }

  const nights = Math.ceil((checkOut - checkIn)/(1000*60*60*24));
  if(nights < 2){
    alert('Минимальное бронирование — 2 ночи');
    return null;
  }

  let total=0;
  for(let d=new Date(checkIn); d<checkOut; d.setDate(d.getDate()+1)){
    const day=d.getDay();
    total += (day===0||day===6)?prices.weekend:prices.weekday;
  }

  const ci = isoDate(checkIn);
  const co = isoDate(checkOut);

  const name=document.getElementById('guestName').value.trim();
  const phone=document.getElementById('guestPhone').value.trim();
  const email=document.getElementById('guestEmail').value.trim();
  const guests = String(document.getElementById('guestCount').value || '');
  const comment = String(document.getElementById('guestComment').value || '');

  return {
    action: 'createBooking',
    status: status,                  // pending | confirmed
    paid: (status === 'confirmed'),  // на всякий случай

    checkIn: ci, checkOut: co,
    check_in: ci, check_out: co,

    // дополнительные варианты ключей под разные версии Code.gs
    start_date: ci, end_date: co,
    date_from: ci, date_to: co,

    nights,
    total,

    name, phone, email,
    guestName: name, guestPhone: phone, guestEmail: email,
    guest_name: name, guest_phone: phone, guest_email: email,

    guests,
    guestCount: guests,
    guest_count: guests,
    guests_count: guests,

    comment,
    pageUrl: location.href,
  };
}

async function postBooking(payload){
  if(!payload) return { ok:false, error:'no payload' };

  const url = getAppsScriptUrl_();
  if(!url){
    alert('Не настроен GOOGLE_APPS_SCRIPT_URL (Web App Apps Script).');
    return { ok:false, error:'no script url' };
  }

  const overlay=document.getElementById('loadingOverlay');
  overlay.classList.add('active');

  try{
    const res = await fetch(url, {
      method:'POST',
      headers:{'Content-Type':'text/plain;charset=utf-8'},
      body: JSON.stringify(payload),
      redirect:'follow',
      cache:'no-store'
    });

    const text = await res.text();
    try{
      return JSON.parse(text);
    }catch(_){
      return { ok:false, error:'bad response (not json): ' + text.slice(0,300) };
    }
  }catch(e){
    console.error(e);
    return { ok:false, error:String(e) };
  }finally{
    overlay.classList.remove('active');
  }
}

async function sendRequest(){
  const payload = getBookingPayload('pending');
  const result = await postBooking(payload);

  if(result && result.ok){
    document.getElementById('successText').textContent = 'Заявка отправлена. Статус: Ожидает подтверждения.';
    document.getElementById('successMessage').classList.add('show');
    document.getElementById('requestBtn').disabled=true;
    document.getElementById('payBtn').disabled=true;

    // обновим календарь после успешной записи
    await loadBookedDates();
    renderCalendar();
    return;
  }
  alert('Не удалось отправить заявку: ' + (result && result.error ? result.error : 'ошибка'));
}

async function payAndConfirm(){
  const payload = getBookingPayload('confirmed');
  const result = await postBooking(payload);

  if(!(result && result.ok)){
    alert('Не удалось создать оплачиваемую бронь: ' + (result && result.error ? result.error : 'ошибка'));
    return;
  }

  document.getElementById('successText').textContent = 'Бронь создана. Переходим к оплате...';
  document.getElementById('successMessage').classList.add('show');

  await loadBookedDates();
  renderCalendar();

  if(CONFIG.YOOKASSA_PAYMENT_URL && CONFIG.YOOKASSA_PAYMENT_URL.trim() !== ''){
    window.location.href = CONFIG.YOOKASSA_PAYMENT_URL;
  }else{
    alert('Ссылка на оплату ЮKassa не задана (CONFIG.YOOKASSA_PAYMENT_URL).');
  }
}

/* INIT */
(async function init(){
  const siteLink = document.getElementById('siteLinkFooter');
  if(siteLink){
    siteLink.href = SITE_ORIGIN + '/';
    siteLink.textContent = SITE_ORIGIN.replace(/^https?:\/\//,'');
  }

  await loadBookedDates();
  renderCalendar();
})();
</script>
</body>
</html>
    