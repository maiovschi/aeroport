<?php

namespace App\Http\Controllers;
use App\Ruta;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Session;
use PDO;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function index() {
        
        $angajat_logat = Session::get('user');
        $nivel_acc = Session::get('nivel_acc');

        return view('welcome')->with(['angajat_logat'=>$angajat_logat,'nivel_acc'=>$nivel_acc]);
    }

    //rute

    public function getRuta(Request $request) {
        $edit_scs = $request->editscs == '1'?"true":"false";
        $add_scs = $request->addscs == '1'?"true":"false";
     //   $delete_scs = (isset($_GET['deletescs']) && $_GET['deletescs'])== '1'?"true":"false";
        $rute = DB::table('rute')->get();
        // $ruta= Ruta::all();
        return  view('ruta')->with(['ruta'=>$rute,'edit_scs'=>$edit_scs,'add_scs'=>$add_scs]); //view ('ruta', compact('ruta'));
        
    }
    public function rutaForm() {
        $rute = DB::table('rute');
    //    if($rute::all()->isEmpty()) $nr_ruta = 1;
    //    else $nr_ruta = $rute::all()->last()->idrute + 1;
        return view('rutaadd')->with(['error'=>false]);
    }

    public function addruta(Request $request) {
        $aero_plecare =  $request->input('aeroport_plecare');
        $aero_sosire = $request->input('aeroport_sosire');
        //
       $exista =  DB::table('rute')->where(['aeroport_plecare'=>$aero_plecare,'aeroport_sosire'=>$aero_sosire])->first();
       if(!$exista){
         $result = DB::table('rute')->insert(['aeroport_plecare'=>$aero_plecare,
                                            'aeroport_sosire'=>$aero_sosire
                                            ]);
       } else{
           return view('rutaadd')->with(['error'=>'Ruta deja exista!!']);
       }
        /*$ruta = new rute();
        $ruta->plecare = $request->input('aeroport_plecare');
        $ruta->sosire = $request->input('aeroport_sosire');
     
       
        $ruta->save();*/
        return redirect()->intended('/ruta?addscs='.$result);
    }
   
    public function editrutaForm($idruta) {
        $ruta = DB::table('rute')->where('idRuta',$idruta)->first();
        return view ('rutaedit', compact('ruta'));
    }
    public function editruta(Request $request, $idruta)
    {   
        $plecare = $request->aeroportdecolare;
        $sosire = $request->aeroportaterizare;

       $ruta_de_editat =  DB::table('rute')->where('idRuta',$idruta)->first();
       $result = 0;
      if($ruta_de_editat->aeroport_plecare != $plecare &&
         $ruta_de_editat->aeroport_sosire != $sosire){ 
            $result = DB::table('rute')->where('idRuta',$idruta)
                                ->update(['aeroport_plecare'=>$plecare,
                                            'aeroport_sosire'=>$sosire]);
         }else{}
 
        

        return redirect()->intended('/ruta?editscs='.$result);
    }
  
    public function deleteruta( Request $request)
    {    $idRuta = $request->id;
         
        DB::table('zboruri')->where('idRuta',$idRuta)->update(['idRuta'=>NULL,'stareZbor'=>'ATENTIE']);
        DB::table('rute')->where('idRuta',$idRuta)->delete();
        
        // Ruta::find($idRuta)->delete();
        
        return  redirect()->intended('/ruta');//redirect()->route('ruta')->with('success','Ruta a fost stearsa');
    }


    //avion
    public function getAvioane(Request $request) {
        $edit_scs = $request->editscs == '1'?"true":"false";
        $add_scs = $request->addscs == '1'?"true":"false";
     //   $delete_scs = (isset($_GET['deletescs']) && $_GET['deletescs'])== '1'?"true":"false";
        $avioane = DB::table('avioane')->get();
        // $ruta= Ruta::all();
        return  view('avioane')->with(['avioane'=>$avioane,'edit_scs'=>$edit_scs,'add_scs'=>$add_scs]); //view ('ruta', compact('ruta'));
       }

    public function avioaneForm() {
        $rute = DB::table('avioane');
        //    if($rute::all()->isEmpty()) $nr_ruta = 1;
        //    else $nr_ruta = $rute::all()->last()->idrute + 1;
            return view('avioaneadd');
    }

    public function addavioane(Request $request) {
        $model =  $request->input('model');
        $marca = $request->input('marca');
        $nume = $request->input('nume');
        $data_fabricatie = $request->input('data_fabricatie');
        $result = DB::table('avioane')->insert(['model'=>$model,
                                            'marca'=>$marca,
                                            'nume'=>$nume,
                                            'data_fabricatie'=>$data_fabricatie
                                            ]);
       
        return redirect()->intended('/avioane?addscs='.$result);
   
    }
   
    public function editavioaneForm($idavion) {
        $avioane = DB::table('avioane')->where('idAvion',$idavion)->first();
        return view ('avioaneedit', compact('avioane'));
    }
    public function editavioane(Request $request, $idavion)
    {   
        $model = $request->model;
        $marca = $request->marca;
        $nume = $request->nume;
        $data_fabricatie=$request->date_fabricatie;
        $avion_de_editat =  DB::table('avioane')->where('idAvion',$idavion)->first();
       $result = 0;
      if($avion_de_editat->model != $model &&
         $avion_de_editat->marca != $marca&&
         $avion_de_editat->nume != $nume &&
         $avion_de_editat->nume != $data_fabricatie){ 
            $result = DB::table('avioane')->where('idAvion',$idavion)
                                ->update(['model'=>$model,
                                            'marca'=>$marca,
                                            'nume'=>$nume,
                                            'data_fabricatie'=>$data_fabricatie]);
         }else{}
 
        

        return redirect()->intended('/avioane?editscs='.$result);
    }
  
    public function deleteavioane( Request $request)
    {    $idAvion = $request->id;
         
        DB::table('zboruri')->where('idAvion',$idAvion)->update(['idAvion'=>NULL,'stareZbor'=>'ATENTIE']);
      
        DB::table('avioane')->where('idAvion',$idAvion)->delete();
       
        
        return  redirect()->intended('/avioane');
    }



    //angajati
   
    public function getAngajati(Request $request) {
        $edit_scs = $request->editscs == '1'?"true":"false";
        $add_scs = $request->addscs == '1'?"true":"false";
     //   $delete_scs = (isset($_GET['deletescs']) && $_GET['deletescs'])== '1'?"true":"false";
        $angajati = DB::table('angajati')->get();
        // $ruta= Ruta::all();
        return  view('angajati')->with(['angajati'=>$angajati,'edit_scs'=>$edit_scs,'add_scs'=>$add_scs]); //view ('ruta', compact('ruta'));
       }

    public function angajatiForm() {
        $angajati = DB::table('angajati');
        //    if($rute::all()->isEmpty()) $nr_ruta = 1;
        //    else $nr_ruta = $rute::all()->last()->idrute + 1;
            return view('angajatiadd');
    }

    public function addangajati(Request $request) {
        $nume =  $request->input('nume');
        $prenume = $request->input('prenume');
        $email = $request->input('email');
        $cnp =  $request->input('cnp');
        $data_angajare =  $request->input('data_angajare');
        $salariu =  $request->input('salariu');
        $tip_angajat =  $request->input('tip_angajat');
        $calificari =  !$request->input('calificari')?NULL:$request->input('calificari');
        $username = $request->input('email');
        $parola =  $request->input('cnp');
        $result = DB::table('angajati')->insert(['nume'=>$nume,
                                            'prenume'=>$prenume,
                                            'email'=>$email,
                                            'cnp'=>$cnp,
                                            'data_angajare'=>$data_angajare,
                                            'salariu'=>$salariu,
                                            'tip_angajat'=>$tip_angajat,
                                            'calificari'=>$calificari,
                                            'username'=>$username,
                                            'parola'=>$parola
                                            ]);
        
        return redirect()->intended('/angajati?addscs='.$result);
   
    }
   
    public function editangajatiForm($idangajat) {
        $angajati = DB::table('angajati')->where('idAngajat',$idangajat)->first();
        $user  = Session::get('user');
        return view ('angajatiedit', compact('angajati'))->with(['user'=>$user]);   
    }

    public function editangajati(Request $request, $idangajat)
    {   
        $vector_update = [];

        $nume = $request->nume;
        if($nume){
            $vector_update['nume']=$nume;
        }
        $prenume = $request->prenume;
        if($prenume){
            $vector_update['prenume']=$prenume;
        }
        $email = $request->email;
        if($email){
            $vector_update['email']=$email;
        }
        $cnp = $request->cnp;
        if($cnp){
            $vector_update['cnp']=$cnp;
        }
        $data_angajare = $request->data_angajare;
        if($data_angajare){
            $vector_update['data_angajare']=$data_angajare;
        }
        $salariu = $request->salariu;
        if($salariu){
            $vector_update['salariu']=$salariu;
        }
        $tip_angajat = $request->tip_angajat;
        if($tip_angajat){
            $vector_update['tip_angajat']=$tip_angajat;
        }
        $calificari = $request->calificari;
        if($calificari){
            $vector_update['calificari']=$calificari;
        }
        
     

        $angajat_de_editat =  DB::table('angajati')->where('idAngajat',$idangajat)->first();
        $result = 0;
         $result = DB::table('angajati')->where('idAngajat',$idangajat)
                                ->update($vector_update);
        
 
        

        return redirect()->intended('/angajati?editscs='.$result);
    }
  
    public function deleteangajati( Request $request)
    {    $idangajati = $request->id;
        
        $programe = DB::table('programe')->where('idAngajat',$idangajati)->get();
        foreach($programe as $prg){
            if($prg->idZbor)
                DB::table('zboruri')->where('idZbor',$idZbor)->update(['stareZbor'=>'ATENTIE']);
      
        }

        DB::table('angajati')->where('idAngajat',$idangajati)->delete();
       
        
        return  redirect()->intended('/angajati');
        }

  
  
  
 
     //zboruri
     public function editzboruriForm($idzbor){
           
        $zbr = DB::table('zboruri')->where('idZbor',$idzbor)->first();
        
      $zbor = new \stdClass();
      $zbor->ruta = DB::table('rute')->where('idRuta','=',$zbr->idRuta)->first();
      $zbor->avioane = DB::table('avioane')->where('idAvion','=',$zbr->idAvion)->first();
      $zbor->nrZbor = $zbr->nrZbor;
      $zbor->data_ora_plecare = $zbr->data_ora_plecare;
      $zbor->data_ora_sosire = $zbr->data_ora_plecare;
      $zbor->Observatii = $zbr->Observatii;
      $zbor->stareZbor = $zbr->stareZbor;
      $zbor->idZbor = $zbr->idZbor;

      $ruta = DB::table('rute')->get();
      $avioane = DB::table('avioane')->get();
    

      return view('zboruriedit')->with(['ruta'=>$ruta,'avioane'=>$avioane,'zbor'=>$zbor]);
    }

    public function getZboruri(Request $request){
     
      $zboruri_brute = DB::table('zboruri')->get();
      $zboruri_ = array();
      foreach($zboruri_brute as $zbr){
        $zbor = new \stdClass();
      $zbor->ruta = DB::table('rute')->where('idRuta','=',$zbr->idRuta)->first();
      $zbor->avioane = DB::table('avioane')->where('idAvion','=',$zbr->idAvion)->first();
      $zbor->nrZbor = $zbr->nrZbor;
      $zbor->data_ora_plecare = $zbr->data_ora_plecare;
      $zbor->data_ora_sosire = $zbr->data_ora_plecare;
      $zbor->Observatii = $zbr->Observatii;
      $zbor->stareZbor = $zbr->stareZbor;
      $zbor->idZbor = $zbr->idZbor;
        $zboruri_[]=$zbor;
      }
      $edit_scs = $request->editscs == '1'?"true":"false";
      $add_scs = $request->addscs == '1'?"true":"false";
      

       return view('zboruri')->with(['zboruri'=>$zboruri_,'edit_scs'=>$edit_scs,'add_scs'=>$add_scs]);                     

    }

    public function editzboruri($idzbor,Request $request){

        $idRuta = $request->ruta;
        $idAvion = $request->avion;
        $nrZbor=$request->nrZbor;
        $data_ora_plecare = $request->data_plecare.' '.$request->ora_plecare;
        $data_ora_sosire = $request->data_sosire.' '.$request->ora_sosire;
        $Observatii=$request->Observatii;
        $stareZbor=$request->stareZbor;

      $result =  DB::table('zboruri')->where('idZbor',$idzbor)->update(['idRuta'=>$idRuta,
        'idAvion'=> $idAvion,
        'nrZbor'=>$nrZbor,
        'ora_plecare'=>$ora_plecare,
        'ora_sosire'=>$ora_sosire,
        'Observatii'=>$Observatii,
        'stareZbor'=>$stareZbor
        ]);

       return  redirect()->intended('/zboruri?editscs='.$result); 
    }


    public function zboruriForm(){

        $rute = DB::table('rute')->get();
     
        $avioane = DB::table('avioane')->get();


        return view('zboruriadd')->with(['rute'=>$rute,'avioane'=>$avioane]);
    }

    public function addzboruri(Request $request){
        $idRuta = $request->ruta;
        $idAvion = $request->avion;
        $nrZbor=$request->nrZbor;
        $data_ora_plecare = $request->data_plecare.' '.$request->ora_plecare;
        $data_ora_sosire = $request->data_sosire.' '.$request->ora_sosire;
        $Observatii=$request->Observatii;
        $stareZbor=$request->stareZbor;

      $idZbor =  DB::table('zboruri')->insertGetId(['idRuta'=>$idRuta,
      'idAvion'=> $idAvion,
      'nrZbor'=>$nrZbor,
      'data_ora_plecare'=>$data_ora_plecare,
      'data_ora_sosire'=>$data_ora_sosire,
      'Observatii'=>$Observatii,
      'stareZbor'=>'ATENTIE']);

    
        if($idZbor){
            return  redirect()->intended('/addechipaj?idzbor='.$idZbor); 
        }else{
            return  redirect()->intended('/zboruri?scs='.false); 
        }
       
     

    }
    public function deletezboruri( Request $request)
    {    $idzboruri = $request->id;
         
        DB::table('programe')->where('idZbor',$idzboruri)->update(['tip_activitate'=>'DUTY','idZbor'=>NULL]);
        DB::table('zboruri')->where('idZbor',$idzboruri)->delete();
        
        
        return  redirect()->intended('/zboruri');
        }
  // program

  public function editprogramForm($idprogram){
           
    $prg = DB::table('programe')->where('idProgram',$idprogram)->first();

    $program = new \stdClass();
    $program->tip_activitate = $ecp->tip_activitate;
    $program->copilot = DB::table('angajati')->where('idAngajat','=',$ecp->idCopilot)->first();
    $program->steward1 = DB::table('angajati')->where('idAngajat','=',$ecp->idSteward1)->first();
    $program->steward2 = DB::table('angajati')->where('idAngajat','=',$ecp->idSteward2)->first();
    $program->nume = $ecp->nume;
    $program->idProgram = $prg->idProgram;

    $angajati = DB::table('angajati')->get();

    return view('echipajeedit')->with(['echipaj'=>$echipaj,'angajati'=>$angajati]);
}

