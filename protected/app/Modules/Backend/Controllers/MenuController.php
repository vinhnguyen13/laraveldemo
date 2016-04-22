<?php namespace App\Modules\Backend\Controllers;

use Auth;
use Config;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Menu;
use App\Models\Category;
use App\Libs\Utils\Vii;

use App\Modules\Backend\Requests\MenuPostRequest;

class MenuController extends BaseController{

    public function __construct(){
        parent::__construct();
    }
    
    
    public function getMenuCatList(Request $request){
        $cats = Category::where('tag', 'menu')->paginate(20);
        
        $cats->setPath('');
        $cats->appends(['mid' => $request->input('mid')]);
        
        $qs = Vii::queryStringBuilder(['mid' => $request->input('mid')]);
        
        return view(
            'Backend::menu.list-cats',
            [
                'cats' => $cats,
                'qs' => $qs
            ]
        );
    }
    
    public function getMenuList(Request $request, $cid=null){
        $menus = Menu::where('cat_id', $cid)
            ->orderBy('ordering', 'ASC')
            ->paginate(20);
        
        $menus->setPath('');
        $menus->appends(['mid' => $request->input('mid')]);
        
        $qs = Vii::queryStringBuilder(['mid' => $request->input('mid')]);
        
        return view(
            'Backend::menu.list-menus',
            [
                'menus' => $menus,
                'cat_id' => $cid,
                'qs' => $qs
            ]
        );
        
    }
    
    public function getMenu(Request $request, $cid, $id=null){
        $qs = [
            'mid' => $request->input('mid')
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        if($id != null){
            $menu = Menu::find($id);
            
            //dd($menu->toArray());
            return view(
                'Backend::menu.edit-menu',
                [
                    'menu' => $menu,
                    'cat_id' => $cid,
                    'qs' => $qs
                    
                ]
            );
        }
        
        return view(
            'Backend::menu.create-menu',
            [
                'cat_id' => $cid,
                'qs' => $qs,
            ]
        );
    }
    
    public function postMenu(MenuPostRequest $request){
        
        $qs = [
            'mid' => $request->input('mid')
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        $data = $request->all();
        
    
        $menu = new Menu($data);
        
        $menu->ordering = $this->getNewOrdering($data['cat_id']);
        
        if($menu->alias == ''){
            $menu->alias = Vii::makeAlias($menu->title);
        }
        
        
        if($menu->save()){
            return redirect('admin/menu/' . $data['cat_id'] . $qs);
        }
        
        return redirect('admin/menu/create/' . $data['cat_id'] . $qs);
        
    }
    
    public function putMenu(MenuPostRequest $request, $id=null){
        $_form = $request->all();
        
        
        $data = [
            'title' => $_form['title'],
            'title_en' => $_form['title_en'],
            'url' => $_form['url'],
            'published' => $_form['published']
        ];
        
        if($_form['alias'] == ''){
            $data['alias'] = Vii::makeAlias($_form['title']);
        }
                
        Menu::find($_form['id'])->update($data);
        
        
        $qs = [
            'mid' => $request->input('mid')
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        return redirect('admin/menu/' . $_form['cat_id'] . $qs);
        
    }
    
    public function postOrdering(Request $request){
        $qs = [
            'mid' => $request->input('mid'),
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        
        $ids = $request->input('ids');
        $ordering = $request->input('ordering');
        $cid = $request->input('cat_id');
        
        //dd($request->all());
        
        $arr_ordering = array_combine($ids, $ordering);
        
        Menu::whereIn('id', $ids)
            ->chunk(100, function($menus) use($arr_ordering) {
                foreach($menus as $item){
                    $item->ordering = $arr_ordering[$item->id];
                    $item->save();
                }
            });
        
        return redirect('admin/menu/' . $cid . $qs);
        
    }
    
    public function getPublished(Request $request, $cid, $id){
        $qs = [
            'mid' => $request->input('mid'),
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        $content = Menu::find($id);
        $data = [
            'published' => 1 - $content->published
        ];
            
        $content->update($data);
        
        return redirect('admin/menu/' . $cid . $qs);
        
    }
    
    public function getDelete(Request $request, $cid, $id){
        
        $qs = [
            'mid' => $request->input('mid'),
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        Menu::destroy($id);
        
        return redirect('admin/menu/' . $cid . $qs);
    }
    
    private function getNewOrdering($cid, $plus=1){
        $max_ordering = Menu::where('cat_id', $cid)->max('ordering');
        
        if($max_ordering == null)
            $max_ordering = 0;
        
        return $max_ordering + $plus; 
    }
    
    
}