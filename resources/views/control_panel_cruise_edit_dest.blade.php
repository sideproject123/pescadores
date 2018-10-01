@extends('layouts.control_panel')
@section('content')
<div class="destination" section="destinations">
  <div>
    <input class="input" type="text" value="" name="name" />
    <button class="submit" data-fn="submit">確認</button>
    <div data-table-wrap="1">
      @include('shared.cruise.destinations_table')
    </div>
  </div>
</div>
@endsection
