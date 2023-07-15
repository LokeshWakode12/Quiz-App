<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QuizAPP?</title>
    <link rel="stylesheet" href="/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" >
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" ></script>
        <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" ></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    

</head>
<body >

    <div class="container">
        <p class="line-1 anim-typewriter name">!! QUIZ APP !!</p>
    </div>

    <div class="element1">
        <a href="/admin/login"><button class="btn btn-primary">Admin Login</button></a>
    </div>

    <div class="element2">
        <a href="/user/login"><button class="btn btn-primary btn-block">USER Login</button></a>
        <span>&nbsp;&nbsp;</span>
        <a href="/user/register"><button class="btn btn-primary btn-block">USER Register</button></a>
    </div>

<style>
    body{
        background-image: url('../img/img1.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-size: 100% 100%;
    }
    .name{
        margin-top:100px;

    }
    .element1{
        width:250px;
        display: flex;
        margin-left: 250px;
        background-color: #efadae;
        padding: 72px;
        border-radius: 30px;
    }
    .element1:hover {
        box-shadow: 0 0 125px rgb(180 33 170 / 60%); 
    }
    .element2{
        margin-top: -206px;
        display: flex;
        position: absolute;
        right: 300px;
        background-color: #c4e7e1;
        padding: 85px 32px;
        border-radius: 30px;
    }
    .element2:hover {
        box-shadow: 0 0 125px rgb(180 33 170 / 60%); 
    }
    .line-1{
    position: relative;
    top: 50%;  
    width: 24em;
    margin: 165px auto;
    border-right: 2px solid rgba(255,255,255,.75);
    font-size: 180%;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    transform: translateY(-50%);    
    font-family: "Sofia", sans-serif;
    }

/* Animation */
.anim-typewriter{
  animation: typewriter 4s steps(44) 1s 1 normal both,
             blinkTextCursor 500ms steps(44) infinite normal;
}
@keyframes typewriter{
  from{width: 0;}
  to{width: 24em;}
}
@keyframes blinkTextCursor{
  from{border-right-color: rgba(255,255,255,.75);}
  to{border-right-color: transparent;}
}
</style>
</body>
</html>