@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <div class="w-full">
            <form method="get" class="grid w-full">
                <div class="flex items-center text-center">
                    <div class="px-2 mx-2 flex items-center text-center">
                        <label for="datepicker" class="dark:text-gray-200 text-gray-700 px-2 text-nowrap">از تاریخ :</label>
                        <input type="text" id="datepicker" name="from_date" class="datepicker appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    <div class="px-2 mx-2 flex items-center text-center">
                        <label for="datepicker" class="dark:text-gray-200 text-gray-700 px-2 text-nowrap">از تاریخ :</label>
                        <input type="text" id="datepicker" name="to_date" class="datepicker appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    <div class="px-2 mx-2">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">
                            <i class="fa fa-filter"></i>
                            فیلتر
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- New Table -->
        <div>
            <form id="bulk-status-form" action="{{ route('costs.changes') }}" method="POST">
                @csrf
                <div class="w-full mt-4">
                    <select name="status" id="bulk-status-select" class="border p-2">
                        <option value="">وضعیت جدید را انتخاب کنید</option>
                        <option value="done">تکمیل شد</option>
                        <option value="fail">ناموفق</option>
                        <option value="pending">در انتظار</option>
                        <option value="accept">تایید شد</option>
                        <option value="cancel">لغو شد</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2">بروزرسانی وضعیت</button>
                </div>
                <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
                <div class="w-full overflow-x-auto">
                    @php $row=0;@endphp
                    @if(!$costs->isEmpty())
                        <table class="w-full  order">
                            <thead>
                            <tr class="text-sm font-bold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                                <th class="px-4 py-3">
                                    <input type="checkbox" id="select-all-checkbox">
                                </th>
                                <th class="px-4 py-3">{{__('dashboard.row')}}</th>
                                <th class="px-4 py-3">پروفایل</th>
                                <th class="px-4 py-3">نام و نام خانوادگی</th>
                                <th class="px-4 py-3">دسته هزینه ها</th>
                                <th class="px-4 py-3">شماره شبا</th>
                                <th class="px-4 py-3">@sortablelink('amount', __('dashboard.amount'))</th>
                                <th class="px-4 py-3">@sortablelink('status', __('dashboard.status'))</th>
                                <th class="px-4 py-3">@sortablelink('created_at', __('dashboard.created_at'))</th>
                                <th class="px-4 py-3">اقدامات</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                            @foreach($costs as $cost)
                                <tr class="text-gray-700 dark:text-gray-400">

                                    <td class="px-4 py-3 text-sm">
                                        <input type="checkbox" name="selected_ids[]" value="{{ $cost->id }}" class="select-item">
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{++$row}}
                                    </td>
                                    <td class="px-4 py-3 text-medium">
                                        @if($cost->user->avatar)
                                            <img src="{{$cost->user->avatar->address}}"  height="90" width="90" alt="" class="rounded-full w-12 h-12 mx-auto">
                                        @else
                                            <img src="{{asset('/images/user/avatar-profile.png')}}" height="90" width="90" alt="" class="rounded-full w-12 h-12 mx-auto">
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-medium">
                                        {{$cost->user->name??$cost->user->mobile}}
                                    </td>
                                    <td class="px-4 py-3 text-medium">
                                        {{$cost->category->name}}
                                    </td>
                                    <td class="px-4 py-3 text-medium">
                                        {{$cost->shaba}}
                                    </td>
                                    <td class="px-4 py-3 text-medium">
                                        <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                                        {{ number_format($cost->amount,0).' تومان '}}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        @if($cost->status=='done')
                                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                                 {{$cost->state}}
                                            </span>
                                        @elseif($cost->status=='fail')
                                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1">
                                                 {{$cost->state}}
                                            </span>
                                        @elseif($cost->status=='pending')
                                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-yellow-600 bg-yellow-200 uppercase last:mr-0 mr-1">
                                                 {{$cost->state}}
                                            </span>
                                        @elseif($cost->status=='accept')
                                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                                                 {{$cost->state}}
                                            </span>
                                        @elseif($cost->status=='cancel')
                                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-yellow-600 bg-blue-200 uppercase last:mr-0 mr-1">
                                                {{$cost->state}}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{verta()->instance($cost->created_at)}}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-xl flex justify-center items-center">
                                            <a href="{{route('costs.show',$cost->id)}}" class="text-blue-500 mx-auto" title="{{__('dashboard.show')}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{route('costs.edit',$cost->id)}}" class="text-yellow-500 mx-auto" title="{{__('dashboard.show')}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                @if(!$costs->isEmpty())
                    <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    <span class="flex items-center col-span-3">
                      {{__('dashboard.number')}}  {{$costs->count()}}
                    </span>
                        <span class="col-span-2"></span>
                        <!-- Pagination -->
                        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                      <nav aria-label="Table navigation">
                        <ul class="inline-flex items-center px-4" >
                            {!! $costs->appends(Request::except('page'))->render() !!}
                        </ul>
                      </nav>
                    </span>
                    </div>
                @endif
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let selectAllCheckbox = document.getElementById("select-all-checkbox");
            let checkboxes = document.querySelectorAll(".select-item");

            // Retrieve stored selected items from localStorage
            let selectedItems = JSON.parse(localStorage.getItem("selectedItems")) || [];

            // Sync checkbox states with localStorage on page load
            checkboxes.forEach((checkbox) => {
                if (selectedItems.includes(checkbox.value)) {
                    checkbox.checked = true;
                }
            });

            // Update localStorage when checkboxes are checked or unchecked
            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener("change", function() {
                    if (this.checked) {
                        if (!selectedItems.includes(this.value)) {
                            selectedItems.push(this.value);
                        }
                    } else {
                        selectedItems = selectedItems.filter(id => id !== this.value);
                    }
                    localStorage.setItem("selectedItems", JSON.stringify(selectedItems));
                });
            });

            // "Select All" checkbox functionality
            selectAllCheckbox.addEventListener("change", function() {
                checkboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
                if (selectAllCheckbox.checked) {
                    selectedItems = Array.from(checkboxes).map(cb => cb.value);
                } else {
                    selectedItems = [];
                }
                localStorage.setItem("selectedItems", JSON.stringify(selectedItems));
            });

            // Update "Select All" checkbox state when an individual checkbox is changed
            function updateSelectAllCheckbox() {
                let allChecked = document.querySelectorAll(".select-item:checked").length === checkboxes.length;
                selectAllCheckbox.checked = allChecked;
            }

            checkboxes.forEach(cb => cb.addEventListener("change", updateSelectAllCheckbox));

            // Select all checkboxes on the current page
            document.getElementById("select-all-btn").addEventListener("click", function() {
                checkboxes.forEach(cb => {
                    cb.checked = true;
                    if (!selectedItems.includes(cb.value)) {
                        selectedItems.push(cb.value);
                    }
                });
                localStorage.setItem("selectedItems", JSON.stringify(selectedItems));
            });

            // Deselect all checkboxes on the current page
            document.getElementById("deselect-all-btn").addEventListener("click", function() {
                checkboxes.forEach(cb => cb.checked = false);
                selectedItems = [];
                localStorage.setItem("selectedItems", JSON.stringify(selectedItems));
            });

            // Clear localStorage on form submit to avoid previous page selection
            document.getElementById("bulk-status-form").addEventListener("submit", function() {
                localStorage.removeItem("selectedItems");
            });
        });
    </script>
@endsection
