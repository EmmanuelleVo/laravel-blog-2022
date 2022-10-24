<x-header></x-header>
<div class="flex items-center justify-between">
    <h1 class="text-xl font-bold text-gray-700 md:text-2xl">All Posts</h1>
</div>
<livewire:search-term-field/>
<livewire:select-order-date/>
<livewire:posts :posts="$posts"/>

<x-footer></x-footer>
</body>
@livewireScripts
</html>
