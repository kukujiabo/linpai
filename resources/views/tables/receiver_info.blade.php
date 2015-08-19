@section('receiver_info')

<div class="person-info table-responsive">
@if (empty($receiverInfos))
  <p class="alert alert-warning" id="receiver-empty-info">您当前没有收货人信息</p>
  <table class="table hide" id="receiver-list-table">
@else

  <p class="alert alert-warning hide" id="receiver-empty-info">您当前没有收货人信息</p>
  <table class="table" id="receiver-list-table">
@endif
  <thead class="gray-light">
    <tr>
      <th class="col-md-1 t-center">使用</th>
      <th class="col-md-1 t-center">收货人</th>
      <th class="col-md-6 t-center">地址</th>
      <th class="col-md-3 t-center">手机号</th>
      <th class="col-md-1 t-center">操作</th>
    </tr>
  </thead> 
  <tbody id="receiver-body">
    @foreach ($receiverInfos as $receiverInfo)        
      <tr id="receiver-item-{{$receiverInfo->id}}" data-id="{{$receiverInfo->id}}">
        <td class="col-md-1 t-center" style="padding-left:35px;">
          <label class="radio no-margin t-center">
            <input type="radio" name="selected-receiver" data-id="{{$receiverInfo->id}}">
          </label>
        </td>
        <td class="col-md-1 t-center">{{$receiverInfo->receiver}}</td>
        <td class="col-md-6 t-center">
          {{$receiverInfo->city}}&nbsp;{{$receiverInfo->district}}&nbsp;{{$receiverInfo->address}}
        </td>
        <td class="col-md-3 t-center">{{$receiverInfo->mobile}}</td>
        <td class="col-md-1 t-center">
            <a href="#"><span class="glyphicon glyphicon-edit"></span></a> | 
            <a href="#" class="remove-receiver" data-type="receiver" data-toggle="model" data-target="receiver-item-{{$receiverInfo->id}}" data-id="{{$receiverInfo->id}}">
              <span class="glyphicon glyphicon-trash"></span>
            </a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection
