<?php

namespace App\Http\Controllers\panel;

use App\models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the Categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.category', [
            'categories' => Category::first_levels(),
            'page_name' => 'category',
            'page_title' => 'گروه بندی محصولات',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create(array_merge($request -> all(), [
            'avatar' => $this->upload_image( Input::file('avatar') )
        ]));
        return redirect()->back()->with('message', 'گروه '.$request->title.' با موفقیت ثبت شد .');
    }

    /**
     * Display the specified Category.
     *
     * @param  \App\models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('panel.category', [
            'categories' => $category->childs()->get(),
            'id' => $category->id,
            'category' => $category,
            'breadcrumb' => $this -> breadcrumb($category),
            'page_name' => 'group',
            'page_title' => 'گروه های زیرمجموعه ' . $category->title,
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  \App\models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('panel.category', [
            'categories' => $category->childs()->get(),
            'category' => $category,
            'id' => $category->id,
            'breadcrumb' => $this -> breadcrumb($category),
            'page_name' => 'category',
            'page_title' => 'ویرایش گروه ' . $category->title,
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if ($request->hasFile('avatar'))
        {
            $avatar = $this->upload_image( Input::file('avatar') );
            
            if ( file_exists( public_path($category->avatar) ) )
                unlink( public_path($category->avatar) );
        }
        else
        {
            $avatar = $category->avatar;
        }
                
        $category->update(array_merge($request -> all(), [
            'avatar' => $avatar
        ]));
        return redirect()->back()->with('message', 'گروه '.$request->title.' با موفقیت بروز رسانی شد .');
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  \App\models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('message', 'گروه '.$category->title.' با موفقیت حذف شد .');
    }

    /**
     * Get a breadcrump for specified group
     *
     * @param Integer $id
     * @return Array
     */
    public function breadcrumb ($id)
    {
        function get_parents (&$output, $p, $i = 0) {
            $sql = "SELECT `cat1`.`parent`, `cat1`.`id`, `cat1`.`title` FROM `categories` as `cat1`
                INNER JOIN `categories` as `cat2` ON `cat1`.`id` = `cat2`.`parent` WHERE `cat2`.`id` = ?";
            
            $output[$i] = DB::select($sql, [$p]);

            if (!empty($output[$i][0]->parent)) {
                get_parents($output, $output[$i][0]->id, ++$i);
            }
        }

        $results = [];
        get_parents($results, $id);
        return $results;
    }

    /**
     * return a sub child of specified category in json
     *
     * @param Integer $id
     * @return JSON
     */
    public function sub ($id)
    {
        return json_encode( Category::select('id', 'title')->where('parent', $id)->get() );
    }
}
