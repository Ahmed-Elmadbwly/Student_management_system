<x-app-layout>
    <h2 class="text-title-md3 mb-3 mt-4 font-bold text-black dark:text-white">
        {{ __('Test') }}
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
    <form id="test-form" method="POST"  onsubmit="clearLocalStorage()" action="{{route('student.test.answer',[$courseId,$lessonId,$content['testId']])}}">
        @csrf
        <div class="mb-4 flex justify-center">
            <input type="text" value="{{$content['time']}}" id="time" disabled  class="bg-gray-50  border border-gray-300 text-gray-900 text-center text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <input type="text" value="{{$content['time']}}" id="time" hidden name="time" class="bg-gray-50  border border-gray-300 text-gray-900 text-center text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="mb-6 ">
            <label class="block mb-2 text-sm font-medium  text-gray-900 dark:text-white">Question</label>
            @foreach($content['questions'] as $question)
                <div class="flex justify-between">
                    <input type="text" disabled  value="{{ $question['questionText'] }}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <input type="text" disabled  value="{{ $question['score'] }}"   class="bg-gray-50 text-center border ml-3 w-20 border-gray-300 text-gray-900 text-sm rounded-lg  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <input hidden name="questionText[{{ $question['id'] }}][questionId]" value="{{$question['id']}}">
                </div>
                <div class="option-container flex  items-center mt-3 mb-2 ">
                @foreach($question['options'] as $index=>$option)
                        <input type="radio" name="questionText[{{ $question['id'] }}][isCorrect]" value="{{ $index+1 }}" class="ml-2 mr-2" >
                        <input type="text" disabled value="{{ $option['optionText'] }}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <input hidden name="questionText[{{ $question['id'] }}][optionText][{{ $option['id'] }}]" value="{{ $option['optionText'] }}">
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('submit') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        function clearLocalStorage() {
            localStorage.removeItem('timeLeft');
        }
        const timeInput = document.getElementById('time');
        console.log(localStorage.getItem('timeLeft'));
        let originalTime = parseInt(timeInput.value) * 60;

        let timeLeft = localStorage.getItem('timeLeft') ? parseInt(localStorage.getItem('timeLeft')) : originalTime;

        function startCountdown() {
            let timerInterval = setInterval(function() {
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    document.getElementById('test-form').submit();
                } else {
                    timeLeft--;
                    let minutes = Math.floor(timeLeft / 60);
                    let seconds = timeLeft % 60;
                    timeInput.value = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
                    localStorage.setItem('timeLeft', timeLeft);
                }
            }, 1000); // Update every second
        }
        window.onload = startCountdown;
    </script>

</x-app-layout>
