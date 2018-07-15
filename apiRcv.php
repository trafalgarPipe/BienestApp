<?php
require_once 'bdRcv.php';
require_once 'UtilRcv.php';

class apiRcv {
    public function api(){
        header('Content-Type: application/JSON');
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
        case 'GET'://consulta
          $this->getRCV();
        break;
        case 'POST'://actualiza
          $this->postRCV();
        break;
        case 'PUT'://inserta
        echo 'PUT';
        break;
        case 'DELETE'://elimina
        echo 'DELETE';
        break;
        default:
        echo 'METODO NO SOPORTADO';
        break;
    }
}

//genera las respuestas
function response($code=200, $status="", $message="") {
    http_response_code($code);
    if( !empty($status) && !empty($message) ){
        $response = array("status" => $status ,"mensaje"=>$message);
        echo json_encode($response,JSON_PRETTY_PRINT);
    }
}




//funciones de la api
function postRCV() {


    if( isset($_GET['action']) ){

        if($_GET['action']=='InsertNewUser'){
            $obj = json_decode( file_get_contents('php://input') );
            $objArr = (array)$obj;
            if (empty($objArr)){
                $this->response(200,"Error000","No se agrego JSON");
            }else{

                if(!isset($obj->edadUsuario)){
                    $this->response(200,"Error001","No se agrego la etiqueta edadUsuario");
                    exit;
                }
                if (!ctype_digit($obj->edadUsuario)) {
                    $this->response(200,"Error002","La etiqueta edadUsuario debe tomar valor numerico");
                    exit;
                }
                if(!isset($obj->rutUsuario)){
                    $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
                    exit;
                }
                if($obj->rutUsuario==''){
                    $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
                    exit;
                }

                if(!isset($obj->nombreUsuario)){
                    $this->response(200,"Error006","No se agrego la etiqueta nombreUsuario");
                    exit;
                }
                if($obj->nombreUsuario==''){
                    $this->response(200,"Error007","La etiqueta nombreUsuario esta vacia");
                    exit;
                }
                if(!isset($obj->apellidoUsuario)){
                    $this->response(200,"Error008","No se agrego la etiqueta apellidoUsuario");
                    exit;
                }
                if($obj->apellidoUsuario==''){
                    $this->response(200,"Error007","La etiqueta apellidoUsuario esta vacia");
                    exit;
                }

                if(!isset($obj->passwordUsuario)){
                    $this->response(200,"Error010","No se agrego la etiqueta passwordUsuario");
                    exit;
                }
                if($obj->passwordUsuario==''){
                    $this->response(200,"Error011","La etiqueta passwordUsuario esta vacia");
                    exit;
                }
                if(!isset($obj->sexoUsuario)){
                    $this->response(200,"Error012","No se agrego la etiqueta sexoUsuario");
                    exit;
                }
                if($obj->sexoUsuario==''){
                    $this->response(200,"Error013","La etiqueta sexoUsuario esta vacia");
                    exit;
                }
                if(!isset($obj->ocupacionUsuario)){
                    $this->response(200,"Error014","No se agrego la etiqueta ocupacionUsuario");
                    exit;
                }
                if($obj->ocupacionUsuario==''){
                    $this->response(200,"Error015","La etiqueta ocupacionUsuario esta vacia");
                    exit;
                }


            $db = new bdRcv();
            $respuesta=$db->InsertNewUser($obj->rutUsuario,$obj->nombreUsuario,$obj->apellidoUsuario,$obj->edadUsuario,$obj->sexoUsuario,$obj->ocupacionUsuario,$obj->passwordUsuario);

            if($respuesta['Estado']=='success'){
                $this->response(200,"success","Registro exitoso");
                //InsertNewMonumento($obj->rutUsuario);
            }else{
              $this->response(200,"Error999",$respuesta['Response']);
              exit;
            }
        } //elseemtyarreglo


        exit;
    }//CIERRA post



    if($_GET['action']=='InsertNewMeta'){
        $obj = json_decode( file_get_contents('php://input') );
        $objArr = (array)$obj;
        if (empty($objArr)){
            $this->response(200,"Error000","No se agrego JSON");
        }else{


            if(!isset($obj->rutUsuario)){
                $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
                exit;
            }
            if($obj->rutUsuario==''){
                $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
                exit;
            }


            if(!isset($obj->idMeta)){
                $this->response(200,"Error016","No se agrego la etiqueta idMeta");
                exit;
            }
            if($obj->idMeta==''){
                $this->response(200,"Error017","La etiqueta idMeta esta vacia");
                exit;
            }
            if(!isset($obj->nombreMeta)){
                  $this->response(200,"Error028","No se agrego la etiqueta nombreMeta");
                  exit;
              }
              if($obj->descripcionMeta==''){
                  $this->response(200,"Error029","La etiqueta descripcionMeta esta vacia");
                  exit;
              }
              // if (!ctype_digit($obj->numCigarros)) {
              //     $this->response(200,"Error030","La etiqueta numCigarros debe tomar valor numerico");
              //     exit;
              // }

              if(!isset($obj->duracionMeta)){
                  $this->response(200,"Error031","No se agrego la etiqueta duracionMeta");
                  exit;
              }
              if($obj->duracionMeta==''){
                  $this->response(200,"Error032","La etiqueta duracionMeta esta vacia");
                  exit;
              }if(!isset($obj->duracionReal)){
                  $this->response(200,"Error033","No se agrego la etiqueta duracionReal");
                  exit;
              }
              if($obj->duracionReal==''){
                  $this->response(200,"Error034","La etiqueta duracionReal esta vacia");
                  exit;
              }

            if(!isset($obj->resultadoMeta)){
                $this->response(200,"Error035","No se agrego la etiqueta resultadoMeta");
                exit;
            }
            if($obj->resultadoMeta==''){
                $this->response(200,"Error036","La etiqueta resultadoMeta esta vacia");
                exit;
            }if(!isset($obj->responsabilidadMeta)){
                $this->response(200,"Error035","No se agrego la etiqueta responsabilidadMeta");
                exit;
            }
            if($obj->responsabilidadMeta==''){
                $this->response(200,"Error036","La etiqueta responsabilidadMeta esta vacia");
                exit;
            }if(!isset($obj->ambitoVidaMeta)){
                $this->response(200,"Error035","No se agrego la etiqueta ambitoVidaMeta");
                exit;
            }
            if($obj->ambitoVidaMeta==''){
                $this->response(200,"Error036","La etiqueta ambitoVidaMeta esta vacia");
                exit;
            }if(!isset($obj->mejoraMeta)){
                $this->response(200,"Error035","No se agrego la etiqueta mejoraMeta");
                exit;
            }
            if($obj->mejoraMeta==''){
                $this->response(200,"Error036","La etiqueta mejoraMeta esta vacia");
                exit;
            }if(!isset($obj->estadoMeta)){
                  $this->response(200,"Error033","No se agrego la etiqueta estadoMeta");
                  exit;
            }if($obj->estadoMeta==''){
                  $this->response(200,"Error034","La etiqueta estadoMeta esta vacia");
                  exit;
            }if(!isset($obj->progresoMeta)){
                $this->response(200,"Error035","No se agrego la etiqueta progresoMeta");
                exit;
            }
            if($obj->progresoMeta==''){
                $this->response(200,"Error036","La etiqueta progresoMeta esta vacia");
                exit;
            }if(!isset($obj->enviado)){
                $this->response(200,"Error035","No se agrego la etiqueta enviado");
                exit;
            }
            if($obj->enviado==''){
                $this->response(200,"Error036","La etiqueta enviado esta vacia");
                exit;
            }if(!isset($obj->compartida)){
                $this->response(200,"Error035","No se agrego la etiqueta compartida");
                exit;
            }
            if($obj->compartida==''){
                $this->response(200,"Error036","La etiqueta compartida esta vacia");
                exit;
            }if(!isset($obj->fechaMeta)){
                $this->response(200,"Error035","No se agrego la etiqueta fechaMeta");
                exit;
            }
            if($obj->fechaMeta==''){
                $this->response(200,"Error036","La etiqueta fechaMeta esta vacia");
                exit;
            }if(!isset($obj->puntajeMeta)){
                $this->response(200,"Error035","No se agrego la etiqueta puntajeMeta");
                exit;
            }
            if($obj->puntajeMeta==''){
                $this->response(200,"Error036","La etiqueta puntajeMeta esta vacia");
                exit;
            }if(!isset($obj->puntajeMetaSocial)){
                $this->response(200,"Error035","No se agrego la etiqueta puntajeMetaSocial");
                exit;
            }
            if($obj->puntajeMetaSocial==''){
                $this->response(200,"Error036","La etiqueta puntajeMetaSocial esta vacia");
                exit;
            }

        $db = new bdRcv();
        $respuesta=$db->InsertNewMeta($obj->rutUsuario,$obj->idMeta,$obj->nombreMeta,$obj->descripcionMeta,$obj->duracionMeta,$obj->duracionReal,$obj->resultadoMeta,$obj->responsabilidadMeta,$obj->ambitoVidaMeta,$obj->mejoraMeta,$obj->estadoMeta,$obj->progresoMeta,$obj->enviado,$obj->fechaMeta,$obj->compartida,$obj->puntajeMeta,$obj->puntajeMetaSocial);

        if($respuesta['Estado']=='success'){
            $this->response(200,"success","Se inserto De Forma Correcta");
        }else{
          $this->response(200,"Error999",$respuesta['Response']);
          exit;
        }
    } //elseemtyarreglo


    exit;
}//CIERRA post

if($_GET['action']=='InsertNewDesafio'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{


        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
            exit;
        }

        if(!isset($obj->idDesafio)){
            $this->response(200,"Error016","No se agrego la etiqueta idDesafio");
            exit;
        }
        if($obj->idDesafio==''){
            $this->response(200,"Error017","La etiqueta idDesafio esta vacia");
            exit;
        }
        if(!isset($obj->nombreDesafio)){
              $this->response(200,"Error028","No se agrego la etiqueta nombreDesafio");
              exit;
          }
          if($obj->descripcionDesafio==''){
              $this->response(200,"Error029","La etiqueta descripcionDesafio esta vacia");
              exit;
          }
          // if (!ctype_digit($obj->numCigarros)) {
          //     $this->response(200,"Error030","La etiqueta numCigarros debe tomar valor numerico");
          //     exit;
          // }

          if(!isset($obj->dificultadInicial)){
              $this->response(200,"Error031","No se agrego la etiqueta dificultadInicial");
              exit;
          }
          if($obj->dificultadInicial==''){
              $this->response(200,"Error032","La etiqueta dificultadInicial esta vacia");
              exit;
          }

          if(!isset($obj->dificultadFinal)){
              $this->response(200,"Error033","No se agrego la etiqueta dificultadFinal");
              exit;
          }
          if($obj->dificultadFinal==''){
              $this->response(200,"Error034","La etiqueta dificultadFinal esta vacia");
              exit;
          }

        if(!isset($obj->resultadoDesafio)){
            $this->response(200,"Error035","No se agrego la etiqueta resultadoDesafio");
            exit;
        }
        if($obj->resultadoDesafio==''){
            $this->response(200,"Error036","La etiqueta resultadoDesafio esta vacia");
            exit;
        }if(!isset($obj->responsabilidadDesafio)){
            $this->response(200,"Error035","No se agrego la etiqueta responsabilidadDesafio");
            exit;
        }
        if($obj->responsabilidadDesafio==''){
            $this->response(200,"Error036","La etiqueta responsabilidadDesafio esta vacia");
            exit;
        }if(!isset($obj->ambitoVidaDesafio)){
            $this->response(200,"Error035","No se agrego la etiqueta ambitoVidaDesafio");
            exit;
        }
        if($obj->ambitoVidaDesafio==''){
            $this->response(200,"Error036","La etiqueta ambitoVidaDesafio esta vacia");
            exit;
        }if(!isset($obj->mejoraDesafio)){
            $this->response(200,"Error035","No se agrego la etiqueta mejoraDesafio");
            exit;
        }
        if($obj->mejoraDesafio==''){
            $this->response(200,"Error036","La etiqueta mejoraDesafio esta vacia");
            exit;
        }if(!isset($obj->estadoDesafio)){
            $this->response(200,"Error035","No se agrego la etiqueta estadoDesafio");
            exit;
        }
        if($obj->estadoDesafio==''){
            $this->response(200,"Error036","La etiqueta estadoDesafio esta vacia");
            exit;
        }if(!isset($obj->enviado)){
            $this->response(200,"Error035","No se agrego la etiqueta enviado");
            exit;
        }
        if($obj->enviado==''){
            $this->response(200,"Error036","La etiqueta enviado esta vacia");
            exit;
        }if(!isset($obj->idMeta_fk)){
            $this->response(200,"Error035","No se agrego la etiqueta idMeta_fk");
            exit;
        }
        if($obj->idMeta_fk==''){
            $this->response(200,"Error036","La etiqueta idMeta_fk esta vacia");
            exit;
        }if(!isset($obj->puntajeDesafio)){
            $this->response(200,"Error035","No se agrego la etiqueta puntajeDesafio");
            exit;
        }
        if($obj->puntajeDesafio==''){
            $this->response(200,"Error036","La etiqueta puntajeDesafio esta vacia");
            exit;
        }

    $db = new bdRcv();
    $respuesta=$db->InsertNewDesafio($obj->rutUsuario,$obj->idDesafio,$obj->nombreDesafio,$obj->descripcionDesafio,$obj->dificultadInicial,$obj->dificultadFinal,$obj->resultadoDesafio,$obj->responsabilidadDesafio,$obj->ambitoVidaDesafio,$obj->mejoraDesafio,$obj->estadoDesafio,$obj->enviado,$obj->idMeta_fk,$obj->puntajeDesafio);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post

if($_GET['action']=='InsertNewSocial'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{


        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
            exit;
        }


        if(!isset($obj->tituloPublicacion)){
              $this->response(200,"Error028","No se agrego la etiqueta tituloPublicacion");
              exit;
          }
          if($obj->tituloPublicacion==''){
              $this->response(200,"Error029","La etiqueta tituloPublicacion esta vacia");
              exit;
          }
          // if (!ctype_digit($obj->numCigarros)) {
          //     $this->response(200,"Error030","La etiqueta numCigarros debe tomar valor numerico");
          //     exit;
          // }

          if(!isset($obj->bodyPublicacion)){
              $this->response(200,"Error031","No se agrego la etiqueta bodyPublicacion");
              exit;
          }
          if($obj->bodyPublicacion==''){
              $this->response(200,"Error032","La etiqueta bodyPublicacion esta vacia");
              exit;
          }

          if(!isset($obj->reaccion1)){
              $this->response(200,"Error033","No se agrego la etiqueta reaccion1");
              exit;
          }
          if($obj->reaccion1==''){
              $this->response(200,"Error034","La etiqueta reaccion1 esta vacia");
              exit;
          }

        if(!isset($obj->reaccion2)){
            $this->response(200,"Error035","No se agrego la etiqueta reaccion2");
            exit;
        }
        if($obj->reaccion2==''){
            $this->response(200,"Error036","La etiqueta reaccion2 esta vacia");
            exit;
        }if(!isset($obj->reaccion3)){
            $this->response(200,"Error035","No se agrego la etiqueta reaccion3");
            exit;
        }
        if($obj->reaccion3==''){
            $this->response(200,"Error036","La etiqueta reaccion3 esta vacia");
            exit;
        }if(!isset($obj->idMeta_fk)){
            $this->response(200,"Error035","No se agrego la etiqueta idMeta_fk");
            exit;
        }
        if($obj->idMeta_fk==''){
            $this->response(200,"Error036","La etiqueta idMeta_fk esta vacia");
            exit;
        }if(!isset($obj->fechaPost)){
            $this->response(200,"Error035","No se agrego la etiqueta fechaPost");
            exit;
        }
        if($obj->fechaPost==''){
            $this->response(200,"Error036","La etiqueta fechaPost esta vacia");
            exit;
        }

    $db = new bdRcv();

    $respuesta=$db->InsertNewSocial($obj->rutUsuario,$obj->tituloPublicacion,$obj->bodyPublicacion,$obj->reaccion1,$obj->reaccion2,$obj->reaccion3,$obj->idMeta_fk,$obj->fechaPost);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post

if($_GET['action']=='InsertNewMonumento'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{


        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
            exit;
        }


    $db = new bdRcv();

    $respuesta=$db->InsertNewMonumento($obj->rutUsuario);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post

if($_GET['action']=='UpdateReaccionSocial'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{

        if(!isset($obj->idPublicacion)){
              $this->response(200,"Error028","No se agrego la etiqueta idPublicacion");
              exit;
          }
          if($obj->idPublicacion==''){
              $this->response(200,"Error029","La etiqueta idPublicacion esta vacia");
              exit;
          }

          if(!isset($obj->reaccionPublicacion)){
              $this->response(200,"Error031","No se agrego la etiqueta reaccionPublicacion");
              exit;
          }
          if($obj->reaccionPublicacion==''){
              $this->response(200,"Error032","La etiqueta reaccionPublicacion esta vacia");
              exit;
          }
          if(!isset($obj->oldReaccionPublicacion)){
              $this->response(200,"Error031","No se agrego la etiqueta oldReaccionPublicacion");
              exit;
          }
          if($obj->oldReaccionPublicacion==''){
              $this->response(200,"Error032","La etiqueta oldReaccionPublicacion esta vacia");
              exit;
          }


    $db = new bdRcv();

    $respuesta=$db->UpdateReaccionSocial($obj->idPublicacion,$obj->reaccionPublicacion,$obj->oldReaccionPublicacion);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post


if($_GET['action']=='UpdatePost'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{

        if(!isset($obj->rutUsuario)){
              $this->response(200,"Error028","No se agrego la etiqueta rutUsuario");
              exit;
          }
          if($obj->rutUsuario==''){
              $this->response(200,"Error029","La etiqueta rutUsuario esta vacia");
              exit;
          }

          if(!isset($obj->idMeta)){
              $this->response(200,"Error031","No se agrego la etiqueta idMeta");
              exit;
          }
          if($obj->idMeta==''){
              $this->response(200,"Error032","La etiqueta idMeta esta vacia");
              exit;
          }



    $db = new bdRcv();

    $respuesta=$db->UpdatePost($obj->rutUsuario,$obj->idMeta);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post


if($_GET['action']=='UpdateMonumento'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{

        if(!isset($obj->idMonumento)){
              $this->response(200,"Error028","No se agrego la etiqueta idMonumento");
              exit;
          }
          if($obj->idMonumento==''){
              $this->response(200,"Error029","La etiqueta idMonumento esta vacia");
              exit;
          }

          if(!isset($obj->nivelMonumento)){
              $this->response(200,"Error031","No se agrego la etiqueta nivelMonumento");
              exit;
          }
          if($obj->nivelMonumento==''){
              $this->response(200,"Error032","La etiqueta nivelMonumento esta vacia");
              exit;
          }
          if(!isset($obj->puntajeMonumento)){
              $this->response(200,"Error031","No se agrego la etiqueta puntajeMonumento");
              exit;
          }
          if($obj->puntajeMonumento==''){
              $this->response(200,"Error032","La etiqueta puntajeMonumento esta vacia");
              exit;
          }
          if(!isset($obj->rutUsuario_fk)){
              $this->response(200,"Error031","No se agrego la etiqueta rutUsuario_fk");
              exit;
          }
          if($obj->rutUsuario_fk==''){
              $this->response(200,"Error032","La etiqueta rutUsuario_fk esta vacia");
              exit;
          }
          if(!isset($obj->idLogro_fk)){
              $this->response(200,"Error031","No se agrego la etiqueta idLogro_fk");
              exit;
          }
          if($obj->idLogro_fk==''){
              $this->response(200,"Error032","La etiqueta idLogro_fk esta vacia");
              exit;
          }
          if(!isset($obj->enviado)){
              $this->response(200,"Error031","No se agrego la etiqueta enviado");
              exit;
          }
          if($obj->enviado==''){
              $this->response(200,"Error032","La etiqueta enviado esta vacia");
              exit;
          }


    $db = new bdRcv();

    $respuesta=$db->UpdateMonumento($obj->idMonumento,$obj->nivelMonumento,$obj->puntajeMonumento,$obj->rutUsuario_fk,$obj->idLogro_fk,$obj->enviado);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post



if($_GET['action']=='UpdateNewReaccionSocial'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{

        if(!isset($obj->idPublicacion)){
              $this->response(200,"Error028","No se agrego la etiqueta idPublicacion");
              exit;
          }
          if($obj->idPublicacion==''){
              $this->response(200,"Error029","La etiqueta idPublicacion esta vacia");
              exit;
          }

          if(!isset($obj->reaccionPublicacion)){
              $this->response(200,"Error031","No se agrego la etiqueta reaccionPublicacion");
              exit;
          }
          if($obj->reaccionPublicacion==''){
              $this->response(200,"Error032","La etiqueta reaccionPublicacion esta vacia");
              exit;
          }



    $db = new bdRcv();

    $respuesta=$db->UpdateNewReaccionSocial($obj->idPublicacion,$obj->reaccionPublicacion);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post

if($_GET['action']=='InsertReaccionSocial'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{

        if(!isset($obj->idPublicacion)){
              $this->response(200,"Error028","No se agrego la etiqueta idPublicacion");
              exit;
          }
          if($obj->idPublicacion==''){
              $this->response(200,"Error029","La etiqueta idPublicacion esta vacia");
              exit;
          }

          if(!isset($obj->rutUsuario)){
              $this->response(200,"Error031","No se agrego la etiqueta rutUsuario");
              exit;
          }
          if($obj->rutUsuario==''){
              $this->response(200,"Error032","La etiqueta rutUsuario esta vacia");
              exit;
          }

          if(!isset($obj->reaccionPublicacion)){
              $this->response(200,"Error031","No se agrego la etiqueta reaccionPublicacion");
              exit;
          }
          if($obj->reaccionPublicacion==''){
              $this->response(200,"Error032","La etiqueta reaccionPublicacion esta vacia");
              exit;
          }


    $db = new bdRcv();

    $respuesta=$db->InsertReaccionSocial($obj->idPublicacion,$obj->rutUsuario,$obj->reaccionPublicacion);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post

if($_GET['action']=='InsertNewReaccionSocial'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{

        if(!isset($obj->idPublicacion)){
              $this->response(200,"Error028","No se agrego la etiqueta idPublicacion");
              exit;
          }
          if($obj->idPublicacion==''){
              $this->response(200,"Error029","La etiqueta idPublicacion esta vacia");
              exit;
          }

          if(!isset($obj->rutUsuario)){
              $this->response(200,"Error031","No se agrego la etiqueta rutUsuario");
              exit;
          }
          if($obj->rutUsuario==''){
              $this->response(200,"Error032","La etiqueta rutUsuario esta vacia");
              exit;
          }

          if(!isset($obj->reaccionPublicacion)){
              $this->response(200,"Error031","No se agrego la etiqueta reaccionPublicacion");
              exit;
          }
          if($obj->reaccionPublicacion==''){
              $this->response(200,"Error032","La etiqueta reaccionPublicacion esta vacia");
              exit;
          }


    $db = new bdRcv();

    $respuesta=$db->InsertNewReaccionSocial($obj->idPublicacion,$obj->rutUsuario,$obj->reaccionPublicacion);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post


if($_GET['action']=='InsertImageUser'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{


        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
            exit;
        }

        if(!isset($obj->imageUser)){
            $this->response(200,"Error043","No se agrego la etiqueta imageUser");
            exit;
        }
        if($obj->imageUser==''){
            $this->response(200,"Error044","La etiqueta imageUser esta vacia");
            exit;
        }


    $path = "uploadFotos/img_perfil_".$obj->rutUsuario.".jpg";
    file_put_contents($path,base64_decode($obj->imageUser));

    $db = new bdRcv();
    $respuesta=$db->InsertImageUser($obj->rutUsuario,$path);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post

if($_GET['action']=='InsertLogIngreso'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{


        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
            exit;
        }

        if(!isset($obj->tipoApp)){
            $this->response(200,"Error016","No se agrego la etiqueta tipoApp");
            exit;
        }
        if($obj->tipoApp==''){
            $this->response(200,"Error017","La etiqueta tipoApp esta vacia");
            exit;
        }
        if(!isset($obj->DateTime)){
            $this->response(200,"Error045","No se agrego la etiqueta DateTime");
            exit;
        }
        if($obj->DateTime==''){
            $this->response(200,"Error046","La etiqueta DateTime esta vacia");
            exit;
        }

    $db = new bdRcv();
    $respuesta=$db->InsertLogIngreso($obj->rutUsuario,$obj->tipoApp,$obj->DateTime);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post

if($_GET['action']=='UpdateMetafora'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{


        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
            exit;
        }

        if(!isset($obj->tipoApp)){
            $this->response(200,"Error016","No se agrego la etiqueta tipoApp");
            exit;
        }
        if($obj->tipoApp==''){
            $this->response(200,"Error017","La etiqueta tipoApp esta vacia");
            exit;
        }
        if(!isset($obj->idMetafora)){
            $this->response(200,"Error047","No se agrego la etiqueta idMetafora");
            exit;
        }
        if($obj->idMetafora==''){
            $this->response(200,"Error048","La etiqueta idMetafora esta vacia");
            exit;
        }

    $db = new bdRcv();
    $respuesta=$db->updateMetafora($obj->tipoApp,$obj->rutUsuario,$obj->idMetafora);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se updateo De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post


if($_GET['action']=='InsertNewResultTest'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{

        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
            exit;
        }




        if(!isset($obj->preguntas)){
            $this->response(200,"Error049","No se agrego la etiqueta preguntas");
            exit;
        }
        if($obj->preguntas==''){
            $this->response(200,"Error050","La etiqueta preguntas esta vacia");
            exit;
        }
        if(!isset($obj->fecha)){
            $this->response(200,"Error035","No se agrego la etiqueta fecha");
            exit;
        }
        if($obj->fecha==''){
            $this->response(200,"Error036","La etiqueta fecha esta vacia");
            exit;
        }




    $db = new bdRcv();
    $respuesta=$db->InsertNewResultTest($obj->rutUsuario,$obj->preguntas,$obj->fecha);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post


if($_GET['action']=='InsertNewLogro'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error 002","No se agrego JSON");
    }else{

        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
            exit;
        }




        if(!isset($obj->porcentajeSolicitado)){
            $this->response(200,"Error051","No se agrego la etiqueta porcentajeSolicitado");
            exit;
        }
        if($obj->porcentajeSolicitado==''){
            $this->response(200,"Error052","La etiqueta porcentajeSolicitado esta vacia");
            exit;
        }

        if(!isset($obj->porcentajeObtenido)){
            $this->response(200,"Error053","No se agrego la etiqueta porcentajeObtenido");
            exit;
        }
        if($obj->porcentajeObtenido==''){
            $this->response(200,"Error054","La etiqueta porcentajeObtenido esta vacia");
            exit;
        }

      $NumeroCigOmin=0;
        if($obj->tipoApp=='tabaquismo'){
          if(!isset($obj->cigarrosDisminuidos)){
              $this->response(200,"Error055","No se agrego la etiqueta cigarrosDisminuidos");
              exit;
          }
          if($obj->cigarrosDisminuidos==''){
              $this->response(200,"Error056","La etiqueta cigarrosDisminuidos esta vacia");
              exit;
          }
          $NumeroCigOmin=$obj->cigarrosDisminuidos;
        }else if($obj->tipoApp=='sedentarismo'){
          if(!isset($obj->minutosAumentados)){
              $this->response(200,"Error057","No se agrego la etiqueta minutosAumentados");
              exit;
          }
          if($obj->minutosAumentados==''){
              $this->response(200,"Error058","La etiqueta minutosAumentados esta vacia");
              exit;
          }
          $NumeroCigOmin=$obj->minutosAumentados;
        }

        if(!isset($obj->nombreElemento)){
            $this->response(200,"Error059","No se agrego la etiqueta nombreElemento");
            exit;
        }
        if($obj->nombreElemento==''){
            $this->response(200,"Error060","La etiqueta nombreElemento esta vacia");
            exit;
        }

        if(!isset($obj->idMetafora)){
            $this->response(200,"Error047","No se agrego la etiqueta idMetafora");
            exit;
        }
        if($obj->idMetafora==''){
            $this->response(200,"Error048","La etiqueta idMetafora esta vacia");
            exit;
        }


        if(!isset($obj->tipoApp)){
            $this->response(200,"Error016","No se agrego la etiqueta tipoApp");
            exit;
        }
        if($obj->tipoApp==''){
            $this->response(200,"Error017","La etiqueta tipoApp esta vacia");
            exit;
        }

        if(!isset($obj->fecha)){
            $this->response(200,"Error035","No se agrego la etiqueta fecha");
            exit;
        }
        if($obj->fecha==''){
            $this->response(200,"Error036","La etiqueta fecha esta vacia");
            exit;
        }




    $db = new bdRcv();
    $respuesta=$db->InsertNewLogro($obj->rutUsuario,$obj->porcentajeSolicitado,$obj->porcentajeObtenido,$NumeroCigOmin,$obj->nombreElemento,$obj->idMetafora,$obj->tipoApp,$obj->fecha);
    $db2 = new bdRcv();
    $db2->updateMetafora($obj->tipoApp,$obj->rutUsuario,$obj->idMetafora);
    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se inserto De Forma Correcta");
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post

if($_GET['action']=='UpdateInfoUser'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{

        if(!isset($obj->edadUsuario)){
            $this->response(200,"Error001","No se agrego la etiqueta edadUsuario");
            exit;
        }
        if (!ctype_digit($obj->edadUsuario)) {
            $this->response(200,"Error002","La etiqueta edadUsuario debe tomar valor numerico");
            exit;
        }
        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
            exit;
        }

        if(!isset($obj->nombreUsuario)){
            $this->response(200,"Error006","No se agrego la etiqueta nombreUsuario");
            exit;
        }
        if($obj->nombreUsuario==''){
            $this->response(200,"Error007","La etiqueta nombreUsuario esta vacia");
            exit;
        }
        if(!isset($obj->apellidoUsuario)){
            $this->response(200,"Error008","No se agrego la etiqueta correoUsuario");
            exit;
        }
        if($obj->apellidoUsuario==''){
            $this->response(200,"Error009","La etiqueta correoUsuario esta vacia");
            exit;
        }
        if(!isset($obj->passwordUsuario)){
            $this->response(200,"Error010","No se agrego la etiqueta contrasenaUsuario");
            exit;
        }
        if($obj->passwordUsuario==''){
            $this->response(200,"Error011","La etiqueta contrasenaUsuario esta vacia");
            exit;
        }



    $db = new bdRcv();
    $respuesta=$db->UpdateInfoUser($obj->edadUsuario,$obj->rutUsuario,$obj->nombreUsuario,$obj->apellidoUsuario,$obj->passwordUsuario);

    if($respuesta['Estado']=='success'){
        $this->response(200,"success","Se Actualizó De Forma Correcta");
    }else{
      $this->response(200,"Error00",$respuesta['Response']);
      exit;
    }
} //elseemtyarreglo


exit;
}//CIERRA post

if($_GET['action']=='GetQuestionTest'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{


        if(!isset($obj->tipoApp)){
            $this->response(200,"Error016","No se agrego la etiqueta tipoApp");
            exit;
        }
        if($obj->tipoApp==''){
            $this->response(200,"Error017","La etiqueta tipoApp esta vacia");
            exit;
        }


    $db = new bdRcv();
    $respuesta = $db->GetTest($obj->tipoApp);
    if($respuesta['Estado']=='success'){
        $this->response(200,"success",$respuesta['Response']);
    }else{
      $this->response(200,"Error00",$respuesta['Response']);
      exit;
    }

} //elseemtyarreglo


exit;
}



    if($_GET['action']=='GetInfoUser'){
        $obj = json_decode( file_get_contents('php://input') );
        $objArr = (array)$obj;
        if (empty($objArr)){
            $this->response(200,"Error000","No se agrego JSON");
        }else{


            if(!isset($obj->rutUsuario)){
                $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
                exit;
            }
            if($obj->rutUsuario==''){
                $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
                exit;
            }

            if(!isset($obj->password)){
                $this->response(200,"Error016","No se agrego el password");
                exit;
            }
            if($obj->password==''){
                $this->response(200,"Error017","El password esta vacio");
                exit;
            }



        $db = new bdRcv();
        $respuesta = $db->GetInfoUser($obj->rutUsuario,$obj->password);
        if($respuesta['Estado']=='success'){
            $this->response(200,"success",$respuesta['Response']);
        }else{
          $this->response(200,"Error00",$respuesta['Response']);
          exit;
        }

    } //elseemtyarreglo
exit;
}//CIERRA ACTION


if($_GET['action']=='GetMetasUser'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{

        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error00","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error01","La etiqueta rutUsuario esta vacia");
            exit;
        }




    $db = new bdRcv();
    $respuesta = $db->GetMetasUser($obj->rutUsuario);
    if($respuesta['Estado']=='success'){
        $this->response(200,"success",$respuesta['Response']);
    }else if($respuesta['Estado']=='NoData'){
      $this->response(200,"NoData",$respuesta['Response']);
    }else{
      $this->response(200,"Error00",$respuesta['Response']);
      exit;
    }

} //
exit;
}//CIERRA ACTION



if($_GET['action']=='GetMetasUser'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{

        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error00","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error01","La etiqueta rutUsuario esta vacia");
            exit;
        }




    $db = new bdRcv();
    $respuesta = $db->GetMetasUser($obj->rutUsuario);
    if($respuesta['Estado']=='success'){
        $this->response(200,"success",$respuesta['Response']);
    }else if($respuesta['Estado']=='NoData'){
      $this->response(200,"NoData",$respuesta['Response']);
    }else{
      $this->response(200,"Error00",$respuesta['Response']);
      exit;
    }

} //elseemtyarreglo
exit;
}//CIERRA ACTION

if($_GET['action']=='GetDesafiosUser'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{

        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error00","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error01","La etiqueta rutUsuario esta vacia");
            exit;
        }




    $db = new bdRcv();
    $respuesta = $db->GetDesafiosUser($obj->rutUsuario);
    if($respuesta['Estado']=='success'){
        $this->response(200,"success",$respuesta['Response']);
    }else if($respuesta['Estado']=='NoData'){
      $this->response(200,"NoData",$respuesta['Response']);
    }else{
      $this->response(200,"Error00",$respuesta['Response']);
      exit;
    }

} //elseemtyarreglo
exit;
}//CIERRA ACTION


////
if($_GET['action']=='GetSocial'){
  $obj = json_decode( file_get_contents('php://input') );
  $objArr = (array)$obj;
  if (empty($objArr)){
      $this->response(200,"Error000","No se agrego JSON");
  }else{
    if(!isset($obj->rutUsuario)){
        $this->response(200,"Error00","No se agrego la etiqueta rutUsuario");
        exit;
    }
    if($obj->rutUsuario==''){
        $this->response(200,"Error01","La etiqueta rutUsuario esta vacia");
        exit;
    }


    $db = new bdRcv();
    $respuesta = $db->GetSocial($obj->rutUsuario);
    if($respuesta['Estado']=='success'){
        $this->response(200,"success",$respuesta['Response']);
    }else if($respuesta['Estado']=='NoData'){
      $this->response(200,"NoData",$respuesta['Response']);
    }else{
      $this->response(200,"Error00",$respuesta['Response']);
      exit;
    }

} //elseemtyarreglo
exit;
}//CIERRA ACTION


//


if($_GET['action']=='GetTipoReaccion'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error000","No se agrego JSON");
    }else{

        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error00","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error01","La etiqueta rutUsuario esta vacia");
            exit;
        }

        if(!isset($obj->idPublicacion)){
            $this->response(200,"Error00","No se agrego la etiqueta idPublicacion");
            exit;
        }
        if($obj->idPublicacion==''){
            $this->response(200,"Error01","La etiqueta idPublicacion esta vacia");
            exit;
        }



    $db = new bdRcv();
    $respuesta = $db->GetTipoReaccion($obj->rutUsuario,$obj->idPublicacion);
    if($respuesta['Estado']=='success'){
        $this->response(200,"success",$respuesta['Response']);
    }else if($respuesta['Estado']=='NoData'){
      $this->response(200,"NoData",$respuesta['Response']);
    }else{
      $this->response(200,"Error00",$respuesta['Response']);
      exit;
    }

} //elseemtyarreglo
exit;
}//CIERRA ACTION



if($_GET['action']=='GetLogrosUser'){
    $obj = json_decode( file_get_contents('php://input') );
    $objArr = (array)$obj;
    if (empty($objArr)){
        $this->response(200,"Error 000","No se agrego JSON");
    }else{


        if(!isset($obj->rutUsuario)){
            $this->response(200,"Error003","No se agrego la etiqueta rutUsuario");
            exit;
        }
        if($obj->rutUsuario==''){
            $this->response(200,"Error004","La etiqueta rutUsuario esta vacia");
            exit;
        }


        if(!isset($obj->tipoApp)){
            $this->response(200,"Error016","No se agrego la etiqueta tipoApp");
            exit;
        }
        if($obj->tipoApp==''){
            $this->response(200,"Error017","La etiqueta tipoApp esta vacia");
            exit;
        }


    $db = new bdRcv();
    $respuesta = $db->GetLogrosUser($obj->rutUsuario,$obj->tipoApp);
    if($respuesta['Estado']=='success'){
        $this->response(200,"success",$respuesta['Response']);
    }else if($respuesta['Estado']=='NoData'){
      $this->response(200,"NoData",$respuesta['Response']);
    }else{
      $this->response(200,"Error999",$respuesta['Response']);
      exit;
    }

} //elseemtyarreglo
exit;
}//CIERRA ACTION

$this->response(400);
}//CIERRA postRCV


}





function getRCV(){
       if($_GET['action']=='GetInfoAllUserTabaquismo'){
            $db = new bdRcv();
           $respuesta = $db->GetInfoAllUserTabaquismo();



           if($respuesta['Estado']=='success'){
               $this->response(200,"success",$respuesta['Response']);
           }else{
             $this->response(200,"Error999",$respuesta['Response']);
             exit;
           }
     }else{
            $this->response(400);
     }

     if($_GET['action']=='GetInfoAllUserSedentarismo'){
          $db = new bdRcv();
         $respuesta = $db->GetInfoAllUserSedentarismo();

         if($respuesta['Estado']=='success'){
             $this->response(200,"success",$respuesta['Response']);
         }else{
           $this->response(200,"Error999",$respuesta['Response']);
           exit;
         }
   }else{
          $this->response(400);
   }

   if($_GET['action']=='GetInfoAllUserBienestApp'){
        $db = new bdRcv();
       $respuesta = $db->GetInfoAllUserBienestApp();

       if($respuesta['Estado']=='success'){
           $this->response(200,"success",$respuesta['Response']);
       }else{
         $this->response(200,"Error999",$respuesta['Response']);
         exit;
       }
 }else{
        $this->response(400);
 }



 if($_GET['action']=='GetAllLogros'){

     $db = new bdRcv();
     $respuesta = $db->GetAllLogros();
     if($respuesta['Estado']=='success'){
         $this->response(200,"success",$respuesta['Response']);
     }else if($respuesta['Estado']=='NoData'){
       $this->response(200,"NoData",$respuesta['Response']);
     }else{
       $this->response(200,"Error00",$respuesta['Response']);
       exit;
     }

 //} //elseemtyarreglo
 exit;
 }//CIERRA ACTION

 if($_GET['action']=='GetReaccionPost'){

     $db = new bdRcv();
     $respuesta = $db->GetReaccionPost();
     if($respuesta['Estado']=='success'){
         $this->response(200,"success",$respuesta['Response']);
     }else if($respuesta['Estado']=='NoData'){
       $this->response(200,"NoData",$respuesta['Response']);
     }else{
       $this->response(200,"Error00",$respuesta['Response']);
       exit;
     }


 exit;
 }//CIERRA ACTION

 if($_GET['action']=='GetAllMonumentos'){

     $db = new bdRcv();
     $respuesta = $db->GetAllMonumentos();
     if($respuesta['Estado']=='success'){
         $this->response(200,"success",$respuesta['Response']);
     }else if($respuesta['Estado']=='NoData'){
       $this->response(200,"NoData",$respuesta['Response']);
     }else{
       $this->response(200,"Error00",$respuesta['Response']);
       exit;
     }


 exit;
 }//CIERRA ACTION

}

}//CIERRA bdRcv
?>
