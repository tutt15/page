-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 02, 2019 lúc 04:31 PM
-- Phiên bản máy phục vụ: 10.4.6-MariaDB
-- Phiên bản PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_page`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `page`
--

CREATE TABLE `page` (
  `id` int(10) NOT NULL,
  `title` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'New',
  `upload` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `page`
--

INSERT INTO `page` (`id`, `title`, `content`, `status`, `upload`) VALUES
(105, 'Cho Nhá»¯ng NgÃ y Se Láº¡nh, LÃ²ng Bá»—ng Tháº¥y PhiÃªu Duâ€¦', '<p><strong>T&acirc;m Sá»±: Cho Nhá»¯ng Ng&agrave;y Se Láº¡nh, L&ograve;ng Bá»—ng Tháº¥y Phi&ecirc;u Du&hellip;</strong></p>\r\n\r\n<blockquote>\r\n<p>Gá»­i táº·ng ri&ecirc;ng cho nhá»¯ng káº» má»™ng mÆ¡<br />\r\nGá»­i táº·ng ri&ecirc;ng cho nhá»¯ng tr&aacute;i tim Ä‘&atilde; tá»«ng vá»¥n vá»¡.</p>\r\n</blockquote>\r\n\r\n<p>Khi c&ograve;n tráº», ch&uacute;ng ta Ä‘á»u kh&ocirc;ng sá»£&nbsp;<a href=\"https://ocuaso.com/tag/co-don\" title=\"\">c&ocirc; Ä‘Æ¡n</a>. Khi c&ograve;n tráº», ch&uacute;ng ta Ä‘á»u Ä‘Æ°á»£c ph&eacute;p máº¯c sai láº§m: n&ocirc;ng ná»•i; váº¥p ng&atilde;; Ä‘au Ä‘á»›n; tháº¥t báº¡i; tá»•n thÆ°Æ¡ng&hellip; táº¥t cáº£ nhá»¯ng th&aacute;ng ng&agrave;y m&agrave; ta gá»i l&agrave; thanh xu&acirc;n Ä‘&oacute; Ä‘á»u táº¡o n&ecirc;n ch&uacute;ng ta b&acirc;y giá». Nhá»¯ng con ngÆ°á»i biáº¿t y&ecirc;u c&aacute;i Ä‘áº¹p, tr&acirc;n trá»ng sá»± bao dung. NÄƒm th&aacute;ng th&igrave; d&agrave;i, cuá»™c Ä‘á»i th&igrave; ngáº¯n!</p>\r\n\r\n<p style=\"text-align:center\"><img alt=\"\" src=\"/page-master/ckeditor/kcfinder/upload/images/dalat.jpg\" style=\"height:467px; width:700px\" /></p>\r\n\r\n<p>Thá»i son tráº» ch&uacute;ng m&igrave;nh y&ecirc;u nhau, y&ecirc;u cáº£ Æ°á»›c mÆ¡ cá»§a nhau, c&ugrave;ng cá»‘ gáº¯ng v&agrave; á»§ng há»™ cho Æ°á»›c mÆ¡ cá»§a nhau. C&oacute; láº½ Ä‘&oacute; l&agrave; khoáº£ng thá»i gian Ä‘áº¹p Ä‘áº½ nháº¥t v&agrave; Ä‘&aacute;ng tr&acirc;n trá»ng nháº¥t. Dáº«u cho Æ°á»›c mÆ¡ Ä‘áº¥y Ä‘á»‘i vá»›i ngÆ°á»i Ä‘á»i l&agrave; Ä‘i&ecirc;n rá»“, l&agrave; áº£o má»™ng th&igrave; ch&uacute;ng m&igrave;nh váº«n m&atilde;i ngu ngÆ¡ theo Ä‘uá»•i n&oacute; má»™t c&aacute;ch khá» dáº¡i. Tháº­t ra, sá»‘ng tr&ecirc;n Ä‘á»i Ä‘&ocirc;i khi pháº£i má»™ng mÆ¡ má»™t ch&uacute;t, v&igrave; chá»‰ c&oacute; báº£n th&acirc;n ch&uacute;ng ta má»›i l&agrave;m n&ecirc;n nhá»¯ng Ä‘iá»u ká»³ diá»‡u. H&atilde;y cá»© mÆ¡ th&ocirc;i nhá»¯ng ngÆ°á»i tráº» áº¡, l&agrave; nhá»¯ng káº» má»™ng mÆ¡ hay nhá»¯ng káº» khá» má»™ng mÆ¡ cÅ©ng cháº³ng sao cáº£. H&atilde;y theo Ä‘uá»•i Æ°á»›c mÆ¡, l&yacute; tÆ°á»Ÿng cá»§a ch&iacute;nh báº£n th&acirc;n m&igrave;nh, v&agrave; trong Ä‘&oacute; c&oacute; cáº£&nbsp;<a href=\"https://ocuaso.com/tam-su-cuoc-song/viet-ve-tinh-yeu\" title=\"\">t&igrave;nh y&ecirc;u</a>.</p>\r\n\r\n<blockquote>\r\n<p>H&atilde;y cá»© l&agrave; t&igrave;nh nh&acirc;n<br />\r\nÄá»ƒ th&aacute;ng ng&agrave;y hoa má»™ng<br />\r\nÄá»ƒ háº¹n h&ograve; y&ecirc;u Ä‘Æ°Æ¡ng<br />\r\nV&agrave; kháº¯c khoáº£i chá» nhau.</p>\r\n</blockquote>\r\n\r\n<p style=\"text-align:center\"><img alt=\"\" src=\"/page-master/ckeditor/kcfinder/upload/images/tam-su.jpg\" style=\"height:441px; width:700px\" /></p>\r\n\r\n<p>Kh&ocirc;ng hiá»ƒu sao t&ocirc;i láº¡i kh&aacute; th&iacute;ch bá»‘n d&ograve;ng n&agrave;y, tá»« ngá»¯ kh&ocirc;ng qu&aacute; má»¹ miá»u hay bay bá»•ng nhÆ°ng Ä‘á»§ Ä‘á»ƒ gá»£n v&agrave;o l&ograve;ng nhá»¯ng con s&oacute;ng nhá»‹p nh&agrave;ng. Khi báº£n th&acirc;n báº¯t Ä‘áº§u suy nghÄ© vá» má»™t d&aacute;ng h&igrave;nh n&agrave;o Ä‘&oacute; cÅ©ng l&agrave; l&uacute;c má»i viá»‡c Ä‘&atilde; c&oacute; sá»± Ä‘á»•i thay, c&oacute; thá»ƒ ta báº¯t Ä‘áº§u &ldquo;say&rdquo;, &ldquo;say&rdquo; trong má»™t thá»© Ä‘&atilde; káº¿t Ä‘oáº¡n duy&ecirc;n t&igrave;nh. Chá»‰ l&agrave; duy&ecirc;n s&acirc;u duy&ecirc;n má»ng, báº¥t cá»© ai Ä‘á»u kh&ocirc;ng thá»ƒ náº¯m cháº¯c, tá»¥ tan Ä‘á»u kh&ocirc;ng c&oacute; c&aacute;ch g&igrave; kh&aacute;c, ch&uacute;ng ta Ä‘á»u pháº£i Ä‘á»‘i Ä‘&atilde;i báº±ng c&aacute;i t&acirc;m b&igrave;nh thÆ°á»ng.</p>\r\n\r\n<p>T&ocirc;i tá»± nhá»§ vá»›i báº£n th&acirc;n m&igrave;nh ráº±ng sá»‘ng cáº§n pháº£i ch&acirc;n tháº­t. Báº¥t ká»ƒ ngÆ°á»i kh&aacute;c nh&igrave;n m&igrave;nh báº±ng con máº¯t n&agrave;o Ä‘i chÄƒng ná»¯a, d&ugrave; cáº£ tháº¿ giá»›i phá»§ Ä‘á»‹nh, t&ocirc;i váº«n c&oacute; báº£n th&acirc;n tin tÆ°á»Ÿng m&igrave;nh. T&ocirc;n Gia Ngá»™ tá»«ng viáº¿t nhÆ° tháº¿ n&agrave;y &ldquo;thá»i c&ograve;n tráº», ch&uacute;ng ta thÆ°á»ng kh&ocirc;ng hiá»ƒu tháº¿ n&agrave;o l&agrave; t&igrave;nh y&ecirc;u. L&uacute;c má»›i bÆ°á»›c v&agrave;o Ä‘á»i, t&ocirc;i tá»«ng nghÄ© t&igrave;nh y&ecirc;u c&oacute; thá»ƒ vÆ°á»£t qua táº¥t cáº£. Khi Ä‘&oacute; t&ocirc;i kh&ocirc;ng há» biáº¿t tr&ecirc;n Ä‘á»i n&agrave;y c&ograve;n tá»“n táº¡i má»™t sá»©c máº¡nh gá»i l&agrave; sá»‘ pháº­n, ch&uacute;ng ta chá»‰ c&oacute; thá»ƒ cháº¥p nháº­n m&agrave; kh&ocirc;ng thá»ƒ thay Ä‘á»•i&rdquo;. Váº­y c&oacute; tháº­t sá»± tr&ecirc;n Ä‘á»i kh&ocirc;ng thá»ƒ thay Ä‘á»•i duy&ecirc;n pháº­n hay kh&ocirc;ng? T&ocirc;i lu&ocirc;n tin l&agrave; c&oacute;. Hoáº¡ chÄƒng t&ocirc;i cÅ©ng náº±m trong &ldquo;nhá»¯ng káº» khá» má»™ng mÆ¡&rdquo;, khi Ä‘Æ°a ra quyáº¿t Ä‘á»‹nh n&agrave;o Ä‘&oacute;, t&ocirc;i lu&ocirc;n muá»‘n kháº³ng Ä‘á»‹nh Ä‘&oacute; l&agrave; quyáº¿t Ä‘á»‹nh Ä‘&uacute;ng cá»§a m&igrave;nh, hoáº·c náº¿u n&oacute; c&oacute; sai th&igrave; cÅ©ng pháº£i biáº¿n n&oacute; th&agrave;nh Ä‘&uacute;ng, chá»‰ cáº§n báº£n th&acirc;n tháº¥y vui l&agrave; Ä‘Æ°á»£c.</p>', 'Edit', 'page105.html'),
(131, 'Chá»§ Nháº­t NgÃ y MÆ°a!', '<p>Chá»§ nháº­t ng&agrave;y&nbsp;<a href=\"https://ocuaso.com/tag/mua\" title=\"\">mÆ°a</a>, cháº³ng c&oacute; g&igrave; th&uacute; hÆ¡n l&agrave; Ä‘Æ°á»£c ngá»“i trong cÄƒn ph&ograve;ng quen thuá»™c vá»›i ly ch&egrave; xanh n&oacute;ng há»•i, nh&acirc;m nhi v&agrave;i Ä‘iáº¿u richmond thÆ¡m lá»«ng v&agrave; thÆ°á»Ÿng thá»©c phin c&agrave; ph&ecirc; Ä‘Æ°Æ¡ng h&ograve;a quyá»‡n theo nhá»¯ng giai Ä‘iá»‡u t&igrave;nh ca ngá»t ng&agrave;o cá»§a NhÆ° Quá»³nh. Ä&ecirc;m qua, tuyá»ƒn Bá»‰ Ä‘&atilde; cho t&ocirc;i l&yacute; do v&agrave; Ä‘á»™ng lá»±c Ä‘á»ƒ dáº­y sá»›m, sáº½ tháº­t ph&iacute; pháº¡m náº¿u nhÆ° nÆ°á»›ng Ä‘áº¿n táº­n trÆ°a v&agrave; kh&ocirc;ng táº­n hÆ°á»Ÿng niá»m vui má»™t c&aacute;ch trá»n váº¹n.</p>\r\n\r\n<p style=\"text-align:center\"><img alt=\"\" src=\"/page-master/ckeditor/kcfinder/upload/images/chu-nhat-ngay-mua.jpg\" style=\"height:467px; width:700px\" /></p>\r\n\r\n<p>Trong nh&agrave;, chá»‰ c&oacute; t&ocirc;i v&agrave; ba l&agrave; uá»‘ng c&agrave; ph&ecirc;, nhÆ°ng ngÆ°á»i pha pháº£i lu&ocirc;n l&agrave; máº¹. Kh&ocirc;ng r&otilde; tá»« bao giá», s&aacute;ng dáº­y, ngo&agrave;i nhá»¯ng c&ocirc;ng viá»‡c m&agrave; Ä‘a sá»‘ nhá»¯ng ngÆ°á»i máº¹ lu&ocirc;n l&agrave;m, lu&ocirc;n c&oacute; th&ecirc;m má»™t áº¥m ch&egrave; xanh v&agrave; phin c&agrave; ph&ecirc; d&agrave;nh sau bá»¯a s&aacute;ng. T&ocirc;i kh&ocirc;ng thá»ƒ uá»‘ng ná»•i ly c&agrave; ph&ecirc; cá»§a m&igrave;nh hoáº·c cá»§a ba, n&oacute; lu&ocirc;n c&oacute; má»™t c&aacute;i g&igrave; Ä‘&oacute; &ldquo;qu&aacute;&rdquo;: ngá»t qu&aacute;; chua qu&aacute;; nháº¡t qu&aacute;, thá»© m&agrave; dáº«u c&oacute; cá»‘ gáº¯ng Ä‘áº¿n máº¥y th&igrave; t&ocirc;i váº«n kh&ocirc;ng thá»ƒ n&agrave;o kiá»ƒm so&aacute;t Ä‘Æ°á»£c.</p>', 'Public', 'page131.html');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `page`
--
ALTER TABLE `page`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
