<?php
if (!isset($_SESSION)) {
  session_start();
}
// echo $_SESSION["is_admin"];
if (isset($_SESSION['is_admin']) && $_SESSION["is_admin"]) {
  header("Location: admin.php");
  exit();
} else if (isset($_SESSION['is_admin']) && !$_SESSION["is_admin"]) {
  header("Location: cliente.php");
  exit();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Noleggio Biciclette RIVA</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../style/style_index.css" />

  <script type="module" src="../js/map.js"></script>

  <script>
    $(document).ready(function () {
      $("#login_button").click(function () {
        window.location.href = "login.php";
      });
      $("#signup_button").click(function () {
        window.location.href = "signup.php";
      });
    });
  </script>

</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-8">
        <div id="intestazione" class="d-flex align-items-center">
          <img src="../img/logo2.png" alt="Noleggio Riva" class="mb-4" width="150">
          <h1 class="mb-4">Noleggio Biciclette RIVA</h1>
        </div>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <button type="button" class="btn btn-primary mr-2" id="login_button">Login</button>
        <!-- <button type="button" class="btn btn-secondary" id="signup_button">Sign Up</button> -->

      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div id="map" class="mt-5"></div>
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