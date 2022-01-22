@extends('layouts.app')

    @section('title')"{{ $title }}@endsection

    @section('content')
        <div class="game-content">
            <div id="game" class="container">
                @php
                    $item = 1;
                    $iV = 1;
                    $maxBlocks = 4;
                @endphp
                <table>
                @for($iH = 1; $iH <= $maxBlocks; $iH++)
                    <tr>
                        @for($iV = 1; $iV <= $maxBlocks; $iV++)
                            <td>{{ $item++ }}</td>
                        @endfor
                    </tr>
                @endfor
                </table>

                <button class="btn btn-block">Start</button>

                <p id="timer"></p>

                <div id="winner">
                    <p id="youWin">You Win</p>
                    <p id="yourTime">Just a second</p>
                    <button id="theEnd">Play New Game</button>
                </div>
            </div>
        </div>
    @endsection
