@foreach($categories as $subCategory)
    <tr class="text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3 text-sm">
            {{$subCategory->id}}
        </td>
        <td class="px-4 py-3 text-sm">
            @if($subCategory->photo)
                <a href="{{route('categories.show',$subCategory->id)}}" title="{{$subCategory->name}}"> <img src="{{$subCategory->photo->address}}"  height="200" width="200" alt="" class="image-grayscale mx-auto"></a>
            @else
                <a href="{{route('categories.show',$subCategory->id)}}" title="{{$subCategory->name}}"> <i class="fa fa-photo-film  text-5xl"></i></a>
            @endif
        </td>
        <td class="px-4 py-3 text-sm">{{str_repeat('--',$level)}} <span> </span>{{$subCategory->name}}</td>
        <td class="px-4 py-3 text-sm">
            @switch($subCategory->language->lang)
                @case('fa')
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.langFa')}}
                                        </span>
                @break
                @case('ku')
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.langKu')}}
                                        </span>
                @break
                @case('ar')
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.langAr')}}
                                        </span>
                @break
                @case('en')
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.langEn')}}
                                        </span>
                @break
            @endswitch
        </td>
        <td class="px-4 py-3 text-sm">
            @if($subCategory->status)
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.active')}}
                                        </span>
            @else
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.inactive')}}
                                        </span>
            @endif
        </td>
        <td class="px-4 py-3 text-sm">
            @if(config('app.locale')=='fa')
                {{verta()->instance($subCategory->created_at)->format('%d %B %Y')}}
            @else
                {{ date('d-M-y', strtotime($subCategory->created_at))}}
            @endif
        </td>
        <td class="px-4 py-3 text-sm">
            <a href="{{route('categories.show',$subCategory->id)}}" class="text-blue-500" title="{{__('dashboard.show')}}">
                <i class="fa fa-eye"></i>
            </a>
            <a href="{{route('categories.edit',$subCategory->id)}}"  class="text-yellow-900" title="{{__('dashboard.edit')}}">
                <i class="fa fa-edit"></i>
            </a>
                <form action="{{route('categories.destroy',$subCategory->id)}}" method="POST">
                    @csrf
                    {{method_field('DELETE')}}
                    <button class="text-red-600 show_confirm" name="delete" onclick="confirmSubmit()" type="submit" title="{{__('dashboard.delete')}}">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
        </td>
    </tr>
    @if(count($subCategory->children)>0)
        @include('panel.partials.category_child',['categories'=>$subCategory->children,'level'=>$level+1])
    @endif
@endforeach
