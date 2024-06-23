@php($candidateapp  = json_decode($candidate->app))
<style type="text/css">
    @media print {
        table {
            width: 100%;
            border: 1pt solid #000000;
            border-collapse: collapse;
        }
    }
</style><!-- Modal -->
<div class="modal fade app{{$candidate->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title{{$candidate->id}}"
                    id="exampleModalLabel">@lang('back.applecation_job') {{$candidate->job->job_title}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                <button class="btnPrint btn btn-primary" data-id="{{$candidate->id}}"
                        type="button">@lang('back.print')</button>
                <button class="btnSendTo btn btn-info" data-id="{{$candidate->id}}"
                        type="button">@lang('back.send_to')</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" id="dvContents{{$candidate->id}}">
                    <form class="col gx-3 gy-2 align-items-center" id="sendto{{$candidate->id}}" method="post" style="display: none"
                          action="{{route('jobs.candidate.sendto',$candidate->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-10">
                                <label class="visually-hidden" for="specificSizeInputName">@lang('back.send_to')</label>
                                <input type="text" name="send_to" class="form-control" id="specificSizeInputName"
                                       placeholder="@lang('back.send_to')">
                            </div>
                            <div class="col-2">
                                <div class="d-flex flex-wrap gap-3">
                                    <button type="submit"
                                            class="btn btn-primary waves-effect waves-light w-md">@lang('back.submit')</button>
                                </div>
                            </div>
                        </div>
                    </form>


                    <div class="row">


                        <div class="col">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                <tr>
                                    <td><p>@lang('back.full_name') <br> {{$candidate->name}}</p></td>
                                    <td><p>@lang('back.email') <br> {{$candidate->email}}</p></td>
                                    <td><p>@lang('back.number_nanonal_id')
                                            <br> {{str_replace('-','',$candidateapp->number_nanonal_id)}}</p></td>
                                </tr>
                                <tr>
                                    <td><p>@lang('back.phone') <br> {{str_replace('-','',$candidateapp->phone)}}</p>
                                    </td>
                                    <td><p>@lang('back.whatsapp') <br> {{str_replace('-','',$candidateapp->whatsapp)}}
                                        </p></td>
                                    <td><p>@lang('back.age') <br> ({{$candidateapp->age}})</p></td>
                                </tr>
                                <tr>
                                    <td><p>@lang('back.address_in_id') <br> {{$candidateapp->address_in_id}}</p></td>
                                    <td><p>@lang('back.current_address') <br> {{$candidateapp->current_address}}</p>
                                    </td>
                                    <td><p>@lang('back.date_of_berth') <br> {{$candidateapp->date_of_berth}}
                                            <br> @lang('back.age') ({{$candidateapp->age}})</p></td>
                                </tr>
                                <tr>
                                    <td><p>@lang('back.social_status') <br> @lang('back.'.$candidateapp->social_status)
                                        </p></td>
                                    <td><p>@lang('back.count_child') <br> {{$candidateapp->count_child}}</p></td>
                                    <td><p>@lang('back.educational_qualification')
                                            <br> {{$candidateapp->educational_qualification}}</p></td>
                                </tr>
                                <tr>
                                    <td><p>@lang('back.educational_qualification')
                                            <br> {{$candidateapp->educational_qualification}}</p></td>
                                    <td><p>@lang('back.graduation_year') <br> {{$candidateapp->graduation_year}}</p>
                                    </td>
                                    <td><p>@lang('back.military_case') <br> @lang('back.'.$candidateapp->military_case)
                                        </p></td>
                                </tr>
                                <tr>
                                    <td><p>@lang('back.do_you_smoke') <br> @lang('back.'.$candidateapp->do_you_smoke)
                                        </p></td>
                                    <td><p>@lang('back.courses_or_certficat')
                                            <br> {{$candidateapp->courses_or_certficat}}</p></td>
                                    <td><p>@lang('back.what_your_understanding_nature_work')
                                            <br>{{$candidateapp->what_your_understanding_nature_work}}</p></td>
                                </tr>
                                <tr>
                                    <td><p>@lang('back.last_salary') <br> {{$candidateapp->last_salary}}</p></td>
                                    <td><p>@lang('back.expected_salary') <br> {{$candidateapp->expected_salary}}</p>
                                    </td>
                                    <td><p>@lang('back.do_you_suffer_from_diseases')
                                            <br>{{$candidateapp->do_you_suffer_from_diseases}}</p></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>


                    <div class="row">
                        <div class="col">
                            <p>@lang('back.previous_jobs_from_newest_oldest')</p>
                            <table class="table table-hover table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th width="30%">@lang('back.position')</th>
                                    <th width="20%">@lang('back.salary')</th>
                                    <th>@lang('back.reason_for_leaving')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($candidateapp->position as $key => $position)
                                    <tr>
                                        <td><p>{{$candidateapp->position[$key]}}</p></td>
                                        <td><p>{{$candidateapp->salary[$key]}}</p></td>
                                        <td><p>{{$candidateapp->reason_for_leaving[$key]}}</p></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                <tr>
                                    <td><p>@lang('back.do_have_achievements_you_made_workplace')
                                            <br> {{isset($candidateapp->do_have_achievements_you_made_workplace) ? $candidateapp->do_have_achievements_you_made_workplace : 'لايوجد' }}
                                        </p></td>
                                    <td><p>@lang('back.datils_diseases')
                                            <br> {{isset($candidateapp->datils_diseases) ? $candidateapp->datils_diseases : 'لايوجد' }}
                                        </p></td>
                                </tr>

                                </tbody>
                            </table>

                        </div>

                    </div>


                </div>

                <div class="modal-footer">

                    <div class="row">
                        <button class="btnPrint btn btn-primary" data-id="{{$candidate->id}}"
                                type="button">@lang('back.print')</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
