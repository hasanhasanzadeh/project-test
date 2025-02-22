<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه اصلی </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" />
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <a href="#" class="flex items-center text-xl font-bold text-blue-600">
                    Flowbite
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{route('login')}}" class="text-gray-700 hover:text-blue-600 px-4">ورود</a>
                <a href="{{route('register')}}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">ثبت‌نام</a>
            </div>
        </div>
    </div>
</nav>

<!-- هدر -->
<header class="bg-blue-600 text-white text-center py-20">
    <h1 class="text-4xl font-bold">به Flowbite خوش آمدید</h1>
    <p class="mt-2 text-lg">بهترین راهکارهای طراحی با Tailwind و Flowbite</p>
    <a href="#" class="mt-4 inline-block bg-white text-blue-600 px-6 py-3 rounded-lg font-medium hover:bg-gray-100">شروع کنید</a>
</header>

<!-- ویژگی‌ها -->
<section class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-2xl font-bold text-center text-gray-800">ویژگی‌های ما</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-white shadow-lg p-6 rounded-lg text-center">
            <h3 class="text-xl font-semibold text-blue-600">طراحی مدرن</h3>
            <p class="text-gray-600 mt-2">استفاده از جدیدترین تکنولوژی‌های طراحی</p>
        </div>
        <div class="bg-white shadow-lg p-6 rounded-lg text-center">
            <h3 class="text-xl font-semibold text-blue-600">ریسپانسیو</h3>
            <p class="text-gray-600 mt-2">سازگاری کامل با موبایل و تبلت</p>
        </div>
        <div class="bg-white shadow-lg p-6 rounded-lg text-center">
            <h3 class="text-xl font-semibold text-blue-600">پرفورمنس بالا</h3>
            <p class="text-gray-600 mt-2">سرعت لود فوق‌العاده سریع</p>
        </div>
    </div>
</section>

<!-- فوتر -->
<footer class="bg-gray-800 text-white text-center py-6">
    <p>&copy; 2025 تمامی حقوق محفوظ است.</p>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>
</html>
