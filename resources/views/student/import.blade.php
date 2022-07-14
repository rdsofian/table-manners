<form action="{{ route('student.import') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="file" name="file" >
    </div>
    <div class="form-group">
        <input type="submit" value="import" >
    </div>
</form>
