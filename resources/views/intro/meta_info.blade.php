@section('meta_info')

<div class="meta_box">
@if ($car_hand == 'one')
  <div class="alert alert-info">
    <h3 class="page-header">办理上海新车临牌</h3>
    
    <h4>快递办理材料</h4>
    
    <p class="padding-5">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请将下述材料准备妥善并快递至［51临牌］办公地址：上海市静安区延安西路433号金柏苑大厦2306室。
    您的资料将会得到［51临牌］最妥善的保管。
    </p>
    
    <p class="padding-5">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我们的工作人员收到您递交的材料以后将以短信形式通知您材料已收到，并第一时间为您办理临牌，我们预计于1-2个工作日内通过顺丰速递将您的办理材料原件和车辆临时号牌一起交付给您，及时保证您的顺利出行。
    </p>
    
    <ol>
    <li>
    车辆所属人身份证原件
    </li>
    <li>
    机动车交通事故责任强制保险单原件（交强险保单原件）
    </li>
    <li>
    机动车销售统一发票原件（车辆购买发票原件）
    </li>
    <li>
    国产车：机动车整车出厂合格证原件（国产车辆合格证原件）
    进口车：货物进口证明书原件（进口车辆海关关单原件）
    </li>
    </ol>
    
    <p>
      <b>关于用户隐私</b>
    </p>
    
    <p class="padding-5">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您的隐私对于51临牌而言至关重要，保护用户隐私是51临牌的一项基本政策，51临牌保证不对外公开或向第三方 提供用户的注册资料和任何与用户有关的信息。为确保您个人信息的安全，我们将公司的隐私和安全准则告知全体51临牌雇员，并将在公司内部严格执行隐私保护措施。您可以参考《51临牌网站使用协议》了解51临牌隐私政策详情。
    </p>
  
  </div>

@elseif($car_hand == 'second')

  <div class="alert alert-info">
    <h3 class="page-header">办理上海二手车临牌</h3>
    <h4>快递办理材料</h4>
    <p class="padding-5">
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请将下述材料准备妥善并快递至［51临牌］办公地址：上海市静安区延安西路433号金柏苑大厦2306室。
    您的资料将会得到［51临牌］最妥善的保管。
    </p>
    
    <p class="padding-5">
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我们的工作人员收到您递交的材料以后将以短信形式通知您材料已收到，并第一时间为您办理临牌，我们预计于1-2个工作日内通过顺丰速递将您的办理材料原件和车辆临时号牌一起交付给您，及时保证您的顺利出行。
    </p>
    
    <ol>
      <li>
        车辆所属人身份证原件
      </li>
      <li>
        车辆行驶证原件
      </li>
    </ol>
    
    <p>
      <b>关于用户隐私</b>
    </p>
    
    <p class="padding-5">
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您的隐私对于51临牌而言至关重要，保护用户隐私是51临牌的一项基本政策，51临牌保证不对外公开或向第三方提供用户的注册资料和任何与用户有关的信息。为确保您个人信息的安全，我们将公司的隐私和安全准则告知全体51临牌雇员，并将在公司内部严格执行隐私保护措施。您可以参考《51临牌网站使用协议》了解51临牌隐私政策详情。
    </p>
  </div>
</div>

@endif

@endsection

