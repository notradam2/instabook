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
                                <th>First Name</th>
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
                                        <div class="text-center">
                                            {{ HTML::image($contact->photo, "$contact->first_name avatar", array('class' => 'avatar')) }}
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">

                                            <a class="btn btn-primary" href="{{ route('contacts.show',$contact->id) }}">Show</a>

                                            <a class="btn btn-primary" href="{{ route('contacts.edit',$contact->id) }}">Edit</a>
                                            <a class="btn btn-primary" href="{{ route('contacts.edit',$contact->id) }}">Email</a>

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
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
@endsection