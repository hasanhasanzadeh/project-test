@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semi bold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('verifies.index')}}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            {{__('dashboard.verify-customer')}}
        </a>
        <div class="mx-auto grid z-10 px-4 my-4">
            <!-- component -->
            <div class="w-full mx-auto bg-white rounded-xl shadow-md overflow-hidden">
                <div class="md:flex">
                    <div class="md:flex-shrink-0 m-auto">
                        <img class="h-48 w-full object-cover md:w-48" src="{{$customer->avatar->address??asset('images/user/avatar-profile.png')}}" alt="Image">
                    </div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">
                            <span class="text-dark">نام و نام خانوادگی :</span>
                            <span class="px-3">
                            {{$customer->full_name_with_gender}}
                            </span>
                        </div>
                        <div class="block mt-1 text-lg leading-tight font-medium text-black">
                           <span>نام پدر :</span>
                            <span class="px-3">
                            {{$customer->father_name}}
                            </span>
                        </div>
                        <div class="block mt-1 text-lg leading-tight font-medium text-black">
                            <span>شماره موبایل :</span>
                            <span class="px-3">
                            {{$customer->mobile}}
                            </span>
                        </div>
                        <div class="block mt-1 text-lg leading-tight font-medium text-black">
                            <span>کد ملی :</span>
                            <span class="px-3">
                            {{$customer->national_code}}
                            </span>
                        </div>
                        <div class="block mt-1 text-lg leading-tight font-medium text-black">
                            <span>تاریخ تولد :</span>
                            <span class="px-3" dir="ltr">
                            {{$customer->birthday? \App\Helpers\Helper::toSolarDate($customer->birthday) :'-'}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <div class="w-full overflow-x-auto">
                <form class="w-full" method="post" action="{{route('verifies.update',$customer->id)}}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                    <input type="hidden" name="id" value="{{$customer->id}}">
                    <div class="flex flex-wrap mx-3 my-2 text-justify items-center">

                        <div class="w-full md:w-1/4 px-3 my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="image">
                                {{__('dashboard.authorize_file')}}
                            </label>
                            <img id="image-select" @if($customer->authorize_file_id) src="{{ route('private.image.show', ['filename' => str_replace('verifies/','',$customer->authorizeFile->path)])}}" @endif alt="" class="object-cover shadow rounded @if(!$customer->authorize_file_id) hidden @endif" width="200" height="300">
                            <div class="m-2 p-2">
                                <a class="text-gray-700 dark:text-gray-200 hover:text-yellow-500"  @if($customer->authorizeFile) href="{{route('private.image.show', ['filename' => str_replace('verifies/','',$customer->authorizeFile->path)])}}" download="{{ route('private.image.show', ['filename' => str_replace('verifies/','',$customer->authorizeFile->path)])}}" @endif target="_blank">دانلود عکس احراز هویت</a>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label for="authorize_file_text" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.authorize_file_text')}}</label>
                            <input name="authorize_file_text" id="authorize_file_text" placeholder="{{__('dashboard.authorize_file_text')}}" value="{{$customer->authorize_file_text}}" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        </div>
                        <div class="w-full md:w-1/4 px-3 my-3">
                            <label for="authorize_file_status" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.authorize_file_status')}}</label>
                            <select name="authorize_file_status" id="authorize_file_status" class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="pending" @if($customer->authorize_file_status=='pending') selected @endif> در حال پردازش </option>
                                <option value="rejected" @if($customer->authorize_file_status=='rejected') selected @endif>تایید نشد</option>
                                <option value="accepted" @if($customer->authorize_file_status=='accepted') selected @endif>تایید شد</option>
                                <option value="" @if($customer->authorize_file_status==null) selected @endif>عکس احراز آپلود نشده است</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/4 px-3 my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="image">
                                {{__('dashboard.authorize_file')}}
                            </label>
                            <img id="image-select" @if($customer->national_card_file_id) src="{{ route('private.image.show', ['filename' => str_replace('verifies/','',$customer->nationalCardFile->path)])}}" @endif alt="" class="object-cover shadow rounded @if(!$customer->national_card_file_id) hidden @endif" width="200" height="300">
                            <div class="m-2 p-2">
                                <a class="text-gray-700 dark:text-gray-200 hover:text-yellow-600" @if($customer->nationalCardFile) href="{{ route('private.image.show', ['filename' => str_replace('verifies/','',$customer->nationalCardFile->path)])}}" download="{{ route('private.image.show', ['filename' => str_replace('verifies/','',$customer->nationalCardFile->path)])}}" @endif target="_blank">دانلود عکس کارت ملی</a>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label for="national_card_file_text" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.national_card_file_text')}}</label>
                            <input name="national_card_file_text" id="national_card_file_text" placeholder="{{__('dashboard.national_card_file_text')}}" value="{{$customer->national_card_file_text}}" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        </div>
                        <div class="w-full md:w-1/4 px-3 my-3">
                            <label for="national_card_file_status" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.national_card_file_status')}}</label>
                            <select name="national_card_file_status" id="national_card_file_status" class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="pending" @if($customer->national_card_file_status=='pending') selected @endif> در حال پردازش </option>
                                <option value="rejected" @if($customer->national_card_file_status=='rejected') selected @endif>تایید نشد</option>
                                <option value="accepted" @if($customer->national_card_file_status=='accepted') selected @endif>تایید شد</option>
                                <option value="" @if($customer->national_card_file_status==null) selected @endif>عکس کارت ملی هنوز آپلود نشده است</option>
                            </select>
                        </div>
                        <div class="w-full px-3 my-3">
                            <label for="user_level_id" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.user_level')}}</label>
                            <select name="user_level_id" id="user_level_id" class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                @if($customer->user_level_id)
                                <option value="{{$customer->userLevel->id}}" @if($customer->user_level_id) selected @endif>
                                    {{$customer->userLevel->level_name}}
                                </option>
                                @else
                                    <option value="" selected>
                                        سطح کاربر را انتخاب کنید
                                    </option>
                                @endif
                            </select>
                        </div>
                        <div class="w-full px-3 my-3">
                            <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fa fa-save"></i>
                                {{__('dashboard.store')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#user_level_id').select2({
            tags : true ,
            placeholder: 'سطح کاربر را انتخاب کنید',
            ajax: {
                url: '{{route('userLevel.search')}}',
                dataType: 'json',
                delay: 220,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (data) {
                            return {
                                text: data.level_name,
                                id: data.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endsection
