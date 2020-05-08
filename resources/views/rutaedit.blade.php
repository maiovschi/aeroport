<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Editare ruta</title>
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
        <form class='text-left' id="edit-form" action="{{route('rutaedit',['idruta' => $ruta->idRuta])}}" method='post' enctype="multipart/form-data">
        @csrf
            
            <div class="form-group">
                <label class='title'>Aeroport decolare*</label>
                <input type="text" id="decolare" class="form-control" name='aeroportdecolare' placeholder="{{$ruta->aeroport_plecare}}" >
            </div>
            <div class="form-group">
                <label class='title'>Aeroport aterizare*</label>
                <input type="text" id="aterizare" class="form-control" name='aeroportaterizare' placeholder="{{$ruta->aeroport_sosire}}" >
            </div>
         

           <!--  <div class="container" style="margin-top: 20px">
                <div style="position: relative">
                <input class="form-control" type="text" id="time"/>
                </div>
            </div> -->
         <!--    <div class="form-group">
                <label class='title'>Ora decolare*</label>
            
                <input class="timepicker form-control" type="text" name='oradecolare' required>
            </div> -->
          <!--   <div class="form-group">
                <label class='title'>Ora aterizare*</label>
                <input class="timepicker form-control" type="text" name='oradecolare' required>
            </div> -->
            
            <div class='d-flex justify-content-end'>
                <button type='submit' id="submit_button" class='btn btn-lg btn-success my-3 title'>Modifica ruta</button>
            </div>

            
        </form>
    </div>

  

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
   <!-- 
    <script>
      $('#submit_button').on('click',function(ev){
            ev.preventDefault();
          var decolare =   $('#decolare').val();
          var aterizare = $('#aterizare').val();
            if(decolare == $('#decolare').attr('placeholder') ||
               aterizare == $('#aterizare').attr('placeholder') || decolare.length == 0 || aterizare.length == 0){
                    if(decolare == $('#decolare').attr('placeholder') || decolare.length == 0){
                      $('#decolare').addClass('wrong');
                    }else{
                      $('#decolare').removeClass('wrong');
                    }
                    if(aterizare == $('#aterizare').attr('placeholder')  || aterizare.length == 0){
                      $('#aterizare').addClass('wrong');
                    }else{
                      $('#aterizare').removeClass('wrong');
                    }

                    alert("Unul sau mai multe campuri nu sunt ok");
            }else{
              $('#decolare').removeClass('wrong');
              $('#aterizare').removeClass('wrong');

              var form = document.getElementById('edit-form');
              form.submit();
            }
            
      })
   
    </script>
-->
    <style>
      .wrong{
        border-color:red;
      }
    </style>
 
  </body>
</html>