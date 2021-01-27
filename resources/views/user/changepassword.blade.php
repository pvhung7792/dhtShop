@extends('frontend.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3 rounded p-3" style="background-color:#e9ecef">
            <div class="panel panel-default row justify-content-center">
                 @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                <div class="panel-heading text-center"><h5>Thay đổi mật khẩu</h5></div>

                <div class="panel-body col-md-10 col-md-offset-1">
                    <form class="form-horizontal" method="POST" action="{{ route('changePass') }}" class="">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label for="new_password" class="control-label">Mật khẩu cũ</label>

                            <div>
                                <input id="old_password" type="password" class="form-control" name="old_password" required>

                                @if ($errors->has('old_password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label for="new_password" class="control-label">Mật khẩu mới</label>

                            <div>
                                <input id="new_password" type="password" class="form-control" name="new_password" required>

                                @if ($errors->has('new_password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation" class="control-label">Nhập lại mật khẩu mới</label>

                            <div>
                                <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                                @if ($errors->has('new_password_confirmation'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop()
