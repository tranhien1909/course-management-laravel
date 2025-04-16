-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 16, 2025 lúc 07:20 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_tasks`
--

CREATE TABLE `admin_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_tasks`
--

INSERT INTO `admin_tasks` (`id`, `title`, `note`, `is_done`, `created_at`, `updated_at`) VALUES
(3, 'Nộp báo cáo', 'Nộp báo cáo Luận văn', 0, '2025-04-15 12:54:23', '2025-04-15 21:44:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `session` enum('morning','afternoon') NOT NULL,
  `status` enum('present','absent','late') NOT NULL DEFAULT 'present',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attendances`
--

INSERT INTO `attendances` (`id`, `student_id`, `class_id`, `date`, `session`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 13, 'CL001', '2025-04-07', 'afternoon', 'present', NULL, '2025-04-07 02:42:14', NULL),
(2, 13, 'CL001', '2025-04-10', 'afternoon', 'late', NULL, '2025-04-10 02:42:14', '2025-04-10 02:42:14'),
(3, 13, 'CL001', '2025-04-14', 'afternoon', 'absent', NULL, '2025-04-14 05:32:51', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:0:{}s:11:\"permissions\";a:0:{}s:5:\"roles\";a:0:{}}', 1744826841);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classes`
--

CREATE TABLE `classes` (
  `id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `number_of_student` bigint(20) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `classes`
--

INSERT INTO `classes` (`id`, `course_id`, `teacher_id`, `description`, `number_of_student`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
('CL001', 'C001', 8, NULL, 20, '2025-04-01', '2025-06-30', 'Active', '2025-03-19 14:05:49', '2025-03-19 14:05:49'),
('CL002', 'C001', 2, NULL, 15, '2025-04-01', '2025-06-30', 'Active', '2025-03-19 14:05:49', '2025-03-19 14:05:49'),
('CL003', 'C002', 3, NULL, 25, '2025-05-01', '2025-07-30', 'Inactive', '2025-03-19 14:05:49', '2025-03-19 14:05:49'),
('CL004', 'C002', 7, NULL, 18, '2025-04-15', '2025-07-15', 'Active', '2025-03-19 14:05:49', '2025-03-19 14:05:49'),
('CL005', 'C003', 2, NULL, 12, '2024-06-12', '2024-09-11', 'Active', '2025-03-19 14:05:49', '2025-03-19 14:05:49'),
('CL006', 'C003', 3, NULL, 20, '2025-06-01', '2025-09-01', 'Inactive', '2025-03-19 14:05:49', '2025-03-19 14:05:49'),
('CL007', 'C004', 6, NULL, 16, '2025-05-01', '2025-08-01', 'Active', '2025-03-19 14:05:49', '2025-03-19 14:05:49'),
('CL008', 'C004', 2, NULL, 22, '2025-05-01', '2025-08-01', 'Inactive', '2025-03-19 14:05:49', '2025-03-19 14:05:49'),
('CL009', 'C005', 7, NULL, 30, '2025-07-01', '2025-10-01', 'Active', '2025-03-19 14:05:49', '2025-03-19 14:05:49'),
('CL010', 'C005', 5, NULL, 18, '2025-07-01', '2025-10-01', 'Inactive', '2025-03-19 14:05:49', '2025-03-19 14:05:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class_schedules`
--

CREATE TABLE `class_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `class_schedules`
--

INSERT INTO `class_schedules` (`id`, `class_id`, `day_of_week`, `start_time`, `end_time`, `room`, `created_at`, `updated_at`) VALUES
(1, 'CL001', 'Monday', '15:00:00', '17:00:00', 'https://meet.google.com/skk-zfes-aje', '2025-03-26 21:33:19', NULL),
(2, 'CL001', 'Thursday', '15:00:00', '17:00:00', 'https://meet.google.com/skk-zfes-aje', '2025-03-26 21:33:19', NULL),
(3, 'CL004', 'Tuesday', '15:00:00', '17:00:00', 'https://meet.google.com/skk-zfes-aje', NULL, NULL),
(4, 'CL004', 'Friday', '15:00:00', '17:00:00', 'https://meet.google.com/skk-zfes-aje', NULL, NULL),
(5, 'CL009', 'Tuesday', '09:00:00', '11:00:00', 'https://meet.google.com/skk-zfes-aje', '2025-04-01 16:35:47', NULL),
(6, 'CL009', 'Thursday', '09:00:00', '11:00:00', 'https://meet.google.com/skk-zfes-aje', '2025-04-01 16:35:47', NULL),
(7, 'CL005', 'Tuesday', '09:00:00', '11:00:00', 'https://meet.google.com/skk-zfes-aje', '2025-04-07 04:24:02', NULL),
(8, 'CL005', 'Friday', '15:00:00', '17:00:00', 'https://meet.google.com/skk-zfes-aje', '2025-04-01 04:24:02', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `courses`
--

CREATE TABLE `courses` (
  `id` varchar(20) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `level` enum('A1','A2','B1','B2','C1','C2') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `lessons` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `description`, `level`, `price`, `lessons`, `status`, `image`, `created_at`, `updated_at`) VALUES
('C001', 'English Basic', 'Khóa học tiếng Anh cơ bản', 'A1', 1000000.00, 30, 'Active', 'https://img.lovepik.com/photo/40189/6179.jpg_wh860.jpg', '2025-03-19 14:05:29', '2025-03-19 14:05:29'),
('C002', 'Intermediate English', 'Khóa học tiếng Anh trung cấp', 'B1', 1500000.00, 40, 'Active', 'https://img.lovepik.com/photo/40005/6020.jpg_wh300.jpg', '2025-03-19 14:05:29', '2025-03-19 14:05:29'),
('C003', 'Advanced English', 'Khóa học tiếng Anh nâng cao', 'C1', 200000.00, 50, 'Inactive', 'https://img.lovepik.com/photo/50090/8802.jpg_wh300.jpg', '2025-03-19 14:05:29', '2025-03-19 14:05:29'),
('C004', 'Business English', 'Tiếng Anh thương mại', 'B2', 180.00, 35, 'Active', 'https://img.lovepik.com/photo/40005/6020.jpg_wh300.jpg', '2025-03-19 14:05:29', '2025-03-19 14:05:29'),
('C005', 'IELTS Preparation', 'Luyện thi IELTS', 'C2', 250000.00, 60, 'Inactive', 'https://img.lovepik.com/free-template/20210930/lovepik-online-education-online-website-login-homepage-image_0021219_list.jpg!/fw/431', '2025-03-19 14:05:29', '2025-03-19 14:05:29'),
('GH002', 'Gaqgsw', 'edxefv', 'A2', 144.00, 1233, 'Active', NULL, '2025-04-08 23:23:04', '2025-04-08 23:23:04'),
('KH002', 'Toeic 450+', NULL, 'B1', 2000000.00, 12, 'Active', 'https://images.shiksha.com/mediadata/ugcDocuments/images/wordpressImages/2022_08_MicrosoftTeams-image-13-2-1.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course_materials`
--

CREATE TABLE `course_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_url` varchar(255) NOT NULL,
  `file_type` enum('pdf','video','slide','document','other') NOT NULL,
  `uploaded_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `course_materials`
--

INSERT INTO `course_materials` (`id`, `course_id`, `title`, `description`, `file_url`, `file_type`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(1, 'C001', 'Sổ tay ngữ pháp Tiếng Anh', 'Tổng hợp các ngữ pháp hay dùng', 'https://drive.google.com/file/d/1NQ5kM5vsltJ7NFlVIZs5jrQ7WmD3XWPJ/view?usp=sharing', 'pdf', 8, '2025-04-09 08:13:32', NULL),
(2, 'C001', '99 từ vựng PART 7', '99 từ vựng cần lưu ý của PART 7 Toeic', 'https://drive.google.com/file/d/17FUuOuMgQ4bMJRF-gdLTbx_UmH2dhIpT/view?usp=sharing', 'pdf', 8, '2025-04-08 08:13:36', NULL),
(3, 'C002', 'Sổ tay ngữ pháp Tiếng Anh', 'Sổ tay ngữ pháp Tiếng Anh', 'https://drive.google.com/file/d/1NQ5kM5vsltJ7NFlVIZs5jrQ7WmD3XWPJ/view?usp=sharing', 'pdf', 6, '2025-04-12 21:51:57', NULL),
(4, 'C002', 'Demo', 'Demo', 'https://drive.google.com/file/d/1NQ5kM5vsltJ7NFlVIZs5jrQ7WmD3XWPJ/view?usp=sharing', 'pdf', 6, '2025-04-12 21:52:02', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course_reviews`
--

CREATE TABLE `course_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `course_reviews`
--

INSERT INTO `course_reviews` (`id`, `course_id`, `student_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'C001', 13, 5, 'Thầy cô siêu kiên nhẫn và vui tính. Nhờ thầy cô mà cô đã lấy lại được cơ bản ngữ pháp Tiếng Anh', '2025-04-13 20:46:52', NULL),
(2, 'C001', 15, 5, 'Tài liệu học phong phú, cập nhật đề thi thường xuyên. Các thầy cô super nhiệt tình, có chuyên môn cao', '2025-04-14 20:55:04', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `enrollment_date` date NOT NULL,
  `status` enum('pending','active','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `payment_id`, `class_id`, `enrollment_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 3, 'CL001', '2025-04-09', 'active', '2025-04-01 05:02:42', NULL),
(3, 19, 5, 'CL004', '2025-04-08', 'active', '2025-04-09 16:10:35', NULL),
(4, 15, 6, 'CL005', '2025-04-15', 'completed', '2025-04-14 03:19:08', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `exam_date` datetime NOT NULL,
  `max_score` decimal(5,2) NOT NULL,
  `uploaded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `exams`
--

INSERT INTO `exams` (`id`, `course_id`, `name`, `description`, `exam_date`, `max_score`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(1, 'C001', 'Kiểm tra 15\'', 'Kiểm tra 15\'', '2025-04-10 17:38:17', 10.00, 8, '2025-03-26 21:33:19', NULL),
(2, 'C001', 'Kiểm tra 45\'', 'Kiểm tra 45\'', '2025-04-10 17:38:56', 10.00, 1, NULL, NULL),
(3, 'C002', 'Kiểm tra 15\'', 'Kiểm tra 15\'', '2025-04-15 18:15:18', 10.00, 7, '2025-04-14 16:15:18', NULL),
(4, 'C002', 'Kiểm tra 45\'', 'Kiểm tra 45\'', '2025-04-15 18:15:18', 10.00, 7, '2025-04-07 21:33:19', NULL),
(5, 'C002', 'Kiểm tra 60\'', 'Kiểm tra 60\'', '2025-04-15 18:17:38', 10.00, 8, '2025-04-01 16:17:39', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_20_073242_create_courses_table', 1),
(5, '2025_03_20_073615_create_classes_table', 1),
(6, '2025_03_20_073807_create_course_materials_table', 1),
(7, '2025_03_20_073902_create_teachers_table', 1),
(8, '2025_03_20_073941_create_class_schedules_table', 1),
(9, '2025_03_20_074016_create_exams_table', 1),
(10, '2025_03_20_074056_create_student_grades_table', 1),
(11, '2025_03_20_074214_create_attendances_table', 1),
(12, '2025_03_20_074300_create_notifications_table', 1),
(13, '2025_04_07_140707_create_permission_tables', 1),
(14, '2025_04_08_175920_create_payments_table', 1),
(15, '2025_04_08_180038_create_enrollments_table', 1),
(16, '2025_04_15_023525_create_attendances_table', 2),
(17, '2025_04_15_050144_create_enrollments_table', 3),
(18, '2025_04_15_173511_create_notifications_table', 4),
(19, '2025_04_15_174936_create_notifications_table', 5),
(20, '2025_04_15_175532_create_notification_targets_table', 6),
(21, '2025_04_15_185908_create_admin_tasks_table', 7),
(22, '2025_04_15_203923_create_course_reviews_table', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` enum('system','class','course','user','all') NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `sender_id`, `created_at`, `updated_at`) VALUES
(1, 'Thông báo đổi lịch học', 'Lịch học chiều ngày 14/4/2025 từ 15:00 - 17:00 sẽ được chuyển sang sáng ngày 15/4/2025 từ 9:00 - 11:00', 'class', 1, '2025-04-15 11:36:12', '2025-04-15 11:36:12'),
(2, 'Lịch nghỉ lễ 30/4/2025 - 1/5/2025', 'Thông báo trung tâm sẽ nghỉ lễ 1 tuần chào mừng ngày lễ 30/4/2025 - 1/5/2025', 'all', 1, '2025-04-15 11:47:25', '2025-04-15 11:47:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notification_targets`
--

CREATE TABLE `notification_targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `class_id` varchar(20) DEFAULT NULL,
  `course_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_method` enum('credit_card','bank_transfer','cash') NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `course_id`, `student_id`, `amount`, `payment_date`, `payment_method`, `status`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 'C002', 'RT0018', 1500000.00, '2025-04-08 20:32:34', 'credit_card', 'completed', NULL, '2025-03-31 23:00:27', NULL),
(2, 'C003', 'RT0019', 200000.00, '2025-04-08 20:33:20', 'credit_card', 'completed', NULL, '2025-04-01 23:00:30', NULL),
(3, 'C001', 'RT0016', 1000000.00, '2025-04-08 20:33:44', 'credit_card', 'completed', NULL, '2025-04-09 23:00:33', NULL),
(4, 'C001', 'RT0013', 1000000.00, '2025-04-08 20:35:57', 'credit_card', 'completed', NULL, '2025-04-08 23:00:36', NULL),
(5, 'C002', 'RT0014', 1500000.00, '2025-04-08 20:36:24', 'credit_card', 'completed', NULL, '2025-04-02 23:00:39', NULL),
(6, 'C003', 'RT0015', 200000.00, '2025-04-08 20:37:02', 'credit_card', 'completed', NULL, '2025-04-08 23:00:42', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aPyrLa6cgeU4i4X7mmGKMnFyGQsUEqwZtqBG6Pks', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVm1BNHFOc2xRbDh0TGZESnZUZFFMTzUxVFR0czIyOTlrcllDbWFRZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo4ODoiaHR0cDovL2xvY2FsaG9zdDo4MDgwL21hbmFnZW1lbnRfbGFyYXZlbC9Db3Vyc2VNYW5hZ2VtZW50L3B1YmxpYy9jb3Vyc2VfbWFuYWdlbWVudC9pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1744778684);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_grades`
--

CREATE TABLE `student_grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_grades`
--

INSERT INTO `student_grades` (`id`, `student_id`, `exam_id`, `score`, `created_at`, `updated_at`) VALUES
(1, 13, 1, 8.00, '2025-03-26 21:33:19', NULL),
(2, 13, 2, 7.00, '2025-03-26 21:33:19', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teachers`
--

CREATE TABLE `teachers` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bio` text DEFAULT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `bio`, `expertise`, `joining_date`, `status`, `created_at`, `updated_at`) VALUES
('SM002', 2, 'Giáo viên yêu thích giảng dạy tiếng Anh.', 'Tiếng Anh', '2023-02-01', 'Active', '2025-04-05 04:03:38', '2025-04-05 04:03:38'),
('SM003', 3, 'Chuyên gia về khoa học máy tính.', 'Công nghệ thông tin', '2023-03-01', 'Active', '2025-04-05 04:03:38', '2025-04-05 04:03:38'),
('SM004', 4, 'Giảng viên tâm lý học với sự nghiệp 10 năm.', 'Tâm lý học', '2023-04-01', 'Active', '2025-04-05 04:03:38', '2025-04-05 04:03:38'),
('SM005', 5, 'Giáo viên giảng dạy lịch sử và địa lý.', 'Lịch sử', '2023-05-01', 'Active', '2025-04-05 04:03:38', '2025-04-05 04:03:38'),
('SM006', 6, 'Chuyên gia trong lĩnh vực văn học.', 'Văn học', '2023-06-01', 'Active', '2025-04-05 04:03:38', '2025-04-05 04:03:38'),
('SM007', 7, 'Giáo viên toán học với cách giảng dạy hiện đại.', 'Toán học', '2023-07-01', 'Active', '2025-04-05 04:03:38', '2025-04-05 04:03:38'),
('SM008', 8, 'Giảng viên nghiên cứu xã hội học.', 'Xã hội học', '2023-08-01', 'Active', '2025-04-05 04:03:38', '2025-04-05 04:03:38'),
('SM009', 9, 'Giáo viên dạy âm nhạc với phương pháp mới.', 'Âm nhạc', '2023-09-01', 'Active', '2025-04-05 04:03:38', '2025-04-05 04:03:38'),
('SM010', 10, 'Giảng viên ngoại ngữ chuyên về tiếng Anh và Pháp.', 'Ngoại ngữ', '2023-10-01', 'Active', '2025-04-05 04:03:38', '2025-04-05 04:03:38'),
('SM011', 11, 'Giáo viên thể dục với nhiều kinh nghiệm giảng dạy.', 'Thể dục', '2023-11-01', 'Active', '2025-04-05 04:03:38', '2025-04-05 04:03:38'),
('SM036', 36, 'sưewf', 'fgg', NULL, 'Active', '2025-04-09 00:12:11', '2025-04-09 00:12:11'),
('SM040', 40, 'xưdcfrv', 'sdefgrt', '2025-04-01', 'Active', '2025-04-09 00:21:13', '2025-04-09 00:21:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'https://img.myloview.com/stickers/default-avatar-profile-icon-vector-social-media-user-image-700-205124837.jpg',
  `fullname` varchar(100) NOT NULL DEFAULT 'user',
  `birthday` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Nam','Nữ') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('admin','teacher','student') NOT NULL DEFAULT 'student',
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `student_id`, `avatar`, `fullname`, `birthday`, `email`, `email_verified_at`, `password`, `gender`, `remember_token`, `role`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, NULL, 'https://cdn.tcdulichtphcm.vn/upload/4-2024/images/2024-11-22/1732271274-006iuq8wly1hv9jtaknluj32m83xcqv9-1.jpg', 'Vũ Thị Vân Anh', '2003-08-06', 'test@example.com', '2025-04-04 20:56:21', '$2y$12$tHEEFHBq9TAkuLVhljR05.ifL.CNr5dXHePFkwMJAx1Kas88T6q3K', 'Nam', 'OFu8GBFkOsswe1CXlqv8PZr4XGIX9GqUCpf0g2NynlYyXc5mbsgnzCrYD5d3', 'admin', '0985674326', 'Lĩnh Nam, Hà Nội', '2025-04-04 20:56:21', '2025-04-04 20:56:21'),
(2, NULL, 'https://img.freepik.com/premium-photo/education-teachers-university-schools-concept-young-smiling-woman-employer-student-glasses_1258-60817.jpg?semt=ais_hybrid&w=740', 'Nguyễn Văn Anh', '1990-01-01', 'user1@example.com', NULL, 'password', 'Nữ', NULL, 'teacher', '0901234567', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(3, NULL, 'https://img.freepik.com/premium-photo/middle-aged-asian-woman-teacher-classroom-white-board-university_43157-2459.jpg?semt=ais_hybrid&w=740', 'Trần Thị Bích', '1991-02-01', 'user2@example.com', NULL, 'password', 'Nữ', NULL, 'teacher', '0902345678', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(4, NULL, 'https://sohanews.sohacdn.com/zoom/640_400/160588918557773824/2023/2/15/photo1676437337491-1676437337992447080488.jpg', 'Phạm Minh Cường', '1992-03-01', 'user3@example.com', NULL, 'password', 'Nam', NULL, 'teacher', '0903456789', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(5, NULL, 'https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of-social-media-user-vector.jpg', 'Nguyễn Thị Dung', '1993-04-01', 'user4@example.com', NULL, 'password', 'Nữ', NULL, 'teacher', '0904567890', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(6, NULL, 'https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of-social-media-user-vector.jpg', 'Lê Quang Dũng', '1994-05-01', 'user5@example.com', NULL, 'password', 'Nam', NULL, 'teacher', '0905678901', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(7, NULL, 'https://baoquangbinh.vn/dataimages/202404/original/images779484_1.png', 'Nguyễn Thị Hạnh', '1995-06-01', 'user6@example.com', NULL, '$2y$12$tHEEFHBq9TAkuLVhljR05.ifL.CNr5dXHePFkwMJAx1Kas88T6q3K', 'Nữ', NULL, 'teacher', '0906789012', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(8, NULL, 'https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of_social_media_user_vector.jpg', 'Phan Minh Hải', '1996-07-01', 'user7@example.com', NULL, 'password', 'Nam', NULL, 'teacher', '0907890123', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(9, NULL, 'https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of_social_media_user_vector.jpg', 'Trần Quang Hiệp', '1997-08-01', 'user8@example.com', NULL, 'password', 'Nam', NULL, 'teacher', '0908901234', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(10, NULL, 'https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of_social_media_user_vector.jpg', 'Lê Thị Kiều', '1998-09-01', 'user9@example.com', NULL, 'password', 'Nữ', NULL, 'teacher', '0909012345', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(11, NULL, 'https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of_social_media_user_vector.jpg', 'Phạm Thị Uyên', '1999-10-01', 'user10@example.com', NULL, 'password', 'Nữ', NULL, 'teacher', '0900123456', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(12, NULL, 'https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of_social_media_user_vector.jpg', 'Nguyễn Minh Khánh', '2000-11-01', 'user11@example.com', NULL, 'password', 'Nam', NULL, 'teacher', '0901234567', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(13, 'RT0013', 'http://images.careerviet.vn/content/images/thoi-quen-cua-nhung-nguoi-giau-suc-thu-hut-careerbuilder.jpg', 'Nguyễn Thị Linh', '2001-12-01', 'user12@example.com', NULL, 'password', 'Nữ', NULL, 'student', '0902345678', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(14, 'RT0014', 'https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/474053GiS/anh-avatar-be-gai-cute-nguoi-that_043409747.jpg', 'Trần Minh Khải', '2002-01-01', 'user13@example.com', NULL, 'password', 'Nữ', NULL, 'student', '0903456789', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(15, 'RT0015', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/180503_%EB%B0%95%EB%B3%B4%EA%B2%80_01_%28cropped%29.jpg/330px-180503_%EB%B0%95%EB%B3%B4%EA%B2%80_01_%28cropped%29.jpg', 'Lê Quang Trí', '2003-02-01', 'user14@example.com', NULL, '$2y$12$tHEEFHBq9TAkuLVhljR05.ifL.CNr5dXHePFkwMJAx1Kas88T6q3K', 'Nam', NULL, 'student', '0904567890', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(16, 'RT0016', 'https://img.myloview.com/stickers/default-avatar-profile-icon-vector-social-media-user-image-700-205124837.jpg', 'Phạm Minh Quang', '2004-03-01', 'user15@example.com', NULL, 'password', 'Nam', NULL, 'student', '0905678901', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(17, 'RT0017', 'https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of_social_media_user_vector.jpg', 'Nguyễn Quang Đạt', '2005-04-01', 'user16@example.com', NULL, 'password', 'Nam', NULL, 'student', '0906789012', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(18, 'RT0018', 'https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of_social_media_user_vector.jpg', 'Trần Thị Hợi', '2006-05-01', 'user17@example.com', NULL, '$2y$12$SX4Sw6xH6QknevjFzhQiu.uVZRBc3Wn0BsAuCkhSB4gA0bAzsgEMi', 'Nữ', NULL, 'student', '0907890123', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(19, 'RT0019', 'https://cdn2.tuoitre.vn/thumb_w/640/471584752817336320/2025/3/9/iu-park-bo-gum-2-1741482278076812000841.jpeg', 'Lê Thị Ngọt', '2007-06-01', 'user18@example.com', NULL, 'password', 'Nữ', NULL, 'student', '0908901234', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(20, 'RT0020', 'https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of_social_media_user_vector.jpg', 'Nguyễn Minh Sáng', '2008-07-01', 'user19@example.com', NULL, 'password', 'Nam', NULL, 'student', '0909012345', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(21, 'RT0021', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/180503_%EB%B0%95%EB%B3%B4%EA%B2%80_01_%28cropped%29.jpg/330px-180503_%EB%B0%95%EB%B3%B4%EA%B2%80_01_%28cropped%29.jpg', 'Trần Quang Tùng', '2009-08-01', 'user20@example.com', NULL, 'password', 'Nam', NULL, 'student', '0900123456', 'Hà Nội', '2025-04-05 03:59:50', '2025-04-05 03:59:50'),
(26, 'RT0026', NULL, 'Hien', '2025-04-10', 'luan12ep1@gmail.com', NULL, '$2y$12$SX4Sw6xH6QknevjFzhQiu.uVZRBc3Wn0BsAuCkhSB4gA0bAzsgEMi', 'Nam', NULL, 'student', '0395751903', '12 Đông Thiên', '2025-04-08 13:34:19', '2025-04-08 13:34:19'),
(36, NULL, NULL, 'Fgssssd', '2025-03-30', 'sdsf@gmail.com', NULL, '$2y$12$N20rhpEX7OvTtDqKLQ9eluCCigVY32epuPk5V.yuU8PGw/c/5.Vri', 'Nam', NULL, 'teacher', '0395751903', '12 Đông Thiên', '2025-04-09 00:12:11', '2025-04-09 00:12:11'),
(40, NULL, NULL, '2sedefrf', '2025-04-14', 'xdwcd@gmail.com', NULL, '$2y$12$Tg6WlggXM86fTujLqSYKC.9jB43t2d./H8aiVcN8ohXsYwS7UJopa', 'Nữ', NULL, 'teacher', '0395751903', '12 Đông Thiên', '2025-04-09 00:21:13', '2025-04-09 00:21:13'),
(42, NULL, 'https://img.myloview.com/stickers/default-avatar-profile-icon-vector-social-media-user-image-700-205124837.jpg', 'Trương Văn Trung', NULL, 'trung@gmail.com', NULL, '$2y$12$9Su0.E1T41DspKtW.dyvbu3C11nLXaAfDuAGj8NHgPpjcEmmmbQka', 'Nam', NULL, 'student', NULL, NULL, '2025-04-15 02:17:31', '2025-04-15 02:17:31');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_tasks`
--
ALTER TABLE `admin_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_student_id_foreign` (`student_id`),
  ADD KEY `attendances_class_id_foreign` (`class_id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classes_teacher_id_foreign` (`teacher_id`),
  ADD KEY `classes_course_id_foreign` (`course_id`);

--
-- Chỉ mục cho bảng `class_schedules`
--
ALTER TABLE `class_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_schedules_class_id_foreign` (`class_id`);

--
-- Chỉ mục cho bảng `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `course_materials`
--
ALTER TABLE `course_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_materials_uploaded_by_foreign` (`uploaded_by`),
  ADD KEY `course_materials_course_id_foreign` (`course_id`);

--
-- Chỉ mục cho bảng `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_reviews_course_id_student_id_unique` (`course_id`,`student_id`),
  ADD KEY `course_reviews_student_id_foreign` (`student_id`);

--
-- Chỉ mục cho bảng `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollments_student_id_foreign` (`student_id`),
  ADD KEY `enrollments_payment_id_foreign` (`payment_id`),
  ADD KEY `enrollments_class_id_foreign` (`class_id`);

--
-- Chỉ mục cho bảng `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_course_id_foreign` (`course_id`),
  ADD KEY `fk_exams_uploaded_by` (`uploaded_by`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notification_targets`
--
ALTER TABLE `notification_targets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_targets_notification_id_foreign` (`notification_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_course_id_foreign` (`course_id`),
  ADD KEY `payments_student_id_foreign` (`student_id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `student_grades`
--
ALTER TABLE `student_grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_grades_student_id_foreign` (`student_id`),
  ADD KEY `student_grades_exam_id_foreign` (`exam_id`);

--
-- Chỉ mục cho bảng `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_student_id_unique` (`student_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_tasks`
--
ALTER TABLE `admin_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `class_schedules`
--
ALTER TABLE `class_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `course_materials`
--
ALTER TABLE `course_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `course_reviews`
--
ALTER TABLE `course_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `notification_targets`
--
ALTER TABLE `notification_targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `student_grades`
--
ALTER TABLE `student_grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `classes_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `class_schedules`
--
ALTER TABLE `class_schedules`
  ADD CONSTRAINT `class_schedules_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `course_materials`
--
ALTER TABLE `course_materials`
  ADD CONSTRAINT `course_materials_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_materials_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD CONSTRAINT `course_reviews_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_reviews_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_exams_uploaded_by` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `notification_targets`
--
ALTER TABLE `notification_targets`
  ADD CONSTRAINT `notification_targets_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`student_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `student_grades`
--
ALTER TABLE `student_grades`
  ADD CONSTRAINT `student_grades_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_grades_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
