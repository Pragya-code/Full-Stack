@extends('layouts.master')

@section('title', 'Add New Student')

@section('content')
    
    <form action="index.php?action=store" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="course">Course:</label>
            <input type="text" id="course" name="course" required>
        </div>
        
        <button type="submit" class="btn btn-success">Add Student</button>
        <a href="index.php?action=index" class="btn">Cancel</a>
    </form>
@endsection