<x-layout>
    <section class="create">
        <div class="container">
            <h2>Edit Item : {{ $listing->title }}</h2>
            <form method="POST" action="/listings/{{ $listing->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{$listing->title}}" autocomplete="on" placeholder="Enter a title" required>
            <x-form-error name='tilte'></x-form-error>

            <label for="price">Price</label>
            <input type="text" name="price" id="price" value="{{$listing->price}}" autocomplete="on" placeholder="Enter price" required>
            <x-form-error name='price'></x-form-error>

            <label for="location">Location</label>
            <input type="text" name="location" id="location" value="{{$listing->location}}" autocomplete="on" placeholder="Enter location" required>
            <x-form-error name='location'></x-form-error>

            <label for="description">Item Description</label>                    
            <textarea type="text" id ="description" rows="4" cols="50" name="description" placeholder="New description for your item" required>{{$listing->description}}</textarea>
            <x-form-error name='description'></x-form-error>
    
            <label for="image">New Item Image</label>
            <input type="file" name="listing_img" id="listing_img" autocomplete="on">
            <img src="{{ asset('storage/' . $listing->listing_img) }}" alt="{{ $listing->title }}" style="max-width: 250px;"
            >
            <x-form-error name='listing_img'></x-form-error>
    
            <hr>

            <div>
                <a href="/listings/{{ $listing->id }}" type="button" class="btn">Cancel</a>
                <a href="{{ route('listings.destroy-confirmation', $listing->id) }}" type="button" class="btn">Delete</a>
                <button type="submit">Update</button>
            </div>
        </form>
        </div>
    </section> 
</x-layout>