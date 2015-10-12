create view v_order_info_large as 
select
distinct 
a.id as oid,
a.code as order_code,
a.uid as uid,
a.cid as cid,
a.gid as gid,
a.rid as rid,
a.num as num,
a.sum as sum,
a.plate_number as plate_number,
a.created_at as created_at,
a.comment as 'comment',
a.status as status,
b.receiver as receiver,
b.mobile as mobile,
b.phone as phone,
b.country as country,
b.province as province,
b.city as city,
b.district as district,
b.road as road,
b.address as address,
b.post_code as post_code,
c.owner as car_owner,
c.brand as car_brand,
c.factory_code as car_factory_code,
c.reco_code as reco_code,
c.dir_identity_face as  dir_identity_face,
c.dir_identity_back as dir_identity_back,
c.dir_trans_ensurance as dir_trans_ensurance,
c.dir_car_check as dir_car_check,
c.dir_validate_paper as dir_validate_paper,
c.car_type as car_type,
d.orig_price as orig_price,
d.cut_fee as cut_fee,
d.final_price as final_price,
e.name as good_name,
e.tiny_good as good_tiny_pic,
e.code as good_code,
f.value as g_single_price,
g.name as order_owner,
g.mobile as order_owner_mobile
from 
orders a, 
receiver_infos b, 
cars c,
order_prices d,
goods e,
v_goods_attributes f,
users g
where 
a.rid = b.id and 
a.cid = c.id and 
a.id = d.oid and 
a.gid = e.id and 
f.gid = a.gid and 
f.acode = 'price' and 
a.uid = g.id;
