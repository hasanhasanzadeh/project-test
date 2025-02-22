@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semi bold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('sliders.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            <span>اسلایدرها</span>
        </a>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <div class="w-full overflow-x-auto">
                <form class="w-full" method="post" action="{{route('sliders.update',$slider->id)}}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                    <input type="hidden" name="id" value="{{$slider->id}}">
                    <div class="flex flex-wrap mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="title">
                                {{__('dashboard.title')}}
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="title" name="title" type="text" value="{{$slider->title}}" placeholder="{{__('dashboard.enterTitle')}}">
                        </div>
                        <div class="w-full md:w-1/2 px-3  my-3">
                            <label for="status" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.status')}}</label>
                            <select name="status" id="status" class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="1" @if($slider->status) selected @endif>{{__('dashboard.active')}}</option>
                                <option value="0" @if(!$slider->status) selected @endif>{{__('dashboard.inactive')}}</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="url">
                                {{__('dashboard.url')}}
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="url" name="url" type="url" value="{{$slider->url}}" placeholder="{{__('dashboard.url')}}">
                        </div>
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label class="flex justify-between uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="image">
                               <span> عکس با سایز</span>
                                <span dir="ltr"> 1400 * 350 px</span>
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="image" name="image" type="file" placeholder="{{__('dashboard.photo_select')}}">
                            <img id="image-select" alt="" src="{{$slider->photo->address}}" class="object-cover shadow rounded" width="150" height="150">
                        </div>
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label class="flex justify-between uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">
                                <span>عکس با سایز</span>
                                <span dir="ltr"> 450 * 170 px</span>
                            </label>
                            <input type="file" name="photo"  id="photo_id" class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" >
                            <img id="photo-select" @if($slider->image_id) src="{{$slider->image->address}}" @endif height="150" width="150" alt="" class="object-cover shadow rounded">
                        </div>
                        <div class="w-full px-3  my-3">
                            <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.description')}} </label>
                            <textarea name="description" class="form-textarea appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="{{__('dashboard.enterDescription')}}" id="description" cols="30" rows="4">{{$slider->description}}</textarea>
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
    <script >
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
        $("#photo_id").change(function (e) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#photo-select').attr('src', e.target.result);
                    $('#photo-select').removeClass('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>

@endsection
