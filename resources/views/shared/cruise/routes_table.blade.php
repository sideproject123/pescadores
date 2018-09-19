<table class="" data-table-id="routes">
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
  @foreach ($data as $d)
    <tr>
      <td>{{ $d->id }}</td>
      <td>{{ $statusMap[$d->status] }}</td>
      <td>{{ $d->fromName }} {{ $d->toName }}</td>
      <td>{{ substr($d->datetime, 0, 10) }}</td>
      <td>{{ substr($d->datetime, 11, 5) }}</td>
      <td>{{ $d->ferryName }}</td>
      <td>left</td>
      <td>
        <a href="/cruise/editRoute/{{ $d->id }}">修改</a> 
        <button type="text" data-action="delete" data-id="{{ $d->id }}">刪除</button>
        <button type="text" data-action="cancel" data-id="{{ $d->id }}">停售</button>
        <button type="text" data-action="reserve" data-id="{{ $d->id }}">劃位</button>
      </td>
    </tr>      
  @endforeach
  </tbody>
</table>
