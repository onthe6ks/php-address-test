CREATE TABLE `extra` (
  `no` int(11) NOT NULL,
  `To_Network_Address` text DEFAULT NULL,
  `Flag_To_Network_Address` boolean DEFAULT NULL,
  `From_Network_Address` text DEFAULT NULL,
  `Flag_From_Network_Address` boolean DEFAULT NULL,
  `error` boolean DEFAULT NULL,
  PRIMARY KEY (no)
)
