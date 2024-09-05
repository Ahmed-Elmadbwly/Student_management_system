<x-app-layout>
    <h2 class="text-title-md3 mb-3 mt-4 font-bold text-black dark:text-white">
        {{ __(isset($course)?'Edit Course':'Add Course') }}
    </h2>
    <form method="POST" class="mt-5" action="{{isset($course)?route('course.update',$course->id):route('course.store')}}" enctype="multipart/form-data">
        @csrf
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="isset($course)?$course->title:old('title')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="isset($course)?$course->description:old('description')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div class="mt-3">
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an Category</label>
            <select id="countries" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach($categories as $category)
                    <option value="{{$category->id}} " {{$course->category == $category->id ?"selected":""}}>{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an Class</label>
            <select id="countries" name="inClass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach($classes as $class)
                <option value="{{$class->id}}" {{$course->inClass == $class->id ?"selected":""}}>{{$class->title}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="isset($course)?$course->price:old('price')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __(isset($course)?'Edit Course':'Add Course') }}
            </x-primary-button>
        </div>

    </form>
</x-app-layout>
