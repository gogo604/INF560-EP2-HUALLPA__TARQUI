<?php

namespace App\Http\Controllers\Guia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\View\View;


class TourController extends Controller
{
    // Tours asifnados al guia autenticado
    public function index(): View
    {
        $tours = Tour::with([
            'categoria',
            'servicios',
            'reservas',
        ])
            ->where('guia_id', auth()->id())
            ->orderBy('fecha_salida')
            ->paginate(10);

        return view('guia.tours.index', compact('tours'));

    }
}
