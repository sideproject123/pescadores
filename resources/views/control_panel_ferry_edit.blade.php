@extends('layouts.control_panel')
@section('main')
<div class="destination" section="destination">
  <h4 class="title">航點設定</h4>
  <div>
    <input class="input" type="text" value="" name="name" />
    <button class="submit" data-fn="submit">確認</button>
  </div>
</div>
@endsection