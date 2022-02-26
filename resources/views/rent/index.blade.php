@extends('layouts.app')

@section('content')
<style>
    .BOOKING {
        color: yellow;
    }

    .SELESAI {
        color: green;
    }

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-start">{{$title}}</h3>
                    <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#addData">
                        <i class="fa fa-plus text-primary"></i> Tambah
                    </button>
                </div>
                <div id="printableId">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Lapangan</th>
                                <th>Tanggal</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>DP</th>
                                <th>Harga Perjam</th>
                                <th>Total</th>
                                <th>STATUS</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            @foreach ($rent as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->field_name }}</td>
                                <td>{{ $data->booking_date }}</td>
                                <td>{{ $data->booking_start }}</td>
                                <td>{{ $data->booking_end }}</td>
                                <td>{{ "Rp " . number_format($data->down_payment,2,',','.') }}</td>
                                <td>{{ "Rp " . number_format($data->cost_hourly,2,',','.') }}</td>
                                <td>{{ "Rp " . number_format($data->cost_total,2,',','.') }}</td>
                                <td class="{{$data->status}}">{{$data->status}}</td>
                                <td class="text-center">
                                    <button type="button" onclick="editData({{$data->id}})" class="btn btn-outline-success">
                                        <i class="fa fa-check"></i>
                                    </button> |
                                    <button type="button" class="btn btn-outline-danger"
                                        onclick="deleteData({{$data->id}})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="button" onclick="printTabel()" class="float-start btn btn-outline-success">
                            <i class="fa fa-print"></i>
                        </button>
                        <h3 class="float-end">Total Pemasukan : {{ "Rp " . number_format($totalCostAll,2,',','.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDataLabel">Tambah {{$title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="rent" class="form-label">Pelanggan</label>
                                <select class="form-select" required name="id_customer">
                                    <option selected disabled value="">Pilih</option>
                                    @foreach ($customer as $data)
                                    <option value="{{$data->id}}">{{$data->name}} ({{$data->phone}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="rent" class="form-label">Lapangan</label>
                                <select class="form-select" required name="id_field">
                                    <option selected disabled value="">Pilih</option>
                                    @foreach ($field as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="field" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" required name="booking_date">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="field" class="form-label">Mulai Jam</label>
                                <input type="time"  class="form-control" id="startTime" required
                                    name="booking_start">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="field" class="form-label">Selesai Jam</label>
                                <input type="time"  class="form-control" id="endTime" required
                                    name="booking_end">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="mb-3">
                                <label for="field" class="form-label">Uang Muka (DP)</label>
                                <input type="text" onkeyup="digits(this)" class="form-control" required
                                    name="down_payment">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="field" class="form-label">Harga Perjam</label>
                                <input type="text" onkeyup="diffs(this)" id="costHour" class="form-control" required
                                    name="cost_hourly">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="field" class="form-label">Total Harga Sewa</label>
                                <input type="text" onkeyup="digits(this)" id="totalCost" readonly class="form-control"
                                    required name="cost_total">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="editDataModal">
        </div>
    </div>
</div>

@endsection

@push('page-js')
<script>
    let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
        'editData')) // Returns a Bootstrap modal instance
    let body = document.getElementById('editDataModal');
    let startTime = document.getElementById('startTime');
    let endTime = document.getElementById('endTime');
    let costHour = document.getElementById('costHour');
    let totalCost = document.getElementById('totalCost');

    function deleteData(id) {
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(id)
                window.location.href = '/rent/delete/' + id;
            }
        })
    }

    async function editData(id) {
        Swal.fire({
            title: 'Are you sure?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Selesai Sewa'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/rent/update/' + id;
            }
        })

    }

    var diffs = function (box) {
        box.value = box.value.replace(/[^0-9]/g, '');
        if (startTime.value == '' || endTime.value == '') {
            box.value = ''
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Isi Terlebih Dahulu Jam Mulai Dan Selesai!',
                footer: '<a href>Why do I have this issue?</a>'
            })
        } else {
            let x = startTime.value.substring(0, 2);
            let y = endTime.value.substring(0, 2);
            let deffs = Math.abs(x - y);
            console.log(deffs)
            totalCost.value = deffs * costHour.value;
        }

    }
    var digits = function (box) {
        box.value = box.value.replace(/[^0-9]/g, '');
    }

    function printTabel() {
        var printHtml = window.open('', 'PRINT', 'height=400,width=600');

        printHtml.document.write(`<html>
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <head>`);
        printHtml.document.write(document.getElementById("printableId").innerHTML);
        printHtml.document.write('</body></html>');
    
        printHtml.document.close(); 
        printHtml.focus();
    
        printHtml.print();

        
    }

</script>
@endpush
