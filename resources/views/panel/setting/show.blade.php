@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('settings.index')}}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            {{__('dashboard.settings')}}
        </a>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border">
            <table class="w-full  order">
                <thead>
                <tr class="text-sm font-bold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">{{__('dashboard.id')}}</th>
                    <th class="px-4 py-3">{{__('dashboard.description')}}</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.favicon')}}</td>
                    <td class="px-4 py-3 text-sm">
                        @if($panel->favicon_id)
                            <img src="{{$panel->favicon->address}}" height="90" width="90"
                                 class="rounded-full w-12 h-12 mx-auto" alt="">
                        @else
                            <img src="{{url('/images/no-image.png')}}" height="90" width="90" alt=""
                                 class="rounded-full  w-12 h-12 mx-auto">
                        @endif
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.logo')}}</td>
                    <td class="px-4 py-3 text-sm">
                        @if($panel->logo_id)
                            <img src="{{$panel->logo->address}}" height="90" width="90"
                                 class="rounded-full w-12 h-12 mx-auto" alt="">
                        @else
                            <img src="{{url('/images/no-image.png')}}" height="100" width="100" alt=""
                                 class="rounded-full mx-auto">
                        @endif
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">عکس صفحه پروفایل</td>
                    <td class="px-4 py-3 text-sm">
                        @if($panel->photo)
                            <img src="{{$panel->photo->address}}" height="90" width="90"
                                 class="rounded-full w-12 h-12 mx-auto" alt="">
                        @else
                            <img src="{{url('/images/no-image.png')}}" height="100" width="100" alt=""
                                 class="rounded-full mx-auto">
                        @endif
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.title')}}</td>
                    <td class="px-4 py-3 text-xs">
                        {{$panel->title}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">درصد معرفی معرف</td>
                    <td class="px-4 py-3 text-xs">
                        {{$panel->percentage}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.short_text')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->short_text}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.post_code')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->post_code}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.copy_right')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->copy_right}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.about')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {!!$panel->about!!}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.description')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {!!$panel->description!!}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.address')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->address}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.tel')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->tel}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.email')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->email}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.telegram')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->socialMedia->telegram??''}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.instagram')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->socialMedia->instagram??''}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.youtube')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->socialMedia->youtube??''}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.facebook')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->socialMedia->facebook??''}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.x_link')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->socialMedia->x_link??''}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.whatsapp')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->socialMedia->whatsapp??''}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.meta_title')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->meta->meta_title??''}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.meta_keywords')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->meta->meta_keywords??''}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.meta_description')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$panel->meta->meta_description??''}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
