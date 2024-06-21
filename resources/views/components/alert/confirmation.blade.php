<div x-data="{ confirmation: false }" x-on:keydown.escape.window="confirmation = false" class="relative z-50 w-auto h-auto">
    <button type="button" id="btn-toogle-confirmation" class="hidden" x-on:click="confirmation=!confirmation"></button>
    <div id="confirmation"  x-show="confirmation" class="hidden fixed top-0 left-0 z-[99] items-center justify-center w-screen h-screen">
        <div x-show="confirmation" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-on:click="confirmation=false"
            class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
        <div x-show="confirmation" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative w-full py-6 bg-white px-7 sm:max-w-sm sm:rounded-lg">
            <form method="POST" class="flex flex-col gap-4 items-center justify-center w-auto">
               @csrf
               <input type="hidden" name="_method">
                <svg width="120" height="120" viewBox="0 0 120 120" fill="none"
                    xmlns="http://www.w3.org/2000/svg" class="w-[100px] h-[100px]">
                    <path
                        d="M60 113.75C30.35 113.75 6.25 89.65 6.25 60C6.25 30.35 30.35 6.25 60 6.25C89.65 6.25 113.75 30.35 113.75 60C113.75 89.65 89.65 113.75 60 113.75ZM60 13.75C34.5 13.75 13.75 34.5 13.75 60C13.75 85.5 34.5 106.25 60 106.25C85.5 106.25 106.25 85.5 106.25 60C106.25 34.5 85.5 13.75 60 13.75Z"
                        fill="#D12D4E" />
                    <path
                        d="M60 68.75C57.95 68.75 56.25 67.05 56.25 65V40C56.25 37.95 57.95 36.25 60 36.25C62.05 36.25 63.75 37.95 63.75 40V65C63.75 67.05 62.05 68.75 60 68.75Z"
                        fill="#D12D4E" />
                    <path
                        d="M60 84.9999C59.35 84.9999 58.7 84.8499 58.1 84.5999C57.5 84.3499 56.95 83.9999 56.45 83.5499C56 83.0499 55.65 82.5499 55.4 81.8999C55.15 81.2999 55 80.6499 55 79.9999C55 79.3499 55.15 78.6999 55.4 78.0999C55.65 77.4999 56 76.9499 56.45 76.4499C56.95 75.9999 57.5 75.6499 58.1 75.3999C59.3 74.8999 60.7 74.8999 61.9 75.3999C62.5 75.6499 63.05 75.9999 63.55 76.4499C64 76.9499 64.35 77.4999 64.6 78.0999C64.85 78.6999 65 79.3499 65 79.9999C65 80.6499 64.85 81.2999 64.6 81.8999C64.35 82.5499 64 83.0499 63.55 83.5499C63.05 83.9999 62.5 84.3499 61.9 84.5999C61.3 84.8499 60.65 84.9999 60 84.9999Z"
                        fill="#D12D4E" />
                </svg>

                <p class="text-[16px] font-krub-semibold message text-center">
                </p>
                <div class="flex gap-3">
                    <x-button.danger x-on:click="confirmation=false" type="button" label="Cancel"
                        elementClass="py-[10px] w-[100px]" />
                    <x-button.grey type="submit" label="Yes" elementClass="py-[10px] w-[100px] btn-confirm-yes" />
                </div>
            </form>
        </div>
    </div>
</div>
