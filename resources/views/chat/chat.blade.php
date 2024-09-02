<x-app-layout>

    <main class="u-min-h-screen">
        <div class="mx-auto h-[calc(100vh-80px)] max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Messages
                </h2>
            </div>
            <!-- Breadcrumb End -->

            <div class="h-[calc(100vh-186px)] overflow-hidden sm:h-[calc(100vh-174px)]">
                <div class="h-full rounded-sm border border-stroke bg-white shadow-default dark:bg-gray-800 dark:border-gray-700 xl:flex">
                    <div class="hidden h-full flex-col xl:flex xl:w-1/4">
                        <!-- ====== Chat List Start -->
                        <div class="flex max-h-full flex-col overflow-auto p-5">
                            <form class="sticky mb-7 dark:bg-gray-800 dark:border-gray-700 ">
                                <input type="text" class="w-full rounded border border-gray-50 bg-gray-100 py-2.5 pl-5 pr-10 text-sm outline-none focus:border-primary dark:bg-gray-950 dark:border-gray-700" placeholder="Search..." fdprocessedid="79a0j">
                                <button class="absolute right-4 top-1/2 -translate-y-1/2" fdprocessedid="49ty12">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 3C5.3505 3 3 5.3505 3 8.25C3 11.1495 5.3505 13.5 8.25 13.5C11.1495 13.5 13.5 11.1495 13.5 8.25C13.5 5.3505 11.1495 3 8.25 3ZM1.5 8.25C1.5 4.52208 4.52208 1.5 8.25 1.5C11.9779 1.5 15 4.52208 15 8.25C15 11.9779 11.9779 15 8.25 15C4.52208 15 1.5 11.9779 1.5 8.25Z" fill="#637381"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.957 11.958C12.2499 11.6651 12.7247 11.6651 13.0176 11.958L16.2801 15.2205C16.573 15.5133 16.573 15.9882 16.2801 16.2811C15.9872 16.574 15.5124 16.574 15.2195 16.2811L11.957 13.0186C11.6641 12.7257 11.6641 12.2508 11.957 11.958Z" fill="#637381"></path>
                                    </svg>
                                </button>
                            </form>
                            <div class="no-scrollbar max-h-full space-y-2.5 overflow-auto">
                                <!-- Chat List Item -->
                                @foreach($conversations as $conv)
                                <a href="{{route("chat.show",$conv->getReceiver()->id)}}" class="flex cursor-pointer items-center rounded  px-4 py-2 hover:bg-gray-2 dark:hover:bg-strokedark">
                                        <div class="relative mr-3.5 h-11 w-full max-w-11 rounded-full ">
                                            <img src="{{Storage::url('images/'.$conv->getReceiver()->image)}}" alt="profile" class="h-full w-full rounded-full  object-cover object-center">
                                        </div>
                                        <div class="w-full">
                                            <h5 class="text-sm font-medium text-black dark:text-white">
                                                {{$conv->getReceiver()->name}}
                                            </h5>

                                        </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <!-- ====== Chat List End -->
                    </div>
                    <div class="flex h-full flex-col {{isset($user)?"": "justify-center"}}  border-l border-stroke dark:border-strokedark xl:w-3/4">
                        <!-- ====== Chat Box Start -->
                        @if(!isset($user))
                        <p class="text-center">Select user and chat with</p>
                        @else
                            <div class="sticky flex items-center justify-between border-b border-stroke px-6 py-4.5 dark:bg-gray-800 dark:border-gray-700">
                                <div class="flex items-center ">
                                    <div class="mr-4.5 h-13 w-full max-w-13 mr-2 overflow-hidden rounded-full">
                                        <img src="{{Storage::url('images/'.$user->image)}}" alt="avatar" class="h-10 w-10 object-cover object-center">
                                    </div>
                                    <div  >
                                        <h5 class="font-medium w-56 text-black dark:text-white">
                                           {{$user->name}}
                                        </h5>
                                        <p class="text-sm font-medium text-gray-400">Reply to message</p>
                                    </div>
                                </div>
                            </div>
                            <div id="messages" class="no-scrollbar max-h-full dark:text-gray-400  space-y-3.5 overflow-auto px-6 py-7.5">
                                @if(isset($messages) && $messages->isNotEmpty() )
                                    @foreach($messages as $message)
                                        @if($message->sender_id == auth()->id())
                                            <div class="ml-auto  max-w-96">
                                                <div class="mb-2.5  rounded-2xl rounded-br-none bg-blue-600 bg-primary px-5 py-3">
                                                    <p class="font-medium text-white">
                                                        {{$message->content}}
                                                    </p>
                                                </div>
                                                <p class="text-right text-xs font-medium">
                                                    {{ $message->updated_at->setTimezone('Africa/Cairo')->format(' h:i A') }}
                                                </p>
                                            </div>
                                        @else
                                            <div class="max-w-96">
                                                <p class="mb-2.5 text-sm font-medium">{{$user->name}}</p>
                                                <div class="mb-2.5 rounded-2xl rounded-tl-none bg-gray-100 px-5 py-3 dark:bg-gray-950 ">
                                                    <p class="font-medium ">
                                                        {{$message->content}}
                                                    </p>
                                                </div>
                                                <p class="text-xs font-medium">
                                                    {{ $message->updated_at->setTimezone('Africa/Cairo')->format(' h:i A') }}
                                                </p>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="text-center m-32">no message found</p>
                                @endif
                            </div>
                            <div class="sticky bottom-0 border-t border-stroke bg-white px-6 py-5 dark:bg-gray-800 dark:border-gray-700">
                                <div class="flex items-center justify-between space-x-4.5">
                                    @csrf
                                    <div class="relative w-full">
                                        <input type="text"  id="messageInput" name="message" placeholder="Type something here" class="h-13 w-full rounded-md border border-stroke bg-gray pl-5 pr-19 font-medium text-black placeholder-body outline-none focus:border-primary dark:bg-gray-950 dark:border-gray-700 dark:text-white" fdprocessedid="6r113">
                                    </div>
                                    <button type="submit" onclick="sendMessage()" class="flex h-11 w-11 ml-3  items-center justify-center rounded-md bg-blue-600 text-white hover:bg-opacity-90" fdprocessedid="d07nil">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22 2L11 13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <!-- ====== Chat Box End -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    @if(isset($user))
    <script>
        window.sendMessage = function() {
            const messageInput = document.getElementById('messageInput');
            const message = messageInput.value;
            axios.post('/chat', { message: message , id: {{$user->id}} })
                .then(response => {
                    console.log(response.data);
                    messageInput.value = '';

                    const utcDateString = response.data.updated_at;
                    const utcDate = new Date(utcDateString);
                    const options = {timeZone: 'Africa/Cairo', hour: 'numeric',minute: 'numeric'};
                    const egyptTimeString = utcDate.toLocaleString('en-US', options);

                    const messages = document.getElementById('messages');
                    const messageHTML = `
                <div class="ml-auto max-w-96">
                    <div class="mb-2.5 rounded-2xl rounded-br-none bg-blue-600 bg-primary px-5 py-3">
                        <p class="font-medium text-white">
                            ${response.data.content}
                        </p>
                    </div>
                    <p class="text-right text-xs font-medium">
                        ${egyptTimeString}
                    </p>
                </div>
            `;
                    messages.innerHTML += messageHTML;

                })
                .catch(error => console.error(error));

            console.log('sent message');
        };
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Echo !== 'undefined') {
                Echo.private(`chat.{{auth()->id()}}`)
                    .listen('MessageSent', (e) => {
                        console.log(e.message);

                        const messages2 = document.getElementById('messages');



                        const messageHtml2 = `
                                    <div class="max-w-96">
                                        <p class="mb-2.5 text-sm font-medium">{{$user->name}}</p>
                                        <div class="mb-2.5 rounded-2xl rounded-tl-none bg-gray-100 px-5 py-3 dark:bg-gray-950">
                                            <p class="font-medium">
                                                ${e.message.content}
                                            </p>
                                        </div>
                                        <p class="text-xs font-medium">
                                            ${egyptTimeString}
                                        </p>
                                    </div>
                                `;
                        messages2.innerText +=messageHtml2;
                    });
            } else {
                console.error('Echo is not defined');
            }
        });

    </script>
    @endif
</x-app-layout>
