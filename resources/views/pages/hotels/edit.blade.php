@extends('admin.layouts.app')
@section('content')
<h3 class="text-center my-4"> {{ trans('main_trans.hotels') }}</h3>
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header text-center" style="background: #fff; color: #333; border-radius: 10px 10px 0 0; border-bottom: 2px solid #ddd; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h3 style="font-weight: bold; letter-spacing: 1px;">{{ trans('Counters_trans.edit_hotel') }}</h3>
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

            <!-- نموذج التحديث -->
            <form action="{{ route('hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- استخدام PUT أو PATCH -->

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name_ar" class="form-label">{{ trans('Counters_trans.name_ar') }}</label>
                        <input type="text" name="name_ar" class="form-control" id="name_ar" value="{{ $hotel->name_ar }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="name_en" class="form-label">{{ trans('Counters_trans.name_en') }}</label>
                        <input type="text" name="name_en" class="form-control" id="name_en" value="{{ $hotel->name_en }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="possition_ar" class="form-label">{{ trans('Counters_trans.possition_ar') }}</label>
                        <input type="text" name="possition_ar" class="form-control" id="possition_ar" value="{{ $hotel->possition_ar }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="possition_en" class="form-label">{{ trans('Counters_trans.possition_en') }}</label>
                        <input type="text" name="possition_en" class="form-control" id="possition_en" value="{{ $hotel->possition_en }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="rate" class="form-label">{{ trans('Counters_trans.rate') }}</label>
                    <input type="number" name="rate" class="form-control" id="rate" value="{{ $hotel->rate }}">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">{{ trans('Counters_trans.price') }}</label>
                    <input type="number" name="price" class="form-control" id="price" value="{{ $hotel->price }}">
                </div>

                {{-- <div class="mb-3">
                    <label for="image">Images:</label>
                    <input type="file" name="image[]" multiple>
                    @if ($hotel->images)
                        <div class="mt-2">
                            @foreach ($hotel->images as $image)
                                <img src="{{ asset('hotel/' . $image) }}" alt="Hotel Image" class="img-thumbnail" style="width: 100px; height: auto;">
                            @endforeach
                        </div>
                    @endif
                </div> --}}

                <div class="div_design">
                    <label for="">Current Images:</label>
                    <div class="d-flex flex-wrap">
                        @foreach (json_decode($hotel->image) as $image)
                            <div class="m-2">
                                <img src="{{ asset('hotel/' . $image) }}" width="50" height="50" class="rounded">
                            </div>
                        @endforeach
                    </div>
                </div>

                <br>

                <div class="div_design">
                    <label for="">Change Images:</label>
                    <input type="file" name="image[]" multiple>
                    <small class="text-muted">You can upload multiple images.</small>
                </div>


                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="overview_ar" class="form-label">{{ trans('Counters_trans.overview_ar') }}</label>
                        <input type="text" name="overview_ar" class="form-control" id="overview_ar" value="{{ $hotel->overview_ar }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="overview_en" class="form-label">{{ trans('Counters_trans.overview_en') }}</label>
                        <input type="text" name="overview_en" class="form-control" id="overview_en" value="{{ $hotel->overview_en }}" required>
                    </div>
                </div>

                





                {{-- <div class="mb-3">
                    <label for="availableroom_image">availableroom_image:</label>
                    <input type="file" name="availableroom_image[]" multiple>
                    <small class="text-muted">Leave empty if you don't want to update images.</small>
                </div> --}}



                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="x_access" class="form-label">{{ trans('Counters_trans.x_access') }}</label>
                        <input type="text" name="x_access" class="form-control" id="x_access"
                               placeholder="{{ trans('Counters_trans.x_access') }}"
                               value="{{ old('x_access', $hotel->x_access) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="y_access" class="form-label">{{ trans('Counters_trans.y_access') }}</label>
                        <input type="text" name="y_access" class="form-control" id="y_access"
                               placeholder="{{ trans('Counters_trans.y_access') }}"
                               value="{{ old('y_access', $hotel->y_access) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="amenity_ids[]">{{ trans('Counters_trans.amenity') }}</label>
                    <select name="amenity_ids[]" class="form-control form-select" id="amenity-select" multiple>
                        @foreach ($amenities as $category)
                            <option value="{{ $category->id }}"
                                    {{ in_array($category->id, old('amenity_ids', $hotel->amenities->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ App::getLocale() === 'ar' ? $category->name_ar : $category->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <script>
                    $(document).ready(function() {
                        $('#amenity-select').select2({
                            placeholder: '{{ trans('Counters_trans.amenity') }}',
                            allowClear: true,
                            closeOnSelect: false
                        });
                    });
                </script>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="privacy_ar" class="form-label">{{ trans('Counters_trans.privacy_ar') }}</label>
                        <input type="text" name="privacy_ar" class="form-control" id="privacy_ar"
                               placeholder="{{ trans('Counters_trans.privacy_ar') }}"
                               value="{{ old('privacy_ar', $hotel->privacy_ar) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="privacy_en" class="form-label">{{ trans('Counters_trans.privacy_en') }}</label>
                        <input type="text" name="privacy_en" class="form-control" id="privacy_en"
                               placeholder="{{ trans('Counters_trans.privacy_en') }}"
                               value="{{ old('privacy_en', $hotel->privacy_en) }}" required>
                    </div>
                </div>



                <div class="d-flex justify-content-end">
                    <a href="{{ route('hotels.index') }}" class="btn btn-secondary me-2">{{ trans('Counters_trans.Close') }}</a>
                    <button type="submit" class="btn btn-success">{{ trans('Counters_trans.Update') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
