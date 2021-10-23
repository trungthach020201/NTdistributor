<?php
     $Connect = pg_connect("postgres://cnvnkjrbeouslw:7d7643cd9914d45b8ced65763810353398bbab37d465e252ddae3847d1426988@ec2-44-199-19-76.compute-1.amazonaws.com:5432/d282ipi4c4ru18
     ") or die("Lỗi".pg_error($Connect));
     pg_query($Connect,'SET NAMES "utf8"');
 ?>
