@extends('layouts.app')

@section('content')
    <!-- component -->
    <div class="flex h-screen">
        <!-- Right Pane -->
        <div class="w-full bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 lg:w-1/2 flex items-center justify-center">
            <div class="max-w-md w-full p-6">
                <div class="block items-center justify-center">
                    <div class="text-sm font-semibold mb-6 text-gray-500">
                        <a href="{{url('/')}}" class="flex justify-center items-center">
                            <img src="https://flowbite.com/docs/images/logo.svg" alt="{{$title}}" class="h-20 w-20 rounded-full">
                        </a>
                    </div>
                    <h1 class="text-xl font-semibold mb-6 text-black text-center dark:text-stone-100">
                        تاییدیه پیامکی
                    </h1>
                    <p class="text-sm font-semibold mb-6 text-black text-center dark:text-stone-100">
                        کد تایید برای شماره
                        <span class="text-yellow-600 px-2">{{request()->session()->get('auth')['mobile']}}</span>
                        پیامک شد
                    </p>
                </div>
                <div class="mx-auto space-y-6">
                    <form action="{{route('verify.mobile')}}" method="get" dir="ltr" class="text-center" autocomplete="off" id="validate">
                        @csrf
                        <input type="hidden" name="combined_digits" id="combined_digits">
                        <div>
                            <input type="text" name="digit-1" maxlength="1" class="digit-input inline-flex items-center m-1 justify-center text-center border rounded-md w-12 h-12 px-3 py-2 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <input type="text" name="digit-2" maxlength="1" class="digit-input inline-flex items-center m-1 justify-center text-center border rounded-md w-12 h-12 px-3 py-2 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <input type="text" name="digit-3" maxlength="1" class="digit-input inline-flex items-center m-1 justify-center text-center border rounded-md w-12 h-12 px-3 py-2 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <input type="text" name="digit-4" maxlength="1" class="digit-input inline-flex items-center m-1 justify-center text-center border rounded-md w-12 h-12 px-3 py-2 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <input type="text" name="digit-5" maxlength="1" class="digit-input inline-flex items-center m-1 justify-center text-center border rounded-md w-12 h-12 px-3 py-2 border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                                <button type="submit" class="w-full bg-blue-400 text-dark p-2 dark:text-black rounded-md hover:bg-yellow-600 focus:outline-none focus:bg-black focus:text-white focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition-colors duration-300 my-2">
                                    تایید
                                </button>
                            </div>
                        <div>
                            <a href="{{route('intro.show')}}" class="block text-center w-full bg-red-500 text-white p-2 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-500 focus:text-white focus:ring-2 focus:ring-offset-2 focus:ring-red-600 transition-colors duration-300 my-2">انصراف</a>
                        </div>
                    </form>
                    <div class="text-center">
                        <div class="text-sm font-light leading-none text-center text-gray-400">
                            <h6 id="sendAgain" class="hidden text-sm font-light leading-none text-center text-gray-400 p-2 m-2">
                                <a href="{{route('resend.code')}}" class="text-decoration-none text-xl text-blue-600">ارسال دوباره کد</a>
                            </h6>
                            <div id="timeDown" class="flex justify-center items-center text-center">
                                <div><i class="fa fa-clock fa-xl px-2"></i></div>
                                <div id="countdown" dir="ltr" class="text-xl text-yellow-600">00:00</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Left Pane -->
        @include('layouts.left')
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const countDownDate = new Date("{{ \Carbon\Carbon::parse($time)->addMinutes(-3)->format('Y-m-d H:i:s') }}").getTime();
            const countdownFunction = setInterval(() => {
                // Get today's date and time
                const now = new Date().getTime();

                // Find the distance between now and the countdown date
                const distance = countDownDate - now;

                // Time calculations for minutes and seconds
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="countdown"
                document.getElementById('countdown').innerHTML = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                // If the countdown is over, write some text
                if (distance < 0) {
                    clearInterval(countdownFunction);
                    document.getElementById('timeDown').classList.add('hidden');
                    document.getElementById('sendAgain').classList.remove('hidden');
                }
            }, 1000);

            const form = document.getElementById('validate');
            const combinedInput = document.getElementById('combined_digits');
            const digitInputs = form.querySelectorAll('input[type="text"]');
            const updateCombinedInput = () => {
                let combinedValue = '';
                let allFilled = true;

                digitInputs.forEach(digitInput => {
                    if (digitInput.value === '') {
                        allFilled = false;
                    }
                    combinedValue += digitInput.value;
                });

                combinedInput.value = combinedValue;

                // if (allFilled) {
                //     form.submit();
                // }
            };
            digitInputs.forEach(input => {
                input.addEventListener('input', updateCombinedInput);
            });

        });
        document.querySelectorAll('.digit-input').forEach((input, index, array) => {
            input.addEventListener('input', function() {
                if (this.value.length === this.maxLength) {
                    const nextInput = array[index + 1];
                    if (nextInput) {
                        nextInput.focus();
                    }
                }
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value === '') {
                    const prevInput = array[index - 1];
                    if (prevInput) {
                        prevInput.focus();
                        prevInput.value = '';  // Clear the previous input
                    }
                }
            });
        });
    </script>
@endsection
