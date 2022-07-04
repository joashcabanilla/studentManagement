<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>   
    
    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

    {{-- icon links --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,700,1,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,700,1,200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,700,1,200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,700,1,200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,700,1,200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,700,1,200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,700,1,200" />

    {{-- stylesheet link --}}
    <link href="{{ url('css/admin/sidemenu.css') }}" rel="stylesheet">
    <link href="{{ url('css/admin/dashboard.css') }}" rel="stylesheet">

    <title>Admin Page</title>
</head>
<body>
    <div class="main-container">
        <div class="title-container">
            <div class="title-menu">
                <div><span class="material-symbols-rounded menuBtn">menu</span></div> 
                <h1>{{$title}}</h1>
            </div>
            <div class="title-account">
                <div class="account-name">
                    <h3>{{Auth::user()->name}}</h3>
                    <p>Admin</p>    
                </div>
                <div class="account-icon">
                    <span class="material-symbols-sharp">account_circle</span>
                </div>
            </div>  
        </div>  
        <div class="sidemenu">
            <div class="sidebar">

                <a href="{{url("admin/dashboard")}}" class="@if($title == "Dashboard") active @endif">
                    <span class="material-symbols-sharp">dashboard</span> 
                    <h3>Dashboard</h3>
                </a>
                <a href="{{url("admin/student")}}" class="@if($title == "Student's Account") active @endif">
                    <span class="material-symbols-sharp">person</span>
                    <h3>Student's Account</h3>
                </a>
                <a href="{{url("admin/announcement")}}" class="@if($title == "Announcement") active @endif">
                    <span class="material-symbols-sharp">newspaper</span>                        
                    <h3>Announcement</h3>
                </a>
                <a href="{{url("admin/account")}}" class="@if($title == "Admin Account") active @endif">
                    <span class="material-symbols-sharp">manage_accounts</span>
                    <h3>Admin Account</h3>
                </a>
                <a href="{{ route('logout') }}" class="logout">
                    <span class="material-symbols-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <main>
            @yield('content')
        </main>
    </div>
    <script src="/js/admin/sidebar.js"></script>
    <script src="/js/admin/chart.js"></script>
</body>
</html>