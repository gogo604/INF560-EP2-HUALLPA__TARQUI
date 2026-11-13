<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class ReservaController extends Controller
{
    // registro reserva
    public function store(Request $request, Tour $tour) {
        // validar los datos enviados por el formulario
        $datos = $request->validate([
            'cantidad_personas' => ['required', 'integer', 'min:1'],
            'observacion'=>['nullable','string','max:1000'],
        ]);

        //registrar la reserva dentro de una transaccion.
        DB::transaction(function () use ($tour, $datos) {

            //Bloquear el tour mientras comprobamos los cupos.
            $tourBloqueado = Tour::whereKey($tour->id)
                ->lockForUpdate()
                ->firstOrFail();

            // comprobar que el tour este activo y no haya salido.
            if (
                !$tourBloqueado->activo ||
                $tourBloqueado->fecha_salida->isPast()
            ) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'tour' => 'Este tour ya no está disponible.'
                ]);
            }

            // 4 comprobar los cupos disponibles
            $cantidad = $datos ['cantidad_personas'];

            if ($cantidad > $tourBloqueado->cuposDisponibles()) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'cantidad_personas' => 'No hay suficientes cupos disponibles.',
                ]);
            }

            //5 crear reserva.
            Reserva::create([
                'user_id' => auth()->id(),
                'tour_id' =>$tourBloqueado->id,
                'cantidad_personas' => $cantidad,
                'estado'=>'pendiente',
                'observacion'=>$datos['observacion'] ?? null,
            ]);
        });

        // 6 redireccinar al listado de reservas
        return redirect()
            ->route('reservas.mias')
            ->with('success', '¡ Tu reserva se registró correctamente!');
    }

    // Mostrar las reservas del turista autenticado.
    public function mias(): View
    {
        // Próximamente implementaremos el listado
        $reservas = auth()->user()
            ->reservas()
            ->with('tour.categoria')
            ->latest()
            ->paginate(10);

        return view('reservas.mias', compact('reservas'));
    }

    public function cancelar(Reserva $reserva) {
        //
        // 1 comprobar si el turista tiene permiso para cancelar
        $this->authorize('cancel', $reserva);

        //2 cancelar la reserva dentro de una transaccion
        DB::transaction(function () use ($reserva) {
            // bloquear tour mientras actualiza la reserva.
            $tour = Tour::whereKey($reserva->tour_id)
                ->lockForUpdate()
                ->firstOrFail();

            //actualiza estado.
            $reserva->update([
                'estado' => 'cancelada',
            ]);
        });

        //3 regresar al listado.
        return redirect()
            ->route('reservas.mias')
            ->with('success', 'Tu reserva ha sido cancelada correctamente.');
    }
}
