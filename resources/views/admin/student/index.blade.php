<x-app-layout>

    <div class="relative mt-6 overflow-x-auto shadow-md sm:rounded-lg">
        <h2 class="text-title-md3 mb-3 font-bold text-black dark:text-white">
            {{$role . 's'}}
        </h2>
        @if(session('message'))
            <div id="alert-message" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{session('message')}}</span>
            </div>
        @endif
        <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <div class="relative mt-3 ml-3">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="table-search-users" onkeyup="searchTable()" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
            </div>
            <a type="button" href="{{route('student.create',$role)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add {{$role}}</a>
        </div>
        <table id="usersTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-5"> Image </th>
                <th scope="col" class="p-5">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" src="{{Storage::url('images/'.$user->image)}}" alt="User image">
                    </th>
                    <td class="w-4 p-4">
                        <div class="text-base font-semibold">{{$user->name}}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        {{$user->email}}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            {{$user->phone}}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if(auth()->user()->role == 'admin')
                            <a href="{{route('student.edit',[$role,$user->id])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit </a>
                            <form action="{{route('student.delete',[$role,$user->id])}}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="font-medium  text-red-600 dark:text-red-500 hover:underline"  type="submit">| Delete |</button>
                            </form>
                        @endif
                        <a href="{{route('chat.show',$user->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">message</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        setTimeout(function() {
            let alertMessage = document.getElementById('alert-message');
            if (alertMessage) {
                alertMessage.style.display = 'none';
            }
        }, 3000);

        function searchTable() {
            let input = document.getElementById('table-search-users').value.toLowerCase();

            let table = document.getElementById('usersTable');
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
