<?php
  //leggo il JSON e lo salvo come str
  $strJson = file_get_contents('todo-list.json');

  //decodifico la str e la trasformo in un array
  $list = json_decode($strJson, true);

  //controllo se mi arrivi in POST la variabile del nuovo Task
  if(isset($_POST['toDoItem'])){
    //aggiungo alla lista
    $newTask = $_POST['toDoItem'];

    $list[] =
      [
        'task' => $newTask,
        'done' => false
      ];
    
    //salvo dentro il JSON insieme alla lista aggiornata
    file_put_contents('todo-list.json', json_encode($list));
  }

  //controllo se esiste un index da eliminare
  if(isset($_POST['indexToDelete'])){
    $indexToDelete = $_POST['indexToDelete'];

    //elimino l'elemento dall'array corrispondente all'index ricevuto
    array_splice($list, $indexToDelete, 1);

    //salvo la lista aggiornata
    file_put_contents('todo-list.json', json_encode($list));
  }

  //faccio diventare il file PHP in JSON
  header('Content-type: application/json');

  //stampo la str ricodificata
  echo json_encode($list);
?>