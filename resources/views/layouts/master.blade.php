<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', 'Home Page')</title>

        {{-- css --}}
        @include('layouts.css')
	</head>
	<body>
        {{-- header --}}
		@include('layouts.header')

        {{-- menu --}}
        @include('layouts.menu')

        {{-- content --}}
        <div class="container">
            @yield('content')
        </div>
        
        {{-- footer --}}
        @include('layouts.footer')

        {{-- Javascript --}}
        @include('layouts.js')
	</body>
</html>