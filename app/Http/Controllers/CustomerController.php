<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $data = [
            'customer' => Customer::all(),
            'title' => 'Pelanggan',
        ];
        return view('customer.index',$data);
    }

    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        return redirect()->back()->with([
            'msg' => 'Data Berhasil Di Tambahkan',
            'type' => 'success'
        ]);
    }
    
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request,$id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        return redirect()->back()->with([
            'msg' => 'Data Berhasil Di Ubah',
            'type' => 'success'
        ]);
    }

    public function destory($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->back()->with([
            'msg' => 'Data Berhasil Di Hapus',
            'type' => 'success'
        ]);
    }
}
