var resetInfoRemove;

/*
 * 首页横幅
 */
(function () {

  $('.carousel').carousel();

   var btop = $('#b-top');
   
   btop.click(function () {
   
     window.scrollTo(0, 0);
   
   })

   /*
    * 回到顶部按钮
    */
   $(window).scroll(function () {
   
     if (window.scrollY > 0) {
         
       btop.fadeIn();
   
     } else {
     
       btop.fadeOut();
     
     }

   });

})(); 

/*
 * 顶部导航
 */
(function() {

    var header = $('#header');

    var initTop = 0;

    $(window).scroll(function () {
    
      var scrollTop = $(document).scrollTop();

      if (scrollTop > initTop) {
      
        header.fadeOut('normal');
      
      } else {
      
        header.fadeIn('fast');
      
      }

      initTop = scrollTop;
    
    });

}());


/*
 * 按钮监听事件
 */

(function () {
  
  /*
   * order confirm add car info.
   */
  var addCar = $('#car-info-add')
    
  addCar.click(function () {

    var that = $(this);
  
    $('#car-info-edit').slideToggle(function () {
    
      if (that.data('status') == 'show') {
      
        that.html('取消编辑');

        that.data('status', 'hide');
      
      } else {

        var s = "<span class=\"glyphicon glyphicon-plus\"></span>";
      
        that.html( s + '新增车辆');

        that.data('status', 'show');
      
      }
    
    });

  });

  /*
   * order confirm add new address info.
   */
  var addAddress = $('#new-address-add');
  
  addAddress.click(function () {

    var that = $(this);

    $('#new-address-info').slideToggle(function () {
    
      if (that.data('status') == 'show') {
      
        that.html('取消编辑');

        that.data('status', 'hide');
      
      } else {

        var s = '<span class="glyphicon glyphicon-plus"></span>';
      
        that.html( s + '&nbsp;新增地址');

        that.data('status', 'show');
      
      }
    
    });
  
  });

  /*
   * bonus
   */
  var viewQuan = $('#quan-view');
  
  viewQuan.click(function () {
  
    var that = $(this);
  
    $('#quan-box').slideToggle(function () {
    
      if (that.data('status') == 'show') {
      
        that.html('---收起优惠券---');

        that.data('status', 'hide');
      
      } else {
      
        that.html('查看可用优惠券');

        that.data('status', 'show');
      
      }
    
    });
  
  });

  /*
   * jump
   */
  var quans = $('.quan-itm');

  quans.each(function () {
  
    var that = $(this);
  
    that.mouseover(function () {

    });

  });

  /*
   * minu num
   */
  var gminus = $('button#g-minu');

  gminus.click(function (e) {

    e.preventDefault();

    var gnum = $('#' + $(this).data('target'));

    var id = $(this).data('id');

    if (parseInt(gnum.val()) > 1) {

      gnum.val(parseInt(gnum.val()) - 1);

      var sprice = $('#single-price-' + id).val();

      var price = parseInt(sprice) * parseInt(gnum.val());

      $('#price-' + id).html(price);

    }

  });

  /*
   * plus num
   */
  var gplus = $('button#g-plus');

  gplus.click(function (e) {

    e.preventDefault();

    var gnum = $('#' + $(this).data('target'));

    var id = $(this).data('id');

    gnum.val(parseInt(gnum.val()) + 1);

    var sprice = $('#single-price-' + id).val();

    var price = parseInt(sprice) * parseInt(gnum.val());

    $('#price-' + id).html(price);
  
  });

  /*
   * 
   */
  var carInfoClick = function () {
  
    $('input[name=selected-car]').click(function () {
    
      $('#car-info-field').find('input[name=car]').val($(this).data('id'));
    
    });
  
  };

  carInfoClick();

  var receiverInfoClick = function () {

    $('input[name=selected-receiver]').click(function () {

      $('#receiver-info-field').find('input[name=receiver]').val($(this).data('id'));

    });
  
  };

  receiverInfoClick();


  /*
   * 提交新车信息
   */
  var carform = $('#new-car-form'); 

  $('#new-car-form  input[type=text]').focus(function (e) {

    $(this).removeClass('alert-info-border');

  });

  var carformOption = {
  
    dataType: 'json',

    resetForm: true,

    success: function (data) {

      if (!data.code) {

        var alertBox = $('#carinfo-error').removeClass('hide');
      
        var message = data.msg;

        var s = '<h5>您的输入有误！</h5>';
        
        for (var k in message) {

          s += '<p>* ' + message[k] + '</p>';

          $("input[name=" + k + "]").each(function (i, e) {
          
            if ($(e).attr('type') == "text") {
            
              $(e).addClass('alert-info-border');
            
            } else {

              $(e).parent().addClass('alert-info-border');
            
            }
          
          });

        }

        alertBox.html(s);
        
      } else {

        var html = data.result;

        if (0 == $('#car-body').children().size()) {
        
          $('#car-empty-info').fadeOut('fast', function () {
          
            $('#car-list-table').removeClass('hide');

            $('#car-list-table').show();
          
          });
        
        }

        $('#car-body').append(html);

        resetInfoRemove();

        carform.find('img').each(function (i, t) {
        
          $(t).attr('src', '');

        });

        carform.find('.progress-bar').each(function (i, t) {

          $(t).css({width: '0px'});
        
        });

        carInfoClick();
      
      }
    
    },

    error: function (err) {
    
      console.log(err);
    
    }
  
  };

  carform.ajaxForm(carformOption);

  var carSubmit = $('#new-car-submit');

  carSubmit.click(function (e) {
    
    e.preventDefault();

    $('#carinfo-error').addClass('hide');
  
    carform.ajaxSubmit(carformOption);
  
  });

  /*
   * 提交收货人信息
   */
  var receiverForm = $('#new-receiver-form');

  $('#new-receiver-form input[type=text]').focus(function (e){
  
    $(this).removeClass('alert-info-border');  
  
  });

  var receiverOptions = {

    dataType: 'json',

    resetForm: true,

    success: function (data) {

      if (data.code == 0) {

        $('#address-alert').removeClass('hide');
      
        var s = '<h5>您的输入有误！</h5>';

        for (var k in data.msg) {
        
          s += '<p>' + data.msg[k] + '</p>';

          $('#v-' + k).addClass('alert-info-border');

        }

        $('#address-alert').html(s);

      } else {

        var item = data.result;

        if (0 == $('#receiver-body').children().size()) {
        
          $('#receiver-empty-info').fadeOut('fast', function () {
          
            $('#receiver-list-table').removeClass('hide');
          
          });
        
        }
      
        $('#receiver-body').append(item);

        resetInfoRemove();

        $('#selected-city').html('选择城市');

        $('#selected-district').html('选择区域');

        receiverInfoClick();
      
      } 
    
    },

    error: function (err) {
    
      console.log(err);
    
    }
  
  };

  receiverForm.ajaxForm(receiverOptions);

  var receiverSubmit = $('#receiver-submit');

  receiverSubmit.click(function (e) {

    e.preventDefault();

    $('#address-alert').addClass('hide');

    receiverForm.ajaxSubmit(receiverOptions);
  
  });

})();


