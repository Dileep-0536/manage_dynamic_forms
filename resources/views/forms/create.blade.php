@extends('layouts.app')

@section('content')
<style>
    .form_element,.element_section {
        border: 1px solid #000;
        padding: 10px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              
                <div class="card-header">{{ __('Add New Form') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                    @endif
                    <form method="post" action="{{ route('forms.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="form_title" class="col-md-4 col-form-label text-md-end">Form Title: *</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control" name="form_title" required id="form_title" placeholder="Enter Form Title"  value="{{ old('form_title') }}"/>
                            @error('form_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror    
                        </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                            <h5 class="card-header">Add Form Element</h5>
                                <div class="card-body">
                                    <div class='form_element' id="row_1">
                                        <div class="row mb-3">
                                            <label for="label_name" class="col-md-4 col-form-label text-md-end">Label Name: *</label>
                                            <div class="col-md-6">
                                            <input type="text" class="form-control" required name="label_name[]" id="label_name" value="{{ old('label_name[]') }}"/>
                                            @error('label_name[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror     
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="form_element_name" class="col-md-4 col-form-label text-md-end">Form Element: *</label>
                                            <div class="col-md-6">
                                                <select name="form_element_name[]" required id="form_element_name" class="form-control form_element_name" value="{{ old('form_element_name[]') }}">
                                                    <option value="">Select Form Element</option>
                                                    @foreach($form_elements_names as $form_element_name_key => $form_elements_name_value)
                                                    <option value="{{ $form_element_name_key }}">{{ $form_elements_name_value }}</option>
                                                    @endforeach
                                                </select>
                                                @error('form_element_name[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                                            </div>
                                        </div>
                                        <div class="row md-3 select_options_row_1"></div>
                                        <div class="row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="button" class="btn btn-secondary btn-sm btn_form_element">
                                                    {{ __('+ Add Form Element') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form_element_append_section"></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <label for="comments" class="col-md-4 col-form-label text-md-end">Comments: (optional)</label>
                            <div class="col-md-6">
                            <textarea id="comments" name="comments" rows="4" cols="50">{{ old('comments') }}</textarea>
                            </div>
                        </div>
                        <br><br>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Form') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-scripts')
<script>
var i=1;  
$(document).ready(function(){
    //append form element
    $('.btn_form_element').click(function(){  
     i++;  
     $('.form_element_append_section').append("<div class='element_section' id='row_"+i+"'><div class='row mb-3'><label for='label_name' class='col-md-4 col-form-label text-md-end'>Label Name:</label><div class='col-md-6'><input type='text' class='form-control' name='label_name[]' id='label_name'/></div></div><div class='row mb-3'><label for='form_element_name' class='col-md-4 col-form-label text-md-end'>Form Element:</label><div class='col-md-6'><select name='form_element_name[]' id='form_element_name' class='form-control form_element_name'><option value=''>Select Form Element</option><option value='text'>Text</option><option value='email'>Email</option><option value='number'>Number</option></select></div></div><div class='row md-3 select_options' id='select_options_"+i+"' style='display: none;'><label for='options' class='col-md-4 col-form-label text-md-end'>Options:</label><div class='col-md-6 options_column'><input type='text' name='options[]' id='options'> <button type='button' class='options_btn' class='btn btn-primary btn-sm'>+</button></div></div> <div class='row mb-0'><div class='col-md-8 offset-md-4'><button type='button' class='btn btn-secondary btn-sm btn_remove' id='"+i+"'>Remove</button></div></div></div><br/>");  
    });

    //remove form element
    $(document).on('click','.form_element_append_section .element_section .btn_remove',function(){  
        $(this).closest('.element_section').remove();
    }); 
}); 
</script>
@endsection