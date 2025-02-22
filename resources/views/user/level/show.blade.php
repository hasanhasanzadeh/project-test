@extends('user.layouts.app_user')

@section('content')
    <div class="w-full mx-auto z-10">
        <div class="flex flex-col">
            <div class="dark:bg-gray-700 border dark:border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                <div class="flex-none sm:flex gap-4">
                    <div class=" relative h-32 w-32  sm:mb-0 mb-3">
                        @if($user->avatar)
                            <img src="{{$user->avatar->address}}" alt="{{$user->full_name}}" class=" w-32 h-32 object-cover rounded-2xl">
                        @else
                            <img src="{{asset('/images/user/avatar-profile.png')}}" alt="avatar default" class=" w-32 h-32 object-cover rounded-2xl">
                        @endif
                        <div>
                            <input type="file" name="avatar" id="imageInput" style="display: none;">
                        </div>
                        <button id="selectImageButton" title="آپلود پروفایل" class="absolute -right-2 bottom-2   -ml-3  text-white p-1 text-xs bg-blue-600 hover:bg-blue-700 font-medium tracking-wider rounded-full transition ease-in duration-300">
                            <i class="fa fa-edit"></i>
                        </button>
                    </div>
                    <div class="flex-auto sm:ml-5 justify-evenly">
                        <div class="flex items-center justify-between sm:mt-2">
                            <div class="flex items-center">
                                <div class="flex flex-col mr-2">
                                    <div class="w-full flex-none px-3 text-lg dark:text-gray-200 text-gray-800 font-bold leading-none">
                                        {{$user->full_name_with_gender??$user->mobile}}
                                    </div>
                                    <div class="flex-auto m-1 dark:text-gray-200 text-gray-800">
                                            <span class="ml-3">
                                                {{$user->mobile}}
                                            </span>
                                        <span class="ml-3 border-r border-gray-600  max-h-0 dark:text-gray-200 text-gray-800"></span><span>{{$user->national_code}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row items-center">
                            <div class="flex mr-2">
                                @if($user->userLevel)
                                    @for($i=1,$k=$user->userLevel->level_number;$i <= $user->userLevel->level_number;$i++,$k--)
                                        <i class="fa-solid fa-star text-blue-400 fa-xl py-2 px-1"></i>
                                    @endfor
                                    @for(;$k > 0;$k--)
                                        <i class="fa-regular fa-star text-blue-400 fa-xl py-2 px-1"></i>
                                    @endfor
                                @else
                                    @for($j=1;$j <= 6;$j++)
                                        <i class="fa-regular fa-star text-blue-400 fa-xl py-2 px-1"></i>
                                    @endfor
                                @endif
                            </div>
                        </div>
                        <div class="flex pt-3 px-2 text-sm text-gray-400">
                            <div class="flex-1 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-blue-600" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                          clip-rule="evenodd">

                                    </path>
                                </svg>
                                <p class="px-2 dark:text-gray-200 text-gray-800">{{$user->userLevel->level_name??'سطح صفر'}}</p>
                            </div>
                            <a href="{{route('level.show')}}"  class="flex-no-shrink bg-green-600 hover:bg-green-700 px-5 ml-4 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-500 hover:border-green-500 text-white rounded-full transition ease-in duration-300">
                                ارتقاء سطح کاربری
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full mx-auto z-10">
    <div class="flex flex-col m-2 p-2">
        <div class="sm:w-full md:flex gap-4">
            @foreach($verifySamples as $verifySample)
                <div class="sm:w-full md:w-1/2 bg-gray-100 h-auto gap-3 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 my-2">
                    <h2 class="flex items-center justify-center text-xl text-blue-500 p-4">
                        <i class="fa-solid fa-circle-info text-blue-600 px-3"></i>
                            <span>{{ $verifySample->title }}</span>
                    </h2>
                    <hr class="text-gray-600 dark:text-gray-200">
                    <div class="text-gray-600 dark:text-gray-200 py-4 space-5 text-justify">
                            {!! $verifySample->description !!}
                    </div>
                    <p class="w-full h-auto mt-8">
                        <img src="{{$verifySample->photo->address}}" alt="{{$verifySample->title}}" class="rounded shadow p-2 m-2 w-full object-cover">
                    </p>
                </div>
            @endforeach
            <div class="sm:w-full md:w-1/2 bg-gray-100 gap-3 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 my-2">
                    <h2 class="flex items-center justify-center text-xl text-blue-500 p-4">
                        <i class="fa-solid fa-circle-info text-blue-600 px-3"></i>
                        <span class="px-3">اطلاعات احراز خود را با دقت وارد کنید</span>
                    </h2>
                    <hr class="text-gray-600 dark:text-gray-200">
                    @if($user->authorize_file_status=='accepted')
                    <div class="bg-green-600 border border-green-300 shadow-lg  rounded-3xl p-4 m-4">
                        <div class="flex justify-between p-2">
                            <div class="flex justify-center items-center text-gray-200">
                                <i class="fa-solid fa-check px-3"></i>
                                <span class="px-4">{{$user->authorize_file_text??'احراز هویت شما انجام شد'}}</span>
                            </div>
                        </div>
                    </div>
                    @elseif($user->authorize_file_status=='pending')
                    <div class="bg-blue-600 border border-blue-300 shadow-lg  rounded-3xl p-4 m-4">
                        <div class="flex justify-between p-2">
                            <div class="flex justify-center items-center text-gray-200">
                                <i class="fa-solid fa-warning px-3"></i>
                                <span class="px-4">{{$user->authorize_file_text??'احراز هویت شما در حال پردازش می باشد'}}</span>
                            </div>
                        </div>
                    </div>
                @elseif($user->authorize_file_status=='rejected')
                    <div class="bg-red-600 border border-red-300 shadow-lg  rounded-3xl p-4 m-4">
                        <div class="flex justify-between p-2">
                            <div class="flex justify-center items-center text-gray-200">
                                <i class="fa-solid fa-warning px-3"></i>
                                <span class="px-4">{{$user->authorize_file_text??'احراز هویت شما مورد تایید نمی باشد'}}</span>
                            </div>
                        </div>
                    </div>
                @elseif($user->authorize_file_status==null)
                    <div class="bg-gray-600 border border-gray-300 shadow-lg  rounded-3xl p-4 m-4">
                        <div class="flex justify-between p-2">
                            <div class="flex justify-center items-center text-gray-200">
                                <i class="fa-solid fa-warning px-3"></i>
                                <span class="px-4">{{$user->authorize_file_text??'هنوز شما احراز هویتی انجام ندادید'}}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if($user->national_card_file_status=='accepted')
                    <div class="bg-green-600 border border-green-300 shadow-lg  rounded-3xl p-4 m-4">
                        <div class="flex justify-between p-2">
                            <div class="flex justify-center items-center text-gray-200">
                                <i class="fa-solid fa-check px-3"></i>
                                <span class="px-4">{{$user->national_card_file_text??'احراز کارت ملی شما تایید شد'}}</span>
                            </div>
                        </div>
                    </div>
                @elseif($user->national_card_file_status=='pending')
                        <div class="bg-blue-600 border border-blue-300 shadow-lg  rounded-3xl p-4 m-4">
                            <div class="flex justify-between p-2">
                                <div class="flex justify-center items-center text-gray-200">
                                    <i class="fa-solid fa-warning px-3"></i>
                                    <span class="px-4">{{$user->national_card_file_text??'احراز کارت ملی شما در حال پردازش می باشد'}}</span>
                                </div>
                            </div>
                        </div>
                @elseif($user->national_card_file_status=='rejected')
                    <div class="bg-red-600 border border-red-300 shadow-lg  rounded-3xl p-4 m-4">
                        <div class="flex justify-between p-2">
                            <div class="flex justify-center items-center text-gray-200 ">
                                <i class="fa-solid fa-warning px-3"></i>
                                <span class="px-4">{{$user->national_card_file_text??'احراز کارت ملی شما مورد تایید نمی باشد'}}</span>
                            </div>
                        </div>
                    </div>
                @elseif($user->national_card_file_status==null)
                    <div class="bg-gray-600 border border-gray-300 shadow-lg  rounded-3xl p-4 m-4">
                        <div class="flex justify-between p-2">
                            <div class="flex justify-center items-center text-gray-200">
                                <i class="fa-solid fa-warning px-3"></i>
                                <span class="px-4">{{$user->authorize_file_text??'هنوز احراز کارت ملی را انجام ندادید'}}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{route('user.activate')}}" method="POST" enctype="multipart/form-data" class="mt-8">
                    @csrf
                        <div class="w-full px-3">
                            <div class="mb-5">
                                <label
                                    for="full_name"
                                    class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                 >
                                  نام و نام خانوادگی
                                    <span class="text-[red!important]">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="full_name"
                                    id="full_name"
                                    placeholder="نام و نام خانوادگی"
                                    value="{{$user->full_name}}"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                />
                            </div>
                        </div>
                    <div class="w-full px-3">
                        <div class="mb-5">
                            <label
                                for="father_name"
                                class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                            >
                                نام پدر
                                <span class="text-[red!important]">*</span>
                            </label>
                            <input
                                type="text"
                                name="father_name"
                                id="father_name"
                                placeholder="نام پدر"
                                value="{{$user->father_name}}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                            />
                        </div>
                    </div>
                        <div class="w-full px-3">
                            <div class="mb-5">
                                <label
                                    for="mobile"
                                    class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                >
                                   موبایل
                                    <span class="text-[red!important]">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="mobile"
                                    id="mobile"
                                    placeholder="موبایل"
                                    value="{{$user->mobile}}"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                />
                            </div>
                        </div>
                        <div class="w-full px-3">
                            <div class="mb-5">
                                <label
                                    for="national_code"
                                    class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                >
                                    کد ملی
                                    <span class="text-[red!important]">*</span>
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
                        <div class="w-full px-3">
                            <div class="mb-5">
                                <label
                                    for="birthday"
                                    class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                >
                                    تاریخ تولد
                                    <span class="text-[red!important]">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="birthday"
                                    id="birthday"
                                    placeholder="تاریخ تولد"
                                    maxlength="10"
                                    value="{{$user->birthday?verta()->parse($user->birthday)->format('Y-m-d'):''}}"
                                    class="w-full datepicker rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                />
                            </div>
                        </div>
                    <div class="w-full px-3">
                        <div class="mb-5">
                            <label
                                for="gender"
                                class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                            >
                                جنسیت
                                <span class="text-[red!important]">*</span>
                            </label>
                            <select name="gender" id="gender" class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option value="" @if($user->gender==null) selected @endif>انتخاب جنسیت</option>
                                <option value="male" @if($user->gender=='male') selected @endif>آقا</option>
                                <option value="female" @if($user->gender=='female') selected @endif>خانم</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full px-3">
                        <div class="mb-5">
                            <label
                                for="address"
                                class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                            >
                                آدرس
                            </label>
                            <input
                                type="text"
                                name="address"
                                id="address"
                                placeholder="آدرس"
                                maxlength="120"
                                value="{{$user->address}}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                            />
                        </div>
                    </div>
                        <div class="w-full px-3">
                            <div class="mb-5">
                                    <label class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium">
                                        عکس احراز هویت طبق تصویر روبرو
                                        <span class="text-[red!important]">*</span>
                                    </label>
                                <input type="file" name="authorize_file"  id="authorize_file" class="px-3 m-2" >
                                <h4 class="text-gray-700 dark:text-gray-200">حداکثر فایل 15 مگابایت , پسوندهای مجاز فایل شامل png , jpg , webp , jpeg , svg می باشد.</h4>
                                <div class="w-full flex justify-center text-center mx-auto">
                                    <img id="authorize_file_id" src="{{$user->authorizeFile?route('private.image.show', ['filename' => str_replace('verifies/','',$user->authorizeFile->path)]):'#'}}" height="200" width="300" alt="" class="rounded shadow-full  @if(!$user->authorize_file_id) hidden @endif ">
                                </div>
                            </div>
                        </div>
                        <div class="w-full px-3">
                            <div class="mb-5">
                                    <label class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium">
                                        عکس کارت ملی
                                        <span class="text-[red!important]">*</span>
                                    </label>
                                    <input type="file" name="national_card_file"  id="national_card_file" class="px-3 m-2" >
                                <h4 class="text-gray-700 dark:text-gray-200">حداکثر فایل 15 مگابایت , پسوندهای مجاز فایل شامل png , jpg , webp , jpeg , svg می باشد.</h4>
                                <div class="w-full flex justify-center text-center mx-auto">
                                        <img id="national_card_file_id" src="{{$user->nationalCardFile?route('private.image.show', ['filename' => str_replace('verifies/','',$user->nationalCardFile->path)]):'#'}}"  height="200" width="300" alt="" class="rounded shadow @if(!$user->national_card_file_id) hidden @endif ">
                                    </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="w-full block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">ثبت اطلاعات احراز هویت</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        $("#authorize_file").change(function (e) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#authorize_file_id').attr('src', e.target.result);
                    $('#authorize_file_id').removeClass('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        $("#national_card_file").change(function (e) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#national_card_file_id').attr('src', e.target.result);
                    $('#national_card_file_id').removeClass('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endsection
