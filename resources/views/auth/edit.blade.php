<x-layout>
    <section class="create">
        <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="error alert-error">
                {{ session('error') }}
            </div>
        @endif
        <h2>Profile</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <h2>Change Profile Information</h2>
            <label for="name">First Name</label>
            <input type="text" name="name" id="name" :value="" autocomplete="on" placeholder="Enter name">
            <x-form-error name='name'></x-form-error>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" :value="" autocomplete="on" placeholder="Enter Email">
            <x-form-error name='email'></x-form-error>
            <button type="submit">Save</button>
        </form>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <hr>
            <h2>Change Password</h2>
            <p>Ensure your account is using a long, random password to stay secure</p>
            <label for="password">Current Password</label>
            <input type="password" name="current_password" id="pass" :value="" autocomplete="on" placeholder="Current password" required>
            <x-form-error name='current_password'></x-form-error>

            <label for="password">New Password</label>
            <input type="password" name="password" id="pass" autocomplete="on" placeholder="New password" required>
            <x-form-error name='password'></x-form-error>

            <label for="password">Confirm Password</label>
            <input type="password" name="password_confirmation" id="c-pass" autocomplete="on" placeholder="Re-enter password" required>
            <x-form-error name='password_confirmation'></x-form-error>
            <button type="submit">Save</button>

            <hr>
            <h2>Delete Account</h2>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
            <div>
                <a href="/" type="button" class="btn">Cancel</a>
                <a class="btn" href="/auth/delete-confirmation">Delete</a>
            </div>
        </form>
        </div>
    </section> 
</x-layout>