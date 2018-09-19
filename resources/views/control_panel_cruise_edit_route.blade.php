@extends('layouts.control_panel')
@section('main')
<div class="edit-route" section="editRoute">
  @if (!empty($route))
  <input type="hidden" name="rId" value="{{ $route->id }}" />
  @endif
  <div class="destination">
    <span class="title">啟點</span>
    @include('shared.selection', ['list' => $destinations, 'fn' => 'fromDest', 'selected' => empty($route) ? '' : $route['fromDestinationId']])
  </div>
  <div class="destination">
    <span class="title">目的地</span>
    @include('shared.selection', ['list' => $destinations, 'fn' => 'toDest', 'selected' => empty($route) ? '' : $route['toDestinationId']])
  </div>
  <div class="calendar">
    <span class="title">航班日期</span>
    @include('shared.datepicker', ['date' => empty($route) ? '' : substr($route['datetime'], 0, 10)])
  </div>
  <div class="time">
    <span class="title">航班時間</span>
    @include('shared.timepicker', ['time' => empty($route) ? '' : substr($route['datetime'], 11, 5)])
  </div>
  <div class="ferry">
    <span class="title">航型</span>
    @include('shared.selection', ['list' => $ferries, 'fn' => 'ferry', 'selected' => empty($route) ? '' : $route['ferryId']])
  </div>
  <div class="submit">
    <button type="button" class="btn" data-fn="submit">確定</button>
    <button type="button" class="btn" data-fn="back">取消</button>
  </div>
</div>
@endsection
