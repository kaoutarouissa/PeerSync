<?php
session_start();

require_once "../config/Database.php";

$db = new Connection();
$conn = $db->connect();

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit;
}

/* all skills */
$sql = "SELECT id,title FROM skills";
$stm = $conn->prepare($sql);
$stm->execute();
$skills = $stm->fetchAll(PDO::FETCH_OBJ);

/* user skills */
$user_id = $_SESSION['user_id'];

$sql2 ="SELECT skills.title
        FROM skills
        JOIN users_skills ON skills.id = users_skills.id_skill
        WHERE users_skills.id_user = ?";

$stm2 = $conn->prepare($sql2);
$stm2->execute([$user_id]);
$userSkills = $stm2->fetchAll(PDO::FETCH_OBJ);

$sql3 = "SELECT * FROM help_requests";

$stm3 = $conn->prepare($sql3);

$stm3->execute();

$requests = $stm3->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<!-- NAVBAR -->
<div class="bg-green-600 text-white px-8 py-4 shadow">

    <div class="flex justify-between items-center">

        <h1 class="text-2xl font-bold">
            Bienvenue <?= $_SESSION['user']; ?>
        </h1>

        <a href="request_detail.php"
           class="bg-white text-green-600 px-5 py-2 rounded-xl font-semibold hover:bg-gray-100 transition">

            Créer une demande

        </a>

    </div>

</div>

<!-- CONTENT -->
<div class="max-w-7xl mx-auto p-6">

    <!-- TOP GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

        <!-- SKILLS FORM -->
        <div class="bg-white rounded-2xl shadow-md p-6">

            <h2 class="text-xl font-bold text-gray-800 mb-5">
                Choisir vos compétences
            </h2>

            <form action="../scripts/assign_process.php" method="POST">

                <div class="space-y-3">

                    <?php foreach($skills as $skill){ ?>

                        <label class="flex items-center gap-3">

                            <input
                                type="checkbox"
                                name="skills[]"
                                value="<?= $skill->id ?>"
                                class="w-4 h-4 text-green-600 rounded">

                            <span class="text-gray-700">
                                <?= $skill->title ?>
                            </span>

                        </label>

                    <?php } ?>

                </div>

                <button
                    class="mt-6 bg-green-600 text-white px-5 py-3 rounded-xl hover:bg-green-700 transition">

                    Enregistrer

                </button>

            </form>

        </div>

        <!-- USER SKILLS -->
        <div class="bg-white rounded-2xl shadow-md p-6">

            <h2 class="text-xl font-bold text-gray-800 mb-5">
                Mes compétences
            </h2>

            <?php if($userSkills){ ?>

                <div class="flex flex-wrap gap-3">

                    <?php foreach($userSkills as $us){ ?>

                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium">
                            <?= $us->title ?>
                        </span>

                    <?php } ?>

                </div>

            <?php } else { ?>

                <p class="text-gray-500">
                    Aucune compétence sélectionnée
                </p>

            <?php } ?>

        </div>

    </div>

    <!-- HELP REQUESTS -->
    <div>

        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            Demandes d'aide
        </h2>

        <div class="grid gap-6">

            <?php foreach($requests as $req){ ?>

                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">

                    <!-- HEADER -->
                    <div class="flex justify-between items-start mb-4">

                        <div>

                            <h3 class="text-xl font-bold text-gray-800">
                                <?= $req->title ?>
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                <?= $req->technologie ?>
                            </p>

                        </div>

                        <!-- STATUS -->
                        <?php if($req->status == 'EN_ATTENTE'){ ?>

                            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
                                EN_ATTENTE
                            </span>

                        <?php } elseif($req->status == 'ASSIGNE'){ ?>

                            <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                                ASSIGNE
                            </span>

                        <?php } else { ?>

                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                                RESOLUE
                            </span>

                        <?php } ?>

                    </div>

                    <!-- DESCRIPTION -->
                    <div class="bg-gray-50 rounded-xl p-4 mb-5">

                        <p class="text-gray-700 leading-relaxed">
                            <?= $req->description ?>
                        </p>

                    </div>

                    <!-- COMMENT -->
                    <?php if($req->status != 'RESOLUE'){ ?>

                        <form action="../scripts/resolve_process.php" method="POST">

                            <input
                                type="hidden"
                                name="request_id"
                                value="<?= $req->id ?>">

                            <textarea
                                name="commentaire"
                                rows="3"
                                required
                                placeholder="Ajouter un commentaire..."
                                class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-green-500 resize-none"
                            ></textarea>

                            <button
                                class="mt-4 bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700 transition">

                                Marquer comme résolu

                            </button>

                        </form>

                    <?php } ?>

                </div>

            <?php } ?>

        </div>

    </div>

</div>

</body>
</html>