public function getProgram(Request $request){

$program_brute = DB::table('programe')->get();
$program_ = array();
foreach($program_brute as $prg){
  $program = new \stdClass();
  $program->angajat = DB::table('angajati')->where('idAngajat','=',$ecp->idPilot)->first();

  $program->nume = $ecp->nume;
  $program->idEchipaj = $ecp->idEchipaj;
  $program[] = $echipaj;
}
$edit_scs = $request->editscs == '1'?"true":"false";
$add_scs = $request->addscs == '1'?"true":"false";
error_log($edit_scs);

return view('echipaje')->with(['echipaje'=>$echipaje_,'edit_scs'=>$edit_scs,'add_scs'=>$add_scs]);                     

}

public function editprogram($idechipaj,Request $request){

$idPilot = $request->pilot;
$idCopilot = $request->copilot;
$idSt1 = $request->steward1;
$idSt2 = $request->steward2;
$nume=$request->nume;

$result =  DB::table('echipaje')->where('idEchipaj',$idechipaj)->update(['idPilot'=>$idPilot,
'idCopilot'=> $idCopilot,
'idSteward1'=>$idSt1,
'idSteward2'=>$idSt2,
'nume'=>$nume]);

return  redirect()->intended('/echipaje?editscs='.$result); 
}


//  adauga form 
public function programForm(){
   
//  $echipaj = DB::table('echipaje')->get();

error_log(">> trecee ");
$angajati = DB::table('angajati')->get();
return view('echipajeadd')->with(['angajati'=>$angajati]);
}
public function addprogram(Request $request){

$idPilot = $request->input('pilot');
$idCopilot = $request->input('copilot');
$idSt1 = $request->input('steward1');
$idSt2 = $request->input('steward2');
$result =  DB::table('echipaje')->insert(['idPilot'=>$idPilot,
'idCopilot'=> $idCopilot,
'idSteward1'=>$idSt1,
'idSteward2'=>$idSt2,
'nume'=> $request->input('nume')
]);
return redirect()->intended('/echipaje?addscs='.$result);  
 }


 public function deleteprogram( Request $request)
{    $idprogram = $request->id;
 
DB::table('programe')->where('idProgram',$idprogram)->delete();


return  redirect()->intended('/program');
}
    
