@extends('layouts.control_panel')
@section('main')
<div class="route-list" section="routeList">
  @include('shared.cruise.routes_table', ['data' => $routes, 'statusMap' => $statusMap])
</div>
<iframe data-fn="seatLayout" src="" width="100%" height="500"></iframe>
@endsection
