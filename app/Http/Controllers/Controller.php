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
use Storage;

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
      if($avion_de_editat->model != $model ||
         $avion_de_editat->marca != $marca||
         $avion_de_editat->nume != $nume ||
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
       $user = Session::get("user");
       if($user->tip_angajat == "Administrator"){
            $angajati = DB::table('angajati')->get();
       }
       if($user->tip_angajat == "Director piloti"){
           $angajati = DB::table('angajati')->where('tip_angajat',"Pilot")->get();
         //  $angajati[] = DB::table('angajati')->where('tip_angajat',"alt_tip")->get();
       }
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
      $zbor->avion = DB::table('avioane')->where('idAvion','=',$zbr->idAvion)->first();
      $zbor->nrZbor = $zbr->nrZbor;
      $zbor->data_ora_plecare = $zbr->data_ora_plecare;
      $zbor->data_ora_sosire = $zbr->data_ora_sosire;
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
      $zbor->ruta = $zbor->ruta? $zbor->ruta : new \stdClass();
      $zbor->avioane = DB::table('avioane')->where('idAvion','=',$zbr->idAvion)->first();
      $zbor->avioane = $zbor->avioane?$zbor->avioane:new \stdClass();
      $zbor->nrZbor = $zbr->nrZbor;
      $zbor->data_ora_plecare = $zbr->data_ora_plecare;
      $zbor->data_ora_sosire = $zbr->data_ora_sosire;
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
        $data_ora_plecare = $request->data_plecare.' '.$request->ora_plecare.':00';
        $data_ora_sosire = $request->data_sosire.' '.$request->ora_sosire.':00';
        $Observatii=$request->Observatii;
        $stareZbor=$request->stareZbor;

        $zbor_retur = DB::table('zboruri')->where('nrZbor',$nrZbor.'R')->first();
        $ruta = DB::table('rute')->where('idRuta',$idRuta)->first();
        if($retur){
            $ruta_retur = DB::table('rute')->where(['aeroport_plecare'=>$ruta->aeroport_sosire, 'aeroport_sosire'=>$ruta->aeroport_placere])->first();
            $conditie_avion_ok = $retur->idAvion == $idAvion;
            $conditie_ruta_ok = !!$ruta_retur;
            $conditie_data_ok = strcmp($zbor_retur->data_ora_plecare, $data_ora_sosire) >= 0;

            $update_vector = [];

        
            

            if(!$conditie_avion_ok){
                $update_vector['idAvion'] = $idAvion;
            }

            if($conditie_ruta_ok){
                $update_vector['idRuta'] = $ruta_retur->idRuta;
            }else{
                $update_vector['stareZbor']='ATENTIE';
            }

            if(!$conditie_data_ok){
                $update_vector['stareZbor']='ATENTIE';
            }

            DB::table('zboruri')->where('idZbor',$retur->idZbor)->update($vector_update);

        }

      $result =  DB::table('zboruri')->where('idZbor',$idzbor)->update(['idRuta'=>$idRuta,
        'idAvion'=> $idAvion,
        'nrZbor'=>$nrZbor,
        'data_ora_plecare'=>$data_ora_plecare,
        'data_ora_sosire'=>$data_ora_sosire,
        'Observatii'=>$Observatii,
        'stareZbor'=>$stareZbor,
        'stareZbor'=>'ATENTIE']);
        

      
            return  redirect()->intended('/editechipaj?idzbor='.$idzbor); 
        
       
     
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

        $data_ora_plecare2 = $request->data_plecare2.' '.$request->ora_plecare2;
        $data_ora_sosire2 = $request->data_sosire2.' '.$request->ora_sosire2;

        $ruta = DB::table('rute')->where('idRuta',$idRuta)->first();

        $retur = DB::table('rute')->where(['aeroport_plecare'=>$ruta->aeroport_sosire,'aeroport_sosire'=>$ruta->aeroport_plecare])->first();

        $idZbor =  DB::table('zboruri')->insertGetId(['idRuta'=>$idRuta,
        'idAvion'=> $idAvion,
        'nrZbor'=>$nrZbor,
        'data_ora_plecare'=>$data_ora_plecare,
        'data_ora_sosire'=>$data_ora_sosire,
        'Observatii'=>$Observatii,
        'stareZbor'=>'ATENTIE']);

        if($retur){
            $idZbor_retur =  DB::table('zboruri')->insertGetId(['idRuta'=>$retur->idRuta,
            'idAvion'=> $idAvion,
            'nrZbor'=>$nrZbor.'R',
            'data_ora_plecare'=>$data_ora_plecare2,
            'data_ora_sosire'=>$data_ora_sosire2,
            'Observatii'=>$Observatii,
            'stareZbor'=>'ATENTIE']);
        }



    
        if($idZbor&&$idZbor_retur){
            return  redirect()->intended('/addechipaj?idzbor='.$idZbor.'&idretur='.$idZbor_retur); 
        }else if($idZbor){
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
        public function addechipaj(Request $request){

            $idZbor = $request->idzbor;
            $idZborRetur = $request->idretur; 
            if($idZbor){
                $zbor = DB::table('zboruri')->where('idZbor',$idZbor)->first();
                $avion = DB::table('avioane')->where('idAvion',$zbor->idAvion)->first();
                $data = explode(' ',$zbor->data_ora_plecare)[0]; //2020-05-19 22:23:00 => ['2020-05-19','22:23:00'];
                if($idZborRetur){
                    $zborR = DB::table('zboruri')->where('idZbor',$idZborRetur)->first();
                }
        
               $results =  DB::select("select distinct idAngajat from programe pgr where pgr.tip_activitate = 'DUTY' and pgr.date  = '".$data."'".($idZborRetur?" and 1 in(select count(*) from programe pgr2 where pgr2.tip_activitate = 'DUTY' and pgr2.idAngajat = pgr.idAngajat and pgr2.date = '".explode(' ',$zborR->data_ora_plecare)[0]."')":""));
               error_log(count($results));
               error_log("select distinct idAngajat from programe pgr where tip_activitate = 'DUTY' and date  = '".$data."'".($idZborRetur?" and 1 in(select count(*) from programe pgr2 where pgr2.tip_activitate = 'DUTY' and pgr2.idAngajat = pgr.idAngajat and pgr2.data = '".explode(' ',$zborR->data_ora_plecare)[0]."'":""));
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
        
        // echipaj zbor add && edit
        public function editechipaj(Request $request){
            $idZbor = $request->idzbor;
            $zborR = DB::table('zboruri')->where('nrZbor',$zbor->nrZbor."R")->first() || DB::table('zboruri')->where('nrZbor',substr($zbor->nrZbor,0,strlen($zbor->nrZbor)))->first();
            




            if($idZbor){
        
                $zbor = DB::table('zboruri')->where('idZbor',$idZbor)->first();
                $avion = DB::table('avioane')->where('idAvion',$zbor->idAvion)->first();
                $data = explode(' ',$zbor->data_ora_plecare)[0];
             
              $piloti_curenti = DB::select("select distinct * from programe pgr join angajati using(idAngajat) where tip_angajat='Pilot' and idZbor = '".$zbor->idZbor."'  and tip_activitate = 'ZBOR' and date  = '".$data."'");
              $stewarzi_curenti = DB::select("select distinct * from programe pgr join angajati using(idAngajat) where tip_angajat='Steward' and idZbor = '".$zbor->idZbor."'  and tip_activitate = 'ZBOR' and date  = '".$data."'");
                error_log("select distinct * from programe pgr join angajati using(idAngajat) where tip_angajat='Pilot' and idZbor = '".$zbor->idZbor."'  and tip_activitate = 'ZBOR' and date  = '".$data."'");
              $results =  DB::select("select distinct idAngajat from programe pgr where tip_activitate = 'DUTY' and date  = '".$data."'".($zborR?" and 1 in(select count(*) from programe pgr2 where pgr2.tip_activitate = 'DUTY' and pgr2.idAngajat = pgr.idAngajat and pgr2.date = '".explode(' ',$zborR->data_ora_plecare)[0]."')":""));
              error_log(count($results));
               $angajati = array();
                foreach($results as $result){
                    $temp = DB::table('angajati')->where('idAngajat',$result->idAngajat)->first();
                    if($temp->tip_angajat == "Pilot" && $temp->calificari != $avion->model)
                        continue;
                    $angajati[] = $temp;
                }
                return view('editechipaj')->with(['zbor'=>$zbor,'angajati'=>$angajati,'pc'=>$piloti_curenti,'sc'=>$stewarzi_curenti]);
        
            }else{
                return redirect()->intended('/zboruri');
            }
        
        }
        
        public function editechipajPOST(Request $req){
            $idZbor = $req->zbor;

            $zbor = DB::table('zboruri')->where('idZbor',$idZbor)->first();

            $zbor_retur = DB::table('zboruri')->where('nrZbor',$zbor->nrZbor."R")->first() || DB::table('zboruri')->where('nrZbor',substr($zbor->nrZbor,0,strlen($zbor->nrZbor)))->first();
            
      
        
            $pilot1 = $req->pilot;
            $pilot2 = $req->copilot;
        
            $steward1 = $req->steward1;
            $steward2 = $req->steward2;
            $ok = true;

            $echipaj_curent = DB::table('programe')->where('idZbor',$idZbor)->get();
            foreach($echipaj_curent as $persoana){
                DB::table('programe')->where(['idAngajat'=>$persoana->idAngajat,'idZbor'=>$idZbor])->update(['tip_activitate'=>'DUTY','idZbor'=>NULL]);
            }

        
           $ok =  !!DB::table('programe')->where(['idAngajat'=>$pilot1,'date'=>explode(' ',$zbor->data_ora_plecare)[0]])->update(['tip_activitate'=>"ZBOR","idZbor"=>$idZbor]) && $ok;
           $ok = !! DB::table('programe')->where(['idAngajat'=>$pilot2,'date'=>explode(' ',$zbor->data_ora_plecare)[0]])->update(['tip_activitate'=>"ZBOR","idZbor"=>$idZbor])  && $ok;
           $ok = !! DB::table('programe')->where(['idAngajat'=>$steward1,'date'=>explode(' ',$zbor->data_ora_plecare)[0]])->update(['tip_activitate'=>"ZBOR","idZbor"=>$idZbor])  && $ok;
           $ok = !! DB::table('programe')->where(['idAngajat'=>$steward2,'date'=>explode(' ',$zbor->data_ora_plecare)[0]])->update(['tip_activitate'=>"ZBOR","idZbor"=>$idZbor])  && $ok;
           
           if($ok){
            $ok = DB::table('zboruri')->where('idZbor',$idZbor)->update(['stareZbor'=>'ACTIV']);
           }


           if($zborR){

            $echipaj_curent = DB::table('programe')->where('idZbor',$zborR->idZbor)->get();
            foreach($echipaj_curent as $persoana){
                DB::table('programe')->where(['idAngajat'=>$persoana->idAngajat,'idZbor'=>$zborR->idZbor])->update(['tip_activitate'=>'DUTY','idZbor'=>NULL]);
            }

              
                $ok =  !!DB::table('programe')->where(['idAngajat'=>$pilot1,'date'=>explode(' ',$zborR->data_ora_plecare)[0]])->update(['tip_activitate'=>"ZBOR","idZbor"=>$zborR->idZbor]) && $ok;
                $ok = !! DB::table('programe')->where(['idAngajat'=>$pilot2,'date'=>explode(' ',$zborR->data_ora_plecare)[0]])->update(['tip_activitate'=>"ZBOR","idZbor"=>$zborR->idZbor])  && $ok;
                $ok = !! DB::table('programe')->where(['idAngajat'=>$steward1,'date'=>explode(' ',$zborR->data_ora_plecare)[0]])->update(['tip_activitate'=>"ZBOR","idZbor"=>$zborR->idZbor])  && $ok;
                $ok = !! DB::table('programe')->where(['idAngajat'=>$steward2,'date'=>explode(' ',$zborR->data_ora_plecare)[0]])->update(['tip_activitate'=>"ZBOR","idZbor"=>$zborR->idZbor])  && $ok;
                
            }


           if($ok){
             return redirect()->intended('/zboruri');
           }else{
             return redirect()->intended('/editechipaj?idzbor='.$idZbor);
           }
             
        
        
        }
        
        public function addechipajPOST(Request $req){
            $idZbor = $req->zbor;
        
            $pilot1 = $req->pilot;
            $pilot2 = $req->copilot;
        
            $steward1 = $req->steward1;
            $steward2 = $req->steward2;
            $ok = true;
        
           $ok =  !!DB::table('programe')->where('idAngajat',$pilot1)->update(['tip_activitate'=>"ZBOR","idZbor"=>$idZbor]) && $ok;
           $ok =  !!DB::table('programe')->where('idAngajat',$pilot2)->update(['tip_activitate'=>"ZBOR","idZbor"=>$idZbor]) && $ok;
           $ok = !!DB::table('programe')->where('idAngajat',$steward1)->update(['tip_activitate'=>"ZBOR","idZbor"=>$idZbor]) && $ok;
           $ok = !!DB::table('programe')->where('idAngajat',$steward2)->update(['tip_activitate'=>"ZBOR","idZbor"=>$idZbor])&& $ok;
        
           if($ok){
            $ok = DB::table('zboruri')->where('idZbor',$idZbor)->update(['stareZbor'=>'ACTIV']);
           }
           if($ok){
             return redirect()->intended('/zboruri');
           }else{
             return redirect()->intended('/addechipaj?idzbor='.$idZbor);
           }
        
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
public function getInfoZboruri(Request $req){
    $data_plecare_lower_limit = $req->an.'-'.$req->luna.'-'.$req->zi.' 00:00:00';
    $data_plecare_upper_limit = $req->an.'-'.$req->luna.'-'.($req->zi+1).' 00:00:00';

    $rez =   DB::select(" select idZbor, nrZbor,stareZbor, aeroport_plecare, aeroport_sosire,nume,model  from zboruri left join rute using(idRuta) left join avioane using(idAvion) where data_ora_plecare > '".$data_plecare_lower_limit."' and data_ora_plecare < '".$data_plecare_upper_limit."'");
                
     $scs = count($rez)>0;            
     $zboruri = [];
 
     foreach($rez as $result){
         $line = [];
         $line[] = $result->nrZbor;
         $line[] = $result->stareZbor;
         $line[] = $result->aeroport_plecare."-".$result->aeroport_sosire;
         $line[] = $result->nume;
         $line[] = $result->model;
         $line[] = $result->idZbor;
         $zboruri[] = $line;        
     }
 
 
 return response()->json(['scs'=>$scs,'rezultate'=>$zboruri]);
 
}
    
// logare
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


// orar

public function orarpilot(Request $req)
{
    return view('orarpilot');
}

public function orarsteward(Request $req)
{
    return view('orarsteward');

}



    //program piloti

    public function getInfoPiloti(Request $req){
        $data = $req->an.'-'.$req->luna.'-'.$req->zi;

       $rez =   DB::select(" select ang.idAngajat, ang.nume, ang.prenume, prg.tip_activitate, zbr.nrZbor 
                    from programe prg join angajati ang on(prg.idAngajat = ang.idAngajat) 
                    left join zboruri zbr on(prg.idZbor = zbr.idZbor) where ang.tip_angajat = 'Pilot'
                    and prg.date = '".$data."'");
                   
        $scs = count($rez)>0;            
        $piloti = [];

        foreach($rez as $result){
            $line = [];
            $line[] = $result->nume;
            $line[] = $result->prenume;
            $line[] = $result->tip_activitate == 'DUTY'?"1":"0";
            $line[] = $result->nrZbor;
            $line[] = $result->idAngajat;
            $piloti[] = $line;        
        }

    $rez = DB::select("select ang1.idAngajat, ang1.nume, ang1.prenume from angajati ang1 where idAngajat not in(select ang.idAngajat 
        from programe prg join angajati ang on(prg.idAngajat = ang.idAngajat) 
        left join zboruri zbr on(prg.idZbor = zbr.idZbor) where ang.tip_angajat = 'Pilot'
        and prg.date = '".$data."') and ang1.tip_angajat = 'Pilot'");

       
    

    $scs = ($scs || count($rez)>0);            
    $avpiloti = [];

    foreach($rez as $result){
        $line = [];
        $line[] = $result->idAngajat;
        $line[] = $result->nume." ".$result->prenume;   //pilot[1] din programpiloti linia 184
        $avpiloti[] = $line;        
    }

    return response()->json(['scs'=>$scs,'rezultate'=>$piloti,'avpiloti'=>$avpiloti]);
}

public function saveProgramPiloti(Request $req){
    $data =  $req->timestamp;
    $piloti = $req->piloti;
    $flag = true;
  
    if($piloti && count($piloti)>0){
    foreach($piloti as $pilot){
     
        $entry =  DB::table('programe')->where(['idAngajat'=>$pilot['idAngajat'],'date'=>$data])->first();
        print_r($entry->tip_activitate);
        if($entry->tip_activitate == "ZBOR"){
          $flag = !!DB::table('zboruri')->where('idZbor',$entry->idZbor)->update(['stareZbor'=>'ATENTIE']) && $flag;
        }

        if($pilot['tip_activitate'] == "2"){
            $flag =  !!DB::table('programe')->where(['idAngajat'=>$pilot['idAngajat'],'date'=>$data])->delete() && $flag ;
        }else{
            $flag =  !!DB::table('programe')->where(['idAngajat'=>$pilot['idAngajat'],'date'=>$data])->update(['tip_activitate'=>"DUTY",'idZbor'=>NULL]) && $flag;
        }
     
    }
    }

    $piloti_new = $req->piloti_new;

    if($piloti_new && count($piloti_new)>0){

    foreach($piloti_new as $pilot){ 
        $flag = !!DB::table('programe')->insertGetID(['tip_activitate'=>'DUTY','idZbor'=>NULL,'idAngajat'=>$pilot['idAngajat'],'date'=>$data]) && $flag ;
     }

    }

    return response()->json(['scs'=>$flag]);


}
// program stewarzi

public function getInfoStewarzi(Request $req){
    $data = $req->an.'-'.$req->luna.'-'.$req->zi;

   $rez =   DB::select(" select ang.idAngajat, ang.nume, ang.prenume, prg.tip_activitate, zbr.nrZbor 
                from programe prg join angajati ang on(prg.idAngajat = ang.idAngajat) 
                left join zboruri zbr on(prg.idZbor = zbr.idZbor) where ang.tip_angajat = 'Steward'
                and prg.date = '".$data."'");
               
    $scs = count($rez)>0;            
    $stewarzi = [];

    foreach($rez as $result){
        $line = [];
        $line[] = $result->nume;
        $line[] = $result->prenume;
        $line[] = $result->tip_activitate == 'DUTY'?"1":"0";
        $line[] = $result->nrZbor;
        $line[] = $result->idAngajat;
        $stewarzi[] = $line;        
    }

$rez = DB::select("select ang1.idAngajat, ang1.nume, ang1.prenume from angajati ang1 where idAngajat not in(select ang.idAngajat 
    from programe prg join angajati ang on(prg.idAngajat = ang.idAngajat) 
    left join zboruri zbr on(prg.idZbor = zbr.idZbor) where ang.tip_angajat = 'Steward'
    and prg.date = '".$data."') and ang1.tip_angajat = 'Steward'");

   


$scs = ($scs || count($rez)>0);            
$avstewarzi = [];

foreach($rez as $result){
    $line = [];
    $line[] = $result->idAngajat;
    $line[] = $result->nume." ".$result->prenume;   //pilot[1] din programpiloti linia 184
    $avstewarzi[] = $line;        
}

return response()->json(['scs'=>$scs,'rezultate'=>$stewarzi,'avstewarzi'=>$avstewarzi]);
}

public function saveProgramStewarzi(Request $req){
$data =  $req->timestamp;
$stewarzi = $req->stewarzi;
$flag = true;

if($stewarzi && count($stewarzi)>0){
foreach($stewarzi as $steward){
 
    $entry =  DB::table('programe')->where(['idAngajat'=>$steward['idAngajat'],'date'=>$data])->first();
    print_r($entry->tip_activitate);
    if($entry->tip_activitate == "ZBOR"){
      $flag = !!DB::table('zboruri')->where('idZbor',$entry->idZbor)->update(['stareZbor'=>'ATENTIE']) && $flag;
    }

    if($steward['tip_activitate'] == "2"){
        $flag =  !!DB::table('programe')->where(['idAngajat'=>$steward['idAngajat'],'date'=>$data])->delete() && $flag ;
    }else{
        $flag =  !!DB::table('programe')->where(['idAngajat'=>$steward['idAngajat'],'date'=>$data])->update(['tip_activitate'=>"DUTY",'idZbor'=>NULL]) && $flag;
    }
 
}
}

$stewarzi_new = $req->stewarzi_new;

if($stewarzi_new && count($stewarzi_new)>0){

foreach($stewarzi_new as $steward){ 
    $flag = !!DB::table('programe')->insertGetID(['tip_activitate'=>'DUTY','idZbor'=>NULL,'idAngajat'=>$steward['idAngajat'],'date'=>$data]) && $flag ;
 }

}

return response()->json(['scs'=>$flag]);


}

//documente angajati
public function arataDocumente(Request $req){

    $user = Session::get("user");
    $documente = null;
    if($user){
        switch($user->tip_angajat){

            case "Pilot":{
                $documente = DB::select("select * from documente where idAngajat = '".$user->idAngajat."'");
            }break;

            case "Steward":{
                $documente = DB::select("select * from documente where idAngajat = '".$user->idAngajat."'");
            }break;

            case "Director piloti":{
                $documente = DB::select("select documente.*, angajati.nume as nume_ang,angajati.prenume as prenume_ang from documente join angajati on(documente.idAngajat = angajati.idAngajat) where angajati.tip_angajat = 'Pilot' or documente.idAngajat = '".$user->idAngajat."'");
            }break;

            case "Director stewarzi":{
                $documente = DB::select("select documente.*, angajati.nume as nume_ang,angajati.prenume as prenume_ang from documente join angajati on(documente.idAngajat = angajati.idAngajat) where angajati.tip_angajat = 'Steward' or documente.idAngajat = '".$user->idAngajat."'");
            }break;

            case "Direcor servicii":{
                $documente = DB::select("select documente.*, angajati.nume as nume_ang,angajati.prenume as prenume_ang from documente join angajati on(documente.idAngajat = angajati.idAngajat) where angajati.tip_angajat = 'Serviciul suport tehnic zboruri' or angajati.tip_angajat = 'Serviciul planificari' or angajati.tip_angajat = 'Serviciul gestiune si analiza operatiuni zboruri' or documente.idAngajat = '".$user->idAngajat."'");
         
            }break;

            case "Serviciul suport tehnic zboruri":{
                $documente = DB::select("select * from documente where idAngajat = '".$user->idAngajat."'");
            }break;


            case "Serviciul planificari":{
                $documente = DB::select("select * from documente where idAngajat = '".$user->idAngajat."'");
            }break;


            case "Serviciul gestiune si analiza operatiuni zboruri":{
                $documente = DB::select("select * from documente where idAngajat = '".$user->idAngajat."'");
            }break;


            case "Administrator":{
                $documente = DB::select("select documente.*, angajati.nume as nume_ang, angajati.prenume as prenume_ang  from documente join angajati on(angajati.idAngajat = documente.idAngajat)");
            }break;

        }   
        
        return view('documents')->with(['documente'=>$documente]);
    }
}

public function descarcaDocument(Request $req){
    $id = $req->idDoc;
    $user = Session::get("user");
    $doc = DB::table('documente')->where('idDocument',$id)->first();
    if($doc){
      $file = Storage::get($doc->cale);
      if($doc->idAngajat == $user->idAngajat)
        $nume_dl = "Document-".$doc->nume;
        else{
          $ang =   DB::table('angajati')->where('idAngajat',$doc->idAngajat)->first();
            $nume_dl = 'Document-'.$ang->nume.'-'.$ang->prenume.'-'.$doc->nume;
        }
     return Storage::download('/'.$doc->cale,$nume_dl);//aresponse()->download($file, "Document - ".$doc->nume);
    }else{
        return response()->json(['error'=>'Bad parameter']);
    }
}

public function uploadeazaDocument(Request $req){
    $doc = $req->file('doc');
//var_dump($_FILES);

  // var_dump('.'.explode('.',$doc->getClientOriginalName())[1]);
   if(strpos($doc->getClientOriginalName(),'.')>0){
       $arr = explode('.',$doc->getClientOriginalName());
     $ext =   '.'.$arr[count($arr)-1];
   }
    $doc_name  = $req->nume.$ext;
    /*
       Storage::disk('local')->putFileAs(
        'files/'.$filename,
        $uploadedFile,
        $filename
      );
    */
   // $res = $req->file('doc')->storeAs('storage/documente',$doc_name,$doc);
   $res =  Storage::disk('local')->putFileAs(
        '/documente/',
        $doc,
        $doc_name
      );
    if($res){
        DB::table('documente')->insert(['nume'=>$doc_name,'idAngajat'=>Session::get("user")->idAngajat,
                                            'cale'=>'/documente/'.$doc_name
                                        ]);

        return redirect()->intended('/documents');
    }
    return response()->json(['scs'=>$res]);
}

public function schimbaDocument(Request $req){
    $doc = $req->file('doc');
    $doc_id  = $req->idDoc;
    $doc_db = DB::table('documente')->where('idDocument',$doc_id)->first();
    $res = false;
    Storage::delete($doc_db->cale);
    if($doc && $doc_db){
    $res =  Storage::disk('local')->putFileAs(
            '/documente/',
            $doc,
            $doc_db->nume
          );
          if($res){
            return redirect()->intended('/documents');
          }
    }
    return response()->json(['scs'=>$res]);
}

public function stergeDocument(Request $req){
    $doc_id  = $req->idDoc;
   $doc = DB::table('documente')->where('idDocument',$doc_id)->first();
    $res = false;
    $res = Storage::delete($doc->cale);
    if($res){
        DB::table('documente')->where('idDocument',$doc->idDocument)->delete();
    }
    return redirect()->intended('/documents');
}





}