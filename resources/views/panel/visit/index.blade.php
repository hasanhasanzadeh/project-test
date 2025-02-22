@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <div class="w-full">
            <form method="get" class="grid w-full">
                <div class="flex items-center text-center">
                    <div class="px-2 mx-2 flex items-center text-center">
                        <label for="visited_at" class="dark:text-gray-200 text-gray-700 px-2 text-nowrap">انتخاب نوع فیلتر :</label>
                        <select id="visited_at" name="visited_at" class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" @if(request('visited_at')=='') selected @endif>انتخاب همه</option>
                            <option value="today" @if(request('visited_at')=='today') selected @endif>بازدید امروز</option>
                            <option value="weekly" @if(request('visited_at')=='weekly') selected @endif>بازدید این هفته</option>
                            <option value="monthly" @if(request('visited_at')=='monthly') selected @endif>بازدید این ماه</option>
                            <option value="yearly" @if(request('visited_at')=='yearly') selected @endif>بازدید امسال</option>
                        </select>
                    </div>
                    <div class="px-2 mx-2">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">
                            <i class="fa fa-filter"></i>
                            فیلتر
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <div class="w-full overflow-x-auto">
                @php $row=0;@endphp
                @if(!$visits->isEmpty())
                    <table class="w-full  order">
                        <thead>
                        <tr class="text-sm font-bold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                            <th class="px-4 py-3">{{__('dashboard.row')}}</th>
                            <th class="px-4 py-3">@sortablelink('ip_address', __('dashboard.ip_address'))</th>
                            <th class="px-4 py-3">@sortablelink('score', 'تعداد بازدید')</th>
                            <th class="px-4 py-3">@sortablelink('created_at', __('dashboard.created_at'))</th>
                            <th class="px-4 py-3">{{__('dashboard.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                        @foreach($visits as $visit)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{++$row}}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    {{$visit->ip_address}}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                        {{$visit->score}}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if(config('app.locale')=='fa')
                                        {{verta()->instance($visit->created_at)->format('%d %B %Y')}}
                                    @else
                                        {{ date('d-M-y', strtotime($visit->created_at))}}
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-xl flex justify-center items-center">
                                        <form action="{{route('visits.destroy',$visit->id)}}" class="mx-auto" method="POST">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button class="text-red-600 show_confirm" name="delete" onclick="confirmSubmit()" type="submit" title="{{__('dashboard.delete')}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-4xl text-center text-gray-700 dark:text-gray-100">
                        {{__('dashboard.showEmpty')}}
                        <h2 class="text-center py-3 " id="smill">
                            <i class="far fa-grin-alt fa-3x"></i>
                        </h2>
                    </div>
                @endif
            </div>
            @if(!$visits->isEmpty())
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                  {{__('dashboard.number')}}  {{$visits->count()}}
                </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center px-4" >
                        {!! $visits->appends(Request::except('page'))->render() !!}
                    </ul>
                  </nav>
                </span>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script src="{{url('/plugin/ckeditor/ckeditor.js')}}"></script>
    <script>
        $('.show_confirm').click(function(e) {
            if(!confirm('{{__('dashboard.areSureDelete')}}')) {
                e.preventDefault();
            }
        });
    </script>
@endsection
