@extends('acp.layout.app')

@section('title')
    @lang('back.price_proposal')
@endsection

@section('css')
    <link href="{{ url('acp/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('acp/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('acp/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.price_proposal')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.price_proposal')</li>
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
                @if (Session::has('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-check me-2"></i>
                        {!! session('msg') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                        </button>
                    </div>
                @endif
                <div class="contentToPrint">
                    <!-- content to be printed here -->
                </div>

                <div class="card-body">
                    <a href="{{ route('price_proposal.create') }}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.create') @lang('back.price_proposal') <i class="uil uil-plus-square ms-2"></i>
                    </a>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('back.whatsapp')</th>
                                <th>@lang('back.print')</th>
                                <th>@lang('back.name')</th>
                                <th>@lang('back.date')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($statements)
                                @foreach ($statements as $key => $statement)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <a class="dropdown-item" href="#" type="button" data-bs-toggle="modal"
                                                data-bs-target="#proposal-id" data-id="{{ $statement->id }}">
                                                <i class="uil uil-whatsapp-alt" style="font-size: 30px; color: green"></i>
                                            </a>
                                        </td>
                                        <td>
                                            @php
                                                $url = route('price_proposal.print', $statement->id);
                                            @endphp
                                            <a class="dropdown-item" href="#"
                                                onclick="printPage('{{ $url }}'); return false;"><i
                                                    class="text-warning fas fa-print" style="font-size: 25px;"></i>
                                            </a>
                                        </td>
                                        <td>
                                            {{ $statement->name }}
                                        </td>
                                        <td>
                                            {{ Carbon\Carbon::parse($statement->date)->format('d/m/Y') }}
                                        </td>

                                        <td style="width: 100px">
                                            <div class="dropdown float-end">
                                                <a class="text-body dropdown-toggle font-size-16" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="uil uil-ellipsis-h"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item"
                                                        href="{{ route('price_proposal.show', $statement->id) }}"><i
                                                            class="text-warning fas fa-eye"></i> @lang('back.show')
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('price_proposal.edit', $statement->id) }}"><i
                                                            class="text-warning fas fa-pencil-alt"></i> @lang('back.edit')
                                                    </a>
                                                    <!-- Delete Button -->
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        data-id="{{ $statement->id }}" class="dropdown-item">
                                                        <i class="text-danger fas fa-times"></i> @lang('back.delete')
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                    {{ $statements->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد حذف هذه الفاتورة؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء الإجراء</button>
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="proposal-id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('back.whatsapp')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('price_proposal.whatsapp') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">ارسال عرض السعر لرقم وتس اب</label>
                            <span class="text-danger d-block">يرجى مراعه كتابه الرقم بالشكل التالى : 01xxxxxxxxx</span>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                placeholder="ادخل رقم العميل">
                            <input type="hidden" class="form-control" id="proposal_id" name="proposal_id"
                                value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">@lang('back.close')</button>
                            <button type="submit" class="btn btn-primary">@lang('back.submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ url('acp/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('acp/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var saleId = button.getAttribute('data-id');
                var action = "{{ route('price_proposal.destroy', '') }}/" + saleId;
                var form = document.getElementById('deleteForm');
                form.action = action;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var proposalModal = document.getElementById('proposal-id');

            proposalModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var proposalId = button.getAttribute('data-id');
                var modalInput = proposalModal.querySelector('#proposal_id');
                modalInput.value = proposalId;
            });
        });
    </script>

    <!-- Buttons examples -->
    <script src="{{ url('acp/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('acp/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('acp/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('acp/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('acp/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ url('acp/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ url('acp/js/pages/datatables.init.js') }}"></script>
    <script>
        function printPage(url) {
            var printWindow = window.open(url, '_blank', 'height=500,width=800');
            printWindow.onload = function() {
                printWindow.focus();
                printWindow.print();
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            };
        }
    </script>
@endsection
