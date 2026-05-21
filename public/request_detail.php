<?php
session_start();

// if(!isset($_SESSION['user_id'])){
//     header("Location: index.php");
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Créer une demande d'aide</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-lg">

        <h1 class="text-2xl font-bold text-green-600 mb-6 text-center">
            Créer une demande d'aide
        </h1>

        <form action="../scripts/request_process.php" method="POST" class="space-y-5">

            <!-- TITLE -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">
                    Titre
                </label>

                <input 
                    type="text"
                    name="title"
                    required
                    placeholder="Ex : Problème SQL"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- DESCRIPTION -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    required
                    placeholder="Décrivez votre problème..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                ></textarea>
            </div>

            <!-- TECHNOLOGIE -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">
                    Technologie
                </label>

                <input 
                    type="text"
                    name="technologie"
                    required
                    placeholder="PHP, JavaScript, SQL..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition"
            >
                Envoyer la demande
            </button>

        </form>

    </div>

</body>
</html>