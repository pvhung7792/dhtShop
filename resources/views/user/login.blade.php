@extends('frontend.main')
@section('content')



<div class="container my-5 py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(session('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button>
                    <strong>{{session('error')}}</strong>
                </div>
                @endif
                <div class="card-header">{{ __('Đăng nhập') }}</div>
                <div class="card-body">
                     
                   <p class="alert alert-danger text-danger font-italic error errlog" style="display: none"></p>
                    
                    <form method="POST" action="{{ route('post_login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" placeholder="Email" >

                                
                                   <p class="text-danger font-italic error errEmail" style="display: none"></p>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                               
                                <p class="text-danger font-italic  error errPass" style="display: none"></p>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" value='1'>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                         
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary subm1" >
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        <a href="{{route('forget_pass')}}">Quên mật khẩu</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
      
                $('.subm1').click(function(e){
                     console.log('djfdkfjg');
            e.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                'url':'{{route("post_login") }}',
                'type':'POST',
                'data':{
                    'email':$('#email').val(),
                    'password':$('#password').val(),
                },

                success:function(data){
                    $('.error').hide();
                    /*console.log(data);*/
                    if(data.error==true){
                       /* console.log(data.message.password);
                        console.log(data.message.email);
                        console.log(data.errorlogin);*/
                        if(data.message.email != undefined){
                            $('.errEmail').show().text(data.message.email);
                        }
                        if(data.message.password != undefined){
                            $('.errPass').show().text(data.message.password);
                        }
                        if((data.message.email == undefined) &&(data.message.password == undefined)){
                            /*console.log(data.errorlogin);*/
                            $('.errlog').show().text(data.errorlogin);    
                        }
 
                    }else{
                        let previousPage = "{{isset($_GET['prev'])?$_GET['prev']:''}}"
                        if (previousPage == 'cart') {
                            window.location="{{route('cart.purchase')}}";
                        }else{
                            window.location="{{route('home')}}";
                        }
                    }
                }
            })
        });
             
    });  
    
</script>

@endsection

