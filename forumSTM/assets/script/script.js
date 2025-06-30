window.showSection = function(section) {
    console.log(`Navigation vers: ${section}`);
    // Ici vous pourriez implémenter la navigation entre sections
};

window.showLoginModal = function() {
    const modal = document.getElementById('authModal');
    modal.style.display = 'flex';
    window.switchTab('login');
};

window.showRegisterModal = function() {
    const modal = document.getElementById('authModal');
    modal.style.display = 'flex';
    window.switchTab('register');
};

window.closeAuthModal = function() {
    document.getElementById('authModal').style.display = 'none';
};

window.switchTab = function(tab) {
    // Gérer les onglets
    const tabs = document.querySelectorAll('.auth-tab');
    const forms = document.querySelectorAll('.auth-form');
    const title = document.getElementById('modalTitle');

    tabs.forEach(t => t.classList.remove('active'));
    forms.forEach(f => f.classList.remove('active'));

    if (tab === 'login') {
        tabs[0].classList.add('active');
        document.getElementById('loginForm').classList.add('active');
        title.textContent = 'Connexion';
    } else {
        tabs[1].classList.add('active');
        document.getElementById('registerForm').classList.add('active');
        title.textContent = 'Inscription';
    }
};

// Fermer la modal en cliquant à l'extérieur
document.getElementById('authModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAuthModal();
    }
});
