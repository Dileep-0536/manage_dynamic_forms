@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Public Forms') }}</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Form Title</th>
                                <th>Comments</th>
                                <th>View Form</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!$public_forms_list->isEmpty())
                       
                            @php $i = 1; @endphp
                            @foreach($public_forms_list as $form)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ ucwords($form->form_title) }}</td>
                                    <td>{{ $form->comments }}</td>
                                    @php
                                    $form_id = Crypt::encryptString($form->id);
                                    @endphp
                                    <td>
                                    <a href="{{ route('public_forms.show', $form_id)}}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td class="alert alert-danger text-center" colspan="4"><strong>No Forms are Found</strong></td></tr>
                        @endif
                        </tbody>
                    </table>
                    {{ $public_forms_list->links() }}
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection
