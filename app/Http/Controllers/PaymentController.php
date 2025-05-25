<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {


        // Ambil semua data dari view
        $parameters = Payment::all();

        // Atau filter data
        // $activePaymentStatuses = PaymentStatusView::where('code', 'active')->get();

        return view('admin.parameter', compact('parameters'));
    }

    public function destroy(Payment $parameter)
    {
        $parameter->delete();

        return redirect()->route('admin.parameter')->with('success', 'Parameter berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $parameter = Payment::findOrFail($id);

        // Validasi input
        $request->validate([
            'code' => 'required|string|max:100',
            'name' => 'required|string|max:255',
        ]);

        // Update data dasar
        $parameter->code = $request->code;
        $parameter->name = $request->name;

        $parameter->save();

        return redirect()->route('admin.parameter')->with('success', 'Parameter updated successfully!');
    }
}
