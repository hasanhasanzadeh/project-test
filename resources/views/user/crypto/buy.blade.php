@extends('user.layouts.app_user')

@section('content')
        <div class="w-full mx-auto z-10">
            <div class="flex flex-col">
                <div class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                    <div class="flex justify-between p-2">
                        <div class="flex justify-center items-center dark:text-gray-200 text-gray-800">
                            <div class="px-1">
                                <i class="fa fa-clock text-2xl"></i>
                                <span class="px-2">{{$title}}</span>
                            </div>
                        </div>
                        <div class="flex justify-center items-center dark:text-gray-200 text-gray-800">
                            <div id="persianDateTime" class="flex py-2">
                                <div class="px-1"> امروز :</div>
                                <div id="persianDate" class="px-1">{{ \App\Helpers\Helper::toSolarDate(\Carbon\Carbon::now()->format('Y-m-d')) }}</div>
                                <div id="persianTime" class="px-1">{{ \Carbon\Carbon::now()->format('H:i:s') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container px-2 mx-auto grid">
            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @include('user.partials.currency')
            </div>
            @if($prices->isEmpty())
                <div class="w-full">
                    <div class="shadow bg-gray-200 dark:bg-gray-700 rounded border dark:text-gray-200">
                        <div class="flex justify-center">
                            <div class="p-2 m-4 text-center text-2xl">
                                ارزی یافت نشد یا موجود نمی باشد
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const getChartOptions = () => {
            return {
                series: [67.8, 33.2],
                colors: ["#1C64F2", "#9061F9"],
                chart: {
                    height: 420,
                    width: "100%",
                    type: "pie",
                },
                stroke: {
                    colors: ["white"],
                    lineCap: "",
                },
                plotOptions: {
                    pie: {
                        labels: {
                            show: true,
                        },
                        size: "100%",
                        dataLabels: {
                            offset: -25
                        }
                    },
                },
                labels: ["سقف واریز روزانه", "جمع واریز امروز"],
                dataLabels: {
                    enabled: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                    },
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return value + "%"
                        },
                    },
                },
                xaxis: {
                    labels: {
                        formatter: function (value) {
                            return value  + "%"
                        },
                    },
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
            }
        }
        if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
            chart.render();
        }

        const getChart = () => {
            return {
                series: [76.8, 23.2],
                colors: ["#ee0585", "#01b60c"],
                chart: {
                    height: 420,
                    width: "100%",
                    type: "pie",
                },
                stroke: {
                    colors: ["white"],
                    lineCap: "",
                },
                plotOptions: {
                    pie: {
                        labels: {
                            show: true,
                        },
                        size: "100%",
                        dataLabels: {
                            offset: -25
                        }
                    },
                },
                labels: ["سقف برداشت روزانه", "جمع برداشت امروز"],
                dataLabels: {
                    enabled: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                    },
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return value + "%"
                        },
                    },
                },
                xaxis: {
                    labels: {
                        formatter: function (value) {
                            return value  + "%"
                        },
                    },
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
            }
        }
        if (document.getElementById("pie-withdrawal") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("pie-withdrawal"), getChart());
            chart.render();
        }

        let dateString = "{{ \App\Helpers\Helper::toSolarDate(\Carbon\Carbon::now()->format('Y-m-d')) }}";
        let timeString = "{{ \Carbon\Carbon::now()->format('H:i:s') }}";

        let currentTime = new Date();
        let [hours, minutes, seconds] = timeString.split(':');
        currentTime.setHours(parseInt(hours));
        currentTime.setMinutes(parseInt(minutes));
        currentTime.setSeconds(parseInt(seconds));

        function updateClock() {
            currentTime.setSeconds(currentTime.getSeconds() + 1);

            let hours = currentTime.getHours().toString().padStart(2, '0');
            let minutes = currentTime.getMinutes().toString().padStart(2, '0');
            let seconds = currentTime.getSeconds().toString().padStart(2, '0');

            document.getElementById('persianTime').innerHTML = hours + ':' + minutes + ':' + seconds;
        }

        setInterval(updateClock, 1000);

        document.getElementById('persianDate').innerHTML = dateString;

    </script>
@endsection
