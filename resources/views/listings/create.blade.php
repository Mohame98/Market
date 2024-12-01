<x-layout>
    <section class="create">
        <div class="container">
        <h2>Post an item</h2>

        <form method="POST" action="/listings" enctype="multipart/form-data">
        @csrf
            <label for="title">Title</label>
            <input type="text" name="title" id="title" :value="old('title')" autocomplete="on" placeholder="Enter a title" required>
            <x-form-error name='tilte'></x-form-error>

            <label for="price">Price</label>
            <input type="text" name="price" id="price" :value="old('price')" autocomplete="on" placeholder="Enter price" required>
            <x-form-error name='price'></x-form-error>

            <label for="location">Location</label>
            <input type="text" name="location" id="location" :value="old('location')" autocomplete="on" placeholder="Enter location" required>
            <x-form-error name='location'></x-form-error>

            <label for="description">Item Description</label>                    
            <textarea type="text" id ="description" rows="4" cols="50" name="description" placeholder="Describe your item" required ></textarea>
            <x-form-error name='description'></x-form-error>
    
            <label for="image">Item Image</label>
            <input type="file" name="listing_img" id="listing_img" autocomplete="on" placeholder="Upload an image" required>
            <x-form-error name='listing_img'></x-form-error>
    
            <hr>

            <button type="submit">Post</button>
        </form>
        </div>
    </section> 
</x-layout>