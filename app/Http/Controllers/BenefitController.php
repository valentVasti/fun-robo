<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index()
    {
        $benefit = Benefit::all();

        return view('backend.benefit.index', [
            'activePage' => 'benefit' // Set the active page to 'home'
        ], compact('benefit'));
    }

    public function update(Request $request)
    {
        $benefit = Benefit::find($request->id);

        $updated_data = $benefit->update([
            'mascot_path' => $request->mascot_path,
            'benefit' => $request->benefit
        ]);

        return  response()->json([
            'Status' => 'Success',
            'data' => $updated_data
        ], 200);
    }
}
