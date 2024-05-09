<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog_auths;
use App\Models\Blog_catogries;
use App\Models\Blog_tags;
use App\Models\Blogs;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\support\facades\validator;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blogs::all();
        return view('index', compact('blogs'));
    }

    public function create()
    {
        $blog_auths = Blog_auths::all();  // Retrieve all authors from the database
        $blog_catogries = Blog_catogries::all();
        $blog_tags = Blog_tags::get();
        return view('BlogCategories', ['blog_auths' => $blog_auths, 'blog_catogries' => $blog_catogries, 'blog_tags' => $blog_tags]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Title' => 'required',
            'Slug' => 'required',
            'Category_id' => 'required',
            'Author_id' => 'required',
            'Tag_id' => 'required',
            'Description' => 'required',
            'Description2' => 'required',
            'Featured_Image' => 'required|image',
            'Banner_Image.*' => 'required|image',  // Validate each banner image separately
        ]);
        $blogs = new Blogs();
        $blogs->Title = $request->input('Title');
        $blogs->Slug = $request->input('Slug');
        $blogs->Category_id = $request->input('Category_id');
        $blogs->Author_id = $request->input('Author_id');
        $blogs->Tag_id = $request->input('Tag_id');
        $blogs->Description = $request->input('Description');
        $blogs->Description2 = $request->input('Description2');

        // Handle file upload for Featured_Image
        if ($request->hasFile('Featured_Image')) {
            $image = $request->file('Featured_Image');
            // Check if the uploaded file is indeed an image
            if ($image->isValid()) {
                $imageName = time() . '_' . $image->getClientOriginalName();  // Generate a unique image name
                $image->move(public_path('assets/img/featured'), $imageName);  // Move the image to the 'public/assets/img/featured' directory
                $blogs->Featured_Image = 'assets/img/featured/' . $imageName;  // Save the image path in the $blog object
            } else {
                // Handle invalid image file
                return redirect()->back()->withInput()->withErrors(['Featured_Image' => 'The Featured_Image field must be an image file.']);
            }
        }

        // Handle file upload for Banner_Image
        if ($request->hasFile('Banner_Image')) {
            $bannerImages = [];
            foreach ($request->file('Banner_Image') as $image) {
                // Check if the uploaded file is indeed an image
                if ($image->isValid()) {
                    $imageName = time() . '_' . $image->getClientOriginalName();  // Generate a unique image name
                    $image->move(public_path('assets/img/banner'), $imageName);  // Move the image to the 'public/assets/img/banner' directory
                    $bannerImages[] = 'assets/img/banner/' . $imageName;  // Save the image path in the $bannerImages array
                } else {
                    // Handle invalid image file
                    return redirect()->back()->withInput()->withErrors(['Banner_Image' => 'The Banner_Image field must be an image file.']);
                }
            }
            $blogs->Banner_Image = json_encode($bannerImages);  // Save the banner images array as a JSON string in the $blog object
        }

        $blogs->save();  // Save the blog to the database

        return redirect()->route('dashboard')->with('success', 'Blog created successfully.');
    }

    public function blogslish(Request $request)
    {
        $blogs = Blogs::all();
        $seo = Seo::get();
        return view('blogslish', compact('blogs', 'seo'));
    }

    public function edit($id)
    {
        $blogs = Blogs::findOrFail($id);
        $blog_catogries = Blog_catogries::get();
        $blog_auths = Blog_auths::get();
        $blog_tags = Blog_tags::get();

        return view('edit', compact('blogs', 'blog_catogries', 'blog_auths', 'blog_tags'));
    }

    public function destroy($id)
    {
        $blogs = Blogs::findOrFail($id);
        $blogs->delete();

        return redirect()->route('blogslish')->with('success', 'blog deleted successfully');
    }

    public function editupdate($id, Request $request)
    {

        $blogs = Blogs::findOrFail($id);
        $blogs->Title = $request->Title;
        $blogs->Slug = $request->Slug;
        $blogs->Category_id = $request->Category_id;
        $blogs->Author_id = $request->Author_id;
        $blogs->Tag_id = $request->Tag_id;  // Fix: Use 'Tag_id' instead of 'Tag'
        $blogs->Description2 = $request->Description2;
        $blogs->Description = $request->Description;

        // Handle image uploads
        // Featured Image
        if ($request->hasFile('Featured_Image')) {
            $featuredImage = $request->file('Featured_Image');
            $featuredImageName = time() . '.' . $featuredImage->getClientOriginalExtension();
            $featuredImage->move(public_path('assets/img/featured'), $featuredImageName);
            $blogs->Featured_Image = $featuredImageName;
        }

        // Save the updated blog post
        $blogs->save();

        return redirect()->route('blogslish')->with('success', 'Blog updated successfully');
    }

    public function contactus()
    {
        return view('contactus');
    }

    public function customer()
    {
        $blogs = Blogs::all();
        return view('customer', compact('blogs'));
    }

    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->input('ids')[0]);
        // Check if IDs array is not empty
        if (!empty($ids)) {
            try {
                // Perform bulk deletion
                Blogs::whereIn('id', $ids)->delete();

                // Return success response
                return response()->json(['message' => 'Blogs deleted successfully']);
            } catch (\Exception $e) {
                // Return error response if deletion fails
                return response()->json(['error' => 'Failed to delete blogs']);
            }
        } else {
            // Return error response if no IDs are provided
            return response()->json(['error' => 'No blogs selected for deletion']);
        }
    }

    public function createauthor(Request $request)
    {
        return view('author');
    }

    public function storeauthor(Request $request)
    {
        // Validate the request data including the image
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        try {
            // Check if the request has an image
            if ($request->hasFile('image')) {
                // Get the file from the request
                $image = $request->file('image');

                // Generate a unique name for the image
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // Move the image to the storage directory
                $image->move(public_path('images'), $imageName);

                // Add the image path to the validated data
                $validatedData['image'] = 'images/' . $imageName;
            }

            // Create a new record in the blog_auths table
            Blog_auths::create($validatedData);

            // Redirect back to the form page with a success message
            return redirect()->route('author')->with('success', 'Author created successfully.');
        } catch (\Exception $e) {
            // If an error occurs during the creation process, return an error message
            return redirect()->back()->with('error', 'Failed to create author: ' . $e->getMessage());
        }
    }

    public function authorshow()
    {
        $blog_auths = Blog_auths::all();
        return view('authorshow', compact('blog_auths'));
    }

    public function processAuthorlish(Request $request)
    {
        // Validate the request data including the image
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        try {
            // Check if the request has an image
            if ($request->hasFile('image')) {
                // Get the file from the request
                $image = $request->file('image');

                // Generate a unique name for the image
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Move the image to the storage directory
                $image->move(public_path('images'), $imageName);

                // Add the image path to the validated data
                $validatedData['image'] = 'images/' . $imageName;
            }

            // Create a new author record with validated data
            $blog_auths = new Blog_auths();
            $blog_auths->name = $validatedData['name'];
            $blog_auths->description = $validatedData['description'];
            $blog_auths->image = $validatedData['image'] ?? null;  // Assign image path if available
            $blog_auths->save();

            // Redirect back to the page from where the form was submitted
            return redirect()->back()->with('success', 'Author created successfully.');
        } catch (\Exception $e) {
            // If an error occurs during the creation process, return an error message
            return redirect()->back()->with('error', 'Failed to create author: ' . $e->getMessage());
        }
    }

    public function createcat()
    {
        return view('blogcat');
    }

    public function storeblog(Request $request)
    {
        $validatedData = $request->validate([
            'categoryname' => 'required|string|max:255',
            'categoryurl' => 'required|string|max:255',
        ]);

        try {
            // Create a new record in the blog_auths table
            Blog_catogries::create($validatedData);

            // Redirect back to the form page with a success message
            return redirect()->route('blog.cat')->with('success', 'Author created successfully.');
        } catch (\Exception $e) {
            // If an error occurs during the creation process, return an error message
            return redirect()->back()->with('error', 'Failed to create author: ' . $e->getMessage());
        }
    }

    public function blogshow()
    {
        $seo = Seo::get();
        $blog_catogries = Blog_catogries::all();
        return view('blogshow', compact('blog_catogries', 'seo'));
    }

    public function processBloglish(Request $request)
    {
        // Validate the request data
        $request->validate([
            'categoryname' => 'required|string|max:255',
            'categoryurl' => 'required|string|max:255',
        ]);

        // Create a new category record
        $blog_catogries = new Blog_catogries();
        $blog_catogries->categoryname = $request->categoryname;  // Assuming the input name is 'categoryname'
        $blog_catogries->categoryurl = $request->categoryurl;  // Assuming the input name is 'categoryurl'
        $blog_catogries->save();

        // Fetch all categories to pass to the view
        $categories = Blog_catogries::all();

        // Redirect back to the page from where the form was submitted
        return redirect()->back()->with('success', 'Category created successfully.')->with('blog_catogries', $categories);
    }

    public function createtag()
    {
        return view('tag');
    }

    public function storetag(Request $request)
    {
        $validatedData = $request->validate([
            'tagname' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
        ]);

        try {
            // Create a new record in the blog_auths table
            Blog_tags::create($validatedData);

            // Redirect back to the form page with a success message
            return redirect()->route('tags')->with('success', 'tag created successfully.');
        } catch (\Exception $e) {
            // If an error occurs during the creation process, return an error message
            return redirect()->back()->with('error', 'Failed to create tag: ' . $e->getMessage());
        }
    }

    public function tagshow()
    {
        $blog_tags = Blog_tags::all();
        return view('tagshow', compact('blog_tags'));
    }

    public function processtaglish(Request $request)
    {
        // Validate the request data
        $request->validate([
            'tagname' => 'required|string|max:255',
            'tagline' => 'required|email|max:255',
        ]);

        // Create a new author record
        $blog_tags = new Blog_tags();
        $blog_tags->tagname = $request->tagname;
        $blog_tags->tagline = $request->tagline;
        $blog_tags->save();

        // Redirect back to the page from where the form was submitted
        return redirect()->back()->with('success', 'Author created successfully.');
    }

    public function modify($id)
    {
        $blog_catogries = Blog_catogries::findOrFail($id);  // Assuming your model is named Category
        return view('modifycategory', compact('blog_catogries'));
    }

    public function deleteItem($id)
    {
        $blog_catogries = Blog_catogries::findOrFail($id);
        $blog_catogries->delete();

        return redirect()->route('blogshow')->with('success', 'blog deleted successfully');
    }

    public function modifyUpdate(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'categoryname' => 'required|string|max:255',
            'categoryurl' => 'required|string|max:255',
        ]);

        // Find the category by ID
        $blog_catogries = Blog_catogries::findOrFail($id);

        // Update the category with the validated data
        $blog_catogries->update($validatedData);

        // Redirect back to the edit page with a success message
        return redirect()->route('blogshow')->with('success', 'Category updated successfully.');
    }

    public function amend($id)
    {
        $blog_auths = Blog_auths::findOrFail($id);
        return view('amendauthor', compact('blog_auths'));
    }

    public function remove($id)
    {
        $blog_auths = Blog_auths::findOrFail($id);
        $blog_auths->delete();

        return redirect()->route('authorshow')->with('success', 'blog deleted successfully');
    }

    public function amendUpdate(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Find the category by ID
        $blog_auths = Blog_auths::findOrFail($id);

        // Update the category with the validated data
        $blog_auths->update($validatedData);

        // Redirect back to the edit page with a success message
        return redirect()->route('authorshow')->with('success', 'Author updated successfully.');
    }

    public function adjust($id)
    {
        $blog_tags = Blog_tags::findOrFail($id);
        return view('adjusttag', compact('blog_tags'));
    }

    public function discard($id)
    {
        $blog_tags = Blog_tags::findOrFail($id);
        $blog_tags->delete();
        return redirect()->route('tagshow')->with('success', 'blog deleted successfully');
    }

    public function adjustUpdate(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'tagname' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
        ]);

        // Find the category by ID
        $blog_tags = Blog_tags::findOrFail($id);

        // Update the category with the validated data
        $blog_tags->update($validatedData);

        // Redirect back to the edit page with a success message
        return redirect()->route('tagshow')->with('success', 'Author updated successfully.');
    }

    // SEO start from here
    public function make()
    {
        return view('seocreate');
    }

    public function saveData(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required',
            'title' => 'required',
            'keyword' => 'required',
            'description' => 'required',
            'canonicaltag' => 'required',
            'productschema' => 'required',
            'faqschema' => 'required',
        ]);

        $seos = new Seo();
        $seos->url = $validatedData['url'];
        $seos->title = $validatedData['title'];
        $seos->keyword = $validatedData['keyword'];
        $seos->description = $validatedData['description'];
        $seos->canonicaltag = $validatedData['canonicaltag'];
        $seos->productschema = $validatedData['productschema'];
        $seos->faqschema = $validatedData['faqschema'];

        // Try to save the Seos model to the database
        if ($seos->save()) {
            // Redirect or return a response
            return redirect()->route('seoshow')->with('success', 'SEO data saved successfully.');
        } else {
            // Handle error if save fails
            return back()->withInput()->with('error', 'Failed to save SEO data.');
        }
    }

    public function seoshow(Request $request)
    {
        $seos = Seo::all();
        return view('seolist', compact('seos'));
    }

    public function processSeolist(Request $request)
    {
        // Validate the request data
        $request->validate([
            'url' => 'required',
            'title' => 'required',
            'description' => 'required',
            'canonicaltag' => 'required',
        ]);

        // Create a new author record
        $seos = new Seo();
        $seos->url = $request->url;
        $seos->title = $request->title;
        $seos->description = $request->description;
        $seos->canonicaltag = $request->canonicaltag;
        $seos->save();

        // Redirect back to the page from where the form was submitted
        return redirect()->back()->with('success', 'SEO created successfully.');
    }

    public function fillable($id)
    {
        $seos = Seo::findOrFail($id);
        return view('seofillable', compact('seos'));
    }

    public function seoUpdate(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'url' => 'required',
            'title' => 'required',
            'keyword' => 'required',
            'description' => 'required',
            'canonicaltag' => 'required',
            'productschema' => 'required',
            'faqschema' => 'required',
        ]);

        // Find the category by ID
        $seos = Seo::findOrFail($id);

        // Update the category with the validated data
        $seos->update($validatedData);

        // Redirect back to the edit page with a success message
        return redirect()->route('seoshow')->with('success', 'Author updated successfully.');
    }

    public function undo($id)
    {
        $seos = Seo::findOrFail($id);
        $seos->delete();
        return redirect()->route('seoshow')->with('success', 'seo deleted successfully');
    }

    // header start
    public function browse()
    {
        return view('header');
    }

    // footer start
    public function listall()
    {
        return view('footer');
    }
}