(function () {

  //validate goods num;
  var num = $('#g-num');

})();

/*
 * file upload.
 */
(function () {

  $('.info-img').each(function (i, t) {

    var that = $(this);

    var url = that.data('url');
    
    var progressBar = $('#progress_bar_' + that.attr('id'));

    that.fileupload({

      autoUpload: true,

      url: url,

      sequentialUploads: true,

      dataType: 'json',

      formData: {
      
        code: that.attr('name'),

        spec: that.data('spec'),

        _token: $('#_token').val()
      
      },

      add: function (e, data) {

        progressBar.css({ width: '10%'});
      
        data.submit();
      
      }
    
    }).bind('fileuploadprogress', function (e, data) {

      var progress = parseInt(data.loaded / data.total * 100, 10);

      progressBar.css({ width: progress + '%'});
    
    }).bind('fileuploaddone', function (e, data) {

      var res = data.result.res;

      $('#hint-' + that.attr('name')).parent().removeClass('alert-info-border');

      $('#upload-img-' + that.attr('name')).attr("src", res.preview);

      $('#hint-' + that.attr('name')).val(res.tmpfile);
      
    });
  
  });

})();

/*
 * 选择地址
 */

var addressBind;

(addressBind = function () {

  $('.cities-item').each(function (i, t) {
  
    $(t).click(function (e) {

      e.preventDefault();
    
      var name = $(this).html();

      $('#selected-city').html(name);

      $('#post-city').val(name);
    
      $('#v-city').removeClass('alert-info-border');

    })
  
  })

  $('.districts-item').each(function (i, t) {
  
    $(t).click(function (e) {
    
      e.preventDefault();

      var name = $(this).html();

      $('#selected-district').html(name);

      $('#post-district').val(name);

      $('#v-district').removeClass('alert-info-border');
    
    })
  
  });

})();

