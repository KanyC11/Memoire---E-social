
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - Don du Cœur</title>
  <link href="/css/style.css" rel="stylesheet">
   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex">
  <div class="w-1/2 hidden md:flex items-center justify-center bg-gray-100">
    <img src="/images/coeur.jpg" alt="Illustration" class="w-3/4">
  </div>
  <div class="w-full md:w-1/2 flex flex-col justify-center items-center px-6">
    <img src="/images/logo.png" alt="Logo" class="w-24 mb-6">
    <h1 class="text-2xl font-semibold mb-4">Connexion</h1>
    <form class="w-full max-w-sm space-y-4">
      <input type="email" placeholder="Email" class="w-full p-3 border rounded">
      <input type="password" placeholder="Mot de passe" class="w-full p-3 border rounded">
      <div class="flex justify-between items-center">
        <a href="mot_de_passe_oublie.php" class="text-sm text-blue-600">Mot de passe oublié ?</a>
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Se connecter</button>
      <p class="text-sm text-center">Pas encore de compte ? <a href="inscription.php" class="text-blue-600">S'inscrire</a></p>
    </form>
  </div>
</body>
</html>