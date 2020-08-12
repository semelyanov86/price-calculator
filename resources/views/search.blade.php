<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (app()->getLocale() === 'he')
    dir="rtl"
      @else
          dir="ltr"
@endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{trans('site.title')}}</title>

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
<script>
    window._locale = '{{ app()->getLocale() }}';
    window._translations = {!! cache('translations') !!};
</script>
<div id="app" class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">{{trans('site.header')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">

            </ul>
            <span class="navbar-text">
                <div class="btn-group">
                  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{app()->getLocale()}}
                  </button>
                  <div class="dropdown-menu">
                    @foreach(config('panel.available_languages') as $langLocale => $langName)
                          <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                      @endforeach
                  </div>
                </div>
            </span>
        </div>
    </nav>
    <div class="card">
        <filter-component :companies="{{$companies}}" type="phone" id="{{$id}}" filter="{{$data}}"></filter-component>
    </div>
    <div class="mt-3"></div>
@forelse($cellulars as $cell)
    <diplay-vue-component :item="{{$cell}}"></diplay-vue-component>
@empty
    <h4 class="text-center">{{trans('site.no_data')}}</h4>
@endforelse
    @if ($ownCellulars->count() > 0)
        <h4 class="mt-3">{{trans('site.cellulars_company')}}</h4>
        @forelse($ownCellulars as $item)
            <diplay-vue-component :item="{{$item}}"></diplay-vue-component>
        @empty
            <h4>{{trans('site.no_data')}}</h4>
        @endforelse
    @endif

</div>
</body>
</html>
