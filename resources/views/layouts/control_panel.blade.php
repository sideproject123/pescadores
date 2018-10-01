@include('shared.control_panel_before_body')
  <div id="app">
    <div class="sidebar">
      <div class="logo-wrap">
      </div>
      <ul class="menus">
      @foreach ($menus as $m)
        <li>
          <a class="link" href="{{ $m['name'] }}" target="_self">{{ $m['displayName'] }}</a>
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
          @yield('content')
          @yield('content')
        </div>
      </div>
    </div>
  </div>
@include('shared.control_panel_after_footer')
