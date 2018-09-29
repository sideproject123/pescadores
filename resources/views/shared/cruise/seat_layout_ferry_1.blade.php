<div class="seat-layout ferry-1" data-fn="seatLayout" data-rid="{{ $routeId }}">
  <ul class="seat-layout-illustration">
    <li class="item">
      <span class="">已保留座位</span>
      <span class="reserved"></span>
    </li>
    <li class="item">
      <span class="">已售出座位</span>
      <span class="taken"></span>
    </li>
    <li class="item">
      <span class="">已選擇座位</span>
      <span class="selected"></span>
    </li>
    <li class="item">
      <span class="">禁止選擇</span>
      <span class="forbidden"></span>
    </li>
    <li class="item">
      <span class="">商務艙座位</span>
      <span class="class-B"></span>
    </li>
    <li class="item">
      <span class="">一般艙座位</span>
      <span class="class-E"></span>
    </li>
  </ul>
  <div class="seat-layout-options">
    <div class="option-reserve">
      <label><input type="checkbox" name="autoFill" data-autoFill="1"><span>自動補位</span></label>
      <span>座位數量</span><input type="text" name="autoFillNum" value="" data-autoFillNum="1">
      <button type="button" data-action="selectAllReserved">選擇全部已保留座位</button>
    </div>
  </div>
  <div class="">
  @php
    list($__x, $__y) = explode('-', $seatInfo['cols']);
    $__colRange = range($__x, $__y);
    $__colLen = count($__colRange) - 1;
  @endphp
  @for ($i = 1, $j = $seatInfo['rows']; $i < $j; ++$i) 
    @foreach ($__colRange as $index => $col)
    @php
      $__pos = $i . $col;
      $__s = isset($seats[$__pos]) ? $seats[$__pos] : '';
    @endphp
    @if (!$__s)
      @continue
    @endif
    @if ($index === 0)
    <ul class="seat-layout-row" data-type="row">
    @endif
      <li
        class="seat-layout-cell {{ $__s['status'] }} class-{{ $__s['class'] }}"
        data-type="cell"
        data-status="{{ $__s['status'] }}"
        data-row="{{ $__s['row'] }}"
        data-col="{{ $__s['col'] }}"
      >
        <span class="text" data-type="text">{{ $__s['position'] }}</span>
      </li>    
    @if ($index === $__colLen)
    </ul>
    @endif
    @endforeach
  @endfor
  </div>
  <div class="actions">
    <div class="reserve">
      <button type="button" data-action="reset">重置</button>
      <button type="button" data-action="submit" value="reserve">確認保留</button>
      <button type="button" data-action="submit" value="unreserve">取消保留</button>
    </div>
  </div>
</div>