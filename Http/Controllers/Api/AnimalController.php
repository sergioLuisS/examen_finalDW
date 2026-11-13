<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    // mostrar todos los animales
    public function index()
    {
        return response()->json(Animal::all(), 200);
    }

    // guardar un animal nuevo
    public function store(Request $request)
    {
        // revisar los datos
        $datos = $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|string|max:100',
            'raza' => 'required|string|max:100',
            'edad' => 'required|integer|min:0',
        ]);

        return response()->json(Animal::create($datos), 201);
    }

    // buscar animal por id
    public function show($id)
    {
        return response()->json(Animal::findOrFail($id), 200);
    }

    // actualizar los datos
    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);

        // validar antes de actualizar
        $datos = $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|string|max:100',
            'raza' => 'required|string|max:100',
            'edad' => 'required|integer|min:0',
        ]);

        $animal->update($datos);

        return response()->json($animal, 200);
    }

    // eliminar un animal
    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return response()->json([
            'mensaje' => 'Animal eliminado correctamente'
        ], 200);
    }
}
