var resetInfoRemove; 

var $linpai = {};

window.linpai = $linpai;
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

  var editBtnListener = this;

  var bindEdit;
  
  ($linpai.bindEdit = bindEdit = function () {
  
    var editBtns = $('.itm-edit');

    editBtns.unbind('click');
    /*
     * 编辑按钮绑定事件
     */
    editBtns.click(function (e) {

      e.preventDefault();

      var that = $(this);

      var oid = that.data('id');

      var key = that.data('key');

      $.get(that.data('iurl'), { "key": key, "oid": oid }, function (data) {
      
        if (data.code) {
        
          var obj = data[key];

          if (obj != undefined && obj != null) {
          
             editBtnListener[ 'fill' + key ](obj, oid);
          
          }
        
        } else {
        
        
        }
      
      }, 'json');
    
    });

  })();
  

  /*
   * order confirm add car info.
   */
  var addCar = $('#car-info-add')

  $linpai.editCar = function () {
  
    $('#car-info-edit').slideToggle(function () {

      var that = $('#car-info-add');

      var content = that.find('#c-i-a-content');

      if (that.data('status') == 'show') {

        that.find('.glyphicon').removeClass('glyphicon-plus').addClass('glyphicon-minus');
      
        content.html(content.data('open'));

        that.data('status', 'hide');
      
      } else {

        that.find('.glyphicon').removeClass('glyphicon-minus').addClass('glyphicon-plus');
      
        content.html(content.data('close'));

        that.data('status', 'show');

        $('#new-car-form')[0].reset();

        $linpai.certFilesReset();
      
      }
    
    });
  
  };
    
  addCar.click(function () {

    var that = $(this);

    var carform = $('#new-car-form');

    carform.attr('action', carform.data('addurl'));

    carform.attr('status', 'add');
  
    $linpai.editCar();

  });

  /*
   * order confirm add new address info.
   */
  var addAddress = $('#new-address-add');

  $linpai.editReceiver = function () {
  
    $('#new-address-info').slideToggle(function () {

      var that = $('#new-address-add');

      var content = that.find('#n-a-content');
    
      if (that.data('status') == 'show') {

        that.find('.glyphicon').removeClass('glyphicon-plus').addClass('glyphicon-minus');
      
        content.html('取消地址编辑');

        that.data('status', 'hide');

      } else {

        that.find('.glyphicon').removeClass('glyphicon-minus').addClass('glyphicon-plus');
      
        content.html('新增地址信息');

        that.data('status', 'show');

        $linpai.areaReset();

        $('#new-receiver-form')[0].reset();
      
      }

    });
  
  };
  
  addAddress.click(function () {

    var that = $(this);

    var receiverForm = $('#new-receiver-form');

    receiverForm.attr('action', receiverForm.data('addurl'));

    receiverForm.attr('status', 'add');

    $linpai.editReceiver();
  
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

    /*
    var gnum = $('#' + $(this).data('target'));

    var id = $(this).data('id');

    gnum.val(parseInt(gnum.val()) + 1);

    var sprice = $('#single-price-' + id).val();

    var price = parseInt(sprice) * parseInt(gnum.val());

    $('#price-' + id).html(price);
    */
  
  });

  /*
   * 
   */
  var carInfoClick = function () {

    $('input[name=selected-car]').click(function () {

      var that = $(this);

      $('#car-info-field').find('input[name=car]').val(that.data('id'));

      $('#car-body').find('.use-card').removeClass('use-active');

      $('#use-car-' + that.data('id')).addClass('use-active');

    });
  
  };

  carInfoClick();

  var receiverInfoClick = function () {

    $('input[name=selected-receiver]').click(function () {

      var that = $(this);

      $('#receiver-info-field').find('input[name=receiver]').val(that.data('id'));

      $('#receiver-body').find('.use-card').removeClass('use-active');

      $('#use-receiver-' + that.data('id')).addClass('use-active');

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

    resetForm: false,

    success: function (data) {

      console.log(data);

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

            $('#more-car-info').removeClass('hide');
          
          });
        
        }

        if (carform.attr('status') == 'edit') {

          var oldItm = $('#' + $(html).attr('id'));

          var preItm = oldItm.prev();

          if (preItm.size() > 0) {

            preItm.after(html);

          } else { 
          
            $('#car-body').prepend(html); 
          }

          oldItm.remove();

        } else {

          $('#car-body').append(html);

        }

        /*
         * 绑定删除事件
         */
        resetInfoRemove();

        carform.find('img').each(function (i, t) {
        
          $(t).attr('src', '');

        });

        carform.find('.progress-bar').each(function (i, t) {

          $(t).css({width: '0px'});
        
        });

        /*
         * 绑定选中车辆事件
         */
        carInfoClick();

        /*
         * 绑定编辑事件
         */
        $linpai.bindEdit();

        /*
         * 清空车辆信息编辑
         */
        $('#new-car-form')[0].reset();

        $linpai.certFilesReset();

        $linpai.editCar();

        $linpai.toast('保存成功', '', 1000);
      
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
   * 重置车辆编辑的图片
   */
  $linpai.certFilesReset = function () {
  
    carform.find('img').attr('src', '');
  
  };

  /*
   *
   * 提交收货人信息
   */
  var receiverForm = $('#new-receiver-form');

  $('#new-receiver-form input[type=text]').focus(function (e){
  
    $(this).removeClass('alert-info-border');  
  
  });

  var receiverOptions = {

    dataType: 'json',

    resetForm: false,

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
          
            $('#receiver-list-table').removeClass('hide').show();

            $('#more-receiver-info').removeClass('hide');

          
          });
        
        }

        if (receiverForm.attr('status') == 'edit') {
        
          var oldItm = $('#' + $(item).attr('id'));

          var preItm = oldItm.prev();

          if (preItm.size() > 0) {
          
            preItm.after(item);
          
          } else {
          
            $('#receiver-body').prepend(item);
          
          }

          oldItm.remove();

        } else { 

          $('#receiver-body').append(item);

        }

        /*
         * 绑定删除事件
         */
        resetInfoRemove();

        /*
         * 绑定编辑事件
         */
        $linpai.bindEdit();
        
        /*
         * 关闭编辑区域
         */
        $linpai.editReceiver();

        $('.selected-province').html('选择省份');

        $('#selected-city').html('选择城市');

        $('#selected-district').html('选择区域');

        receiverInfoClick();

        $linpai.toast('保存成功！', '', 1000);

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

  /*
   * 提交合作商户信息
   */
  var cooperForm = $('#coop-form');

  if (cooperForm != undefined && cooperForm != null &&  cooperForm.size() > 0) {

    var cooperOptions = {
    
        dataType: 'json',

        resetForm: 'true',

        success: function (data) { 

          if (data.code) {

            var modal = $('#linpai-modal');

            modal.on('show.bs.modal', function () {

              modal.find('.modal-title').html('提交成功!');
          
              modal.find('.modal-body').html('您的信息已经收到，我们将尽快与您取得联系。');
              modal.find('#modal-confirm').hide();
              
            });

            modal.modal('show');

            cooperForm.find('p.p-5').addClass('hide');

            cooperForm.find('p.p-5').html('');

            $('.selected-province').html('选择省份');

            $('#selected-city').html('选择城市');

            $('#selected-district').html('选择区域');
          
          } else {
          
            var msg = data.msg;

            console.log(msg);

            for(var i = 0; i < msg.length; i++) {

              var code = msg[i];

              if (code =='province' || code == 'city' || code == 'district') {
              
                var lnotice = $('p[notice=location]');

                var location = lnotice.html();

                if (location.trim() != '') {

                  location += ', ';
                
                }

                location += code == 'province' ? '省份必须选择' : code == 'city' ? '城市必须选择' : code == 'district' ? '区域必须选择' : '';

                lnotice.html(location);

                lnotice.removeClass('hide');
              
              } else {

                var cname = $('label[for=' + code + ']').html();

                var notice = $('p[notice=' + code +']');
            
                notice.html(cname + ' 必须填写.');

                notice.removeClass('hide');

              }
            
            }
          
          }
        
        },

        error: function (err) {
        
        }
    
    };

    cooperForm.ajaxForm(cooperOptions);

    cooperSubmit = $('#coop-submit');

    cooperSubmit.click(function (e) {

      e.preventDefault();
    
      cooperForm.ajaxSubmit(cooperOptions);
    
    });

  }

  /*
   * 填充车辆编辑表单
   */
  editBtnListener.fillcar = function (obj, oid) {

    var carform = $('#new-car-form');

    carform.find('input[name=cid]').val(oid);

    for (var ky in obj) {

      var itm = carform.find('input[name=' + ky + ']');
        
      if (itm.attr('type') == 'text') {
      
        itm.val(obj[ky]);
      
      } else if (itm.attr('type') == 'hidden') {
        
        itm.val(obj[ky]);
        
        var imgItm = carform.find('img[target=' + ky + ']');

        if (imgItm.size() > 0) {
        
          imgItm.attr('src', '/imgs/tmps/' + itm.val());
        
        }

      } else if (itm.attr('type') == 'radio') {

        itm.each(function (i, t) {

          var th = $(t);

          if (th.attr('id') == obj[ky]) {

            console.log(th.attr('id'));

            th.attr('checked', true);

            th.val() == 'domestic' ? carform.find('p[filename=validate_paper]').html('合格证扫描件') : carform.find('p[filename=validate_paper]').html('报关单扫描件'); 
          
          } else {

            th.removeAttr('checked');
          
          }

        });
      
      }

    }

    /*
     * 设置编辑表单
     */
    carform.attr('action', carform.data('editurl'));

    carform.attr('status', 'edit');

    carform.find('#c-i-tit').html('编辑车辆信息');

    var addCar = $('#car-info-add');

    if (addCar.data('status') == 'show') {
    
      $linpai.editCar();
    
    }
  
  };

  editBtnListener.fillreceiver = function (obj ,rid) {

    var receiverForm = $('#new-receiver-form');

    receiverForm.attr('status', 'edit');

    for (var k in obj) {

      var value = obj[k];
    
      var itm = receiverForm.find('input[name=' + k + ']');
    
      itm.val(value);

      /*
       * 填充地区
       */
      if (k == 'province') $('.selected-province').html(value);
      else if (k == 'city') $('#selected-city').html(value);
      else if (k == 'district') $('#selected-district').html(value);
    
    }

    /*
     * 设置编辑表单
     */
    receiverForm.attr('action', receiverForm.data('editurl'));

    receiverForm.find('input[name=rid]').val(rid);

    receiverForm.find('#r-i-tit').html('编辑收货地址');

    var addReceiver = $('#new-address-add');

    if (addReceiver.data('status') == 'show') {
    
      $linpai.editReceiver();
    
    }
  
  };

})();

