<?php

        //建立SQL
        include("./Lib/UtilClass.php");
        $Util = new UtilClass();


        //籤詩randon
        $sql = "SELECT * FROM Draw where `STATUS` = 1 ORDER BY RAND() LIMIT 1";


        //籤詩一條一條測試
        // $sql = "SELECT * FROM Draw where id = 1";
        //籤詩8把.title的width:435px
        //籤11跟30非常的長嗚嗚嗚嗚QQ 偷偷在mySQL把h2標籤style="font-size:17px;"


            //執行
        $statement = $Util->getPDO()->prepare($sql);
        $statement->execute();
        $data = $statement->fetchAll();
    

        print_r(json_encode($data));

?>