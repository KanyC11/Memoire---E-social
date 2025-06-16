
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription - Don du Cœur</title>
  <link href="/css/style.css" rel="stylesheet">
</head>
<body class="h-screen flex">
  <div class="w-1/2 hidden md:flex items-center justify-center bg-gray-100">
    <img src="/images/coeur.jpg" alt="Illustration" class="w-3/4">
  </div>
  <div class="w-full md:w-1/2 flex flex-col justify-center items-center px-6">
    <img src="/images/logo.png" alt="Logo" class="w-24 mb-6">
    <h1 class="text-2xl font-semibold mb-4">Inscription</h1>
    <form class="w-full max-w-sm space-y-4">
      <input type="text" placeholder="Nom complet" class="w-full p-3 border rounded">
      <input type="email" placeholder="Email" class="w-full p-3 border rounded">
      <input type="password" placeholder="Mot de passe" class="w-full p-3 border rounded">
      <input type="password" placeholder="Confirmer le mot de passe" class="w-full p-3 border rounded">
      <button type="submit" class="w-full bg-green-600 text-white py-2 rounded">S'inscrire</button>
      <p class="text-sm text-center">Déjà un compte ? <a href="connexion.php" class="text-blue-600">Se connecter</a></p>
    </form>
  </div>
</body>
</html>