@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('content')

<h1>Detail User</h1>
<div class="mt-5 d-flex justify-content-end">
    @if ($user->status == 'inactive')
    <a href="/user-approve/{{ $user->slug }}" class="btn btn-info">Approve Userr</a>
    @endif

</div>

<div class="mt-5">
   @if (session('status'))
   <div class="alert alert-success">
       {{ session('status') }}
</div>
@endif
</div>
<div class="my-5">
   
        <form action="" method="POST">
            @csrf
            <div>
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" readonly value="{{ $user->username }}">
            </div>
           
            <div>
                <label for="status" class="form-label">phone</label>
                <input type="text" name="phone" id="phone" class="form-control" readonly value="{{ $user->phone }}">
            </div>
            <div>
                <label for="address" class="form-label">address</label>
               <textarea name="address" id="address" class="form-control" rows="5" readonly >{{ $user->address }}"</textarea>
            </div>
            <div>
                <label for="status" class="form-label">status</label>
                <input type="text" name="status" id="status" class="form-control" readonly value="{{ $user->status }}">
            </div>
           
        </form>
    
</div>

<div class="mt-5">
    <h1> User rentlog</h1>
    <x-rent-log-table :rentlog='$rent_logs' > 
</div>
@endsection
