@section('receiver_info')

<div class="person-info table-responsive">
@if (empty($receiverInfos))
  <p class="alert alert-warning" id="receiver-empty-info">您当前没有收货人信息</p>
  <table class="table hide" id="receiver-list-table">
@else

  <p class="alert alert-warning hide" id="receiver-empty-info">您当前没有收货人信息</p>
  <table class="table" id="receiver-list-table">
@endif
  <thead class="super-light">
    <tr>
      <th class="col-md-3 t-center"></th>
      <th class="col-md-2 t-center">收货人</th>
      <th class="col-md-4 t-center">地址</th>
      <th class="col-md-1 t-center">手机号</th>
      <th class="col-md-2 t-center">操作</th>
    </tr>
  </thead> 
  <tbody id="receiver-body">
    @foreach ($receiverInfos as $key => $receiverInfo)        

      @if ($key > 1)

        <tr class="hide" seq="hide" id="receiver-item-{{$receiverInfo->id}}" data-id="{{$receiverInfo->id}}">

      @else

        <tr id="receiver-item-{{$receiverInfo->id}}" data-id="{{$receiverInfo->id}}">

      @endif
        <td class="col-md-3 t-center" style="padding-left:10px;">
          <label class="radio no-margin t-center">

            @if ($receiverInfo->last_used)

            <div class="use-card t-padding use-active" id="use-receiver-{{$receiverInfo->id}}" data-id="{{$receiverInfo->id}}">

            @else

            <div class="use-card t-padding" id="use-receiver-{{$receiverInfo->id}}" data-id="{{$receiverInfo->id}}">

            @endif
              {{$receiverInfo->receiver}}&nbsp;&nbsp;&nbsp;&nbsp;{{$receiverInfo->city}}
              <b></b>
            </div>
            <input class="hide" type="radio" name="selected-receiver" data-id="{{$receiverInfo->id}}">
          </label>
        </td>
        <td class="col-md-2 t-center">
          <div class="t-padding">{{$receiverInfo->receiver}}</div>
        </td>
        <td class="col-md-4 t-center">
          <div class="t-padding over-elis receive-address">
            {{$receiverInfo->province}}&nbsp;{{$receiverInfo->city}}&nbsp;{{$receiverInfo->district}}&nbsp;{{$receiverInfo->address}}
          </div>
        </td>
        <td class="col-md-1 t-center">
          <div class="t-padding">{{$receiverInfo->mobile}}</div>
        </td>
        <td class="col-md-3 t-center edit-col">
          <div class="t-padding">
            <a href="#" class="itm-edit" data-id="{{$receiverInfo->id}}" data-iurl="{{asset('receiver/receiverinfo')}}" data-key="receiver">
              <span class="glyphicon glyphicon-edit edit-col"></span>
            </a> 
              &nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="#" class="remove-receiver" data-type="receiver" data-toggle="model" data-target="receiver-item-{{$receiverInfo->id}}" data-id="{{$receiverInfo->id}}">
              <span class="glyphicon glyphicon-trash edit-col"></span>
            </a>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection
