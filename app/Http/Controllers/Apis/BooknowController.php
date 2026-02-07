<?php

namespace App\Http\Controllers\Apis;

use App\Models\booknow;
use App\Models\avilableroom;
use Illuminate\Http\Request;
use App\Http\Trait\GeneralTrait;
use App\Http\Controllers\Controller;

class BooknowController extends Controller
{

use GeneralTrait;
    public function index()
    {
        $booknows = booknow::all()->map(function ($booknow) {
            // فك تشفير الحقل age_child إذا كان يحتوي على بيانات
            $booknow->age_child = $booknow->age_child ? json_decode($booknow->age_child, true) : [];
            return $booknow;
        });

        return $this->returnData('booknows', $booknows);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'phonenumber' => 'required',
            'specialrequest'=>'required',
            'check_in_ar' => 'required',
            'check_in_en' => 'required',
            'check_out_ar' => 'required',
            'check_out_en' => 'required',
            'room_id' => 'required',
            'numberofroom' => 'required',

        ],[
            'fullname.required' => 'Full Name is required',
            'phonenumber.required' => 'Phone Number is required',
            'specialrequest.required' => 'Special Request is required',
            'check_in_ar.required' => 'English Check In Date is required',
            'check_in_en.required' => 'Arabic Check In Date is required',
            'check_out_ar.required' => 'English Check Out Date is required',
            'check_out_en.required' => 'Arabic Check Out Date is required',
            'room_id.required' => 'Room is required',
            'numberofroom.required' => 'Number of Room is required',
        ]);
        try{
        $booknow = new booknow();
        $booknow->fullname = $request->fullname;
        $booknow->phonenumber = $request->phonenumber;
        $booknow->specialrequest = $request->specialrequest;
        $booknow->check_in_ar = $request->check_in_ar;
        $booknow->check_in_en = $request->check_in_en;
        $booknow->check_out_ar = $request->check_out_ar;
        $booknow->check_out_en = $request->check_out_en;
        $booknow->numberofadult=$request->numberofadult;
        $booknow->numberofchild=$request->numberofchild;
        $booknow->age_child = json_encode($request->age_child);
        $booknow->totalprice = $request->totalprice;

        $booknow->room_id = $request->room_id;
        $booknow->numberofroom = $request->numberofroom;
        $booknow->save();
        return $this->returnData('booknow', $booknow);
        }catch(\Exception $e){
            return $this->returnError('E001','error');
        }
    }

    public function destroy($id)
    {
        $booknow = booknow::find($id);
        $booknow->delete();
        if(!$booknow){
            return $this->returnError('E001','data not found');
        }else{
            return $this->returnSuccessMessage('data deleted');
        }    }
}
