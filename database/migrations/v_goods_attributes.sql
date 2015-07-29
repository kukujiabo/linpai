create view v_goods_attributes as
select 
g.id as gid, 
g.name as gname, 
g.code as gcode, 
g.pic as gpic, 
a.id as aid, 
a.name as aname, 
a.spec as spec, 
a.code as acode, 
c.value as value
from 
goods g,
attributes a,
good_attribs c
where
g.id = c.gid
and
a.id = c.aid;
