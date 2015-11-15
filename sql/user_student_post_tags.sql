DROP TABLE IF EXISTS `post_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_tags` (
  `postid` int(11) NOT NULL,
  `job_year` int(4) NOT NULL,
  `major_class` varchar(64) NOT NULL,
  `company` varchar(64) NOT NULL,
  `job_type` varchar(64) NOT NULL,
  PRIMARY KEY (`postid`),
  FOREIGN KEY (`postid`) REFERENCES post_info(`postid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;