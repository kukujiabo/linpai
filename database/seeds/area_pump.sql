insert into provinces (cname, code, active) select province, provinceID, 1 from hat_province;

insert into cities (cname, code, province_code, active) select city, cityID, father, 1 from hat_city;

insert into districts (cname, code, city_code, active) select area, areaID, father, 1 from hat_area;
