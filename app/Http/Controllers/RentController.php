<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Customer;
use App\Models\Field;

class RentController extends Controller
{
    public function index()
    {
        $fieldCheck = Field::all();
        $fieldAvailable = [];
        foreach ($fieldCheck as $key => $value) {
          $checkRent = Rent::where('id_field',$value->id)->where('status','BOOKING')->first();
          if (!$checkRent) {
            $fieldAvailable[] = $value;
          }
        }
        $data = [
            'rent' => Rent::select('rents.*', 'customers.name', 'fields.name as field_name')
                ->join('customers', 'rents.id_customer', '=', 'customers.id')
                ->join('fields', 'rents.id_field', '=', 'fields.id')
                ->get(),
            'customer' => Customer::all(),
            'field' => $fieldAvailable,
            'title' => 'Sewa',
            'totalCostAll' => Rent::sum('cost_total'),
        ];
        return view('rent.index',$data);
    }

    public function store(Request $request)
    {
        $rent = new Rent;
        $rent->id_customer = $request->id_customer;
        $rent->id_field = $request->id_field;
        $rent->booking_date = $request->booking_date;
        $rent->booking_start = $request->booking_start;
        $rent->booking_end = $request->booking_end;
        $rent->down_payment = $request->down_payment;
        $rent->cost_hourly = $request->cost_hourly;
        $rent->cost_total = $request->cost_total;
        $rent->status = 'BOOKING';
        $rent->save();
        return redirect()->back()->with([
            'msg' => 'Data Berhasil Di Tambahkan',
            'type' => 'success'
        ]);
    }
    

    public function update($id)
    {
        $rent = Rent::find($id);
        $rent->status = 'SELESAI';
        $rent->save();
        return redirect()->back()->with([
            'msg' => 'Data Berhasil Di Ubah',
            'type' => 'success'
        ]);
    }

    public function destory($id)
    {
        $rent = Rent::find($id);
        $rent->delete();
        return redirect()->back()->with([
            'msg' => 'Data Berhasil Di Hapus',
            'type' => 'success'
        ]);
    }
}
