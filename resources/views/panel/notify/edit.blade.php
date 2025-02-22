@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semi bold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('notifies.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            {{__('dashboard.notifies')}}
        </a>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <div class="w-full overflow-x-auto">
                <form class="w-full" method="post" action="{{route('notifies.update',$notify->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{$notify->id}}">
                    <div class="flex flex-wrap mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="title">
                                {{__('dashboard.title')}}
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="title" name="title" type="text" value="{{$notify->title}}" placeholder="{{__('dashboard.enterTitle')}}">
                        </div>
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="expired_at">
                                {{__('dashboard.expired_at')}}
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="expired_at" name="expired_at" type="date" value="{{$notify->expired_at?\Carbon\Carbon::parse($notify->expired_at)->format('Y-m-d'):''}}" placeholder="{{__('dashboard.expired_at')}}">
                        </div>
                        <div class="w-full md:w-1/2 px-3  my-3">
                            <label for="status" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.status')}}</label>
                            <select name="status" id="status" class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="1" @if($notify->status) selected @endif>{{__('dashboard.active')}}</option>
                                <option value="0" @if(!$notify->status) selected @endif>{{__('dashboard.inactive')}}</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/2 px-3  my-3">
                            <label for="type" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.type')}}</label>
                            <select name="type" id="type" class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="all" @if($notify->type=='all') selected @endif>{{__('dashboard.all')}}</option>
                                <option value="some" @if($notify->type='some') selected @endif>{{__('dashboard.some')}}</option>
                            </select>
                        </div>
                        <div class="w-full px-3  my-3">
                            <label for="users" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.type')}}</label>
                            <select name="users[]" multiple id="users" class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                @if($notify->users)
                                    @foreach($notify->users as $user)
                                        <option value="{{$user->id}}" selected>{{$user->full_name.' , '.$user->mobile}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="w-full px-3  my-3">
                            <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.description')}} </label>
                            <textarea name="description" class="form-textarea appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="{{__('dashboard.enterDescription')}}" id="description" cols="30" rows="10" >{!!$notify->description!!}</textarea>
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
        })
        $('#users').select2({
            placeholder: '{{__('dashboard.customer')}}',
            ajax: {
                url: '{{route('customers.search')}}',
                dataType: 'json',
                delay: 220,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (data) {
                            return {
                                text:' '+data.full_name+' , '+data.mobile,
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

