-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2018 at 12:30 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nxs_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `nxs_customer`
--

CREATE TABLE `nxs_customer` (
  `customer_id` int(6) NOT NULL,
  `customer_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_tel` varchar(255) NOT NULL,
  `customer_plan` set('english','engineer','domestic') NOT NULL,
  `customer_other` longtext NOT NULL,
  `customer_staff` int(6) NOT NULL,
  `customer_progress` set('received','reply','interview','sent','contract') NOT NULL,
  `customer_sells` int(6) NOT NULL,
  `customer_studay` varchar(255) NOT NULL,
  `customer_duration` varchar(255) NOT NULL,
  `customer_start` varchar(255) NOT NULL,
  `customer_notice` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nxs_customer`
--

INSERT INTO `nxs_customer` (`customer_id`, `customer_modify`, `customer_name`, `customer_email`, `customer_tel`, `customer_plan`, `customer_other`, `customer_staff`, `customer_progress`, `customer_sells`, `customer_studay`, `customer_duration`, `customer_start`, `customer_notice`) VALUES
(1, '2018-04-07 20:32:52', '仙道', 'sendo@slamdunk.com', '090-1111-2222', 'english', '', 1, 'received', 0, '', '', '', ''),
(2, '2018-04-07 20:32:15', '福田', 'fukuda@slamdunk.com', '13', 'english', '2年、188cm 80kg、背番号13、パワーフォワード（PF）。\r\nバッシュ：コンバースアクセレレーターRS1HI\r\nディフェンスは非常に不得意だが、粘り強いプレイでチームにガムシャラな勢いをもたらすことのできるスコアラー。\r\nバスケ経験は中学2年の終わりごろからで浅く、高校入学当初は新入生の中でも一番下手だったが、仙道を過剰に意識し、ガムシャラなプレイスタイルと急速な成長スピードを持つ。', 1, 'interview', 0, '', '', '', ''),
(3, '2018-04-07 20:36:29', '牧', 'maki@slamdunk.com', '12', 'domestic', '3年、184cm 79kg、背番号12（1年）→8（2年）→4、G。\r\nバッシュ：リーボック', 2, 'contract', 0, '特になし', '6', '2018年3月20日', '主将。1年の頃から怪物と呼ばれ、3年間常に神奈川の頂点を走り続けてきながらも、一切それに驕ることなく自らを鍛え続けると共に貪欲に勝利を求め続ける姿勢を持つ。\r\n\r\n「神奈川No.1プレイヤー」や「帝王」とも称される実力者で、自身が神奈川No.1の存在であることも自負しており、桜木もうらやむ全国区の知名度を持つ。\r\n\r\n今年度のインターハイ神奈川県予選では神奈川ベスト5および最優秀選手に選出され、湘北戦ではチーム最多の30得点を記録したうえ、他の2項目は不明だがトリプル・ダブルを達成した。'),
(4, '2018-04-07 20:38:17', '神', 'gin@slamdunk.com', '090-6666-6666', 'domestic', '声 - 林延年\r\n2年、189cm 71kg、背番号6、SF。\r\nバッシュ：ナイキ', 2, 'interview', 0, '', '', '', '身体能力は高くないが、託されたボールを確実にバスケットに収めることができるピュアシューター。\r\n入部当初のポジションはセンターだったが線が細く、練習で牧や高砂に何度も吹っ飛ばされ続け、高頭にも「センターは到底無理だ」と言われたほか、「何も持たない選手」と評された。その後は1日500本のシューティング練習を毎日欠かさず続け、シューターとしての才能を開花し海南のスタメンの座を射止める。'),
(5, '2018-04-07 20:40:26', '清田', 'kiyota@slamdunk.com', '090-10101-1010', 'english', '声 - 森川智之\r\n1年、178cm 65kg、背番号10、SG[66]。\r\nバッシュ：リーボック', 2, 'contract', 19808, '', '4', '2018年4月20日', '本作中、最も身長の低いダンクシューター。ルーキー離れした能力を買われ、1年にして海南のスタメンの座を射止める。花道同様、流川への敵愾心が強い。湘北戦では最終的にチームで牧、神に次ぐ18得点を記録した。\r\n\r\n礼儀知らずでほぼうぬぼれ屋の自信家、非常に目立ちたがり屋な性格、試合中につくづく相手につっかかること、\r\n\r\n驚異的な身体能力、同じ背番号10番など、花道とは共通点が多く、流川への敵愾心も強いところから、お互い、「赤毛猿（あかげざる）」「野猿（のざる）」「猿（さる）」などと呼び合う。');

-- --------------------------------------------------------

--
-- Table structure for table `nxs_user`
--

CREATE TABLE `nxs_user` (
  `user_id` int(6) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` set('admin','sells') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nxs_user`
--

INSERT INTO `nxs_user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_role`) VALUES
(1, '赤城', 'akagi@slamdunk.com', '4', 'admin'),
(2, '桜木', 'sakuragi@slamdunk.com', '10', 'sells'),
(3, '安西先生', 'anzai@slamdunk.com', '9', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nxs_customer`
--
ALTER TABLE `nxs_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `nxs_user`
--
ALTER TABLE `nxs_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nxs_customer`
--
ALTER TABLE `nxs_customer`
  MODIFY `customer_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nxs_user`
--
ALTER TABLE `nxs_user`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
