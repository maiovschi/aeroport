<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Companie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style='font-family: Arial; background-color: #cde8f9; font-size: 14px;'>
    <div class='container-fluid text-center'>
        
     
 
        <div class='d-flex flex-row'>
          
        @if($nivel_acc ==='admin')
          <div class='px-5'><a href="{{route('ruta')}}">&#9679;Rute</div>
          <div class='px-5'><a href="{{route('avioane')}}">&#9679;Avioane</div>
            <div class='px-5'><a href="{{route('angajati')}}">&#9679;Angajati</div>
            <div class='px-5'><a href="{{route('program')}}">&#9679;Echipaje</div>
            <div class='px-5'><a href="{{route('zboruri')}}">&#9679;Zboruri</div>
            <div class='px-5'><a href="/">&#9679;Delogare</a></div>
        @endif


      
            <div class='px-5'><a href="{{route('ruta')}}">&#9679;Rute</div>     
            <div class='px-5'><a href="{{route('avioane')}}">&#9679;Avioane</div>
            <div class='px-5'><a href="{{route('angajati')}}">&#9679;Angajati</div>
            <div class='px-5'><a href="{{route('program')}}">&#9679;Echipaje</div>
            <div class='px-5'><a href="{{route('zboruri')}}">&#9679;Zboruri</div>
            <div class='px-5'><a href="/">&#9679;Delogare</a></div>
        </div>
        <hr class='bg-dark'>
        
    </div>

    <div class="gridMaster"> 
        <div class="grid">
        <a href="Invitatii.jsp" class="blocks"> Invitatii</a>
            <a href="GenInv.jsp" class="blocks"> Genereaza invitatie </a>
            <a href="Proiecte.jsp" class="blocks"> Proiecte </a>
            <a href="AddProiect.jsp" class="blocks"> Creaza Proiect </a>
            <a href="Angajati.jsp" class="blocks"> Angajati </a>
            <a href="Analytics.jsp" class="blocks"> Analytics </a>
        </div>
       
          <div class="grid2">
            <a href="/delogare" class="block"> Delogheaza-ma! </a>
          </div>   
     </div>
     
    <style>
      body{
        
          background-image:url('7.jpeg');
          background-size:1600px 1100px; 
   
                background-attachment: fixed;
      }
      
          .blocks{
            background:#7B68EE;
          }
            .block{
             background:#7B68EE;
          }
          
          
      .grid {
    
          margin:0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: .5rem;
            padding: .5rem;
            grid-auto-rows: minmax(100px, auto);
   
      }
             .grid2 {
  
          margin:0 auto;
            display: grid;
            grid-template-columns: repeat(1, 1fr);
           grid-gap: .5rem;
            padding: .5rem;
            grid-auto-rows: minmax(100px, auto);
      
            
         
            }

       .gridMaster{
             width:40%;
  
    margin-left: 450px;
        margin-top: 120px;
 
         grid-gap: .5rem;
       padding: .7rem;
   
           /* box-shadow:0px 10px 50px 0px black;*/
            
        }


 .blocks{
     font-family: monospace;
     text-decoration: none;;
     user-select: none;
     cursor: pointer;
    margin:10px;
    transition:.2s ease-in-out;
    color:white;
    text-align: center;
    padding:50px ;
}
 .blocks:hover{
         transform:scale(1.1);
    }
    
    
    
    .block{
     font-family: monospace;
     text-decoration: none;;
     user-select: none;
     cursor: pointer;
    margin:10px;
    transition:.2s ease-in-out;
    color:white;
    text-align: center;
    padding:50px 0;
}
 .block:hover{
         transform:scale(1.1);
    }
      </style>
  </body>
</html>