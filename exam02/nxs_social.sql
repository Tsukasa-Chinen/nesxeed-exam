-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2018 at 12:31 AM
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
-- Database: `nxs_social`
--

-- --------------------------------------------------------

--
-- Table structure for table `nxs_article`
--

CREATE TABLE `nxs_article` (
  `article_id` int(6) NOT NULL,
  `article_title` longtext NOT NULL,
  `article_content` longtext NOT NULL,
  `article_like` int(6) NOT NULL,
  `article_user` varchar(255) NOT NULL,
  `article_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `article_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nxs_article`
--

INSERT INTO `nxs_article` (`article_id`, `article_title`, `article_content`, `article_like`, `article_user`, `article_modify`, `article_token`) VALUES
(1, 'テスト記事０１', 'これは\r\n\r\nただの\r\n\r\nテストの記事です。\r\n\r\n本文の内容は何も関係ありません。', 1, '1', '2018-04-07 21:36:51', ''),
(2, '翔北 vs 陵南高校', '初めて本格的な試合のシーンが描かれたのが陵南高校との練習試合で、コミックでは3〜6巻にあたります。この練習試合まではひたすら基礎練習で、順調に実力をつけては行くものの桜木自身もあまり身が入っていない状態です。作品のテイストもこの時点ではコミカルな印象が強いですね。\n\nただし、迫力は抜群。練習試合とはいえ、キレ者のエース仙道、2m超えの魚住という強力な選手を抱えた陵南高校はかなりの強敵です。\n\n意気揚々と試合を迎える桜木ですが彼はレギュラーではなくベンチに座る補欠要員（最終兵器と言いくるめられ）で、おまけに相手チームの監督にカンチョーをして反則点を与えてしまいます。そんな彼にチャンスが訪れたのは、「ゴリ」の怪我。交代要員としてコートに立った桜木は荒削りながらも力強いプレイで味方を沸かせます。しかし残り数秒というところでシュートを決められてしまい敗退。\n\n悔しい結果ではあったものの、桜木の実力にスポットが当たるきっかけとなった試合で、バスケに対する熱意に目覚め始めます。', 1, '1', '2018-04-07 21:37:28', '5ac939d3c9b91'),
(3, '翔北 vs 翔陽高校', 'インターハイ県予選の翔陽高校戦は、これで決勝リーグへの進出が決まるか否かの大勝負。\n\n翔陽高校は前年に準優勝を飾った強豪校で、県内外から協力な選手を集めているという手強い相手です。ひとつ前の三浦台戦では倍以上の点差をつけて勝利しましたが、今度はそうも行きません。\n\n試合開始直後は主要選手がベンチ待機という、あきらかに湘北を見下した戦法を取ってきます。これはある種の挑発ですから頭脳戦であるともいえます。試合を見てもパワー押しではなく技工や連携を武器にした緻密なプレイを繰り広げてきます。\n\n前回の三浦台戦では相手チームの選手に（リングではなく）おもいっきりダンクシュートを決め退場となりましたが、今回はそういうおイタは控えようとしている様子。しかし、ボールを取られそうになった拍子に上げた肘が相手選手、花形の顔にヒット。これでファールを取られてしまった桜木は後がなくなり、思うようなプレイが出来なくなってしまいます。桜木はこれまでの試合で必ず退場になっているのです。\n\nその後も奮闘を続け、残り2分で華麗なダンクシュートを決めますが、その過程でファールを取られてしまい退場します。残された時間は1分50秒。桜木の代わりに入った角田の活躍によってわずか2点差で翔陽高校に勝利したのでした。\n\n', 0, '1', '2018-04-07 21:38:12', '5ac93a443736f');

-- --------------------------------------------------------

--
-- Table structure for table `nxs_comment`
--

CREATE TABLE `nxs_comment` (
  `comment_id` int(6) NOT NULL,
  `comment_article_id` int(6) NOT NULL,
  `comment_user_id` int(6) NOT NULL,
  `comment_content` longtext NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nxs_comment`
--

INSERT INTO `nxs_comment` (`comment_id`, `comment_article_id`, `comment_user_id`, `comment_content`, `comment_date`, `comment_token`) VALUES
(1, 2, 1, '流川きゅーーーーーーんん！', '2018-04-07 21:37:05', '5ac93a0199598'),
(2, 1, 1, 'へー！', '2018-04-07 21:38:12', '5ac93a44372fd');

-- --------------------------------------------------------

--
-- Table structure for table `nxs_user`
--

CREATE TABLE `nxs_user` (
  `user_id` int(6) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` set('admin','editor') NOT NULL,
  `user_liked_article` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nxs_user`
--

INSERT INTO `nxs_user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_role`, `user_liked_article`) VALUES
(1, '赤城', 'akagi@slamdunk.com', '4', 'admin', 0),
(2, '流川', 'rukawa@slamdunk.com', '10', 'editor', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nxs_article`
--
ALTER TABLE `nxs_article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `nxs_comment`
--
ALTER TABLE `nxs_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `nxs_user`
--
ALTER TABLE `nxs_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nxs_article`
--
ALTER TABLE `nxs_article`
  MODIFY `article_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nxs_comment`
--
ALTER TABLE `nxs_comment`
  MODIFY `comment_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nxs_user`
--
ALTER TABLE `nxs_user`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
