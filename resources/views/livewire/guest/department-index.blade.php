<x-guest-layout>
    <div class="bg-cover" style="background-image: url({{ asset('images/bg1.jpg') }})">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">
            <div class="w-full md:w-3/4 lg:w-1/2">
                <h1 class="text-white font-bold text-4xl">SKBase</h1>
                <p class="text-white text-lg mb-4">Simple Knowledge Base</p>

                <x-input placeholder="{{__('Search for')}}">
                    <x-slot name="append">
                        <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                            <x-button
                                class="rounded-r-md h-full"
                                icon="search"
                                primary
                                flat
                                squared
                            />
                        </div>
                    </x-slot>
                </x-input>

            </div>
        </div>
    </div>

    <div class="mt-10 mb-10">
        <h1 class="text-gray-600 text-center text-3xl mb-10">
            {{__('Departments')}}
        </h1>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach ($this->departments as $item)
                <a href="">
                    <article>
                        <figure>
                            <img class="rounded-xl h-36 w-full object-cover" src="{{asset('images/home/01.jpg')}}" alt="">
                        </figure>
                        <header class="mt-2">
                            <h2 class="text-center text-xl text-gray-700">{{$item->name}}</h2>
                        </header>
                    </article>
                </a>
            @endforeach
            
        </div>
    </div>

</x-guest-layout>
