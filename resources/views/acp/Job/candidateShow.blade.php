<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$candidate->name}} || {{$candidate->job->job_title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style type="text/css">
        @media print
        {
            table {
                width: 100%;
                border: 1pt solid #000000;
                border-collapse: collapse;
            }
        }
    </style><!-- Modal -->

</head>
<body>
@php($candidateapp  = json_decode($candidate->app))

<div class="row">

    <div class="col">
        <table class="table table-hover table-bordered">
            <tbody>
            <tr>
                <td><p>@lang('back.full_name') <br> {{$candidate->name}}</p></td>
                <td><p>@lang('back.email') <br> {{$candidate->email}}</p></td>
                <td><p>@lang('back.number_nanonal_id') <br> {{str_replace('-','',$candidateapp->number_nanonal_id)}}</p></td>
            </tr>
            <tr>
                <td><p>@lang('back.phone') <br> {{str_replace('-','',$candidateapp->phone)}}</p></td>
                <td><p>@lang('back.whatsapp') <br> {{str_replace('-','',$candidateapp->whatsapp)}}</p></td>
                <td><p>@lang('back.age') <br> ({{$candidateapp->age}})</p></td>
            </tr>
            <tr>
                <td><p>@lang('back.address_in_id') <br> {{$candidateapp->address_in_id}}</p></td>
                <td><p>@lang('back.current_address') <br> {{$candidateapp->current_address}}</p></td>
                <td><p>@lang('back.date_of_berth') <br> {{$candidateapp->date_of_berth}} <br> @lang('back.age') ({{$candidateapp->age}})</p></td>
            </tr>
            <tr>
                <td> <p>@lang('back.social_status') <br> @lang('back.'.$candidateapp->social_status)</p></td>
                <td> <p>@lang('back.count_child') <br> {{$candidateapp->count_child}}</p></td>
                <td> <p>@lang('back.educational_qualification') <br> {{$candidateapp->educational_qualification}}</p></td>
            </tr>
            <tr>
                <td> <p>@lang('back.educational_qualification') <br> {{$candidateapp->educational_qualification}}</p></td>
                <td> <p>@lang('back.graduation_year') <br> {{$candidateapp->graduation_year}}</p></td>
                <td> <p>@lang('back.military_case') <br> @lang('back.'.$candidateapp->military_case)</p></td>
            </tr>
            <tr>
                <td> <p>@lang('back.do_you_smoke') <br> @lang('back.'.$candidateapp->do_you_smoke)</p></td>
                <td> <p>@lang('back.courses_or_certficat') <br> {{$candidateapp->courses_or_certficat}}</p></td>
                <td> <p>@lang('back.what_your_understanding_nature_work') <br>{{$candidateapp->what_your_understanding_nature_work}}</p></td>
            </tr>
            <tr>
                <td> <p>@lang('back.last_salary') <br> {{$candidateapp->last_salary}}</p></td>
                <td> <p>@lang('back.expected_salary') <br> {{$candidateapp->expected_salary}}</p></td>
                <td> <p>@lang('back.do_you_suffer_from_diseases') <br>{{$candidateapp->do_you_suffer_from_diseases}}</p></td>
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
                <td><p>@lang('back.do_have_achievements_you_made_workplace') <br> {{isset($candidateapp->do_have_achievements_you_made_workplace) ? $candidateapp->do_have_achievements_you_made_workplace : 'لايوجد' }}</p></td>
                <td><p>@lang('back.datils_diseases') <br> {{isset($candidateapp->datils_diseases) ? $candidateapp->datils_diseases : 'لايوجد' }}</p></td>
            </tr>

            </tbody>
        </table>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>