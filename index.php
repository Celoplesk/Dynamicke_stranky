<?php
require_once "db.php";

// ✅ Funkce 1 – najde sudá čísla
function ziskejSuda($pole) {
    $suda = [];
    foreach ($pole as $cislo) {             // ✅ Cyklus 1
        if ($cislo % 2 === 0) {             // ✅ Větvení 1 + operátor %
            $suda[] = $cislo;               // ✅ Pole 1
        }
    }
    return $suda;
}

// ✅ Funkce 2 – zjistí maximální číslo
function maxHodnota($pole) {
    $max = null;
    foreach ($pole as $cislo) {             // ✅ Cyklus 2
        if ($max === null || $cislo > $max) { // ✅ Větvení 2 + operátor >
            $max = $cislo;
        }
    }
    return $max;
}

// ✅ Funkce 3 – spočítá součet
function soucet($pole) {
    $sum = 0;
    foreach ($pole as $cislo) {             // ✅ Cyklus 3
        $sum += $cislo;
    }
    return $sum;
}

// ✅ Zpracování formuláře
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vstup = $_POST['cisla'] ?? '';
    $pole = array_map('intval', explode(',', $vstup)); // ✅ Pole 2

    // Vložení čísel do databáze – INSERT
    $stmt = $conn->prepare("INSERT INTO cisla (hodnota) VALUES (?)");
    foreach ($pole as $cislo) {
        if ($cislo >= 0) {                   // ✅ Větvení 3 + operátor >=
            $stmt->bind_param("i", $cislo);
            $stmt->execute();
        }
    }
    $stmt->close();
}

// Načti všechna čísla z databáze – SELECT
$cislaZDb = [];                               // ✅ Pole 3
$result = $conn->query("SELECT hodnota FROM cisla");
while ($row = $result->fetch_assoc()) {
    $cislaZDb[] = (int)$row['hodnota'];
}

// Výpočty
$suda = ziskejSuda($cislaZDb);
$max = maxHodnota($cislaZDb);
$soucet = soucet($cislaZDb);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Práce s databází</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Zadej čísla oddělená čárkou</h1>

    <form method="POST">
        <input type="text" name="cisla" placeholder="např. 10,5,32,7">
        <button type="submit">Uložit a zobrazit</button>
    </form>

    <h2>Výsledky z databáze:</h2>
    <p><strong>Všechna čísla:</strong> <?= implode(', ', $cislaZDb) ?></p>
    <p><strong>Sudá čísla:</strong> <?= implode(', ', $suda) ?></p>
    <p><strong>Největší číslo:</strong> <?= $max ?></p>
    <p><strong>Součet čísel:</strong> <?= $soucet ?></p>
</div>
</body>
</html>
