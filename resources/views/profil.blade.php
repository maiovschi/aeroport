<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Angajati</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script></div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src='//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
    <style>

    html {
      font-size: 12px;
   
    }
    .title {
      font-size: 14px;
    }
    .hideContent {
      overflow: hidden;
      line-height: auto;
      height: auto;
    }

    .showContent {
      line-height: auto;
      height: auto;
    }

    td,th {
      min-width: 3em; /* the normal 'fixed' width */
      width: 10em; /* the normal 'fixed' width */
      max-width: 7em; /* the normal 'fixed' width, to stop the cells expanding */
    }



    .break {
    word-wrap: break-word !important;
    display: inline-block !important;
    max-width: 11em !important;
    padding-right: 3px;
  }

  .search-input {
      width: 100px !important;
    }
    tfoot {
    display: table-header-group;
    }
    body {
    background-color: #cde8f9;
  }
  .logo {
    width: 250px;
  }
  </style>
  </head>
  <body style='font-family: Arial; background-color: #cde8f9;'>
   
         <!-- <div class='d-flex justify-content-start'>
          <img src='images/sigla.png' class='logo'>
      </div> -->
      <div class='d-flex flex-row'>
        <div class='px-5'>&#9679;Angajati</div>
      </div>
      <hr class='bg-dark'>
      <div class="d-flex justify-content-between">
        <a href="{{route('home')}}" class='btn btn-lg btn-info my-4'>Acasa</a>
 
      </div>
  
      <table class="table table-sm px-0 " id='entry-table'>
          <thead>
              <tr>
                  <th scope="col" class='px-1'>Nr. angajati</th>
                  <th scope="col">Nume</th>
                  <th scope="col">Prenume</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">CNP</th>
                  <th scope="col">Data angajarii</th>
                  <th scope="col">Salariu </th>
                  <th scope="col">Tip angajat</th>
                  <th scope="col">Calificare </th>
                  <th scope="col">Username </th>
                  <th scope="col">Parola </th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>

            
              </tr>
          </tfoot>
          <tbody>
      
              <tr>
                  <th scope="row">{{$profil->idAngajat}}</th>
                  <td>{{$profil-> nume}}</td>
                  <td>{{$profil-> prenume}}</td>
                  <td>{{$profil-> email}}</td>
                  <td>{{$profil-> cnp}}</td>
                  <td>{{$profil-> data_angajare}}</td>
                  <td>{{$profil-> salariu}}</td>
                  <td>{{$profil-> tip_angajat}}</td>
                  <td>{{$profil-> calificari}}</td>
                  <td>{{$profil-> username}}</td>
                  <td>{{$profil-> parola}}</td>
                  <td>
                

                        <!--button type="submit" class="btn btn-danger">Delete</button-->
                     
              
                  
                  </td>
                  
                  
               </tr>
       
          </tbody>
          
      </table>
    </div> 

    <script>
 
     
    </script>
  
  <script>
        $(document).ready(function() {
         

            var table = $('#entry-table').DataTable( {
                orderCellsTop: true,
                fixedHeader: true
            });
        });
    </script>
  

  </body>
</html>