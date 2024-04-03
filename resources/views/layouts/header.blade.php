<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">Book Inventory</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    @if (Route::current()->getName() == 'book')
                        <a class="nav-link active" aria-current="page" href="/">Books</a>
                    @else
                        <a class="nav-link" aria-current="page" href="/">Books</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if (Route::current()->getName() == 'author' || Route::current()->getName() == 'author.create')
                        <a class="nav-link active" href="/author">Authors</a>
                    @else
                        <a class="nav-link" href="/author">Authors</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if (Route::current()->getName() == 'category' || Route::current()->getName() == 'category.create')
                        <a class="nav-link active" href="/category">Categories</a>
                    @else
                        <a class="nav-link" href="/category">Categories</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
