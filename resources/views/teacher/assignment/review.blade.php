<x-app-layout>
    <h2 class="text-title-md3 mb-3 mt-4 font-bold text-black dark:text-white">
        {{ __('Review Assignment') }}
    </h2>

    <form method="POST" action="{{route('teacher.assignments.score',[$answerId,$answer->id])}}" enctype="multipart/form-data">
        @csrf
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
        <div class="mb-6 mt-4 flex justify-between ">
            <input type="text" name="title" disabled value="{{$answer->title}}" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <a type="button" href="{{route('downloadPDF',$answer->answerFile)}}" class="text-white ml-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Download</a>
        <a target="_blank" href="{{ Storage::url('documents/'.$answer->answerFile)}}" class="text-white ml-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">show</a>
        </div>
         <div class="mb-6 mt-4">
            <label for="score" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Score</label>
            <input type="text" name="score" value="{{$answer->score ?$answer->score:""}}" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Add Review') }}
            </x-primary-button>
        </div>

    </form>
</x-app-layout>
