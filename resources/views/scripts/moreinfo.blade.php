@section('more-info')
<script type="text/javascript">
  window.onload = function () {
    /*
     * 下拉显示更多信息.
     */
    var handleToggleDown = function (that, upContent, downContent, prefix, mainBody) {

      var mode = that.data('mode');

      var target = $('#' + that.data('target'));

      if (mode == 'hide') {

        target.find('tr[seq=hide]').removeClass('hide');

        that.find('span.glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');

        that.find('.m-i-value').html(upContent);

        that.data('mode', 'show');

      } else {

        that.find('span.glyphicon').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');

        that.find('.m-i-value').html(downContent);

        that.data('mode', 'hide');

        var at = $('#' + mainBody).find('.use-active');

        if (at.size() > 0) {

          var atLine = $('#' + prefix + at.data('id'));

          atLine.prependTo('#' + mainBody);

          atLine.removeAttr('seq');

          var lines = $('#' + mainBody).find('tr');

          $(lines[2]).attr('seq', 'hide');

        }

        target.find('tr[seq=hide]').addClass('hide');
      
      }
    
    };

    /*
     * 收货人
     */
    $('#new-address-toggle').find('.more-info').click(function (e) {
    
      e.preventDefault();

      var that = $(this);

      handleToggleDown(that, '收起收货地址', '更多收货地址', 'receiver-item-', 'receiver-body')
    
    });

    /*
     * 车辆
     */
    $('#car-info-toggle').find('.more-info').click(function (e) {
    
      e.preventDefault();

      var that = $(this);

      handleToggleDown(that, '收起车辆信息', '更多车辆信息', 'car-item-', 'car-body');
    
    });

  };
</script>
@endsection
