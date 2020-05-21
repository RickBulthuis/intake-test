<?php
$type = $_GET['type'];


// TODO: Splits deze file op naar meerdere losse scripts. Eentje voor customer, eentje voor auto, eentje voor klussen.

// TODO: Maak het mogelijk om een auto aan een bestaande klant toe te voegen

// TODO: Maak het mogelijk om autos, klanten en klussen te verwijderen


?>

<header>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>

    <link type="text/css" rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap-grid.css">
    <link type="text/css" rel="stylesheet" href="./assets/css/global.css">
</header>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav nav-tabs">
            <li class="nav-item active">
                <a class="nav-link" href="overview.php">Klanten</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="overview.php">Autos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="overview.php">Klussen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="nieuw.php?type=klant">Nieuwe klant</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="nieuw.php?type=task">Nieuwe klus</a>
            </li>
        </ul>
        <ul class="nav nav-tabs ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Uitloggen</a>
            </li>
        </ul>
    </div>
</nav>

<form action="opslaan.php" method="POST">
    <?php
    switch ($type){
    case 'klant':
        ?>

        <h3>Persoon</h3>
        <table class="table">
            <tr>
                <td>Voornaam:</td>
                <td><input name="first_name" class="form-control marginInput"></td>
            </tr>
            <tr>
                <td>Achternaam:</td>
                <td><input name="last_name" class="form-control marginInput"></td>
            </tr>
            <tr>
                <td>Leeftijd:</td>
                <td><input name="leeftijd" class="form-control marginInput"></td>
            </tr>
        </table>
        <h3> Auto</h3>
        <table class="table">
            <tr>
                <td>Merk:</td>
                <td><input name="brand" class="form-control marginInput"></td>
            </tr>
            <tr>
                <td>Type:</td>
                <td><input name="type" class="form-control marginInput"></td>
            </tr>
        </table>
        <?php break;
    case 'task':
    require(__DIR__.'/services/Database.php');
    $db = new Database;

    $cars = $db->getAllRows('SELECT car.*, customer.first_name, customer.last_name from car JOIN customer on customer.id = car.customer_id;')

    ?>
    <form action="opslaan.php">

        <h3> Auto</h3>

        <table class="table">
            <tr>
                <td>klant auto</td>
                <td>        <select name="car" class="form-control">
                        <?php foreach ($cars

                        as $car): ?>
                        <option value="<?= $car['id'] ?>"><?= $car['first_name'] . ' ' . $car['last_name'] . '\'s ' . $car['brand'] . ' ' . $car['type'] ?>

                            <?php endforeach; ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Klus:</td>
                <td><input name="task" class="form-control marginInput"></td>
            </tr>
        </table>
        <?php
        } ?>

        <input type="hidden" name="save_type" value="<?= $_GET['type'] ?>" class="form-control marginInput">
        <input type="submit" value="Invoeren" class="btn btn-primary"/>
    </form>
    </body>
