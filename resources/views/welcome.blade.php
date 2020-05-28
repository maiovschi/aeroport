<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Companie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style='font-family: Arial; background-color: #cde8f9; font-size: 14px;'>
    <div class='container-fluid text-center'>
        
     
 
   <!--      <div class='d-flex flex-row'>
          
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
        </div> -->
       
        
    </div>

    <div class="gridMaster"> 
        <div class="grid">
        @if($nivel_acc ==='Administrator')
            <a href="{{route('ruta')}}" class="blocks"> Profil </a>
            <a href="{{route('ruta')}}" class="blocks"> Documente </a>
            <a href="{{route('angajati')}}" class="blocks"> Angajati </a>
            <a href="{{route('ruta')}}" class="blocks"> Rute </a>
            <a href="{{route('avioane')}}" class="blocks"> Avioane </a>
            <a href="{{route('zboruri')}}" class="blocks"> Zboruri </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice Rute </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice Avion </a>  
            <a href="{{route('angajati')}}" class="blocks"> Grafice Zboruri</a>
            <a href="{{route('angajati')}}" class="blocks"> Program Piloti </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice Piloti </a>
            <a href="{{route('angajati')}}" class="blocks"> Program Steward </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice Steward </a>
            <a href="{{route('angajati')}}" class="blocks"> Program Avion </a> 
        </div>
          @endif
          <div class="grid">
        @if($nivel_acc ==='Pilot')
            <a href="{{route('ruta')}}" class="blocks"> Profil </a>
            <a href="{{route('ruta')}}" class="blocks"> Documente </a>
            <a href="{{route('angajati')}}" class="blocks"> Program  </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice </a>
        </div>
          @endif
          <div class="grid">
        @if($nivel_acc ==='Steward')
            <a href="{{route('ruta')}}" class="blocks"> Profil </a>
            <a href="{{route('ruta')}}" class="blocks"> Documente </a>
            <a href="{{route('angajati')}}" class="blocks"> Program  </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice </a>
        </div>
          @endif
          <div class="grid">
        @if($nivel_acc ==='Serviciul suport tehnic zboruri')
            <a href="{{route('ruta')}}" class="blocks"> Profil </a>
            <a href="{{route('ruta')}}" class="blocks"> Documente </a>
            <a href="{{route('angajati')}}" class="blocks"> Avioane </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice Avioane </a>
            <a href="{{route('angajati')}}" class="blocks"> Documente Avioane </a>
        </div>
          @endif
          <div class="grid">
        @if($nivel_acc ==='Serviciul planificari')
            <a href="{{route('ruta')}}" class="blocks"> Profil </a>
            <a href="{{route('ruta')}}" class="blocks"> Documente </a>
            <a href="{{route('angajati')}}" class="blocks"> Zboruri </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice Zboruri </a>
            <a href="{{route('angajati')}}" class="blocks"> Program piloti </a>
            <a href="{{route('angajati')}}" class="blocks"> Program steward </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice piloti </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice steward </a>
        </div>
          @endif
          <div class="grid">
        @if($nivel_acc ===' Serviciul gestiune si analiza operatiuni zboruri')
            <a href="{{route('ruta')}}" class="blocks"> Profil </a>
            <a href="{{route('ruta')}}" class="blocks"> Documente </a>
            <a href="{{route('angajati')}}" class="blocks"> Rute </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice Rute </a>
        </div>
          @endif
          <div class="grid">
        @if($nivel_acc ==='Director piloti')
            <a href="{{route('ruta')}}" class="blocks"> Profil </a>
            <a href="{{route('ruta')}}" class="blocks"> Documente </a>
            <a href="{{route('angajati')}}" class="blocks"> Angajati </a>
            <a href="{{route('angajati')}}" class="blocks"> Program  </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice angajati </a>
        </div>
          @endif
          <div class="grid">
        @if($nivel_acc ==='Director steward')
            <a href="{{route('ruta')}}" class="blocks"> Profil </a>
            <a href="{{route('ruta')}}" class="blocks"> Documente </a>
            <a href="{{route('angajati')}}" class="blocks"> Angajati </a>
            <a href="{{route('angajati')}}" class="blocks"> Program  </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice angajati</a>
        </div>
          @endif
          <div class="grid">
        @if($nivel_acc ==='Director servicii')
            <a href="{{route('ruta')}}" class="blocks"> Profil </a>
            <a href="{{route('ruta')}}" class="blocks"> Documente </a>
            <a href="{{route('angajati')}}" class="blocks"> Angajati </a>
            <a href="{{route('angajati')}}" class="blocks"> Avioane  </a>
            <a href="{{route('angajati')}}" class="blocks"> Rute </a>
            <a href="{{route('angajati')}}" class="blocks"> Zboruri </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice Avioane </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice Rute </a>
            <a href="{{route('angajati')}}" class="blocks"> Grafice Zboruri</a>
        </div>
          @endif
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