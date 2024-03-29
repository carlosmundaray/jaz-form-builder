@extends('formbuilder::layout')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
<div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="card-title">
                        {{ $pageTitle }} ({{ $submissions->count() }})
                        
                        <a href="{{ route('formbuilder::forms.index') }}" class="btn btn-primary float-md-right btn-sm">
                            <i class="fa fa-arrow-left"></i> Back To Forms
                        </a>
                    </h5>
                </div>
            </div>
   

                @if($submissions->count())
                    <div class="table-responsive">
                        <table class="table table-bordered d-table table-striped pb-0 mb-0">
                            <thead>
                                <tr>
                                    <th class="five">#</th>
                                    <th class="fifteen">User Name</th>
                                    @foreach($form_headers as $header)
                                        <th>{{ $header['label'] ?? title_case($header['name']) }}</th>
                                    @endforeach
                                    <th class="fifteen">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($submissions as $submission)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $submission->user->name ?? 'n/a' }}</td>
                                        @foreach($form_headers as $header)
                                            <td>
                                                {{ 
                                                    $submission->renderEntryContent(
                                                        $header['name'], $header['type'], true
                                                    ) 
                                                }}
                                            </td>
                                        @endforeach
                                        <td>
                                            <a href="{{ route('formbuilder::forms.submissions.show', [$form, $submission->id]) }}" class="btn btn-primary btn-sm" title="View submission">
                                                <i class="fa fa-eye"></i> View
                                            </a> 
                                            <a href="{{ route('formbuilder::my-submissions.edit', [$submission->id]) }}" class="btn btn-primary btn-sm" title="Edit submission">
                                                    <i class="fa fa-pencil"></i> 
                                            </a> 
                                            <form action="{{ route('formbuilder::forms.submissions.destroy', [$form, $submission]) }}" method="POST" id="deleteSubmissionForm_{{ $submission->id }}" class="d-inline-block">
                                                @csrf 
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm confirm-form" data-form="deleteSubmissionForm_{{ $submission->id }}" data-message="Delete this submission?" title="Delete submission">
                                                    <i class="fa fa-trash-o"></i> 
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="card-body">
                        <h4 class="text-danger text-center">
                            No submission to display.
                        </h4>
                    </div>  
                @endif
            </div>
        </div>
    </div>
@endsection
