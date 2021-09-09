<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--      <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
 --}}

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <link
    href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <title>{{config('app.name', 'iTeach')}}</title>
</head>
    <body>
        <div id="app">
        @include('inc.navbar')



            <div class="container p-5">
                <div>
                    @include('inc.messages')
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
        <!-- Scripts -->
        {{--<script src="{{ asset('js/custom.js') }}"></script> --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer
      ></script>
      <!-- Scripts -->
      <script src="{{ asset('js/custom.js') }}"></script>


</html>
