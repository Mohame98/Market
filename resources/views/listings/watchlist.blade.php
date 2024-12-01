@props(['listing', 'watchlist'])
<x-layout>
    <section class="item-cards">
        <div class="container">
           <x-section-heading>Your Watchlist</x-section-heading>
            <div class="grid"> 
                @if($listings->isEmpty())
                    <p>Your watchlist is empty.</p>
                @else
                    @foreach($listings as $listing)
                        <x-listing-card 
                        :$listing 
                        :watchlist="$watchlist"
                        />
                    @endforeach
                @endif
            </div>
        </div>
    </section>
</x-layout>
