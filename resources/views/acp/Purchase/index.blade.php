@extends('acp.layout.app')

@section('title')
    @lang('back.purchases')
@endsection

@section('css')
    <link href="{{url('acp/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('acp/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('acp/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.purchases')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.purchases')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(Session::has('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-check me-2"></i>
                        {!! session('msg') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                        </button>
                    </div>

                @endif
                <div class="card-body">
                    <a href="{{route('purchases.create')}}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.create') @lang('back.bill_purchase') <i class="uil uil-plus-square ms-2"></i>
                    </a>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('back.date') </th>
                            <th>@lang('back.ref') </th>
                            <th>@lang('back.provider') </th>
                            <th>@lang('back.store') </th>
                            <th>@lang('back.status') </th>
                            <th>@lang('back.total') </th>
                            <th>@lang('back.paid') </th>
                            <th>@lang('back.due') </th>
                            <th>@lang('back.status_paid') </th>
                            <th>@lang('back.action')</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($purchases as $key => $purchase)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$purchase->set_date}}</td>
                                <td><a href="{{route('purchases.show',$purchase->id)}}">{{$purchase->ref}}</a></td>
                                <td>{{$purchase->user->name}}</td>
                                <td>{{$purchase->store->name}}</td>
                                <td><span class="badge bg-soft-{{$purchase->status == 'ordered' ? 'success' : 'danger'}}">@lang('back.'.$purchase->status)</span></td>
                                <td>{{$purchase->total_amount}}</td>
                                <td>{{$purchase->paid}}</td>
                                <td>{{$purchase->due}}</td>
                                <td>{!! $purchase->status_paid !!}</td>
                                <td style="width: 100px">
                                    <div class="dropdown float-end">
                                        <a class="text-body dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                            <i class="uil uil-ellipsis-h"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{route('purchases.edit',$purchase->id)}}"><i class="text-warning fas fa-pencil-alt"></i> @lang('back.edit')</a>
                                            <a class="dropdown-item" href="{{route('purchases.destroy',$purchase->id)}}"><i class="text-danger fas fa-times"></i> @lang('back.delete')</a>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg{{$purchase->id}}"><i class="text-primary fas fa-plus-circle"></i> @lang('back.create') @lang('back.payment')</button>
                                            <a class="dropdown-item" href="{{route('payments.show',$purchase->id)}}"><i class="text-dark fas fa-dollar-sign"></i> @lang('back.payments')</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!--  Create Payment -->
                            <div class="modal fade bs-example-modal-lg{{$purchase->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myLargeModalLabel">@lang('back.create') @lang('back.payment') {{$purchase->ref}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('payments.store',$purchase->id)}}" enctype="multipart/form-data">
                                            @csrf
                                                <div class="row">

                                                    <div class="col-lg-6">
                                                        <div class="mt-5 mt-lg-4">

                                                            <div class="row mb-4">
                                                                <label for="horizontal-Fullname-input"
                                                                       class="col-sm-4 col-form-label">@lang('back.date') *</label>
                                                                <div class="col-sm-8">
                                                                    <input type="date" class="form-control" id="horizontal-Fullname-input"
                                                                           value="{{old('date',date('Y-m-d'))}}" required name="date">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <label for="horizontal-Fullname-input"
                                                                       class="col-sm-4 col-form-label">@lang('back.to_be_paid') </label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control" id="horizontal-Fullname-input"
                                                                           value="{{$purchase->total_amount}}" readonly required name="total_amount">
                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mt-5 mt-lg-4">
                                                            <div class="row mb-4" >
                                                                <label for="horizontal-address-input"
                                                                       class="col-sm-4 col-form-label">@lang('back.payment_type') *</label>
                                                                <div class="col-sm-8">
                                                                    <select name="payment_type" class="form-control">
                                                                        <option value="" disabled selected>@lang('back.select_one')</option>
                                                                        <option value="cash">@lang('back.cash')</option>
                                                                        <option value="bank_transfer">@lang('back.bank_transfer')</option>
                                                                        <option value="bank_check">@lang('back.bank_check')</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <label for="horizontal-Fullname-input"
                                                                       class="col-sm-4 col-form-label">@lang('back.paid_up') *</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control" id="horizontal-Fullname-input"
                                                                           value="{{old('amount	')}}" required name="amount" placeholder="@lang('back.paid_up')">
                                                                </div>
                                                            </div>





                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="row">

                                                    <div class="col-lg-12">
                                                        <div class="mt-5 mt-lg-4">

                                                            <div class="row mb-4">
                                                                <label for="horizontal-Fullname-input"
                                                                       class="col-sm-4 col-form-label">@lang('back.description') *</label>
                                                                <div class="col-sm-8">
                                                                    <textarea name="note" class="form-control" cols="30"
                                                                              rows="5" placeholder="@lang('back.description')">{{old('note')}}</textarea>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row justify-content-end">
                                                    <div class="col-sm-9">
                                                        <div class="d-flex flex-wrap gap-3">
                                                            <button type="submit"
                                                                    class="btn btn-primary waves-effect waves-light w-md">@lang('back.submit')</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->



@endsection


@section('js')

    <!-- Required datatable js -->
    <script src="{{url('acp/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Buttons examples -->
    <script src="{{url('acp/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('acp/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{url('acp/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{url('acp/js/pages/datatables.init.js')}}"></script>


@endsection