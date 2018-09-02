@include('shared.before_head')
@include('shared.head')
  <div id="app">
    @include('shared.header');
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
  </div>
@include('shared.after_footer')