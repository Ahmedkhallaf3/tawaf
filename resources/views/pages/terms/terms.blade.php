@extends('admin.layouts.app')


@section('content')

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="text-center my-4"> {{ trans('main_trans.term') }}</h3>
                <div class="text-right mb-3">
                    @can('create apartments')
                    <a href="{{ route('terms.create') }}" class="btn-bid-now" style="color:white; cursor:pointer">
                        <i class="fas fa-plus-circle"></i> {{ trans('web.add') }}
                    </a>
                    @endcan
                </div>

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





            <button type="button" class=" button x-small  " data-toggle="modal" data-target="#exampleModal">
                {{ trans('Counters_trans.add_Grade') }}
            </button>




                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="data-table">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>{{ trans('Counters_trans.phone') }}</th>
                                <th>{{ trans('Counters_trans.email') }}</th>
                                <th>{{ trans('Counters_trans.title1') }}</th>
                                <th>{{ trans('Counters_trans.title2') }}</th>
                                <th>{{ trans('Counters_trans.title3') }}</th>
                                {{-- <th>{{ trans('Counters_trans.title4') }}</th> --}}
                                <th>{{ trans('Counters_trans.description1') }}</th>
                                <th>{{ trans('Counters_trans.description2') }}</th>
                                <th>{{ trans('Counters_trans.description3') }}</th>
                                {{-- <th>{{ trans('Counters_trans.description4') }}</th> --}}

                                <th>{{ trans('Counters_trans.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($terms as $term)



                                <tr>
                                    <td>{{ $term->id }}</td>
                                    <td>{{ $term->phonenumber }}</td>
                                    <td>{{ $term->email }}</td>

                                    <td>@if(App::getLocale() == 'ar')
                                        {{ $term->title1_ar }}
                                    @else
                                        {{ $term->title1_en }}
                                    @endif</td>
                                    <td>@if(App::getLocale() == 'ar')
                                        {{ $term->title2_ar }}
                                    @else
                                        {{ $term->title2_en }}
                                    @endif</td>
                                    <td>@if(App::getLocale() == 'ar')
                                        {{ $term->title3_ar }}
                                    @else
                                        {{ $term->title3_en }}
                                    @endif</td>
                                    {{-- <td>@if(App::getLocale() == 'ar')
                                        {{ $term->title4_ar }}
                                    @else
                                        {{ $term->title4_en }}
                                    @endif</td> --}}
                                    <td>@if(App::getLocale() == 'ar')
                                        {{ $term->description1_ar }}
                                    @else
                                        {{ $term->description1_en }}
                                    @endif</td>
                                    <td>@if(App::getLocale() == 'ar')
                                        {{ $term->description2_ar }}
                                    @else
                                        {{ $term->description2_en }}
                                    @endif</td>
                                    <td>@if(App::getLocale() == 'ar')
                                        {{ $term->description3_ar }}
                                    @else
                                        {{ $term->description3_en }}
                                    @endif</td>
                                    {{-- <td>@if(App::getLocale() == 'ar')
                                        {{ $term->description4_ar }}
                                    @else
                                        {{ $term->description4_en }}
                                    @endif</td> --}}




                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $term->id }}"
                                            title="{{ trans('Counters_trans.Edit') }}"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $term->id }}"
                                            title="{{ trans('Counters_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>



                                </tr>

                                    <!-- edit_modal_Grade -->
                                    <div class="modal fade" id="edit{{ $term->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('Counters_trans.edit_Grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('terms.update',$term->id) }}" method="post" enctype="multipart/form-data">
                                                        {{ method_field('patch') }}
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="title1_ar"
                                                                    class="mr-sm-2">{{ trans('Counters_trans.title1_ar') }}
                                                                    :</label>
                                                                <input id="title1_ar" type="text" name="title1_ar"
                                                                    class="form-control"
                                                                    value="{{ $term->title1_ar }}"
                                                                    required>
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $term->id }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="title1_en"
                                                                    class="mr-sm-2">{{ trans('Counters_trans.title1_en') }}
                                                                    :</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $term->title1_en }}"
                                                                    name="title1_en" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="title2_ar"
                                                                    class="mr-sm-2">{{ trans('Counters_trans.title2_ar') }}
                                                                    :</label>
                                                                <input id="title2_ar" type="text" name="title2_ar"
                                                                    class="form-control"
                                                                    value="{{ $term->title2_ar }}"
                                                                    >
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $term->id }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="title2_en"
                                                                    class="mr-sm-2">{{ trans('Counters_trans.title2_en') }}
                                                                    :</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $term->title2_en }}"
                                                                    name="title2_en" >
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="title3_ar"
                                                                    class="mr-sm-2">{{ trans('Counters_trans.title3_ar') }}
                                                                    :</label>
                                                                <input id="title3_ar" type="text" name="title3_ar"
                                                                    class="form-control"
                                                                    value="{{ $term->title3_ar }}"
                                                                    >
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $term->id }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="title3_en"
                                                                    class="mr-sm-2">{{ trans('Counters_trans.title3_en') }}
                                                                    :</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $term->title3_en }}"
                                                                    name="title3_en" >
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="title4_ar"
                                                                    class="mr-sm-2">{{ trans('Counters_trans.title4_ar') }}
                                                                    :</label>
                                                                <input id="title4_ar" type="text" name="title4_ar"
                                                                    class="form-control"
                                                                    value="{{ $term->title4_ar }}"
                                                                    >
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $term->id }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="title4_en"
                                                                    class="mr-sm-2">{{ trans('Counters_trans.title4_en') }}
                                                                    :</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $term->title4_en }}"
                                                                    name="title4_en" >
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="description1_ar" class="mr-sm-2">
                                                                    {{ trans('Counters_trans.description1_ar') }} :
                                                                </label>
                                                                <textarea id="description1_ar" name="description1_ar" class="form-control" rows="3" required>{{ $term->description1_ar }}</textarea>
                                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $term->id }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="description1_en" class="mr-sm-2">
                                                                    {{ trans('Counters_trans.description1_en') }} :
                                                                </label>
                                                                <textarea id="description1_en" name="description1_en" class="form-control" rows="3" required>{{ $term->description1_en }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="description2_ar" class="mr-sm-2">
                                                                    {{ trans('Counters_trans.description2_ar') }} :
                                                                </label>
                                                                <textarea id="description2_ar" name="description2_ar" class="form-control" rows="3" >{{ $term->description2_ar }}</textarea>
                                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $term->id }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="description2_en" class="mr-sm-2">
                                                                    {{ trans('Counters_trans.description2_en') }} :
                                                                </label>
                                                                <textarea id="description2_en" name="description2_en" class="form-control" rows="3" >{{ $term->description2_en }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="description3_ar" class="mr-sm-2">
                                                                    {{ trans('Counters_trans.description3_ar') }} :
                                                                </label>
                                                                <textarea id="description3_ar" name="description3_ar" class="form-control" rows="3" >{{ $term->description3_ar }}</textarea>
                                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $term->id }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="description3_en" class="mr-sm-2">
                                                                    {{ trans('Counters_trans.description3_en') }} :
                                                                </label>
                                                                <textarea id="description3_en" name="description3_en" class="form-control" rows="3" >{{ $term->description3_en }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="description4_ar" class="mr-sm-2">
                                                                    {{ trans('Counters_trans.description4_ar') }} :
                                                                </label>
                                                                <textarea id="description4_ar" name="description4_ar" class="form-control" rows="3" >{{ $term->description4_ar }}</textarea>
                                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $term->id }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="description4_en" class="mr-sm-2">
                                                                    {{ trans('Counters_trans.description4_en') }} :
                                                                </label>
                                                                <textarea id="description4_en" name="description4_en" class="form-control" rows="3" >{{ $term->description4_en }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="phonenumber"
                                                                    class="mr-sm-2">{{ trans('Counters_trans.phonenumber') }}
                                                                    :</label>
                                                                <input id="phonenumber" type="text" name="phonenumber"
                                                                    class="form-control"
                                                                    value="{{ $term->phonenumber }}"
                                                                    required>
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $term->id }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="email"
                                                                    class="mr-sm-2">{{ trans('Counters_trans.email') }}
                                                                    :</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $term->email }}"
                                                                    name="email" required>
                                                            </div>
                                                        </div>





                                                        <br><br>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Counters_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ trans('Counters_trans.Submit') }}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
    {{-- //////////////////////////////////// --}}
                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $term->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('Counters_trans.delete_Grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('terms.destroy',$term->id)}}" method="post">
                                                        {{method_field('Delete')}}
                                                        @csrf
                                                        {{ trans('Counters_trans.Warning_Grade') }}
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $term->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('Counters_trans.Close') }}</button>
                                                            <button type="submit"
                                                                    class="btn btn-danger">{{ trans('Counters_trans.Submit') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </table>
                        {{ $terms->links('pagination::bootstrap-5') }}


                    </div>
                </div>
            </div>
        </div>


        <!-- add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('Counters_trans.add_Grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('terms.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <label for="phonenumber" class="mr-sm-2">{{ trans('Counters_trans.phonenumber') }}
                                        :</label>
                                    <input id="phonenumber" type="text" name="phonenumber" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label for="email" class="mr-sm-2">{{ trans('Counters_trans.email') }}
                                        :</label>
                                    <input id="email" type="text" class="form-control" name="email" required>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <label for="title1_ar" class="mr-sm-2">{{ trans('Counters_trans.title1_ar') }}
                                        :</label>
                                    <input id="title1_ar" type="text" name="title1_ar" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="title1_en" class="mr-sm-2">{{ trans('Counters_trans.title1_en') }}
                                        :</label>
                                    <input id="title1_en" type="text" class="form-control" name="title1_en" required>
                                </div>
                            </div>

                            <div class="row d-flex flex-row">
                                <div class="col" style="width: 50%">
                                    <label for="description1_ar" class="mr-sm-2">
                                        {{ trans('Counters_trans.description1_ar') }} :
                                    </label>
                                    <textarea id="description1_ar" name="description1_ar" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col" style="width: 50%">
                                    <label for="description1_en" class="mr-sm-2">
                                        {{ trans('Counters_trans.description1_en') }} :
                                    </label>
                                    <textarea id="description1_en" name="description1_en" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <label for="title2_ar" class="mr-sm-2">{{ trans('Counters_trans.title2_ar') }}
                                        :</label>
                                    <input id="title2_ar" type="text" name="title2_ar" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="title2_en" class="mr-sm-2">{{ trans('Counters_trans.title2_en') }}
                                        :</label>
                                    <input id="title2_en" type="text" class="form-control" name="title2_en" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col" style="width: 50%">
                                    <label for="description2_ar" class="mr-sm-2">
                                        {{ trans('Counters_trans.description2_ar') }} :
                                    </label>
                                    <textarea id="description2_ar" name="description2_ar" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col" style="width: 50%">
                                    <label for="description2_en" class="mr-sm-2">
                                        {{ trans('Counters_trans.description2_en') }} :
                                    </label>
                                    <textarea id="description2_en" name="description2_en" class="form-control" rows="3" ></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="title3_ar" class="mr-sm-2">{{ trans('Counters_trans.title3_ar') }}
                                        :</label>
                                    <input id="title3_ar" type="text" name="title3_ar" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="title3_en" class="mr-sm-2">{{ trans('Counters_trans.title3_en') }}
                                        :</label>
                                    <input id="title3_en" type="text" class="form-control" name="title3_en" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col" style="width: 50%">
                                    <label for="description3_ar" class="mr-sm-2">
                                        {{ trans('Counters_trans.description3_ar') }} :
                                    </label>
                                    <textarea id="description3_ar" name="description3_ar" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col" style="width: 50%">
                                    <label for="description3_en" class="mr-sm-2">
                                        {{ trans('Counters_trans.description3_en') }} :
                                    </label>
                                    <textarea id="description3_en" name="description3_en" class="form-control" rows="3" ></textarea>
                                </div>
                            </div>










                            <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('Counters_trans.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('Counters_trans.Submit') }}</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>

    </div>


@endsection



