@props(['listing'])
<x-layout>
    <section class="item-cards">
        <div class="container">
           <x-section-heading>Your Current Listings
           </x-section-heading>
            <div class="grid"> 
                @if($listings->isEmpty())
                    <p>You have no items listed.</p>
                @else
                    @foreach($listings as $listing)
                        <x-listing-card :listing="$listing" />
                    @endforeach
                @endif
            </div>
        </div>
    </section>
</x-layout>
