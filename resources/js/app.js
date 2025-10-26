import './bootstrap';

/**
 * ============================
 *  HANDLER UNTUK INSTALL PWA
 * ============================
 */
let deferredPrompt = null;

window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;

    const btnInstall = document.getElementById('btn-install-pwa');
    if (btnInstall) btnInstall.classList.remove('hidden');
});

window.addEventListener('appinstalled', () => {
    console.log('✅ Aplikasi PWA berhasil di-install');
    const btnInstall = document.getElementById('btn-install-pwa');
    if (btnInstall) btnInstall.classList.add('hidden');
});

document.addEventListener('DOMContentLoaded', () => {
    const btnInstall = document.getElementById('btn-install-pwa');
    const btnIos = document.getElementById('btn-ios-instructions');

    const isStandalone =
        window.matchMedia('(display-mode: standalone)').matches ||
        window.navigator.standalone === true;
    const isIOS = /iphone|ipad|ipod/i.test(window.navigator.userAgent);

    // Jika di iOS → tampilkan instruksi
    if (isIOS && !isStandalone && btnIos) {
        btnIos.classList.remove('hidden');
    }

    // Klik tombol install (Android/Chrome)
    if (btnInstall) {
        btnInstall.addEventListener('click', async () => {
            if (!deferredPrompt) return;
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            if (outcome === 'accepted') {
                console.log('User setuju install PWA');
            }
            deferredPrompt = null;
            btnInstall.classList.add('hidden');
        });
    }

    // Klik tombol iOS
    if (btnIos) {
        btnIos.addEventListener('click', () => {
            alert('Untuk iPhone/iPad: Tekan tombol “Share” → pilih “Add to Home Screen”.');
        });
    }
});
