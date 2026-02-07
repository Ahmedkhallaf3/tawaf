<?php

namespace App\Http\Controllers\Apis;

use App\Models\promocode;
use Illuminate\Http\Request;
use App\Http\Trait\GeneralTrait;
use App\Http\Controllers\Controller;

class PromocodeController extends Controller
{
use GeneralTrait;
    public function index()
    {
        $promocodes = promocode::all();
        return $this->returnData('promocodes',$promocodes);

    }

    public function store(Request $request)
    {
        $request->validate([
            'promocode' => 'required',
            'discount' => 'required',
        ],[
            'promocode.required' => 'Promocode is required',
            'discount.required' => 'Discount is required',
        ]);
        try {
        $promocode = new promocode();
        $promocode->promocode = $request->promocode;
        $promocode->discount = $request->discount;
        $promocode->save();
            return $this->returnData('promocode',$promocode);
        } catch (\Exception $e) {
            return $this->returnError('E001','error');}
       }

       public function update(Request $request)
    {
        $request->validate([
            'promocode' => 'required',
            'discount' => 'required',
        ],[
            'promocode.required' => 'Promocode is required',
            'discount.required' => 'Discount is required',
        ]);
        try {
            $promocode = promocode::findOrFail($request->id);
            $promocode->promocode = $request->promocode;
            $promocode->discount = $request->discount;
            $promocode->save();
            return $this->returnData('promocode', $promocode);
            } catch (\Exception $e) {
                return $this->returnError('E001','error');
                }

}

public function destroy($id)
{
    $promocode = promocode::find($id);
    $promocode->delete();
    if(!$promocode){
        return $this->returnError('E001','data not found');
    }else{
        return $this->returnSuccessMessage('data deleted');
    }

}

}
