@include('shared.control_panel_before_body')
  <div id="app">
    @include('shared.control_panel_header')
    <div class="content">
      <div class="sidebar">
        <ul class="menus">
        @foreach ($menus as $m)
          <li>
            <a href="{{ $m['name'] }}" target="_self">{{ $m['displayName'] }}</a>
          </li>   
        @endforeach
        </ul>
      </div>
      <div class="main">
        <ul class="sub-functions">
        @foreach ($subMenus as $m)
          <li>
            <a href="{{ $m['url'] }}" target="_self">{{ $m['displayName'] }}</a>
          </li>   
        @endforeach
        </ul>
        <div id="{{ $menuId }}">
          @yield('main')
        </div>
      </div>
    </div>
  </div>
@include('shared.control_panel_after_footer')
