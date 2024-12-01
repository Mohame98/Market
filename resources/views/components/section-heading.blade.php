<div class="title-post">
    <h3> {{$slot}} </h3>
    @auth
        <div class="post-btn">
            <x-nav-links href="/listings/create" :active="request()->is('create')">POST AN ITEM</x-nav-links>
        </div>
    @endauth
</div>

