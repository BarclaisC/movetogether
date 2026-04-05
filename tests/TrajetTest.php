<?php

use PHPUnit\Framework\TestCase;
use App\Models\Trajet;

class TrajetTest extends TestCase
{
    public function testGetAvailableReturnsArray()
    {
        $trajet = new Trajet();
        $result = $trajet->getAvailable();

        $this->assertIsArray($result);
    }
}