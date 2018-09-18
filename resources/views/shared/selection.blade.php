<div class="selection {{ isset($cls) ? $cls : '' }}">
  <select
    class="list"
    name="{{ isset($fn) ? $fn : '' }}"
    data-fn="{{ isset($fn) ? $fn : '' }}"
  >
  @foreach ($list as $item)
    <option class="item" value="{{ $item['value'] }}" {{ $selected === $item['value'] ? 'selected' : '' }}>{{ $item['displayName'] }}</option>
  @endforeach
  </select>
</div>
