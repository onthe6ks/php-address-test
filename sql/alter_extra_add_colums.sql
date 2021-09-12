ALTER TABLE extra ADD Flag_valid BOOLEAN DEFAULT TRUE;

--samole
-- update extra set Flag_valid = false where To_Network_Address in ("12.1.0.64");
-- https://sql55.com/t-sql/t-sql-update-1.php