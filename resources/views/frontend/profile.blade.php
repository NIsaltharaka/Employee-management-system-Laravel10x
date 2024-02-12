@extends('layout.index')
@section('title', 'profile')
@section('nav')
@endsection
@section('header')
@endsection
@section('content')

<div class="content">
    <div class="row d-flex justify-content-center align-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercase">profile</h4><hr>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="card-body p-5">
                        <form action="#" method="POST" id="profile_form">
                                @csrf  
                                <div class="mb-3">
                                    <label for="name">name :</label> {{ $userInfo->name }}
                                </div>
                                <div class="mb-3">
                                    <label for="email">email :</label> {{ $userInfo->email }}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

</script>
@endsection
