<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Echipaj nou</title>
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
        <div class='px-5 title'>Adauga echipaj</div>
      </div>
      
      <h4 class='text'>Toate campurile cu steluta (*) sunt obligatorii!</h4>
        <form class='text-left' id="edit-form" action="{{route('echipajeadd')}}" method='post' enctype="multipart/form-data">
        @csrf
            <div class="group">
            <div class="form-group">
                <label class='title'>Pilot</label>
                   <select class="pilot" name="pilot">
                    <option ang="{{$idPilot->pilot->idAngajat}}" selected value="{{$idPilot->pilot->idAngajat}}" calificari="{{$idPilot->pilot->calificari}}">
                        {{$idPilot->pilot->nume.' '.$idPilot->pilot->prenume}}
                    </option>
                    @foreach($angajati as $ang)
                        @if($ang->tip_angajat == "pilot" && $ang->idAngajat != $idPilot->pilot->idAngajat)
                            <option ang="{{$ang->idAngajat}}" value="{{$ang->idAngajat}}" class="{{ $ang->idAngajat ==$idCopilot->copilot->idAngajat?"hidden":"" }}" calificari="{{$ang->calificari}}">
                                {{$ang->nume.' '.$ang->prenume}}
                            </option>
                         @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class='title'>Copilot</label>
               <select class="copilot" name="copilot">  
                    <option ang="{{$idCopilot->copilot->idAngajat}}" selected  value="{{$idCopilot->copilot->idAngajat}}" calificari="{{$idPilot->pilot->calificari}}">
                         {{$idCOpilot->copilot->nume.' '.$idCopilot->copilot->prenume}}
                    </option>
                    @foreach($angajati as $ang)
                        @if($ang->tip_angajat == "pilot"  && $ang->idAngajat != $idCopilot->copilot->idAngajat)
                            <option ang="{{$ang->idAngajat}}"  value="{{$ang->idAngajat}}" class="{{ $ang->idAngajat ==$idPilot->pilot->idAngajat?"hidden":"" }}"  calificari="{{$ang->calificari}}">
                                {{$ang->nume.' '.$ang->prenume}}
                            </option>
                         @endif
                    @endforeach
                </select>
            </div>
            </div>

            <div class="group">
            <div class="form-group">
                <label class='title'>Steward1</label>
                 <select class="steward1" name="steward1">
                    <option ang="{{$echipaj->steward1->idAngajat}}" selected  value="{{$echipaj->steward1->idAngajat}}">
                         {{$echipaj->steward1->nume.' '.$echipaj->steward1->prenume}}
                    </option>
                    @foreach($angajati as $ang)
                        @if($ang->tip_angajat == "steward"  && $ang->idAngajat != $echipaj->steward1->idAngajat)
                            <option ang="{{$ang->idAngajat}}"  value="{{$ang->idAngajat}}"  class="{{ $ang->idAngajat ==$echipaj->steward2->idAngajat?"hidden":"" }}" >
                                {{$ang->nume.' '.$ang->prenume}}
                            </option>
                         @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class='title'>Steward2</label>
                <select class="steward2" name="steward2">
                    <option ang="{{$echipaj->steward2->idAngajat}}" selected  value="{{$echipaj->steward2->idAngajat}}">
                         {{$echipaj->steward2->nume.' '.$echipaj->steward2->prenume}}
                    </option>
                    @foreach($angajati as $ang)
                        @if($ang->tip_angajat == "steward"  && $ang->idAngajat != $echipaj->steward2->idAngajat)
                            <option ang="{{$ang->idAngajat}}"  value="{{$ang->idAngajat}}"  class="{{ $ang->idAngajat ==$echipaj->steward1->idAngajat?"hidden":"" }}" >
                                {{$ang->nume.' '.$ang->prenume}}
                            </option>
                         @endif
                    @endforeach
                </select>
            </div>
            </div>
            <div class="form-group">
                <label class='title'>Nume Echipaj</label>
                <input type="text"  class="form-control nume" name='nume' placeholder="{{$echipaj->pilot->nume.' '.$echipaj->pilot->prenume}}" >
            </div>

                <div class='d-flex justify-content-end'>
                <button type='submit' id="submit_button" class='btn btn-lg btn-success my-3 title'>Adauga Echipaj</button>
            </div>

            
        </form>
    </div>

  

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    
     <script>
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