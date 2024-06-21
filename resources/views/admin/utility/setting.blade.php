<x-layout.admin title="Setting">
    <form action="{{ route('admin.setting.store') }}" method="POST"
        class="bg-white rounded-lg border mx-4 my-4  max-w-[50%]">
        <div class="px-5 py-3 border-b flex justify-between items-center">
            <h1 class="font-krub-medium text-[16px]" id="form-page-title">
                Setting
            </h1>
            <div class="flex gap-3">
                <x-button.orange type="submit" label="Submit" elementClass="py-[10px]" />
            </div>
        </div>
        <div class="px-4 py-3 flex flex-col gap-3">
          @csrf
            <x-input type="number" id="efficiency_percentage" name="efficiency_percentage"
                label="Efficiency Percentage (%)" required placeholder="Efficiency Percentage (%)" max="100" value="{{@$setting->efficiency_percentage}}" />
        </div>
        <br>
        <br>
    </form>
</x-layout.admin>
