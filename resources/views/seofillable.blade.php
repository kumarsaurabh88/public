<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Edit Seo - NiceAdmin Bootstrap Template</title>
  <!-- Include necessary CSS files -->
</head>

<body>
  <!-- Include your header and sidebar -->

  <!-- Main content -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Edit SEO</h1>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('update.seo', $seos->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="url">Url</label>
              <input type="text" id="url" name="url" class="form-control" value="{{ $seos->url }}">
            </div>

            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" id="title" name="title" class="form-control" value="{{ $seos->title }}">
            </div>

            <div class="form-group">
              <label for="keyword">keyword</label>
              <input type="text" id="keyword" name="keyword" class="form-control" value="{{ $seos->keyword }}">
            </div>

            <div class="form-group">
              <label for="description">Description</label>
              <input type="text" id="description" name="description" class="form-control"
                value="{{ $seos->description }}">
            </div>

            <div class="form-group">
              <label for="canonicaltag">Canonical Tag</label>
              <input type="canonicaltag" id="canonicaltag" name="canonicaltag" class="form-control"
                value="{{ $seos->canonicaltag }}">
            </div>

            <div class="form-group">
              <label for="productschema">Product schema</label>
              <input type="productschema" id="productschema" name="productschema" class="form-control"
                value="{{ $seos->productschema }}">
            </div>

            <div class="form-group">
              <label for="faqschema">faq schema</label>
              <input type="faqschema" id="faqschema" name="faqschema" class="form-control"
                value="{{ $seos->faqschema }}">
            </div>

            <button type="submit" class="btn btn-primary">Update SEO</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  <!-- Include necessary JS files -->
</body>

</html>