<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\View\View;
use App\Http\Requests\StoreTourRequest;
use App\Models\Categoria;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Requests\UpdateTourRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    /**
     * Display a listing of the resource (Mostrar * tours).
     */
    public function index()
    {
        //
        $tours = Tour::with([
            'categoria',
            'guia',
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::orderBy('nombre')->get();

        $servicios = Servicio::orderBy('nombre')->get();

        $guias = User::role('guia')->orderBy('name')->get();

        return view('admin.tours.create', compact(
            'categorias',
            'servicios',
            'guias',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourRequest $request)
    {
        //

        $datos = $request->validated();

        DB::transaction(function () use ($request, $datos) {

            $servicios = $datos['servicios'];

            unset($datos['servicios']);

            $datos['slug'] = Str::slug($datos['titulo'])
                . '-' . Str::lower(Str::random(6));

            if ($request->hasFile('imagen')) {
                $datos['imagen'] = $request->file('imagen')
                    ->store('tours', 'public');
            }

            $tour = Tour::create($datos);

            $tour->servicios()->attach($servicios);
        });

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Tour registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour): View
    {
        //
        $categorias = Categoria::orderBy('nombre')->get();

        $servicios = Servicio::orderBy('nombre')->get();

        $guias = User::role('guia')->orderBy('name')->get();

        $tour->load('servicios');

        return view('admin.tours.edit', compact(
            'tour',
            'categorias',
            'servicios',
            'guias',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {
        //
        $datos = $request->validated();

        $servicios = $datos['servicios'];

        unset($datos['servicios']);

        // actualizar el slug si cambia el titulo
        if ($tour->titulo !== $datos['titulo']) {
            $datos['slug'] = Str::slug($datos['titulo'])
                . '-' . Str::lower(Str::random(6));
        }

        //Guardar una imagen si se seleccionó
        if ($request->hasFile('imagen')) {
            if ($tour->imagen) {
                Storage::disk('public')->delete($tour->imagen);
            }

            $datos['imagen'] = $request->file(('imagen'))
                ->store('tours', 'public');
        }

        DB::transaction(function () use ($tour, $datos, $servicios) {
            $tour->update($datos);

            //actualizar los servicios relacionados
            $tour->servicios()->sync($servicios);
        });

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Tour actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        //para no permitir eliminar tours que tengan reservas
        if ($tour->reservas()->exists()) {
            return redirect()
                ->route('admin.tours.index')
                ->with('error', 'Nose puede eliminar este tour porque tiene reservas asociados.');

        }

        // Eliminar imagen almacenada
        if ($tour-> imagen) {
            Storage::disk('public')->delete($tour->imagen);
        }

        // eliminarservicios relacionados
        $tour->servicios()->detach();

        //eliminar el tour
        $tour->delete();

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Tour eliminado correctamente.');
    }
}
