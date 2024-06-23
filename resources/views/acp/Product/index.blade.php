@extends('acp.layout.app')

@section('title')
    @lang('back.products')
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.products')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.products')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        @if(Session::has('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="uil uil-check me-2"></i>
                {!! session('msg') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="mb-0">@lang('back.filter')</h5>
                </div>

                <div class="p-7">
                    <a class="text-body fw-semibold pb-2 d-block" data-bs-toggle="collapse" href="#categories-collapse" role="button" aria-expanded="false" aria-controls="categories-collapse">
                        <i class="mdi mdi-chevron-up accor-down-icon text-primary me-1"></i> @lang('back.brands')
                    </a>
                    <div class="card p-2 border shadow-none">
                        <ul class="list-unstyled categories-list mb-0">
                            @foreach($brands as $brand)
                                <li>
                                    <a href="?brand={{$brand->id}}">
                                        <i class="mdi mdi-circle-medium me-1"></i>
                                        {{$brand->title}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>


            </div>
        </div>

        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                    <a href="{{route('products.create')}}" class="btn btn-primary waves-effect waves-light">
                                        @lang('back.create') @lang('back.product') <i class="uil uil-plus-square ms-2"></i>
                                    </a>
                            </div>

                        </div>


                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-xl-4 col-sm-6">
                                <div class="product-box">
                                    <div class="product-img pt-4 px-4">
                                        <div class="product-ribbon badge bg-warning">
                                            {{$product->brand->title}}
                                        </div>
                                        <img src="{{getFile(json_decode($product->photos)[0])}}" alt="" class="img-fluid mx-auto d-block w-100" style="height: 160px;">
                                    </div>

                                    <div class="text-center product-content p-4">

                                        <h5 class="mb-1"><a href="#" class="text-dark">{{$product->name}}</a></h5>

                                        <h6 class="mt-3 mb-0"><span class="text-muted me-2">@lang('back.cost')</span>{{$product->cost}}</h6>
                                        <h6 class="mt-3 mb-0"><span class="text-muted me-2">@lang('back.sale')</span>{{$product->sale}}</h6>
                                        <ul class="list-inline mb-0 text-muted product-color">
                                            <li class="list-inline-item">
                                                <a href="{{route('products.edit',$product->id)}}" class="btn btn-outline-warning btn-sm" title="@lang('back.edit')">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{route('products.destroy',$product->id)}}" class="btn btn-outline-danger btn-sm" title="@lang('back.delete')">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- end row -->

                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <div class="float-sm-end">
                                    {!! $products->render() !!}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->


@endsection

