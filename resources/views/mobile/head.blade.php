@section('header')

  @if (!empty($header))

    <h1>{{$header}} －51临牌</h1>

  @else

    <h1>欢迎来到51临牌</h1>

  @endif
    @if (Auth::user())

      <a href="/mobile/profile" data-icon="user" class="ui-btn-right">个人</a>

    @endif

@endsection
