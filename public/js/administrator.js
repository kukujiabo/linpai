/*
 * 管理员登录
 *
 */
$linpai = {};

$linpai.route = 'administrator_$2y$10$m1lWH3HqB9oimrxrB3Ea7uu76y5xxUqsldjEpuiWu7H5r6uCGdNSS';

(function () {

  var alogForm = $('#admin_login_form');

  if (!alogForm.size()) {

    return; 

  }

  alogForm.ajaxForm();

  var tips = $('#login-tips');

  var logOptions = {

    'dataType': 'json',

    'resetForm': false,

    success: function (data) {

      console.log(data);

      if (data.code) {

        window.location.href = '/' + $linpai.route;

      } else {

        if (typeof(data.msg) == 'string') {
        
          if (data.msg == 'not_found') {

            tips.html('没有该用户，请检查用户名');

          } else if (data.msg == 'not_match') {

            tips.html('用户名或密码不匹配');

          }

        } else if (typeof(data.msg) == 'object') { 

          var s = '';

          for (var k in data.msg) {

            var input = alogForm.find('input[name=' + k + ']');

            s += '<p>' + input.attr('title') + '不能为空！' + '</p>';
          
          }

          tips.html(s);

        }

        tips.removeClass('hide');

      }

    },

    error: function (err) {

      console.log(err);

    }

  };

  var logSubmit = alogForm.find('#log-submit');

  logSubmit.click(function (e) {

    e.preventDefault();

    tips.addClass('hide');

    alogForm.ajaxSubmit(logOptions);

  });

})();

/*
 *
 */
(function () {

  var source;

  var orderUnread = true;

  var coopUnread = true;

  var sdb = sessionStorage;

  source = new EventSource('http://www.51linpai.com/' + $linpai.route + '/push');

  source.onopen = function () {
  
    console.log('connected.');

  };

  source.onmessage = function (evnet) {

    var pre_order = sdb.getItem('pre_order');

    var pre_coop = sdb.getItem('pre_coop');

    var notice = evnet.data;

    var arr = notice.split('-');

    var order_num = arr[0];

    var coop_num = arr[1];

    if (pre_order == null || pre_coop == null) {
    
      sdb.setItem('pre_order', pre_order);

      sdb.setItem('pre_coop', pre_order);

      sdb.setItem('ods', 0);

      sdb.setItem('cds', 0);

      return;
    
    }

    if (coop_num > pre_coop || order_num > pre_order) {
    
      $('#message_btn').addClass('btn-danger').removeClass('btn-info');

      $('#unread_coop').html(coop_num - pre_coop);

      $('#unread_order').html(order_num - pre_order);

      sdb.setItem('ods', order_num - pre_order);

      sdb.setItem('cds', coop_num - pre_coop);

    }
  
  };

  source.onerror = function (evnet) {
  
  };

  $('#unread_coop').parent().click(function (e) {

    e.preventDefault();
  
    $('#unread_coop').html('0');

    var cds = sdb.getItem('cds');

    var pre_coop = sdb.getItem('pre_coop');

    sdb.setItem('pre_coop', pre_coop + cds);

    $('#unread_coop').html('0');

  });

  $('#unread_order').parent().click(function (e) {
  
    e.preventDefault();
  
    var ods = sdb.getItem('ods');

    var pre_order = sdb.getItem('pre_order');

    sdb.setItem('pre_order', pre_order + ods);

    $('#unread_order').html('0');

  });

})();

/*
 * 
 */
(function () {

  var orderInfos = $('.get_order_details');

  if (orderInfos.size() == 0) {

    return;

  }

  orderInfos.click(function (e) {

    e.preventDefault();

    var that = $(this); 

    $.get('/orderboard/orderlargeinfo', {

      'order_code': that.data('oid'),

      'user': that.data('user')
    
    }, function (data) {

      if (data.code) {

        var object = $(data.res);

        $('body').append(object);

      } else {


      }

    }, 'json');

  });

})();

(function () {

  $('.file-download').click(function (e) {
  
    e.preventDefault();
  
    window.open('/imgs/tmp/' + $(this).data('url'));
  
  });


})();

(function () {

  /*
   * 用户列表下载
   */
  var queryForm = $('.query_form');

  $('.excel_download').click(function (e) {

    e.preventDefault();

    queryForm.find('input[name=excel]').val(1);

    queryForm[0].submit();

  });

  $('.board_query').click(function (e) {

    e.preventDefault();

    queryForm.find('input[name=excel]').val(0);

    queryForm[0].submit();

  });

  /*
   * 合作伙伴列表下载
   */

})();


/*
 * 选择地区
 */
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

(function () {

  var uploadsBtn = $('.board_img_uploads');

  uploadsBtn.click(function (e) {

    e.preventDefault();

    var that = $(this);

    var uploadBox = $('#upload_box');

    var imgUrl = that.data('url');

    uploadBox.find('#u_p_img').attr('src', imgUrl); 

    uploadBox.find('#board_upload').fileupload({
    
      autoUpload: true,

      url: '/adboard/imgupload',

      sequentialUploads: true,

      dataType: 'json',

      formData: {

        'code': that.data('code')

      },

      add: function (e, data) {

        data.submit();

      }
    
    }).bind('fileuploadprogress', function (e, data) {
      
      var progress = parseInt(data.loaded / data.total * 100, 10);

    }).bind('fileuploaddone', function (e, data) {
      
      
    });

    uploadBox.removeClass('hide');

  });

})();

(function () {

  var messageBtn = $('#message_btn');

  messageBtn.click(function (e) {
  
    e.preventDefault();

    messageBtn.removeClass('btn-danger').addClass('btn-info');
  
  });

})();

(function () {

  $('.detail_tag').click(function (e) {
  
    e.preventDefault();

    var that = $(this);

    var target_data = that.data('target');

    var itms = $('#' + target_data).find('td');

    itms.each(function (i, t) {
    
      var targetId = $(t).data('target');

      if (typeof targetId != 'undefined') {

        $('#' + targetId).html($(t).html());

      }
    
    });

    $('.coop_panel').removeClass('hide');
  
  });

  $('#op_remove').click(function (e) {

    e.preventDefault();
  
    $('.coop_panel').addClass('hide');
    
  
  });

})();
