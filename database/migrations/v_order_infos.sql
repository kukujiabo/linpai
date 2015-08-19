create view v_order_infos as
select 
a.id as oid,
a.code as code,
a.uid as uid,
a.gid as gid,
a.num as num,
a.sum as sum,
a.status as status,
a.active as active,
b.cut_fee as cut_fee,
b.extra_fee as extra_fee,
b.final_price as final_price,
g.name as gname,
g.pic as gpic,
a.created_at as created_at
from 
orders a,
order_prices b,
goods g
where 
a.gid = g.id and
a.id = b.oid


