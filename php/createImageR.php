<?php 

    include("./Lib/MemberClass.php");

    $Member = new MemberClass();

    $id = $Member->getMemberID();
    
    include("./Lib/UtilClass.php");
    $Util = new UtilClass();

    //建立SQL
    $sql = "SELECT IMAGE FROM member WHERE ID = ?";

    //執行
    $statement = $Util->getPDO()->prepare($sql);

    //給值
    $statement->bindValue(1, $id);
    $statement->execute();

    $data = $statement->fetchAll();

    $oldData = "";
    // 確認是否有存在資料
    foreach($data as $index => $row){
        $oldData = $row["IMAGE"];
    }

    $img = $_POST["img"];

    $img = str_replace('data:image/png;base64,','', $img);// 需注意 data url 格式 與來源是否相符 ex:image/jpeg
    $data = base64_decode($img);//解base64碼

    if ($oldData != null) {
        $file = '../images/member/profile/'. $oldData;//檔名 包含資料夾路徑 請記得此資料夾需 777 權限 方可寫入圖檔
        // echo $file;
    }else{
        $file = '../images/member/profile/'. uniqid().'.png';//檔名 包含資料夾路徑 請記得此資料夾需 777 權限 方可寫入圖檔
    }

    $filepath = substr($file,-17);
    $success = file_put_contents($file, $data);


    $sql = "UPDATE member SET IMAGE = ? where ID = ?";

    //執行
    $statement = $Util->getPDO()->prepare($sql);

    //給值
    $statement->bindValue(1, $filepath);
    $statement->bindValue(2, $id);
    $statement->execute();
    $data = $statement->fetchAll();    

?>