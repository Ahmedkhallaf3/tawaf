<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Models\hotelinmadina;
use App\Http\Trait\GeneralTrait;
use App\Http\Controllers\Controller;

class HotelinmadinaController extends Controller
{
    use GeneralTrait;
 public function index()
    {
        $hotelinmadinas = hotelinmadina::with('hotels')->get(); // تحميل العلاقة
        //$hotels=hotel::all();
     $hotelinmadinas->transform(function ($hotelinmadina) {
        $hotelinmadina->hotels->transform(function ($hotel) {
            // إزالة pivot
            $hotel->makeHidden('pivot');

            $images = json_decode($hotel->image, true);
            $baseUrl = asset('hotel');
            $hotel->image = $images ? array_map(fn($image) => $baseUrl . '/' . $image, $images) : [];
         
            return $hotel;
        });

        return $hotelinmadina;
    });
        return $this->returnData('hotelinmadinas', $hotelinmadinas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'hotel_ids' => 'required|array',
            'hotel_ids.*' => 'exists:hotels,id',
            ],[
            'title_ar.required' => 'Title Arabic is required',
            'title_en.required' => 'Title English is required',
            'description_ar.required' => 'Description Arabic is required',
            'description_en.required' => 'Description English is required',
           // 'hotel_id.required' => 'Hotel is required',

        ]);
        try{


        $hotelinmadina = hotelinmadina::create(array_merge(
            $request->only([
                'title_ar','title_en','description_ar','description_en',
            ])

        ));

        // Sync amenities
        $hotelinmadina->hotels()->sync($request->hotel_ids);

        $hotelinmadina->save();
        return $this->returnData('hotelinmadina', $hotelinmadina);
        }catch(\Exception $e){
            return $this->returnError('E001','error');
        }
    }

    public function update(Request $request,)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'hotel_ids' => 'required|array',
            'hotel_ids.*' => 'exists:hotels,id',
            ],[
            'title_ar.required' => 'Title Arabic is required',
            'title_en.required' => 'Title English is required',
            'description_ar.required' => 'Description Arabic is required',
            'description_en.required' => 'Description English is required',
            'hotel_ids.required' => 'Hotel is required',
        ]);
        try{
        $hotelinmadina = hotelinmadina::find($request->id);
        $hotelinmadina->update(array_merge(
            $request->only([
                'title_ar','title_en','description_ar','description_en'
            ]),

        ));
        //$hotelinhome->amenities()->sync($request->amenity_ids);
        $hotelinmadina->hotels()->sync($request->input('hotel_ids', [])); // تحديث العلاقة

        return $this->returnData('hotelinmadina', $hotelinmadina);
        }catch(\Exception $e){
            return $this->returnError('E001','error');
        }
    }

    public function destroy($id)
    {
        $hotelinmadina = hotelinmadina::find($id);
        $hotelinmadina->delete();
        if(!$hotelinmadina){
            return $this->returnError('E001','data not found');
        }else{
            return $this->returnSuccessMessage('data deleted');
        }
    }
}
