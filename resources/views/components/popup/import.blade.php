<div x-on:keydown.escape.window="importPopup = false" class="relative z-50 w-auto h-auto">
     <button type="button" id="btn-toogle-importPopup" class="hidden" x-on:click="importPopup=!importPopup"></button>
     <div x-show="importPopup" x-hidden-first class="hidden fixed top-0 left-0 z-[99] items-center justify-center w-screen h-screen">
         <div x-show="importPopup" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-on:click="importPopup=false"
             class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
         <div x-show="importPopup" x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative w-full py-6 bg-white px-7 sm:max-w-md sm:rounded-lg">
             <div class="flex items-center justify-between pb-2  mb-4">
                 <h3 class="text-lg font-semibold" id="form-crud-title">
                    Import Data
                 </h3>
                 <button x-on:click="importPopup=false">
                     <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                     </svg>
                 </button>
             </div>
             <form method="POST" action="{{$action}}" id="form-popup-import" enctype='multipart/form-data' class="flex flex-col gap-4 items-center justify-center w-auto" x-data="{processing:false}">
                 @csrf
                 <div class="empty-data flex flex-col items-center justify-center">
                    <img src="{{asset('assets/img/emty-state.png')}}" alt="">
                    <p class="text-[#A6ACBE] font-krub-medium">No Data Here</p>
                    <button type="button" id="btn-import-choose-file" class="bg-[#FFA258] text-white text-[13px] px-3 py-2 font-krub-medium flex gap-2 items-center justify-center rounded-md mt-2">
                         Upload Document
                         <i class="isax-b icon-import-2 text-[15px] block mt-[-4px]"></i>
                    </button>
                    <input type="file" name="import_file" id="file-upload-import" required class="hidden h-[0px] w-[0px]" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,.csv">
                    @if($sample)
                    <p class="mt-3 text-[13px]">
                        Klik <a href="{{$sample}}" download class="underline text-blue-500">disini</a> untuk mendownload sample format file
                    </p>
                    @endif
                 </div>
                 <div class="hidden flex justify-between items-center w-full border px-3 py-2 rounded-md file-import-uploaded">
                    <p id="import-filename" class="text-[#4A86E4] font-krub-medium text-[14px]">
                    </p>
                    <button type="button" id="import-clear-file" class="block mt-[5px]">
                         <i class="isax-b icon-close-circle text-[#9DA5A1] text-[19px]"></i>
                    </button>
                 </div>
                 <span x-show="processing">Processing ...</span>
                 <div class="flex gap-3 mt-5">
                     <x-button.grey x-on:click="importPopup=false" type="button" label="Cancel"
                         elementClass="py-[10px] w-[100px]" />
                     <x-button.orange type="submit" label="Submit" x-on:click="setTimeout(()=>{processing=true},500)" x-bind:disabled="processing" disabled elementClass="py-[10px] w-[100px]" />
                 </div>
             </form>
         </div>
     </div>
 </div>
 