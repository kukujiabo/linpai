$mini = {};

$mini.isMobile = function (mobile) {
  return mobile.length == 11;
};

var addressBind;

(addressBind = function () {

  /*
   * 绑定省份选择事件
   */
  addressBind.provinceBind = function () {

    /*
     * 获取省份数据.
     */
    $.get('/location/province', {}, function (data) { 

      if (data.code) {

        $('#province-menu').html(data.res);

        $('#nav-province-list').html(data.res);

        $('.province-item').click(function (e) {

          e.preventDefault();

          $('input[name=province]').val('');
          $('input[name=city]').val('');
          $('input[name=district]').val('');
          $('#city-menu').html('');
          $('#district-menu').html('');
          $('#selected-city').html('选择城市');
          $('#selected-district').html('选择区域');
        
          var that = $(this);

          var code = that.data('code');

          if (code != undefined && code != '') {

            console.log(code);

            $('.selected-province').html(that.html());

            $('#post-province').val(that.html());

            $('#v-province').removeClass('alert-info-border');
          
            $.get('/location/city', { province: code }, function (data) {

              if (data.code) {

                $('#city-menu').html(data.res);

                if ($('#city-menu').find('.city-item').size() > 8) {

                  $('#city-menu').css({'width': '480px'});

                  $('#city-menu').find('li').addClass('col-xs-4');
                
                } else {
                
                  $('#city-menu').css({'width': 'auto'});
                
                }

                addressBind.cityBind();
              
              }
            
            }, 'json');
          
          }
        
        });

      }

    }, 'json');

  };

  addressBind.cityBind = function () {

    $('.city-item').each(function (i, t) {
  
      $(t).click(function (e) {

        e.preventDefault();

        $('#selected-district').html('选择区域');
        $('input[name=district]').val('');
    
        var name = $(this).html();

        $('#selected-city').html(name);

        $('#post-city').val(name);
    
        $('#v-city').removeClass('alert-info-border');

        $.get('/location/district', { city: $(t).data('code') }, function (data) {

          if (data.code) {
          
            var dmenu = $('#district-menu');
            
            dmenu.html(data.res);

            if (dmenu.find('.district-item').size() > 8) {
            
              dmenu.css({'width': '480px'});

              dmenu.find('li').addClass('col-xs-4');
            
            } else {
            
              dmenu.css({ 'width': 'auto' });
            
            }

            addressBind.districtBind();
          
          }
        
        }, 'json')

      })
  
    });

  };

  addressBind.districtBind = function () {

    $('.district-item').each(function (i, t) {
    
      $(t).click(function (e) {
      
        e.preventDefault();

        var name = $(this).html();

        $('#selected-district').html(name);

        $('#post-district').val(name);

        $('#v-district').removeClass('alert-info-border');
      
      })
    
    });

  };

  addressBind.provinceBind();

  $linpai.areaReset = function () {
  
    $('.selected-province').html('选择省份');
    $('#selected-city').html('选择城市');
    $('#selected-district').html('选择区域');

    addressBind.provinceBind();
  
  };

})();
