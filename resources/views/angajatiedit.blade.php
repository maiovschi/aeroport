<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Editare angajat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> 

    <style>
    html {
      font-size: 12px;
   
    }
    .title {
      font-size: 14px;
    }
    </style>
  </head>
  <body style='font-family: Arial; background-color: #cde8f9;'>
   
    <div class='container text-center'>
        
        <a href="{{route('home')}}" class='btn btn-lg btn-info mt-4 title'>Acasa</a>
        <!-- <div class='px-5'><a href="{{route('ruta')}}">&#9679;Rute</div> -->
       
        
      <div class='d-flex flex-row'>
        <div class='px-5 title'>&#9679;Ruta noua</div>
      </div>
      
      <h4 class='text'>Toate campurile cu steluta (*) sunt obligatorii!</h4>
        <form class='text-left' id="edit-form" action="{{route('angajatiedit',['idangajat' => $angajati->idAngajat])}}" method='post' enctype="multipart/form-data">
        @csrf
            
            <div class="form-group">
                <label class='title'>Nume*</label>
                <input type="text" id="nume" class="form-control" name='nume' value="{{$angajati->nume}}" >
            </div>
            <div class="form-group">
                <label class='title'>Prenume*</label>
                <input type="text" id="prenume" class="form-control" name='prenume' value="{{$angajati->prenume}}" >
            </div>
            <div class="form-group">
                <label class='title'>E-mail*</label>
                <input type="email" id="email" class="form-control" name='email' value="{{$angajati->email}}" >
            </div>

            <div class="form-group">
                <label class='title'>CNP*</label>
                <input type="text" id="cnp" class="form-control" name='cnp' value="{{$angajati->cnp}}" >
            </div>

            <div class="form-group">
                <label class='title'>Data angajarii*</label>
                <input type="date" id="data_angajare" class="form-control" name='data_angajare' value="{{$angajati->data_angajare}}" >
            </div>
            <div class="form-group">
                <label class='title'>Salariu*</label>
                <input type="text" id="salariu" class="form-control" name='salariu' value="{{$angajati->salariu}}" >
            </div>
            <div class="form-group">
                <label class='title'>Tip angajat*</label>
                <input type="text" id="tip_angajat" class="form-control" name='tip_angajat' value="{{$angajati->tip_angajat}}" >
            </div>
            <div class="form-group">
                <label class='title'>Calificare*</label>
                <input type="text" id="calificari" class="form-control" name='calificari' value="{{$angajati->calificari}}" >
            </div>
         
            
            <div class='d-flex justify-content-end'>
                <button type='submit' id="submit_button" class='btn btn-lg btn-success my-3 title'>Modifica angajat</button>
            </div>

            
        </form>
    </div>

  

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    
   

    <style>
      .wrong{
        border-color:red;
      }
    </style>
 
  </body>
</html>