CREATE TABLE `address` (
  `no` int(11) NOT NULL,
  `ip1` varchar(3) DEFAULT NULL,
  `ip2` varchar(3) DEFAULT NULL,
  `ip3` varchar(3) DEFAULT NULL,
  `ip4` varchar(3) DEFAULT NULL,
  `subnet_mask` text DEFAULT NULL,
    PRIMARY KEY (no)
)
