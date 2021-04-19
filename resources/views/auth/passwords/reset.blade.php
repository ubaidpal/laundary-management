{{-- {{dd($errors->first('password'))}} --}}
<html lang="en">
<head>
  <title>MenuBar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
    body{
        height: 100%;
    }
    .a1{
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        position: absolute;
    }
    .box{
        width: 430px;
        max-height: 100%;
        background: #75efd3;
    }
    form{
        margin: 45px;
        margin-left: 20px;
        margin-right: 20px;
    }
    button{
        width: 100%
    }
    label{
        text-align: left !important;
    }
    .mt-15{
        margin-top: 5%;
    }
</style>
</head>

<body>

<div class="container mt-15">
    <div class="row">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                          <h3><i class="fa fa-lock fa-4x"></i></h3>
                          <h2 class="text-center">Reset Password</h2>

                            <div class="panel-body">
                                <form action="{{ route('reset.password',$token) }}" method="POST">
                                    {!! csrf_field() !!}

                                    <input type="hidden" name="type" value={{ $type }}>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" name="email" value="{{$email}}" readonly >
                                    </div>
                                    @if($errors->first('email'))
                                    <span class="text text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="email">New Password:</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    @if($errors->first('password'))
                                    <span class="text text-danger">
                                        {{ $errors->first('password') }}
                                    </span>
                                    @endif
                                    <div class="form-group">
                                        <label for="pwd">Confirm Password:</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






</body>
</html>

