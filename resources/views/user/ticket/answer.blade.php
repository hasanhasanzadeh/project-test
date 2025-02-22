@extends('user.layouts.app_user')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <div class="flex justify-between gap-4">
           <div>
               <a href="{{route('ticket.index')}}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
                   <i class="fa fa-list"></i>
                   تیکت ها
               </a>
           </div>
            @if($ticket->status!='closed')
               <div>
                   <a href="{{route('ticket.close',$ticket->id)}}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-auto">
                       <i class="fa fa-close"></i>
                       بستن تیکت
                   </a>
               </div>
            @endif
        </div>
        <div class="w-full shadow-lg rounded bg-blue-600 text-white my-4">
            <div x-data="accordion(1)" class="relative transition-all duration-700">
                <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="tracking-wide">
                            <i class="fa fa-pencil"></i>
                            <span class="px-3">پاسخ</span>
                        </span>
                        <span :class="handleRotate()" class="transition-transform duration-500 transform fill-current ">
                <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
                </span>
                    </div>
                </div>

                <div x-ref="tab" :style="handleToggle()" class="relative overflow-hidden transition-all duration-700 max-h-0 bg-gray-100 dark:bg-gray-700">
                    <div class="px-6 pb-4 text-gray-700 dark:text-gray-200">
                        <div class="w-full p-8">
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
                                            disabled
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        />
                                    </div>
                                </div>
                                <div class="w-full px-3 sm:w-1/2">
                                    <div class="mb-5">
                                        <label for="full_name" class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium">
                                            ایمیل
                                        </label>
                                        <input
                                            type="text"
                                            name="email"
                                            id="email"
                                            value="{{$user->email}}"
                                            placeholder="ایمیل"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="post" class="p-2 m-2 md:p-5 md:m-5" action="{{route('ticket.answer',$ticket->id)}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                            <div class="flex flex-wrap mx-3 mb-6">
                                <div class="w-full px-3  my-3">
                                    <label for="description" class="block  tracking-wide dark:text-gray-200 text-gray-700 text-xs font-bold mb-2">پیام</label>
                                    <textarea name="description" class="form-textarea appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="متن پاسخ تیکت را وارد کنید" id="description" rows="7">{{old('description')}}</textarea>
                                </div>
                                <div class="w-full px-3  my-3">
                                    <label for="file" class="block  tracking-wide dark:text-gray-200 text-gray-700 text-xs font-bold mb-2">فایل ضمیمه</label>
                                    <input type="file" name="attach" class="form-textarea appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="فایل ضمیمه" id="file">
                                    <span class="text-gray-700 dark:text-gray-200">حداکثر فایل ۲ مگابات , پسوندهای مجاز فایل شامل png , jpeg , jpg , gif , rar , zip می باشد.</span>
                                </div>
                                <div class="w-full px-3  my-3">
                                    <button type="submit" class="d-block bg-blue-600 hover:bg-blue-700 text-gray-200 font-bold py-2 px-4 rounded">
                                        <i class="fa fa-save"></i>
                                        ثبت
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!$ticket->answers->isEmpty())
            @foreach($ticket->answers as $answer)
                <div class="w-full ">
                    <div class="full flex justify-between px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded-t mt-4">
                        <div class="flex justify-center items-center text-gray-700 dark:text-gray-200">
                            <div>
                                <img src="{{$answer->user->avatar->address??asset('/images/user/avatar-profile.png')}}" width="90" height="90" class="rounded-full w-12 h-12 shadow" alt="">
                            </div>
                            <div class="px-2 mx-2 text-center">
                                <span class="block">{{$answer->user->full_name??'کاربر'}}</span>
                                <span class="block">
                                    @if($answer->user_id!=$user->id)
                                        <span>کارمند</span>
                                    @else
                                        <span>کاربر</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div>
                            <span>{{verta($answer->created_at)->format('Y-m-d ( H:i )')}}</span>
                        </div>
                    </div>
                    <div class="text-justify dark:text-gray-100 text-gray-700 bg-gray-200 dark:bg-gray-600 rounded-b mb-8 p-4">
                        <p class="text-justify">
                            {!! $answer->description !!}
                        </p>
                        <div class="dark:text-gray-100 text-gray-700">
                            @if($answer->attach)
                                <h6 class="text-left ">
                                    <span>دانلود فایل ضمیمه :</span>
                                    <a href="{{$answer->attach->address}}" class="px-2 mx-auto" title="دانلود فایل ضمیمه">
                                        <i class="fa fa-download text-blue-600 hover:text-blue-700 text-2xl"></i>
                                    </a>
                                </h6>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="w-full">
            <div class="full flex justify-between px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded-t mt-4">
                <div class="flex justify-center items-center text-gray-600 dark:text-gray-200">
                    <div>
                        <img src="{{$ticket->user->avatar->address??asset('/images/user/avatar-profile.png')}}" width="90" height="90" class="rounded-full w-12 h-12 shadow" alt="">
                    </div>
                    <div class="px-2 mx-2 text-center">
                        <span class="block">{{$ticket->user->full_name??'کاربر'}}</span>
                        <span class="block">کاربر </span>
                    </div>
                </div>
                <div>
                    <span>{{verta($ticket->created_at)->format('Y-m-d ( H:i )')}}</span>
                </div>
            </div>
            <div class="text-justify dark:text-gray-100 text-gray-600 bg-gray-200 dark:bg-gray-600 mb-8 rounded-b p-4">
                <p class="text-justify">
                    {!! $ticket->description !!}
                </p>
                <div class="dark:text-gray-100 text-gray-600">
                @if($ticket->attach)
                    <h6 class="text-left ">
                        <span>دانلود فایل ضمیمه :</span>
                        <a href="{{$ticket->attach->address}}" class="px-2 mx-auto" title="دانلود فایل ضمیمه">
                            <i class="fa fa-download text-blue-600 hover:text-blue-700 text-2xl"></i>
                        </a>
                    </h6>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{url('/plugin/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('description',{
            customConfig: 'config.js',
            toolbar: 'simple',
            language: '{{Config::get('app.locale')}}',
            removePlugins: 'cloudservices, easyimage',
            filebrowserImageUploadUrl: "{{url('/')}}"+'/panel/upload-image?type=Images&_token=' + $('meta[name="csrf-token"]').attr('content'),
            filebrowserUploadMethod: 'form',
            filebrowserUploadUrl:"{{url('/')}}"+'/panel/upload-image?type=Images&_token=' + $('meta[name="csrf-token"]').attr('content'),
            filebrowserImage2BrowseUrl:"{{url('/')}}"+'/panel/upload-image?type=Images&_token=' + $('meta[name="csrf-token"]').attr('content'),
            filebrowserImageBrowseUrl: "{{url('/')}}"+'/panel/upload-image?type=Images&_token=' + $('meta[name="csrf-token"]').attr('content'),
            filebrowserBrowseUrl: "{{url('/')}}"+'/panel/upload-image?type=Files&_token=' + $('meta[name="csrf-token"]').attr('content'),
        });
        document.addEventListener("alpine:init", () => {
            Alpine.store("accordion", {
                tab: 0
            });

            Alpine.data("accordion", (idx) => ({
                init() {
                    this.idx = idx;
                },
                idx: -1,
                handleClick() {
                    this.$store.accordion.tab =
                        this.$store.accordion.tab === this.idx ? 0 : this.idx;
                },
                handleRotate() {
                    return this.$store.accordion.tab === this.idx ? "-rotate-180" : "";
                },
                handleToggle() {
                    return this.$store.accordion.tab === this.idx
                        ? `max-height: ${this.$refs.tab.scrollHeight}px`
                        : "";
                }
            }));
        });
    </script>
@endsection
