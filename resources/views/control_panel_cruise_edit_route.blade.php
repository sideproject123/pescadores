@extends('layouts.control_panel')
@section('main')
<div class="edit-route" section="editRoute">
  <div class="destination">
    <span class="title">啟點</span>
    @include('shared.selection', ['list' => $destinations, 'fn' => 'fromDest'])
  </div>
  <div class="destination">
    <span class="title">目的地</span>
    @include('shared.selection', ['list' => $destinations, 'fn' => 'toDest'])
  </div>
  <div class="calendar">
    <span class="title">航班日期</span>
    @include('shared.datepicker')
  </div>
  <div class="time">
    <span class="title">航班時間</span>
    @include('shared.timepicker')
  </div>
  <div class="ferry">
    <span class="title">航型</span>
    @include('shared.selection', ['list' => $ferries, 'fn' => 'ferry'])
  </div>
  <div class="submit">
    <button type="button" class="btn" data-fn="submit">確定</button>
  </div>
</div>
@endsection
