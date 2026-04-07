<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Country;

class ShippingController extends Controller
{
    // SHOW PAGE
    public function create()
    {
        $countries = Country::all();
        $shippingCharges = Shipping::with('country')->get();

        return view('admin.shipping.create', compact('countries', 'shippingCharges'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'amount' => 'required|numeric'
        ]);

        Shipping::create([
            'country_id' => $request->country_id,
            'amount' => $request->amount
        ]);

        return redirect()->back()->with('success', 'Shipping created successfully');
    }
    public function edit($id)
{
    $shipping = Shipping::findOrFail($id);
    $countries = Country::all();

    return view('admin.shipping.edit', compact('shipping', 'countries'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'country_id' => 'required',
        'amount' => 'required|numeric'
    ]);

    $shipping = Shipping::findOrFail($id);

    $shipping->update([
        'country_id' => $request->country_id,
        'amount' => $request->amount
    ]);

    return redirect()->route('admin.shipping.create')
        ->with('success', 'Shipping updated successfully');
}

    // DELETE
    public function delete($id)
    {
        Shipping::find($id)->delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }
}