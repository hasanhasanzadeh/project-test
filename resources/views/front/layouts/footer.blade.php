<footer class="bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-100">
    <div class="max-w-screen-xl mx-auto px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8 text-center">
            <!-- Column 1: Brand and Description -->
            <div class="col-span-2">
                <h2 class="text-2xl font-semibold mb-4">
                    <a href="{{url('/')}}" class="flex items-center">
                        <img src="{{$setting->logo->address??asset('images/logo/logo-icon.svg')}}" class="mr-3 object-cover h-12 w-12  rounded-full" alt="FlowBite Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white px-3">{{$setting->title}}</span>
                    </a>
                </h2>
                <p class="text-gray-600 dark:text-gray-400 text-justify">
                    {!!$setting->about!!}
                </p>
                <div class="text-center mt-4">
                    <h4 class="text-xl text-gray-700 dark:text-gray-200 p-2 text-center">
                        ما را در شبکه های اجتماعی دنبال کنید
                    </h4>
                    <div class="flex mt-4 space-x-3 justify-center text-center mx-auto">
                        @if($setting->socialMedia)
                            @if($setting->socialMedia->telegram)
                                <a target="_blank" href="{{$setting->socialMedia->telegram}}" class="text-gray-500 hover:text-gray-900 dark:hover:text-white p-4" title="telegram">
                                    <i class="fa-brands fa-telegram text-blue-500 fa-2xl pl-6"></i>
                                </a>
                            @endif
                            @if($setting->socialMedia->instagram)
                                <a target="_blank" href="{{$setting->socialMedia->instagram}}" class="text-gray-500 hover:text-gray-900 dark:hover:text-white p-4" title="telegram">
                                    <i class="fa-brands fa-instagram text-red-500 fa-2xl"></i>
                                </a>
                            @endif
                            @if($setting->socialMedia->x_link)
                                <a target="_blank" href="{{$setting->socialMedia->x_link}}" class="text-gray-500 hover:text-gray-900 dark:hover:text-white p-4" title="telegram">
                                    <i class="fa-brands fa-x-twitter dark:text-stone-400 text-stone-800 fa-2xl"></i>
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
            <div class="hidden  md:w-[100px] md:block"></div>
            <!-- Column 2: Quick Links -->
            <div  class="text-gray-600 dark:text-gray-400">
                <h2 class="text-xl font-semibold mb-4">لینک ها</h2>
                <ul class="text-gray-600 dark:text-gray-400">
                    <li class="py-1">
                        <a href="{{route('blog.index')}}" class="hover:underline">وبلاگ</a>
                    </li>
                    <li class="py-1">
                        <a href="{{route('about.index')}}" class="hover:underline text-nowrap">درباره ما</a>
                    </li>
                    <li class="py-1">
                        <a href="{{route('contact-us.index')}}" class="hover:underline text-nowrap">تماس با ما</a>
                    </li>
                </ul>
            </div>
            <!-- Column 3: Resources -->
            <div class="text-gray-600 dark:text-gray-400">
                <h2 class="text-xl font-semibold mb-4">{{$setting->title}}</h2>
                <ul class="text-gray-600 dark:text-gray-400">
                    <li class="py-1">
                        <a href="{{route('question.index')}}" class="hover:underline text-nowrap">سوالات متداول</a>
                    </li>
                    <li class="py-1">
                        <a href="{{route('provision.index')}}" class="hover:underline text-nowrap">قوانین و مقررات</a>
                    </li>
                    @foreach(App\Models\Page::where('status',true)->get() as $page)
                        <li class="py-1">
                            <a href="{{route('page.show',$page->slug)}}" class="hover:underline text-nowrap">{{$page->title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Footer Bottom -->
        @if(!$setting->symbols->isEmpty())
        <hr class="border-gray-300 sm:mx-auto dark:border-gray-600 my-4" />
        <div class="text-center mx-auto">
            <h3 class="text-xl text-gray-700 dark:text-gray-200">
                <span>نماد ها و مجوز های</span>
                <span class="px-1">{{$setting->title}}</span>
            </h3>
               <div class="text-center flex justify-center mx-4">
                   @foreach($setting->symbols as $symbol)
                       <a href="{{$symbol->url}}" title="{{$symbol->title}}">
                           <img src="{{$symbol->photo->address}}" class="object-cover h-40 w-40 rounded hover:shadow-lg" alt="{{$symbol->title}}">
                       </a>
                   @endforeach
               </div>
        </div>
        @endif
        <hr class="border-gray-300 sm:mx-auto dark:border-gray-600 my-4" />
        <div class="mt-10 text-center">
            <p class="text-gray-600 dark:text-gray-400 text-sm">{{$setting->copy_right}}</p>
        </div>
    </div>
</footer>

