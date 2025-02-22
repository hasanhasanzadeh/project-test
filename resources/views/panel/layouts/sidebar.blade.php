<aside id="sidebar" class="fixed top-0 right-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">
    <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-gray-100 border-r border-gray-200 dark:bg-gray-700 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 divide-y divide-gray-200 bg-gray-100 dark:bg-gray-700 dark:divide-gray-700">
                <ul class="pb-2 space-y-2">
                    <li>
                        <form action="#" method="GET" class="lg:hidden">
                            <label for="mobile-search" class="sr-only">جستجو</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input type="text" name="search" id="mobile-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="جستجو">
                            </div>
                        </form>
                    </li>
                    <li>
                        <a href="{{route('dashboard.admin')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span class="mr-3" sidebar-toggle-item="">داشبورد</span>
                        </a>
                    </li>
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-layouts" data-collapse-toggle="dropdown-layouts">
                            <i class="fa-solid fa-users-viewfinder"></i>
                            <span class="flex-1 mr-3 text-right whitespace-nowrap" sidebar-toggle-item="">کاربران</span>
                            <svg sidebar-toggle-item="" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <ul id="dropdown-layouts" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{route('customers.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-users"></i>
                                    <span class="px-2">
                                    کاربران
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('verifies.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-star"></i>
                                    <span class="px-2">
                                    احراز هویت کاربران
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('roles.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-user-shield"></i>
                                    <span class="px-2">
                                    نقش ها
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('permissions.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-user-lock"></i>
                                    <span class="px-2">
                                    دسترسی ها
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('user-levels.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-layer-group"></i>
                                    <span class="px-2">
                                    سطح بندی کاربران
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('referrals.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-user-check"></i>
                                    <span class="px-2">
                                    کاربران دعوت شده
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-history" data-collapse-toggle="dropdown-history">
                            <i class="fa-solid fa-circle-dollar-to-slot"></i>
                            <span class="flex-1 mr-3 text-right whitespace-nowrap" sidebar-toggle-item="">اطلاعات بانکی</span>
                            <svg sidebar-toggle-item="" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <ul id="dropdown-history" role="none" class="hidden py-2 space-y-2">
                            <li role="menuitem">
                                <a href="{{route('banks.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-building-columns"></i>
                                    <span class="px-2">
                                        اطلاعات بانک ها
                                    </span>
                                </a>
                            </li>
                            <li role="menuitem">
                                <a href="{{route('bank-cards.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-money-check"></i>
                                    <span class="px-2">
                                    حساب های بانکی
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                            <i class="fa-regular fa-file-lines"></i>
                            <span class="flex-1 mr-3 text-right whitespace-nowrap" sidebar-toggle-item="">صفحات</span>
                            <svg sidebar-toggle-item="" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <ul id="dropdown-pages" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{route('pages.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="px-2">
                                    صفحات
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('abouts.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-address-book"></i>
                                    <span class="px-2">
                                    درباره ما
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('contactus.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-regular fa-file-lines"></i>
                                    <span class="px-2">
                                     ارتباط با ما
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('sliders.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-sliders"></i>
                                    <span class="px-2">
                                     اسلایدرها
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('landing-pages.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-file-lines"></i>
                                    <span class="px-2">
                                     صفحه اصلی
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('questions.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-question-circle"></i>
                                    <span class="px-2">
                                    سوالات متداول
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('provisions.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-scale-balanced"></i>
                                    <span class="px-2">
                                        قوانین و مقررات
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-banks" data-collapse-toggle="dropdown-banks">
                            <i class="fa-solid fa-money-check-dollar"></i>
                            <span class="flex-1 mr-3 text-right whitespace-nowrap" sidebar-toggle-item="">تاریخچه سفارشات</span>
                            <svg sidebar-toggle-item="" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <ul id="dropdown-banks" role="none" class="hidden py-2 space-y-2">
                            <li role="menuitem">
                                <a href="#" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-money-check"></i>
                                    <span class="px-2">
                                        سفارشات
                                    </span>
                                </a>
                            </li>
                            <li role="menuitem">
                                <a href="{{route('payments.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-money-bill-1"></i>
                                    <span class="px-2">
                                    پرداخت ها
                                    </span>
                                </a>
                            </li>
                            <li role="menuitem">
                                <a href="{{route('withdrawals.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa-solid fa-credit-card"></i>
                                    <span class="px-2">برداشت ها
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="bg-red-800 dark:text-gray-100">
                        <hr class="bg-red-800 dark:text-gray-100">
                    </li>
                    <li>
                        <a href="{{route('currencies.index')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-coins"></i>
                            <span class="mr-3" sidebar-toggle-item="">ارزهای دیجیتال</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('verify-samples.index')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-user-check"></i>
                            <span class="mr-3" sidebar-toggle-item="">نمونه احراز هویت</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('blogs.index')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-blog"></i>
                            <span class="mr-3" sidebar-toggle-item="">وبلاگ</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('symbols.index')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-tarp"></i>
                            <span class="mr-3" sidebar-toggle-item="">نمادها</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('settings.index')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-cogs"></i>
                            <span class="mr-3" sidebar-toggle-item="">تنظیمات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('tickets.index')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-comments"></i>
                            <span class="mr-3" sidebar-toggle-item="">تیکت ها</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('visits.index')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-eye"></i>
                            <span class="mr-3" sidebar-toggle-item="">بازدید ها</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('contacts.index')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-contact-card"></i>
                            <span class="mr-3" sidebar-toggle-item="">ارتباطات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('contact-users.index')}}" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-user-secret"></i>
                            <span class="px-2" sidebar-toggle-item="">
                                     ارتباط با مدیران
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('notifies.index')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-tarp"></i>
                            <span class="mr-3" sidebar-toggle-item="">اعلانات کاربران</span>
                        </a>
                    <li>
                        <a href="{{route('logins.index')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-chalkboard-user"></i>
                            <span class="mr-3" sidebar-toggle-item="">ورود و خروج کاربران</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('logout')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-sign-out"></i>
                            <span class="mr-3" sidebar-toggle-item="">خروج</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
