<?php
include 'db.php';

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bier Winkel</title>
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

        .beer-brands {
            display: flex;
            justify-content: center;
            gap: 100px;
            margin-top: 20px;
        }

        .beer-brand {
            text-align: center;
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 10px;
            border: 5px solid #0BA908;
            width: 220px;
        }

        .beer-brand img {
            max-width: 100px;
            height: auto;
            border-radius: 10px;
        }

        .beer-brand h2 {
            margin-top: 10px;
        }

        .beer-brand a {
            text-decoration: none;
            color: white;
        }

        footer nav {
            background-color: #0BA908;
            padding: 20px;
            border-radius: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        footer nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        footer nav ul h3, footer nav ul p {
            margin: 5px 0;
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
        <a href="pagina2.php"><img src="shoppingkart.webp" alt="Winkelwagen"></a>
    </div>
</header>

<div class="paginacontent">
    <h1>Welkom bij onze website</h1>
    <p>Ontdek hier onze biersoorten.</p>

    <div class="beer-brands">
        <div class="beer-brand">
            <img src="heineken.png" alt="Heineken">
            <a href="pagina3.php">
                <h2>Heineken</h2>
            </a>
        </div>
        <div class="beer-brand">
            <img src="amstelfoto.svg" alt="Amstel">
            <a href="pagina3.php">
                <h2>Amstel</h2>
            </a>
        </div>
    </div>
</div>

<footer>
    <nav>
        <ul>
            <h3>Contact Informatie</h3>
            <p>06 000 000 111 <br> fakegmail@gmail.com</p>
        </ul>
    </nav>
</footer>

</body>
</html>
