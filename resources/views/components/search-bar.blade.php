<section class="search">
    <div class="container">
        <h2>{{$slot}}</h2>
        <form action="/search" method="GET">
            <input type="text" name="query" placeholder="Search...">
        </form>
    </div>
</section>