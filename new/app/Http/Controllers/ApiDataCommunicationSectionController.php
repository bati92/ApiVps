<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\DataCommunicationSection;
class ApiDataCommunicationSectionController extends Controller
{
    public function index()
    {
        $dataSections=DB::table('data_communication_sections')->select('*')->orderBy('id', 'desc')->paginate(500);
       foreach ($dataSections as $data) {
         $data->image_url = asset('assets/images/dataCommunicationSections/' . $data->image);  // إنشاء رابط للصورة
         
        }
       return response()->json(['dataSections'=> $dataSections]);
    }

    public function getData(string $section_id)
    {
       $section = DataCommunicationSection::find($section_id);
       $dataCommunication = $section->dataCommunications;
       foreach ($dataCommunication as $app) {
         $app->image_url = asset('assets/images/data/' . $app->image);  // إنشاء رابط للصورة
         $app->save();
        }
       return response()->json(['data-communications'=> $dataCommunication ]);
    }

}
