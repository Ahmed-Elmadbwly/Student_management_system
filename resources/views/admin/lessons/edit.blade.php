<x-app-layout>
    <h2 class="text-title-md3 mb-3 mt-4 font-bold text-black dark:text-white">
        {{ __(isset($lesson)?'Edit Lesson':'Add Lesson') }}
    </h2>
    <form method="POST" class="mt-5" action="{{isset($lesson)?route('lesson.update',[$courseId,$lesson->id]):route('lesson.store',$courseId)}}" enctype="multipart/form-data">
        @csrf
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="isset($lesson)?$lesson->title:old('title')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="isset($lesson)?$lesson->description:old('description')"  autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __(isset($lesson)?'Edit Lesson':'Add Lesson') }}
            </x-primary-button>
        </div>

    </form>
</x-app-layout>
