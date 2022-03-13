<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\Crypt;

// only for public visible
class FormsDisplayController extends Controller
{
    public function get_public_forms()
    {
        $public_forms_list = Form::where(['status'=>1])->latest()->paginate(5);
        return view('forms.forms_display',compact('public_forms_list'));
    }

    public function view_public_form($form_id)
    {
        $form_id = Crypt::decryptString($form_id);
        $form_element_data = Form::with('formelements')->whereHas('formelements', function($query) use ($form_id){
            $query->where(['status'=>1,'form_id'=>$form_id]);
        })->where(['id'=>$form_id,'status'=>1])->first();
        return view('forms.show_form_elements',compact('form_element_data'));
    }
}
