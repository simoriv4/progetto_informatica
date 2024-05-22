$(document).ready(function() {
    $("#conferma").click(function() {
        signUp();
    });

    $("#tornaIndietro").click(function() {
        window.location = "index.php";
    });
});

function signUp() {
    var nome = $('#nome').val().trim();
    var cognome = $('#cognome').val().trim();
    var email = $('#email').val().trim();
    var password = $('#password').val().trim();
    var conferma_password = $('#conferma_password').val().trim();
    var numeroTessera = $('#numeroTessera').val().trim();
    var numeroCartaCredito = $('#numeroCartaCredito').val().trim();
    var stato = $('#stato').val().trim();
    var provincia = $('#provincia').val().trim();
    var paese = $('#paese').val().trim();
    var cap = $('#cap').val().trim();
    var via = $('#via').val().trim();
    var isAdmin = $('#is_admin').is(':checked');

    if (!nome || !cognome || !email || !password || !conferma_password || !numeroTessera || !numeroCartaCredito ||
        !stato || !provincia || !paese || !cap || !via) {
        alert("Tutti i campi sono obbligatori.");
        return false;
    }

    if (!/^[a-zA-Z ]+$/.test(nome) || !/^[a-zA-Z ]+$/.test(cognome)) {
        alert("Nome e cognome devono contenere solo lettere e spazi.");
        return false;
    }

    if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
        alert("L'email inserita non è valida.");
        return false;
    }

    if (password.length < 8) {
        alert("La password deve contenere almeno 8 caratteri.");
        return false;
    }

    if (password != conferma_password) {
        alert("Le password non corrispondono!");
        return false;
    }

    if (isNaN(numeroTessera) || numeroTessera.length !== 6) {
        alert("Il numero di tessera deve essere di 6 cifre e deve essere un numero.");
        return false;
    }

    if (isNaN(numeroCartaCredito) || numeroCartaCredito.length !== 16) {
        alert("Il numero della carta di credito deve essere di 16 cifre e deve essere un numero.");
        return false;
    }

    if (isNaN(cap) || cap.length !== 5) {
        alert("Il CAP deve essere di 5 cifre e deve essere un numero.");
        return false;
    }

    var dati = {
        nome: nome,
        cognome: cognome,
        email: email,
        password: password,
        conferma_password: conferma_password,
        numeroTessera: numeroTessera,
        numeroCartaCredito: numeroCartaCredito,
        stato: stato,
        provincia: provincia,
        paese: paese,
        cap: cap,
        via: via,
        is_admin: isAdmin
    };

    $.get("../AJAX/signup.php", dati, function(data) {
        if (data.status === false) {
            alert("Registrazione fallita.");
        } else if (data.status === true) {
            window.location.href = "../pages/admin.php";
        }
    }, 'json');
}

function printResponse(status) {
    if (status === false) {
        alert("Registrazione fallita.");
    } else if (status === true) {
        window.location.href = "../pages/admin.php";
    }
}
