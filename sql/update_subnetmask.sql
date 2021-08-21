update address set subnet_mask = REGEXP_REPLACE(subnet_mask,'\\.\\d{1,3}\\.\\d{1,3}$','.0.0');


-- select * ,REGEXP_REPLACE(subnet_mask,'\\..{1,3}\\..{1,3}$','.aaa.aaa') from address;
