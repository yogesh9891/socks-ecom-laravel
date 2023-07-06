<?php

namespace Modules\Membership\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Membership\Entities\Membership;
use Modules\Membership\Entities\UserMembership;
use Auth;
use StdClass;

class MembershipController extends Controller
{
    public function index()
    {

     
        // return view('membership::index');
        return view('public.membership.index', [
            'membership' => Membership::all(),
        ]);
    }




    public function checkout($id){
        return view('public.membership.checkout', [
            'membership' => Membership::find($id),
        ]);
    }


    public function purchase(Request $request,$id){


         $response = new StdClass;  
            
        if(!empty($request->transaction_id)){

            $m = Membership::find($id);
            if($m){

                $check = UserMembership::where('user_id',Auth::user()->id)->where('membership_id',$id)->first();

                if ($check) {
                    $response->status = false;
                    $response->message = 'You Already have  membership';     
                }else{


                    $data = new UserMembership;
                    $data->user_id = Auth::user()->id;
                    $data->membership_id = $id;
                    $data->save();
                    $response->status = true;
                    $response->message = 'Thanks for purchasing  membership';     
                }

            }else{
                    $response->status = false;
                    $response->message = 'Something Went wrong'; 

            }
        }else{
            $response->status = false;
            $response->message = 'Something Went wrong'; 
        }

         return response()->json($response);
    }

        public function faq()
        {
            // return view('membership::index');
            return view('public.faq.index');
        }



}
