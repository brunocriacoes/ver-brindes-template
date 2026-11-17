document.documentElement.classList.add('has-js');

const body = document.body;
const theme = document.getElementById('theme-toggle');
const menu = document.getElementById('menu-toggle');
const nav = document.getElementById('nav');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

function readPreference(key) {
    try {
        return window.localStorage.getItem(key);
    } catch {
        return null;
    }
}

function savePreference(key, value) {
    try {
        window.localStorage.setItem(key, value);
    } catch {
        // Preference still applies to the current page.
    }
}

function setTheme(dark) {
    body.classList.toggle('dark', dark);
    theme.setAttribute('aria-pressed', String(dark));
    theme.firstElementChild.classList.toggle('fa-moon', !dark);
    theme.firstElementChild.classList.toggle('fa-sun', dark);
    savePreference('ver-theme', dark ? 'dark' : 'light');
}

function setMenu(open) {
    nav.classList.toggle('open', open);
    menu.setAttribute('aria-expanded', String(open));
    menu.setAttribute('aria-label', open ? 'Fechar menu' : 'Abrir menu');
    menu.firstElementChild.classList.toggle('fa-bars', !open);
    menu.firstElementChild.classList.toggle('fa-xmark', open);
}

let fontSize = Number(readPreference('ver-font-size')) || 16;
function setSize(value) {
    fontSize = Math.min(20, Math.max(14, value));
    document.documentElement.style.fontSize = `${fontSize}px`;
    savePreference('ver-font-size', fontSize);
}

setTheme(readPreference('ver-theme') === 'dark');
setSize(fontSize);
theme.addEventListener('click', () => setTheme(!body.classList.contains('dark')));
menu.addEventListener('click', () => setMenu(!nav.classList.contains('open')));
document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && nav.classList.contains('open')) {
        setMenu(false);
        menu.focus();
    }
});
nav.addEventListener('click', event => {
    if (event.target.closest('a')) setMenu(false);
});
document.getElementById('font-minus').addEventListener('click', () => setSize(fontSize - 1));
document.getElementById('font-reset').addEventListener('click', () => setSize(16));
document.getElementById('font-plus').addEventListener('click', () => setSize(fontSize + 1));

const track = document.getElementById('product-track');
if (track) {
    const previous = document.getElementById('prev');
    const next = document.getElementById('next');
    const firstCard = track.firstElementChild;
    const updateButtons = () => {
        previous.disabled = track.scrollLeft <= 1;
        next.disabled = track.scrollLeft + track.clientWidth >= track.scrollWidth - 1;
    };
    for (const [button, direction] of [[previous, -1], [next, 1]]) {
        button.addEventListener('click', () => {
            const step = firstCard.getBoundingClientRect().width + parseFloat(getComputedStyle(track).columnGap);
            track.scrollBy({left: step * direction, behavior: reducedMotion.matches ? 'auto' : 'smooth'});
        });
    }
    track.addEventListener('scroll', updateButtons, {passive: true});
    new ResizeObserver(updateButtons).observe(track);
    updateButtons();
}

const contact = document.querySelector('[data-contact-form]');
if (contact) {
    const endpoint = new URL(contact.action);
    if (endpoint.hostname === 'wa.me') {
        contact.querySelector('fieldset').disabled = false;
        contact.addEventListener('submit', event => {
            event.preventDefault();
            const data = new FormData(contact);
            const fields = [
                ['nome', 'Nome'], ['whatsapp', 'WhatsApp'], ['email', 'E-mail'],
                ['produto', 'Produto'], ['mensagem', 'Projeto']
            ];
            const message = ['Olá! Gostaria de conversar sobre um orçamento.'];
            for (const [key, label] of fields) {
                const value = String(data.get(key) ?? '').trim();
                if (value) message.push(`${label}: ${value}`);
            }
            endpoint.searchParams.set('text', message.join('\n'));
            window.location.assign(endpoint.href);
        });
    }
}

const parallaxHero = document.querySelector('.parallax-hero');
const parallaxProducts = [...document.querySelectorAll('.parallax-product')];
if (parallaxHero && !reducedMotion.matches) {
  parallaxHero.addEventListener('pointermove', event => {
    const bounds = parallaxHero.getBoundingClientRect();
    const x = (event.clientX - bounds.left) / bounds.width - .5;
    const y = (event.clientY - bounds.top) / bounds.height - .5;
    parallaxProducts.forEach((product, index) => {
      const depth = (index + 1) * 9;
      product.style.setProperty('--parallax-x', `${x * depth}px`);
      product.style.setProperty('--parallax-y', `${y * depth}px`);
    });
  });
  parallaxHero.addEventListener('pointerleave', () => parallaxProducts.forEach(product => { product.style.setProperty('--parallax-x', '0px'); product.style.setProperty('--parallax-y', '0px'); }));
  let scrollFrame;
  window.addEventListener('scroll', () => {
    if (scrollFrame) return;
    scrollFrame = requestAnimationFrame(() => {
      const bounds = parallaxHero.getBoundingClientRect();
      const offset = Math.max(-65, Math.min(65, -bounds.top * .18));
      parallaxHero.style.setProperty('--scroll-y', `${offset}px`);
      scrollFrame = null;
    });
  }, { passive: true });
}
