<x-app-layout>
    <h2 class="text-title-md3 mb-3 mt-4 font-bold text-black dark:text-white">
        {{ __('Show SubLesson') }}
    </h2>
     <div class="mb-6">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
        <input type="text" disabled value="{{$content['title']}}" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>
    <div class="mb-6">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
        <input type="text" id="title" disabled value="{{$content['type']}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>
        @if($content['type'] == 'assignment')
             <a type="button" href="{{route('downloadPDF',$content['fileTitle'])}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Download</a>
            @if(auth()->user()->role == 'student' )
                <form method="POST" action="{{route('student.assignments.create')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6 mt-4">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <label class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white" for="assignment_input">Upload answer assignment</label>
                    <input name="answerFile" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="assignment_input" type="file">
                    <input hidden name="id" value="{{$content['id']}}">
                    <button type="submit" class="text-black bg-gray-200 mt-4 hover:bg-gray-100 rounded-lg text-sm px-5 py-2.5">Upload</button>
                </form>
                @foreach($content['answers'] as $answer)
                <div class="mb-6 mt-4 flex justify-between ">
                    <input type="text" value="{{$answer->title}}" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <input type="text" {{$anser->score ? "" : "hidden"}}  value="{{$answer->score}}" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <a type="button" href="{{route('downloadPDF',$answer->answerFile)}}" class="text-white ml-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Download</a>
                    <a type="button" href="{{route('showPDF',$answer->answerFile)}}" class="text-white ml-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">show</a>
                    <form action="{{route('student.assignments.delete',$answer->id)}}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="text-white ml-5 bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Delete</button>
                    </form>
                </div>

                @endforeach
           @endif
    @elseif($content['type'] =='text')
            <video class="w-full" autoplay muted controls>
                <source src="{{Storage::url("videos/".$content['videoContent'])}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Text</label>
            <textarea id="message" readonly name="textContent" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                {{$content['textContent']}}
            </textarea>
        @else
        <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quiz Title</label>
            <input type="text"  disabled value="{{$content['quizTitle']}}" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="mb-6">
            <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Time</label>
            <input type="text" disabled value="{{$content['time']}}" id="time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Question</label>
    @foreach($content['questions'] as $question)
            <div class="mb-6 flex justify-between">
                <input type="text" disabled value="{{$question['questionText']}}" id="question" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <input type="text" disabled value="{{$question['score']}}" id="question" class="bg-gray-50 border ml-3 text-center w-20 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="flex flex-wrap justify-between mb-6">
                @foreach($question['options'] as $option)
                <div>
                    <input type="text" style="{{$option['isCorrect'] == 1 ?'border: #2db82d 4px solid;' :''}}" disabled value="{{$option['optionText']}}" id="option" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                @endforeach
            </div>
            @endforeach
        @endif
</x-app-layout>
