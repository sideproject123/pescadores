<div class="datepicker-wrap">
  <input
    type="text"
    class="input"
    data-fn="datepicker"
    readonly
    name="{{ $name or '' }}"
    value="{{ $date or '' }}"
    @if (isset($id))
    id="{{ $id }}"
    @endif
  />
  <img
    class="calendar"
    src="/images/calendar-icon.jpg"
    data-fn="datepicker-click"
  />
</div>
