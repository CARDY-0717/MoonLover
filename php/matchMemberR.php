<?php

        include("./Lib/MemberClass.php");
        $Member = new MemberClass();
        $myId = $Member->getMemberID();

        include("./Lib/UtilClass.php");
        $Util = new UtilClass();

        $intCondToSql = "(".$_POST["intCondToSql"].")";
        // $intCondToSql = $_POST["intCondToSql"];

        if ($intCondToSql == '()') {
                $intCondToSql = '(m.ID is not null)';
        }

        //建立SQL        
        // $sql = "SELECT m.*, myInt.* FROM `member` m JOIN `my_interest` myInt on m.ID = myInt.mMEMBER_ID WHERE m.ID != $myId and m.PAIR_PRIV = 1 and m.SO = ? and m.SEX = ? and m.AGE_RANGE = ? and m.AREA = ? and m.JOB = ? and m.EDUCATION = ? and $intCondToSql GROUP BY m.ID ORDER BY RAND() LIMIT 1";
        // $sql = "SELECT m.*, myInt.*, re.* FROM `member` m 
        //         JOIN `my_interest` myInt on m.ID = myInt.mMEMBER_ID 
        //         JOIN `relationship` re on re.MYMEMBER_ID = $myId
        //             WHERE m.ID != $myId 
        //                 and m.PAIR_PRIV = 1 
        //                 and m.SO = ? 
        //                 and m.SEX = ? 
        //                 and m.AGE_RANGE = ? 
        //                 and m.AREA = ? 
        //                 and m.JOB = ? 
        //                 and m.EDUCATION = ? 
        //                 and $intCondToSql 
        //                 and re.TARGET_ID != m.ID
        //         GROUP BY m.ID";

        $sql = "SELECT myInt.mMEMBER_ID, m.IMAGE, m.NICKNAME, m.ABOUT, m.AREA, m.JOB, m.JOB_DETAIL, m.AGE, m.SCHOOL  FROM `member` m 
        JOIN `my_interest` myInt on m.ID = myInt.mMEMBER_ID 
        LEFT JOIN (SELECT TARGET_ID FROM relationship where MYMEMBER_ID = 10) as re on re.TARGET_ID = m.ID
        WHERE m.ID != 10
        and m.PAIR_PRIV = 1 
        and m.SO = ? 
        and m.SEX = ?
        and m.AGE_RANGE = ?
        and m.AREA = ? 
        and m.JOB = ? 
        and m.EDUCATION = ?  
        and re.TARGET_ID is Null
        and $intCondToSql
        GROUP BY m.ID
        ORDER BY RAND() 
        LIMIT 1";
        
        // $sql = "SELECT m.*, myInt.* FROM `member` m JOIN `my_interest` myInt on m.ID = myInt.mMEMBER_ID WHERE m.ID != $myId and m.PAIR_PRIV = `1` and m.SO = ? and m.SEX = ? and m.AGE_RANGE = ? and m.AREA = ? and m.JOB = ? and m.EDUCATION = ? and ?";
        // echo $sql;
        // //執行
        $statement = $Util->getPDO()->prepare($sql);
        $statement->bindValue(1, $_POST["sex"]);
        $statement->bindValue(2, $_POST["seo"]);
        $statement->bindValue(3, $_POST["ageRange"]);
        $statement->bindValue(4, $_POST["city"]);
        $statement->bindValue(5, $_POST["job"]);
        $statement->bindValue(6, $_POST["education"]);
        // $statement->bindValue(7, $intCondToSql);
        
        $statement->execute();
        $data = $statement->fetchAll();
    
        // $error = $statement->errorInfo();
        // print_r ($error);
        print_r(json_encode($data));
    

?>