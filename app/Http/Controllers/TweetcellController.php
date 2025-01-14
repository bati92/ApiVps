<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TweetcellSection;
use App\Models\Tweetcell;
use Illuminate\Support\Facades\DB;
class TweetcellController extends Controller
{
    
   /* public function index($type)
    { 
        $games=DB::table('games')->select('*')->orderBy('id', 'desc')->paginate(500);
        
        $gameSections=DB::table('game_sections')->select('*')->orderBy('id', 'desc')->paginate(500);
        foreach ($games as $service) {
            $service->price = $this->profitService->getPrice($service);    // إنشاء رابط 
        }
        return view('backend.game.games.index', compact('games','gameSections'));
    }*/

 /*   public function store(Request $request)
    {
        $input = $request->all();
       
         if($request->file('image')!="")
         {
            if ($file = $request->file('image')) {
                $name = 'game'.time().$file->getClientOriginalName();
                $file->move('assets/images/games/', $name);
                $input['image'] = $name;
            }
        }
        else
        {
            $input['image']= "";
        }
        Game::create($input);
        return back()->with('message', 'تمت الاضافة بنجاح');
    }
*/
    public function update(Request $request, string $id)
    {
        $s = Tweetcell::findOrFail($id);
        $input = $request->all();
        if($request->file('image')!="")
        {
           if ($file = $request->file('image')) {
               $name = 'tweet'.time().$file->getClientOriginalName();
               $file->move('assets/images/tweetcellSections/', $name);
               $input['image'] = $name;
            }
        }
        else
        {
            $input['image']= $s['image'];
        }
        $s->update( $input);
       
        return back()->with('message', 'تم التعديل بنجاح');
    }

    public function showGames($id)
    {
        $services=DB::table('Tweetcells')->select('*')->where('section_id',$id)->orderBy('id', 'desc')->paginate(500);
   
        $sections=DB::table('tweetcell_sections')->select('*')->orderBy('id', 'desc')->paginate(500);
        return view('backend.tweetcell.tweetcells.index',compact('services','sections'));
    }
    public function changeStatus(string $id)
    {

        $myservice= Tweetcell::findOrFail($id);
       
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
        $game= Tweetcell::findOrFail($id);
        $game->delete();
        return back()->with('message', 'تم الحذف  بنجاح');
    }

}
