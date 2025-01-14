<?php

namespace App\Http\Controllers;

use App\Models\EcardSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiEcardSectionController extends Controller
{
    public function index()
    {
       $ecardSections=DB::table('ecard_sections')->select('*')->orderBy('id', 'desc')->paginate(500);
       foreach ($ecardSections as $app) {
         $app->image_url = asset('assets/images/ecardSections/' . $app->image);  // إنشاء رابط للصورة
        
        }
       return response()->json(['ecardSections'=> $ecardSections ]);
    }

    public function getEcards(string $section_id)
    {
       $section = EcardSection::find($section_id);
       $ecards = $section->ecards;
       foreach ($ecards as $app) {
         $app->image_url = asset('assets/images/ecards/' . $app->image);  // إنشاء رابط للصورة
         
        }
       return response()->json(['ecards'=> $ecards ]);
    }
}
