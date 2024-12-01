<x-layout>
    <section class="confirmation">
        <div class="container">
        <h2>Confirm Account Deletion</h2>
        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
        <form method="POST" action="{{ route('account.delete') }}">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">Yes, Delete My Account</button>
            <a href="{{ url('/') }}" class="btn">Cancel</a>
        </form>
        </div>
    </section>
</x-layout>