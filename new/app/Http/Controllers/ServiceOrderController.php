<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ServiceOrder;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Utils\ProfitCalculationService;
class ServiceOrderController extends Controller
{ protected $profitService;
    public function __construct(ProfitCalculationService $profitService)
    {
        $this->profitService = $profitService;
    }
      public function index()
    {
    $currentUser = auth()->user();

    // جلب كافة طلبات المستخدمين الذين لهم نفس الـ agent_id الخاص بالمستخدم المسجل
    $serviceOrders = DB::table('service_orders')
        ->join('users', 'service_orders.user_id', '=', 'users.id')
        ->join('services', 'service_orders.app_id', '=', 'services.id')
        ->where('users.agent_id', '=', $currentUser->id) // إضافة الشرط هنا
        ->select('service_orders.*', 'users.name as user_name', 'services.name as service_name')
        ->get();
        
        return view('backend.service.serviceOrders.index', compact('serviceOrders'));
}
public function reject( $id)
{
    $order= ServiceOrder::findOrFail($id);
    $order->status="مرفوض";
    $order->save();
    return back()->with('message', 'تمت العملية  بنجاح');
}
public function accept( $id)
{
    $order= ServiceOrder::findOrFail($id);
    $order->status="مقبول";
    $order->save();
    $this->profitService->calculateProfit($order, Service::class,$order->service_id);

    return back()->with('message', 'تمت العملية  بنجاح');
}
}
