<?php

namespace App\Http\Controllers\Apis;

use App\Models\term;
use Illuminate\Http\Request;
use App\Http\Trait\GeneralTrait;
use App\Http\Controllers\Controller;

class TermController extends Controller
{
use GeneralTrait;

    public function index()
    {
        $terms = term::all();
        return $this->returnData('terms', $terms);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title1_ar' => 'required',
            'title1_en' => 'required',
            'title2_ar' => 'nullable',
            'title2_en' => 'nullable',
            'title3_ar' => 'nullable',
            'title3_en' => 'nullable',


            'description1_ar' => 'required',
            'description1_en' => 'required',
            'description2_ar' => 'nullable',
            'description2_en' => 'nullable',
            'description3_ar' => 'nullable',
            'description3_en' => 'nullable',

            'phonenumber' => 'required',
            'email' => 'required',
        ],[
            'title1_ar.required' => 'Title 1 Arabic is required',
            'title1_en.required' => 'Title 1 English is required',
            'description1_ar.required' => 'Description 1 Arabic is required',
            'description1_en.required' => 'Description 1 English is required',
            'phonenumber.required' => 'Phone Number is required',
            'email.required' => 'Email is required',
        ]);
        try{
        $term=new term();
        $term->title1_ar=$request->title1_ar;
        $term->title1_en=$request->title1_en;
        $term->title2_ar=$request->title2_ar;
        $term->title2_en=$request->title2_en;
        $term->title3_ar=$request->title3_ar;
        $term->title3_en=$request->title3_en;
        $term->description1_ar=$request->description1_ar;
        $term->description1_en=$request->description1_en;
        $term->description2_ar=$request->description2_ar;
        $term->description2_en=$request->description2_en;
        $term->description3_ar=$request->description3_ar;
        $term->description3_en=$request->description3_en;
        $term->phonenumber=$request->phonenumber;
        $term->email=$request->email;
        $term->save();
        return $this->returnData('term', $term);
        }catch(\Exception $ex){
            return $this->returnError('E001','error');

        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'title1_ar' => 'required',
            'title1_en' => 'required',
            'title2_ar' => 'nullable',
            'title2_en' => 'nullable',
            'title3_ar' => 'nullable',
            'title3_en' => 'nullable',


            'description1_ar' => 'required',
            'description1_en' => 'required',
            'description2_ar' => 'nullable',
            'description2_en' => 'nullable',
            'description3_ar' => 'nullable',
            'description3_en' => 'nullable',

            'phonenumber' => 'required',
            'email' => 'required',
        ],[
            'title1_ar.required' => 'Title 1 Arabic is required',
            'title1_en.required' => 'Title 1 English is required',
            'description1_ar.required' => 'Description 1 Arabic is required',
            'description1_en.required' => 'Description 1 English is required',
            'phonenumber.required' => 'Phone Number is required',
            'email.required' => 'Email is required',
        ]);
        try{

            $term = term::findOrFail($request->id);
            $term->title1_ar=$request->title1_ar;
            $term->title1_en=$request->title1_en;
            $term->title2_ar=$request->title2_ar;
            $term->title2_en=$request->title2_en;
            $term->title3_ar=$request->title3_ar;
            $term->title3_en=$request->title3_en;

            $term->description1_ar=$request->description1_ar;
            $term->description1_en=$request->description1_en;
            $term->description2_ar=$request->description2_ar;
            $term->description2_en=$request->description2_en;
            $term->description3_ar=$request->description3_ar;
            $term->description3_en=$request->description3_en;

            $term->phonenumber=$request->phonenumber;
            $term->email=$request->email;
            $term->save();
            return $this->returnData('term', $term);

            }catch(\Exception $e){
                return $this->returnError('E001','error');

            }
    }

    public function destroy($id)
    {
        $term = term::find($id);
        $term->delete();
        if(!$term){
            return $this->returnError('E001','data not found');
        }else{
            return $this->returnSuccessMessage('data deleted');
        }     }
}
