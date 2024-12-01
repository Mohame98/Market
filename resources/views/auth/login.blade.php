<x-layout>
    <section class="login">
        <div class="container">
            <h2>Log In</h2>
            <form method="POST" action="/login">
                @csrf
                <x-form-error name='email'></x-form-error>
                <x-form-error name='password'></x-form-error>
                
                <label for="email">Email</label>
                <input type="email" name="email" id="email" :value="old('email')" autocomplete="on" placeholder="Enter Email" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="pass" autocomplete="on" placeholder="Enter password" required>

                <button type="submit">Log In</button>
            </form>
        </div>
    </section> 
</x-layout>