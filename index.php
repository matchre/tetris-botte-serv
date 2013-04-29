<?  
// Lecture du fichier de code des valeurs du controleur optimal de tetris boté   

// Autorise les accès en webservice
header('Access-Control-Allow-Origin: *');

// Rend explicite les erreurs 
if (!function_exists("debug_error_handler")) {
  function debug_error_handler($errno, $errstr, $errfile, $errline, $errcontext) {     
    if ($errno != 8192)
      echo "<br/>\n".str_repeat("-", 120)."<br/>\nError #$errno: '$errstr' [in $errfile line $errline]<br/>\n".str_repeat("-", 120)."<br/>\n<br/>\n";
  }
  error_reporting(E_ALL); set_error_handler('debug_error_handler');
}

// Lecture de la requête
if (!isset($_GET['index'])) {
  echo "<tt>Usage : https://iww.inria.fr/mecsci/grains3.0/tetris-botte-serv/?index=['min','max',&lt;<i>valeur-de-l'index</i>>]</tt><hr>";
  exit;
}
$index = $_GET['index'];

// Lecture du fichier
$file = fopen('./scores.dat', "rb");
if ($index == 'min') {
  $data = unpack('d', fread($file, 8));
  $data = $data[1];
 } else if ($index == 'max') {
  fseek($file, 8);
  $data = unpack('d', fread($file, 8));
  $data = $data[1];
 } else {
  fseek($file, 2 * 8 + $index);
  $data = ord(fread($file, 1));
 }
fclose($file);

// Echo de la valeur
echo $data;

?>