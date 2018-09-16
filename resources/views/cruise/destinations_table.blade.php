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
      <td class="actions {{ $d->status === 1 ? 'active' : '' }}">
        <button
          type="button disable"
          data-action="status"
          data-value="0"
          data-id="{{ $d->id }}"
        >停用</button>
        <button
          type="button enable"
          data-action="status"
          data-value="1"
          data-id="{{ $d->id }}"
        >啟用</button>
      </td>
    </tr>      
  @endforeach
  </tbody>
</table>
