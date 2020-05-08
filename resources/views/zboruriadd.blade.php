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
        <div class='px-5 title'>Editeaza zbor</div>
      </div>
      
      <h4 class='text'>Toate campurile cu steluta (*) sunt obligatorii!</h4>
        <form class='text-left' id="edit-form" action="{{route('zboruriadd')}}" method='post' enctype="multipart/form-data">
        @csrf
            <div class="group">
            <div class="form-group">
                <label class='title'>Ruta</label>
                   <select class="ruta" name="ruta">
                   <option  selected  value="-1">
                       Selectati
                    </option>
                    @foreach($rute as $ruta)
                       
                            <option  value="{{$ruta->idRuta}}" class="">
                            {{$ruta->aeroport_plecare.' '.$ruta->aeroport_sosire}}
                            </option>
                         
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class='title'>Avion</label>
               <select class="avion" name="avion">  
                    <option  selected  value="-1">
                       Selectati
                    </option>
                    @foreach($avioane as $avion)
                       
                            <option ang="{{$avion->idAvion}}" value="{{$avion->idAvion}}" class="" calificare = "{{$avion->model}}">
                            {{$avion->nume.' '.$avion->model}}
                            </option>
                         
                    @endforeach
                </select>
            </div>
            </div>
            <div class="form-group">
                <label class='title'>Echipaj</label>
               <select class="echipaj" name="echipaj">  
               <option  selected  value="-1">
                       Selectati
                    </option>
               @foreach($echipaje as $echipaj)
                       
                       <option ang="" value="{{$echipaj->idEchipaj}}" class="" calificare = "{{$echipaj->pilot->calificari}}">
                       {{$echipaj->nume}}
                       </option>
                    
               @endforeach
                  
                </select>
            </div>
            </div>

            <div class="group">
            <div class="form-group">
                <label class='title'>Informatii plecare*</label>
                <input type="date" id="data_plecare" class="form-control" name='data_plecare' >
             
             
            </div>

            <div class="form-group">
                <label class='title'>Informatii plecare*</label>
                <input type="text" id="ora_plecare" name="ora_plecare" class=" form-control hidden">
                <input type="text" class="clock">
             
            </div>

          
            </div>
      
            <div class="form-group">
                <label class='title'>Informatii sosire*</label>
                <input type="date" id="data_sosire" class="form-control" name='data_sosire' >
              
            </div>

            <div class="form-group">
                <label class='title'>Informatii sosire*</label>
                <input type="text" id="ora_sosire" name='ora_sosire' class="form-control hidden" >
                <input type="text" class="clock">
            </div>


         
           
            
            <div class="form-group">
                <label class='title'>Observatii</label>
                <input type="text"  class="form-control nume" name='Observatii' >
            </div>

                <div class='d-flex justify-content-end'>
                <button type='submit' id="submit_button" class='btn btn-lg btn-success my-3 title'>Modifica zbor</button>
            </div>

            
        </form>
    </div>

  

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="/jquery-clock-timepicker.min.js"></script>
    
      <script>
      $('#submit_button').on('click',function(ev){
            ev.preventDefault();

            $('.clock').toArray().forEach(clock=>{
              var value =   $(clock).val();
              $(clock).closest('.form-group').find('.form-control').val(value);
            })

            if($('.wrong').length == 0){
              var form = document.getElementById('edit-form');
              form.submit();
            } else{
                alert("Nu toate campurile sunt ok!");
            }
            
      })

      $(document).ready(function(ev){
            $('.clock').clockTimePicker();
      })

      $('select').on('change',function(){
             var selected_option = this.options[this.options.selectedIndex];
        

            var calificare = $(selected_option).attr("calificare");
            if($(this).hasClass('avion')){
                var selected_option_echipaj = $('.echipaj')[0].options[$('.echipaj')[0].options.selectedIndex];
                    if($(selected_option_echipaj).attr("calificare") != calificare){
                        $(selected_option_echipaj).parent().addClass("wrong");
                    }else{
                        $(selected_option_echipaj).parent().removeClass("wrong");
                    }
            }

            if($(this).hasClass('echipaj')){
                var selected_option_avion = $('.avion')[0].options[$('.avion')[0].options.selectedIndex];
            
                if($(selected_option_avion).attr("calificare") != calificare){
                        $(selected_option_avion).parent().addClass("wrong");
                    }else{
                        $(selected_option_avion).parent().removeClass("wrong");
                    }
            }

            if($(this).hasClass('avion') || $(this).hasClass('echipaj'))
                    $(this).removeClass('wrong');


      })
   
    </script> 

    <style>
      .wrong{
        border-color:red;
        border:1px solid red;
      }
      .hidden{
          display:none;
      }
    </style>
 
  </body>
</html>