<?php

class m0001_initial
{

    public function up()
    {

        $db = Application::$app->db->pdo;

        $sql = "CREATE TABLE IF NOT EXISTS `calc_history`  (
                  `_id` varchar(255) COLLATE utf8_bin NOT NULL PRIMARY KEY,
                  `parent_id` varchar(255) COLLATE utf8_bin NOT NULL,
                  `equation` text COLLATE utf8_bin NOT NULL,
                  `result` text COLLATE utf8_bin NOT NULL,
                  `status` int COLLATE utf8_bin NOT NULL,
                  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
                  `edited_timestamp` datetime NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";

        $sql2="INSERT INTO `calc_history` (`_id`, `parent_id`, `equation`, `result`, `timestamp`, `edited_timestamp`) VALUES
                ('sd4565rs3df654tertvc6b46df5y3a5sd4a87wer4689d47d', '', '1 + 1', '2', '2021-02-05 17:15:23', NULL),
                ('df4e6rt54d2f14bg654hrft56ft56as68d74ds789d7tsd56', '', '2 + 2', '4', '2021-02-04 17:15:34', NULL);";


        $db->exec($sql);

        $db->exec($sql2);

    }

    public function down()
    {

        $db = Application::$app->db->pdo;

        $sql = "DROP TABLE `calc_history`;";

        $db->exec($sql);
    }


}