<?php
session_start();
// require_once "src/Entities/User.php";
require_once __DIR__ . "/../src/Entities/User.php"; 
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>PeerSync - Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">

    <h2 class="text-2xl font-bold text-center text-green-600 mb-6">
       Bienvenue sur votre espace
    </h2>
<?php
if(isset($_SESSION['error'])){
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
?>
    <!-- <h4><?php echo $_SESSION['error'];?></h4> -->

    <form action="../scripts/login_process.php" method="POST" class="space-y-4">

      
      <div>
        <label class="block text-gray-700"> Email</label>
        <input type="text" name="email"
               class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-400"
               >
      </div>


      <div>
        <label class="block text-gray-700">Mot de passe</label>
        <input type="password" name="password"
               class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-400"
               >
      </div>

      
      <div>
        <label class="block text-gray-700">Rôle</label>
        <select name="role"
                class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                >

          <option value=""> Choisir un rôle </option>
          <option value="admin">Admin</option>
          <option value="tuteur">Tuteur</option>
          <option value="apprenant">Apprenant</option>

        </select>
      </div>

      
      <button type="submit"
              class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-lg">
        Se connecter
      </button>

    </form>

  </div>

</body>
</html>