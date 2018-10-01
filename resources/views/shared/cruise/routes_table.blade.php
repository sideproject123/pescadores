<div class="routes-table-container">
  <div class="search-filter">
    @include('shared.datepicker', ['date' => isset($date) ? $date : ''])
    <span class="today" data-action="setToday">今日</span>
  </div>
  <table class="routes-table" data-table-id="routes" data-status-map="{{ json_encode($statusMap, true) }}">
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
        <td data-cell-key="actions" class="actions">
          <button type="text" data-action="activate" data-id="{{ $d->id }}" class="btn activate">啟用</button>
          <button type="text" data-action="delete" data-id="{{ $d->id }}" class="btn delete">刪除</button>
          <button type="text" data-action="cancel" data-id="{{ $d->id }}" class="btn cancel">停售</button>
          <button type="text" data-action="reserve" data-id="{{ $d->id }}" data-fid="{{ $d->ferryId }}" class="btn reserve">劃位</button>
          <button type="text" data-action="refund" data-id="{{ $d->id }}" class="btn refund">退票</button>
        </td>
      </tr>      
    @endforeach
    </tbody>
  </table>
</div>