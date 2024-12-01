<x-layout>
    <section class="register">
        <div class="container">
            <h2>Register</h2>
            <form method="POST" action="/register">
                @csrf
                <label for="name">First Name</label>
                <input type="text" name="name" id="name" :value="old('name')" autocomplete="on" placeholder="Enter name" required>
                <x-form-error name='name'></x-form-error>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" :value="old('email')" autocomplete="on" placeholder="Enter Email" required>
                <x-form-error name='email'></x-form-error>

                <label for="password">Password</label>
                <input type="password" name="password" id="pass" :value="old('password')" autocomplete="on" placeholder="Enter password" required>
                <x-form-error name='password'></x-form-error>

                <label for="password">Confirm Password</label>
                <input type="password" name="password_confirmation" id="c-pass" autocomplete="on" placeholder="Re-enter password" required>
                <x-form-error name='password_confirmation'></x-form-error>
        
                <hr>

                <label for="name">Username</label>
                <input type="text" name="username" id="user" :value="old('trader')" autocomplete="on" placeholder="Enter User" required>
                <x-form-error name='trader'></x-form-error>
            
                <button type="submit">Sign up</button>
            </form>
        </div>
    </section> 
</x-layout>