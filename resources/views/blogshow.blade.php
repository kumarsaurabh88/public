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
      <a href="{{ route('blog.cat') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle">add categories</i>
      </a>

    </nav>
  </div>
  <!-- End Page Title -->
  <table class="table table-borderless datatable">
    <thead>
      <tr>
        <th scope="col">categoryname</th>
        <th scope="col">categoryurl</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @if (!$blog_catogries->isEmpty())
      @foreach ($blog_catogries as $blog_catogries)
      <tr>
        <td>{{ $blog_catogries->categoryname }}</td>
        <td><a href="{{ $blog_catogries->categoryurl }}">{{ $blog_catogries->categoryurl }}</a></td>
        <td>
          <a href="{{route('modify.category', $blog_catogries->id)}}" class="btn btn-dark">Edit</a>
          <form id="delete-blog-form-{{$blog_catogries->id}}" action="{{route('deleteItem',$blog_catogries->id)}}"
            method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
        {{-- Add more table cells here if needed --}}
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
  {{-- js start --}}
  <script>
    $(document).ready(function() {
      $('#deleted_all_seleced_record').click(function() {
        let all_ids = [];
        $('input[type="checkbox"][name="ids[]"]:checked').each(function() {
          all_ids.push($(this).val());
        });
        $('#bulk_delete').val(all_ids);
      });
    });
  </script>