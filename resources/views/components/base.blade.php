<!DOCTYPE html>
<html lang="en">
<x-header />
<body>
    <x-bodyHeader />

        {{$slot}}

    <x-bodyFooter/>
    <x-footer/>
@yield('scripts')
</body>
<script type="text/javascript">
    @if (count($errors) > 0)
    $('#login-modal').modal('show');
    @endif
</script>
</html>
