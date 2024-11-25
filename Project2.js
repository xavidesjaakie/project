// Probeer het opgeslagen saldo te laden bij het opstarten
let geldBedrag = parseFloat(localStorage.getItem('geldBedrag')) || 200;  // Startsaldo, of geladen saldo uit localStorage
let geldStatusElement = document.getElementById("geldStatus");
let transactionListElement = document.getElementById("transaction-list");

function voegGeldToe(bedrag) {
    geldBedrag += bedrag;  // Verhoog het saldo met het opgegeven bedrag
    updateGeldStatus();    // Werk het saldo weer bij in de interface
    voegTransactieToe(`€${bedrag} toegevoegd`);  // Voeg transactie toe
    localStorage.setItem('geldBedrag', geldBedrag);  // Sla het saldo op in localStorage
}

function verlaagGeld(bedrag) {
    if (geldBedrag >= bedrag) {
        geldBedrag -= bedrag;  // Verlaag het saldo met het opgegeven bedrag
        updateGeldStatus();    // Werk het saldo weer bij in de interface
        voegTransactieToe(`€${bedrag} afgenomen`);  // Voeg transactie toe
        localStorage.setItem('geldBedrag', geldBedrag);  // Sla het saldo op in localStorage
    } else {
        alert("Onvoldoende saldo voor deze actie!");  // Waarschuwing als er niet genoeg saldo is
    }
}

function updateGeldStatus() {
    // Werk het saldo bij in de interface
    if (geldBedrag >= 1) {
        geldStatusElement.style.color = "green";
        geldStatusElement.textContent = `€${geldBedrag.toFixed(2)}`;
    } else {
        geldStatusElement.style.color = "red";
        geldStatusElement.textContent = `€${geldBedrag.toFixed(2)}`;
    }
}

// Transacties opslaan in localStorage
function voegTransactieToe(tekst) {
    let transacties = JSON.parse(localStorage.getItem('transacties')) || [];
    transacties.push(tekst);  // Voeg de nieuwe transactie toe
    localStorage.setItem('transacties', JSON.stringify(transacties));  // Sla de transacties op in localStorage
}

// Transacties weergeven op de Rekening-pagina
window.onload = function() {
    // Haal het saldo op uit localStorage
    geldBedrag = parseFloat(localStorage.getItem('geldBedrag')) || 200;
    updateGeldStatus();  // Werk het saldo bij

    // Haal de transacties op uit localStorage
    let transacties = JSON.parse(localStorage.getItem('transacties')) || [];
    // Voeg elke transactie toe aan de lijst op de pagina
    transacties.forEach(transactie => {
        let li = document.createElement("li");
        li.textContent = transactie;
        transactionListElement.appendChild(li);
    });
};
