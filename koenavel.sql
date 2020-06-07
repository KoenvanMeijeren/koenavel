-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: koenavel
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account` (
  `account_ID` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) DEFAULT NULL,
  `account_email` varchar(255) NOT NULL,
  `account_password` text NOT NULL,
  `account_rights` tinyint(1) NOT NULL DEFAULT '0',
  `account_login_token` text,
  `account_failed_login` tinyint(1) NOT NULL DEFAULT '0',
  `account_is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `account_is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,'Koen van Meijeren','koenvanmeijeren@gmail.com','$argon2id$v=19$m=65536,t=4,p=1$MmlLUGg5NThPTWVzMmxERQ$MeZ0YGJ33R1ZUXhWiGy06ZXw4NPDq8TGi1lVF5ml9MI',3,'c18d20e753ad0c150a0361fb541c5b91e22852113720d950d7c996c53d509277e176a2221da944992947fad9f8df1353b75a3fa1fdf85c0df55e2a1ee183c4c6cc62edb1d0e9bad6ca13a08feb18c9c1766f8bea31c2c0386ed50cf040e2bee161b816e261ac601c40b6ae2ae819d0335082b03b28d14789cda717c5737c124cb9ad4241a87409904ef736b7b1fba470b90e88a643d7edea586835b627f209e2973162a44ca560d133a4bbb4507eb1f0bbf5138c42f3b05a256d69af1219e4b22fba07c04c4b4a3a',0,0,0),(47,'Beheerder','beheerder@test.nl','$argon2id$v=19$m=65536,t=4,p=1$dFlsQ29QT3o3S2tZcnZmMg$zOeYh75WwFuR3LekyPJi5hU+gNUOtwlkaygisInYMzk',1,'7bbb0182788475b5964fb2615a26a51e8b17a1ff322b68f7708c7000806598e0ba01e69a57476801519108bde70ddcc6622f3c21632511c75be4635c980ecbca90a3f1b62db27a34268370233ffe2c43553f349f0bce61356a0527497481cff5e56b81c927558968ba560d422bd862c75ed92a1efa4cfad04ae1918fb26b4d8af3e049ff6f3f4d8daa552fcf8eda55b49a85ffb81206da675d9eea9615c0a00894a353e68441c9393924671e9a4858cd7a8e5d21bcfb1c4dd8a05c4a3aa2de40cd72b40aa558e0b1',0,0,0),(50,'Beheerder','superbeheerder@test.nl','$argon2id$v=19$m=65536,t=4,p=1$WnlRUkcxODloaklPWS4zTQ$1CnaEdqIdIbQofhXUaKtpuviZ2R3Q/5VaihftwpMy4s',2,'5de571a62294d5fc24354d2a4699ba11e7f23737603cdc3ad0783a2910f124a517fd55e23174d73ada912590e957166dc2cb64f73d635ff2f96b88ab993b464c38eb97afd44abd97d3a2c2d96d623747bd2187564b58ebcf912da8391f227e64e759d7f09d6d4da34fa9d5ab5d949c5260f95b65ebe62008a7c36a32e9f37b8bd1ca4fb0e5b31d7a7cb5ade7744431515109dd9019ace0f005ca59af0e734ba1310599c14518a1e259c1e40ac04ec47116694930ff38461cee70b43f81a006effbaa06ddc8d8ed90',0,0,0),(51,'Account','account@test.nl','$argon2id$v=19$m=65536,t=4,p=1$cWZ3TllPaWRxVjA0TU41bQ$O4kWtzr+CF8I3yWvGT02m1h+PZpvVWuHgay1WKlEVqA',3,'eae96793024711b89d7cfb2d717395117f2c288f537042ad5c71d2ff3a9f562931d56d9e2f6b412b5b92f29c6c3b8e2aacb54d33dae9f3c6df46155b9349b88dea3fc75cc9c79ba8060c363dc09da0cd31277a5b84441637279bab312f94f08d64bed87945781d6216939c1d08a3db58ed98d038104d8d3b1cb37d50b58ef396fb4bd7dbd865a9ef2aea2b5fa2c1ea4d3ec217ffbb0c53365521df46d50b7ed00f22d8a6bbdfd7215c3ff926dd2a2e70d782661fd13750c0745d4f88ee9c6917dc040cb82a83c1a9',0,1,0),(58,'Test Nieuwe Views','view@test.nl','$argon2id$v=19$m=65536,t=4,p=1$c0VlLzk3SFhNVFJiOEkzcA$oxNsGmsyJ1VBvbB1cGYzLwWC8dcjkKcXbj2Uw1UgV1c',1,NULL,0,0,1),(59,'test form validatie','formvalidatie@test.nl','$argon2id$v=19$m=65536,t=4,p=1$ZGw3RjY4SFIuV201Tm5peQ$x0zLcL7e2+b7WKQFsaUu9jZcKcT4TyVjB7dAmDuTxwc',3,NULL,0,0,1),(60,'Test Form validatie','form@validatie.nl','$argon2id$v=19$m=65536,t=4,p=1$aUtuY3dJVzBtRjJ4OGxqTA$8zHpNIeaJsnSeLiPa3THFSI1+JYi5572zdzrc3YfsHc',1,NULL,0,0,1),(61,'test','testen@testen.nl','$argon2id$v=19$m=65536,t=4,p=1$Yk9xRUc3Wi5WRVR1MGVUcA$38LFl4aFub6aXrhgt/mac/Gq2W8hbRANVVQZqebLTGY',1,NULL,0,0,1);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `file` (
  `file_ID` int(11) NOT NULL AUTO_INCREMENT,
  `file_path` text NOT NULL,
  `file_is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (1,'/storage/media/677261736c656767656e2e6a7067.jpeg',0),(2,'/storage/media/6e696768742d766965772d323134303938325f313238302e6a7067.jpeg',0),(3,'/storage/media/626c617577652d7a65696c656e2e6a7067.jpeg',0),(4,'/storage/media/626c75652d343131393831365f313238302e6a7067.jpeg',0),(5,'/storage/media/6d61696e6c696e6b2d332e6a7067.jpeg',0),(6,'/storage/media/44534330333736372d373030783330302e6a7067.jpeg',0),(7,'/storage/media/63726179736964652d736563746f72732d696e647573747269616c2e6a7067.jpeg',0),(8,'/storage/media/3530305f465f38303539313133305f56535176453963476b6d4e565541627163653430726778786f5962384b4250672e6a7067.jpeg',0),(9,'/storage/media/61657269616c2d766965772d6f696c2d6761732d696e647573747269616c6f696c2d3236306e772d313039393633343936302e6a7067.jpeg',0),(10,'/storage/media/6865726f2d683030332d696e642d7265662d6f696c726566696e6572792d3030342e6a7067.jpeg',0),(11,'/storage/media/6d61702e737667.svg',0),(12,'/storage/media/626c6f6227df8a2d86efcd2b4674716488c41b854cdf82a954727ca7d83218eef9b36899a1ca5c204791c3a4.png',0),(13,'/storage/media/626c6f6220c48e210aa99712c548fdc247ace0550154688d0e04e60cde3d8990f1c4bad2360111e6956ddfcd.png',0),(14,'/storage/media/626c6f625a49b610cf3e5a6543421bea72aa9475b072f00eb19e94b1d9145e288cadcc01524589bbe089d44c.png',0),(15,'/storage/media/626c6f626a9e1e2bc9fa7b66d844d42a7bbe26a6205a047f5f579e6a88f3f4c4a32b29c968d838d421e169ca.png',0),(16,'/storage/media/626c6f62efb5cb2c5ce664e01c71aae97913427ac684bba564d99df659545d5817387bd6c11b5d08fe0e0eb1.png',0),(17,'/storage/media/626c6f6232eaf6cfb3b951186282b92a6a0a5b57e292a0d3b40543e6881c47faa9b497d5359d62f8f6225e59.png',0),(18,'/storage/media/626c6f62452457dcf665d71c617f6827ae968066e7350571df0a6e20a00f8bbaf6e6ac07bf89fddfb20507b6.png',0),(19,'/storage/media/626c6f6260b8572cacfa44a67549e228e966fede5070416549ec0e1cb1346da9242e9cf7f87da8a0f2502deb.png',0),(20,'/storage/media/626c6f6234b981eecbb30fb14b5b4f84975db8be8c93d0054d8ca46359c7c47c47d6db1cfd408d9e32b2390b.png',0),(21,'/storage/media/626c6f62026b7cca6949eafd47c1c312086969085e7135d665eb9a0ec2b10d6d9492e60fce683ca946b11ebd.png',0),(22,'/storage/media/626c6f62af0b4f71ab94ee65a6396e18a7e931603547dbbafa7e357ee0de98bd7b3b4f3a12aacf9de3056608.png',0),(23,'/storage/media/626c6f6203b195439af16d0d67de36adc46a180078d8ec13d875aa7cf0fa87200c51fb0268794acb3d2a337f.png',0),(24,'/storage/media/626c6f62d911ccfe841b45628386d7cfa60d383d4eb7d8ce97eecb0e660182bb477dfd6aad3562b8bf416c07.png',0),(25,'/storage/media/626c6f628dfa21f7a3ef3e9456ade5b9ed993df9806836efe7b83366e48e99bee64c7b70e476e293631f4424.png',0),(26,'/storage/media/626c6f62634ecb880b06d1ef96c63befa6eb2dbf4600819eb0fc1fd2766729e0aa15ef9e90820edcaad39a4d.png',0),(27,'/storage/media/626c6f620995a07a52f4e231ba2435551e74b8d867f4b7b413613f5c792bf6078c0dcf59121fe62da236e481.png',0),(28,'/storage/media/626c6f62839320ce1d8c03ec653a6ab9ebee211aac96eba55ed4efb05c966b1db8a3a7a883b2634b8756a53f.png',0),(29,'/storage/media/626c6f622c6f8c4524d0c7ebeb81452edc5bd4d87a230522f97c750308b431095743f21cd6f3edad5eaadbeb.png',0),(30,'/storage/media/626c6f62572e57fd06ea91b2970eb9c10afefd937bbd0d7ac09b1544769f621a979eee8f5ee96f7efe0e9053.png',0),(31,'/storage/media/626c6f627583d59f91417da5a6182b0f20d7a0d5a2241ea44fd3d686ff0389b5bf0c4cd15b2750b2108c4509.png',0),(32,'/storage/media/626c6f622bed31d41d33a6f45f0b819c8feb108822bce66d0755e32071c5633b0cd698138656f7c617431139.png',0),(33,'/storage/media/626c6f624069daf370d7c0e67d782a8af4c69ab51fecec74fc4a7d0ca6995cefea1afebc2e897a9edc9382d6.png',0),(34,'/storage/media/626c6f62c759e0a18edf028ed4b6ad85e2dbd07de6b585dba4901a1dfb117bffa875061b73281cdda7bdecf8.png',0),(35,'/storage/media/626c6f624d394c1f1d096abcaf89af95676188df4c610ac7928fd005ceb5eaeea1db7d9cd0669f093010d649.png',0),(36,'/storage/media/626c6f62496a44af653c8adb5c4f86ae01eb4eef709b4d1088bb99272c7900760b7282040804eca44e401ac9.png',0),(37,'/storage/media/626c6f62e5ac37ae65fba8c8a33eb879f1c6b8b5d6bf48c910ae3d1274d03fb07f13e23b943e2118045785d9.png',0),(38,'/storage/media/626c6f6228d25bad4a8766b72d85705f63698a1b6ae5ffdb8c915ade01d57ca57e9b6404738885634f6a78ff.png',0),(39,'/storage/media/626c6f62fbd8f04aad3672e9c568ef661a44a3abdd316206406888c115fdb68efc0344729c6f1d35e30393c6.png',0),(40,'/storage/media/626c6f62cc30bf1cfbfdde3b0412b89b0a082242cba90c03ec37a10b6522d16afa3d0cf21a04af57037dd2da.png',0),(41,'/storage/media/626c6f62ab7afe915be091b876942a07e2c1f0036f4ad607bdbc1d44ca84813681e4d1402e60a49d726780f3.png',0),(42,'/storage/media/626c6f62ec493842ac6321740b4ea5c5f3c1432eec7e0e029589243694edda31f34f5a75e6bbd7d06692d730.png',0),(43,'/storage/media/626c6f62ad9c553f36c764752d70086d13d2ea1db5d55bcf5472a7cfba6c53e96f16cbb93bb2c2270562f9dc.png',0),(44,'/storage/media/626c6f625bad3e117e6503d2032299d5195ceafc96f4d43c237a456b5bc35df2a837e46bfe2497fe16246062.png',0),(45,'/storage/media/626c6f627c6668df3ecb7c8c855104e448e02cc564e0d22ff8ee235a2f61fccaacd6940b1ecaee3fb08263e8.png',0),(46,'/storage/media/626c6f62633a9355f817b235879ac587731e3c081eb7adb2781294630e36adeca8f69494c0e7d5e106d41dec.png',0),(47,'/storage/media/626c6f62a8833197f680980aac1c819174719fb4ad2708c927789e1895ce3c5bdfda51fbfb4f0f5da185d02a.png',0),(48,'/storage/media/626c6f625490e40dcb8a1f8ba3b426574d2401d235b9e057f7d7505b7ebc71170386050c4ba9eda77e9cdc70.png',0),(49,'/storage/media/626c6f629d93b5af937edfc5b04e25c93e99a81f383e4f84bc1a38cb91b413ab55f0ead587bba8c97f0dd602.png',0),(50,'/storage/media/626c6f62b4e9bae108265c15bab0c8265149cf31870ea5b08b5fb0cd73e8e501c272462b8f9537bb14d5143c.png',0),(51,'/storage/media/626c6f620ff3e0dbcf7a7eb3d7b98f2df84b014cdc450fe89f1f3cd6d8390f0437ee6cf7bb27a6f8f572090b.png',0),(52,'/storage/media/626c6f629a237bf08b0d757245af0098868aaf7dc6421c11b0bcd59d11333828f3ca91c6c5c672fd9af8a2d0.png',0),(53,'/storage/media/626c6f62d28b8162e11ad4607bdc63118ef18c76c5d7945504db062c4b1fbcd3c7ffc0ea638c2bbc5b51d1a8.png',0),(54,'/storage/media/626c6f62bf22b7c1d52921614879f29e7b5695e6e28c603c9be8eb0b40a2db58a0874b1e30a234419f154195.png',0),(55,'/storage/media/626c6f62a6a118e920859f334c8f8684ce1614f0050c8f82a4bea0698884015987029bb3076737ad3d7e6a0d.png',0),(56,'/storage/media/626c6f62c7c5ef56a3f7bfeb8e6809a1934f46fc147787aa48404a838108c293e10b3e318c91d08f7e0173cc.png',0),(57,'/storage/media/626c6f6212bfa86639917e8822173887d89b7a9f1419070e2c93d973b0de896a2b6d3a73c82c46e99556076a.png',0),(58,'/storage/media/626c6f62f7bc5c721a5a836c547e3749fcfe63c8161307b32568942b5a5a56b1e703fd604e17fe0a1e07c245.png',0),(59,'/storage/media/626c6f625a237022c7a85b0499a9848dd7365415a536fa3fb941c8e59d938541a3fe889e778d3d922e7516ff.png',0),(60,'/storage/media/626c6f62c2be5033ab4066354b92b846243e2e828751d1c25ecc25d8bf4ccd753e0d0ecb420bd940ebe559ca.png',0),(61,'/storage/media/626c6f62a4f7a350112954e418d104bac922b2a7cc9620b957e83e1b4b96328fe1ad0dde261da4aea8a829ca.png',0),(62,'/storage/media/626c6f629df0f8db1e308f787f6290a5fb846f5578d47ff086631bb857fc42f2905e86ea85993b893c6d4076.png',0),(63,'/storage/media/626c6f62743f344f20657768ebedb7130f8793ddffe20a8805649194bcec758da5d4b8b8b0c02d0cd78f0c2e.png',0),(64,'/storage/media/626c6f620c487cfb3c8d7c23db9b3168cb86828ad19d79642965f3bdd979b88951768a52f6fe2a2e0dd426b6.png',0),(65,'/storage/media/626c6f62ece4464ec8b65db2c9f25c95a55f486fbf1d2f8116b9157f4f10fffe5a4bc1a9a5a1d5f4d1c4d1ad.png',0),(66,'/storage/media/626c6f6292c0c0fce4bfae8fb7eef7920906b9647d649ad6331f18962d179063a66d8fe6b0c46f913dd6067a.png',0),(67,'/storage/media/626c6f625920c648a1804ba2ab0e43f4d945bd9fd851610bcf6bf7c50675563db1466665b7c094c5e992592c.png',0),(68,'/storage/media/626c6f6225bcbcf59edaa14cc87679b6ed45807a2abd7a7db4588973737c12b54b52b76623f389c62b2a08fa.png',0),(69,'/storage/media/626c6f626baba1ffc30c6060fb7e998ef692664aa825f93ecac20cde6e17bee90c495d52cf92c077d388459f.png',0),(70,'/storage/media/626c6f627f60a216acea526d35b28526b46630041cde6bf6161fb98ec3c4519ecad622f2182f0c4c90e3b9d4.png',0),(71,'/storage/media/626c6f62d9434329f694f298003f3d01b456bfb3decf938f12577f188d28a58ba507259d142ee0a726ca1b29.png',0),(72,'/storage/media/626c6f62c6b327331805f4b28bf789e0b40f0dd3221da1ff3e17f1623c1edcb5b67070bdbb19fd9861949c65.png',0),(73,'/storage/media/626c6f62d54bec9ca2b9c18beded495e9175194881ecd3761d13fca6d973b06ed23b9c120184edeeab41f27e.png',0),(74,'/storage/media/626c6f62c85b20a5b552237f974c60c64902cd50796d219b7dc42dd6270a33310c2752fb5bd2b33c09120dfe.png',0),(75,'/storage/media/626c6f6259b15a9ee54e954bc5da4e5a59290eedcc539f8d55ecb5677c384bf0cf4218aab15188e2db12b321.png',0),(76,'/storage/media/626c6f62c87c2b80ec50c76d315d94611af9a6a4aae0c30d42157a8aa096a3fdaff7cd0e710722e10518727c.png',0),(77,'/storage/media/626c6f62840e898f861b4e8acdc32fa692d0348f24b3f331393006eac98993e82d75924791c2748aac90be7b.png',0),(78,'/storage/media/6c6f6e646f6e2d6d61702d302e6a706758796b097ce58d0c46de0aae67f694652b987c078ffe0acc8b4d40f2d3681f0d60d99aa923e5fb39.jpeg',0),(79,'/storage/media/626c6f62680fbd9355121316fd05a1e9ba1737ed3866e446e5bb0f342dbf5f2739be25b582b15ea6e1e5a334.png',0),(80,'/storage/media/626c6f622cc7ca43026ff77a6abca7e08005898e44f31e5690f70a1bb9639bf6476380c40d8044f04f06e88f.png',0),(81,'/storage/media/626c6f62271cfbbdaab2fcc991fa7b8fb43632a746732afa55aaa287ad739167f02d7ba1999d6799a1451ea4.png',0),(82,'/storage/media/706c6174746567726f6e642043432e737667b24533364a244a6af7ab0d0d54b32f4b838abe4a3b015b1f627dd11d3b9d516cabe070970890f1ff.svg',0);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page` (
  `page_ID` int(11) NOT NULL AUTO_INCREMENT,
  `page_slug_ID` int(11) NOT NULL,
  `page_title` text NOT NULL,
  `page_content` text NOT NULL,
  `page_in_menu` tinyint(1) NOT NULL DEFAULT '0',
  `page_is_published` tinyint(1) NOT NULL DEFAULT '0',
  `page_is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_ID`),
  KEY `page_slug_ID` (`page_slug_ID`),
  CONSTRAINT `page_ibfk_1` FOREIGN KEY (`page_slug_ID`) REFERENCES `slug` (`slug_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,1,'Home','&lt;h1 style=&#34;text-align: center;&#34;&gt;Home&lt;/h1&gt;\r\n&lt;p style=&#34;text-align: center;&#34;&gt;Dit is de home pagina&lt;/p&gt;',3,1,1),(2,2,'404 - Pagina niet gevonden','&lt;h1 style=&#34;text-align: center;&#34;&gt;Pagina niet gevonden&lt;/h1&gt;\r\n&lt;p style=&#34;text-align: center;&#34;&gt;Deze pagina bestaat niet.&lt;/p&gt;',3,1,0),(3,1,'Home','&lt;h1 style=&#34;text-align: center;&#34;&gt;Home pagina&lt;/h1&gt;\r\n&lt;p style=&#34;text-align: center;&#34;&gt;Dit is de home pagina.&lt;/p&gt;',3,1,0),(4,3,'Concerten','&lt;h2 style=&#34;text-align:center;&#34;&gt;Concerten&lt;/h2&gt;&lt;p style=&#34;text-align:center;&#34;&gt;De volgende concerten worden gehouden in deze maand.&lt;/p&gt;',0,0,0),(5,4,'Statisch','&lt;h1 style=&#34;text-align: center;&#34;&gt;Statisch&lt;/h1&gt;\r\n&lt;p style=&#34;text-align: center;&#34;&gt;Dit is een statische pagina.&lt;/p&gt;',3,1,1),(6,6,'Tiny MCE','&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;h2 style=&#34;text-align: center;&#34;&gt;&lt;img style=&#34;float: left;&#34; title=&#34;CC Westeinde&#34; src=&#34;/storage/media/57656273697465205765737465696e64652e706e67.png&#34; alt=&#34;CC Westeinde ruimte&#34; width=&#34;500&#34; height=&#34;313&#34; /&gt;&lt;/h2&gt;\r\n&lt;h2 style=&#34;text-align: center;&#34;&gt;&lt;img style=&#34;float: right;&#34; title=&#34;CC Westeinde&#34; src=&#34;/storage/media/57656273697465205765737465696e64652e706e67.png&#34; alt=&#34;CC Westeinde ruimte&#34; width=&#34;500&#34; height=&#34;313&#34; /&gt;&lt;/h2&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;h2 style=&#34;text-align: center;&#34;&gt;&amp;nbsp;&lt;/h2&gt;\r\n&lt;h2 style=&#34;text-align: center;&#34;&gt;&amp;nbsp;&lt;/h2&gt;\r\n&lt;h2 style=&#34;text-align: center;&#34;&gt;&amp;nbsp;&lt;/h2&gt;\r\n&lt;h2 style=&#34;text-align: center;&#34;&gt;&amp;nbsp;&lt;/h2&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;h2 style=&#34;text-align: center;&#34;&gt;&amp;nbsp;&lt;/h2&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;h1 style=&#34;text-align: center;&#34;&gt;&lt;span style=&#34;font-family: &#39;arial black&#39;, sans-serif;&#34;&gt;The Flavorful Tuscany Meetup&lt;/span&gt;&lt;/h1&gt;\r\n&lt;h3 style=&#34;text-align: center;&#34;&gt;Welcome letter&lt;/h3&gt;\r\n&lt;p&gt;Dear Guest,&lt;/p&gt;\r\n&lt;p&gt;We are delighted to welcome you to the annual &lt;em&gt;Flavorful Tuscany Meetup&lt;/em&gt; and hope you will enjoy the programme as well as your stay at the &lt;a href=&#34;http://ckeditor.com&#34;&gt;Bilancino Hotel&lt;/a&gt;.&lt;/p&gt;\r\n&lt;p&gt;Please find below the full schedule of the event.&lt;/p&gt;\r\n&lt;figure class=&#34;table&#34;&gt;\r\n&lt;table&gt;\r\n&lt;thead&gt;\r\n&lt;tr&gt;\r\n&lt;th colspan=&#34;2&#34;&gt;Saturday, July 14&lt;/th&gt;\r\n&lt;/tr&gt;\r\n&lt;/thead&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;9:30 AM - 11:30 AM&lt;/td&gt;\r\n&lt;td&gt;\r\n&lt;p&gt;&lt;strong&gt;Americano vs. Brewed&lt;/strong&gt; - &amp;ldquo;know your coffee&amp;rdquo; with:&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Giulia Bianchi&lt;/li&gt;\r\n&lt;li&gt;Stefano Garau&lt;/li&gt;\r\n&lt;li&gt;Giuseppe Russo&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;1:00 PM - 3:00 PM&lt;/td&gt;\r\n&lt;td&gt;\r\n&lt;p&gt;&lt;strong&gt;Pappardelle al pomodoro&lt;/strong&gt; - live cooking&lt;/p&gt;\r\n&lt;p&gt;Incorporate the freshest ingredients&amp;nbsp;&lt;br /&gt;with Rita Fresco&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td&gt;5:00 PM - 8:00 PM&lt;/td&gt;\r\n&lt;td&gt;&lt;strong&gt;Tuscan vineyards at a glance&lt;/strong&gt; - wine-tasting&amp;nbsp;&lt;br /&gt;with Frederico Riscoli&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/figure&gt;\r\n&lt;blockquote&gt;\r\n&lt;p&gt;The annual Flavorful Tuscany meetups are always a culinary discovery. You get the best of Tuscan flavors during an intense one-day stay at one of the top hotels of the region. All the sessions are lead by top chefs passionate about their profession. I would certainly recommend to save the date in your calendar for this one!&lt;/p&gt;\r\n&lt;p&gt;Angelina Calvino, food journalist&lt;/p&gt;\r\n&lt;/blockquote&gt;\r\n&lt;p&gt;Please arrive at the &lt;a href=&#34;http://ckeditor.com&#34;&gt;Bilancino Hotel&lt;/a&gt; reception desk &lt;mark class=&#34;marker-yellow&#34;&gt;at least half an hour earlier&lt;/mark&gt; to make sure that the registration process goes as smoothly as possible.&lt;/p&gt;\r\n&lt;p&gt;We look forward to welcoming you to the event.&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Victoria Valc&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Event Manager&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Bilancino Hotel&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;',0,1,0),(7,7,'test','&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;',0,1,1),(8,12,'Test url','&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;p&gt;test&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;',0,1,1);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project` (
  `project_ID` int(11) NOT NULL AUTO_INCREMENT,
  `project_thumbnail_ID` int(11) NOT NULL,
  `project_banner_ID` int(11) NOT NULL,
  `project_header_ID` int(11) NOT NULL,
  `project_title` text NOT NULL,
  `project_content` text NOT NULL,
  `project_is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`project_ID`),
  KEY `project_thumbnail_ID` (`project_thumbnail_ID`),
  KEY `project_banner_ID` (`project_banner_ID`),
  KEY `project_header_ID` (`project_header_ID`),
  CONSTRAINT `project_ibfk_1` FOREIGN KEY (`project_thumbnail_ID`) REFERENCES `file` (`file_ID`),
  CONSTRAINT `project_ibfk_2` FOREIGN KEY (`project_banner_ID`) REFERENCES `file` (`file_ID`),
  CONSTRAINT `project_ibfk_3` FOREIGN KEY (`project_header_ID`) REFERENCES `file` (`file_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,67,69,70,'Gamedesign  |  ICT en VE','&amp;lt;h1&amp;gt;Gamedesign&amp;lt;/h1&amp;gt;\r\n&amp;lt;p&amp;gt;Kan je een game ontwerpen en deze viral laten gaan?&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;Met deze opdracht als uitdaging zijn studenten ICT en Mediavormgeving aan de slag gegaan. Bedenk een concept, een thema en communicatieplan en bouw vervolgens als team deze game. Binnen 10 weken moest deze game gerealiseerd zijn. Met een grote presentatie is het eindresultaat aan de klant overhandigd.&amp;amp;nbsp;&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;&amp;amp;nbsp;&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;&amp;lt;video controls=&amp;#34;controls&amp;#34; width=&amp;#34;300&amp;#34; height=&amp;#34;150&amp;#34;&amp;gt;\r\n&amp;lt;source src=&amp;#34;https://www.facebook.com/586782101708811/videos/606886006365087/&amp;#34; /&amp;gt;&amp;lt;/video&amp;gt;&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;&amp;amp;nbsp;&amp;lt;/p&amp;gt;',0),(2,64,65,66,'Maakshop  |  CC Westeinde','&amp;lt;h1&amp;gt;Maakshop&amp;lt;/h1&amp;gt;\r\n&amp;lt;p&amp;gt;Binnenkort in CC Westeinde: De mogelijkheid voor studenten om verslagen te laten inbinden/bedrukken, items te laten vervaardigen en projecten te laten uitvoeren. Al deze mogelijkheden worden gebundeld in de Maakshop. In opdracht van CC Westeinde wordt voor het presenteren van dit idee een logo ontwikkeld en verschillende items met dit logo bedrukt. Studenten regelen het frezen van een broodplank en het bedrukken van een schort.&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;Klant: CC Westeinde&amp;lt;/p&amp;gt;',0),(7,71,72,73,'VE Awards  |  Diploma-uitreiking','&amp;lt;p&amp;gt;VE Awards&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;&amp;amp;nbsp;&amp;lt;/p&amp;gt;\r\n&amp;lt;p&amp;gt;Voor de diploma-uitreiking van schooljaar 2018-2019 is een thema met daarbijhorende vormgeving gereailseerd door studenten vierdejaars.&amp;lt;/p&amp;gt;',0);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setting` (
  `setting_ID` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` text NOT NULL,
  `setting_value` text NOT NULL,
  `setting_is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`setting_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,'bedrijf_email','bedrijf@email.nl',0),(2,'test','test',1);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slug`
--

DROP TABLE IF EXISTS `slug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slug` (
  `slug_ID` int(11) NOT NULL AUTO_INCREMENT,
  `slug_name` text NOT NULL,
  `slug_is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`slug_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slug`
--

LOCK TABLES `slug` WRITE;
/*!40000 ALTER TABLE `slug` DISABLE KEYS */;
INSERT INTO `slug` VALUES (1,'home',0),(2,'pagina-niet-gevonden',0),(3,'concerten',0),(4,'statisch',0),(5,'kceditor',0),(6,'tinymce',0),(7,'test',0),(8,'test-url',0),(9,'test-url-fkkfak   kkfak',0),(10,'test-url-fkkfak+++kkfak',0),(11,'mess39d-up-text-just-to-stress-test-our-little-clean-url-function-gt',0),(12,'mess-d-up-text-just-to-stress-test-our-little-clean-url-function-gt',0);
/*!40000 ALTER TABLE `slug` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translation`
--

DROP TABLE IF EXISTS `translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `translation` (
  `translation_ID` int(11) NOT NULL AUTO_INCREMENT,
  `translation_name` text NOT NULL,
  `translation_value` text NOT NULL,
  `translation_language` varchar(2) NOT NULL DEFAULT 'nl',
  `translation_is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`translation_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translation`
--

LOCK TABLES `translation` WRITE;
/*!40000 ALTER TABLE `translation` DISABLE KEYS */;
INSERT INTO `translation` VALUES (1,'call_to_action_bedrijf_tekst','Wilt u meer weten, een project inbrengen of een afspraak plannen?','nl',0),(2,'call_to_action_bedrijf_knop_tekst','Informatie &amp;gt;','nl',0),(3,'call_to_action_student_tekst','Wil je informatie over lopende projecten of een werkplek reserveren?','nl',0),(4,'call_to_action_student_knop_tekst','Informatie &amp;gt;','nl',0),(5,'call_to_action_meet_the_expert_tekst','Inspirerende sessies waarin experts uit het vakgebied ervaringen delen!','nl',0),(6,'project_bekijken_knop_tekst','Bekijken &amp;gt;','nl',0),(7,'projecten_foto_alt_tekst','Projecten','nl',0),(8,'call_to_action_bedrijf_foto_alt_tekst','Bedrijf','nl',0),(9,'call_to_action_student_foto_alt_tekst','Student','nl',0),(10,'call_to_action_meet_the_expert_foto_alt_tekst','Meet the Expert','nl',0),(11,'call_to_action_bedrijf_contact_titel','Contact','nl',0),(12,'call_to_action_bedrijf_contact_tekst','Bent u geïntereseerd of heeft u een project. Neem contact op!','nl',0),(13,'call_to_action_bedrijf_contact_knop_tekst','Contact opnemen &amp;gt;','nl',0),(14,'formulier_werkveld_label','Werkveld','nl',0),(15,'formulier_werkveld_kiezen','Kies werkveld:','nl',0),(16,'formulier_email','Email','nl',0),(17,'formulier_email_placeholder','Typ email','nl',0),(18,'formulier_onderwerp','Onderwerp','nl',0),(19,'formulier_onderwerp_placeholder','Typ onderwerp','nl',0),(20,'formulier_bericht','Bericht','nl',0),(21,'formulier_bericht_placeholder','Typ bericht','nl',0),(22,'formulier_verzenden_knop','Verzenden','nl',0),(23,'call_to_action_werkplek_titel','Werkplek ','nl',0),(24,'call_to_action_werkplek_tekst','Werkplek reserveren','nl',0),(25,'call_to_action_werkplek_knop_tekst','Reserveren &amp;gt;','nl',0),(26,'call_to_action_meet_the_expert_aanmelden_titel','Meet the Expert','nl',0),(27,'call_to_action_meet_the_expert_aanmelden_tekst','Aanmelden voor hele leuke Meet the Experts','nl',0),(28,'call_to_action_meet_the_expert_aanmelden_knop_tekst','Aanmelden &amp;gt;','nl',0),(29,'call_to_action_meet_the_expert_aanmelden_overzicht_titel','Binnenkort bij CC Westeinde','nl',0),(30,'call_to_action_meet_the_expert_archief_overzicht_titel','Wat geweest is','nl',0),(31,'call_to_action_meet_the_expert_bekijk_alles_knop_tekst','Bekijk alles &amp;gt;','nl',0),(33,'meet_the_expert_aanmelden_locatie','Locatie:','nl',0),(34,'meet_the_expert_aanmelden_datum','Datum:','nl',0),(35,'meet_the_expert_aanmelden_tijdstip','Tijdstip:','nl',0),(36,'meet_the_expert_aanmelden_beschikbare_plekken','Beschikbare plekken:','nl',0),(37,'meet_the_expert_aanmelden_ingeschreven_tekst','Je bent ingeschreven voor deze Meet the Expert.','nl',0),(38,'meet_the_expert_aanmelden_is_vol_tekst','Deze Meet the Expert is vol','nl',0),(39,'meet_the_expert_aanmelden_knop_tekst','Aanmelden &amp;gt;','nl',0),(40,'meet_the_expert_aanmelden_is_niet_meer_mogelijk_tekst','Voor deze Meet the Expert kan niet meer worden aangemeld.','nl',0),(41,'formulier_welke_werkplek_reserveren_kiezen_tekst','Wat wil je reserveren?','nl',0),(42,'formulier_volgende_knop_tekst','Volgende','nl',0),(43,'werkplek_reserveren_plattegrond_foto_alt_tekst','Plattegrond','nl',0),(44,'formulier_datum','Datum','nl',0),(45,'formulier_dagdeel','Dagdeel','nl',0),(46,'formulier_vorige_knop_tekst','Vorige','nl',0),(47,'formulier_werkplek','Werkplek','nl',0),(48,'formulier_reserveren_knop_tekst','Reserveren &amp;gt;','nl',0),(49,'formulier_tijdstip','Tijd','nl',0),(50,'formulier_duur','Duur','nl',0),(51,'formulier_duur_optie_half_uur','Half uur','nl',0),(52,'formulier_duur_optie_uur','1 uur','nl',0),(53,'formulier_duur_optie_anderhalf_uur','Anderhalf uur','nl',0),(54,'formulier_duur_optie_2_uur','2 uur','nl',0),(55,'meet_the_expert_aanmeldingen_beheren','Meet the Expert aanmeldingen beheren','nl',0),(56,'werkplek_reserveringen_beheren','Werkplek reserveringen beheren','nl',0),(57,'vergaderruimte_reserveringen_beheren','Vergaderruimte reserveringen beheren','nl',0),(58,'menu_item_bedrijf','Bedrijf','nl',0),(59,'menu_item_student','Student','nl',0),(60,'menu_item_meet_the_expert','Meet the Expert','nl',0),(61,'menu_item_projecten','Projecten','nl',0),(62,'menu_item_werkwijze','Werkwijze','nl',0),(63,'menu_item_contact','Contact','nl',0),(64,'menu_item_werkplek_reserveren','Werkplek reserveren','nl',0),(65,'menu_item_aanmeldingen_en_reserveringen_beheren','Aanmeldingen en reserveringen beheren','nl',0),(66,'menu_item_meet_the_experts_beheren','Meet the Expert sessies beheren','nl',0),(67,'menu_item_meet_the_expert_aanmeldingen_beheren','Meet the Expert aanmeldingen beheren','nl',0),(68,'menu_item_werkplek_reserveringen_beheren','Werkplek reserveringen','nl',0),(69,'menu_item_vergaderruimte_reserveringen_beheren','Vergaderruimte reserveringen','nl',0),(70,'menu_item_aanmelden_voor_meet_the_expert','Aanmelden voor Meet the Expert','nl',0),(71,'formulier_verzenden','Verzenden','nl',0),(72,'meet_the_expert_aanmelden_titel','Aanmelden','nl',0),(73,'meet_the_expert_aanmelden_tekst_voor_sessie_titel','Aanmelden voor','nl',0);
/*!40000 ALTER TABLE `translation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-14 18:59:10
