@extends('user.layouts.app_user')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('ticket.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            تیکت ها
        </a>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs" >
            <div class="mx-auto w-full">
                <form action="{{route('ticket.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3">
                            <div class="mb-5">
                                <label for="subject" class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium">
                                    موضوع تیکت
                                </label>
                                <input
                                    type="text"
                                    name="subject"
                                    id="subject"
                                    value="{{old('subject')}}"
                                    placeholder="موضوع تیکت"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                />
                            </div>
                        </div>
                        <div class="w-full px-3">
                            <div class="mb-5">
                                <label for="description" class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium">
                                    توضیحات
                                </label>
                                <textarea
                                    type="text"
                                    name="description"
                                    id="description"
                                    placeholder="توضیحات"
                                    rows="7"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                >{!! old('description') !!}</textarea>
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/4">
                            <div class="mb-5">
                                <label
                                    for="section"
                                    class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                >
                                    بخش
                                </label>
                                <select name="section" id="section" class="w-full pr-7 rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md" >
                                    <option value="technical_unit" selected>واحد فنی</option>
                                    <option value="financial_unit">واحد مالی</option>
                                    <option value="management_unit">واحد مدیریت</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/4">
                            <div class="mb-5">
                                <label
                                    for="importance"
                                    class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                >
                                    اهمیت
                                </label>
                                <select name="importance" id="importance" class="w-full pr-7 rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md" >
                                    <option value="ordinary" selected>معمولی</option>
                                    <option value="important">مهم</option>
                                    <option value="necessary">ضروری</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="file" class="block  tracking-wide dark:text-gray-200 text-gray-700 text-xs font-bold mb-2">فایل ضمیمه</label>
                                <input type="file" name="attach" class="w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="فایل ضمیمه" id="file">
                                <span class="text-gray-700 dark:text-gray-200">حداکثر فایل ۲ مگابات , پسوندهای مجاز فایل شامل png , jpeg , jpg , gif , rar , zip می باشد.</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="hover:shadow-form rounded-md bg-blue-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            ارسال
                        </button>
                    </div>
                </form>
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
</script>
@endsection
