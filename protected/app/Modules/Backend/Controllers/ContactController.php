<?php namespace App\Modules\Backend\Controllers;

use Auth;
use Config;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Contact;
use App\Libs\Utils\Vii;
use App\Modules\Backend\Requests\ContactPostRequest;


class ContactController extends BaseController{

    
    public function __construct(){
        parent::__construct();
    }
    
    public function getContactList(Request $request){
        //$user = Auth::admin()->get();
        $contacts = Contact::orderBy('ordering', 'ASC')
            ->paginate(20);
        
        $contacts->setPath('');
        $contacts->appends(['mid' => $request->input('mid')]);
        
        $qs = Vii::queryStringBuilder(['mid' => $request->input('mid')]);
        
        return view(
            'Backend::contact.list-contacts',
            [
                'contacts' => $contacts,
                'qs' => $qs
            ]
        );
        
    }
    
    public function getContact(Request $request, $id=null){
        
        $qs = [
            'mid' => $request->input('mid')
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        if($id != null){
            $contact = Contact::find($id);
            //dd($section->toArray());
            return view(
                'Backend::contact.edit-contact',
                [
                    'contact' => $contact,
                    'qs' => $qs
                    
                ]
            );
        }
        
        return view(
            'Backend::contact.create-contact',
            [
                'qs' => $qs
            ]
        );
        
    }
    
    public function postContact(ContactPostRequest $request){
        $qs = [
            'mid' => $request->input('mid')
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        $data = $request->all();
        
        $contact = new Contact($data);
        $contact->map_photo = '';
        $contact->ordering = $this->getNewOrdering();
        
        //dd($contact->toArray());
        
        if($contact->save()){
            return redirect('admin/contact' . $qs);
        }
        
        return redirect('admin/contact/create' . $qs);
    }
    
    public function putContact(ContactPostRequest $request, $id=null){
        $_form = $request->all();
        
        $data = [
            'building_name' => $_form['building_name'],
            'building_name_en' => $_form['building_name_en'],
            'address' => $_form['address'],
            'address_en' => $_form['address_en'],
            'phone' => $_form['phone'],
            'fax' => $_form['fax'],
            'email' => $_form['email'],
            'hotline' => $_form['hotline'],
            //'map_photo',
            'gmap_url' => $_form['gmap_url'],
            'facebook' => $_form['facebook'],
            'youtube' => $_form['youtube'],
            'instagram' => $_form['instagram'],
            'published' => $_form['published']
        ];
        
        Contact::find($_form['id'])->update($data);
        
        
        $qs = [
            'mid' => $request->input('mid')
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        return redirect('admin/contact' . $qs);
        
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
        
        Contact::whereIn('id', $ids)
            ->chunk(100, function($contacts) use($arr_ordering) {
                foreach($contacts as $item){
                    $item->ordering = $arr_ordering[$item->id];
                    $item->save();
                }
            });
        
        return redirect('admin/contact' . $qs);
        
    }
    
    public function getPublished(Request $request, $id){
        $qs = [
            'mid' => $request->input('mid'),
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        $contact = Contact::find($id);
        $data = [
            'published' => 1 - $contact->published
        ];
            
        $contact->update($data);
        
        return redirect('admin/contact' . $qs);
        
    }
    
    public function getDelete(Request $request, $id){
        
        $qs = [
            'mid' => $request->input('mid'),
        ];
        
        if($request->input('page'))
            $qs['page'] = $request->input('page');
        
        $qs = Vii::queryStringBuilder($qs);
        
        Contact::destroy($id);
        
        return redirect('admin/contact' . $qs);
    }
    
    private function getNewOrdering($plus=1){
        $max_ordering = Contact::max('ordering');

        if($max_ordering == null)
            $max_ordering = 0;
        
        return $max_ordering + $plus; 
    }
   
}