@extends('layouts.app')

    @section('title')"{{$title}}"@endsection

    @section('content')

        <div class="home-content">
            <div class="form-wrap">
                <form action="{{ route('Create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="input name">
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="text" class="form-control" name="email" placeholder="input email">
                    </div>
                    <div class="form-group">
                        <label for="subject">subject</label>
                        <input type="text" class="form-control" name="text" placeholder="input subject">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" name="message" placeholder="Edit it"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Send</button>
                </form>
            </div>
        </div>

    @endsection

    @section('aside')
        @parent
            <p>adding text</p>
    @endsection
