<?php

namespace App\Http\Controllers;
use App\Ruta;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function index() {
        
        return view('welcome');
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
        return view('rutaadd');
    }

    public function addruta(Request $request) {
        $aero_plecare =  $request->input('aeroport_plecare');
        $aero_sosire = $request->input('aeroport_sosire');
        $result = DB::table('rute')->insert(['aeroport_plecare'=>$aero_plecare,
                                            'aeroport_sosire'=>$aero_sosire
                                            ]);
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
        $result = DB::table('avioane')->insert(['model'=>$model,
                                            'marca'=>$marca,
                                            'nume'=>$nume
                                            ]);
        /*$ruta = new rute();
        $ruta->plecare = $request->input('aeroport_plecare');
        $ruta->sosire = $request->input('aeroport_sosire');
     
       
        $ruta->save();*/
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
       $avion_de_editat =  DB::table('avioane')->where('idAvion',$idavion)->first();
       $result = 0;
      if($avion_de_editat->model != $model &&
         $avion_de_editat->marca != $marca&&
         $avion_de_editat->nume != $nume){ 
            $result = DB::table('avioane')->where('idAvion',$idavion)
                                ->update(['model'=>$model,
                                            'marca'=>$marca,
                                            'nume'=>$nume]);
         }else{}
 
        

        return redirect()->intended('/avioane?editscs='.$result);
    }
  
    public function deleteavioane( Request $request)
    {    $idAvion = $request->id;
         
        DB::table('avioane')->where('idAvion',$idAvion)->delete();
        // Ruta::find($idRuta)->delete();
        
        return  redirect()->intended('/avioane');//redirect()->route('ruta')->with('success','Ruta a fost stearsa');
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
        $calificari =  $request->input('calificari');
        $result = DB::table('angajati')->insert(['nume'=>$nume,
                                            'prenume'=>$prenume,
                                            'email'=>$email,
                                            'cnp'=>$cnp,
                                            'data_angajare'=>$data_angajare,
                                            'salariu'=>$salariu,
                                            'tip_angajat'=>$tip_angajat,
                                            'calificari'=>$calificari,
                                            ]);
        
        return redirect()->intended('/angajati?addscs='.$result);
   
    }
   
    public function editangajatiForm($idangajat) {
        $angajati = DB::table('angajati')->where('idAngajat',$idangajat)->first();
        return view ('angajatiedit', compact('angajati'));   
    }

    public function editangajati(Request $request, $idangajat)
    {   
        $nume = $request->nume;
        $prenume = $request->prenume;
        $email = $request->email;
        $cnp = $request->cnp;
        $data_angajare = $request->data_angajare;
        $salariu = $request->salariu;
        $tip_angajat = $request->tip_angajat;
        $calificari = $request->calificari;
error_log($nume.'!!!');
       $angajat_de_editat =  DB::table('angajati')->where('idAngajat',$idangajat)->first();
       $result = 0;
      /* if($angajat_de_editat->nume != $nume &&
         $angajat_de_editat->prenume != $prenume&&
         $angajat_de_editat->email != $prenume &&
         $angajat_de_editat->cnp != $cnp &&
         $angajat_de_editat->data_angajare != $data_angajare &&
         $angajat_de_editat->salariu != $salariu &&
         $angajat_de_editat->tip_angajat != $tip_angajat &&
         $angajat_de_editat->calificari != $calificari 
         ){ 
           */  $result = DB::table('angajati')->where('idAngajat',$idangajat)
                                ->update(['nume'=>$nume,
                                            'prenume'=>$prenume,
                                            'cnp'=>$cnp,
                                            'data_angajare'=>$data_angajare,
                                            'salariu'=>$salariu,
                                            'tip_angajat'=>$tip_angajat,
                                            'calificari'=>$calificari]);
         /* }else{} */
 
        

        return redirect()->intended('/angajati?editscs='.$result);
    }
  
    public function deleteangajati( Request $request)
    {    $idangajati = $request->id;
         
        DB::table('angajati')->where('idAngajat',$idangajati)->delete();
       
        
        return  redirect()->intended('/angajati');
        }

  
  
  
  
   // echipaje 

    public function editechipajeForm($idechipaj){
           
            $ecp = DB::table('echipaje')->where('idEchipaj',$idechipaj)->first();
        
            $echipaj = new \stdClass();
            $echipaj->pilot = DB::table('angajati')->where('idAngajat','=',$ecp->idPilot)->first();
            $echipaj->copilot = DB::table('angajati')->where('idAngajat','=',$ecp->idCopilot)->first();
            $echipaj->steward1 = DB::table('angajati')->where('idAngajat','=',$ecp->idSteward1)->first();
            $echipaj->steward2 = DB::table('angajati')->where('idAngajat','=',$ecp->idSteward2)->first();
            $echipaj->nume = $ecp->nume;
            $echipaj->idEchipaj = $ecp->idEchipaj;

            $angajati = DB::table('angajati')->get();

            return view('echipajeedit')->with(['echipaj'=>$echipaj,'angajati'=>$angajati]);
    }

    public function getEchipaje(Request $request){
     
      $echipaje_brute = DB::table('echipaje')->get();
      $echipaje_ = array();
      foreach($echipaje_brute as $ecp){
          $echipaj = new \stdClass();
          $echipaj->pilot = DB::table('angajati')->where('idAngajat','=',$ecp->idPilot)->first();
          $echipaj->copilot = DB::table('angajati')->where('idAngajat','=',$ecp->idCopilot)->first();
          $echipaj->steward1 = DB::table('angajati')->where('idAngajat','=',$ecp->idSteward1)->first();
          $echipaj->steward2 = DB::table('angajati')->where('idAngajat','=',$ecp->idSteward2)->first();
          $echipaj->nume = $ecp->nume;
          $echipaj->idEchipaj = $ecp->idEchipaj;
          $echipaje_[] = $echipaj;
      }
      $edit_scs = $request->editscs == '1'?"true":"false";
      $add_scs = $request->addscs == '1'?"true":"false";
      error_log($edit_scs);

       return view('echipaje')->with(['echipaje'=>$echipaje_,'edit_scs'=>$edit_scs,'add_scs'=>$add_scs]);                     

    }

    public function editechipaje($idechipaj,Request $request){

        $idPilot = $request->pilot;
        $idCopilot = $request->copilot;
        $idSt1 = $request->steward1;
        $idSt2 = $request->steward2;


      $result =  DB::table('echipaje')->where('idEchipaj',$idechipaj)->update(['idPilot'=>$idPilot,
        'idCopilot'=> $idCopilot,
        'idSteward1'=>$idSt1,
        'idSteward2'=>$idSt2]);

       return  redirect()->intended('/echipaje?editscs='.$result); 
    }


    //  adauga form 
    public function echipajeForm(){
           
      //  $echipaj = DB::table('echipaje')->get();

      error_log(">> trecee ");
      $angajati = DB::table('angajati')->get();
        return view('echipajeadd')->with(['angajati'=>$angajati]);
      }
    public function addechipaje(Request $request){
        
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

     //zboruri
     public function editzboruriForm($idzbor){
           
        $zbr = DB::table('zboruri')->where('idZbor',$idzbor)->first();
        
      $zbor = new \stdClass();
      $zbor->ruta = DB::table('rute')->where('idRuta','=',$zbr->idRuta)->first();
      $zbor->avioane = DB::table('avioane')->where('idAvion','=',$zbr->idAvion)->first();
      $zbor->echipaje = DB::table('echipaje')->where('idEchipaj','=',$zbr->idEchipaj)->first();
      $zbor->ora_plecare = $zbr->ora_plecare;
      $zbor->ora_sosire = $zbr->ora_sosire;
      $zbor->Observatii = $zbr->Observatii;
      $zbor->idZbor = $zbr->idZbor;

      $ruta = DB::table('rute')->get();
      $avioane = DB::table('avioane')->get();
      $echipaje = DB::table('echipaje')->get();

      return view('zboruriedit')->with(['echipaje'=>$echipaje,'ruta'=>$ruta,'avioane'=>$avioane,'zbor'=>$zbor]);
    }

    public function getZboruri(Request $request){
     
      $zboruri_brute = DB::table('zboruri')->get();
      $zboruri_ = array();
      foreach($zboruri_brute as $zbr){
        $zbor = new \stdClass();
        $zbor->ruta = DB::table('rute')->where('idRuta','=',$zbr->idRuta)->first();
        $zbor->avioane = DB::table('avioane')->where('idAvion','=',$zbr->idAvion)->first();
        $zbor->echipaje = DB::table('echipaje')->where('idEchipaj','=',$zbr->idEchipaj)->first();
        $zbor->ora_plecare = $zbr->ora_plecare;
        $zbor->ora_sosire = $zbr->ora_sosire;
        $zbor->Observatii = $zbr->Observatii;
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
        $idEchipaj = $request->echipaj;
        $ora_plecare = $request->ora_plecare;
        $ora_sosire = $request->ora_sosire;
        $Observatii=$request->Observatii;

      $result =  DB::table('zboruri')->where('idZbor',$idzbor)->update(['idRuta'=>$idRuta,
        'idAvion'=> $idAvion,
        'idEchipaj'=>$idEchipaj,
        'ora_plecare'=>$ora_plecare,
        'ora_sosire'=>$ora_sosire,
        'Observatii'=>$Observatii]);

       return  redirect()->intended('/zboruri?editscs='.$result); 
    }


    public function zboruriForm(){

        $rute = DB::table('rute')->get();
        $echipaje = DB::table('echipaje')->get();
        foreach($echipaje as $ecp){
            $ecp->pilot = DB::table('angajati')->where('idAngajat',$ecp->idPilot)->first();
        }
        $avioane = DB::table('avioane')->get();


        return view('zboruriadd')->with(['rute'=>$rute,'echipaje'=>$echipaje,'avioane'=>$avioane]);
    }

    public function addzboruri(Request $request){
        $idRuta = $request->ruta;
        $idAvion = $request->avion;
        $idEchipaj = $request->echipaj;
        $ora_plecare = $request->data_plecare.' '.$request->ora_plecare;
        $ora_sosire = $request->data_sosire.' '.$request->ora_sosire;
        $Observatii=$request->Observatii;

      $result =  DB::table('zboruri')->insert(['idRuta'=>$idRuta,
        'idAvion'=> $idAvion,
        'idEchipaj'=>$idEchipaj,
        'ora_plecare'=>$ora_plecare,
        'ora_sosire'=>$ora_sosire,
        'Observatii'=>$Observatii]);

       return  redirect()->intended('/zboruri?editscs='.$result); 

    }


    

}