<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MoveTogether</title>

    <!-- Bootstrap en premier -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Ton CSS (chemin corrigé) -->
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <?php require __DIR__ . '/header.php'; ?>

    <main class="container mt-4">
        <?= $content ?>
    </main>

    <?php require __DIR__ . '/footer.php'; ?>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Ton JS -->
    <script src="js/app.js"></script>

</body>
</html>