@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header text-center">Sewa</div>
                <div class="card-body">
                    <h1 class="text-center">{{$rent}}</h1>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header text-center">Pelanggan</div>

                <div class="card-body">
                    <h1 class="text-center">{{$customer}}</h1>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header text-center">Lapangan</div>
                <div class="card-body">
                    <h1 class="text-center">{{$field}}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
