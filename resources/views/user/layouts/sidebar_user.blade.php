<aside id="sidebar" class="fixed top-0 right-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">
    <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-gray-100 border-r border-gray-200 dark:bg-gray-700 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-gray-100 divide-y divide-gray-200 dark:bg-gray-700 dark:divide-gray-700">
                <ul class="pb-2 space-y-2">
                    <li class="text-center">
                        <div class="flex justify-center">
                            <img class="w-20 h-20 rounded-full shadow-lg" src="{{auth()->user()->avatar->address??asset('/images/user/avatar-profile.png')}}" alt="user photo">
                        </div>
                        <div class="py-4 text-center">
                            <div class="flex flex-row items-center justify-center">
                                <div class="flex mr-2">
                                    <i class="fa-regular fa-star text-blue-400 fa-xl py-2"></i>
                                </div>
                            </div>
                            <h3 class="dark:text-gray-200 text-gray-700 p-1">{{auth()->user()->name??auth()->user()->mobile}}</h3>
                        </div>
                    </li>
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
                        <hr>
                    </li>
                    <li>
                        <a href="{{route('dashboard.user')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span class="mr-3" sidebar-toggle-item="">داشبورد</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('payments.index')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-code-pull-request"></i>
                            <span class="mr-3" sidebar-toggle-item="">درخواست ها</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('profile.show')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-id-card"></i>
                            <span class="mr-3" sidebar-toggle-item="">پروفایل</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('logout')}}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span class="mr-3" sidebar-toggle-item="">خروج</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
