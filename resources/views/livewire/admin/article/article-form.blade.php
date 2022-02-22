<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Article') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4 pb-4">
        <x-card>
            <div class="grid grid-cols-6 gap-x-6">
                {{-- form --}}
                <div class="lg:col-span-5 md:col-span-4 sm:col-span-6">
                    <div class="grid grid-cols-2 gap-4">
            
                        <div class="col-span-1">
                            <x-input label="{{__('Title')}}" placeholder="{{__('Article Title')}}" wire:model="article.title" autofocus/>
                        </div>
            
                        <div class="col-span-1">
                            <x-input label="{{__('Slug')}}" placeholder="{{__('Article Slug')}}" wire:model="article.slug" class="bg-gray-100" readonly />
                        </div>
            
                        <div class="col-span-1">
                            <x-native-select
                                label="{{__('Department')}}"
                                placeholder="{{__('Select a Department')}}"
                                :options="$this->departments"
                                option-label="name"
                                option-value="id"
                                wire:model.defer="article.department_id"
                            />
                        </div>
            
                        <div class="col-span-1">
                            <x-native-select
                                label="{{__('Category')}}"
                                placeholder="{{__('Select a category')}}"
                                :options="$this->categories"
                                option-label="name"
                                option-value="id"
                                wire:model.defer="article.category_id"
                            />
                        </div>
            
                        <div class="col-span-2 border border-gray-200 rounded shadow" x-data="" x-init="" wire:ignore>
                            <div id="toolbar-container"></div>
                            <div class="wysiwyg">
                                {!! $article->body !!}
                            </div>
                        </div>
            
                        <div class="col-span-1">
                            <x-native-select
                                label="{{__('Author')}}"
                                placeholder="{{__('Select a author')}}"
                                :options="$this->users"
                                option-label="name"
                                option-value="id"
                                wire:model.defer="article.user_id"
                            />
                        </div>
                        
                        @push('js')
                        <script>
                            function MyUploadAdapter(editor) {
                                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                                    return {
                                        upload() {
                                            return loader.file.then(file => new Promise((resolve, reject) => {
                                                let form_data = new FormData();
                                                form_data.append('file', file);
                                                axios.post('{{ route('admin.articles.upload') }}', form_data, {
                                                    headers: {'Content-Type': 'multipart/form-data'}
                                                }).then(response => {
                                                    resolve({
                                                        default: response.data
                                                    })
                                                })
                                            }))
                                        },
                                        abort() {}
                                    }
                                }
                            }
            
                            var ready = (callback) => {
                                if (document.readyState != "loading") callback();
                                else document.addEventListener("DOMContentLoaded", callback);
                            }
                            ready(() => { 
            
                                DecoupledEditor.create( document.querySelector('.wysiwyg'), {
                                    extraPlugins:[MyUploadAdapter],
                                })
                                .then(function(editor) {
                                    const toolbarContainer = document.querySelector( '#toolbar-container' );
                                    toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                                    editor.model.document.on('change:data', () => {
                                        @this.set('article.body', editor.getData())
                                    })
                                })
                                .catch( error => {
                                    console.error( error );
                                });
                            }); 
                        </script>
                        @endpush
                    </div>
                </div>
                {{-- featured image --}}
                <div class="lg:col-span-1 md:col-span-2 sm:col-span-6 sm:mt-4">
                    <x-card title="{{__('Featured Image')}}">
                        
                        {{-- @if ($featured_image)
                            <img src="{{ $featured_image->temporaryUrl() }}" class="mb-4 rounded-md">
                        @endif
                        
                        <input type="file" wire:model="featured_image">
                        
                        @error('featured_image') <span class="error">{{ $message }}</span> @enderror --}}
                        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                            
                            <input type="file" class="hidden"
                                        wire:model="featured_image"
                                        x-ref="featured_image"
                                        x-on:change="
                                                photoName = $refs.featured_image.files[0].name;
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    photoPreview = e.target.result;
                                                };
                                                reader.readAsDataURL($refs.featured_image.files[0]);
                                        " />
            
                            <!-- Current featured image -->
                            <div class="mt-2 mx-auto" x-show="! photoPreview">
                                <img src="{{ $article->featured_image ? Storage::url($article->featured_image) : asset('images/no-img.png') }}" alt="" 
                                    class="block rounded-md object-cover cursor-pointer" 
                                    x-on:click.prevent="$refs.featured_image.click()">
                            </div>
            
                            <!-- New featured image Preview -->
                            <div class="mt-2" x-show="photoPreview">
                                <span class="block h-36 w-36 rounded-md bg-cover bg-no-repeat bg-center"
                                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>
            
                            @if ($article->featured_image)
                                <x-button xs icon="trash" secondary label="{{ __('Remove Photo') }}" wire:click="deleteFeaturedImage" spinner class="w-full mt-2"/>
                            @endif
            
                            @error('featured_image') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        
                    </x-card>
                </div>
                
            </div>

            <x-slot name="footer">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-x-2">
                        <x-button label="Return to List" secondary wire:click="returnToList" />
                        <x-button label="Save" icon="check-circle" primary wire:click="save" />
                    </div>
                </div>
            </x-slot>
        </x-card>
    </div>
</div>
