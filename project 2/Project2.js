
const users = [
    { username: "admin", password: "admin123" },
    { username: "gebruiker1", password: "wachtwoord1" },
    { username: "gebruiker2", password: "wachtwoord2" }
];

document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            const user = users.find(u => u.username === username && u.password === password);

            if (user) {
                localStorage.setItem("loggedInUser", username);
                window.location.href = "project2.html"; 
            } else {
                document.getElementById("error-message").style.display = "block";
            }
        });
    }
});


let geldBedrag;
let transacties;
let gebruikersSaldoKey;
let gebruikersTransactiesKey;
const loggedInUser = localStorage.getItem("loggedInUser");


if (loggedInUser) {
    gebruikersSaldoKey = `${loggedInUser}_saldo`;
    gebruikersTransactiesKey = `${loggedInUser}_transacties`;

    geldBedrag = parseFloat(localStorage.getItem(gebruikersSaldoKey)) || 200;
    transacties = JSON.parse(localStorage.getItem(gebruikersTransactiesKey)) || [];

    function updateGeldStatus() {
        const geldStatusElement = document.getElementById("geldStatus");
        if (geldStatusElement) {
            geldStatusElement.textContent = `€${geldBedrag.toFixed(2)}`;
            geldStatusElement.style.color = geldBedrag >= 0.01 ? "green" : "red";
        }
        localStorage.setItem(gebruikersSaldoKey, geldBedrag); 
    }


    function voegTransactieToe(tekst) {
        const nieuweTransactie = {
            id: transacties.length + 1,
            tekst: tekst,
            datum: new Date().toISOString(),
        };

        transacties.push(nieuweTransactie);
        localStorage.setItem(gebruikersTransactiesKey, JSON.stringify(transacties)); 

        toonTransactie(nieuweTransactie);
    }

 
    function toonTransactie(transactie) {
        const transactionListElement = document.getElementById("transaction-list");
        if (transactionListElement) {
            const li = document.createElement("li");
            li.innerHTML = `<span class="transactie-id">[ID ${transactie.id}]</span> ${transactie.tekst} <br><small>${new Date(transactie.datum).toLocaleString()}</small>`;
            transactionListElement.appendChild(li);
        }
    }
    function toonAlleTransacties() {
        const transactionListElement = document.getElementById("transaction-list");
        if (transactionListElement) {
            transactionListElement.innerHTML = ""; 
            transacties.forEach(transactie => toonTransactie(transactie));
        }
    }


    function voegGeldToe(bedrag) {
        geldBedrag += bedrag;
        updateGeldStatus();
        voegTransactieToe(`€${bedrag} toegevoegd`);
    }

  
    function verlaagGeld(bedrag) {
        if (geldBedrag >= bedrag) {
            geldBedrag -= bedrag;
            updateGeldStatus();
            voegTransactieToe(`€${bedrag} afgenomen`);
        } else {
            alert("Onvoldoende saldo voor deze actie!");
        }
    }

    function wisTransacties() {
        if (confirm("Weet je zeker dat je alle transacties wilt wissen?")) {
            transacties = [];
            localStorage.removeItem(gebruikersTransactiesKey);
            toonAlleTransacties();
        }
    }


    window.onload = function () {
        if (!loggedInUser) {
            window.location.href = "login.html"; 
            return;
        }

        updateGeldStatus();
        toonAlleTransacties();

        setInterval(() => {
            const huidigeTijd = new Date();
            transacties = transacties.filter(transactie => {
                const transactieTijd = new Date(transactie.datum);
                return (huidigeTijd - transactieTijd) <= 10 * 60 * 1000; 
            });

            localStorage.setItem(gebruikersTransactiesKey, JSON.stringify(transacties));
            toonAlleTransacties();
        }, 60 * 1000);
    };

    
    document.getElementById("logout").addEventListener("click", function () {
        localStorage.removeItem("loggedInUser");
        window.location.href = "login.html";
    });


    window.voegGeldToe = voegGeldToe;
    window.verlaagGeld = verlaagGeld;
    window.wisTransacties = wisTransacties;
}
