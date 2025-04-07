<?php
include 'db.php';

$message = "";

// Haal alle soorten bier en producten op met prijzen
$soorten_query = "SELECT id, name FROM soorten";
$soorten_result = $conn->query($soorten_query);

$producten_query = "SELECT id, naam, prijs, soort_id FROM producten";
$producten_result = $conn->query($producten_query);
$producten = [];
while ($row = $producten_result->fetch_assoc()) {
    $producten[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg klantgegevens uit het formulier
    $naam = $_POST['naam'];
    $email = $_POST['email'];

    // Controleer of de 'bestellingen' parameter aanwezig is
    if (!isset($_POST['bestellingen']) || empty($_POST['bestellingen'])) {
        die("Vul alstublieft alle velden in en selecteer producten.");
    }

    // Decodeer de bestellingen
    $bestellingen = json_decode($_POST['bestellingen'], true);

    // Controleer of klantgegevens en bestellingen aanwezig zijn
    if (empty($naam) || empty($email) || empty($bestellingen)) {
        die("Vul alstublieft alle velden in en selecteer producten.");
    }

    // Voeg de klant toe en verkrijg de klant-ID
    $sql = $conn->prepare("INSERT INTO klanten (naam, email) VALUES (?, ?)");
    $sql->bind_param("ss", $naam, $email);
    if (!$sql->execute()) {
        die("Fout bij het toevoegen van klant: " . $sql->error);
    }
    $klanten_id = $conn->insert_id; // Verkrijg de klant-ID van de nieuw toegevoegde klant

    // Voeg bestellingen toe aan de database
    foreach ($bestellingen as $bestelling) {
        $product_id = $bestelling['product_id'];
        $aantal = $bestelling['aantal'];

        if (!empty($product_id) && !empty($aantal)) {
            $sql = $conn->prepare("INSERT INTO bestellingen (klantid, product_id, bestelling_datum, aantal) VALUES (?, ?, NOW(), ?)");
            $sql->bind_param("iis", $klanten_id, $product_id, $aantal);
            if (!$sql->execute()) {
                die("Fout bij het plaatsen van bestelling: " . $sql->error);
            }
        }
    }

    $message = "Bestelling succesvol geplaatst!";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bier Bestellen</title>
    <style>
        body {
            background-color: lightslategray;
            font-family: Arial, sans-serif;
            color: white;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #0BA908;
            padding: 10px 20px;
            border-radius: 10px;
        }
        .logo img {
            max-width: 100px;
            height: auto;
        }
        header nav ul {
            list-style: none;
            display: flex;
            padding: 0;
        }
        header nav ul li {
            margin: 0 20px;
        }
        header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 20px;
        }
        .cart a img {
            max-width: 100px;
            height: auto;
        }
        .paginacontent {
            margin: 20px;
            text-align: center;
        }
        .bestelformulier {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin: 20px auto;
            border: 3px solid #0BA908;
            text-align: center;
        }
        .product-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .btn {
            padding: 5px 10px;
            cursor: pointer;
            background-color: #0BA908;
            color: white;
            border: none;
            margin: 0 5px;
        }
        .winkelmandje {
            margin-top: 20px;
            padding: 10px;
            background-color: #222;
            border-radius: 5px;
        }
        .totaalprijs {
            margin-top: 20px;
            padding: 10px;
            background-color: #333;
            color: white;
            border-radius: 5px;
            font-size: 18px;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="logo.webp" alt="Bierwinkel Logo">
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="pagina2.php">Product</a></li>
            <li><a href="pagina3.php">Product Info</a></li>
        </ul>
    </nav>
    <div class="cart">
        <a href="#"><img src="shoppingkart.webp" alt="Winkelwagen"></a>
    </div>
</header>

<div class="paginacontent">
    <h1>Bestel je favoriete bier</h1>
    <div class="bestelformulier">
        <h2>Vul je gegevens in</h2>
        <form method="POST" id="bestelForm">
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <h2>Selecteer producten</h2>
            <div id="producten-lijst">
                <?php foreach ($producten as $product): ?>
                    <div class="product-item" data-id="<?= $product['id']; ?>" data-price="<?= $product['prijs']; ?>" data-name="<?= htmlspecialchars($product['naam']); ?>">
                        <span><?= htmlspecialchars($product['naam']); ?> - €<?= number_format($product['prijs'], 2); ?></span>
                        <div>
                            <button class="btn" type="button" onclick="veranderAantal(<?= $product['id']; ?>, -1)">-</button>
                            <span id="aantal-<?= $product['id']; ?>">0</span>
                            <button class="btn" type="button" onclick="veranderAantal(<?= $product['id']; ?>, 1)">+</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="winkelmandje">
                <h3>Winkelmandje</h3>
                <ul id="winkelmandje-lijst"></ul>
            </div>
            <div class="totaalprijs">
                <h4>Totaal: €<span id="totaal-waarde">0.00</span></h4>
                <button class="btn" type="button" onclick="plaatsBestelling()">Bestellen</button>
            </div>
        </form>
    </div>
    <p><?php echo $message; ?></p>
</div>

<script>
let winkelmandje = {};

function veranderAantal(productId, verandering) {
    if (!winkelmandje[productId]) {
        winkelmandje[productId] = { aantal: 0, prijs: parseFloat(document.querySelector(`[data-id="${productId}"]`).getAttribute('data-price')) };
    }
    winkelmandje[productId].aantal += verandering;
    if (winkelmandje[productId].aantal < 0) {
        winkelmandje[productId].aantal = 0;
    }
    document.getElementById('aantal-' + productId).textContent = winkelmandje[productId].aantal;
    updateWinkelmandje();
}

function updateWinkelmandje() {
    let lijst = document.getElementById("winkelmandje-lijst");
    lijst.innerHTML = "";
    let totaalPrijs = 0;

    Object.keys(winkelmandje).forEach(id => {
        if (winkelmandje[id].aantal > 0) {
            let li = document.createElement("li");
            let prijs = winkelmandje[id].prijs * winkelmandje[id].aantal;
            totaalPrijs += prijs;
            li.textContent = `${document.querySelector(`[data-id="${id}"]`).getAttribute('data-name')} x${winkelmandje[id].aantal} - €${prijs.toFixed(2)}`;
            lijst.appendChild(li);
        }
    });

    document.getElementById("totaal-waarde").textContent = totaalPrijs.toFixed(2);
}

function plaatsBestelling() {
    let naam = document.getElementById("naam").value;
    let email = document.getElementById("email").value;
    let bestellingen = [];

    // Verzamel bestellingen uit het winkelmandje
    Object.keys(winkelmandje).forEach(id => {
        if (winkelmandje[id].aantal > 0) {
            bestellingen.push({ product_id: id, aantal: winkelmandje[id].aantal });
        }
    });

    if (!naam || !email || bestellingen.length === 0) {
        alert("Vul alle velden in en selecteer producten.");
        return;
    }

    let formData = new FormData();
    formData.append("naam", naam);
    formData.append("email", email);
    formData.append("bestellingen", JSON.stringify(bestellingen));

    fetch("pagina2.php", {
        method: "POST",
        body: formData
    }).then(response => response.text())
      .then(data => {
          alert("Bestelling geplaatst!");
          location.reload(); // Vernieuw de pagina na het plaatsen van de bestelling
      }).catch(error => console.error("Fout:", error));
}
</script>

</body>
</html>
