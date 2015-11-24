
(function () {

  var form = $('#receiver_form');

  var submit = $('#submit_btn');
  
  var options = {
  
    dataType : 'json',

    success: function (data) {
    
      if (data.code == 1) {
      
        alert('保存成功！');

        window.location.href = "/miniorder/buy?car_hand={{$car_hand == 'one' ? 1 : 2}}";
      
      } else {
      
        var msg = data.msg;

        var html = '';

        for (var k in msg) {
        
          html += '<p>' +  msg[k] + '</p>';   
           
        }

        $('#info_content').html(html);

        $('#trigger_pop').click();
      
      }
    
    },

    error: function (err) {
    
      console.log(err);
    
    }
  
  };

  submit.on('tap', function (e) {
  
    e.preventDefault(); 

    form.ajaxSubmit(options);    
  
  });
  
  $(document).on('pagecontainerload', function () {

    alert(1);

    submitajax();

    $('input[type=text]').change(function(e) {

      var that = $(this);
    
      var name = that.attr('name');

      $('#' + name + '_txt').html(that.val());
    
    });
  
  });

})();
