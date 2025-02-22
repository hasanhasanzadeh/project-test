@extends('user.layouts.app_user')

@section('content')
    <div class="mx-auto grid z-10 px-4">
        <div class="w-full bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4">
            <div class="flex p-2">
                <div class="flex justify-center items-center dark:text-gray-200 text-gray-800">
                    <p>
                        با معرفی دوستانتان هر بار که معامله می کنند
                        {{$setting->percentage.'%'}}
                        از کارمزدشان به شما تعلق می گیرد.
                    </p>
                </div>
            </div>
        </div>
        <div class="sm:w-full md:flex gap-4">
           <div class="sm:w-full md:w-1/2 bg-gray-100 gap-3 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 my-2">
               <h2 class="text-center text-xl text-blue-500 py-4">
                   کد دعوت پیش فرض
               </h2>
               <hr class="text-gray-600 dark:text-gray-200">
               <p class="text-center h4 text-gray-600 dark:text-gray-200 py-4">
                   دوستان خود را با لینک مخصوص خودتان از طریق پیامک , ایمیل , واتساپ , تلگرام دعوت کنید
               </p>
               <p class="text-gray-600 dark:text-gray-200 text-center py-3">
                   <span>کد معرفی</span><br>
                   {{$user->referral_code}}
               </p>
               <div class="text-center mx-auto">
                   <h4 class="text-gray-600 dark:text-gray-200 text-center py-3">لینک معرفی</h4>
                   <h4 id="copyText" class="inline-block text-center rounded text-gray-700 dark:text-gray-200">
                       {{url('/register?referral_code='.$user->referral_code)}}
                    </h4>
                   <button id="copyButton" type="button" class="w-full block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">
                       کپی
                   </button>
               </div>
           </div>
            <div class="sm:w-full md:w-1/2 bg-gray-100 gap-3 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 my-2">
                <h5 class="text-center text-xl text-blue-500 py-4">
                   دوستان معرفی شده توسط شما
                </h5>
                <hr class="text-gray-600 dark:text-gray-200">
                <p class="text-center h4 text-gray-600 dark:text-gray-200 py-4">
                    مجموع کارمزد دریافتی شما (تومان)
                </p>
                <p class="text-gray-600 dark:text-gray-200 text-center pb-3">
                    0
                </p>
                <div class="text-center mx-auto">
                    <h4 class="text-gray-600 dark:text-gray-200 text-center py-3">دوستان شما (نفر)</h4>
                    <h4 id="copyText" class="inline-block text-center rounded text-gray-700 dark:text-gray-200">
                        {{\App\Models\User::with('referrals')->whereHas('referrals',function($query){$query->where('referral_id',auth()->user()->id);})->count()}}
                    </h4>
                </div>
                <div>
                    <p class="text-center h4 text-gray-600 dark:text-gray-200 py-4">
                        معاملات دوستان شما
                    </p>
                    <p class="text-gray-600 dark:text-gray-200 text-center pb-3">
                        0
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.getElementById('copyButton').addEventListener('click', function() {
            // Get the text from the paragraph element
            let copyText = document.getElementById('copyText').innerText;

            // Copy the text to the clipboard
            navigator.clipboard.writeText(copyText).then(() => {
                Swal.fire({
                    toast: false,
                    position: 'center',
                    icon: 'success',
                    title: "لینک معرف کپی شد " ,
                    showConfirmButton: false,
                    timer: 3000
                });
            }).catch(err => {
                Swal.fire({
                    toast: false,
                    position: 'center',
                    icon: 'success',
                    title: "لینک معرف کپی شد " ,
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        });
    </script>
@endsection