// logara
public function login(Request $req){
    if(Session::get('user'))
        return redirect()->intended('/');


    $err = $req->err;

    return view('login')->with(['err'=>$err]);
}

public function loginform(Request $req){

    $username = $req->user;
    $parola = $req->password;

   $user = DB::table('angajati')->where(['username'=>$username,'parola'=>$parola])->first();
    if($user){
        Session::put('user',$user);
        Session::put('nivel_acc',$user->tip_angajat);
        return redirect()->intended('/');
    }else{
        return redirect()->intended('/login?err=true');
    }
}

public function resetpass(Request $req){
    $email = $req->email;
    $user = DB::table('angajati')->where('email',$email)->first();
    if($user){
      $ok = DB::table('angajati')->where('email',$email)->update(['parola'=>$user->cnp]);
    }

    return response()->json(['scs'=>$ok]);
}

public function resetuser(Request $req){

    $email = $req->email;
    $user = DB::table('angajati')->where('email',$email)->first();

    if($user){
      $ok = DB::table('angajati')->where('email',$email)->update(['nickname'=>$user->email]);
    }

    return response()->json(['scs'=>$ok]);
}

public function delogare(Request $req){

    Session::forget('user');
    Session::forget('nivel_acc');

    return redirect()->intended('/login');

}

