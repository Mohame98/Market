<x-layout>
    <section class="confirmation">
        <div class="container">
        <h2>Confirm Item Deletion</h2>
        <p>Are you sure you want to delete your Item? This action cannot be undone.</p>
        <form method="POST" id="delete-form" action="/listings/{{$listing->id}}" class="hidden">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">Yes, Delete My Listing</button>
            <a href="/listings/{{ $listing->id }}" type="button" class="btn">Cancel</a>
        </form>
        </div>
    </section>
</x-layout>