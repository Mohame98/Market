@props(['listing', 'watchlist'])
<div 
data-aos="fade" 
data-aos-duration="700" 
class="card">
    <a href="/listings/{{ $listing['id'] }}">
        <p class="user">{{$listing->trader->truncatedUsername}}</p>
        <div class="img">
            <img src="{{ asset('storage/'. $listing->listing_img) }}" alt="">
        </div>
        <p>{{$listing->truncatedDescription}}</p>
        <div class="wrapper">
            <p>{{$listing->truncatedTitle}}</p>
            <p>{{$listing->truncatedPrice}}$</p>
        </div>
    </a>
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