// calendar programe
public function programpiloti(Request $req){

    return view('programpiloti');
}

public function programstewarzi(Request $req){

    return view('programstewarzi');
}
public function programavioane(Request $req){

    return view('programavioane');
}public function programzboruri(Request $req){

    return view('programzboruri');
}

// profil

public function profil(Request $request)
{
   $angajat = Session::get('user');
//$profil=DB::table('angajati')->where(['idAngajat'=>$idAngajat])->first();

return view('profil')->with(['profil'=>$angajat]);
}

public function addechipaj(Request $request){

    $idZbor = $request->idzbor;
    if($idZbor){

        $zbor = DB::table('zboruri')->where('idZbor',$idZbor)->first();
        $avion = DB::table('avioane')->where('idAvion',$zbor->idAvion)->first();
        $data = explode(' ',$zbor->data_ora_plecare)[0]; //2020-05-19 22:23:00 => ['2020-05-19','22:23:00'];
       /* 
        $connection = new PDO("mysql:host=".'localhost:3306'.";dbname=aeroport", 'root','');
        $stmt = $connection->prepare("select distinct idAngajat from programe pgr where 1 not in(select count(*) from programe pgr2 where `pgr2`.`idAngajat` = `pgr`.`idAngajat` and `pgr2`.`date` = '".$data."' and `pgr2`.`tip_activitate` != 'DUTY')"); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $results = $stmt->fetchAll();
        $connection = null;
*/

       $results =  DB::select("select distinct idAngajat from programe pgr where 1 not in(select count(*) from programe pgr2 where `pgr2`.`idAngajat` = `pgr`.`idAngajat` and `pgr2`.`date` = '".$data."' and `pgr2`.`tip_activitate` != 'DUTY')");
       error_log(count($results));
       $angajati = array();
        foreach($results as $result){
            $temp = DB::table('angajati')->where('idAngajat',$result->idAngajat)->first();
            if($temp->tip_angajat == "Pilot" && $temp->calificari != $avion->model)
                continue;
            $angajati[] = $temp;
        }
        return view('addechipaj')->with(['zbor'=>$zbor,'angajati'=>$angajati]);

    }else{
        return redirect()->intended('/zboruri');
    }
}

