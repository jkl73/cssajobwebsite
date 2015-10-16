<?php

function sql_update_visit($postid) {
	$conn = getconn();
    $stmt = $conn->prepare("select visit from post_info where postid=:postid");
    $stmt->bindParam(":postid", $postid);
    $result = $stmt->execute();
	if (!$result)
        pdo_die($stmt);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    $newvisit = $result[0]['visit'] + 1;

    $stmt = $conn->prepare("update post_info set visit=:newvisit where postid=:postid");
    $stmt->bindParam(":newvisit", $newvisit);
	$stmt->bindParam(":postid", $postid);
    $result = $stmt->execute();

    if (!$result)
        pdo_die($stmt);

    $result = $stmt->fetchAll();

    assert(count($result) <= 1);
    if (count($result) != 0)
        return $result[0][$column];
    else
        return null;



//    $stmt = $conn->prepare("update post_info set status=:new_status where id=:order_id");




}

function sql_add_post($email, $company_name, $position, $description, $job_content) {
	$conn = getconn();
    $post_id = $conn->lastInsertId();

    $stmt = $conn->prepare("insert into post_info(email, company, position, tags, time, visit, fav) values(:email, :company, :position, :tags, now(), 0, 0)");

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':company', $company_name);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':tags', $description);
    
    $result = $stmt->execute();
    $post_id = $conn->lastInsertId();

    if (!$result)
        pdo_die($stmt);

	$stmt = $conn->prepare("insert into post_content(postid, content) values(:postid, :content)");

    $stmt->bindParam(':postid', $post_id);
    $stmt->bindParam(':content', $job_content);

    $result = $stmt->execute();
    $post_id = $conn->lastInsertId();

    if (!$result)
        pdo_die($stmt);

    return 1;
}

function pdo_die($stmt)
{
    var_dump($stmt->errorInfo());
    die("PDO error!");
}

function getconn()
{
    static $conn;

    if ($conn)
        return $conn;
        
    $dbname = "user_student";
    $user = "cssaadmin"; $pw = "cssaadmin123";
    $host = "cssadbinstance.ccmgeu2ghiy1.us-east-1.rds.amazonaws.com";
        
    $dsn = "mysql:host=$host;dbname=$dbname"; // Data source name
    $conn = new PDO($dsn, $user, $pw);
    return $conn;
}


?>