@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('content')
<h1>
    ini halaman books
</h1>
<div class="mt-5 d-flex justify-content-end">
    <a href="book-deleted" class="btn btn-secondary me-3">View Deleted Data</a> 
    <a href="book-add" class="btn btn-primary">Add Data</a> 
</div>

<div class="mt-5">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
</div>

<div class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Code</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->book_code }}</td>
                <td>{{ $item->title }}</td>
                <td>
                    @foreach ($item->categories as $category)
                        {{ $category->name }} <br>
                    @endforeach
                </td>
                <td>{{ $item->status }}</td>
                <td> 
                    <a href="book-edit/{{ $item->slug }}">Edit</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->slug }}">Delete</a>
                    <div class="modal fade" id="exampleModal{{ $item->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="/book-deleted/{{ $item->slug }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        @method('DELETE')
                                        Apakah anda yakin menghapus untuk menghapus {{ $item->name }} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tidak</button>
                                        <button type="submit" class="btn btn-primary">Yakin</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

