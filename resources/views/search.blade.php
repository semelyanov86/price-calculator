<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Search for best provider</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        .container {
            padding: 10px;
        }
    </style>
</head>
<body>
<div id="app" class="container">
    <div class="card">
        <filter-component :companies="{{$companies}}" type="phone" id="{{$id}}" filter="{{$data}}"></filter-component>
    </div>
    <div class="mt-3"></div>
@forelse($cellulars as $cell)
    <diplay-vue-component :item="{{$cell}}"></diplay-vue-component>
@empty
    <h4 class="text-center">No packages found matching our search</h4>
@endforelse
    @if ($ownCellulars->count() > 0)
        <h4 class="mt-3">Cellulars for your company</h4>
        @forelse($ownCellulars as $item)
            <diplay-vue-component :item="{{$item}}"></diplay-vue-component>
        @empty
            <h4>No packages found matching our search</h4>
        @endforelse
    @endif

</div>
</body>
</html>
