// Alkohol Katalógus – kis segéd-JavaScript (nincs hozzá külső könyvtár)

document.addEventListener('DOMContentLoaded', () => {

    // 1) Törlés előtti megerősítés: <form data-confirm="Biztosan törlöd?">
    document.querySelectorAll('form[data-confirm]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!window.confirm(form.dataset.confirm)) {
                event.preventDefault();
            }
        });
    });

    // 2) Sikerüzenet bezárása gombbal, illetve automatikusan 5 másodperc után
    document.querySelectorAll('[data-flash]').forEach((flash) => {
        const hide = () => {
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 400);
        };

        flash.querySelector('[data-dismiss]')?.addEventListener('click', hide);
        setTimeout(hide, 5000);
    });

    // 3) Mobil menü nyitása / zárása
    const toggle = document.querySelector('[data-nav-toggle]');
    const nav = document.getElementById('main-nav');

    toggle?.addEventListener('click', () => nav.classList.toggle('open'));
});
