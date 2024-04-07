@extends('layouts.app')
@section('content')

<div class="main-container">
  <div class="container">
    <h1>Welcome to Student Management System</h1>
    <p>Manage your students efficiently with our system</p>
    <img src="student_management_image.jpg" alt="Student Management System Image">
  </div>
</div>
@endsection

@push('css')

<style>

.main-container {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        img {
            width: 300px;
            height: auto;
            margin-bottom: 20px;
        }
</style>
    
@endpush