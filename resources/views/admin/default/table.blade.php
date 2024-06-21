<x-layout.admin :title="$pageTitle">
    <x-table :columns="$tableColumns" :action="$action" :routePath="$routePath" :result="$data" :formView="$formView" limit="{{$limit}}"
        :resourcePath="$resourcePath">
        @include($datatableViews)
    </x-table>
</x-layout.admin>