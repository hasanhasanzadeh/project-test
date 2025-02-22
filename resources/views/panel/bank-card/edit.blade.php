@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semi bold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('bank-cards.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            <span>حساب های بانکی</span>
        </a>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <div class="w-full overflow-x-auto">
                <form class="w-full" method="post" action="{{route('bank-cards.update',$bankCard->id)}}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                    <input type="hidden" value="{{$bankCard->id}}" name="id">
                    <div class="flex flex-wrap mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3  my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="bank_id">
                                {{__('dashboard.bank')}}
                            </label>
                            <select name="bank_id" dir="ltr" id="bank_id" class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" >
                                <option value="{{$bankCard->bank_id}}">{{$bankCard->bank->name}}</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/2 px-3  my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="card_number">
                                {{__('dashboard.card_number')}}
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="card_number" name="card_number" type="text" value="{{$bankCard->card_number}}" placeholder="{{__('dashboard.card_number')}}">
                        </div>
                        <div class="w-full md:w-1/2 px-3  my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="card_shaba">
                                {{__('dashboard.card_shaba')}}
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="card_shaba" name="card_shaba" type="text" value="{{$bankCard->card_shaba}}" placeholder="{{__('dashboard.card_shaba')}}">
                        </div>
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label for="status" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50">{{__('dashboard.status')}}</label>
                            <select name="status" id="status" class="form-select appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="active" @if($bankCard->status=='active') selected @endif>{{__('dashboard.active')}}</option>
                                <option value="inactive" @if($bankCard->status=='inactive') selected @endif>{{__('dashboard.inactive')}}</option>
                                <option value="pending" @if($bankCard->status=='pending') selected @endif>{{__('dashboard.pending')}}</option>
                            </select>
                        </div>
                        <div class="w-full px-3 my-3">
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
