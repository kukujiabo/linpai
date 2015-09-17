<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Good;
use App\Models\OrderAllInfo;
use Illuminate\Http\Request;
use App\Models\ReceiverInfo;
use App\Models\DeliverInfo;
use App\Models\OrderBoun;
use Validator;
use App\User;
use Session;

class OrderManageController extends Controller {

  public function __construct () 
  {

    $this->middleware('admin_auth');

  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

  public function getIndex (Request $request) 
  {

    $page = $request->input('page');

    $order_code = $request->input('order_code');

    $receiver = $request->input('receiver');

    $mobile = $request->input('mobile');

    $status = $request->input('status');

    $offset = 20;

    $pages = intval(ceil(OrderAllInfo::count()/$offset));

    $page = empty($page) ? 1 : $page > $pages ? $pages : $pages < 1 ? 1 : $page;

    $query = OrderAllInfo::where('order_code', '>', '1');

    if (!empty($order_code)) {

      $query->where('order_code', '=', $order_code);

    }

    if (!empty($receiver)) {

      $query->where('receiver', '=', $receiver);

    }

    if (!empty($mobile)) {

      $query->where('mobile', '=', $mobile);

    }

    if (is_numeric($status) && $status >= 0) {

      $query->where('status', '=', $status);

    }

    $orders = $query->skip(($page - 1) * $offset)

        ->take($offset)

        ->get();

    $data = [
    
      'pageName' => '订单管理',

      'orders' => $orders,

      'pages' => $pages,

      'current_page' => $page,

      'order_code' => empty($order_code) ? '' : $order_code,

      'receiver' => empty($receiver) ? '' : $receiver,

      'mobile' => empty($mobile) ? '' : $mobile,

      'status' => empty($status) ? '' : $status

    ];

    return view('/admin/order_board', $data);

  }

  public function getOrderlargeinfo (Request $request)
  {
    $code = $request->input('order_code');

    $uid = $request->input('user');

    $user = User::find($uid);

    if (empty($user->id)) {

      return $this->failResponse('user_not_found');

    }

    $order = OrderAllInfo::where('order_code', '=', $code)->first();

    if (empty($order->oid)) {

      return $this->failResponse('order_not_found');

    }

    $data = [
    
      'user' => $user,

      'order' => $order
    
    ];

    if ($order->status == 1 || $order->status == 2) {

      $deliver_info = DeliverInfo::where('order_code', '=', $order->order_code)

        ->first();

      $data['deliver'] = $deliver_info;

    }

    $html = view('admin/order_panel', $data).'';

    return $this->successResponse('res', $html);

  }

  public function postDeliver (Request $request) 
  {

    $validator = Validator::make($request->input(), [

      'plate_number' => 'required',
    
      'company' => 'required',

      'deliver_code' => 'required',

    ]);
     
    if ($validator->fails()) {

      $failed = $validator->failed();

      return $this->failResponse($failed);

    } 

    $plate_number = $request->input('plate_number');
  
    $company = $request->input('company');

    $deliver_code = $request->input('deliver_code');

    $order_code = $request->input('order_code');

    $operator_id = Session::get('admin')->id;

    $deliver = DeliverInfo::where('order_code', '=', $order_code)

      ->first();

    if (empty($deliver->id)) {

      $result = DeliverInfo::create([
      
        'company' => $company,

        'code' => $deliver_code,

        'order_code' => $order_code,

        'operator_id' => $operator_id,

        'active' => 1
      
      ]);    

      if (!empty($result->id)) {

        $order = Order::where('code', '=', $order_code)->first();

        if (!empty($order->id)) {

          $order->status = 2;

          $order->plate_number = $plate_number;

          $order->save();

          return $this->successResponse('res', $result);

        } else {

          return $this->failResponse('order_not_found');

        }

      } else {

        return $this->failResponse('failed');

      }

    } else {

      $deliver->code = $deliver_code;

      $deliver->company = $company;

      $deliver->save();

      return $this->successResponse('res', $deliver);

    }

  }

  public function getBouns (Request $request)
  {
    $order_code = $request->input('order_code');

    $uid = $request->input('uid');

    $order = Order::where('code', '=', $order_code)->first();

    $bouns = OrderBoun::where('uid', '=', $uid)

      ->where('oid', '=', $order->id)

      ->get();

    if (count($bouns)) {

      $str = "<div class=\"boun_line\">";

      foreach ($bouns as $boun) {

        $str .= $boun->bcode . '&nbsp;&nbsp;';

      }

      $str .= '</div>';

      return $this->successResponse('res', $str);

    } else {

      $str = "<div class=\"boun_line\">没有使用优惠券</div>";

      return $this->successResponse('res', $str);

    }
    
  }

  public function getOrderpdf (Request $request)
  {
    $order_code = $request->order_code;

    if (empty($order_code)) {
    

    } 

    $order = OrderAllInfo::where('order_code', '=', $order_code)

      ->first();

    require_once('tcpdf/tcpdf.php');

    $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->SetCreator('51linpai');

    $pdf->SetAuthor(Session::get('admin')->admin_name);

    $pdf->SetKeywords('TCPFF,PHP,PDF');

    $pdf->SetHeaderData('logo-linpai-sm.jpg', 50, '', '', array(255, 255, 255), array(255,255,255));

    $pdf->setPrintFooter(false);

    //$pdf->setHeaderFont(Array('stsongstdlight', '', '10')); 
     
    $pdf->SetDefaultMonospacedFont('courier'); 
    
    // 设置间距 
    $pdf->SetMargins(15, 45, 15); 
    $pdf->SetHeaderMargin(20); 
    $pdf->SetFooterMargin(5); 
    
    // 设置分页 
    $pdf->SetAutoPageBreak(TRUE, 30); 
     
     // set image scale factor 
    $pdf->setImageScale(1.25); 
     
     // set default font subsetting mode 
    $pdf->setFontSubsetting(true); 
     
     //设置字体 
    $pdf->SetFont('stsongstdlight', 1, 12); 
     
    $pdf->AddPage(); 

    $user = User::find($order->uid);

    $html = <<<EOD

      <div style="font-family:'微软雅黑'">
      <h1>感谢您选择［51临牌］的服务</h1>
      <p>订单号：{$order->order_code}</p>
      <p>下单时间：{$order->created_at}</p>
      <br>
      <p>用户名：{$user->name}</p>
      <p>收件人：{$order->receiver}</p>
      <p>手机号码：{$order->mobile}</p>
      <p>收货地址：{$order->province}{$order->city}{$order->address}</p>
      <br>
      <p>订单详情：</p>
      <table style="text-align:center">
        <thead>
          <tr>
            <th>商品名称</th>
            <th>单价（元）</th>
            <th>数量</th>
            <th>优惠码减免</th>
            <th>实付款</th>
            <th>临牌号</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
          </tr>
          <tr>
            <td>{$order->good_name}</td>
            <td>{$order->g_single_price}</td>
            <td>{$order->num}</td>
            <td>{$order->cut_fee}</td>
            <td>{$order->final_price}</td>
            <td style="">{$order->plate_number}</td>
          </tr>
        </tbody>
      </table>
      <br>
      <p>如果您有任何问题，欢迎给我们发送邮件 service@51linpai.com 或与周一至周五</p>
      <p>的 10:00 －18:00 给我们来电 4006932724</p>
      </div>
      <p>诚挚的问候</p>
      <p>51临牌团队</p>
      <p width="100%" style="text-align:center"><h2>www.51linpai.com</h2></p>
EOD;

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


    $pdf->Output('t.pdf', 'I');

  }

}
