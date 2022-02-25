<div class="modal-header">
    <h5 class="modal-title" id="editDataLabel">Ubah Lapangan</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="POST" action="{{url('field/update/'.$field->id)}}">
    @csrf
    <input type="hidden" name="id" value="{{$field->id}}">
    <div class="modal-body">
        <div class="mb-3">
            <label for="field" class="form-label">Nama Lapangan</label>
            <input type="text" class="form-control" id="field" required name="name" value="{{$field->name}}" aria-describedby="emailHelp">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Ubah</button>
    </div>
</form>
