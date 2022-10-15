@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Contacts</div>

                    <div class="card-body">
                        <div class="text-left mb-3">
                            <a class="btn btn-primary" href="{{ route('contacts.create') }}">Create New Contact</a>
                        </div>


                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <tr>
                                <th>First Name xx</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Avatar</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->first_name }}</td>
                                    <td>{{ $contact->last_name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>
                                        @if($contact->photo)
                                        <div class="text-center">
                                            {{ HTML::image($contact->photo, "$contact->first_name avatar", array('class' => 'avatar')) }}
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                            <a class="btn btn-secondary text-white" href="{{ route('contacts.show',$contact->id) }}">
                                                <i class="bi bi-info-circle"></i>
                                            </a>

                                            <a class="btn btn-secondary" href="{{ route('contacts.edit',$contact->id) }}">
                                                <i class="bi bi-pen-fill"></i>
                                            </a>
                                            <a class="btn btn-secondary" href="{{ route('mails.create',$contact->id) }}">
                                                <i class="bi bi-send"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="showDeleteModal btn btn-secondary" data-id="{{ $contact->id }}">
                                                <i class="bi bi-trash"></i>
                                            </a>

                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {!! $contacts->links() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('common.delete_confirmation', [
        'title' => __('Contact Deletion'),
    ])
@endsection