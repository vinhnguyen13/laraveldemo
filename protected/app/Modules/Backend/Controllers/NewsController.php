<?php namespace App\Modules\Backend\Controllers;

use Auth;

use Config;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Content;

use App\Libs\Utils\Vii;
use App\Modules\Backend\Requests\ContentPostRequest;

class NewsController extends BaseController{

    
    public function __construct(){
        parent::__construct();
    }
    
    public function getNewsList(Request $request){

        $contents = Content::orderBy('ordering', 'DESC')
            ->paginate(20);
        
        $contents->setPath('');
        $contents->appends(['mid' => $request->input('mid')]);
        
        $qs = Vii::queryStringBuilder(['mid' => $request->input('mid')]);
        
        return view(
            'Backend::news.list-news',
            [
                'contents' => $contents,
                'qs' => $qs
            ]
        );
        
    }
    
    public function getContent(Request $request, $id=null){

        $qs = [
            'mid' => $request->input('mid')
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        if($id != null){
            $content = Content::find($id);
            
            if($content->intro_text != ''){
                $content->content_text = $content->intro_text . '<hr class="line-break">' . $content->content_text;
            }
            
            $meta_description = '';
            $meta_keywords = '';
            if($content->meta_data != ''){
                $a = json_decode($content->meta_data, true);
                $meta_description = $a['meta_description'];
                $meta_keywords = $a['meta_keywords'];
            }
            
            //dd($content->toArray());
            return view(
                'Backend::news.edit-news',
                [
                    'content' => $content,
                    'meta_description' => $meta_description,
                    'meta_keywords' => $meta_keywords,
                    'qs' => $qs
                    
                ]
            );
        }
        
        return view(
            'Backend::news.create-news',
            [
                'qs' => $qs,
            ]
        );
        
    }
    
    public function postContent(ContentPostRequest $request){
        $qs = [
            'mid' => $request->input('mid')
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        $data = $request->all();
        $content = new Content($data);
        $content->created_at = date('Y-m-d H:i:s');
        $content->ordering = $this->getNewOrdering();
        
        $content->meta_data = json_encode([
            'meta_description' => $data['meta_description'],
            'meta_keywords' => $data['meta_keywords']
        ]);
        
        if($data['alias'] == ''){
            $content->alias = Vii::makeAlias($content->title);
        }
        else{
            $content->alias = Vii::makeAlias($content->alias);
        }
        
        $atemp = explode('<hr class="line-break">', $content->content_text);
        
        if(count($atemp) == 2){
            $content->intro_text = $atemp[0];
            $content->content_text = $atemp[1];
        }
        else{
            $content->intro_text = '';
        }
        
        //dd($content->toArray());
        
        if($content->save()){
            return redirect('admin/content' . $qs);
        }
        
        return redirect('admin/content/create' . $qs);
    }
    
    public function putContent(ContentPostRequest $request, $id=null){
        $_form = $request->all();
        
        $data = [
            'title' => $_form['title'],
            'alias' => ($_form['alias'] != '') ? $_form['alias'] : Vii::makeAlias($_form['title']),
            'modified_at' => date('Y-m-d H:i:s'),
            'published' => $_form['published']
        ];
        
        $data['meta_data'] = json_encode([
            'meta_description' => $_form['meta_description'],
            'meta_keywords' => $_form['meta_keywords']
        ]);
        
        $atemp = explode('<hr class="line-break">', $_form['content_text']);
        
        if(count($atemp) == 2){
            $data['intro_text'] = $atemp[0];
            $data['content_text'] = $atemp[1];
        }
        else{
            $data['intro_text'] = '';
            $data['content_text'] = $_form['content_text'];
        }
        
        
        Content::find($_form['id'])->update($data);
        
        
        $qs = [
            'mid' => $request->input('mid')
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        return redirect('admin/content' . $qs);
        
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
        
        $arr_ordering = array_combine($ids, $ordering);
        
        Content::whereIn('id', $ids)
            ->chunk(100, function($contents) use($arr_ordering) {
                foreach($contents as $item){
                    $item->ordering = $arr_ordering[$item->id];
                    $item->save();
                }
            });
        
        return redirect('admin/content' . $qs);
        
    }
    
    public function getPublished(Request $request, $id){
        $qs = [
            'mid' => $request->input('mid'),
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        $content = Content::find($id);
        $data = [
            'published' => 1 - $content->published
        ];
            
        $content->update($data);
        
        return redirect('admin/content' . $qs);
        
    }
    
    public function getDelete(Request $request, $id){
        
        $qs = [
            'mid' => $request->input('mid'),
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        Content::destroy($id);
        
        return redirect('admin/content' . $qs);
    }
    
    private function getNewOrdering($plus=1){
        $max_ordering = Content::max('ordering');
        
        if($max_ordering == null)
            $max_ordering = 0;
        
        return $max_ordering + $plus; 
    }
    
    
}