@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Compose Mail</div>

                    <div class="card-body col-md-6">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('mails.send',[$contact->id]) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="sendToInput">Send To</label>
                                <input type="text" name="email" class="form-control" id="sendToInput" value="{{ $contact->email }}">
                            </div>

                            <div class="form-group">
                                <label for="subjectInput">Subject</label>
                                <input type="text" name="subject" class="form-control" id="subjectInput" aria-describedby="emailHelp" placeholder="Enter Your Subject">
                            </div>

                            <div class="form-group">
                                <label for="bodyInput">Message</label>
                                <textarea name="body" class="form-control" rows="10" id="bodyInput"></textarea>
                            </div>

                            <a class="btn btn-primary" href="{{ route('contacts.index') }}">Back</a>
                            <button type="submit" class="btn btn-primary">Send</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection