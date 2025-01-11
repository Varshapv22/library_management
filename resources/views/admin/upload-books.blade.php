@extends('layout.app')

@section('content')
<div class="container">
    <h1>Upload Books</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.upload.books') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Upload CSV File:</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <button type="submit" class="mt-3 btn btn-primary">Upload</button>
    </form>
</div>
@endsection
