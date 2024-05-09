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
    <!-- End Charts Nav -->
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
    <!-- End F.A.Q Page Nav -->
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
    <h1>Dashboard</h1>
    <nav>
      <a href="{{ route('author') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle">NewAuth</i>
      </a>
    </nav>
  </div>
  <form action="{{ route('authorshow') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-md-6 mt-3">
      <label for="name" class="mb-2">Name</label>
      <input type="text" id="name" name="name" class=" @error('name') is-invalid @enderror form-control" required>
      @error('name')
      <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
    <div class="col-md-6 mt-3">
      <label for="Description" class="mb-2">Description*</label>
      <textarea name="description" class="form-control" id="Description" cols="20" rows="5"></textarea>
    </div>
    <div class="col-md-6 mt-3">
      <label for="image" class="mb-2">Image*</label>
      <input type="file" id="image" name="image" class=" @error('image') is-invalid @enderror fome-control" required>
      @error('image')
      <p class="invalid-feedback">{{ $message }}</p>
      @enderror
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger mt-3">submit</button>
    </div>
  </form>
  @include('footer')