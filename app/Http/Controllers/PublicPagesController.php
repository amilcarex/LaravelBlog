<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\FormatTime;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use SebastianBergmann\Environment\Console;

class PublicPagesController extends Controller
{
    //

    public function index(Request $request)
    {


        $general_settings = DB::table('general_settings')->where('id', 1)->first();
        $social_settings = DB::table('social_settings')->where('id', 1)->first();

        $posts = Post::select('id', 'slug', 'tittle', 'visibility', 'image')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->limit(4)->get();

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
                $fill_posts = Post::select('id', 'slug', 'tittle', 'visibility', 'image')->where('visibility', '=', 2)->whereNotIn('id', $array_ids)->orderBy('updated_at', $general_settings->pinnedOrder)->limit(4 - $i)->get();

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
        if (!auth()->user()) {
        if ($views_total) {
            DB::table('public_views')->where('id', '=', $views_total->id)->update([
                'views' => $views_total->views + 1,
                'updated_at' => new \DateTime(),
            ]);
        } else {
            DB::table('public_views')->insert([
                'page' => 'home',
                'views' => 1,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),

            ]);
        }
    }

        return view('publicPages.home', ['general_settings' => $general_settings, 'social_settings' => $social_settings, 'posts' => $array_posts]);
    }

    public function about(Request $request)
    {

        $general_settings = DB::table('general_settings')->where('id', 1)->first();
        $social_settings = DB::table('social_settings')->where('id', 1)->first();
        $users = User::select('id', 'name', 'description', 'image', 'hierarchy', 'skills')->where('show', '=', 1)->paginate(1);
        foreach ($users as $user) {
            $experience = DB::table('user_experience')->where('user_id', '=', $user->id)->get();

            $user->skills = explode(',', $user->skills);
            foreach ($user->skills as $skill) {
                $skill = trim($skill);
            }
            $user->experience = $experience;
        }

        $month = date('m');
        $year = date('Y');
        $views_total = DB::table('public_views')->where('page', 'about')->whereYear('updated_at', $year)->whereMonth('updated_at', $month)->first();
        if (!auth()->user()) {
        if ($views_total) {
            DB::table('public_views')->where('id', '=', $views_total->id)->update([
                'views' => $views_total->views + 1,
                'updated_at' => new \DateTime(),
            ]);
        } else {
            DB::table('public_views')->insert([
                'page' => 'about',
                'views' => 1,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),

            ]);
        }
    }
        return view('publicPages.about', ['general_settings' => $general_settings, 'social_settings' => $social_settings, 'users' => $users] );
    }

    public function blog(Request $request, $slug = null)
    {

        $general_settings = DB::table('general_settings')->where('id', 1)->first();
        $social_settings = DB::table('social_settings')->where('id', 1)->first();
        
        $posts = [];
        if ($general_settings->maxPostsToDisplay != null || $general_settings->maxPostsToDisplay != 0) {
            if ($request->category == 0 || $request->category == null) {
                $posts = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->paginate($general_settings->maxPostsToDisplay);
            } else {
                $category_id = $request->category;

                $array_filter = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->with('categories')->get();
                foreach ($array_filter as $post) {
                    foreach ($post->categories as $category) {
                        if ($category->id == $category_id) {
                            array_push($posts, $post);
                        }
                    }
                }
            }
        } else {
            if ($request->category == 0 || $request->category == null) {
                $posts = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->get();
            } else {
                $category_id = $request->category;

                $array_filter = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->with('categories')->get();
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

        $post_to_article = null;
        if (isset($slug) && $slug != null) {
            $post_to_article = Post::where('slug', $slug)->first();
        }

        $total_categories = Category::select('id', 'name')->get();
        $posts = $array_posts;
        $month = date('m');
        $year = date('Y');
        $views_total = DB::table('public_views')->where('page', 'blog')->whereYear('updated_at', $year)->whereMonth('updated_at', $month)->first();
        if(!auth()->user()){
        
        if ($views_total) {
            DB::table('public_views')->where('id', '=', $views_total->id)->update([
                'views' => $views_total->views + 1,
                'updated_at' => new \DateTime(),
            ]);
        } else {
            DB::table('public_views')->insert([
                'page' => 'blog',
                'views' => 1,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),

            ]);
        }
        }

        return view('publicPages.blog', compact('posts'), ['general_settings' => $general_settings, 'social_settings' => $social_settings, 'categories' => $total_categories, 'post' => $post_to_article]);
    }


    public function blogPagination(Request $request, $category = null){

        $general_settings = DB::table('general_settings')->where('id', 1)->first();

        $posts = [];
        if ($general_settings->maxPostsToDisplay != null || $general_settings->maxPostsToDisplay != 0) {
            if ($category == 0 || $category == null) {
                $posts = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->paginate($general_settings->maxPostsToDisplay);
            } else {
                $category_id = $category;

                $array_filter = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->with('categories')->get();
                foreach ($array_filter as $post) {
                    foreach ($post->categories as $category) {
                        if ($category->id == $category_id) {
                            array_push($posts, $post);
                        }
                    }
                }
            }
        } else {
            if ($category == 0 || $category == null) {
                $posts = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->get();
            } else {
                $category_id = $category;

                $array_filter = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->with('categories')->get();
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

        $posts = $array_posts;

        return view('publicPages.posts.pagination', compact('posts'));

    }
    public function filter(Request $request, $category = null){

        $general_settings = DB::table('general_settings')->where('id', 1)->first();
        $posts = [];
        if ($general_settings->maxPostsToDisplay != null || $general_settings->maxPostsToDisplay != 0) {
            if ($category == 0 || $category == null) {
                $posts = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->paginate($general_settings->maxPostsToDisplay);
            } else {
                $category_id = $category;

                $array_filter = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->with('categories')->get();
                foreach ($array_filter as $post) {
                    foreach ($post->categories as $category) {
                        if ($category->id == $category_id) {
                            array_push($posts, $post);
                        }
                    }
                }
            }
        } else {
            if ($category == 0 || $category == null) {
                $posts = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->get();
            } else {
                $category_id = $category;

                $array_filter = Post::select('id', 'slug', 'tittle', 'content', 'visibility', 'image', 'updated_at')->where('visibility', '=', 2)->orderBy('updated_at', $general_settings->pinnedOrder)->with('categories')->get();
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

        $posts = $array_posts;

        return view('publicPages.posts.pagination', compact('posts'));
    }

    public function article($id)
    {
        

        $post = Post::find($id);

        $view = view('publicPages.posts.article', compact('post'))->render();
        $content = $post->content;
        return response()->json(['view' => $view, 'content' => $content]);

    }
}
