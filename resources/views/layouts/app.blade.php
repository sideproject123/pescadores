@include('shared.before_head')
@include('shared.head')
<body>
  <div id="app">
    @include('shared.header');
    {{ $msg }} 
    <br />
    {{ __('landing.banner') }}
    <br />
    {{ __('landing.logo') }}
  </div>
@include('shared.after_footer')