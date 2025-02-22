<div class="w-full md:w-1/2 px-3 my-3">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="telegram">
        {{__('dashboard.telegram')}}
    </label>
    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="telegram" name="telegram" type="url" value="{{$object->socialMedia->telegram??old('telegram')}}" placeholder="{{__('dashboard.enterTelegram')}}">
</div>
<div class="w-full md:w-1/2 px-3 my-3">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="instagram">
        {{__('dashboard.instagram')}}
    </label>
    <input type="url" name="instagram" placeholder="{{__('dashboard.enterInstagram')}}" value="{{$object->socialMedia->instagram??old('instagram')}}" id="instagram" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-input" >
</div>
<div class="w-full md:w-1/2 px-3 my-3">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="whatsapp">
        {{__('dashboard.whatsapp')}}
    </label>
    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="whatsapp" name="whatsapp" type="url" value="{{$object->socialMedia->whatsapp??old('whatsapp')}}" placeholder="{{__('dashboard.enterWhatsapp')}}">
</div>
<div class="w-full md:w-1/2 px-3 my-3">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="youtube">
        {{__('dashboard.youtube')}}
    </label>
    <input type="url"  name="youtube" placeholder="{{__('dashboard.enterYoutube')}}" value="{{$object->socialMedia->youtube??old('youtube')}}" id="youtube" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-input" >
</div>
<div class="w-full md:w-1/2 px-3 my-3">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="facebook">
        {{__('dashboard.facebook')}}
    </label>
    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="facebook" name="facebook" type="url" value="{{$object->socialMedia->facebook??old('facebook')}}" placeholder="{{__('dashboard.enterFacebook')}}">
</div>
<div class="w-full md:w-1/2 px-3 my-3">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="twitter">
        {{__('dashboard.x_link')}}
    </label>
    <input type="url" name="x_link" placeholder="{{__('dashboard.x_link')}}" value="{{$object->socialMedia->x_link??old('x_link')}}" id="twitter" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-input" >
</div>
<div class="w-full px-3 my-3">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-50" for="linkedin">
        {{__('dashboard.linkedin')}}
    </label>
    <input type="url" name="linkedin" placeholder="{{__('dashboard.enterLinkedin')}}" value="{{$object->socialMedia->linkedin??old('linkedin')}}" id="twitter" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-input" >
</div>
