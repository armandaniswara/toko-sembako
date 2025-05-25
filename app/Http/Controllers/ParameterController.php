<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Shipment;

class ParameterController extends Controller
{

    public function index(Request $request)
    {
        $type = $request->get('type', 'payment'); // 'payment' adalah default jika tidak ada parameter 'type'

        $models = [
            'payment' => Payment::class,
            'shipment' => Shipment::class,
        ];

        if (!array_key_exists($type, $models)) {
            abort(404);
        }

        $model = $models[$type];
        $data = $model::all();

        return view('admin.parameter', compact('data', 'type'));
    }

    private function getModelClass($type)
    {
        $models = [
            'payment' => Payment::class,
            'shipment' => Shipment::class,
        ];

        return $models[$type] ?? null;
    }

    private function getTableName($type)
    {
        $tables = [
            'payment' => 'payment_status',
            'shipment' => 'shipment_status',
        ];

        return $tables[$type] ?? 'unknown';
    }

    public function store(Request $request)
    {
        $type = $request->input('type');

        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:' . $this->getTableName($type),
            'name' => 'required|string|max:100',
        ]);

        $modelClass = $this->getModelClass($type);

        if (!class_exists($modelClass)) {
            return redirect()->back()->withErrors(['type' => 'Invalid type selected.']);
        }

        $modelClass::create([
            'code' => $validated['code'],
            'name' => $validated['name'],
        ]);

        return redirect()->route('parameter.index', ['type' => $type])->with('success', 'Data successfully added.');
    }

    public function destroy($type, $id)
    {
        $modelClass = $this->getModelClass($type);

        if (!class_exists($modelClass)) {
            return redirect()->back()->withErrors(['type' => 'Invalid type selected.']);
        }

        $item = $modelClass::find($id);

        if (!$item) {
            return redirect()->back()->withErrors(['not_found' => 'Data not found.']);
        }

        $item->delete();

        return redirect()->route('parameter.index', ['type' => $type])->with('success', 'Data successfully deleted.');
    }

    public function edit($type, $id)
    {
        $modelClass = $this->getModelClass($type);

        if (!class_exists($modelClass)) {
            return redirect()->back()->withErrors(['type' => 'Invalid type selected.']);
        }

        $item = $modelClass::find($id);

        if (!$item) {
            return redirect()->back()->withErrors(['not_found' => 'Data not found.']);
        }



        return view('admin.parameter-edit', compact('item', 'type'));
    }


    public function update(Request $request, $type, $id)
    {
        $modelClass = $this->getModelClass($type);

        if (!class_exists($modelClass)) {
            return redirect()->route('parameter.index', ['type' => $type])
                ->withErrors(['type' => 'Invalid parameter type.']);
        }

        $item = $modelClass::find($id);

        if (!$item) {
            return redirect()->route('parameter.index', ['type' => $type])
                ->withErrors(['not_found' => 'Data not found.']);
        }

        // Validasi input
        $validated = $request->validate([
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:100',
        ]);

        // Update data
        $item->update($validated);

        return redirect()->route('parameter.index', ['type' => $type])
            ->with('success', ucfirst($type) . ' updated successfully.');
    }

}
