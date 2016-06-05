<?php
    require_once("jsonList.php");
    require_once("Article.php");

    if(isset($_POST['suffix'], $_POST['title'], $_POST['suffix'], $_POST['text'] )){
        $suffix = filter_var($_POST["suffix"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH); 
        $suffix = preg_replace('/\s+/', '', $suffix); //strip any form of space 
        $filename = "./articles/" . $suffix . ".json";

        $title =  filter_var($_POST["title"], FILTER_SANITIZE_STRING); 
        $text =  filter_var($_POST["text"], FILTER_SANITIZE_STRING); 


        if($title=="" || $text==""|| strlen($title) > 100 || strlen($text) > 2000000) {
            die();
        }

        date_default_timezone_set('UTC');
        $data = array(
            'title' => $title, 
            'suffix' => $suffix,
            'date' => time(),
            'text' => $text,
            'number_of_comments' => 0,
            'comments' => ""
        );
    
        if(file_exists($filename)) {
            $art = Article::fromJson($filename);
            $data['comments'] = $art->getCommentsRaw();
        }

        $article = json_encode($data);
        $fp = fopen($filename, 'w');
        fwrite($fp, $article);
        fclose($fp);
        $list = new jsonList();
        $list->updateList();
        header("Location: index.php");
    }
?>
