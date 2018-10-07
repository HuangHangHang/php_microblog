-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2018-10-05 10:35:32
-- 服务器版本： 5.5.53
-- PHP 版本： 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `microblog`
--

-- --------------------------------------------------------

--
-- 表的结构 `tb_at`
--

CREATE TABLE `tb_at` (
  `id` int(8) UNSIGNED NOT NULL,
  `user_id` int(8) NOT NULL,
  `post_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tb_collect`
--

CREATE TABLE `tb_collect` (
  `id` int(8) UNSIGNED NOT NULL,
  `user_id` int(8) NOT NULL,
  `post_id` int(8) NOT NULL,
  `status` tinyint(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tb_friends`
--

CREATE TABLE `tb_friends` (
  `id` int(8) UNSIGNED NOT NULL,
  `user_id` int(8) NOT NULL,
  `friend_id` int(8) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `addtime` char(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tb_post`
--

CREATE TABLE `tb_post` (
  `id` int(8) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `addtime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_id` int(8) NOT NULL,
  `pid` int(8) NOT NULL DEFAULT '0',
  `post_type` tinyint(1) NOT NULL DEFAULT '0',
  `parent_user_id` int(8) NOT NULL DEFAULT '0',
  `pictures` text,
  `forward_num` int(8) NOT NULL DEFAULT '0',
  `comment_num` int(8) NOT NULL DEFAULT '0',
  `praise_num` int(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tb_praise`
--

CREATE TABLE `tb_praise` (
  `id` int(8) UNSIGNED NOT NULL,
  `user_id` int(8) NOT NULL,
  `post_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(8) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `addtime` char(10) NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `qq` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `posts_num` int(8) DEFAULT '0',
  `follows_num` int(8) DEFAULT '0',
  `fans_num` int(8) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `addtime`, `sex`, `qq`, `email`, `avatar`, `posts_num`, `follows_num`, `fans_num`) VALUES
(1, '亚当', '123456', '2018-10-3', 1, '2361916156', '2361916156@1qq.com', 'header_img03.jpeg', 0, 0, 0),
(2, '夏娃', '12345', '2017-7-10', 0, '453656896', '15478965@163.com', 'header_img01.jpeg', 0, 0, 0),
(3, '大胖子', '12345', '2018-2-22', 1, '23658974', '23658974@qq.com', 'header_img02.jpg', 0, 0, 0);

--
-- 转储表的索引
--

--
-- 表的索引 `tb_at`
--
ALTER TABLE `tb_at`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_a_u` (`user_id`),
  ADD KEY `fk_a_po` (`post_id`);

--
-- 表的索引 `tb_collect`
--
ALTER TABLE `tb_collect`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_c_u` (`user_id`),
  ADD KEY `fk_c_po` (`post_id`);

--
-- 表的索引 `tb_friends`
--
ALTER TABLE `tb_friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_f_u` (`user_id`);

--
-- 表的索引 `tb_post`
--
ALTER TABLE `tb_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_p_u` (`user_id`);

--
-- 表的索引 `tb_praise`
--
ALTER TABLE `tb_praise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_p_u` (`user_id`),
  ADD KEY `fk_p_po` (`post_id`);

--
-- 表的索引 `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tb_at`
--
ALTER TABLE `tb_at`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `tb_collect`
--
ALTER TABLE `tb_collect`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `tb_friends`
--
ALTER TABLE `tb_friends`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `tb_post`
--
ALTER TABLE `tb_post`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `tb_praise`
--
ALTER TABLE `tb_praise`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
