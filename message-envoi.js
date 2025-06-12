
   const form = document.querySelector("form");
  const merciMessage = document.getElementById("merciMessage");

  form.addEventListener("submit", function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire temporairement

    // Afficher le message de remerciement
    merciMessage.style.display = "block";

    // Masquer le message après 5 secondes
    setTimeout(() => {
      merciMessage.style.display = "none";
      form.submit(); // Soumettre le formulaire après 5s
    }, 5000);
  });