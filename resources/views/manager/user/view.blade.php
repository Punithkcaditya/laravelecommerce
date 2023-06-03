@extends('manager.layouts.app', ['title' => 'User Approval'])

@section('css')
@endsection

@section('content')

<!-- Start Content-->
<div class="container-fluid">
    <x-alert></x-alert>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">{{env('APP_NAME')}}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('manager.user.index')}}">{{__('User Approval')}}</a></li>
                        <li class="breadcrumb-item active">{{__('view')}}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{__('User Approval')}}</h4>
            </div>
        </div>
    </div>

    <div class="card-box">
        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">{{__('User Details')}}</h5>

        <!-- <div class="form-group mb-3">
            <label for="name">{{__('User ID')}}</label>
            <input type="text" value="{{$user->id}}" class="form-control" readonly>

        </div> -->
        <div class="row offset-1">
            <div class="col-md-5">
                <div class="form-group mb-3">
                    <label for="name">{{__('User Name')}} </label>
                    <input type="text" value="{{$user->name}}" class="form-control" readonly>

                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group mb-3">
                    <label for="name">{{__('User Email')}}</label>
                    <input type="text" value="{{$user->email}}" class="form-control" readonly>
                </div>
            </div>
        </div>





        <!-- <div class="form-group mb-3">
            <label for="name">{{__('User status')}}</label>
            <input type="text" value="{{($user->status == 0)?'Approval Bending':''}}" class="form-control" readonly>
        </div> -->

        @if($user->status == 0)
        <div class="row mt-5">
            <div class="col">
                <div class="text-sm-center">
                    <a type="button" href="{{route('manager.user.approve',$user->id)}}" class="btn btn-success waves-effect waves-light mb-2 text-white"><i class="mdi mdi-correct"></i>{{__('Accept')}}
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="text-sm-center">
                    <a type="button" href="{{route('manager.user.decline',$user->id)}}" class="btn btn-danger waves-effect waves-light mb-2 text-white">{{__('Decline')}}
                    </a>
                </div>
            </div>
        </div>
        @elseif($user->status == 1)
        <div class="">
            <div class="text-center">
                <span class="text-success h3">Approved</span>
            </div>
        </div>
        @else
        <div class="">
            <div class="text-center">
                <span class="text-danger h3">Declined</span>
            </div>
        </div>
        @endif
    </div>


</div> <!-- container -->

@endsection

@section('script')
@endsection