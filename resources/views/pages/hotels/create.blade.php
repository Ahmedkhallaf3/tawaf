@extends('admin.layouts.app')
@section('content')
<h3 class="text-center my-4"> {{ trans('main_trans.hotels') }}</h3>
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header text-center" style="background: #fff; color: #333; border-radius: 10px 10px 0 0; border-bottom: 2px solid #ddd; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h3 style="font-weight: bold; letter-spacing: 1px;">{{ trans('Counters_trans.add_Grade') }}</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('hotels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name_ar" class="form-label">{{ trans('Counters_trans.name_ar') }}</label>
                        <input type="text" name="name_ar" class="form-control" id="name_ar" placeholder="{{ trans('Counters_trans.name_ar') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="name_en" class="form-label">{{ trans('Counters_trans.name_en') }}</label>
                        <input type="text" name="name_en" class="form-control" id="name_en" placeholder="{{ trans('Counters_trans.name_en') }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="possition_ar" class="form-label">{{ trans('Counters_trans.possition_ar') }}</label>
                        <input type="text" name="possition_ar" class="form-control" id="possition_ar" placeholder="{{ trans('Counters_trans.possition_ar') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="possition_en" class="form-label">{{ trans('Counters_trans.possition_en') }}</label>
                        <input type="text" name="possition_en" class="form-control" id="possition_en" placeholder="{{ trans('Counters_trans.possition_en') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="rate" class="form-label">{{ trans('Counters_trans.rate') }}</label>
                    <input type="number" name="rate" class="form-control" id="rate" placeholder="{{ trans('Counters_trans.rate') }}">
                </div>




                {{-- <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="price" class="form-label">{{ trans('Counters_trans.Pricestartssfrom') }}</label>
                    <input type="number" name="price" class="form-control" id="price" placeholder="{{ trans('Counters_trans.Pricestartsfrom') }}">
                </div>
                    <div class="col-md-6">
                        <label for="discount_price" class="form-label">{{ trans('Counters_trans.discount_price') }}</label>
                        <input type="number" name="discount_price" class="form-control" id="discount_price" placeholder="{{ trans('Counters_trans.Price_after_discount_for_stocks') }}" >
                    </div>
                </div> --}}





                <div class="mb-3">
                    <label for="image">Images:</label>
                    <input type="file" name="image[]" multiple required>
                  </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="overview_ar" class="form-label">{{ trans('Counters_trans.overview_ar') }}</label>
                        <input type="text" name="overview_ar" class="form-control" id="overview_ar" placeholder="{{ trans('Counters_trans.overview_ar') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="overview_en" class="form-label">{{ trans('Counters_trans.overview_en') }}</label>
                        <input type="text" name="overview_en" class="form-control" id="overview_en" placeholder="{{ trans('Counters_trans.overview_en') }}" required>
                    </div>
                </div>






                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="x_access" class="form-label">{{ trans('Counters_trans.x_access') }}</label>
                        <input type="number" name="x_access" class="form-control" id="x_access" placeholder="{{ trans('Counters_trans.x_access') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="y_access" class="form-label">{{ trans('Counters_trans.y_access') }}</label>
                        <input type="number" name="y_access" class="form-control" id="y_access" placeholder="{{ trans('Counters_trans.y_access') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="amenity_ids[]">{{ trans('Counters_trans.amenity') }}</label>
                    <select name="amenity_ids[]" class="form-control form-select" id="amenity-select" multiple>
                        @foreach ($amenities as $category)
                            <option value="{{ $category->id }}">
                                {{ App::getLocale() === 'ar' ? $category->name_ar : $category->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <script>
                    $(document).ready(function() {
                        // تهيئة Select2
                        $('#amenity-select').select2({
                            placeholder: '{{ trans('Counters_trans.amenity') }}',
                            allowClear: true,
                            closeOnSelect: false // إبقاء القائمة مفتوحة بعد الاختيار
                        });

                        // منع إغلاق القائمة يدويًا
                        $('#amenity-select').on('select2:select', function(e) {
                            let selectedOption = e.params.data.id; // العنصر الذي تم اختياره
                            let $option = $(this).find(`option[value="${selectedOption}"]`);
                            $option.prop('disabled', true); // تعطيل العنصر الذي تم اختياره
                            $(this).select2('open'); // إعادة فتح القائمة
                        });

                        // تمكين العنصر عند إزالته
                        $('#amenity-select').on('select2:unselect', function(e) {
                            let unselectedOption = e.params.data.id; // العنصر الذي تمت إزالته
                            let $option = $(this).find(`option[value="${unselectedOption}"]`);
                            $option.prop('disabled', false); // إعادة تمكين العنصر
                            $(this).select2('open'); // إعادة فتح القائمة
                        });
                    });
                </script>

<!-- الفترات الزمنية والأسعار -->
<h4>Pricing by Periods</h4>
<div id="price-container">
    <div class="price-group">
        <label>Start Date:</label>
        <input type="date" name="prices[0][start_date]" class="form-control" required>
        <label>End Date:</label>
        <input type="date" name="prices[0][end_date]" class="form-control" required>
        <label>Price:</label>
        <input type="number" name="prices[0][price]" class="form-control" min="0" required>
        <label>Discount (Optional):</label>
        <input type="number" name="prices[0][discount]" class="form-control" min="0" placeholder="Leave empty if no discount">
    </div>
</div>
<button type="button" class="btn btn-secondary mt-2" onclick="addPrice()">Add Another Period</button>

<!-- إرسال -->
<div class="form-group mt-4">
    <button type="submit" class="btn btn-primary">Add Hotel</button>
</div>
</form>
</div>

<script>
function addPrice() {
const container = document.getElementById('price-container');
const index = container.children.length;
const group = document.createElement('div');
group.className = 'price-group mt-3';
group.innerHTML = `
<label>Start Date:</label>
<input type="date" name="prices[${index}][start_date]" class="form-control" required>
<label>End Date:</label>
<input type="date" name="prices[${index}][end_date]" class="form-control" required>
<label>Price:</label>
<input type="number" name="prices[${index}][price]" class="form-control" min="0" required>
<label>Discount (Optional):</label>
<input type="number" name="prices[${index}][discount]" class="form-control" min="0" placeholder="Leave empty if no discount">
`;
container.appendChild(group);
}
</script>



                <div class="d-flex justify-content-end">
                    <a href="{{ route('hotels.index') }}" class="btn btn-secondary me-2">{{ trans('Counters_trans.Close') }}</a>
                    <button type="submit" class="btn btn-success">{{ trans('Counters_trans.Submit') }}</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
