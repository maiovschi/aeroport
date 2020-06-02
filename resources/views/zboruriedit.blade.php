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
        <form class='text-left' id="edit-form" action="{{route('zboruriedit',['idzbor' => $zbor->idZbor])}}" method='post' enctype="multipart/form-data">
        @csrf
            <div class="group">
            <div class="form-group container">
            <?php error_log("inceput") ?>
                <label class='title'>Ruta</label>
                   <select class="ruta" name="ruta">
                        @if(property_exists($zbor,'ruta') && $zbor->ruta)
                            <option selected>  {{$zbor->ruta->aeroport_plecare.' '.$zbor->ruta->aeroport_sosire}}  </option>
                        @else
                            <option selected> Selectati o ruta </option>
                        @endif
                
                        @foreach($ruta as $rt)
                        <option ang="{{$rt->idRuta}}" selected value="{{$rt->idRuta}}" >
                            {{$rt->aeroport_plecare.' '.$rt->aeroport_sosire}}
                        </option>
                        @endforeach
            
                </select>
            </div>

            <?php error_log("trece") ?>
            <div class="form-group container">
                <label class='title'>Avion</label>
               <select class="avion" name="avion">  
                    @if(property_exists($zbor,'avion') && $zbor->avion)
                      <option ang="{{$zbor->avion->idAvion}}" selected  value="{{$zbor->avion->idAvion}}">
                            {{$zbor->avion->nume.' '.$zbor->avion->model}}
                        </option>
                    @else
                        <option selected> Selectati avion </option>
                    @endif
                    @foreach($avioane as $avion)
                        <option ang="{{$avion->idAvion}}" selected  value="{{$avion->idAvion}}">
                            {{$avion->nume.' '.$avion->model}}
                        </option>
                    @endforeach
                </select>
            </div>
            </div>
        
            </div>

            <div class="group ">
            <div class="form-group container">
                <label class='title'>Informatii plecare*</label>
                <input type="date" id="data_plecare" class="form-control" name='data_plecare' value="{{explode(' ',$zbor->data_ora_plecare)[0]}}">
             
             
            </div>

            <div class="form-group container">
                <h4 style="margin:0;">Ora plecare curenta: {{explode(' ',$zbor->data_ora_plecare)[1]}}</h4> <br>
                <label class='title'>Informatii plecare*</label>
                <input type="text" id="ora_plecare" name="ora_plecare" class=" form-control hidden">
                <input type="text" class="clock" value="">
             
            </div>

          
            </div>
      
            <div class="form-group container">
                <label class='title'>Informatii sosire*</label>
                <input type="date" id="data_sosire" class="form-control" name='data_sosire' value="{{explode(' ',$zbor->data_ora_plecare)[0]}}" >
              
            </div>

            <div class="form-group container">
            <h4 style="margin:0;">Ora sosire curenta: {{explode(' ',$zbor->data_ora_sosire)[1]}}</h4> <br> 
            <label class='title'>Informatii sosire*</label>
                <input type="text" id="ora_sosire" name='ora_sosire' class="form-control hidden" >
                <input type="text" class="clock">
            </div>
            <div class="form-group container">
                <label class='title'>Observatii</label>
                <input type="text"  class="form-control nume" name='Observatii' placeholder="{{$zbor->Observatii}}" >
            </div>

                <div class='d-flex justify-content-end' style="margin-right:150px;">
                <button type='submit' id="submit_button" class='btn btn-lg btn-success my-3 title'>Modifica zbor</button>
            </div>

            
        </form>
    </div>

  

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="/jquery-clock-timepicker.min.js"></script>
    <script>
     $('.clock').clockTimePicker();
   
      $(document).ready(function(ev){
           
          /*  setTimeout(function(){
                $('.clock').first().clockTimePicker('value', '{{explode(' ',$zbor->data_ora_plecare)[1]}}'.substring(0,5));
                $('.clock').last().clockTimePicker('value', '{{explode(' ',$zbor->data_ora_sosire)[1]}}'.substring(0,5));
            },600); */
      })

      /*  $('.clock').toArray().forEach(clock=>{
              var value =   $(clock).val();
              $(clock).closest('.form-group').find('.form-control').val(value);
            })

            */
    </script>
     <!-- <script>
      $('#submit_button').on('click',function(ev){
            ev.preventDefault();
       
            if($('.wrong').length == 0){
              var form = document.getElementById('edit-form');
              form.submit();
            } else{
                alert("Nu toate campurile sunt ok!");
            }
            
      })

      $('select').on('change',function(){
             var selected_option = this.options[this.options.selectedIndex];
             var id_angajat = $(selected_option).attr('ang');
            $(this).closest('.group').find('option').each(function(index,element){
                    if($(element).attr('ang') == id_angajat && element != selected_option){
                        $(element).addClass('hidden');
                    }else{
                        $(element).removeClass('hidden');
                    }
            });

            var calificare = $(selected_option).attr("calificari");
            if($(this).hasClass('pilot')){
                var selected_option_copilot = $('.copilot')[0].options[$('.copilot')[0].options.selectedIndex];
                    if($(selected_option_copilot).attr("calificari") != calificare){
                        $(selected_option_copilot).parent().addClass("wrong");
                    }else{
                        $(selected_option_copilot).parent().removeClass("wrong");
                    }
            }

            if($(this).hasClass('copilot')){
                var selected_option_pilot = $('.pilot')[0].options[$('.pilot')[0].options.selectedIndex];
                console.log(selected_option_pilot);
                console.log($(selected_option_pilot).attr("calificari"), calificare,this.attributes)
                if($(selected_option_pilot).attr("calificari") != calificare){
                        $(selected_option_pilot).parent().addClass("wrong");
                    }else{
                        $(selected_option_pilot).parent().removeClass("wrong");
                    }
            }

            if($(this).hasClass('copilot') || $(this).hasClass('pilot'))
                    $(this).removeClass('wrong');


      })
   
    </script> -->

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