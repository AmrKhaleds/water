<?php


if (!function_exists('uploadFile')) {
    function uploadFile($file)
    {
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/'), $fileName);
            $file = new App\Models\File();
            $file->name = $fileName;
            $file->save();
            return $file->id;

    }
}

if (!function_exists('getFile')) {
    function getFile($file_id)
    {
        $file = App\Models\File::find($file_id);
        return $file != null ? url('uploads/'.$file->name) : null;
    }
}

if (!function_exists('getSetting')) {
    function getSetting($data)
    {
        $query = App\Models\Setting::where('name',$data)->first();
        return $query;
    }
}

if (!function_exists('account_setting')) {
    function account_setting($data)
    {
        $query = App\Models\Setting::where('name',$data)->first();
        return $query;
    }
}
