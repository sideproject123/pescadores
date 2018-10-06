<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ __('title') }}</title>
  <link href="//fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/control_panel.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
  <div id="app">
    <div class="sidebar">
      <div class="logo-wrap">
      </div>
      <ul class="menus">
      @foreach ($menus as $m)
        <li>
          <a class="link" href="{{ $m['url'] }}" target="_self">{{ $m['displayName'] }}</a>
        </li>   
      @endforeach
      </ul>
    </div>
    <div class="main">
      @include('shared.control_panel_header')
      <div class="content">
        <ul class="sub-functions">
        @foreach ($subMenus as $m)
          <li>
            <a href="{{ $m['url'] }}" target="_self">{{ $m['displayName'] }}</a>
          </li>   
        @endforeach
        </ul>
        <div id="{{ $menuId }}">
          @yield('content')
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('js/control_panel.js') }}"></script>
</body>
</html>
