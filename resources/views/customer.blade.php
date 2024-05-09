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
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->
  <table class="table table-borderless datatable">
    <thead>
      <tr>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Author</th>
        <th scope="col">Tag</th>
        <th scope="col">Description</th>
        <th scope="col">Description2</th>
        <th scope="col">Featured_Image</th>
        <th scope="col">Banner_Image</th>
      </tr>
    </thead>
    <tbody>
      @if ($blogs->isNotEmpty())
      @foreach ($blogs as $blogs)
      <tr>
        <td>{{ $blogs->Title }}</td>
        <td>{{ $blogs->Category }}</td>
        <td>{{ $blogs->Author }}</td>
        <td>{{ $blogs->Tag }}</td>
        <td>{{ $blogs->Description }}</td>
        <td>{{ $blogs->Description2 }}</td>
        <td>
          @if ($blogs->Featured_Image != "")
          <img src="{{ asset($blogs->Featured_Image) }}" alt="Current Image"
            style="max-width: 50px; border-radius: 50%;">
          @else
          No image available
          @endif
        </td>
        <td>
          @if ($blogs->Featured_Image != "")
          <img src="{{ asset($blogs->Banner_Image) }}" alt="Current Image" style="max-width: 50px; border-radius: 50%;">
          @else
          No image available
          @endif
        </td>
      </tr>
      @endforeach
      @else
      <tr>
        <td colspan="9">No data available</td>
      </tr>
      @endif
    </tbody>
  </table>
  @include('footer')