@props(['listing'])
<x-layout>
    <section class="show">
        <div class="container">
            <div data-aos="fade-up" data-aos-duration="1200" class="flex">
                <div class="card-product">
                    <div class="product">
                        <img 
                        src="{{ asset('storage/'. $listing->listing_img) }}" 
                        alt="{{ $listing->title }}">
                    </div>
                </div> 
                <div class="card-content">
                    <div class="content">
                        <p><span>User :</span> {{$listing->trader->username}}</p>
                        <p><span>Item Name :</span> {{$listing->title}}</p>
                        <p><span>Description :</span> {{$listing->description}}</p>
                        <p><span>Approxiamte Location :</span> {{$listing->location}}</p>
                        <p><span>Estimated Value :</span> {{$listing->price}}</p>
                        @if(auth()->id() !== $listing->trader->user_id)
                            <form action="{{ route('contact.me', $listing->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Contact Me</button>
                            </form>
                        @endif 
                        @can('edit-listing', $listing)
                            <div class="edit-btn">
                                <a class="btn" href="/listings/{{ $listing->id }}/edit">Edit Your Listing</a>
                            </div>
                        @endcan  
                    </div>
                </div>
                <div class="icon">
                    @auth
                        @if(auth()->id() !== $listing->trader->user_id)
                            <form action="{{ route('watchlist.toggle') }}" method="POST">
                                @csrf
                                <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                <button type="submit">
                                    <i class="{{ $watchlist->contains('listing_id', $listing->id) ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div> 
        </div>
    </section>
</x-layout>