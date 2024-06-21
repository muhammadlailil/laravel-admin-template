<x-layout.admin :title="$pageTitle" :breadcrumb="$breadcrumb">
    <form action="{{ $formAction }}" class="bg-white rounded-lg border mx-4 my-4 flex flex-col" method="POST"
        enctype='multipart/form-data' id="form-main-process">
        @csrf
        @if ($formType == 'update')
            @method('PATCH')
        @endif
        @if (request('return_url'))
            <input type="hidden" name="return_url" value="{{ request('return_url') }}">
        @endif
        <div class="px-5 py-3 border-b flex justify-between items-center">
            <h1 class="font-krub-medium text-[16px]" id="form-page-title">
                {{ $formTitle }}
            </h1>
            <div class="flex gap-3">
                <x-button.grey href="{{ route($routePath . '.index') }}" id="btn-back-form" label="Cancel" elementClass="py-[10px]" />
                @stack('button_action')
                <x-button.orange type="submit" label="Submit" elementClass="py-[10px]" />
            </div>
        </div>
        <div class="px-5 py-5 max-h-[calc(100vh-170px)] overflow-auto">
            @include($formViews)
        </div>
    </form>
</x-layout.admin>
