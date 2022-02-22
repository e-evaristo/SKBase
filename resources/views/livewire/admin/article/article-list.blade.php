<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>
    
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4 pb-12">
            
            <div class="shadow border-b border-gray-200 sm:rounded-lg overflow-hidden">
                <div class="p-4 flex items-center justify-between">
                    <div class="flex items-center gap-x-4">
                        <x-input icon="search" placeholder="{{__('Search Title')}}" wire:model.debounce.500ms="search" required autofocus />
                        <x-native-select
                            placeholder="{{__('Filter by Departments')}}"
                            :options="$this->departments"
                            option-label="name"
                            option-value="id"
                            wire:model="department_id"
                        />
                        <x-native-select
                            placeholder="{{__('Filter by Category')}}"
                            :options="$this->categories"
                            option-label="name"
                            option-value="id"
                            wire:model="category_id"
                        />
                    </div>
                    
                    <a href="{{ route('admin.articles.form') }}" class="focus:outline-none px-2.5 py-1.5 flex justify-center gap-x-2 items-center transition-all ease-in duration-75 focus:ring-2 focus:ring-offset-2 hover:shadow-sm disabled:opacity-60 disabled:cursor-not-allowed rounded-md text-sm ring-primary-600 text-white bg-primary-500 hover:bg-primary-600 dark:ring-offset-secondary-800 dark:bg-primary-700 dark:ring-primary-700">
                        <i class="fas fa-plus-circle mr-2"></i> Add
                    </a>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('Title')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('Category')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('Department')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('Created At')}}
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($this->articles as $item)
                        <tr class="odd:bg-gray-50">
                            <td class="px-2 py-4 border">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm text-gray-700 uppercase font-bold">
                                            <a href="{{ route('admin.articles.form',$item->id) }}">{{ $item->title }}</a>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{__('by')}} {{ $item->user->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap border">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-700 uppercase">
                                            {{ $item->category->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap border">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-700 uppercase">
                                            {{ $item->department->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap border">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-700 uppercase">
                                            {{ $item->created_at->format('Y-m-d') }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center text-sm font-medium border">
                                <div>
                                    <x-button icon="trash" flat negative 
                                        x-on:confirm="{
                                            title: '{{ __('Are you sure?') }}',
                                            icon: 'warning',
                                            method: 'delete',
                                            params: '{{$item->id}}'
                                        }"
                                     />
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-4 py-4">
                    {{ $this->articles->links() }}
                </div>
            </div>
            
        </div>
    </div>
</div>