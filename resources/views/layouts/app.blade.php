@include('shared.before_head')
@include('shared.head')
<body>
  <div id="app">
    @include('shared.header');
    {{ $msg }} 
  </div>
@include('shared.after_footer')