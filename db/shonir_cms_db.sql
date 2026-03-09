-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2026 at 07:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shonir_cms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_awards`
--

CREATE TABLE `tbl_awards` (
  `award_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `items` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `bottom` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banners`
--

CREATE TABLE `tbl_banners` (
  `banner_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `parent_id` varchar(190) DEFAULT NULL,
  `parent_type` varchar(190) DEFAULT NULL,
  `position` varchar(190) NOT NULL DEFAULT 'center',
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `link` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_banners`
--

INSERT INTO `tbl_banners` (`banner_id`, `sort_order`, `parent_id`, `parent_type`, `position`, `title`, `name`, `description`, `link`, `status`, `removable`, `published_time`, `today_views`, `statistics_update`, `lifetime_views`, `today_hits`, `lifetime_hits`, `last_view_time`, `last_hit_time`, `token`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(1, 1, 'home', 'hero-slides', 'start', 'Spring Collection', 'Explore Now', '<p>New Arrivals 2026</p>', 'https://8.shonir.com/shonir-cms/ibc.html', 1, 1, 1771837348, 203, 573091200, 999, 99, 999, 1773043111, 573091200, 'Phxfm4RGHqfy71es', 1771837399, 1, '59.103.124.231', 1771837933, 1, '59.103.124.231'),
(2, 2, 'home', 'hero-slides', 'center', 'Leather Jackets', 'Explore Now', '<p>Check our latest collection</p>', 'https://8.shonir.com/shonir-cms/ibc.html', 1, 1, 1771837479, 203, 573091200, 999, 99, 999, 1773043111, 573091200, 'ejJaqiNFGDKuBtix', 1771837501, 1, '59.103.124.231', 1771838117, 1, '59.103.124.231'),
(3, 3, 'home', 'hero-slides', 'center', 'Jeans To Know by Name', 'Shop Denim', '<p>New Items Collection&nbsp;</p>', 'https://8.shonir.com/shonir-cms/ibc.html', 1, 1, 1771837540, 203, 573091200, 999, 99, 999, 1773043111, 573091200, 'CtFqEjc3S4ty1PWb', 1771837554, 1, '59.103.124.231', 1771838254, 1, '59.103.124.231'),
(4, 4, 'home', 'hero-slides', 'start', 'Faux Fur Collection', 'Explore Now', '<p>Women\'s Style&nbsp;</p>', 'https://8.shonir.com/shonir-cms/ibc.html', 1, 1, 1771837558, 203, 573091200, 999, 99, 999, 1773043111, 573091200, 'cBT8Mp35M68h7TdQ', 1771837572, 1, '59.103.124.231', 1771838472, 1, '59.103.124.231'),
(5, 5, 'home', 'hero-slides', 'end', 'Leather Gloves & Pants Style', 'Explore Now', '<p>Check our leather gloves and pants collection</p>', 'https://8.shonir.com/shonir-cms/ibc.html', 1, 1, 1771837577, 203, 573091200, 999, 99, 999, 1773043111, 573091200, 'wzTQpQBayCEumjiJ', 1771837591, 1, '59.103.124.231', 1771838568, 1, '59.103.124.231');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogs_categories`
--

CREATE TABLE `tbl_blogs_categories` (
  `blog_category_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `posts` int(11) NOT NULL DEFAULT 0,
  `childrens` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `bottom` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_blogs_categories`
--

INSERT INTO `tbl_blogs_categories` (`blog_category_id`, `sort_order`, `posts`, `childrens`, `slug`, `title`, `name`, `description`, `spotlight`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `featured`, `listed`, `removable`, `searchable`, `top`, `bottom`, `published_time`, `today_views`, `statistics_update`, `lifetime_views`, `today_hits`, `lifetime_hits`, `last_view_time`, `last_hit_time`, `votes`, `ratings`, `scores`, `likes`, `token`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(2, 0, 0, 0, 'aaaaaaa', 'Sports', 'Sports', '<p>aaaaaaaaaaa</p>', '<p>aaaaaaaa</p>', 'aaaaa', 'aaaaaaa', 'aaaaaaaaa', 1, 1, 1, 1, 1, 1, 1, 1771895144, 0, 1773078317, 0, 0, 0, 573091200, 573091200, 0, 0, '0', 0, 'x2t7psuTdZn7fxhv', 1771895220, 1, '127.0.0.1', 573091200, 0, NULL),
(3, 0, 0, 0, 'bbb', 'Fashion', 'Fashion', '<p>bbbbbbbbb</p>', '<p>aaaaaaaa</p>', 'bbbbb', 'bbbbbbbbb', 'bbbbbbbbbb', 1, 1, 1, 1, 1, 1, 1, 1771895232, 0, 1773078317, 0, 0, 0, 573091200, 573091200, 0, 0, '0', 0, 'uRLUv9LJpJTdB1zJ', 1771895301, 1, '127.0.0.1', 1772460075, 1, '59.103.124.231'),
(4, 0, 0, 0, 'ccccc', 'Business', 'Business', '<p>ccccccccccccccccc</p>', '<p>cccccccccccccccc</p>', 'cccccccc', 'cccccccccc', 'ccccccccccccc', 1, 1, 1, 1, 1, 1, 1, 1771895308, 0, 1773078317, 0, 0, 0, 573091200, 573091200, 0, 0, '0', 0, 'hUvX6gyA2FL15z1H', 1771895383, 1, '127.0.0.1', 573091200, 0, NULL),
(5, 0, 5, 0, 'guide-and-updates', 'Explore everything about SHONiR CMS — from installation and features to updates and best practices', 'Guide & Updates', '<p>Welcome to the official knowledge hub for SHONiR CMS. This category covers everything you need to know about SHONiR CMS &mdash; from beginner guides to advanced technical insights.</p>\r\n<p>Here you will find detailed articles explaining what SHONiR CMS is, why businesses and developers choose it, who should use it, and how it compares to other content management systems. We also publish step-by-step installation guides, configuration tutorials, feature breakdowns, optimization tips, security practices, performance enhancements, and integration methods.</p>\r\n<p>Stay updated with the latest feature launches, version releases, improvements, and roadmap updates. Whether you are a developer, business owner, startup founder, digital agency, or enterprise team, this section will help you understand how SHONiR CMS can power modern websites and web applications efficiently and securely.</p>\r\n<p>This category is designed to serve as the central documentation and learning center for SHONiR CMS users worldwide.</p>', '<p>Your complete resource for understanding, installing, using, and mastering SHONiR CMS. Explore features, tutorials, updates, and expert insights all in one place.</p>', 'SHONiR CMS Guide: Tutorials, Features, Updates & Installation Help', 'Discover SHONiR CMS. Learn how to install, explore core features, and stay updated with the latest news on this high-performance CodeIgniter 4 based CMS.', 'SHONiR CMS, Content Management System, Open Source CMS, CodeIgniter 4 CMS, PHP 8 CMS, Web Development, SEO Friendly CMS, Website Builder, Admin Panel, Developer Tools, Future-Proof CMS, Dynamic Web App, How to install SHONiR CMS, Best CMS for CodeIgniter 4, SHONiR CMS features and benefits, Why use SHONiR CMS for business, High performance PHP CMS tutorials, SHONiR CMS installation guide for beginners, Lightweight open source CMS for developers, SEO optimization with SHONiR CMS, SHONiR CMS latest version updates, Scaling web apps with SHONiR CMS, SHONiR CMS hardware requirements, Building ecommerce with SHONiR CMS', 1, 1, 1, 1, 1, 0, 0, 1772458717, 0, 1773078317, 0, 0, 0, 573091200, 573091200, 0, 0, '0', 0, 'pgkUkLhfrTpCmuea', 1772460049, 1, '59.103.124.231', 573091200, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogs_categories_to_categories`
--

CREATE TABLE `tbl_blogs_categories_to_categories` (
  `parent_id` int(11) NOT NULL,
  `children_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogs_posts`
--

CREATE TABLE `tbl_blogs_posts` (
  `blog_post_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `comments` int(11) NOT NULL DEFAULT 0,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_blogs_posts`
--

INSERT INTO `tbl_blogs_posts` (`blog_post_id`, `sort_order`, `slug`, `comments`, `title`, `name`, `description`, `spotlight`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `featured`, `listed`, `removable`, `searchable`, `published_time`, `today_views`, `statistics_update`, `lifetime_views`, `today_hits`, `lifetime_hits`, `last_view_time`, `last_hit_time`, `votes`, `ratings`, `scores`, `likes`, `token`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(14, 0, 'the-powerfully-fast-codeigniter-4-based-open-source-cms', 0, 'Introducing SHONiR CMS – Unlimited Power, Open Source Freedom & Modern Web Control', 'The Powerfully Fast, CodeIgniter 4 Based Open-Source CMS', '<p>The future of content management is here.</p>\r\n<p><strong>SHONiR CMS</strong> is a powerful, modern, scalable, and developer-friendly content management system designed to give complete control over websites, dynamic platforms, and digital publishing systems.</p>\r\n<p>Built with performance, flexibility, and SEO at its core, SHONiR CMS allows businesses, developers, and designers to create highly optimized websites without limitations.</p>\r\n<p>You can explore the live system right now: <br />👉 <a href=\"https://8.shonir.com/shonir-cms/\" target=\"_new\">https://8.shonir.com/shonir-cms/</a></p>\r\n<p>And the full open-source code will officially be available on <strong>March 17, 2026</strong> at: <br />👉 <a href=\"https://github.com/shonirits/SHONiR-CMS\" target=\"_new\">https://github.com/shonirits/SHONiR-CMS</a></p>\r\n<p>Stay tuned to download the first public release.</p>\r\n<hr />\r\n<h2>🚀 Core Features of SHONiR CMS</h2>\r\n<h3>✅ Unlimited Information Pages</h3>\r\n<p>Add, edit, and delete unlimited information pages with complete content flexibility. Perfect for company profiles, service pages, documentation, policies, and more.</p>\r\n<hr />\r\n<h3>✅ Unlimited Categories &amp; Multi-Level Subcategories</h3>\r\n<p>Create unlimited item categories with unlimited levels of subcategories. Build structured hierarchies for products, services, portfolios, directories, or knowledge bases without restriction.</p>\r\n<hr />\r\n<h3>✅ Unlimited Items with Multiple Category Selection</h3>\r\n<p>Add, edit, and delete unlimited items. Assign items to multiple categories for advanced content organization and better discoverability.</p>\r\n<hr />\r\n<h3>✅ Dynamic Banner Management</h3>\r\n<p>Easily create and manage banners for:</p>\r\n<ul>\r\n<li><p>Hero sliders</p></li>\r\n<li><p>Dynamic pages</p></li>\r\n<li><p>Categories</p></li>\r\n<li><p>Products</p></li>\r\n<li><p>Static promotional sections</p></li>\r\n</ul>\r\n<p>Flexible banner control allows visual marketing anywhere in the system.</p>\r\n<hr />\r\n<h3>✅ Blog Management System</h3>\r\n<p>Create unlimited blog categories and publish articles with:</p>\r\n<ul>\r\n<li><p>Images</p></li>\r\n<li><p>Embedded videos</p></li>\r\n<li><p>Custom hashtags</p></li>\r\n<li><p>SEO meta control</p></li>\r\n</ul>\r\n<p>Perfect for content marketing and organic growth strategies.</p>\r\n<hr />\r\n<h3>⚡ Advanced SEO Integration</h3>\r\n<p>Every page, category, item, and blog post is:</p>\r\n<ul>\r\n<li><p>SEO meta optimized</p></li>\r\n<li><p>Structured for search engines</p></li>\r\n<li><p>Clean URL friendly</p></li>\r\n<li><p>Performance enhanced</p></li>\r\n</ul>\r\n<p>SHONiR CMS is built for ranking and visibility.</p>\r\n<hr />\r\n<h3>⚡ Speed Optimized Architecture</h3>\r\n<p>The system is lightweight, optimized for performance, and structured for fast loading times &mdash; improving both user experience and search engine rankings.</p>\r\n<hr />\r\n<h3>🎨 5+ Bootstrap 5 Fully Responsive Themes</h3>\r\n<p>The official release includes:</p>\r\n<ul>\r\n<li><p>More than 5 professionally designed themes</p></li>\r\n<li><p>Built with Bootstrap 5</p></li>\r\n<li><p>Fully responsive layouts</p></li>\r\n<li><p>Modern UI/UX standards</p></li>\r\n<li><p>Open-source theme architecture</p></li>\r\n</ul>\r\n<p>The default theme has been finalized in collaboration with <strong>ExTech Corporation</strong>, ensuring professional-grade design quality.</p>\r\n<hr />\r\n<h2>🌍 Why Developers &amp; Designers Should Choose SHONiR CMS</h2>\r\n<ul>\r\n<li><p>Fully open-source</p></li>\r\n<li><p>Modern code structure</p></li>\r\n<li><p>Flexible content architecture</p></li>\r\n<li><p>Multi-level categorization</p></li>\r\n<li><p>SEO-first development</p></li>\r\n<li><p>Performance-driven system</p></li>\r\n<li><p>Developer-friendly customization</p></li>\r\n<li><p>Scalable for startups to enterprises</p></li>\r\n</ul>\r\n<p>SHONiR CMS is not just another CMS &mdash; it is a complete web management ecosystem.</p>\r\n<p>&nbsp;</p>\r\n<p>#SHONiRCMS #OpenSourceCMS #ContentManagementSystem #Bootstrap5 #WebDevelopment #SEOTools #CMSPlatform #DynamicWebsites #DeveloperFriendly #OpenSourceProject #TechLaunch2026 #ModernWeb</p>', '<p>Discover the powerful features of SHONiR CMS including unlimited pages, categories, items, banners, blog management, and full SEO optimization. Open-source release coming March 17, 2026.</p>', 'SHONiR CMS Features, Open Source Release & Full Guide 2026', 'Explore SHONiR CMS powerful features including unlimited pages, categories, banners, blogs, SEO optimization and Bootstrap 5 themes. Open source release March 17, 2026.', 'SHONiR CMS, content management system, CMS platform, open source CMS, website management system, Bootstrap 5 CMS, SEO optimized CMS, web development platform, modern CMS, enterprise CMS solution, blog management system, dynamic website CMS, SHONiR CMS unlimited pages and categories system, how to use SHONiR CMS for dynamic websites, SHONiR CMS open source release March 2026, SHONiR CMS with multi level subcategories, SHONiR CMS SEO optimized architecture guide, SHONiR CMS banner management for hero sliders, SHONiR CMS blog system with video and hashtags, SHONiR CMS Bootstrap 5 responsive themes, download SHONiR CMS source code from GitHub, SHONiR CMS performance optimized CMS platform, SHONiR CMS for developers and designers, SHONiR CMS modern content management solution', 1, 1, 1, 1, 1, 1772461310, 2, 1773059124, 1012, 1, 1012, 1773077819, 1773059124, 100, 5, '500', 101, 'Z0832ieJx6ARfDCA', 1772461699, 1, '59.103.124.231', 1772462562, 1, '59.103.124.231'),
(15, 0, 'shonir-cms-high-performance-php-mariadb-vps', 0, 'SHONiR CMS: First-Class Speed on Low-End Servers – Open Source Launch March 17, 2026', 'SHONiR CMS – Lightning Fast, Open Source, Ultra Efficient', '<h4>🚀 Experience the Speed. Feel the Power.</h4>\r\n<p><strong>Visit</strong> 👉 https://8.shonir.com/shonir-cms/</p>\r\n<p>It feels like a high-end, first-class dedicated server running a pure HTML website&hellip;</p>\r\n<p>But the truth?</p>\r\n<p>It&rsquo;s fully dynamic &mdash; powered by PHP 8 + MariaDB 10 &mdash; running on:</p>\r\n<p>✔ <strong>VPS</strong></p>\r\n<p>✔ <strong>Single Core CPU</strong></p>\r\n<p>✔ <strong>1GB RAM</strong></p>\r\n<p>✔ <strong>HestiaCP Installed</strong></p>\r\n<p>⚡ Even with this minimal setup, SHONiR CMS can handle 100,000+ requests at a time without losing speed or overloading. That&rsquo;s the engineering excellence behind SHONiR CMS.</p>\r\n<p>{gal_src_3}</p>\r\n<h4>This is the power of SHONiR CMS.</h4>\r\n<p>Built with one clear mission:</p>\r\n<p>⚡ Fastest project completion</p>\r\n<p>🔐 Strong security architecture</p>\r\n<p>🎯 Clean code quality</p>\r\n<p>🚀 High performance even on low-end hosting</p>\r\n<p>Whether you\'re a developer, agency owner, or business looking for a robust CMS that doesn\'t compromise on speed - SHONiR CMS is your answer!</p>\r\n<p>{gal_src_2}</p>\r\n<h4>And here&rsquo;s the big news&hellip;</h4>\r\n<p>📅 Source code will be publicly available on 17 March 2026</p>\r\n<p>🔗 https://github.com/shonirits/SHONiR-CMS&nbsp;</p>\r\n<p>Hosted on GitHub</p>\r\n<p><strong>Stay connected.</strong></p>\r\n<p><strong>Feel the speed.</strong></p>\r\n<p><strong>Enjoy the code.</strong></p>\r\n<p>{gal_src_1}</p>\r\n<p>#SHONiRCMS #HighPerformance #PHPCMS #MariaDB #VPSHosting #WebDevelopment #OpenSource #FastWebsites #SecureCoding #StartupTech #LowEndServerHighPerformance #DynamicWebsite #TechInnovation</p>', '<p>Discover how SHONiR CMS delivers ultra-fast performance using PHP 8 and MariaDB 10 on a single-core 1GB VPS server &mdash; handling 100K+ requests without slowing down.</p>', 'SHONiR CMS – High Speed PHP 8 CMS Running 100K+ Requests on 1GB VPS', 'Experience SHONiR CMS — a dynamic PHP 8 + MariaDB 10 platform that delivers lightning-fast performance on minimal VPS setups. Built for speed, security, and rapid project completion, even on low-end hosting.', 'shonir cms, php cms, high performance cms, dynamic website system, mariadb database, vps hosting solution, fast loading website, secure cms platform, open source cms, scalable web application, lightweight cms, web development platform, high performance php 8 cms on 1gb vps, mariadb 10 powered dynamic website system, cms that handles 100k concurrent requests, lightweight cms for low end servers, secure php cms with fast loading speed, open source cms releasing march 2026, scalable cms for startup hosting environments, best cms for vps single core server, dynamic php website running like html, cms optimized for hestiacp server, fast finishing website development platform, shonir cms performance demonstration', 1, 1, 1, 1, 1, 1772575372, 1, 1773077819, 1002, 1, 1002, 1773077819, 1773077819, 99, 5, '495', 100, 'fwNwjFDKEuwr2h34', 1772576004, 1, '59.103.124.231', 573091200, 0, NULL),
(16, 0, 'why-choose-shonir-cms-lightweight-codeigniter-alternative', 0, 'Why Choose SHONiR CMS? The Developer’s Lightweight Alternative to Bloated Systems', 'The Lightweight CodeIgniter 4 CMS for Web Agencies', '<p>Today there are many popular content management systems such as WordPress, OpenCart, PrestaShop, Joomla, and Drupal. These platforms are powerful and widely used across the world. However, after more than <strong>20 years of experience in web development</strong>, one important reality becomes very clear:</p>\r\n\r\n<p><strong>Every business has different requirements.</strong></p>\r\n<p>A single CMS cannot perfectly fit every type of business.</p>\r\n<hr>\r\n\r\n<h2>The Reality of Custom Business Requirements</h2>\r\n<p>In real-world projects, customers rarely need a full-featured system. Their requirements depend entirely on the <strong>nature of their business</strong>.</p>\r\n\r\n<p>For example:</p>\r\n\r\n<p>A <strong>manufacturing company</strong> may only need a website to showcase products and company information. They usually <strong>do not need online payment systems, add-to-cart features, or complex pricing systems</strong>.</p>\r\n\r\n<p>A <strong>service-based business</strong> may only need pages like services, portfolio, blog, and contact forms. They <strong>do not need product catalogs or eCommerce functionality</strong>.</p>\r\n\r\n<p>However, many developers still install large platforms like WordPress or full eCommerce systems such as OpenCart or PrestaShop, which include <strong>hundreds of unnecessary features</strong> for such websites.</p>\r\n\r\n<p>These extra features make the system:</p>\r\n<ul>\r\n    <li>Heavier</li>\r\n    <li>Slower</li>\r\n    <li>Harder to maintain</li>\r\n    <li>More complex to customize</li>\r\n</ul>\r\n<hr>\r\n\r\n<h2>How Web Development Agencies Actually Work</h2>\r\n<p>Most professional web development agencies understand this challenge.</p>\r\n\r\n<p>Instead of using heavy CMS platforms for every project, many agencies create <strong>their own internal control panels or custom CMS systems</strong>. These systems are designed specifically for the types of websites they build regularly.</p>\r\n\r\n<p>Over the past two decades, I have personally built many such panels using different technologies, including:</p>\r\n<ul>\r\n    <li>Classic ASP</li>\r\n    <li>PHP</li>\r\n    <li>Modern frameworks like Laravel</li>\r\n    <li>Frameworks like CodeIgniter</li>\r\n</ul>\r\n\r\n<p>Each panel was created to <strong>simplify development and meet client-specific requirements</strong>.</p>\r\n<hr>\r\n\r\n<h2>The Idea Behind SHONiR CMS</h2>\r\n<p>After building many custom systems over the years, a simple idea emerged:</p>\r\n<p><strong>Why not create a lightweight open-source CMS that developers and agencies can easily customize and extend?</strong></p>\r\n\r\n<p>This idea led to the creation of <strong>SHONiR CMS</strong>.</p>\r\n<p>Instead of forcing developers to work around a heavy structure, SHONiR CMS provides a <strong>clean, flexible, and developer-friendly base system</strong> that can be adapted to almost any type of website.</p>\r\n<hr>\r\n\r\n<h2>Built on CodeIgniter for Developers</h2>\r\n<p>SHONiR CMS is built on the powerful PHP framework CodeIgniter 4.</p>\r\n\r\n<p>This framework is widely recognized for being <strong>one of the fastest and most lightweight PHP frameworks available</strong>. Its architecture is clean, simple, and easy to understand.</p>\r\n\r\n<p>Because SHONiR CMS is based on CodeIgniter 4, it offers several advantages:</p>\r\n<ul>\r\n    <li>Clean MVC architecture</li>\r\n    <li>Easy customization</li>\r\n    <li>Developer-friendly structure</li>\r\n    <li>High performance</li>\r\n    <li>Simple learning curve</li>\r\n</ul>\r\n\r\n<p>Developers who are familiar with CodeIgniter can quickly understand how SHONiR CMS works and start building or extending projects without a steep learning curve.</p>\r\n<hr>\r\n\r\n<h2>SHONiR CMS Works Like Your Own Development Panel</h2>\r\n<p>The core philosophy behind SHONiR CMS is very simple:</p>\r\n<p><strong>Every developer or agency should be able to use it like their own custom control panel.</strong></p>\r\n\r\n<p>Developers can:</p>\r\n<ul>\r\n    <li>Extend features anytime</li>\r\n    <li>Modify existing functions</li>\r\n    <li>Build custom modules</li>\r\n    <li>Adapt the system to any business type</li>\r\n    <li>Train new developers quickly</li>\r\n</ul>\r\n\r\n<p>Instead of rewriting a CMS from scratch for every project, developers can start with SHONiR CMS and customize it according to their client’s business needs.</p>\r\n<hr>\r\n\r\n<h2>Easy to Learn for Developers</h2>\r\n<p>Another major advantage of SHONiR CMS is how easy it is for developers to learn.</p>\r\n\r\n<p>Because it is built on CodeIgniter 4, developers benefit from one of the <strong>most comprehensive and professional documentation systems in the PHP ecosystem</strong>.</p>\r\n\r\n<p>The official documentation provides clear explanations, real-world examples, and practical guidance that help developers solve problems quickly.</p>\r\n\r\n<p>In addition, CodeIgniter has a <strong>large and active global developer community</strong>. Developers around the world continuously contribute tutorials, discussions, and resources that make learning and development easier.</p>\r\n\r\n<p>For development agencies, this provides several practical benefits:</p>\r\n<ul>\r\n    <li>New developers can learn the system quickly</li>\r\n    <li>Training time for teams becomes much shorter</li>\r\n    <li>Developers can easily modify or extend features</li>\r\n    <li>Projects can be developed faster and more efficiently</li>\r\n</ul>\r\n<hr>\r\n\r\n<h2>Lightweight and Performance-Focused</h2>\r\n<p>One of the main goals behind SHONiR CMS was <strong>performance and simplicity</strong>.</p>\r\n\r\n<p>Unlike many heavy CMS platforms, SHONiR CMS is designed to be:</p>\r\n<ul>\r\n    <li>Lightweight</li>\r\n    <li>Fast</li>\r\n    <li>Cleanly structured</li>\r\n    <li>Easy to scale</li>\r\n</ul>\r\n\r\n<p>It follows the same philosophy as CodeIgniter 4 itself — <strong>simple, fast, and developer friendly</strong>.</p>\r\n\r\n<p>This makes it especially suitable for projects where <strong>speed, flexibility, and clean architecture are important</strong>.</p>\r\n<hr>\r\n\r\n<h2>Final Thoughts</h2>\r\n<p>Platforms like WordPress, OpenCart, PrestaShop, Joomla, and Drupal are excellent tools for specific purposes.</p>\r\n\r\n<p>However, many real-world projects require something <strong>lighter, more flexible, and easier to customize</strong>.</p>\r\n\r\n<p><strong>SHONiR CMS was created to solve that problem.</strong></p>\r\n\r\n<p>It provides developers with a <strong>solid and lightweight foundation</strong> that can grow into any type of system—without the limitations or heaviness of traditional CMS platforms.</p>\r\n\r\n<p>In simple words:</p>\r\n<p><strong>SHONiR CMS is not just a CMS — it is a customizable development base for developers and agencies.</strong> 🚀</p>\r\n\r\n<p>#SHONiRCMS #CodeIgniter4 #WebDevelopment #OpenSource #LightweightCMS #WordPressAlternative #DeveloperTools #CustomCMS #PHPFramework #Agencies #TechInnovation #FastCMS</p>\r\n', '<p>SHONiR CMS is a lightweight, developer‑friendly, open‑source platform built on CodeIgniter 4. It offers speed, flexibility, and customization without the bloat of WordPress, OpenCart, or other heavy CMS systems.</p>', 'Why Choose SHONiR CMS Over Heavyweight Platforms Like WordPress or OpenCart', 'Tired of bloated CMS platforms? SHONiR CMS provides a high-performance, open-source solution built on CodeIgniter 4. Perfect for custom business requirements and fast web development.', 'CMS, CodeIgniter, WordPress alternative, OpenCart alternative, Joomla, Drupal, PrestaShop, lightweight CMS, open source CMS, PHP framework, web development, custom CMS, SHONiR CMS built on CodeIgniter 4, lightweight CMS for agencies, flexible CMS for developers, open source CMS for customization, CodeIgniter CMS with active community, easy to learn CMS for beginners, fast CMS compared to WordPress, extensible CMS for business needs, developer‑friendly CMS platform, custom CMS for manufacturers, CMS without e‑commerce bloat, CodeIgniter 4 documentation benefits', 1, 1, 1, 1, 1, 1772852681, 4, 1773027675, 1006, 1, 1006, 1773059124, 1773027675, 99, 5, '495', 99, 'Wh2pNFQvSpGbKtvj', 1772853176, 1, '59.103.124.231', 1772853463, 1, '59.103.124.231'),
(17, 0, 'multi-cdn-guide-boost-website-speed-performance', 0, 'Using Multiple CDN Services in SHONiR CMS for Maximum Website Performance', 'Multiple CDN Usage in SHONiR CMS via phpMyAdmin', '<p>Modern websites must load extremely fast to provide a good user experience and improve SEO rankings. One of the most powerful ways to improve performance is by using a <strong>Content Delivery Network (CDN)</strong>.</p>\r\n\r\n<p><strong>SHONiR CMS</strong> is designed with performance in mind and includes a <strong>built-in multiple CDN configuration system</strong>. This allows website owners to distribute different types of static files across multiple CDN providers, improving load speed and reducing server load.</p>\r\n\r\n<p>This guide explains how to configure and use multiple CDN URLs in SHONiR CMS using <strong>phpMyAdmin</strong>.</p>\r\n\r\n<hr>\r\n\r\n<h2>Accessing CDN Configuration in SHONiR CMS</h2>\r\n\r\n<p>All CDN and resource URLs are stored inside the <strong><code>tbl_config</code></strong> table in the database.</p>\r\n\r\n<p>Follow these steps to access the configuration:</p>\r\n\r\n<ol>\r\n<li>Login to <strong>phpMyAdmin</strong></li>\r\n<li>Select your <strong>SHONiR CMS database</strong></li>\r\n<li>Open the table:</li>\r\n</ol>\r\n\r\n<pre><code>tbl_config</code></pre>\r\n\r\n<p>This table contains the following columns:</p>\r\n\r\n<ul>\r\n<li><code>config_id</code></li>\r\n<li><code>config_key</code></li>\r\n<li><code>config_value</code></li>\r\n<li><code>config_mode</code></li>\r\n</ul>\r\n\r\n<hr>\r\n\r\n<h2>Finding CDN Related Configuration Keys</h2>\r\n\r\n<p>To locate the CDN related configuration values:</p>\r\n\r\n<ol>\r\n<li>Click the <strong>Search</strong> tab in phpMyAdmin</li>\r\n<li>Search in column <strong>config_key</strong></li>\r\n<li>Use the operator:</li>\r\n</ol>\r\n\r\n<pre><code>LIKE %url%</code></pre>\r\n\r\n<p>You will see the following configuration keys:</p>\r\n\r\n<pre><code>assets_url\r\nuploads_url\r\nimg_url\r\nbase_url\r\ncss_url\r\njs_url\r\ncdn_url</code></pre>\r\n\r\n<p>Each of these keys controls how SHONiR CMS loads different types of files.</p>\r\n\r\n<hr>\r\n\r\n<h1>Understanding Each CDN URL Configuration</h1>\r\n\r\n<h2>1. assets_url</h2>\r\n\r\n<p>This URL is used for <strong>static libraries</strong>.</p>\r\n\r\n<p>Examples include:</p>\r\n\r\n<ul>\r\n<li>Bootstrap</li>\r\n<li>jQuery</li>\r\n<li>Other third-party libraries</li>\r\n</ul>\r\n\r\n<p>These files are stored in:</p>\r\n\r\n<pre><code>public/assets</code></pre>\r\n\r\n<p>Example CDN usage:</p>\r\n\r\n<pre><code>https://cdn.example.com/shonir-cms/public/assets/</code></pre>\r\n\r\n<hr>\r\n\r\n<h2>2. css_url</h2>\r\n\r\n<p>This configuration controls <strong>all CSS files used by the website theme</strong>.</p>\r\n\r\n<p>Locations include:</p>\r\n\r\n<pre><code>public/css/frontend/default.css\r\npublic/css/frontend/{theme_folder}/theme.css</code></pre>\r\n\r\n<p>Example CDN URL:</p>\r\n\r\n<pre><code>https://cdn.example.com/shonir-cms/public/css/</code></pre>\r\n\r\n<hr>\r\n\r\n<h2>3. js_url</h2>\r\n\r\n<p>This URL loads <strong>JavaScript files related to the theme</strong>.</p>\r\n\r\n<p>Files are located in:</p>\r\n\r\n<pre><code>public/js/frontend/default.js\r\npublic/js/frontend/{theme_folder}/theme.js</code></pre>\r\n\r\n<p>Example:</p>\r\n\r\n<pre><code>https://cdn.example.com/shonir-cms/public/js/</code></pre>\r\n\r\n<hr>\r\n\r\n<h2>4. uploads_url</h2>\r\n\r\n<p>This configuration is used for <strong>all files uploaded from the admin panel</strong>.</p>\r\n\r\n<p>Uploaded files are stored in:</p>\r\n\r\n<pre><code>public/uploads</code></pre>\r\n\r\n<p>Example:</p>\r\n\r\n<pre><code>https://cdn.example.com/shonir-cms/public/uploads/</code></pre>\r\n\r\n<hr>\r\n\r\n<h2>5. img_url</h2>\r\n\r\n<p>This URL is used for <strong>website images</strong>.</p>\r\n\r\n<p>It allows images to be served from a dedicated CDN optimized for image delivery.</p>\r\n\r\n<hr>\r\n\r\n<h2>6. cdn_url</h2>\r\n\r\n<p>This is the <strong>global CDN URL</strong>.</p>\r\n\r\n<p>It can act as a fallback or general CDN for multiple file types across the system.</p>\r\n\r\n<hr>\r\n\r\n<h1>Real Example from the SHONiR CMS Demo</h1>\r\n\r\n<p>The official SHONiR CMS demo already uses <strong>multiple CDN services</strong> to optimize performance.</p>\r\n\r\n<h3>Image CDN (Image Optimization)</h3>\r\n\r\n<p>Images are served using <strong>ImageKit CDN</strong>.</p>\r\n\r\n<p>Example:</p>\r\n\r\n<pre><code>https://ik.imagekit.io/stznbxt6o/shonir-cms/public/images/frontend/default/logo.webp</code></pre>\r\n\r\n<p>This provides:</p>\r\n\r\n<ul>\r\n<li>automatic image optimization</li>\r\n<li>global edge caching</li>\r\n<li>faster image delivery</li>\r\n</ul>\r\n\r\n<hr>\r\n\r\n<h3>Static File CDN</h3>\r\n\r\n<p>CSS, JS, and other files are delivered through <strong>Gcore CDN</strong>.</p>\r\n\r\n<p>Example:</p>\r\n\r\n<pre><code>https://8static.shonir.com/shonir-cms/public/js/frontend/default.js</code></pre>\r\n\r\n<p>This improves loading speed for:</p>\r\n\r\n<ul>\r\n<li>JavaScript</li>\r\n<li>CSS</li>\r\n<li>static assets</li>\r\n</ul>\r\n\r\n<hr>\r\n\r\n<h1>Supported CDN Providers</h1>\r\n\r\n<p>SHONiR CMS works with almost any CDN provider.</p>\r\n\r\n<p>Popular CDN services include:</p>\r\n\r\n<ul>\r\n<li>Cloudflare</li>\r\n<li>Amazon CloudFront</li>\r\n<li>Microsoft Azure CDN</li>\r\n<li>KeyCDN</li>\r\n<li>Fastly</li>\r\n<li>Google Cloud CDN</li>\r\n<li>EdgeNext</li>\r\n<li>Akamai</li>\r\n<li>CacheFly</li>\r\n<li>CDNetworks</li>\r\n</ul>\r\n\r\n<p>You can configure different CDN services for different file types.</p>\r\n\r\n<hr>\r\n\r\n<h1>Why Multiple CDN Architecture Is Powerful</h1>\r\n\r\n<p>Using multiple CDN endpoints provides several benefits:</p>\r\n\r\n<h3>Faster Load Times</h3>\r\n<p>Files are served from the nearest CDN edge server.</p>\r\n\r\n<h3>Reduced Server Load</h3>\r\n<p>Static resources are offloaded from the main hosting server.</p>\r\n\r\n<h3>Parallel Resource Loading</h3>\r\n<p>Browsers can download resources from different domains simultaneously.</p>\r\n\r\n<h3>Global Performance</h3>\r\n<p>Visitors from different countries receive optimized delivery.</p>\r\n\r\n<h3>Higher Scalability</h3>\r\n<p>Your website can handle very large traffic volumes.</p>\r\n\r\n<hr>\r\n\r\n<h1>How SHONiR CMS Achieves High Performance</h1>\r\n\r\n<p>SHONiR CMS was built with <strong>performance-first architecture</strong>. By combining:</p>\r\n\r\n<ul>\r\n<li>optimized database queries</li>\r\n<li>lightweight templates</li>\r\n<li>caching mechanisms</li>\r\n<li>multiple CDN integration</li>\r\n</ul>\r\n\r\n<p>The system can run <strong>high-performance websites even on low-resource servers</strong>.</p>\r\n\r\n<p>By distributing files across multiple CDN services, SHONiR CMS ensures:</p>\r\n\r\n<ul>\r\n<li>faster page rendering</li>\r\n<li>reduced latency</li>\r\n<li>improved visitor experience</li>\r\n<li>scalable architecture for high traffic websites</li>\r\n</ul>\r\n\r\n<hr>\r\n\r\n<h1>Final Thoughts</h1>\r\n\r\n<p>The built-in <strong>multi-CDN configuration system in SHONiR CMS</strong> allows developers and website owners to easily optimize performance without complex server configurations.</p>\r\n\r\n<p>By simply updating a few values inside the <strong><code>tbl_config</code></strong> table, you can distribute your static resources across multiple CDN providers and dramatically improve website speed.</p>\r\n\r\n<p>This flexible architecture makes SHONiR CMS an excellent choice for building <strong>high-performance, scalable websites</strong>.</p>\r\n\r\n<p>#SHONiRCMS #WebPerformance #CDN #WebDevelopment #SpeedOptimization #SEO #FullStack #TechTips #Cloudflare #CloudComputing #WebsiteSpeed #PHP</p>', '<p>In the world of high-performance web development, speed is everything. SHONiR CMS is designed with a \"performance-first\" mindset, offering a granular configuration system that allows developers to split asset delivery across multiple Content Delivery Networks (CDNs).</p>\r\n<p>By distributing the load across different specialized servers, you reduce latency, improve global accessibility, and provide a seamless experience for your visitors. Here is how you can configure these settings using phpMyAdmin.</p>', 'How to Configure Multi-CDN in SHONiR CMS via phpMyAdmin | Speed Optimization Guide', 'Learn how to configure and use multiple CDN services in SHONiR CMS using phpMyAdmin. Optimize assets, CSS, JS, images, and uploads across different CDN providers to improve website speed, scalability, and performance.', 'CDN configuration, multiple CDN setup, website performance optimization, content delivery network, CDN integration, website speed optimization, PHP CMS optimization, static file CDN, high performance website, CDN for images, CDN for CSS JS, website load speed, how to configure CDN in SHONiR CMS, multiple CDN setup in PHP CMS, using phpMyAdmin to configure CDN URLs, optimize website speed with multiple CDN, SHONiR CMS CDN configuration guide, distribute static files using CDN in PHP, improve website performance with CDN architecture, configure assets css js CDN in CMS, how to use ImageKit CDN for images, using gcore CDN for static website files, high performance CMS CDN optimization, multi CDN strategy for fast websites', 1, 1, 1, 1, 1, 1772918839, 28, 1772981253, 1006, 4, 1006, 1773077819, 1773009303, 99, 5, '495', 99, 'eCZh0SkbBFABnzqy', 1772919181, 1, '59.103.124.231', 1772920114, 1, '59.103.124.231'),
(18, 0, 'three-distinct-layers-of-caching-to-ensure-your-server-almost-never-has-to-work-hard-to-serve-a-page', 0, 'Cache System: How It Delivers High-Speed Performance Even on Low-End Servers', 'Cache: High-Speed Delivery on Any Server', '<p>One of the most surprising things people notice when testing <strong>SHONiR CMS</strong> is its performance. Many developers ask the same question:</p>\r\n\r\n<p><strong>How can SHONiR CMS handle extremely high traffic and deliver web pages so fast, even on an average or low-end server?</strong></p>\r\n\r\n<p>In real-world testing, SHONiR CMS has been able to <strong>handle 100,000+ requests</strong> efficiently on modest server configurations – even on shared hosting environments. The secret behind this performance lies in its <strong>smart caching architecture</strong>.</p>\r\n\r\n<p>Instead of modifying the core of <strong>CodeIgniter 4</strong>, SHONiR CMS simply uses its built-in capabilities in a smarter and more optimized way.</p>\r\n\r\n<hr />\r\n\r\n<h1>Respecting the Power of CodeIgniter 4</h1>\r\n\r\n<p>SHONiR CMS <strong>does not modify any core files of CodeIgniter 4</strong>.</p>\r\n\r\n<p>This is intentional.</p>\r\n\r\n<p>CodeIgniter has a very strong development team behind it and is one of the most stable and reliable PHP frameworks available today. Rather than altering the framework, SHONiR CMS focuses on <strong>utilizing the full power of CodeIgniter in the best possible way</strong>.</p>\r\n\r\n<p>The goal is simple:</p>\r\n\r\n<ul>\r\n  <li>Keep the framework <strong>clean and maintainable</strong></li>\r\n  <li>Use <strong>native features efficiently</strong></li>\r\n  <li>Help developers <strong>build projects faster</strong></li>\r\n</ul>\r\n\r\n<hr />\r\n\r\n<h1>The 3-Layer Cache System in SHONiR CMS</h1>\r\n\r\n<p>To achieve extremely fast performance, SHONiR CMS uses <strong>three different caching layers</strong>.</p>\r\n\r\n<ol>\r\n  <li>PHP Web Page Cache</li>\r\n  <li>HTML Static Cache</li>\r\n  <li>Image Cache Optimization</li>\r\n</ol>\r\n\r\n<p>Each layer reduces server workload and improves response time.</p>\r\n\r\n<hr />\r\n\r\n<h1>1. PHP Web Page Cache (CodeIgniter Built-in Cache)</h1>\r\n\r\n<p>The first layer uses the built-in caching feature provided by <strong>CodeIgniter 4</strong>.</p>\r\n\r\n<p>This caching system stores the <strong>generated output of a page</strong>, allowing the server to deliver the same page quickly without rebuilding it every time.</p>\r\n\r\n<p>This built-in feature works extremely well and provides significant speed improvements.</p>\r\n\r\n<p>You can learn more about CodeIgniter’s page caching here:</p>\r\n<p><a href=\"https://codeigniter.com/user_guide/general/caching.html\" target=\"_blank\">https://codeigniter.com/user_guide/general/caching.html</a></p>\r\n\r\n<hr />\r\n\r\n<h1>2. HTML Static Cache (Ultra-Fast Page Delivery)</h1>\r\n\r\n<p>The second caching layer in SHONiR CMS is <strong>HTML static caching</strong>.</p>\r\n\r\n<p>In this method, the CMS generates a <strong>fully rendered HTML version of a page</strong> and stores it directly on the server.</p>\r\n\r\n<p>When a visitor requests the page:</p>\r\n\r\n<ul>\r\n  <li>The system <strong>does not connect to the database</strong></li>\r\n  <li>No PHP processing occurs</li>\r\n  <li>The server <strong>directly delivers the static HTML file</strong></li>\r\n</ul>\r\n\r\n<p>This approach dramatically reduces server load.</p>\r\n\r\n<p>All generated HTML cache files are stored in: <pre><code>writable/cache/htmls</code></pre></p>\r\n\r\n<p>This method is particularly useful for websites where content rarely changes, such as:</p>\r\n\r\n<ul>\r\n  <li>Business websites</li>\r\n  <li>Product catalogs</li>\r\n  <li>Service websites</li>\r\n  <li>Company portfolios</li>\r\n</ul>\r\n\r\n<p>For such sites, content might remain unchanged for months or even years. In those cases, repeatedly querying the database to rebuild pages is unnecessary.</p>\r\n\r\n<p>SHONiR CMS handles this intelligently by serving <strong>pre-generated HTML pages instantly</strong>.</p>\r\n\r\n<hr />\r\n\r\n<h1>Example of SHONiR CMS HTML Cache</h1>\r\n\r\n<p>You can see an example here:</p>\r\n<p><a href=\"../bpd17/multi-cdn-guide-boost-website-speed-performance.html\" target=\"_blank\">https://8.shonir.com/shonir-cms/bpd17/multi-cdn-guide-boost-website-speed-performance.html</a></p>\r\n\r\n<p>If you open the <strong>page source</strong>, you will see something like this at the top:</p>\r\n<p><pre><code>&lt;!-- SHONiR Cache generated: 03/08/26 15:07:42 UTC --&gt;</code></pre></p>\r\n\r\n<p>At the bottom of the page you will find:</p>\r\n<p><pre><code>&lt;!-- SHONiR Cache loaded Time: 03/08/26 23:35:12 PKT Usage:659.19 kb Peak:659.73 kb --&gt;</code></pre></p>\r\n<ul>\r\n  <li>When the page request was processed</li>\r\n  <li>The memory usage for the request</li>\r\n  <li>Peak memory usage</li>\r\n</ul>\r\n\r\n<p>This provides transparency for developers and helps monitor performance.</p>\r\n\r\n<hr />\r\n\r\n<h1>How to Enable Web Page Caching in SHONiR CMS</h1>\r\n\r\n<p>To activate the <strong>CodeIgniter web page cache</strong>, follow these steps:</p>\r\n\r\n<ol>\r\n  <li>Open your database in <strong>phpMyAdmin</strong></li>\r\n  <li>Locate the table: <pre><code>tbl_config</code></pre></li>\r\n  <li>Search for the config key: <pre><code>cache_time</code></pre></li>\r\n</ol>\r\n\r\n<p>If the value is <pre><code>0</code></pre>, caching is disabled. Set a value like <pre><code>300</code></pre> for 5 minutes cache duration. Example values:</p>\r\n\r\n<table>\r\n<thead>\r\n<tr>\r\n<th>Value</th>\r\n<th>Meaning</th>\r\n</tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>300</td>\r\n<td>5 minutes</td>\r\n</tr>\r\n<tr>\r\n<td>900</td>\r\n<td>15 minutes</td>\r\n</tr>\r\n<tr>\r\n<td>3600</td>\r\n<td>1 hour</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n\r\n<p>This setting controls <strong>CodeIgniter\'s built-in web page caching</strong>.</p>\r\n\r\n<hr />\r\n\r\n<h1>How to Enable HTML Cache</h1>\r\n\r\n<p>To enable <strong>HTML static caching</strong>, open the <pre><code>.env</code></pre> file in the root directory of SHONiR CMS. Find this line:</p>\r\n<p><pre><code>html.cache = false</code></pre></p>\r\n<p>Change it to: <pre><code>html.cache = true</code></pre></p>\r\n\r\n<p>Once enabled, SHONiR CMS will automatically generate static HTML pages and store them in the cache directory.</p>\r\n\r\n<hr />\r\n\r\n<h1>3. Image Cache Optimization</h1>\r\n\r\n<p>The third layer of caching focuses on <strong>image performance</strong>.</p>\r\n\r\n<p>SHONiR CMS automatically:</p>\r\n\r\n<ul>\r\n  <li>Converts images to <strong>WebP format</strong></li>\r\n  <li>Compresses image files</li>\r\n  <li>Reduces file size while maintaining visual quality</li>\r\n</ul>\r\n\r\n<p>This results in <strong>faster page load times and reduced bandwidth usage</strong>.</p>\r\n\r\n<hr />\r\n\r\n<h1>How to Enable Image Cache</h1>\r\n\r\n<p>To enable image caching:</p>\r\n\r\n<ol>\r\n  <li>Open table <pre><code>tbl_config</code></pre></li>\r\n  <li>Find the key: <pre><code>cache_image</code></pre></li>\r\n  <li>Set its value to <pre><code>true</code></pre></li>\r\n</ol>\r\n\r\n<p>To control image quality, find <pre><code>image_quality</code></pre> and set values from 0–100. Example: 85 provides a good balance between <strong>image quality and file size</strong>.</p>\r\n\r\n<hr />\r\n\r\n<h1>Important Note About Global Cache Time</h1>\r\n\r\n<p>The <pre><code>cache_time</code></pre> setting acts as the <strong>global cache control</strong>. If <pre><code>cache_time = 0</code></pre>, HTML caches will be removed after generation. This value affects <strong>multiple cache systems</strong>, including image caching behavior.</p>\r\n\r\n<hr />\r\n\r\n<h1>Why This Caching Strategy Works So Well</h1>\r\n\r\n<p>By combining multiple caching layers, SHONiR CMS drastically reduces:</p>\r\n\r\n<ul>\r\n  <li>Database queries</li>\r\n  <li>PHP processing</li>\r\n  <li>Server CPU usage</li>\r\n  <li>Memory consumption</li>\r\n</ul>\r\n\r\n<p>The result is a system that can <strong>serve massive traffic even on low-cost hosting environments</strong>. This is why SHONiR CMS can achieve <strong>exceptional performance without requiring expensive infrastructure</strong>.</p>\r\n\r\n<hr />\r\n\r\n<p>✔ Clean architecture<br />\r\n✔ Zero modification of CodeIgniter core<br />\r\n✔ Multi-layer caching system<br />\r\n✔ Optimized image delivery<br />\r\n✔ High performance even on shared hosting</p>\r\n\r\n<p>All these factors together make <strong>SHONiR CMS a powerful and efficient platform for building fast websites.</strong></p>\r\n\r\n<p>#SHONiRCMS #WebPerformance #Caching #CodeIgniter4 #WebDevelopment #SharedHosting #WebOptimization #PHP #CMS #SpeedBoost</p>', '<p>One of the most surprising aspects of SHONiR CMS is its ability to deliver lightning-fast web content even on average or low-end servers, including shared hosting environments. Developers and beginners alike are often amazed that SHONiR CMS can handle 100,000+ requests without breaking a sweat. The secret lies in how it leverages the power of CodeIgniter 4 and introduces a three-layer caching system &mdash; all without modifying any core framework files.</p>', 'SHONiR CMS: 100K Requests on Low-End Servers? Here\'s How | Triple Cache System', 'Discover how SHONiR CMS achieves lightning-fast performance with three layers of caching (PHP, HTML, and image compression), handling 100k+ requests even on shared hosting — without modifying CodeIgniter 4 core files.', 'SHONiR CMS, CodeIgniter 4 cache, high performance CMS, static HTML caching, WebP image conversion, shared hosting optimization, low-end server performance, PHP caching system, CodeIgniter 4 speed, CMS for business websites, 100k requests per second, HTML cache vs database, image optimization CMS ', 1, 1, 1, 1, 1, 1772996746, 17, 1772997171, 1006, 7, 1006, 1773077819, 1773009602, 99, 5, '495', 99, 'qp5GtteFgdNtwXfu', 1772997117, 1, '59.103.124.231', 573091200, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogs_posts_to_categories`
--

CREATE TABLE `tbl_blogs_posts_to_categories` (
  `blog_post_id` int(11) NOT NULL,
  `blog_category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_blogs_posts_to_categories`
--

INSERT INTO `tbl_blogs_posts_to_categories` (`blog_post_id`, `blog_category_id`) VALUES
(16, 5),
(15, 5),
(14, 5),
(17, 5),
(18, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brands`
--

CREATE TABLE `tbl_brands` (
  `brand_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `items` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `bottom` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_captcha`
--

CREATE TABLE `tbl_captcha` (
  `captcha_id` int(11) NOT NULL,
  `token` varchar(190) NOT NULL,
  `code` varchar(190) NOT NULL,
  `add_at` int(11) NOT NULL DEFAULT 573091200,
  `add_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carts`
--

CREATE TABLE `tbl_carts` (
  `cart_id` int(11) NOT NULL,
  `session_id` varchar(190) DEFAULT NULL,
  `token` varchar(190) DEFAULT NULL,
  `promo_code` varchar(190) DEFAULT NULL,
  `add_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carts_items`
--

CREATE TABLE `tbl_carts_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` varchar(190) NOT NULL DEFAULT '1',
  `token` varchar(190) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `items` int(11) NOT NULL DEFAULT 0,
  `childrens` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(190) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `bottom` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(256) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `sort_order`, `items`, `childrens`, `icon`, `slug`, `title`, `name`, `description`, `spotlight`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `featured`, `listed`, `removable`, `searchable`, `top`, `bottom`, `published_time`, `today_views`, `statistics_update`, `lifetime_views`, `today_hits`, `lifetime_hits`, `last_view_time`, `last_hit_time`, `votes`, `ratings`, `scores`, `likes`, `token`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(1, 1, 12, 0, NULL, 'mens-leather-jackets-classic-fashion-chicago', 'Men’s Leather Jackets – Classic & Modern Styles', 'Mens', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Our Men&rsquo;s Leather Jackets category showcases a curated range of premium outerwear designed to elevate any wardrobe. Crafted from 100% real lambskin leather, these jackets deliver a luxurious look and long-lasting durability. With soft polyester linings, tailored fits, and versatile designs, they combine comfort with style. From classic Harrington silhouettes to rugged biker jackets, the collection caters to men seeking both elegance and practicality. Functional details such as adjustable waists, cuffs, and multiple pockets make these jackets ideal for everyday wear. Whether styled casually with jeans or layered for a refined evening look, these jackets embody timeless fashion and modern versatility.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Step into timeless style with the Men&rsquo;s Leather Jackets Collection, crafted for men who value sophistication, durability, and versatility. Each jacket is made from premium lambskin leather with soft linings for comfort, featuring classic Harrington collars, biker-inspired cuts, adjustable fits, and functional pockets. Designed for all-season wear, these jackets seamlessly blend luxury craftsmanship with everyday practicality, making them essential wardrobe staples for modern men.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>', 'Men’s Leather Jackets – Premium Styles in Chicago', 'Explore the Men’s Leather Jackets Collection, crafted from premium lambskin leather with refined collars, tailored fits, soft linings, and versatile designs. Perfect for casual and evening wear, these jackets blend timeless elegance with modern fashion — available now in Chicago.', 'men’s leather jackets, black leather jacket men, lambskin leather jacket men, classic men’s jacket, stylish men’s outerwear, premium leather fashion, men’s wardrobe essentials, rugged leather jacket, timeless men’s fashion, casual leather jacket men, luxury men’s jacket, versatile men’s jacket, men’s leather jackets Chicago, premium lambskin leather jackets for men Chicago, classic men’s leather jacket with zipper Chicago, real leather Harrington jacket for men Chicago, stylish black leather jacket for men Chicago edition, durable lambskin leather jacket men Chicago, all-season men’s leather jacket Chicago, chic leather jacket with tailored fit Chicago, men’s leather jacket with functional pockets Chicago, adjustable waist and cuffs men’s jacket Chicago, versatile men’s Harrington leather jacket Chicago, luxury men’s black leather jacket Chicago', 1, 1, 1, 1, 1, 1, 1, 1769644800, 0, 1773078317, 0, 0, 0, 573091200, 573091200, 0, 0, '0', 0, 'tb7egPMvfFzbsApY', 573091200, 0, NULL, 1772259593, 1, '59.103.124.231'),
(2, 2, 10, 0, NULL, 'womens-leather-jackets-classic-fashion-chicago', 'Women’s Leather Jackets – Classic & Modern Styles', 'Womens', '<p>Our Women&rsquo;s Leather Jackets category offers a curated selection of premium outerwear designed to elevate any wardrobe. Each piece is crafted from 100% real lambskin leather, ensuring a luxurious feel and long-lasting durability. With soft polyester linings, tailored fits, and versatile designs, these jackets combine comfort with style. From classic Harrington collars to modern biker silhouettes, the collection caters to women seeking both sophistication and practicality. Functional details such as adjustable waists, cuffs, and multiple pockets make these jackets ideal for all-season wear. Whether paired with jeans for a casual look or layered over dresses for a chic evening ensemble, these jackets embody timeless fashion and modern elegance.</p>', '<p>Discover the Women&rsquo;s Leather Jackets Collection, where timeless craftsmanship meets modern fashion. Designed for women who value elegance, durability, and versatility, each jacket is crafted from premium lambskin leather with soft linings for comfort. Featuring classic cuts, chic collars, adjustable fits, and functional pockets, these jackets are perfect for both casual outings and sophisticated evenings. A must-have wardrobe staple that blends luxury with everyday wear.</p>', 'Women’s Leather Jackets – Premium Styles in Chicago', 'Shop the Women’s Leather Jackets Collection, crafted from premium lambskin leather with chic collars, tailored fits, soft linings, and versatile designs. Perfect for casual and evening wear, these jackets blend timeless elegance with modern fashion — available now in Chicago.', 'women’s leather jackets, black leather jacket women, lambskin leather jacket women, classic women’s jacket, stylish women’s outerwear, premium leather fashion, women’s wardrobe essentials, chic leather jacket, timeless women’s fashion, casual leather jacket women, luxury women’s jacket, versatile women’s jacket, women’s leather jackets Chicago, premium lambskin leather jackets for women Chicago, classic women’s leather jacket with zipper Chicago, real leather Harrington jacket for women Chicago, stylish black leather jacket for women Chicago edition, durable lambskin leather jacket women Chicago, all-season women’s leather jacket Chicago, chic leather jacket with tailored fit Chicago, women’s leather jacket with functional pockets Chicago, adjustable waist and cuffs women’s jacket Chicago, versatile women’s Harrington leather jacket Chicago, luxury women’s black leather jacket Chicago', 1, 1, 1, 1, 1, 1, 1, 1769644800, 0, 1773078317, 0, 0, 0, 573091200, 573091200, 0, 0, '0', 0, 'fULsaEGsmy7FCNXb', 573091200, 0, NULL, 1772259690, 1, '59.103.124.231'),
(3, 3, 8, 0, NULL, 'kids-leather-jackets-fashion-new-york', 'Kids’ Leather Jackets – Stylish & Durable Outerwear', 'Kids', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Our Kids&rsquo; Leather Jackets category offers a curated selection of premium outerwear tailored for children. Made from 100% real lambskin leather, these jackets deliver a luxurious look while ensuring durability for active lifestyles. Soft polyester linings provide comfort, while adjustable waists and cuffs allow for a flexible fit as kids grow. With functional pockets and easy closures, these jackets are practical for everyday use. Available in versatile designs ranging from classic Harrington styles to modern biker-inspired cuts, they are perfect for school, play, or family events. A timeless addition to any child&rsquo;s wardrobe, blending fashion with functionality &mdash; proudly styled for New York families.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Introduce your little ones to timeless fashion with the Kids&rsquo; Leather Jackets Collection. Crafted from premium lambskin leather with soft linings for comfort, these jackets are designed to be both stylish and durable. Featuring classic cuts, easy-to-use zippers, adjustable fits, and functional pockets, they provide practicality for everyday wear while keeping kids looking sharp. Perfect for school days, family outings, or seasonal layering, these jackets combine luxury craftsmanship with child-friendly design &mdash; now available in New York.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>', 'Kids’ Leather Jackets – Premium Styles in New York', 'Shop the Kids’ Leather Jackets Collection, crafted from premium lambskin leather with soft linings, adjustable fits, and functional pockets. Stylish, durable, and versatile outerwear designed for everyday wear — available now in New York.', 'kids’ leather jackets, children’s leather jacket, lambskin leather jacket kids, stylish kids’ outerwear, durable kids’ jacket, premium leather fashion kids, kids’ wardrobe essentials, chic kids’ jacket, timeless kids’ fashion, casual leather jacket children, luxury kids’ jacket, versatile kids’ jacket, kids’ leather jackets New York, premium lambskin leather jackets for kids New York, classic kids’ leather jacket with zipper New York, real leather Harrington jacket for kids New York, stylish black leather jacket for kids New York edition, durable lambskin leather jacket children New York, all-season kids’ leather jacket New York, chic leather jacket with tailored fit kids New York, kids’ leather jacket with functional pockets New York, adjustable waist and cuffs kids’ jacket New York, versatile kids’ Harrington leather jacket New York, luxury kids’ black leather jacket New York', 1, 1, 1, 1, 1, 1, 1, 1769644800, 0, 1773078317, 0, 0, 0, 573091200, 573091200, 0, 0, '0', 0, '3pmY3qr1acnfFNYT', 573091200, 0, NULL, 1772102572, 1, '59.103.124.231'),
(4, 4, 9, 0, NULL, 'leather-bags-fashion-los-angeles', 'Leather Bags – Premium Collection in Los Angeles', 'Bags', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Our Leather Bags category offers a curated selection of premium accessories tailored for every lifestyle. Made from 100% real lambskin leather, these bags deliver a luxurious look while ensuring durability for daily use. Soft linings, adjustable straps, and secure closures provide comfort and practicality, while spacious compartments and functional pockets make them ideal for carrying essentials. From classic tote bags to modern crossbody and backpack designs, the collection caters to men, women, and kids alike. Whether for professional settings, school, or casual outings, these leather bags embody timeless fashion, versatility, and craftsmanship &mdash; a must-have addition to any wardrobe in Los Angeles.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Discover the Leather Bags Collection, designed for men, women, and kids who value timeless fashion and everyday practicality. Crafted from premium lambskin leather with durable stitching and soft linings, these bags combine luxury with functionality. Featuring versatile designs such as crossbody, tote, backpack, and messenger styles, each bag offers spacious compartments, secure closures, and modern detailing. Perfect for work, school, travel, or casual outings, this collection blends elegance, durability, and convenience &mdash; now available in Los Angeles.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>', 'Leather Bags – Premium Collection in Los Angeles', 'Shop the Leather Bags Collection, crafted from premium lambskin leather with versatile designs, spacious compartments, and durable finishes. Perfect for men, women, and kids — timeless fashion meets everyday practicality in Los Angeles.', 'leather bags, men’s leather bag, women’s leather bag, kids’ leather bag, lambskin leather bag, stylish leather accessories, premium leather fashion, durable leather bag, timeless leather bag, casual leather bag, luxury leather bag, versatile leather bag, leather bags Los Angeles, premium lambskin leather bags Los Angeles, classic leather tote bag Los Angeles, real leather crossbody bag Los Angeles, stylish leather backpack Los Angeles edition, durable lambskin leather messenger bag Los Angeles, all-season leather bags Los Angeles, chic leather bag with tailored design Los Angeles, leather bag with functional compartments Los Angeles, adjustable strap leather bag Los Angeles, versatile leather bags collection Los Angeles, luxury black leather bag Los Angeles', 1, 1, 1, 1, 1, 1, 1, 1769644800, 0, 1773078317, 0, 0, 0, 573091200, 573091200, 0, 0, '0', 0, 'KjtX7wQXEL8Q74Vp', 573091200, 0, NULL, 1772102696, 1, '59.103.124.231'),
(5, 5, 12, 0, NULL, 'womens-leather-blazers-fashion-miami', 'Women’s Leather Blazers – Elegant & Modern Styles (Miami Edition)', 'Blazer', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Our Women&rsquo;s Leather Blazers category showcases a curated range of premium outerwear designed to bring sophistication to every occasion. Made from 100% real lambskin leather, these blazers deliver a polished look while ensuring durability and comfort. Soft polyester linings enhance wearability, while tailored cuts and structured silhouettes create a refined fit. Functional details such as button closures, inner pockets, and adjustable designs make them practical for everyday use. Whether styled with trousers for business meetings or layered over dresses for chic evenings, these leather blazers embody timeless fashion, versatility, and craftsmanship &mdash; a must-have addition to any wardrobe in Miami.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Elevate your wardrobe with the Women&rsquo;s Leather Blazers Collection, crafted from premium lambskin leather for a luxurious feel and lasting durability. Designed with tailored fits, soft linings, and chic detailing, these blazers seamlessly blend elegance with versatility. Perfect for professional settings, evening occasions, or smart-casual wear, each piece offers comfort, sophistication, and timeless fashion &mdash; now available in Miami.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>', 'Women’s Leather Blazers – Premium Collection in Miami', 'Shop the Women’s Leather Blazers Collection, crafted from premium lambskin leather with tailored fits, soft linings, and chic designs. Perfect for professional, casual, and evening wear — timeless fashion in Miami.', 'women’s leather blazers, black leather blazer women, lambskin leather blazer women, stylish women’s outerwear, premium leather fashion women, wardrobe essentials blazer women, chic leather blazer women, timeless women’s fashion, casual leather blazer women, luxury women’s blazer, versatile women’s blazer, tailored leather blazer women, women’s leather blazers Miami, premium lambskin leather blazers women Miami, classic women’s leather blazer with button Miami, real leather tailored blazer women Miami, stylish black leather blazer women Miami edition, durable lambskin leather blazer women Miami, all-season women’s leather blazer Miami, chic tailored leather blazer women Miami, women’s leather blazer with functional pockets Miami, adjustable fit women’s leather blazer Miami, versatile women’s leather blazers Miami, luxury black leather blazer women Miami', 1, 1, 1, 1, 1, 1, 1, 1769644800, 0, 1773078317, 0, 0, 0, 573091200, 573091200, 0, 0, '0', 0, 'LUm5SWMj7hxfBRev', 573091200, 0, NULL, 1772102809, 1, '59.103.124.231'),
(6, 6, 8, 0, NULL, 'mens-leather-shoes-fashion-new-york', 'Men’s Leather Shoes – Classic & Modern Styles', 'Shoes', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Our Men&rsquo;s Leather Shoes category offers a curated selection of premium footwear designed to elevate any wardrobe. Made from 100% genuine leather, these shoes deliver a polished look while ensuring long-lasting durability. Soft linings and cushioned insoles provide comfort, while tailored designs and versatile styles make them suitable for every occasion. From formal dress shoes to casual loafers and rugged boots, the collection caters to men seeking both sophistication and practicality. Whether paired with suits for business meetings or jeans for weekend outings, these leather shoes embody timeless fashion, versatility, and craftsmanship &mdash; a must-have addition to any wardrobe in New York.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Step into sophistication with the Men&rsquo;s Leather Shoes Collection, crafted from premium leather for durability, comfort, and timeless appeal. Featuring classic dress shoes, versatile loafers, stylish boots, and modern sneakers, this collection is designed for men who value elegance and practicality. Perfect for professional settings, casual outings, or evening occasions, these shoes combine luxury craftsmanship with everyday versatility &mdash; now available in New York.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>', 'Men’s Leather Shoes – Premium Collection in New York', 'Shop the Men’s Leather Shoes Collection, crafted from premium leather with cushioned comfort, tailored fits, and versatile designs. Perfect for professional, casual, and evening wear — timeless fashion in New York.', 'men’s leather shoes, black leather shoes men, premium leather footwear men, stylish men’s shoes, classic dress shoes men, men’s loafers leather, men’s leather boots, luxury men’s shoes, versatile men’s footwear, timeless men’s fashion shoes, casual leather shoes men, durable leather shoes men, men’s leather shoes New York, premium leather dress shoes men New York, stylish men’s loafers leather New York, real leather boots for men New York, men’s black leather shoes New York edition, durable leather sneakers men New York, all-season men’s leather shoes New York, chic leather shoes tailored fit men New York, men’s leather shoes with cushioned insoles New York, versatile men’s footwear collection New York, luxury men’s leather shoes New York, classic men’s leather shoes New York', 1, 1, 1, 1, 1, 1, 1, 1769644800, 0, 1773078317, 0, 0, 0, 573091200, 573091200, 0, 0, '0', 0, 'UsBAPYC8TMcNHNcG', 573091200, 0, NULL, 1772102937, 1, '59.103.124.231');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories_to_categories`
--

CREATE TABLE `tbl_categories_to_categories` (
  `parent_id` int(11) NOT NULL,
  `children_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ci_sessions`
--

CREATE TABLE `tbl_ci_sessions` (
  `id` varchar(190) NOT NULL,
  `ip_address` varchar(190) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE `tbl_config` (
  `config_id` int(11) NOT NULL,
  `config_key` varchar(190) NOT NULL,
  `config_value` text NOT NULL,
  `config_mode` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_config`
--

INSERT INTO `tbl_config` (`config_id`, `config_key`, `config_value`, `config_mode`) VALUES
(1, 'assets_url', 'https://8static.shonir.com/shonir-cms/', 1),
(2, 'uploads_url', 'https://8static.shonir.com/shonir-cms/', 1),
(3, 'price', 'TRUE', 1),
(4, 'lifetime_views', '0', 0),
(5, 'frontend_theme', 'default', 1),
(6, 'backend_theme', 'default', 1),
(7, 'app_name', 'SHONiR CMS', 0),
(8, 'img_url', 'https://ik.imagekit.io/stznbxt6o/shonir-cms/', 1),
(9, 'base_url', 'https://8.shonir.com/shonir-cms/', 1),
(10, 'css_url', 'https://8static.shonir.com/shonir-cms/', 1),
(11, 'js_url', 'https://8static.shonir.com/shonir-cms/', 1),
(12, 'notify_email', 'info@shonir.com', 0),
(13, 'app_type', '1', 0),
(14, 'badge_sale', 'TRUE', 1),
(15, 'fc_app_cdn_url', '18', 0),
(16, 'fc_app_api_url', '194', 0),
(17, 'fc_app_public_key', 'ieuHBxC6Y3Jl8qcyEK4mqXlVJZP75zke', 0),
(18, 'fc_app_secret_key', 'zWmlT6cUVo95idst8Sprx87OSpZjq0UW', 0),
(19, 'today_views', '0', 0),
(20, 'today_update', '0', 0),
(21, 'app_description', 'SHONiR CMS is an open-source content management system built on PHP 8+ with CodeIgniter 4 as the backend framework.\nIt’s designed to streamline development for PHP developers working on custom web applications. Whether you\'re building a dynamic product catalog, service portal, or content-heavy site, SHONiR CMS helps reduce conventional workload and accelerate delivery.', 0),
(22, 'app_key', 'shonir', 0),
(23, 'cache_time', '0', 0),
(24, 'ratings', 'TRUE', 1),
(25, 'ratings_guest', 'TRUE', 1),
(26, 'likes', 'TRUE', 1),
(27, 'likes_guest', 'TRUE', 1),
(28, 'promo_code', 'FALSE', 1),
(29, 'small_image_width', '274', 0),
(30, 'small_image_height', '274', 0),
(31, 'medium_image_width', '360', 0),
(32, 'medium_image_height', '360', 0),
(33, 'large_image_width', '492', 0),
(34, 'large_image_height', '492', 0),
(35, 'image_quality', '85', 0),
(36, 'tiny_image_width', '176', 0),
(37, 'tiny_image_height', '176', 0),
(38, 'limit_items_list', '16', 0),
(39, 'limit_items_newbie', '16', 0),
(40, 'limit_items_featured', '16', 0),
(41, 'limit_items_sale', '16', 0),
(42, 'limit_items_trending', '16', 0),
(43, 'limit_items_related', '16', 0),
(44, 'limit_items_same', '16', 0),
(45, 'limit_items_search', '48', 0),
(46, 'app_title', 'SHONiR Content Management System | Modern, Fast & Secure CMS', 0),
(47, 'app_meta_title', 'SHONiR CMS: The Future of Content Management & Digital Experiences', 0),
(48, 'app_meta_description', 'Experience the future of content management with SHONiR CMS. Fast, secure, and developer-friendly platform for businesses of all sizes. Collaborate in real-time, publish anywhere, and scale with ease.', 0),
(49, 'app_meta_keywords', 'best content management system for small business websites, how to choose a headless cms platform for developers, enterprise content management system with multi-language support, affordable cms software for ecommerce websites 2024, shonir cms pricing and features comparison guide, secure content management platform for healthcare websites, cms with built-in seo tools and analytics dashboard, migrate from wordpress to headless cms benefits, content management system for real estate websites, api-first cms for mobile app content management, cloud-based cms with drag and drop page builder, enterprise grade cms for government websites security, content management system, headless cms, enterprise cms, website builder, cms platform, web content management, digital experience platform, cloud cms, api cms, cms software, enterprise content management, modern cms, luxury content management system for e‑commerce, premium CMS solutions for global brands, scalable CMS with advanced mega menu design, professional CMS for fashion and sportswear websites, SHONiR CMS luxury branding and motion design, best CMS for UI/UX architects and developers, content management system with gold accents and tactile motion, SEO‑friendly CMS for international businesses, modern CMS with responsive mega menu and edge flipping, enterprise CMS with luxury e‑commerce themes, CMS platform for pixel‑perfect UI/UX design, professional CMS with modular CSS and semantic HTML, e‑commerce CMS, SEO CMS, responsive CMS, global CMS, UI/UX CMS, Custom sports wear manufacturing with no minimum order limits, Premium private label fitness clothing for fashion brands, Ethical sports apparel production in Pakistan for global exports, Best CMS for custom uniform design and fulfillment, How to start a custom fitness brand with free samples, Precision craftsmanship for professional team sports apparel, Eco-friendly custom activewear manufacturers for small businesses, Scalable content management system for global apparel brands, Luxury custom clothing design software for sports enthusiasts, Wholesale custom sports wears with premium fabric technology, Direct-to-consumer custom sports apparel platform for influencers, Technical sports wear development and manufacturing services, Bespoke tailoring, Fabric innovation, Apparel supply chain, Brand identity, Ethical manufacturing, Direct-to-Garment, Textile heritage, Activewear aesthetics, Moisture-wicking technology, Global logistics, Sublimation printing, Seamless integration, SHONiR CMS, Performance fabrics, Textile engineering, Custom apparel branding, Sports kit designer, High-end activewear, Pakistani textile export, Sustainable fashion production, Teamwear solutions, Fashion tech platform, B2B apparel CMS, Digital garment rendering', 0),
(50, 'badge_newbie', 'TRUE', 1),
(51, 'badge_featured', 'TRUE', 1),
(52, 'cdn_url', 'https://8static.shonir.com/shonir-cms/', 1),
(53, 'limit_hero_slides', '5', 0),
(54, 'hero_slides_width', '2000', 0),
(55, 'hero_slides_height', '938', 0),
(56, 'social_facebook', 'https://facebook.com/shonirits', 0),
(57, 'social_instagram', 'https://www.instagram.com/shonirits/', 0),
(58, 'social_x', 'https://x.com/shonirits', 0),
(59, 'social_pinterest', 'https://www.pinterest.com/shonirits/', 0),
(60, 'social_linkedin', 'https://www.linkedin.com/company/shonirits/', 0),
(61, 'social_youtube', 'https://www.youtube.com/@shonirits', 0),
(62, 'social_blogger', 'https://shonirits.blogspot.com/', 0),
(63, 'social_group', 'https://groups.google.com/g/shonirits', 0),
(64, 'social_tumblr', 'https://www.tumblr.com/shonirits', 0),
(65, 'social_reddit', 'https://www.reddit.com/user/shonirits/', 0),
(66, 'app_founding_date', '1988-02-29', 0),
(67, 'app_telephone', '+92-333-333-6426', 0),
(68, 'app_address', '3300 Broadway', 0),
(69, 'app_city', 'New York City', 0),
(70, 'app_region', 'New York', 0),
(71, 'app_postal', '10031', 0),
(72, 'app_country', 'US', 0),
(73, 'app_languages', 'English,Spanish', 0),
(74, 'app_email', 'info@shonir.com', 0),
(75, 'head_code', '<script type=\"text/javascript\">\r\n  fc_widget_id = \'13580\';\r\n</script>\r\n<script async src=\"https://cdn.jsdelivr.net/gh/shonirits/fishingcab@main/widgets/chat-min.js\" type=\"text/javascript\"></script>', 0),
(76, 'end_code', '<!-- Google tag (gtag.js) -->\r\n<script async src=\"https://www.googletagmanager.com/gtag/js?id=G-51EHWT8P66\"></script>\r\n<script>\r\n  window.dataLayer = window.dataLayer || [];\r\n  function gtag(){dataLayer.push(arguments);}\r\n  gtag(\'js\', new Date());\r\n\r\n  gtag(\'config\', \'G-51EHWT8P66\');\r\n</script>', 0),
(77, 'limit_items_all', '80', 0),
(78, 'app_website', 'www.shonir.com', 0),
(79, 'social_map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4587.577213854728!2d74.49164877654509!3d32.49676649825402!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391eea690f74f6a5%3A0x2ce374e577639e53!2sExTech%20Corporation!5e1!3m2!1sen!2s!4v1772003220236!5m2!1sen!2s', 0),
(80, 'ip_info_token', 'aefa42367041f0', 0),
(81, 'developer_mode', 'FALSE', 0),
(82, 'developer_mode_notice', ' <h5 class=\"mb-2\">🚧 Site Under Maintenance</h5>\r\n  <p>\r\n    Our website is currently in <strong>Developer Mode</strong> for updates and improvements.<br>\r\n    During this time, <strong>registration</strong>, <strong>login</strong>, and <strong>order placement</strong> are temporarily disabled.\r\n  </p>\r\n  <p class=\"mb-0\">We appreciate your patience and will be back online shortly!</p>', 0),
(83, 'celebiz_public_key', '1qazxsw23edcvfr45tgbnhy67ujm', 0),
(84, 'celebiz_secret_key', 'mju76yhnbgt54rfvcde32wsxzaq1', 0),
(85, 'currency_last_update', '1773078346', 0),
(86, 'currency_last_update_try', '1773078346', 0),
(87, 'statistics_update', '1773009357', 0),
(88, 'social_whatsapp', ' https://wa.me/923333336426 ', 0),
(89, 'social_tiktok', ' https://tiktok.com/@shonirits ', 0),
(90, 'social_telegram', ' https://telegram.me/shonirits ', 0),
(91, 'badge_hd', 'FALSE', 1),
(92, 'badge_lq', 'FALSE', 1),
(93, 'badge_st', 'FALSE', 1),
(94, 'category_image_width', '415', 0),
(95, 'category_image_height', '415', 0),
(96, 'aaaaaaaaaa', '', 0),
(97, 'app_author', 'Mian Shoaib', 0),
(100, 'cache_image', 'true', 0),
(101, 'image_original', 'false', 0),
(102, 'post_small_image_width', '414', 0),
(103, 'post_small_image_height', '240', 0),
(104, 'post_medium_image_width', '854', 0),
(105, 'post_medium_image_height', '240', 0),
(106, 'post_large_image_width', '854', 0),
(107, 'post_large_image_height', '495', 0),
(108, 'limit_posts_list', '8', 0),
(109, 'limit_posts_newbie', '2', 0),
(110, 'limit_posts_featured', '5', 0),
(111, 'limit_posts_search', '14', 0),
(112, 'limit_posts_random', '3', 0),
(113, 'limit_gallery_list', '16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currencies`
--

CREATE TABLE `tbl_currencies` (
  `currency_id` int(11) UNSIGNED NOT NULL,
  `priority` tinyint(4) NOT NULL DEFAULT 0,
  `currency` varchar(190) DEFAULT NULL,
  `name` varchar(190) DEFAULT NULL,
  `symbol` varchar(190) DEFAULT NULL,
  `exchange_rate` varchar(190) DEFAULT NULL,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_currencies`
--

INSERT INTO `tbl_currencies` (`currency_id`, `priority`, `currency`, `name`, `symbol`, `exchange_rate`, `update_time`) VALUES
(1, 0, 'AFN', 'Afghan afghani', '؋', '63.8565065953', 1773078346),
(2, 17, 'EUR', 'Euro', '€', '0.8678751244', 1773078346),
(3, 0, 'ALL', 'Albanian lek', 'Lek', '82.6000104925', 1773078346),
(4, 0, 'DZD', 'Algerian dinar', 'دج', '131.6500191781', 1773078346),
(5, 18, 'USD', 'US Dollar', '$', '1', 1773078346),
(7, 0, 'AOA', 'Angolan kwanza', 'Kz', '912.1311082148', 1773078346),
(8, 0, 'XCD', 'East Caribbean dollar', '$', '2.7', 1773078346),
(11, 0, 'ARS', 'Argentine peso', '$', '1415.0031460962', 1773078346),
(12, 0, 'AMD', 'Armenian dram', '֏', '377.3100567857', 1773078346),
(13, 0, 'AWG', 'Aruban florin', 'ƒ', '1.79', 1773078346),
(14, 12, 'AUD', 'Australian dollar', '$', '1.4356002543', 1773078346),
(16, 0, 'AZN', 'Azerbaijani manat', 'm', '1.7', 1773078346),
(17, 0, 'BSD', 'Bahamian dollar', 'B$', '1', 1773078346),
(18, 0, 'BHD', 'Bahraini dinar', '.د.ب', '0.376', 1773078346),
(19, 5, 'BDT', 'Bangladeshi taka', '৳', '122.3500143486', 1773078346),
(20, 0, 'BBD', 'Barbadian dollar', 'Bds$', '2', 1773078346),
(21, 0, 'BYN', 'Belarusian ruble', 'Br', '2.9500023363', 1773078346),
(23, 0, 'BZD', 'Belize dollar', '$', '2', 1773078346),
(24, 0, 'XOF', 'West African CFA franc', 'CFA', '569.1100654519', 1773078346),
(25, 0, 'BMD', 'Bermudian dollar', '$', '1', 1773078346),
(26, 0, 'BTN', 'Bhutanese ngultrum', 'Nu.', '91.9665038691', 1773078346),
(27, 0, 'BOB', 'Bolivian boliviano', 'Bs.', '6.9400013139', 1773078346),
(28, 0, 'BAM', 'Bosnia and Herzegovina convertible mark', 'KM', '1.6969002629', 1773078346),
(29, 0, 'BWP', 'Botswana pula', 'P', '13.1752024564', 1773078346),
(30, 0, 'NOK', 'Norwegian Krone', 'kr', '9.6537409896', 1773078346),
(31, 0, 'BRL', 'Brazilian real', 'R$', '5.265900947', 1773078346),
(33, 0, 'BND', 'Brunei dollar', 'B$', '1.2843001285', 1773078346),
(34, 0, 'BGN', 'Bulgarian lev', 'Лв.', '1.6650001987', 1773078346),
(36, 0, 'BIF', 'Burundian franc', 'FBu', '2967.8703110164', 1773078346),
(37, 0, 'KHR', 'Cambodian riel', 'KHR', '4008.0006123335', 1773078346),
(38, 0, 'XAF', 'Central African CFA franc', 'FCFA', '569.1100892731', 1773078346),
(39, 11, 'CAD', 'Canadian dollar', '$', '1.3602801398', 1773078346),
(40, 0, 'CVE', 'Cape Verdean escudo', '$', '95.5800189437', 1773078346),
(41, 0, 'KYD', 'Cayman Islands dollar', '$', '0.83333', 1773078346),
(44, 0, 'CLP', 'Chilean peso', '$', '912.1001264823', 1773078346),
(45, 14, 'CNY', 'Chinese yuan', '¥', '6.8970010357', 1773078346),
(48, 0, 'COP', 'Colombian peso', '$', '3773.9307314996', 1773078346),
(49, 0, 'KMF', 'Comorian franc', 'CF', '426.2700712336', 1773078346),
(51, 0, 'CDF', 'Congolese Franc', 'FC', '2147.7903799002', 1773078346),
(52, 0, 'NZD', 'Cook Islands dollar', '$', '1.7096002874', 1773078346),
(53, 0, 'CRC', 'Costa Rican colón', '₡', '475.6751029657', 1773078346),
(55, 0, 'HRK', 'Croatian kuna', 'kn', '6.5381397293', 1773078346),
(56, 0, 'CUP', 'Cuban peso', '$', '24', 1773078346),
(58, 0, 'CZK', 'Czech koruna', 'Kč', '21.207802486', 1773078346),
(59, 0, 'DKK', 'Danish krone', 'Kr.', '6.4831909737', 1773078346),
(60, 0, 'DJF', 'Djiboutian franc', 'Fdj', '177.721', 1773078346),
(62, 0, 'DOP', 'Dominican peso', '$', '59.9900083689', 1773078346),
(65, 0, 'EGP', 'Egyptian pound', 'ج.م', '52.1300096246', 1773078346),
(68, 0, 'ERN', 'Eritrean nakfa', 'Nfk', '15', 1773078346),
(70, 0, 'ETB', 'Ethiopian birr', 'Nkf', '156.1000268167', 1773078346),
(71, 0, 'FKP', 'Falkland Islands pound', '£', '0.7515110701', 1773078346),
(73, 0, 'FJD', 'Fijian dollar', 'FJ$', '2.2105504391', 1773078346),
(77, 0, 'XPF', 'CFP franc', '₣', '104.0000161805', 1773078346),
(80, 0, 'GMD', 'Gambian dalasi', 'D', '74.490010154', 1773078346),
(81, 0, 'GEL', 'Georgian lari', 'ლ', '2.7362004626', 1773078346),
(83, 0, 'GHS', 'Ghanaian cedi', 'GH₵', '10.772701188', 1773078346),
(84, 0, 'GIP', 'Gibraltar pound', '£', '0.7515111117', 1773078346),
(90, 0, 'GTQ', 'Guatemalan quetzal', 'Q', '7.6640011243', 1773078346),
(91, 16, 'GBP', 'British pound', '£', '0.7518630841', 1773078346),
(92, 0, 'GNF', 'Guinean franc', 'FG', '8788.0012324916', 1773078346),
(94, 0, 'GYD', 'Guyanese dollar', '$', '208.9800223864', 1773078346),
(95, 0, 'HTG', 'Haitian gourde', 'G', '133.1300195033', 1773078346),
(97, 0, 'HNL', 'Honduran lempira', 'L', '26.5204040261', 1773078346),
(98, 0, 'HKD', 'Hong Kong dollar', '$', '7.8170613744', 1773078346),
(99, 0, 'HUF', 'Hungarian forint', 'Ft', '342.6800428507', 1773078346),
(100, 0, 'ISK', 'Icelandic króna', 'kr', '124.9500241244', 1773078346),
(101, 4, 'INR', 'Indian rupee', '₹', '92.0640092261', 1773078346),
(102, 0, 'IDR', 'Indonesian rupiah', 'Rp', '16918.00226722', 1773078346),
(103, 0, 'IRR', 'Iranian rial', '﷼', '1317341.2372987', 1773078346),
(104, 0, 'IQD', 'Iraqi dinar', 'د.ع', '1310.5002215682', 1773078346),
(106, 0, 'ILS', 'Israeli new shekel', '₪', '3.1122204669', 1773078346),
(108, 0, 'JMD', 'Jamaican dollar', 'J$', '156.2400165015', 1773078346),
(109, 9, 'JPY', 'Japanese yen', '¥', '158.4400253507', 1773078346),
(111, 0, 'JOD', 'Jordanian dinar', 'ا.د', '0.71', 1773078346),
(112, 0, 'KZT', 'Kazakhstani tenge', 'лв', '493.9700781998', 1773078346),
(113, 0, 'KES', 'Kenyan shilling', 'KSh', '128.8768350592', 1773078346),
(115, 0, 'KPW', 'North Korean Won', '₩', '900.0116311938', 1773078346),
(116, 0, 'KRW', 'Won', '₩', '1493.9381618831', 1773078346),
(117, 0, 'KWD', 'Kuwaiti dinar', 'ك.د', '0.3077700525', 1773078346),
(118, 0, 'KGS', 'Kyrgyzstani som', 'лв', '87.4500093855', 1773078346),
(119, 0, 'LAK', 'Lao kip', '₭', '21336.0022835', 1773078346),
(121, 0, 'LBP', 'Lebanese pound', '£', '89500.009773887', 1773078346),
(122, 0, 'LSL', 'Lesotho loti', 'L', '16.5700021828', 1773078346),
(123, 0, 'LRD', 'Liberian dollar', '$', '183.0050286925', 1773078346),
(124, 0, 'LYD', 'Libyan dinar', 'د.ل', '6.3720008607', 1773078346),
(125, 0, 'CHF', 'Swiss franc', 'CHf', '0.7812901475', 1773078346),
(128, 0, 'MOP', 'Macanese pataca', '$', '8.0536010968', 1773078346),
(129, 0, 'MKD', 'Denar', 'ден', '53.1000087981', 1773078346),
(130, 0, 'MGA', 'Malagasy ariary', 'Ar', '4178.0007894348', 1773078346),
(131, 0, 'MWK', 'Malawian kwacha', 'MK', '1733.673276856', 1773078346),
(132, 0, 'MYR', 'Malaysian ringgit', 'RM', '3.9460004859', 1773078346),
(133, 0, 'MVR', 'Maldivian rufiyaa', 'Rf', '15.4600024614', 1773078346),
(139, 0, 'MRO', 'Mauritanian ouguiya', 'MRU', '356.999828', 1773078346),
(140, 0, 'MUR', 'Mauritian rupee', '₨', '47.3900049249', 1773078346),
(142, 0, 'MXN', 'Mexican peso', '$', '17.9961025479', 1773078346),
(144, 0, 'MDL', 'Moldovan leu', 'L', '17.2000032616', 1773078346),
(146, 0, 'MNT', 'Mongolian tögrög', '₮', '3569.8950978206', 1773078346),
(150, 0, 'MZN', 'Mozambican metical', 'MT', '63.5600109443', 1773078346),
(151, 0, 'MMK', 'Burmese kyat', 'K', '2098.6802705758', 1773078346),
(152, 0, 'NAD', 'Namibian dollar', '$', '16.5600025526', 1773078346),
(154, 0, 'NPR', 'Nepalese rupee', '₨', '146.5640235385', 1773078346),
(159, 0, 'NIO', 'Nicaraguan córdoba', 'C$', '36.7162769028', 1773078346),
(161, 0, 'NGN', 'Nigerian naira', '₦', '1387.9901778478', 1773078346),
(166, 6, 'OMR', 'Omani rial', '.ع.ر', '0.3849000451', 1773078346),
(167, 19, 'PKR', 'Pakistani rupee', '₨', '279.2300407779', 1773078346),
(170, 0, 'PAB', 'Panamanian balboa', 'B/.', '1.0000001641', 1773078346),
(171, 0, 'PGK', 'Papua New Guinean kina', 'K', '4.2928005745', 1773078346),
(172, 0, 'PYG', 'Paraguayan guarani', '₲', '6540.0007152956', 1773078346),
(173, 0, 'PEN', 'Peruvian sol', 'S/.', '3.4815005681', 1773078346),
(174, 0, 'PHP', 'Philippine peso', '₱', '59.0360084264', 1773078346),
(176, 0, 'PLN', 'Polish złoty', 'zł', '3.7297905849', 1773078346),
(179, 7, 'QAR', 'Qatari riyal', 'ق.ر', '3.6410004535', 1773078346),
(181, 0, 'RON', 'Romanian leu', 'lei', '4.4164007114', 1773078346),
(182, 15, 'RUB', 'Russian ruble', '₽', '79.0000119347', 1773078346),
(183, 0, 'RWF', 'Rwandan franc', 'FRw', '1458.590243112', 1773078346),
(184, 0, 'SHP', 'Saint Helena pound', '£', '0.745600094', 1773078346),
(191, 0, 'WST', 'Samoan tālā', 'SAT', '2.7143731538', 1773078346),
(193, 0, 'STD', 'Dobra', 'Db', '21343.790699252', 1773078346),
(194, 8, 'SAR', 'Saudi riyal', '﷼', '3.7533007074', 1773078346),
(196, 0, 'RSD', 'Serbian dinar', 'din', '101.0660175501', 1773078346),
(197, 0, 'SCR', 'Seychellois rupee', 'SRe', '14.7739028333', 1773078346),
(198, 0, 'SLL', 'Sierra Leonean leone', 'Le', '22871.102772772', 1773078346),
(199, 0, 'SGD', 'Singapore dollar', '$', '1.2844001599', 1773078346),
(202, 0, 'SBD', 'Solomon Islands dollar', 'Si$', '8.0291603501', 1773078346),
(203, 0, 'SOS', 'Somali shilling', 'Sh.so.', '572.0000928349', 1773078346),
(204, 0, 'ZAR', 'South African rand', 'R', '16.8168031434', 1773078346),
(208, 0, 'LKR', 'Sri Lankan rupee', 'Rs', '310.9100549534', 1773078346),
(209, 0, 'SDG', 'Sudanese pound', '.س.ج', '601.5', 1773078346),
(210, 0, 'SRD', 'Surinamese dollar', '$', '37.7500051054', 1773078346),
(212, 0, 'SZL', 'Lilangeni', 'E', '16.7807027359', 1773078346),
(213, 0, 'SEK', 'Swedish krona', 'kr', '9.2752417959', 1773078346),
(215, 0, 'SYP', 'Syrian pound', 'LS', '110.5840565647', 1773078346),
(216, 0, 'TWD', 'New Taiwan dollar', '$', '31.9079047059', 1773078346),
(217, 0, 'TJS', 'Tajikistani somoni', 'SM', '9.5749015143', 1773078346),
(218, 0, 'TZS', 'Tanzanian shilling', 'TSh', '2559.000295406', 1773078346),
(219, 0, 'THB', 'Thai baht', '฿', '32.0640062205', 1773078346),
(222, 0, 'TOP', 'Tongan paʻanga', '$', '2.3524003881', 1773078346),
(223, 0, 'TTD', 'Trinidad and Tobago dollar', '$', '6.6908006915', 1773078346),
(224, 0, 'TND', 'Tunisian dinar', 'ت.د', '2.9075004866', 1773078346),
(225, 13, 'TRY', 'Turkish lira', '₺', '44.0835081876', 1773078346),
(226, 0, 'TMT', 'Turkmenistan manat', 'T', '3.5', 1773078346),
(229, 0, 'UGX', 'Ugandan shilling', 'USh', '3679.9006975956', 1773078346),
(230, 0, 'UAH', 'Ukrainian hryvnia', '₴', '43.9319069908', 1773078346),
(231, 10, 'AED', 'United Arab Emirates dirham', 'إ.د', '3.6734006472', 1773078346),
(235, 0, 'UYU', 'Uruguayan peso', '$', '40.0400070746', 1773078346),
(236, 0, 'UZS', 'Uzbekistani soʻm', 'лв', '12210.001371315', 1773078346),
(237, 0, 'VUV', 'Vanuatu vatu', 'VT', '119.4350001309', 1773078346),
(239, 0, 'VEF', 'Bolívar', 'Bs', '43257458.324344', 1773078346),
(240, 0, 'VND', 'Vietnamese đồng', '₫', '26200.002843469', 1773078346),
(244, 0, 'MAD', 'Moroccan Dirham', 'MAD', '9.2894011542', 1773078346),
(245, 0, 'YER', 'Yemeni rial', '﷼', '238.3800433522', 1773078346),
(246, 0, 'ZMW', 'Zambian kwacha', 'ZK', '19.4300023152', 1773078346),
(247, 0, 'ZWL', 'Zimbabwe Dollar', '$', '64339.686150832', 1773078346),
(249, 0, 'ANG', 'Netherlands Antillean guilder', 'ƒ', '1.7880003459', 1773078346);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emails`
--

CREATE TABLE `tbl_emails` (
  `email_id` int(11) NOT NULL,
  `mail_queue_id` int(11) NOT NULL DEFAULT 0,
  `email` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `subscribed` tinyint(1) NOT NULL DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `unsubscribed` tinyint(1) NOT NULL DEFAULT 0,
  `subscribed_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `verified_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `unsubscribed_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_galleries`
--

CREATE TABLE `tbl_galleries` (
  `gallery_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `parent_id` varchar(190) DEFAULT NULL,
  `parent_type` varchar(190) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `link` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 1,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_galleries`
--

INSERT INTO `tbl_galleries` (`gallery_id`, `sort_order`, `parent_id`, `parent_type`, `title`, `name`, `description`, `link`, `status`, `featured`, `listed`, `removable`, `today_views`, `statistics_update`, `lifetime_views`, `today_hits`, `lifetime_hits`, `last_view_time`, `last_hit_time`, `token`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(1, 1, 'gallery-videos', 'video', 'Old Money & Quiet Luxury on London Streets — What Real Men Are Wearing in 2026 🇬🇧', 'Old Money & Quiet Luxury on London Streets ', '<p>Discover the latest in London men\'s style for 2026! From chic streetwear to sophisticated fashion trends, this video showcases the best looks and where to find them. Whether you\'re strolling through Shoreditch or enjoying a coffee in Notting Hill, we\'ll help you elevate your fashion game. Join us as we explore the stylish streets of London and share insider tips on how to dress like a true Londoner. Don\'t forget to like, comment, and subscribe for more fashion inspiration!<br />London Street Style Highlights<br />Trendy Outfits 2026<br />Shop in London<br />Style Tips from London Influencers<br />Must-Have Wardrobe Essentials 2026</p>', 'https://www.youtube.com/watch?v=06esoQboNPM', 1, 1, 1, 1, 318, 573091200, 999, 99, 999, 1773077707, 573091200, 'eKLqbSDeLw295nMj', 1771918748, 1, '59.103.124.231', 1771919463, 1, '59.103.124.231'),
(2, 2, 'gallery-videos', 'video', 'Stylish Leather Jacket Outfit Ideas for Men 2025 Fall/Winter | Modern & Trendy ', 'Stylish Leather Jacket Outfit Ideas for Men 2025', '<p>Upgrade your style game this season with our best leather jacket outfit ideas for men in 2025. From rugged biker looks to polished streetwear fits, these modern and trendy outfit inspirations show you how to wear a leather jacket with confidence and class. Discover how to pair timeless jackets with jeans, turtlenecks, boots, and accessories that elevate your fall and winter wardrobe. Whether you love a casual cool vibe or a sleek urban edge, these outfit ideas will help you turn heads and stay warm in style. Perfect for men who value fashion, comfort, and effortless sophistication &mdash; this is your go-to guide for 2025 men&rsquo;s fashion trends.</p>', 'https://www.youtube.com/watch?v=3XUOJBywGms', 1, 1, 1, 1, 312, 573091200, 999, 99, 999, 1773077707, 573091200, 'uS1s0sKqT0Er2tWm', 1771919685, 1, '59.103.124.231', 573091200, 0, NULL),
(3, 3, 'gallery-videos', 'video', 'The One Leather Jacket Every Man Over 50 Needs (And How to Wear It Right)', 'The One Leather Jacket Every Man', '<p>There&rsquo;s a difference between wearing leather and owning it.<br />After 50, the leather jacket is no longer a symbol of rebellion &mdash; it&rsquo;s a statement of refinement.<br />In this video, we&rsquo;ll explore how mature men wear branded leather jackets with grace, confidence, and timeless style.</p>\r\n<p>From choosing the perfect fit and appreciating craftsmanship, to layering it with quiet confidence &mdash; discover how to turn a simple jacket into a lifelong companion.</p>', 'https://www.youtube.com/watch?v=P4DPc-mS6Ao', 1, 0, 1, 1, 125, 573091200, 999, 99, 999, 1773006396, 573091200, 'jYYYueS5XnvnM9JX', 1771919817, 1, '59.103.124.231', 1771923688, 1, '59.103.124.231'),
(4, 4, 'gallery-videos', 'video', 'M&S Men\'s Style: The Art of Tailoring - TV AD 2016', 'M&S Men\'s Style', '<p>Our new slim-cut suit, a modern design that blends seamlessly with your life. From classic workwear tailoring to cutting-edge pieces that smarten up your off-duty occasions, make it a perennially stylish suit.</p>', 'https://www.youtube.com/watch?v=75nNqaNOYrs', 1, 0, 1, 1, 125, 573091200, 999, 99, 999, 1773006396, 573091200, '9q4Yta8sM4eb5MLA', 1771920015, 1, '59.103.124.231', 1771923688, 1, '59.103.124.231'),
(5, 5, 'gallery-videos', 'video', 'Sherri Hill | Spring/Summer 2026 | New York Fashion Week', 'Sherri Hill | Spring/Summer 2026', '<p>Sherri Hill | Spring/Summer 2026 | New York Fashion Week</p>\r\n<p>Witness the magic of Sherri Hill&rsquo;s Spring/Summer 2026 womenswear &nbsp;collection, presented in New York</p>\r\n<p>Take a closer look of every runway looks of the fashion show in the video.&nbsp;</p>', 'https://www.youtube.com/watch?v=ZukboSBHZJk', 1, 1, 1, 1, 310, 573091200, 999, 99, 999, 1773077707, 573091200, 'BKkELARy3T6PdtXS', 1771920179, 1, '59.103.124.231', 573091200, 0, NULL),
(6, 5, 'gallery-videos', 'video', 'Rethink Fashion 2025–2026: What No One’s Telling You About This Year’s Trends', 'Rethink Fashion 2025–2026', '<p>Fall 2025 Wardrobe Guide (palettes, capsules, swaps): https://trendsspottedfashion.com/fall...</p>\r\n<p>Fashion in 2025 and 2026 is changing fast &mdash; but not in the way you think. In this video, I&rsquo;ll reveal the real story behind this season&rsquo;s trends and how to stay current without chasing microtrends or wasting money.&nbsp;</p>\r\n<p>📖 My Fall 2025 Style Guide is OUT! &nbsp;<br />Get all the trends, timeless pieces &amp; outfit formulas in one place &rarr; https://trendsspottedfashion.com/fall...</p>\r\n<p>From the new wave of minimalism and the return of refined Boho to the quiet rise of &ldquo;Marine elegance,&rdquo; we&rsquo;ll dive into the most wearable Spring/Summer 2025 trends for women over 40 and 50 who want to look stylish, modern, and authentic.</p>\r\n<p>This isn\'t just a trend recap &mdash; it\'s a smart, elevated take on fashion for real life. Whether you\'re a long-time fashion lover or just starting to rebuild your wardrobe with purpose, this video is packed with practical tips, honest insight, and surprising truths.</p>\r\n<p>✨ Discover what&rsquo;s in, what&rsquo;s out, and what actually works for you in 2025-2026.</p>\r\n<p>#SpringFashion2025 #FashionTrends2025 #TrendsSpottedFashion #WomenOver40Style #TimelessFashion #2025StyleUpdate #MinimalistChic #SmartFashion #FashionTips2025 #Boho2025 #MarineTrend #MochaMousseTrend #ElevatedStyle</p>', 'https://www.youtube.com/watch?v=sw3J50YE5Tw', 1, 0, 1, 1, 123, 573091200, 999, 99, 999, 1773006396, 573091200, '1Axhu7PGe9rGpgc4', 1771920414, 1, '59.103.124.231', 1771923688, 1, '59.103.124.231'),
(7, 7, 'gallery-video', 'video', 'WINTER FASHION 2025: 10 Trends to Embrace and 5 to Ditch!', 'WINTER FASHION 2025', '<p>Winter Fashion 2025: 10 Trends to Embrace and 5 to Ditch! ❄️</p>\r\n<p>Watch Next- &nbsp; &nbsp; &bull; What to Shop for the Fashionistas in Your ... &nbsp;</p>\r\n<p>Get ready to elevate your winter wardrobe with my comprehensive guide to the top fashion trends of 2024-2025! 🌟 In this video, I&rsquo;ll walk you through 10 must-have styles that will keep you cozy and chic all season long, from luxurious layers to statement accessories. Plus, I&rsquo;ll reveal the 5 trends you should leave behind to stay ahead in the fashion game.&nbsp;</p>\r\n<p>✨ What\'s Inside:<br />1. Embrace- Discover the fabrics, colors, and silhouettes that are taking over the runways.<br />2. Ditch - Learn which outdated styles to swap out of your closet.<br />3. Style Tips- Expert advice on how to integrate these trends into your everyday outfits.<br />4. Shopping Guide- Where to find the best pieces to refresh your winter look.</p>\r\n<p>Don&rsquo;t forget to hit LIKE, SUBSCRIBE, and RING THE BELL for your dose of the latest fashion updates. Stay warm and stylish! 💃🧥👢</p>', 'https://www.youtube.com/watch?v=HwOu6VKwlDo', 1, 1, 1, 1, 99, 573091200, 999, 99, 999, 573091200, 573091200, 'AqHMgqZu6e8yMrjU', 1771920549, 1, '59.103.124.231', 573091200, 0, NULL),
(8, 8, 'gallery-videos', 'video', 'Beautiful Italian Street Style May 2025 – Best Fashion Looks from the World’s Fashion Capital', 'Beautiful Italian Street Style May 2025', '<p>Explore the beautiful Italian street style of May 2025, captured in the heart of the world&rsquo;s fashion capital &mdash; Milan. 🇮🇹</p>\r\n<p>This video showcases the best fashion looks worn by Italy&rsquo;s most stylish women, blending timeless elegance with today&rsquo;s hottest trends. From chic spring outfits to sophisticated street style, discover how Italian fashionistas dress with effortless grace and modern flair.</p>\r\n<p>Get inspired by quiet luxury, old money vibes, and fresh outfit ideas perfect for the warm spring season!</p>', 'https://www.youtube.com/watch?v=BtymtUiAEZI&pp=ygUadHJlbmR5IHdvbWVuIGZhc2hpb24gaXRseSA%3D', 1, 1, 1, 1, 308, 573091200, 999, 99, 999, 1773077707, 573091200, 'yA2DZX8DLzsWTXLG', 1771920797, 1, '59.103.124.231', 573091200, 0, NULL),
(9, 9, 'gallery-videos', 'video', 'Italian Fashion Street Style 2026: Chic in the Cold Italian Street Style Fashion Trends in February ', 'Italian Fashion Street Style 2026', '<p>MILAN STREET STYLE 2026: Clean, Elegant, Expensive Minimalist Luxury Fashion Inspiration 2026</p>\r\n<p>Step into the fashion capital of Milan, where classic Italian tailoring meets modern streetwear energy. Milan street style is known for its polished silhouettes, luxurious textures, and effortless layering&mdash;blending structured coats, statement accessories, and bold seasonal trends. From minimalist neutrals to standout designer pieces, these looks capture the city\'s signature balance of elegance and creativity, offering endless inspiration for everyday outfits with a high-fashion edge.</p>\r\n<p><br />Please click the link to see Amazing Summer Outfit inspiration:</p>', 'https://www.youtube.com/watch?v=Tl2Kd5QjwPs', 1, 0, 1, 1, 117, 573091200, 999, 99, 999, 1773006396, 573091200, '55SzxrPHifY1NjTE', 1771920973, 1, '59.103.124.231', 573091200, 0, NULL),
(10, 10, 'gallery-videos', 'video', 'Unique Italian Street Style! Discover the Best Italian Trends for Summer 2024. Luxury shopping walk', 'Unique Italian Street Style! Discover the Best Italian', '<p>Discover Unique Italian Street Style for Summer 2024! Explore the best Italian trends in this luxury shopping walk. See how stylish locals embrace chic elegance, quiet luxury, and effortlessly trendy looks. Get inspired by the latest fashion insights and elevate your summer wardrobe with these must-have pieces!</p>\r\n<p>Become a channel sponsor for only 2,99$/month</p>', 'https://www.youtube.com/watch?v=A99O4lDSpvo', 1, 0, 1, 1, 115, 573091200, 999, 99, 999, 1773006396, 573091200, 'RJXyZtxheDE6s45g', 1771921304, 1, '59.103.124.231', 573091200, 0, NULL),
(11, 11, 'gallery-videos', 'video', 'TOP 5 Handbag Trends 2025 YOU Need To Know', 'TOP 5 Handbag Trends 2025 YOU Need To Know', '<p>Top 5 Handbag Trends 2025 YOU Need To Know</p>\r\n<p>Discover the top 5 handbag trends for 2025 that you need to know to stay ahead in fashion! This video explores the must-have styles dominating the season, from bold statement bags to practical and versatile options. Learn what makes these handbags stand out, how to style them, and where to find them. Elevate your accessory game with the hottest picks for the year.</p>', 'https://www.youtube.com/watch?v=TA-jq6S6bZU', 1, 0, 1, 1, 115, 573091200, 999, 99, 999, 1773006396, 573091200, 'ZUV7MnK8hPyM8UwN', 1771921584, 1, '59.103.124.231', 573091200, 0, NULL),
(12, 1, 'gallery-images', 'image', 'Men Blazer Style', 'Men Blazer Style', '<p>Men Blazer Style</p>', '', 1, 0, 1, 1, 127, 573091200, 999, 99, 999, 1773006399, 573091200, 'Mwf8WFfVUyB93Q3e', 1771926026, 1, '59.103.124.231', 1772000953, 1, '59.103.124.231'),
(13, 2, 'gallery-images', 'image', 'Denim Jeans and Shoes', 'Denim Jeans and Shoes', '<p>Denim Jeans and Shoes</p>', '', 1, 1, 1, 1, 301, 573091200, 999, 99, 999, 1773077707, 573091200, '093DsP448LWXV8zJ', 1771999052, 1, '59.103.124.231', 573091200, 0, NULL),
(14, 3, 'gallery-images', 'image', 'Kids Leather And Denim Jeans Jackets', 'Kids Leather And Denim Jeans Jackets', '<p>Kids Leather And Denim Jeans Jackets</p>', '', 1, 1, 1, 1, 301, 573091200, 999, 99, 999, 1773077707, 573091200, 'nR6FzNNSziTtqpNK', 1771999141, 1, '59.103.124.231', 573091200, 0, NULL),
(15, 4, 'gallery-images', 'image', 'Women Wear Blazer and Brown Shoes', 'Women Wear Blazer and Brown Shoes', '', '', 1, 1, 1, 1, 300, 573091200, 999, 99, 999, 1773077707, 573091200, 'FTTSh2huvuqPwy6c', 1771999259, 1, '59.103.124.231', 573091200, 0, NULL),
(16, 5, 'gallery-images', 'image', 'Ladies Bag', 'Ladies Bag', '', '', 1, 0, 1, 1, 118, 573091200, 999, 99, 999, 1773006399, 573091200, 'RLZgAV24BikQ3Zqt', 1771999709, 1, '59.103.124.231', 573091200, 0, NULL),
(17, 6, 'gallery-images', 'image', 'Men Brown Blazer Style', 'Men Brown Blazer Style', '', '', 1, 0, 1, 1, 120, 573091200, 999, 99, 999, 1773006399, 573091200, 'rD6mVhtk5GL7UQY0', 1771999761, 1, '59.103.124.231', 1772000953, 1, '59.103.124.231'),
(18, 7, 'gallery-images', 'image', 'Street style fashion.Three girls Professional model', 'Street style fashion.Three girls Professional model', '', '', 1, 1, 1, 1, 298, 573091200, 999, 99, 999, 1773077707, 573091200, 'dwN89uS9TDYiMjGL', 1771999840, 1, '59.103.124.231', 1772000332, 1, '59.103.124.231'),
(19, 8, 'gallery-images', 'image', 'A Young Brunette Woman in Green Coat', 'A Young Brunette Woman in Green Coat', '', '', 1, 1, 1, 1, 297, 573091200, 999, 99, 999, 1773077707, 573091200, 'AasBxA2hPq8hQqTT', 1772000444, 1, '59.103.124.231', 573091200, 0, NULL),
(20, 9, 'gallery-images', 'image', 'Happy Woman Dance Motion Wear Lime Yellow Flared Outfit Jumper', 'Happy Woman Dance Motion Wear Lime Yellow Flared Outfit Jumper', '', '', 1, 1, 1, 1, 295, 573091200, 999, 99, 999, 1773077707, 573091200, 'D0QiJhYGSmRa1SsP', 1772000680, 1, '59.103.124.231', 573091200, 0, NULL),
(21, 10, 'gallery-images', 'image', 'A stylish young man poses in a black coat and yellow beanie', 'A stylish young man poses in a black coat and yellow beanie', '', '', 1, 0, 1, 1, 113, 573091200, 999, 99, 999, 1773006399, 573091200, 'aGYff5nK3Tm7A2qK', 1772001290, 1, '59.103.124.231', 573091200, 0, NULL),
(22, 11, 'gallery-images', 'image', 'Trendy young man in sunglasses posing near the wall on the street on a summer day', 'Trendy young man in sunglasses posing near the wall on the street on a summer day', '<p>Trendy young man in sunglasses posing near the wall on the street on a summer day</p>', '', 1, 0, 1, 1, 113, 573091200, 999, 99, 999, 1773006399, 573091200, 'vwvpc8uUuzhHUVrM', 1772001343, 1, '59.103.124.231', 573091200, 0, NULL),
(23, 12, 'gallery-images', 'image', 'Beautiful girl wear leather jacket in the city', 'Beautiful girl wear leather jacket in the city', '<p>Beautiful girl wear leather jacket in the city</p>', 'Beautiful girl wear leather jacket in the city', 1, 0, 1, 1, 113, 573091200, 999, 99, 999, 1773006399, 573091200, '6DKqw45kvcwFm2LG', 1772001440, 1, '59.103.124.231', 573091200, 0, NULL),
(24, 13, 'gallery-images', 'image', 'Fashionable confident beautiful woman wearing trendy burgundy leather raincoat', 'Fashionable confident beautiful woman wearing trendy burgundy leather raincoat', '<p>Fashionable confident beautiful woman wearing trendy burgundy leather raincoat</p>', '', 1, 0, 1, 1, 113, 573091200, 999, 99, 999, 1773006399, 573091200, 'zEDvdZ8kBWrajiAM', 1772001479, 1, '59.103.124.231', 573091200, 0, NULL),
(25, 14, 'gallery-images', 'image', 'Hipster in leather jacket', 'Hipster in leather jacket', '<p>Hipster in leather jacket</p>', '', 1, 0, 1, 1, 112, 573091200, 999, 99, 999, 1773006399, 573091200, 'bAHq3faXh0YkY5fb', 1772001711, 1, '59.103.124.231', 573091200, 0, NULL),
(26, 15, 'gallery-images', 'image', 'Baby Girls Wear Leather Jackets', 'Baby Girls Wear Leather Jackets', '<p>Baby Girls Wear Leather Jackets</p>', '', 1, 0, 1, 1, 112, 573091200, 999, 99, 999, 1773006399, 573091200, 'Bggj9EhCvQmr5tjW', 1772001828, 1, '59.103.124.231', 573091200, 0, NULL),
(27, 16, 'gallery-images', 'image', 'Serious fashionable woman with black sunglasses on her eyes looking away ', 'Serious fashionable woman with black sunglasses on her eyes looking away ', '<p>Serious fashionable woman with black sunglasses on her eyes looking away&nbsp;</p>', '', 1, 0, 1, 1, 111, 573091200, 999, 99, 999, 1773006399, 573091200, 'jMfZHv0Ja3dK78Jd', 1772002057, 1, '59.103.124.231', 573091200, 0, NULL),
(28, 11, 'gallery-videos', 'video', 'LPM Leather Fashion House - Natural Leather Pants', 'LPM Leather Fashion House', '<p>Kelsey modelling our exquisite 5 pocket natural leather pants.. www.leatherpantsmodels.com #leatherpantsmodels #leatherpants #leather #leatherleggings #leathershorts #leathermodel #leatherfashion #leathergoods #fashionblogger #fashionadelaide #adelaidemodel #fashionmodel</p>', 'https://www.youtube.com/watch?v=vfoamsEkhe0', 1, 0, 1, 1, 112, 573091200, 999, 99, 999, 1773006396, 573091200, 'emPt8VnfJffbsz4S', 1772002335, 1, '59.103.124.231', 573091200, 0, NULL),
(29, 12, 'gallery-videos', 'video', 'Buying A Leather Jacket For Life', 'Buying A Leather Jacket For Life', '<p>Join the Newsletter &amp; Discord: https://bit.ly/3WDNY3s</p>\r\n<p>MY BRAND: https://bit.ly/4dDBqiG</p>\r\n<p>The current collection: https://bit.ly/3Y041sC</p>\r\n<p>Leather Jackets</p>\r\n<p>LOWER SEGMENT:</p>', 'https://www.youtube.com/watch?v=8CS1au6qPvw', 1, 0, 1, 1, 112, 573091200, 999, 99, 999, 1773006396, 573091200, 'CYqEW41TPrDn8Exm', 1772002439, 1, '59.103.124.231', 573091200, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_industries`
--

CREATE TABLE `tbl_industries` (
  `industry_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `items` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `bottom` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `item_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `model` varchar(190) DEFAULT NULL,
  `sku` varchar(190) DEFAULT NULL,
  `mpn` varchar(190) DEFAULT NULL,
  `gtin` varchar(190) DEFAULT NULL,
  `price` varchar(190) NOT NULL DEFAULT '0',
  `price_previous` varchar(190) NOT NULL DEFAULT '0',
  `minimum` int(11) NOT NULL DEFAULT 10,
  `maximum` int(11) NOT NULL DEFAULT 1000,
  `stock` int(11) NOT NULL DEFAULT 100,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `newbie` tinyint(1) NOT NULL DEFAULT 0,
  `hd` tinyint(1) NOT NULL DEFAULT 0,
  `lq` tinyint(1) NOT NULL DEFAULT 0,
  `st` tinyint(1) NOT NULL DEFAULT 0,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `launch_year` int(4) DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 99,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 999,
  `today_hits` int(11) NOT NULL DEFAULT 99,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `lifetime_hits` int(11) NOT NULL DEFAULT 999,
  `today_carts` int(11) NOT NULL DEFAULT 0,
  `last_cart_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `lifetime_carts` int(11) NOT NULL DEFAULT 0,
  `votes` int(11) NOT NULL DEFAULT 99,
  `ratings` int(11) NOT NULL DEFAULT 5,
  `scores` varchar(190) NOT NULL DEFAULT '495',
  `likes` int(11) NOT NULL DEFAULT 99,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`item_id`, `sort_order`, `slug`, `title`, `name`, `description`, `spotlight`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `model`, `sku`, `mpn`, `gtin`, `price`, `price_previous`, `minimum`, `maximum`, `stock`, `featured`, `newbie`, `hd`, `lq`, `st`, `searchable`, `listed`, `removable`, `launch_year`, `published_time`, `last_view_time`, `today_views`, `statistics_update`, `lifetime_views`, `today_hits`, `last_hit_time`, `lifetime_hits`, `today_carts`, `last_cart_time`, `lifetime_carts`, `votes`, `ratings`, `scores`, `likes`, `token`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(1, 1, 'mens-black-harrington-classic-leather-jacket-los-angeles', 'Men’s Black Harrington Classic Leather Jacket', 'Men’s Black Harrington Leather Jacket', '<p>The Men&rsquo;s Black Harrington Classic Leather Jacket is crafted for men who appreciate timeless fashion with modern functionality. Made from 100% real lambskin leather, it delivers a luxurious feel and long-lasting durability. The soft polyester lining ensures comfort, while the classic Harrington shirt-style collar elevates the design.</p>\r\n<p>Functional details include a secure zipper closure, two outside pockets, two inside pockets, and an extra dedicated phone pocket. Adjustable waist and cuffs provide a tailored fit, making this jacket versatile for casual outings, professional settings, or evening wear.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS ensures every piece meets international standards of quality and craftsmanship. This jacket is not only a fashion statement but also a symbol of reliability and worldwide trust &mdash; proudly styled for Los Angeles.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Shirt Collar (Harrington style)</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zipper Closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> 2 Outside, 2 Inside, plus 1 extra phone pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Fit:</strong> Adjustable waist &amp; cuffs</p>\r\n</li>\r\n</ul>', '<p>Designed to offer both sophistication and casual appeal, the Men&rsquo;s Black Harrington Classic Leather Jacket is a timeless wardrobe essential. The Harrington collar adds refined elegance, while premium lambskin leather ensures luxury and durability. With versatile styling and all-season wearability, this jacket blends fashion with practicality &mdash; proudly manufactured and supplied worldwide by SHONiR CMS, now available in Los Angeles.</p>\r\n<div>&nbsp;</div>', 'Men’s Black Harrington Leather Jacket – Premium Style in Los Angeles', 'Shop the Men’s Black Harrington Classic Leather Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with a Harrington collar, zipper closure, and functional pockets. A versatile all-season staple — available now in Los Angeles.', 'men’s leather jacket, black leather jacket men, Harrington leather jacket, lambskin leather jacket men, stylish men’s outerwear, premium leather fashion, casual leather jacket men, luxury men’s jacket, versatile men’s jacket, timeless men’s fashion, tailored fit leather jacket, durable leather jacket men, men’s black leather jacket Los Angeles, Harrington leather jacket men Los Angeles, premium lambskin leather jacket Los Angeles, classic Harrington collar jacket Los Angeles, stylish men’s outerwear Los Angeles edition, durable leather jacket men Los Angeles, all-season men’s leather jacket Los Angeles, tailored fit leather jacket Los Angeles, men’s leather jacket with phone pocket Los Angeles, versatile men’s leather fashion Los Angeles, luxury men’s black leather jacket Los Angeles, timeless Harrington leather jacket Los Angeles', 1, 'SC-101', 'XN-4268-YQ', 'RK-762246', '3109800963830', '55.03', '131.5', 10, 1000, 100, 1, 1, 0, 0, 0, 1, 1, 1, 2026, 1769581305, 1773077819, 89, 1772590643, 1001, 1, 1772590643, 1001, 1, 573091200, 0, 99, 5, '495', 99, '4LvkfJ5EF5GM50dU', 1772260741, 1, '59.103.124.231', 573091200, 0, NULL),
(2, 2, 'mens-black-distressed-washed-leather-trucker-jacket-houston', 'Men’s Black Distressed Washed Real Leather Trucker Jacket', 'Men’s Black Distressed Leather Trucker Jacket', '<p>he Men&rsquo;s Black Distressed Washed Real Leather Trucker Jacket is a versatile outerwear piece that blends timeless design with rugged sophistication. Made from 100% real lambskin leather, it offers durability, comfort, and a stylish distressed finish with a washed shade for a unique look.</p>\r\n<p>The shirt-style collar and button-up front closure provide classic trucker aesthetics, while the soft polyester lining ensures all-day wearability. Functional details include two front flap button pockets, two side pockets, and two inside pockets &mdash; including a dedicated phone pocket for convenience. Buttoned cuffs and structured paneling add to its tailored fit, making it ideal for transitional weather and all-season use.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft skin-friendly polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Distressed Black (washed shade)</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Shirt-style collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Button-up front closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two front flap button pockets, two side pockets</p>\r\n</li>\r\n<li>\r\n<p><strong>Inside:</strong> Two inside pockets, including one phone pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Buttoned cuffs</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Classic trucker style</p>\r\n</li>\r\n<li>\r\n<p><strong>Season:</strong> Suitable for all seasons</p>\r\n</li>\r\n</ul>', '<p>Add a smart layer with the Men&rsquo;s Black Distressed Washed Real Leather Trucker Jacket, featuring classic paneling and dual-flap pockets. Designed with utility and sleekness in mind, this jacket is perfect for everyday style. Crafted from premium lambskin leather, it combines rugged appeal with modern comfort. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Houston.</p>\r\n<div>&nbsp;</div>', 'Men’s Black Distressed Leather Trucker Jacket – Premium Style', 'Shop the Men’s Black Distressed Washed Real Leather Trucker Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with classic trucker styling, button closure, and functional pockets. Rugged yet versatile.', 'men’s leather jacket, black leather jacket men, distressed leather jacket, trucker leather jacket men, lambskin leather jacket men, stylish men’s outerwear, premium leather fashion, casual leather jacket men, luxury men’s jacket, versatile men’s jacket, timeless men’s fashion, durable leather jacket men, men’s distressed leather jacket Houston, trucker leather jacket men Houston, premium lambskin leather jacket Houston, classic trucker style leather jacket Houston, stylish men’s outerwear Houston edition, durable leather jacket men Houston, all-season men’s leather jacket Houston, tailored fit leather jacket Houston, men’s leather jacket with phone pocket Houston, versatile men’s leather fashion Houston, luxury men’s black leather jacket Houston, timeless trucker leather jacket Houston', 1, 'SC-102', 'DB-0769-VX', 'UC-637454', '3771886293591', '49.79', '144.13', 10, 1000, 100, 1, 1, 0, 0, 0, 1, 1, 1, 2026, 1769582392, 1773077707, 60, 1772806799, 1011, 1, 1772806799, 1011, 1, 573091200, 0, 100, 5, '499', 99, '4RagWSvPA8P7pKeL', 1772261049, 1, '59.103.124.231', 1772261356, 1, '59.103.124.231'),
(3, 3, 'men-off-white-real-leather-harrington-jacket-boston', 'Men Off White Real Leather Harrington Jacket', 'Men’s Off White Harrington Leather Jacket', '<p>The Men&rsquo;s Off White Real Leather Harrington Jacket is a versatile outerwear piece designed for men who value timeless fashion and durability. Made from 100% real lambskin leather, it delivers a luxurious feel and long-lasting wear. The soft polyester lining ensures comfort, while the Harrington shirt-style collar elevates the design with a touch of sophistication.</p>\r\n<p>Functional details include a secure zipper closure, two outside pockets, two inside pockets, and an extra dedicated phone pocket for convenience. Its off-white color adds a unique, stylish edge, making it suitable for both casual and formal occasions.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and international delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of quality, reliability, and worldwide trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Off White</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Shirt Style Harrington Collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zipper Closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> 2 Outside, 2 Inside, plus 1 extra phone pocket</p>\r\n</li>\r\n</ul>', '<p>Timeless style meets modern sophistication with the Men&rsquo;s Off White Harrington Leather Jacket. Expertly crafted from premium lambskin leather, this jacket blends elegance with endurance. The distinguished Harrington collar adds refined charm, setting it apart from contemporary designs. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Boston.</p>\r\n<div>&nbsp;</div>', 'Men’s Off White Harrington Leather Jacket – Premium Style', 'Shop the Men’s Off White Harrington Leather Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with a Harrington collar, zipper closure, and functional pockets. Timeless elegance and durability.', 'men’s leather jacket, off white leather jacket men, Harrington leather jacket, lambskin leather jacket men, stylish men’s outerwear, premium leather fashion, casual leather jacket men, luxury men’s jacket, versatile men’s jacket, timeless men’s fashion, tailored fit leather jacket, durable leather jacket men, men’s off white leather jacket Boston, Harrington leather jacket men Boston, premium lambskin leather jacket Boston, classic Harrington collar jacket Boston, stylish men’s outerwear Boston edition, durable leather jacket men Boston, all-season men’s leather jacket Boston, tailored fit leather jacket Boston, men’s leather jacket with phone pocket Boston, versatile men’s leather fashion Boston, luxury men’s off white leather jacket Boston, timeless Harrington leather jacket Boston', 1, 'SC-103', 'PG-8425-PL', 'PU-481538', '1755617355017', '84.34', '145.33', 10, 1000, 100, 1, 1, 0, 0, 0, 1, 1, 1, 2026, 1769582704, 1773077819, 78, 1772591375, 1001, 1, 1772591375, 1001, 1, 1772493227, 1, 99, 5, '495', 99, 'V16dtP0QeQUtdQsN', 1772261189, 1, '59.103.124.231', 573091200, 0, NULL),
(4, 4, 'black-bomber-mens-leather-jacket-removable-hood-dallas', 'Black Bomber Men’s Leather Jacket — with Removable Hood', 'Men’s Black Bomber Leather Jacket with Hood', '<p>The Black Bomber Men&rsquo;s Leather Jacket with Removable Hood is designed for men who value versatility, comfort, and timeless style. Made from 100% real lambskin leather, it offers a soft, luxurious feel while ensuring durability. The detachable hood, crafted with soft polyester lining, adds a casual layered look and can be easily removed for a sleeker appearance.</p>\r\n<p>Functional details include a smooth YKK zipper closure with drawstrings, three exterior pockets, two internal pockets, and an extra dedicated phone pocket. Rib-knit cuffs and hem provide a snug fit, while the belted collar adds a refined touch. The black leather exterior paired with a grey hood makes this jacket a perfect choice for both casual outings and smart layering.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Inner Hood:</strong> Detachable hood with soft polyester lining</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Smooth YKK zipper with drawstrings</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Belted collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Three exterior pockets, two internal pockets, plus one extra phone pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black exterior with grey hood</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Bomber style with removable hood</p>\r\n</li>\r\n<li>\r\n<p><strong>Fit:</strong> Rib-knit cuffs and hem for snug fit</p>\r\n</li>\r\n</ul>', '<p>The Black Bomber Men&rsquo;s Leather Jacket with Removable Hood is your one go-to outerwear that requires no extra effort. Crafted from 100% real lambskin leather, it features a detachable dark grey hood, rib-knit cuffs, multiple pockets, and a belted collar for a stylish yet functional look. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Dallas.</p>\r\n<div>&nbsp;</div>', 'Black Bomber Men’s Leather Jacket with Hood – Premium Style', 'Shop the Black Bomber Men’s Leather Jacket with Removable Hood by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with detachable hood, rib-knit cuffs, and multiple pockets. Stylish, versatile, and durable.', 'men’s leather jacket, black bomber leather jacket men, bomber jacket with hood, lambskin leather jacket men, stylish men’s outerwear, premium leather fashion, casual leather jacket men, luxury men’s jacket, versatile men’s jacket, timeless men’s fashion, tailored fit leather jacket, durable leather jacket men, men’s bomber leather jacket Dallas, bomber jacket with removable hood Dallas, premium lambskin bomber jacket Dallas, classic bomber style leather jacket Dallas, stylish men’s outerwear Dallas edition, durable bomber leather jacket men Dallas, all-season bomber leather jacket Dallas, tailored fit bomber leather jacket Dallas, men’s bomber jacket with phone pocket Dallas, versatile men’s bomber leather fashion Dallas, luxury men’s black bomber jacket Dallas, timeless bomber leather jacket Dallas', 1, 'SC-104', 'CQ-2412-SC', 'YW-882022', '5948986039525', '12.79', '37.82', 10, 1000, 100, 1, 1, 0, 0, 0, 1, 1, 1, 2026, 1769582809, 1773077707, 71, 1772618913, 1004, 1, 1772618913, 1004, 2, 1772618969, 5, 99, 5, '495', 99, '9HrKUDnXmLUxJ0KS', 1772261439, 1, '59.103.124.231', 573091200, 0, NULL),
(5, 5, 'dodge-mens-cafe-racer-blue-leather-jacket-san-francisco', 'Dodge Men’s Cafe Racer Blue Leather Jacket', 'Men’s Cafe Racer Blue Leather Jacket', '<p>The Dodge Men&rsquo;s Cafe Racer Blue Leather Jacket is a striking outerwear piece designed for men who want to stand out. Crafted from 100% real lambskin leather, it offers durability, comfort, and a unique sky blue distressed finish that adds colorful vibes to any wardrobe.</p>\r\n<p>The jacket features a press stud collar, front zipper closure, and zippered cuffs for a sleek racer-inspired look. Functional details include four outer pockets, two inside pockets, and an extra dedicated phone pocket. Fully lined with soft polyester fabric, it ensures all-day wearability.</p>\r\n<p>This is a fashion jacket designed for style and comfort &mdash; it does not include CE armor or protective padding. As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and international delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of bold individuality and worldwide trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Internal full polyester fabric</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Sky Blue (distressed finish)</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Press stud collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Front zipper closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Zippered cuffs</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Four outer pockets, two inside pockets, plus one extra phone pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Cafe Racer style</p>\r\n</li>\r\n<li>\r\n<p><strong>Protection:</strong> Fashion jacket (no CE armor or padding)</p>\r\n</li>\r\n</ul>', '<p>Style vibrant with the Dodge Men&rsquo;s Cafe Racer Blue Leather Jacket, crafted in a stunning sky blue finish. Made from 100% real lambskin leather, it features a press stud collar, zip fastener, and distressed detailing for a bold upgrade to traditional black and brown styles. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in San Francisco.</p>\r\n<div>&nbsp;</div>', 'Dodge Men’s Cafe Racer Blue Leather Jacket – Premium Style', 'Shop the Dodge Men’s Cafe Racer Blue Leather Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with racer styling, press stud collar, and distressed sky blue finish. Bold, stylish, and durable.', 'men’s leather jacket, blue leather jacket men, cafe racer leather jacket, lambskin leather jacket men, stylish men’s outerwear, premium leather fashion, casual leather jacket men, luxury men’s jacket, versatile men’s jacket, timeless men’s fashion, tailored fit leather jacket, durable leather jacket men, men’s cafe racer leather jacket San Francisco, blue leather jacket men San Francisco, premium lambskin leather jacket San Francisco, distressed sky blue leather jacket San Francisco, stylish men’s outerwear San Francisco edition, durable leather jacket men San Francisco, all-season men’s leather jacket San Francisco, tailored fit leather jacket San Francisco, men’s leather jacket with phone pocket San Francisco, versatile men’s leather fashion San Francisco, luxury men’s blue leather jacket San Francisco, timeless cafe racer leather jacket San Francisco', 1, 'SC-105', 'WZ-8195-JA', 'EC-919343', '0092183278936', '44.55', '50.04', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769588306, 1773077819, 76, 1772606772, 1003, 2, 1772606772, 1003, 1, 1772578381, 2, 99, 5, '495', 99, 'GXRygmm8NCNMvQ4e', 1772266951, 1, '2400:adc7:193c:5200:a86e:e76e:1613:6f2b', 1772272510, 1, '59.103.124.231'),
(6, 6, 'negan-mens-black-leather-biker-style-jacket-seattle', 'Negan Men’s Black Leather Biker Style Jacket', 'Men’s Black Biker Leather Jacket', '<p>The Negan Men&rsquo;s Black Leather Biker Style Jacket is designed for men who want to stand out with confidence. Crafted from 100% real lambskin leather, it offers durability, comfort, and a sleek black finish that complements any outfit.</p>\r\n<p>The asymmetrical front zipper adds a rebellious flair, while the belt adjustment at the waist ensures a tailored fit. Functional details include four outer pockets, two inside pockets, and an extra dedicated phone pocket. Zippered cuffs enhance the biker-inspired look, while the soft polyester lining provides all-day comfort.</p>\r\n<p>This is a fashion jacket designed for style and everyday wear &mdash; it does not include CE armor or protective padding. As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a symbol of bold individuality and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Biker-inspired fashion jacket for daily wear</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft polyester lining</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Sleek black</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Asymmetrical front zipper</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Wide lapel with snap buttons</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Four outer pockets, two inside pockets, plus one extra phone pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Zippered cuffs</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Belt adjustment at waist</p>\r\n</li>\r\n<li>\r\n<p><strong>Protection:</strong> Fashion jacket (no CE armor or padding)</p>\r\n</li>\r\n</ul>', '<p>The Negan Men&rsquo;s Black Leather Biker Style Jacket is a fusion of edgy design and impeccable craftsmanship. Made from 100% real lambskin leather, it delivers bold style with a rebellious edge. Featuring an asymmetrical front zipper, belt adjustment, and zippered cuffs, this jacket is the ultimate statement piece. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Seattle.</p>\r\n<div>&nbsp;</div>', 'Negan Men’s Black Leather Biker Jacket – Premium Style', 'Shop the Negan Men’s Black Leather Biker Style Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with asymmetrical zipper, belt adjustment, and biker-inspired design. Bold, stylish, and durable.', 'men’s leather jacket, black leather jacket men, biker leather jacket, lambskin leather jacket men, stylish men’s outerwear, premium leather fashion, casual leather jacket men, luxury men’s jacket, versatile men’s jacket, timeless men’s fashion, tailored fit leather jacket, durable leather jacket men, men’s biker leather jacket Seattle, asymmetrical zipper leather jacket Seattle, premium lambskin biker jacket Seattle, classic biker style leather jacket Seattle, stylish men’s outerwear Seattle edition, durable biker leather jacket men Seattle, all-season biker leather jacket Seattle, tailored fit biker leather jacket Seattle, men’s biker jacket with phone pocket Seattle, versatile men’s biker fashion Seattle, luxury men’s black biker jacket Seattle, timeless biker leather jacket Seattle', 1, 'SC-106', 'CQ-4496-BU', 'DJ-821340', '3360209140895', '30.85', '59.79', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769588571, 1773077707, 75, 1772607009, 1001, 2, 1772659142, 1001, 1, 1772607009, 2, 99, 5, '495', 99, 'hSHW5N1VJTUihW5w', 1772267146, 1, '2400:adc7:193c:5200:a86e:e76e:1613:6f2b', 1772272586, 1, '59.103.124.231'),
(7, 7, 'mens-black-lambskin-leather-cafe-racer-jacket-philadelphia', 'Men’s Black Lambskin Leather Cafe Racer Jacket', 'Men’s Black Cafe Racer Leather Jacket', '<p>The Men&rsquo;s Black Lambskin Leather Cafe Racer Jacket is a versatile outerwear piece designed for men who value sophistication with an edge. Crafted from 100% real lambskin leather, it offers a luxurious feel that only gets better with time. The soft polyester lining ensures comfort, while the erect collar and smooth YKK zipper closure add to its sleek racer-inspired design.</p>\r\n<p>Decorative shoulder padding provides understated style, while functional details include four zippered exterior pockets, two inside pockets, and an extra mobile pocket for convenience. Zippered cuffs enhance the tailored fit, making this jacket suitable for casual outings, professional wear, or evening style.</p>\r\n<p>This is a fashion jacket designed for everyday wear &mdash; it does not include CE armor or protective padding. As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Biker-inspired fashion jacket for daily wear</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft, fully lined polyester fabric</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar Style:</strong> Erect collar with smooth YKK zipper closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Decorative shoulder padding for added style</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Four zippered exterior pockets, two inside pockets, plus one extra mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Zippered cuffs</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> Perfect for all seasons</p>\r\n</li>\r\n<li>\r\n<p><strong>Protection:</strong> Fashion jacket (no CE armor or padding)</p>\r\n</li>\r\n</ul>\r\n<div>&nbsp;</div>', '<p>The Men&rsquo;s Black Lambskin Leather Cafe Racer Jacket is crafted for timeless style and modern functionality. Made from buttery-soft lambskin leather, it features decorative shoulder padding, zippered cuffs, and an erect collar for classic racer appeal. With multiple pockets, including a dedicated mobile pocket, this jacket blends sleekness with practicality. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Philadelphia.</p>\r\n<div>&nbsp;</div>', 'Men’s Black Lambskin Cafe Racer Jacket – Premium Style', 'Shop the Men’s Black Lambskin Leather Cafe Racer Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with racer styling, erect collar, and decorative shoulder padding. Sleek, stylish, and durable.', 'men’s leather jacket, black leather jacket men, cafe racer leather jacket, lambskin leather jacket men, stylish men’s outerwear, premium leather fashion, casual leather jacket men, luxury men’s jacket, versatile men’s jacket, timeless men’s fashion, tailored fit leather jacket, durable leather jacket men, men’s cafe racer leather jacket Philadelphia, black lambskin leather jacket Philadelphia, premium lambskin cafe racer jacket Philadelphia, decorative shoulder padding leather jacket Philadelphia, stylish men’s outerwear Philadelphia edition, durable leather jacket men Philadelphia, all-season men’s leather jacket Philadelphia, tailored fit cafe racer leather jacket Philadelphia, men’s leather jacket with phone pocket Philadelphia, versatile men’s leather fashion Philadelphia, luxury men’s black cafe racer jacket Philadelphia, timeless cafe racer leather jacket Philadelphia', 1, 'SC-107', 'CN-4240-JQ', 'ZC-993375', '5745359400688', '06.72', '72.99', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769592877, 1773077707, 1, 1773077707, 1004, 1, 1773077707, 1004, 1, 1772968923, 2, 99, 5, '495', 99, 'qinctA5NL6iApxhE', 1772271412, 1, '154.80.39.210', 1772272426, 1, '59.103.124.231'),
(8, 8, 'mens-camel-brown-trucker-leather-jacket-atlanta', 'Men’s Camel Brown Trucker Leather Jacket', 'Men’s Camel Brown Leather Trucker Jacket', '<p>The Men&rsquo;s Camel Brown Trucker Leather Jacket is designed for men who appreciate classic style with modern functionality. Made from premium lambskin leather, it offers durability, comfort, and a rich camel brown finish that stands out in any wardrobe.</p>\r\n<p>The jacket features a button-up front closure, shirt-style collar, and buttoned cuffs for a structured look. Inside, a soft polyester lining with quilted foam ensures warmth and comfort. Functional details include two flap chest pockets with buttons, two side pockets, and two inside pockets &mdash; including a dedicated mobile pocket for convenience.</p>\r\n<p>Sporty, simple, and suitable for all weather, this jacket is a versatile staple for casual outings, professional wear, or evening style. As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft polyester with quilted foam</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Camel Brown</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Shirt-style collar with fastening buttons</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Button-up front closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Buttoned cuffs</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two flap chest pockets with buttons, two side pockets, two inside pockets, plus one extra mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Classic trucker style</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All-weather</p>\r\n</li>\r\n</ul>', '<p>The Men&rsquo;s Camel Brown Trucker Leather Jacket is a timeless outerwear piece that blends rugged charm with everyday versatility. Crafted from 100% real lambskin leather, it features a classic button-up front, shirt-style collar, and multiple functional pockets. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Atlanta.</p>\r\n<div>&nbsp;</div>', 'Men’s Camel Brown Trucker Leather Jacket – Premium Style', 'Shop the Men’s Camel Brown Trucker Leather Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with button-up closure, shirt-style collar, and multiple pockets. Rugged, stylish, and versatile.', 'men’s leather jacket, brown leather jacket men, trucker leather jacket men, lambskin leather jacket men, stylish men’s outerwear, premium leather fashion, casual leather jacket men, luxury men’s jacket, versatile men’s jacket, timeless men’s fashion, tailored fit leather jacket, durable leather jacket men, men’s camel brown leather jacket Atlanta, trucker leather jacket men Atlanta, premium lambskin leather jacket Atlanta, classic trucker style leather jacket Atlanta, stylish men’s outerwear Atlanta edition, durable leather jacket men Atlanta, all-season men’s leather jacket Atlanta, tailored fit leather jacket Atlanta, men’s leather jacket with phone pocket Atlanta, versatile men’s leather fashion Atlanta, luxury men’s brown leather jacket Atlanta, timeless trucker leather jacket Atlanta', 1, 'SC-108', 'WF-8415-DU', 'JV-034738', '4183957597291', '11.27', '79.13', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1772271488, 1773077819, 78, 1772607002, 1004, 2, 1772618893, 1004, 2, 1772659136, 3, 99, 5, '495', 99, '52imFJR5rJ2ZCwMR', 1772271682, 1, '154.80.39.210', 573091200, 0, NULL),
(9, 9, 'womens-black-real-leather-jacket-removable-hood-chicago', 'Women’s Black Real Leather Jacket With Removable Hood', 'Women’s Black Leather Jacket With Hood', '<p>The Women&rsquo;s Black Real Leather Jacket With Removable Hood is designed for women who want versatility and sophistication in their outerwear. Made from premium lambskin leather, it offers a buttery-soft feel and long-lasting durability. The removable hood adds casual comfort, while the belted collar elevates the design with a touch of elegance.</p>\r\n<p>Functional details include a smooth front zipper closure, adjustable buttoned waist, and zippered cuffs for a tailored fit. Two side zippered pockets and an inside mobile pocket provide practical storage for essentials. Fully lined with soft polyester, this jacket ensures all-day wearability across all seasons.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Belted open collar with removable hood</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Front zippered closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Waist:</strong> Adjustable buttoned waist</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Zippered cuffs</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two side zippered pockets, one inside mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All-season</p>\r\n</li>\r\n</ul>', '<p>The Women&rsquo;s Black Real Leather Jacket With Removable Hood is the perfect blend of warmth, comfort, and timeless style. Crafted from 100% real lambskin leather, it features a detachable hood, belted collar, and sleek zippered closure. Functional yet fashionable, this jacket is proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Chicago.</p>\r\n<div>&nbsp;</div>', 'Women’s Black Leather Jacket With Hood – Premium Style', 'Shop the Women’s Black Real Leather Jacket With Removable Hood by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with detachable hood, belted collar, and functional pockets. Stylish, versatile, and durable.', 'women’s leather jacket, black leather jacket women, hooded leather jacket women, lambskin leather jacket women, stylish women’s outerwear, premium leather fashion, casual leather jacket women, luxury women’s jacket, versatile women’s jacket, timeless women’s fashion, tailored fit leather jacket, durable leather jacket women, women’s hooded leather jacket Chicago, black lambskin leather jacket Chicago, premium lambskin hooded jacket Chicago, detachable hood leather jacket Chicago, stylish women’s outerwear Chicago edition, durable leather jacket women Chicago, all-season women’s leather jacket Chicago, tailored fit hooded leather jacket Chicago, women’s leather jacket with phone pocket Chicago, versatile women’s leather fashion Chicago, luxury women’s black leather jacket Chicago, timeless hooded leather jacket Chicago', 1, 'SC-201', 'BL-9878-XN', 'GM-390763', '6252330552213', '83.76', '183.35', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769594768, 1773077707, 56, 1772806861, 1000, 1, 1772806861, 1000, 1, 1772538767, 2, 99, 5, '495', 99, 'hHRKaqDFHy7hXL34', 1772273549, 1, '59.103.124.231', 573091200, 0, NULL),
(10, 10, 'fernando-womens-cognac-brown-trucker-leather-jacket-denver', 'Fernando Women’s Cognac Brown Trucker Leather Jacket', 'Women’s Cognac Brown Leather Trucker Jacket', '<p>The Fernando Women&rsquo;s Cognac Brown Trucker Leather Jacket is designed for women who appreciate refined style with everyday practicality. Made from premium lambskin leather, it offers a luxurious feel and long-lasting wear. The warm cognac brown finish adds richness and versatility, making it a standout addition to any wardrobe.</p>\r\n<p>This jacket features a buttoned front closure, shirt-style collar, and buttoned cuffs for a structured look. Functional details include four exterior pockets and one inside pocket, perfect for carrying essentials. A soft polyester lining ensures comfort, making it suitable for all-day wear across seasons.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of elegance, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Cognac Brown</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Trucker</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Buttoned front closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Standard shirt-style collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Buttoned cuffs</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Four exterior pockets, one inside pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft polyester lining for comfort</p>\r\n</li>\r\n</ul>', '<p>Discover timeless elegance with the Fernando Women&rsquo;s Cognac Brown Trucker Leather Jacket. Crafted from 100% real lambskin leather, it features a rich cognac hue, classic trucker styling, and impeccable craftsmanship. A versatile piece that blends sophistication with durability &mdash; proudly manufactured, exported, and supplied worldwide by SHONiR CMS, now available in Denver.</p>\r\n<div>&nbsp;</div>', 'Fernando Women’s Cognac Brown Trucker Jacket – Premium Style', 'Shop the Fernando Women’s Cognac Brown Trucker Leather Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with buttoned closure, shirt-style collar, and rich cognac finish. Elegant, versatile, and durable.', 'women’s leather jacket, brown leather jacket women, trucker leather jacket women, lambskin leather jacket women, stylish women’s outerwear, premium leather fashion, casual leather jacket women, luxury women’s jacket, versatile women’s jacket, timeless women’s fashion, tailored fit leather jacket, durable leather jacket women, women’s cognac brown leather jacket Denver, trucker leather jacket women Denver, premium lambskin leather jacket Denver, classic trucker style leather jacket Denver, stylish women’s outerwear Denver edition, durable leather jacket women Denver, all-season women’s leather jacket Denver, tailored fit trucker leather jacket Denver, women’s leather jacket with inside pocket Denver, versatile women’s leather fashion Denver, luxury women’s brown leather jacket Denver, timeless trucker leather jacket Denver', 1, 'SC-202', 'XJ-9134-DJ', 'JH-473212', '8135233866252', '12.07', '77.73', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769595239, 1773077707, 37, 1772968635, 1004, 4, 1772968636, 1004, 1, 1772538734, 2, 99, 5, '495', 99, 'Dv78CR9cEpiMigxc', 1772273699, 1, '59.103.124.231', 573091200, 0, NULL),
(11, 11, 'bari-black-womens-real-leather-biker-jacket-detroit', 'Bari Black Women’s Real Leather Biker Jacket', 'Women’s Black Biker Leather Jacket', '<p>The Bari Black Women&rsquo;s Real Leather Biker Jacket is a versatile outerwear piece that blends bold fashion with timeless sophistication. Made from premium lambskin leather, it offers durability, comfort, and a sleek black finish that complements any wardrobe.</p>\r\n<p>The jacket features an asymmetrical zip-fastening, buckle waist adjuster, and zippered cuffs for a classic biker-inspired look. Slight padding on the shoulders and sleeves adds texture and style, while the soft polyester lining ensures all-day comfort. Functional details include three exterior pockets and an extra inside mobile pocket, making it practical as well as stylish.</p>\r\n<p>Suitable for all seasons, this jacket is a wardrobe essential for women who want to make a statement. As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a symbol of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Biker-inspired fashion jacket for daily wear</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft, skin-friendly polyester lining</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Asymmetrical zip-fastening with buckle waist adjuster</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Zippered cuffs</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Slight padding on shoulders and sleeves for added style</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Three exterior pockets, one inside mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All-season</p>\r\n</li>\r\n</ul>\r\n<div>&nbsp;</div>', '<p>You don&rsquo;t have to be a biker to own this &mdash; the Bari Black Women&rsquo;s Real Leather Biker Jacket is designed for everyday style with sleek, edgy detailing. Crafted from 100% real lambskin leather, it features padded shoulders and sleeves, silver hardware accents, and an asymmetrical zip closure with buckle waist adjuster. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Detroit.</p>\r\n<div>&nbsp;</div>', 'Bari Black Women’s Leather Biker Jacket – Premium Style', 'Shop the Bari Black Women’s Real Leather Biker Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with asymmetrical zipper, buckle waist adjuster, and padded shoulders. Sleek, stylish, and durable.', 'women’s leather jacket, black leather jacket women, biker leather jacket women, lambskin leather jacket women, stylish women’s outerwear, premium leather fashion, casual leather jacket women, luxury women’s jacket, versatile women’s jacket, timeless women’s fashion, tailored fit leather jacket, durable leather jacket women, women’s biker leather jacket Detroit, asymmetrical zipper leather jacket Detroit, premium lambskin biker jacket Detroit, classic biker style leather jacket Detroit, stylish women’s outerwear Detroit edition, durable biker leather jacket women Detroit, all-season biker leather jacket Detroit, tailored fit biker leather jacket Detroit, women’s biker jacket with phone pocket Detroit, versatile women’s biker fashion Detroit, luxury women’s black biker jacket Detroit, timeless biker leather jacket Detroit', 1, 'SC-203', 'UR-8403-GX', 'AF-134464', '2715921491956', '64.84', '70.21', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769595349, 1773077707, 36, 1772923451, 1000, 1, 1772806831, 1000, 1, 1772923451, 3, 99, 5, '495', 99, '4pv7JY9cKbBjNKSW', 1772273928, 1, '59.103.124.231', 573091200, 0, NULL),
(12, 12, 'womens-black-asymmetrical-real-leather-biker-jacket-orlando', 'Women’s Black Asymmetrical Real Leather Biker Jacket', 'Women’s Black Leather Biker Jacket', '<p>The Women&rsquo;s Black Asymmetrical Real Leather Biker Jacket is designed for women who want to combine timeless biker aesthetics with modern sophistication. Made from premium lambskin leather, it offers durability, comfort, and a sleek black finish that pairs effortlessly with any outfit.</p>\r\n<p>The jacket features an asymmetrical front zipper closure, zipped cuffs, and a tailored silhouette that enhances its edgy appeal. Functional details include three exterior pockets and one interior pocket, perfect for carrying essentials. A soft polyester lining ensures comfort, making this jacket suitable for all-day wear across seasons.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of individuality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Biker-inspired fashion jacket for daily wear</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft, skin-friendly polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Classic Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Asymmetrical biker style</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Front zip closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Three exterior pockets, one interior pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Zipped cuffs</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All-season</p>\r\n</li>\r\n</ul>', '<p>Unleash your inner rebel with the Women&rsquo;s Black Asymmetrical Real Leather Biker Jacket. Crafted from 100% lambskin leather, it features a bold asymmetrical design, sleek zip closure, and edgy detailing. A modern twist on iconic biker culture &mdash; proudly manufactured, exported, and supplied worldwide by SHONiR CMS, now available in Orlando.</p>\r\n<div>&nbsp;</div>', 'Women’s Black Asymmetrical Leather Biker Jacket – Premium Style', 'Shop the Women’s Black Asymmetrical Real Leather Biker Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with asymmetrical design, zip closure, and biker-inspired detailing. Bold, stylish, and durable.', 'women’s leather jacket, black leather jacket women, biker leather jacket women, asymmetrical leather jacket women, lambskin leather jacket women, stylish women’s outerwear, premium leather fashion, casual leather jacket women, luxury women’s jacket, versatile women’s jacket, timeless women’s fashion, tailored fit leather jacket, durable leather jacket women, women’s biker leather jacket Orlando, asymmetrical zipper leather jacket Orlando, premium lambskin biker jacket Orlando, classic biker style leather jacket Orlando, stylish women’s outerwear Orlando edition, durable biker leather jacket women Orlando, all-season biker leather jacket Orlando, tailored fit biker leather jacket Orlando, women’s biker jacket with interior pocket Orlando, versatile women’s biker fashion Orlando, luxury women’s black biker jacket Orlando, timeless asymmetrical biker leather jacket Orlando', 1, 'SC-205', 'YY-7038-HV', 'BT-531112', '3017467740814', '14.06', '38.82', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769595589, 1773077707, 76, 1772591380, 1001, 1, 1772591380, 1001, 1, 1772538727, 2, 99, 5, '495', 99, 'wfYmBpGdZFULBWBx', 1772274104, 1, '59.103.124.231', 1772274617, 1, '59.103.124.231');
INSERT INTO `tbl_items` (`item_id`, `sort_order`, `slug`, `title`, `name`, `description`, `spotlight`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `model`, `sku`, `mpn`, `gtin`, `price`, `price_previous`, `minimum`, `maximum`, `stock`, `featured`, `newbie`, `hd`, `lq`, `st`, `searchable`, `listed`, `removable`, `launch_year`, `published_time`, `last_view_time`, `today_views`, `statistics_update`, `lifetime_views`, `today_hits`, `last_hit_time`, `lifetime_hits`, `today_carts`, `last_cart_time`, `lifetime_carts`, `votes`, `ratings`, `scores`, `likes`, `token`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(13, 13, 'womens-cafe-racer-black-leather-jacket-charlotte', 'Women’s Cafe Racer Black Leather Jacket', 'Women’s Black Cafe Racer Leather Jacket', '<p>The Women&rsquo;s Cafe Racer Black Leather Jacket is designed for women who want versatility and sophistication in their outerwear. Made from premium lambskin leather, it offers a buttery-soft feel and long-lasting durability. The removable hood adds casual comfort, while the belted collar elevates the design with a touch of elegance.</p>\r\n<p>Functional details include a smooth front zipper closure, adjustable buttoned waist, and zippered cuffs for a tailored fit. Two side zippered pockets and an inside mobile pocket provide practical storage for essentials. Fully lined with soft polyester, this jacket ensures all-day wearability across all seasons.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Belted open collar with removable hood</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Front zippered closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Waist:</strong> Adjustable buttoned waist</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Zippered cuffs</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two side zippered pockets, one inside mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All-season</p>\r\n</li>\r\n</ul>\r\n<div>&nbsp;</div>', '<p>The Women&rsquo;s Cafe Racer Black Leather Jacket is the perfect combination of warmth, comfort, and timeless style. Crafted from 100% real lambskin leather, it features a removable hood, belted collar, and sleek zippered closure. Functional yet fashionable, this jacket is proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Charlotte.</p>\r\n<div>&nbsp;</div>', 'Women’s Cafe Racer Black Leather Jacket – Premium Style', 'Shop the Women’s Cafe Racer Black Leather Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with removable hood, belted collar, and functional pockets. Stylish, versatile, and durable.', 'women’s leather jacket, black leather jacket women, cafe racer leather jacket women, hooded leather jacket women, lambskin leather jacket women, stylish women’s outerwear, premium leather fashion, casual leather jacket women, luxury women’s jacket, versatile women’s jacket, timeless women’s fashion, tailored fit leather jacket, durable leather jacket women, women’s cafe racer leather jacket Charlotte, black lambskin leather jacket Charlotte, premium lambskin cafe racer jacket Charlotte, detachable hood leather jacket Charlotte, stylish women’s outerwear Charlotte edition, durable leather jacket women Charlotte, all-season women’s leather jacket Charlotte, tailored fit cafe racer leather jacket Charlotte, women’s leather jacket with phone pocket Charlotte, versatile women’s leather fashion Charlotte, luxury women’s black leather jacket Charlotte, timeless cafe racer leather jacket Charlotte', 1, 'SC-204', 'XG-1003-LZ', 'RN-564685', '6933982132904', '90.90', '133.12', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769595772, 1773077707, 5, 1773025018, 1001, 1, 1773025018, 1001, 1, 1772538724, 1, 99, 5, '495', 99, 'wLNBUPQ1b92rqBgn', 1772274392, 1, '59.103.124.231', 1772274645, 1, '59.103.124.231'),
(14, 14, 'womens-cafe-racer-tan-real-leather-jacket-austin', 'Women’s Cafe Racer Tan Real Leather Jacket', 'Women’s Tan Cafe Racer Leather Jacket', '<p>The Women&rsquo;s Cafe Racer Tan Real Leather Jacket is designed for women who want a versatile outerwear piece that combines durability with elegance. Made from premium lambskin leather, it offers a buttery-soft feel and long-lasting wear. The rich tan color adds warmth and timeless appeal, making it a standout addition to any wardrobe.</p>\r\n<p>Functional details include a snap strap collar, front zipper closure, and quilted pattern on the shoulders and back for added style. Four exterior zippered pockets and an inside mobile pocket provide practical storage. Snap adjustments on the waist and cuffs ensure a tailored fit, while the soft polyester lining guarantees comfort across all seasons.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of individuality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Biker-inspired fashion jacket for daily wear</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft polyester lining</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Tan</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Snap strap collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Front zipper closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Quilted pattern on shoulders &amp; back</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Four exterior zippered pockets, one inside mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Adjustments:</strong> Snap adjustment on waist &amp; cuffs</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All-season</p>\r\n</li>\r\n</ul>\r\n<div>&nbsp;</div>', '<p>The Women&rsquo;s Cafe Racer Tan Real Leather Jacket blends timeless biker-inspired style with modern sophistication. Crafted from 100% lambskin leather, it features quilted shoulder and back detailing, a snap strap collar, and sleek zippered closure. Functional yet fashionable, this jacket is proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Austin.</p>\r\n<div>&nbsp;</div>', 'Women’s Tan Cafe Racer Leather Jacket – Premium Style', 'Shop the Women’s Cafe Racer Tan Real Leather Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with quilted detailing, snap strap collar, and rich tan finish. Stylish, versatile, and durable.', 'women’s leather jacket, tan leather jacket women, cafe racer leather jacket women, lambskin leather jacket women, stylish women’s outerwear, premium leather fashion, casual leather jacket women, luxury women’s jacket, versatile women’s jacket, timeless women’s fashion, tailored fit leather jacket, durable leather jacket women, women’s cafe racer leather jacket Austin, tan lambskin leather jacket Austin, premium lambskin cafe racer jacket Austin, quilted shoulder leather jacket Austin, stylish women’s outerwear Austin edition, durable leather jacket women Austin, all-season women’s leather jacket Austin, tailored fit cafe racer leather jacket Austin, women’s leather jacket with phone pocket Austin, versatile women’s leather fashion Austin, luxury women’s tan leather jacket Austin, timeless cafe racer leather jacket Austin', 1, 'SC-206', 'XV-9218-ZH', 'RY-968763', '7696541375535', '52.25', '124.79', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769596108, 1773077707, 62, 1772806787, 1001, 1, 1772806787, 1001, 1, 1772578381, 2, 99, 5, '495', 99, 'aBXq3CrMMeHiZNhR', 1772274666, 1, '59.103.124.231', 573091200, 0, NULL),
(15, 15, 'tavares-womens-wax-blue-leather-biker-jacket-portland', 'Tavares Women’s Wax Blue Leather Biker Jacket', 'Women’s Wax Blue Leather Biker Jacket', '<p>The Tavares Women&rsquo;s Wax Blue Leather Biker Jacket is designed for women who want to make a statement with their outerwear. Made from premium lambskin leather, it offers durability, comfort, and a unique wax blue distressed finish that adds character and individuality.</p>\r\n<p>This jacket features a classic biker silhouette with a zippered front closure, YKK zip collar, and tailored fit. Functional details include four exterior pockets (including a button-flap chest patch) and one inside mobile pocket for convenience. A soft polyester lining ensures comfort, making it suitable for all-day wear across seasons.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of bold individuality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Biker-inspired fashion jacket for daily wear</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Wax Blue (distressed finish)</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zippered front closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> YKK zip-closure collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Classic biker with vintage edge</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Four exterior pockets (including button-flap chest patch), one inside mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft polyester lining for comfort</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All-season</p>\r\n</li>\r\n</ul>', '<p>The Tavares Women&rsquo;s Wax Blue Leather Biker Jacket blends bold style with vintage edge. Crafted from 100% real lambskin leather, it features a wax blue finish, sleek zip closure, and tailored fit for standout appeal. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Portland.</p>\r\n<div>&nbsp;</div>', 'Tavares Women’s Wax Blue Leather Biker Jacket – Premium Style', 'Shop the Tavares Women’s Wax Blue Leather Biker Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with wax blue finish, biker silhouette, and functional pockets. Bold, stylish, and durable.', 'women’s leather jacket, blue leather jacket women, biker leather jacket women, wax finish leather jacket women, lambskin leather jacket women, stylish women’s outerwear, premium leather fashion, casual leather jacket women, luxury women’s jacket, versatile women’s jacket, timeless women’s fashion, tailored fit leather jacket, durable leather jacket women, women’s biker leather jacket Portland, wax blue leather jacket Portland, premium lambskin biker jacket Portland, distressed finish leather jacket Portland, stylish women’s outerwear Portland edition, durable biker leather jacket women Portland, all-season biker leather jacket Portland, tailored fit biker leather jacket Portland, women’s biker jacket with phone pocket Portland, versatile women’s biker fashion Portland, luxury women’s wax blue leather jacket Portland, timeless biker leather jacket Portland', 1, 'SC-207', 'SR-6952-PQ', 'NP-575544', '1689269467019', '02.89', '23', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1772274717, 1773077707, 5, 1773028543, 1001, 1, 1772604052, 1001, 1, 1773028543, 1, 99, 5, '495', 99, 'fgN5veNgWvbdNJYC', 1772274905, 1, '59.103.124.231', 573091200, 0, NULL),
(16, 16, 'womens-black-cafe-racer-leather-jacket-san-diego', 'Women’s Black Cafe Racer Leather Jacket', 'Women’s Black Cafe Racer Leather Jacket', '<p>The Women&rsquo;s Black Cafe Racer Leather Jacket is designed for women who want to combine edgy biker aesthetics with everyday sophistication. Made from premium lambskin leather, it offers durability, comfort, and a sleek black finish that pairs effortlessly with any outfit.</p>\r\n<p>Functional details include a zip-up front closure, padded shoulders for added style, and ribbed elbow panels for extended comfort. Four front zippered pockets and an inside mobile pocket provide practical storage. A soft polyester lining ensures all-day wearability, making this jacket suitable for all seasons.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of individuality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Biker-inspired fashion jacket for daily wear</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining:</strong> Soft polyester lining</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zip-up front closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Stand-up collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Padded shoulders for racer edge</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Four front zippered pockets, one inside mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Zippered cuffs</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All-season</p>\r\n</li>\r\n</ul>', '<p>Unveiling the perfect blend of style and functionality: the Women&rsquo;s Black Cafe Racer Leather Jacket. Crafted from real lambskin leather, it features padded shoulders, zippered cuffs, and a sleek stand-up collar for that chic racer edge. A timeless silhouette that never goes out of style &mdash; proudly manufactured, exported, and supplied worldwide by SHONiR CMS, now available in San Diego.</p>\r\n<div>&nbsp;</div>', 'Women’s Black Cafe Racer Leather Jacket – Premium Style', 'Shop the Women’s Black Cafe Racer Leather Jacket by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted from lambskin leather with padded shoulders, stand-up collar, and zippered cuffs. Sleek, stylish, and durable.', 'women’s leather jacket, black leather jacket women, cafe racer leather jacket women, lambskin leather jacket women, stylish women’s outerwear, premium leather fashion, casual leather jacket women, luxury women’s jacket, versatile women’s jacket, timeless women’s fashion, tailored fit leather jacket, durable leather jacket women, women’s cafe racer leather jacket San Diego, black lambskin leather jacket San Diego, premium lambskin cafe racer jacket San Diego, padded shoulder leather jacket San Diego, stylish women’s outerwear San Diego edition, durable leather jacket women San Diego, all-season women’s leather jacket San Diego, tailored fit cafe racer leather jacket San Diego, women’s leather jacket with phone pocket San Diego, versatile women’s leather fashion San Diego, luxury women’s black leather jacket San Diego, timeless cafe racer leather jacket San Diego', 1, 'SC-208', 'BK-2219-HV', 'LZ-204287', '6830598977277', '03.94', '13.23', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769596564, 1773077707, 72, 1772604151, 1001, 1, 1772604151, 1001, 1, 1772538715, 1, 100, 5, '497.5', 100, 'xgHSpCTdbKS5skNv', 1772275130, 1, '59.103.124.231', 573091200, 0, NULL),
(17, 17, 'stonegrey-kids-jersey-bomber-jacket-minneapolis', 'StoneGrey Kids’ Jersey Bomber Jacket', 'Kids’ StoneGrey Jersey Bomber Jacket', '<p>The StoneGrey Kids&rsquo; Jersey Bomber Jacket is designed for children who love casual comfort with a touch of sporty flair. Crafted from 93% cotton and 7% recycled polyester, it offers a soft, breathable feel while being durable enough for active play.</p>\r\n<p>The neutral stone grey tone makes it versatile for school, outings, or weekend adventures. Ribbed cuffs, collar, and hem ensure a snug fit, while the snap‑button closure makes it easy for kids to put on and take off. Two side pockets provide space for small essentials.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just fashion &mdash; it&rsquo;s a statement of sustainability, reliability, and international trust for kids&rsquo; wear.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 93% Cotton, 7% Recycled Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Kids&rsquo; bomber jacket for casual wear</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Stone Grey</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Front snap‑button closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Ribbed bomber‑style collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs &amp; Hem:</strong> Ribbed for snug fit</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two side slit pockets</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The StoneGrey Kids&rsquo; Jersey Bomber Jacket combines comfort, durability, and playful style. Made from a sustainable cotton‑poly blend, it features ribbed trims and a classic bomber silhouette perfect for everyday wear. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Minneapolis.</p>\r\n<div>&nbsp;</div>', 'StoneGrey Kids’ Jersey Bomber Jacket – Sustainable Style', 'Shop the StoneGrey Kids’ Jersey Bomber Jacket by SHONiR CMS, a global manufacturer and supplier of premium children’s fashion. Crafted from cotton and recycled polyester with bomber styling, ribbed trims, and versatile stone grey finish. Comfortable, stylish, and sustainable.', 'kids’ bomber jacket, grey bomber jacket kids, jersey bomber jacket children, cotton bomber jacket kids, sustainable kids’ bomber jacket, stylish children’s outerwear, premium kids’ fashion, casual bomber jacket children, versatile kids’ jacket, timeless kids’ fashion, tailored fit bomber jacket kids, durable bomber jacket children, kids’ bomber jacket Minneapolis, stone grey kids’ bomber jacket Minneapolis, premium jersey bomber jacket Minneapolis, sustainable cotton kids’ bomber jacket Minneapolis, stylish children’s outerwear Minneapolis edition, durable bomber jacket kids Minneapolis, all‑season kids’ bomber jacket Minneapolis, tailored fit bomber jacket kids Minneapolis, kids’ bomber jacket with pockets Minneapolis, versatile kids’ casual fashion Minneapolis, luxury kids’ grey bomber jacket Minneapolis, timeless jersey bomber jacket Minneapolis', 1, 'SC-301', 'GQ-4586-YR', 'GK-131143', '6969824829451', '21.89', '43.92', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769596774, 1773077707, 35, 1772923443, 1000, 1, 1772806875, 1000, 1, 1772923443, 1, 99, 5, '495', 99, 'NpeSPgxTuX2wHgrW', 1772275328, 1, '59.103.124.231', 573091200, 0, NULL),
(18, 18, 'green-camouflage-hooded-waterproof-kids-jacket-kansas-city', 'Green Camouflage Hooded Waterproof Jacket – Kids', 'Kids’ Green Camouflage Waterproof Bomber Jacket', '<p>The Green Camouflage Hooded Waterproof Jacket is designed to keep kids comfortable and protected in all weather conditions. Made from 100% recycled polyester, it offers durability, sustainability, and a shower-resistant finish.</p>\r\n<p>This bomber-style jacket features a full zip fastening, elastic cuffs, and a snug hood for added warmth. The camouflage pattern adds a trendy edge, while the lightweight construction ensures ease of movement. Perfect for rainy days, outdoor play, or casual wear, this jacket combines functionality with fashion.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just outerwear &mdash; it&rsquo;s a statement of sustainability, reliability, and international trust for kids&rsquo; fashion.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Recycled Polyester (main, lining, and wadding)</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Kids&rsquo; bomber jacket with waterproof finish</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Green camouflage pattern</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Full zip fastening</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar &amp; Hood:</strong> Attached hood for protection</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs &amp; Hem:</strong> Elastic ribbed cuffs and hem for snug fit</p>\r\n</li>\r\n<li>\r\n<p><strong>Features:</strong> Waterproof, shower-resistant, breathable</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All-season</p>\r\n</li>\r\n</ul>', '<p>The Green Camouflage Hooded Waterproof Jacket is a practical and stylish outerwear piece for kids. Featuring a bold camouflage design, waterproof finish, and cozy hood, it&rsquo;s perfect for school, play, and outdoor adventures. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Kansas City.</p>\r\n<div>&nbsp;</div>', 'Kids’ Green Camouflage Waterproof Bomber Jacket – Sustainable Style', 'Shop the Kids’ Green Camouflage Hooded Waterproof Jacket by SHONiR CMS, a global manufacturer and supplier of premium children’s fashion. Crafted from recycled polyester with waterproof finish, bomber styling, and camouflage design. Durable, stylish, and sustainable.', 'kids’ waterproof jacket, camouflage jacket kids, bomber jacket children, recycled polyester kids’ jacket, sustainable kids’ fashion, stylish children’s outerwear, premium kids’ bomber jacket, casual waterproof jacket kids, versatile kids’ jacket, timeless kids’ fashion, durable waterproof jacket children, tailored fit bomber jacket kids, kids’ waterproof bomber jacket Kansas City, camouflage bomber jacket Kansas City, premium recycled kids’ jacket Kansas City, sustainable waterproof kids’ jacket Kansas City, stylish children’s outerwear Kansas City edition, durable waterproof jacket kids Kansas City, all-season waterproof kids’ jacket Kansas City, tailored fit bomber jacket kids Kansas City, kids’ waterproof jacket with hood Kansas City, versatile kids’ casual fashion Kansas City, luxury kids’ camouflage bomber jacket Kansas City, timeless waterproof bomber jacket Kansas City', 1, 'SC-302', 'JH-3619-YL', 'FT-043472', '0005749545031', '06.71', '81.46', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769596948, 1773077819, 6, 1773028553, 1002, 1, 1772806824, 1002, 1, 1773028553, 3, 99, 5, '495', 99, 'EAgfWkwTkMtNDU6y', 1772275431, 1, '59.103.124.231', 573091200, 0, NULL),
(19, 19, 'grey-smart-kids-bomber-jacket-columbus', 'Grey Smart Bomber Jacket – Kids', 'Kids’ Grey Smart Bomber Jacket', '<p>The Kids&rsquo; Grey Smart Bomber Jacket is designed for children who want comfort with a touch of sophistication. Made from a sustainable blend of recycled polyester, viscose, and elastane, it offers durability, flexibility, and a soft feel.</p>\r\n<p>This jacket features a zip fastening, ribbed hems, and raglan-style sleeves for ease of movement. Side pockets provide practical storage, while the printed lining adds a fun detail. Machine washable for convenience, it&rsquo;s perfect for everyday wear and layering over polos, t-shirts, or matching trousers.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just outerwear &mdash; it&rsquo;s a statement of sustainability, reliability, and international trust for kids&rsquo; fashion.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Main: 55% Recycled Polyester, 32% Viscose, 11% Polyester, 2% Elastane</p>\r\n</li>\r\n<li>\r\n<p><strong>Body Lining:</strong> 100% Recycled Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Sleeve Lining:</strong> 100% Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Kids&rsquo; smart-casual bomber jacket</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Grey</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zip fastening</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Ribbed bomber-style collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs &amp; Hem:</strong> Ribbed for snug fit</p>\r\n</li>\r\n<li>\r\n<p><strong>Sleeves:</strong> Raglan-style for comfort</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two side pockets</p>\r\n</li>\r\n<li>\r\n<p><strong>Features:</strong> Printed lining, machine washable</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All-season</p>\r\n</li>\r\n</ul>', '<p>The Grey Smart Bomber Jacket is a stylish and practical choice for kids. Featuring elevated textured fabric, ribbed trims, and raglan sleeves, it delivers a smart-casual look perfect for school, outings, or play. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Columbus.</p>\r\n<div>&nbsp;</div>', 'Kids’ Grey Smart Bomber Jacket – Sustainable Style', 'Shop the Kids’ Grey Smart Bomber Jacket by SHONiR CMS, a global manufacturer and supplier of premium children’s fashion. Crafted from recycled polyester blend with smart fabric, raglan sleeves, and ribbed trims. Stylish, durable, and sustainable.', 'kids’ bomber jacket, grey bomber jacket kids, smart bomber jacket children, recycled polyester kids’ jacket, sustainable kids’ fashion, stylish children’s outerwear, premium kids’ bomber jacket, casual bomber jacket children, versatile kids’ jacket, timeless kids’ fashion, durable bomber jacket children, tailored fit bomber jacket kids, kids’ smart bomber jacket Columbus, grey bomber jacket Columbus, premium recycled kids’ jacket Columbus, sustainable smart kids’ jacket Columbus, stylish children’s outerwear Columbus edition, durable bomber jacket kids Columbus, all-season bomber jacket kids Columbus, tailored fit bomber jacket kids Columbus, kids’ bomber jacket with pockets Columbus, versatile kids’ casual fashion Columbus, luxury kids’ grey bomber jacket Columbus, timeless smart bomber jacket Columbus', 1, 'SC-303', 'TX-0584-ML', 'BW-989129', '4894719313308', '34.40', '89.97', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769597071, 1773077707, 6, 1773010595, 1002, 2, 1773010596, 1002, 1, 573091200, 0, 99, 5, '495', 99, 'x6GSTbjXHeCZQT6q', 1772275602, 1, '59.103.124.231', 573091200, 0, NULL),
(20, 20, 'green-colour-block-waterproof-kids-cagoule-phoenix', 'Green Colour Block Waterproof Cagoule – Kids', 'Kids’ Green Colour Block Waterproof Cagoule', '<p>The Kids&rsquo; Green Colour Block Waterproof Cagoule is designed for children who love outdoor adventures, even on rainy days. Made from 100% recycled polyester, it offers durability, sustainability, and maximum protection with taped seams.</p>\r\n<p>This cagoule-style jacket features a hood for extra coverage, a zip fastening for easy wear, and a soft jersey lining for comfort. The vibrant colour block design adds a sporty edge, making it perfect for school, play, or weekend outings. Machine washable for convenience, it&rsquo;s a reliable choice for parents and a fun piece for kids.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just outerwear &mdash; it&rsquo;s a statement of sustainability, reliability, and international trust for kids&rsquo; fashion.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Recycled Polyester (main and lining)</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Kids&rsquo; waterproof cagoule jacket</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Green colour block design</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zip fastening</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar &amp; Hood:</strong> Attached hood for protection</p>\r\n</li>\r\n<li>\r\n<p><strong>Sleeves:</strong> Raglan-style for sporty fit</p>\r\n</li>\r\n<li>\r\n<p><strong>Features:</strong> Waterproof with taped seams, mesh lining, machine washable</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All-season</p>\r\n</li>\r\n</ul>\r\n<div>&nbsp;</div>', '<p>The Green Colour Block Waterproof Cagoule is a practical and stylish outerwear piece for kids. Featuring taped seams, waterproof finish, and a sporty design, it&rsquo;s perfect for rainy day adventures. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Phoenix.</p>\r\n<div>&nbsp;</div>', 'Kids’ Green Colour Block Waterproof Cagoule – Sustainable Style', 'Shop the Kids’ Green Colour Block Waterproof Cagoule by SHONiR CMS, a global manufacturer and supplier of premium children’s fashion. Crafted from recycled polyester with waterproof finish, taped seams, and sporty colour block design. Durable, stylish, and sustainable.', 'kids’ waterproof jacket, colour block jacket kids, cagoule jacket children, recycled polyester kids’ jacket, sustainable kids’ fashion, stylish children’s outerwear, premium kids’ cagoule jacket, casual waterproof jacket kids, versatile kids’ jacket, timeless kids’ fashion, durable waterproof jacket children, tailored fit cagoule jacket kids, kids’ waterproof cagoule Phoenix, colour block waterproof jacket Phoenix, premium recycled kids’ jacket Phoenix, sustainable waterproof kids’ jacket Phoenix, stylish children’s outerwear Phoenix edition, durable waterproof jacket kids Phoenix, all-season waterproof kids’ jacket Phoenix, tailored fit cagoule jacket kids Phoenix, kids’ waterproof jacket with hood Phoenix, versatile kids’ casual fashion Phoenix, luxury kids’ colour block cagoule Phoenix, timeless waterproof cagoule jacket Phoenix', 1, 'SC-304', 'PT-1315-KR', 'RC-995245', '5664335226318', '57.13', '127.31', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769597263, 1773077819, 273, 573091200, 999, 99, 573091200, 999, 0, 573091200, 0, 99, 5, '495', 99, 'SRDzs4WAnKMwT1dJ', 1772275884, 1, '59.103.124.231', 573091200, 0, NULL),
(21, 21, 'red-cars-bag-pocket-kids-cagoule-jacket-st-louis', 'Red Cars Bag Pocket Cagoule Jacket – Kids', 'Kids’ Red Cars Bag Pocket Cagoule Jacket', '<p>The Kids&rsquo; Red Cars Bag Pocket Cagoule Jacket is designed for children who love playful fashion with practical functionality. Made from 100% recycled polyester, it offers durability, sustainability, and comfort.</p>\r\n<p>This cagoule‑style jacket features a hood for extra coverage, a zip fastening for easy wear, and a unique bag pocket detail for added fun. The vibrant red color and themed accents make it a standout piece for school, play, or weekend outings. Machine washable for convenience, it&rsquo;s a reliable choice for parents and a favorite for kids.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just outerwear &mdash; it&rsquo;s a statement of sustainability, reliability, and international trust for kids&rsquo; fashion.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Recycled Polyester (main and lining)</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Kids&rsquo; waterproof cagoule jacket</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Red</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zip fastening</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar &amp; Hood:</strong> Attached hood for protection</p>\r\n</li>\r\n<li>\r\n<p><strong>Features:</strong> Bag pocket detail, machine washable</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Red Cars Bag Pocket Cagoule Jacket is a fun, practical, and stylish outerwear piece for kids. Featuring a bold red design, hooded coverage, and playful Cars‑inspired details, it&rsquo;s perfect for rainy day adventures and casual wear. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in St. Louis.</p>\r\n<div>&nbsp;</div>', 'Kids’ Red Cars Bag Pocket Cagoule Jacket – Sustainable Style', 'Shop the Kids’ Red Cars Bag Pocket Cagoule Jacket by SHONiR CMS, a global manufacturer and supplier of premium children’s fashion. Crafted from recycled polyester with cagoule styling, hooded coverage, and playful bag pocket detail. Durable, stylish, and sustainable.', 'kids’ waterproof jacket, red cagoule jacket kids, bag pocket jacket children, recycled polyester kids’ jacket, sustainable kids’ fashion, stylish children’s outerwear, premium kids’ cagoule jacket, casual waterproof jacket kids, versatile kids’ jacket, timeless kids’ fashion, durable waterproof jacket children, tailored fit cagoule jacket kids, kids’ waterproof cagoule St. Louis, red cagoule jacket St. Louis, premium recycled kids’ jacket St. Louis, sustainable waterproof kids’ jacket St. Louis, stylish children’s outerwear St. Louis edition, durable waterproof jacket kids St. Louis, all‑season waterproof kids’ jacket St. Louis, tailored fit cagoule jacket kids St. Louis, kids’ waterproof jacket with hood St. Louis, versatile kids’ casual fashion St. Louis, luxury kids’ red cagoule St. Louis, timeless waterproof cagoule jacket St. Louis', 1, 'SC-305', 'HR-0425-DA', 'YW-492434', '9807949060384', '41.02', '83.23', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769597520, 1773077707, 7, 1773005673, 1000, 1, 1773005673, 1000, 1, 573091200, 0, 99, 5, '495', 99, 'dtp7LWa04XZJAquT', 1772276045, 1, '59.103.124.231', 573091200, 0, NULL),
(22, 22, 'ombre-blue-waterproof-kids-cagoule-jacket-san-antonio', 'Ombre Blue Waterproof Cagoule Jacket – Kids', 'Kids’ Ombre Blue Waterproof Cagoule Jacket', '<p>The Kids&rsquo; Ombre Blue Waterproof Cagoule Jacket is designed for children who love outdoor adventures, even in unpredictable weather. Made from recycled polyester with cotton‑viscose lining, it offers durability, sustainability, and comfort.</p>\r\n<p>This cagoule‑style jacket features a hood for extra coverage, a zip fastening for easy wear, and elastic cuffs for a snug fit. The ombre blue gradient design adds a trendy edge, making it perfect for school, play, or weekend outings. Machine washable for convenience, it&rsquo;s a reliable choice for parents and a fun piece for kids.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just outerwear &mdash; it&rsquo;s a statement of sustainability, reliability, and international trust for kids&rsquo; fashion.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Main: 100% Recycled Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Body Lining:</strong> 85% Cotton, 15% Viscose</p>\r\n</li>\r\n<li>\r\n<p><strong>Sleeve Lining:</strong> 100% Recycled Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Kids&rsquo; waterproof cagoule jacket</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Ombre Blue gradient</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zip fastening</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar &amp; Hood:</strong> Attached hood for protection</p>\r\n</li>\r\n<li>\r\n<p><strong>Features:</strong> Waterproof with taped seams, soft jersey lining, machine washable</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Ombre Blue Waterproof Cagoule Jacket is a stylish and practical outerwear piece for kids. Featuring taped seams, waterproof finish, and a soft jersey lining, it&rsquo;s perfect for rainy day adventures. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in San Antonio.</p>\r\n<div>&nbsp;</div>', 'Kids’ Ombre Blue Waterproof Cagoule Jacket – Sustainable Style', 'Shop the Kids’ Ombre Blue Waterproof Cagoule Jacket by SHONiR CMS, a global manufacturer and supplier of premium children’s fashion. Crafted from recycled polyester with waterproof finish, taped seams, and ombre blue design. Durable, stylish, and sustainable.', 'kids’ waterproof jacket, ombre blue jacket kids, cagoule jacket children, recycled polyester kids’ jacket, sustainable kids’ fashion, stylish children’s outerwear, premium kids’ cagoule jacket, casual waterproof jacket kids, versatile kids’ jacket, timeless kids’ fashion, durable waterproof jacket children, tailored fit cagoule jacket kids, kids’ waterproof cagoule San Antonio, ombre blue waterproof jacket San Antonio, premium recycled kids’ jacket San Antonio, sustainable waterproof kids’ jacket San Antonio, stylish children’s outerwear San Antonio edition, durable waterproof jacket kids San Antonio, all‑season waterproof kids’ jacket San Antonio, tailored fit cagoule jacket kids San Antonio, kids’ waterproof jacket with hood San Antonio, versatile kids’ casual fashion San Antonio, luxury kids’ ombre blue cagoule San Antonio, timeless waterproof cagoule jacket San Antonio', 1, 'SC-306', 'DX-6506-FB', 'DC-791104', '6486809650327', '23.55', '122.07', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1772276075, 1773077707, 28, 1772923455, 1004, 1, 1772806821, 1004, 1, 1772923455, 2, 99, 5, '495', 99, 'znnPWHh96bhd5qKr', 1772276138, 1, '59.103.124.231', 573091200, 0, NULL),
(23, 23, 'black-smart-kids-bomber-jacket-dallas', 'Black Smart Bomber Jacket – Kids', 'Kids’ Black Smart Bomber Jacket', '<p>The Kids&rsquo; Black Smart Bomber Jacket is designed for children who want versatile style with everyday comfort. Made from a sustainable cotton‑poly blend, it provides a soft feel while maintaining durability and structure.</p>\r\n<p>This bomber jacket features ribbed collar, cuffs, and hem for a snug fit, a front zip fastening for easy wear, and side pockets for practicality. Its regular fit and jersey fabric construction make it ideal for layering over polos, t‑shirts, or matching trousers. Machine washable for convenience, it&rsquo;s a reliable choice for parents and a stylish option for kids.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This jacket is not just outerwear &mdash; it&rsquo;s a statement of sustainability, reliability, and international trust for kids&rsquo; fashion.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 80% Cotton, 20% Recycled Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Kids&rsquo; smart‑casual bomber jacket</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Front zip fastening</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Ribbed bomber‑style collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs &amp; Hem:</strong> Ribbed for snug fit</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two side pockets</p>\r\n</li>\r\n<li>\r\n<p><strong>Fit:</strong> Regular fit</p>\r\n</li>\r\n<li>\r\n<p><strong>Features:</strong> Jersey fabric construction, machine washable</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Black Smart Bomber Jacket offers a refined take on a classic layering piece for kids. Crafted from soft jersey fabric, it combines comfort with a structured silhouette, making it perfect for smart‑casual occasions. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Dallas.</p>\r\n<div>&nbsp;</div>', 'Kids’ Black Smart Bomber Jacket – Sustainable Style', 'Shop the Kids’ Black Smart Bomber Jacket by SHONiR CMS, a global manufacturer and supplier of premium children’s fashion. Crafted from cotton and recycled polyester with jersey fabric, ribbed trims, and smart‑casual design. Comfortable, stylish, and sustainable.', 'kids’ bomber jacket, black bomber jacket kids, smart bomber jacket children, cotton bomber jacket kids, recycled polyester kids’ jacket, sustainable kids’ fashion, stylish children’s outerwear, premium kids’ bomber jacket, casual bomber jacket children, versatile kids’ jacket, timeless kids’ fashion, durable bomber jacket children, tailored fit bomber jacket kids, kids’ smart bomber jacket Dallas, black bomber jacket Dallas, premium recycled kids’ jacket Dallas, sustainable smart kids’ jacket Dallas, stylish children’s outerwear Dallas edition, durable bomber jacket kids Dallas, all‑season bomber jacket kids Dallas, tailored fit bomber jacket kids Dallas, kids’ bomber jacket with pockets Dallas, versatile kids’ casual fashion Dallas, luxury kids’ black bomber jacket Dallas, timeless smart bomber jacket Dallas', 1, 'SC-307', 'QJ-4014-YL', 'WA-014352', '0215168116667', '37.37', '118.17', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769597787, 1773077819, 51, 1772747926, 1000, 1, 1772747926, 1000, 1, 1772503272, 1, 99, 5, '495', 99, 'kBCZjzFYP5xY6jMP', 1772276267, 1, '59.103.124.231', 573091200, 0, NULL),
(24, 24, 'black-longline-shower-resistant-kids-padded-coat-chicago', 'Black Longline Shower Resistant Padded Coat – Kids', 'Kids’ Black Longline Shower Resistant Padded Coat', '<p>The Kids&rsquo; Black Longline Shower Resistant Padded Coat is designed to keep children warm, dry, and comfortable during chilly weather. Made from recycled polyester with padded wadding, it offers durability, sustainability, and reliable insulation.</p>\r\n<p>This coat features a longline silhouette for extra coverage, a hood with soft lining for added protection, and a zip fastening for easy wear. Shower‑resistant fabric ensures maximum protection against light rain, while the quilted design adds a stylish touch. Perfect for school, outdoor play, or weekend outings, this coat is both functional and fashionable.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This coat is not just outerwear &mdash; it&rsquo;s a statement of sustainability, reliability, and international trust for kids&rsquo; fashion.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Main: 100% Recycled Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Body Lining:</strong> 100% Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Hood Lining:</strong> 100% Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Sleeve Lining:</strong> 100% Recycled Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Wadding:</strong> 100% Recycled Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Kids&rsquo; padded longline coat</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Front zip fastening</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar &amp; Hood:</strong> Attached hood with lining</p>\r\n</li>\r\n<li>\r\n<p><strong>Features:</strong> Shower‑resistant finish, padded insulation, longline fit</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> Autumn/Winter</p>\r\n</li>\r\n</ul>', '<p>The Black Longline Shower Resistant Padded Coat is a warm, practical, and stylish outerwear piece for kids. Featuring a longline fit, padded insulation, and shower‑resistant finish, it&rsquo;s perfect for cold and rainy days. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Chicago.</p>\r\n<div>&nbsp;</div>', 'Kids’ Black Longline Shower Resistant Padded Coat – Sustainable Style', 'Shop the Kids’ Black Longline Shower Resistant Padded Coat by SHONiR CMS, a global manufacturer and supplier of premium children’s fashion. Crafted from recycled polyester with padded insulation, shower‑resistant finish, and longline fit. Warm, stylish, and sustainable.', 'kids’ padded coat, black longline coat kids, shower resistant coat children, recycled polyester kids’ coat, sustainable kids’ fashion, stylish children’s outerwear, premium kids’ padded coat, casual winter coat kids, versatile kids’ jacket, timeless kids’ fashion, durable padded coat children, tailored fit longline coat kids, kids’ padded coat Chicago, black longline padded coat Chicago, premium recycled kids’ coat Chicago, sustainable shower resistant kids’ coat Chicago, stylish children’s outerwear Chicago edition, durable padded coat kids Chicago, winter longline coat kids Chicago, tailored fit padded coat kids Chicago, kids’ padded coat with hood Chicago, versatile kids’ winter fashion Chicago, luxury kids’ black padded coat Chicago, timeless shower resistant padded coat Chicago', 1, 'SC-308', 'KM-2935-LA', 'WR-650285', '8613133766764', '81.40', '81.79', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769597912, 1773077819, 271, 573091200, 999, 99, 573091200, 999, 0, 573091200, 0, 99, 5, '495', 99, 'NTEMNc3SLZDumyrU', 1772276432, 1, '59.103.124.231', 573091200, 0, NULL),
(25, 25, 'jessie-leather-crossbody-bag-atlanta', 'Jessie Leather Crossbody Bag', 'Women’s Jessie Leather Crossbody Bag', '<p>The Jessie Leather Crossbody Bag blends fashion and function in a compact yet practical design. Made with leather patchwork and trim, it showcases a multi‑color palette with gold‑tone hardware for a chic finish.</p>\r\n<p>This small bucket crossbody silhouette includes a magnetic snap closure, structured compartments, and an interior slide pocket for essentials. With a grab drop of 4\" and a crossbody drop of 23\", it offers versatile carrying options. The polyurethane interior lining ensures durability, while the design is compatible with large devices such as the iPhone&reg; 16 Pro Max and Samsung Galaxy S24 Ultra&reg;.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. This bag is not just an accessory &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Leather Patchwork / Leather Trim</p>\r\n</li>\r\n<li>\r\n<p><strong>Measurements:</strong> 7.25\" L x 5\" W x 7\" H</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Magnetic Snap</p>\r\n</li>\r\n<li>\r\n<p><strong>Hardware:</strong> Gold Tone</p>\r\n</li>\r\n<li>\r\n<p><strong>Platform:</strong> Jessie</p>\r\n</li>\r\n<li>\r\n<p><strong>Primary Color:</strong> Multi</p>\r\n</li>\r\n<li>\r\n<p><strong>Grab Drop:</strong> 4\"</p>\r\n</li>\r\n<li>\r\n<p><strong>Crossbody Drop:</strong> 23\"</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Material:</strong> Polyurethane</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Details:</strong> 1 Slide Pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Device Compatibility:</strong> Fits iPhone&reg; 16 Pro Max &amp; Samsung Galaxy S24 Ultra&reg;</p>\r\n</li>\r\n<li>\r\n<p><strong>Silhouette:</strong> Small Bucket Crossbody</p>\r\n</li>\r\n<li>\r\n<p><strong>Handle Strap Description:</strong> 1 Adjustable &amp; Detachable Crossbody Strap, 1 Shoulder Strap</p>\r\n</li>\r\n</ul>', '<p>The Jessie Leather Crossbody Bag is a stylish patchwork bucket silhouette designed for modern versatility. Crafted with leather trim and gold‑tone hardware, it features a magnetic snap closure, spacious compartments, and adjustable straps. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Atlanta.</p>\r\n<div>&nbsp;</div>', 'Jessie Leather Crossbody Bag – Premium Patchwork Style', 'Shop the Jessie Leather Crossbody Bag by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted with patchwork leather, gold‑tone hardware, and bucket silhouette. Compact, stylish, and versatile.', 'women’s leather bag, crossbody leather bag, patchwork leather bag, bucket crossbody bag, stylish women’s handbag, premium leather fashion, casual crossbody bag women, luxury leather bag women, versatile women’s bag, timeless women’s fashion, durable leather bag women, Jessie leather crossbody bag Atlanta, patchwork bucket bag Atlanta, premium leather crossbody Atlanta, stylish women’s handbag Atlanta edition, durable leather bag women Atlanta, all‑season leather bag Atlanta, tailored fit crossbody bag Atlanta, women’s leather bag with slide pocket Atlanta, versatile women’s leather fashion Atlanta, luxury women’s patchwork bag Atlanta, timeless Jessie leather bag Atlanta', 1, 'SC-401', 'KB-2633-FL', 'UL-006489', '7293989932902', '09.51', '67.69', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769598102, 1773077819, 65, 1772590930, 1000, 1, 1772590930, 1000, 1, 573091200, 0, 99, 5, '495', 99, 'JJbdGm2c23CLW4Mj', 1772276627, 1, '59.103.124.231', 573091200, 0, NULL);
INSERT INTO `tbl_items` (`item_id`, `sort_order`, `slug`, `title`, `name`, `description`, `spotlight`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `model`, `sku`, `mpn`, `gtin`, `price`, `price_previous`, `minimum`, `maximum`, `stock`, `featured`, `newbie`, `hd`, `lq`, `st`, `searchable`, `listed`, `removable`, `launch_year`, `published_time`, `last_view_time`, `today_views`, `statistics_update`, `lifetime_views`, `today_hits`, `last_hit_time`, `lifetime_hits`, `today_carts`, `last_cart_time`, `lifetime_carts`, `votes`, `ratings`, `scores`, `likes`, `token`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(26, 26, 'jolie-leather-crossbody-bag-atlanta', 'Jolie Leather Crossbody Bag', 'Women’s Jolie Leather Crossbody Bag', '<p>The Jolie Leather Crossbody Bag blends timeless elegance with modern functionality. Made with leather and polyurethane trim, it offers durability and a refined finish.</p>\r\n<p>This crossbody silhouette features a secure zipper closure, gold‑tone hardware, and a structured design. The interior includes a slide pocket and a zipper pocket for organization, while the exterior hidden side phone pocket with magnetic snap adds convenience. With an 8\" shoulder drop and a 23\" adjustable crossbody strap, it offers versatile carrying options.</p>\r\n<p>Compatible with large devices such as the iPhone&reg; 14 Pro Max, Samsung Galaxy S22 Ultra&reg;, and iPad&reg; Air, this bag is designed for practicality without compromising style.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Jolie Crossbody Bag is not just an accessory &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Leather / Polyurethane Trim</p>\r\n</li>\r\n<li>\r\n<p><strong>Measurements:</strong> 11\" L x 3\" W x 8\" H</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zipper</p>\r\n</li>\r\n<li>\r\n<p><strong>Hardware:</strong> Gold Tone</p>\r\n</li>\r\n<li>\r\n<p><strong>Platform:</strong> Jolie</p>\r\n</li>\r\n<li>\r\n<p><strong>Primary Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Shoulder Drop:</strong> 8\"</p>\r\n</li>\r\n<li>\r\n<p><strong>Crossbody Drop:</strong> 23\" (fully extended)</p>\r\n</li>\r\n<li>\r\n<p><strong>Exterior Details:</strong> 1 Hidden Side Phone Pocket with Magnetic Snap</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Material:</strong> Fabric</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Details:</strong> 1 Slide Pocket, 1 Zipper Pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Device Compatibility:</strong> Fits iPhone&reg; 14 Pro Max, Samsung Galaxy S22 Ultra&reg;, iPad&reg; Air</p>\r\n</li>\r\n<li>\r\n<p><strong>Silhouette:</strong> Crossbody</p>\r\n</li>\r\n<li>\r\n<p><strong>Handle Strap Description:</strong> 1 Adjustable &amp; Detachable Crossbody Strap, 1 Short Shoulder Strap</p>\r\n</li>\r\n</ul>\r\n<div>&nbsp;</div>', '<p>The Jolie Leather Crossbody Bag is a sleek, versatile accessory crafted with leather and polyurethane trim. Featuring gold‑tone hardware, a zip closure, and smart compartments, it&rsquo;s perfect for everyday use. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Atlanta.</p>\r\n<div>&nbsp;</div>', 'Jolie Leather Crossbody Bag – Premium Black Style', 'Shop the Jolie Leather Crossbody Bag by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted with leather trim, gold‑tone hardware, and crossbody silhouette. Stylish, versatile, and durable.', 'women’s leather bag, crossbody leather bag, black leather bag women, stylish women’s handbag, premium leather fashion, casual crossbody bag women, luxury leather bag women, versatile women’s bag, timeless', 1, 'SC-402', 'CT-4754-KT', 'YA-142954', '9081279499149', '19.96', '87.56', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769598243, 1773077707, 3, 1773028546, 1000, 1, 1772591385, 1000, 1, 1773028546, 2, 99, 5, '495', 99, 'nAJTJF3vv98YACwS', 1772276786, 1, '59.103.124.231', 573091200, 0, NULL),
(27, 27, 'dillon-leather-shoulder-bag-boston', 'Dillon Leather Shoulder Bag', 'Women’s Dillon Leather Shoulder Bag', '<p>The Dillon Leather Shoulder Bag blends modern design with practical functionality. Made with leather patchwork and trim, it showcases a multi‑color palette with gold‑tone hardware for a stylish finish.</p>\r\n<p>This shoulder silhouette features a secure zipper closure, an exterior back slide pocket with magnetic snap, and a cotton interior lining for durability. Inside, it includes a slide pocket and a zipper pocket for organization. With an 11\" shoulder drop and adjustable strap, it offers versatile carrying options.</p>\r\n<p>Compatible with devices such as the 7.9\" iPad&reg; mini, this bag is designed for convenience while maintaining a fashionable look.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Dillon Shoulder Bag is not just an accessory &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Leather Patchwork / Leather Trim</p>\r\n</li>\r\n<li>\r\n<p><strong>Measurements:</strong> 11.5\" L x 4\" W x 7\" H</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zipper</p>\r\n</li>\r\n<li>\r\n<p><strong>Hardware:</strong> Gold Tone</p>\r\n</li>\r\n<li>\r\n<p><strong>Platform:</strong> Dillon</p>\r\n</li>\r\n<li>\r\n<p><strong>Primary Color:</strong> Multi</p>\r\n</li>\r\n<li>\r\n<p><strong>Shoulder Drop:</strong> 11\"</p>\r\n</li>\r\n<li>\r\n<p><strong>Exterior Details:</strong> 1 Back Slide Pocket with Magnetic Snap</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Material:</strong> 100% Cotton</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Details:</strong> 1 Slide Pocket, 1 Zipper Pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Device Compatibility:</strong> Fits 7.9\" iPad&reg; mini</p>\r\n</li>\r\n<li>\r\n<p><strong>Silhouette:</strong> Shoulder</p>\r\n</li>\r\n<li>\r\n<p><strong>Handle Strap Description:</strong> 1 Adjustable Shoulder Strap</p>\r\n</li>\r\n</ul>', '<p>The Dillon Leather Shoulder Bag is a chic patchwork silhouette crafted with leather trim and gold‑tone hardware. Featuring a zipper closure, structured compartments, and versatile shoulder strap, it&rsquo;s perfect for everyday use. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Boston.</p>\r\n<div>&nbsp;</div>', 'Dillon Leather Shoulder Bag – Premium Patchwork Style', 'Shop the Dillon Leather Shoulder Bag by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted with patchwork leather, gold‑tone hardware, and shoulder silhouette. Stylish, versatile, and durable.', 'women’s leather bag, shoulder leather bag, patchwork leather bag, stylish women’s handbag, premium leather fashion, casual shoulder bag women, luxury leather bag women, versatile women’s bag, timeless women’s fashion, durable leather bag women, Dillon leather shoulder bag Boston, patchwork shoulder bag Boston, premium leather shoulder bag Boston, stylish women’s handbag Boston edition, durable leather bag women Boston, all‑season leather bag Boston, tailored fit shoulder bag Boston, women’s leather bag with slide pocket Boston, versatile women’s leather fashion Boston, luxury women’s patchwork bag Boston, timeless Dillon leather bag Boston', 1, 'SC-403', 'XM-3540-DB', 'TA-439032', '6005049943933', '76.75', '144.45', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769598443, 1773077707, 5, 1773025071, 1001, 1, 1772806793, 1001, 1, 1773025071, 1, 99, 5, '495', 99, 'SL9hduAxZbqAEHEX', 1772276967, 1, '59.103.124.231', 573091200, 0, NULL),
(28, 28, 'willa-leather-shoulder-bag-philadelphia', 'Willa Leather Shoulder Bag', 'Women’s Willa Leather Shoulder Bag', '<p>The Willa Leather Shoulder Bag blends timeless sophistication with modern practicality. Made from premium leather, it offers durability, style, and a polished finish.</p>\r\n<p>This shoulder silhouette includes a secure zipper closure, gold‑tone hardware, and versatile compartments. Exterior details feature a back slide pocket, a front flap pocket, and a front zipper pocket for easy access. Inside, a fabric lining with a zipper pocket ensures organized storage.</p>\r\n<p>With a 9\" shoulder drop, this bag is comfortable to carry and designed to fit large devices such as the iPhone&reg; 16 Pro Max and Samsung Galaxy S24 Ultra&reg;. Compact yet spacious, it&rsquo;s ideal for work, travel, or casual outings.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Willa Shoulder Bag is not just an accessory &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Measurements:</strong> 12\" L x 3.5\" W x 9\" H</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zipper</p>\r\n</li>\r\n<li>\r\n<p><strong>Hardware:</strong> Gold Tone</p>\r\n</li>\r\n<li>\r\n<p><strong>Platform:</strong> Willa</p>\r\n</li>\r\n<li>\r\n<p><strong>Primary Color:</strong> Blue</p>\r\n</li>\r\n<li>\r\n<p><strong>Shoulder Drop:</strong> 9\"</p>\r\n</li>\r\n<li>\r\n<p><strong>Exterior Details:</strong> 1 Back Slide Pocket, 1 Front Flap Pocket, 1 Front Zipper Pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Material:</strong> Fabric</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Details:</strong> 1 Zipper Pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Device Compatibility:</strong> Fits iPhone&reg; 16 Pro Max &amp; Samsung Galaxy S24 Ultra&reg;</p>\r\n</li>\r\n<li>\r\n<p><strong>Silhouette:</strong> Shoulder</p>\r\n</li>\r\n<li>\r\n<p><strong>Handle Strap Description:</strong> 1 Shoulder Strap</p>\r\n</li>\r\n</ul>', '<p>The Willa Leather Shoulder Bag is a refined silhouette crafted from premium leather with gold‑tone hardware. Featuring multiple exterior pockets, a secure zipper closure, and structured design, it&rsquo;s perfect for everyday elegance. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Philadelphia.</p>\r\n<div>&nbsp;</div>', 'Willa Leather Shoulder Bag – Premium Blue Style', 'Shop the Willa Leather Shoulder Bag by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted with leather, gold‑tone hardware, and shoulder silhouette. Stylish, versatile, and durable.', 'women’s leather bag, shoulder leather bag, blue leather bag women, stylish women’s handbag, premium leather fashion, casual shoulder bag women, luxury leather bag women, versatile women’s bag, timeless women’s fashion, durable leather bag women, Willa leather shoulder bag Philadelphia, blue shoulder bag Philadelphia, premium leather shoulder bag Philadelphia, stylish women’s handbag Philadelphia edition, durable leather bag women Philadelphia, all‑season leather bag Philadelphia, tailored fit shoulder bag Philadelphia, women’s leather bag with zipper pocket Philadelphia, versatile women’s leather fashion Philadelphia, luxury women’s blue bag Philadelphia, timeless Willa leather bag Philadelphia', 1, 'SC-404', 'EJ-3451-NC', 'CL-240069', '2611243393000', '07.41', '80.44', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769598591, 1773043111, 24, 1772968636, 1001, 1, 1772968636, 1001, 1, 1772647344, 1, 99, 5, '495', 99, 'KWN1W8ciHbyZSamQ', 1772277357, 1, '59.103.124.231', 573091200, 0, NULL),
(29, 29, 'dillon-leather-shoulder-bag-boston', 'Dillon Leather Shoulder Bag', 'Women’s Dillon Leather Shoulder Bag', '<p>The Dillon Leather Shoulder Bag blends timeless sophistication with modern practicality. Made with leather and trim, it offers durability and a polished finish.</p>\r\n<p>This shoulder silhouette includes a secure zipper closure, gold‑tone hardware, and versatile compartments. Exterior details feature a back slide pocket with magnetic snap for easy access. Inside, a cotton lining with a slide pocket and zipper pocket ensures organized storage.</p>\r\n<p>With an 11\" shoulder drop, this bag is comfortable to carry and designed to fit devices such as the 7.9\" iPad&reg; mini. Compact yet spacious, it&rsquo;s ideal for work, travel, or casual outings.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Dillon Shoulder Bag is not just an accessory &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Leather / Leather Trim</p>\r\n</li>\r\n<li>\r\n<p><strong>Measurements:</strong> 11.5\" L x 4\" W x 7\" H</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zipper</p>\r\n</li>\r\n<li>\r\n<p><strong>Hardware:</strong> Gold Tone</p>\r\n</li>\r\n<li>\r\n<p><strong>Platform:</strong> Dillon</p>\r\n</li>\r\n<li>\r\n<p><strong>Primary Color:</strong> Brown</p>\r\n</li>\r\n<li>\r\n<p><strong>Shoulder Drop:</strong> 11\"</p>\r\n</li>\r\n<li>\r\n<p><strong>Exterior Details:</strong> 1 Back Slide Pocket with Magnetic Snap</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Material:</strong> 100% Cotton</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Details:</strong> 1 Slide Pocket, 1 Zipper Pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Device Compatibility:</strong> Fits 7.9\" iPad&reg; mini</p>\r\n</li>\r\n<li>\r\n<p><strong>Silhouette:</strong> Shoulder</p>\r\n</li>\r\n<li>\r\n<p><strong>Handle Strap Description:</strong> 1 Adjustable Shoulder Strap</p>\r\n</li>\r\n</ul>', '<p>The Dillon Leather Shoulder Bag is a chic silhouette crafted from premium leather with gold‑tone hardware. Featuring a zipper closure, structured compartments, and versatile shoulder strap, it&rsquo;s perfect for everyday use. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Boston.</p>\r\n<div>&nbsp;</div>', 'Dillon Leather Shoulder Bag – Premium Brown Style', 'Shop the Dillon Leather Shoulder Bag by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted with leather trim, gold‑tone hardware, and shoulder silhouette. Stylish, versatile, and durable.', 'women’s leather bag, shoulder leather bag, brown leather bag women, stylish women’s handbag, premium leather fashion, casual shoulder bag women, luxury leather bag women, versatile women’s bag, timeless women’s fashion, durable leather bag women, Dillon leather shoulder bag Boston, brown shoulder bag Boston, premium leather shoulder bag Boston, stylish women’s handbag Boston edition, durable leather bag women Boston, all‑season leather bag Boston, tailored fit shoulder bag Boston, women’s leather bag with slide pocket Boston, versatile women’s leather fashion Boston, luxury women’s brown bag Boston, timeless Dillon leather bag Boston', 1, 'SC-405', 'LJ-2583-KT', 'GC-410261', '5449894632164', '97.18', '135.06', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769598980, 1773077707, 41, 1772806845, 1006, 1, 1772806845, 1006, 1, 573091200, 0, 99, 5, '495', 99, 'Y3rKspjFvRS1Man4', 1772277455, 1, '59.103.124.231', 573091200, 0, NULL),
(30, 30, 'danni-leather-shoulder-bag-houston', 'Danni Leather Shoulder Bag', 'Women’s Danni Leather Shoulder Bag', '<p>The Danni Leather Shoulder Bag blends timeless sophistication with modern practicality. Made from premium leather, it offers durability, style, and a polished finish.</p>\r\n<p>This shoulder silhouette includes a secure zipper closure, gold‑tone hardware, and versatile compartments. Exterior details feature a back slide pocket for easy access. Inside, a cotton lining with one zipper pocket and two slide pockets ensures organized storage.</p>\r\n<p>With a 13\" shoulder drop and two adjustable straps, this bag is comfortable to carry and designed to fit large devices such as the iPhone&reg; 16 Pro Max and Samsung Galaxy S24 Ultra&reg;. Compact yet spacious, it&rsquo;s ideal for work, travel, or casual outings.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Danni Shoulder Bag is not just an accessory &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Measurements:</strong> 12\" L x 3.5\" W x 6.5\" H</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zipper</p>\r\n</li>\r\n<li>\r\n<p><strong>Hardware:</strong> Gold Tone</p>\r\n</li>\r\n<li>\r\n<p><strong>Platform:</strong> Danni</p>\r\n</li>\r\n<li>\r\n<p><strong>Primary Color:</strong> Brown</p>\r\n</li>\r\n<li>\r\n<p><strong>Shoulder Drop:</strong> 13\"</p>\r\n</li>\r\n<li>\r\n<p><strong>Exterior Details:</strong> 1 Back Slide Pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Material:</strong> 100% Cotton</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Details:</strong> 1 Zipper Pocket, 2 Slide Pockets</p>\r\n</li>\r\n<li>\r\n<p><strong>Device Compatibility:</strong> Fits iPhone&reg; 16 Pro Max &amp; Samsung Galaxy S24 Ultra&reg;</p>\r\n</li>\r\n<li>\r\n<p><strong>Silhouette:</strong> Shoulder</p>\r\n</li>\r\n<li>\r\n<p><strong>Handle Strap Description:</strong> 2 Adjustable Shoulder Straps</p>\r\n</li>\r\n</ul>', '<p>The Danni Leather Shoulder Bag is a refined silhouette crafted from premium leather with gold‑tone hardware. Featuring multiple interior pockets, a secure zipper closure, and dual adjustable straps, it&rsquo;s perfect for everyday elegance. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Houston.</p>\r\n<div>&nbsp;</div>', 'Danni Leather Shoulder Bag – Premium Brown Style', 'Shop the Danni Leather Shoulder Bag by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted with leather, gold‑tone hardware, and shoulder silhouette. Stylish, versatile, and durable.', 'women’s leather bag, shoulder leather bag, brown leather bag women, stylish women’s handbag, premium leather fashion, casual shoulder bag women, luxury leather bag women, versatile women’s bag, timeless women’s fashion, durable leather bag women, Danni leather shoulder bag Houston, brown shoulder bag Houston, premium leather shoulder bag Houston, stylish women’s handbag Houston edition, durable leather bag women Houston, all‑season leather bag Houston, tailored fit shoulder bag Houston, women’s leather bag with slide pocket Houston, versatile women’s leather fashion Houston, luxury women’s brown bag Houston, timeless Danni leather bag Houston', 1, 'SC-406', 'NU-3476-NJ', 'QH-224069', '2549155054644', '32.26', '63.22', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769599072, 1773077707, 46, 1772806865, 1000, 1, 1772806865, 1000, 1, 1772538442, 1, 99, 5, '495', 99, 'CPsP55R6qDMEqyBT', 1772277671, 1, '59.103.124.231', 573091200, 0, NULL),
(31, 31, 'danni-leather-shoulder-bag-houston', 'Danni Leather Shoulder Bag', 'Women’s Danni Leather Shoulder Bag', '<p>The Danni Leather Shoulder Bag blends timeless sophistication with modern practicality. Made from premium leather with polyurethane trim, it offers durability, style, and a polished finish.</p>\r\n<p>This shoulder silhouette includes a secure zipper closure, gold‑tone hardware, and versatile compartments. Exterior details feature a back slide pocket for easy access. Inside, a cotton lining with one zipper pocket and two slide pockets ensures organized storage.</p>\r\n<p>With a 13\" shoulder drop and two adjustable straps, this bag is comfortable to carry and designed to fit large devices such as the iPhone&reg; 16 Pro Max and Samsung Galaxy S24 Ultra&reg;. Compact yet spacious, it&rsquo;s ideal for work, travel, or casual outings.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Danni Shoulder Bag is not just an accessory &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Leather / Polyurethane Trim</p>\r\n</li>\r\n<li>\r\n<p><strong>Measurements:</strong> 12\" L x 3.5\" W x 6.5\" H</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zipper</p>\r\n</li>\r\n<li>\r\n<p><strong>Hardware:</strong> Gold Tone</p>\r\n</li>\r\n<li>\r\n<p><strong>Platform:</strong> Danni</p>\r\n</li>\r\n<li>\r\n<p><strong>Primary Color:</strong> Brown</p>\r\n</li>\r\n<li>\r\n<p><strong>Shoulder Drop:</strong> 13\"</p>\r\n</li>\r\n<li>\r\n<p><strong>Exterior Details:</strong> 1 Back Slide Pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Material:</strong> 100% Cotton</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Details:</strong> 1 Zipper Pocket, 2 Slide Pockets</p>\r\n</li>\r\n<li>\r\n<p><strong>Device Compatibility:</strong> Fits iPhone&reg; 16 Pro Max &amp; Samsung Galaxy S24 Ultra&reg;</p>\r\n</li>\r\n<li>\r\n<p><strong>Silhouette:</strong> Shoulder</p>\r\n</li>\r\n<li>\r\n<p><strong>Handle Strap Description:</strong> 2 Adjustable Shoulder Straps</p>\r\n</li>\r\n</ul>', '<p>The Danni Leather Shoulder Bag is a refined silhouette crafted from premium leather with polyurethane trim and gold‑tone hardware. Featuring multiple interior pockets, a secure zipper closure, and dual adjustable straps, it&rsquo;s perfect for everyday elegance. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Houston.</p>\r\n<div>&nbsp;</div>', 'Danni Leather Shoulder Bag – Premium Brown Style', 'Shop the Danni Leather Shoulder Bag by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted with leather and polyurethane trim, gold‑tone hardware, and shoulder silhouette. Stylish, versatile, and durable.', 'women’s leather bag, shoulder leather bag, brown leather bag women, stylish women’s handbag, premium leather fashion, casual shoulder bag women, luxury leather bag women, versatile women’s bag, timeless women’s fashion, durable leather bag women, Danni leather shoulder bag Houston, brown shoulder bag Houston, premium leather shoulder bag Houston, stylish women’s handbag Houston edition, durable leather bag women Houston, all‑season leather bag Houston, tailored fit shoulder bag Houston, women’s leather bag with slide pocket Houston, versatile women’s leather fashion Houston, luxury women’s brown bag Houston, timeless Danni leather bag Houston', 1, 'SC-406', 'TS-0932-JK', 'XD-327912', '6820520116522', '88.11', '100.86', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1772277684, 1773077707, 253, 573091200, 999, 99, 573091200, 999, 0, 573091200, 0, 99, 5, '495', 99, 'MQdMTpFL8KFExmYh', 1772277777, 1, '59.103.124.231', 1772278211, 1, '59.103.124.231'),
(32, 32, 'jolie-leather-hobo-bag-philadelphia', 'Jolie Leather Hobo Bag', 'Women’s Jolie Leather Hobo Bag', '<p>The Jolie Leather Hobo Bag blends timeless elegance with modern functionality. Made with leather and polyurethane trim, it offers durability and a refined finish.</p>\r\n<p>This hobo silhouette features a secure zipper closure, gold‑tone hardware, and a spacious design. The interior includes a zipper pocket and two slide pockets for organization, while the exterior hidden side phone pocket with magnetic snap adds convenience. With an 8\" shoulder drop and a 23\" adjustable crossbody strap, it offers versatile carrying options.</p>\r\n<p>Compatible with large devices such as the 12.9\" iPad&reg; Pro, iPhone&reg; 14 Pro Max, and Samsung Galaxy S22 Ultra&reg;, this bag is designed for practicality without compromising style.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Jolie Hobo Bag is not just an accessory &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Leather / Polyurethane Trim</p>\r\n</li>\r\n<li>\r\n<p><strong>Measurements:</strong> 12\" L x 5\" W x 13\" H</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Zipper</p>\r\n</li>\r\n<li>\r\n<p><strong>Hardware:</strong> Gold Tone</p>\r\n</li>\r\n<li>\r\n<p><strong>Platform:</strong> Jolie</p>\r\n</li>\r\n<li>\r\n<p><strong>Primary Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Shoulder Drop:</strong> 8\"</p>\r\n</li>\r\n<li>\r\n<p><strong>Crossbody Drop:</strong> 23\" (fully extended)</p>\r\n</li>\r\n<li>\r\n<p><strong>Exterior Details:</strong> 1 Hidden Side Phone Pocket with Magnetic Snap</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Material:</strong> Fabric</p>\r\n</li>\r\n<li>\r\n<p><strong>Interior Details:</strong> 1 Zipper Pocket, 2 Slide Pockets</p>\r\n</li>\r\n<li>\r\n<p><strong>Device Compatibility:</strong> Fits 12.9\" iPad&reg; Pro, iPhone&reg; 14 Pro Max, Samsung Galaxy S22 Ultra&reg;</p>\r\n</li>\r\n<li>\r\n<p><strong>Silhouette:</strong> Hobo</p>\r\n</li>\r\n<li>\r\n<p><strong>Handle Strap Description:</strong> 1 Adjustable &amp; Detachable Crossbody Strap, 1 Short Shoulder Strap</p>\r\n</li>\r\n</ul>', '<p>The Jolie Leather Hobo Bag is a sleek, versatile accessory crafted with leather and polyurethane trim. Featuring gold‑tone hardware, a zip closure, and smart compartments, it&rsquo;s perfect for everyday use. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Philadelphia.</p>\r\n<div>&nbsp;</div>', 'Jolie Leather Hobo Bag – Premium Black Style', 'Shop the Jolie Leather Hobo Bag by SHONiR CMS, a global manufacturer and supplier of premium leather fashion. Crafted with leather trim, gold‑tone hardware, and hobo silhouette. Stylish, versatile, and durable.', 'women’s leather bag, hobo leather bag, black leather bag women, stylish women’s handbag, premium leather fashion, casual hobo bag women, luxury leather bag women, versatile women’s bag, timeless women’s fashion, durable leather bag women, Jolie leather hobo bag Philadelphia, black hobo bag Philadelphia, premium leather hobo bag Philadelphia, stylish women’s handbag Philadelphia edition, durable leather bag women Philadelphia, all‑season leather bag Philadelphia, tailored fit hobo bag Philadelphia, women’s leather bag with phone pocket Philadelphia, versatile women’s leather fashion Philadelphia, luxury women’s black bag Philadelphia, timeless Jolie leather bag Philadelphia', 1, 'SC-408', 'LC-8455-UM', 'EN-928341', '5460658967640', '59.54', '142.93', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769599439, 1773043111, 56, 1772590650, 1000, 1, 1772590650, 1000, 1, 573091200, 0, 99, 5, '495', 99, 'iGA2UwLEEx8JC2gD', 1772277981, 1, '59.103.124.231', 573091200, 0, NULL),
(33, 33, 'kim-black-double-breasted-leather-blazer-women-new-york', 'Kim Black Double Breasted Leather Blazer – Women', 'Women’s Kim Black Double Breasted Leather Blazer', '<p>The Women&rsquo;s Kim Black Double Breasted Leather Blazer is designed for women who want to look polished and stylish, whether at work or on a night out. Made from 100% real lambskin leather, it offers durability, luxury, and a refined finish.</p>\r\n<p>This blazer features a double‑breasted button closure, peak lapel collar, and multiple pockets &mdash; two front flap pockets, one chest pocket, and one inside mobile pocket. Fully lined with soft polyester, it ensures comfort while maintaining a structured silhouette.</p>\r\n<p>Available in a sleek black finish, this blazer is a versatile wardrobe essential that combines timeless tailoring with modern celebrity‑inspired fashion.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Kim Leather Blazer is not just outerwear &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Internal Lining:</strong> Soft Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Women&rsquo;s tailored leather blazer</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Double‑breasted button closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Peak lapel collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two front flap pockets, one chest pocket, one inside mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Fit:</strong> Tailored celebrity‑inspired silhouette</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Kim Black Double Breasted Leather Blazer is a glamorous, tailored piece inspired by celebrity style. Crafted from premium lambskin leather with soft polyester lining, it delivers elegance, versatility, and sophistication. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in New York.</p>\r\n<div>&nbsp;</div>', 'Kim Black Double Breasted Leather Blazer – Premium Women’s Style', 'Shop the Kim Black Double Breasted Leather Blazer by SHONiR CMS, a global manufacturer and supplier of premium women’s fashion. Crafted from lambskin leather with peak lapel collar, double‑breasted closure, and tailored fit. Elegant, versatile, and durable.', 'women’s leather blazer, black leather blazer women, double breasted blazer women, lambskin leather blazer women, premium leather fashion, stylish women’s outerwear, celebrity style leather blazer, tailored leather blazer women, versatile women’s jacket, timeless women’s fashion, durable leather blazer women, Kim leather blazer New York, black double breasted blazer New York, premium lambskin blazer New York, stylish women’s leather blazer New York edition, durable leather blazer women New York, all‑season leather blazer New York, tailored fit leather blazer New York, women’s leather blazer with pockets New York, versatile women’s leather fashion New York, luxury women’s black blazer New York, timeless Kim leather blazer New York', 1, 'SC-501', 'SJ-2440-UN', 'AM-071105', '9618829872181', '19.33', '115.54', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769599720, 1773077819, 244, 573091200, 999, 99, 573091200, 999, 0, 573091200, 0, 99, 5, '495', 99, 'LxtgDvV8ZXrmtdqi', 1772278331, 1, '59.103.124.231', 573091200, 0, NULL),
(34, 34, 'womens-two-button-cognac-wax-leather-blazer-los-angeles', 'Women’s Two Button Cognac Wax Real Leather Blazer', 'Women’s Cognac Wax Two Button Leather Blazer', '<p>The Women&rsquo;s Two Button Cognac Wax Leather Blazer is designed for women who want timeless sophistication with modern versatility. Made from 100% real lambskin leather, it offers durability, luxury, and a rich hand‑waxed finish.</p>\r\n<p>This blazer features a classic two‑button closure, wide lapel collar, and decorative seams that define the silhouette. Functional flap pockets add practicality, while the soft polyester lining ensures comfort. Available in a warm cognac wax color, it&rsquo;s a versatile wardrobe essential that travels as well as you do.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Cognac Wax Leather Blazer is not just outerwear &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Internal Lining:</strong> Soft Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Women&rsquo;s tailored leather blazer</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Cognac Wax</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Two‑button closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Wide lapel collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two outside flap pockets, one chest pocket, one inside mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Fit:</strong> Tailored silhouette with decorative seams</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Women&rsquo;s Two Button Cognac Wax Leather Blazer is a polished, tailored piece crafted from premium lambskin leather with a hand‑waxed finish. Featuring wide lapels, decorative seams, and functional pockets, it&rsquo;s perfect for work, travel, or evenings out. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Los Angeles.</p>\r\n<div>&nbsp;</div>', 'Women’s Cognac Wax Leather Blazer – Premium Style', 'Shop the Women’s Two Button Cognac Wax Leather Blazer by SHONiR CMS, a global manufacturer and supplier of premium women’s fashion. Crafted from lambskin leather with wide lapels, two‑button closure, and tailored fit. Elegant, versatile, and durable.', 'women’s leather blazer, cognac leather blazer women, two button blazer women, lambskin leather blazer women, premium leather fashion, stylish women’s outerwear, tailored leather blazer women, versatile women’s jacket, timeless women’s fashion, durable leather blazer women, cognac wax leather blazer Los Angeles, two button leather blazer Los Angeles, premium lambskin blazer Los Angeles, stylish women’s leather blazer Los Angeles edition, durable leather blazer women Los Angeles, all‑season leather blazer Los Angeles, tailored fit leather blazer Los Angeles, women’s leather blazer with pockets Los Angeles, versatile women’s leather fashion Los Angeles, luxury women’s cognac blazer Los Angeles, timeless cognac wax leather blazer Los Angeles', 1, 'SC-502', 'KN-5019-HF', 'SQ-822706', '7321980632538', '31.10', '64.8', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769599963, 1773077819, 29, 1772931539, 1001, 1, 1772931539, 1001, 1, 1772923447, 2, 99, 5, '495', 99, '0X4pVNzQQjKi8iPu', 1772278484, 1, '59.103.124.231', 1772278709, 1, '59.103.124.231'),
(35, 35, 'womens-red-real-leather-blazer-jacket-miami', 'Women’s Red Real Leather Blazer Jacket', 'Women’s Red Leather Blazer Jacket', '<p>Step up your style with the Women&rsquo;s Red Real Leather Blazer Jacket. Made from 100% real lambskin leather, it offers durability, luxury, and a striking red finish.</p>\r\n<p>This blazer features a classic three‑button closure, front lapel collar, and full‑length sleeves for a polished silhouette. Practicality meets style with two exterior side pockets and one inner mobile pocket. Fully lined with soft polyester, it ensures comfort while maintaining structure.</p>\r\n<p>Perfect for work, evenings out, or casual chic looks, this blazer is a versatile wardrobe essential. Professional leather cleaning is recommended to maintain its rich finish.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Red Leather Blazer is not just outerwear &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Internal Lining:</strong> Soft Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Women&rsquo;s tailored leather blazer</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Red</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Classic three‑button closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Front Lapel Collar</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> 2 exterior side pockets, 1 inner mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Sleeves:</strong> Full‑length sleeves</p>\r\n</li>\r\n<li>\r\n<p><strong>Care Instructions:</strong> Professional leather cleaning only</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Women&rsquo;s Red Real Leather Blazer Jacket is a bold, tailored piece crafted from premium lambskin leather. Featuring a classic three‑button closure, lapel collar, and functional pockets, it blends elegance with a touch of edge. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Miami.</p>\r\n<div>&nbsp;</div>', 'Women’s Red Leather Blazer Jacket – Premium Style', 'Shop the Women’s Red Real Leather Blazer Jacket by SHONiR CMS, a global manufacturer and supplier of premium women’s fashion. Crafted from lambskin leather with lapel collar, three‑button closure, and tailored fit. Elegant, bold, and durable.', 'women’s leather blazer, red leather blazer women, three button blazer women, lambskin leather blazer women, premium leather fashion, stylish women’s outerwear, tailored leather blazer women, versatile women’s jacket, timeless women’s fashion, durable leather blazer women, red leather blazer Miami, three button leather blazer Miami, premium lambskin blazer Miami, stylish women’s leather blazer Miami edition, durable leather blazer women Miami, all‑season leather blazer Miami, tailored fit leather blazer Miami, women’s leather blazer with pockets Miami, versatile women’s leather fashion Miami, luxury women’s red blazer Miami, timeless red leather blazer Miami', 1, 'SC-503', 'DU-9371-XQ', 'BV-861486', '5885341792168', '06.74', '37.97', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769600092, 1773070154, 45, 1772806816, 1001, 1, 1772806816, 1001, 1, 1772493224, 1, 99, 5, '495', 99, 'azhn8LYJghJbbhJs', 1772278701, 1, '59.103.124.231', 573091200, 0, NULL),
(36, 36, 'womens-single-button-cognac-wax-leather-blazer-chicago', 'Women’s Single‑Button Lambskin Leather Blazer – Cognac Wax', 'Women’s Cognac Wax Single‑Button Leather Blazer', '<p>Achieve timeless sophistication with the Women&rsquo;s Cognac Wax Single‑Button Leather Blazer. Made from 100% real lambskin leather, it offers durability, luxury, and a smooth wax finish that adds distinct appeal.</p>\r\n<p>This blazer features a wide lapel collar, single‑button closure, and open hem cuffs with button styling. Functional flap pockets add practicality, while the soft polyester lining ensures comfort. Available in a warm cognac wax color, it&rsquo;s a versatile wardrobe essential for all seasons.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Cognac Wax Leather Blazer is not just outerwear &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Internal Lining:</strong> Soft Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Women&rsquo;s tailored leather blazer</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Cognac Wax</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Single‑button closure with wide lapel</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Open hem with button style</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two outside flap pockets, one inside pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Women&rsquo;s Cognac Wax Single‑Button Leather Blazer is a tailored piece crafted from premium lambskin leather. Featuring a sharp notch lapel, single‑button closure, and decorative seams, it delivers a clean, structured silhouette perfect for business chic or casual layering. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Chicago.</p>\r\n<div>&nbsp;</div>', 'Women’s Cognac Wax Leather Blazer – Premium Single‑Button Style', 'Shop the Women’s Cognac Wax Single‑Button Leather Blazer by SHONiR CMS, a global manufacturer and supplier of premium women’s fashion. Crafted from lambskin leather with wide lapel, single‑button closure, and tailored fit. Elegant, versatile, and durable.', 'women’s leather blazer, cognac leather blazer women, single button blazer women, lambskin leather blazer women, premium leather fashion, stylish women’s outerwear, tailored leather blazer women, versatile women’s jacket, timeless women’s fashion, durable leather blazer women, cognac wax leather blazer Chicago, single button leather blazer Chicago, premium lambskin blazer Chicago, stylish women’s leather blazer Chicago edition, durable leather blazer women Chicago, all‑season leather blazer Chicago, tailored fit leather blazer Chicago, women’s leather blazer with pockets Chicago, versatile women’s leather fashion Chicago, luxury women’s cognac blazer Chicago, timeless cognac wax leather blazer Chicago', 1, 'SC-504', 'PS-4851-DH', 'RR-357869', '8787484339035', '86.39', '172.18', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769600360, 1773077707, 2, 1773070154, 1003, 1, 1773070154, 1003, 1, 1772984222, 1, 99, 5, '495', 99, 'WCaxegpwvBgj2a0x', 1772280185, 1, '59.103.124.231', 1772280509, 1, '59.103.124.231'),
(37, 37, 'womens-three-button-camel-leather-blazer-san-francisco', 'Women’s Three Button Camel Real Leather Blazer', 'Women’s Camel Brown Three Button Leather Blazer', '<p>Crafted from 100% real lambskin leather, the Women&rsquo;s Camel Brown Three Button Blazer offers a luxurious feel and a polished, professional look.</p>\r\n<p>This blazer features a classic three‑button closure, lapel collar, and full‑length sleeves for a structured silhouette. Practicality meets style with two exterior side pockets and one inner mobile pocket. Fully lined with soft polyester, it ensures comfort while maintaining durability.</p>\r\n<p>Available in a warm camel brown finish, this blazer is a versatile wardrobe essential that pairs seamlessly with both business and casual outfits. Professional leather cleaning is recommended to preserve its rich texture and color.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Camel Leather Blazer is not just outerwear &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Internal Lining:</strong> Soft Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Women&rsquo;s tailored leather blazer</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Camel Brown</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Classic three‑button closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Collar:</strong> Lapel style</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two exterior side pockets, one inner mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Sleeves:</strong> Full‑length sleeves</p>\r\n</li>\r\n<li>\r\n<p><strong>Care Instructions:</strong> Professional leather cleaning only</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>\r\n<div>&nbsp;</div>', '<p>The Women&rsquo;s Three Button Camel Real Leather Blazer is a timeless tailored piece crafted from premium lambskin leather. Featuring a classic three‑button closure, lapel collar, and functional pockets, it delivers elegance and sophistication for work or evening wear. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in San Francisco.</p>\r\n<div>&nbsp;</div>', 'Women’s Camel Leather Blazer – Premium Three Button Style', 'Shop the Women’s Three Button Camel Leather Blazer by SHONiR CMS, a global manufacturer and supplier of premium women’s fashion. Crafted from lambskin leather with lapel collar, three‑button closure, and tailored fit. Elegant, versatile, and durable.', 'women’s leather blazer, camel leather blazer women, three button blazer women, lambskin leather blazer women, premium leather fashion, stylish women’s outerwear, tailored leather blazer women, versatile women’s jacket, timeless women’s fashion, durable leather blazer women, camel leather blazer San Francisco, three button leather blazer San Francisco, premium lambskin blazer San Francisco, stylish women’s leather blazer San Francisco edition, durable leather blazer women San Francisco, all‑season leather blazer San Francisco, tailored fit leather blazer San Francisco, women’s leather blazer with pockets San Francisco, versatile women’s leather fashion San Francisco, luxury women’s camel blazer San Francisco, timeless camel leather blazer San Francisco', 1, 'SC-505', 'KE-2129-YZ', 'FZ-897792', '9979832720510', '42.67', '55.26', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769601837, 1773077707, 48, 1772659188, 1001, 1, 1772659188, 1001, 1, 573091200, 0, 99, 5, '495', 99, 'tfZwfkLAj5sPkvWB', 1772280322, 1, '59.103.124.231', 573091200, 0, NULL),
(38, 38, 'womens-single-button-purple-leather-blazer-dallas', 'Women’s Single Button Purple Real Leather Blazer', 'Women’s Purple Single Button Leather Blazer', '<p>Create a sleek and refined look with the Women&rsquo;s Purple Single Button Leather Blazer. Made from 100% real lambskin leather, it offers durability, luxury, and a waxed finish that adds character.</p>\r\n<p>This blazer features a wide lapel collar, single‑button closure, and open hem cuffs with button styling. Functional flap pockets add practicality, while the soft polyester lining ensures comfort. Available in a striking purple color, it&rsquo;s a versatile wardrobe essential for all seasons.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Purple Leather Blazer is not just outerwear &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Internal Lining:</strong> Soft Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Women&rsquo;s tailored leather blazer</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Purple</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Single‑button closure with wide lapel</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Open hem with button style</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two outside flap pockets, one inside pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>\r\n<div>&nbsp;</div>', '<p>The Women&rsquo;s Purple Single Button Leather Blazer is a bold, tailored piece crafted from premium lambskin leather. Featuring a crisp notch lapel, single‑button closure, and flap pockets, it blends business‑ready structure with relaxed styling. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Dallas.</p>\r\n<div>&nbsp;</div>', 'Women’s Purple Leather Blazer – Premium Single Button Style', 'Shop the Women’s Purple Single Button Leather Blazer by SHONiR CMS, a global manufacturer and supplier of premium women’s fashion. Crafted from lambskin leather with wide lapel, single‑button closure, and tailored fit. Elegant, bold, and durable.', 'women’s leather blazer, purple leather blazer women, single button blazer women, lambskin leather blazer women, premium leather fashion, stylish women’s outerwear, tailored leather blazer women, versatile women’s jacket, timeless women’s fashion, durable leather blazer women, purple leather blazer Dallas, single button leather blazer Dallas, premium lambskin blazer Dallas, stylish women’s leather blazer Dallas edition, durable leather blazer women Dallas, all‑season leather blazer Dallas, tailored fit leather blazer Dallas, women’s leather blazer with pockets Dallas, versatile women’s leather fashion Dallas, luxury women’s purple blazer Dallas, timeless purple leather blazer Dallas', 1, 'SC-506', 'LR-9575-LG', 'BJ-439696', '9048433343748', '52.90', '141.78', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769601929, 1773077707, 65, 1772590666, 1000, 1, 1772590666, 1000, 1, 573091200, 0, 99, 5, '495', 99, 'LYRjnQEn5KS5x6Xn', 1772280427, 1, '59.103.124.231', 1772280643, 1, '59.103.124.231');
INSERT INTO `tbl_items` (`item_id`, `sort_order`, `slug`, `title`, `name`, `description`, `spotlight`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `model`, `sku`, `mpn`, `gtin`, `price`, `price_previous`, `minimum`, `maximum`, `stock`, `featured`, `newbie`, `hd`, `lq`, `st`, `searchable`, `listed`, `removable`, `launch_year`, `published_time`, `last_view_time`, `today_views`, `statistics_update`, `lifetime_views`, `today_hits`, `last_hit_time`, `lifetime_hits`, `today_carts`, `last_cart_time`, `lifetime_carts`, `votes`, `ratings`, `scores`, `likes`, `token`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(39, 39, 'hazel-womens-two-button-black-leather-blazer-new-york', 'Hazel Women’s Two Button Black Real Leather Blazer', 'Women’s Hazel Black Two Button Leather Blazer', '<p>The Hazel Women&rsquo;s Two Button Black Leather Blazer delivers timeless sophistication with modern practicality. Made from 100% real lambskin leather, it offers durability, luxury, and a sleek black finish.</p>\r\n<p>This blazer features a wide lapel collar, two‑button closure, and open hem cuffs for a refined silhouette. Functional flap pockets add practicality, while the soft polyester lining ensures comfort. Lightweight and versatile, it&rsquo;s designed for all‑season wear, making it ideal for work, travel, or evening outings.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Hazel Leather Blazer is not just outerwear &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> 100% Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Internal Lining:</strong> Soft Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Women&rsquo;s tailored leather blazer</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Wide lapel with two‑button closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Open hem</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two outside flap pockets, one inside pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> Lightweight, all‑season</p>\r\n</li>\r\n</ul>', '<p>The Hazel Women&rsquo;s Two Button Black Leather Blazer is a polished, tailored piece crafted from premium lambskin leather. Featuring a wide lapel, two‑button closure, and flap pockets, it&rsquo;s the perfect office companion for professional and constantly traveling women. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in New York.</p>\r\n<div>&nbsp;</div>', 'Hazel Black Leather Blazer – Premium Two Button Style', 'Shop the Hazel Women’s Two Button Black Leather Blazer by SHONiR CMS, a global manufacturer and supplier of premium women’s fashion. Crafted from lambskin leather with wide lapel, two‑button closure, and tailored fit. Elegant, versatile, and durable.', 'women’s leather blazer, black leather blazer women, two button blazer women, lambskin leather blazer women, premium leather fashion, stylish women’s outerwear, tailored leather blazer women, versatile women’s jacket, timeless women’s fashion, durable leather blazer women, Hazel leather blazer New York, black two button leather blazer New York, premium lambskin blazer New York, stylish women’s leather blazer New York edition, durable leather blazer women New York, all‑season leather blazer New York, tailored fit leather blazer New York, women’s leather blazer with pockets New York, versatile women’s leather fashion New York, luxury women’s black blazer New York, timeless Hazel leather blazer New York', 1, 'SC-507', 'LT-5433-MC', 'BE-486669', '8923322837705', '86.13', '108.72', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769602153, 1773077707, 29, 1772968640, 1002, 1, 1772968640, 1002, 1, 573091200, 0, 99, 5, '495', 99, 'HGVy2eWGt5LwL8dD', 1772280650, 1, '59.103.124.231', 1772280846, 1, '59.103.124.231'),
(40, 40, 'womens-black-two-button-leather-blazer-jacket-chicago', 'Women’s Black Two Button Leather Blazer Jacket', 'Women’s Black Two Button Leather Blazer', '<p>Tailored to perfection, the Women&rsquo;s Black Two Button Leather Blazer Jacket seamlessly combines the luxurious feel of lambskin leather with the classic silhouette of a blazer.</p>\r\n<p>This semi‑formal design features a broad lapel, two‑button closure, and decorative seams for a polished finish. Functional side pockets and an inner mobile pocket add practicality, while the soft polyester lining ensures comfort.</p>\r\n<p>Available in a timeless black color, this blazer is versatile enough for business meetings, casual outings, or evening wear. The open cuff design adds a sleek, modern touch.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. The Black Leather Blazer is not just outerwear &mdash; it&rsquo;s a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Real Lambskin Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Internal Lining:</strong> Soft Polyester</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Women&rsquo;s tailored leather blazer</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Classic Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Two‑button closure with broad lapel, decorative seams</p>\r\n</li>\r\n<li>\r\n<p><strong>Pockets:</strong> Two side pockets, one inner mobile pocket</p>\r\n</li>\r\n<li>\r\n<p><strong>Cuffs:</strong> Open cuff design</p>\r\n</li>\r\n<li>\r\n<p><strong>Fit:</strong> Semi‑formal tailored silhouette</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Women&rsquo;s Black Two Button Leather Blazer Jacket is a tailored piece crafted from premium lambskin leather. Featuring decorative seams, broad lapel, and functional pockets, it blends sophistication with versatility. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Chicago.</p>\r\n<div>&nbsp;</div>', 'Women’s Black Leather Blazer – Premium Two Button Style', 'Shop the Women’s Black Two Button Leather Blazer Jacket by SHONiR CMS, a global manufacturer and supplier of premium women’s fashion. Crafted from lambskin leather with broad lapel, two‑button closure, and tailored fit. Elegant, versatile, and durable.', 'women’s leather blazer, black leather blazer women, two button blazer women, lambskin leather blazer women, premium leather fashion, stylish women’s outerwear, tailored leather blazer women, versatile women’s jacket, timeless women’s fashion, durable leather blazer women, black leather blazer Chicago, two button leather blazer Chicago, premium lambskin blazer Chicago, stylish women’s leather blazer Chicago edition, durable leather blazer women Chicago, all‑season leather blazer Chicago, tailored fit leather blazer Chicago, women’s leather blazer with pockets Chicago, versatile women’s leather fashion Chicago, luxury women’s black blazer Chicago, timeless black leather blazer Chicago', 1, 'SC-508', 'LS-2998-UU', 'ZW-156385', '2834297466570', '80.67', '146.15', 10, 1000, 100, 0, 1, 0, 0, 0, 1, 1, 1, 2026, 1769602271, 1773070154, 55, 1772806828, 1000, 1, 1772806828, 1000, 1, 573091200, 0, 99, 5, '495', 99, '5ZC23zWNaxTw2Syk', 1772280761, 1, '59.103.124.231', 573091200, 0, NULL),
(41, 41, 'tan-brown-leather-chunky-brogues-boston', 'Tan Brown Standard Fit Leather Contrast Sole Chunky Brogues Shoes', 'Men’s Tan Brown Leather Chunky Brogues', '<p>Step into sophistication with the Tan Brown Standard Fit Leather Contrast Sole Chunky Brogues Shoes. Designed with a smooth leather upper and perforated brogue detailing, these shoes deliver a polished look for formal occasions and professional settings.</p>\r\n<p>The Ortholite cushioned footbed ensures all‑day comfort, while the sturdy welt stitch sole provides durability and support. Crafted with a leather upper, leather/textile lining, and a contrast sole, these brogues balance elegance with practicality.</p>\r\n<p>Perfect for pairing with suits or smart casual outfits, they are a versatile wardrobe essential for men who value both style and comfort.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. These Chunky Brogues are not just shoes &mdash; they&rsquo;re a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Material:</strong> Leather Upper / Leather &amp; Textile Lining / Other Materials Sole</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Tan Brown</p>\r\n</li>\r\n<li>\r\n<p><strong>Fit:</strong> Standard Fit</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Perforated Wingtip Detailing</p>\r\n</li>\r\n<li>\r\n<p><strong>Insole:</strong> Ortholite Cushioned Footbed</p>\r\n</li>\r\n<li>\r\n<p><strong>Closure:</strong> Lace‑up</p>\r\n</li>\r\n<li>\r\n<p><strong>Sole:</strong> Durable Welted Contrast Sole</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Chunky Brogues</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Tan Brown Standard Fit Leather Chunky Brogues are a timeless footwear choice, crafted from premium leather with perforated wingtip detailing. Featuring an Ortholite cushioned footbed and durable welted sole, they combine classic style with modern comfort. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Boston.</p>\r\n<div>&nbsp;</div>', 'Tan Brown Leather Chunky Brogues – Premium Men’s Style', 'Shop the Tan Brown Standard Fit Leather Chunky Brogues Shoes by SHONiR CMS, a global manufacturer and supplier of premium men’s footwear. Crafted with leather upper, Ortholite footbed, and durable welted sole. Elegant, versatile, and durable.', 'men’s leather brogues, tan brown brogues shoes, chunky leather brogues men, premium leather footwear men, stylish men’s formal shoes, durable welted sole shoes, Ortholite footbed brogues, classic wingtip brogues men, versatile men’s leather shoes, timeless men’s fashion, tan brown brogues Boston, leather chunky brogues Boston, premium men’s brogues Boston, stylish men’s leather shoes Boston edition, durable leather brogues Boston, all‑season leather brogues Boston, tailored fit brogues Boston, men’s leather shoes with Ortholite Boston, versatile men’s leather fashion Boston, luxury men’s tan brogues Boston, timeless chunky brogues Boston', 1, 'SC-601', 'ZY-7022-RC', 'RY-978538', '9899899727317', '31.03', '71.5', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769602549, 1773077707, 244, 573091200, 999, 99, 573091200, 999, 0, 573091200, 0, 99, 5, '495', 99, 'BB7H9gUq4Cqs8qFg', 1772281077, 1, '59.103.124.231', 573091200, 0, NULL),
(42, 42, 'brown-suedette-derby-shoes-philadelphia', 'Brown Suedette Derby Shoes', 'Men’s Brown Suedette Derby Shoes', '<p>Step into sophistication with the Brown Suedette Derby Shoes. Designed with a textile and synthetic upper, these shoes offer a polished look that pairs seamlessly with suits or smart casual outfits.</p>\r\n<p>The derby silhouette ensures a comfortable fit, while the sturdy sole provides durability for everyday wear. With a lining and sock made from textile and other materials, these shoes balance elegance with practicality.</p>\r\n<p>Perfect for professional settings or evening outings, they are a versatile wardrobe essential for men who value both style and comfort.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. These Derby Shoes are not just footwear &mdash; they&rsquo;re a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Upper:</strong> Textile &amp; Other Materials</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining &amp; Sock:</strong> Textile &amp; Other Materials</p>\r\n</li>\r\n<li>\r\n<p><strong>Sole:</strong> Other Materials</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Brown</p>\r\n</li>\r\n<li>\r\n<p><strong>Silhouette:</strong> Derby</p>\r\n</li>\r\n<li>\r\n<p><strong>Fit:</strong> Standard</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Formal / Smart Casual</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Brown Suedette Derby Shoes are a refined footwear choice, crafted with a textile and synthetic upper for a sleek finish. Featuring a durable sole and classic derby silhouette, they deliver timeless style for formal and smart‑casual occasions. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Philadelphia.</p>\r\n<div>&nbsp;</div>', 'Brown Suedette Derby Shoes – Premium Men’s Style', 'Shop the Brown Suedette Derby Shoes by SHONiR CMS, a global manufacturer and supplier of premium men’s footwear. Crafted with textile and synthetic upper, durable sole, and classic derby silhouette. Elegant, versatile, and durable.', 'men’s derby shoes, brown suedette derby shoes, premium men’s footwear, stylish men’s formal shoes, durable derby shoes men, classic men’s derby silhouette, versatile men’s leather shoes, timeless men’s fashion, brown derby shoes Philadelphia, suedette derby shoes Philadelphia, premium men’s derby shoes Philadelphia, stylish men’s footwear Philadelphia edition, durable derby shoes Philadelphia, all‑season derby shoes Philadelphia, tailored fit derby shoes Philadelphia, men’s suedette shoes Philadelphia, versatile men’s fashion Philadelphia, luxury men’s brown derby shoes Philadelphia, timeless suedette derby shoes Philadelphia', 1, 'SC-602', 'JD-0135-RS', 'LA-196535', '5169677457841', '59.13', '132', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769602697, 1773077819, 66, 1772590574, 1000, 1, 1772590574, 1000, 1, 573091200, 0, 99, 5, '495', 99, 'C44RNsxEBC0PCQGN', 1772281193, 1, '59.103.124.231', 573091200, 0, NULL),
(43, 43, 'black-double-monk-toe-cap-shoes-los-angeles', 'Black Double Monk Toe Cap Shoes', 'Men’s Black Double Monk Toe Cap Shoes', '<p>Add a unique edge to your formal wardrobe with the Black Double Monk Toe Cap Shoes. Designed with a faux leather upper and panel detailing, these shoes feature a dual buckle monk fastening for a refined look.</p>\r\n<p>The Ortholite foam footbed ensures cushioned comfort throughout the day, while the durable outsole provides long‑lasting wear. With a sleek monk design and toe cap finish, these shoes are perfect for pairing with suits or smart casual outfits.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. These Monk Shoes are not just footwear &mdash; they&rsquo;re a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Upper:</strong> Faux Leather (Other Materials)</p>\r\n</li>\r\n<li>\r\n<p><strong>Panel Detail:</strong> Decorative overlays</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Monk style with toe cap</p>\r\n</li>\r\n<li>\r\n<p><strong>Fastening:</strong> Dual buckle closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Insole:</strong> Ortholite Foam Footbed</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining &amp; Sock:</strong> Other Materials &amp; Textile</p>\r\n</li>\r\n<li>\r\n<p><strong>Sole:</strong> Durable Outsole (Other Materials)</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Formal / Smart Casual</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Black Double Monk Toe Cap Shoes are a stylish, modern twist on classic formal footwear. Crafted with a faux leather upper, panel overlays, and dual buckle fastening, they deliver sophistication with comfort. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Los Angeles.</p>\r\n<div>&nbsp;</div>', 'Black Double Monk Toe Cap Shoes – Premium Men’s Style', 'Shop the Black Double Monk Toe Cap Shoes by SHONiR CMS, a global manufacturer and supplier of premium men’s footwear. Crafted with faux leather upper, dual buckle fastening, Ortholite footbed, and durable outsole. Elegant, versatile, and durable.', 'men’s monk shoes, black monk toe cap shoes, double buckle monk shoes men, premium men’s footwear, stylish men’s formal shoes, durable monk shoes men, Ortholite footbed monk shoes, classic monk design men, versatile men’s leather shoes, timeless men’s fashion, black monk shoes Los Angeles, double monk toe cap shoes Los Angeles, premium men’s monk shoes Los Angeles, stylish men’s footwear Los Angeles edition, durable monk shoes Los Angeles, all‑season monk shoes Los Angeles, tailored fit monk shoes Los Angeles, men’s monk shoes with Ortholite Los Angeles, versatile men’s leather fashion Los Angeles, luxury men’s black monk shoes Los Angeles, timeless double monk shoes Los Angeles', 1, 'SC-603', 'KP-8019-LE', 'TP-846375', '3426380030963', '24.94', '62.91', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769602838, 1773077819, 25, 1772856154, 1000, 1, 1772659085, 1000, 1, 1772856154, 1, 99, 5, '495', 99, 'ybWM1g05k5tKr4B1', 1772281334, 1, '59.103.124.231', 573091200, 0, NULL),
(44, 44, 'black-wide-fit-leather-plain-derby-shoes-houston', 'Black Wide Fit Leather Plain Derby Shoes', 'Men’s Black Wide Fit Leather Derby Shoes', '<p>Our Black Wide Fit Leather Derby Shoes are designed for men who value both style and comfort. Crafted from genuine leather, they offer a sleek, polished finish that pairs effortlessly with formal and smart‑casual outfits.</p>\r\n<p>The classic lace‑up derby silhouette ensures a secure fit, while the Ortholite foam sole provides cushioned support for all‑day wear. With a wide fit design, these shoes deliver extra comfort without compromising on elegance.</p>\r\n<p>Perfect for work, weddings, or evenings out, these Derby shoes are versatile wardrobe essentials.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. These Derby Shoes are not just footwear &mdash; they&rsquo;re a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Upper:</strong> Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining &amp; Sock:</strong> Textile &amp; Other Materials</p>\r\n</li>\r\n<li>\r\n<p><strong>Sole:</strong> Other Materials</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Silhouette:</strong> Derby</p>\r\n</li>\r\n<li>\r\n<p><strong>Fit:</strong> Wide Fit</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Plain lace‑up style</p>\r\n</li>\r\n<li>\r\n<p><strong>Insole:</strong> Ortholite Foam for comfort</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Formal / Smart Casual</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Black Wide Fit Leather Derby Shoes are a timeless footwear choice, crafted from genuine leather with a polished finish. Featuring a lace‑up design, Ortholite foam sole, and wide fit comfort, they deliver sophistication and ease for all‑day wear. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Houston.</p>\r\n<div>&nbsp;</div>', 'Black Wide Fit Leather Derby Shoes – Premium Men’s Style', 'Shop the Black Wide Fit Leather Derby Shoes by SHONiR CMS, a global manufacturer and supplier of premium men’s footwear. Crafted with genuine leather upper, Ortholite foam sole, and wide fit comfort. Elegant, versatile, and durable.', 'men’s derby shoes, black leather derby shoes, wide fit derby shoes men, premium leather footwear men, stylish men’s formal shoes, durable derby shoes men, Ortholite foam derby shoes, classic lace‑up derby men, versatile men’s leather shoes, timeless men’s fashion, black derby shoes Houston, wide fit leather derby Houston, premium men’s derby shoes Houston, stylish men’s footwear Houston edition, durable derby shoes Houston, all‑season derby shoes Houston, tailored fit derby shoes Houston, men’s leather shoes with Ortholite Houston, versatile men’s leather fashion Houston, luxury men’s black derby shoes Houston, timeless wide fit derby shoes Houston', 1, 'SC-604', 'CL-7721-RB', 'MV-997632', '9339513056148', '55.01', '141.58', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769602957, 1773077819, 22, 1772968651, 1004, 1, 1772968651, 1004, 1, 573091200, 0, 99, 5, '495', 99, 'QKZM4AUpm5tVtRVR', 1772281413, 1, '59.103.124.231', 573091200, 0, NULL),
(45, 45, 'black-standard-fit-patent-oxford-toe-cap-shoes-new-york', 'Black Standard Fit Patent Oxford Toe Cap Shoes', 'Men’s Black Patent Oxford Toe Cap Shoes', '<p>Elevate your formal footwear rotation with the Black Standard Fit Patent Oxford Toe Cap Shoes. Crafted with a high‑shine patent upper, these shoes feature a classic lace‑up fastening, derby overlays, and a refined toe cap design.</p>\r\n<p>The textile lining ensures comfort, while the durable rubber outsole provides long‑lasting wear. Perfect for weddings, business events, or evenings out, these shoes combine elegance with practicality.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. These Oxford Shoes are not just footwear &mdash; they&rsquo;re a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Upper:</strong> Patent Faux Leather (Other Materials)</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Derby overlays with toe cap</p>\r\n</li>\r\n<li>\r\n<p><strong>Fastening:</strong> Lace‑up closure</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining &amp; Sock:</strong> Textile &amp; Other Materials</p>\r\n</li>\r\n<li>\r\n<p><strong>Sole:</strong> Durable Rubber Outsole (Other Materials)</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Fit:</strong> Standard Fit</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Oxford Formal Shoes</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Black Standard Fit Patent Oxford Toe Cap Shoes are a polished, high‑shine choice for formal occasions. Featuring a patent upper, lace‑up fastening, and durable rubber sole, they deliver timeless sophistication with modern comfort. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in New York.</p>\r\n<div>&nbsp;</div>', 'Black Patent Oxford Toe Cap Shoes – Premium Men’s Style', 'Shop the Black Standard Fit Patent Oxford Toe Cap Shoes by SHONiR CMS, a global manufacturer and supplier of premium men’s footwear. Crafted with patent upper, lace‑up fastening, toe cap design, and durable rubber sole. Elegant, versatile, and durable.', 'men’s oxford shoes, black patent oxford shoes, toe cap oxford shoes men, premium men’s footwear, stylish men’s formal shoes, durable oxford shoes men, patent leather oxford shoes, classic lace‑up oxford men, versatile men’s leather shoes, timeless men’s fashion, black oxford shoes New York, patent toe cap oxford New York, premium men’s oxford shoes New York, stylish men’s footwear New York edition, durable oxford shoes New York, all‑season oxford shoes New York, tailored fit oxford shoes New York, men’s patent shoes New York, versatile men’s leather fashion New York, luxury men’s black oxford shoes New York, timeless patent oxford shoes New York', 1, 'SC-605', 'TR-9441-BU', 'CU-089065', '5112023113863', '62.50', '132.72', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769603047, 1773077819, 30, 1772923428, 1001, 1, 1772806808, 1001, 1, 1772923428, 1, 99, 5, '495', 99, 'PMEDFEtpSpkixAqx', 1772281529, 1, '59.103.124.231', 573091200, 0, NULL),
(46, 46, 'black-wide-fit-leather-oxford-toecap-shoes-san-diego', 'Black Wide Fit Leather Oxford Toecap Shoes', 'Men’s Black Wide Fit Leather Oxford Shoes', '<p>Step into elegance with the Black Wide Fit Leather Oxford Toecap Shoes. Designed with a genuine leather upper, these shoes feature a pointed toe and classic lace‑up fastening for a polished finish.</p>\r\n<p>The Ortholite foam insole ensures cushioned comfort throughout the day, while the flat, durable sole provides long‑lasting wear. With a wide fit design, these Oxfords offer extra comfort without compromising on style.</p>\r\n<p>Perfect for business meetings, weddings, or evening outings, they are versatile wardrobe essentials for men who value both sophistication and practicality.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. These Oxford Shoes are not just footwear &mdash; they&rsquo;re a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Upper:</strong> Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining &amp; Sock:</strong> Textile &amp; Other Materials</p>\r\n</li>\r\n<li>\r\n<p><strong>Sole:</strong> Other Materials</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Black</p>\r\n</li>\r\n<li>\r\n<p><strong>Fit:</strong> Wide Fit</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Pointed toe with toecap</p>\r\n</li>\r\n<li>\r\n<p><strong>Fastening:</strong> Lace‑up style</p>\r\n</li>\r\n<li>\r\n<p><strong>Insole:</strong> Ortholite Foam for comfort</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Oxford Formal Shoes</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Black Wide Fit Leather Oxford Toecap Shoes are a refined footwear choice, crafted from genuine leather with a pointed toe and lace‑up fastening. Featuring Ortholite foam cushioning and a durable sole, they deliver timeless sophistication with extra comfort. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in San Diego.</p>\r\n<div>&nbsp;</div>', 'Black Wide Fit Leather Oxford Shoes – Premium Men’s Style', 'Shop the Black Wide Fit Leather Oxford Toecap Shoes by SHONiR CMS, a global manufacturer and supplier of premium men’s footwear. Crafted with genuine leather upper, lace‑up fastening, Ortholite foam insole, and durable sole. Elegant, versatile, and durable.', 'men’s oxford shoes, black leather oxford shoes, wide fit oxford shoes men, premium leather footwear men, stylish men’s formal shoes, durable oxford shoes men, Ortholite foam oxford shoes, classic lace‑up oxford men, versatile men’s leather shoes, timeless men’s fashion, black oxford shoes San Diego, wide fit leather oxford San Diego, premium men’s oxford shoes San Diego, stylish men’s footwear San Diego edition, durable oxford shoes San Diego, all‑season oxford shoes San Diego, tailored fit oxford shoes San Diego, men’s leather shoes with Ortholite San Diego, versatile men’s leather fashion San Diego, luxury men’s black oxford shoes San Diego, timeless wide fit oxford shoes San Diego', 1, 'SC-606', 'GF-6342-VT', 'XM-141622', '9591236104152', '03.53', '35.01', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769603147, 1773077819, 8, 1773005467, 1002, 1, 1773005467, 1002, 1, 573091200, 0, 99, 5, '495', 99, '0DjFNJe3bbuKaybQ', 1772281627, 1, '59.103.124.231', 573091200, 0, NULL),
(47, 47, 'navy-blue-suede-desert-shoes-seattle', 'Navy Blue Suede Desert Shoes', 'Men’s Navy Blue Suede Desert Shoes', '<p>Perfect for both formal and smart‑casual outfits, the Navy Blue Suede Desert Shoes combine timeless style with modern comfort. Designed with a suede leather upper, lace‑up fastening, and stitched welt, they offer durability and elegance.</p>\r\n<p>The Ortholite cushioned footbed ensures all‑day comfort, while the durable outsole provides long‑lasting wear. With a round toe silhouette and refined craftsmanship, these shoes are ideal for pairing with suits, chinos, or tailored casual looks.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. These Desert Shoes are not just footwear &mdash; they&rsquo;re a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Upper:</strong> Suede Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining &amp; Sock:</strong> Textile &amp; Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Sole:</strong> Other Materials</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Navy Blue</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Round toe with stitched welt</p>\r\n</li>\r\n<li>\r\n<p><strong>Fastening:</strong> Lace‑up style</p>\r\n</li>\r\n<li>\r\n<p><strong>Insole:</strong> Ortholite Cushioned Footbed</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Desert Shoes (Smart Casual / Formal)</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Navy Blue Suede Desert Shoes are a versatile footwear choice, crafted from premium suede leather with a lace‑up fastening and round toe design. Featuring an Ortholite cushioned footbed and durable outsole, they deliver comfort and sophistication for smart‑casual and formal looks. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Seattle.</p>\r\n<div>&nbsp;</div>', 'Navy Blue Suede Desert Shoes – Premium Men’s Style', 'Shop the Navy Blue Suede Desert Shoes by SHONiR CMS, a global manufacturer and supplier of premium men’s footwear. Crafted with suede leather upper, lace‑up fastening, Ortholite footbed, and durable outsole. Elegant, versatile, and durable.', 'men’s desert shoes, navy suede desert shoes, premium suede footwear men, stylish men’s formal shoes, durable suede shoes men, Ortholite footbed desert shoes, classic lace‑up desert men, versatile men’s suede shoes, timeless men’s fashion, navy desert shoes Seattle, suede desert shoes Seattle, premium men’s suede shoes Seattle, stylish men’s footwear Seattle edition, durable desert shoes Seattle, all‑season desert shoes Seattle, tailored fit desert shoes Seattle, men’s suede shoes with Ortholite Seattle, versatile men’s suede fashion Seattle, luxury men’s navy desert shoes Seattle, timeless suede desert shoes Seattle', 1, 'SC-607', 'WX-8835-AZ', 'TP-232291', '2865956310396', '62.64', '84.66', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769603248, 1773077707, 4, 1773028593, 1001, 1, 1773005283, 1001, 1, 1773028593, 1, 99, 5, '495', 99, 'FSdiCqycJ1UUTsZM', 1772281767, 1, '59.103.124.231', 573091200, 0, NULL),
(48, 48, 'mink-brown-suede-brogue-shoes-atlanta', 'Mink Brown Suede Brogue Shoes', 'Men’s Mink Brown Suede Brogue Shoes', '<p>Step into sophistication with the Mink Brown Suede Brogue Shoes. Designed with a leather upper, textile and leather lining, and a sturdy sole, these shoes combine traditional craftsmanship with modern comfort.</p>\r\n<p>The brogue silhouette ensures a polished look, while the durable sole provides long‑lasting wear. Perfect for pairing with suits, tailored trousers, or smart casual outfits, they are versatile wardrobe essentials for men who value both style and practicality.</p>\r\n<p>As a <strong>global manufacturer, exporter, and supplier</strong>, SHONiR CMS guarantees premium craftsmanship and worldwide delivery. These Brogue Shoes are not just footwear &mdash; they&rsquo;re a statement of quality, reliability, and international trust.</p>\r\n<div>&nbsp;</div>\r\n<h3>📋 Specifications</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Upper:</strong> Leather</p>\r\n</li>\r\n<li>\r\n<p><strong>Lining &amp; Sock:</strong> Leather &amp; Textile</p>\r\n</li>\r\n<li>\r\n<p><strong>Sole:</strong> Other Materials</p>\r\n</li>\r\n<li>\r\n<p><strong>Color:</strong> Mink Brown</p>\r\n</li>\r\n<li>\r\n<p><strong>Design:</strong> Classic brogue detailing</p>\r\n</li>\r\n<li>\r\n<p><strong>Silhouette:</strong> Brogue Shoes</p>\r\n</li>\r\n<li>\r\n<p><strong>Style:</strong> Formal / Smart Casual</p>\r\n</li>\r\n<li>\r\n<p><strong>Seasonal Wear:</strong> All‑season</p>\r\n</li>\r\n</ul>', '<p>The Mink Brown Suede Brogue Shoes are a timeless footwear choice, crafted from premium leather with classic brogue detailing. Featuring a durable sole and refined silhouette, they deliver elegance and comfort for both formal and smart‑casual occasions. Proudly manufactured, exported, and supplied worldwide by SHONiR CMS &mdash; now available in Atlanta.</p>\r\n<div>&nbsp;</div>', 'Mink Brown Suede Brogue Shoes – Premium Men’s Style', 'Shop the Mink Brown Suede Brogue Shoes by SHONiR CMS, a global manufacturer and supplier of premium men’s footwear. Crafted with leather upper, brogue detailing, and durable sole. Elegant, versatile, and durable.', 'men’s brogue shoes, mink brown brogues shoes, suede brogue shoes men, premium leather footwear men, stylish men’s formal shoes, durable brogue shoes men, classic brogue design men, versatile men’s leather shoes, timeless men’s fashion, mink brown brogues Atlanta, suede brogue shoes Atlanta, premium men’s brogues Atlanta, stylish men’s footwear Atlanta edition, durable brogue shoes Atlanta, all‑season brogue shoes Atlanta, tailored fit brogues Atlanta, men’s leather shoes Atlanta, versatile men’s leather fashion Atlanta, luxury men’s mink brogues Atlanta, timeless suede brogues Atlanta', 1, 'SC-608', 'HC-9178-GH', 'TP-112829', '4131215980895', '37.34', '114.91', 10, 1000, 100, 0, 0, 0, 0, 0, 1, 1, 1, 2026, 1769603408, 1773070154, 26, 1772961090, 1002, 1, 1772806873, 1002, 1, 1772961090, 2, 99, 5, '495', 99, 'wyjkzFk8B0M262Bz', 1772281862, 1, '59.103.124.231', 573091200, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items_to_awards`
--

CREATE TABLE `tbl_items_to_awards` (
  `item_id` int(11) NOT NULL,
  `award_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items_to_brands`
--

CREATE TABLE `tbl_items_to_brands` (
  `item_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items_to_categories`
--

CREATE TABLE `tbl_items_to_categories` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_items_to_categories`
--

INSERT INTO `tbl_items_to_categories` (`item_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(2, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(7, 1),
(5, 1),
(6, 1),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(31, 4),
(33, 5),
(34, 5),
(35, 5),
(34, 5),
(36, 5),
(37, 5),
(38, 5),
(36, 5),
(38, 5),
(39, 5),
(40, 5),
(39, 5),
(41, 6),
(42, 6),
(43, 6),
(44, 6),
(45, 6),
(46, 6),
(47, 6),
(48, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items_to_industries`
--

CREATE TABLE `tbl_items_to_industries` (
  `item_id` int(11) NOT NULL,
  `industry_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items_to_natives`
--

CREATE TABLE `tbl_items_to_natives` (
  `item_id` int(11) NOT NULL,
  `native_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items_to_places`
--

CREATE TABLE `tbl_items_to_places` (
  `item_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items_to_regions`
--

CREATE TABLE `tbl_items_to_regions` (
  `item_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items_to_sections`
--

CREATE TABLE `tbl_items_to_sections` (
  `item_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items_to_talents`
--

CREATE TABLE `tbl_items_to_talents` (
  `item_id` int(11) NOT NULL,
  `talent_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items_to_voices`
--

CREATE TABLE `tbl_items_to_voices` (
  `item_id` int(11) NOT NULL,
  `voice_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_likes`
--

CREATE TABLE `tbl_likes` (
  `like_id` int(11) NOT NULL,
  `parent_type` varchar(190) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_links`
--

CREATE TABLE `tbl_links` (
  `link_id` int(11) NOT NULL,
  `category_id` int(1) NOT NULL DEFAULT 0,
  `parent_type` varchar(190) NOT NULL DEFAULT '''items''',
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `host_id` int(11) NOT NULL DEFAULT 0,
  `type_id` tinyint(1) NOT NULL DEFAULT 0,
  `url` text DEFAULT NULL,
  `quality_id` int(11) NOT NULL DEFAULT 0,
  `duration` varchar(190) NOT NULL DEFAULT '''12:34:56''',
  `file_size` varchar(190) NOT NULL DEFAULT '''12.34 GB''',
  `part_id` tinyint(1) NOT NULL DEFAULT 0,
  `part` varchar(190) NOT NULL DEFAULT '''1''',
  `public_id` varchar(190) NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 99,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 999,
  `today_hits` int(11) NOT NULL DEFAULT 99,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `lifetime_hits` int(11) NOT NULL DEFAULT 999,
  `votes` int(11) NOT NULL DEFAULT 99,
  `ratings` int(11) NOT NULL DEFAULT 5,
  `scores` varchar(190) NOT NULL DEFAULT '495',
  `likes` int(11) NOT NULL DEFAULT 99,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mails_queues`
--

CREATE TABLE `tbl_mails_queues` (
  `mail_queue_id` int(11) NOT NULL,
  `to_name` text DEFAULT NULL,
  `to_email` text DEFAULT NULL,
  `mail_subject` text DEFAULT NULL,
  `mail_content` mediumtext DEFAULT NULL,
  `mail_attachments` mediumtext DEFAULT NULL,
  `mail_type` varchar(190) DEFAULT 'text',
  `last_try_time` int(11) UNSIGNED NOT NULL DEFAULT 573136426,
  `total_try` int(11) NOT NULL DEFAULT 0,
  `priority` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) DEFAULT 0,
  `last_error` mediumtext NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `parent_type` varchar(190) DEFAULT NULL,
  `mail_server_id` int(11) NOT NULL DEFAULT 0,
  `add_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mails_servers`
--

CREATE TABLE `tbl_mails_servers` (
  `mail_server_id` int(11) NOT NULL,
  `hostname` varchar(190) DEFAULT NULL,
  `email` varchar(190) DEFAULT NULL,
  `username` varchar(190) DEFAULT NULL,
  `password` varchar(190) DEFAULT NULL,
  `port` varchar(190) DEFAULT NULL,
  `crypto` varchar(190) DEFAULT NULL,
  `priority` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `last_error` mediumtext DEFAULT NULL,
  `total_used` int(11) NOT NULL DEFAULT 0,
  `succeed` int(11) NOT NULL DEFAULT 0,
  `failed` int(11) NOT NULL DEFAULT 0,
  `relay` int(11) NOT NULL DEFAULT 5,
  `sent` int(11) NOT NULL DEFAULT 0,
  `relay_type` tinyint(1) NOT NULL DEFAULT 3,
  `last_used_time` int(10) UNSIGNED NOT NULL DEFAULT 573091200,
  `reset_time` int(10) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_error_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_mails_servers`
--

INSERT INTO `tbl_mails_servers` (`mail_server_id`, `hostname`, `email`, `username`, `password`, `port`, `crypto`, `priority`, `status`, `last_error`, `total_used`, `succeed`, `failed`, `relay`, `sent`, `relay_type`, `last_used_time`, `reset_time`, `last_error_time`, `removable`, `token`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(1, 'smtp-pulse.com', 'info@customsportswears.com', 'info@customsportswears.com', 'C3GP3NJbjCDoi2', '465', 'SSL', 7, 1, NULL, 222, 222, 0, 5, 0, 3, 1769376531, 1773078313, 573091200, 1, NULL, 573091200, 0, NULL, 573091200, 0, NULL),
(2, 'smtp-pulse.com', 'info@customsportswears.com', 'info@customsportswears.com', 'C3GP3NJbjCDoi2', '587', 'TLS', 8, 1, NULL, 223, 223, 0, 5, 0, 3, 1769433059, 1773078313, 573091200, 1, NULL, 573091200, 0, NULL, 573091200, 0, NULL),
(3, 'hn.celebiz.com', 'notify@customsportswears.com', 'notify@customsportswears.com', 'nNew786@CsW6426!', '465', 'SSL', 1, 0, 'Unable to send email using SMTP. Your server might not be configured to send mail using this method.<br><pre>Date: Thu, 4 Dec 2025 07:49:36 +0000\r\nList-Unsubscribe: &lt;notify@customsportswears.com&gt;, &lt;https://customsportswears.com/Ajax/execution?mqid=1726&amp;do=unsubscribe&amp;email=marco.metzger@isc.fraunhofer.de&amp;token=CXqcEJFWFhBjcNbJ&gt;\r\nFrom: &quot;Custom Sports Wears&quot; &lt;notify@customsportswears.com&gt;\r\nReturn-Path: &lt;notify@customsportswears.com&gt;\r\nTo: marco.metzger@isc.fraunhofer.de\r\nSubject: =?UTF-8?Q?We&#039;re=20sorry=20to=20see=20you=20go=20=E2=80=94=20confirm=20to?= =?UTF-8?Q?=20unsubscribe?=\r\nReply-To: &lt;notify@customsportswears.com&gt;\r\nUser-Agent: SHONiR\r\nX-Sender: notify@customsportswears.com\r\nX-Mailer: SHONiR\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;69313d107e0114.17330333@customsportswears.com&gt;\r\nMime-Version: 1.0\r\n\n\nContent-Type: multipart/alternative; boundary=&quot;B_ALT_69313d107e1ef4.51281372&quot;\r\n\r\nThis is a multi-part message in MIME format.\r\nYour email application may not support this format.\r\n\r\n--B_ALT_69313d107e1ef4.51281372\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\r\n\r\nConfirm Unsubscription\r\n Hi there,\r\n We received your request to unsubscribe from our mailing list. To confirm,\r\nsimply click the button below.\r\n You’ll stop receiving updates, offers, and news from us — but you&#039;re\r\nalways welcome back anytime.\r\n Confirm Unsubscribe\r\n If you didn’t request this, feel free to ignore this message.\r\n\r\n\r\n &amp;copy; 2025 Custom Sports Wears. All rights reserved.\r\n\r\n\r\n--B_ALT_69313d107e1ef4.51281372\r\nContent-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n&lt;!DOCTYPE html&gt;=0A&lt;html lang=3D&quot;en&quot;&gt;=0A&lt;head&gt;=0A  &lt;meta charset=3D&quot;UTF-8&quot;&gt;=\r\n=0A  &lt;title&gt;Email Unsubscription Confirmation&lt;/title&gt;=0A  &lt;style&gt;=0A    bod=\r\ny {=0A      font-family: Arial, sans-serif;=0A      background-color: #f4f6=\r\nf8;=0A      padding: 0;=0A      margin: 0;=0A    }=0A    .email-container {=\r\n=0A      max-width: 600px;=0A      margin: auto;=0A      background-color: =\r\n#ffffff;=0A      padding: 20px;=0A      border-radius: 8px;=0A      box-sha=\r\ndow: 0 2px 5px rgba(0,0,0,0.05);=0A    }=0A    .logo {=0A      text-align: =\r\ncenter;=0A      margin-bottom: 20px;=0A    }=0A      .logo img {=0A      bo=\r\nrder: 0;=0A    }=0A=0A    .content {=0A      color: #333333;=0A      font-s=\r\nize: 16px;=0A      line-height: 1.6;=0A    }=0A    .cta-button {=0A      di=\r\nsplay: inline-block;=0A      margin-top: 20px;=0A      padding: 12px 24px;=\r\n=0A      background-color: #420000;=0A      color: #c9bb04 !important;=0A  =\r\n    text-decoration: none;=0A      border-radius: 5px;=0A      font-weight:=\r\n bold;=0A    }=0A    .footer {=0A      margin-top: 30px;=0A      font-size:=\r\n 12px;=0A      color: #999999;=0A      text-align: center;=0A    }=0A  &lt;/st=\r\nyle&gt;=0A&lt;/head&gt;=0A&lt;body&gt;=0A  &lt;div class=3D&quot;email-container&quot;&gt;=0A    &lt;div clas=\r\ns=3D&quot;logo&quot;&gt;=0A      &lt;a href=3D&quot;https://customsportswears.com/&quot;&gt;&lt;img src=3D&quot;=\r\nhttps://cdn.customsportswears.com/public/images/frontend/default/logo.png&quot; =\r\nalt=3D&quot;Custom Sports Wears&quot; /&gt;&lt;/a&gt;=0A    &lt;/div&gt;=0A    &lt;div class=3D&quot;content=\r\n&quot;&gt;=0A      &lt;h2&gt;Confirm Unsubscription&lt;/h2&gt;=0A      &lt;p&gt;Hi there,&lt;/p&gt;=0A     =\r\n &lt;p&gt;We received your request to unsubscribe from our mailing list. To confi=\r\nrm, simply click the button below.&lt;/p&gt;=0A      &lt;p&gt;You=E2=80=99ll stop recei=\r\nving updates, offers, and news from us =E2=80=94 but you&#039;re always welcome =\r\nback anytime.&lt;/p&gt;=0A      &lt;a href=3D&quot;https://customsportswears.com/Ajax/exe=\r\ncution?do=3Demail_confirm&amp;token=3Duf4b5FgBsDuSdRkv&amp;email=3Dmarco.metzger@is=\r\nc.fraunhofer.de&quot; class=3D&quot;cta-button&quot;&gt;Confirm Unsubscribe&lt;/a&gt;=0A      &lt;p&gt;If=\r\n you didn=E2=80=99t request this, feel free to ignore this message.&lt;/p&gt;=0A =\r\n   &lt;/div&gt;=0A    &lt;div class=3D&quot;footer&quot;&gt;=0A      &amp;copy; 2025 Custom Sports We=\r\nars. All rights reserved.=0A    &lt;/div&gt;=0A  &lt;/div&gt;=0A&lt;/body&gt;=0A&lt;/html&gt;\r\n\r\n--B_ALT_69313d107e1ef4.51281372--</pre>', 85, 0, 85, 5, 0, 3, 1764834576, 1764863330, 1764834576, 1, '7AatzaHEbvMHC7Lp', 573091200, 0, NULL, 1759592390, 1, '2400:adc7:193c:5200:68c9:4e09:bcd0:cd2e'),
(4, 'hn.celebiz.com', 'notify@customsportswears.com', 'notify@customsportswears.com', 'nNew786@CsW6426!', '587', 'TLS', 1, 0, '220 hn.celebiz.com ESMTP Postfix (Debian/GNU)\r\n<br><pre>hello: 250-hn.celebiz.com\r\n250-PIPELINING\r\n250-SIZE 102400000\r\n250-VRFY\r\n250-ETRN\r\n250-STARTTLS\r\n250-ENHANCEDSTATUSCODES\r\n250-8BITMIME\r\n250-DSN\r\n250-SMTPUTF8\r\n250 CHUNKING\r\n</pre>Failed to send AUTH LOGIN command. Error: 530 5.7.0 Must issue a STARTTLS command first\r\n<br>Unable to send email using SMTP. Your server might not be configured to send mail using this method.<br><pre>Date: Thu, 4 Dec 2025 07:54:49 +0000\r\nList-Unsubscribe: &lt;notify@customsportswears.com&gt;, &lt;https://customsportswears.com/Ajax/execution?mqid=1726&amp;do=unsubscribe&amp;email=marco.metzger@isc.fraunhofer.de&amp;token=9335xBUqLNChQWq0&gt;\r\nFrom: &quot;Custom Sports Wears&quot; &lt;notify@customsportswears.com&gt;\r\nReturn-Path: &lt;notify@customsportswears.com&gt;\r\nTo: marco.metzger@isc.fraunhofer.de\r\nSubject: =?UTF-8?Q?We&#039;re=20sorry=20to=20see=20you=20go=20=E2=80=94=20confirm=20to?= =?UTF-8?Q?=20unsubscribe?=\r\nReply-To: &lt;notify@customsportswears.com&gt;\r\nUser-Agent: SHONiR\r\nX-Sender: notify@customsportswears.com\r\nX-Mailer: SHONiR\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;69313e49c15f92.92247837@customsportswears.com&gt;\r\nMime-Version: 1.0\r\n\n\nContent-Type: multipart/alternative; boundary=&quot;B_ALT_69313e49c161d9.74549531&quot;\r\n\r\nThis is a multi-part message in MIME format.\r\nYour email application may not support this format.\r\n\r\n--B_ALT_69313e49c161d9.74549531\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\r\n\r\nConfirm Unsubscription\r\n Hi there,\r\n We received your request to unsubscribe from our mailing list. To confirm,\r\nsimply click the button below.\r\n You’ll stop receiving updates, offers, and news from us — but you&#039;re\r\nalways welcome back anytime.\r\n Confirm Unsubscribe\r\n If you didn’t request this, feel free to ignore this message.\r\n\r\n\r\n &amp;copy; 2025 Custom Sports Wears. All rights reserved.\r\n\r\n\r\n--B_ALT_69313e49c161d9.74549531\r\nContent-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n&lt;!DOCTYPE html&gt;=0A&lt;html lang=3D&quot;en&quot;&gt;=0A&lt;head&gt;=0A  &lt;meta charset=3D&quot;UTF-8&quot;&gt;=\r\n=0A  &lt;title&gt;Email Unsubscription Confirmation&lt;/title&gt;=0A  &lt;style&gt;=0A    bod=\r\ny {=0A      font-family: Arial, sans-serif;=0A      background-color: #f4f6=\r\nf8;=0A      padding: 0;=0A      margin: 0;=0A    }=0A    .email-container {=\r\n=0A      max-width: 600px;=0A      margin: auto;=0A      background-color: =\r\n#ffffff;=0A      padding: 20px;=0A      border-radius: 8px;=0A      box-sha=\r\ndow: 0 2px 5px rgba(0,0,0,0.05);=0A    }=0A    .logo {=0A      text-align: =\r\ncenter;=0A      margin-bottom: 20px;=0A    }=0A      .logo img {=0A      bo=\r\nrder: 0;=0A    }=0A=0A    .content {=0A      color: #333333;=0A      font-s=\r\nize: 16px;=0A      line-height: 1.6;=0A    }=0A    .cta-button {=0A      di=\r\nsplay: inline-block;=0A      margin-top: 20px;=0A      padding: 12px 24px;=\r\n=0A      background-color: #420000;=0A      color: #c9bb04 !important;=0A  =\r\n    text-decoration: none;=0A      border-radius: 5px;=0A      font-weight:=\r\n bold;=0A    }=0A    .footer {=0A      margin-top: 30px;=0A      font-size:=\r\n 12px;=0A      color: #999999;=0A      text-align: center;=0A    }=0A  &lt;/st=\r\nyle&gt;=0A&lt;/head&gt;=0A&lt;body&gt;=0A  &lt;div class=3D&quot;email-container&quot;&gt;=0A    &lt;div clas=\r\ns=3D&quot;logo&quot;&gt;=0A      &lt;a href=3D&quot;https://customsportswears.com/&quot;&gt;&lt;img src=3D&quot;=\r\nhttps://cdn.customsportswears.com/public/images/frontend/default/logo.png&quot; =\r\nalt=3D&quot;Custom Sports Wears&quot; /&gt;&lt;/a&gt;=0A    &lt;/div&gt;=0A    &lt;div class=3D&quot;content=\r\n&quot;&gt;=0A      &lt;h2&gt;Confirm Unsubscription&lt;/h2&gt;=0A      &lt;p&gt;Hi there,&lt;/p&gt;=0A     =\r\n &lt;p&gt;We received your request to unsubscribe from our mailing list. To confi=\r\nrm, simply click the button below.&lt;/p&gt;=0A      &lt;p&gt;You=E2=80=99ll stop recei=\r\nving updates, offers, and news from us =E2=80=94 but you&#039;re always welcome =\r\nback anytime.&lt;/p&gt;=0A      &lt;a href=3D&quot;https://customsportswears.com/Ajax/exe=\r\ncution?do=3Demail_confirm&amp;token=3Duf4b5FgBsDuSdRkv&amp;email=3Dmarco.metzger@is=\r\nc.fraunhofer.de&quot; class=3D&quot;cta-button&quot;&gt;Confirm Unsubscribe&lt;/a&gt;=0A      &lt;p&gt;If=\r\n you didn=E2=80=99t request this, feel free to ignore this message.&lt;/p&gt;=0A =\r\n   &lt;/div&gt;=0A    &lt;div class=3D&quot;footer&quot;&gt;=0A      &amp;copy; 2025 Custom Sports We=\r\nars. All rights reserved.=0A    &lt;/div&gt;=0A  &lt;/div&gt;=0A&lt;/body&gt;=0A&lt;/html&gt;\r\n\r\n--B_ALT_69313e49c161d9.74549531--</pre>', 85, 0, 85, 5, 0, 3, 1764834889, 1764863330, 1764834889, 1, 'TT490sC5n3cajibU', 573091200, 0, NULL, 1759592402, 1, '2400:adc7:193c:5200:68c9:4e09:bcd0:cd2e'),
(5, 'smtp-relay.brevo.com', 'info@customsportswears.com', '927e1e001@smtp-brevo.com', '9VkTfCwPXzrZ6E2h', '465', 'SSL', 7, 1, NULL, 223, 223, 0, 5, 0, 3, 1770275984, 1773078313, 573091200, 1, NULL, 573091200, 0, NULL, 573091200, 0, NULL),
(6, 'smtp-relay.brevo.com', 'info@customsportswears.com', '927e1e001@smtp-brevo.com', '9VkTfCwPXzrZ6E2h', '587', 'TLS', 8, 1, NULL, 223, 223, 0, 5, 0, 3, 1769376824, 1773078313, 573091200, 1, NULL, 573091200, 0, NULL, 573091200, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_natives`
--

CREATE TABLE `tbl_natives` (
  `native_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `items` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `bottom` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `session_id` varchar(190) DEFAULT NULL,
  `token` varchar(190) DEFAULT NULL,
  `order_number` varchar(190) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `company` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `address2` text NOT NULL,
  `country` text NOT NULL,
  `state` text NOT NULL,
  `city` text NOT NULL,
  `zip` text NOT NULL,
  `details` mediumtext NOT NULL,
  `total_items` int(11) NOT NULL DEFAULT 0,
  `total_quantity` varchar(190) NOT NULL DEFAULT '0',
  `sub_total` varchar(190) NOT NULL DEFAULT '0',
  `promo_code` varchar(190) DEFAULT NULL,
  `discount_type` tinyint(1) NOT NULL DEFAULT 0,
  `discount` varchar(190) NOT NULL DEFAULT '0',
  `discount_net` varchar(190) NOT NULL DEFAULT '0',
  `net_total` varchar(190) NOT NULL DEFAULT '0',
  `gst_type` tinyint(1) NOT NULL DEFAULT 0,
  `gst` varchar(190) NOT NULL DEFAULT '0',
  `gst_net` varchar(190) NOT NULL DEFAULT '0',
  `vat_type` tinyint(1) NOT NULL DEFAULT 0,
  `vat` varchar(190) NOT NULL DEFAULT '0',
  `vat_net` varchar(190) NOT NULL DEFAULT '0',
  `shipping_fee` varchar(190) NOT NULL DEFAULT '0',
  `handling_fee` varchar(190) NOT NULL DEFAULT '0',
  `grand_total` varchar(190) NOT NULL DEFAULT '0',
  `add_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `update_by` int(11) NOT NULL DEFAULT 0,
  `update_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders_items`
--

CREATE TABLE `tbl_orders_items` (
  `order_item_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `quantity` varchar(190) NOT NULL DEFAULT '0',
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `model` varchar(190) DEFAULT NULL,
  `sku` varchar(190) DEFAULT NULL,
  `mpn` varchar(190) DEFAULT NULL,
  `gtin` varchar(190) DEFAULT NULL,
  `price` varchar(190) NOT NULL DEFAULT '0',
  `price_previous` varchar(190) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

CREATE TABLE `tbl_pages` (
  `page_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `childrens` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `bottom` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_pages`
--

INSERT INTO `tbl_pages` (`page_id`, `sort_order`, `childrens`, `slug`, `title`, `name`, `description`, `spotlight`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `featured`, `listed`, `removable`, `searchable`, `top`, `bottom`, `published_time`, `today_views`, `statistics_update`, `lifetime_views`, `today_hits`, `lifetime_hits`, `last_view_time`, `last_hit_time`, `votes`, `ratings`, `scores`, `likes`, `token`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(10, 0, 0, 'welcome-to-shonir-cms-where-leather-meets-luxury', 'Welcome to SHONiR CMS – Where Leather Meets Luxury', 'Welcome to SHONiR CMS – Where Leather Meets Luxury', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">At SHONiR CMS, we believe that fashion is more than clothing &mdash; it&rsquo;s a lifestyle. Our journey began with a passion for redefining leather craftsmanship, and today we proudly stand as a global manufacturer, exporter, and supplier of premium leather products.</span></p>\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">From classic jackets and elegant blazers to durable shoes and versatile bags, our collections are designed to meet the diverse needs of modern families. Each piece is made from 100% genuine lambskin leather, ensuring unmatched quality, comfort, and longevity.</span></p>\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">We are committed to excellence at every step &mdash; from design to delivery. Our products are not only stylish but also practical, featuring tailored fits, functional details, and versatile designs that suit every occasion. Whether you&rsquo;re dressing for business, casual outings, or special events, SHONiR CMS offers fashion that adapts to your lifestyle.</span></p>\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">With a strong presence in international markets, we continue to expand our reach, offering localized collections across major U.S. cities and beyond. Our mission is simple: to provide leather fashion that inspires confidence, builds trust, and lasts a lifetime.</span></p>\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Welcome to SHONiR CMS &mdash; where tradition meets innovation, and every product tells a story of craftsmanship and style.</span></p>', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Welcome to SHONiR CMS, your trusted destination for premium leather apparel and accessories. We craft timeless fashion pieces that blend elegance, durability, and modern design &mdash; empowering men, women, and kids to express their individuality with confidence.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>', 'Welcome to SHONiR CMS – Premium Leather Fashion', 'Discover SHONiR CMS, a global leader in premium leather jackets, blazers, shoes, and bags. Timeless craftsmanship, modern design, and durable fashion for men, women, and kids.', 'SHONiR CMS welcome, premium leather fashion, leather jackets brand, leather blazers supplier, leather shoes exporter, leather bags collection, global leather apparel, timeless leather craftsmanship, luxury leather products, men’s leather fashion, women’s leather fashion, kids’ leather fashion, leather apparel company, trusted leather supplier, leather fashion worldwide', 1, 1, 1, 0, 1, 0, 0, 1767548699, 1, 1769043847, 1042, 1, 1042, 1769043847, 1769043847, 99, 5, '495', 99, 'iadnBSv6Hi6PHxUm', 1749059099, 0, '127.0.0.1', 1772105104, 1, '59.103.124.231'),
(11, 1, 0, 'shonir-cms-premium-leather-apparel-accessories', 'About Us – SHONiR CMS Leather Fashion Excellence', 'About Us', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">SHONiR CMS was founded with a vision to redefine leather fashion by blending traditional craftsmanship with modern design. Today, we stand as a trusted manufacturer, exporter, and supplier of premium leather apparel and accessories, serving global markets with pride.</span></p>\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Our expertise spans men&rsquo;s, women&rsquo;s, and kids&rsquo; collections, offering everything from classic Harrington jackets and elegant blazers to durable shoes and versatile bags. Each product is crafted from 100% genuine lambskin leather, ensuring luxury, comfort, and long-lasting wear.</span></p>\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">We believe in meticulous tailoring, functional detailing, and timeless designs that suit both casual and formal occasions. Beyond fashion, our mission is to deliver reliability, customer satisfaction, and global accessibility. With a strong presence in international markets, SHONiR CMS continues to expand by offering localized collections across major U.S. cities, while maintaining the same uncompromising standard of excellence.</span></p>\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">At SHONiR CMS, we don&rsquo;t just create leather products &mdash; we craft experiences that last a lifetime.</span></p>', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">At SHONiR CMS, fashion is more than appearance &mdash; it&rsquo;s a promise of quality, craftsmanship, and individuality. From jackets and blazers to shoes and bags, our collections are designed to inspire confidence, deliver durability, and reflect timeless style.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>', 'About Us – SHONiR CMS Premium Leather Apparel', 'Learn about SHONiR CMS, a global manufacturer and supplier of premium leather jackets, blazers, shoes, and bags. Combining craftsmanship, durability, and timeless fashion for men, women, and kids.', 'SHONiR CMS about us, premium leather apparel, leather jackets manufacturer, leather blazers supplier, leather shoes exporter, leather bags collection, global leather fashion, timeless leather craftsmanship, luxury leather products, men’s leather fashion, women’s leather fashion, kids’ leather fashion, leather apparel company, trusted leather supplier, leather fashion worldwide', 1, 1, 1, 0, 1, 1, 1, 1767548699, 2, 1772982076, 1462, 2, 1462, 1773006393, 1773006393, 109, 5, '545', 114, '9fH8bbnHt6tf3K25', 1749059099, 0, '127.0.0.1', 1772103114, 1, '59.103.124.231'),
(12, 0, 0, 'final-step-send-your-enquiry-shonir-cms', 'Final Step: Send Your Enquiry - SHONiR CMS', 'Final Step: Send Your Enquiry', '<p><strong class=\"t-h2\">You&rsquo;re Almost There!</strong></p>\r\n<p>Thank you for using Custom Sports Wears\' Enquiry Basket. You\'re just one step away from getting your free quotation for your desired SHONiR CMS.</p>\r\n<p><strong class=\"t-h2\">What Happens Next?</strong></p>\r\n<ol start=\"1\">\r\n<li>\r\n<p><strong class=\"t-h3\">Review Your Selections</strong>: Take a moment to review the products you&rsquo;ve added to your Enquiry Basket. Make sure everything looks good and you&rsquo;ve included all the items you&rsquo;re interested in.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Provide Your Details</strong>: Fill out the required fields, including your name, email address, and any additional information or specific requests you may have.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Submit Your Enquiry</strong>: Click the \"Submit Enquiry\" button to send us your request. Remember, you do not have to make any payment at this stage. This page is not a shopping cart checkout; it&rsquo;s an enquiry submission.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Receive Free Quotation</strong>: Our team will review your enquiry and provide you with a detailed, free quotation based on the products and customization options you&rsquo;ve selected.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Next Steps</strong>: Once you receive and approve the quotation, we will guide you through the payment process and begin working on your order.</p>\r\n</li>\r\n</ol>\r\n<p><strong class=\"t-h2\">Your Security</strong></p>\r\n<p>Rest assured, we will never ask for your credit card information or any payment-related details at this stage. Our goal is to provide you with the information you need to make an informed decision without any obligation.</p>\r\n<p><strong class=\"t-h2\">Need Help?</strong></p>\r\n<p>If you have any questions or need assistance, please don\'t hesitate to contact us at +923333336426 or email us at info@shonir.com. We&rsquo;re here to help!</p>', '<p>Complete your SHONiR CMS enquiry with Custom Sports Wears. Review your selections, provide your details, and submit your enquiry to receive a free quotation. No payment required at this stage. Enjoy a secure and friendly experience with us.</p>', 'Final Step: Send Your Enquiry - SHONiR CMS', 'Complete your SHONiR CMS enquiry with SHONiR CMS. Review your selections, provide your details, and submit your enquiry to receive a free quotation. No payment required at this stage. Enjoy a secure and friendly experience with us.', 'send enquiry, final step enquiry, custom sportswear, free quotation, secure enquiry, no payment required, Custom Sports Wears, review selections, enquiry submission, personalized sportswear, customer-friendly process', 1, 1, 1, 0, 1, 0, 0, 1767548699, 1, 1762773335, 1042, 1, 1042, 1762773335, 1762773335, 99, 5, '495', 99, 'gppheuPMMbXDf91x', 1749059099, 0, '127.0.0.1', 1772103821, 1, '59.103.124.231'),
(13, 0, 0, 'customer-reviews-feedback-shonir-cms-share-your-experie', 'Customer Reviews & Feedback - SHONiR CMS: Share Your Experience', 'Customer Reviews & Feedback', '<p><strong class=\"t-h2\">We Value Your Feedback</strong></p>\r\n<p>At Custom Sports Wears, your feedback is essential. It helps us understand your needs, refine our products, improve our services, and rectify any mistakes. Your insights are invaluable in our pursuit of excellence.</p>\r\n<p><strong class=\"t-h2\">How to Submit Your Feedback</strong></p>\r\n<ol start=\"1\">\r\n<li>\r\n<p><strong class=\"t-h3\">Fill Out the Form Below</strong>: Provide your name, email, and detailed feedback about our products or services.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Submit Your Feedback</strong>: Once you\'ve completed the form, click \"Submit\" to send us your feedback.</p>\r\n</li>\r\n</ol>\r\n<p><strong class=\"t-h2\">What Happens Next?</strong></p>\r\n<p>After you submit your feedback, our team will review it and take the necessary steps to address your concerns or implement your suggestions. We strive to respond to all feedback promptly and ensure your voice is heard.</p>\r\n<p><strong class=\"t-h2\">Customer Reviews</strong></p>\r\n<p>We believe in transparency and the value of genuine customer reviews. Your feedback may be featured on our website to help other customers make informed decisions about our products and services.</p>\r\n<p><strong class=\"t-h2\">Contact Us</strong></p>\r\n<p>If you have any questions or need further assistance, please contact us at +923333336426 or email us at info@shonir.com. We are here to help and ensure you have the best possible experience with SHONiR CMS.</p>', '<p>At SHONiR CMS, we value your feedback. Help us improve our products and services by sharing your experience. Your insights are essential in enhancing product quality and customer satisfaction. Submit your feedback and let your voice be heard.</p>', 'Customer Reviews & Feedback - SHONiR CMS: Share Your Experience', 'At SHONiR CMS, we value your feedback. Help us improve our products and services by sharing your experience. Your insights are essential in enhancing product quality and customer satisfaction. Submit your feedback and let your voice be heard.', 'customer reviews, feedback, product quality, customer satisfaction, SHONiR CMS, improve services, enhance products, share experience, customer insights, brand improvement', 1, 1, 1, 0, 1, 0, 0, 1767548699, 3, 1762742934, 1046, 3, 1046, 1762780664, 1762780664, 99, 5, '495', 100, 'ZzVzARHzApjJg5UU', 1749059099, 0, '127.0.0.1', 1772103551, 1, '59.103.124.231'),
(14, 0, 0, 'contact-us', 'Get in Touch', 'Contact Us', '<p><strong class=\"t-h3\">Address:</strong> Sialkot - 51310, Pakistan.<br /><strong class=\"t-h3\">WhatsApp/Phone:</strong> <a href=\"https://wa.me/923303270786\" target=\"_blank\" rel=\"noopener\">(+92)-333-333-6426</a><br /><strong class=\"t-h3\">Email:</strong> info@shonir.com<br /><strong class=\"t-h3\">Website:</strong> www.shonir.com</p>\r\n<p><strong><br /><span class=\"t-h3\">Office Timings:</span></strong><br />Monday to Friday &nbsp;9:00 AM 6:00 PM<br />Saturday &nbsp;9:00 AM 1:30 PM<br />Lunch Break &nbsp;1:00 PM 2:00 PM (Friday 12:30 PM 2:30 PM)<br />Closed on &nbsp;Sunday &amp; National Holidays<br /><br /></p>\r\n<p><span class=\"t-h3\"><strong>Email Hours:</strong></span><br />11:00AM to 4:00PM, 7 Days per Week</p>\r\n<p><span style=\"text-decoration: underline;\"><em>Note: All times are in (Pakistan Standard Time) local timezone (UTC+5).<br /><br /></em></span></p>\r\n<p><strong><span class=\"t-h3\">URGENT:</span></strong><br />Please call at Cell: <a href=\"https://wa.me/923303270786\" target=\"_blank\" rel=\"noopener\">+92-333-333-6426</a> OR e-mail at <a href=\"mailto:info@shonir.com\">info@shonir.com</a> with urgent in subject bar for immediate response.</p>', '<p>Experience seamless communication with Shonir CMS: request instant, no-obligation quotes via our free Quote Cart; connect directly through WhatsApp, email, or phone; and rely on our professional support team available during PST office hours. With our Sialkot headquarters fully transparent&mdash;complete with physical address&mdash;and a commitment to rapid, personalized responses, you&rsquo;ll enjoy a trustworthy, efficient path to your custom athletic apparel.</p>', 'Reach Out for Custom Performance Gear  & Accessories', 'Reach out to Custom Sports Wears to discuss your team’s custom sports uniforms and apparel needs. Fill out our contact form or WhatsApp us for a free quote and speedy support.', 'custom sportswear, sports uniforms, athletic apparel manufacturer, team jersey supplier, custom team kits, sportswear company, sports apparel contact, custom workout gear, sports uniform quotes, custom athletic wear, sportswear services, bespoke sports apparel, contact custom sportswears Pakistan, request a quote for custom football jerseys, free quote custom basketball uniforms, custom cricket uniform inquiry form, custom rugby kit manufacturer contact, order personalized soccer uniforms online, best custom sportswear Sialkot contact, custom volleyball apparel quote Pakistan, how to order custom tennis wear, custom MMA gear quote request, bespoke team apparel contact form, urgent custom sportswear assistance PST', 1, 1, 1, 0, 1, 0, 0, 1767548699, 1, 1762682444, 1039, 1, 1039, 1762682444, 1762682444, 99, 5, '495', 99, 'hEvhsqDGG5vd0i6Q', 1749059099, 0, '127.0.0.1', 1772003117, 1, '59.103.124.231'),
(15, 0, 0, 'enquiry-basket-shonir-cms-request-your-free-quotation', 'Enquiry Basket - SHONiR CMS: Request Your Free Quotation', 'Enquiry Basket', '<p><strong class=\"t-h2\">Your SHONiR CMS Enquiry Basket</strong></p>\r\n<p>At SHONiR CMS, we understand the importance of making informed decisions. Our Enquiry Basket feature allows you to easily request quotations for your desired products before making a purchase.</p>\r\n<p><strong class=\"t-h2\">What is the Enquiry Basket?</strong></p>\r\n<p>The Enquiry Basket is a tool that enables you to add the products you are interested in and request a free quotation. <strong>Please note, this is not a shopping cart</strong>. You do not have to pay at the checkout page. Instead, it works as a request for a quotation.</p>\r\n<p><strong class=\"t-h2\">How It Works:</strong></p>\r\n<ol start=\"1\">\r\n<li>\r\n<p><strong class=\"t-h3\">Browse Products</strong>: Explore our wide range of sportswear and related products.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Add to Enquiry Basket</strong>: Select the products you are interested in and add them to your Enquiry Basket. This can be done by clicking the \"Add to Enquiry Basket\" button on the product page.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Submit Enquiry</strong>: Once you have added all the desired products, go to your Enquiry Basket and review your selections. Fill out the required information and submit your enquiry.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Receive Free Quotation</strong>: Our team will review your enquiry and provide you with a detailed, free quotation based on your selected products and customization requirements.</p>\r\n</li>\r\n</ol>\r\n<p><strong class=\"t-h2\">Why Use the Enquiry Basket?</strong></p>\r\n<ul>\r\n<li>\r\n<p><strong class=\"t-h3\">No Commitment</strong>: Adding products to the Enquiry Basket does not obligate you to make a purchase. It&rsquo;s a way to explore your options and make informed decisions.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Free Quotation</strong>: We offer a free quotation service to help you understand the costs involved and the customization options available.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Personalized Service</strong>: Our team will work closely with you to ensure that all your requirements are met and provide any necessary assistance.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Security Assurance</strong>: We will never ask for your credit card information or any payment-related details when you use the Enquiry Basket.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Get Started</strong></p>\r\n<p>Begin by exploring our range of products and adding your desired items to the Enquiry Basket. Submit your enquiry, and let us assist you in bringing your custom sportswear vision to life.</p>', '<p>Use the Enquiry Basket at SHONiR CMS to add your desired products and request a free quotation. Understand our process, explore options, and make informed decisions without any commitment or payment required at checkout. Your security is our priority&mdash;we never ask for credit card information.</p>', 'Enquiry Basket - SHONiR CMS: Request Your Free Quotation', 'Use the Enquiry Basket at SHONiR CMS to add your desired products and request a free quotation. Understand our process, explore options, and make informed decisions without any commitment or payment required at checkout. Your security is our priority—we never ask for credit card information.', 'enquiry basket, free quotation, request a quote, no commitment, secure enquiry, Custom Sports Wears, product inquiry, no payment at checkout, personalized sportswear, custom order process', 1, 1, 1, 0, 1, 0, 0, 1767548699, 1, 1762736103, 1037, 1, 1037, 1762736103, 1762736103, 99, 5, '495', 99, 'fvptGBQeC3rJ1aYn', 1749059099, 0, '127.0.0.1', 1772103636, 1, '59.103.124.231'),
(16, 0, 0, 'factory', 'Factory', 'Factory', '<p>Coming Soon!</p>', 'Factory', 'Factory', 'Factory', 'Factory', 1, 1, 1, 0, 1, 0, 0, 1749059099, 1, 1768636340, 1056, 1, 1056, 1768636340, 1768636340, 99, 5, '495', 99, 'hhHPjAhWS1izeYnFmW7xCAXWQEL2ZHTv', 1749059099, 0, '127.0.0.1', 573091200, 0, NULL),
(17, 0, 0, 'custom-orders-shonir-cms-premium-leather', 'Custom Orders – SHONiR CMS Premium Leather', 'Custom Order', '<p>At SHONiR CMS, we understand that every client has unique needs and specifications. Our custom order process is designed to ensure you get exactly what you envision, tailored to your precise requirements.</p>\r\n<h4 style=\"white-space: normal;\">Custom Order Form</h4>\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">To begin your custom order, please fill out the form below with all necessary details. You can send us your design, size requirements, and any related documents or ideas to help us bring your vision to life.</span></p>\r\n<div style=\"white-space: normal;\">&nbsp;</div>\r\n<h4 style=\"white-space: normal;\">What We Offer</h4>\r\n<ul style=\"white-space: normal;\">\r\n<li style=\"white-space: normal;\">\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Custom designs for <strong style=\"white-space: pre-wrap;\">sportswear, casual wear, fitness gear, boxing equipment, motorbike jackets, and workwear</strong></span></p>\r\n</li>\r\n<li style=\"white-space: normal;\">\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Personalization with <strong style=\"white-space: pre-wrap;\">badges, colors, cuts, emblems, embroidery, labels, logos, patterns, prints, and sizes</strong></span></p>\r\n</li>\r\n<li style=\"white-space: normal;\">\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\"><strong style=\"white-space: pre-wrap;\">High-quality materials and craftsmanship</strong> for durability and comfort</span></p>\r\n</li>\r\n<li style=\"white-space: normal;\">\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\"><strong style=\"white-space: pre-wrap;\">No minimum order limits</strong> &mdash; flexibility for individuals and businesses</span></p>\r\n</li>\r\n<li style=\"white-space: normal;\">\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\"><strong style=\"white-space: pre-wrap;\">Free samples</strong> to test product quality, size, and materials before bulk production</span></p>\r\n</li>\r\n</ul>\r\n<div style=\"white-space: normal;\">&nbsp;</div>\r\n<h4 style=\"white-space: normal;\">How It Works</h4>\r\n<ol style=\"white-space: normal;\" start=\"1\">\r\n<li style=\"white-space: normal;\">\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\"><strong style=\"white-space: pre-wrap;\">Fill Out the Form</strong> &ndash; Provide detailed information about your custom order, including design specifications, sizes, and any additional requirements.</span></p>\r\n</li>\r\n<li style=\"white-space: normal;\">\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\"><strong style=\"white-space: pre-wrap;\">Submit Your Documents</strong> &ndash; Upload relevant files such as design sketches, logos, or other documents that will help us understand your requirements.</span></p>\r\n</li>\r\n<li style=\"white-space: normal;\">\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\"><strong style=\"white-space: pre-wrap;\">Review and Confirmation</strong> &ndash; Our team will review your submission, contact you to confirm details, and provide a transparent quote.</span></p>\r\n</li>\r\n<li style=\"white-space: normal;\">\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\"><strong style=\"white-space: pre-wrap;\">Production and Delivery</strong> &ndash; Once confirmed, our skilled craftsmen begin production. We keep you updated throughout the process and ensure timely delivery.</span></p>\r\n</li>\r\n</ol>\r\n<div style=\"white-space: normal;\">&nbsp;</div>\r\n<h4 style=\"white-space: normal;\">Contact Us</h4>\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">If you have any questions or need assistance with your custom order, please reach out: 📞 <strong style=\"white-space: pre-wrap;\">+92 333 3336426</strong> 📧 <strong style=\"white-space: pre-wrap;\">info@shonir.com</strong></span></p>\r\n<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">Our team at <strong style=\"white-space: pre-wrap;\">SHONiR CMS</strong> is here to guide you every step of the way.</span></p>\r\n<p>&nbsp;</p>', '<p style=\"white-space: normal;\"><span style=\"white-space: pre-wrap;\">At <strong style=\"white-space: pre-wrap;\">SHONiR CMS</strong>, we understand that every client has unique needs and specifications. Our custom order process is designed to ensure you receive exactly what you envision &mdash; tailored to your precise requirements with uncompromising quality.</span></p>', 'Custom Orders – SHONiR CMS Premium Leather', 'Place your custom order with SHONiR CMS. Premium leather and sportswear tailored to your exact specifications — with personalization, free samples, and no minimum order limits.', 'SHONiR CMS custom orders, custom leather jackets, custom sportswear, personalized fitness gear, boxing equipment custom, motorbike jackets custom, workwear custom, premium leather customization, tailored leather apparel, custom embroidery leather, custom logo jackets, custom leather supplier Pakistan, SHONiR CMS custom fashion, custom leather products New York, custom leather products Los Angeles, custom leather products Miami, custom leather products Chicago', 1, 1, 1, 0, 1, 0, 0, 1767548699, 2, 1762673865, 1046, 2, 1046, 1762682457, 1762682457, 99, 5, '495', 99, 'cLtdLZ2KYkUr7B9X', 1749059099, 0, '127.0.0.1', 1772103403, 1, '59.103.124.231'),
(18, 2, 0, 'our-process-shonir-cms-from-design-to-delivery', 'Our Process - SHONiR CMS: From Design to Delivery', 'Our Process', '<p><strong class=\"t-h2\">1. Submit Your Design</strong></p>\r\n<p>Transform your vision into reality with SHONiR CMS. Whether you have a specific design file or just a concept in mind, we&rsquo;re here to help. You can:</p>\r\n<ul>\r\n<li>\r\n<p><strong class=\"t-h3\">Upload Your Design Files</strong>: Share your ready-made designs with us for customization.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Share Your Idea</strong>: Describe your concept, and our skilled design team will create a custom design tailored to your needs.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">2. Receive a Free Quotation</strong></p>\r\n<p>Once we receive your design or concept, our team will:</p>\r\n<ul>\r\n<li>\r\n<p><strong class=\"t-h3\">Prepare a Free Quotation</strong>: Based on your requirements, we will provide you with a detailed quotation at no cost.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Review and Approve</strong>: You can review the quotation and agree to the terms. If you have any questions or need adjustments, we are here to assist.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">3. Finalize the Order</strong></p>\r\n<p>After you approve the quotation, the next steps are:</p>\r\n<ul>\r\n<li>\r\n<p><strong class=\"t-h3\">Advance Payment</strong>: We require a 60% advance payment to begin the production process.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Start Production</strong>: Once the payment is received, we will start working on your design/order.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">4. Design Optimization</strong></p>\r\n<p>After receiving your initial layout, our design team will:</p>\r\n<ul>\r\n<li>\r\n<p><strong class=\"t-h3\">Make It Print-Ready</strong>: Ensure your design is optimized for printing.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Facilitate Change Requests</strong>: Work with you to incorporate any changes or modifications.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Share Final Proof</strong>: Provide a final version for your approval before moving to production.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">5. Stay Informed</strong></p>\r\n<p>We believe in keeping you updated throughout the entire process. Here&rsquo;s what you can expect:</p>\r\n<ul>\r\n<li>\r\n<p><strong class=\"t-h3\">Regular Updates</strong>: Receive timely updates on the status of your order.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Final Product</strong>: Once your custom-made product is ready, we&rsquo;ll inform you and prepare it for shipping.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Share Your Experience</strong>: We&rsquo;d love to see your custom sportswear in action! Snap a photo and share it with us to showcase your unique style.</p>\r\n</li>\r\n</ul>\r\n<h3 class=\"t-h2\">What Makes Us Different?</h3>\r\n<p><strong class=\"t-h3\">No Minimums</strong></p>\r\n<p>Unlike other sportswear manufacturers, we don&rsquo;t deal in only bulk orders. You can ask for a single item order and get a customized product at a price comparable to branded products.</p>\r\n<p><strong class=\"t-h3\">Complete Control</strong></p>\r\n<p>You control the price as we offer progressive discounts based on your order size. With dozens of style options and size charts, you can experience unparalleled control over your custom sportswear order.</p>\r\n<p><strong class=\"t-h3\">Smart Production</strong></p>\r\n<p>To uphold our commitment to world-class export-quality sports kits, we have in-house design, manufacturing, and printing facilities. No integral process is outsourced to third parties.</p>\r\n<p><strong class=\"t-h3\">Stellar Team</strong></p>\r\n<p>With decades of experience and a singular goal of making mass customization mainstream, you will find a helpful partner every step of the way with Custom Sports Wears.</p>\r\n<p><strong class=\"t-h3\">Fabric Selection</strong></p>\r\n<p>Your dedicated representative will initially help you select the best fabric for your product. We offer custom fabric development with minimum orders as low as 300 KGs per color.</p>\r\n<p><strong class=\"t-h3\">Customization</strong></p>\r\n<p>At this step, all changes in terms of printing, add-ons, and modifications are executed effectively.</p>\r\n<p><strong class=\"t-h3\">Cut &amp; Sewing</strong></p>\r\n<p>Once the fabric is selected, it is sent for cutting and sewing to ensure the quality of the product is never compromised.</p>\r\n<p><strong class=\"t-h3\">Labeling</strong></p>\r\n<p>After finalizing your product, we ensure every piece is labeled before being sent to the packaging department.</p>\r\n<p><strong class=\"t-h3\">Packaging</strong></p>\r\n<p>The final product is ironed, folded with care, and packed in the packaging of your choice to give it a premium look.</p>\r\n<p><strong class=\"t-h3\">Shipment</strong></p>\r\n<p>Once the order is packed and ready, it is shipped to your location with minimum shipping time.</p>', '<p>Discover the seamless process at SHONiR CMS, from submitting your design to receiving your custom-made sportswear. We offer free quotations, detailed design optimization, and regular updates throughout production. Experience personalized service with every order.</p>', 'Our Process - SHONiR CMS: From Design to Delivery', 'Discover the seamless process at SHONiR CMS, from submitting your design to receiving your custom-made sportswear. We offer free quotations, detailed design optimization, and regular updates throughout production. Experience personalized service with every order.', 'custom sportswear process, design submission, free quotation, design optimization, production updates, custom order process, Custom Sports Wears, personalized sportswear, customer-focused process, seamless production, tailored sportswear', 1, 1, 1, 0, 1, 1, 1, 1767548699, 1, 1773010632, 1144, 1, 1144, 1773010632, 1773010632, 99, 5, '495', 99, 'iXRnSzGK0RzHr4yF', 1749059099, 0, '127.0.0.1', 1772103897, 1, '59.103.124.231'),
(21, 0, 0, 'images-gallery', 'Images Gallery Lorem Ipsum has been the industry\'s standard dummy', 'Images Gallery', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem &nbsp;passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s printer took.</p>', '<p>typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem &nbsp;passages, and more recently&nbsp;</p>', 'Top Pages', 'Images Gallery', 'Images Gallery', 1, 1, 1, 0, 1, 0, 0, 1767548699, 1, 1773006399, 1122, 1, 1122, 1773006399, 1773006399, 100, 5, '500', 100, 'VuJ91zEZabDkdAxZ', 1749059099, 0, '127.0.0.1', 1770275259, 1, '127.0.0.1'),
(22, 3, 0, 'exchange-return-policy-shonir-cms', 'Exchange & Return Policy - SHONiR CMS', 'Exchange & Return', '<p><strong class=\"t-h2\">Exchange Policy</strong></p>\r\n<p>To initiate an exchange, SHONiR CMS must be notified within 48 hours of receiving your order. Exchanges are eligible under the following conditions:</p>\r\n<ul>\r\n<li>\r\n<p class=\"t-h3\">The product is physically broken</p>\r\n</li>\r\n<li>\r\n<p class=\"t-h3\">The wrong size was received</p>\r\n</li>\r\n<li>\r\n<p class=\"t-h3\">The wrong color was received</p>\r\n</li>\r\n</ul>\r\n<p>For refunds, the purchase price (excluding delivery charges) will be refunded using the original payment method once the returned item is received and confirmed to meet our conditions. You are responsible for any costs associated with returning the item to us.</p>\r\n<p>If you request a size or product change, the customer will be responsible for delivery charges. Our courier replacement service is available in limited areas of Lahore; in other cities, customers must send items via courier themselves.</p>\r\n<p><strong class=\"t-h3\">Note:</strong> Items on sale, packs, clearance, or customized orders are not eligible for returns or exchanges, except in cases of defects.</p>\r\n<p><strong class=\"t-h2\">Return Policy</strong></p>\r\n<p>If you change your mind about a purchase, we offer an 80% refund of the purchase price or an exchange, provided the items are returned within 7 days of purchase with the original receipt or proof of purchase.</p>\r\n<p>SHONiR CMS will only accept returns if the product is unworn, unwashed, and unused. If the returned product is in inadequate condition, we reserve the right not to accept the return.</p>\r\n<p>We accept returns only if the product is sent back within 7 days of delivery and for valid reasons such as:</p>\r\n<ul>\r\n<li>\r\n<p class=\"t-h3\">Defective product</p>\r\n</li>\r\n<li>\r\n<p class=\"t-h3\">Physically damaged product</p>\r\n</li>\r\n<li>\r\n<p class=\"t-h3\">Incomplete order</p>\r\n</li>\r\n<li>\r\n<p class=\"t-h3\">Incorrect item received</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Faulty Items or Wrong Order Returns</strong></p>\r\n<p>If an item is faulty, wrongly described, or the incorrect size, we will fulfill our legal obligations by refunding the purchase price and delivery charges, or providing a replacement product. This is contingent upon the item being returned within a reasonable time with proof of purchase.</p>\r\n<p class=\"t-h3\">For further inquiries about returns, please contact us at +923333336426 or email us at info@shonir.com.</p>', '<p>Learn about the Exchange and Return Policy at SHONiR CMS. Discover how to request exchanges or returns for defective, incorrect, or unwanted items. No minimum order limits and free samples available. Contact us for further assistance.</p>', 'Exchange & Return Policy - SHONiR CMS', 'Learn about the Exchange and Return Policy at SHONiR CMS. Discover how to request exchanges or returns for defective, incorrect, or unwanted items. No minimum order limits and free samples available. Contact us for further assistance.', 'exchange policy, return policy, custom sportswear, defective items, incorrect order, return process, free samples, no minimum order, Custom Sports Wears, customer support', 1, 1, 1, 0, 1, 1, 1, 1767548699, 1, 1773010643, 1173, 1, 1173, 1773010643, 1773010643, 101, 5, '505', 101, 'ffvW2Wa5huK0cQDs', 1749059099, 0, '127.0.0.1', 1772103725, 1, '59.103.124.231'),
(23, 4, 0, 'privacy-policy-shonir-cms-your-privacy-matters', 'Privacy Policy - SHONiR CMS: Your Privacy Matters', 'Privacy Policy', '<p><strong class=\"t-h2\">Your Privacy Matters to Us</strong></p>\r\n<p>At Custom Sports Wears, we are committed to protecting your privacy. This Privacy Policy outlines how we process and use your personal information. We assure you that we will use your personal information only in ways that are compatible with this Privacy Policy.</p>\r\n<p><strong class=\"t-h2\">Information We Collect</strong></p>\r\n<ul>\r\n<li>\r\n<p><strong class=\"t-h3\">IP Address and Domain Name</strong>: When you visit our website, our servers automatically recognize your domain name and IP address. This information does not reveal anything personal about you other than the IP address from which you accessed our site. We use this information to analyze traffic patterns in aggregate.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Cookies</strong>: A cookie is a small piece of data sent from a website and stored on your computer&rsquo;s hard drive. Cookies help us identify which areas of our site you have visited and enhance your browsing experience. You can choose to accept or decline cookies by adjusting your browser settings. Note that declining cookies may affect your experience on our site.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Personal Information</strong>: We may request your email address or mailing address for surveys, newsletters, announcements, or information about conferences and trade shows. We maintain a strict &ldquo;No-Spam&rdquo; policy and do not sell or rent your email address to third parties without your consent.</p>\r\n</li>\r\n<li>\r\n<p><strong class=\"t-h3\">Purchase Information</strong>: When you make a purchase, we collect your name, email address, mailing address, credit card number, and expiration date to process your order. This information may also be used to notify you of related products and services. Credit card and email information are never shared or sold.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Use of Information</strong></p>\r\n<ul>\r\n<li>\r\n<p>We use your information to improve our website, services, and products.</p>\r\n</li>\r\n<li>\r\n<p>We may send you email announcements about new products and services if you have agreed to receive such communications.</p>\r\n</li>\r\n<li>\r\n<p>We do not share personal information with third parties without your consent, except as necessary to provide our services or comply with legal requirements.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Third-Party Links</strong></p>\r\n<p>Our website contains links to third-party websites and advertisements. We are not responsible for the privacy practices or content of these external sites. We encourage you to review the privacy policies of any third-party sites you visit.</p>\r\n<p><strong class=\"t-h2\">Your Consent</strong></p>\r\n<p>By using our website, you consent to the collection and use of your information as outlined in this Privacy Policy. We reserve the right to modify this policy at any time. Any changes will be posted on this page, ensuring you are always informed about what information we collect, how we use it, and under what circumstances we disclose it.</p>\r\n<p><strong class=\"t-h2\">Contact Us</strong></p>\r\n<p>If you have any questions or concerns about our Privacy Policy, please contact us at +923333336426or email us at info@shonir.com.</p>', '<p>Learn about how SHONiR CMS protects your privacy. Understand the information we collect, how we use it, and our commitment to safeguarding your personal data. Read our comprehensive privacy policy for detailed insights on our practices.</p>', 'Privacy Policy - SHONiR CMS: Your Privacy Matters', 'Learn about how SHONiR CMS protects your privacy. Understand the information we collect, how we use it, and our commitment to safeguarding your personal data. Read our comprehensive privacy policy for detailed insights on our practices.', 'privacy policy, data protection, personal information, Custom Sports Wears, information collection, cookie policy, data security, online privacy, user privacy, data usage, privacy practices', 1, 1, 1, 0, 1, 1, 1, 1767548699, 1, 1773010657, 1176, 1, 1176, 1773010657, 1773010657, 99, 5, '495', 99, 'X3eYQ2CWuhR51h4v', 1749059099, 0, '127.0.0.1', 1772104280, 1, '59.103.124.231'),
(25, 0, 0, 'size-guide', 'Size Guide', 'Size Guide', '<p>Arcu cursus euismod quis viverra nibh cras pulvinar. Nunc lobortis mattis aliquam faucibus purus in massa. Et malesuada fames ac turpis egestas. Tempor orci dapibus ultrices in iaculis. Urna id volutpat lacus laoreet non curabitur gravida. Sed adipiscing diam donec adipiscing tristique risus nec feugiat in. Senectus et netus et malesuada. Vehicula ipsum a arcu cursus vitae congue mauris. Vitae proin sagittis nisl rhoncus mattis rhoncus urna neque. Dignissim convallis aenean et tortor at risus viverra adipiscing. <a href=\"https://www.bind.pk\">Nisl rhoncus mattis rhoncus urna neque</a>. Hac habitasse platea dictumst quisque sagittis purus sit amet.</p>\r\n<p><br /><br /></p>\r\n<ul>\r\n<li>Semper quis lectus nulla at volutpat diam.</li>\r\n<li>Arcu dictum varius duis at consectetur.</li>\r\n<li>Amet nisl purus in mollis nunc sed.</li>\r\n<li>Odio pellentesque diam volutpat.</li>\r\n<li>Commodo sed egestas.</li>\r\n<li>Egestas fringilla.</li>\r\n<li>Consequat mauris nunc congue</li>\r\n<li>Nisi vitae suscipit</li>\r\n<li>Donec pretium vulputate sapien nec.</li>\r\n<li>Faucibus scelerisque eleifend</li>\r\n</ul>', 'Size Guide', 'Size Guide', 'Size Guide', 'Size Guide', 1, 1, 1, 0, 1, 0, 0, 1749059099, 1, 1762683127, 1033, 1, 1033, 1762683127, 1762683127, 99, 5, '495', 99, 'hhHPjAhWS1izeYnFmW7xCAXWQEL2ZHTv', 1749059099, 0, '127.0.0.1', 573091200, 0, NULL),
(26, 1, 0, 'video-gallery', 'Video Gallery modo ullamcorper. Lobortis feugiat vivamus', 'Video Gallery', '<p>consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus eget nunc scelerisque viverra mauris in aliquam sem fringilla. <a href=\"https://www.bind.pk\">Posuere urna nec tincidunt praesent</a>. Viverra nam libero justo laoreet sit amet cursus sit amet. Nulla pharetra diam sit amet nisl. Ipsum a arcu cursus vitae congue mauris rhoncus. At urna condimentum mattis pellentesque. Nulla facilisi cras fermentum odio eu feugiat. Metus dictum at tempor commodo ullamcorper. Lobortis feugiat vivamus at augue eget arcu. Risus commodo viverra maecenas accumsan lacus vel facilisis volutpat est. Turpis egestas pretium aenean pharetra magna ac placerat vestibulum lectus. Mollis nunc sed id semper. In dictum non consectetur a erat nam at lectus urna. Porttitor lacus luctus accumsan tortor posuere ac ut consequat. Vitae et leo duis ut diam quam nulla porttitor massa. At erat pellentesque adipiscing commodo elit at imperdiet dui accumsan.</p>', '<p>modo ullamcorper. Lobortis feugiat vivamus at augue eget arcu. Risus commodo viverra maecenas accumsan lacus vel facilisis volutpat est. Turpis egestas pretium aenean pharetra magna ac placerat vestibulum lectus. Mollis nunc sed id semper. In dictum non consectetur a erat nam at lectus urna. Porttitor lacus luctus accumsan tortor posuere ac ut consequat. Vitae et leo duis ut diam quam nulla porttitor massa. At erat pellentesque adipiscing commodo elit at imperdiet dui accumsan.</p>', 'Video Gallery', 'Video Gallery', 'Video Gallery', 1, 1, 1, 0, 1, 0, 0, 1767548699, 2, 1772983850, 1071, 2, 1071, 1773006396, 1773006396, 99, 5, '495', 99, 'UgvY79e5mxqm2mem', 1749059099, 0, '127.0.0.1', 1770275142, 1, '127.0.0.1'),
(27, 0, 0, 'order-status', 'Order Status', 'Order Status', '<div style=\"color: #d4d4d4; background-color: #1e1e1e; font-family: Consolas, \'Courier New\', monospace; font-weight: normal; font-size: 14px; line-height: 19px; white-space: pre;\">\r\n<div><span style=\"color: #d4d4d4;\">Order&nbsp;Status</span></div>\r\n</div>', 'Order Status', 'Order Status', 'Order Status', 'Order Status', 1, 1, 1, 0, 1, 0, 0, 1749059099, 2, 1762682514, 1035, 2, 1035, 1762697563, 1762697563, 99, 5, '495', 99, 'hhHPjAhWS1izeYnFmW7xCAXWQEL2ZHTv', 1749059099, 0, '127.0.0.1', 573091200, 0, NULL);
INSERT INTO `tbl_pages` (`page_id`, `sort_order`, `childrens`, `slug`, `title`, `name`, `description`, `spotlight`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `featured`, `listed`, `removable`, `searchable`, `top`, `bottom`, `published_time`, `today_views`, `statistics_update`, `lifetime_views`, `today_hits`, `lifetime_hits`, `last_view_time`, `last_hit_time`, `votes`, `ratings`, `scores`, `likes`, `token`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(28, 5, 0, 'terms-and-conditions-shonir-cms-website-use-and-policie', 'Terms and Conditions - SHONiR CMS: Website Use and Policies', 'Terms & Condition', '<p>These terms and conditions outline the rules and regulations for the use of Custom Sports Wears\' website, located at <a href=\"../../\">https://shonir.com</a>.</p>\r\n<p><strong>By accessing this website, we assume you accept these terms and conditions. Do not continue to use Custom Sports Wears if you do not agree to all of the terms and conditions stated on this page.</strong></p>\r\n<p><strong class=\"t-h2\">Terminology</strong></p>\r\n<ul>\r\n<li>\r\n<p class=\"t-h3\">\"Client\", \"You\" and \"Your\" refers to you, the person logging on this website and compliant with the Company&rsquo;s terms and conditions.</p>\r\n</li>\r\n<li>\r\n<p class=\"t-h3\">\"The Company\", \"Ourselves\", \"We\", \"Our\" and \"Us\", refers to Custom Sports Wears.</p>\r\n</li>\r\n<li>\r\n<p class=\"t-h3\">\"Party\", \"Parties\", or \"Us\", refers to both the Client and ourselves.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Use of Website</strong></p>\r\n<ul>\r\n<li>\r\n<p>By accessing our website, you warrant and represent that you are at least 18 years old or visiting under the supervision of a parent or guardian.</p>\r\n</li>\r\n<li>\r\n<p>Subject to the terms and conditions of this Agreement, Custom Sports Wears hereby grants you a limited, revocable, non-transferable, and non-exclusive license to access and use the website by displaying it on your internet browser for the sole purpose of shopping for personal items sold on the site and not for any commercial use or use on behalf of any third party, except as explicitly permitted by Custom Sports Wears in advance.</p>\r\n</li>\r\n<li>\r\n<p>Any breach of this Agreement shall result in the immediate revocation of the license granted without notice to you.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Intellectual Property</strong></p>\r\n<ul>\r\n<li>\r\n<p>All content included on this site, such as text, graphics, logos, images, audio clips, digital downloads, data compilations, and software, is the property of Custom Sports Wears or its content suppliers and protected by international copyright laws.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Custom Orders</strong></p>\r\n<ul>\r\n<li>\r\n<p>Custom Sports Wears does not keep stock. All products are made to order based on customer inquiries. The product images on our website are samples to illustrate what we can do and how the products will look.</p>\r\n</li>\r\n<li>\r\n<p>Customers can submit their inquiries and receive a free quotation. Upon order confirmation, an invoice will be issued, and customers are required to pay 60% of the total cost in advance. The remaining 40% is due once the shipment is ready for delivery.</p>\r\n</li>\r\n<li>\r\n<p>The \"Add to Cart\" function serves as an inquiry cart. Customers can add desired products to the inquiry cart and send it to us for a quotation.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">User Accounts</strong></p>\r\n<ul>\r\n<li>\r\n<p>If you create an account on the website, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer. You agree to accept responsibility for all activities that occur under your account or password.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Product Information</strong></p>\r\n<ul>\r\n<li>\r\n<p>Custom Sports Wears strives for accuracy in the description and pricing of products. However, we do not warrant that product descriptions or other content on this site are accurate, complete, reliable, current, or error-free.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Payments and Pricing</strong></p>\r\n<ul>\r\n<li>\r\n<p>Prices for our products are not listed on the website. Quotations are provided based on customer inquiries.</p>\r\n</li>\r\n<li>\r\n<p>We accept various payment methods. By placing an order, you agree to pay the applicable charges for the products ordered, including shipping and handling charges, as stated on the quotation and invoice.</p>\r\n</li>\r\n<li>\r\n<p>For detailed information on shipping, payment, and orders, please visit our <a href=\"../../Pages/11_about-us.html\">About Us</a> page.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Shipping and Delivery</strong></p>\r\n<ul>\r\n<li>\r\n<p>All orders are subject to product availability. If an item is not in stock at the time you place your order, we will notify you and refund you the total amount of your order using the original method of payment.</p>\r\n</li>\r\n<li>\r\n<p>Delivery times may vary depending on your location and the availability of products.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Return and Exchange Policy</strong></p>\r\n<ul>\r\n<li>\r\n<p>For information on returns and exchanges, please refer to our <a href=\"../../Pages/22_exchange-return-policy-custom-sports-wears.html\">Exchange &amp; Return Policy</a>.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Privacy</strong></p>\r\n<ul>\r\n<li>\r\n<p>Your use of the website is also governed by our <a href=\"../../Pages/23_privacy-policy-custom-sports-wears-your-privacy-matters.html\">Privacy Policy</a>.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Limitation of Liability</strong></p>\r\n<ul>\r\n<li>\r\n<p>Custom Sports Wears shall not be liable for any damages that result from the use of, or the inability to use, the materials on this site or the performance of the products, even if Custom Sports Wears has been advised of the possibility of such damages.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Governing Law</strong></p>\r\n<ul>\r\n<li>\r\n<p>These terms and conditions are governed by and construed in accordance with the laws of Pakistan, and you irrevocably submit to the exclusive jurisdiction of the courts in that location.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Changes to Terms and Conditions</strong></p>\r\n<ul>\r\n<li>\r\n<p>Custom Sports Wears reserves the right to change or update these terms and conditions at any time. Any changes will be effective immediately upon posting to the website. Your continued use of the website constitutes your agreement to such changes.</p>\r\n</li>\r\n</ul>\r\n<p><strong class=\"t-h2\">Contact Us</strong></p>\r\n<p>If you have any questions about our Terms and Conditions, please contact us at +923333336426 or email us at info@shonir.com.</p>', '<p>Read the Terms and Conditions of SHONiR CMS. Understand the rules and regulations for using our website, including product information, user accounts, payments, shipping, returns, and privacy. Stay informed about your rights and obligations.</p>', 'Terms and Conditions - SHONiR CMS: Website Use and Policies', 'Read the Terms and Conditions of SHONiR CMS. Understand the rules and regulations for using our website, including product information, user accounts, payments, shipping, returns, and privacy. Stay informed about your rights and obligations.', 'terms and conditions, website policies, Custom Sports Wears, user agreements, product information, user accounts, payments, shipping policy, return policy, privacy policy, website rules, legal terms', 1, 1, 1, 0, 1, 1, 1, 1767548699, 1, 1772613644, 1185, 1, 1185, 1772613644, 1772613644, 99, 5, '495', 99, 'psG1PYYjtJzMpfDr', 1749059099, 0, '127.0.0.1', 1772104377, 1, '59.103.124.231'),
(29, 0, 0, 'shonir-cms-your-one-stop-shop-for-premium-sports-and-cu', 'SHONiR CMS: Your One-Stop Shop for Premium Sports and Custom Apparel', 'Our Products Line', '<p>Welcome to Custom Sports Wears! Discover our extensive range of top-quality, customizable apparel designed to meet all your needs. Each category offers unique products tailored to enhance your performance, style, and comfort. Dive into our categories and explore the perfect fit for you.</p>\r\n<h3 class=\"t-h2\">Sports Wear</h3>\r\n<p>Gear up with our versatile sportswear collection, crafted for optimal performance and comfort. Whether you\'re training, competing, or simply staying active, our sportswear ensures you look and feel your best. <strong><a href=\"../../Sections/45_custom-sports-wear-for-all-ages-and-skill-levels-personalized-uniforms\"><span class=\"t-h3\">Explore now and add to your Enquiry Basket for a free quotation</span></a>.</strong></p>\r\n<h3 class=\"t-h2\">Fitness Wear</h3>\r\n<p>Elevate your workout with our premium fitness wear. Designed for durability and flexibility, our fitness apparel supports you through every rep, stride, and stretch, keeping you motivated and comfortable. <strong><a href=\"../../Sections/46_premium-fitness-wear-for-men-and-women-custom-gym-apparel\"><span class=\"t-h3\">Explore now and add to your Enquiry Basket for a free quotation</span></a>.</strong></p>\r\n<h3 class=\"t-h2\">Boxing Wear</h3>\r\n<p>Step into the ring with confidence in our high-performance boxing wear. From gloves to shorts and protective gear, we provide everything you need to train hard and fight smart. <strong><a href=\"../../Sections/47_custom-boxing-wear-high-quality-gear-for-fighters-and-fitness-enthusiasts\"><span class=\"t-h3\">Explore now and add to your Enquiry Basket for a free quotation</span></a>.</strong></p>\r\n<h3 class=\"t-h2\">Fashion Jackets</h3>\r\n<p>Make a statement with our stylish fashion jackets. Perfect for any occasion, our jackets combine modern design with high-quality materials, offering both functionality and flair. <strong><a href=\"../../Sections/48_fashion-jackets\"><span class=\"t-h3\">Explore now and add to your Enquiry Basket for a free quotation</span></a>.</strong></p>\r\n<h3 class=\"t-h2\">Working Wear</h3>\r\n<p>Stay protected and comfortable on the job with our durable working wear. Designed for various industries, our workwear provides the safety and flexibility you need to perform your tasks efficiently. <strong><a href=\"../../Sections/50_working-wear\"><span class=\"t-h3\">Explore now and add to your Enquiry Basket for a free quotation</span></a>.</strong></p>\r\n<h3 class=\"t-h2\">Motorbike Wear</h3>\r\n<p>Hit the road with our robust motorbike wear. Our gear is designed to offer maximum protection, comfort, and style for every ride, ensuring you stay safe while looking sharp. <strong><a href=\"../../Sections/49_motorbike-wear\"><span class=\"t-h3\">Explore now and add to your Enquiry Basket for a free quotation</span></a>.</strong></p>\r\n<h3 class=\"t-h2\">Leather Collection</h3>\r\n<p>Indulge in the luxury of our leather collection. Crafted from the finest materials, our leather products exude elegance and durability, making them a timeless addition to your wardrobe. <strong><a href=\"../../Sections/51_leather-collection\"><span class=\"t-h3\">Explore now and add to your Enquiry Basket for a free quotation</span></a>.</strong></p>\r\n<h3 class=\"t-h2\">Cycling Wear</h3>\r\n<p>Ride with confidence in our cycling wear. Engineered for performance and comfort, our cycling apparel enhances your riding experience, whether you\'re tackling tough trails or cruising city streets. <strong><a href=\"../../Sections/137_cycling-wear\"><span class=\"t-h3\">Explore now and add to your Enquiry Basket for a free quotation</span></a>.</strong></p>\r\n<p>&nbsp;</p>\r\n<p><strong><em><span style=\"text-decoration: underline;\">Explore our collections, add your favorites to the Enquiry Basket, and request a free quotation to start your journey with Custom Sports Wears today. Experience the best in custom apparel and let us help you create your perfect fit.</span></em></strong></p>', '<p>Explore SHONiR CMS\' extensive range of top-quality, customizable apparel. From sports wear and fitness wear to boxing wear, fashion jackets, working wear, motorbike wear, leather collection, and cycling wear, we offer products tailored to enhance your performance, style, and comfort. Add items to your Enquiry Basket for free quotations and enjoy a seamless, secure, and personalized shopping experience. Start your journey with us today and bring your sportswear vision to life!</p>', 'SHONiR CMS: Your One-Stop Shop for Premium Sports and Custom Apparel', 'Explore SHONiR CMS\' extensive range of top-quality, customizable apparel. From sports wear and fitness wear to boxing wear, fashion jackets, working wear, motorbike wear, leather collection, and cycling wear, we offer products tailored to enhance your performance, style, and comfort. Add items to your Enquiry Basket for free quotations and enjoy a seamless, secure, and personalized shopping experience. Start your journey with us today and bring your sportswear vision to life!', 'Custom sportswear,  Premium sportswear,  Sports wear,  Fitness wear,  Boxing wear,  Fashion jackets,  Working wear,  Motorbike wear,  Leather collection,  Cycling wear,  Custom apparel,  Free quotation,  Enquiry basket,  Personalized sportswear,  Custom order process,  High-quality sportswear', 1, 1, 1, 0, 1, 0, 0, 1767548699, 1, 1762785638, 1034, 1, 1034, 1762785638, 1762785638, 99, 5, '495', 99, 'CDdMALMrUMmgjrrb', 1749059099, 0, '127.0.0.1', 1772103967, 1, '59.103.124.231');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages_to_pages`
--

CREATE TABLE `tbl_pages_to_pages` (
  `parent_id` int(11) NOT NULL,
  `children_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_places`
--

CREATE TABLE `tbl_places` (
  `place_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `items` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `bottom` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ratings`
--

CREATE TABLE `tbl_ratings` (
  `rating_id` int(11) NOT NULL,
  `parent_type` varchar(190) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_regions`
--

CREATE TABLE `tbl_regions` (
  `region_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `items` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `bottom` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sections`
--

CREATE TABLE `tbl_sections` (
  `section_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `items` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `bottom` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_talents`
--

CREATE TABLE `tbl_talents` (
  `talent_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `type_id` int(11) NOT NULL DEFAULT 0,
  `items` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `bottom` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uploads`
--

CREATE TABLE `tbl_uploads` (
  `upload_id` int(11) NOT NULL,
  `upload_type` varchar(190) NOT NULL DEFAULT 'image',
  `upload_file` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `parent_type` varchar(190) NOT NULL,
  `sort_order` int(5) NOT NULL DEFAULT 0,
  `add_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL,
  `token` varchar(190) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_uploads`
--

INSERT INTO `tbl_uploads` (`upload_id`, `upload_type`, `upload_file`, `parent_id`, `parent_type`, `sort_order`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`, `token`) VALUES
(1, 'image', 'n-a-1771837399_d2cf8bc63d74b8dc68e4.webp', 1, 'banners_images', 0, 1771837399, 1, '59.103.124.231', 1771837933, 1, '59.103.124.231', 'Phxfm4RGHqfy71es'),
(2, 'image', 'n-a-1771837501_6da1ce153e1c98498ddb.webp', 2, 'banners_images', 0, 1771837501, 1, '59.103.124.231', 1771838117, 1, '59.103.124.231', 'ejJaqiNFGDKuBtix'),
(6, 'image', 'jeans-to-know-by-name-1771838254_5b4d0f47f81450d99617.webp', 3, 'banners_images', 0, 1771838254, 1, '59.103.124.231', 573091200, 0, NULL, 'CtFqEjc3S4ty1PWb'),
(4, 'image', 'n-a-1771837572_f2e1fa4a32a8c2419c8f.webp', 4, 'banners_images', 0, 1771837572, 1, '59.103.124.231', 1771838472, 1, '59.103.124.231', 'cBT8Mp35M68h7TdQ'),
(5, 'image', 'n-a-1771837591_2b499a8d832fc095b2b2.webp', 5, 'banners_images', 0, 1771837591, 1, '59.103.124.231', 1771838568, 1, '59.103.124.231', 'wzTQpQBayCEumjiJ'),
(7, 'image', 'women-s-1771839348_1b0012edb541c5d1fd10.jpg', 2, 'categories_images', 0, 1771839348, 1, '59.103.124.231', 1772259690, 1, '59.103.124.231', 'fULsaEGsmy7FCNXb'),
(8, 'image', 'men-s-1771839373_2b4f20eb8b9eeac01c2b.jpg', 1, 'categories_images', 0, 1771839373, 1, '59.103.124.231', 1772259593, 1, '59.103.124.231', 'tb7egPMvfFzbsApY'),
(9, 'image', 'kids-1771839477_9b08c1fd0158d702d6c4.jpg', 3, 'categories_images', 0, 1771839477, 1, '59.103.124.231', 1772102572, 1, '59.103.124.231', '3pmY3qr1acnfFNYT'),
(10, 'image', 'bags-1771841630_c182a86dc7f79a19433f.jpg', 4, 'categories_images', 0, 1771841630, 1, '59.103.124.231', 1772102696, 1, '59.103.124.231', 'KjtX7wQXEL8Q74Vp'),
(11, 'image', 'blazer-1771841636_bbd7f6a2aaa3d24260b5.jpg', 5, 'categories_images', 0, 1771841636, 1, '59.103.124.231', 1772102809, 1, '59.103.124.231', 'LUm5SWMj7hxfBRev'),
(12, 'image', 'shoes-1771841711_8dda9f590af8d8a4d001.jpg', 6, 'categories_images', 0, 1771841711, 1, '59.103.124.231', 1772102937, 1, '59.103.124.231', 'UsBAPYC8TMcNHNcG'),
(14, 'image', 'old-money-quiet-luxury-on-london-streets-what-real-men-are-wearing-in-2026-1771919317_442aa49f81e98daff486.jpg', 1, 'galleries_images', 0, 1771919317, 1, '59.103.124.231', 1771919463, 1, '59.103.124.231', 'eKLqbSDeLw295nMj'),
(15, 'image', 'stylish-leather-jacket-outfit-ideas-for-men-2025-fall-winter-modern-trendy-1771919685_bd846c1822668a616191.jpg', 2, 'galleries_images', 0, 1771919685, 1, '59.103.124.231', 573091200, 0, NULL, 'uS1s0sKqT0Er2tWm'),
(16, 'image', 'the-one-leather-jacket-every-man-over-50-needs-and-how-to-wear-it-right-1771919817_b7673410e9168a62d7cb.jpg', 3, 'galleries_images', 0, 1771919817, 1, '59.103.124.231', 1771923688, 1, '59.103.124.231', 'jYYYueS5XnvnM9JX'),
(17, 'image', 'm-s-men-s-style-the-art-of-tailoring-tv-ad-2016-1771920015_828322f2bd68b7014ae7.jpg', 4, 'galleries_images', 0, 1771920015, 1, '59.103.124.231', 1771923688, 1, '59.103.124.231', '9q4Yta8sM4eb5MLA'),
(18, 'image', 'sherri-hill-spring-summer-2026-new-york-fashion-week-1771920179_94fd59209c265395c478.jpg', 5, 'galleries_images', 0, 1771920179, 1, '59.103.124.231', 573091200, 0, NULL, 'BKkELARy3T6PdtXS'),
(19, 'image', 'rethink-fashion-2025-2026-what-no-one-s-telling-you-about-this-year-s-trends-1771920414_b475d750d4d2365289ea.jpg', 6, 'galleries_images', 0, 1771920414, 1, '59.103.124.231', 1771923688, 1, '59.103.124.231', '1Axhu7PGe9rGpgc4'),
(20, 'image', 'winter-fashion-2025-10-trends-to-embrace-and-5-to-ditch-1771920549_bbca41cc23fdba24a67a.jpg', 7, 'galleries_images', 0, 1771920549, 1, '59.103.124.231', 573091200, 0, NULL, 'AqHMgqZu6e8yMrjU'),
(21, 'image', 'beautiful-italian-street-style-may-2025-best-fashion-looks-from-the-world-s-fashion-capital-1771920797_20c29e18fefafc048700.jpg', 8, 'galleries_images', 0, 1771920797, 1, '59.103.124.231', 573091200, 0, NULL, 'yA2DZX8DLzsWTXLG'),
(22, 'image', 'italian-fashion-street-style-2026-chic-in-the-cold-italian-street-style-fashion-trends-in-february-1771920973_6589fb4a16d9a72a7fc7.jpg', 9, 'galleries_images', 0, 1771920973, 1, '59.103.124.231', 573091200, 0, NULL, '55SzxrPHifY1NjTE'),
(23, 'image', 'unique-italian-street-style-discover-the-best-italian-trends-for-summer-2024-luxury-shopping-walk-1771921304_a7238566674a04fc6e05.jpg', 10, 'galleries_images', 0, 1771921304, 1, '59.103.124.231', 573091200, 0, NULL, 'RJXyZtxheDE6s45g'),
(24, 'image', 'top-5-handbag-trends-2025-you-need-to-know-1771921584_9a7f04c7e3153d161b9c.jpg', 11, 'galleries_images', 0, 1771921584, 1, '59.103.124.231', 573091200, 0, NULL, 'ZUV7MnK8hPyM8UwN'),
(25, 'image', 'men-blazer-style-1771926026_b3539f3a361ae005c870.jpg', 12, 'galleries_images', 0, 1771926026, 1, '59.103.124.231', 1772000953, 1, '59.103.124.231', 'Mwf8WFfVUyB93Q3e'),
(26, 'image', 'denim-jeans-and-shoes-1771999052_07d97148ecd177803c78.jpg', 13, 'galleries_images', 0, 1771999052, 1, '59.103.124.231', 573091200, 0, NULL, '093DsP448LWXV8zJ'),
(27, 'image', 'kids-leather-and-denim-jeans-jackets-1771999141_ee2a84634fa06c10b4d3.jpg', 14, 'galleries_images', 0, 1771999141, 1, '59.103.124.231', 573091200, 0, NULL, 'nR6FzNNSziTtqpNK'),
(28, 'image', 'women-wear-blazer-and-brown-shoes-1771999259_06ed744cdc06a00ea421.jpg', 15, 'galleries_images', 0, 1771999259, 1, '59.103.124.231', 573091200, 0, NULL, 'FTTSh2huvuqPwy6c'),
(29, 'image', 'ladies-bag-1771999709_bc4960e404e205d19f1d.jpg', 16, 'galleries_images', 0, 1771999709, 1, '59.103.124.231', 573091200, 0, NULL, 'RLZgAV24BikQ3Zqt'),
(30, 'image', 'men-brown-blazer-style-1771999761_5576b0fc36ddd966bb54.jpg', 17, 'galleries_images', 0, 1771999761, 1, '59.103.124.231', 1772000953, 1, '59.103.124.231', 'rD6mVhtk5GL7UQY0'),
(31, 'image', 'street-style-fashion-three-girls-professional-model-1771999840_6b5a0695ad84e6bd2141.jpg', 18, 'galleries_images', 0, 1771999840, 1, '59.103.124.231', 1772000332, 1, '59.103.124.231', 'dwN89uS9TDYiMjGL'),
(32, 'image', 'a-young-brunette-woman-in-green-coat-1772000444_facbc5f46be0226a76d6.jpg', 19, 'galleries_images', 0, 1772000444, 1, '59.103.124.231', 573091200, 0, NULL, 'AasBxA2hPq8hQqTT'),
(33, 'image', 'happy-woman-dance-motion-wear-lime-yellow-flared-outfit-jumper-1772000680_42c17ec7cbfe6bded316.jpg', 20, 'galleries_images', 0, 1772000680, 1, '59.103.124.231', 573091200, 0, NULL, 'D0QiJhYGSmRa1SsP'),
(34, 'image', 'a-stylish-young-man-poses-in-a-black-coat-and-yellow-beanie-1772001290_72b708da007aa41ba0e2.jpg', 21, 'galleries_images', 0, 1772001290, 1, '59.103.124.231', 573091200, 0, NULL, 'aGYff5nK3Tm7A2qK'),
(35, 'image', 'trendy-young-man-in-sunglasses-posing-near-the-wall-on-the-street-on-a-summer-day-1772001343_ce4da0101a12078f1c5e.jpg', 22, 'galleries_images', 0, 1772001343, 1, '59.103.124.231', 573091200, 0, NULL, 'vwvpc8uUuzhHUVrM'),
(36, 'image', 'beautiful-girl-wear-leather-jacket-in-the-city-1772001440_f9d9e2b0baf6368298e3.jpg', 23, 'galleries_images', 0, 1772001440, 1, '59.103.124.231', 573091200, 0, NULL, '6DKqw45kvcwFm2LG'),
(37, 'image', 'fashionable-confident-beautiful-woman-wearing-trendy-burgundy-leather-raincoat-1772001479_5112a78084467a012354.jpg', 24, 'galleries_images', 0, 1772001479, 1, '59.103.124.231', 573091200, 0, NULL, 'zEDvdZ8kBWrajiAM'),
(38, 'image', 'hipster-in-leather-jacket-1772001711_42b1a710ebd3978ac79b.jpg', 25, 'galleries_images', 0, 1772001711, 1, '59.103.124.231', 573091200, 0, NULL, 'bAHq3faXh0YkY5fb'),
(39, 'image', 'baby-girls-wear-leather-jackets-1772001828_7df13d39d0ebfa8f1f1d.jpg', 26, 'galleries_images', 0, 1772001828, 1, '59.103.124.231', 573091200, 0, NULL, 'Bggj9EhCvQmr5tjW'),
(40, 'image', 'serious-fashionable-woman-with-black-sunglasses-on-her-eyes-looking-away-1772002057_8f5635b5de6b851c43fe.jpg', 27, 'galleries_images', 0, 1772002057, 1, '59.103.124.231', 573091200, 0, NULL, 'jMfZHv0Ja3dK78Jd'),
(41, 'image', 'lpm-leather-fashion-house-natural-leather-pants-1772002335_2fdc45af67ca953e454c.jpg', 28, 'galleries_images', 0, 1772002335, 1, '59.103.124.231', 573091200, 0, NULL, 'emPt8VnfJffbsz4S'),
(42, 'image', 'buying-a-leather-jacket-for-life-1772002439_14ee2066a11d3e825401.jpg', 29, 'galleries_images', 0, 1772002439, 1, '59.103.124.231', 573091200, 0, NULL, 'CYqEW41TPrDn8Exm'),
(45, 'image', 'welcome-to-shonir-cms-where-leather-meets-luxury-1772105104_72e1bbaecaf01d122143.jpg', 10, 'pages_images', 0, 1772105104, 1, '59.103.124.231', 573091200, 0, NULL, 'iadnBSv6Hi6PHxUm'),
(46, 'image', 'men-s-black-harrington-classic-leather-jacket-1772260741_e16d7f505016f41b4218.webp', 1, 'items_images', 3, 1772260741, 1, '59.103.124.231', 573091200, 0, NULL, '4LvkfJ5EF5GM50dU'),
(47, 'image', 'men-s-black-harrington-classic-leather-jacket-1772260741_7e990d3491c60d6493c7.webp', 1, 'items_images', 1, 1772260741, 1, '59.103.124.231', 573091200, 0, NULL, '4LvkfJ5EF5GM50dU'),
(48, 'image', 'men-s-black-harrington-classic-leather-jacket-1772260741_82320b866bfb092a236c.webp', 1, 'items_images', 2, 1772260741, 1, '59.103.124.231', 573091200, 0, NULL, '4LvkfJ5EF5GM50dU'),
(49, 'image', 'men-s-black-harrington-classic-leather-jacket-1772260741_dab4cab57b661b4c721d.webp', 1, 'items_images', 0, 1772260741, 1, '59.103.124.231', 573091200, 0, NULL, '4LvkfJ5EF5GM50dU'),
(50, 'image', 'men-s-black-harrington-classic-leather-jacket-1772260741_cfdcf96c54c520ff73ae.webp', 1, 'items_images', 4, 1772260741, 1, '59.103.124.231', 573091200, 0, NULL, '4LvkfJ5EF5GM50dU'),
(51, 'image', 'men-s-black-harrington-classic-leather-jacket-1772260741_6855b9020bf1da6c3d63.webp', 1, 'items_images', 5, 1772260741, 1, '59.103.124.231', 573091200, 0, NULL, '4LvkfJ5EF5GM50dU'),
(52, 'image', 'men-s-black-distressed-washed-real-leather-trucker-jacket-1772261049_e414269844e3370bfd7c.webp', 2, 'items_images', 5, 1772261049, 1, '59.103.124.231', 1772261356, 1, '59.103.124.231', '4RagWSvPA8P7pKeL'),
(53, 'image', 'men-s-black-distressed-washed-real-leather-trucker-jacket-1772261049_220d45a8b27fc292c449.webp', 2, 'items_images', 0, 1772261049, 1, '59.103.124.231', 1772261356, 1, '59.103.124.231', '4RagWSvPA8P7pKeL'),
(54, 'image', 'men-s-black-distressed-washed-real-leather-trucker-jacket-1772261049_0040b94a535aa17fac49.webp', 2, 'items_images', 4, 1772261049, 1, '59.103.124.231', 1772261356, 1, '59.103.124.231', '4RagWSvPA8P7pKeL'),
(55, 'image', 'men-s-black-distressed-washed-real-leather-trucker-jacket-1772261049_385f82f1db23627ba0f0.webp', 2, 'items_images', 1, 1772261049, 1, '59.103.124.231', 1772261356, 1, '59.103.124.231', '4RagWSvPA8P7pKeL'),
(56, 'image', 'men-s-black-distressed-washed-real-leather-trucker-jacket-1772261049_48ba84c79d96f1671a24.webp', 2, 'items_images', 2, 1772261049, 1, '59.103.124.231', 1772261356, 1, '59.103.124.231', '4RagWSvPA8P7pKeL'),
(57, 'image', 'men-s-black-distressed-washed-real-leather-trucker-jacket-1772261049_5c77798d3653df7c33e5.webp', 2, 'items_images', 3, 1772261049, 1, '59.103.124.231', 1772261356, 1, '59.103.124.231', '4RagWSvPA8P7pKeL'),
(58, 'image', 'men-off-white-real-leather-harrington-jacket-1772261189_14d438a9dbbc4365aeee.webp', 3, 'items_images', 0, 1772261189, 1, '59.103.124.231', 573091200, 0, NULL, 'V16dtP0QeQUtdQsN'),
(59, 'image', 'men-off-white-real-leather-harrington-jacket-1772261189_92d7403d896a92cd44e6.webp', 3, 'items_images', 1, 1772261189, 1, '59.103.124.231', 573091200, 0, NULL, 'V16dtP0QeQUtdQsN'),
(60, 'image', 'men-off-white-real-leather-harrington-jacket-1772261189_46414f325cd4e2adec15.webp', 3, 'items_images', 2, 1772261189, 1, '59.103.124.231', 573091200, 0, NULL, 'V16dtP0QeQUtdQsN'),
(61, 'image', 'men-off-white-real-leather-harrington-jacket-1772261189_fb8201536abee48b6459.webp', 3, 'items_images', 5, 1772261189, 1, '59.103.124.231', 573091200, 0, NULL, 'V16dtP0QeQUtdQsN'),
(62, 'image', 'men-off-white-real-leather-harrington-jacket-1772261189_7d79ed57dfe85b9f7c46.webp', 3, 'items_images', 6, 1772261189, 1, '59.103.124.231', 573091200, 0, NULL, 'V16dtP0QeQUtdQsN'),
(63, 'image', 'men-off-white-real-leather-harrington-jacket-1772261189_6aa365dfd000f0fc3681.webp', 3, 'items_images', 3, 1772261189, 1, '59.103.124.231', 573091200, 0, NULL, 'V16dtP0QeQUtdQsN'),
(64, 'image', 'men-off-white-real-leather-harrington-jacket-1772261189_eb88effe5846d2a8c891.webp', 3, 'items_images', 4, 1772261189, 1, '59.103.124.231', 573091200, 0, NULL, 'V16dtP0QeQUtdQsN'),
(65, 'image', 'black-bomber-men-s-leather-jacket-with-removable-hood-1772261439_e077144c3b4eba2a86ef.webp', 4, 'items_images', 0, 1772261439, 1, '59.103.124.231', 573091200, 0, NULL, '9HrKUDnXmLUxJ0KS'),
(66, 'image', 'black-bomber-men-s-leather-jacket-with-removable-hood-1772261439_35a8cdc880e982d0ba8e.webp', 4, 'items_images', 1, 1772261439, 1, '59.103.124.231', 573091200, 0, NULL, '9HrKUDnXmLUxJ0KS'),
(67, 'image', 'black-bomber-men-s-leather-jacket-with-removable-hood-1772261439_edebe7b20d6a7b107e48.webp', 4, 'items_images', 2, 1772261439, 1, '59.103.124.231', 573091200, 0, NULL, '9HrKUDnXmLUxJ0KS'),
(68, 'image', 'black-bomber-men-s-leather-jacket-with-removable-hood-1772261439_5c43e1dcfb9f8202d8e1.webp', 4, 'items_images', 3, 1772261439, 1, '59.103.124.231', 573091200, 0, NULL, '9HrKUDnXmLUxJ0KS'),
(69, 'image', 'black-bomber-men-s-leather-jacket-with-removable-hood-1772261439_a1cae97491a05a6faacb.webp', 4, 'items_images', 4, 1772261439, 1, '59.103.124.231', 573091200, 0, NULL, '9HrKUDnXmLUxJ0KS'),
(70, 'image', 'black-bomber-men-s-leather-jacket-with-removable-hood-1772261439_96117a9411b70528f095.webp', 4, 'items_images', 5, 1772261439, 1, '59.103.124.231', 573091200, 0, NULL, '9HrKUDnXmLUxJ0KS'),
(71, 'image', 'dodge-men-s-cafe-racer-blue-leather-jacket-1772266951_58afd61f7e9a67b7a32f.webp', 5, 'items_images', 0, 1772266951, 1, '2400:adc7:193c:5200:a86e:e76e:1613:6f2b', 1772272510, 1, '59.103.124.231', 'GXRygmm8NCNMvQ4e'),
(72, 'image', 'dodge-men-s-cafe-racer-blue-leather-jacket-1772266951_ecef2c669abc8c366d33.webp', 5, 'items_images', 1, 1772266951, 1, '2400:adc7:193c:5200:a86e:e76e:1613:6f2b', 1772272510, 1, '59.103.124.231', 'GXRygmm8NCNMvQ4e'),
(73, 'image', 'dodge-men-s-cafe-racer-blue-leather-jacket-1772266951_a67c440eedf33b00ef20.webp', 5, 'items_images', 2, 1772266951, 1, '2400:adc7:193c:5200:a86e:e76e:1613:6f2b', 1772272510, 1, '59.103.124.231', 'GXRygmm8NCNMvQ4e'),
(74, 'image', 'dodge-men-s-cafe-racer-blue-leather-jacket-1772266951_f7daad77c9cb660e8ccb.webp', 5, 'items_images', 3, 1772266951, 1, '2400:adc7:193c:5200:a86e:e76e:1613:6f2b', 1772272510, 1, '59.103.124.231', 'GXRygmm8NCNMvQ4e'),
(75, 'image', 'negan-men-s-black-leather-biker-style-jacket-1772267146_0a4fc7004d9427a93743.webp', 6, 'items_images', 0, 1772267146, 1, '2400:adc7:193c:5200:a86e:e76e:1613:6f2b', 1772272586, 1, '59.103.124.231', 'hSHW5N1VJTUihW5w'),
(76, 'image', 'negan-men-s-black-leather-biker-style-jacket-1772267146_27a61cdbfb70797dcd3e.webp', 6, 'items_images', 1, 1772267146, 1, '2400:adc7:193c:5200:a86e:e76e:1613:6f2b', 1772272586, 1, '59.103.124.231', 'hSHW5N1VJTUihW5w'),
(77, 'image', 'negan-men-s-black-leather-biker-style-jacket-1772267146_c1f18f5072559ef1b819.webp', 6, 'items_images', 2, 1772267146, 1, '2400:adc7:193c:5200:a86e:e76e:1613:6f2b', 1772272586, 1, '59.103.124.231', 'hSHW5N1VJTUihW5w'),
(78, 'image', 'negan-men-s-black-leather-biker-style-jacket-1772267146_6c94108778ac0ce0eefd.webp', 6, 'items_images', 3, 1772267146, 1, '2400:adc7:193c:5200:a86e:e76e:1613:6f2b', 1772272586, 1, '59.103.124.231', 'hSHW5N1VJTUihW5w'),
(79, 'image', 'negan-men-s-black-leather-biker-style-jacket-1772267146_923432e7124e6656cda9.webp', 6, 'items_images', 4, 1772267146, 1, '2400:adc7:193c:5200:a86e:e76e:1613:6f2b', 1772272586, 1, '59.103.124.231', 'hSHW5N1VJTUihW5w'),
(80, 'image', 'men-s-black-lambskin-leather-cafe-racer-jacket-1772271412_37095fe354db1f0587b0.webp', 7, 'items_images', 0, 1772271412, 1, '154.80.39.210', 1772272426, 1, '59.103.124.231', 'qinctA5NL6iApxhE'),
(81, 'image', 'men-s-black-lambskin-leather-cafe-racer-jacket-1772271412_eaf23091706b3ec415c7.webp', 7, 'items_images', 1, 1772271412, 1, '154.80.39.210', 1772272426, 1, '59.103.124.231', 'qinctA5NL6iApxhE'),
(82, 'image', 'men-s-black-lambskin-leather-cafe-racer-jacket-1772271412_07b7db3c965b54a3507b.webp', 7, 'items_images', 4, 1772271412, 1, '154.80.39.210', 1772272426, 1, '59.103.124.231', 'qinctA5NL6iApxhE'),
(83, 'image', 'men-s-black-lambskin-leather-cafe-racer-jacket-1772271412_8cce87908538f39a6901.webp', 7, 'items_images', 2, 1772271412, 1, '154.80.39.210', 1772272426, 1, '59.103.124.231', 'qinctA5NL6iApxhE'),
(84, 'image', 'men-s-black-lambskin-leather-cafe-racer-jacket-1772271412_9b4cfdb8d8f58b609aac.webp', 7, 'items_images', 3, 1772271412, 1, '154.80.39.210', 1772272426, 1, '59.103.124.231', 'qinctA5NL6iApxhE'),
(85, 'image', 'men-s-camel-brown-trucker-leather-jacket-1772271682_168719a1721a2157936f.webp', 8, 'items_images', 0, 1772271682, 1, '154.80.39.210', 573091200, 0, NULL, '52imFJR5rJ2ZCwMR'),
(86, 'image', 'men-s-camel-brown-trucker-leather-jacket-1772271682_22edec8e6e6e997e1036.webp', 8, 'items_images', 1, 1772271682, 1, '154.80.39.210', 573091200, 0, NULL, '52imFJR5rJ2ZCwMR'),
(87, 'image', 'men-s-camel-brown-trucker-leather-jacket-1772271682_864628a013da64812ede.webp', 8, 'items_images', 2, 1772271682, 1, '154.80.39.210', 573091200, 0, NULL, '52imFJR5rJ2ZCwMR'),
(88, 'image', 'men-s-camel-brown-trucker-leather-jacket-1772271682_2c4a01acd967c638eede.webp', 8, 'items_images', 3, 1772271682, 1, '154.80.39.210', 573091200, 0, NULL, '52imFJR5rJ2ZCwMR'),
(89, 'image', 'women-s-black-real-leather-jacket-with-removable-hood-1772273549_5e331be976010f837553.webp', 9, 'items_images', 0, 1772273549, 1, '59.103.124.231', 573091200, 0, NULL, 'hHRKaqDFHy7hXL34'),
(90, 'image', 'women-s-black-real-leather-jacket-with-removable-hood-1772273549_1681f5ded5862f37d70d.webp', 9, 'items_images', 1, 1772273549, 1, '59.103.124.231', 573091200, 0, NULL, 'hHRKaqDFHy7hXL34'),
(91, 'image', 'women-s-black-real-leather-jacket-with-removable-hood-1772273549_7325d3742c1aecefba18.webp', 9, 'items_images', 2, 1772273549, 1, '59.103.124.231', 573091200, 0, NULL, 'hHRKaqDFHy7hXL34'),
(92, 'image', 'women-s-black-real-leather-jacket-with-removable-hood-1772273549_1d8ed0a23f8602b7438a.webp', 9, 'items_images', 3, 1772273549, 1, '59.103.124.231', 573091200, 0, NULL, 'hHRKaqDFHy7hXL34'),
(93, 'image', 'women-s-black-real-leather-jacket-with-removable-hood-1772273549_fee9f2929c50731a0d3e.webp', 9, 'items_images', 4, 1772273549, 1, '59.103.124.231', 573091200, 0, NULL, 'hHRKaqDFHy7hXL34'),
(94, 'image', 'women-s-black-real-leather-jacket-with-removable-hood-1772273549_9006e137e62d066d6958.webp', 9, 'items_images', 5, 1772273549, 1, '59.103.124.231', 573091200, 0, NULL, 'hHRKaqDFHy7hXL34'),
(95, 'image', 'fernando-women-s-cognac-brown-trucker-leather-jacket-1772273699_74ec9322dbd3727bc166.webp', 10, 'items_images', 0, 1772273699, 1, '59.103.124.231', 573091200, 0, NULL, 'Dv78CR9cEpiMigxc'),
(96, 'image', 'fernando-women-s-cognac-brown-trucker-leather-jacket-1772273699_c4f900b998fd0ba694ca.webp', 10, 'items_images', 1, 1772273699, 1, '59.103.124.231', 573091200, 0, NULL, 'Dv78CR9cEpiMigxc'),
(97, 'image', 'fernando-women-s-cognac-brown-trucker-leather-jacket-1772273699_cc2c54db480f7bda4755.webp', 10, 'items_images', 2, 1772273699, 1, '59.103.124.231', 573091200, 0, NULL, 'Dv78CR9cEpiMigxc'),
(98, 'image', 'fernando-women-s-cognac-brown-trucker-leather-jacket-1772273699_d4b8832487dc89144e62.webp', 10, 'items_images', 3, 1772273699, 1, '59.103.124.231', 573091200, 0, NULL, 'Dv78CR9cEpiMigxc'),
(99, 'image', 'bari-black-women-s-real-leather-biker-jacket-1772273928_100c4c568654a218b9a9.webp', 11, 'items_images', 1, 1772273928, 1, '59.103.124.231', 573091200, 0, NULL, '4pv7JY9cKbBjNKSW'),
(100, 'image', 'bari-black-women-s-real-leather-biker-jacket-1772273928_d0ae9e9c1a169329e1cf.webp', 11, 'items_images', 0, 1772273928, 1, '59.103.124.231', 573091200, 0, NULL, '4pv7JY9cKbBjNKSW'),
(101, 'image', 'bari-black-women-s-real-leather-biker-jacket-1772273928_6178ad29da7d8a66d081.webp', 11, 'items_images', 2, 1772273928, 1, '59.103.124.231', 573091200, 0, NULL, '4pv7JY9cKbBjNKSW'),
(102, 'image', 'bari-black-women-s-real-leather-biker-jacket-1772273928_398f667211a1cd8077f8.webp', 11, 'items_images', 4, 1772273928, 1, '59.103.124.231', 573091200, 0, NULL, '4pv7JY9cKbBjNKSW'),
(103, 'image', 'bari-black-women-s-real-leather-biker-jacket-1772273928_27e7aaefd3adac677576.webp', 11, 'items_images', 3, 1772273928, 1, '59.103.124.231', 573091200, 0, NULL, '4pv7JY9cKbBjNKSW'),
(104, 'image', 'bari-black-women-s-real-leather-biker-jacket-1772273928_b60dfc55c696e2ae7cad.webp', 11, 'items_images', 5, 1772273928, 1, '59.103.124.231', 573091200, 0, NULL, '4pv7JY9cKbBjNKSW'),
(105, 'image', 'bari-black-women-s-real-leather-biker-jacket-1772273928_d52ec7efa02b83907323.webp', 11, 'items_images', 6, 1772273928, 1, '59.103.124.231', 573091200, 0, NULL, '4pv7JY9cKbBjNKSW'),
(106, 'image', 'women-s-black-asymmetrical-real-leather-biker-jacket-1772274104_5cff8c90fa776655213c.webp', 12, 'items_images', 0, 1772274104, 1, '59.103.124.231', 1772274617, 1, '59.103.124.231', 'wfYmBpGdZFULBWBx'),
(107, 'image', 'women-s-black-asymmetrical-real-leather-biker-jacket-1772274104_091356b7fbf37dfbc8cd.webp', 12, 'items_images', 1, 1772274104, 1, '59.103.124.231', 1772274617, 1, '59.103.124.231', 'wfYmBpGdZFULBWBx'),
(108, 'image', 'women-s-black-asymmetrical-real-leather-biker-jacket-1772274104_f938fa3accef15ce7467.webp', 12, 'items_images', 4, 1772274104, 1, '59.103.124.231', 1772274617, 1, '59.103.124.231', 'wfYmBpGdZFULBWBx'),
(109, 'image', 'women-s-black-asymmetrical-real-leather-biker-jacket-1772274104_a023bc762e9e4484cfec.webp', 12, 'items_images', 5, 1772274104, 1, '59.103.124.231', 1772274617, 1, '59.103.124.231', 'wfYmBpGdZFULBWBx'),
(110, 'image', 'women-s-black-asymmetrical-real-leather-biker-jacket-1772274104_09981a8c5ac2a66f51f1.webp', 12, 'items_images', 2, 1772274104, 1, '59.103.124.231', 1772274617, 1, '59.103.124.231', 'wfYmBpGdZFULBWBx'),
(111, 'image', 'women-s-black-asymmetrical-real-leather-biker-jacket-1772274104_e37589ab2e5dcd1e94bc.webp', 12, 'items_images', 3, 1772274104, 1, '59.103.124.231', 1772274617, 1, '59.103.124.231', 'wfYmBpGdZFULBWBx'),
(112, 'image', 'women-s-cafe-racer-black-leather-jacket-1772274392_0f83f201df2ff6515e7a.webp', 13, 'items_images', 0, 1772274392, 1, '59.103.124.231', 1772274645, 1, '59.103.124.231', 'wLNBUPQ1b92rqBgn'),
(113, 'image', 'women-s-cafe-racer-black-leather-jacket-1772274392_32d916314fd71ebed8cf.webp', 13, 'items_images', 1, 1772274392, 1, '59.103.124.231', 1772274645, 1, '59.103.124.231', 'wLNBUPQ1b92rqBgn'),
(114, 'image', 'women-s-cafe-racer-black-leather-jacket-1772274392_7901a6ce0bc8166b87ec.webp', 13, 'items_images', 5, 1772274392, 1, '59.103.124.231', 1772274645, 1, '59.103.124.231', 'wLNBUPQ1b92rqBgn'),
(115, 'image', 'women-s-cafe-racer-black-leather-jacket-1772274392_d0ef3377e821dff94806.webp', 13, 'items_images', 4, 1772274392, 1, '59.103.124.231', 1772274645, 1, '59.103.124.231', 'wLNBUPQ1b92rqBgn'),
(116, 'image', 'women-s-cafe-racer-black-leather-jacket-1772274392_9db74ff69c6483f569e8.webp', 13, 'items_images', 2, 1772274392, 1, '59.103.124.231', 1772274645, 1, '59.103.124.231', 'wLNBUPQ1b92rqBgn'),
(117, 'image', 'women-s-cafe-racer-black-leather-jacket-1772274392_67f80a30ede76363707e.webp', 13, 'items_images', 3, 1772274392, 1, '59.103.124.231', 1772274645, 1, '59.103.124.231', 'wLNBUPQ1b92rqBgn'),
(118, 'image', 'women-s-cafe-racer-tan-real-leather-jacket-1772274666_f5351b72e03dd510bc64.webp', 14, 'items_images', 0, 1772274666, 1, '59.103.124.231', 573091200, 0, NULL, 'aBXq3CrMMeHiZNhR'),
(119, 'image', 'women-s-cafe-racer-tan-real-leather-jacket-1772274666_d442fc8dd3316984b730.webp', 14, 'items_images', 1, 1772274666, 1, '59.103.124.231', 573091200, 0, NULL, 'aBXq3CrMMeHiZNhR'),
(120, 'image', 'women-s-cafe-racer-tan-real-leather-jacket-1772274666_372ee65ffb3db68488db.webp', 14, 'items_images', 2, 1772274666, 1, '59.103.124.231', 573091200, 0, NULL, 'aBXq3CrMMeHiZNhR'),
(121, 'image', 'women-s-cafe-racer-tan-real-leather-jacket-1772274666_5dc46a3eeb1ca0ff9fa4.webp', 14, 'items_images', 3, 1772274666, 1, '59.103.124.231', 573091200, 0, NULL, 'aBXq3CrMMeHiZNhR'),
(122, 'image', 'tavares-women-s-wax-blue-leather-biker-jacket-1772274905_e26ef374ad2ed80d4b87.webp', 15, 'items_images', 1, 1772274905, 1, '59.103.124.231', 573091200, 0, NULL, 'fgN5veNgWvbdNJYC'),
(123, 'image', 'tavares-women-s-wax-blue-leather-biker-jacket-1772274905_c7dce90d743eaf1731ac.webp', 15, 'items_images', 0, 1772274905, 1, '59.103.124.231', 573091200, 0, NULL, 'fgN5veNgWvbdNJYC'),
(124, 'image', 'tavares-women-s-wax-blue-leather-biker-jacket-1772274905_b537d99c0e8dbb034474.webp', 15, 'items_images', 2, 1772274905, 1, '59.103.124.231', 573091200, 0, NULL, 'fgN5veNgWvbdNJYC'),
(125, 'image', 'tavares-women-s-wax-blue-leather-biker-jacket-1772274905_b22f1865250c3ef16fbf.webp', 15, 'items_images', 3, 1772274905, 1, '59.103.124.231', 573091200, 0, NULL, 'fgN5veNgWvbdNJYC'),
(126, 'image', 'women-s-black-cafe-racer-leather-jacket-1772275130_0dbc2fa612b95957d1b4.webp', 16, 'items_images', 2, 1772275130, 1, '59.103.124.231', 573091200, 0, NULL, 'xgHSpCTdbKS5skNv'),
(127, 'image', 'women-s-black-cafe-racer-leather-jacket-1772275130_b90f782b0ea83becd0c6.webp', 16, 'items_images', 0, 1772275130, 1, '59.103.124.231', 573091200, 0, NULL, 'xgHSpCTdbKS5skNv'),
(128, 'image', 'women-s-black-cafe-racer-leather-jacket-1772275130_27496b24c7e9ecec7c09.webp', 16, 'items_images', 1, 1772275130, 1, '59.103.124.231', 573091200, 0, NULL, 'xgHSpCTdbKS5skNv'),
(129, 'image', 'women-s-black-cafe-racer-leather-jacket-1772275130_cc2b734557e26e501d55.webp', 16, 'items_images', 3, 1772275130, 1, '59.103.124.231', 573091200, 0, NULL, 'xgHSpCTdbKS5skNv'),
(130, 'image', 'stonegrey-kids-jersey-bomber-jacket-1772275328_6621f3f4d9bc9ff6390f.webp', 17, 'items_images', 0, 1772275328, 1, '59.103.124.231', 573091200, 0, NULL, 'NpeSPgxTuX2wHgrW'),
(131, 'image', 'stonegrey-kids-jersey-bomber-jacket-1772275328_39e41d288a7d55a3d7cf.webp', 17, 'items_images', 1, 1772275328, 1, '59.103.124.231', 573091200, 0, NULL, 'NpeSPgxTuX2wHgrW'),
(132, 'image', 'stonegrey-kids-jersey-bomber-jacket-1772275328_c6e548f7ecda7117198e.webp', 17, 'items_images', 2, 1772275328, 1, '59.103.124.231', 573091200, 0, NULL, 'NpeSPgxTuX2wHgrW'),
(133, 'image', 'stonegrey-kids-jersey-bomber-jacket-1772275328_60bc620c46c48547356d.webp', 17, 'items_images', 3, 1772275328, 1, '59.103.124.231', 573091200, 0, NULL, 'NpeSPgxTuX2wHgrW'),
(134, 'image', 'stonegrey-kids-jersey-bomber-jacket-1772275328_2589c813a9cefc591976.webp', 17, 'items_images', 4, 1772275328, 1, '59.103.124.231', 573091200, 0, NULL, 'NpeSPgxTuX2wHgrW'),
(135, 'image', 'stonegrey-kids-jersey-bomber-jacket-1772275328_3f4e1db216567f9f6543.webp', 17, 'items_images', 5, 1772275328, 1, '59.103.124.231', 573091200, 0, NULL, 'NpeSPgxTuX2wHgrW'),
(136, 'image', 'green-camouflage-hooded-waterproof-jacket-kids-1772275431_0a252e3f62c014326ece.webp', 18, 'items_images', 0, 1772275431, 1, '59.103.124.231', 573091200, 0, NULL, 'EAgfWkwTkMtNDU6y'),
(137, 'image', 'green-camouflage-hooded-waterproof-jacket-kids-1772275431_fee32d6b9d0698d3dc53.webp', 18, 'items_images', 1, 1772275431, 1, '59.103.124.231', 573091200, 0, NULL, 'EAgfWkwTkMtNDU6y'),
(138, 'image', 'green-camouflage-hooded-waterproof-jacket-kids-1772275431_c5716db487b3a0e55f9e.webp', 18, 'items_images', 2, 1772275431, 1, '59.103.124.231', 573091200, 0, NULL, 'EAgfWkwTkMtNDU6y'),
(139, 'image', 'green-camouflage-hooded-waterproof-jacket-kids-1772275431_ea66b0fcdbe2e82f5e9b.webp', 18, 'items_images', 3, 1772275431, 1, '59.103.124.231', 573091200, 0, NULL, 'EAgfWkwTkMtNDU6y'),
(140, 'image', 'green-camouflage-hooded-waterproof-jacket-kids-1772275431_f2c4ef3d965b6f6ea60b.webp', 18, 'items_images', 4, 1772275431, 1, '59.103.124.231', 573091200, 0, NULL, 'EAgfWkwTkMtNDU6y'),
(141, 'image', 'grey-smart-bomber-jacket-kids-1772275602_f46379af8207c5b620bc.webp', 19, 'items_images', 0, 1772275602, 1, '59.103.124.231', 573091200, 0, NULL, 'x6GSTbjXHeCZQT6q'),
(142, 'image', 'grey-smart-bomber-jacket-kids-1772275602_6ec459f4aa2a6f1a3ed5.webp', 19, 'items_images', 1, 1772275602, 1, '59.103.124.231', 573091200, 0, NULL, 'x6GSTbjXHeCZQT6q'),
(143, 'image', 'grey-smart-bomber-jacket-kids-1772275602_310d996344737b83d941.webp', 19, 'items_images', 2, 1772275602, 1, '59.103.124.231', 573091200, 0, NULL, 'x6GSTbjXHeCZQT6q'),
(144, 'image', 'grey-smart-bomber-jacket-kids-1772275602_56db8c4b65a2cff93c9e.webp', 19, 'items_images', 3, 1772275602, 1, '59.103.124.231', 573091200, 0, NULL, 'x6GSTbjXHeCZQT6q'),
(145, 'image', 'green-colour-block-waterproof-cagoule-kids-1772275884_251f8e08e0bc5c833fc7.webp', 20, 'items_images', 0, 1772275884, 1, '59.103.124.231', 573091200, 0, NULL, 'SRDzs4WAnKMwT1dJ'),
(146, 'image', 'green-colour-block-waterproof-cagoule-kids-1772275884_d8deaa7af4dbdbd3a51d.webp', 20, 'items_images', 1, 1772275884, 1, '59.103.124.231', 573091200, 0, NULL, 'SRDzs4WAnKMwT1dJ'),
(147, 'image', 'green-colour-block-waterproof-cagoule-kids-1772275884_f7c04028e7eacd3c5db4.webp', 20, 'items_images', 2, 1772275884, 1, '59.103.124.231', 573091200, 0, NULL, 'SRDzs4WAnKMwT1dJ'),
(148, 'image', 'green-colour-block-waterproof-cagoule-kids-1772275884_c08f3e51db884d6ddaaa.webp', 20, 'items_images', 3, 1772275884, 1, '59.103.124.231', 573091200, 0, NULL, 'SRDzs4WAnKMwT1dJ'),
(149, 'image', 'green-colour-block-waterproof-cagoule-kids-1772275884_3f946d99e5c4c316cc04.jpg', 20, 'items_images', 4, 1772275884, 1, '59.103.124.231', 573091200, 0, NULL, 'SRDzs4WAnKMwT1dJ'),
(150, 'image', 'red-cars-bag-pocket-cagoule-jacket-kids-1772276045_43aa947b548e2df97ba5.webp', 21, 'items_images', 0, 1772276045, 1, '59.103.124.231', 573091200, 0, NULL, 'dtp7LWa04XZJAquT'),
(151, 'image', 'red-cars-bag-pocket-cagoule-jacket-kids-1772276045_4cc9a64aebe5e7908add.webp', 21, 'items_images', 1, 1772276045, 1, '59.103.124.231', 573091200, 0, NULL, 'dtp7LWa04XZJAquT'),
(152, 'image', 'red-cars-bag-pocket-cagoule-jacket-kids-1772276045_79d299c54af8252384fd.webp', 21, 'items_images', 2, 1772276045, 1, '59.103.124.231', 573091200, 0, NULL, 'dtp7LWa04XZJAquT'),
(153, 'image', 'ombre-blue-waterproof-cagoule-jacket-kids-1772276138_ebd803b9be1572ebdcb4.webp', 22, 'items_images', 0, 1772276138, 1, '59.103.124.231', 573091200, 0, NULL, 'znnPWHh96bhd5qKr'),
(154, 'image', 'ombre-blue-waterproof-cagoule-jacket-kids-1772276138_fdc15b542ca9a0029841.webp', 22, 'items_images', 1, 1772276138, 1, '59.103.124.231', 573091200, 0, NULL, 'znnPWHh96bhd5qKr'),
(155, 'image', 'ombre-blue-waterproof-cagoule-jacket-kids-1772276138_a154d1ab6116e6e61744.webp', 22, 'items_images', 2, 1772276138, 1, '59.103.124.231', 573091200, 0, NULL, 'znnPWHh96bhd5qKr'),
(156, 'image', 'ombre-blue-waterproof-cagoule-jacket-kids-1772276138_d467141643b4f4c45b7b.webp', 22, 'items_images', 3, 1772276138, 1, '59.103.124.231', 573091200, 0, NULL, 'znnPWHh96bhd5qKr'),
(157, 'image', 'ombre-blue-waterproof-cagoule-jacket-kids-1772276138_b63177ec96d879224167.webp', 22, 'items_images', 4, 1772276138, 1, '59.103.124.231', 573091200, 0, NULL, 'znnPWHh96bhd5qKr'),
(158, 'image', 'black-smart-bomber-jacket-kids-1772276267_6c8168001b310920c616.webp', 23, 'items_images', 0, 1772276267, 1, '59.103.124.231', 573091200, 0, NULL, 'kBCZjzFYP5xY6jMP'),
(159, 'image', 'black-smart-bomber-jacket-kids-1772276267_da91c25fd28e15204587.webp', 23, 'items_images', 1, 1772276267, 1, '59.103.124.231', 573091200, 0, NULL, 'kBCZjzFYP5xY6jMP'),
(160, 'image', 'black-smart-bomber-jacket-kids-1772276267_e7596bcb7936f64c1452.webp', 23, 'items_images', 2, 1772276267, 1, '59.103.124.231', 573091200, 0, NULL, 'kBCZjzFYP5xY6jMP'),
(161, 'image', 'black-smart-bomber-jacket-kids-1772276267_0e136bfe5d8243f9fb93.webp', 23, 'items_images', 3, 1772276267, 1, '59.103.124.231', 573091200, 0, NULL, 'kBCZjzFYP5xY6jMP'),
(162, 'image', 'black-longline-shower-resistant-padded-coat-kids-1772276432_18f7fcc2a333b6f3fadd.webp', 24, 'items_images', 0, 1772276432, 1, '59.103.124.231', 573091200, 0, NULL, 'NTEMNc3SLZDumyrU'),
(163, 'image', 'black-longline-shower-resistant-padded-coat-kids-1772276432_8bedd85645cc05761753.webp', 24, 'items_images', 1, 1772276432, 1, '59.103.124.231', 573091200, 0, NULL, 'NTEMNc3SLZDumyrU'),
(164, 'image', 'black-longline-shower-resistant-padded-coat-kids-1772276432_2523399bb64255c03c09.webp', 24, 'items_images', 2, 1772276432, 1, '59.103.124.231', 573091200, 0, NULL, 'NTEMNc3SLZDumyrU'),
(165, 'image', 'black-longline-shower-resistant-padded-coat-kids-1772276432_cf3e852bcd8455b4ab9e.webp', 24, 'items_images', 3, 1772276432, 1, '59.103.124.231', 573091200, 0, NULL, 'NTEMNc3SLZDumyrU'),
(166, 'image', 'black-longline-shower-resistant-padded-coat-kids-1772276432_1679b98724c70ade6a28.webp', 24, 'items_images', 4, 1772276432, 1, '59.103.124.231', 573091200, 0, NULL, 'NTEMNc3SLZDumyrU'),
(167, 'image', 'black-longline-shower-resistant-padded-coat-kids-1772276432_1e9df8495bc72dc326c1.webp', 24, 'items_images', 5, 1772276432, 1, '59.103.124.231', 573091200, 0, NULL, 'NTEMNc3SLZDumyrU'),
(168, 'image', 'jessie-leather-crossbody-bag-1772276627_a1728a0ded5156acad12.webp', 25, 'items_images', 2, 1772276627, 1, '59.103.124.231', 573091200, 0, NULL, 'JJbdGm2c23CLW4Mj'),
(169, 'image', 'jessie-leather-crossbody-bag-1772276627_796ed41068d452aa2efe.webp', 25, 'items_images', 1, 1772276627, 1, '59.103.124.231', 573091200, 0, NULL, 'JJbdGm2c23CLW4Mj'),
(170, 'image', 'jessie-leather-crossbody-bag-1772276627_9ff2fe78a6d3418d4f09.webp', 25, 'items_images', 0, 1772276627, 1, '59.103.124.231', 573091200, 0, NULL, 'JJbdGm2c23CLW4Mj'),
(171, 'image', 'jessie-leather-crossbody-bag-1772276627_b237b3fe0b1a7409a4b2.webp', 25, 'items_images', 3, 1772276627, 1, '59.103.124.231', 573091200, 0, NULL, 'JJbdGm2c23CLW4Mj'),
(172, 'image', 'jessie-leather-crossbody-bag-1772276627_fdfdff98cf5f5579e3c0.webp', 25, 'items_images', 4, 1772276627, 1, '59.103.124.231', 573091200, 0, NULL, 'JJbdGm2c23CLW4Mj'),
(173, 'image', 'jolie-leather-crossbody-bag-1772276786_00934a548d454c3e8b1d.webp', 26, 'items_images', 1, 1772276786, 1, '59.103.124.231', 573091200, 0, NULL, 'nAJTJF3vv98YACwS'),
(174, 'image', 'jolie-leather-crossbody-bag-1772276786_5ac75fcf816526f626a4.webp', 26, 'items_images', 0, 1772276786, 1, '59.103.124.231', 573091200, 0, NULL, 'nAJTJF3vv98YACwS'),
(175, 'image', 'jolie-leather-crossbody-bag-1772276786_054b0fc352ce78451e92.webp', 26, 'items_images', 2, 1772276786, 1, '59.103.124.231', 573091200, 0, NULL, 'nAJTJF3vv98YACwS'),
(176, 'image', 'dillon-leather-shoulder-bag-1772276967_50b570a8a75fa27c2d25.webp', 27, 'items_images', 1, 1772276967, 1, '59.103.124.231', 573091200, 0, NULL, 'SL9hduAxZbqAEHEX'),
(177, 'image', 'dillon-leather-shoulder-bag-1772276967_ee34d333420d2afbebec.webp', 27, 'items_images', 3, 1772276967, 1, '59.103.124.231', 573091200, 0, NULL, 'SL9hduAxZbqAEHEX'),
(178, 'image', 'dillon-leather-shoulder-bag-1772276967_613ce09ed33697e22e42.webp', 27, 'items_images', 2, 1772276967, 1, '59.103.124.231', 573091200, 0, NULL, 'SL9hduAxZbqAEHEX'),
(179, 'image', 'dillon-leather-shoulder-bag-1772276967_19e4d6bd76819fc8103f.webp', 27, 'items_images', 4, 1772276967, 1, '59.103.124.231', 573091200, 0, NULL, 'SL9hduAxZbqAEHEX'),
(180, 'image', 'dillon-leather-shoulder-bag-1772276967_22abf3de91d756988057.webp', 27, 'items_images', 0, 1772276967, 1, '59.103.124.231', 573091200, 0, NULL, 'SL9hduAxZbqAEHEX'),
(181, 'image', 'willa-leather-shoulder-bag-1772277357_7f1d99e5e838504cc8a3.webp', 28, 'items_images', 2, 1772277357, 1, '59.103.124.231', 573091200, 0, NULL, 'KWN1W8ciHbyZSamQ'),
(182, 'image', 'willa-leather-shoulder-bag-1772277357_b98d8f7196e5e0a62b98.webp', 28, 'items_images', 1, 1772277357, 1, '59.103.124.231', 573091200, 0, NULL, 'KWN1W8ciHbyZSamQ'),
(183, 'image', 'willa-leather-shoulder-bag-1772277357_3f2ff6c590d7337acfb4.webp', 28, 'items_images', 5, 1772277357, 1, '59.103.124.231', 573091200, 0, NULL, 'KWN1W8ciHbyZSamQ'),
(184, 'image', 'willa-leather-shoulder-bag-1772277357_a3e251179db5c8eae379.webp', 28, 'items_images', 0, 1772277357, 1, '59.103.124.231', 573091200, 0, NULL, 'KWN1W8ciHbyZSamQ'),
(185, 'image', 'dillon-leather-shoulder-bag-1772277455_846fa179f075d0a7dc4b.webp', 29, 'items_images', 1, 1772277455, 1, '59.103.124.231', 573091200, 0, NULL, 'Y3rKspjFvRS1Man4'),
(186, 'image', 'dillon-leather-shoulder-bag-1772277455_35d4974eca9188beabf7.webp', 29, 'items_images', 2, 1772277455, 1, '59.103.124.231', 573091200, 0, NULL, 'Y3rKspjFvRS1Man4'),
(187, 'image', 'dillon-leather-shoulder-bag-1772277455_3f880be23300e689efe7.webp', 29, 'items_images', 3, 1772277455, 1, '59.103.124.231', 573091200, 0, NULL, 'Y3rKspjFvRS1Man4'),
(188, 'image', 'dillon-leather-shoulder-bag-1772277455_565c10dffa6a6168a874.webp', 29, 'items_images', 4, 1772277455, 1, '59.103.124.231', 573091200, 0, NULL, 'Y3rKspjFvRS1Man4'),
(189, 'image', 'dillon-leather-shoulder-bag-1772277455_41756dbfb030cc3b43a4.webp', 29, 'items_images', 0, 1772277455, 1, '59.103.124.231', 573091200, 0, NULL, 'Y3rKspjFvRS1Man4'),
(190, 'image', 'danni-leather-shoulder-bag-1772277671_a3f8ebe345331753e242.webp', 30, 'items_images', 0, 1772277671, 1, '59.103.124.231', 573091200, 0, NULL, 'CPsP55R6qDMEqyBT'),
(191, 'image', 'danni-leather-shoulder-bag-1772277671_b39dda503ab94b702776.webp', 30, 'items_images', 1, 1772277671, 1, '59.103.124.231', 573091200, 0, NULL, 'CPsP55R6qDMEqyBT'),
(192, 'image', 'danni-leather-shoulder-bag-1772277671_82769b70d78f3ff2c720.webp', 30, 'items_images', 2, 1772277671, 1, '59.103.124.231', 573091200, 0, NULL, 'CPsP55R6qDMEqyBT'),
(193, 'image', 'danni-leather-shoulder-bag-1772277671_6956079e7d7d23784a54.webp', 30, 'items_images', 3, 1772277671, 1, '59.103.124.231', 573091200, 0, NULL, 'CPsP55R6qDMEqyBT'),
(194, 'image', 'danni-leather-shoulder-bag-1772277671_963b310d484665157d8c.webp', 30, 'items_images', 4, 1772277671, 1, '59.103.124.231', 573091200, 0, NULL, 'CPsP55R6qDMEqyBT'),
(195, 'image', 'danni-leather-shoulder-bag-1772277777_c0275922beed2a2f0150.webp', 31, 'items_images', 2, 1772277777, 1, '59.103.124.231', 1772278211, 1, '59.103.124.231', 'MQdMTpFL8KFExmYh'),
(196, 'image', 'danni-leather-shoulder-bag-1772277777_e39b2f810a21ea8f351d.webp', 31, 'items_images', 1, 1772277777, 1, '59.103.124.231', 1772278211, 1, '59.103.124.231', 'MQdMTpFL8KFExmYh'),
(197, 'image', 'danni-leather-shoulder-bag-1772277777_dc26ce2c2a9fc57e5715.webp', 31, 'items_images', 0, 1772277777, 1, '59.103.124.231', 1772278211, 1, '59.103.124.231', 'MQdMTpFL8KFExmYh'),
(198, 'image', 'danni-leather-shoulder-bag-1772277777_630aed76fd38fbc5b8ab.webp', 31, 'items_images', 3, 1772277777, 1, '59.103.124.231', 1772278211, 1, '59.103.124.231', 'MQdMTpFL8KFExmYh'),
(199, 'image', 'danni-leather-shoulder-bag-1772277777_f23b9e6719a36e9eaf46.webp', 31, 'items_images', 4, 1772277777, 1, '59.103.124.231', 1772278211, 1, '59.103.124.231', 'MQdMTpFL8KFExmYh'),
(200, 'image', 'jolie-leather-hobo-bag-1772277981_259d7bbaff6b2d9cc8be.webp', 32, 'items_images', 0, 1772277981, 1, '59.103.124.231', 573091200, 0, NULL, 'iGA2UwLEEx8JC2gD'),
(201, 'image', 'jolie-leather-hobo-bag-1772277981_364f0c74513ac90e8e18.webp', 32, 'items_images', 1, 1772277981, 1, '59.103.124.231', 573091200, 0, NULL, 'iGA2UwLEEx8JC2gD'),
(202, 'image', 'jolie-leather-hobo-bag-1772277981_62f21e33b83811e85f53.webp', 32, 'items_images', 2, 1772277981, 1, '59.103.124.231', 573091200, 0, NULL, 'iGA2UwLEEx8JC2gD'),
(203, 'image', 'jolie-leather-hobo-bag-1772277981_baa440c65904ae80a449.webp', 32, 'items_images', 3, 1772277981, 1, '59.103.124.231', 573091200, 0, NULL, 'iGA2UwLEEx8JC2gD'),
(204, 'image', 'kim-black-double-breasted-leather-blazer-women-1772278331_6c5de916dbdf034d79ca.webp', 33, 'items_images', 0, 1772278331, 1, '59.103.124.231', 573091200, 0, NULL, 'LxtgDvV8ZXrmtdqi'),
(205, 'image', 'kim-black-double-breasted-leather-blazer-women-1772278331_69c69676742d5a49c415.webp', 33, 'items_images', 1, 1772278331, 1, '59.103.124.231', 573091200, 0, NULL, 'LxtgDvV8ZXrmtdqi'),
(206, 'image', 'kim-black-double-breasted-leather-blazer-women-1772278331_539fb95c6b4040bda51f.webp', 33, 'items_images', 2, 1772278331, 1, '59.103.124.231', 573091200, 0, NULL, 'LxtgDvV8ZXrmtdqi'),
(207, 'image', 'kim-black-double-breasted-leather-blazer-women-1772278331_9817d3e00d99dafe1361.webp', 33, 'items_images', 3, 1772278331, 1, '59.103.124.231', 573091200, 0, NULL, 'LxtgDvV8ZXrmtdqi'),
(208, 'image', 'kim-black-double-breasted-leather-blazer-women-1772278331_98c043b2d887bb81dcef.webp', 33, 'items_images', 4, 1772278331, 1, '59.103.124.231', 573091200, 0, NULL, 'LxtgDvV8ZXrmtdqi'),
(209, 'image', 'women-s-two-button-cognac-wax-real-leather-blazer-1772278484_127ff20bff484b6bd337.webp', 34, 'items_images', 1, 1772278484, 1, '59.103.124.231', 1772278709, 1, '59.103.124.231', '0X4pVNzQQjKi8iPu'),
(210, 'image', 'women-s-two-button-cognac-wax-real-leather-blazer-1772278484_d24625e64d069c4d4539.webp', 34, 'items_images', 5, 1772278484, 1, '59.103.124.231', 1772278709, 1, '59.103.124.231', '0X4pVNzQQjKi8iPu'),
(211, 'image', 'women-s-two-button-cognac-wax-real-leather-blazer-1772278484_be8337f69f816e5787d9.webp', 34, 'items_images', 0, 1772278484, 1, '59.103.124.231', 1772278709, 1, '59.103.124.231', '0X4pVNzQQjKi8iPu'),
(212, 'image', 'women-s-two-button-cognac-wax-real-leather-blazer-1772278484_b25ffe84d0dda2a1ecbe.webp', 34, 'items_images', 4, 1772278484, 1, '59.103.124.231', 1772278709, 1, '59.103.124.231', '0X4pVNzQQjKi8iPu'),
(213, 'image', 'women-s-two-button-cognac-wax-real-leather-blazer-1772278484_f7e65bf07c868069b327.webp', 34, 'items_images', 2, 1772278484, 1, '59.103.124.231', 1772278709, 1, '59.103.124.231', '0X4pVNzQQjKi8iPu'),
(214, 'image', 'women-s-two-button-cognac-wax-real-leather-blazer-1772278484_84b725f567b959e25a29.webp', 34, 'items_images', 3, 1772278484, 1, '59.103.124.231', 1772278709, 1, '59.103.124.231', '0X4pVNzQQjKi8iPu'),
(215, 'image', 'women-s-red-real-leather-blazer-jacket-1772278701_e8e5d0a6d085188db41d.webp', 35, 'items_images', 0, 1772278701, 1, '59.103.124.231', 573091200, 0, NULL, 'azhn8LYJghJbbhJs'),
(216, 'image', 'women-s-red-real-leather-blazer-jacket-1772278701_11df1309208c1a1929f4.webp', 35, 'items_images', 2, 1772278701, 1, '59.103.124.231', 573091200, 0, NULL, 'azhn8LYJghJbbhJs'),
(217, 'image', 'women-s-red-real-leather-blazer-jacket-1772278701_995efc9aed085c850e89.webp', 35, 'items_images', 1, 1772278701, 1, '59.103.124.231', 573091200, 0, NULL, 'azhn8LYJghJbbhJs'),
(218, 'image', 'women-s-red-real-leather-blazer-jacket-1772278701_b2b4d8d405deec5d053f.webp', 35, 'items_images', 3, 1772278701, 1, '59.103.124.231', 573091200, 0, NULL, 'azhn8LYJghJbbhJs'),
(219, 'image', 'women-s-single-button-lambskin-leather-blazer-cognac-wax-1772280185_d39568cc15266f389141.webp', 36, 'items_images', 5, 1772280185, 1, '59.103.124.231', 1772280509, 1, '59.103.124.231', 'WCaxegpwvBgj2a0x'),
(220, 'image', 'women-s-single-button-lambskin-leather-blazer-cognac-wax-1772280185_9ea6fb692e8755e73e88.webp', 36, 'items_images', 0, 1772280185, 1, '59.103.124.231', 1772280509, 1, '59.103.124.231', 'WCaxegpwvBgj2a0x'),
(221, 'image', 'women-s-single-button-lambskin-leather-blazer-cognac-wax-1772280185_49f81724ab407c4fe991.webp', 36, 'items_images', 1, 1772280185, 1, '59.103.124.231', 1772280509, 1, '59.103.124.231', 'WCaxegpwvBgj2a0x'),
(222, 'image', 'women-s-single-button-lambskin-leather-blazer-cognac-wax-1772280185_9486477e14777c5ad123.webp', 36, 'items_images', 4, 1772280185, 1, '59.103.124.231', 1772280509, 1, '59.103.124.231', 'WCaxegpwvBgj2a0x'),
(223, 'image', 'women-s-single-button-lambskin-leather-blazer-cognac-wax-1772280185_82262f909181638a6d1f.webp', 36, 'items_images', 2, 1772280185, 1, '59.103.124.231', 1772280509, 1, '59.103.124.231', 'WCaxegpwvBgj2a0x'),
(224, 'image', 'women-s-single-button-lambskin-leather-blazer-cognac-wax-1772280185_97c149955c8ce031cd5e.webp', 36, 'items_images', 3, 1772280185, 1, '59.103.124.231', 1772280509, 1, '59.103.124.231', 'WCaxegpwvBgj2a0x'),
(225, 'image', 'women-s-three-button-camel-real-leather-blazer-1772280322_9d6a453c8614e2ccaa5f.webp', 37, 'items_images', 0, 1772280322, 1, '59.103.124.231', 573091200, 0, NULL, 'tfZwfkLAj5sPkvWB'),
(226, 'image', 'women-s-three-button-camel-real-leather-blazer-1772280322_26563831c48c0502a795.webp', 37, 'items_images', 2, 1772280322, 1, '59.103.124.231', 573091200, 0, NULL, 'tfZwfkLAj5sPkvWB'),
(227, 'image', 'women-s-three-button-camel-real-leather-blazer-1772280322_bf0057dc57689d369f0a.webp', 37, 'items_images', 3, 1772280322, 1, '59.103.124.231', 573091200, 0, NULL, 'tfZwfkLAj5sPkvWB'),
(228, 'image', 'women-s-three-button-camel-real-leather-blazer-1772280322_306d2c123ef3a8b3dc83.webp', 37, 'items_images', 4, 1772280322, 1, '59.103.124.231', 573091200, 0, NULL, 'tfZwfkLAj5sPkvWB'),
(229, 'image', 'women-s-three-button-camel-real-leather-blazer-1772280322_7a4c47717ee4145d2965.webp', 37, 'items_images', 1, 1772280322, 1, '59.103.124.231', 573091200, 0, NULL, 'tfZwfkLAj5sPkvWB'),
(230, 'image', 'women-s-single-button-purple-real-leather-blazer-1772280427_2c0d002140c9e62ca17c.webp', 38, 'items_images', 5, 1772280427, 1, '59.103.124.231', 1772280643, 1, '59.103.124.231', 'LYRjnQEn5KS5x6Xn'),
(231, 'image', 'women-s-single-button-purple-real-leather-blazer-1772280427_e4e4a5cccbb04361aca7.webp', 38, 'items_images', 4, 1772280427, 1, '59.103.124.231', 1772280643, 1, '59.103.124.231', 'LYRjnQEn5KS5x6Xn'),
(232, 'image', 'women-s-single-button-purple-real-leather-blazer-1772280427_3ec04a3860c4cc16839f.webp', 38, 'items_images', 0, 1772280427, 1, '59.103.124.231', 1772280643, 1, '59.103.124.231', 'LYRjnQEn5KS5x6Xn'),
(233, 'image', 'women-s-single-button-purple-real-leather-blazer-1772280427_895b11b856a82fe242f4.webp', 38, 'items_images', 1, 1772280427, 1, '59.103.124.231', 1772280643, 1, '59.103.124.231', 'LYRjnQEn5KS5x6Xn'),
(234, 'image', 'women-s-single-button-purple-real-leather-blazer-1772280427_f3868d8a31e21afa3d4d.webp', 38, 'items_images', 2, 1772280427, 1, '59.103.124.231', 1772280643, 1, '59.103.124.231', 'LYRjnQEn5KS5x6Xn'),
(235, 'image', 'women-s-single-button-purple-real-leather-blazer-1772280427_e5d02b56ba5ef0fcfc6f.webp', 38, 'items_images', 3, 1772280427, 1, '59.103.124.231', 1772280643, 1, '59.103.124.231', 'LYRjnQEn5KS5x6Xn'),
(236, 'image', 'women-s-black-two-button-leather-blazer-jacket-1772280761_8d4e9fa117518f7213a5.webp', 40, 'items_images', 0, 1772280761, 1, '59.103.124.231', 573091200, 0, NULL, '5ZC23zWNaxTw2Syk'),
(237, 'image', 'women-s-black-two-button-leather-blazer-jacket-1772280761_9336bc44c1b5879c3674.webp', 40, 'items_images', 2, 1772280761, 1, '59.103.124.231', 573091200, 0, NULL, '5ZC23zWNaxTw2Syk'),
(238, 'image', 'women-s-black-two-button-leather-blazer-jacket-1772280761_236b1770622a302e62d9.webp', 40, 'items_images', 1, 1772280761, 1, '59.103.124.231', 573091200, 0, NULL, '5ZC23zWNaxTw2Syk'),
(239, 'image', 'women-s-black-two-button-leather-blazer-jacket-1772280761_8dbe1595c0a9e439b6d0.webp', 40, 'items_images', 3, 1772280761, 1, '59.103.124.231', 573091200, 0, NULL, '5ZC23zWNaxTw2Syk'),
(240, 'image', 'hazel-women-s-two-button-black-real-leather-blazer-1772280846_170e9815b9434a107aa1.webp', 39, 'items_images', 0, 1772280846, 1, '59.103.124.231', 573091200, 0, NULL, 'HGVy2eWGt5LwL8dD'),
(241, 'image', 'hazel-women-s-two-button-black-real-leather-blazer-1772280846_ed271ed9956606300532.webp', 39, 'items_images', 1, 1772280846, 1, '59.103.124.231', 573091200, 0, NULL, 'HGVy2eWGt5LwL8dD'),
(242, 'image', 'hazel-women-s-two-button-black-real-leather-blazer-1772280846_37ac4ce6f0856a611760.webp', 39, 'items_images', 2, 1772280846, 1, '59.103.124.231', 573091200, 0, NULL, 'HGVy2eWGt5LwL8dD'),
(243, 'image', 'hazel-women-s-two-button-black-real-leather-blazer-1772280846_64b596e0f529c51c712a.webp', 39, 'items_images', 3, 1772280846, 1, '59.103.124.231', 573091200, 0, NULL, 'HGVy2eWGt5LwL8dD'),
(244, 'image', 'tan-brown-standard-fit-leather-contrast-sole-chunky-brogues-shoes-1772281077_dfb7174c796dbf8f3e94.webp', 41, 'items_images', 0, 1772281077, 1, '59.103.124.231', 573091200, 0, NULL, 'BB7H9gUq4Cqs8qFg'),
(245, 'image', 'tan-brown-standard-fit-leather-contrast-sole-chunky-brogues-shoes-1772281077_ebbc7fb6c2c3126bbe9a.webp', 41, 'items_images', 1, 1772281077, 1, '59.103.124.231', 573091200, 0, NULL, 'BB7H9gUq4Cqs8qFg'),
(246, 'image', 'tan-brown-standard-fit-leather-contrast-sole-chunky-brogues-shoes-1772281077_5205bac69d9e9c2590fd.webp', 41, 'items_images', 2, 1772281077, 1, '59.103.124.231', 573091200, 0, NULL, 'BB7H9gUq4Cqs8qFg'),
(247, 'image', 'tan-brown-standard-fit-leather-contrast-sole-chunky-brogues-shoes-1772281077_418d6c2da0093dc657b8.webp', 41, 'items_images', 3, 1772281077, 1, '59.103.124.231', 573091200, 0, NULL, 'BB7H9gUq4Cqs8qFg'),
(248, 'image', 'tan-brown-standard-fit-leather-contrast-sole-chunky-brogues-shoes-1772281077_ed0397c393a08ca32f43.webp', 41, 'items_images', 4, 1772281077, 1, '59.103.124.231', 573091200, 0, NULL, 'BB7H9gUq4Cqs8qFg'),
(249, 'image', 'tan-brown-standard-fit-leather-contrast-sole-chunky-brogues-shoes-1772281077_b3b9fabb3285e914017b.webp', 41, 'items_images', 5, 1772281077, 1, '59.103.124.231', 573091200, 0, NULL, 'BB7H9gUq4Cqs8qFg'),
(250, 'image', 'brown-suedette-derby-shoes-1772281193_427f4bcb061ca45d9408.webp', 42, 'items_images', 0, 1772281193, 1, '59.103.124.231', 573091200, 0, NULL, 'C44RNsxEBC0PCQGN'),
(251, 'image', 'brown-suedette-derby-shoes-1772281193_9931546f6406c8f83f20.webp', 42, 'items_images', 1, 1772281193, 1, '59.103.124.231', 573091200, 0, NULL, 'C44RNsxEBC0PCQGN'),
(252, 'image', 'brown-suedette-derby-shoes-1772281193_8d2860886339c30103a6.webp', 42, 'items_images', 2, 1772281193, 1, '59.103.124.231', 573091200, 0, NULL, 'C44RNsxEBC0PCQGN'),
(253, 'image', 'brown-suedette-derby-shoes-1772281193_fb09517e3e5631234821.webp', 42, 'items_images', 3, 1772281193, 1, '59.103.124.231', 573091200, 0, NULL, 'C44RNsxEBC0PCQGN'),
(254, 'image', 'brown-suedette-derby-shoes-1772281193_2658e805626ba262f72e.webp', 42, 'items_images', 4, 1772281193, 1, '59.103.124.231', 573091200, 0, NULL, 'C44RNsxEBC0PCQGN'),
(255, 'image', 'black-double-monk-toe-cap-shoes-1772281334_8ca921ebf3723de8b073.webp', 43, 'items_images', 0, 1772281334, 1, '59.103.124.231', 573091200, 0, NULL, 'ybWM1g05k5tKr4B1'),
(256, 'image', 'black-double-monk-toe-cap-shoes-1772281334_c367816da064b32db46e.webp', 43, 'items_images', 1, 1772281334, 1, '59.103.124.231', 573091200, 0, NULL, 'ybWM1g05k5tKr4B1');
INSERT INTO `tbl_uploads` (`upload_id`, `upload_type`, `upload_file`, `parent_id`, `parent_type`, `sort_order`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`, `token`) VALUES
(257, 'image', 'black-double-monk-toe-cap-shoes-1772281334_1a7aa0df91f4a9979051.webp', 43, 'items_images', 2, 1772281334, 1, '59.103.124.231', 573091200, 0, NULL, 'ybWM1g05k5tKr4B1'),
(258, 'image', 'black-double-monk-toe-cap-shoes-1772281334_cf7c663c866c9dc0fc91.webp', 43, 'items_images', 3, 1772281334, 1, '59.103.124.231', 573091200, 0, NULL, 'ybWM1g05k5tKr4B1'),
(259, 'image', 'black-double-monk-toe-cap-shoes-1772281334_c49270d6c317f6b01279.webp', 43, 'items_images', 4, 1772281334, 1, '59.103.124.231', 573091200, 0, NULL, 'ybWM1g05k5tKr4B1'),
(260, 'image', 'black-double-monk-toe-cap-shoes-1772281334_878ec974573332947b53.webp', 43, 'items_images', 5, 1772281334, 1, '59.103.124.231', 573091200, 0, NULL, 'ybWM1g05k5tKr4B1'),
(261, 'image', 'black-double-monk-toe-cap-shoes-1772281334_0b7b5dec8f0257ed0434.webp', 43, 'items_images', 6, 1772281334, 1, '59.103.124.231', 573091200, 0, NULL, 'ybWM1g05k5tKr4B1'),
(262, 'image', 'black-wide-fit-leather-plain-derby-shoes-1772281413_05b5aa2fbb1ab34398fa.webp', 44, 'items_images', 0, 1772281413, 1, '59.103.124.231', 573091200, 0, NULL, 'QKZM4AUpm5tVtRVR'),
(263, 'image', 'black-wide-fit-leather-plain-derby-shoes-1772281413_bc74b05ad47cbd3f8856.webp', 44, 'items_images', 1, 1772281413, 1, '59.103.124.231', 573091200, 0, NULL, 'QKZM4AUpm5tVtRVR'),
(264, 'image', 'black-wide-fit-leather-plain-derby-shoes-1772281413_30e8320083dda7c05c7f.webp', 44, 'items_images', 2, 1772281413, 1, '59.103.124.231', 573091200, 0, NULL, 'QKZM4AUpm5tVtRVR'),
(265, 'image', 'black-wide-fit-leather-plain-derby-shoes-1772281413_85fd6422af61401d1187.webp', 44, 'items_images', 3, 1772281413, 1, '59.103.124.231', 573091200, 0, NULL, 'QKZM4AUpm5tVtRVR'),
(266, 'image', 'black-standard-fit-patent-oxford-toe-cap-shoes-1772281529_6f61f9b72ffe082250d1.webp', 45, 'items_images', 0, 1772281529, 1, '59.103.124.231', 573091200, 0, NULL, 'PMEDFEtpSpkixAqx'),
(267, 'image', 'black-standard-fit-patent-oxford-toe-cap-shoes-1772281529_9dd37ac77bc81f9a4256.webp', 45, 'items_images', 1, 1772281529, 1, '59.103.124.231', 573091200, 0, NULL, 'PMEDFEtpSpkixAqx'),
(268, 'image', 'black-standard-fit-patent-oxford-toe-cap-shoes-1772281529_b3b268c83082d80e3807.webp', 45, 'items_images', 2, 1772281529, 1, '59.103.124.231', 573091200, 0, NULL, 'PMEDFEtpSpkixAqx'),
(269, 'image', 'black-standard-fit-patent-oxford-toe-cap-shoes-1772281529_de31d0c3c423fd1329b9.webp', 45, 'items_images', 3, 1772281529, 1, '59.103.124.231', 573091200, 0, NULL, 'PMEDFEtpSpkixAqx'),
(270, 'image', 'black-standard-fit-patent-oxford-toe-cap-shoes-1772281529_8d7f35be695559177b96.webp', 45, 'items_images', 4, 1772281529, 1, '59.103.124.231', 573091200, 0, NULL, 'PMEDFEtpSpkixAqx'),
(271, 'image', 'black-wide-fit-leather-oxford-toecap-shoes-1772281627_366efc65d70b63b82a41.webp', 46, 'items_images', 0, 1772281627, 1, '59.103.124.231', 573091200, 0, NULL, '0DjFNJe3bbuKaybQ'),
(272, 'image', 'black-wide-fit-leather-oxford-toecap-shoes-1772281627_9d5886b836c8ae579cc0.webp', 46, 'items_images', 1, 1772281627, 1, '59.103.124.231', 573091200, 0, NULL, '0DjFNJe3bbuKaybQ'),
(273, 'image', 'black-wide-fit-leather-oxford-toecap-shoes-1772281627_4fd0b46532507ad9528d.webp', 46, 'items_images', 2, 1772281627, 1, '59.103.124.231', 573091200, 0, NULL, '0DjFNJe3bbuKaybQ'),
(274, 'image', 'black-wide-fit-leather-oxford-toecap-shoes-1772281627_44cad7499924039264e2.webp', 46, 'items_images', 3, 1772281627, 1, '59.103.124.231', 573091200, 0, NULL, '0DjFNJe3bbuKaybQ'),
(275, 'image', 'black-wide-fit-leather-oxford-toecap-shoes-1772281627_8f6f8b6a9484cf9c91ff.webp', 46, 'items_images', 4, 1772281627, 1, '59.103.124.231', 573091200, 0, NULL, '0DjFNJe3bbuKaybQ'),
(276, 'image', 'navy-blue-suede-desert-shoes-1772281767_2cf282de99b3992f6c4b.webp', 47, 'items_images', 0, 1772281767, 1, '59.103.124.231', 573091200, 0, NULL, 'FSdiCqycJ1UUTsZM'),
(277, 'image', 'navy-blue-suede-desert-shoes-1772281767_60a20b980926d4db4331.webp', 47, 'items_images', 1, 1772281767, 1, '59.103.124.231', 573091200, 0, NULL, 'FSdiCqycJ1UUTsZM'),
(278, 'image', 'navy-blue-suede-desert-shoes-1772281767_8e72b4f0b1d870ef9900.webp', 47, 'items_images', 2, 1772281767, 1, '59.103.124.231', 573091200, 0, NULL, 'FSdiCqycJ1UUTsZM'),
(279, 'image', 'mink-brown-suede-brogue-shoes-1772281862_46c18a9f45e361b2bb06.webp', 48, 'items_images', 0, 1772281862, 1, '59.103.124.231', 573091200, 0, NULL, 'wyjkzFk8B0M262Bz'),
(280, 'image', 'mink-brown-suede-brogue-shoes-1772281862_9520c64b7b45481debbd.webp', 48, 'items_images', 1, 1772281862, 1, '59.103.124.231', 573091200, 0, NULL, 'wyjkzFk8B0M262Bz'),
(281, 'image', 'mink-brown-suede-brogue-shoes-1772281862_3f677de72a2c0e8ede88.webp', 48, 'items_images', 2, 1772281862, 1, '59.103.124.231', 573091200, 0, NULL, 'wyjkzFk8B0M262Bz'),
(282, 'image', 'mink-brown-suede-brogue-shoes-1772281862_b225a12db60320c1fd08.webp', 48, 'items_images', 3, 1772281862, 1, '59.103.124.231', 573091200, 0, NULL, 'wyjkzFk8B0M262Bz'),
(283, 'image', 'mink-brown-suede-brogue-shoes-1772281862_d0e225e0f0357aa7ecef.webp', 48, 'items_images', 4, 1772281862, 1, '59.103.124.231', 573091200, 0, NULL, 'wyjkzFk8B0M262Bz'),
(284, 'image', 'introducing-shonir-cms-unlimited-power-open-source-freedom-modern-web-control-1772462562_5af6c47542817b468632.jpg', 14, 'blogs_posts_images', 0, 1772462562, 1, '59.103.124.231', 573091200, 0, NULL, 'Z0832ieJx6ARfDCA'),
(285, 'image', 'shonir-cms-first-class-speed-on-low-end-servers-open-source-launch-march-17-2026-1772576004_bed54104d225b4020d3f.jpg', 15, 'blogs_posts_images', 0, 1772576004, 1, '59.103.124.231', 573091200, 0, NULL, 'fwNwjFDKEuwr2h34'),
(286, 'image', 'shonir-cms-first-class-speed-on-low-end-servers-open-source-launch-march-17-2026-1772576004_d4aed75b15e15f153ae1.jpg', 15, 'blogs_posts_gallery', 0, 1772576004, 1, '59.103.124.231', 573091200, 0, NULL, 'fwNwjFDKEuwr2h34'),
(287, 'image', 'shonir-cms-first-class-speed-on-low-end-servers-open-source-launch-march-17-2026-1772576004_e5418acd32aae94b6dcc.jpg', 15, 'blogs_posts_gallery', 2, 1772576004, 1, '59.103.124.231', 573091200, 0, NULL, 'fwNwjFDKEuwr2h34'),
(288, 'image', 'shonir-cms-first-class-speed-on-low-end-servers-open-source-launch-march-17-2026-1772576004_d439d9dfe732972ab646.jpg', 15, 'blogs_posts_gallery', 1, 1772576004, 1, '59.103.124.231', 573091200, 0, NULL, 'fwNwjFDKEuwr2h34'),
(289, 'image', 'why-choose-shonir-cms-the-developer-s-lightweight-alternative-to-bloated-systems-1772853463_4b52f8d1454cc356c163.png', 16, 'blogs_posts_images', 0, 1772853463, 1, '59.103.124.231', 573091200, 0, NULL, 'Wh2pNFQvSpGbKtvj'),
(290, 'image', 'using-multiple-cdn-services-in-shonir-cms-for-maximum-website-performance-1772920114_dd6e78f322119ed27b2a.png', 17, 'blogs_posts_images', 0, 1772920114, 1, '59.103.124.231', 573091200, 0, NULL, 'eCZh0SkbBFABnzqy'),
(291, 'image', 'cache-system-how-it-delivers-high-speed-performance-even-on-low-end-servers-1772997117_754ba033873d19e461d0.png', 18, 'blogs_posts_images', 0, 1772997117, 1, '59.103.124.231', 573091200, 0, NULL, 'qp5GtteFgdNtwXfu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(190) NOT NULL,
  `password` varchar(190) NOT NULL,
  `nickname` varchar(190) DEFAULT NULL,
  `gender` varchar(16) NOT NULL DEFAULT 'not specified',
  `role` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `add_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `email`, `password`, `nickname`, `gender`, `role`, `status`, `add_time`, `add_by`, `add_ip`, `edit_time`, `edit_by`, `edit_ip`) VALUES
(1, 'demo@example.com', '54560d7596ed887ccc8735b95225b7f2', 'G Mian G', 'Male', 1, 1, 573091200, 0, NULL, 573091200, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visitors`
--

CREATE TABLE `tbl_visitors` (
  `visitor_id` int(11) NOT NULL,
  `session_id` varchar(190) DEFAULT NULL,
  `token` varchar(190) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `data` text DEFAULT NULL,
  `add_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voices`
--

CREATE TABLE `tbl_voices` (
  `voice_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `items` int(11) NOT NULL DEFAULT 0,
  `slug` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `spotlight` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `listed` tinyint(1) NOT NULL DEFAULT 0,
  `removable` tinyint(1) NOT NULL DEFAULT 1,
  `searchable` tinyint(1) NOT NULL DEFAULT 0,
  `top` tinyint(1) NOT NULL DEFAULT 0,
  `bottom` tinyint(1) NOT NULL DEFAULT 0,
  `published_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `today_views` int(11) NOT NULL DEFAULT 0,
  `statistics_update` int(11) NOT NULL DEFAULT 573091200,
  `lifetime_views` int(11) NOT NULL DEFAULT 0,
  `today_hits` int(11) NOT NULL DEFAULT 0,
  `lifetime_hits` int(11) NOT NULL DEFAULT 0,
  `last_view_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `last_hit_time` int(11) UNSIGNED NOT NULL DEFAULT 573091200,
  `votes` int(11) NOT NULL DEFAULT 0,
  `ratings` int(11) NOT NULL DEFAULT 0,
  `scores` varchar(190) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT 0,
  `token` varchar(190) DEFAULT NULL,
  `add_time` int(11) NOT NULL DEFAULT 573091200,
  `add_by` int(11) NOT NULL DEFAULT 0,
  `add_ip` varchar(190) DEFAULT NULL,
  `edit_time` int(11) NOT NULL DEFAULT 573091200,
  `edit_by` int(11) NOT NULL DEFAULT 0,
  `edit_ip` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_banners`
--
ALTER TABLE `tbl_banners`
  ADD PRIMARY KEY (`banner_id`),
  ADD KEY `idx_banners_status_published_parent` (`status`,`published_time`,`parent_id`),
  ADD KEY `idx_banners_sort_order` (`sort_order`);

--
-- Indexes for table `tbl_blogs_categories`
--
ALTER TABLE `tbl_blogs_categories`
  ADD PRIMARY KEY (`blog_category_id`);

--
-- Indexes for table `tbl_blogs_categories_to_categories`
--
ALTER TABLE `tbl_blogs_categories_to_categories`
  ADD KEY `idx_cat_to_cat_parent` (`parent_id`),
  ADD KEY `idx_cat_to_cat_children` (`children_id`);

--
-- Indexes for table `tbl_blogs_posts`
--
ALTER TABLE `tbl_blogs_posts`
  ADD PRIMARY KEY (`blog_post_id`);

--
-- Indexes for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_captcha`
--
ALTER TABLE `tbl_captcha`
  ADD PRIMARY KEY (`captcha_id`);

--
-- Indexes for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `idx_carts_session` (`session_id`);

--
-- Indexes for table `tbl_carts_items`
--
ALTER TABLE `tbl_carts_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `idx_carts_items_cart` (`cart_id`),
  ADD KEY `idx_carts_items_item` (`item_id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `idx_categories_status_listed_published` (`status`,`listed`,`published_time`),
  ADD KEY `idx_categories_sort_order` (`sort_order`);

--
-- Indexes for table `tbl_categories_to_categories`
--
ALTER TABLE `tbl_categories_to_categories`
  ADD KEY `idx_cat_to_cat_parent` (`parent_id`),
  ADD KEY `idx_cat_to_cat_children` (`children_id`);

--
-- Indexes for table `tbl_ci_sessions`
--
ALTER TABLE `tbl_ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_sessions_timestamp` (`timestamp`),
  ADD KEY `idx_sessions_ip` (`ip_address`);

--
-- Indexes for table `tbl_config`
--
ALTER TABLE `tbl_config`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `tbl_currencies`
--
ALTER TABLE `tbl_currencies`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `tbl_emails`
--
ALTER TABLE `tbl_emails`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `tbl_galleries`
--
ALTER TABLE `tbl_galleries`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `idx_galleries_status_listed_featured_parent` (`status`,`listed`,`featured`,`parent_id`,`parent_type`),
  ADD KEY `idx_galleries_sort_order` (`sort_order`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `idx_items_status` (`status`);

--
-- Indexes for table `tbl_likes`
--
ALTER TABLE `tbl_likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `tbl_mails_queues`
--
ALTER TABLE `tbl_mails_queues`
  ADD PRIMARY KEY (`mail_queue_id`);

--
-- Indexes for table `tbl_mails_servers`
--
ALTER TABLE `tbl_mails_servers`
  ADD PRIMARY KEY (`mail_server_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_orders_items`
--
ALTER TABLE `tbl_orders_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD PRIMARY KEY (`page_id`),
  ADD KEY `idx_pages_status_listed_published` (`status`,`listed`,`published_time`),
  ADD KEY `idx_pages_sort_order` (`sort_order`);

--
-- Indexes for table `tbl_pages_to_pages`
--
ALTER TABLE `tbl_pages_to_pages`
  ADD KEY `idx_pages_to_pages_parent` (`parent_id`),
  ADD KEY `idx_pages_to_pages_children` (`children_id`);

--
-- Indexes for table `tbl_places`
--
ALTER TABLE `tbl_places`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_regions`
--
ALTER TABLE `tbl_regions`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `tbl_sections`
--
ALTER TABLE `tbl_sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `tbl_talents`
--
ALTER TABLE `tbl_talents`
  ADD PRIMARY KEY (`talent_id`);

--
-- Indexes for table `tbl_uploads`
--
ALTER TABLE `tbl_uploads`
  ADD PRIMARY KEY (`upload_id`),
  ADD KEY `idx_uploads_query` (`upload_type`(50),`parent_type`(50),`parent_id`,`sort_order`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_visitors`
--
ALTER TABLE `tbl_visitors`
  ADD PRIMARY KEY (`visitor_id`),
  ADD KEY `idx_visitors_session` (`session_id`);

--
-- Indexes for table `tbl_voices`
--
ALTER TABLE `tbl_voices`
  ADD PRIMARY KEY (`voice_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_banners`
--
ALTER TABLE `tbl_banners`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_blogs_categories`
--
ALTER TABLE `tbl_blogs_categories`
  MODIFY `blog_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_blogs_posts`
--
ALTER TABLE `tbl_blogs_posts`
  MODIFY `blog_post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_captcha`
--
ALTER TABLE `tbl_captcha`
  MODIFY `captcha_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_carts_items`
--
ALTER TABLE `tbl_carts_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_config`
--
ALTER TABLE `tbl_config`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `tbl_currencies`
--
ALTER TABLE `tbl_currencies`
  MODIFY `currency_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `tbl_emails`
--
ALTER TABLE `tbl_emails`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_galleries`
--
ALTER TABLE `tbl_galleries`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_likes`
--
ALTER TABLE `tbl_likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_mails_queues`
--
ALTER TABLE `tbl_mails_queues`
  MODIFY `mail_queue_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_mails_servers`
--
ALTER TABLE `tbl_mails_servers`
  MODIFY `mail_server_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_orders_items`
--
ALTER TABLE `tbl_orders_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_places`
--
ALTER TABLE `tbl_places`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_regions`
--
ALTER TABLE `tbl_regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sections`
--
ALTER TABLE `tbl_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_talents`
--
ALTER TABLE `tbl_talents`
  MODIFY `talent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_uploads`
--
ALTER TABLE `tbl_uploads`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_visitors`
--
ALTER TABLE `tbl_visitors`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_voices`
--
ALTER TABLE `tbl_voices`
  MODIFY `voice_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
