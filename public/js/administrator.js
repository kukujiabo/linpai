/*
 * 管理员登录
 */
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

        window.location.href = '/admin';

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