public function addechipajPOST(Request $req){
    $idZbor = $req->zbor;

    $pilot1 = $req->pilot;
    $pilot2 = $req->copilot;

    $steward1 = $req->steward1;
    $steward2 = $req->steward2;
    $ok = true;

   $ok = $ok && DB::table('programe')->where('idAngajat',$pilot1)->update(['tip_activitate'=>"ZBOR","idZbor"=>$idZbor]);
   $ok = $ok && DB::table('programe')->where('idAngajat',$pilot2)->update(['tip_activitate'=>"ZBOR","idZbor"=>$idZbor]);
   $ok = $ok && DB::table('programe')->where('idAngajat',$steward1)->update(['tip_activitate'=>"ZBOR","idZbor"=>$idZbor]);
   $ok = $ok && DB::table('programe')->where('idAngajat',$steward2)->update(['tip_activitate'=>"ZBOR","idZbor"=>$idZbor]);
   
   if($ok){
    $ok = DB::table('zboruri')->where('idZbor',$idZbor)->update('stareZbor','ACTIV');
   }
   if($ok){
     return redirect()->intended('/zboruri');
   }else{
     return redirect()->intended('/addechipaj?idzbor='.$idZbor);
   }
     

}
// orar

public function orarpilot(Request $req)
{
    return view('orarpilot');
}
public function programpilot(Request $req)
{
    return view('programpilot');
}
public function orarsteward(Request $req)
{
    return view('orarsteward');

}
public function programsteward(Request $req)
{
    return view('programsteward');
}

}