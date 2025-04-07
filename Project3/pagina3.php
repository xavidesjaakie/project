<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="project 3.css">
    <title>placeholder</title>
    <style>body {
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

.paginaheineken {
  margin:  30px;
}


.paginaamstel {
  margin-left: 30px;
  margin-top: 100px;
}

.paginaheineken, .paginaamstel {
    text-align: center; /* Centreert de tekst */
    display: flex;
    flex-direction: column;
    align-items: center; /* Centreert de inhoud horizontaal */
}
.paginaheineken, .paginaamstel {
    width: 50%; /* Of een andere breedte naar wens */
    margin: 0 auto; /* Zorgt ervoor dat de div in het midden van de pagina staat */
}

.beer-brands {
  display: flex;
  justify-content: center;
  gap: 100px;
  margin-top: 20px;
  margin-left: 350px;
  
}
img {width: 95px; height: 250px;}
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

footer nav {
  background-color: #0BA908;
  padding: 10px;
  border-radius: 10px;
  position: fixed;
  bottom: 0;
  width: 100%;
  height: 60px;
  display: flex;
  justify-content: center;
  align-items: center;
}

footer nav ul {
  list-style: none;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0;
  margin: 0;
  width: 100%;
}

footer nav ul p {
  font-size: 20px;
}

footer nav ul li a {
  color: white;
  text-decoration: none;
  font-size: 20px;
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
    <div class="paginaheineken">
        <h1>Heineken</h1>
        <h3>Heineken 330ml</h3>   
        <img src="heineken330.webp" alt="">
<p>
Alcoholpercentage: 5.0% <br>
Inhoud: 33cl <br>
Prijs: €2.39 <br>
</p>
<h3>Heineken 250ml</h3>
<img src="heineken330.webp" alt="">
<p>Alcoholpercentage: 5.0% <br>
Inhoud: 25cl <br>
Prijs: €2.00</p> 

<h3>Heineken trui</h3>
<img src="heinekentrui.webp" alt="">
<p>Stof: 100% katoen
Kleur: Donkergroen
Prijs: €50</p>



 </div>


 <div class="paginaamstel">
        <h1>Amstel</h1>

        <h3>Amstel pet:</h3>
        <img src="amstelpet.webp" alt="">
        <p>
  Prijs: 24,99€ <br>
Stijlvolle pet met Amstel Bier-logo <br>
Verstelbare pasvorm voor optimaal comfort <br> 
gemaakt van ademend materiaal voor langdurig draagplezier <br>
</p>
<h3>Amstel bier 330ml:</h3>
<img src="amstel330.webp" alt="">
<p> prijs: 3,00€ <br>
Alcholpercentage: 5% <br>
Verfrissend pils met een volle, zachte smaak
Perfect gebalanceerd met een lichte hopbitterheid
Gebrouwen volgens het traditionele Amstel-recept sinds 1870
</p>
<h3>Amstel bier 250ml:</h3>
<img src="amstel250.webp" alt="">
<p> Prijs: 2,39€ <br>
Alcholpercentage: 5% <br>
Verfrissend en zacht pils in een handzaam 250ml formaat
Perfect in balans met een lichte hopbitterheid
Gebrouwen volgens het authentieke Amstel-recept sinds 1870</p>
 </div>



</body>
</html>
