<?php namespace app\http\controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Good;
use App\Models\Boun;
use App\Models\OrderAllInfo;
use Illuminate\Http\Request;
use App\Models\ReceiverInfo;
use App\Models\DeliverInfo;
use App\Models\OrderBoun;
use App\Events\TriggerSms;
use App\Events\TriggerEmail;
use App\Models\DownloadRecord;
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

    $user = $request->input('user');

    $offset = 20;

    $pages = intval(ceil(OrderAllInfo::count()/$offset));

    $page = empty($page) ? 1 : $page > $pages ? $pages : $pages < 1 ? 1 : $page;

    $query = OrderAllInfo::where('order_code', '>', '1');

    if (!empty($user)) {

      $query->where('uid', '=', $user);

    }

    if (!empty($order_code)) {

      $query->where('order_code', 'like', '%' . $order_code . '%');

    }

    if (!empty($receiver)) {

      $query->where('receiver', 'like', '%' . $receiver . '%');

    }

    if (!empty($mobile)) {

      $query->where('order_owner_mobile', 'like', '%' . $mobile . '%');

    }

    if (is_numeric($status) && $status >= 0) {

      $query->where('status', '=', $status);

    }

    $orders = $query->skip(($page - 1) * $offset)

        ->take($offset)

        ->orderBy('created_at', 'desc')

        ->get();

    $data = [
    
      'pageName' => '订单管理',

      'orders' => $orders,

      'pages' => $pages,

      'current_page' => $page,

      'order_code' => empty($order_code) ? '' : $order_code,

      'receiver' => empty($receiver) ? '' : $receiver,

      'mobile' => empty($mobile) ? '' : $mobile,

      'status' => empty($status) ? '-1' : $status

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

    if ($order->status == 2) {

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

    $order = Order::where('code', '=', $order_code)->first();

    /*
     * 如果未创建
     */
    if (empty($deliver->id)) {

      $result = DeliverInfo::create([
      
        'company' => $company,

        'code' => $deliver_code,

        'order_code' => $order_code,

        'operator_id' => $operator_id,

        'active' => 1
      
      ]);    

      if (!empty($result->id)) {

        if (!empty($order->id)) {

          $order->status = 2;

          $order->plate_number = $plate_number;

          $order->save();

          $user = User::find($order->uid);

          $boun = Boun::where('uid', '=', $user->id)->where('type', '=', 0)->where('active', '=', 1)->first();

          $post_data = [
            
            'order_code' => $order->code,

            'deliver_code' => $result->code,

            'company' => $result->company,

            'recommend' => !empty($boun->code) ? $boun->code : '您还没有优惠码',

            'user' => $user->name,

            'url' => "www.sf-express.com"
          
          ];

          $smsRes = event(new TriggerSms($user->mobile, 'deliver', $post_data));

          $mailRes = event(new TriggerEmail($user->email, 'deliver', $post_data));

          return $this->successResponse('res', ['deliver' => $result, 'order' => $order, 'sms' => $smsRes, 'mailRes' => $mailRes]);

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

      $order->plate_number = $plate_number;

      $order->save();

      return $this->successResponse('res', [ 'deliver' => $deliver, 'order' => $order ]);

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
    
      return 'empty_ordercode';

    } 

    $order = OrderAllInfo::where('order_code', '=', $order_code)

      ->first();
    
    $path = storage_path() . '/app/pdf/';

    $pdf = $order->order_code . '.pdf';

    if (!is_dir($path)) {

      mkdir($path, 0777, true);

    }

    if (!file_exists($pdf)) {

      $url = "http://www.51linpai.com:8000/download/orderpdf?oid=" . $order->order_code;

      $command = "/tools/wkhtmltopdf {$url}  {$path}{$pdf}";

      $out = array();

      $status = 0;

      exec($command, $out, $status); 

      var_dump($out);

      var_dump($status);

      DownloadRecord::create([

        'code' => $url,
      
        'type' => 'pdf',

        'output' => $out,

        'status' => $status,
      
        'key' => $order->order_code
      
      ]);

    }

    return response()->download($path . $pdf);
    
  }

}
