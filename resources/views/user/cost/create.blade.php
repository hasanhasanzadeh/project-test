@extends('user.layouts.app_user')

@section('content')
    <div class="w-full mx-auto z-10">
        <div class="flex flex-col">
            <div class="dark:bg-gray-700 border dark:border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                <div class="flex-none sm:flex gap-4">
                    <div class=" relative h-32 w-32  sm:mb-0 mb-3">
                        @if(auth()->user()->avatar)
                            <img src="{{auth()->user()->avatar->address}}" alt="{{auth()->user()->name}}" class=" w-32 h-32 object-cover rounded-2xl">
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
                                        {{auth()->user()->name}}
                                    </div>
                                    <div class="flex-auto m-1 dark:text-gray-200 text-gray-800">
                                            <span class="ml-3">
                                                {{auth()->user()->mobile}}
                                            </span>
                                        <span class="ml-3 border-r border-gray-600  max-h-0 dark:text-gray-200 text-gray-800"></span><span>{{auth()->user()->national_code}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row items-center">
                            <div class="flex mr-2">
                                <i class="fa-regular fa-star text-blue-400 fa-xl py-2 px-1"></i>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full mx-auto z-10">
        <div class="flex flex-col">
            <div class="bg-green-600 border border-green-700 shadow-lg  rounded-3xl p-4 m-4">
                <div class="flex-none sm:flex gap-4">
                    <p class="text-gray-200 text-justify text-xl">
                        درخواست پرداخت خود را انجام دهید
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full mx-auto z-10">
        <div class="flex flex-col">
            <div class="dark:bg-gray-700 border dark:border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                <!-- component -->
                <div class="flex items-center justify-center p-12">
                    <div class="mx-auto w-full">
                        <form action="{{route('payments.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="-mx-3 flex flex-wrap">
                                <div class="w-full px-3">
                                    <div class="mb-5">
                                        <label for="description" class="flex justify-between mb-3 dark:text-gray-200 text-gray-800 text-base font-medium">
                                            <span>
                                                توضیحات
                                            </span>
                                        </label>

                                        <textarea
                                            name="description"
                                            id="description"
                                            placeholder="توضیحات را وارد کنید"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        ></textarea>
                                    </div>
                                </div>
                                <div class="w-full Customize Toolbar… px-3">
                                    <div class="mb-5">
                                        <label for="amount" class="flex justify-between mb-3 dark:text-gray-200 text-gray-800 text-base font-medium">
                                            <span>
                                                مبلغ پرداخت
                                            (مبلغ را به تومان وارد کنید)
                                            </span>
                                            <span class="amount font-bold mb-2 dark:text-gray-50"></span>
                                        </label>

                                        <input
                                            type="text"
                                            name="amount"
                                            id="amount"
                                            min="1000"
                                            maxlength="8"
                                            placeholder="مبلغ پرداخت را وارد کنید"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        />
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="card_shaba">
                                        {{__('dashboard.card_shaba')}}
                                    </label>
                                    <input oninput="addPrefix()" class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md" id="card_shaba" name="shaba" type="text" value="{{old('shaba')}}" maxlength="26" placeholder="{{__('dashboard.card_shaba')}}">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <div class="mb-5">
                                        <label for="category" class="flex justify-between mb-3 dark:text-gray-200 text-gray-800 text-base font-medium">
                                            <span>
                                               انتخاب هزینه کرد ها
                                            </span>
                                        </label>
                                        <select name="category_id" id="category_id" class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-3 my-5">
                                <div class="mb-5">
                                    <label class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium">
                                        عکس ضمیمه
                                        <span class="text-[red!important]">*</span>
                                    </label>
                                    <input type="file" name="cost_file"  id="cost_file" class="px-3 m-2" >
                                    <h4 class="text-gray-700 dark:text-gray-200">حداکثر فایل 15 مگابایت , پسوندهای مجاز فایل شامل png , jpg , webp , jpeg , svg می باشد.</h4>
                                    <div class="w-full flex justify-center text-center mx-auto">
                                        <img id="cost_file_id" src="{{$user->costFile?route('private.image.show', ['filename' => str_replace('verifies/','',$user->costFile->path)]):'#'}}" height="200" width="300" alt="" class="rounded shadow-full  @if(!$user->cost_file_id) hidden @endif ">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="hover:shadow-form rounded-md bg-blue-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                    درخواست پرداخت
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
    <script src="{{url('/js/numtopersian.min.js')}}"></script>
    <script>
        $("#cost_file").change(function (e) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#cost_file_id').attr('src', e.target.result);
                    $('#cost_file_id').removeClass('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        $('body').on('keyup', '#amount', function() {
            let price=Num2persian($(this).val())+" تومان ";
            $('.amount').html(price);
        });
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
        $('#category_id').select2({
            tags : true ,
            placeholder: 'دسته هزینه کرد ها را انتخاب کنید',
            ajax: {
                url: '{{route('category.search')}}',
                dataType: 'json',
                delay: 220,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (data) {
                            return {
                                text: data.name,
                                id: data.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        function addPrefix() {
            const input = document.getElementById("card_shaba");
            const prefix = "IR";

            // Check if input value already starts with the prefix
            if (!input.value.startsWith(prefix)) {
                input.value = prefix + input.value;
            }
        }
    </script>
@endsection
