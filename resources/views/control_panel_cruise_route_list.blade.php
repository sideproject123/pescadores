@extends('layouts.control_panel')
@section('main')
<div class="route-list" section="routeList">
  @include('shared.cruise.routes_table', ['data' => $routes, 'statusMap' => $statusMap])
</div>
@include('shared.cruise.seat_layout_ferry_1')
@endsection
