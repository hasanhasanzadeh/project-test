@extends('panel.layouts.app')

@section('content')
        <div class="w-full mx-auto z-10">
            <div class="flex flex-col">
                <div class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                    <div class="flex justify-between p-2">
                        <div class="flex justify-center items-center dark:text-gray-200 text-gray-800">
                            <i class="fa-solid fa-wallet fa-xl px-3"></i>
                            <span>{{number_format($user->balance,0)}}</span>
                            <span class="px-2">تومان</span>
                        </div>
                        <div class="flex justify-center items-center dark:text-gray-200 text-gray-800">
                            <i class="fa fa-mobile fa-xl px-1"></i>
                            <span class="px-1">{{$user->mobile}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full mx-auto z-10">
            <div class="flex flex-col">
                <div class="bg-gray-700 border border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                    <div class="flex-none sm:flex">
                        <div class=" relative h-32 w-32  sm:mb-0 mb-3">
                            @if($user->avatar)
                                <img src="{{$user->avatar->address}}" alt="{{$user->full_name}}" class=" w-32 h-32 object-cover rounded-2xl">
                            @else
                                <img src="{{asset('/images/user/avatar-profile.png')}}" alt="avatar default" class=" w-32 h-32 object-cover rounded-2xl">
                            @endif
                            <div>
                                <input type="file" name="avatar" id="imageInput" style="display: none;">
                            </div>
                            <button id="selectImageButton" title="آپلود پروفایل" class="absolute -right-2 bottom-2   -ml-3  text-white p-1 text-xs bg-yellow-600 hover:bg-yellow-700 font-medium tracking-wider rounded-full transition ease-in duration-300">
                                <i class="fa fa-edit"></i>
                            </button>
                        </div>
                        <div class="flex-auto sm:ml-5 justify-evenly">
                            <div class="flex items-center justify-between sm:mt-2">
                                <div class="flex items-center">
                                    <div class="flex flex-col mr-2">
                                        <div class="w-full flex-none px-3 text-lg text-gray-200 font-bold leading-none">
                                            {{$user->full_name_with_gender??$user->mobile}}
                                        </div>
                                        <div class="flex-auto text-gray-400 m-1">
                                            <span class="ml-3">
                                                {{$user->mobile}}
                                            </span>
                                            <span class="ml-3 border-r border-gray-600  max-h-0"></span><span>{{$user->national_code}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-row items-center">
                                <div class="flex mr-2">
                                    @if($user->userLevel)
                                        @for($i=1,$k=$user->userLevel->number;$i <= $user->userLevel->number;$i++,$k--)
                                            <i class="fa-solid fa-star text-yellow-400 fa-xl py-2 px-1"></i>
                                        @endfor
                                        @for(;$k > 0;$k--)
                                                <i class="fa-regular fa-star text-yellow-400 fa-xl py-2 px-1"></i>
                                        @endfor
                                    @else
                                        @for($j=1;$j <= 6;$j++)
                                            <i class="fa-regular fa-star text-yellow-400 fa-xl py-2 px-1"></i>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                            <div class="flex pt-3 px-2 text-sm text-gray-400">
                                <div class="flex-1 inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-yellow-600" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                              clip-rule="evenodd">

                                        </path>
                                    </svg>
                                    <p class="px-2">{{$user->userLevel->title??'سطح صفر'}}</p>
                                </div>
                                <a href="{{route('level.show')}}"  class="flex-no-shrink bg-yellow-600 hover:bg-yellow-700 px-5 ml-4 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-yellow-500 hover:border-yellow-500 text-white rounded-full transition ease-in duration-300">
                                    ارتقاء سطح کاربری
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="w-full mx-auto z-10">
        <div class="flex flex-col">
            <div class="dark:bg-gray-700 border dark:border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                <!-- component -->
                <div class="flex items-center justify-center p-12">
                    <!-- Author: FormBold Team -->
                    <!-- Learn More: https://formbold.com -->
                    <div class="mx-auto w-full">
                        <form action="{{route('profile.admin.update')}}" method="POST">
                            @csrf
                            {{method_field('PATCH')}}
                            <div class="-mx-3 flex flex-wrap">
                                <div class="w-full px-3 sm:w-1/2">
                                    <div class="mb-5">
                                        <label for="full_name" class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium">
                                            نام و نام خانوادگی
                                        </label>
                                        <input
                                            type="text"
                                            name="full_name"
                                            id="full_name"
                                            value="{{$user->full_name}}"
                                            placeholder="نام و نام خانوادگی"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        />
                                    </div>
                                </div>
                                <div class="w-full px-3 sm:w-1/2">
                                    <div class="mb-5">
                                        <label for="father_name" class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium">
                                            نام پدر
                                        </label>
                                        <input
                                            type="text"
                                            name="father_name"
                                            id="father_name"
                                            value="{{$user->father_name}}"
                                            placeholder="نام پدر"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        />
                                    </div>
                                </div>
                                <div class="w-full px-3 sm:w-1/2">
                                    <div class="mb-5">
                                        <label
                                            for="national_code"
                                            class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                        >
                                            کد ملی
                                        </label>
                                        <input
                                            type="text"
                                            name="national_code"
                                            id="national_code"
                                            placeholder="کد ملی"
                                            value="{{$user->national_code}}"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        />
                                    </div>
                                </div>
                                <div class="w-full px-3 sm:w-1/2">
                                    <div class="mb-5">
                                        <label
                                            for="datepicker"
                                            class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                        >
                                            تاریخ تولد
                                        </label>
                                        <input
                                            type="text"
                                            name="birthday"
                                            id="datepicker"
                                            value="{{$user->birthday?verta()->parse($user->birthday)->format('Y-m-d'):''}}}}"
                                            class="w-full datepicker rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        />
                                    </div>
                                </div>
                                <div class="w-full px-3 sm:w-1/2">
                                    <div class="mb-5">
                                        <label
                                            for="mobile"
                                            class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                        >
                                            موبایل
                                        </label>
                                        <input
                                            type="text"
                                            maxlength="11"
                                            name="mobile"
                                            id="mobile"
                                            value="{{$user->mobile}}"
                                            placeholder="موبایل"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        />
                                    </div>
                                </div>
                                <div class="w-full px-3 sm:w-1/2">
                                    <div class="mb-5">
                                        <label
                                            for="gender"
                                            class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                        >
                                            جنسیت
                                        </label>
                                        <select name="gender" id="gender" dir="ltr" class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md">
                                            <option value="" @if($user->gender==null) selected @endif>انتخاب جنسیت</option>
                                            <option value="male" @if($user->gender=='male') selected @endif>آقا</option>
                                            <option value="female" @if($user->gender=='female') selected @endif>خانم</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-full px-3">
                                    <div class="mb-5">
                                        <label
                                            for="email"
                                            class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                        >
                                            ایمیل
                                        </label>
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            value="{{$user->email}}"
                                            placeholder="ایمیل"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        />
                                    </div>
                                </div>
                                <div class="w-full px-3">
                                    <div class="mb-5">
                                        <label for="address" class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium">
                                            آدرس
                                        </label>
                                        <input name="address" placeholder="آدرس" value="{{$user->address}}" id="address" class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="hover:shadow-form rounded-md bg-yellow-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                    ویرایش اطلاعات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('selectImageButton').addEventListener('click', function() {
            // Trigger the hidden file input when the button is clicked
            document.getElementById('imageInput').click();
        });
        document.getElementById('imageInput').addEventListener('change', function() {
            const imageInput = document.getElementById('imageInput');
            const file = imageInput.files[0];

            if (file) {
                const formData = new FormData();
                formData.append('avatar', file);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('{{route('avatar.upload')}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('مشکل در آپلود فایل.');
                    });
            } else {
                alert('هیچ عکسی اپلود انتخاب نشده است.');
            }
        });
    </script>
@endsection
