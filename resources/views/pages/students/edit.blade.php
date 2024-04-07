<form action={{route('student.update',$student->id)}} method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{$student->name}}">
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="number" class="form-control" name="age" placeholder="Enter age"value="{{$student->age}}">
    </div>
    <div class="form-group">
        <label for="image">Upload Image</label>
        <input type="file" class="form-control-file" name="image" value="{{$student->image}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>