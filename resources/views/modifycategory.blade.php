<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Edit Category - NiceAdmin Bootstrap Template</title>
  <!-- Include necessary CSS files -->
</head>

<body>
  <!-- Include your header and sidebar -->

  <!-- Main content -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Edit Category</h1>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('update.category', $blog_catogries->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="categoryname">Category Name</label>
              <input type="text" id="categoryname" name="categoryname" class="form-control"
                value="{{ $blog_catogries->categoryname }}">
            </div>

            <div class="form-group">
              <label for="categoryurl">Category URL</label>
              <input type="text" id="categoryurl" name="categoryurl" class="form-control"
                value="{{ $blog_catogries->categoryurl }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Category</button>
          </form>
        </div>
      </div>
    </div>
  </main>

  <!-- Include necessary JS files -->
</body>

</html>