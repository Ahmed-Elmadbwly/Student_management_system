<x-app-layout>

    <div class="relative mt-6 overflow-x-auto shadow-md sm:rounded-lg">
        <h2 class="text-title-md3 mb-3 font-bold text-black dark:text-white">
            Courses
        </h2>
        <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <div class="relative mt-3 ml-3">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="table-search-users" onkeyup="searchTable()" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for Courses">
            </div>
        </div>
        <table id="classesTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-5"> </th>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Create by
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    in Class
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach( $courses as $course)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4"></td>
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{$course->title}}
                    </td>
                    <td class="px-6 py-4">
                        {{$course->description}}
                    </td>
                    <td class="px-6 py-4">
                        {{$course->createBy()->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$course->category()->title}}
                    </td>
                    <td class="px-6 py-4">
                        {{$course->inClass()->title}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{route('lessons.index',$course->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"> Lesson </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function searchTable() {
            let input = document.getElementById('table-search-users').value.toLowerCase();

            let table = document.getElementById('classesTable');
            let rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j]) {
                        if (cells[j].innerText.toLowerCase().indexOf(input) > -1) {
                            match = true;
                            break;
                        }
                    }
                }
                rows[i].style.display = match ? '' : 'none';
            }
        }
    </script>

</x-app-layout>
