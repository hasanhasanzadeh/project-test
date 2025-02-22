@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <div class="w-full overflow-x-auto">
                @php $row=0;@endphp
                @if(!$panels->isEmpty())
                    <table class="w-full order">
                        <thead>
                        <tr class="text-sm font-bold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                            <th class="px-4 py-3">{{__('dashboard.row')}}</th>
                            <th class="px-4 py-3">@sortablelink('title', __('dashboard.title'))</th>
                            <th class="px-4 py-3">{{__('dashboard.logo')}}</th>
                            <th class="px-4 py-3">{{__('dashboard.favicon')}}</th>
                            <th class="px-4 py-3">@sortablelink('created_at', __('dashboard.created_at'))</th>
                            <th class="px-4 py-3">{{__('dashboard.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                        @foreach($panels as $panel)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{++$row}}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{$panel->title}}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($panel->logo_id)
                                        <img src="{{$panel->logo->address}}"  height="90" width="90" alt="" class="rounded-full w-12 h-12 mx-auto">
                                    @else
                                        <img src="{{url('/images/no-image.png')}}" height="90" width="90" alt="" class="rounded-full w-12 h-12 mx-auto">
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @if($panel->favicon_id)
                                        <img src="{{$panel->favicon->address}}"  height="90" width="90" alt="" class="rounded-full w-12 h-12 mx-auto">
                                    @else
                                        <img src="{{url('/images/no-image.png')}}" height="90" width="90" alt="" class="rounded-full w-12 h-12 mx-auto">
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if(config('app.locale')=='fa')
                                    {{verta()->instance($panel->created_at)->format('%d %B %Y')}}
                                    @else
                                        {{ date('d-M-y', strtotime($panel->created_at))}}
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-xl flex justify-center items-center">
                                    <a href="{{route('settings.show',$panel->id)}}" class="text-blue-500 mx-auto" title="{{__('dashboard.show')}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{route('settings.edit',$panel->id)}}" class="text-yellow-400 mx-auto" title="{{__('dashboard.edit')}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-4xl text-center text-gray-700 dark:text-gray-100">
                        {{__('dashboard.showEmpty')}}
                        <h2 class="text-center py-3 text-6xl">
                            <i class="far fa-grin-alt"></i>
                        </h2>
                    </div>
                @endif
            </div>
            @if(!$panels->isEmpty())
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                  {{__('dashboard.number')}}  {{$panels->count()}}
                </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center px-4" dir="ltr">
                        {!! $panels->appends(Request::except('page'))->render() !!}
                    </ul>
                  </nav>
                </span>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('.show_confirm').click(function(e) {
            if(!confirm('{{__('dashboard.delete')}}')) {
                e.preventDefault();
            }
        });
    </script>
@endsection
