@include('shared.control_panel_before_body')
  <div id="app">
    @include('shared.control_panel_header')
    <div class="content">
      <div class="sidebar">
        <ul class="functions">
        @foreach ($functions as $fn)
          <li>
            <a href="{{ $fn['name'] }}" target="_self">{{ $fn['displayName'] }}</a>
          </li>   
        @endforeach
        </ul>
      </div>
      <div class="main">
        <ul class="sub-functions">
        @foreach ($function['subFunctions'] as $fn)
          <li>
            <a href="{{ $fn['url'] }}" target="_self">{{ $fn['displayName'] }}</a>
          </li>   
        @endforeach
        </ul>
        <div id="{{ $function['id'] }}">
          @yield('main')
        </div>
      </div>
    </div>
  </div>
@include('shared.control_panel_after_footer')
