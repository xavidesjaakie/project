// Vooraf ingestelde gebruikers
const users = [
    { username: "admin", password: "admin123" },
    { username: "gebruiker1", password: "wachtwoord1" },
    { username: "gebruiker2", password: "wachtwoord2" }
];

// Selecteer het formulier en voeg een submit-event toe
document.getElementById("loginForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Voorkom standaard formuliergedrag

    // Haal ingevoerde waarden op
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Controleer of de ingevoerde gegevens overeenkomen met een gebruiker
    const user = users.find(u => u.username === username && u.password === password);

    if (user) {
        // Bewaar de gebruikersnaam in localStorage en ga naar dashboard
        localStorage.setItem("loggedInUser", username);
        window.location.href = "project2.html"; // Verwijs naar de dashboardpagina
    } else {
        // Toon foutmelding
        document.getElementById("error-message").style.display = "block";
    }
});
