<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PermissionPost;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use stdClass;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $per_page = 10;

    public function list(Request $request)
    {
        //
            $posts = Post::Select('id', 'tittle', 'author_id', 'author_name', 'visibility', 'updated_at', 'created_at')->paginate($this->per_page);

        foreach ($posts as $post) {
            $post_permissions = $post->permissionpost()->get();

            if ($post->visibility == 1) {
                $post->visibility = 'Draft';
            }
            if ($post->visibility == 2) {
                $post->visibility = 'Public';
            }
            if ($post->visibility == 3) {
                $post->visibility = 'Private';
            }
            $object_permissions = new stdClass();
            foreach ($post_permissions as $permissions) {
                if ($permissions->permission == 'restricted') {
                    $object_permissions->restricted = true;
                }
                if ($permissions->permission == 'allowComments') {
                    $object_permissions->allowComments = true;
                }
                if ($permissions->permission == 'pinned') {
                    $object_permissions->pinned = true;
                }
            }
            $post->permissions = $object_permissions;
        }

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $categories = Category::whereNull('category_id')
        ->get();
        $permissions = PermissionPost::select('id', 'permission')->get();
        $visibilities = DB::table('visibility_options')->select('id', 'visibility')->get();
        
        return view('posts.create', ['categories' => $categories, 'permissions' => $permissions, 'visibilities' => $visibilities]);
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate(
            $request,
            [   
                'slug' => 'required|alpha_dash|max:80|unique:posts,slug',
                'tittle' => 'required|string|max:80',
                'content' => 'required|string',
                'image' => 'string|nullable',
            ]
        );


        
        $category_default = Category::select('id')->where('default', '=', 1)->first();
        $image = $request->image != null ? $request->image : null;
        $authUser = User::find(auth()->user()->id);
        $author_name = $authUser->name;
        $author_id = $authUser->id;

        if ($request->slug == null) {
            $slug = trim(str_replace(" ", "-", strtolower($request->tittle)));
        } else {
            $slug = trim(str_replace(" ", "-", strtolower($request->slug)));
        }

        


        $restricted = $request->restricted;
        $pinned = $request->pinned;
        $tittle = $request->tittle;
        if ($request->categories != null) :
            $categories = $request->categories;
        else :
            $categories = [$category_default->id];
        endif;

        $image_path = $image;
        $post = Post::create([
            'slug' => $slug,
            'tittle' => $tittle,
            'content' => $request->content,
            'image' => $image_path,
            'visibility' => $request->visibility,
            'author_name' => $author_name,
            'author_id' => $author_id
        ]);
        
        if ($post) {
            foreach ($categories as $category) {
                $post->categories()->attach(intval($category));
            }
            
            if ($restricted == true) {
                $permission = PermissionPost::find(3);
                $post->permissionpost()->attach($permission);
            }
            if ($pinned == true) {
                $permission = PermissionPost::find(1);
                $post->permissionpost()->attach($permission);
            }

        }


        return redirect()->route('index.post')->with(['success' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $post = Post::find($id);
        $categories = Category::whereNull('category_id')
        ->get();
        $permissions = PermissionPost::select('id', 'permission')->get();
        $visibilities = DB::table('visibility_options')->select('id', 'visibility')->get();
        $category_check = $post->categories()->get();
        $permissions_post = $post->permissionpost()->get();
        $pinned = false;
        $restricted = false;
        foreach($permissions_post as $permission){
            if($permission->id == 1){
                $pinned = true;
            }
            if($permission->id == 3){
                $restricted = true;
            }
        }
        return view('posts.edit', ['post' => $post, 'categories' => $categories, 'visibilities' => $visibilities, 'permissions' => $permissions, 'category_check' => $category_check, 'pinned' => $pinned, 'restricted' => $restricted]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request, [
            'slug' => 'required|alpha_dash|unique:posts,slug,' . $request->id,
            'tittle' => 'required|string',
            'content' => 'string|required'
        ]);

        
        $post = Post::find($request->id);


        $category_default = Category::select('id')->where('default', '=', 1)->first();
        $image_path = $request->image != null ? $request->image : $post->image;

        if ($request->slug == null) :
            $slug = trim(str_replace(" ", "-", strtolower($request->tittle)));
        else :
                $slug = trim(str_replace(" ", "-", strtolower($request->slug)));
        endif;

        $array_permissions = [];
        $array_categories = [];
        $categories = $request->categories != null ? $request->categories : [1];
        if($request->pinned == true){
            array_push($array_permissions, 1);
        }
        if($request->restricted ==true){
            array_push($array_permissions, 3);
        }
        foreach($categories as $category){
            array_push($array_categories, intval($category));
        }

        $post->slug = $slug;
        $post->tittle = $request->tittle;
        $post->content = $request->content;
        $post->visibility = $request->visibility;
        $post->image = $image_path;



        if ($post->update()) {
            $post->categories()->sync($categories);
            $post->permissionpost()->sync($array_permissions);
            
            return redirect()->route('edit.post', ['id' => $post->id])->with(['success' => 'edited']);
        }else{
            return redirect()->route('edit.post', ['id' => $post->id])->with(['error' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {

        $post = Post::find($request->record_id);
        if ($post->delete()) {
            return redirect()->route('index.post', ['page' => $request->page])->with(['success' => 'deleted']);
        } else {
            return redirect()->route('index.post', ['page' => $request->page])->with(['error' => 'error']);
        }
    }


    public function homeFeatured(Request $request)
    {

        $setting = DB::table('general_settings')->select('pinnedOrder')->first();
        $posts = Post::select('id', 'slug', 'tittle', 'visibility', 'image')->where('visibility', '=', 2)->orderBy('updated_at', $setting->pinnedOrder)->limit(4)->get();

        $array_posts = [];
        $array_ids = [];
        foreach ($posts as $post) {
            $permissions = $post->permissionpost()->get();
            $show = false;
            foreach ($permissions as $permission) {
                if ($permission->permission == 'pinned') {
                    $show = true;
                }
                if ($permission->permission == 'restricted') {
                    $show = false;
                }
            }
            if ($show == true) {
                array_push($array_posts, $post);
                array_push($array_ids, $post->id);
            }
        }
        if (count($array_posts) < 4) {

            $i = count($array_posts);
            for ($i; $i < 4; $i++) {
                $fill_posts = Post::select('id', 'slug', 'tittle', 'visibility', 'image')->where('visibility', '=', 2)->whereNotIn('id', $array_ids)->orderBy('updated_at', $setting->pinnedOrder)->limit(4 - $i)->get();

                foreach ($fill_posts as $fill_post) {
                    $show = true;
                    $permissions_fillPost = $fill_post->permissionpost()->get();
                    foreach ($permissions_fillPost as $permission) {
                        if ($permission->permission == 'restricted') {
                            $show = false;
                        }
                    }
                    if ($show == true) {
                        array_push($array_posts, $fill_post);
                        $i = count($array_posts);
                        array_push($array_ids, $fill_post->id);
                    }
                }
            }
        }
        $month = date('m');
        $year = date('Y');
        $views_total = DB::table('public_views')->where('page', 'home')->whereYear('updated_at', $year)->whereMonth('updated_at', $month)->first();
        if ($views_total) {
            DB::table('public_views')->where('id', '=', $views_total->id)->update([
                'views' => $views_total->views + 1,
                'updated_at' => new \DateTime(),
            ]);
        } else {
            DB::table('public_views')->insert([
                'id' => Uuid::uuid4(),
                'page' => 'home',
                'views' => 1,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),

            ]);
        }

        return response()->json($array_posts);
    }

    public function postsToBlog(Request $request)
    {
        $setting = DB::table('general_settings')->select('pinnedOrder', 'maxPostsToDisplay')->first();
        $posts = [];
        if($setting->maxPostsToDisplay != null || $setting->maxPostsToDisplay != 0){
            if ($request->category == 0 || $request->category == null) {
                $posts = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $setting->pinnedOrder)->limit($setting->maxPostsToDisplay)->get();
            } else {
                $category_id = $request->category;

                $array_filter = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $setting->pinnedOrder)->with('categories')->get();
                foreach ($array_filter as $post) {
                    foreach ($post->categories as $category) {
                        if ($category->id == $category_id) {
                            array_push($posts, $post);
                        }
                    }
                }
            }
        }else{
            if ($request->category == 0 || $request->category == null) {
                $posts = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $setting->pinnedOrder)->get();
            } else {
                $category_id = $request->category;

                $array_filter = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $setting->pinnedOrder)->with('categories')->get();
                foreach ($array_filter as $post) {
                    foreach ($post->categories as $category) {
                        if ($category->id == $category_id) {
                            array_push($posts, $post);
                        }
                    }
                }
            }
        }
        
        



        $array_posts = [];
        $array_ids = [];
        foreach ($posts as $post) {
            $permissions = $post->permissionpost()->get();
            $categories = $post->categories()->get();
            $post->categories = $categories;
            $show = true;
            foreach ($permissions as $permission) {
                if ($permission->permission == 'restricted') {
                    $show = false;
                }
            }
            if ($show == true) {
                array_push($array_posts, $post);
                array_push($array_ids, $post->id);
            }
        }

        $total_categories = Category::select('id', 'name')->get();



        $month = date('m');
        $year = date('Y');
        $views_total = DB::table('public_views')->where('page', 'blog')->whereYear('updated_at', $year)->whereMonth('updated_at', $month)->first();


        if ($views_total) {
            DB::table('public_views')->where('id', '=', $views_total->id)->update([
                'views' => $views_total->views + 1,
                'updated_at' => new \DateTime(),
            ]);
        } else {
            DB::table('public_views')->insert([
                'id' => Uuid::uuid4(),
                'page' => 'blog',
                'views' => 1,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),

            ]);
        }


        return response()->json(['posts' => $array_posts, 'categories' => $total_categories]);
    }

    public function postVisits(Request $request)
    {


        $post = $request;
        $month = date('m');
        $year = date('Y');
        $views_total = DB::table('public_views')->where('page', 'blog')->where('post_id', $post['id'])->whereYear('updated_at', $year)->whereMonth('updated_at', $month)->first();
        if ($views_total) {
            DB::table('public_views')->where('id', '=', $views_total->id)->update([
                'views' => $views_total->views + 1,
                'updated_at' => new \DateTime(),
            ]);
        } else {
            DB::table('public_views')->insert([
                'id' => Uuid::uuid4(),
                'page' => 'blog',
                'views' => 1,
                'post_id' => $post['id'],
                'post_tittle' => $post['tittle'],
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),

            ]);
        }

        return response()->json($request);
    }
}
