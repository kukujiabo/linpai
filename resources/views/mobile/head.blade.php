@section('header')

  @if (!empty($header))

    <h1>{{$header}} －51临牌</h1>

  @else

    <h1>欢迎来到51临牌</h1>

  @endif
    @if (Auth::user())

      <a href="/mobile/profile" style="display:block;padding:1px;" data-role="none" class="ui-btn-right">
        <img src="/imgs/35.png">
      </a>

    @endif

@endsection
