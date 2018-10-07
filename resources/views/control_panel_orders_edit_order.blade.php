@extends('layouts.control_panel')
@section('content')
<div class="edit-order" section="editOrder">
  <form name="editOrder">
    @if (isset($order['id']))
    <div>
      <span>訂單編號</span><span class="orderNumber">{{ $order['id'] }}</span>
    </div>
    @endif
    <div>
      <label>
        <span>單程</span>
        <input type="radio" name="trip" value="one" />
      </label>
      <label>
        <span>往返</span>
        <input type="radio" name="trip" value="round" />
      </label>
    </div>
    <div class="detail to-trip" data-container="to">
      <div class="calendar">
        <span class="title">去程日期</span>
        @include('shared.datepicker', [
          'name' => 'toDate',
          'date' => $order['toRoute']['date'] ?? '',
        ])
      </div>
      <div class="routes-wrap">
        <span class="title">去程船班</span>
        @include('shared.selection', [
          'name' => 'toRouteId',
          'list' => $toRouteOptions ?? [],
          'selected' => $order['toRoute']['id'] ?? '',
        ])
      </div>
      <div class="tickets-wrap">
        @include('shared.ticket_price_calculate', [
          'types' => $seatTypes ?? [],
        ])
      </div>
      <div>
        <span>乘客資訊</span>
        <div id="to-jexcel" data-fn="jexcel"></div>
        <button type="button" data-action="add">新增</button>
        <button type="button" data-action="get">get</button>
      </div>
    </div>
    <div class="contact-info">
      <div>
        <span>連絡人</span>
        <input type="text" name="contactName" value="{{ $order['contactName'] or '' }}" />
      </div>
      <div>
        <span>連絡人電話</span>
        <input type="text" name="contactPhone" value="{{ $order['contactPhone'] or '' }}" />
      </div>
    </div>
    <div class="memo-wrap">
      <textarea name="memo"></textarea>
    </div>
    <div class="total-wrap">
      <span>總金額</span>
      <input
        type="text"
        value="{{ $order['total'] or '' }}"
      />
    </div>
    <div class="btn-wrap">
      <button type="button" value="reserve">劃位</button>
      <button type="button" value="submit">確認購買</button>
    </div>
  </form>
</div>
@endsection
