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
  
    var content = $('#c-i-a-content')

    $('#car-info-edit').slideToggle(function () {
    
      if (that.data('status') == 'show') {
      
        content.html('取消编辑');

        that.data('status', 'hide');
      
      } else {
      
        content.html('新增车辆');

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
      
        that.html('新增地址');

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
    
      that.hy

    });

  });


  var gnum = $('input#g-num');
  /*
   * minu num
   */
  var gminus = $('button#g-minu');

  gminus.click(function (e) {

    e.preventDefault();

    if (parseInt(gnum.val()) > 1) {

      gnum.val(parseInt(gnum.val()) - 1);

    }

  });

  /*
   * plus num
   */
  var gplus = $('button#g-plus');

  gplus.click(function (e) {

    e.preventDefault();

    gnum.val(parseInt(gnum.val()) + 1);
  
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

  $('.info-img').each(function () {

    var that = $(this);

    var url = that.data('url');

    that.fileupload({

      autoUpload: true,

      url: url,

      sequentialUploads: true
    
    }).bind('fileuploadprogress', function (e, data) {

      var progress = parseInt(data.loaded / data.total * 100, 10);
    
    }).bind('fileuploaddone', function (e, data) {
    
      
    
    });
  
  });

})();
