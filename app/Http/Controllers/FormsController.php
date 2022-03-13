<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormElements;
use Illuminate\Support\Facades\Crypt;

class FormsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = Form::where(['status'=>1])->orderBy('id','desc')->latest()->paginate(5);
        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form_elements_names=[];
        $form_elements_names = ['text'=>"Text","email"=>"Email","number"=>"Number"];
        return view('forms.create', compact('form_elements_names'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'form_title'=> 'required|string',
            "label_name.*"  => "required|string",
            "form_element_name.*"  => "required|string",
        ]);
        $final_form_element_arr=[];
        $form = new Form();
        $form->form_title = $request->get('form_title');
        $form->status = 1;
        $form->comments = $request->get('comments');
        $form->save();
        
        $label_name_arr = $request->get('label_name');
        $form_element_name_arr = $request->get('form_element_name');
        
        for($i=0;$i<count($label_name_arr);$i++) {
            $label_name = $label_name_arr[$i];
            $form_element_name = $form_element_name_arr[$i];
            $final_form_element_arr[] = ['form_id'=>$form->id,'label_name'=>$label_name,'form_element_name'=>$form_element_name,'status'=>1];
        }
        $final_forms_list = FormElements::insert($final_form_element_arr);
        if($final_forms_list) {
            return redirect('forms')->With('success',"Forms are Added Successfully");
        } else {
            return redirect('forms')->With('error_msg',"Something is went wrong");
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form_id = Crypt::decryptString($id);
        $form_element_data = Form::with('formelements')->whereHas('formelements', function($query) use ($form_id){
            $query->where(['status'=>1,'form_id'=>$form_id]);
        })->where(['id'=>$form_id,'status'=>1])->first();
        return view('forms.view_form',compact('form_element_data'));
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form_id = Crypt::decryptString($id);
        $delform = Form::where(['id'=>$form_id])->update(['status'=>0]);
        $del_form_ele = FormElements::where(['form_id'=>$form_id])->update(['status'=>0]);
        if($del_form_ele || $delform) {
            return redirect('forms')->with('success',"Forms are deleted Successfully");
        } else {
            return redirect('forms')->with('error_msg',"Something is wrong");
        }
    }
}
