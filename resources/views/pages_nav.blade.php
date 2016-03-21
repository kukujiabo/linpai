@section('page_nav')

<nav>
  <ul class="pagination">

    @if ($current_page > 1)
    <li>
      <a href="page={{$i-1}}" id="" aria-label="Previous" id="o-pre-page" data-cpage="{{$current_page}}" data-token="{{csrf_token()}}">
        <span aria-hidden="true">&laquo;上一页</span>
      </a>
    </li>
    @else
    <li>
      <a href="#" class="hide" id="o-pre-page" aria-label="Previous" data-token="{{csrf_token()}}">
        <span aria-hidden="true">&laquo;上一页</span>
      </a>
    </li>
    @endif

    @for ($i = 1; $i <= $pages; $i++) 

      <li><a href="page={{$i}}" class="o-page" data-page="{{$i}}" data-token={{csrf_token()}}>{{$i}}</a></li>

    @endfor

    @if ($current_page < $pages)
    <li>
      <a href="page={{$i+1}}" aria-label="Next" id="o-next-page" data-cpage="{{$current_page}}" data-token="{{csrf_token()}}">
        <span aria-hidden="true">下一页&raquo;</span>
      </a>
    </li>

    @else

    <li>
      <a href="#" class="hide" aria-label="Next" id="o-next-page" data-token="{{csrf_token()}}">
        <span aria-hidden="true">下一页&raquo;</span>
      </a>
    </li>

    @endif
  </ul>
</nav>

@endsection
