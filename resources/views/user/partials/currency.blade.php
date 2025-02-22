@foreach($prices as $price)
        <div class="shadow bg-gray-200 dark:bg-gray-700 rounded border dark:text-gray-200">
            <div class="flex justify-center">

                <div class="p-2 m-4 text-center">
                    <h3 class="dark:text-gray-200 text-gray-700 p-2">{{$price->currency->dispaly_name}}</h3>
                    <h3 class="dark:text-gray-200 text-gray-700 p-2">{{$price->currency->base_currency}}</h3>
                    <img src="{{$price->currency->photo->address??asset('images/no-image.png')}}" class="h-40 w-40 rounded shadow object-cover mx-auto" alt="{{$price->currency->name}}">
                    <div>
                        <h4 class="py-2">
                            <span>{{$price->price .' دلار '}}</span>
                        </h4>
                        <h4 class="py-2">
                            <span>{{number_format($price->usdt,0) .'  تومان'}}</span>
                        </h4>
                    </div>
                </div>

            </div>
            <div class="p-2 text-center ">
                <a href="#" class="w-full block text-center m-1 mx-auto bg-green-300 hover:bg-green-400 text-green-600 font-bold p-2 rounded">
                    <span>واریز</span>
                </a>
                <a href="#" class="w-full block text-center m-1 mx-auto bg-red-300 hover:bg-red-400 text-red-600 font-bold p-2 rounded">
                    <span>برداشت</span>
                </a>
                <a href="#" class="w-full block text-center m-1 mx-auto bg-red-300 hover:bg-red-400 text-red-600 font-bold p-2 rounded">
                    <span>فروش</span>
                </a>
                <a href="#" class="w-full block text-center m-1 mx-auto bg-green-300 hover:bg-green-400 text-green-600 font-bold p-2 rounded">
                    <span>خرید</span>
                </a>
            </div>
        </div>
    @endforeach
