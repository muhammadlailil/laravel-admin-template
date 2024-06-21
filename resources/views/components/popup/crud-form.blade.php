<div x-on:keydown.escape.window="crudForm = false" class="relative z-50 w-auto h-auto">
    <button type="button" id="btn-toogle-crudForm" class="hidden" x-on:click="crudForm=!crudForm"></button>
    <div x-show="crudForm" x-hidden-first class="hidden fixed top-0 left-0 z-[99] items-center justify-center w-screen h-screen">
        <div x-show="crudForm" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-on:click="crudForm=false"
            class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
        <div x-show="crudForm" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">
            <div class="flex items-center justify-between pb-2  mb-4">
                <h3 class="text-lg font-semibold" id="form-crud-title">Add Data</h3>
                <button x-on:click="crudForm=false">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form method="POST" id="form-crud" class="flex flex-col gap-4 items-center justify-center w-auto">
                @csrf
                <input type="hidden" id="_method" name="_method" value="POST">
                @include(@$resourcePath.'.form')
                <div class="flex gap-3 mt-5">
                    <x-button.grey x-on:click="crudForm=false" type="button" label="Cancel"
                        elementClass="py-[10px] w-[100px]" />
                    <x-button.blue type="submit" label="Submit" elementClass="py-[10px] w-[100px]" />
                </div>
            </form>
        </div>
    </div>
</div>
