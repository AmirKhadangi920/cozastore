<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateGroup;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\Option;
class GroupController extends Controller
{
    public function index ()
    {
        $groups = Group::select('id', 'title', 'description')->where('parent', null)->get();

        $options = Option::select('name', 'value')->whereIn('name', ['site_name', 'site_logo'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
            }
        }

        return view('panel.groups', [
            'groups' => $groups,
            'page_name' => 'group',
            'page_title' => 'گروه بندی محصولات',
            'site_name'=> $site_name,
            'site_logo'=> $site_logo
        ]);
    }

    public function get ($id, $title)
    {
        $groups = Group::select('id', 'title', 'description')->where('parent', $id)->get();

        $options = Option::select('name', 'value')->whereIn('name', ['site_name', 'site_logo'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
            }
        }

        return view('panel.groups', [
            'groups' => $groups,
            'title' => $title,
            'id' => $id,
            'breadcrumb' => $this -> breadcrumb($id),
            'page_name' => 'group',
            'page_title' => 'گروه های زیرمجموعه ' . $title,
            'site_name'=> $site_name,
            'site_logo'=> $site_logo
        ]);
    }

    public function sub ($id)
    {
        return json_encode(Group::select('id', 'title')->where('parent', $id)->get());
    }

    public function add (CreateGroup $req)
    {
        Group::create($req -> all());
        return redirect()->back()->with('message', 'گروه '.$req->title.' با موفقیت ثبت شد .');
    }

    public function edit ($id, $title)
    {
        $selected = Group::select('id', 'title', 'description')->where('id', $id)->get();
        $groups = Group::select('id', 'title', 'description')->where('parent', $id)->get();

        $options = Option::select('name', 'value')->whereIn('name', ['site_name', 'site_logo'])->get();
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'site_name': $site_name = $option['value']; break;
                case 'site_logo': $site_logo = $option['value']; break;
            }
        }
        
        return view('panel.groups', [
            'groups' => $groups,
            'selected' => $selected,
            'title' => $title,
            'breadcrumb' => $this -> breadcrumb($id),
            'edit' => true,
            'page_name' => 'group',
            'page_title' => 'ویرایش گروه ' . $title,
            'site_name'=> $site_name,
            'site_logo'=> $site_
        ]);
    }

    public function update (CreateGroup $req)
    {
        Group::where('id', $req->id)->update([
            'title' => $req->title,
            'description' => $req->description
        ]);
        return redirect()->back()->with('message', 'گروه '.$req->title.' با موفقیت بروز رسانی شد .');
    }

    public function delete ($id, $title)
    {
        Group::destroy($id);
        return redirect()->back()->with('message', 'گروه '.$title.' با موفقیت حذف شد .');
    }

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
}
