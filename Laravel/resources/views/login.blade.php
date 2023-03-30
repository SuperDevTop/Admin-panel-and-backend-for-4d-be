
<html>
    <head>
        <title>Log In</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="{{ url('imgs/2.jpg') }}">
    </head>
    <body class="bg-dark">
        <div>
            <img src="/imgs/1.png" class="ml-auto mr-auto mt-5 mb-5 pt-5 d-block" style="width:15%">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4 mt-5">
                    <form method="post" action="/login" style="font-family: 'Times New Roman', Times, serif;">
                    @csrf    
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <div class="input-group mb-5 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i aria-hidden="true" class="fa fa-user"></i></span>
                            </div>
                            <input type="text" required name="name" class="form-control" placeholder="Username" value="{{ old('name') }}">
                        </div>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        <div class="input-group mb-5 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i aria-hidden="true" class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-secondary w-100"> LOGIN </button>
                    </form>
                    
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
        
    </body>
</html>