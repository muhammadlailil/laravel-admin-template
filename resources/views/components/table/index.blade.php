<section class="bg-white rounded-md border mx-4 my-4 flex flex-col">
    <div class="px-4 py-4 flex justify-between items-center">
        <div class="flex gap-2">
            @if (@$action['search'])
                <x-input.table-search />
            @endif
            @if (@$action['filter'])
                <div class="relative">
                    <x-button.grey type="button" x-on:click="filterForm=true" icon="icon-candle-2" label="Filter"
                        elementClass="h-full" />
                    @if (request('filter'))
                        <span class="absolute w-[10px] h-[10px] rounded-full bg-[#FDA157] right-2 top-2"></span>
                    @endif
                </div>
            @endif
            {{-- @if (@$action['sorting'])
                <x-button.grey type="button" icon="icon-arrow-swap" label="Sort by" />
            @endif --}}
            @stack('button_action')
        </div>
        <div class="flex gap-2">
            @if (@$action['import'])
                <x-popup.import sample="{{ @$action['importSample'] }}" :action="route($routePath . '.import-data', ['return_url' => str_return_url()])" />
                <x-button.orange type="button" x-on:click="importPopup=true" icon="icon-import-1"
                    label="Import Data" />
            @endif
            @if (@$action['export'])
                <form action="{{ route($routePath . '.export-data', ['return_url' => str_return_url()]) }}"
                    method="POST">
                    @stack('exportParam')
                    {!! input_query() !!}
                    @csrf
                    <x-button.orange type="submit" icon="icon-export-1" label="Export Data" />
                </form>
            @endif
            @if (@$action['add'])
                @if (@$formView == 'new_page')
                    <x-button.orange href="{{ route($routePath . '.create', ['return_url' => str_return_url()]) }}"
                        icon="icon-add-square" label="Add Data" />
                @else
                    <div>
                        <x-button.orange id="btn-add-crud-form"
                            data-action="{{ @$action['add_url'] ?: route($routePath . '.store') }}"
                            x-on:click="crudForm=true" type="button" icon="icon-add-square" label="Add Data" />
                        <x-popup.crud-form :resourcePath="@$resourcePath" />
                    </div>
                @endif
            @endif
        </div>
    </div>
    @stack('pre_table')
    <div class="overflow-auto" x-data="{ selectedId: [] }">
        <form action="{{ @$action['bulkAction'] ? route("{$routePath}.bulk-action") : '' }}" formtarget="_self"
            method="POST" id="form-data-table">
            <input type="hidden" name="action_type" id="bulk_action_type">
            @csrf

            <table class="w-full border-t datatable" id="js-table">
                <thead>
                    <tr>
                        @if (@$action['bulkAction'])
                            <th
                                class="text-start uppercase bg-[#E3E3E3] border-b font-krub-regular text-[11px] font-semibold px-4 whitespace-nowrap py-2 w-[15px]">
                                <div class="relative" style="margin-top: 9px;margin-bottom: -23px;">
                                    <input type="checkbox"  id="checkall-table-list" class="w-[1px] h-[1px] border-[#ddd] bg-white input-checkbox font-normal input-checkbox-table">
                                </div>
                            </th>
                        @endif
                        @if (@$action['tableAction'])
                            <th
                                class="text-start uppercase w-[100px] bg-[#E3E3E3] border-b font-krub-regular text-[11px] font-semibold px-4 whitespace-nowrap py-2">
                                Action
                            </th>
                        @endif
                        @foreach ($columns as $column => $name)
                            <th
                                class="text-start uppercase bg-[#E3E3E3] border-b font-krub-regular text-[11px] font-semibold px-4 whitespace-nowrap py-2">
                                @if ($name)
                                    @php
                                        $sortDirection = 'desc';
                                        $iconSorting = '<i class="isax icon-arrow-3"></i>';
                                        $sortingValue = @request('filter_column')[$name];
                                        if (@$sortingValue) {
                                            if ($sortingValue == 'asc') {
                                                $iconSorting = '<i class="isax sort-icon icon-arrow-up-3"></i>';
                                                $sortDirection = 'desc';
                                            } else {
                                                $iconSorting = '<i class="isax sort-icon icon-arrow-down"></i>';
                                                $sortDirection = 'asc';
                                            }
                                        }
                                    @endphp
                                    <a href="{{ urlFilterColumn($name, $sortDirection) }}"
                                        class="flex items-center gap-2">
                                        {{ $column }}
                                        {!! $iconSorting !!}
                                    </a>
                                @else
                                    {{ $column }}
                                @endif

                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    {{ $slot }}
                </tbody>
            </table>
            @if (@$action['bulkAction'])
                <div>
                    <div x-show="selectedId.length" x-transition:enter="ease-out duration-300" x-hidden-first
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        class="bg-white shadow-lg border-4 border-[#B22041] fixed bottom-5 left-[50%] flex items-center gap-2 rounded-xl text-[12px] font-krub-semibold px-4 py-3 hidden">
                        <span><span x-text="selectedId.length"></span> Selected</span>
                        @foreach (@$action['bulkActions'] as $actions)
                            <span>|</span>
                            <button type="button" data-action="{{ $actions['action'] }}"
                                data-name=" {{ $actions['label'] }}"
                                data-target="{{ @$actions['target'] ?: '_self' }}"
                                class="flex gap-1 items-center {{ $actions['color'] }} do-triger-bulk-action">
                                {{ $actions['label'] }}
                                <i class="isax {{ $actions['icon'] }} text-[15px]"></i>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
        </form>
        @if (!$result->count())
            <div class="flex flex-col items-center justify-center py-10">
                <img src="{{ asset('assets/img/emty-state.png') }}" alt="No Data Icon" class="h-[100px]">
                <h1 class="font-krub-semibold text-[14px] mt-3">No Data Here</h1>
            </div>
        @endif
    </div>
    <div class="flex justify-between items-center table-pagination px-4 py-3">
        <div class="paginate-links">
            {{ $result->appends(request()->query())->onEachSide(2)->links() }}
        </div>
        <div class="flex gap-2 items-center">
            <div class="paginate-information text-[11px] text-[#A6ACBE] font-krub-medium">
                @php
                    $from = $result->count() ? $result->perPage() * $result->currentPage() - $result->perPage() + 1 : 0;
                    $to = $result->perPage() * $result->currentPage() - $result->perPage() + $result->count();
                @endphp
                {{ $from }} - {{ $to }} From {{ $result->total() }}
            </div>
            <div class="flex justify-center items-center gap-2">
                <select class="border rounded-md outline-none text-[11px] bg-white font-krub-medium w-[50px] py-2 px-1"
                    id="input-limit-datatable">
                    <option @selected($limit == 10) value="10">10</option>
                    <option @selected($limit == 20) value="20">20</option>
                    <option @selected($limit == 50) value="50">50</option>
                    <option @selected($limit == 100) value="100">100</option>
                    <option @selected($limit == 150) value="150">150</option>
                </select>
            </div>
        </div>
    </div>
</section>
