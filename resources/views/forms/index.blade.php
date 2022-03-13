@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="btn-group">
                <a href="{{ route('forms.create') }}" type="button" class="btn btn-primary">Add New Form</a>
            </div>
            <br><br>
            <div class="card">
            @if(session('success'))
                <div class='alert alert-success'>{{session('success')}}</div>
            @endif
            @if(session('error_msg'))
                <div class='alert alert-danger'>{{session('error_msg')}}</div>
            @endif
                <div class="card-header">{{ __('Manage Forms') }}</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Form Title</th>
                                <th>Comments</th>
                                <!-- <th>Edit</th> -->
                                <th>View</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!$forms->isEmpty())
                            @php $i = 1; @endphp
                            @foreach($forms as $form)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ ucwords($form->form_title) }}</td>
                                    <td>{{ $form->comments }}</td>
                                    @php
                                    $form_id = Crypt::encryptString($form->id);
                                    @endphp
                                    <!--<td><a href="{{ route('forms.edit', $form->id)}}" class="btn btn-primary">Edit</a></td>-->
                                    <td><a href="{{ route('forms.show', $form_id)}}" class="btn btn-primary">View</a></td>
                                    <td>
                                        <form action="{{ route('forms.destroy', $form_id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td class="alert alert-danger text-center" colspan="5"><strong>No Records Found</strong></td></tr>
                        @endif
                        </tbody>
                    </table>
                    {{ $forms->links() }}
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection
