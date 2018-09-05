@include('shared.before_head')
@include('shared.head')
  <div id="app">
    @include('shared.header')
    @yield('content')
    {{ $msg }} 
    <br />
    {{ __('landing.banner') }}
    <br />
    {{ __('landing.logo') }}
    <select id="locale">
      <option value="en">en</option>
      <option value="zh-tw">zh-tw</option>
      <option value="fr">fr</option>
    </select>
    @include('shared.footer')
  </div>
@include('shared.after_body')