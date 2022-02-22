<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4 pb-12">
            
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="p-4 flex items-center justify-between">
                    <x-input icon="search" placeholder="{{__('Search Name')}}" wire:model.debounce.500ms="search" required autofocus />
                    <x-button icon="plus-circle" primary label="Add" class="ml-2" wire:click="create" />
                </div>
                <table class="min-w-full">
                    <thead class="bg-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('Name')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('Articles')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('Created At')}}
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($this->categories as $item)
                        <tr class="odd:bg-gray-50">
                            <td class="px-2 py-4 whitespace-nowrap border">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm text-gray-700 uppercase font-bold">                                            
                                            <a href="javascript:void(0)" wire:click="edit({{$item}})">{{ $item->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap border">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-700 uppercase">
                                            {{ $item->articles_count }}
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
                            <td class="px-2 py-4 text-center text-sm font-medium border mx-auto">
                                <x-button icon="trash" flat negative 
                                    x-on:confirm="{
                                        title: '{{ __('Are you sure?') }}',
                                        description: '{{ __('Also excludes related articles') }}',
                                        icon: 'warning',
                                        method: 'delete',
                                        params: '{{$item->id}}'
                                    }"
                                />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-4 py-2">
                    {{ $this->categories->links() }}
                </div>
            </div>
            
        </div>
    </div>

    <x-modal.card title="{{__('Category')}}" blur wire:model.defer="cardModal">
        <div class="grid grid-cols-1 gap-y-2">
            <x-input label="{{__('Name')}}" placeholder="{{__('Category Name')}}" wire:model="name" autofocus/>
            <x-input label="{{__('Slug')}}" placeholder="{{__('Category Slug')}}" wire:model="slug" class="bg-gray-100" readonly />
        </div>
     
        <x-slot name="footer">
            <div class="flex justify-between gap-x-4">
                <div class="flex">
                    <x-button flat label="{{__('Cancel')}}" x-on:click="close" class="mr-2" />
                    @if (empty($category_id))
                        <x-button primary label="{{__('Create')}}" icon="check" wire:click="store" />
                    @else
                        <x-button primary label="{{__('Update')}}" icon="check" wire:click="update" />
                    @endif
                </div>
            </div>
        </x-slot>
    </x-modal.card>

</div>
