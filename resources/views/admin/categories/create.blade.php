<h2>Create Category</h2>

<form method="POST" action="{{ route('categories.store') }}">
    @csrf

    <label>Category Name</label>
    <input type="text" name="name">

    <br><br>

    <button type="submit">Save Category</button>

</form>