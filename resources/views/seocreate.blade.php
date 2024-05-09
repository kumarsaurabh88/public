@include('header')
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link " href="{{ route('dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <!-- End Dashboard Nav -->
    <li class="nav-heading">Pages</li>
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Welcome to Blogs</span><i
        class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ route('blogslish') }}">
          <i class="bi bi-circle"></i><span>Blogs</span>
        </a>
        <a href="{{ route('blogshow') }}">
          <i class="bi bi-circle"></i><span>Categories</span>
        </a>
        <a href="{{ route('authorshow') }}">
          <i class="bi bi-circle"></i><span>Author</span>
        </a>
        <a href="{{ route('tagshow') }}">
          <i class="bi bi-circle"></i><span>Tag</span>
        </a>
      </li>
      <li>
      </li>
    </ul>
    <a class="nav-link collapsed" href="{{ route('contactus') }}">
      <i class="bi bi-person"></i>
      <span>ContactUs</span>
    </a>
    <a class="nav-link collapsed" href="{{ route('seoshow') }}">
      <i class="bi bi-person"></i>
      <span>SEO</span>
    </a>
    </li>
    <!-- End Icons Nav -->
    <li class="nav-heading">Pages</li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="users-profile.html">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li>
    <!-- End Profile Page Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-contact.html">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
      </a>
    </li>
    <!-- End Contact Page Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-register.html">
        <i class="bi bi-card-list"></i>
        <span>Register</span>
      </a>
    </li>
    <!-- End Register Page Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="pages-login.html">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Login</span>
      </a>
    </li>
    <!-- End Login Page Nav -->
  </ul>
</aside>
<!-- End Sidebar-->
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Welcome to SEO</h1>
  </div>
  @if(session('message'))
  <div class="row mb-2">
    <div class="col-lg-12">
      <div class="alert alert-success" role="alert">{{ session('message') }}</div>
    </div>
  </div>
  @endif
  @if($errors->count() > 0)
  <div class="alert alert-danger">
    <ul class="list-unstyled">
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form action="{{ route('seoshow') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-md-12 mt-3">
      <label for="url" class="mb-2">Url*</label>
      <input type="text" id="url" name="url" class=" @error('url') is-invalid @enderror form-control" required>
      @error('url')
      <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
    <div class="col-md-12 mt-3">
      <label for="title" class="mb-2">Title*</label>
      <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror form-control" required>
      @error('title')
      <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
    <div class="col-md-12 mt-3">
      <label for="keyword" class="mb-2">Keyword*</label>
      <input type="text" id="keyword" name="keyword" class="@error('keyword') is-invalid @enderror form-control"
        required>
      @error('keyword')
      <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
    <div class="col-md-12 mt-3">
      <label for="description" class="mb-2">Description*</label>
      <input type="text" id="description" name="description"
        class="@error('description') is-invalid @enderror form-control" required>
      @error('description')
      <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
    <div class="col-md-12 mt-3">
      <label for="canonicaltag" class="mb-2">Canonical Tag*</label>
      <input type="text" id="canonicaltag" name="canonicaltag"
        class="@error('canonicaltag') is-invalid @enderror form-control" required>
      @error('canonicaltag')
      <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
    <div class="col-md-12 mt-3">
      <label for="productschema" class="mb-2">Product schema*</label>
      <textarea name="productschema" class="form-control" id="productschema" cols="20" rows="5" required></textarea>
    </div>
    <div class="col-md-12 mt-3">
      <label for="faqschema" class="mb-2">Faq schema*</label>
      <textarea name="faqschema" class="form-control" id="faqschema" cols="20" rows="5" required></textarea>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger mt-3">save</button>
    </div>
  </form>
  @include('footer')