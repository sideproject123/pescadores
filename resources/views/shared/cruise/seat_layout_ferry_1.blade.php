<div class="seat-layout" data-fn="seatLayout">
  <ul class="seat-layout-illustration">
    <li class="item">
      <span class="">已保留座位</span>
      <span class="reserved"></span>
    </li>
    <li class="item">
      <span class="">已售出座位</span>
      <span class="sold"></span>
    </li>
    <li class="item">
      <span class="">可使用座位</span>
      <span class="av"></span>
    </li>
    <li class="item">
      <span class="">已選擇座位</span>
      <span class="selected"></span>
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
  @for ($i = 1, $j = 10; $i < $j; $i++) 
    <ul class="seat-layout-row" data-type="row">
    @for ($x = 65, $y = 81; $x < $y; $x++)
    @php
      $c = chr($x);
      $__no = $i.$c;
      $__status = isset($seats[$__no]) ? $seats[$__no] : 'av';
    @endphp
      <li
        class="seat-layout-cell {{ $__status }}"
        data-type="cell"
        data-status="{{ $__status }}"
        data-row="{{ $i }}"
        data-col="{{ $c }}"
      >
        {{ $__no }}
      </li>    
    @endfor
    </ul>
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