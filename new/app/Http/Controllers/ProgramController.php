<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Program;
use Illuminate\Support\Facades\DB;
use App\Utils\ProfitCalculationService;
class ProgramController extends Controller
{
    protected $profitService;
    public function __construct(ProfitCalculationService $profitService)
    {
        $this->profitService = $profitService;
    }
    public function index()
    { 
        $programs=DB::table('programs')->select('*')->orderBy('id', 'desc')->paginate(500);
        foreach ($programs as $service) {
            $service->price = $this->profitService->getPrice($service);    // إنشاء رابط 
        }
        return view('backend.program.programs.index', compact('programs'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        if($request->file('image')!="")
        {
            if ($file = $request->file('image')) {
                $name = 'program'.time().$file->getClientOriginalName();
                $file->move('assets/images/programs/', $name);
                $input['image'] = $name;
            }
        }
        else
        {
            $input['image']= "";
        }
        Program::create($input);
        return back()->with('message', 'تمت الاضافة بنجاح');
    }

    public function update(Request $request, string $id)
    {
        $program = Program::findOrFail($id);
        $input = $request->all();
        if($request->file('image')!="")
         {
            if ($file = $request->file('image')) {
                $name = 'program'.time().$file->getClientOriginalName();
                $file->move('assets/images/program/', $name);
                $input['image'] = $name;
            }
        }
        else
        {
            $input['image']= $program['image'];
        }
        $program->update($input);
       
        return back()->with('message', 'تم التعديل بنجاح');
    }
    public function changeStatus(string $id)
    {

        $myservice= Program::findOrFail($id);
       
        if($myservice->status)
         { $myservice->status=0;
           $myservice->save();
            return back()->with('message', 'تم الغاء تفعيل الخدمة  بنجاح');
         }
        else
         { $myservice->status=1;
            $myservice->save();
          return back()->with('message', 'تم تفعيل الخدمة  بنجاح');
         }
    }
    public function destroy(string $id)
    {
        $program= Program::findOrFail($id);
        $program->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }
}
