select p.first_name, last_name, sum(pt.lab_rate) as total
from 
patients_copy p 
JOIN customer_pathology_tests_copy cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests_copy pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null
group by cpt.customer_id;



-- Total amount
select sum(fee.total) from (select sum(pt.lab_rate) as total
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id) as fee;

-- Total amount by test type
select sum(fee.total) as amount from (select sum(pt.lab_rate) as total
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null and pt.test_type IN (3) 
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id) as fee;

-- Total amount only for opstratic patients
select sum(fee.total) from (select sum(pt.lab_rate) as total
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null 
and cpt.pathologytest_id IN(211, 222, 297, 133, 221)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id) as fee;

-- fetch all the x-ray patients data
select sum(fee.total) from (select sum(pt.lab_rate) as total
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null and pt.test_type IN (2)
and cpt.pathologytest_id NOT IN(211, 222, 297, 133, 221)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id) as fee;

-- Fetch only usg data
-- sum(pt.lab_rate) as total, p.*
select sum(pt.lab_rate) as total, p.*
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null 
and cpt.pathologytest_id IN(211, 222, 297, 133, 221)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id;


--- numb of pt
select count(*)
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null and pt.test_type IN (1,2,3) 
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id;

--- update x-ray test rates
update pathology_tests set lab_rate= 250 where id IN(126, 127, 136, 228, 229, 230, 231, 233, 234, 235, 236, 249);

-- update usg test rates
update pathology_tests set lab_rate= 700 where id IN(211, 222, 297, 133, 221);

-- Path patients
select sum(fee.total) as amount from (select sum(pt.lab_rate) as total
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null and pt.test_type IN (1) 
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id) as fee;

-- path patients count
select count(*)
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null and pt.test_type IN (1) 
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id;

select sum(total) as amount from (select sum(pt.lab_rate) as total
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null 
and total > 60 and total < 300
and pt.test_type IN (1) 
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id) as fee;

-- total count 
select count(*)
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null 
and total > 60 and total < 300
and pt.test_type IN (1)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id;


 211 |         2 | USG obs routine
 222 |         2 | USG anomaly scan
  297 |         2 | USG anomaly scan & abdomen
  133 |         2 | USG doppler obs
221 |         2 | USG early anomaly scan (NT)


-- query to fetch usg patients
select sum(pt.lab_rate) as total
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null 
and cpt.pathologytest_id IN(211, 222, 297, 133, 221)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id; limit 10;

-- query to fetch x-ray patients
select sum(fee.total) as amount from (select sum(pt.lab_rate) as total
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null 
and cpt.pathologytest_id IN(126, 127, 136, 228, 229, 230, 231, 233, 234, 235, 236, 249)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id) as fee;

-- query to fetch patho patients
select sum(pt.lab_rate) as total
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null 
and total > 60 and total < 300
and pt.test_type IN (1) 
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id limit 10;


-- Total patients cost
 select sum(fee.total) from (select sum(pt.lab_rate) as total
 from
 patients p
 JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
 JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
 where cpt.customer_id is not null
 and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
 group by cpt.customer_id) as fee;

-- USG patients cost - Final 1947540
select sum(fee.total) from (select sum(pt.lab_rate) as total
from
patients p
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null
and cpt.pathologytest_id IN(211, 222, 297, 133, 221)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id) as fee;

---- SQL 
select sum(pt.lab_rate) as total, p.first_name, p.last_name, p.recieved_on
from
patients p
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null
and cpt.pathologytest_id IN(211, 222, 297, 133, 221)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id

-- other usg cost - Final 310350
select sum(fee.total), count(cust) from (select sum(pt.lab_rate) as total, cpt.customer_id as cust
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null 
and cpt.pathologytest_id NOT IN(211, 222, 297, 133, 221)
and pt.test_type IN (2)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id LIMIT 450) as fee;

--- SQL 
select sum(pt.lab_rate) as total, p.first_name, p.last_name, p.recieved_on
from 
patients p 
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null 
and cpt.pathologytest_id NOT IN(211, 222, 297, 133, 221)
and pt.test_type IN (2)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id LIMIT 450;

-- X-Ray patient cost - Final 329200
select sum(fee.total) as amount from (select sum(pt.lab_rate) as total
from
patients p
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null
and cpt.pathologytest_id IN(234)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id) as fee;

-- SQL 
select sum(pt.lab_rate) as total, p.first_name, p.last_name, p.recieved_on
from
patients p
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null
and cpt.pathologytest_id IN(234)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id


select count(cpt.customer_id) as total
from
patients p
JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
where cpt.customer_id is not null
and cpt.pathologytest_id IN(234)
and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
group by cpt.customer_id;

126, 127, 136, 228, 229, 230, 231, 233, 234, 235, 236, 249

-- Path patients cost - Final 405590
 select sum(fee.total) as amount from (select sum(pt.lab_rate) as total
 from
 patients p
 JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
 JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
 where cpt.customer_id is not null and pt.test_type IN (1)
 and total > 60 and total < 300
 and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
 group by cpt.customer_id) as fee;

 --- SQL 
 select sum(pt.lab_rate) as total, p.first_name, p.last_name, p.recieved_on
 from
 patients p
 JOIN customer_pathology_tests cpt ON(p.id=cpt.customer_id)
 JOIN pathology_tests pt ON(cpt.pathologytest_id=pt.id)
 where cpt.customer_id is not null and pt.test_type IN (1)
 and total > 60 and total < 300
 and date(p.recieved_on) between '2016-04-01' and '2016-12-31'
 group by cpt.customer_id;

