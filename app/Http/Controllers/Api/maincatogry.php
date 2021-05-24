<?php

namespace App\Http\Controllers\Api;

use App\traits\Generaltrait;
use App\Http\Controllers\Controller;
use App\Models\models\Catagory;
use Illuminate\Http\Request;

class maincatogry extends Controller
{
    use Generaltrait;
    public function  index(){
        $cat=Catagory::select('id','name_' . app() -> getLocale()) ->get();
       // $cat=Catagory::selection() ->get();
        return response() -> json($cat);
    }
    public function  getcatogryById(request $request){
    //$onecat=Catagory::selection()->find($request -> id);
        $onecat=Catagory::select('id','name_' . app() -> getLocale()) ->find ($request -> id);
        if(!$onecat) {
            return $this->ReturnError('404', 'هذا القسم لم يعد موجود');
        }
            return $this->returndata('mycatogry', $onecat, 'تمت العمليه بنجاح',);
        }
        public function changestatus(request $request){
            Catagory::where("id",$request -> id ) -> update(['active' =>$request -> Active]);
            return $this ->returnsuccesstatus('5000','تم التحديث بنجاح') ;

            }
   // return response() -> json($onecat);
}


