<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan | @yield('title') </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="main d-flex flex-column justify-content-between">
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Perpustakaan</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        
      
        <div class="body-content h-100">
            <div class="row g-0 h-100">
                <div class="sidebar col-lg-2 collapse d-lg-block" id="navbarSupportedContent">
                   @if (Auth::user())
                        @if (Auth::user()->role_id == 1)
                        <a href="/dashboard" @if (request()->route()->uri == 'dashboard') class="active" @endif >Dashboard</a>
                        <a href="/books" @if (request()->route()->uri == 'books') class="active"  @endif >Books</a>
                        <a href="/categories" @if (request()->route()->uri == 'categories' || request()->route()->uri == 'category-add/{slug}' || request()->route()->uri == 'dashboard' || request()->route()->uri == 'category-deleted') class="active" @endif>Category</a>
                        <a href="/users" @if (request()->route()->uri == 'users') class="active" @endif >User</a>
                        <a href="/rent-logs" @if (request()->route()->uri == 'rent-logs') class="active" @endif >Rent Log</a>
                        <a href="/"  @if (request()->route()->uri == '/') class="active" @endif>Book List</a>
                        <a href="/book-rent">Book Rent</a>
                        <a href="/rent-return">Book Return</a>
                        <a href="/logout">Logout</a>
                        @else
                        <a href="profile" @if (request()->route()->uri == 'profile') class="active" @endif >Profile</a>
                        <a href="/"  @if (request()->route()->uri == '/') class="active" @endif>Book List</a>
                        <a href="Logout">Logout</a>
                        @endif
                    @else
                    <a href="/"  @if (request()->route()->uri == '/') class="active" @endif>Book List</a>
                    <a href="/login">login</a>
                 @endif
                      
                </div>
                    <div class="content p-5 col-lg-10">
                        @yield('content')
                    </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    
</body>

</html>
