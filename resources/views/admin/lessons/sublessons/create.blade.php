<x-app-layout>
    <h2 class="text-title-md3 mb-3 mt-4 font-bold text-black dark:text-white">
        {{ __('Add Lesson') }}
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
    <form method="POST" class="mt-5" action="{{ route('subLesson.store', [$courseId, $lessonId]) }}" enctype="multipart/form-data">
        @csrf
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="assignment_input">Title</label>
        <input name="title" value="{{old('title')}}" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="assignment_input" type="text">
        <x-input-error :messages="$errors->get('title')" class="mt-2" />

        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
        <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="" selected>Choose type :</option>
            <option value="text">Text and video</option>
            <option value="assignment">Assignment</option>
            <option value="test">Test</option>
        </select>
        <x-input-error :messages="$errors->get('type')" class="mt-2" />

        <div id="text-section" class="mt-5 hidden">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Text</label>
            <textarea id="message" name="textContent" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
            <x-input-error :messages="$errors->get('textContent')" class="mt-2" />

            <label class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload video</label>
            <input name="videoContent" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
            <x-input-error :messages="$errors->get('videoContent')" class="mt-2" />
        </div>

        <div id="assignment-section" class="mt-5 hidden">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="assignment_input">Upload file assignment</label>
            <input name="fileTitle" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="assignment_input" type="file">
            <x-input-error :messages="$errors->get('fileTitle')" class="mt-2" />
        </div>

        <div id="test-section" class="mt-5 hidden">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="assignment_input">Quiz Title</label>
            <input name="quizTitle" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="text">
            <x-input-error :messages="$errors->get('quizTitle')" class="mt-2" />
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="assignment_input">Quiz Time</label>
            <input name="time" class="block w-full mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="time">
            <x-input-error :messages="$errors->get('time')" class="mt-2" />
            <button type="button" id="add-question-btn" class="bg-blue-500 text-white px-4 py-2 rounded">Add Question</button>
            <div id="questions-container" class="mt-4"></div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Add SubLesson') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        // Show/hide sections based on selection
        document.getElementById('type').addEventListener('change', function () {
            const textSection = document.getElementById('text-section');
            const assignmentSection = document.getElementById('assignment-section');
            const testSection = document.getElementById('test-section');

            // Hide all sections initially
            textSection.classList.add('hidden');
            assignmentSection.classList.add('hidden');
            testSection.classList.add('hidden');

            // Show the selected section based on the value of the select input
            switch (this.value) {
                case 'text':
                    textSection.classList.remove('hidden');
                    break;
                case 'assignment':
                    assignmentSection.classList.remove('hidden');
                    break;
                case 'test':
                    testSection.classList.remove('hidden');
                    break;
                default:
                    // Do nothing if the default option is selected
                    break;
            }
        });

        let questionIndex = 0;

        // Add Question and Options functionality
        document.getElementById('add-question-btn').addEventListener('click', function () {
            const questionsContainer = document.getElementById('questions-container');
            questionIndex++;
            let optionIndex = 1;

            // Create a new question block
            const questionBlock = document.createElement('div');
            questionBlock.className = 'question-block mb-4';

            // Question input
            const questionInput = document.createElement('input');
            questionInput.type = 'text';
            questionInput.name = `questionText[${questionIndex}][text]`;
            questionInput.placeholder = 'Enter question';
            questionInput.className = 'bg-gray-50 mb-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';

            // Options container
            const optionsContainer = document.createElement('div');
            optionsContainer.className = 'options-container mb-4';

            // Add option button
            const addOptionBtn = document.createElement('button');
            addOptionBtn.type = 'button';
            addOptionBtn.className = 'bg-green-500 text-white px-2 py-1 rounded mb-2';
            addOptionBtn.textContent = 'Add Option';
            addOptionBtn.addEventListener('click', function () {
                const optionContainer = document.createElement('div');
                optionContainer.className = 'option-container flex items-center mb-2';

                // Option input
                const optionInput = document.createElement('input');
                optionInput.type = 'text';
                optionInput.name = `questionText[${questionIndex}][optionText][${optionIndex}]`;
                optionInput.placeholder = `Option ${optionIndex}`;
                optionInput.className = 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';

                // Correct option radio button
                const correctOptionInput = document.createElement('input');
                correctOptionInput.type = 'radio';
                correctOptionInput.name = `questionText[${questionIndex}][isCorrect]`;
                correctOptionInput.value = optionIndex;
                correctOptionInput.className = 'ml-2';

                // Correct label
                const correctLabel = document.createElement('label');
                correctLabel.textContent = 'Correct';
                correctLabel.className = 'ml-2 text-gray-900 dark:text-white';

                // Remove option button
                const removeOptionBtn = document.createElement('button');
                removeOptionBtn.type = 'button';
                removeOptionBtn.className = 'bg-red-500 text-white ml-2 px-2 py-1 rounded';
                removeOptionBtn.textContent = 'Remove';
                removeOptionBtn.addEventListener('click', function () {
                    optionContainer.remove();
                });

                // Append option input, correct option input, and remove option button
                optionContainer.appendChild(optionInput);
                optionContainer.appendChild(correctOptionInput);
                optionContainer.appendChild(correctLabel);
                optionContainer.appendChild(removeOptionBtn);
                optionsContainer.appendChild(optionContainer);

                optionIndex++;
            });

            // Remove question button
            const removeQuestionBtn = document.createElement('button');
            removeQuestionBtn.type = 'button';
            removeQuestionBtn.className = 'bg-red-500 text-white ml-5 px-2 py-1 rounded mt-2';
            removeQuestionBtn.textContent = 'Remove Question';
            removeQuestionBtn.addEventListener('click', function () {
                questionBlock.remove();
            });

            // Append question input, options container, add option button, and remove question button
            questionBlock.appendChild(questionInput);
            questionBlock.appendChild(optionsContainer);
            questionBlock.appendChild(addOptionBtn);
            questionBlock.appendChild(removeQuestionBtn);
            questionsContainer.appendChild(questionBlock);


        });
    </script>
</x-app-layout>
