<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione Stazione</title>
    <!-- Includi Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Includi jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Includi Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../style/style_menu_stazione.css">

    <script type="module" src="../js/aggiorna_stazione.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Registrazione Stazione</h2>
                <form id="stazioneForm">
                    <div class="form-group">
                        <label for="nome_stazione">Nome Stazione</label>
                        <input type="text" class="form-control" id="nome_stazione" placeholder="Inserisci il nome della stazione">
                    </div>
                    <div class="form-group">
                        <label for="numero_slot">Numero Slot</label>
                        <input type="number" class="form-control" id="numero_slot" placeholder="Inserisci il numero di slot">
                    </div>
                    <button type="submit" class="btn btn-primary">Conferma</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
