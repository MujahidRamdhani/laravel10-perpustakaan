@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('content')

<h1>User list</h1>
<div class="mt-5 d-flex justify-content-end">
    <a href="/user-banned" class="btn btn-secondary me-3">View Banned User</a>
    <a href="/registered-users" class="btn btn-primary">New Registered User</a>
</div>

{{-- <div class="mt-5">
   @if (session('status'))
   <div class="alert alert-success">
       {{ session('status') }}
</div>
@endif
</div> --}}
<div class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->username }}</td>
                <td>
                  @if ($item->phone)
                  {{ $item->phone }}
                  @else
                      -
                  @endif
                </td>  
                <td> 
                  <a href="user-detail/{{ $item->slug }}">detail</a>
                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->slug }}">Ban User</a>
                  <div class="modal fade" id="exampleModal{{ $item->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="/user-deleted/{{ $item->slug }}" method="POST">
                                  <div class="modal-body">
                                      @csrf
                                      @method('DELETE')
                                      Apakah anda yakin menghapus untuk menghapus {{ $item->username }} ?
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
