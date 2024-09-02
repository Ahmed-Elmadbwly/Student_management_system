<x-app-layout>
    <h2 class="text-title-md3 mb-3 mt-4 font-bold text-black dark:text-white">
        {{ __(isset($category)?'Edit category':'Add category') }}
    </h2>
    <form method="POST" class="mt-5" action="{{isset($category)?route('category.update',$category[0]->id):route('category.store')}}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="isset($category)?$category[0]->title:old('title')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __(isset($category)?'Edit category':'Add category') }}
            </x-primary-button>
        </div>

    </form>
</x-app-layout>
