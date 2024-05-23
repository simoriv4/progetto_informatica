$(document).ready(function () {
    $("#conferma").click(function () {
        signUp();
    });

    $("#admin").click(function () {
        window.location.href = "admin.php";
    });
});

function signUp() {
    var nome = $("#nome").val();
    var cognome = $("#cognome").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var conferma_password = $("#conferma_password").val();
    var numeroTessera = $("#numeroTessera").val();
    var numeroCartaCredito = $("#numeroCartaCredito").val();
    var regione = $("#regione").val();
    var provincia = $("#provincia").val();
    var paese = $("#paese").val();
    var cap = $("#cap").val();
    var via = $("#via").val();
    var n_civico = $("#n_civico").val();
    var is_admin = $("#is_admin").prop("checked") ? 1 : 0; 

    // if (!nome || !cognome || !email || !password || !conferma_password || !numeroCartaCredito ||
    //     !regione || !provincia || !paese || !cap || !via) {
    //     alert("Tutti i campi sono obbligatori.");
    //     return false;
    // }

    // if (!/^[a-zA-Z ]+$/.test(nome) || !/^[a-zA-Z ]+$/.test(cognome)) {
    //     alert("Nome e cognome devono contenere solo lettere e spazi.");
    //     return false;
    // }

    // if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
    //     alert("L'email inserita non è valida.");
    //     return false;
    // }

    // if (password.length < 8) {
    //     alert("La password deve contenere almeno 8 caratteri.");
    //     return false;
    // }

    // if (password != conferma_password) {
    //     alert("Le password non corrispondono!");
    //     return false;
    // }

    // if (isNaN(numeroCartaCredito) || numeroCartaCredito.length !== 16) {
    //     alert("Il numero della carta di credito deve essere di 16 cifre e deve essere un numero.");
    //     return false;
    // }

    // if (isNaN(cap) || cap.length !== 5) {
    //     alert("Il CAP deve essere di 5 cifre e deve essere un numero.");
    //     return false;
    // }

    $.ajax({
        url: "../AJAX/signup.php",
        type: "GET",
        data: {
            nome: nome,
            cognome: cognome,
            email: email,
            password: password,
            conferma_password: conferma_password,
            numeroTessera: numeroTessera,
            numeroCartaCredito: numeroCartaCredito,
            regione: regione,
            provincia: provincia,
            paese: paese,
            cap: cap,
            via: via,
            n_civico: n_civico,
            is_admin: is_admin
        },
        dataType: "json",
        success: function(response) {
            if (response.status === "ok") {
                alert(response.message);
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function printResponse(status) {
    if (status === false) {
        alert("Registrazione fallita.");
    } else if (status === true) {
        window.location.href = "../pages/admin.php";
    }
}
