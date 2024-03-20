<?php
require_once('connect-db.php');

function addRequests($reqDate, $roomNumber, $reqBy, $repairDesc, $reqPriority)
{
   global $db;   
   $reqDate = date('Y-m-d');      // ensure proper data type before inserting it into a db
       
   $query = "INSERT INTO requests (reqDate, roomNumber, reqBy, repairDesc, reqPriority) VALUES (:reqDate, :roomNumber, :reqBy, :repairDesc, :reqPriority)";  
   
   try { 

      $statement = $db->prepare($query);

      // fill in the value
      $statement->bindValue(':reqDate', $reqDate);
      $statement->bindValue(':roomNumber', $roomNumber);
      $statement->bindValue(':reqBy',$reqBy);
      $statement->bindValue(':repairDesc', $repairDesc);
      $statement->bindValue(':reqPriority', $reqPriority);

      // exe
      $statement->execute();
      $statement->closeCursor();
   } catch (PDOException $e)
   {
      $e->getMessage();   // consider a generic message
   } catch (Exception $e) 
   {
      $e->getMessage();   // consider a generic message
   }

}

function getAllRequests()
{
    global $db;
    $query = "select * from requests";    
    $statement = $db->prepare($query);    
    $statement->execute();
    $result = $statement->fetchAll();     
    $statement->closeCursor();
 
    return $result;
}

function getRequestById($id)  
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM requests WHERE reqId =:reqId");
    $stmt->bindValue(':reqId', $id);
    $stmt->execute();
    $result = $stmt->fetch();
    $stmt->closeCursor();

    return $result;
}

function updateRequest($reqId, $reqDate, $roomNumber, $reqBy, $repairDesc, $reqPriority)
{
    $stmt = $db->prepare("UPDATE requests SET reqDate = ?, roomNumber = ?, reqBy = ?, repairDesc = ?, reqPriority = ? WHERE reqId = ?");
    $stmt->execute([$reqDate, $roomNumber, $reqBy, $repairDesc, $reqPriority, $reqId]);
}

function deleteRequest($reqId)
{
    $stmt = $db->prepare("DELETE FROM requests WHERE reqId = ?");
    $stmt->execute([$reqId]);    
}

?>

