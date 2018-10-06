@extends('layouts.control_panel')
@section('content')
<div class="route-list" section="routeList">
  @include('shared.cruise.routes_table', ['data' => isset($routes) ? $routes : [], 'statusMap' => isset($statusMap) ? $statusMap : []])
  <div data-fn="seatLayoutContainer"></div>
</div>
@endsection
