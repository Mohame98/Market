@props(['listings', 'watchlist'])
<x-layout>
    @auth
        <x-welcome>{{ auth()->user()->trader->username }}</x-welcome>
    @endauth
    <x-search-bar>Seach for an item here</x-search-bar>
    <section class="item-cards">
        <div class="container">
           <x-section-heading>Featured Items</x-section-heading>
            <div class="grid" id="listing-container"> 
                @foreach ($listings as $listing)
                    <x-listing-card 
                    :listing="$listing" 
                    :watchlist="$watchlist"
                    />
                @endforeach
            </div>
            <div class="paginator">
                {{$listings->links()}}
            </div>
        </div> 
    </section>
 </x-layout>