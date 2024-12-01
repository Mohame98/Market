<x-layout>
  <section class="contact-noti">
        <div class="container">
            <p>Hello {{ $listing->trader->username }},</p>
            <p>
                We wanted to let you know that user {{$user->trader->username}} is interested in your listing {{ $listing->title }} you had priced at {{$listing->price}}$. <br>
                Send them an email: {{$user->email}}.
            </p>

            <p>
                <a href="{{url('/listings/' . $listing->id) }}">View your listing Here</a>
            </p>
            <p>Best regards,<br>MARKETGHOST</p>
        </div>
    </section>      
</x-layout>