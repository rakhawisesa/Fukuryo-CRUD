<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book | Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    @include('layouts.header');

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Update {{ $book->name }} book</h1>
                <form class="mt-5" action="/book/{{ $book->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text"
                                class="form-control @error('name')
                                is-invalid
                            @enderror"
                                id="name" name="name" required
                                value="{{ old('name') ? old('name') : $book->name }}">
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
                        <div class="col-sm-10">
                            <input type="text"
                                class="form-control @error('isbn')
                                is-invalid
                            @enderror"
                                id="isbn" name="isbn" required
                                value="{{ old('isbn') ? old('isbn') : $book->isbn }}">
                            @error('dob')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="isbn" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select
                                class="form-select @error('category_id')
                                    is-invalid
                                @enderror"
                                name="category_id" required>
                                <option selected disabled>Category</option>
                                @if (old('category_id'))
                                    @foreach ($categories as $c)
                                        @if ($c->status == 'enable')
                                            <option value="{{ $c->id }}"
                                                {{ old('category_id') == $c->id ? 'selected' : '' }}>
                                                {{ $c->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($categories as $c)
                                        @if ($c->status == 'enable')
                                            <option value="{{ $c->id }}"
                                                {{ $c->id == $book->category->id ? 'selected' : '' }}>
                                                {{ $c->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="isbn" class="col-sm-2 col-form-label">Author</label>
                        <div class="col-sm-10">
                            <select
                                class="form-select @error('author_id')
                                    is-invalid
                                @enderror"
                                name="author_id" required>
                                <option selected disabled>Author</option>
                                @if (old('author_id'))
                                    @foreach ($authors as $a)
                                        <option value="{{ $a->id }}"
                                            {{ old('author_id') == $a->id ? 'selected' : '' }}>
                                            {{ $a->name }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach ($authors as $a)
                                        <option value="{{ $a->id }}"
                                            {{ $a->id == $book->author->id ? 'selected' : '' }}>{{ $a->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('author_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-5">Update</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
