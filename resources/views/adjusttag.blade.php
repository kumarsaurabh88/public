<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Edit Tag - NiceAdmin Bootstrap Template</title>
  <!-- Include necessary CSS files -->
</head>

<body>
  <!-- Main content -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Edit Tag</h1>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('update.tag', $blog_tags->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="tagname">tagname</label>
              <input type="text" id="tagname" name="tagname" class="form-control" value="{{ $blog_tags->tagname }}">
            </div>
            <div class="form-group">
              <label for="tagline">tagline</label>
              <input type="tagline" id="tagline" name="tagline" class="form-control" value="{{ $blog_tags->tagline }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Tag</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  <!-- Include necessary JS files -->
</body>

</html>