<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Edit Author - NiceAdmin Bootstrap Template</title>
  <!-- Include necessary CSS files -->
</head>

<body>
  <!-- Main content -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Edit Author</h1>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('update.author', $blog_auths->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="name">name</label>
              <input type="text" id="name" name="name" class="form-control" value="{{ $blog_auths->name }}">
            </div>
            <div class="form-group">
              <label for="description">description</label>
              <input type="description" id="description" name="description" class="form-control"
                value="{{ $blog_auths->description }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Author</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  <!-- Include necessary JS files -->
</body>

</html>