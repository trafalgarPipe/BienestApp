<?php
error_reporting(0);
class bdRcv {

    protected $mysqli;
    const LOCALHOST = 'nodclous.com';
    const USER = 'nodclous_puerto';
    const PASSWORD = 'Nodclous0558';
    const DATABASE = 'nodclous_bienestapp';
    const PORT = 3306;

    public function __construct() {
        try{
            //conexión a base de datos
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE,self::PORT);
        }catch (mysqli_sql_exception $e){
            //Si no se puede realizar la conexión
            http_response_code(500);
            exit;
        }
    }


    public function InsertNewUser($rutUsuario,$nombreUsuario,$apellidoUsuario,$edadUsuario,$sexoUsuario,$ocupacionUsuario,$passwordUsuario){
            $respuesta =Array();
            $none = "none";
            if(!$this->checkRut($rutUsuario)){
            $query="INSERT INTO usuario(run_usuario,nombre_usuario,apellido_usuario,edad_usuario,sexo_usuario,ocupacion_usuario,password_usuario) VALUES (?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE nombre_usuario = VALUES(nombre_usuario), apellido_usuario = VALUES(apellido_usuario), edad_usuario= VALUES(edad_usuario), password_usuario= VALUES(password_usuario)";
          if( $stmt = $this->mysqli->prepare($query)){
            $nombreUsuario=utf8_decode($nombreUsuario);
            $apellidoUsuario=utf8_decode($apellidoUsuario);
            $passwordUsuario=utf8_decode($passwordUsuario);
            $stmt->bind_param('ississs',$rutUsuario,$nombreUsuario,$apellidoUsuario,$edadUsuario,$sexoUsuario,$ocupacionUsuario,$passwordUsuario);
            $r = $stmt->execute();

            $respuesta= array('Estado' =>"success" ,
                              'Response'=>$r );
            $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }



          }else{
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>"El rut ingresado ya fue registrado" );
          }
            return $respuesta;
    }

    public function InsertNewMonumento($rutUsuario){
            $respuesta =Array();

            $query="INSERT INTO monumento(nivel_monumento,puntaje_monumento,run_usuario_fk,id_logro_fk,enviado_monumento) VALUES (1,0,?,2,0)";
          if( $stmt = $this->mysqli->prepare($query)){

            $stmt->bind_param('i',$rutUsuario);
            $r = $stmt->execute();

            $respuesta= array('Estado' =>"success" ,
                              'Response'=>$r );
            $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }


            return $respuesta;
    }



    public function InsertNewMeta($rutUsuario,$idMeta,$nombreMeta,$descripcionMeta,$duracionMeta,$duracionReal,$resultadoMeta,$responsabilidadMeta,$ambitoVidaMeta,$mejoraMeta,$estadoMeta,$progresoMeta,$enviado,$fechaMeta,$compartida,$puntajeMeta,$puntajeMetaSocial) {
            $respuesta =Array();

            $query="INSERT INTO meta(id_meta,nombre_meta,descripcion_meta,duracion_meta,duracion_meta_real,resultado_meta,responsabilidad_meta,ambito_vida_meta,mejora_meta,estado_meta,progreso_meta,enviado_meta,run_usuario_fk,fecha_meta,meta_compartida,puntaje_meta,puntaje_meta_social) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE nombre_meta = VALUES(nombre_meta),
            descripcion_meta= VALUES(descripcion_meta), duracion_meta= VALUES(duracion_meta),duracion_meta_real= VALUES(duracion_meta_real),resultado_meta= VALUES(resultado_meta),responsabilidad_meta= VALUES(responsabilidad_meta),ambito_vida_meta= VALUES(ambito_vida_meta),mejora_meta= VALUES(mejora_meta),estado_meta= VALUES(estado_meta),
           progreso_meta = VALUES(progreso_meta),enviado_meta = VALUES(enviado_meta),fecha_meta = VALUES(fecha_meta),meta_compartida = VALUES(meta_compartida),puntaje_meta = VALUES(puntaje_meta),puntaje_meta_social = VALUES(puntaje_meta_social)";

          if( $stmt = $this->mysqli->prepare($query)){
            $nombreMeta=utf8_decode($nombreMeta);
            $descripcionMeta=utf8_decode($descripcionMeta);
            $stmt->bind_param('isssssiiiiiiisiii',$idMeta,$nombreMeta,$descripcionMeta,$duracionMeta,$duracionReal,$resultadoMeta,$responsabilidadMeta,$ambitoVidaMeta,$mejoraMeta,$estadoMeta,$progresoMeta,$enviado,$rutUsuario,$fechaMeta,$compartida,$puntajeMeta,$puntajeMetaSocial);
            $r = $stmt->execute();
            $respuesta= array('Estado' =>"success" ,
            'Response'=>$r );
            $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }

            return $respuesta;
    }

    public function InsertNewDesafio($rutUsuario,$idDesafio,$nombreDesafio,$descripcionDesafio,$dificultadInicial,$dificultadFinal,$resultadoDesafio,$responsabilidadDesafio,$ambitoVidaDesafio,$mejoraDesafio,$estadoDesafio,$enviado,$idMeta_fk,$puntajeDesafio) {
            $respuesta =Array();

            $query="INSERT INTO desafio(id_desafio,nombre_desafio,descripcion_desafio,dificultad_i,dificultad_f,resultado_desafio,responsabilidad_desafio,ambito_vida_desafio,mejora_desafio,estado_desafio,enviado_desafio,id_meta_fk,run_usuario_fk,puntaje_desafio) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE nombre_desafio = VALUES(nombre_desafio), descripcion_desafio= VALUES(descripcion_desafio),
             dificultad_i= VALUES(dificultad_i), dificultad_f= VALUES(dificultad_f), resultado_desafio = VALUES(resultado_desafio),responsabilidad_desafio = VALUES(responsabilidad_desafio),ambito_vida_desafio = VALUES(ambito_vida_desafio),mejora_desafio = VALUES(mejora_desafio),estado_desafio = VALUES(estado_desafio),enviado_desafio = VALUES(enviado_desafio),puntaje_desafio = VALUES(puntaje_desafio)";

          if($stmt = $this->mysqli->prepare($query)){
            $nombreDesafio=utf8_decode($nombreDesafio);
            $descripcionDesafio=utf8_decode($descripcionDesafio);
            $stmt->bind_param('issiisiiiiiiii',$idDesafio,$nombreDesafio,$descripcionDesafio,$dificultadInicial,$dificultadFinal,$resultadoDesafio,$responsabilidadDesafio,$ambitoVidaDesafio,$mejoraDesafio,$estadoDesafio,$enviado,$idMeta_fk,$rutUsuario,$puntajeDesafio);
            $r = $stmt->execute();
            $respuesta= array('Estado' =>"success" ,
            'Response'=>$r );
            $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }

            return $respuesta;
    }

    public function InsertNewSocial($rutUsuario,$tituloPublicacion,$bodyPublicacion,$reaccion1,$reaccion2,$reaccion3,$idMeta_fk,$fechaPost) {
            $respuesta =Array();

            $query="INSERT INTO publicacion(titulo_publicacion,body_publicacion,reaccion1,reaccion2,reaccion3,run_usuario_fk,id_meta_fk,fecha_post) VALUES (?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE reaccion1 = VALUES(reaccion1), reaccion2= VALUES(reaccion2), reaccion3= VALUES(reaccion3), fecha_post= VALUES(fecha_post)";

          if( $stmt = $this->mysqli->prepare($query)){
            $tituloPublicacion=utf8_decode($tituloPublicacion);
            $bodyPublicacion=utf8_decode($bodyPublicacion);
            $stmt->bind_param('ssiiiiis',$tituloPublicacion,$bodyPublicacion,$reaccion1,$reaccion2,$reaccion3,$rutUsuario,$idMeta_fk,$fechaPost);
            $r = $stmt->execute();
            $respuesta= array('Estado' =>"success" ,
            'Response'=>$r );
            $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }

            return $respuesta;
    }

    public function UpdateReaccionSocial($idPublicacion,$reaccionPublicacion,$oldReaccionPublicacion) {
            $respuesta =Array();

          $query="UPDATE publicacion SET $reaccionPublicacion = $reaccionPublicacion+1, $oldReaccionPublicacion = $oldReaccionPublicacion-1 WHERE  id_publicacion=?;";

          if( $stmt = $this->mysqli->prepare($query)){

            $stmt->bind_param('i',$idPublicacion);
            $r = $stmt->execute();
            $respuesta= array('Estado' =>"success" ,
            'Response'=>$r );
            $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }

            return $respuesta;

    }

    public function UpdatePost($rutUsuario,$idMeta) {
            $respuesta =Array();

          $query="UPDATE publicacion SET estado_post = 0 WHERE run_usuario_fk = ? AND id_meta_fk = ?";

          if( $stmt = $this->mysqli->prepare($query)){

            $stmt->bind_param('ii',$rutUsuario,$idMeta);
            $r = $stmt->execute();
            $respuesta= array('Estado' =>"success" ,
            'Response'=>$r );
            $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }

            return $respuesta;

    }

    public function UpdateMonumento($idMonumento,$nivelMonumento,$puntajeMonumento,$rutUsuario_fk,$idLogro_fk,$enviado) {
            $respuesta =Array();

          $query="UPDATE monumento SET nivel_monumento = ?, puntaje_monumento = ?, id_logro_fk = ?, enviado_monumento = ? WHERE id_monumento=?;";

          if( $stmt = $this->mysqli->prepare($query)){

            $stmt->bind_param('iiiii',$nivelMonumento,$puntajeMonumento,$idLogro_fk,$enviado,$idMonumento);
            $r = $stmt->execute();
            $respuesta= array('Estado' =>"success" ,
            'Response'=>$r );
            $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }

            return $respuesta;

    }

    public function UpdateNewReaccionSocial($idPublicacion,$reaccionPublicacion) {
            $respuesta =Array();

          $query="UPDATE publicacion SET $reaccionPublicacion = $reaccionPublicacion+1 WHERE  id_publicacion=?;";

          if( $stmt = $this->mysqli->prepare($query)){

            $stmt->bind_param('i',$idPublicacion);
            $r = $stmt->execute();
            $respuesta= array('Estado' =>"success" ,
            'Response'=>$r );
            $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }

            return $respuesta;

    }


    public function InsertReaccionSocial($idPublicacion,$rutUsuario,$reaccion) {
            $respuesta =Array();


            $query="UPDATE usuario_publicacion SET reaccion_usuario =? WHERE  id_publicacion_fk=? AND run_usuario_fk = ?";


          if( $stmt = $this->mysqli->prepare($query)){
            $stmt->bind_param('iii',$reaccion,$idPublicacion,$rutUsuario);
            $r = $stmt->execute();

            $respuesta= array('Estado' =>"success" ,
                              'Response'=>$r );
                              $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }


            return $respuesta;
    }

    public function InsertNewReaccionSocial($idPublicacion,$rutUsuario,$reaccion) {
            $respuesta =Array();


            $query="INSERT INTO usuario_publicacion(run_usuario_fk,id_publicacion_fk,reaccion_usuario) VALUES (?,?,?) ON DUPLICATE KEY UPDATE reaccion_usuario = VALUES(reaccion_usuario)";


          if( $stmt = $this->mysqli->prepare($query)){
            $stmt->bind_param('iii',$rutUsuario,$idPublicacion,$reaccion);
            $r = $stmt->execute();

            $respuesta= array('Estado' =>"success" ,
                              'Response'=>$r );
                              $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }


            return $respuesta;
    }

    public function InsertNewLogro($rutUsuario,$porcentajeSolicitado,$porcentajeObtenido,$NumeroCigOmin,$nombreElemento,$idMetafora,$tipoApp,$fecha) {
            $respuesta =Array();

            if($tipoApp=='tabaquismo'){
              $query="INSERT INTO LogrosUsuario(tipoApp,fechaLogro,rutUsuario_fk,porcentajeSolicitado,porcentajeObtenido,cigarrosDisminuidos,nombreElemento,idMetafora) VALUES (?,?,?,?,?,?,?,?)";

            }else if($tipoApp=='sedentarismo'){
              $query="INSERT INTO LogrosUsuario(tipoApp,fechaLogro,rutUsuario_fk,porcentajeSolicitado,porcentajeObtenido,minutosAumentados,nombreElemento,idMetafora) VALUES (?,?,?,?,?,?,?,?)";

            }

          if( $stmt = $this->mysqli->prepare($query)){
            $nombreElemento = utf8_decode($nombreElemento);
            $stmt->bind_param('sssddisi',$tipoApp,$fecha,$rutUsuario,$porcentajeSolicitado,$porcentajeObtenido,$NumeroCigOmin,$nombreElemento,$idMetafora);
            $r = $stmt->execute();

            $respuesta= array('Estado' =>"success" ,
                              'Response'=>$r );
                              $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }


            return $respuesta;
    }

    public function InsertLogIngreso($rutUsuario,$tipoApp,$DateTime) {
            $respuesta =Array();

              $query="INSERT INTO LogIngreso(DatetimeIngreso,rutUsuario_fk,tipoApp) VALUES (?,?,?)";


          if( $stmt = $this->mysqli->prepare($query)){

            $stmt->bind_param('sss',$DateTime,$rutUsuario,$tipoApp);
            $r = $stmt->execute();

            $respuesta= array('Estado' =>"success" ,
                              'Response'=>$r );
                              $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }


            return $respuesta;
    }

    public function updateMetafora($tipoApp,$rutUsuario,$idMetafora){

      if($tipoApp=='tabaquismo'){
        $query="UPDATE InfoTabaquismo SET imgMetafora = ? WHERE  rutUsuario_fk=?;";
      }else if($tipoApp=='sedentarismo'){
        $query="UPDATE InfoSedentarismo SET imgMetafora = ? WHERE  rutUsuario_fk=?;";
      }

      if( $stmt = $this->mysqli->prepare($query)){
        $stmt->bind_param('is',$idMetafora,$rutUsuario);
        $r = $stmt->execute();
        $respuesta= array('Estado' =>"success" ,
                          'Response'=>$r );
        $stmt->close();
      }  else {
        $Error = "Error: ".$this->mysqli->error." query : ".$query;
        $respuesta= array('Estado' =>"Error" ,
                          'Response'=>$Error );

      }
      return $respuesta;
    //  echo "respuesta : ". var_dump($respuesta);
    }


    public function InsertImageUser($rutUsuario,$imageUser) {
            $respuesta =Array();


            $query="UPDATE usuario SET imagen_usuario = ? WHERE  run_usuario=?;";
          if( $stmt = $this->mysqli->prepare($query)){

            $stmt->bind_param('si',$imageUser,$rutUsuario);
            $r = $stmt->execute();

            $respuesta= array('Estado' =>"success" ,
                              'Response'=>$r );
            $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }


            return $respuesta;
    }

    public function InsertNewResultTest($rutUsuario,$preguntas,$fecha) {
            $respuesta =Array();
            $listo=0;
            json_encode($preguntas);
            //echo "preguntas : ".json_encode($preguntas);
            foreach ($preguntas as $detalle){
              $idPregunta = $detalle->idPregunta;
              $idRespuesta = $detalle->idRespuesta;

            //  echo "\n idPregunta ".$idPregunta." - idRespuesta ".$idRespuesta;

                $query="INSERT INTO ResultadoTest(rutUsuario_fk,idRespuestaTest_fk,idPreguntasTest_fk,fechaResultado) VALUES (?,?,?,?)";

                if( $stmt = $this->mysqli->prepare($query)){

                  $stmt->bind_param('siis',$rutUsuario,$idRespuesta,$idPregunta,$fecha);
                  $r = $stmt->execute();
                  $listo=1;
                  $respuesta= array('Estado' =>"success" ,
                                          'Response'=>$r );
                  $stmt->close();
                }else{
                  $Error = "Error: ".$this->mysqli->error." query : ".$query;
                  $respuesta= array('Estado' =>"Error" ,
                                    'Response'=>$Error );
                }
            }

            return $respuesta;
    }

    public function UpdateInfoUser($edadUsuario,$rutUsuario,$nombreUsuario,$apellidoUsuario,$passwordUsuario) {
            $respuesta =Array();



            $query="UPDATE usuario SET nombre_usuario = ?,apellido_usuario = ?,edad_usuario = ?,password_usuario = ? WHERE  run_usuario=?;";
          if( $stmt = $this->mysqli->prepare($query)){
            $nombreUsuario=utf8_decode($nombreUsuario);
            $apellidoUsuario=utf8_decode($apellidoUsuario);
            $stmt->bind_param('ssisi',$nombreUsuario,$apellidoUsuario,$edadUsuario,$passwordUsuario,$rutUsuario);
            $r = $stmt->execute();

            $respuesta= array('Estado' =>"success" ,
                              'Response'=>$r );
            $stmt->close();
          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }


            return $respuesta;
    }

    public function GetInfoUser($rutUsuario,$password) {

      $datosUsuario =  Array();
      $respuesta = Array();


          $query="SELECT * FROM usuario WHERE run_usuario = ? AND password_usuario = ?";


            if($stmt = $this->mysqli->prepare($query)){

                  $stmt->bind_param('is',$rutUsuario,utf8_decode($password));
                  $r = $stmt->execute();

                    $stmt->bind_result($rutUsuario,$nombreUsuario,$apellidoUsuario,$edadUsuario,$sexoUsuario,$ocupacionUsuario,$password,$rutaImagen);

                    if($stmt->fetch()){

                      $numero=$stmt->num_rows;
                      $datosUsuario = array("rutUsuario"=>$rutUsuario,
                                "nombreUsuario"=>utf8_encode($nombreUsuario),
                                "apellidoUsuario"=>utf8_encode($apellidoUsuario),
                                "edadUsuario"=>$edadUsuario,
                                "sexoUsuario"=>$sexoUsuario,
                                "ocupacionUsuario"=>$ocupacionUsuario,
                                "passwordUsuario"=>utf8_encode($password),
                                "rutaImagen"=>$rutaImagen);

                    $respuesta= array('Estado' =>"success" ,
                                      'Response'=>$datosUsuario );


                    $stmt->close();


                  }else {
                    $Error = "Error: ".$this->mysqli->error." query : ".$query;
                    $respuesta= array('Estado' =>"Error" ,
                                      'Response'=>$Error );
                  }

      		}else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }

            return $respuesta;
    }

    public function GetInfoAllUserTabaquismo() {

      $datosUsuario =  Array();
      $respuesta = Array();
            $query="SELECT rutUsuario,nombreUsuario,correoUsuario,sexoUsuario,edadUsuario,passUsuario,carreraUsuario,testActivo,rutaImgUsuario,i.imgMetafora
from Usuario u inner join InfoTabaquismo i on i.rutUsuario_fk=u.rutUsuario group by u.rutUsuario ";

            if($stmt = $this->mysqli->prepare($query)){

            $r = $stmt->execute();


                $stmt->bind_result($rutUsuario,$nombreUsuario,$correoUsuario,$sexoUsuario,$edadUsuario,$passUsuario,$carreraUsuario,$testActivo,$rutaImgUsuario,$idMetafora);

              while ( $stmt->fetch()){
                if($idMetafora==null)$idMetafora=1;
                $imgBase64="none";
                if($rutaImgUsuario!="none")$imgBase64=base64_encode(file_get_contents($rutaImgUsuario));

                $datosUsuario[] = array("rutUsuario"=>$rutUsuario,
                          "nombreUsuario"=>utf8_encode($nombreUsuario),
                          "correoUsuario"=>$correoUsuario,
                          "sexoUsuario"=>$sexoUsuario,
                          "edadUsuario"=>$edadUsuario,
                          "passUsuario"=>$passUsuario,
                          "carreraUsuario"=>utf8_encode($carreraUsuario),
                          "testActivo"=>$testActivo,
                          "rutaImgUsuario"=> $rutaImgUsuario,
                          "imgBase64"=>$imgBase64,
                          "idMetafora"=>$idMetafora);

                          }
                  $respuesta= array('Estado' =>"success" ,
                                    'Response'=>$datosUsuario );

                  $stmt->close();

          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }

            return $respuesta;
    }

    public function GetInfoAllUserSedentarismo() {

      $datosUsuario =  Array();
      $respuesta = Array();
            $query="SELECT rutUsuario,nombreUsuario,correoUsuario,sexoUsuario,edadUsuario,passUsuario,carreraUsuario,testActivo,rutaImgUsuario,i.imgMetafora
from Usuario u inner join InfoSedentarismo i on i.rutUsuario_fk=u.rutUsuario group by u.rutUsuario ";

            if($stmt = $this->mysqli->prepare($query)){

            $r = $stmt->execute();


                $stmt->bind_result($rutUsuario,$nombreUsuario,$correoUsuario,$sexoUsuario,$edadUsuario,$passUsuario,$carreraUsuario,$testActivo,$rutaImgUsuario,$idMetafora);

              while ( $stmt->fetch()){
                if($idMetafora==null)$idMetafora=1;
                $imgBase64="none";
                if($rutaImgUsuario!="none")$imgBase64=base64_encode(file_get_contents($rutaImgUsuario));

                $datosUsuario[] = array("rutUsuario"=>$rutUsuario,
                          "nombreUsuario"=>utf8_encode($nombreUsuario),
                          "correoUsuario"=>$correoUsuario,
                          "sexoUsuario"=>$sexoUsuario,
                          "edadUsuario"=>$edadUsuario,
                          "passUsuario"=>$passUsuario,
                          "carreraUsuario"=>utf8_encode($carreraUsuario),
                          "testActivo"=>$testActivo,
                        "rutaImgUsuario"=> $rutaImgUsuario,
                        "imgBase64"=>$imgBase64,
                          "idMetafora"=>$idMetafora);

                          }
                  $respuesta= array('Estado' =>"success" ,
                                    'Response'=>$datosUsuario );

                  $stmt->close();

          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }

            return $respuesta;
    }

    public function GetInfoAllUserBienestApp() {

      $datosUsuario =  Array();
      $respuesta = Array();
      $query="SELECT run_usuario,nombre_usuario,apellido_usuario,edad_usuario,sexo_usuario,ocupacion_usuario,password_usuario,imagen_usuario FROM usuario";

            if($stmt = $this->mysqli->prepare($query)){

            $r = $stmt->execute();


                $stmt->bind_result($rutUsuario,$nombreUsuario,$apellidoUsuario,$edadUsuario,$sexoUsuario,$ocupacionUsuario,$passwordUsuario,$rutaImagen);

              while ( $stmt->fetch()){

                $imgBase64="none";
                if($rutaImagen!="none")$imgBase64=base64_encode(file_get_contents($rutaImagen));

                $datosUsuario[] = array("rutUsuario"=>$rutUsuario,
                          "nombreUsuario"=>utf8_encode($nombreUsuario),
                          "apellidoUsuario"=>utf8_encode($apellidoUsuario),
                          "sexoUsuario"=>$sexoUsuario,
                          "edadUsuario"=>$edadUsuario,
                          "passwordUsuario"=>utf8_encode($passwordUsuario),
                          "ocupacionUsuario"=>$ocupacionUsuario,
                          "imgBase64"=>$imgBase64,
                          "rutaImagen"=> $rutaImagen);
                          }
                  $respuesta= array('Estado' =>"success" ,
                                    'Response'=>$datosUsuario);

                  $stmt->close();

          }else{
            $Error = "Error: ".$this->mysqli->error." query : ".$query;
            $respuesta= array('Estado' =>"Error" ,
                              'Response'=>$Error );
          }

            return $respuesta;
    }

    public function GetMetasUser($rutUsuario){

          $query = "SELECT run_usuario_fk,id_meta,nombre_meta,descripcion_meta,duracion_meta,duracion_meta_real,resultado_meta,responsabilidad_meta,ambito_vida_meta,mejora_meta,estado_meta,progreso_meta,enviado_meta,fecha_meta,meta_compartida,puntaje_meta,puntaje_meta_social
                    FROM meta WHERE run_usuario_fk=? ORDER BY id_meta ASC";

                if($stmt = $this->mysqli->prepare($query)){

                $stmt->bind_param('i',$rutUsuario);
                $stmt->execute();
                $stmt->store_result();


                $stmt->bind_result($rutUsuario_fk,$idMeta,$nombreMeta,$descripcionMeta,$duracionMeta,$duracionReal,$resultadoMeta,$responsabilidadMeta,$ambitoVidaMeta,$mejoraMeta,$estadoMeta,$progresoMeta,$enviado,$fechaMeta,$compartida,$puntajeMeta,$puntajeMetaSocial);
                if(($stmt->num_rows)>0):
                  while ( $stmt->fetch()){
                    $datosMetas[] = array("rutUsuario_fk"=>$rutUsuario_fk,
                              "idMeta"=>$idMeta,
                              "nombreMeta"=>utf8_encode($nombreMeta),
                              "descripcionMeta"=>utf8_encode($descripcionMeta),
                              "duracionMeta"=>$duracionMeta,
                              "duracionReal"=>$duracionReal,
                              "resultadoMeta"=>$resultadoMeta,
                              "responsabilidadMeta"=>$responsabilidadMeta,
                              "ambitoVidaMeta"=>$ambitoVidaMeta,
                              "mejoraMeta"=>$mejoraMeta,
                              "estadoMeta"=>$estadoMeta,
                              "progreso"=>$progresoMeta,
                              "enviado"=>$enviado,
                              "fechaMeta"=>$fechaMeta,
                              "compartida"=>$compartida,
                              "puntajeMeta"=>$puntajeMeta,
                              "puntajeMetaSocial"=>$puntajeMetaSocial);

                              }
                              $respuesta= array('Estado' =>"success" ,
                                                'Response'=>$datosMetas);
                        else:
                                $respuesta= array('Estado' =>"NoData" ,
                                                    'Response'=>"No existen datos" );
                        endif;



                      $stmt->close();
              }else{
                $Error = "Error: ".$this->mysqli->error." query : ".$query;
                $respuesta= array('Estado' =>"Error" ,
                                  'Response'=>$Error );
              }

                return $respuesta;
    }

    public function GetDesafiosUser($rutUsuario){

          $query = "SELECT run_usuario_fk,id_desafio,nombre_desafio,descripcion_desafio,dificultad_i,dificultad_f,resultado_desafio,responsabilidad_desafio,ambito_vida_desafio,mejora_desafio,estado_desafio,enviado_desafio,id_meta_fk,puntaje_desafio
                    FROM desafio WHERE run_usuario_fk=? ORDER BY id_desafio ASC";

                if($stmt = $this->mysqli->prepare($query)){

                $stmt->bind_param('i',$rutUsuario);
                $stmt->execute();
                $stmt->store_result();


                $stmt->bind_result($rutUsuario_fk,$idDesafio,$nombreDesafio,$descripcionDesafio,$dificultadInicial,$dificultadFinal,$resultadoDesafio,$responsabilidadDesafio,$ambitoVidaDesafio,$mejoraDesafio,$estadoDesafio,$enviado,$idMeta_fk,$puntajeDesafio);
                if(($stmt->num_rows)>0):
                  while ( $stmt->fetch()){
                    $datosDesafios[] = array("rutUsuario_fk"=>$rutUsuario_fk,
                              "idDesafio"=>$idDesafio,
                              "nombreDesafio"=>utf8_encode($nombreDesafio),
                              "descripcionDesafio"=>utf8_encode($descripcionDesafio),
                              "dificultadInicial"=>$dificultadInicial,
                              "dificultadFinal"=>$dificultadFinal,
                              "responsabilidadDesafio"=>$responsabilidadDesafio,
                              "ambitoVidaDesafio"=>$ambitoVidaDesafio,
                              "mejoraDesafio"=>$mejoraDesafio,
                              "estadoDesafio"=>$estadoDesafio,
                              "resultadoDesafio"=>$resultadoDesafio,
                              "enviado"=>$enviado,
                              "idMeta_fk"=>$idMeta_fk,
                              "puntajeDesafio"=>$puntajeDesafio);

                              }
                              $respuesta= array('Estado' =>"success" ,
                                                'Response'=>$datosDesafios);
                        else:
                                $respuesta= array('Estado' =>"NoData" ,
                                                    'Response'=>"No existen datos" );
                        endif;



                      $stmt->close();
              }else{
                $Error = "Error: ".$this->mysqli->error." query : ".$query;
                $respuesta= array('Estado' =>"Error" ,
                                  'Response'=>$Error );
              }

                return $respuesta;
    }

    public function GetTipoReaccion($rutUsuario,$idPublicacion){

      $respuesta = Array();

          $query = "SELECT reaccion_usuario
                    FROM usuario_publicacion WHERE run_usuario_fk=? AND id_publicacion_fk=?;";

                if($stmt = $this->mysqli->prepare($query)){

                $stmt->bind_param('ii',$rutUsuario,$idPublicacion);
                $stmt->execute();
                $stmt->store_result();


                $stmt->bind_result($tipoReaccion);
                if($stmt->fetch()){
                  $datosReaccion = $tipoReaccion;
                  $respuesta= array('Estado' =>"success" ,
                                    'Response'=>$datosReaccion);



                      $stmt->close();
              }else{
                $Error = "Error: ".$this->mysqli->error." query : ".$query;
                $respuesta= array('Estado' =>"Error" ,
                                  'Response'=>$Error );
              }

                return $respuesta;
    }else {
      $Error = "Error: ".$this->mysqli->error." query : ".$query;
      $respuesta= array('Estado' =>"Error" ,
                        'Response'=>$Error );
    }
      return $respuesta;
    }

    public function GetReaccionPost(){

          $query = "SELECT id_reaccion_usuario,run_usuario_fk,reaccion_usuario,id_publicacion_fk
                    FROM usuario_publicacion";

                if($stmt = $this->mysqli->prepare($query)){


                $stmt->execute();
                $stmt->store_result();


                $stmt->bind_result($idReaccionUsuario,$rutUsuario,$reaccionUsuario,$idPublicacion);
                if(($stmt->num_rows)>0):
                  while ( $stmt->fetch()){
                    $datosDesafios[] = array(  "idReaccionUsuario"=>$idReaccionUsuario,
                                "rutUsuario"=>$rutUsuario,
                              "idPublicacion"=>$idPublicacion,
                              "reaccionUsuario"=>$reaccionUsuario);

                              }
                              $respuesta= array('Estado' =>"success" ,
                                                'Response'=>$datosDesafios);
                        else:
                                $respuesta= array('Estado' =>"NoData" ,
                                                    'Response'=>"No existen datos" );
                        endif;
                      $stmt->close();
              }else{
                $Error = "Error: ".$this->mysqli->error." query : ".$query;
                $respuesta= array('Estado' =>"Error" ,
                                  'Response'=>$Error );
              }

                return $respuesta;
    }

    public function GetSocial($rutUsuario){

      //    $query = "SELECT rut_usuario_fk,id_publicacion,titulo_publicacion,body_publicacion,reaccion1,reaccion2,reaccion3,id_meta_fk,fecha_post
        //            FROM publicacion ORDER BY fecha_post DESC";
          $query =  "SELECT run_usuario_fk,id_publicacion,titulo_publicacion,body_publicacion,reaccion1,reaccion2,reaccion3,id_meta_fk,fecha_post,estado_post FROM publicacion  WHERE estado_post = 1 UNION SELECT run_usuario_fk,id_publicacion,titulo_publicacion,body_publicacion,reaccion1,reaccion2,reaccion3,id_meta_fk,fecha_post,estado_post FROM publicacion WHERE run_usuario_fk = ? AND estado_post = 0 ORDER BY fecha_post DESC";
                if($stmt = $this->mysqli->prepare($query)){

                $stmt->bind_param('i',$rutUsuario);
                $stmt->execute();
                $stmt->store_result();


                $stmt->bind_result($rutUsuario_fk,$idPublicacion,$tituloPublicacion,$bodyPublicacion,$reaccion1,$reaccion2,$reaccion3,$idMeta_fk,$fechaPost,$estadoPost);
                if(($stmt->num_rows)>0):
                  while ( $stmt->fetch()){
                    $datosMetas[] = array("rutUsuario_fk"=>$rutUsuario_fk,
                              "idPublicacion"=>$idPublicacion,
                              "tituloPublicacion"=>utf8_encode($tituloPublicacion),
                              "bodyPublicacion"=>utf8_encode($bodyPublicacion),
                              "reaccion1"=>$reaccion1,
                              "reaccion2"=>$reaccion2,
                              "reaccion3"=>$reaccion3,
                              "idMeta_fk"=>$idMeta_fk,
                              "fechaPost"=>$fechaPost,
                              "estadoPost"=>$estadoPost);

                              }
                              $respuesta= array('Estado' =>"success" ,
                                                'Response'=>$datosMetas);
                        else:
                                $respuesta= array('Estado' =>"NoData" ,
                                                    'Response'=>"No existen datos" );
                        endif;



                      $stmt->close();
              }else{
                $Error = "Error: ".$this->mysqli->error." query : ".$query;
                $respuesta= array('Estado' =>"Error" ,
                                  'Response'=>$Error );
              }

                return $respuesta;
    }

    public function GetAllLogros(){

          $query = "SELECT id_logro,imagen_logro,nombre_logro,puntaje_logro
                    FROM logro ORDER BY id_logro ASC";

                if($stmt = $this->mysqli->prepare($query)){

                $stmt->bind_param();
                $stmt->execute();
                $stmt->store_result();


                $stmt->bind_result($idLogro,$imagenLogro,$nombreLogro,$puntajeLogro);
                if(($stmt->num_rows)>0):
                  while ( $stmt->fetch()){
                    $datosLogros[] = array("idLogro"=>$idLogro,
                              "imagenLogro"=>$imagenLogro,
                              "nombreLogro"=>utf8_encode($nombreLogro),
                              "puntajeLogro"=>$puntajeLogro);

                              }
                              $respuesta= array('Estado' =>"success" ,
                                                'Response'=>$datosLogros);
                        else:
                                $respuesta= array('Estado' =>"NoData" ,
                                                    'Response'=>"No existen datos" );
                        endif;



                      $stmt->close();
              }else{
                $Error = "Error: ".$this->mysqli->error." query : ".$query;
                $respuesta= array('Estado' =>"Error" ,
                                  'Response'=>$Error );
              }

                return $respuesta;
    }

    public function GetAllMonumentos(){

          $query = "SELECT id_monumento,nivel_monumento,puntaje_monumento,run_usuario_fk,id_logro_fk,enviado_monumento
                    FROM monumento ORDER BY id_monumento ASC";

                if($stmt = $this->mysqli->prepare($query)){

                $stmt->bind_param();
                $stmt->execute();
                $stmt->store_result();


                $stmt->bind_result($idMonumento,$nivelMonumento,$puntajeMonumento,$rutUsuario_fk,$idLogro_fk,$enviado);
                if(($stmt->num_rows)>0):
                  while ( $stmt->fetch()){
                    $datosMonumento[] = array("idMonumento"=>$idMonumento,
                              "nivelMonumento"=>$nivelMonumento,
                              "puntajeMonumento"=>$puntajeMonumento,
                              "rutUsuario_fk"=>$rutUsuario_fk,
                              "id_logro_fk"=>$idLogro_fk,
                              "enviado"=>$enviado);
                                          }
                              $respuesta= array('Estado' =>"success" ,
                                                'Response'=>$datosMonumento);
                        else:
                                $respuesta= array('Estado' =>"NoData" ,
                                                    'Response'=>"No existen datos" );
                        endif;



                      $stmt->close();
              }else{
                $Error = "Error: ".$this->mysqli->error." query : ".$query;
                $respuesta= array('Estado' =>"Error" ,
                                  'Response'=>$Error );
              }

                return $respuesta;
    }

    public function GetLogrosUser($rutUsuario,$tipoApp){

                if($tipoApp=='tabaquismo'){
                  $query = "SELECT rutUsuario_fk,fechaLogro,porcentajeSolicitado,porcentajeObtenido,cigarrosDisminuidos,nombreElemento,idMetafora
                            from LogrosUsuario where rutUsuario_fk=?
                            and fechaLogro between (select fechaInfo from InfoTabaquismo
                            where rutUsuario_fk=? order by fechaInfo desc LIMIT 1) and DATE(NOW()) ";

                }else if($tipoApp=='sedentarismo'){
                  $query = "SELECT rutUsuario_fk,fechaLogro,porcentajeSolicitado,porcentajeObtenido,minutosAumentados,nombreElemento,idMetafora
                            from LogrosUsuario where rutUsuario_fk=?
                            and fechaLogro between (select fechaInfo from InfoSedentarismo
                            where rutUsuario_fk=? order by fechaInfo desc LIMIT 1) and DATE(NOW()) ";
                }

                if($stmt = $this->mysqli->prepare($query)){

                $stmt->bind_param('ss',$rutUsuario,$rutUsuario);
                $r = $stmt->execute();
                  $stmt->store_result();
                      if($tipoApp=='tabaquismo'){
                $stmt->bind_result($rutUsuario_fk,$fechaLogro,$porcentajeSolicitado,$porcentajeObtenido,$cigarrosDisminuidos,$nombreElemento,$idMetafora);
                    if(($stmt->num_rows)>0):
                    while ( $stmt->fetch()){
                            $datosUsuario[] = array("rutUsuario_fk"=>$rutUsuario_fk,
                                      "fechaLogro"=>$fechaLogro,
                                      "porcentajeSolicitado"=>$porcentajeSolicitado,
                                      "porcentajeObtenido"=>$porcentajeObtenido,
                                      "cigarrosDisminuidos"=>$cigarrosDisminuidos,
                                      "nombreElemento"=>$nombreElemento,
                                      "idMetafora"=>$idMetafora);
                                      }
                          $respuesta= array('Estado' =>"success" ,
                                                'Response'=>$datosUsuario );
                else:
                          $respuesta= array('Estado' =>"NoData" ,
                                            'Response'=>"No existen datos" );
                endif;
              }else if($tipoApp=='sedentarismo'){

                $stmt->bind_param('ss',$rutUsuario,$rutUsuario);
                $r = $stmt->execute();
                  $stmt->store_result();

                $stmt->bind_result($rutUsuario_fk,$fechaLogro,$porcentajeSolicitado,$porcentajeObtenido,$minutosAumentados,$nombreElemento,$idMetafora);
                    if(($stmt->num_rows)>0):
                    while ( $stmt->fetch()){
                            $datosUsuario[] = array("rutUsuario_fk"=>$rutUsuario_fk,
                                      "fechaLogro"=>$fechaLogro,
                                      "porcentajeSolicitado"=>$porcentajeSolicitado,
                                      "porcentajeObtenido"=>$porcentajeObtenido,
                                      "minutosAumentados"=>$minutosAumentados,
                                      "nombreElemento"=>$nombreElemento,
                                      "idMetafora"=>$idMetafora);
                                      }
                          $respuesta= array('Estado' =>"success" ,
                                                'Response'=>$datosUsuario );
                else:
                          $respuesta= array('Estado' =>"NoData" ,
                                            'Response'=>"No existen datos" );
                endif;


              }
                $stmt->close();
            }else{
                $Error = "Error: ".$this->mysqli->error." query : ".$query;
                $respuesta= array('Estado' =>"Error" ,
                                  'Response'=>$Error );
              }

                return $respuesta;
    }

    public function GetTest($tipoApp_){

      $question = Array();
      $respuesta = Array();

      $query = "SELECT  idPreguntasTest,preguntaTest,idRespuestaTest,respuestaTest,puntajeRespuestaTest,tipoApp from PreguntaTest right join RespuestaTest on PreguntaTest.idPreguntasTest=RespuestaTest.idPreguntasTest_fk where tipoApp=? ";

      if($stmt = $this->mysqli->prepare($query)){

          $stmt->bind_param('s',$tipoApp_);
          $r = $stmt->execute();


          $stmt->bind_result($idPreguntasTest,$preguntaTest,$idRespuestaTest,$respuestaTest,$puntajeRespuestaTest,$tipoApp);


        while ( $stmt->fetch()){

          $question[] = array('idPreguntasTest' => $idPreguntasTest,
                              'preguntaTest' => utf8_encode($preguntaTest),
                              'idRespuestaTest' => $idRespuestaTest,
                              'respuestaTest' => utf8_encode($respuestaTest),
                              'puntajeRespuestaTest' => $puntajeRespuestaTest,
                              'tipoApp' => $tipoApp );
        };

$resp_test=Array();
$preg_test=Array();
      for ($i=0; $i < count($question) ; $i++) {

          $resp_test[]= array('idRespuestaTest' => $question[$i]['idRespuestaTest'],
                              'respuestaTest' => $question[$i]['respuestaTest'],
                              'puntajeRespuestaTest' => $question[$i]['puntajeRespuestaTest']);

        if($question[$i]['idPreguntasTest']!=$question[$i+1]['idPreguntasTest']){

          $preg_test[] = array('idPreguntasTest' => $question[$i]['idPreguntasTest'],
                              'preguntaTest' => $question[$i]['preguntaTest'],
                              'respuestasTest' =>$resp_test);

                $resp_test='';
          };
      }




        $respuesta  = array('Estado' =>"success" ,
                            'Response'=>$preg_test );
        $stmt->close();
    }else{
      $Error = "Error: ".$this->mysqli->error." query : ".$query;
      $respuesta= array('Estado' =>"Error" ,
                        'Response'=>$Error );
    }

      return $respuesta;
    }

    public function checkRut($rutUsuario){

        $sql2="SELECT *FROM usuario WHERE run_usuario = $rutUsuario";
       if($result = $this->mysqli->query($sql2)){
        if ($result->num_rows == 0) {
          return false;
          }else {
            return true;
         }

 }



}
  }

  ///query
  ///select info.rutUsuario_fk,avg(activ.numeroCigarrosActividad) as promedioCigarrosActual,info.cigarrosDiarios as promedioCigarrosPreguntaTestInicio from ActividadTabaquismo activ,InfoTabaquismo info where activ.rutUsuario_fk=info.rutUsuario_fk and info.rutUsuario_fk='18291683-8'

?>
