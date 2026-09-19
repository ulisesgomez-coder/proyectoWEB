<?php

namespace App\Http\Controllers;

use App\Models\Huerto;
use Illuminate\View\View;

class HuertoController extends Controller
{
    public function index(): View
    {
        $huertos = Huerto::query()
            ->with('propietario')
            ->orderBy('id')
            ->paginate(5);

        return view('huertos.index', [
            'huertos' => $huertos,
        ]);
    }
}