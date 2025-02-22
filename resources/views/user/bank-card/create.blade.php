@extends('user.layouts.app_user')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semi bold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('cards.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            <span>حساب های بانکی</span>
        </a>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <div class="w-full overflow-x-auto">
                <form class="w-full" method="post" action="{{route('cards.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3  my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="bank">
                                انتخاب بانک
                            </label>
                            <select name="bank_id" id="bank" class="appearance-none pr-9 block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" >
                                <option value="" selected>بانک خود را انتخاب کنید</option>
                                @foreach(App\Models\Bank::with('photo')->get() as $bank)
                                    <option value="{{$bank->id}}" >{{$bank->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:w-1/2 px-3  my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="card_number">
                                {{__('dashboard.card_number')}}
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="card_number" name="card_number" type="text" value="{{old('card_number')}}" maxlength="16" placeholder="{{__('dashboard.card_number')}}">
                        </div>
                        <div class="w-full md:w-1/2 px-3  my-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="card_shaba">
                                {{__('dashboard.card_shaba')}}
                            </label>
                            <input oninput="addPrefix()" class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="card_shaba" name="card_shaba" type="text" value="{{old('card_shaba')}}" maxlength="26" placeholder="{{__('dashboard.card_shaba')}}">
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
@section('script')
    <script>
        $('#bank_id').select2({
            tags : true ,
            placeholder: 'بانک را انتخاب کنید',
            ajax: {
                url: '{{route('bank.search')}}',
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
