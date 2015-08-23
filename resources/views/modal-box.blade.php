
@section('modal-box')

<div class="modal fade" id="linpai-modal" role="dialog" aria-label="linpai-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">提示</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-dismiss">关闭</button>
        <button type="button" class="btn btn-primary" id="modal-confirm" data-token="{{csrf_token()}}">确认</button>
      </div>
    </div>
  </div>
</div>

@endsection
