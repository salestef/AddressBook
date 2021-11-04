<x-layout>
<div class="container">

@include('admin._header')
    <a class="button-add" style="width: 200px" href="/admin/agency/add">Add Agency</a>
    <div class="agency-contacts"></div>
</div>
<script>
    $(document).ready(function () {
        getAgencies();
    });
</script>
</x-layout>
