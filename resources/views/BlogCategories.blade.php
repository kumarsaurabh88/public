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
    {{-- categories start --}}
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
    <!-- End Blank Page Nav -->
  </ul>
</aside>
<!-- End Sidebar-->
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <a href="{{ route('categories') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle">Blogs</i>
      </a>
    </nav>
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
  <!-- End Page Title -->
  <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-md-6 mt-3">
      <label for="Title" class="mb-2">Title*</label>
      <input type="text" id="Title" name="Title" class=" @error('Title') is-invalid @enderror form-control" required>
      @error('name')
      <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
    <div class="col-md-6 mt-3">
      <label for="Slug" class="mb-2">Slug*</label>
      <input type="text" id="Slug" name="Slug" class="form-control">
    </div>
    <div class="col-md-6 mt-3">
      <label for="categoryname" class="mb-2">category*</label>
      <select id="Category" name="Category_id" class="form-control" required>
        @foreach($blog_catogries as $blog_catogries)
        <option value="{{ $blog_catogries->categoryname }}">{{ $blog_catogries->categoryname }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-6 mt-3">
      <label for="Author" class="mb-2">Author*</label>
      <select id="Author" name="Author_id" class="form-control" required>
        @foreach($blog_auths as $blog_auths)
        <option value="{{ $blog_auths->name }}">{{ $blog_auths->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-6 mt-3">
      <label for="tagname" class="mb-2">Tag*</label>
      <select id="tagname" name="Tag_id" class="form-control" required multiple>
        @foreach($blog_tags as $blog_tags)
        <option value="{{ $blog_tags->tagname }}">{{ $blog_tags->tagname }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-6 mt-3">
      <label for="Description" class="mb-2">Description*</label>
      <textarea name="Description" class="form-control" id="Description" cols="20" rows="5"></textarea>
    </div>
    <div class="col-md-6 mt-3">
      <label for="Description" class="mb-2">Description2*</label>
      <textarea name="Description2" class="form-control" id="Description" cols="20" rows="5"></textarea>
    </div>
    </div>
    </div>
    <div class="col-md-6 mt-3">
      <label for="image" class="mb-2">Featured_Image*</label>
      <input type="file" id="image" name="Featured_Image" class=" @error('image') is-invalid @enderror fome-control"
        required>
      @error('image')
      <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
    <div class="col-md-6 mt-3">
      <label for="image" class="mb-2">Banner_Image*</label>
      <input type="file" id="image" name="Banner_image[]" class=" @error('image') is-invalid @enderror fome-control"
        required multiple>
      @error('image')
      <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger mt-3">save</button>
    </div>
  </form>
  @include('footer')