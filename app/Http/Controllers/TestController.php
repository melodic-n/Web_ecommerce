<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return "Connexion réussie!";
        } catch (\Exception $e) {
            return "Erreur de connexion : " . $e->getMessage();
        }
    }
}
