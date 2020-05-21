<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Avion nou</title>
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
        <div class='px-5 title'>&#9679;Editare avion</div>
      </div>
      
      <h4 class='text'>Toate campurile cu steluta (*) sunt obligatorii!</h4>
        <form class='text-left' id="edit-form" action="{{route('avioaneedit',['idavion' => $avioane->idAvion])}}" method='post' enctype="multipart/form-data">
        @csrf
        <div class="form-group">
                <label class='title'>Marca*</label>
                <input type="text" id="marca" class="form-control" name='marca' placeholder="{{$avioane->marca}}" >
            </div>
            <div class="form-group">
                <label class='title'>Model*</label>
                <input type="text" id="model" class="form-control" name='model' placeholder="{{$avioane->model}}" >
            </div>
           
            <div class="form-group">
                <label class='title'>Nume*</label>
                <input type="text" id="nume" class="form-control" name='nume' placeholder="{{$avioane->nume}}" >
            </div>

            <div class="form-group">
                <label class='title'>Data fabricarii*</label>
                <input type="date" class="form-control" name='data_fabricarii'placeholder="{{$avioane->data_fabricatie}}" >
            </div>
                <div class='d-flex justify-content-end'>
                <button type='submit' id="submit_button" class='btn btn-lg btn-success my-3 title'>Modifica avion</button>
            </div>

            
        </form>
    </div>

  

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    
     <script>
      $('#submit_button').on('click',function(ev){
            ev.preventDefault();
          var marca = $('#marca').val();
          var model = $('#model').val();
          var nume =  $('#nume').val();
          var nume =  $('#data_fabricatie').val();
            if(marca == $('#marca').attr('placeholder') ||
               model == $('#model').attr('placeholder') ||
               nume == $('#nume').attr('placeholder') ||
               data_fabricatie==$('#data_fabricatie').attr('placeholder')|| marca.length == 0 || model.length == 0||nume.length==0||data_fabricatie.lenght==0){
                    if(marca == $('#marca').attr('placeholder') || marca.length == 0){
                      $('#marca').addClass('wrong');
                    }else{
                      $('#marca').removeClass('wrong');
                    }
                    if(model == $('#model').attr('placeholder')  || model.length == 0){
                      $('#model').addClass('wrong');
                    }else{
                      $('#model').removeClass('wrong');
                    }
                    if(nume == $('#nume').attr('placeholder')  || nume.length == 0){
                      $('#nume').addClass('wrong');
                    }else{
                      $('#nume').removeClass('wrong');
                    }
                    if(nume == $('#data_fabricatie').attr('placeholder')  || data_fabricatie.length == 0){
                      $('#data_fabricatie').addClass('wrong');
                    }else{
                      $('#data_fabricatie').removeClass('wrong');
                    }
                    alert("Unul sau mai multe campuri nu sunt ok");
            }else{
              $('#model').removeClass('wrong');
              $('#marca').removeClass('wrong');
              $('#nume').removeClass('wrong');
              $('#data_fabricatie').removeClass('wrong');
              var form = document.getElementById('edit-form');
              form.submit();
            }
            
      })
   
    </script>

    <style>
      .wrong{
        border-color:red;
      }
    </style>
 
  </body>
</html>