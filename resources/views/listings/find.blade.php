@props(['listing'])
<x-layout>
    <section class="item-cards search">
        <div class="container">
           <x-section-heading>Search Results
           </x-section-heading>
           <x-search-bar>Seach for more items</x-search-bar>
            <div class="grid"> 
                @foreach ($listings as $listing)
                    <x-listing-card :$listing 
                    :watchlist="$watchlist"
                    />
                @endforeach
            </div>
        </div>
    </section>
</x-layout>