@include('shared.control_panel_before_body')
  <div id="app">
    @include('shared.control_panel_header')
    <div class="content">
      <div class="sidebar">
        <ul class="functions">
        @foreach ($functions as $fn)
          <li>
            <a href="{{ $fn->name }}" target="_self">{{ $fn->displayName }}</a>
          </li>   
        @endforeach
        </ul>
      </div>
      <div class="main">
        <ul class="sub-functions">
        @foreach ($subFunctions as $subFn)
          <li>
            <a href="{{ $subFn->name }}" target="_self">{{ $subFn->displayName }}</a>
          </li>   
        @endforeach
        </ul>
        <div id="{{ $functionId }}">
          @yield('main')
        </div>
      </div>
    </div>
  </div>
@include('shared.control_panel_after_footer')
