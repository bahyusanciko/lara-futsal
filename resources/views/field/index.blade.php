@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-start">{{$title}}</h3>
                    <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#addData">
                        <i class="fa fa-plus text-primary"></i> Tambah
                    </button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        @foreach ($field as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name }}</td>
                            <td class="text-center">
                                <button type="button" onclick="editData({{$data->id}})" class="btn btn-outline-warning">
                                    <i class="fa fa-pencil"></i>
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
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDataLabel">Tambah {{$title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="field" class="form-label">Nama {{$title}}</label>
                        <input type="text" class="form-control" id="field" required name="name"
                            aria-describedby="emailHelp">
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
    let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editData')) // Returns a Bootstrap modal instance
    let body = document.getElementById('editDataModal');
    function deleteData(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(id)
                window.location.href = '/field/delete/' + id;
            }
        })
    }

    async function editData(id) {
        const response = await fetch(`{{url('/field/edit/${id}')}}`);
        let data = await response.text(); 
        if (data) {
            body.innerHTML = data
            modal.show();
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href>Why do I have this issue?</a>'
            })
        }

    }

</script>
@endpush
