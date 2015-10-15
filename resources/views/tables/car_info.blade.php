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
      <thead class="super-light">
        <tr>
          <th class="col-md-3 t-center"></th>
          <th class="col-md-2 t-center">所有人</th>
          <th class="col-md-3 t-center">车辆型号</th>
          <th class="col-md-2 t-center">车架号</th>
          <th class="col-md-2 t-center">操作</th>
        </tr>
      </thead> 
      <tbody id="car-body">
          
        @foreach ($cars as $key => $car)

          @if ($key > 1)

          <tr seq="hide" class="car-list-item hide" id="car-item-{{$car->id}}">

          @else

          <tr class="car-list-item" id="car-item-{{$car->id}}">

          @endif

            <td class="col-md-3 text-center" style="padding-left:10px;">
              <label class="radio no-margin">

              @if ($key == 0) 

                <div class="use-card t-padding use-active" id="use-car-{{$car->id}}" data-id="{{$car->id}}">

              @else

                <div class="use-card t-padding" id="use-car-{{$car->id}}" data-id="{{$car->id}}">

              @endif
                  {{$car->owner}}&nbsp;&nbsp;&nbsp;&nbsp;{{$car->factory_code}}
                  <b></b>
                </div>
                <input class="hide" name="selected-car" type="radio" data-id="{{$car->id}}">
              </label>
            </td>
            <td class="col-md-2 text-center">
              <div class="t-padding">{{$car->owner}}</div>
            </td>
            <td class="col-md-3 text-center">
              <div class="t-padding">{{$car->factory_code}}</div>
            </td>
            <td class="col-md-2 text-center">
              <div class="t-padding">{{$car->reco_code}}</div>
            </td>
            <td class="col-md-2 text-center edit-col">
              <div class="t-padding">
                <a href="#" class="itm-edit" data-id="{{$car->id}}" data-iurl="{{ asset('car/carinfo') }}" data-key="car">
                  <span class="glyphicon glyphicon-edit edit-col"></span>
                </a> &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="#" data-type="car" data-target="car-item-{{$car->id}}" class="remove-car" data-id="{{$car->id}}">
                  <span class="glyphicon glyphicon-trash edit-col" data-id="{{$car->id}}"></span>
                </a>
              </div>
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
