<?php

namespace App\Core;

class Controller
{
    protected function render(string $view, array $data = [])
    {
        // Rend les variables accessibles dans la vue
        extract($data);

        // On capture le contenu de la vue
        ob_start();
        require __DIR__ . '/../Views/' . $view . '.php';
        $content = ob_get_clean();

        // On charge le layout global
        require __DIR__ . '/../Views/layout/layout.php';
    }
}