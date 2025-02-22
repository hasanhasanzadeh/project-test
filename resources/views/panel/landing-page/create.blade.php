@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semi bold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('landing-pages.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            طلاعات صفحه لندینگ
        </a>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <div class="w-full overflow-x-auto">
                <form class="w-full" method="post" action="{{route('landing-pages.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="title">
                                {{__('dashboard.title')}}
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="title" name="title" type="text" value="{{old('title')}}" placeholder="{{__('dashboard.enterTitle')}}">
                        </div>
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="landing_number">
                                {{__('dashboard.landing_number')}}
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="landing_number" name="landing_number" type="number" value="{{old('landing_number')}}" placeholder="{{__('dashboard.landing_number')}}">
                        </div>
                        <div class="w-full  md:w-1/2 px-3  my-3">
                            <label for="status" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.status')}}</label>
                            <select name="status" id="status" class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="1" selected>{{__('dashboard.active')}}</option>
                                <option value="0">{{__('dashboard.inactive')}}</option>
                            </select>
                        </div>
                        <div class="w-full  md:w-1/2 px-3  my-3">
                            <label for="type" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.type')}}</label>
                            <select name="type" id="type" class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="" selected>انتخاب کنید</option>
                                <option value="top" >بالا</option>
                                <option value="bottom">پایین</option>
                                <option value="base">اصل و اساس</option>
                                <option value="attribute">ویژگی</option>
                                <option value="introduction">معرفی</option>
                            </select>
                        </div>
                        <div class="w-full px-3  my-3">
                            <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.description')}} </label>
                            <textarea name="description" class="form-textarea appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="{{__('dashboard.enterDescription')}}" id="description" cols="30" rows="10" >{!!old('description')!!}</textarea>
                        </div>
                        <div class="w-full px-3 my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="image">
                                {{__('dashboard.photo_select')}}
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="image" name="image" type="file" placeholder=" عکس را انتخاب کنید">
                            <img src="" id="image-select" alt="" class="object-cover shadow rounded hidden" width="150" height="150">
                        </div>
                        <div class="w-full px-3  my-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
    <script src="{{url('/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/plugin/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
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
        })
         $("#title").keyup(function() {
             let title=$('#title').val();
             $.ajax({
                 type: 'POST',
                 url: "{{route('make.slug')}}",
                 data: {
                     '_token':"{{csrf_token()}}",
                     'title':title
                 },
                 success: function(res){
                     $("#slug").val(res);
                 }, error: function(){
                     console.log('error for slug make')
                 }
             });

         });
         $("#image").change(function (e) {
             if (this.files && this.files[0]) {
                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $('#image-select').attr('src', e.target.result);
                     $('#image-select').removeClass('hidden');
                 }
                 reader.readAsDataURL(this.files[0]);
             }
         });
    </script>

@endsection

