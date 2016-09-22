<¿php
class Estadistica {

  public function __invoke ($request, $response, $next)
  {
// informacion de la url de $request;

    return $next($request,$reponse);
  }
}
}





?>
