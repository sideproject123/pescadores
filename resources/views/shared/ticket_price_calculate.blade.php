@php
$__isAdmin = $admin ?? true;  
@endphp
<div clsss="ticket-price-calculate-wrap">
  <table class="ticket-price-calculate">
    <thead>
      <th><span>票卷類型</span></th>
      <th><span>張數</span></th>
      @if ($__isAdmin)
      <th><span>扣除票數</span></th>
      @endif
      <th><span>單價</span></th>
    </thead>
    <tbody>
      @foreach ($types as $t)
      <tr>
        <td>{{ $t['displayName'] }}</td>
        <td>
          <input
            type="text"
            name="{{ $t['name'] . 'Count' }}"
            value=""
          />
        </td>
        @if ($__isAdmin)
        <td>
          <input
            type="text"
            name="{{ $t['name'] . 'DiscountCount' }}"
            value=""
          />
        </td>
        @endif
        <td>
          <span>{{ $t['price'] }}</span>
        </td>
      </tr>
      @endforeach
    </tbody>   
  </table>
  <div>
    <div>
      <span>原價：</span>
      <input type="text"
        readonly
        name="{{ $originalPriceName ?? '' }}"
        value="{{ $originalPriceValue ?? '' }}"
      />
    </div>
    <div>
      <span>促銷價：</span>
      <input type="text"
        readonly
        name="{{ $discountPriceName ?? '' }}"
        value="{{ $discountPriceValue ?? '' }}"
      />
    </div>
  </div>
</div>