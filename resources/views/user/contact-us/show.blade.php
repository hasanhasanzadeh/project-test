@extends('user.layouts.app_user')

@section('content')
    <div class="mx-auto grid z-10 px-4">
        <div class="sm:w-full md:flex gap-4">
           <div class="sm:w-full md:w-1/2 bg-gray-100 gap-3 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 my-2">
               <h2 class="flex items-center justify-center text-xl text-blue-500 p-4">
                   <i class="fa-solid fa-circle-info text-blue-600 px-3"></i>
                   @if($contact)
                       <span>{{ $contact->title }}</span>
                   @else
                       <span>توجه</span>
                   @endif
               </h2>
               <hr class="text-gray-600 dark:text-gray-200">
               <p class="text-gray-600 dark:text-gray-200 py-4 space-4">
                   @if($contact)
                       {{ $contact->description }}
                   @else
                       <span class="p-4">
                           می توانی با ما از راه های زیر در ارتباط باشید
                       </span>
                   @endif
               </p>
           </div>
            <div class="sm:w-full md:w-1/2 bg-gray-100 gap-3 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 my-2">
                @if($contact)
                    <a href="{{'tel:'.$contact->tel_1}}" class="sm:w-full md:w-1/2 block text-center my-4 mx-auto bg-blue-600 hover:bg-blue-700 text-white font-bold p-6 rounded">
                        <i class="fa-solid fa-phone-flip"></i>
                        <span>تماس با بخش مالی</span>
                    </a>
                    <a href="{{'tel:'.$contact->tel_2}}" class="sm:w-full md:w-1/2 block text-center my-4 mx-auto bg-blue-600 hover:bg-blue-700 text-white font-bold p-6 rounded">
                        <i class="fa-solid fa-phone-flip"></i>
                        <span>تماس با بخش احراز هویت</span>
                    </a>
                @endif
                <a href="{{route('ticket.add')}}" class="sm:w-full md:w-1/2 block text-center my-4 mx-auto bg-stone-300 hover:bg-stone-400 text-stone-600 font-bold p-6 rounded">
                    <span>ارسال تیکت</span>
                </a>
                <div class="py-4 my-3">
                    <h1 class="text-center text-gray-700 dark:text-gray-200 text-xl">ما را در شبکه های اجتماعی دنبال کنید</h1>
                    <div class="flex mt-8 space-x-6 sm:justify-center sm:mt-0 sm:items-center sm:text-center">
                       @if($setting->socialMedia)
                            @if($setting->socialMedia->instagram)
                                <a target="_blank" href="{{$setting->socialMedia->instagram}}" class="text-gray-500 hover:text-gray-900 dark:hover:text-white p-4" title="telegram">
                                    <i class="fa-brands fa-instagram text-red-500 fa-2xl"></i>
                                </a>
                           @endif
                                @if($setting->socialMedia->telegram)
                                    <a target="_blank" href="{{$setting->socialMedia->telegram}}" class="text-gray-500 hover:text-gray-900 dark:hover:text-white p-4" title="telegram">
                                        <i class="fa-brands fa-telegram text-blue-500 fa-2xl"></i>
                                    </a>
                                @endif
                               @if($setting->socialMedia->x_link)
                                   <a target="_blank" href="{{$setting->socialMedia->x_link}}" class="text-gray-500 hover:text-gray-900 dark:hover:text-white p-4" title="telegram">
                                       <i class="fa-brands fa-x-twitter dark:text-stone-300 text-stone-800 fa-2xl"></i>
                                   </a>
                               @endif
                               @if($setting->socialMedia->linkedin)
                                   <a target="_blank" href="{{$setting->socialMedia->linkedin}}" class="text-gray-500 hover:text-gray-900 dark:hover:text-white p-4" title="telegram">
                                       <i class="fa-brands fa-linkedin text-blue-500 fa-2xl"></i>
                                   </a>
                               @endif
                               @if($setting->socialMedia->youtube)
                                   <a target="_blank" href="{{$setting->socialMedia->youtube}}" class="text-gray-500 hover:text-gray-900 dark:hover:text-white p-4" title="telegram">
                                       <i class="fa-brands fa-youtube text-red-500 fa-2xl"></i>
                                   </a>
                               @endif
                               @if($setting->socialMedia->facebook)
                                   <a target="_blank" href="{{$setting->socialMedia->facebook}}" class="text-gray-500 hover:text-gray-900 dark:hover:text-white p-4" title="telegram">
                                       <i class="fa-brands fa-facebook text-blue-500 fa-2xl"></i>
                                   </a>
                               @endif
                               @if($setting->socialMedia->whatsapp)
                                   <a target="_blank" href="{{$setting->socialMedia->whatsapp}}" class="text-gray-500 hover:text-gray-900 dark:hover:text-white p-4" title="telegram">
                                       <i class="fa-brands fa-whatsapp text-green-500 fa-2xl"></i>
                                   </a>
                               @endif
                       @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
