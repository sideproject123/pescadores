@extends('layouts.control_panel')
@section('main')
<div class="route-list" section="routeList">
  @include('cruise.routes_table', ['data' => $routes])
</div>
@endsection
