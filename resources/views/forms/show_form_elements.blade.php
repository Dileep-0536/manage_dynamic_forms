@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('View Form Elements') }}</div>

                <div class="card-body">
                <h5 class="card-title">{{ ucwords($form_element_data->form_title) }}</h5>
                <p class="card-title">Comments: {{ $form_element_data->comments }}</p>
                
                    @if(isset($form_element_data->formelements))
                    <form method="post">
                        @foreach($form_element_data->formelements as $formelement) 
                            <div class="row mb-3">
                                @php
                                $html_element_name = strtolower(str_replace(' ', '_', $formelement->label_name));
                                @endphp
                            <label for="{{ $html_element_name }}" class="col-md-4 col-form-label text-md-end">{{ ucwords($formelement->label_name) }}</label>
                            <div class="col-md-6">
                               
                                <input type="{{ $formelement->form_element_name }}" class="form-control" name="{{ $html_element_name }}" id="{{ $html_element_name }}"/>
                            </div>
                            </div>
                        @endforeach
                    </form>
                    @else
                        <div class='alert alert-dnager'>No Html Elements Found</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
