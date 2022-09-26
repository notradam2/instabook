@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Contact Details</div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ HTML::image($contact->photo, "$contact->first_name avatar", array('class' => 'img-thumbnail')) }}
                                </div>
                            </div>
                            <div class="col-md-8">

                                <div class="form-group">
                                    <strong>First Name</strong>
                                    <p>{{ $contact->first_name }}</p>
                                </div>

                                <div class="form-group">
                                    <strong>Last Name</strong>
                                    <p>{{ $contact->last_name }}</p>
                                </div>

                                <div class="form-group">
                                    <strong>Email</strong>
                                    <p>{{ $contact->email }}</p>
                                </div>
                                <a class="btn btn-primary" href="{{ route('contacts.index') }}">Back</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection