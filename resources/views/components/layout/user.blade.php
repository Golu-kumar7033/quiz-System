<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<div class="d-flex">

<!--<style>
    

.sidebar {
  width: 200px;
  height: 100vh;
  position: fixed;
  left: 0;
  top: 0;
  background: #1e293b;
  padding: 20px;
  box-sizing: border-box;
}

.sidebar h2 {
  color: white;
}

.sidebar a {
  display: block;
  color: #cbd5e1;
  text-decoration: none;
  padding: 12px 0;
}

.sidebar a:hover {
  color: white;
}

.content {
  margin-left: 200px;
}

</style>
    <!- Sidebar ->
<div class="sidebar">
  <h2>My App</h2>
  <a href="#">Home</a>
  <a href="#">Dashboard</a>
  <a href="#">Profile</a>
  <a href="#">Settings</a>
  <a href="#">Logout</a>
</div>-->



    <div class="content flex-grow-1">

        <!-- Topbar -->
        @include('components.includes.usernav')

        <main class="p-5">

            @yield('contents')
        </main>

@include('components.includes.footer')

    </div>

</div>


<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>