/*
 * 绑定信息删除事件
 */
(resetInfoRemove = function () {

  $('a.remove-receiver').click(function (e) {
  
    e.preventDefault();

    modal('delete', this);
  
  });

  $('a.remove-car').click(function (e) {
  
    e.preventDefault();

    modal('delete', this);
  
  });

})();

/*
 * 优惠券相关
 */
(function () {

  var setTprice = function (num, type) {

    var tprice = $('.total-price');
  
    if (!type) {
    
      tprice.html(num);

      return;
    
    }

    var cprice = parseInt(tprice.html());

    return type == 'minus' ? tprice.html(cprice - parseInt(num)) : tprice.html(cprice + parseInt(num));
  
  }

  var setDiscount = function (num, type) {

    var discount = $('#discount');
  
    if (!type) {
    
      discount.html(num);
    
      return;

    }

    var c = parseInt(discount.html());

    return type == 'minus' ? discount.html(c - parseInt(num)) : discount.html(c + parseInt(num));
  
  }

  var bouns = $('a.bouns');

  var bounsList = $('#selected-bouns').find('input.form-control');

  //绑定优惠券输入事件
  bounsList.change(function () {

    var that = $(this);

    var bind = that.data('boun-bind');

    var bindItm = (bind == undefined || bind == '') ? undefined : $('#b-' + that.data('boun-bind'));

    //绑定了优惠券
    if (bindItm) {

      that.data('boun-bind', '');

      bindItm.data('selected', false);

      bindItm.find('div.quan-itm').addClass('r-trans').removeClass('selected-boun');

      var num = that.data('denomination') == undefined ? 0 : that.data('denomination');

      setDiscount(num, 'minus');

      setTprice(num, 'plus');

    } else {

      that.data('boun-bind', that.val());

      bindItm = $('#b-' + that.val());

      bindItm.find('div.quan-itm').removeClass('r-trans').addClass('selected-boun');

      bindItm.data('selected', 'true');

    }

    $('#youhui-field').find('input[name=' + that.attr('name') + ']').val(that.val());

    if (that.val() == '') {

      that.css({background: '#fff'});

      return;

    }

    $.post('bouns/check', {

      _token: $('#_token').val(),

      boun_code: that.val()
    
    }, function (data) {

      var checkBoun = data.res.boun;

      var userId = data.res.uid;

      var yAlert = $('#youhui-alert');

      if (checkBoun) {
      
        if (checkBoun.active == 0) {
        
          /*
           * 失效
           */
          yAlert.html(checkBoun.code + '已经失效');

          yAlert.fadeIn();
        
          that.css({background: '#ebccd1' });

        } else if (checkBoun.uid != userId && checkBoun.type == 1) {

          /*
           * 不能使用别人的优惠码
           */
          yAlert.html(checkBoun.code + '是错误的优惠码，或者不是您的优惠码。');

          yAlert.fadeIn(); 

          that.css({background: '#ebccd1' });
        
        } else if (checkBoun.uid == userId && checkBoun.type == 0) {

          /*
           * 不能使用自己的推荐码
           */
          yAlert.html("抱歉，不能使用自己的推荐码：" + checkBoun.code + " 进行购买");

          yAlert.fadeIn();
        
          that.css({background: '#ebccd1' });
        
        } else {

          var bcss = that.css('background-color');


          if (bcss == 'rgb(235, 204, 209)') {
          
            yAlert.fadeOut();
          
          }
        
          that.css({background: '#d6e9c6'}); 

          var num = checkBoun.note;

          setTprice(num, 'minus')

          setDiscount(num, 'plus');

          that.data('denomination', num);
        
        }
      
      } else {
      
        yAlert.html("优惠码／推荐码：" + that.val() + " 不存在，请重新输入！");

        yAlert.fadeIn();
      
        that.css({background: '#ebccd1' });

      }
    
    }, 'json');
  
  
  });

  //////绑定优惠券点击事件
  
  if (bouns.size() > 0) {

    bouns.each(function (i, t) {
    
      $(t).click(function (e) {

        e.preventDefault();

        //当点击已选中按钮时
        if ($(t).data('selected') == 'true') {

          bounsList.each(function () {

            if ($(this).val() == $(t).data('code')) {

              $(this).val('');

              $(this).change();
            
            }

          });
        
        } else {

          for (var i = 0; i < bounsList.size(); i++) {

            var bounItm = $(bounsList[i]);

            if (bounItm.val() == '' || bounItm.val().length != 8) {

              bounItm.val($(this).data('code'));

              bounItm.change();

              break;
            
            }

            if (i == bounsList.size() - 1) {
            
            
            }
          
          }
        } 
    
      });
    
    });
  
  }

})();

