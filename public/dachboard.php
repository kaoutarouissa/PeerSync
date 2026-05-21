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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- NAV -->
<div class="bg-blue-600 text-white p-4">
    <h1 class="text-xl font-bold">
        Bienvenue <?= $_SESSION['user']; ?> 
    </h1>
</div>

<div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

<!-- SKILLS FORM -->
<div class="bg-white p-6 rounded-xl shadow">

    <h2 class="text-lg font-bold mb-4">Choisir vos compétences</h2>

    <form action="../scripts/assign_process.php" method="POST">

        <div class="space-y-2">
        <?php foreach($skills as $skill){ ?>
            
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="skills[]" value="<?= $skill->id ?>"
                class="w-4 h-4 text-blue-600">

                <span><?= $skill->title ?></span>
            </label>

        <?php } ?>
        </div>

        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Enregistrer
        </button>

    </form>

</div>

<!-- USER SKILLS -->
<div class="bg-white p-6 rounded-xl shadow">

    <h2 class="text-lg font-bold mb-4">Mes compétences</h2>

    <?php if($userSkills){ ?>

        <div class="flex flex-wrap gap-2">

        <?php foreach($userSkills as $us){ ?>
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                <?= $us->title ?>
            </span>
        <?php } ?>

        </div>

    <?php } else { ?>
        <p class="text-gray-500">Aucune compétence sélectionnée</p>
    <?php } ?>

</div>

</div>

</body>
</html>