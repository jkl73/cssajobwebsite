<?php

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