<table class="" data-table-id="routes" data-status-map="{{ json_encode($statusMap, true) }}">
  <thead>
    <tr>
      <td data-visible="false">ID</td>
      <td>狀態</td>
      <td>航線</td>
      <td>日期</td>
      <td>時間</td>
      <td>船型</td>
      <td>剩餘票數</td>
      <td></td>
    </tr>
  </thead>
  <tbody>
  @foreach ($data as $key => $d)
    <tr data-row-index="{{ $key }}" class="{{ $d->status }}">
      <td data-cell-key="id">{{ $d->id }}</td>
      <td data-cell-key="status">{{ $statusMap[$d->status] }}</td>
      <td data-cell-key="path">{{ $d->fromName }} {{ $d->toName }}</td>
      <td data-cell-key="date">{{ substr($d->datetime, 0, 10) }}</td>
      <td data-cell-key="time">{{ substr($d->datetime, 11, 5) }}</td>
      <td data-cell-key="ferry">{{ $d->ferryName }}</td>
      <td data-cell-key="remain">remain</td>
      <td data-cell-key="function">
        @if ($d->status === 'pending')
        <a href="/cruise/editRoute/{{ $d->id }}" class="edit">修改</a> 
        <button type="text" data-action="activate" data-id="{{ $d->id }}" class="active">啟用</button>
        <button type="text" data-action="delete" data-id="{{ $d->id }}" class="delete">刪除</button>
        @endif
        @if ($d->status === 'active')
        <button type="text" data-action="cancel" data-id="{{ $d->id }}" class="cancelled">停售</button>
        @endif
        @if ($d->status === 'pending' || $d->status === 'active')
        <button type="text" data-action="reserve" data-id="{{ $d->id }}" class="function">劃位</button>
        @endif
      </td>
    </tr>      
  @endforeach
  </tbody>
</table>
