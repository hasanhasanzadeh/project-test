@php
    $setting = App\Models\Setting::with(['logo','favicon','socialMedia','meta'])->first();
@endphp

@if($setting->favicon_id)
    <link rel="icon" href="{{$setting->favicon->address}}" type="image/png">
    <link rel="icon" href="{{$setting->favicon->address}}" type="image/ico">
    <link rel="icon" href="{{$setting->favicon->address}}" type="image/jpeg">
@endif
