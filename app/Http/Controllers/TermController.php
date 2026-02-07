<?php

namespace App\Http\Controllers;

use App\Models\term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terms = term::paginate(5);
        return view('pages.terms.terms', compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return redirect()->route('terms.index')->with('success', 'Term Created successfully');
        }catch(\Exception $e){
            return redirect()->route('terms.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(term $term)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

            return redirect()->route('terms.index')->with('success', 'Term Updated successfully');
            }catch(\Exception $e){
                return redirect()->route('terms.index')->with('error', $e->getMessage());
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $term = term::find($id);
        $term->delete();
        return redirect()->back()->with('success', 'Term Deleted Successfully');
    }
}
