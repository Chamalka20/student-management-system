@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Add Student Details</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action={{route('student.add')}} method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" name="age" placeholder="Enter age">
                </div>
                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" class="form-control-file" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h1 class="text-center mb-4">Student List</h1>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->age }}</td>
                        <td>{{$student->image}}</td>
                        <td style="background-color: {{ $student->status === 1 ? '#c8e6c9' : '#ffcdd2' }}">
                            @if ($student->status === 1)
                                <i class="fa fa-check text-success" aria-hidden="true"></i> Active
                            @else
                                <i class="fa fa-times text-danger" aria-hidden="true"></i> Inactive
                            @endif
                        </td>
                        <td>
                            <form action={{ route('student.delete',  $student->id)}} method="get" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <a  class="btn btn-primary btn-sm" class="btn" href="{{ route('student.active',  $student->id)}}"><i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i></a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-student" data-student-id="{{ $student->id }}">Edit</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

  
  <!-- Modal -->
  <div class="modal fade" id="studentEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Student Update</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="studentEditContent">
          ...
        </div>
      </div>
    </div>
  </div>
    
@endsection

@push('js')
<script>
    $(document).ready(function() {
        
        $('.edit-student').on('click', function() {
            var studentId = $(this).data('student-id');
            editStudentDetails(studentId);
        });
    });

    function editStudentDetails(studentId) {
        var data = {
            studentId: studentId,
        };
        $.ajax({
            url: "{{ route('student.edit') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            dataType: 'html',
            data: data,
            success: function(response) {
                $('#studentEdit').modal('show');
                $('#studentEditContent').html(response);
            },
            
        });
    }
</script>
@endpush