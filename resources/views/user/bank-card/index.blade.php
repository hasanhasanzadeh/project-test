@extends('user.layouts.app_user')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('cards.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-add"></i>
            <span>حساب های بانکی</span>
        </a>
        <div class="w-full mx-auto z-10">
            <div class="flex flex-col">
                <div class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 my-4">
                        <div class="flex justify-center items-center dark:text-gray-200 text-gray-800">
                            <i class="fa-solid fa-circle-info fa-xl px-1"></i>
                            <span class="px-1">لطفا قبل از ثبت حساب های بانکی احراز هویت خود را انجام دهید!</span>
                        </div>
                </div>
            </div>
        </div>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <div class="w-full overflow-x-auto">
                @php $row=0;@endphp
                @if(!$bankCards->isEmpty())
                    <table class="w-full  order">
                        <thead>
                        <tr class="text-sm font-bold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                            <th class="px-4 py-3">{{__('dashboard.row')}}</th>
                            <th class="px-4 py-3">{{__('dashboard.bank')}}</th>
                            <th class="px-4 py-3">@sortablelink('card_number', __('dashboard.card_number'))</th>
                            <th class="px-4 py-3">@sortablelink('card_shaba', __('dashboard.card_shaba'))</th>
                            <th class="px-4 py-3">@sortablelink('status', __('dashboard.status'))</th>
                            <th class="px-4 py-3">@sortablelink('created_at', __('dashboard.created_at'))</th>
                            <th class="px-4 py-3">{{__('dashboard.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                        @foreach($bankCards as $bankCard)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{++$row}}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @if($bankCard->bank_id)
                                        <img src="{{$bankCard->bank->photo->address??''}}"  height="140" width="100" alt="" class="image-grayscale mx-auto">
                                    @else
                                        <img src="{{asset('/images/no-image.png')}}"  height="140" width="100" alt="" class="image-grayscale mx-auto">
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    {{$bankCard->card_number}}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    {{$bankCard->card_shaba}}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @if($bankCard->status=='active')
                                        <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.active')}}
                                        </span>
                                    @elseif($bankCard->status=='inactive')
                                        <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.inactive')}}
                                        </span>
                                    @elseif($bankCard->status=='pending')
                                        <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.pending')}}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                        {{verta()->instance($bankCard->created_at)}}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-xl flex justify-center items-center">
                                    <a href="{{route('cards.show',$bankCard->id)}}" class="text-blue-500 mx-auto" title="{{__('dashboard.show')}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                        <form action="{{route('cards.destroy',$bankCard->id)}}" class="mx-auto" method="POST">
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
            @if(!$bankCards->isEmpty())
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                  {{__('dashboard.number')}}  {{$bankCards->count()}}
                </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center px-4" >
                        {!! $bankCards->appends(Request::except('page'))->render() !!}
                    </ul>
                  </nav>
                </span>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.show_confirm').click(function(e) {
            if(!confirm('{{__('dashboard.areSureDelete')}}')) {
                e.preventDefault();
            }
        });
    </script>
@endsection
