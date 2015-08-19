@include('modal-box')

@section('car_info')

<div class="person-info table-responsive">

  @if (empty($cars))

    <p class="alert alert-warning" id="car-empty-info">您当前没有车辆信息</p>
    <table class="table hide" id="car-list-table">

  @else

    <p class="alert alert-warning hide" id="car-empty-info">您当前没有车辆信息</p>
    <table class="table" id="car-list-table">

  @endif
      <thead class="gray-light">
        <tr>
          <th class="col-md-1 t-center">使用</th>
          <th class="col-md-2 t-center">所有人</th>
          <th class="col-md-3 t-center">车辆型号</th>
          <th class="col-md-3 t-center">识别代码</th>
          <th class="col-md-3 t-center">操作</th>
        </tr>
      </thead> 
      <tbody id="car-body">
          
        @foreach ($cars as $car)

          <tr id="car-item-{{$car->id}}">
            <td class="col-md-1 text-center" style="padding-left:40px;">
              <label class="radio no-margin">
                <input name="selected-car" type="radio" data-id="{{$car->id}}">
              </label>
            </td>
            <td class="col-md-2 text-center">{{$car->owner}}</td>
            <td class="col-md-4 text-center">{{$car->brand}}</td>
            <td class="col-md-4 text-center">{{$car->reco_code}}</td>
            <td class="col-md-1 text-center">
              <a href="#">
                <span class="glyphicon glyphicon-edit"></span>
              </a> | 
              <a href="#" data-type="car" data-target="car-item-{{$car->id}}" class="remove-car" data-id="{{$car->id}}">
                <span class="glyphicon glyphicon-trash" data-id="{{$car->id}}"></span>
              </a>
            </td>
          </tr>

        @endforeach

      </tbody>
    </table>
</div>
<div>
  @yield('modal-box')
</div>

@endsection
