@extends('layouts.user-account')
@section('title', 'Notification')

@section('my-account')
    <div class="dashboard-wishlist">
        <div class="title">
            <h2>Notifications</h2>
            <span class="title-leaf title-leaf-gray">
                <svg class="icon-width bg-gray">
                    <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                </svg>
            </span>
        </div>

        @if(auth()->user()->notifications()->count() > 0)
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Notification</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $key => $notification)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $notification->data['message'] }}</td>
                            <td><em>{{ $notification->created_at->diffForHumans() }}</em></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h4 class="text-center fw-bold text-warning">You dont have any notification yet!</h4>
        @endif
    </div>
@endsection