/*
 * 订单提交
 */
(function () {

  var bt = $('#to-pay');

  $('#contract').click(function () {
  
    var that = $(this);

    if (that.is(':checked')) {
    
      bt.enable();
    
    } else {
    
      bt.enable(false);
    
    }
    
  });

})();

//提交订单
(function () {
  
  var orderSubmit = $('#to-pay');

  if (!orderSubmit) {

    return;

  } 

  var orderErr = $('#order-sub-error');

  var checkOrderForm = function () {

    var err = true;
  
    $('#next-form').find('input[required=yes]').each(function (i, t) {
    
      if ($(t).val() == undefined || $(t).val() == '') {
      
        orderErr.append('<p>' + $(t).data('name') + '选择错误，请重新选择</p>');
      
        err = false;
      }
      
    });

    console.log(err);

    return err;
  
  }
  
  orderSubmit.click(function (e) {

    if (!checkOrderForm()) {

      e.preventDefault();

      orderErr.removeClass('hide');

      orderErr.fadeIn('fast');
    
    } else {
    
      orderErr.html('');

      $('#next-form').submit();
    
    }
  
  });

})();

/*
 * profile 编辑个人信息
 */
(function () {

  var editBt = $('a.account-edit');

  var personInfoForm = $('#person-form');

  personInfoForm.ajaxForm();

  var pOptions = {

    'dataType': 'json',

    'success': function (data) {

      if (data.code) {
      
        for (var key in data.result) {
        
          $('#edit-' + key).find('input').val(data.result[key]);

          $('#display-' + key).html(data.result[key]);
        
        }
      
      } else {
      
        console.log('failed.');
      
      }
    
    },

    'error': function (err) {
    
      console.log(err);
    
    }
  
  };

  if (editBt.size() > 0) {
  
    editBt.each(function (i, t) {

      $(t).click(function () {
      
        var that = $(this);

        var target = that.data('target');

        var icon = that.find('span');

        var state = that.attr('state');

        var editTarget = $('#edit-' + target);

        var displayTarget = $('#display-' + target);

        var editElement = editTarget.find('input');

        if (state == 'edit') {
        
          icon.removeClass('glyphicon-edit');  

          icon.addClass('glyphicon-save');

          that.attr('state', 'save');

          editElement.data('pre', editElement.val());

          editTarget.removeClass('hide');

          displayTarget.addClass('hide');

        } else if (state == 'save') {

          if (editElement.val() != editElement.data('pre')) {

            personInfoForm.ajaxSubmit(pOptions);

          }

          editTarget.addClass('hide');

          displayTarget.removeClass('hide');

          icon.removeClass('glyphicon-save');

          icon.addClass('glyphicon-edit');

          that.attr('state', 'edit');
        
        }

      });
    
    })
  
  }



})();

