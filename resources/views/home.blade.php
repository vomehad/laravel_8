@extends('layouts.app')

    @section('title')"{{$title}}"@endsection

    @section('content')

        <div class="home-content">
            @if ($errors->any())
                @php
                    $nameFault = $errors->first('name');
                    $emailFault = $errors->first('email');
                    $subjectFault = $errors->first('subject');
                @endphp
            @endif
            <div class="form-wrap">
                <form action="{{ route('Create') }}" method="post" class="row g-3 needs-validation" novalidate>

                    @csrf

                    <label for="validationCustomUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Please choose a username.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text"
                                   class="form-control {{ !empty($nameFault) ? "border-danger" : "" }}"
                                   name="name"
                                   placeholder="input name"
                                   id="name"
                            >
                        </div>
                        @if (!empty($nameFault))
                            <div class="alert alert-danger">
                                <div class="">
                                    <span>{{ $nameFault }}</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text"
                                   class="form-control {{ !empty($emailFault) ? "border-danger" : "" }}"
                                   name="email"
                                   placeholder="input email"
                                   id="email"
                            >
                        </div>
                        @if (!empty($emailFault))
                            <div class="alert alert-danger">
                                <div class="">
                                    <span>{{ $emailFault }}</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="subject">subject</label>
                            <input type="text"
                                   class="form-control {{ !empty($subjectFault) ? "border-danger" : "" }}"
                                   name="text"
                                   placeholder="input subject"
                                   id="subject"
                            >
                        </div>
                        @if (!empty($subjectFault))
                            <div class="alert alert-danger">
                                <div class="">
                                    <span>{{ $subjectFault }}</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" name="message" placeholder="Edit it" id="message"></textarea>
                        </div>
                    </div>

                    <div class="ml-5">
                        <button type="submit" class="btn btn-success">Send</button>
                    </div>

                </form>
            </div>
        </div>

    @endsection

    @section('aside')
        @parent
            <p>adding text</p>
    @endsection
