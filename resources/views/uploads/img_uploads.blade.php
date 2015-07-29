<DOCTYPE HTML>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/upload.css') }}" rel="stylesheet">
</head>
<body>
  <form method="get" class="form" style="width:100%; height:100%">
    <div class="upload fs-upload-element fs-upload" id="upload-wrapper" style="width:100%; height:100%;"
      data-upload-options="{ 'action': '#'}">
      <div class="fs-upload-target" height="100%" >拖拽或点击选择图片</div>
      <input class="fs-upload-input" type="file" fs-upload-mutiple>
    </div>
  </form>
</body>
<script type="text/javascript">
   function resetIframeSize()
   {

      var a = document.getElementById('upload-wrapper');



   }

   window.onload=resetIframeSize;

   window.onresize=resetIframeSize

    </script>
</html>
