

function showPage(page) {
    document.getElementById('login-page').style.display = (page === 'login') ? 'block' : 'none';
    document.getElementById('register-page').style.display = (page === 'register') ? 'block' : 'none';
    document.getElementById('forgot-page').style.display = (page === 'forgot') ? 'block' : 'none';
}

        function showPage(pageType) {
           
            document.querySelectorAll('.page').forEach(page => {
                page.classList.remove('active');
            });

           
            document.getElementById(pageType + '-page').classList.add('active');

            
            updateTabButtons(pageType);
        }

        function updateTabButtons(activeTab) {
            const tabButtons = document.querySelectorAll('.tab-button');
            tabButtons.forEach(button => {
                button.classList.remove('active', 'orange');
                button.classList.add('inactive');
            });

           
            if (activeTab === 'login') {
                tabButtons[0].classList.remove('inactive');
                tabButtons[0].classList.add('orange');
            } else if (activeTab === 'register') {
                tabButtons[1].classList.remove('inactive');
                tabButtons[1].classList.add('orange');
            }
        }

        function togglePassword(button) {
            const input = button.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                button.innerHTML = '🙈';
            } else {
                input.type = 'password';
                button.innerHTML = '👁';
            }
        }

        
        // document.getElementById('login-form').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     alert('Formulaire de connexion soumis');
        // });

        // document.getElementById('register-form').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     alert('Formulaire d\'inscription soumis');
        // });

        // document.getElementById('forgot-form').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     alert('Demande de réinitialisation envoyée');
        // });
