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
                            <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">{{env('APP_NAME')}}</a></li>
                            <li class="breadcrumb-item active">{{__('User Approval')}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{__('User Approval')}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">


                        <div class="float-right">
                         
                        
                        </div>


                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Change Status</th>
                                   
                                    
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($users as $user)
                               <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                @if($user->status == 0)
                                <td><span class="text-warning">Approval Pending</span> </td>
                                @elseif($user->status == 1)
                                <td><span class="text-success">Approved</span> </td>
                                @elseif($user->status == 2)
                                <td><span class="text-danger">Approval Declined</span> </td>
                                @endif
                                <td> <a href="{{route('manager.user.view',['id'=>$user->id])}}"
                                               style="font-size: 20px"> <i
                                                    class="mdi mdi-eye"></i></a></td>
                               </tr>

                               @endforeach
                                
                                </tbody>
                            </table>
                        </div>


                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
        </div>
    </div> <!-- container -->

@endsection

@section('script')
@endsection
