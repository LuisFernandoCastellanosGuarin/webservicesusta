<?php

 /** 
   @Descripción: Servicio web del lado del servidor de información de libros:
  Este Sctript crea un servicio web utilizando la biblioteca php NuSOAP. 
  La función fetchBookData acepta el ISBN y envía información del libro.
 */
 require_once('dbconn.php');
 require_once('lib/nusoap.php'); 
 $server = new nusoap_server();

 /* Method to isnter a new book */
function insertBook($title, $author_name, $price, $isbn, $category){
  global $dbconn;
  $sql_insert = "insert into libros_facultad (title, author_name, price, isbn, category) values ( :title, :author_name, :price, :isbn, :category)";
  $stmt = $dbconn->prepare($sql_insert);
  // insert a row
  $result = $stmt->execute(array(':title'=>$title, ':author_name'=>$author_name, ':price'=>$price, ':isbn'=>$isbn, ':category'=>$category));
  if($result) {
    return json_encode(array('status'=> 200, 'msg'=> 'success'));
  }
  else {
    return json_encode(array('status'=> 400, 'msg'=> 'fail'));
  }
  
  $dbconn = null;
  }
/* Fetch 1 book data */
function fetchBookData($isbn){
	global $dbconn;
	$sql = "SELECT id, title, author_name, price, isbn, category FROM libros_facultad 
	        where isbn = :isbn";
  // prepare sql and bind parameters
    $stmt = $dbconn->prepare($sql);
    $stmt->bindParam(':isbn', $isbn);

    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return json_encode($data);
    $dbconn = null;
}
/* Fetch 1 book data */
function fetchBookDataAll(){
  global $dbconn;
  $sql = "SELECT id, title, author_name, price, isbn, category FROM libros_facultad";
    $stmt = $dbconn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchall(PDO::FETCH_ASSOC);
    return json_encode($data);
    $dbconn = null;
}


$server->configureWSDL('booksWebServiceUSTA', 'urn:book');

$server->register('fetchBookData',
			array('isbn' => 'xsd:string'),  //parameter
			array('data' => 'xsd:string'),  //output
			'urn:book',                     //namespace
			'urn:book#fetchBookData',        //soapaction
      'rpc',                               // style
      'encoded',                           // use
      'trae la informacion de un libro'   // description
      ); 
$server->register('fetchBookDataAll',
      array('all' => 'xsd:string'),    //parameter
      array('data' => 'xsd:string'),   //output
      'urn:book',                      //namespace
      'urn:book#fetchBookDataAll',        //soapaction
      'rpc',                               // style
      'encoded',                           // use
      'trae la informacion de todos los libros'   // description
      );  
$server->register('insertBook',
			array('title' => 'xsd:string', 'author_name' => 'xsd:string', 'price' => 'xsd:string', 'isbn' => 'xsd:string', 'category' => 'xsd:string'),  //parameter
			array('data' => 'xsd:string'),  //output
			'urn:book',   //namespace
			'urn:book#fetchBookData' ,        //soapaction
      'rpc',                               // style
      'encoded',                           // use
      'Inserta un libro a la base de datos'   // description
    );
$server->service(file_get_contents("php://input"));

?>