/*
 * 显示列表更多信息
 */
(function () {

  //validate goods num;
  var num = $('input.g-num');

  num.change(function (e) {
  
    num.val(1);
  
  });


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

/*
 * 绑定信息删除事件
 */
($linpai.resetInfoRemove = resetInfoRemove = function () {

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
  
    /*
    var that = $(this);

    if (that.is(':checked')) {
    
      bt.enable();
    
    } else {
    
      bt.enable(false);
    
    }
    */
    
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

  var toPage;

  $('#o-pre-page').click(function (e) {
  
    e.preventDefault();

    var that = $(this);

    var page = parseInt(that.data('cpage')) - 1;

    toPage = page;

    getOrders(that, page);
  
  });

  $('#o-next-page').click(function (e) {

    e.preventDefault();
  
    var that = $(this);

    var page = parseInt(that.data('cpage')) + 1;

    toPage = page;

    getOrders(that, page);
  
  });

  $('.o-page').click(function (e) {
  
    e.preventDefault();

    var that = $(this);

    var page = that.data('page');

    that.attr('disabled', 'disabled');

    toPage = page;

    getOrders(that, page);
  
  });

  function getOrders (that, page) { 

    $.get('/profile/myorder', {
    
        page: page,

        _token: that.data('token')

      }, function (data) {

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

        $('.o-page').each(function (i, t) {

          if ($(t).data('page') == toPage) {

            $(t).addClass('active');
          
          } else {

            $(t).removeClass('active');

          }
        
        });
      
      }, 'json');
  
  }

})();

/*
 *  展示协议
 */
(function () {

  var uagree = $('.text-agreement');

  if (uagree != undefined &&  uagree != null && uagree.size() > 0) {

    uagree.click(function (e) {

      e.preventDefault();

      var url = $(this).data('url');

      $.get('/text/' + url, {}, function (data) {

        var text = data.text;

        $('#linpai-modal').on('show.bs.modal', function () {

          var modal = $(this);

          modal.find('.modal-title').html('《51临牌使用协议》');

          modal.find('.modal-body').html(text);

          modal.find('#modal-confirm').hide();
        
        });

        $('#linpai-modal').modal('show');
      
      }, 'json');

    });

  }

})();

/*
 * 检测手机号js
 */
(function () {

  var mInput = $('.mobile-input');

  var legal = false;

  if (mInput != undefined && mInput != null && mInput.size() > 0) {
  
    mInput.change(function () {

      var that = $(this);
    
      that.css({'background': '#fff'});

      if (!isMobile(that.val())) {
      
        that.css({'background': '#f2dede'});

        that.val('');

        that.attr('placeholder', '请输入有效手机号码！(长度为11位)');

        legal = false;
      
      } else {
      
        legal = true;
      
      }
    
    });
  
  }

  var cInput = $('.mobile-unique');

  cInput.blur(function () {

    if (!legal) return;

    $.get('/user/exists', { 'type': 'mobile',  'value': cInput.val() }, function (data) {

      if (data.code) {

        cInput.css({'background-color': '#f2dede'});

        cInput.val('');

        cInput.attr('placeholder', '该手机号已经被注册，请更换。');

      } else {

        //cInput.css({'background': '#d6e9c6'});
      
      }
    
    }, 'json');
  
  });

})();

/*
 * 选择进口车，国产车
 */
(function () {

  $('.car_type').click(function (e) {

    if ($(this).attr('id') == 'domestic') {

      $('p[filename=validate_paper]').html('合格证扫描件');

    } else {
    
      $('p[filename=validate_paper]').html('报关单扫描件');
    
    }
  
  });

})();

/*
 * 文件样例
 */
(function () {

  var clientWidth = $(window).width(),
    
      clientHeight = $(window).height();

  $('.i-img').mouseover(function (e) {

    var that = $(this);
  
    var newNode = "<div class=\"box " + that.data('disclass') + "\" trigger=\"" + that.attr('id') + "\"></div>";

    var introImg = $(newNode);

    var elementLeft = that.offset().left;

    var elementTop = that.offset().top;

    $('body').append(introImg);

    /*
     * 定义弹出元素的位置
     */
    if (that.data('flow-pos') == 'above') {

      introImg.css({left: elementLeft - (introImg.width()/3), 'bottom': '105px' });

      introImg.show();

      return;

    }

    if (clientWidth/elementLeft > 2) {

      introImg.css({left: elementLeft + that.width() * 2});
    
    } else {

      introImg.css({left: elementLeft - introImg.width() - that.width()});
    
    }

  });

  $('.i-img').mouseout(function (e) {
  
    var that = $(this);

    $("div[trigger=\"" + that.attr('id') + "\"]").remove();
  
  })

})();

/*
 * 用户注册
 */
(function () {

  var registrar = $('#register-box'); 
  registrar.find('input').focus(function () {

    var that = $(this);
  
    that.css({background: '#fff'});

    that.attr('placeholder', that.attr('tips'));
  
  });

  if (!registrar.size()) return;

  var regForm = $('#reg-form');
  
  regForm.ajaxForm();

  var regSubmit = $('#register-submit');

  var regOptions = {
  
    dataType: 'json',

    success: function (data) {

      if (data.code) {
      
        $linpai.toast('注册成功', 'window.location.href="/home"', 1500)
      
      } else {

        $.each(data.failed, function (n, val) {
        
          var field = regForm.find('input[name=' + val + ']');
          
          field.css({background: '#ebccd1'});
          
          field.attr('placeholder', '填写错误！');
            
          field.val('');
        
        });
      
        regSubmit.removeAttr('disabled');

        regSubmit.html('提交');

      }
    
    },

    error: function (err) {
    
      console.log(err);

      regSubmit.removeAttr('disabled');

      regSubmit.html('提交');
    
    }

  };

  regSubmit.click(function (e) {
  
    e.preventDefault();
      
    regForm.find('input').each(function (i, t) {

      var iele = $(t);
    
      if (iele.val() == undefined || iele.val().length == 0) {
      
        iele.css({background: '#ebccd1'});
      
        iele.attr('placeholder', '请填写' + iele.attr('tips'));
      
      }
    
    });

    $(this).html('正在提交...');

    $(this).attr('disabled', 'disabled');
  
    regForm.ajaxSubmit(regOptions);
  
  });

})();

/*
 * 密码检测
 */
(function () {

  var pInput = $('input[type=password]');

  pInput.change(function () {

    var pwd = pInput.val();
    
    var that = $(this);

    if (pwd.length > 0 && pwd.length < 6) {

      that.val('');

      that.css({'background': '#ebccd1'});

      that.attr('placeholder', '请输入长度 6 －18 位的密码');
    
    }

  });

  pInput.focus(function () {
  
    var that = $(this);

    that.css({'background': '#fff'});

    that.attr('placeholder', '');
  
  });

})();

/*
 * 修改密码
 */
(function () {

  var passModifyBtn = $('#password-modify');

  var passBlock = $('#passwd-modify');
        
  var passform = $('#passwd-form');

  passModifyBtn.click(function (e) {

    e.preventDefault();

    passBlock.removeClass('hide').fadeIn();

    $('.over-all').click(function () {

      passBlock.fadeOut();
    
      passform[0].reset(); 
    
    });

  });

  if (passform.size() > 0) {

    passform.ajaxForm();

    var passOptions = {

      dataType: 'json',
    
      resetForm: true,
    
      success: function (data) {

        passBlock.find('.alert').addClass('hide');

        if (data.code) {

          passBlock.find('.alert-success').removeClass('hide').html('修改成功，请重新登录');

          passBlock.find('#passwd-box').addClass('animated infinite bounce');

          passform[0].reset();

          passform.find('input[type=password]').enable(false).css({'background': '#f5f5f5'});

          setTimeout('$(\'.over-all\').fadeOut();$(\'#passwd-modify\').fadeOut();window.location.href=\'/auth/login\'', 1500);

        } else {

          if (data.msg == 'miss_match') {
          
            passBlock.find('.alert-danger').removeClass('hide').html('原密码输入错误！');
          
          } else if (data.msg == 'not_match') {

            passBlock.find('.alert-danger').removeClass('hide').html('两次输入的密码不一致！');

          }

        }

      }, 

      error: function (err) {

        console.log(err);

      }
    
    };

    var passSubmit = $('#pass-submit');

    passSubmit.click(function (e) {

      e.preventDefault();

      var inputs = passform.find('input[type=password]');

      var legal = true;

      for (var i = 0; i < inputs.size(); i++) {

        var input = $(inputs[i]);

        if (input.val() == '') {

          legal = false;

          input.css({ 'background': '#ebccd1' }).attr('placeholder', '请填写' + input.attr('title'));

        }

      }

      if (legal) {

        passform.ajaxSubmit(passOptions);

      } 

    });

  }
  
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

              $('#more-' + that.data('type') + '-info').addClass('hide');

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

  /*
  var reg = /^0?1[3|4|5|7|8|][0-9]\d{8}$/;

  return reg.test(mobile);
  */
  return mobile.length == 11;

}

$linpai.toast = function (shortStr, scripts, timeout) {

   $('body').append("<div class=\"over-all\"></div>");

   $('body').append("<div class=\"box login-notice animated infinite bounce toast-notice\">" + shortStr + "</div>");

   window.setTimeout(scripts, timeout);

   window.setTimeout('$(\'.over-all\').remove();$(\'.toast-notice\').remove();', timeout);


};
