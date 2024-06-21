<div class="md:max-w-[80%]  flex flex-col gap-4">
    <x-input type="text" id="name" name="name" label="Name" required placeholder="Name" :value="old('name')"/>
    <x-input type="number" id="line_number" name="line_number" label="Line ST" required placeholder="Line ST" :value="old('line_number')"/>
    <x-input type="number" id="employee_count" name="employee_count" label="Employee Count" required placeholder="Employee Count" :value="old('employee_count')"/>
</div>
