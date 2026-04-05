<?php

namespace App\Controllers;

use App\Models\Trajet;
use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $trajets = (new Trajet())->getAvailable();

        $this->render('home/index', [
            'trajets' => $trajets
        ]);
    }
}