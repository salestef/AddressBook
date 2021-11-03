<x-layout>
<div class="container">

@include('admin._header')
    <a class="button-add" href="/admin/agency/add">Add Agency</a>
    <div class="agency-wrapper"></div>
</div>
<script>
    $(document).ready(function () {
        getAgencies();
    });
</script>
</x-layout>
