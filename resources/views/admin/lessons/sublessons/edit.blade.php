<x-app-layout>
    <h2 class="text-title-md3 mb-3 mt-4 font-bold text-black dark:text-white">
        {{ __('Edit SubLesson') }}
    </h2>
    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('subLesson.update', [$courseId,$lessonId,$content['subLessonId']]) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" name="title" value="{{$content['title']}}" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>

        <div class="mb-6">
            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
            <input type="text" name="type" value="{{$content['type']}}" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>

        <!-- Assignment Edit -->
        @if($content['type'] == 'assignment')
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File</label>
                <input type="file" name="fileTitle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <p hidden >Current File: {{ $content['fileTitle'] }}</p>
            </div>

            <!-- Text Edit -->
        @elseif($content['type'] == 'text')
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Video Content</label>
                <input type="file" name="videoContent" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <p hidden >Current Video: {{ $content['videoContent'] }}</p>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Text Content</label>
                <textarea name="textContent" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $content['textContent'] }}</textarea>
            </div>

            <!-- Quiz Edit -->
        @else
            <div class="mb-6">
                <label for="quizTitle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quiz Title</label>
                <input type="text" name="quizTitle" value="{{ $content['quizTitle'] }}" id="quizTitle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <div class="mb-6">
                <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time</label>
                <input type="text" name="time" value="{{ $content['time'] }}" id="time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            @foreach($content['questions'] as $question)
                <div class="mb-6 ">
                    <label class="block mb-2 text-sm font-medium  text-gray-900 dark:text-white">Question</label>
                        <div class="flex justify-between">
                            <input type="text" name="questionText[{{ $question['id'] }}][text]" value="{{ $question['questionText'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <input type="text" name="questionText[{{ $question['id'] }}][score]" value="{{ $question['score'] }}" class="bg-gray-50 text-center border ml-3 w-20 border-gray-300 text-gray-900 text-sm rounded-lg  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <input hidden name="questionText[{{ $question['id'] }}][questionId]" value="{{$question['id']}}">
                        </div>
                    </div>

                @foreach($question['options'] as $index=>$option)
                    <div class="option-container flex items-center mb-2 ">
                        <input type="text" name="questionText[{{ $question['id'] }}][optionText][{{ $option['id'] }}]" value="{{ $option['optionText'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <input type="radio" class="ml-2" name="questionText[{{ $question['id'] }}][isCorrect]" value="{{ $index+1 }}" {{ $option['isCorrect'] == 1 ? 'checked' : '' }}>
                        <label class="ml-2 text-gray-900 dark:text-white">Correct</label>
                    </div>
                @endforeach
            @endforeach
        @endif

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5">Save Changes</button>
    </form>
</x-app-layout>
