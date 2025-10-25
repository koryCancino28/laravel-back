<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        return response()->json(Vehiculo::all());
    }

    public function show($id)
    {
        $vehiculo = Vehiculo::find($id);
        if (!$vehiculo) {
            return response()->json(['error' => 'Vehículo no encontrado'], 404);
        }
        return response()->json($vehiculo);
    }

    public function buscar(Request $request){
        $query = $request->input('query');
        // print_r($query);
        // exit;
        $fechaDesde = $request->input('fecha_desde');
        $fechaHasta = $request->input('fecha_hasta');

        // $vehiculo = Vehiculo::where('placa', 'like', '%'. $query. '%')->get();
        $vehiculoQuery = Vehiculo::query();
        if($query){
            $vehiculoQuery->where('placa', 'like', '%'.$query.'%');
        }
        if($fechaDesde){
            $vehiculoQuery->where('fecha_ingreso', '>=', $fechaDesde);
        }
        if($fechaHasta){
            $vehiculoQuery->where('fecha_ingreso', '<=', $fechaHasta);
        }
        $vehiculo = $vehiculoQuery->get();
        if ($vehiculo->isEmpty()) {
            return response()->json([]);
        }
        return response()->json($vehiculo);
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|max:10',
            'fecha_ingreso' => 'required|date',
        ]);

        $vehiculo = Vehiculo::create($request->all());
        return response()->json($vehiculo, 201);
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::find($id);
        if (!$vehiculo) {
            return response()->json(['error' => 'Vehículo no encontrado'], 404);
        }

        $vehiculo->update($request->all());
        return response()->json($vehiculo);
    }

    public function destroy($id)
    {
        $vehiculo = Vehiculo::find($id);
        if (!$vehiculo) {
            return response()->json(['error' => 'Vehículo no encontrado'], 404);
        }

        $vehiculo->delete();
        return response()->json(null, 204);
    }
}
