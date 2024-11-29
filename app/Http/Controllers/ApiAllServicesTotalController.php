<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\App;
use App\Models\Card;
use App\Models\DataCommunication;
use App\Models\Ebank;
use App\Models\Ecard;
use App\Models\Game;
use App\Models\Program;
use App\Models\TransferMoneyFirm;

use App\Models\Service;

use Illuminate\Support\Facades\Http;
class ApiAllServicesTotalController extends Controller
{
    public function index()
    {
       $appRecords = App::count();
       $cardRecords = Card::count();
       $serviceRecords = Service::count();
       $dataCommunicationRecords = DataCommunication::count();
       $ebankRecords = Ebank::count();
       $ecardRecords = Ecard::count();
       $gameRecords = Game::count();
       $programRecords = Program::count();
       $transferMoneyFirmRecords = TransferMoneyFirm::count();
       return response()->json([
        'appRecords'=>$appRecords,
        'serviceRecords'=>$serviceRecords,
        'cardRecords'=>$cardRecords,
        'data-communicationRecords'=>$dataCommunicationRecords,
        'ebankRecords'=>$ebankRecords,
        'ecardRecords'=>$ecardRecords,
        'gameRecords'=>$gameRecords,
        'programRecords'=>$programRecords,
        'transfer-mone-firmRecords'=>$transferMoneyFirmRecords,
    ]);
    }


    function getServiceList()
    {
        // إعداد البيانات التي سترسل إلى API
        $data = [
            'action' => 'imeiservicelist', // العملية المطلوبة
            'username' => 'abdalkadr777352',      // اسم المستخدم
            'apiaccesskey' => 'AWK-TT6-AT0-ZN1-IVH-BX3-LXH-NCO',   // مفتاح الوصول
        ];
    
        // إرسال طلب POST إلى API
        $response = Http::asForm()->post('https://server.halabtech.com', $data);
    
        // التحقق من حالة الاستجابة
        if ($response->successful()) {
            // جلب البيانات إذا كانت الاستجابة ناجحة
            $services = $response->json();
            return $services;
        } else {
            // التعامل مع الأخطاء
            return [
                'error' => 'Failed to fetch services',
                'status' => $response->status(),
                'message' => $response->body(),
            ];
        }
    }
    

    /*<?php
$ch = curl_init("https://server.halabtech.com/api.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    echo 'Success: API Response Received';
}

curl_close($ch);
?>
*/



}
