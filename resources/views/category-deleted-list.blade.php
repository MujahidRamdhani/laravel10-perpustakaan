@extends('layouts.mainlayout')

@section('title', 'Deleted Category')


@section('content')
<h1> Deleted Category list</h1>
<div class="mt-5 d-flex justify-content-end">
    <a href="category" class="btn btn-primary">back</a> 
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
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($deletedCategories as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td> 
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->slug }}">restore</a>
                <div class="modal fade" id="exampleModal{{ $item->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/category-restore/{{ $item->slug }}" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    @method('get')
                                    Apakah anda yakin restore untuk restore {{ $item->name }} ?
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
</div>
@endsection

