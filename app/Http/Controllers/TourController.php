<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\View\View;

class TourController extends Controller
{
    public function index(): View
    {
        $tours = Tour::with([
            'categoria',
            'guia',
            'servicios'
        ])
            ->activos()
            ->orderBy('fecha_salida')
            ->paginate(9);
        return view('tours.index', compact('tours'));
    }

    public function show(Tour $tour): View
    {
        $tour->load([
            'categoria',
            'guia',
            'servicios'
        ]);

        $cuposDisponibles = $tour->cuposDisponibles();

        return view('tours.show', compact(
            'tour',
            'cuposDisponibles'
        ));

    }
}

