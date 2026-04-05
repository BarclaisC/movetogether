<?php

namespace App\Core;

class Controller
{
    protected function render(string $view, array $data = [])
    {
        // Rend les variables accessibles dans la vue
        extract($data);

        // Header
        require __DIR__ . '/../Views/layout/header.php';

        // Vue principale
        require __DIR__ . '/../Views/' . $view . '.php';

        // Footer
        require __DIR__ . '/../Views/layout/footer.php';
    }
}