<!doctype html>
<html>
  <head>
    <meta charset="utf-8" http-equiv=Content-Type content=text/html >
    <title>用户列表</title>
  </head>
  <body>
    <table class="table">
      <thead>
        <tr>
          <th>序号</th>
          <th>用户名</th>
          <th>手机号</th>
          <th>邮箱</th>
          <th>注册时间</th>
        </tr> 
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->mobile}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
