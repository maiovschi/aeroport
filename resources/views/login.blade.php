
<html>

<head>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>

<body>

<div>
<form method="POST" action="/login">
   @csrf
    <div class="row">
     <h4>Nickname</h4>
     <input type="text" name="user">
    </div>

    <div class="row">
     <h4>Parola</h4>
     <input type="password" name="password" >
    </div>

    <div class="row">
        <input type="submit" value="Log in">
    </div>

    <div class="row">
        <button class="passreset"> Reseteaza parola </button>
    </div>
    <div class="row">
        <button class="userreset"> Reseteaza nickname </button>
    </div>

    <div class="row">
        @if($err)
            <h4>Datele sunt gresite!</h4>
        @endif
    </div>
    

</form>
<script>
    $('.passreset').on('click',function(ev){
        ev.preventDefault();
       var email = prompt("Introduceti mail-ul pentru care doriti sa resetati parola","");
       var payload={email:email}; 
        $.ajax({
            url:"/resetpass",
            type:"post",
            data:payload,
            success:function(data){
                if(data.scs){
                    alert("Parola a fost resetata cu succes");
                }else{
                    alert("Parola nu a fost resetata cu succes");
                }
            },
            error:function(data){
                alert("A aparut o problema!");
                console.log(data);
            }
        })
    })

    $('.userreset').on('click',function(ev){
        ev.preventDefault();
       var email = prompt("Introduceti mail-ul pentru care doriti sa resetati usernameul","");
       var payload={email:email}; 
        $.ajax({
            url:"/resetuser",
            type:"post",
            data:payload,
            success:function(data){
                if(data.scs){
                    alert("Username-ul a fost resetat cu succes");
                }else{
                    alert("Username-ul nu a fost resetat cu succes");
                }
            },
            error:function(data){
                alert("A aparut o problema!");
                console.log(data);
            }
        })
    })
    
</script>
</div>
<style>

</style>
<body>
</html>