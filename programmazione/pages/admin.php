<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['is_admin']) && !$_SESSION["is_admin"]) {
    header("Location: cliente.php");
    exit();
} else if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin - Noleggio Biciclette RIVA</title>
    <!-- Includi Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Includi jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Includi il CSS personalizzato -->
    <link rel="stylesheet" type="text/css" href="../style/style_admin.css">
    <!-- Includi Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script type="module" src="../js/map.js"></script>
    <script type="module" src="../js/admin.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../img/logo2.png" alt="Noleggio Riva" width="150">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button type="button" class="btn btn-secondary mr-2" id="logout">Logout</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-secondary" id="signup_button">Sign Up</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-secondary" id="gestione_bici">Gestione Bici</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-secondary" id="gestione_stazioni">Gestione Stazioni</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Noleggio Biciclette RIVA</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="map" class="mt-5"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="rides" class="mt-5"></div>
            </div>
        </div>
    </div>

    <script>
        (g => {
            var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__", m = document, b = window; b = b[c] || (b[c] = {}); var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams, u = () => h || (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + ""); for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]); e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e; d[q] = f; a.onerror = () => h = n(Error(p + " could not load.")); a.nonce = m.querySelector("script[nonce]")?.nonce || ""; m.head.append(a)
            }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
        })
            ({
                key: "AIzaSyAr14sRK-gZQduBqjL4a6ioX0laYlu590A", v: "weekly"
            });
    </script>
</body>

</html>
