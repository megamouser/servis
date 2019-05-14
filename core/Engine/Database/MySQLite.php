<?php
namespace Core\Engine\Database;
use SQLite3;

class MySQLite extends SQLite3 {
    function __construct() {
        $this->open("messages.db");
    }
}

/*
0. OPEN DATABASE CONNECTION

$db = new MyDB();

if(!$db) {
    echo $db->lastErrorMsg();
} else {
    echo "Opened database successfully\n";
}
*/


/*
1. CREATE OPERATION

$sql = 
<<<EOF
CREATE TABLE COMPANY
(
    ID            INT PRIMARY KEY         NOT NULL,
    NAME          TEXT                    NOT NULL,
    AGE           INT                     NOT NULL,
    ADDRESS       CHAR(50),
    SALARY        REAL
);
EOF;

$ret = $db->exec($sql);

if(!$ret) {
    echo $db->lastErrorMsg();
} else {
    echo "Table created successfully\n";
}

$db->close(); 
*/

/* 
2. INSERT OPERATION

$sql =
<<<EOF
INSERT INTO COMPANY ( ID,    NAME,  AGE,      ADDRESS,    SALARY )
            VALUES  (  1,  'Paul',   32, 'California',  20000.00 );

INSERT INTO COMPANY ( ID,    NAME, AGE, ADDRESS, SALARY )
            VALUES  (  2, 'Allen',  25, 'Texas', 15000.00 );

INSERT INTO COMPANY ( ID,    NAME,  AGE,    ADDRESS,   SALARY )
            VALUES  (  3, 'Teddy',   23,   'Norway', 20000.00 );

INSERT INTO COMPANY ( ID,  NAME,  AGE,      ADDRESS,    SALARY )
            VALUES  (  4, 'Mark',  25,  'Rich-Mond',  65000.00 );
EOF;

$ret = $db->exec($sql);
if(!$ret) {
echo $db->lastErrorMsg();
} else {
echo "Records created successfully\n";
}
$db->close();
*/

/*
3. SELECT OPERATION

$sql =<<<EOF
SELECT * from COMPANY;
EOF;

$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
    echo "ID = ". $row['ID'] . "\n";
    echo "NAME = ". $row['NAME'] ."\n";
    echo "ADDRESS = ". $row['ADDRESS'] ."\n";
    echo "SALARY = ".$row['SALARY'] ."\n\n";
}
echo "Operation done successfully\n";
$db->close();
*/

/* 
4. UPDATE OPERATION

$sql =
<<<EOF
UPDATE COMPANY set SALARY = 30000.00 where ID=1;
EOF;

$ret = $db->exec($sql);

if(!$ret) {
    echo $db->lastErrorMsg();
} else {
    echo $db->changes(), " Record updated successfully\n";
}

$sql =
<<<EOF
SELECT * from COMPANY;
EOF;

$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
    echo "ID = ". $row['ID'] . "\n";
    echo "NAME = ". $row['NAME'] ."\n";
    echo "ADDRESS = ". $row['ADDRESS'] ."\n";
    echo "SALARY = ".$row['SALARY'] ."\n\n";
}
echo "Operation done successfully\n";
$db->close();
*/

/*
5. DELETE OPERATION

$sql =
<<<EOF
DELETE from COMPANY where ID = 2;
EOF;

$ret = $db->exec($sql);
if(!$ret){
    echo $db->lastErrorMsg();
} else {
    echo $db->changes(), " Record deleted successfully\n";
}

$sql =
<<<EOF
SELECT * from COMPANY;
EOF;

$ret = $db->query($sql);

while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
    echo "ID = ". $row['ID'] . "\n";
    echo "NAME = ". $row['NAME'] ."\n";
    echo "ADDRESS = ". $row['ADDRESS'] ."\n";
    echo "SALARY = ".$row['SALARY'] ."\n\n";
}

echo "Operation done successfully\n";
$db->close();
*/






