@extends('layouts.mainlayout')

@section('title', 'Profile')

@section('content')
<div class="mt-5">
    <h1>Your Rent Log</h1>
    <x-rent-log-table :rentlog='$rent_logs' > 
</div>
@endsection

