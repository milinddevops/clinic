<?php
$con 	= mysql_connect('localhost', 'root', '');
$db 	= mysql_select_db('ghatge18');

print('Generating USG bills....'."\n");
$sql 	= 'select sum(pt.lab_rate) as total, p.id, p.first_name, p.last_name, p.recieved_on from patients p JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id) JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id) where cpt.customer_id is not null and cpt.pathologytest_id IN(211, 222, 297, 133, 221) and date(p.recieved_on) between \'2017-04-01\' and \'2018-03-31\' group by cpt.customer_id order by rand();';

// Generate bills of USG
$res = mysql_query($sql);

//generate_bill($res, 'bill_sheets/usg.csv');


// Generate bills for non-usg 
print('Generating NON-USG bills....'."\n");
$sql = 'select sum(pt.lab_rate) as total, p.id, p.first_name, p.last_name, p.recieved_on from patients p JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id) JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id) where cpt.customer_id is not null and cpt.pathologytest_id NOT IN(211, 222, 297, 133, 221) and pt.test_type IN (2) and date(p.recieved_on) between \'2017-04-01\' and \'2018-03-31\' group by cpt.customer_id order by rand() LIMIT 2000;';

$res = mysql_query($sql);

generate_bill($res, 'bill_sheets/nonusg.csv');


// Generate bills of x-ray
print('Generating X-Ray bills....'."\n");

$sql = 'select sum(pt.lab_rate) as total, p.id, p.first_name, p.last_name, p.recieved_on from patients p JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id) JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id) JOIN test_types tt ON (tt.id=pt.test_type) where cpt.customer_id is not null and tt.id = 3 and date(p.recieved_on) between \'2017-04-01\' and \'2018-03-31\' group by cpt.customer_id order by rand();'; //  IN(234)
//$sql = 'select sum(pt.lab_rate) as total, p.id, p.first_name, p.last_name, p.recieved_on from patients p JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id) JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id) JOIN test_types tt ON (tt.id=pt.test_type and tt.id = 3) where cpt.customer_id is not null and pt.id IN(228,235) and date(p.recieved_on) between \'2017-04-01\' and \'2018-03-31\' group by cpt.customer_id order by rand();';

$res = mysql_query($sql);

//generate_bill($res, 'bill_sheets/xray.csv');


// Generate bills of patho tests
print('Generating Pathology bills....'."\n");
$sql = 'select sum(pt.lab_rate) as total, p.id, p.first_name, p.last_name, p.recieved_on  from  patients p  JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)  JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)  where cpt.customer_id is not null and pt.test_type IN (1)  and pt.total > 60 and pt.total < 300 and date(p.recieved_on) between \'2017-04-01\' and \'2018-03-31\' group by cpt.customer_id order by rand();';
//$sql = 'select sum(pt.lab_rate) as total, p.id, p.first_name, p.last_name, p.recieved_on  from  patients p  JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)  JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)  where cpt.customer_id is not null and pt.test_type IN (1) and date(p.recieved_on) between \'2017-04-01\' and \'2018-03-31\' group by cpt.customer_id order by rand();';

$res = mysql_query($sql);

//generate_bill($res, 'bill_sheets/patho.csv');

function generate_bill($res, $file) {
	$strContents 	= file_get_contents( 'Interfaces/Templates/Admin/patients/show_bill.tpl' );
	$arrPaterns 	= array( '/bill-no/', '/date/', '/patient-name/', '/total/');
	$strFinalContents = '';

	$intCtr = 1;
	while($row=mysql_fetch_assoc($res)) {

		$arrReplacements = array( $row['id']
							 ,$row['recieved_on']
							 ,$row['first_name'] . ' ' . $row['last_name']
							 ,700  );
		
		/*if( 0 == ($intCtr%2) ) {
			$arrReplacements = array( $row['id']
							 ,$row['recieved_on']
							 ,$row['first_name'] . ' ' . $row['last_name']
							 ,600  );
		}*/

		/*if( 840 == $row['total'] ) {
			
		}*/


		
		$strFinalContents .= implode($arrReplacements, ',') . "\n";
	}

	file_put_contents($file, $strFinalContents);
}
?>
