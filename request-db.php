<?php
function addRequests($reqDate, $roomNumber, $reqBy, $repairDesc, $reqPriority)
{
    $stmt = $db->prepare("INSERT INTO requests(reqDate, roomNumber, reqBy, repairDesc, reqPriority) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$reqDate, $roomNumber, $reqBy, $repairDesc, $reqPriority]);
}

function getAllRequests()
{
    $stmt = $db->query("SELECT * FROM requests");
    return $stmt->fetchAll();
}

function getRequestById($id)  
{
    $stmt = $db->prepare("SELECT * FROM requests WHERE reqId = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
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