/*
 * 订单分页
 */
(function () {

  $('#o-pre-page').click(function (e) {
  
    e.preventDefault();

    var that = $(this);

    var page = parseInt(that.data('cpage')) - 1;
  
    getOrders(that, page);
  
  });

  $('#o-next-page').click(function (e) {

    e.preventDefault();
  
    var that = $(this);

    var page = parseInt(that.data('cpage')) + 1;

    getOrders(that, page);
  
  });

  $('.o-page').click(function (e) {
  
    e.preventDefault();

    var that = $(this);

    var page = that.data('page');

    that.attr('disabled', 'disabled');

    getOrders(that, page);
  
  });

  function getOrders (that, page) { 

    $.get('/profile/myorder', {
    
        page: page,

        _token: that.data('token')

      }, function (data) {

        console.log(data.res);

        var res = data.res;

        if (res.html) { 

          $('#order-list').html(res.html);

          if (res.page > 1 && res.page <= res.pages) {
          
            $('#o-pre-page').removeClass('hide');

            $('#o-pre-page').data('cpage', res.page);
          
          } else {
          
            $('#o-pre-page').addClass('hide');
          
          }

          if (res.page == res.pages) {
          
            $('#o-next-page').addClass('hide');
          
          } else {
          
            $('#o-next-page').removeClass('hide');

            $('#o-next-page').data('cpage', res.page);
          
          }

        }
      
      }, 'json');
  
  }

})();

/*
 * Go to pay.
 */
(function () {
  
  var toPay = $('.go_to_pay');

  if (!toPay) return;

  toPay.click(function (e) {

    e.preventDefault();

     
  
  
  
  });

})();

/*
 * deliver info.
 */
(funciton () {


})();

function modal (e, th) {

  var postDelete = function(e, t) {

    e.preventDefault();

    var that = $(this);

    var url = '/' + that.data('type') + '/delete';
  
    $.post(url, { 
      
        id: that.data('id'),

        _token: that.data('token')
       
      }, function (data) {
    
        if (parseInt(data.result) == 1) {

          var deletedItem = $('#' + that.data('related'));

          if (0 == deletedItem.siblings().size()) {

            $('#' + that.data('type') + '-list-table').fadeOut('fast', function () {

              $('#'+ that.data('type') + '-empty-info').removeClass('hide').fadeIn('fast');

            });

          }

          deletedItem.remove();

          $('#modal-dismiss').click();
        
        }
    
      }, 
      
    'json');

  }

  if (e == 'delete') {

    var target = $('#' + $(th).data('target'));

    var s = "确认您要删除的记录：";

    target.children().each(function (i, t) {

      s += '&nbsp;&nbsp;' + htmlReplace($(t).html());
    
    })

    s = s.trim();

    $('#linpai-modal').on('show.bs.modal', function () {

      var modal = $(this);
        
      modal.find('.modal-body').html(s);

      modal.find('#modal-confirm')
        .data('id', $(th).data('id'))
        .data('type', $(th).data('type'))
        .data('related', $(th).data('target'))
        .click(postDelete);
    
    });

    $('#linpai-modal').modal('show');
    
  }

}

function htmlReplace (str) {

  return str.replace(/<[^>]+>/g,"").replace(/\|/g, "");

}

function isMobile(mobile) {

  var reg = /^0?1[3|4|5|7|8|][0-9]\d{8}$/;

  return reg.test(mobile);

}
