@extends('layouts.master')

@section('title', 'All Students')

@section('content')
    <a href="index.php?action=create" class="btn btn-success">Add New Student</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($students) > 0)
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student['id'] }}</td>
                        <td>{{ $student['name'] }}</td>
                        <td>{{ $student['email'] }}</td>
                        <td>{{ $student['course'] }}</td>
                        <td>
                            <a href="index.php?action=edit&id={{ $student['id'] }}" class="btn">Edit</a>
                            <a href="index.php?action=delete&id={{ $student['id'] }}" 
                               class="btn btn-danger" 
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" style="text-align: center;">No students found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection