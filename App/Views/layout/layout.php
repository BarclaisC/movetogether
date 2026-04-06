<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Titre dynamique -->
    <title><?= $this->title ?? 'MoveTogether' ?></title>

    <!-- Meta description (pro) -->
    <meta name="description" content="MoveTogether — Plateforme interne de covoiturage.">

    <!-- Favicon (optionnel) -->
    <link rel="icon" type="image/png" href="assets/img/favicon.png">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Ton CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php require __DIR__ . '/header.php'; ?>

    <!-- Contenu principal -->
    <main class="mt-4">
        <?= $content ?>
    </main>

    <?php require __DIR__ . '/footer.php'; ?>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Ton JS -->
    <script src="assets/js/app.js"></script>

</body>
</html>