<div class="selection-wrap">
  <select
    class="selction"
    name="{{ $name ?? '' }}"
    @if (isset($fn))
    data-fn="{{ $fn }}"
    @endif
  >
  @foreach ($list as $item)
    <option
      class="item"
      value="{{ $item['value'] }}" {{ isset($selected) && $selected === $item['value'] ? 'selected' : '' }}
    >
      {{ $item['displayName'] }}
    </option>
  @endforeach
  </select>
</div>
