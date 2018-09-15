@extends('layouts.control_panel')
@section('main')
<div class="destination" section="destinations">
  <div>
    <input class="input" type="text" value="" name="name" />
    <button class="submit" data-fn="submit">確認</button>
    <table class="" data-table-id="destinations">
      <thead>
        <tr>
          <td data-visible="false">ID</td>
          <td>地點</td>
          <td></td>
        </tr>
      </thead>
      <tbody>
      @foreach ($data as $d)
        <tr>
          <td>{{ $d->id }}</td>
          <td>{{ $d->name }}</td>
          <td class="actions">
            <button
              type="button disable"
              data-action="disable"
              data-id="{{ $d->id }}"
            >停用</button>
            <button
              type="button enable"
              data-action="enable"
              data-id="{{ $d->id }}"
            >啟用</button>
          </td>
        </tr>      
      @endforeach
      </tbody>
  </div>
  <div>
  </div>
</div>
@endsection
