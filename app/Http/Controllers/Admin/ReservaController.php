<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class ReservaController extends Controller
{
    // Mostrar las reservas.
    public function index(): View
    {
        $reservas = Reserva::with([
            'user',
            'tour',
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.reservas.index', compact('reservas'));
    }

    public function estado(Request $request, Reserva $reserva)
    {
        // Validar el estado recibido
        $datos = $request->validate([
            'estado' => ['required', 'in:pendiente,confirmada,cancelada'],
        ]);

        DB::transaction(function () use ($reserva, $datos) {
            // bloquear el tour mientras comprobamos los cupos
            $tour = $reserva->tour()
                ->lockForUpdate()
                ->firstOrFail();

            // Comprobar si el nuevo estado consume cupos
            if (in_array($datos['estado'], ['pendiente', 'confirmada'])) {

                //obtener las personas reservadas por otras reservas activas
                $personasReservadas = Reserva::where('tour_id', $tour->id)
                    ->where('id', '!=', $reserva->id)
                    ->whereIn('estado', ['pendiente', 'confirmada'])
                    ->sum('cantidad_personas');

                // Comprobar la capacidad
                if (
                    $personasReservadas + $reserva->cantidad_personas
                    > $tour->cupo_maximo
                ) {
                    throw ValidationException::withMessages([
                        'estado' => 'No hay suficientes cupos disponibles para confirmar esta reserva.',
                    ]);
                }
            }

            //Actualizar la reserva
            $reserva->update([
                'estado' => $datos['estado'],
            ]);
        });

        return redirect()
            ->route('admin.reservas.index')
            ->with('success', 'Estado de la reserva actualizado correctamente.');
    }
}
