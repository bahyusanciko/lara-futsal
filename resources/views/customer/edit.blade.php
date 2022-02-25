<div class="modal-header">
    <h5 class="modal-title" id="editDataLabel">Ubah Customer</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="POST" action="{{url('customer/update/'.$customer->id)}}">
    @csrf
    <input type="hidden" name="id" value="{{$customer->id}}">
    <div class="modal-body">
        <div class="mb-3">
            <label for="customer" class="form-label">Nama</label>
            <input type="text" class="form-control" id="customer" required value="{{$customer->name}}" name="name" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">NO. HP</label>
            <input type="text" class="form-control" id="phone" onkeyup="digits(this)" required value="{{$customer->phone}}" name="phone" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="customer" class="form-label">Alamat</label>
            <textarea class="form-control" name="address" rows="3" required>{{$customer->address}}</textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Ubah</button>
    </div>
</form>
