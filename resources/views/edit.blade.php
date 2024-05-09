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
      <h1>Edit Blogs</h1>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('editupdate', $blogs->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="Title">Title</label>
              <input type="text" id="Title" name="Title" class="form-control" value="{{ $blogs->Title }}">
            </div>
            <div class="form-group">
              <label for="Slug">Slug</label>
              <input type="text" id="Slug" name="Slug" class="form-control" value="{{ $blogs->Slug }}">
            </div>
            <div class="form-group">
              <label for="Category">Category</label>
              <select name="Category_id" class="form-control">
                @foreach($blog_catogries as $key => $blog_catogrie)
                <option <?php if($blog_catogrie->id == $blogs->Category_id){ echo 'selected'; } ?>
                  value="{{ $blog_catogrie->categoryname }}">{{$blog_catogrie->categoryname}}</option>

                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="Author">Author</label>
              <select name="Author_id" class="form-control">
                {{-- Loop through authors and display them in options --}}
                @foreach($blog_auths as $key => $blog_auth)
                <option value="{{ $blog_auth->name }}" {{ $blog_auth->name == $blogs->Author_id ? 'selected' : '' }}>
                  {{ $blog_auth->name }}
                </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="Tag">Tag</label>

              {{-- <input type="text" id="Author" name="Author" class="form-control" value="{{ $blogs->Author }}"> --}}

              <select name="Tag_id" class="form-control">
                {{-- Loop through authors and display them in options --}}
                @foreach($blog_tags as $key => $blog_tag)
                <option value="{{ $blog_tag->tagname }}" {{ $blog_tag->tagname == $blogs->Tag_id ? 'selected' : '' }}>
                  {{ $blog_tag->tagname }}
                </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="Description">Description</label>
              <input type="text" id="Description" name="Description" class="form-control"
                value="{{ $blogs->Description }}">
            </div>

            <div class="form-group">
              <label for="Description2">Description2</label>
              <input type="text" id="Description2" name="Description2" class="form-control"
                value="{{ $blogs->Description2 }}">
            </div>

            <button type="submit" class="btn btn-primary">Update blogs</button>
          </form>
        </div>
      </div>
    </div>
  </main>

  <!-- Include necessary JS files -->
</body>

</html>