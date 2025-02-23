@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
            <div id="persianDateTime" class="flex py-3">
                <div> امروز :</div>
                <div id="persianTime" class="px-3">{{ \Carbon\Carbon::now()->format('H:i:s') }}</div>
            </div>
        </span>
            <div class="shadow bg-gray-200 dark:bg-gray-700 rounded gap-4 border dark:text-gray-200">
                <a href="{{route('costs.index')}}">
                <div class="flex justify-between p-4 m-2">
                    <div>
                        <i class="fa-solid fa-money-bill-1 text-green-700 text-3xl"></i>
                        <h4>درخواست های منتظر پرداخت</h4>
                    </div>
                    <span>
                        {{\App\Models\Cost::where('status','pending')->count()}}
                    </span>
                </div>
                </a>
            </div>
            <div class="shadow bg-gray-200 dark:bg-gray-700 rounded gap-4 border dark:text-gray-200">
                <a href="{{route('customers.index')}}">
                    <div class="flex justify-between p-4 m-2">
                        <div>
                            <i class="fa-solid fa-users-line text-yellow-600 text-3xl"></i>
                            <h4>کاربران </h4>
                        </div>
                        <span>
                        {{App\Models\User::all()->count()}}
                    </span>
                    </div>
                </a>
            </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const options = {
            chart: {
                height: "100%",
                maxWidth: "100%",
                type: "line",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false,
                },
                toolbar: {
                    show: true,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 2,
            },
            grid: {
                show: true,
                strokeDashArray: 2,
                padding: {
                    left: 2,
                    right: 2,
                    top: -26
                },
            },
            series: [
                {
                    name: "برداشت ها",
                    data: [6500, 6418, 6456, 6526, 6356, 6456 ,6567],
                    color: "#1A56DB",
                },
                {
                    name: "واریزی ها",
                    data: [6456, 6356, 6526, 6332, 6418, 6500 , 6456],
                    color: "#7E3AF2",
                },
            ],
            legend: {
                show: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: ['یکشنبه ۲ مهر', 'دوشنبه ۳ مهر', 'سه شنبه ۴ مهر', 'چهارشنبه ۵ مهر', 'پنجشنبه ۶ مهر', 'جمعه ۷ مهر', 'شنبه ۸ مهر'],
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-medium font-normal fill-gray-500 dark:fill-gray-400'
                    }
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
        }

        if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("line-chart"), options);
            chart.render();
        }

        const option = {
            series: [
                {
                    name: "واریز",
                    color: "#31C48D",
                    data: ["1420", "1620", "1820", "1420", "1650", "2120","1420", "1620", "1820", "1420", "1650", "2120"],
                },
                {
                    name: "برداشت",
                    data: ["788", "810", "866", "788", "1100", "1200","788", "810", "866", "788", "1100", "1200"],
                    color: "#F05252",
                }
            ],
            chart: {
                sparkline: {
                    enabled: false,
                },
                type: "bar",
                width: "100%",
                height: 400,
                toolbar: {
                    show: false,
                }
            },
            fill: {
                opacity: 1,
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    columnWidth: "100%",
                    borderRadiusApplication: "end",
                    borderRadius: 6,
                    dataLabels: {
                        position: "top",
                    },
                },
            },
            legend: {
                show: true,
                position: "bottom",
            },
            dataLabels: {
                enabled: false,
            },
            tooltip: {
                shared: true,
                intersect: false,
                formatter: function (value) {
                    return "$" + value
                }
            },
            xaxis: {
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-medium font-normal fill-gray-500 dark:fill-gray-400'
                    },
                    formatter: function(value) {
                        return "$" + value
                    }
                },
                categories: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور","مهر","آبان","آذر","دی","بهمن","اسفند"],
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-medium font-normal fill-gray-500 dark:fill-gray-400'
                    }
                }
            },
            grid: {
                show: true,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: -20
                },
            },
            fill: {
                opacity: 1,
            }
        }

        if(document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("bar-chart"), option);
            chart.render();
        }


        let dateString = "{{ verta()->format(\Carbon\Carbon::now()->format('Y-m-d')) }}";
        let timeString = "{{ \Carbon\Carbon::now()->format('H:i:s') }}";

        // Convert the time string to an actual date object in JavaScript
        let currentTime = new Date();
        let [hours, minutes, seconds] = timeString.split(':');
        currentTime.setHours(parseInt(hours));
        currentTime.setMinutes(parseInt(minutes));
        currentTime.setSeconds(parseInt(seconds));

        function updateClock() {
            // Increment the time by 1 second
            currentTime.setSeconds(currentTime.getSeconds() + 1);

            // Format the time to HH:MM:SS
            let hours = currentTime.getHours().toString().padStart(2, '0');
            let minutes = currentTime.getMinutes().toString().padStart(2, '0');
            let seconds = currentTime.getSeconds().toString().padStart(2, '0');

            // Display the updated time
            document.getElementById('persianTime').innerHTML = hours + ':' + minutes + ':' + seconds;
        }

        // Run the clock update every 1000ms (1 second)
        setInterval(updateClock, 1000);

        // Display the current date (static, no need to update since it's from PHP)
        document.getElementById('persianDate').innerHTML = dateString;
    </script>
@endsection
