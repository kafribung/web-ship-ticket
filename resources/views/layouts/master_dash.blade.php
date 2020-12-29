<!DOCTYPE html>
<html lang="en">

<head>
    <title>SB Admin 2 - Dashboard</title>
    @include('includes.css_dash')
</head>

<body id="page-top">
    <div id="app">
        <router-view></router-view>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    
    <script src="{{ asset('js/app.js') }}" defer></script>
    @include('includes.script_dash')
</body>

</html>