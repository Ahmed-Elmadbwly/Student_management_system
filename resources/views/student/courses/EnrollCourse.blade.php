<x-app-layout>
    <h2 class="text-title-md3 mb-3 mt-4 font-bold text-black dark:text-white">
        {{ __('Payment form') }}
    </h2>
        <form id="payment-form" method="POST" action="{{route('student.courses.payment')}}">
            @csrf
            <div class="mb-6">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" value="{{$course->title}}" id="title" disabled name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="mb-6">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                <input type="text" value="{{$course->price}}" id="price"  disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <input type="hidden" name="price" value="{{$course->price}}">
                <input type="hidden" name="id" value="{{$course->id}}">
            </div>
            <div>
                <div id="card-element" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div id="card-errors" class="text-red-700"></div>
            </div>
            <div class="flex items-center justify-end mt-4">
            <x-primary-button type="submit" class="ms-4">
                {{ __('Submit Payment') }}
            </x-primary-button>
            </div>
        </form>


        <script src="https://js.stripe.com/v3/"></script>
        <script>
                console.log("Stripe Key: {{ env('STRIPE_KEY') }}");

    var stripe = Stripe('{{env('STRIPE_KEY')  }}', {
                locale: 'en'
            });
            var elements = stripe.elements();

            var card = elements.create('card');
            card.mount('#card-element');

            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', result.token.id);
                        form.appendChild(hiddenInput);

                        form.submit();
                    }
                });
            });
        </script>
</x-app-layout>
