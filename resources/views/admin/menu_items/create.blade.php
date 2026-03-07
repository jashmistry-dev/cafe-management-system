<h2>Add Menu Item</h2>

<form method="POST" action="{{ route('menu-items.store') }}">
    @csrf

    <label>Name</label>
    <input type="text" name="name">

    <br><br>

    <label>Price</label>
    <input type="number" name="price">

    <br><br>

    <label>Category</label>
    <select name="category_id">

        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach

    </select>

    <br><br>

    <button type="submit">Save Item</button>

</form>