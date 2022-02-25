<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;

class FieldController extends Controller
{
    public function index()
    {
        $data = [
            'field' => Field::all(),
            'title' => 'Lapangan',
        ];
        return view('field.index',$data);
    }

    public function store(Request $request)
    {
        $field = new Field;
        $field->name = $request->name;
        $field->save();
        return redirect()->back()->with([
            'msg' => 'Data Berhasil Di Tambahkan',
            'type' => 'success'
        ]);
    }
    
    public function edit($id)
    {
        $field = Field::find($id);
        return view('field.edit', compact('field'));
    }

    public function update(Request $request,$id)
    {
        $field = Field::find($id);
        $field->name = $request->name;
        $field->save();
        return redirect()->back()->with([
            'msg' => 'Data Berhasil Di Ubah',
            'type' => 'success'
        ]);
    }

    public function destory($id)
    {
        $field = Field::find($id);
        $field->delete();
        return redirect()->back()->with([
            'msg' => 'Data Berhasil Di Hapus',
            'type' => 'success'
        ]);
    }
}
