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
</html>
